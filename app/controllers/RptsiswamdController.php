<?php

class RptsiswamdController extends ControllerBase
{

    protected $auth;

   

    public function initialize() {
        $this->tag->setTitle('Piutang Tak Tertagih');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Piutang Tak Tertagih';
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
            return $this->forward('rptsiswacabang/index');
        }

        $tahun = $this->request->getPost('tahun');
        $cabang = $this->request->getPost('Cabang');
		if ($cabang==''){
			$cabang = $this->auth['areacabang'];
		}


        
		
        $sql = "select siswa.VirtualAccount,Siswa.MD, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, 
                tahunajaran.Description, (pembayaran.JumlahTotal-pembayarandetail.Jumlah) as
				JumlahTotal,
                (select sum(transaksibank.Nominal) as Uang_masuk from transaksibank where transaksibank.Siswa = siswa.RecID and 
				tahunajaran=$tahun) as Uang_masuk
                From Siswa

                Join programsiswa ON siswa.RecID = programsiswa.siswa
                Join program ON program.RecID = programsiswa.program
                Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
                Join pembayaran ON pembayaran.ProgramSiswa = programsiswa.RecID
				join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
                Join areacabang ON areacabang.RecID = siswa.cabang
               Where program.tahunajaran = $tahun and siswa.cabang =$cabang and siswa.MD= '0'
			   and pembayarandetail.pembayaranuntuk='Pendaftaran'
                group by siswa.VirtualAccount,Siswa.MD,pembayaran.JumlahTotal, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, siswa.RecID,
                tahunajaran.Description,pembayarandetail.Jumlah";
		 $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$this->view->result = $query->fetchAll($query);
				
			    
			 $sql1 = "select sum(Nominal) Nominal from feemanagement join areacabang on feemanagement.KodeCabang=areacabang.KodeAreaCabang
					where areacabang.RecID=$cabang and feemanagement.keterangan='$tahun'";
		

      
		
		$query1 = $this->getDI()->getShared('db')->query($sql1);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$this->view->result1 = $query1->fetchAll($query1);

        
        

        $date = date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));
	

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $area ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabang ? $cabang->KodeNamaAreaCabang : 'All';
        $tahunajaran = Tahunajaran::findFirstByRecID($tahun);
        $this->view->rpt_tahun = $tahun ? $tahunajaran->Description : 'all';

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

