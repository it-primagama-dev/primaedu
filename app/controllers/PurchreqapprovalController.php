<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PurchreqapprovalController extends ControllerBase {

    /** 
     * Index action
     */
    public function indexAction() { 
    //    $this->persistent->parameters = null;

        $numberPage = 1;
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }

        $cabang = $this->session->has('auth') ? $this->session->get('auth')['areacabang'] : '';


        $purchreqheader = $this->modelsManager->createBuilder()
                ->columns(array("Purchreqheader.RecId as RecIdd,PurchReqId,PurchReqName,Requester,PurchReqDate,Status,Cabang,
                sum(d.price*d.Qty) as harga"))
                ->from("Purchreqheader")
                ->join("Areacabang", "Purchreqheader.Cabang = c.RecID", "c")
                ->join("Areacabang", "c.Area = a.KodeAreaCabang", "a")
                ->join("Purchreqline", "Purchreqheader.RecId = d.Purchreqheader","d")
                ->where("Purchreqheader.Status = :status: AND a.RecID = :area:")
                ->groupby("Purchreqheader.RecId,PurchReqId,PurchReqName,Requester,PurchReqDate,Status,Cabang")
                ->getQuery()
                ->execute(["status" => "Inreview", "area" => $cabang]);

        if (count($purchreqheader) == 0) { 
        }

        $paginator = new Paginator(array(
                    "data" => $purchreqheader,
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
        $purchreqheader = Purchreqheader::find("Status = 'Inreview' AND Cabang = '".$this->session->auth['areacabang']."'");
        if (count($purchreqheader) == 0) {
            $this->flash->notice("The search did not find any item");

            return $this->dispatcher->forward(array(
                        "controller" => "purchreqapproval",
                        "action" => "index"
                    ));
        }else{
            $numberPage = $this->request->getQuery("page", "int");
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

            $purchreqline = Purchreqline::query()
                                    ->where("Purchreqheader = '$RecId'")
                                    ->execute();

            if (!$purchreqline) {
                $this->flash->error("Item was not found");

                return $this->dispatcher->forward(array(
                            "controller" => "purchreqapproval",
                            "action" => "index"
                        ));
            }

            $paginator = new Paginator(array(
                    "data" => $purchreqline,
                    "limit" => 10,
                    "page" => $numberPage
                ));

            $this->view->purchreqlineRecId = $RecId;

            $this->view->page = $paginator->getPaginate();

            $this->view->setVar("session",$this->session->get('auth'));
        }
    }

    /**
     * Creates a new purchreqheader
     */
    public function createAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "purchreqapproval",
                        "action" => "index"
                    ));
        }

        $purchreqheader = new Purchreqheader();

        $purchreqheader->PurchReqId = $this->request->getPost("PurchReqId");
        $purchreqheader->PurchReqName = $this->request->getPost("PurchReqName");
        $purchreqheader->Requester = $this->request->getPost("Requester");
        $purchreqheader->PurchReqDate = $this->request->getPost("PurchReqDate");
        $purchreqheader->Status = 'Draft';
        $purchreqheader->CreatedBy = $this->session->auth['username'];
        $purchreqheader->CreatedDateTime = date('Y-m-d H:i:s');

        if (!$purchreqheader->save()) {
            foreach ($purchreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "purchreqapproval",
                        "action" => "new"
                    ));
        }

        $this->flash->success("Item was created successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "purchreqapproval",
                    "action" => "index"
                ));
    }

    /**
     * Saves a purchreqheader edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "purchreqapproval",
                        "action" => "index"
                    ));
        }

        $RecId = $this->request->getPost("RecId");

        $purchreqheader = Purchreqheader::findFirstByRecId($RecId);
        if (!$purchreqheader) {
            $this->flash->error("Item does not exist ");

            return $this->dispatcher->forward(array(
                        "controller" => "purchreqapproval",
                        "action" => "index"
                    ));
        }

        $purchreqheader->PurchReqId = $this->request->getPost("PurchReqId");
        $purchreqheader->PurchReqName = $this->request->getPost("PurchReqName");
        $purchreqheader->Requester = $this->request->getPost("Requester");
        $purchreqheader->PurchReqDate = $this->request->getPost("PurchReqDate");
        $purchreqheader->Status = $this->request->getPost("Status");

        if (!$purchreqheader->save()) {

            foreach ($purchreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "purchreqapproval",
                        "action" => "edit",
                        "params" => array($purchreqheader->RecId)
                    ));
        }

        $this->flash->success("Item was updated successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "purchreqapproval",
                    "action" => "index"
                ));
    }

    /**
     * Deletes a purchreqheader
     *
     * @param string $RecId
     */
    public function deleteAction($RecId) {

        $purchreqheader = Purchreqheader::findFirstByRecId($RecId);
        if (!$purchreqheader) {
            $this->flash->error("Item was not found");

            return $this->dispatcher->forward(array(
                        "controller" => "purchreqapproval",
                        "action" => "index"
                    ));
        }

        if (!$purchreqheader->delete()) {

            foreach ($purchreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "purchreqapproval",
                        "action" => "search"
                    ));
        }

        $this->flash->success("Item was deleted successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "purchreqapproval",
                    "action" => "search"
                ));
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

    public function approvedAction(){
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "purchreqapproval",
                "action" => "index"
            ));
        }

        $RecId = $this->request->getPost("RecId");
        $Deposit = $this->request->getPost("Deposit");
        $Harga = $this->request->getPost("Harga");
        $RecIdCabang = $this->request->getPost("Cabang");
        $PurchReqDate = $this->request->getPost("PurchReqDate");
        $PurchReqId = $this->request->getPost("PurchReqId");

        if ($Deposit >= $Harga) {

        $Purchreqheader = Purchreqheader::findFirstByRecId($RecId);
        $Konfirmasipembayaran = new Konfirmasipembayaran();

        if (!$Purchreqheader) {
            $this->flash->error("Item was not found ");

            return $this->dispatcher->forward(array(
                "controller" => "purchreqapproval",
                "action" => "index"
            ));
        }

        $Purchreqheader->Status = "Approved";
        $Purchreqheader->ApprovalDate = date('Y-m-d H:i:s');

        if (!$Purchreqheader->save()) {
            foreach ($Purchreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }
        }

        $Konfirmasipembayaran->Cabang = $RecIdCabang;
        $Konfirmasipembayaran->ConfirmId = "KP2016-SISTEM";
        $Konfirmasipembayaran->PurchReqName = "Confirm By System";
        $Konfirmasipembayaran->Nominal = 0;
        $Konfirmasipembayaran->PurchReqDate = $PurchReqDate;
        $Konfirmasipembayaran->Status = "Inreview";
        $Konfirmasipembayaran->CreatedBy = "System";
        $Konfirmasipembayaran->CreatedDateTime = date('Y-m-d H:i:s');
        $Konfirmasipembayaran->PurchReqId = $PurchReqId;
        
        if (!$Konfirmasipembayaran->save()) {
            foreach ($Purchreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }
        }

        return $this->response->redirect('purchreqapproval');    


        } else {

        $Purchreqheader = Purchreqheader::findFirstByRecId($RecId);

        if (!$Purchreqheader) {
            $this->flash->error("Item was not found ");

            return $this->dispatcher->forward(array(
                "controller" => "purchreqapproval",
                "action" => "index"
            ));
        }

        $Purchreqheader->Status = "Approved";
       
        $Purchreqheader->ApprovalDate = date('Y-m-d H:i:s');

        if (!$Purchreqheader->save()) {
            foreach ($Purchreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }
        }

        return $this->response->redirect('purchreqapproval');    
        }
    }

    public function rejectAction(){
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "purchreqapproval",
                "action" => "index"
            ));
        }

        $RecId = $this->request->getPost("RecId");

        $purchreqline = Purchreqheader::findFirstByRecId($RecId);

        if (!$purchreqline) {
            $this->flash->error("Item was not found");

            return $this->dispatcher->forward(array(
                "controller" => "purchreqapproval",
                "action" => "index"
            ));
        }

        $purchreqline->Status = "Rejected";
        $purchreqline->Remarks = $_POST['Remarks'];

        if (!$purchreqline->save()) {
            foreach ($purchreqline->getMessages() as $message) {
                $this->flash->error($message);
            }            
        }

        //$this->flash->success(self::getAlert("Item Rejected"));
