<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\NativeArray as Paginator;

class quetionerController extends ControllerBase {

    protected $auth;
    
	 protected $sql = <<<SQL
select Kuesioner.pertanyaan, JawabanBobot.IdPilihan, PilihanBobot.Bobot, JawabanBobot.IdCabang, Kuesioner.IdJenis, 
PilihanBobot.Pilihan,a.NamaAreaCabang,saran
--(select Saran from JawabanBobot join areacabang a on  a.RecID = jawabanBobot.IdCabang ) as Saran
				From JawabanBobot 
				Join areacabang a ON JawabanBobot.IdCabang = a.RecID
				join areacabang on a.Area = areacabang.KodeAreaCabang
				join PilihanBobot ON JawabanBobot.IdPilihan = PilihanBobot.IdPilihan
				join Kuesioner ON JawabanBobot.IdPertanyaan = Kuesioner.RecID
				
%2
order By a.NamaAreaCabang
SQL;
	

   public function initialize() {
        $this->tag->setTitle('Quetioner');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Quetioner';
    }

    public function indexAction() {
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('Area', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
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

    /**
     * Searches for inventstock
     */
    public function viewAction() {
		if (!$this->request->isPost()) {
            return $this->forward('quetioner/index');
        }
		
		$this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
		 $areaid = $this->_validateArea($this->request->getPost('Area'));
		 $cabangid = $this->_validateArea($this->request->getPost('Cabang'));
		//$area2=> $this->request->getPOST("RecId","int");
		
		/*	$sql = "select Kuesioner.pertanyaan, JawabanBobot.IdPilihan, JawabanEssay.jawaban, PilihanBobot.Bobot, JawabanBobot.IdCabang, Kuesioner.Id_jenis, PilihanBobot.Pilihan
				 From Kuesioner Left Join JawabanBobot ON Kuesioner.RecID = JawabanBobot.IdPertanyaan
				 Left Join PilihanBobot ON JawabanBobot.IdPilihan = PilihanBobot.IdPilihan
				 Left Join JawabanEssay ON JawabanEssay.Id_pernyataan = Kuesioner.RecID
					Where JawabanEssay.Cabang = '$area1'";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
		
        $this->view->result = $query->fetchAll($query);*/
		
		$sql1 = str_replace(
                ['%0', '%1', '%2', '%3'], [$datefrom, $dateto, $this->_getCriteria($areaid, $cabangid), ""], $this->sql);
				 
        $query1 = $this->getDI()->getShared('db')->query($sql1);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
		
        $this->view->hasil = $query1->fetchAll($query1);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';

}

	private function _getCriteria($areaid, $cabangid) {
        $temp = "WHERE ";
        if ($areaid){
            $temp .= "areacabang.RecID = ".$areaid;
        }
        if ($cabangid){
            $temp .= $areaid ? " AND " : "";
            $temp .= "a.RecID = ".$cabangid;
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
?>
