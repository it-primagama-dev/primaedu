<?php

class RptpurchreqController extends ControllerBase {

    protected $auth;
    protected $sql = <<<SQL
SELECT
    a.KodeAreaCabang AS [KodeArea], a.NamaAreaCabang AS [NamaArea],
    c.KodeAreaCabang AS [KodeCabang], c.NamaAreaCabang AS [NamaCabang],
    ph.PurchReqId, ph.PurchReqName, ph.[Status], ph.Requester, ph.PurchReqDate, ph.Remarks, ph.ImportAX,
    pl.ItemId, pl.ItemName, pl.Qty, pl.Qty - pl.QtyRemaining AS QtyReceived, pl.QtyRemaining, pl.IsReceipt
FROM areacabang a
JOIN areacabang c on a.KodeAreaCabang = c.Area
JOIN purchreqheader ph on c.RecID = ph.Cabang
JOIN purchreqline pl on ph.RecId = pl.Purchreqheader
WHERE c.Aktif = 1 AND a.KodeAreaCabang LIKE '%%0%' AND ph.[Status] LIKE '%%1%'
ORDER by  [KodeCabang], PurchReqId,[KodeArea]
SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan Pembelian Smartbook');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Laporan Pembelian Smartbook';
    }

    public function indexAction() {
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->view->status = $this->modelsManager->createBuilder()
                ->columns('ph.Status AS Status')
                ->addFrom('Purchreqheader', 'ph')
                ->groupBy('ph.Status')->getQuery()->execute()
                ->setHydrateMode(Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
        $this->view->rpt_auth = $this->auth;
        $this->tag->setDefault('KodeArea', $this->auth['kodeareacabang']);
    }

    public function viewAction() {
        if (!$this->request->isPost()) {
            return $this->forward('rptpurchreq/index');
        }
        $datefrom = $this->request->getPost('DateFrom', 'int');
        $dateto = $this->request->getPost('DateTo', 'int');
        $areaid = $this->_validateArea($this->request->getPost('KodeArea'));
        $status = $this->request->getPost('Status');

        $purchreq = Purchreqheader::query()
                ->join('Areacabang', 'Purchreqheader.Cabang = c.RecID', 'c')
                ->join('Areacabang', 'c.Area = a.KodeAreaCabang', 'a')
                ;//->execute();
        if ($areaid) {
            $purchreq->andWhere('c.Area = :area:',['area' => $areaid]);
        }
        if ($status) {
            $purchreq->andWhere('Purchreqheader.Status = :status:', ['status' => $status]);
        }
        if ($datefrom) {
            $purchreq->andWhere('Purchreqheader.PurchReqDate > :PurchReqDate:', ['PurchReqDate' => $datefrom]);
            $purchreq->andWhere('Purchreqheader.PurchReqDate < :PurchReqDatea:', ['PurchReqDatea' => $dateto]);
        }

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = date('d/m/Y', strtotime($datefrom)) . ' - ' . date('d/m/Y', strtotime($dateto));
        //$this->view->result = $query->fetchAll($query);
        $this->view->result = $purchreq->execute();
        $this->view->area = $areaid ? $this->_getAreaName($areaid) : 'All';
    }

    private function _validateArea($areaid = NULL) {
        if ($this->auth['areaparent']) {
            return NULL;
        } else if ($this->auth['areacabang']) {
            return $this->auth['kodeareacabang'];
        } else {
            return $areaid ? : NULL;
        }
    }

    private function _getAreaName($areaid) {
        $area = Areacabang::findFirst([
            "Area IS NULL AND KodeAreaCabang = ?0", "bind" => [0 => $areaid]
        ]);
        return $area !== FALSE ? $area->NamaAreaCabang : "Undefined";
    }
}
 