/*
        return $this->dispatcher->forward(array(
            "controller" => "purchreqapproval",
            "action" => "index"
        ));
*/
        return $this->response->redirect('purchreqapproval');
    }

    /*
    * Custom alert
    */
    public static function getAlert($content){
        
        return "
        <div id='alertContainer' style='position:absolute;z-index:10;width:100%;height:100%;left:0;top:0;background-color:#000;opacity:0.7;' onclick='closePopup();'>
            &nbsp;
            <script language='javascript'>
                Element.prototype.remove = function() {
                    this.parentElement.removeChild(this);
                }
                NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
                    for(var i = 0, len = this.length; i < len; i++) {
                        if(this[i] && this[i].parentElement) {
                            this[i].parentElement.removeChild(this[i]);
                        }
                    }
                }

                function closePopup(){
                    document.getElementById('alert').remove();
                    document.getElementById('alertContainer').remove();
                }
            </script>
        </div>

        <div id='alert' style='position:absolute;z-index:1000;width:30%;height:30%;left:35%;top:30%;background-color:#DADADA;border-radius:3px;border:solid 1px #DADADA;' onclick='closePopup();'>
            <div style='padding-top:10%;text-align:center;'>
                <div style='font-size:2vw;font-weight:bold;padding-bottom:10px;'>Upss..!</div>
                <div style='font-size:1vw;padding:2% 2%;background-color:#FFF;border-radius:3px;border:solid 1px #DADADA;'>$content</div>
            </div>
        </div>";
    }

}
