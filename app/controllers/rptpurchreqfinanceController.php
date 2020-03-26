<?php

class RptpurchreqfinanceController extends ControllerBase
{

    protected $auth;

   

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

        $status = $this->request->getPost('Status');
        $tglawal = $this->request->getPost('DateFrom', 'int') ? : date('Y-m-d');
        $tglakhir = $this->request->getPost('DateTo', 'int') ? : date('Y-m-d');
	$awal = date('Y/m/d', strtotime($tglawal));
	$akhir = date('Y/m/d', strtotime($tglakhir));
        $sql = "SELECT ph.PurchReqId as KodePR, ph.PurchReqName,pl.ItemId, pl.ItemName, pl.Qty as pembelian, pl.QtyRemaining as kurang, pl.IsReceipt as diterima,
                (select sum(Konfirmasipembayaran.Nominal) as Nominal from Konfirmasipembayaran where Konfirmasipembayaran.PurchReqId = ph.PurchReqId and Status = 'Approved') as Uang_masuk,
                (select top 1 Konfirmasipembayaran.PurchReqDate from Konfirmasipembayaran where Konfirmasipembayaran.PurchReqId = ph.PurchReqId and Status = 'Approved' order by RecID desc) as TglSubmit,
                (select top 1 Konfirmasipembayaran.ApprovalDate from Konfirmasipembayaran where Konfirmasipembayaran.PurchReqId = ph.PurchReqId and Status = 'Approved' order by RecID desc) as TglApproved
                FROM areacabang a
                JOIN areacabang c on a.KodeAreaCabang = c.Area
                JOIN purchreqheader ph on c.RecID = ph.Cabang
                JOIN purchreqline pl on ph.RecId = pl.Purchreqheader
                JOIN Konfirmasipembayaran kf on ph.PurchReqId=kf.PurchReqId
                WHERE kf.Status = 'Approved' and ph.PurchReqId not like '%9999%' AND convert(varchar(20), kf.ApprovalDate,111) <= '$akhir' AND  convert(varchar(20), kf.ApprovalDate,111) >= '$awal'
                group by ph.PurchReqId, ph.PurchReqName,pl.ItemId, pl.ItemName, pl.QtyRemaining, pl.IsReceipt, pl.Qty
                Order By TglApproved";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);
        $this->view->tgl_awal = $tglawal;
        $this->view->tgl_akhir = $tglakhir;

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
    }

    private function _getCriteria($areaid, $cabangid) {
        $temp = "WHERE ";
        if ($areaid){
            $temp .= "a.RecID = ".$areaid;
        }
        if ($cabangid){
            $temp .= $areaid ? " AND " : "";
            $temp .= "c.RecID = ".$cabangid;
        }
        return $temp == "WHERE " ? "" : $temp;
    }

    private function _validateArea($areaid) {
        if ($this->auth['areaparent']) {
            return $this->auth['areaparent'];
        } else if ($this->auth['areacabang']) {
            return $this->auth['areacabang'];
        } else {
            return $areaid ? : NULL;
        }
    }

    private function _validateCabang($cabangid) {
        if ($this->auth['areaparent']) {
            return $this->auth['areacabang'];
        } else {
            return $cabangid ? : NULL;
        }
    }

}

