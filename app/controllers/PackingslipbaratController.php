<?php
use Phalcon\Mvc\Model\konfirmasipembayaran;
use Phalcon\Paginator\Adapter\Model as Paginator;
class PackingslipbaratController extends ControllerBase
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
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }

        $cabang = $this->session->has('auth') ? $this->session->get('auth')['areacabang'] : '';


        $konfirmasipembayaran = $this->modelsManager->createBuilder()
                ->columns(array("Konfirmasipembayaran.PurchReqId,Purchreqheader.ApprovalDate,c.NamaAreaCabang,a.NamaAreaCabang AS nama,Purchreqheader.Cabang"))
                ->from("Konfirmasipembayaran")
				 ->join("Areacabang", "Konfirmasipembayaran.Cabang = c.RecID", "c")
                ->join("Areacabang", "c.Area = a.KodeAreaCabang", "a")
				 ->join("CabangBarat", "CabangBarat.KodeCabang = c.KodeAreaCabang")
                ->where("Konfirmasipembayaran.Status = :status: and Konfirmasipembayaran.print_PS < 1")
				->join("Purchreqheader","Konfirmasipembayaran.Purchreqid=Purchreqheader.Purchreqid")
				->groupBy([ "Konfirmasipembayaran.PurchReqId","Purchreqheader.ApprovalDate",
				"c.NamaAreaCabang","a.NamaAreaCabang","Purchreqheader.Cabang"])
                ->getQuery()
                ->execute(["status" => "Approved"]);

        if (count($konfirmasipembayaran) == 0) { 
        }

        $paginator = new Paginator(array(
                    "data" => $konfirmasipembayaran,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();

        $this->view->setVar("session",$this->session->get('auth'));
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

    public function viewAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('LaporanData/index');
        }
 
		
        $area = $this->request->getPost('Area');
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));
		$purchreqid = $this->_validateCabang($this->request->getPost('reqid'));

        $sql = "select rtrim(ltrim(SUBSTRING(ItemID,5,4)))as jenjang,RIGHT(ItemName,4)as tahun,ItemName,Qty from purchreqline join purchreqheader on(purchreqline.Purchreqheader=purchreqheader.RecId)
					 WHERE purchreqheader.cabang=' $cabangid' AND purchreqheader.PurchReqId='$purchreqid'";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
		
		

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
      
        $this->view->result = $query->fetchAll($query);
        $this->view->rpt_area = $area;
		$this->view->reqid = $purchreqid;
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';
		$this->view->rpt_alamat = $cabangid ? $cabang->Alamat : 'All';
		
		$this->db->begin();
		$test=  "update Konfirmasipembayaran set print_PS=print_PS+1,print_time = GETDATE() where PurchReqId='$purchreqid'";
		$this->db->execute($test);
		$this->db->commit();
		$sql1 = "SELECT * from Konfirmasipembayaran where PurchReqId='$PurchReqId'";	
        $que = $this->getDI()->getShared('db')->query($sql1);
        $que->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->res = $que->fetchAll($que);
		
	
		
		
		

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
