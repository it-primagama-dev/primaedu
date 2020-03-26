<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;

class InventreceiptController extends ControllerBase
{
 
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->PurchReqId = null;

        $areacabang = $this->session->auth['areacabang'];

        $NoPR = $this->modelsManager->createBuilder()
                ->columns(["Purchreqheader.RecId", "Purchreqheader.PurchReqId"])
                ->from("Purchreqheader")
                ->leftJoin("Purchreqline", "Purchreqheader.RecId = p.Purchreqheader", "p")
                ->where("Purchreqheader.Cabang = :cabang: AND Purchreqheader.Status = :status: AND p.QtyRemaining > 0")
                ->groupBy(["Purchreqheader.RecId", "Purchreqheader.PurchReqId"])
                ->getQuery()
                ->execute(["cabang" => $areacabang, "status" => "Approved"])
                ->setHydrateMode(\Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
        
        $this->view->NoPR = $NoPR;
    }

    /**
     * Searches for inventreceipt
     */
    public function searchAction()
    {
        $numberPage = 1;
        $query = null;
        //Get Area Cabang
        $areacabang = $this->session->get('auth');
        $areacabang = $areacabang['areacabang'];
        $PurchReqId = null;

        if ($this->request->isPost()) {
            $PurchReqId = $_POST['PurchReqId'];
            // set persistent for searching Action
            $this->persistent->PurchReqId = $_POST['PurchReqId'];
        } else {
            $numberPage = $this->request->getQuery("page", "int");

            //set tag for searching page > 1
            $this->tag->setDefault('PurchReqId',$this->persistent->PurchReqId);
            $PurchReqId = $this->persistent->PurchReqId;
        }

        $where = "Purchreqline.QtyRemaining > 0 AND Purchreqheader.Status = 'Approved' ";
        $where .= " AND Purchreqheader.Cabang = '".$areacabang."' ";
        $where .= " AND Purchreqheader.RecId= '".$PurchReqId."' ";

        $query = $this->modelsManager->createBuilder()
                ->columns(array('Purchreqline.RecId','Purchreqline.ItemId','Purchreqline.ItemName','Purchreqline.Qty','Purchreqline.QtyRemaining','Purchreqline.isReceipt','Purchreqline.CreatedBy','Purchreqline.CreatedDateTime', 'Inventitem.NamaItem'))
                ->from('Purchreqheader')
                ->leftJoin('Purchreqline', 'Purchreqheader.RecId = Purchreqline.Purchreqheader')
                ->leftJoin('Inventitem', 'Purchreqline.ItemId = Inventitem.KodeItem')
                ->andWhere($where)
                ->getQuery()
                ->execute();

        $inventreceipt = $query;
        if (count($inventreceipt) == 0) {
            $this->flash->notice("The search did not find any item");

            return $this->dispatcher->forward(array(
                "controller" => "inventreceipt",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $inventreceipt,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();

        $this->view->pick("inventreceipt/index"); 
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a inventreceipt
     *
     * @param string $RecId
     */
    public function editAction($RecId)
    {

        if (!$this->request->isPost()) {

            $inventreceipt = Inventreceipt::findFirstByRecId($RecId);
            if (!$inventreceipt) {
                $this->flash->error("inventreceipt was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "inventreceipt",
                    "action" => "index"
                ));
            }

            $this->view->RecId = $inventreceipt->RecId;

            $this->tag->setDefault("RecId", $inventreceipt->RecId);
            $this->tag->setDefault("Cabang", $inventreceipt->Cabang);
            $this->tag->setDefault("PurchReqLineRecId", $inventreceipt->PurchReqLineRecId);
            $this->tag->setDefault("PackingSlipId", $inventreceipt->PackingSlipId);
            $this->tag->setDefault("ReceiptDate", $inventreceipt->ReceiptDate);
            $this->tag->setDefault("ItemId", $inventreceipt->ItemId);
            $this->tag->setDefault("ItemName", $inventreceipt->ItemName);
            $this->tag->setDefault("QtyReceipt", $inventreceipt->QtyReceipt);
            $this->tag->setDefault("RemainingQty", $inventreceipt->RemainingQty);
            $this->tag->setDefault("CreatedBy", $inventreceipt->CreatedBy);
            $this->tag->setDefault("CreatedDateTime", $inventreceipt->CreatedDateTime);
            
        }
    }

    /**
     * Creates a new inventreceipt
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "inventreceipt",
                "action" => "index"
            ));
        }

        $inventreceipt = new Inventreceipt();

        $inventreceipt->Cabang = $this->request->getPost("Cabang");
        $inventreceipt->PurchReqLineRecId = $this->request->getPost("PurchReqLineRecId");
        $inventreceipt->PackingSlipId = $this->request->getPost("PackingSlipId");
        $inventreceipt->ReceiptDate = $this->request->getPost("ReceiptDate");
        $inventreceipt->ItemId = $this->request->getPost("ItemId");
        $inventreceipt->ItemName = $this->request->getPost("ItemName");
        $inventreceipt->QtyReceipt = $this->request->getPost("QtyReceipt");
        $inventreceipt->RemainingQty = $this->request->getPost("RemainingQty");
        $inventreceipt->CreatedBy = $this->request->getPost("CreatedBy");
        $inventreceipt->CreatedDateTime = $this->request->getPost("CreatedDateTime");
        

        if (!$inventreceipt->save()) {
            foreach ($inventreceipt->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "inventreceipt",
                "action" => "new"
            ));
        }

        $this->flash->success("inventreceipt was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "inventreceipt",
            "action" => "index"
        ));

    }

    /**
     * Saves a inventreceipt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "inventreceipt",
                "action" => "index"
            ));
        }

        $RecId = $this->request->getPost("RecId");

        $inventreceipt = Inventreceipt::findFirstByRecId($RecId);
        if (!$inventreceipt) {
            $this->flash->error("inventreceipt does not exist ");

            return $this->dispatcher->forward(array(
                "controller" => "inventreceipt",
                "action" => "index"
            ));
        }

        $inventreceipt->Cabang = $this->request->getPost("Cabang");
        $inventreceipt->PurchReqLineRecId = $this->request->getPost("PurchReqLineRecId");
        $inventreceipt->PackingSlipId = $this->request->getPost("PackingSlipId");
        $inventreceipt->ReceiptDate = $this->request->getPost("ReceiptDate");
        $inventreceipt->ItemId = $this->request->getPost("ItemId");
        $inventreceipt->ItemName = $this->request->getPost("ItemName");
        $inventreceipt->QtyReceipt = $this->request->getPost("QtyReceipt");
        $inventreceipt->RemainingQty = $this->request->getPost("RemainingQty");
        $inventreceipt->CreatedBy = $this->request->getPost("CreatedBy");
        $inventreceipt->CreatedDateTime = $this->request->getPost("CreatedDateTime");
        

        if (!$inventreceipt->save()) {

            foreach ($inventreceipt->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "inventreceipt",
                "action" => "edit",
                "params" => array($inventreceipt->RecId)
            ));
        }

        $this->flash->success("Item was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "inventreceipt",
            "action" => "index"
        ));

    }

    /**
     * Deletes a inventreceipt
     *
     * @param string $RecId
     */
    public function deleteAction($RecId)
    {

        $inventreceipt = Inventreceipt::findFirstByRecId($RecId);
        if (!$inventreceipt) {
            $this->flash->error("inventreceipt was not found");

            return $this->dispatcher->forward(array(
                "controller" => "inventreceipt",
                "action" => "index"
            ));
        }

        if (!$inventreceipt->delete()) {

            foreach ($inventreceipt->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "inventreceipt",
                "action" => "search"
            ));
        }

        $this->flash->success("inventreceipt was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "inventreceipt",
            "action" => "index"
        ));
    }

    public function editQtyAction()
    {

        if (!$this->request->isPost() || $_POST['PackingSlipIdSubmit'] == "") {
            $this->flash->notice("Nomor SPJ belum diisi");
            return $this->dispatcher->forward(array(
                "controller" => "inventreceipt",
                "action" => "index"
            ));
        }

        //Get PurchReqId, ReceiptDate, and Packing SlipId from View
        $PurchReqId=null;
        $ReceiptDate=date('Ymd');
        $PackingSlipId="";

        if(isset($_POST['PurchReqIdSubmit'])){
            $PurchReqId = $_POST['PurchReqIdSubmit'];
            unset($_POST['PurchReqIdSubmit']);
        }

        if(isset($_POST['ReceiptDateSubmit']) && $ReceiptDate!= ""){
            $ReceiptDate = $_POST['ReceiptDateSubmit'];
            unset($_POST['ReceiptDateSubmit']);
        }

        if(isset($_POST['PackingSlipIdSubmit'])){
            $PackingSlipId = $_POST['PackingSlipIdSubmit'];
            unset($_POST['PackingSlipIdSubmit']);
        }

        foreach ($_POST as $key => $value) {
            if ($value=="") {
                $this->flash->notice("Harap isi semua input kuantitas yang diterima");

                return $this->dispatcher->forward(array(
                    "controller" => "inventreceipt",
                    "action" => "index"
                ));
            }
        }

        $error = false;
        $namaItemTemp = "";
        foreach ($_POST as $purchreqlineRecId => $updateQty) {

            $inventreceipt = Purchreqline::findFirstByRecId($purchreqlineRecId);

            if(intval($inventreceipt->QtyRemaining) >= intval($updateQty) && intval($updateQty) > 0)
            {
                $namaItemTemp = $inventreceipt->ItemName;
                try{

                    // START Insert inventstock 
                    $inventstockTEMP = $this->modelsManager->createBuilder()
                        ->columns(array('Purchreqheader.Cabang','Purchreqline.ItemId','Purchreqline.ItemName','Purchreqline.Qty','Purchreqline.QtyRemaining'))
                        ->from('Purchreqline')
                        ->leftJoin('Purchreqheader', 'Purchreqline.Purchreqheader=Purchreqheader.RecId')
                        ->where('Purchreqline.RecId = "'.$purchreqlineRecId.'"')
                        ->getQuery()
                        ->execute();

                    $inventreceiptTEMP = $this->modelsManager->createBuilder()
                        ->columns(array('Purchreqheader.Cabang','Purchreqline.RecId','Purchreqline.ItemId','Purchreqline.ItemName','Purchreqline.QtyRemaining'))
                        ->from('Purchreqline')
                        ->join('Purchreqheader', 'Purchreqline.Purchreqheader=Purchreqheader.RecId')
                        ->where('Purchreqline.RecId = "'.$purchreqlineRecId.'"')
                        ->getQuery()
                        ->execute();

                    //$this->db->begin();
                    $transactionManager = new TransactionManager();
                    $transaction = $transactionManager->get();

                    $inventstock = new Inventstock();

                    $inventstock->setTransaction($transaction);
                    $inventstock->Cabang = $inventstockTEMP[0]->Cabang;
                    $inventstock->ItemId = $inventstockTEMP[0]->ItemId;
                    $inventstock->ItemName = $inventstockTEMP[0]->ItemName;
                    $inventstock->QtyReceipt = $updateQty;
					//$inventstock->QtyOrder = $inventstockTEMP[0]->Qty;
					$inventstock->QtyOrder = "0";// adit update roby request 13 april 2015
                    $inventstock->TransDate = date('Ymd');

                    if ($inventstock->save()==false) {
                        $transaction->rollback();
                        $this->flash->error();
                        return;

                        foreach ($inventstock->getMessages() as $message) {
                            $this->flash->error($message);
                        }

                        return $this->dispatcher->forward(array(
                            "controller" => "inventreceipt",
                            "action" => "Index"
                        ));   
                    }
                    // END Insert inventstock 



                    // START insert record to invent receipt                     
                    $inventreceiptInsert = new Inventreceipt();

                    $username = $this->session->get('auth');
                    $username = $username['username'];

                    $inventreceiptInsert->setTransaction($transaction);
                    $inventreceiptInsert->Cabang = $inventreceiptTEMP[0]->Cabang;
                    $inventreceiptInsert->PurchReqLineRecId = $inventreceiptTEMP[0]->RecId;
                    $inventreceiptInsert->PackingSlipId = $PackingSlipId;
                    $inventreceiptInsert->ReceiptDate = $ReceiptDate;//date('ymd');
                    $inventreceiptInsert->ItemId = $inventreceiptTEMP[0]->ItemId;
                    $inventreceiptInsert->ItemName = $inventreceiptTEMP[0]->ItemName;
                    $inventreceiptInsert->QtyReceipt = $updateQty;                
                    $inventreceiptInsert->RemainingQty = ($inventreceiptTEMP[0]->QtyRemaining)-$updateQty;
                    $inventreceiptInsert->CreatedBy = $username;
                    $inventreceiptInsert->CreatedDateTime = date('ymd H:i:s'); //SQL
                    //$inventreceiptInsert->CreatedDateTime = date('y-m-d H:i:s'); //MySql

                    if ($inventreceiptInsert->save() == false) {
                        $transaction->rollback();
                        $this->flash->error();
                        return;
                    
                      foreach ($inventreceipt->getMessages() as $message) {
                            $this->flash->error($message);
                        }

                        return $this->dispatcher->forward(array(
                            "controller" => "inventreceipt",
                            "action" => "Index"
                        ));   
                    }
                    // END insert record to invent receipt 


                    // START update qty purchreq line 
                    $inventreceipt->setTransaction($transaction);
                    if(intval($inventreceipt->QtyRemaining) == intval($updateQty)) $inventreceipt->IsReceipt = 1;
                    $inventreceipt->QtyRemaining -= $updateQty;
                
                     if ($inventreceipt->save()==false) {
                        $transaction->rollback();

                        foreach ($purchreqline->getMessages() as $message) {
                            $this->flash->error($message);
                        }

                        return $this->dispatcher->forward(array(
                            "controller" => "inventreceipt",
                            "action" => "Index"
                        ));   
                    }
                   //  END update qty purchreq line 

                    // commit changes
                    //$this->db->commit();
                    $transaction->commit();
                }catch(Phalcon\Mvc\Model\Transaction\Failed $e){
                    echo 'Failed, reason: ', $e->getMessage();

                }
            }else{
                $error = true;
                break;
            }
        }

        if($error) $this->flash->error("Input tidak valid : ".$namaItemTemp);
        else $this->flash->success("<center>Data ".$namaItemTemp." berhasil diubah</center>");

        return $this->response->redirect('inventreceipt/index');
    }

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
