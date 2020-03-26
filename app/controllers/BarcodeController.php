<?php
    
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class BarcodeController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle("Barcode Cabang");
        parent::initialize();        

        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    
    }

   
    public function indexAction() {
            //$this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
            $this->view->cabangtx = $this->getTransaction();
            $this->view->jenjang = jenjang::find();

            $this->persistent->parameters = null;
    }

    public function detailAction() {

        $this->view->leveluser = $this->auth['usergroup'];
    }

    public function detailbarcodeAction() {
        
        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);

        $Barcode = $this->request->getPost('Barcode');
        $PR = $this->request->getPost('pr');
        if($Barcode != '' AND $PR == ''){
            $where = "a.Barcode = '$Barcode'";
        } else if ($Barcode == '' AND $PR != '') {
            $where = "e.PurchReqId like '%$PR%'";
        } else  {
            $where = "a.Barcode = '111111111111111'";
        }
        $sql = "SELECT a.RecID,a.Barcode, a.Status, d.NamaItem, b.KodeAreaCabang,b.NamaAreaCabang, a.CreatedBy, a.CreatedAt, a.Cabang, a.PurchReqId, a.TypeUpload  ,e.PurchReqId as PR, f.NoVA
                from masterbarcode a 
                join areacabang b on a.Cabang=b.RecID
                join barcodeitem c on SUBSTRING(a.barcode,5,2)=c.jenjang and SUBSTRING(a.barcode,7,2) = c.kurikulum
                join inventitem d on c.kodeitem=d.KodeItem
                join purchreqheader e on a.PurchReqId=e.RecId
                left join barcode f on a.Barcode=f.bcode
                where $where";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);
        $this->view->leveluser = $this->auth['usergroup'];
    }

    public function ViewAction() {

        if (!$this->request->isPost()) {
            return $this->forward('barcode/index');
        }

        $this->view->rpt_title = 'Barcode Cabang';
        $areaid = $this->_validateArea($this->request->getPost('Area2'));
        $cabangid = $this->request->getPost('Cabang2');
        $pr = $this->request->getPost('Kodepr2');     
        $stok = $this->request->getPost('pr2');     

        if ($stok != '1') {
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->RecID : 'All';
        $this->view->rpt_namacabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';
        $this->view->rpt_kodecabang = $cabangid ? $cabang->KodeAreaCabang : 'All';
        $kodepr = Purchreqheader::findFirstByRecId($pr);
        $this->view->rpt_pr = $pr ? $kodepr->RecId : 'All';
        $kodepr2 = Purchreqheader::findFirstByRecId($pr);
        $this->view->rpt_pr2 = $pr ? $kodepr2->PurchReqId : 'All';

        $sql="SELECT count(barcode) as jumlahpr from masterbarcode where PurchReqId = '$pr'";
        $q = $this->getDI()->getShared('db')->query($sql);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->jumlahpr = $q->fetchAll($q); 

        $where = "masterbarcode.PurchReqId='$pr'";

        } else {

        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->RecID : 'All';
        $this->view->rpt_namacabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';
        $this->view->rpt_kodecabang = $cabangid ? $cabang->KodeAreaCabang : 'All';
        $kodepr2 = Purchreqheader::findFirstByRecId($pr);
        $this->view->rpt_pr2 = "Barcode Lama";

        $sql="SELECT count(barcode) as jumlahpr from masterbarcode 
                join Purchreqheader on masterbarcode.PurchReqId=Purchreqheader.RecId
                where masterbarcode.Cabang='$cabangid' and Purchreqheader.PurchReqDate <= '2017-06-01'";
        $q = $this->getDI()->getShared('db')->query($sql);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->jumlahpr = $q->fetchAll($q); 

        $where = "masterbarcode.Cabang='$cabangid' and Purchreqheader.PurchReqDate <= '2017-06-01'";

        }
        $mbarcode = masterbarcode::query()
                ->columns(" masterbarcode.RecID, Areacabang.KodeAreaCabang as Cabangg, Purchreqheader.PurchReqId, masterbarcode.Barcode as Barcode, Inventitem.NamaItem, SUBSTRING(masterbarcode.barcode,7,2) as Kurikulum")
                ->join("Areacabang", "masterbarcode.Cabang=Areacabang.RecId")
                ->join("barcodeitem", "SUBSTRING(masterbarcode.barcode,5,2)=barcodeitem.Jenjang 
                                        and SUBSTRING(masterbarcode.barcode,7,2) = barcodeitem.kurikulum")
                ->join("Inventitem", "barcodeitem.kodeitem=Inventitem.KodeItem")
                ->join("Purchreqheader", "masterbarcode.PurchReqId = Purchreqheader.RecId")
                ->where("$where")
               ->orderBy("masterbarcode.PurchReqId")
              ->execute();

        $paginator = new Paginator(array(
            "data" => $mbarcode,
            "limit" => 1000,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);

    }



    public function addbarcodeAction() {
        $this->persistent->parameters = null;
         $numberPage = 1;
        if (!$this->request->isPost()) {
        $numberPage = $this->request->getQuery("page", "int");
        }

        $cabangid = $this->request->getPost('Cabang');
        $stok = $this->request->getPost('pr');

        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->RecID : 'All';
        $this->view->rpt_namacabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';
        $this->view->rpt_kodecabang = $cabangid ? $cabang->KodeAreaCabang : 'All';

        if ($stok != '1') {

        $pr = $this->request->getPost('Kodepr');

        $kodepr = Purchreqheader::findFirstByRecId($pr);
        $this->view->rpt_pr = $pr ? $kodepr->RecId : 'All';

        $kodepr2 = Purchreqheader::findFirstByRecId($pr);
        $this->view->rpt_pr2 = $pr ? $kodepr2->PurchReqId : 'Barcode Lama';
        $this->view->rpt_prExcel = $pr ? $kodepr2->PurchReqId : 'All'; 
        $this->view->cabangid = $cabangid;

        $sql="SELECT count(barcode) as jumlahpr from masterbarcode where PurchReqId = '$pr'";
        $q = $this->getDI()->getShared('db')->query($sql);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->jumlahpr = $q->fetchAll($q); 

        $where = "masterbarcode.Cabang = '$cabangid' and masterbarcode.PurchReqId='$pr'";

        } else {

        $sql="SELECT count(barcode) as jumlahpr 
                from masterbarcode 
                join Purchreqheader on masterbarcode.PurchReqId=Purchreqheader.RecId
                where masterbarcode.Cabang = '$cabangid' and purchreqheader.PurchReqDate <= '2017-06-01'";
        $q = $this->getDI()->getShared('db')->query($sql);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->jumlahpr = $q->fetchAll($q);

        $sql1="SELECT Top 1 * From Purchreqheader where cabang='$cabangid' and PurchReqDate <= '2017-06-01'";
        $q1 = $this->getDI()->getShared('db')->query($sql1);
        $q1->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $rpt_pr2 = $q1->fetchAll($q1);

        foreach ($rpt_pr2 as $rec) {
            $prlama=$rec->PurchReqId;
            $prlamaRecID=$rec->RecId;
        }
        $this->view->rpt_pr2 = 'Barcode Lama'; 
        $this->view->rpt_prExcel = $prlama; 
        $this->view->rpt_pr = $prlamaRecID;

        $where = "masterbarcode.Cabang = '$cabangid' and Purchreqheader.PurchReqDate <= '2017-06-01'";

        }

        $sql2="SELECT count(barcode) as jumlah from masterbarcode where Cabang = '$cabangid'";
        $q2 = $this->getDI()->getShared('db')->query($sql2);
        $q2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->jumlah = $q2->fetchAll($q2); 

        $mbarcode = masterbarcode::query()
                ->columns(" masterbarcode.RecID, masterbarcode.Cabang as Cabangg, Purchreqheader.PurchReqId, masterbarcode.Barcode as Barcode, Inventitem.NamaItem, SUBSTRING(masterbarcode.barcode,7,2) as Kurikulum,Purchreqheader.ApprovalDate")
                ->join("barcodeitem", "SUBSTRING(masterbarcode.barcode,5,2)=barcodeitem.Jenjang 
                                        and SUBSTRING(masterbarcode.barcode,7,2) = barcodeitem.kurikulum")
                ->join("Inventitem", "barcodeitem.kodeitem=Inventitem.KodeItem")
                ->join("Purchreqheader", "masterbarcode.PurchReqId = Purchreqheader.RecId")
               ->where("$where")
               ->orderBy("masterbarcode.RecID DESC")
              ->execute();

        $paginator = new Paginator(array(
            "data" => $mbarcode,
            "limit" => 1000,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
   
    }


    public function tambahAction()
    {
        
       // if (isset($_POST["submit"]))
        //if (isset($_POST["Jawaban"]))
        //foreach($_POST['Barcode'] AS $key=>$val)
        //foreach($_POST['Jawaban'] as $idd) 
        //{

        $id = $this->request->getPost("Barcode");
       // $sarann = $_POST['isisaran'];

        $paramCount = [
            "Barcode = :bc:", "bind" => ["bc" => $id]
        ];
        if (masterbarcode::count($paramCount)) {
            $this->flash->error("Input GAGAL, Barcode $id sudah terdaftar");
            return $this->dispatcher->forward(array(
            "controller" => "barcode",
            "action" => "addbarcode"
        ));
        }


        //$PurchReqId = $this->request->getPost("Kodepr");

        $barcode = new masterbarcode();

        $barcode->Cabang = $this->request->getPost("Cabang");
        $barcode->PurchReqId = $this->request->getPost("Kodepr");
        $barcode->Barcode = $id;
        $barcode->CreatedAt = date("Y-m-d H:i:s");
        $barcode->CreatedBy = $this->auth['username'];
        $barcode->Status = 0;
        
        $barcode->save();
        //}
        $this->flash->success("Input barcode $id berhasil...");
        return $this->dispatcher->forward(array(
            "controller" => "barcode",
            "action" => "addbarcode"
        ));
         $this->view->mbarcode = masterbarcode::find();


    }

    public function allAction($cabang)
    {

        if (!$this->request->isPost()) {
        $numberPage = $this->request->getQuery("page", "int");
        }

        $cabang = $_GET["cabang"];

        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->RecID : 'All';
        $this->view->rpt_namacabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';
        
        $mbarcode = masterbarcode::query()
                ->columns(" masterbarcode.RecID, masterbarcode.Cabang as Cabang, Purchreqheader.PurchReqId as Kodepr, masterbarcode.Barcode as Barcode, jenjang.NamaJenjang as NamaJenjang")
                ->join("jenjangbarcode", "SUBSTRING(masterbarcode.barcode,5,2) = jenjangbarcode.kodebarcode")
                ->join("jenjang", "jenjangbarcode.kodejenjang = jenjang.KodeJenjang")
                ->join("Purchreqheader", "masterbarcode.PurchReqId = Purchreqheader.RecId")
               ->where("masterbarcode.Cabang = '$cabang'")
               ->orderBy("masterbarcode.RecID")
              ->execute();

        $paginator = new Paginator(array(
            "data" => $mbarcode,
            "limit" => 50
        ));

        $this->view->page = $paginator->getPaginate();

        $this->view->cabang = $cabang;


    }

    public function downloadformAction($kodepr) {
        //$kodepr = $this->request->getPost("Kodepr2");
        //$kodepr = "Kode PR";

        $fileName = $this->excel->downloadFormBarcode($kodepr);
        //$this->response->redirect("scheduleheader/");
    }

    public function uploadbarcodeAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "scheduleheader",
                        "action" => "index"
            ));
        }
            $Cabang = $this->request->getPost("Cabang");
            $PurchReqId = $this->request->getPost("Kodepr");
            $CreatedAt = date("Y-m-d H:i:s");
            $CreatedBy = $this->auth['username'];

            // TOC-RB : Validate File Uploaded
            $fileUpload = $this->request->getUploadedFiles()[0];

//            if ($this->request->hasFiles() == true && $_POST['Program'] != "") {
            if ($fileUpload->getExtension() == "xlsx") {
                try {
                    //$this->flash->notice('qweqwe');
                    $dataExcel = $this->excel->readBarcode($fileUpload, "");

                    foreach ($dataExcel AS $key => $value) {

                        $masterbarcode = new masterbarcode();

                        $masterbarcode->Barcode = $value['Barcode'];
                        $masterbarcode->PurchReqId = $PurchReqId;
                        $masterbarcode->CreatedAt = $CreatedAt;
                        $masterbarcode->CreatedBy = $CreatedBy;
                        $masterbarcode->Cabang = $Cabang;
                        $masterbarcode->TypeUpload = 1;
                        $masterbarcode->Status = 0;

                        if (!$masterbarcode->save()) {
                            $this->flash->error("Import detail excel gagal");
                            return $this->response->redirect("barcode/addbarcode");
                        }
                    }
                } catch (Exception $e) {
                    $this->flash->error("Import data excel gagal");
                    return $this->response->redirect("barcode/addbarcode");
                }
            }

            $this->flash->success("Upload barcode berhasil");
            return $this->forward("barcode/addbarcode");
    }

    Public function reportAction() {

        $sql = "SELECT RecID,KodeAreaCabang,NamaAreaCabang,Sum(qty) JumlahOrder, 
                (select COUNT(masterbarcode.Barcode) from masterbarcode 
                join areacabang ar on masterbarcode.Cabang=ar.RecId
                join barcodeitem bi on SUBSTRING(masterbarcode.barcode,5,2)=bi.jenjang and SUBSTRING(masterbarcode.barcode,7,2) = bi.kurikulum
                join Purchreqheader pr on masterbarcode.PurchReqId = pr.RecId
                where ar.KodeAreaCabang=Odr.KodeAreaCabang and bi.Kurikulum != '13' and pr.ApprovalDate >= '2017-06-01' and bi.Jenjang != '23' or 
                    ar.KodeAreaCabang=Odr.KodeAreaCabang and bi.Jenjang = '23' and bi.Kurikulum = '13' and pr.ApprovalDate >= '2017-06-01'
                ) as JumlahBarcode,
                (select COUNT(masterbarcode.Barcode) from masterbarcode 
                join areacabang ar on masterbarcode.Cabang=ar.RecId
                join barcodeitem bi on SUBSTRING(masterbarcode.barcode,5,2)=bi.jenjang and SUBSTRING(masterbarcode.barcode,7,2) = bi.kurikulum
                where ar.KodeAreaCabang=Odr.KodeAreaCabang and bi.Kurikulum = '13' and bi.Jenjang != '23'
                ) as JumlahBarcode2013 from
                (select d.RecID,d.KodeAreaCabang,d.NamaAreaCabang,a.PurchReqId,b.ItemName,b.qty from purchreqheader a 
                join purchreqline b on a.RecId=b.Purchreqheader 
                join Konfirmasipembayaran c on a.PurchReqId=c.PurchReqId
                join areacabang d on a.Cabang=d.RecID
                join areacabang e on d.Area=e.KodeAreaCabang
                where  c.Status = 'Approved' and c.ApprovalDate >= '2017-06-01' and a.ApprovalDate >= '2017-06-01' and d.KodeAreaCabang != '9999'
                group by d.RecID,d.KodeAreaCabang,d.NamaAreaCabang,a.PurchReqId,b.ItemName,b.qty) as Odr
                group By RecID,KodeAreaCabang,NamaAreaCabang
                Order By JumlahOrder DESC";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);
                
        }

        Public function detailreportAction($Cabang) {

        $sql = "SELECT RecID,KodeAreaCabang,NamaAreaCabang,PurchReqId, Sum(qty) JumlahOrder, 
                (select COUNT(masterbarcode.Barcode) from masterbarcode 
                join areacabang ar on masterbarcode.Cabang=ar.RecId
                join purchreqheader pr on masterbarcode.PurchReqId=pr.RecId
                join barcodeitem bi on SUBSTRING(masterbarcode.barcode,5,2)=bi.jenjang and SUBSTRING(masterbarcode.barcode,7,2) = bi.kurikulum
                where ar.KodeAreaCabang=Odr.KodeAreaCabang and pr.PurchReqId=Odr.PurchReqId and bi.Kurikulum != '13' and bi.Jenjang != '23' or 
                    ar.KodeAreaCabang=Odr.KodeAreaCabang and pr.PurchReqId=Odr.PurchReqId and bi.Jenjang = '23'
                ) as JumlahBarcode from
                (select d.RecID,d.KodeAreaCabang,d.NamaAreaCabang,a.PurchReqId,b.ItemName,b.qty from purchreqheader a 
                join purchreqline b on a.RecId=b.Purchreqheader 
                join Konfirmasipembayaran c on a.PurchReqId=c.PurchReqId
                join areacabang d on a.Cabang=d.RecID
                join areacabang e on d.Area=e.KodeAreaCabang
                where c.Status = 'Approved' and a.ApprovalDate >= '2017-06-01' and c.ApprovalDate >= '2017-06-01' and d.KodeAreaCabang = '$Cabang'
                group by d.RecID,d.KodeAreaCabang,d.NamaAreaCabang,a.PurchReqId,b.ItemName,b.qty) as Odr
                group By RecID,KodeAreaCabang,NamaAreaCabang,PurchReqId
                Order By PurchReqId";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);
        $this->view->KodeCabang = $Cabang;
        $this->view->NamaCabang = areacabang::findFirstByKodeAreaCabang($Cabang);
                
        }

        Public function detailprAction($PR) {

        $sql = "SELECT PurchReqId,KodeItem,NamaItem,
                (select sum(qty) from purchreqline pl 
                join inventitem i on pl.ItemId=i.KodeItem
                join purchreqheader pr on pl.Purchreqheader=pr.RecId
                where i.KodeItem=Odr.KodeItem and pr.PurchReqId = '$PR'
                ) as JumlahOrder,
                (select COUNT(masterbarcode.Barcode) from masterbarcode 
                join purchreqheader pr on masterbarcode.PurchReqId=pr.RecId
                join barcodeitem bi on SUBSTRING(masterbarcode.barcode,5,2)=bi.jenjang and SUBSTRING(masterbarcode.barcode,7,2) = bi.kurikulum
                where pr.PurchReqId=Odr.PurchReqId and bi.Kurikulum != '13' and bi.KodeItem=Odr.KodeItem and bi.Jenjang != '23' or pr.PurchReqId=Odr.PurchReqId and bi.KodeItem=Odr.KodeItem and bi.Jenjang = '23' and bi.Kurikulum = '13'
                ) as JumlahBarcode from
                (select a.PurchReqId,f.KodeItem,f.NamaItem from purchreqheader a 
                join purchreqline b on a.RecId=b.Purchreqheader 
                join masterbarcode on masterbarcode.PurchReqId=a.RecId
                join barcodeitem bi on SUBSTRING(masterbarcode.barcode,5,2)=bi.jenjang and SUBSTRING(masterbarcode.barcode,7,2) = bi.kurikulum
                join Konfirmasipembayaran c on a.PurchReqId=c.PurchReqId
                join inventitem f on b.ItemId=f.KodeItem or bi.KodeItem=f.KodeItem
                where a.PurchReqId = '$PR' and bi.Kurikulum != '13'
                group by a.PurchReqId,f.KodeItem,f.NamaItem) as Odr
                group By PurchReqId,KodeItem,NamaItem
                Order By PurchReqId DESC";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);
        $this->view->KdCabang = substr($PR,7,4);
        $this->view->PR = $PR;

        $sql2 = "SELECT PurchReqId,ItemId,ItemName as NamaItem, Sum(qty) JumlahOrder, 
                    (select COUNT(masterbarcode.Barcode) from masterbarcode 
                    join areacabang ar on masterbarcode.Cabang=ar.RecId
                    join purchreqheader pr on masterbarcode.PurchReqId=pr.RecId
                    join barcodeitem bi on SUBSTRING(masterbarcode.barcode,5,2)=bi.jenjang and SUBSTRING(masterbarcode.barcode,7,2) = bi.kurikulum
                    where pr.PurchReqId=Odr.PurchReqId and bi.Kurikulum != '13' and bi.KodeItem=Odr.ItemId
                    ) as JumlahBarcode from
                    (select a.PurchReqId,b.ItemId,b.ItemName,b.qty from purchreqheader a 
                    join purchreqline b on a.RecId=b.Purchreqheader 
                    join Konfirmasipembayaran c on a.PurchReqId=c.PurchReqId
                    where  a.PurchReqId = '$PR'
                    group by a.PurchReqId,b.ItemId,b.ItemName,b.qty) as Odr
                    group By PurchReqId,ItemId,ItemName
                    Order By PurchReqId DESC";

        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result2 = $query2->fetchAll($query2);
                
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
            echo "<option value=\"" . $rec->RecID . "\">" . $rec->KodeNamaAreaCabang . "</option>";
        }
    }

    public function getkodeprAction($cabang = 0) {
        $this->view->disable();
        $kodepr = Purchreqheader::query()
                ->columns("Purchreqheader.PurchReqId,Purchreqheader.RecID")
                ->join("Areacabang", "Areacabang.RecID = Purchreqheader.Cabang")
                ->where("Areacabang.RecID = :cabang: AND Purchreqheader.Status = 'Approved' AND Purchreqheader.ApprovalDate >= '2017-06-01'")
                ->orderBy("Purchreqheader.PurchReqId")
                ->bind(["cabang" => $this->filter->sanitize($cabang, "int")])
                ->execute();
        echo "<option value=\"\">---</option>";
        if (!count($kodepr)) {
            return;
        }
        foreach ($kodepr as $rec) {

            echo "<option value=\"" . $rec->RecID . "\">" . $rec->PurchReqId . "</option>";
        }
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

    private function getTransaction() {
        $column = ['a.RecId', 'a.KodeAreaCabang + " - " + a.NamaAreaCabang AS NamaCabang'];

        $query = $this->modelsManager->createBuilder()
                ->columns($column)->groupBy($groupBy)
                ->addFrom('areacabang', 'a')
                ->join('areacabang', 'a.Area = b.KodeAreaCabang', 'b')
                ->orderBy('a.KodeAreaCabang');
    
        return $query->getQuery()->execute()->setHydrateMode(Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
    }

}
