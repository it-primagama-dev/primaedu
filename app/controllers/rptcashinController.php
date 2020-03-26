<?php

class rptcashinController extends ControllerBase
{

    protected $auth;

   

    public function initialize() {
        $this->tag->setTitle('Laporan Pengembalian Dana');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Pilih Sesuai Tanggal'; 
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
            return $this->forward('rptcashin/index');
        }
		
		$datefrom = $this->request->getPost('DateFrom', 'int') ? : date('Y-m-d');
        $dateto = $this->request->getPost('DateTo', 'int') ? : date('Y-m-d');
        $tahun = $this->request->getPost('tahun');
        $cabang = $this->request->getPost('Cabang');
         	if ($cabang==''){
			$cabang = $this->auth['areacabang'];
		}
  
		
		$sql = "  select sum(transaksibank.Nominal * 0.89) AS Nominal89,  areacabang.KodeAreaCabang
		 from transaksibank 
		--left join tahunajaran on transaksibank.tahunajaran=tahunajaran.RecID
		join areacabang on transaksibank.KodeCabang=areacabang.KodeAreaCabang
		where areacabang.RecID='$cabang' and transaksibank.TanggalTransaksi between '$datefrom' and '$dateto'
		group by areacabang.kodeAreaCabang
		 	    ";
		 $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$this->view->result = $query->fetchAll($query); 
		
			$sql1 = "select areacabang.NamaAreaCabang, areacabang.kodeAreaCabang ,pengeluaranbiayagroup.NamaBiayaGroup,Tanggal,Description, Jumlah from pengeluaranbiaya 
			join areacabang on pengeluaranbiaya.Cabang=areacabang.RecID
			join pengeluaranbiayagroup on pengeluaranbiaya.BiayaGroup=pengeluaranbiayagroup.RecID
		where areacabang.RecID='$cabang' and pengeluaranbiaya.Tanggal between '$datefrom' and '$dateto'
		group by pengeluaranbiayagroup.NamaBiayaGroup,areacabang.KodeAreaCabang,areacabang.NamaAreaCabang,pengeluaranbiaya.Description, pengeluaranbiaya.Jumlah, pengeluaranbiaya.Tanggal
					";
		$query1 = $this->getDI()->getShared('db')->query($sql1);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$this->view->result1 = $query1->fetchAll($query1);
		
			$sql2 = "SELECT
							c.NamaAreaCabang AS NamaCabang
							, SUM(pd.Jumlah) AS Jumlah							
						FROM siswa s
						JOIN programsiswa ps ON s.RecID = ps.Siswa
						JOIN pembayaran pb ON ps.RecID = pb.ProgramSiswa
						JOIN pembayarandetail pd ON pb.RecID = pd.Pembayaran
						JOIN program p ON ps.Program = p.RecID
						JOIN jenjang j ON p.Jenjang = j.KodeJenjang
						JOIN areacabang c ON s.Cabang = c.RecID
						JOIN areacabang a ON a.KodeAreaCabang = c.Area
						WHERE pd.PembayaranUntuk = 'Pendaftaran' and c.RecID='$cabang' and pd.TanggalPembayaran between '$datefrom' and '$dateto'
						group by  c.KodeAreaCabang, c.NamaAreaCabang		 	
					";				
		$query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$this->view->result2 = $query2->fetchAll($query2);
		
	    $date = date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
		$cabangid = $this->_validateCabang($this->request->getPost('Cabang'));
      //  $cabangid = $this->request->getPost('Cabang');
	
	 

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

