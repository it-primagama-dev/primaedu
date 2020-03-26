<?php

class RptpurchreqappfinController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Laporan Pembelian Smartbook');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Laporan Pembelian Smartbook ( Approve Finance )';
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
            return $this->forward('rptpurchreqappfin/index');
        }
        $datefrom = $this->request->getPost('DateFrom', 'int') ? : date('Y-m-d');
        $dateto = $this->request->getPost('DateTo', 'int') ? : date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateArea($this->request->getPost('cabang'));
        $status = "Approved";
        
        $purchreq = Purchreqheader::query()
               //->columns(array('Purchreqheader.*, count(Purchreqheader.PurchReqId) as Total'))
                ->join('Areacabang', 'Purchreqheader.Cabang = c.RecID', 'c')
                ->join('Areacabang', 'c.Area = a.KodeAreaCabang', 'a')
                ->join('Konfirmasipembayaran', 'd.PurchReqId = Purchreqheader.PurchReqId','d')
                ->orderby('c.KodeAreaCabang')
                ;//->execute();
        if ($areaid) {
            $purchreq->andWhere('a.RecID = :area:',['area' => $areaid]);
        }
        if ($cabangid) {
            $purchreq->andWhere('c.KodeAreaCabang = :cabang:',['cabang' => $cabangid]);
        }
        if ($status) {
            $purchreq->andWhere('d.Status = :status:', ['status' => $status]);
        }

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = date('d/m/Y', strtotime($datefrom));
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
            "Area IS NULL AND RecID = ?0", "bind" => [0 => $areaid]
        ]);
        return $area !== FALSE ? $area->NamaAreaCabang : "Undefined";
    }    

    public function getcabangAction($area = 0) {
        $this->view->disable();
        $cabang = Areacabang::query()
                ->columns("c.*")
                ->join("Areacabang", "Areacabang.KodeAreaCabang = c.Area", "c")
                ->where("Areacabang.RecID = :area:")
                ->orderBy("c.KodeAreaCabang")
                ->bind(["area" => $this->filter->sanitize($area, "int")])
                ->execute();
        echo "<option value=\"\">---</option>";
        if (!count($cabang)) {
            return;
        }
        foreach ($cabang as $rec) {
            echo "<option value=\"" . $rec->KodeAreaCabang . "\">" . $rec->KodeNamaAreaCabang . "</option>";
        }
    }
}
