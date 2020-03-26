<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class DeliveryreqapprovalController extends ControllerBase {

    /** 
     * Index action
     */
    public function indexAction() { 
    //    $this->persistent->parameters = null;

        $numberPage = 1;
       

  //      $cabang = $this->session->has('auth') ? $this->session->get('auth')['areacabang'] : '';

	$where = "Deliveryreqheader.Status = 'Draft' and Deliveryreqheader.ResiId = ''";

        $deliveryreqheader = $this->modelsManager->createBuilder()
                ->columns(array("Deliveryreqheader.RecId,Deliveryreqheader.Purchreqheader,Deliveryreqheader.PurchReqId,c.NamaAreaCabang,a.NamaAreaCabang as area,Deliveryreqheader.Status,Deliveryreqheader.Cabang"))
                ->from("Deliveryreqheader")
                ->join("Areacabang", "Deliveryreqheader.Cabang = c.RecID", "c")
                ->join("Areacabang", "c.Area = a.KodeAreaCabang", "a")
                 ->andWhere($where)
                ->getQuery()
                ->execute();

        if (count($deliveryreqheader) == 0) { 
        }

        $paginator = new Paginator(array(
                    "data" => $deliveryreqheader,
                    "limit" => 1000,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();

        $this->view->setVar("session",$this->session->get('auth'));
    }

    
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
                    "limit" => 1000,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        
    }

    
	
    public function editAction($RecId) {

        if (!$this->request->isPost()) {
    
            $numberPage = $this->request->getQuery("page", "int");
            $numberPage = isset($numberPage) ? $numberPage : 1;

          

            $deliveryreqline = Deliveryreqline::query()
                                    ->where("Deliveryreqheader = '$RecId'")
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
                    "limit" => 100,
                    "page" => $numberPage
                ));

            $this->view->deliveryreqlineRecId = $RecId;

            $this->view->page = $paginator->getPaginate();

            $this->view->setVar("session",$this->session->get('auth'));
        }
    }

    
	
    public function createAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "deliveryreqapproval",
                        "action" => "index"
                    ));
        }

        $deliveryreqheader = new Purchreqheader();

        $deliveryreqheader->PurchReqId = $this->request->getPost("PurchReqId");
        $deliveryreqheader->ResiId = $this->request->getPost("ResiId");
        $deliveryreqheader->Koli = $this->request->getPost("Koli");
        $deliveryreqheader->DeliveryReqDate = $this->request->getPost("DeliveryReqDate");
		$deliveryreqheader->EstimasiDate = $this->request->getPost("EstimasiDate");	
        $deliveryreqheader->Status = 'Draft';
        $deliveryreqheader->CreatedBy = $this->session->auth['username'];
        $deliveryreqheader->CreatedDateTime = date('Y-m-d H:i:s');

        if (!$deliveryreqheader->save()) {
            foreach ($deliveryreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "deliveryreqapproval",
                        "action" => "new"
                    ));
        }

        $this->flash->success("Item was created successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "deliveryreqapproval",
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
                        "controller" => "deliveryreqapproval",
                        "action" => "index"
                    ));
        }

        $RecId = $this->request->getPost("RecId");

        $deliveryreqheader = Deliveryreqheader::findFirstByRecId($RecId);
        if (!$deliveryreqheader) {
            $this->flash->error("Item does not exist ");

            return $this->dispatcher->forward(array(
                        "controller" => "deliveryreqapproval",
                        "action" => "index"
                    ));
        }

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

            return $this->dispatcher->forward(array(
                        "controller" => "deliveryreqapproval",
                        "action" => "edit",
                        "params" => array($deliveryreqheader->RecId)
                    ));
        }

        $this->flash->success("Item was updated successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "deliveryreqapproval",
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
                        "controller" => "deliveryreqapproval",
                        "action" => "index"
                    ));
        }

        if (!$deliveryreqheader->delete()) {

            foreach ($deliveryreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "deliveryreqapproval",
                        "action" => "search"
                    ));
        }

        $this->flash->success("Item was deleted successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "deliveryreqapproval",
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

    public function approvedAction(){
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "deliveryreqapproval",
                "action" => "index"
            ));
        }

        $RecId = $this->request->getPost("RecId");

        $deliveryreqline = Deliveryreqheader::findFirstByRecId($RecId);

        if (!$deliveryreqline) {
            $this->flash->error("Item was not found ");

            return $this->dispatcher->forward(array(
                "controller" => "deliveryreqapproval",
                "action" => "index"
            ));
        }

        $deliveryreqline->Status = "Approved";
        //TOC-RB 05-08-2015
        $deliveryreqline->ApprovalDate = date('Y-m-d H:i:s');

        if (!$deliveryreqline->save()) {
            foreach ($deliveryreqline->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
/*
        return $this->dispatcher->forward(array(
            "controller" => "purchreqapproval",
            "action" => "index"
        ));
*/
        return $this->response->redirect('deliveryreqapproval');

    }

    public function rejectAction(){
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "deliveryreqapproval",
                "action" => "index"
            ));
        }

        $RecId = $this->request->getPost("RecId");

        $deliveryreqline = Deliveryreqheader::findFirstByRecId($RecId);

        if (!$deliveryreqline) {
            $this->flash->error("Item was not found");

            return $this->dispatcher->forward(array(
                "controller" => "deliveryreqapproval",
                "action" => "index"
            ));
        }

        $deliveryreqline->Status = "Rejected";
        $deliveryreqline->Remarks = $_POST['Remarks'];

        if (!$deliveryreqline->save()) {
            foreach ($deliveryreqline->getMessages() as $message) {
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
        return $this->response->redirect('deliveryreqapproval');
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
