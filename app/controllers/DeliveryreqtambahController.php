<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
 

class DeliveryreqtambahController extends ControllerBase {
protected $sql_0=<<<SQL
insert into deliveryreqline(Deliveryreqheader,ItemId,ItemName,Qty,PurchReqLine)
					select deliveryreqheader.RecId,purchreqline.ItemId,purchreqline.itemName,
					purchreqline.qty,purchreqline.RecId from purchreqheader join purchreqline on (purchreqheader.RecId=purchreqline.Purchreqheader)join deliveryreqheader on
					(deliveryreqheader.Purchreqheader=purchreqheader.RecId) where purchreqheader.PurchReqId='?0'
SQL;


    

    public function initialize() {
        $this->tag->setTitle("Permintaan Pengiriman");
        parent::initialize();
    
    }

   
    public function indexAction() {
	        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);

        $this->persistent->parameters = null;
    }

   
	 
	 public function editQtyAction(){
		  $reqid =$this->request->getPost('PurchReqId');
			$this->db->begin();
			
			$sql_0 = "insert into deliveryreqline(Deliveryreqheader,ItemId,ItemName,Qty,PurchReqLine)
						select deliveryreqheader.RecId,purchreqline.ItemId,purchreqline.itemName,
						purchreqline.qty,purchreqline.RecId from purchreqheader 
						join purchreqline on (purchreqheader.RecId=purchreqline.Purchreqheader)
						join deliveryreqheader on (deliveryreqheader.Purchreqheader=purchreqheader.RecId) 
						where purchreqheader.PurchReqId='$reqid'";
			$this->db->execute($sql_0);
			
			
			foreach($_POST['qtyupdate'] as $i => $qtyup){
			
			$Purchreqline = $_POST['Purchreqline'][$i];
			$ItemId = $_POST['ItemId'][$i];
			$qty = $_POST['qty'][$i];
			$ItemName = $_POST['ItemName'][$i];
			$Deliveryreqheaderid = $_POST['Deliveryreqheaderid'][$i];
			
			
				
						 $sql_1 = "update deliveryreqline set QtyRemaining='$qtyup',CreatedBy='logistik',CreatedDateTime=GETDATE()
									FROM deliveryreqline WHERE PurchReqLine='$Purchreqline'";
						$this->db->execute($sql_1);            
					
					
				 }
						$this->db->commit();
						 return $this->forward('deliveryreqheader/index');
						$this->flash->success("Detil pengiriman berhasil silahkan submit");

	 }
	 
	 
	 
	 
	 
    public function searchAction() {
	
	 
        $numberPage = 1;

        if ($this->request->isPost()) {
            $cabangid = $_POST['cabangid'];
            $PurchReqId = $_POST['PurchReqId'];
          

         
		    $numberPage = $this->request->getQuery("page", "int");
        } else {
            $PurchReqId = '';
            $cabangid = $_POST['cabangid'];
         
            $numberPage = $this->request->getQuery("page", "int");

        }


        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));


		$where = "Konfirmasipembayaran.Status = 'Approved'";



    
	  	$where = "a.RecId = '".$areaid."'";
		$where = "c.RecID = '".$cabangid."' ";

	

        $deliver = $this->modelsManager->createBuilder()
                ->columns(array('deliveryreqheader.RecId, test, deliveryreqheader.PurchReqId,deliveryreqheader.approvaldate,
				deliveryreqheader.Status,deliveryreqheader.Cabang, a.NamaAreaCabang as area, c.KodeAreaCabang as kodecabang,					
				c.NamaAreaCabang as namacabang'))
                ->from('deliveryreqheader')
				->join("deliveryreqline","deliveryreqheader.RecId=deliveryreqline.Deliveryreqheader")
                ->join("Areacabang", "deliveryreqheader.Cabang = c.RecID", "c")
                ->join("Areacabang", "c.Area = a.KodeAreaCabang", "a")
                ->leftjoin("deliveryreqheader", "deliveryreqheader.RecId=d.Purchreqheader", "d")	
				->where("deliveryreqline.qty-deliveryreqline.qtyremaining>0")
				->groupby(array("deliveryreqline.recid,deliveryreqheader.PurchReqId,deliveryreqheader.approvaldate,
				deliveryreqheader.Status,deliveryreqheader.Cabang, a.NamaAreaCabang,c.KodeAreaCabang,deliveryreqheader.RecId,
				c.NamaAreaCabang,deliveryreqheader.Status"))
                ->getQuery()
                ->execute();


        if (count($deliver) == 0) { 
        }

        $paginator = new Paginator(array(
                    "data" => $deliver,
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
    public function editAction($RecId) {
	
	
	

        if (!$this->request->isPost()) {

            $deliveryreqheader = Deliveryreqheader::findFirstByPurchreqheader($RecId);
            if (!$deliveryreqheader) {
                $this->flash->error("Permintaan pengiriman tidak dapat ditemukan");
                return $this->forward('deliveryreqheader/index');
            }

            $this->view->RecId = $deliveryreqheader->RecId;

            $this->tag->setDefault("RecId", $deliveryreqheader->RecId);
            $this->tag->setDefault("PurchReqId", $deliveryreqheader->PurchReqId);
            $this->tag->setDefault("ResiId", $deliveryreqheader->ResiId);
            $this->tag->setDefault("Koli", $deliveryreqheader->Koli);
            $this->tag->setDefault("DeliveryReqDate", $deliveryreqheader->DeliveryReqDate);
            $this->tag->setDefault("EstimasiDate", $deliveryreqheader->EstimasiDate);
            $this->tag->setDefault("CreatedBy", $deliveryreqheader->CreatedBy);
            $this->tag->setDefault("CreatedDateTime", $deliveryreqheader->CreatedDateTime);
            $this->tag->setDefault("dataTableUrl", $this->url->get("deliveryreqheader/details/{$deliveryreqheader->RecId}"));
        }
    
	
	
	


    }

    /**
     * Creates a new purchreqheader
     */
    public function createAction() {

        if (!$this->request->isPost()) {
            return $this->forward('deliveryreqtambah/index');
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
        $deliveryreqheader->Status = 'Draft';
        $deliveryreqheader->CreatedBy = $this->auth['username'];
        $deliveryreqheader->CreatedDateTime = date('Y-m-d H:i:s');
        $deliveryreqheader->Cabang = $this->request->getPost("Cabang");

		
        if (!$deliveryreqheader->save()) {
            foreach ($deliveryreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward('deliveryreqtambah/new');
        }
		
			$query = new Criteria();
            $deliveryreqheader2 = Purchreqheader::findFirst($query->getParams());
            $this->view->RecId = $deliveryreqheader2->RecId;
            $this->tag->setDefault("RecId", $deliveryreqheader2->RecId);

		
		

        $this->flash->success("Permintaan pengiriman berhasil ditambahkan");
        
		
		return $this->response->redirect('deliveryreqtambah/viewdetail/'.$deliveryreqheader->Purchreqheader);
    }


    /**
     * Saves a purchreqheader edited {{ hidden_field("dataTableUrl") }}
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->forward('deliveryreqheader/index');
        }

        $RecId = $this->request->getPost("RecId");

        $deliveryreqheader = Deliveryreqheader::findFirstByRecId($RecId);
        if (!$deliveryreqheader) {
            $this->flash->error("Permintaan pembelian tidak dapat ditemukan " . $RecId);
            return $this->forward('deliveryreqheader/index');
        }

        if ($deliveryreqheader->Status != "Draft" && $deliveryreqheader->Status != "Rejected") {
            $this->flash->error("Permintaan Pembelian Tidak Dapat Diubah");
            return $this->forward("deliveryreqheader/index");
        }

        $deliveryreqheader->PurchReqId = $this->request->getPost("PurchReqId");
        $deliveryreqheader->ResiId = $this->request->getPost("ResiId");
		$deliveryreqheader->Koli = $this->request->getPost("Koli");
        $deliveryreqheader->EstimasiDate = $this->request->getPost("EstimasiDate");
       $deliveryreqheader->Purchreqheader = $this->request->getPost("Purchreqheader");
        // TOC-RB
        $deliveryreqheader->Status = $this->request->getPost("Status");

        if (!$deliveryreqheader->save()) {

            foreach ($deliveryreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "deliveryreqheader",
                        "action" => "edit",
                        "params" => array($deliveryreqheader->RecId)
            ));
        }

        $this->flash->success("Permintaan pengiriman berhasil diubah");
        return $this->response->redirect('deliveryreqheader/index');
    }

    /**
     * Deletes a purchreqheader
     *
     * @param string $RecId
     */
    public function deleteAction($RecId) {

        $deliveryreqheader = Deliveryreqheader::findFirstByPurchreqheader($RecId);
		$deliveryreqheader = Deliveryreqline::findFirstByRecId($deliveryreqheader->deliveryreqheader);
        if (!$deliveryreqheader) {
            $this->flash->error("Permintaan pengiriman tidak dapat ditemukan");
            return $this->forward('deliveryreqheader/index');
        }

        if (!$deliveryreqheader->delete()) {

            foreach ($deliveryreqheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward('deliveryreqheader/search');
        }

        $this->flash->success("Permintaan pengiriman berhasil dihapus");
        return $this->forward('deliveryreqheader/search');
    }
	
    /*
      TOC-RB : Added Submit Action (change status to inreview)
     */

    public function submitAction($RecId) {
        if (!$this->request->isPost()) {
            $deliveryreqheader = Deliveryreqheader::findFirstByRecId($RecId);
       //     if (!$deliveryreqheader) {
        //        $this->flash->error("Permintaan pengiriman tidak dapat ditemukan");
         //       return $this->forward('purchreqheader/index');
         //   }
            $deliveryreqheader->status = "Inreview";

          echo  $phql = "UPDATE Deliveryreqheader SET Status = '{$deliveryreqheader->status}' WHERE Purchreqheader = {$RecId}";

            $ret = $this->db->query($phql);

            if (!$ret) {
                foreach ($deliveryreqheader->getMessages() as $message) {
                    $this->flash->error($message);
                }

                return $this->forward('deliveryreqheader/index');
            }
            $this->flash->success("Permintaan pengiriman berhasil diubah");

            return $this->response->redirect("deliveryreqheader/index");
        }
    }

    public function detailsAction($id) {

        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $details = array();





	
	 $deliveryreqheader = Deliveryreqheader::findFirstByRecId($RecId);
		
   $result=$this->db->query("SELECT * FROM Deliveryreqheader where RecId='$RecId'");
    $row=$result->fetchArray();



		//echo $deliveryreqline = "select* FROM deliveryreqline WHERE Deliveryreqheader='25'";
			
						
		//$result=$this->db->query("select* FROM deliveryreqline WHERE Deliveryreqheader=25");
                         
		//$deliveryreqline=$result->fetchArray();				
						
		
		
$deliveryreqline = Deliveryreqline::find("Deliveryreqheader= 25" );

        if (!count($deliveryreqline)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($deliveryreqline as $detail) {
                $details [] = array(
                    'id' => $detail->RecId,
                    'ItemId' => $detail->ItemId,
                    'ItemName' => $detail->ItemName,
                    'Qty' => $detail->QtyRemaining
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
	



    public function viewdetailAction($RecID) {
	
		$deliveryreqheader = deliveryreqline::findFirstByRecId($RecID);

		$this->view->RecId = $deliveryreqheader->RecId;
		$this->tag->setDefault("PurchReqId", $deliveryreqheader->PurchReqId);
		$this->tag->setDefault("Cabang", $deliveryreqheader->Cabang);

		$this->tag->setDefault(" deliveryreqline", $deliveryreqheader->RecId);
	
	
	
        $numberPage = 1;
        $query = null;
        //Get Area Cabang
        $areacabang = $this->session->get('auth');
        $areacabang = $areacabang['areacabang'];
        $PurchReqId = null;
        $Purchreqheader = $RecID;


        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Purchreqheader", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
            $this->tag->setDefault('Purchreqheader',$this->persistent->Purchreqheader);
            $Purchreqheader = $this->persistent->Purchreqheader;
        }



        $where = "deliveryreqline.QtyRemaining > 0 AND deliveryreqline.Status = 'Approved'";
       $where .= " AND deliveryreqline.Deliveryreqheader= '".$this->filter->sanitize($RecID, "int")."'";// OR Deliveryreqheader.Purchreqheader= '25' ";
     


        $query = $this->modelsManager->createBuilder()
               ->columns(array('Purchreqline.RecId','Purchreqline.Purchreqheader','Purchreqline.ItemId','Purchreqline.ItemName','Purchreqline.Qty',
			'Purchreqline.QtyRemaining','Purchreqline.isReceipt','Purchreqline.CreatedBy','Purchreqline.CreatedDateTime', 'Inventitem.NamaItem',
				'Purchreqheader.PurchReqId','Deliveryreqheader.Purchreqheader','Deliveryreqheader.RecId as Deliveryreqheaderid'))
                ->from('Purchreqheader')
                ->leftJoin('Purchreqline', 'Purchreqheader.RecId = Purchreqline.Purchreqheader')
                ->leftJoin('Inventitem', 'Purchreqline.ItemId = Inventitem.KodeItem')
                ->leftJoin('Deliveryreqheader', 'Purchreqheader.RecId = Deliveryreqheader.Purchreqheader')
                ->andWhere($where)
                ->getQuery()
                ->execute();

        $inventreceipt = $query;
		$deliveryreq = $query;
		
        if (count($inventreceipt) == 0) {
          //  $this->flash->notice("The search did not find any item");

            return $this->dispatcher->forward(array(
                "controller" => "deliveryreqheader",
                "action" => "viewdetail"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $inventreceipt,
            "limit"=> 50,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();

        $this->view->pick("deliveryreqheader/viewdetail"); 
    
	
	
    }
	
	 public function kirimAction($RecID) {


            $deliveryreqheader = deliveryreqheader::findFirstByRecId($RecID);

            $this->view->RecId = $deliveryreqheader->RecId;
            $this->tag->setDefault("PurchReqId", $deliveryreqheader->PurchReqId);
            $this->tag->setDefault("Cabang", $deliveryreqheader->Cabang);

			$this->tag->setDefault("deliveryreqheader", $deliveryreqheader->RecId);

	
	
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
