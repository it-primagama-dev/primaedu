<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class KonfirmasipembayaranholdController extends ControllerBase {

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


        $Konfirmasipembayaran= $this->modelsManager->createBuilder()
                ->columns(array("Konfirmasipembayaran.PurchReqId,sum(Nominal)as Nominal,Purchreqheader.PurchReqDate,Purchreqheader.PurchReqName,
				Konfirmasipembayaran.Status,Purchreqheader.Cabang,c.NamaAreaCabang,a.NamaAreaCabang as nama,Purchreqheader.RecId as rec"))
                ->from("Konfirmasipembayaran")
                ->join("Areacabang", "Konfirmasipembayaran.Cabang = c.RecID", "c")
                ->join("Areacabang", "c.Area = a.KodeAreaCabang", "a")
				->join("Purchreqheader","Konfirmasipembayaran.PurchReqId=Purchreqheader.PurchReqId")
                ->where("Konfirmasipembayaran.Status = :status: ")
				->groupBy(["Konfirmasipembayaran.PurchReqId","Purchreqheader.PurchReqDate","Konfirmasipembayaran.Status","Purchreqheader.Cabang",
				"Purchreqheader.PurchReqName","c.NamaAreaCabang","a.NamaAreaCabang","Purchreqheader.RecId"])
                ->getQuery()
                ->execute(["status" => "OnHold"]);

        if (count($konfirmasipembayaran) == 0) { 
        }

        $paginator = new Paginator(array(
                    "data" => $Konfirmasipembayaran,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();
			
        $this->view->setVar("session",$this->session->get('auth'));
    }
    
    public function searchAction() {

        $numberPage = 1;
        $konfirmasipembayaran = konfirmasipembayaran::find("Status = 'Inreview' AND Cabang = '".$this->session->auth['areacabang']."'");
        if (count($konfirmasi) == 0) {
            $this->flash->notice("The search did not find any item");

            return $this->dispatcher->forward(array(
                        "controller" => "Konfirmasipembayaran",
                        "action" => "index"
                    ));
        }else{
            $numberPage = $this->request->getQuery("page", "int");
        }

        $paginator = new Paginator(array(
                    "data" => $konfirmasi,
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
     * Edits a konfirmasi
     *
     * @param string $RecId
     */
   

    /**
     * Creates a new konfirmasi
     */
    
    public function createAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "Konfirmasipembayaran",
                        "action" => "index"
                    ));
        }

        $konfirmasi = new konfirmasi();

        $konfirmasi->PurchReqId = $this->request->getPost("PurchReqId");
        $konfirmasi->PurchReqName = $this->request->getPost("PurchReqName");
        $konfirmasi->Requester = $this->request->getPost("Requester");
        $konfirmasi->PurchReqDate = $this->request->getPost("PurchReqDate");
        $konfirmasi->Status = 'Draft';
        $konfirmasi->CreatedBy = $this->session->auth['username'];
        $konfirmasi->CreatedDateTime = date('Y-m-d H:i:s');

        if (!$konfirmasi->save()) {
            foreach ($konfirmasi->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "Konfirmasipembayaran",
                        "action" => "new"
                    ));
        }

        $this->flash->success("Item was created successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "Konfirmasipembayaran",
                    "action" => "index"
                ));
    }

    /**
     * Saves a konfirmasi edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "Konfirmasipembayaran",
                        "action" => "index"
                    ));
        }

        $RecId = $this->request->getPost("RecId");

        $konfirmasi = konfirmasi::findFirstByRecId($RecId);
        if (!$konfirmasi) {
            $this->flash->error("Item does not exist ");

            return $this->dispatcher->forward(array(
                        "controller" => "Konfirmasipembayaran",
                        "action" => "index"
                    ));
        }

        $konfirmasi->PurchReqId = $this->request->getPost("PurchReqId");
        $konfirmasi->PurchReqName = $this->request->getPost("PurchReqName");
        $konfirmasi->Requester = $this->request->getPost("Requester");
        $konfirmasi->PurchReqDate = $this->request->getPost("PurchReqDate");
        $konfirmasi->Status = $this->request->getPost("Status");

        if (!$konfirmasi->save()) {

            foreach ($konfirmasi->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "Konfirmasipembayaran",
                        "action" => "edit",
                        "params" => array($konfirmasi->RecId)
                    ));
        }

        $this->flash->success("Item was updated successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "Konfirmasipembayaran",
                    "action" => "index"
                ));
    }

    /**
     * Deletes a konfirmasi
     *
     * @param string $RecId
     */
    public function deleteAction($RecId) {

        $konfirmasi = konfirmasi::findFirstByRecId($RecId);
        if (!$konfirmasi) {
            $this->flash->error("Item was not found");

            return $this->dispatcher->forward(array(
                        "controller" => "Konfirmasipembayaran",
                        "action" => "index"
                    ));
        }

        if (!$konfirmasi->delete()) {

            foreach ($konfirmasi->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "Konfirmasipembayaran",
                        "action" => "search"
                    ));
        }

        $this->flash->success("Item was deleted successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "Konfirmasipembayaran",
                    "action" => "search"
                ));
    }

    public function detailsAction($id) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $details = array();

        $purchreqline = Purchreqline::findBykonfirmasi($id);

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
                "controller" => "Konfirmasipembayaranapp",
                "action" => "index"
            ));
        }
		$rec = $this->request->getPost("rec");
		$Nominal= $this->request->getPost("Nominal");
		$harga = $this->request->getPost("harga");
        $PurchReqId = $this->request->getPost("PurchReqId");
		$Remarks = $_POST['Remarks'];

		$this->db->begin();
		$test=  "update Konfirmasipembayaran set Status = 'Approved',print_PS = 0,Remarks='$Remarks',ApprovalDate=GETDATE() where PurchReqId='$PurchReqId' and Status='OnHold'";
		$tes=$this->db->execute($test);
		$this->db->commit();

        if (!$tes) {
            $this->flash->error("Item was not found ");

            return $this->dispatcher->forward(array(
                "controller" => "Konfirmasipembayaranhold",
                "action" => "index"
            ));
        }
		if($Nominal > $harga){
				$purchreqheader = purchreqheader::findFirstByRecId($rec);
				 $depo=$Nominal-$harga;
					if (!$purchreqheader) {
						$this->flash->error("Item was not found ");

				return $this->dispatcher->forward(array(
					"controller" => "Konfirmasipembayaranapp",
					"action" => "index"
				));
			}
			$purchreqheader->Deposit = $depo;
			if (!$purchreqheader->save()) {
				foreach ($purchreqheader->getMessages() as $message) {
					$this->flash->error($message);
				}
			}
						
					
		 }

        return $this->response->redirect('Konfirmasipembayaranhold');

    }

    public function rejectAction(){
         if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "Konfirmasipembayaranapp",
                "action" => "index"
            ));
        }
		$rec = $this->request->getPost("rec");
		$Nominal= $this->request->getPost("Nominal");
		$harga = $this->request->getPost("harga");
        $PurchReqId = $this->request->getPost("PurchReqId");
		$Remarks = $_POST['Remarks'];

		$this->db->begin();
		$test=  "update Konfirmasipembayaran set Status = 'Rejected',print_PS = 0,Remarks='$Remarks',
		ApprovalDate=GETDATE() where PurchReqId='$PurchReqId' and Status='OnHold'";
		$tes=$this->db->execute($test);
		$this->db->commit();

        if (!$tes) {
            $this->flash->error("Item was not found ");

            return $this->dispatcher->forward(array(
                "controller" => "Konfirmasipembayaranhold",
                "action" => "index"
            ));
        }
		if($Nominal>$harga){
				$purchreqheader = purchreqheader::findFirstByRecId($rec);
				 $depo=$Nominal-$harga;
					if (!$purchreqheader) {
						$this->flash->error("Item was not found ");

				return $this->dispatcher->forward(array(
					"controller" => "Konfirmasipembayaranapp",
					"action" => "index"
				));
			}
			$purchreqheader->Deposit = $depo;
			if (!$purchreqheader->save()) {
				foreach ($purchreqheader->getMessages() as $message) {
					$this->flash->error($message);
				}
			}
				

						
					
		 }


        return $this->response->redirect('Konfirmasipembayaranhold');
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
