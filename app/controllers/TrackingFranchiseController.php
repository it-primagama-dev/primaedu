<?php
use Phalcon\Mvc\Model\konfirmasipembayaran;
use Phalcon\Paginator\Adapter\Model as Paginator;
class TrackingFranchiseController extends ControllerBase
{

    protected $auth;

    public function initialize() {
        $this->tag->setTitle('Packing Slip');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Packing Slip';
    }

    public function indexAction() {
        $numberPage = 1;
		$this->persistent->ConfirmId = null;
        if(!$this->request->isPost()){
        $areacabang = $this->session->auth['areacabang'];
         
        }else{
			$areacabang = $this->_validateCabang($this->request->getPost('Cabang'));
		}
		 $NoPR = $this->modelsManager->createBuilder()
                ->columns(["Konfirmasipembayaran2.RecId", "Konfirmasipembayaran2.ConfirmId"])
                ->from("Konfirmasipembayaran2")
                ->join("Areacabang", "Konfirmasipembayaran2.Cabang = areacabang.RecID", "areacabang")
                ->where("Konfirmasipembayaran2.cabang = :cabang: AND PurchReqDate> '2015-12-06'")
                ->groupBy(["Konfirmasipembayaran2.RecId", "Konfirmasipembayaran2.ConfirmId"])
                ->getQuery()
                ->execute(["cabang" => $areacabang])
                ->setHydrateMode(\Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
        
        $this->view->NoPR = $NoPR;

        
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
	
	public function trakAction() {

        if (!$this->request->isPost()) {
            return $this->forward('Tracking/index');
        }
        $areacabang = $this->session->auth['areacabang'];
		$ConfirmId = $this->request->getPost("ConfirmId");
        $sql = "select Status,convert(varchar,PurchReqDate ,105) as PurchReqDate, convert(varchar,approvaldate ,105) 
		as approvaldate, convert(varchar,PurchReqDate ,108)as waktu, convert(varchar,approvaldate ,108)as waktuapp from konfirmasipembayaran2
		where ConfirmId ='$ConfirmId'";	
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);
		
		 $NoPR = $this->modelsManager->createBuilder()
                ->columns(["Konfirmasipembayaran2.RecId", "Konfirmasipembayaran2.ConfirmId","Konfirmasipembayaran2.PurchReqDate", "Konfirmasipembayaran2.Cabang"])
                ->from("Konfirmasipembayaran2")
                ->where("Konfirmasipembayaran2.ConfirmId = '$PurchReqId' ")
                ->getQuery()
                ->execute()
				 ->setHydrateMode(\Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
                          foreach ( $NoPR as $tes=>$value){
							  $rec=$value[RecId];
							  $Purch=$value[ConfirmId];
							  $Date=$value[PurchReqDate];
							  $Cabang=$value[Cabang];
						  }
						  
		$bahasa="select  TOP 1 * from Konfirmasipembayaran2 where Cabang='$Cabang' and ConfirmId!='$Purch' AND PurchReqDate < '$Date' order by PurchReqDate DESC";
		$depo = $this->getDI()->getShared('db')->query($bahasa);
        $depo->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->deposit = $depo->fetchAll($depo);
		
		$sql1 = 
		"select konfirmasipembayaran2.Status,convert(varchar,konfirmasipembayaran2.PurchReqDate ,105) as PurchReqDate, konfirmasipembayaran2.Nominal,
		(SELECT SUM(Nominal) FROM Konfirmasipembayaran2 WHERE Cabang='$areacabang' and Status='Approved')AS NOMINAL, 
		(select sum(pembayaranfranchisee.Total) from pembayaranfranchisee
		join Areacabang on pembayaranfranchisee.KodeCabang = Areacabang.KodeAreaCabang
		where Areacabang.RecID='$areacabang')as Total, convert(varchar,konfirmasipembayaran2.approvaldate ,105) as approvaldate,convert(varchar,konfirmasipembayaran2.approvaldate ,108)as waktuapp
		 from konfirmasipembayaran2 where konfirmasipembayaran2.ConfirmId='$ConfirmId'";	
		 
        $que = $this->getDI()->getShared('db')->query($sql1);
        $que->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->rest = $que->fetchAll($que);
				 
               
        $this->flash->success("Berikut Alur Pembayaran Anda");
       
    }

}
