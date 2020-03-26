<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class DeliveryreqlessController extends ControllerBase {

    /** 
     * Index action
     */
     
     public function initialize() {
       
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Packing Slip susulan';
    }
     
     
    public function indexAction() { 
    //    $this->persistent->parameters = null;
        
        $numberPage = 1;
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }
        $this->db->begin();
        $sql_0 = "UPDATE deliveryreqline set QtyRemaining=0 where QtyRemaining is NULL";
        $this->db->execute($sql_0);
        $this->view->InventItem = inventitem::find(["StatusItem = 1", "order" => "KodeJenjang"]);

  //      $cabang = $this->session->has('auth') ? $this->session->get('auth')['areacabang'] : '';

        $where = "Deliveryreqheader.Status = 'Approved' Order by Deliveryreqheader.RecId DESC";

        $deliveryreqheader = $this->modelsManager->createBuilder()
                 ->columns(array('deliveryreqheader.RecId,deliveryreqheader.PurchReqId,deliveryreqheader.CreatedDateTime,
                deliveryreqheader.Status,deliveryreqheader.Cabang, a.NamaAreaCabang as area, c.KodeAreaCabang as kodecabang,                    
                c.NamaAreaCabang as namacabang'))
                ->from('deliveryreqheader')
                ->join("deliveryreqline","deliveryreqheader.RecId=deliveryreqline.Deliveryreqheader")
                ->join("Areacabang", "deliveryreqheader.Cabang = c.RecID", "c")
                ->join("Areacabang", "c.Area = a.KodeAreaCabang", "a")
                ->leftjoin("deliveryreqheader", "deliveryreqheader.RecId=d.Purchreqheader", "d")    
                ->where("deliveryreqline.qty-deliveryreqline.qtyremaining >0   
                        or deliveryreqline.qty-deliveryreqline.qtyse1 > 0 and deliveryreqline.ItemId != 'PB 12 SMK ' and deliveryreqline.ItemId not like '%PIKSUN%'  and deliveryreqline.ItemId not like '%PIKSE%'  and deliveryreqline.ItemId not like '%PIKSTAN%' 
                        or deliveryreqline.qty-deliveryreqline.qtyse2 > 0 and deliveryreqline.ItemId != 'PB 12 SMK ' and deliveryreqline.ItemId not like '%SMP KURNAS%' and deliveryreqline.ItemId not like '%PIKSUN%'  and deliveryreqline.ItemId not like '%PIKSE%'  and deliveryreqline.ItemId not like '%PIKSTAN%'")
                ->groupby(array("deliveryreqheader.recid,deliveryreqheader.PurchReqId,deliveryreqheader.approvaldate,
                deliveryreqheader.Status,deliveryreqheader.Cabang, a.NamaAreaCabang,c.KodeAreaCabang,deliveryreqheader.RecId,
                c.NamaAreaCabang,deliveryreqheader.Status,deliveryreqheader.CreatedDateTime"))
                ->getQuery()
                ->execute();

        if (count($deliveryreqheader) == 0) { 
        }

        $paginator = new Paginator(array(
                    "data" => $deliveryreqheader,
                    "limit" => 50,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();

        $this->view->setVar("session",$this->session->get('auth'));
    }

    public function cariAction() { 
    //    $this->persistent->parameters = null;
        
        $numberPage = 1;
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }
        $this->db->begin();
        $sql_0 = "update deliveryreqline set QtyRemaining=0 where QtyRemaining is NULL";
        $this->db->execute($sql_0);
        $this->view->InventItem = inventitem::find(["StatusItem = 1", "order" => "KodeJenjang"]);

  //      $cabang = $this->session->has('auth') ? $this->session->get('auth')['areacabang'] : '';

        $kode = $this->request->getPost("KodeCabang");
        $buku = $this->request->getPost("InventItem");

        if($kode != '' && $buku == ''){
        $where = "deliveryreqline.qty-deliveryreqline.qtyremaining >0 and deliveryreqheader.PurchReqId like '%$kode%' 
                    or deliveryreqline.qty-deliveryreqline.QtySE1 >0 and deliveryreqheader.PurchReqId like '%$kode%' and deliveryreqline.ItemId != 'PB 12 SMK ' and deliveryreqline.ItemId not like '%PIKSUN%'  and deliveryreqline.ItemId not like '%PIKSE%'  and deliveryreqline.ItemId not like '%PIKSTAN%' 
                    or deliveryreqline.qty-deliveryreqline.QtySE2 >0 and deliveryreqheader.PurchReqId like '%$kode%' and deliveryreqline.ItemId != 'PB 12 SMK ' and deliveryreqline.ItemId not like '%SMP KURNAS%' and deliveryreqline.ItemId not like '%PIKSUN%'  and deliveryreqline.ItemId not like '%PIKSE%'  and deliveryreqline.ItemId not like '%PIKSTAN%' ";   
        } 
        else if ($kode == '' && $buku != '') {
        $where = "deliveryreqline.qty-deliveryreqline.qtyremaining >0 and deliveryreqline.ItemId like '%$buku%' 
                    or deliveryreqline.qty-deliveryreqline.QtySE1 >0 and deliveryreqline.ItemId like '%$buku%' and deliveryreqline.ItemId != 'PB 12 SMK 'and deliveryreqline.ItemId not like '%PIKSUN%'  and deliveryreqline.ItemId not like '%PIKSE%'  and deliveryreqline.ItemId not like '%PIKSTAN%' 
                    or deliveryreqline.qty-deliveryreqline.QtySE2 >0 and deliveryreqline.ItemId like '%$buku%' and deliveryreqline.ItemId != 'PB 12 SMK ' and deliveryreqline.ItemId not like '%SMP KURNAS%'and deliveryreqline.ItemId not like '%PIKSUN%'  and deliveryreqline.ItemId not like '%PIKSE%' and deliveryreqline.ItemId not like '%PIKSTAN%' ";
        } 
        else if ($kode != '' && $buku != '') {
        $where = "deliveryreqline.qty-deliveryreqline.qtyremaining >0 and deliveryreqline.ItemId like '%$buku%' and deliveryreqheader.PurchReqId like '%$kode%' 
                    or deliveryreqline.qty-deliveryreqline.QtySE1 >0 and deliveryreqline.ItemId like '%$buku%' and deliveryreqheader.PurchReqId like '%$kode%' and deliveryreqline.ItemId != 'PB 12 SMK ' and deliveryreqline.ItemId not like '%PIKSUN%' and deliveryreqline.ItemId not like '%PIKSE%' and deliveryreqline.ItemId not like '%PIKSTAN%' 
                    or deliveryreqline.qty-deliveryreqline.QtySE2 >0 and deliveryreqline.ItemId like '%$buku%' and deliveryreqheader.PurchReqId like '%$kode%' and deliveryreqline.ItemId != 'PB 12 SMK ' and deliveryreqline.ItemId not like '%SMP KURNAS%' and deliveryreqline.ItemId not like '%PIKSUN%'  and deliveryreqline.ItemId not like '%PIKSE%' and deliveryreqline.ItemId not like '%PIKSTAN%' ";
        } else {
        $where = "deliveryreqline.qty-deliveryreqline.qtyremaining >0 
                    or deliveryreqline.qty-deliveryreqline.QtySE1 >0 and deliveryreqline.ItemId != 'PB 12 SMK '
                    or deliveryreqline.qty-deliveryreqline.QtySE2 >0 and deliveryreqline.ItemId != 'PB 12 SMK ' and deliveryreqline.ItemId not like '%SMP KURNAS%' and deliveryreqline.ItemId not like '%PIKSUN%'  and deliveryreqline.ItemId not like '%PIKSE%' and deliveryreqline.ItemId not like '%PIKSTAN%' ";
        }

        $deliveryreqheader = $this->modelsManager->createBuilder()
                 ->columns(array('deliveryreqheader.RecId,deliveryreqheader.PurchReqId,deliveryreqheader.CreatedDateTime,
                deliveryreqheader.Status,deliveryreqheader.Cabang, a.NamaAreaCabang as area, c.KodeAreaCabang as kodecabang,                    
                c.NamaAreaCabang as namacabang'))
                ->from('deliveryreqheader')
                ->join("deliveryreqline","deliveryreqheader.RecId=deliveryreqline.Deliveryreqheader")
                ->join("Areacabang", "deliveryreqheader.Cabang = c.RecID", "c")
                ->join("Areacabang", "c.Area = a.KodeAreaCabang", "a")
                ->leftjoin("deliveryreqheader", "deliveryreqheader.RecId=d.Purchreqheader", "d")    
                ->where("$where")
                ->groupby(array("deliveryreqheader.recid,deliveryreqheader.PurchReqId,deliveryreqheader.approvaldate,
                deliveryreqheader.Status,deliveryreqheader.Cabang, a.NamaAreaCabang,c.KodeAreaCabang,deliveryreqheader.RecId,
                c.NamaAreaCabang,deliveryreqheader.Status,deliveryreqheader.CreatedDateTime"))
                ->getQuery()
                ->execute();

        if (count($deliveryreqheader) == 0) { 
        }

        $paginator = new Paginator(array(
                    "data" => $deliveryreqheader,
                    "limit" => 50,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();

        $this->view->setVar("session",$this->session->get('auth'));
    }

   public function invalidAction() { 
    //    $this->persistent->parameters = null;
        
        $numberPage = 1;
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }

        $deliveryreqheader = $this->modelsManager->createBuilder()
                 ->columns(array('deliveryreqheader.RecId,deliveryreqheader.PurchReqId,deliveryreqheader.CreatedDateTime,
                deliveryreqheader.Status,deliveryreqheader.Cabang, a.NamaAreaCabang as area, c.KodeAreaCabang as kodecabang,                    
                c.NamaAreaCabang as namacabang'))
                ->from('deliveryreqheader')
                ->join("deliveryreqline","deliveryreqheader.RecId=deliveryreqline.Deliveryreqheader")
                ->join("Areacabang", "deliveryreqheader.Cabang = c.RecID", "c")
                ->join("Areacabang", "c.Area = a.KodeAreaCabang", "a")
                ->leftjoin("deliveryreqheader", "deliveryreqheader.RecId=d.Purchreqheader", "d")    
                ->where("deliveryreqline.qty-deliveryreqline.qtyremaining < 0 or deliveryreqline.qty-deliveryreqline.QtySE1 < 0 or deliveryreqline.qty-deliveryreqline.QtySE2 < 0")
                ->groupby(array("deliveryreqheader.recid,deliveryreqheader.PurchReqId,deliveryreqheader.approvaldate,
                deliveryreqheader.Status,deliveryreqheader.Cabang, a.NamaAreaCabang,c.KodeAreaCabang,deliveryreqheader.RecId,
                c.NamaAreaCabang,deliveryreqheader.Status,deliveryreqheader.CreatedDateTime"))
                ->getQuery()
                ->execute();

        if (count($deliveryreqheader) == 0) { 
        }

        $paginator = new Paginator(array(
                    "data" => $deliveryreqheader,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();

        $this->view->setVar("session",$this->session->get('auth'));
    }

    /**
     * Searches for purchreqheader
     */
    public function searchAction() {

        $numberPage = 1;
        $deliveryreqheader = Deliveryreqheader::find("Status = 'Inreview'");
        if (count($deliveryreqheader) == 0) {
            $this->flash->notice("The search did not find any item");

            return $this->dispatcher->forward(array(
                        "controller" => "deliveryreqapproval",
                        "action" => "index"
                    ));
        }else{
            $numberPage = $this->request->getQuery("page", "int");
        }

        $paginator = new Paginator(array(
                    "data" => $deliveryreqheader,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        
    }

    /**
     * Edits a purchreqheader
     *
     * @param string $RecId
     */
    public function editAction($RecId="") {

        if (!$this->request->isPost()) {
    
            $numberPage = $this->request->getQuery("page", "int");
            $numberPage = isset($numberPage) ? $numberPage : 1;

            if($this->request->getQuery("recid") != null) $RecId = $this->request->getQuery("recid");

            $deliveryreqline = Deliveryreqline::query()
                                    ->where("Deliveryreqheader = '$RecId' and QtyRemaining <> Qty")
                                    ->execute();

            if (!$deliveryreqline) {
                $this->flash->error("Item was not found");

                return $this->dispatcher->forward(array(
                            "controller" => "deliveryreqapproval",
                            "action" => "index"
                        ));
            }

            $paginator = new Paginator(array(
                    "data" => $deliveryreqline,
                    "limit" => 10,
                    "page" => $numberPage
                ));

            $this->view->deliveryreqlineRecId = $RecId;

            $this->view->page = $paginator->getPaginate();

            $this->view->setVar("session",$this->session->get('auth'));
        }
    }
    
        public function qtyAction($RecId) {

        if (!$this->request->isPost()) {
    
            $numberPage = $this->request->getQuery("page", "int");
            $numberPage = isset($numberPage) ? $numberPage : 1;

           
            $where1 = "Deliveryreqheader = '$RecId' and QtyRemaining <> Qty or
                        Deliveryreqheader = '$RecId' and ItemId != 'PB 12 SMK ' and ItemName not like '%PIKSUN%'  and ItemName not like '%PIKSE%'  and ItemName not like '%PIKSTAN%' and QtySE1 <> Qty or
                        Deliveryreqheader = '$RecId' and ItemId != 'PB 12 SMK ' and ItemName not like '%PIKSUN%'  and ItemName not like '%PIKSE%'  and ItemName not like '%PIKSTAN%' 
                        and ItemId not like '%SMP KURNAS%' and QtySE2 <> Qty";
            //$where2 = "Deliveryreqheader = '$RecId' and ItemId = 'PB 12 SMK ' and QtyRemaining <> Qty";
            $deliveryreqline = Deliveryreqline::query()
                                    ->join('InventItem','Deliveryreqline.ItemId=InventItem.KodeItem')
                                    ->where("$where1")
                                    ->OrderBy('InventItem.TipeInvent')
                                    ->execute();


            $this->tag->setDefault("PurchReqId", $deliveryreqline->PurchReqId);
            $this->tag->setDefault("Cabang", $deliveryreqline->Cabang);
            $this->tag->setDefault("Purchreqheader", $deliveryreqline->RecId);


            if (!$deliveryreqline) {
                $this->flash->error("Item was not found");

               
               return $this->response->redirect('deliveryreqless');

            }

            $paginator = new Paginator(array(
                    "data" => $deliveryreqline,
                    "limit" => 1000,
                    "page" => $numberPage
                ));

            $this->view->deliveryreqlineRecId = $RecId;

            $this->view->page = $paginator->getPaginate();

            $this->view->setVar("session",$this->session->get('auth'));
        }
    }

        public function qtyinvalidAction($RecId) {

        if (!$this->request->isPost()) {
    
            $numberPage = $this->request->getQuery("page", "int");
            $numberPage = isset($numberPage) ? $numberPage : 1;

           
            $where1 = "Deliveryreqheader = '$RecId' and QtyRemaining <> Qty or
                        Deliveryreqheader = '$RecId' and ItemId != 'PB 12 SMK ' and QtySE1 <> Qty or
                        Deliveryreqheader = '$RecId' and ItemId != 'PB 12 SMK ' 
                        and ItemId not like '%SMP KURNAS%' and QtySE2 <> Qty";
            //$where2 = "Deliveryreqheader = '$RecId' and ItemId = 'PB 12 SMK ' and QtyRemaining <> Qty";
            $deliveryreqline = Deliveryreqline::query()
                                    ->where("$where1")
                                    ->execute();


            $this->tag->setDefault("PurchReqId", $deliveryreqline->PurchReqId);
            $this->tag->setDefault("Cabang", $deliveryreqline->Cabang);
            $this->tag->setDefault("Purchreqheader", $deliveryreqline->RecId);


            if (!$deliveryreqline) {
                $this->flash->error("Item was not found");

               
               return $this->response->redirect('deliveryreqless');

            }

            $paginator = new Paginator(array(
                    "data" => $deliveryreqline,
                    "limit" => 1000,
                    "page" => $numberPage
                ));

            $this->view->deliveryreqlineRecId = $RecId;

            $this->view->page = $paginator->getPaginate();

            $this->view->setVar("session",$this->session->get('auth'));
        }
    }



     public function editQtyAction(){
          $reqid =$this->request->getPost('PurchReqId');
            $this->db->begin();
                    
            foreach($_POST['qtyupdate'] as $i => $qtyup)
            //foreach($_POST['qtyupdatese1'] as $i => $qtyupse1)
            //foreach($_POST['qtyupdatese2'] as $i => $qtyupse2)
            {
            $Purchreqline = $_POST['Purchreqline'][$i];
            $ItemId = $_POST['ItemId'][$i];
            $qty = $_POST['qty'][$i];
            $ItemName = $_POST['ItemName'][$i];
            $Deliveryreqheaderid = $_POST['Deliveryreqheaderid'][$i];
            $qtyupse1 = $_POST['qtyupdatese1'][$i];
            $qtyupse2 = $_POST['qtyupdatese2'][$i];
            
            
            
                         $sql_1 = "UPDATE deliveryreqline
                                       SET QtyRemaining = (SELECT QtyRemaining+'$qtyup'
                                                          FROM deliveryreqline
                                                          WHERE RecId='$Purchreqline'),
                                        QtySE1 = (SELECT QtySE1+'$qtyupse1'
                                                          FROM deliveryreqline
                                                          WHERE RecId='$Purchreqline'),
                                        QtySE2 = (SELECT QtySE2+'$qtyupse2'
                                                          FROM deliveryreqline
                                                          WHERE RecId='$Purchreqline')
                                       WHERE RecId='$Purchreqline'";
                        $this->db->execute($sql_1);            
                 }
                        $this->db->commit();
                        $this->flash->success("Detil pengiriman berhasil");

                return $this->dispatcher->forward(array(
                            "controller" => "deliveryreqless",
                            "action" => "index"
                        ));
    
     }

    public function detailAction($RecId="") {

        if (!$this->request->isPost()) {
    
            $numberPage = $this->request->getQuery("page", "int");
            $numberPage = isset($numberPage) ? $numberPage : 1;

            if($this->request->getQuery("recid") != null) $RecId = $this->request->getQuery("recid");

            $deliveryreqline = Deliveryreqline::query()
                                    ->where("Deliveryreqheader = '$RecId'")
                                    ->execute();

            if (!$deliveryreqline) {
                $this->flash->error("Item was not found");

                return $this->dispatcher->forward(array(
                            "controller" => "deliveryreqless",
                            "action" => "index"
                        ));
            }

            $paginator = new Paginator(array(
                    "data" => $deliveryreqline,
                    "limit" => 10,
                    "page" => $numberPage
                ));

            $this->view->deliveryreqlineRecId = $RecId;

            $this->view->page = $paginator->getPaginate();

            $this->view->setVar("session",$this->session->get('auth'));
        }
    }


     public function kirimAction($RecID) {
            $deliveryreqheader = Deliveryreqheader::findFirstByRecId($RecID);
            $this->view->RecId = $deliveryreqheader->RecId;
            
            $this->tag->setDefault("devId", $deliveryreqheader->RecId);
            $this->tag->setDefault("PurchReqId", $deliveryreqheader->PurchReqId);
            $this->tag->setDefault("Cabang", $deliveryreqheader->Cabang);
            $this->tag->setDefault("Purchreqheader", $deliveryreqheader->Purchreqheader);
    }
        /**
     * Creates a new purchreqheader
     */
    public function createdevAction() {

        if (!$this->request->isPost()) {
            return $this->forward('purchreqheader/index');
        }

        $deliveryreqheader = new Deliveryreqheader();

        $prcabangnum = sprintf("%02d", $deliveryreqheader->totalRecord() + 1);
        $deliveryreqheader->PurchReqId = $this->request->getPost("PurchReqId");
        $deliveryreqheader->DeliveryReqId = 'DO' . date('Y').''.date('m') . '-' . substr($this->request->getPost("PurchReqId"),8,4) . '-' . $prcabangnum;
        $deliveryreqheader->ResiId = $this->request->getPost("ResiId");
        $deliveryreqheader->Koli = $this->request->getPost("Koli");
        $deliveryreqheader->EstimasiDate = $this->request->getPost("EstimasiDate");
        $deliveryreqheader->Purchreqheader = $this->request->getPost("Purchreqheader");
        $deliveryreqheader->DeliveryReqDate = $this->request->getPost("DeliveryReqDate") ? : date('Y-m-d');
        $deliveryreqheader->Status = 'Inreview';
        $deliveryreqheader->CreatedBy = $this->auth['username'];
        $deliveryreqheader->CreatedDateTime = date('Y-m-d H:i:s');
        $deliveryreqheader->Cabang = $this->request->getPost("Cabang");

        if (!$deliveryreqheader->save()) {
            foreach ($deliveryreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward('deliveryreqless/index');
        }




        $this->flash->success("Permintaan pembelian berhasil ditambahkan");
        return $this->response->redirect('deliveryreqless/qty/'.$this->request->getPost("devId"));
    }

    /**
     * Saves a purchreqheader edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "deliveryreqless",
                        "action" => "index"
                    ));
        }

        $RecId = $this->request->getPost("RecId");

        $deliveryreqheader = Deliveryreqheader::findFirstByRecId($RecId);
        if (!$deliveryreqheader) {
            $this->flash->error("Item does not exist ");

            return $this->dispatcher->forward(array(
                        "controller" => "deliveryreqless",
                        "action" => "index"
                    ));
        }

        $deliveryreqheader->Cabang = $this->request->getPost("Cabang");
        $deliveryreqheader->PurchReqId = $this->request->getPost("PurchReqId");
        $deliveryreqheader->ResiId = $this->request->getPost("ResiId");
        $deliveryreqheader->Koli = $this->request->getPost("Koli");
        $deliveryreqheader->DeliveryReqDate = $this->request->getPost("DeliveryReqDate");
        $deliveryreqheader->EstimasiDate = $this->request->getPost("EstimasiDate"); 
        $deliveryreqheader->Status = $this->request->getPost("Status");

        if (!$deliveryreqheader->save()) {

            foreach ($deliveryreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }
            
        //  $phql  = "SELECT * FROM Deliveryreqheader where PurchReqId='{$deliveryreqheader->PurchReqId}' ORDER BY RecId ASC";
        //  $query = $manager->createQuery($phql);

            return $this->dispatcher->forward(array(
                        "controller" => "deliveryreqless",
                        "action" => "qty",
                        "params" => array($deliveryreqheader->RecId)
                    ));
        }

        $this->flash->success("Item was updated successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "deliveryreqless",
                    "action" => "index"
                ));
    }

    /**
     * Deletes a purchreqheader
     *
     * @param string $RecId
     */
    public function deleteAction($RecId) {

        $deliveryreqheader = Deliveryreqheader::findFirstByRecId($RecId);
        if (!$deliveryreqheader) {
            $this->flash->error("Item was not found");

            return $this->dispatcher->forward(array(
                        "controller" => "deliveryreqless",
                        "action" => "index"
                    ));
        }

        if (!$deliveryreqheader->delete()) {

            foreach ($deliveryreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "deliveryreqless",
                        "action" => "search"
                    ));
        }

        $this->flash->success("Item was deleted successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "deliveryreqless",
                    "action" => "search"
                ));
    }

    public function detailsAction($id) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $details = array();

        $deliveryreqline = Deliveryreqline::findByDeliveryreqheader($id);

        if (!count($deliveryreqline)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($deliveryreqline as $detail) {
                $details [] = array(
                    'id' => $detail->RecId,
                    'ItemId' => $detail->ItemId,
                    'ItemName' => $detail->ItemName,
                    'Qty' => $detail->Qty
                );
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'deleteUrl' => $this->url->get("deliveryreqline/delete"),
                'listData' => $details
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }
    
    
    
    public function susulanAction()
    {
        
 $area = $this->request->getPost('Area');
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));
        $purchreqid = $this->_validateCabang($this->request->getPost('reqid'));
    

        $sql = "SELECT rtrim(ltrim(SUBSTRING(ItemID,5,4)))as jenjang,RIGHT(ItemName,5)as tahun,NamaAlias as ItemID,(Qty-QtyRemaining) as Qty,(Qty-QtySE1) as QtySE1,(Qty-QtySE2) as QtySE2 from deliveryreqline join deliveryreqheader
 on(deliveryreqline.Deliveryreqheader=deliveryreqheader.RecId)
            join aliasitem on deliveryreqline.ItemId = aliasitem.KodeItem
                     WHERE deliveryreqheader.PurchReqId='$purchreqid' AND Qty-QtySE1 != 0 and deliveryreqline.ItemId != 'PB 12 SMK ' and ItemName not like '%PIKSUN%'  and ItemName not like '%PIKSE%'  and ItemName not like '%PIKSTAN%'
                     OR deliveryreqheader.PurchReqId='$purchreqid' AND Qty-QtySE2 != 0 and deliveryreqline.ItemId != 'PB 12 SMK ' and deliveryreqline.ItemId not like '%SMP KURNAS%' and ItemName not like '%PIKSUN%'  and ItemName not like '%PIKSE%'  and ItemName not like '%PIKSTAN%'
                     OR deliveryreqheader.PurchReqId='$purchreqid' AND Qty-QtyRemaining != 0
                     Order By aliasitem.RecId";

        $sql2 = "SELECT rtrim(ltrim(SUBSTRING(ItemID,5,4)))as jenjang,RIGHT(ItemName,5)as tahun,NamaAlias as ItemID,Qty from purchreqline join purchreqheader on(purchreqline.Purchreqheader=purchreqheader.RecId)
            join aliasitem on purchreqline.ItemId = aliasitem.KodeItem
                     WHERE purchreqheader.cabang=' $cabangid' AND purchreqheader.PurchReqId='$purchreqid'
                     Order By aliasitem.RecId";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        
          $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
      
        $this->view->result = $query->fetchAll($query);
        $this->view->rpt_area = $area;
        $this->view->reqid = $purchreqid;
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeAreaCabang : 'All';
        $this->view->rpt_namacabang = $cabangid ? $cabang->NamaAreaCabang : 'All';
        $this->view->rpt_alamat = $cabangid ? $cabang->Alamat : 'All';
        $this->view->rpt_hp = $cabangid ? $cabang->NoHandPhone : 'All';
            
        
        

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
