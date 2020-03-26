<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class RptbarcodecabangController extends ControllerBase {

    protected $auth;

   

    public function initialize() {
        $this->tag->setTitle('Data Stok Barcode');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Data Stok Barcode';
    }

    public function indexAction() {

    $cabang = $this->session->get('auth');
    $prcabang = $cabang['areacabang'];

     $this->view->PRecId = Purchreqheader::query()
                ->columns("*")
                ->where("Cabang = '$prcabang' and Status='Approved' and ApprovalDate > '2017-06-01'")
                ->orderBy("RecId DESC")
              ->execute();


    }

    public function viewAction(){

        if (!$this->request->isPost()) {
            return $this->forward('Rptbarcodecabang/index');
        }

    $this->tag->setTitle('Laporan Barcode Cabang');
    $cabang = $this->session->get('auth');
    $prcabang = $cabang['areacabang'];

    $stok = $this->request->getPost('pr');
    $pr = $this->request->getPost('PRecId');

    if($stok==1){
      $where="masterbarcode.Cabang = '$prcabang' and Purchreqheader.ApprovalDate <= '2017-06-01' OR masterbarcode.Cabang = '$prcabang' and Purchreqheader.ApprovalDate is null";
      $wherecount="masterbarcode.Cabang = '$prcabang' and Purchreqheader.ApprovalDate <= '2017-06-01' and masterbarcode.status = 1 OR masterbarcode.Cabang = '$prcabang' and Purchreqheader.ApprovalDate is null and masterbarcode.status = 1";
    } else if($pr =='' && $stok==2) {
      $where="masterbarcode.Cabang = '$prcabang' and Purchreqheader.ApprovalDate >= '2017-06-01'";
      $wherecount="masterbarcode.Cabang = '$prcabang' and Purchreqheader.ApprovalDate >= '2017-06-01' and masterbarcode.status = 1";
    } else if($pr !='' && $stok==2) {
      $where="masterbarcode.Cabang = '$prcabang' and Purchreqheader.ApprovalDate >= '2017-06-01' and masterbarcode.PurchReqId = '$pr'";
      $wherecount="masterbarcode.Cabang = '$prcabang' and Purchreqheader.ApprovalDate >= '2017-06-01' and masterbarcode.PurchReqId = '$pr' and masterbarcode.status = 1";
    } else {
      $where="masterbarcode.Cabang = '$prcabang'";
      $wherecount="masterbarcode.Cabang = '$prcabang' and masterbarcode.status = 1";
    }

        $sql="SELECT count(barcode) as jumlahpr from masterbarcode 
              join Purchreqheader on masterbarcode.PurchReqId=Purchreqheader.RecID
              where $where";
        $q = $this->getDI()->getShared('db')->query($sql);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->jumlahpr = $q->fetchAll($q);         

        $sql1="SELECT count(barcode) as jumlahpr from masterbarcode 
              join Purchreqheader on masterbarcode.PurchReqId=Purchreqheader.RecID 
              where $wherecount";
        $q1 = $this->getDI()->getShared('db')->query($sql1);
        $q1->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->jumlahpr1 = $q1->fetchAll($q1); 
 
        $mbarcode = masterbarcode::query()
                ->columns("masterbarcode.Status as status,Purchreqheader.ApprovalDate, masterbarcode.RecID, Areacabang.KodeAreaCabang as Cabangg, Purchreqheader.PurchReqId, masterbarcode.Barcode as Barcode, SUBSTRING(masterbarcode.barcode,7,2) as Kurikulum, Inventitem.NamaItem as NamaBuku")
                ->join("Areacabang", "masterbarcode.Cabang=Areacabang.RecId")
                ->join("Purchreqheader", "masterbarcode.PurchReqId = Purchreqheader.RecId")
                ->join("barcodeitem", "SUBSTRING(masterbarcode.barcode,5,2)=barcodeitem.Jenjang 
                                        and SUBSTRING(masterbarcode.barcode,7,2) = barcodeitem.kurikulum")
                ->join("Inventitem", "barcodeitem.kodeitem=Inventitem.KodeItem")
                ->where("$where")
               ->orderBy("Purchreqheader.PurchReqId,masterbarcode.RecID")
              ->execute();

        $paginator = new Paginator(array(
            "data" => $mbarcode,
            "limit" => 1000,
            "page" => $numberPage
        ));

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->stok = $stok; 
        $this->view->page = $paginator->getPaginate();
    }

}