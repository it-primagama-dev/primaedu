<?php
use Phalcon\Mvc\Model\konfirmasipembayaran;
use Phalcon\Paginator\Adapter\Model as Paginator;
class TrackingController extends ControllerBase
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
		$this->persistent->PurchReqId = null;
        if(!$this->request->isPost()){
        $areacabang = $this->session->auth['areacabang'];
         
        }else{
			$areacabang = $this->_validateCabang($this->request->getPost('Cabang'));
		}
		 $NoPR = $this->modelsManager->createBuilder()
                ->columns(["Purchreqheader.RecId", "Purchreqheader.PurchReqId"])
                ->from("Purchreqheader")
                ->Join("Purchreqline", "Purchreqheader.RecId = p.Purchreqheader", "p")
                ->where("Purchreqheader.Cabang = :cabang: AND p.Qty > 0 AND PurchReqDate> '2015-12-06'")
                ->groupBy(["Purchreqheader.RecId", "Purchreqheader.PurchReqId"])
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
		$PurchReqId = $this->request->getPost("PurchReqId");
        $sql = "select TOP 1 status as astatus,convert(varchar,PurchReqDate ,105) as PurchReqDate ,convert(varchar,approvaldate ,105) 
		as approvaldate,convert(varchar,PurchReqDate ,108)as waktu,convert(varchar,approvaldate ,108)as waktuapp 
		from purchreqheader where PurchReqId='$PurchReqId'";	
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);
		
		 $sql1 = "select TOP 1 konfirmasipembayaran.status as astatus,print_PS,convert(varchar,konfirmasipembayaran.PurchReqDate ,105) as PurchReqDate ,
		 (SELECT SUM(NOMINAL) FROM Konfirmasipembayaran WHERE purchreqid='$PurchReqId' and Status='Approved' GROUP BY PurchReqId)AS NOMINAL,
		 SUM(purchreqline.PRICE*purchreqline.QTY) AS HARGA ,convert(varchar,konfirmasipembayaran.print_time ,105) as printDate,
		 convert(varchar,konfirmasipembayaran.approvaldate ,105) as approvaldate,convert(varchar,konfirmasipembayaran.print_time ,108)as waktuprint,convert(varchar,konfirmasipembayaran.PurchReqDate ,108)as waktu,
		 convert(varchar,konfirmasipembayaran.approvaldate ,108)as waktuapp  from konfirmasipembayaran JOIN purchreqheader on Konfirmasipembayaran.PurchReqId=
		 purchreqheader.PurchReqId join purchreqline on purchreqheader.RecId=purchreqline.Purchreqheader
		where konfirmasipembayaran.PurchReqId='$PurchReqId' 
		group by  konfirmasipembayaran.PurchReqId,konfirmasipembayaran.status,konfirmasipembayaran.PurchReqDate,konfirmasipembayaran.NOMINAL,konfirmasipembayaran.print_time,
		konfirmasipembayaran.approvaldate,konfirmasipembayaran.PurchReqDate,konfirmasipembayaran.print_PS ";	
        $que = $this->getDI()->getShared('db')->query($sql1);
        $que->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->rest = $que->fetchAll($que);
		
		$sql2="select TOP 1 status,convert(varchar,CreatedDateTime ,105) as tanggal ,convert(varchar,EstimasiDate ,105) as ETA,koli,ResiId,
		convert(varchar,CreatedDateTime ,108)as waktu from deliveryreqheader
		where PurchReqId='$PurchReqId'";
		$q = $this->getDI()->getShared('db')->query($sql2);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->reslast = $q->fetchAll($q);
		
		$sql3="select *,deliveryreqheader.ResiId as resi from deliveryreqline 
                join deliveryreqheader on (deliveryreqheader.RecId=deliveryreqline.Deliveryreqheader)
                join inventitem on deliveryreqline.ItemId=inventitem.kodeItem
		          where deliveryreqheader.PurchReqId='$PurchReqId'
                  order by inventitem.TipeInvent";
		$qu = $this->getDI()->getShared('db')->query($sql3);
        $qu->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->tampung = $qu->fetchAll($qu);
		
        $sql4="select deliveryreqheader.ResiId,convert(varchar,CreatedDateTime ,105) as tgl,convert(varchar,CreatedDateTime,108)as waktu,koli,b.Nama as Expedisi,deliveryreqheader.CpExpedisi from deliveryreqheader
        join expedisi b on deliveryreqheader.Expedisi=b.RecId
        where deliveryreqheader.PurchReqId='$PurchReqId'";
		$weri = $this->getDI()->getShared('db')->query($sql4);
        $weri->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->weri = $weri->fetchAll($weri);
		
		
		 $NoPR = $this->modelsManager->createBuilder()
                ->columns(["Purchreqheader.RecId", "Purchreqheader.PurchReqId","Purchreqheader.PurchReqDate", "Purchreqheader.Cabang"])
                ->from("Purchreqheader")
                ->where("Purchreqheader.PurchReqId = '$PurchReqId' ")
                ->getQuery()
                ->execute()
				 ->setHydrateMode(\Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
                          foreach ( $NoPR as $tes=>$value){
							  $rec=$value[RecId];
							  $Purch=$value[PurchReqId];
							  $Date=$value[PurchReqDate];
							  $Cabang=$value[Cabang];
						  }
						  
		$bahasa="select  TOP 1 * from Purchreqheader where Cabang='$Cabang' and PurchReqId!='$Purch' AND PurchReqDate < '$Date' order by PurchReqDate DESC";
		$depo = $this->getDI()->getShared('db')->query($bahasa);
        $depo->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->deposit = $depo->fetchAll($depo);
				 
         
        $this->view->PR = $PurchReqId;      
		
        $this->flash->success("Berikut Alur Pemesanan Anda");
       
    }

}
