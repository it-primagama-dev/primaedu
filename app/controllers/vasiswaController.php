<?php

set_time_limit(100);
class VasiswaController extends ControllerBase
{

   protected $auth;

    public function initialize() {
        $this->tag->setTitle('VA Siswa');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'VA Siswa TA 2015/2016, 2016/2017 & 2017/2018';
    }

    public function indexAction() {
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('Area', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
		
        $this->view->tahun = Tahunajaran::find();
	
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

    public function viewAction() {


        if (!$this->request->isPost()) {
            return $this->forward('vasiswa/index');
        }

        $va = $this->request->getPost('va');
        $va2 = $this->request->getPost('va2');
        $cabang = $this->request->getPost('Cabang');
        if ($cabang != ''){
        $areaid = $this->request->getPost('Cabang');
        } else if ($cabang == ''){
        $areaid = $this->request->getPost('Area');
        }
        	
        $sql = "SELECT (substring(areacabang.KodeAreaCabang,0,5)+siswa.VirtualAccount) as NoVA, REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(siswa.NamaSiswa,'!', ' '),'@', ' '),'$', ' '),'%', ' '),'^', ' '),'&', ' '),'#', ' '),'(', ' '),')', ' '),'-', ' '),'=', ' '),'_', ' '),'+', ' '),'{', ' '),'}', ' '),'[', ' '),']', ' '),'\', ' '),'|', ' '),':', ' '),';', ' '),',', ' '),'.', ' '),'<', ' '),'>', ' '),'?', ' '),'/', ' '),'`', ' ') as NamaSiswa FROM siswa
        Join programsiswa ON siswa.RecID = programsiswa.siswa
        Join program ON program.RecID = programsiswa.program
        join tahunajaran on tahunajaran.RecID = program.tahunajaran
        join areacabang on siswa.Cabang = areacabang.RecID
        join areacabang b on areacabang.Area = b.KodeAreaCabang
        where siswa.cabang != '1259' and NamaSiswa != '' and siswa.NamaSiswa != 'test' and siswa.NamaSiswa != 'salah' and siswa.NamaSiswa not like '%double%' and b.RecID = '$areaid' and siswa.VirtualAccount between '$va' and '$va2'
        or siswa.cabang != '1259' and siswa.cabang = '$areaid' and NamaSiswa != '' and siswa.NamaSiswa != 'test' and siswa.NamaSiswa != 'salah' and siswa.NamaSiswa not like '%double%' and siswa.VirtualAccount between '$va' and '$va2'
        Group By (substring(areacabang.KodeAreaCabang,0,5)+siswa.VirtualAccount), siswa.NamaSiswa
        order by NoVA";
		 $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$this->view->result = $query->fetchAll($query);          

        $date = date('Y-m-d');

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $this->view->date = $date;
        $this->view->va = "$va - $va2";
        //$tahunajaran = Tahunajaran::findFirstByRecID($tahun);
        //$this->view->rpt_tahun = $tahun ? $tahunajaran->Description : 'all';

    }
}

