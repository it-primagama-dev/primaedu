<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PurchreqheaderController extends ControllerBase {

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Permintaan Pembelian");
        parent::initialize();
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }

    /**
     * Index action
     */
    public function indexAction() {
        ?>

            
            <?php
        $this->persistent->parameters = null;
    }

    
    public function searchAction() {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Purchreqheader", $_POST);
            $query->andWhere("Cabang = :cabang:", ["cabang" => $this->auth['areacabang']]);
            $query->andWhere("PurchReqDate > '2015-12-06'");
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecId";

        $purchreqheader = Purchreqheader::find($parameters);
        if (count($purchreqheader) == 0) {
            $this->flash->notice("Permintaan pembelian tidak dapat ditemukan");
            return $this->forward('purchreqheader/index');
        }

        $paginator = new Paginator(array(
            "data" => $purchreqheader,
            "limit" => 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {

        $cabang = $this->auth['areacabang'];

        $order = Purchreqheader::query()
            ->columns("count(RecId) as TotalOrder")
            ->where("Cabang = '$cabang' and Status = 'Approved' and ApprovalDate >= '2017-06-01'")
            ->execute();
        
        $paginator = new Paginator(array(
            "data" => $order,
            "limit" => 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }


    public function editAction($RecId) {

        if (!$this->request->isPost()) {

            $purchreqheader = Purchreqheader::findFirstByRecId($RecId);
            if (!$purchreqheader) {
                $this->flash->error("Permintaan pembelian tidak dapat ditemukan");
                return $this->forward('purchreqheader/index');
            }

            $this->view->RecId = $purchreqheader->RecId;

            $this->tag->setDefault("RecId", $purchreqheader->RecId);
            $this->tag->setDefault("PurchReqId", $purchreqheader->PurchReqId);
            $this->tag->setDefault("PurchReqName", $purchreqheader->PurchReqName);
            $this->tag->setDefault("Requester", $purchreqheader->Requester);
            $this->tag->setDefault("PurchReqDate", $purchreqheader->PurchReqDate);
            $this->tag->setDefault("Status", $purchreqheader->Status);
            $this->tag->setDefault("Remarks", $purchreqheader->Remarks);
            $this->tag->setDefault("CreatedBy", $purchreqheader->CreatedBy);
            $this->tag->setDefault("CreatedDateTime", $purchreqheader->CreatedDateTime);
            $this->tag->setDefault("dataTableUrl", $this->url->get("purchreqheader/details/{$purchreqheader->RecId}"));
        }
    }

    /**
     * Creates a new purchreqheader
     */
    public function createAction() {
        
       $cabang=$this->auth['areacabang'];

        if (!$this->request->isPost()) {
            return $this->forward('purchreqheader/index');
        }

        $cabang = $this->auth['areacabang'];

        $order = Purchreqheader::query()
            ->columns("count(RecId) as TotalOrder")
            ->where("Cabang = '$cabang' and Status = 'Approved'")
            ->execute();

       /** foreach ($order as $row) {
            $TotalOrder = $row->TotalOrder;
            if ($TotalOrder >= 7){
            $Paket = "Reguler";
        } else {
            $Paket = "-";
        }
        } */

        $cek= $this->modelsManager->createBuilder()
                ->columns("outstanding.KodeCabang")
                ->from("outstanding")
                ->join("Areacabang", "outstanding.KodeCabang = Areacabang.KodeAreaCabang")
                 ->where("Areacabang.RecId = '$cabang' ")
                ->getQuery()
                ->execute();

        if (count($cek) == 0) { 

        $purchreqheader = new Purchreqheader();
     
        $purchreqheader->PurchReqId = $this->getNumberSequence('PR', $this->auth['kodeareacabang']);
        $purchreqheader->PurchReqName = $this->request->getPost("PurchReqName");
        $purchreqheader->Requester = $this->request->getPost("Requester");
        $purchreqheader->PurchReqDate = $this->request->getPost("PurchReqDate") ? : date('Y-m-d H:i:s');
        $purchreqheader->Status = 'Draft';
        $purchreqheader->CreatedBy = $this->auth['username'];
        $purchreqheader->CreatedDateTime = date('Y-m-d H:i:s');
        $purchreqheader->Cabang = $this->auth['areacabang'];
        //$purchreqheader->TipePengiriman = $Paket;

        if (!$purchreqheader->save()) {
            foreach ($purchreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward('purchreqheader/new');
        }

        $this->flash->success("Permintaan pembelian berhasil ditambahkan");
        return $this->response->redirect('purchreqheader/edit/'.$purchreqheader->RecId);
        }else{
            ?>
            <script language="Javascript">
            
            window.alert('Anda masih mempunyai outstanding pembelian buku\nsilahkan hubungin finance@primagama.co.id');
            </script>
            
            <?php
             return $this->forward('purchreqheader/index');
        }
    }

    /**
     * Saves a purchreqheader edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->forward('purchreqheader/index');
        }

        $RecId = $this->request->getPost("RecId");

        $purchreqheader = Purchreqheader::findFirstByRecId($RecId);
        if (!$purchreqheader) {
            $this->flash->error("Permintaan pembelian tidak dapat ditemukan " . $RecId);
            return $this->forward('purchreqheader/index');
        }

        if ($purchreqheader->Status != "Draft" && $purchreqheader->Status != "Rejected") {
            $this->flash->error("Permintaan Pembelian Tidak Dapat Diubah");
            return $this->forward("purchreqheader/index");
        }

        $purchreqheader->PurchReqId = $this->request->getPost("PurchReqId");
        $purchreqheader->PurchReqName = $this->request->getPost("PurchReqName");
        $purchreqheader->Requester = $this->request->getPost("Requester");
        $purchreqheader->PurchReqDate = $this->request->getPost("PurchReqDate");
        // TOC-RB
        //$purchreqheader->Status = $this->request->getPost("Status");

        if (!$purchreqheader->save()) {

            foreach ($purchreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "purchreqheader",
                        "action" => "edit",
                        "params" => array($purchreqheader->RecId)
            ));
        }

        $this->flash->success("Permintaan pembelian berhasil diubah");
        return $this->response->redirect('purchreqheader/invoicetemp/'.$purchreqheader->RecId);
    }

    /**
     * Deletes a purchreqheader
     *
     * @param string $RecId
     */
    public function deleteAction($RecId) {

        $purchreqheader = Purchreqheader::findFirstByRecId($RecId);
        if (!$purchreqheader) {
            $this->flash->error("Permintaan pembelian tidak dapat ditemukan");
            return $this->forward('purchreqheader/index');
        }

        if (!$purchreqheader->delete()) {

            foreach ($purchreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward('purchreqheader/search');
        }

        $this->flash->success("Permintaan pembelian berhasil dihapus");
        return $this->forward('purchreqheader/search');
    }
    
    /*
      TOC-RB : Added Submit Action (change status to inreview)
     */

    public function submitAction($RecId) {
        if (!$this->request->isPost()) {
            $purchreqheader = Purchreqheader::findFirstByRecId($RecId);
            if (!$purchreqheader) {
                $this->flash->error("Permintaan pembelian tidak dapat ditemukan");
                return $this->forward('purchreqheader/index');
            }
            $purchreqheader->status = "Inreview";
             $purchreqheader->PurchReqDate = date('Y-m-d H:i:s');

        $phql = "UPDATE purchreqheader SET Status = '{$purchreqheader->status}',PurchReqDate='{$purchreqheader->PurchReqDate}' WHERE RecId = {$RecId}";

            $ret = $this->db->query($phql);

//          if (!$usergroup->save()) {
            if (!$ret) {
                foreach ($purchreqheader->getMessages() as $message) {
                    $this->flash->error($message);
                }

                return $this->forward('purchreqheader/index');
            }
            $this->flash->success("Permintaan pembelian berhasil diubah");

            return $this->response->redirect("purchreqheader/search");
        }
    }

    public function detailsAction($id) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $details = array();

        $purchreqline = Purchreqline::findByPurchreqheader($id);

        if (!count($purchreqline)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($purchreqline as $detail) {
                $details [] = array(
                    'id' => $detail->RecId,
                    'ItemId' => $detail->ItemId,
                    'ItemName' => $detail->ItemName,
                    'Qty' => $detail->Qty
                );
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'deleteUrl' => $this->url->get("purchreqline/delete"),
                'listData' => $details
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

    public function viewdetailAction($RecID) {
        $query = new Criteria();
        $query->setModelName('Purchreqheader')
            ->andWhere("Cabang = :cabang:", ["cabang" => $this->auth['areacabang']])
            ->andWhere("RecId = :recid:", ["recid" => $this->filter->sanitize($RecID, "int")]);

        $pr = Purchreqheader::findFirst($query->getParams());

        if ($pr === FALSE) {
            $this->flash->error('Detil pembelian tidak dapat ditemukan');
            return $this->forward('purchreqheader/index');
        }

        $this->view->pr = $pr;
    }
    
     public function invoiceAction($RecID) {
        $query = new Criteria();
        $query->setModelName('Purchreqheader')
            ->andWhere("Cabang = :cabang:", ["cabang" => $this->auth['areacabang']])
            ->andWhere("RecId = :recid:", ["recid" => $this->filter->sanitize($RecID, "int")]);

        $pr = Purchreqheader::findFirst($query->getParams());
        $sql2="select  TOP 1 * from Purchreqheader where Cabang='$pr->Cabang' and PurchReqId!='$pr->PurchReqId' AND PurchReqDate < '$pr->PurchReqDate' order by PurchReqDate DESC";
        $q = $this->getDI()->getShared('db')->query($sql2);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $q->fetchAll($q);

        if ($pr === FALSE) {
            $this->flash->error('Detil pembelian tidak dapat ditemukan');
            return $this->forward('purchreqheader/index');
        }
         $this->view->pr = $pr;
        
    }

     public function invoicetempAction($RecID) {

        $cabang = $this->auth['areacabang'];

        $order = Purchreqheader::query()
            ->columns("count(RecId) as TotalOrder")
            ->where("Cabang = '$cabang' and Status = 'Approved'")
            ->execute();

        $this->view->jumlahorder = $order;

        $query = new Criteria();
        $query->setModelName('Purchreqheader')
            ->andWhere("Cabang = :cabang:", ["cabang" => $this->auth['areacabang']])
            ->andWhere("RecId = :recid:", ["recid" => $this->filter->sanitize($RecID, "int")]);

        $pr = Purchreqheader::findFirst($query->getParams());
        $sql2="select  TOP 1 * from Purchreqheader where Cabang='$pr->Cabang' and PurchReqId!='$pr->PurchReqId' AND PurchReqDate < '$pr->PurchReqDate' order by PurchReqDate DESC";
        $q = $this->getDI()->getShared('db')->query($sql2);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $q->fetchAll($q);

        if ($pr === FALSE) {
            $this->flash->error('Detil pembelian tidak dapat ditemukan');
            return $this->forward('purchreqheader/index');
        }
         $this->view->pr = $pr;
        
    }

    public function updatepengirimanAction() {

        if (!$this->request->isPost()) {
            return $this->forward('purchreqheader/index');
        }

        $Purchreqheader = $this->request->getPost("Purchreqheader");
        $cabang = $this->auth['areacabang'];
        $pengiriman = $this->request->getPost("Pengiriman");

        $sql = "UPDATE purchreqline set price = hbo.HargaOngkir+hbo.HargaBuku 
                    From purchreqline As pl
                    join hargabukuongkir As hbo ON pl.ItemId = hbo.KodeBuku
                    join purchreqheader As ph ON hbo.Cabang = ph.Cabang
                    where ph.Cabang = '$cabang' and hbo.TipePengiriman = '$pengiriman' 
                    and pl.Purchreqheader = '$Purchreqheader'";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $sql = "UPDATE purchreqheader set TipePengiriman = '$pengiriman'
                    where RecId = '$Purchreqheader'";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->flash->success("Paket pengiriman telah diubah ke Paket $pengiriman");
        return $this->response->redirect('purchreqheader/invoicetemp/'.$Purchreqheader);
    }

    public function searchorderAction() {

        $Purchreqheader = $this->request->getPost("Purchreqheader");
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Purchreqheader", $_POST);
            $query->andWhere("Cabang = :cabang:", ["cabang" => $this->auth['areacabang']]);
            $query->andWhere("PurchReqDate > '2015-12-06'");
            $query->andWhere("RecId = '$Purchreqheader'");
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecId";

        $purchreqheader = Purchreqheader::find($parameters);
        if (count($purchreqheader) == 0) {
            $this->flash->notice("Permintaan pembelian tidak dapat ditemukan");
            return $this->forward('purchreqheader/index');
        }

        $paginator = new Paginator(array(
            "data" => $purchreqheader,
            "limit" => 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }
}
