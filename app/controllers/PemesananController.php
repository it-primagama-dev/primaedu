<?php
use Phalcon\Mvc\Model\konfirmasipembayaran;
use Phalcon\Paginator\Adapter\Model as Paginator;
class PemesananController extends ControllerBase
{

    protected $auth;

    public function initialize() {
        $this->tag->setTitle('Pemesanan');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Pemesanan';
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
                ->where("Purchreqheader.Cabang = :cabang: AND p.Qty> 0 AND PurchReqDate> '2015-12-06'")
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
	
	public function pesanAction() {

        if (!$this->request->isPost()) {
            return $this->forward('Pesan/index');
        }
		$PurchReqId = $this->request->getPost("PurchReqId");
        
		
		$sql3="select * from purchreqline join purchreqheader on (purchreqheader.RecId=purchreqline.Purchreqheader)
		where Purchreqheader.PurchReqId='$PurchReqId'";
		$qu = $this->getDI()->getShared('db')->query($sql3);
        $qu->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->tampung = $qu->fetchAll($qu);
        $this->view->pr = $PurchReqId;
		
				 
               
		
        $this->flash->success("Berikut Pemesanan ".$PurchReqId);
       
    }

}
