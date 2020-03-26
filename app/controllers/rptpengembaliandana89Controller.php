<?php

class rptpengembaliandana89Controller extends ControllerBase
{

    protected $auth;

   

    public function initialize() {
        $this->tag->setTitle('Laporan Pengembalian Dana');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Pilih Tahunajaran';
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
        if (!count($cabang)) {
            return;
        }
        foreach ($cabang as $rec) {
            echo "<option value=\"" . $rec->RecID . "\">" . $rec->KodeNamaAreaCabang . "</option>";
        }
    }

 public function viewAction() {


        if (!$this->request->isPost()) {
            return $this->forward('rptpengembaliandana89/index');
        }

        $tahun = $this->request->getPost('tahun');
        $cabang = $this->request->getPost('Cabang');
         	if ($cabang==''){
			$cabang = $this->auth['areacabang'];
		}
		
  
		
		$sql = "   select  siswa.NamaSiswa as siswa,transaksibank.NamaBank,transaksibank.TanggalTransaksi,transaksibank.TanggalImport,transaksibank.WaktuTransaksi,transaksibank.NoVA,
         (transaksibank.Nominal * 0.89) AS Nominal89, tahunajaran.Description, siswa.VirtualAccount, areacabang.KodeAreaCabang  
		 from transaksibank 
		left join siswa on transaksibank.siswa=siswa.RecID
		left join tahunajaran on transaksibank.tahunajaran=tahunajaran.RecID
		left join areacabang on transaksibank.KodeCabang=areacabang.KodeAreaCabang
		where areacabang.RecID='$cabang' and isnull(tahunajaran.RecID,1) = '$tahun'
		and len(NoReferensi) != 4 and len(NoReferensi) != 6
		order by NoVA, TanggalTransaksi
		 	
                ";
		 $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$this->view->result = $query->fetchAll($query); 

        $date = date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
      //  $cabangid = $this->request->getPost('Cabang');
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'all';
        $tahunajaran = Tahunajaran::findFirstByRecID($tahun);
        $this->view->rpt_tahun = $tahun ? $tahunajaran->Description : 'all';

    }

    private function _getCriteria($areaid, $cabangid) {
        $temp = "";
        if ($areaid){
            $temp .= "Areacabang.RecID = ".$areaid;
        }
        if ($cabangid){
            $temp .= $areaid ? " AND " : "";
            $temp .= "c.RecID = ".$cabangid;
        }
        return $temp == "" ? NULL : $temp;
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

