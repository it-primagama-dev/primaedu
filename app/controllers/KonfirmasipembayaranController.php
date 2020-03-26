<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class KonfirmasipembayaranController extends ControllerBase {

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Konfirmasi Pembayaran");
        parent::initialize();
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }

    
    public function indexAction() {
        $this->persistent->parameters = null;
		 
    }

   
    public function searchAction() {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Konfirmasipembayaran", $_POST);
            $query->andWhere("Cabang = :cabang:", ["cabang" => $this->auth['areacabang']]);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecId";

        $Konfirmasipembayaran = Konfirmasipembayaran::find($parameters);
        if (count($Konfirmasipembayaran) == 0) {
            $this->flash->notice("Konfirmasi Pembayaran tidak dapat ditemukan");
            return $this->forward('Konfirmasipembayaran/index');
        }

        $paginator = new Paginator(array(
            "data" => $Konfirmasipembayaran,
            "limit" => 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    
    public function newAction() {
		$this->persistent->PurchReqId = null;

        $areacabang = $this->session->auth['areacabang'];

        $NoPR = $this->modelsManager->createBuilder()
                ->columns(["Purchreqheader.RecId","Purchreqheader.PurchReqId"])
                ->from("Purchreqheader")
                ->Join("Purchreqline", "Purchreqheader.RecId = p.Purchreqheader", "p")
                ->where("Purchreqheader.Cabang = :cabang: AND Purchreqheader.Status = :status: AND p.QtyRemaining > 0 AND PurchReqDate> '2015-12-06'")
                ->groupBy(["Purchreqheader.RecId", "Purchreqheader.PurchReqId"])
                ->getQuery()
                ->execute(["cabang" => $areacabang, "status" => "Approved"])
                ->setHydrateMode(\Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
        
        $this->view->NoPR = $NoPR;
        
    }


    public function editAction($RecId) {

        if (!$this->request->isPost()) {

            $Konfirmasipembayaran = Konfirmasipembayaran::findFirstByRecId($RecId);
            if (!$Konfirmasipembayaran) {
                $this->flash->error("Konfirmasi Pembayaran tidak dapat ditemukan");
                return $this->forward('Konfirmasipembayaran/index');
            }

            $this->view->RecId = $Konfirmasipembayaran->RecId;

            $this->tag->setDefault("RecId", $Konfirmasipembayaran->RecId);
            $this->tag->setDefault("ConfirmId", $Konfirmasipembayaran->ConfirmId);
			$this->tag->setDefault("PurchReqId", $Konfirmasipembayaran->PurchReqId);
            $this->tag->setDefault("PurchReqName", $Konfirmasipembayaran->PurchReqName);
            $this->tag->setDefault("Nominal", $Konfirmasipembayaran->Nominal);
            $this->tag->setDefault("PurchReqDate", $Konfirmasipembayaran->PurchReqDate);
            $this->tag->setDefault("Status", $Konfirmasipembayaran->Status);
            $this->tag->setDefault("Remarks", $Konfirmasipembayaran->Remarks);
            $this->tag->setDefault("CreatedBy", $Konfirmasipembayaran->CreatedBy);
            $this->tag->setDefault("CreatedDateTime", $Konfirmasipembayaran->CreatedDateTime);
            $this->tag->setDefault("dataTableUrl", $this->url->get("Konfirmasipembayaran/details/{$Konfirmasipembayaran->RecId}"));
        }
    }

    /**
     * Creates a new Konfirmasipembayaran
     */
    public function createAction() {

        if (!$this->request->isPost()) {
            return $this->forward('Konfirmasipembayaran/index');
        }
		if (!$id=$this->request->getPost("PurchReqId")){
			
			?>
			<script language="Javascript">
			
			window.alert('anda belum melakukan pemesanan');
			</script>
			
			<?php
			
			 return $this->forward('Konfirmasipembayaran/index');
		}

		
		
        $Konfirmasipembayaran = new Konfirmasipembayaran();
			$bank=$this->request->getPost("bank");
				if ($bank==""){
					$bank=$this->request->getPost("Bank");
				}
        //TOC-RB 4 Mei 2015
        //$prcabang = sprintf("%04d", $this->session->auth['areacabang']);
        //TOC-RB 2 Juli 2015
		 $jumlah = substr($this->request->getPost("Nominal", "int"), 0, -2);
        $prcabangnum = sprintf("%02d", $Konfirmasipembayaran->totalRecord() + 1);
        $Konfirmasipembayaran->ConfirmId = 'KP' . date('Y') . '-' . trim($this->auth['kodeareacabang']) . '-' . $prcabangnum;
		$Konfirmasipembayaran->PurchReqId = $this->request->getPost("PurchReqId");
		$Konfirmasipembayaran->Bank= $bank;
        $Konfirmasipembayaran->PurchReqName = $this->request->getPost("PurchReqName");
        $Konfirmasipembayaran->Nominal = $jumlah;
        $Konfirmasipembayaran->PurchReqDate = $this->request->getPost("PurchReqDate") ? : date('Y-m-d H:i:s');
        $Konfirmasipembayaran->Status = 'Draft';
        $Konfirmasipembayaran->CreatedBy = $this->auth['username'];
        $Konfirmasipembayaran->CreatedDateTime = date('Y-m-d H:i:s');
        $Konfirmasipembayaran->Cabang = $this->auth['areacabang'];

        if (!$Konfirmasipembayaran->save()) {
            foreach ($Konfirmasipembayaran->getMessages() as $message) {
                $this->flash->error($message);
            }
			
				return $this->forward('Konfirmasipembayaran/new');
        }

        $this->flash->success("Detail Konfirmasi berhasil ditambahkan");
        return $this->response->redirect('Konfirmasipembayaran/index');
    }

    /**
     * Saves a Konfirmasipembayaran edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->forward('Konfirmasipembayaran/index');
        }

        $RecId = $this->request->getPost("RecId");

        $Konfirmasipembayaran = Konfirmasipembayaran::findFirstByRecId($RecId);
        if (!$Konfirmasipembayaran) {
            $this->flash->error("Konfirmasi Pembayaran tidak dapat ditemukan " . $RecId);
            return $this->forward('Konfirmasipembayaran/index');
        }

        

        $Konfirmasipembayaran->ConfirmId = $this->request->getPost("ConfirmId");
        $Konfirmasipembayaran->PurchReqName = $this->request->getPost("PurchReqName");
        $Konfirmasipembayaran->Nominal = $this->request->getPost("Nominal");
        $Konfirmasipembayaran->PurchReqDate = $this->request->getPost("PurchReqDate");
        // TOC-RB
        //$Konfirmasipembayaran->Status = $this->request->getPost("Status");

        if (!$Konfirmasipembayaran->save()) {

            foreach ($Konfirmasipembayaran->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "Konfirmasipembayaran",
                        "action" => "edit",
                        "params" => array($Konfirmasipembayaran->RecId)
            ));
        }

        $this->flash->success("Konfirmasi Pembayaran berhasil diubah");
        return $this->response->redirect('Konfirmasipembayaran/index');
    }

    /**
     * Deletes a Konfirmasipembayaran
     *
     * @param string $RecId
     */
    public function deleteAction($RecId) {

        $Konfirmasipembayaran = Konfirmasipembayaran::findFirstByRecId($RecId);
        if (!$Konfirmasipembayaran) {
            $this->flash->error("Konfirmasi Pembayaran tidak dapat ditemukan");
            return $this->forward('Konfirmasipembayaran/index');
        }

        if (!$Konfirmasipembayaran->delete()) {

            foreach ($Konfirmasipembayaran->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward('Konfirmasipembayaran/search');
        }

        $this->flash->success("Konfirmasi Pembayaran berhasil dihapus");
        return $this->forward('Konfirmasipembayaran/search');
    }
	
    /*
      TOC-RB : Added Submit Action (change status to inreview)
     */

    public function submitAction($RecId) {
        if (!$this->request->isPost()) {
            $Konfirmasipembayaran = Konfirmasipembayaran::findFirstByRecId($RecId);
            if (!$Konfirmasipembayaran) {
                $this->flash->error("Konfirmasi Pembayaran tidak dapat ditemukan");
                return $this->forward('Konfirmasipembayaran/index');
            }
            $Konfirmasipembayaran->status = "Inreview";
			$Konfirmasipembayaran->PurchReqDate=date('Y-m-d H:i:s');

            $phql = "UPDATE Konfirmasipembayaran SET Status = '{$Konfirmasipembayaran->status}',PurchReqDate='{$Konfirmasipembayaran->PurchReqDate}'
			WHERE RecId = {$RecId}";

            $ret = $this->db->query($phql);

//        	if (!$usergroup->save()) {
            if (!$ret) {
                foreach ($Konfirmasipembayaran->getMessages() as $message) {
                    $this->flash->error($message);
                }

                return $this->forward('Konfirmasipembayaran/index');
            }
            $this->flash->success("Konfirmasi Pembayaran berhasil diubah");

            return $this->response->redirect("Konfirmasipembayaran/search");
        }
    }

    public function detailsAction($id) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $details = array();

        $purchreqline = Purchreqline::findByKonfirmasipembayaran($id);

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
        $query->setModelName('Konfirmasipembayaran')
            ->andWhere("Cabang = :cabang:", ["cabang" => $this->auth['areacabang']])
            ->andWhere("RecId = :recid:", ["recid" => $this->filter->sanitize($RecID, "int")]);

        $pr = Konfirmasipembayaran::findFirst($query->getParams());

        if ($pr === FALSE) {
            $this->flash->error('Konfirmasi Pembayaran tidak dapat ditemukan');
            return $this->forward('Konfirmasipembayaran/index');
        }

        $this->view->pr = $pr;
    }
	
	public function KwitansiAction($RecID) {
		$this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
  
		 $sql = "select convert(varchar,Konfirmasipembayaran.PurchReqDate ,105) as PurchReqDate,c.NamaAreaCabang,Konfirmasipembayaran.PurchReqId,Konfirmasipembayaran.Nominal from Konfirmasipembayaran join areacabang c on Konfirmasipembayaran.Cabang=c.RecID join areacabang
				on areacabang.KodeAreaCabang=c.Area where Konfirmasipembayaran.RecId='$RecID'";	
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);
		
  
        
    }

}
