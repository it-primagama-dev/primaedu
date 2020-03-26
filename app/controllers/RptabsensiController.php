<?php

class RptabsensiController extends ReportBase {

    protected $sql1 = <<<SQL
select siswa.VirtualAccount,siswa.NamaSiswa, absensi.AbsenDate, absensi.AbsenTime, c.NamaAreaCabang  from absensi 
join siswa on absensi.KodeSiswa=siswa.RecID
JOIN areacabang c ON absensi.Cabang = c.RecID
JOIN areacabang a ON a.KodeAreaCabang = c.Area
WHERE siswa.VirtualAccount='%1' AND AbsenDate >=  '%2' AND AbsenDate <= '%3'
%0
ORDER BY c.KodeAreaCabang, siswa.VirtualAccount
SQL;

   protected $sql = <<<SQL
select siswa.VirtualAccount,siswa.NamaSiswa, absensi.AbsenDate, absensi.AbsenTime, c.NamaAreaCabang  from absensi 
join siswa on absensi.KodeSiswa=siswa.RecID
JOIN areacabang c ON absensi.Cabang = c.RecID
JOIN areacabang a ON a.KodeAreaCabang = c.Area
WHERE AbsenDate BETWEEN '%2' AND '%3'
%0 
ORDER BY c.KodeAreaCabang, siswa.VirtualAccount
SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan Absensi Siswa');
        parent::initialize();
        $this->view->rpt_title = 'Laporan Absensi Siswa';
    }

    public function indexAction() {
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('Area', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
		$this->view->siswatx = $this->getTransaction();
    }

    public function getcabangAction($area = 0) {
        $this->view->disable();
        $cabang = Areacabang::query()
                ->columns("c.*")
                ->join("Areacabang", "Areacabang.KodeAreaCabang = c.Area", "c")
                ->where("Areacabang.RecID = :area: AND Aktif = 1")
                ->orderBy("c.KodeAreaCabang")
                ->bind(["area" => $this->filter->sanitize($area, "int")])
                ->execute();
        //echo '<option value="">---</option>';
        if (!count($cabang)) {
            return;
        }
        foreach ($cabang as $rec) {
            echo "<option value=\"" . $rec->RecID . "\">" . $rec->KodeNamaAreaCabang . "</option>";
        }
    }

    public function viewAction() {
        if (!$this->request->isPost()) {
            return $this->forward('Rptabsensi/index');
        }
	         
		$siswatx = $this->request->getPost('Siswa');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));
        $param = [
            $this->_getCriteria($areaid, $cabangid, FALSE),
            $this->request->getPost('Siswa'), $this->getDateFrom(), $this->getDateTo()			
        ];
	
        $sql = str_replace(['%0', '%1', '%2', '%3'], $param, $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
				
        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = $this->getDateFrom('d/m/Y') . ' - ' . $this->getDateTo('d/m/Y');
	//	$this->view->periode = $this->getDateFrom1('d/m/Y') . ' - ' . $this->getDateTo1('d/m/Y');
	    $this->view->result = $query->fetchAll($query);
        $this->view->rpt_title = 'Laporan Absensi ' ;
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';
    }

	    public function absensiallAction() {
        if (!$this->request->isPost()) {
            return $this->forward('Rptabsensi/index');
        }
  
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));
        $param = [
            $this->_getCriteria($areaid, $cabangid, FALSE),
            $this->getDateFrom1(), $this->getDateTo1()
        ];    
	
		$sql1 = str_replace(['%0', '%1', '%2', '%3'], $param, $this->sql1);
        $query1 = $this->getDI()->getShared('db')->query1($sql1);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
    
        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
		$this->view->periode = $this->getDateFrom1('d/m/Y') . ' - ' . $this->getDateTo1('d/m/Y');
		$this->view->result = $query1->fetchAll($query1);
        $this->view->rpt_title = 'Laporan Absensi ' ;
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';
    }
	
   private function getType() {
        return $this->request->getPost('ViewType') === 'D' ? 'Pendaftaran' : 'Bimbingan';
    }

    private function getDateFrom($format = 'Y-m-d', $time = null) {
        $temp = $time ? strtotime($time) : strtotime($this->request->getPost('DateFrom', 'int'));
        return $temp === FALSE ? date($format) : date($format, $temp);
    }
	 private function getDateFrom1($format = 'Y-m-d', $time = null) {
        $temp = $time ? strtotime($time) : strtotime($this->request->getPost('DateFrom1', 'int'));
        return $temp === FALSE ? date($format) : date($format, $temp);
    }

    private function getDateTo($format = 'Y-m-d', $time = null) {
        $temp = $time ? strtotime($time) : strtotime($this->request->getPost('DateTo', 'int'));
        return $temp === FALSE ? date($format) : date($format, $temp);
    }
	  private function getDateTo1($format = 'Y-m-d', $time = null) {
        $temp = $time ? strtotime($time) : strtotime($this->request->getPost('DateTo1', 'int'));
        return $temp === FALSE ? date($format) : date($format, $temp);
    }
    private function getTransaction($siswa = NULL) {
        $column = ['s.VirtualAccount', 's.VirtualAccount + " - " + s.NamaSiswa AS NamaSiswa'];
        $groupBy = ['s.VirtualAccount', 's.NamaSiswa'];
        $cabang = $this->auth['areacabang'];
        $query = $this->modelsManager->createBuilder()
                ->columns($column)->groupBy($groupBy)
                ->addFrom('Siswa', 's')
                ->join('Programsiswa', 'ps.Siswa = s.RecID', 'ps')
                ->where('s.Cabang = :c:', ['c' => $cabang])
                ->orderBy('s.VirtualAccount');
        if ($siswa) {
            $query = $query->andWhere('s.VirtualAccount = :s:', ['c' => $siswa]);
        }
        return $query->getQuery()->execute()->setHydrateMode(Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
    }

}
