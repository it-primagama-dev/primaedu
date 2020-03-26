<?php

class RptrekapitulasiController extends ControllerBase
{

    protected $auth;


    public function initialize() {
        $this->tag->setTitle('Laporan Rekapitulasi Area');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Laporan Rekapitulasi Area';
        $this->view->rpt_img = '<img src=../img/logo_new_web.png width=220>';

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

    public function viewAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('rptrekapitulasi/index');
        }
   
		$tahun    = $this->request->getPost('Tahun');
        $areaid   = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));



		if($this->request->getPost('Area')){

		$sql="SELECT  a.KodeAreaCabang, a.NamaAreaCabang
			,PBSUM.Bimbingan,PIUSUM.piutang,TRANSSUM.total as PembayaranBCA
			FROM areacabang a
			JOIN areacabang c ON a.KodeAreaCabang = c.Area
			LEFT JOIN (
					SELECT a.KodeAreaCabang, a.NamaAreaCabang, SUM(pd.SisaPembayaran) AS Bimbingan
					 ,SUM(DISTINCT pb.SisaPembayaran) AS TotalPiutang	 
					FROM pembayaran pb
					JOIN pembayarandetail pd ON pd.Pembayaran = pb.RecID
					JOIN programsiswa ps ON ps.RecID = pb.ProgramSiswa
					JOIN siswa s ON s.RecID = ps.Siswa
					JOIN areacabang c ON c.RecID = s.Cabang
					JOIN areacabang a ON a.KodeAreaCabang = c.Area
					WHERE pd.PembayaranUntuk = 'Pendaftaran' 
					Group BY a.KodeAreaCabang,a.NamaAreaCabang
					  ) PBSUM
					ON a.KodeAreaCabang = PBSUM.KodeAreaCabang
			JOIN(
					SELECT a.KodeAreaCabang, a.NamaAreaCabang,
					SUM(pb.SisaPembayaran)as piutang
					FROM transaksibank tx
					JOIN siswa s ON s.RecID=tx.Siswa
					JOIN areacabang c ON c.KodeAreaCabang = tx.KodeCabang
					JOIN areacabang a ON a.KodeAreaCabang = c.Area
					JOIN programsiswa ps ON ps.Siswa = s.RecID
					JOIN pembayaran pb ON pb.ProgramSiswa = ps.RecID
					JOIN pembayarandetail pd ON pd.Pembayaran = pb.RecID
					WHERE pd.PembayaranUntuk = 'Pendaftaran' 
					Group BY a.KodeAreaCabang, a.NamaAreaCabang
				) PIUSUM ON a.KodeAreaCabang = PIUSUM.KodeAreaCabang
			
			LEFT JOIN(
					SELECT a.KodeAreaCabang, a.NamaAreaCabang
				,SUM(DISTINCT pb.JumlahTotal) - SUM(CASE WHEN pd.PembayaranUntuk = 'Pendaftaran'  THEN pd.Jumlah END) AS BiayaBimbingan
						,ISNULL(SUM(CASE WHEN pd.PembayaranUntuk = 'Bimbingan' THEN pd.Jumlah END),0) AS TotalPembayaran		
						 , SUM(DISTINCT pb.SisaPembayaran) AS TotalPiutang	
						,SUM(tx.Nominal) AS TotalPembayaranVA
					FROM siswa s
					JOIN programsiswa ps ON s.RecID = ps.Siswa
					JOIN pembayaran pb ON ps.RecID = pb.ProgramSiswa
					JOIN pembayarandetail pd ON pb.RecID = pd.Pembayaran
					LEFT JOIN transaksibank tx on pd.RecID = tx.RefRecID
					JOIN areacabang c ON c.KodeAreaCabang = tx.KodeCabang
					JOIN areacabang a ON a.KodeAreaCabang = c.Area
					Group BY a.KodeAreaCabang, a.NamaAreaCabang	
				) 	SUMSIS ON A.KodeAreaCabang= SUMSIS.KodeAreaCabang
			
			LEFT JOIN (
						select a.KodeAreaCabang, a.NamaAreaCabang, sum(tb.Nominal) as total 
						from transaksibank tb
						join areacabang c on c.KodeAreaCabang = tb.KodeCabang
						join areacabang a on a.KodeAreaCabang = c.Area
						Group BY a.KodeAreaCabang, a.NamaAreaCabang	
					    )TRANSSUM ON a.KodeAreaCabang = TRANSSUM.KodeAreaCabang
			
			WHERE a.Area IS NULL AND c.Aktif = 1 AND a.RecID = '$areaid'
					Group by a.KodeAreaCabang, a.NamaAreaCabang,PBSUM.Bimbingan,PIUSUM.piutang,TRANSSUM.total";
	

		//  $sql = "SELECT * FROM areacabang WHERE Aktif = 1 AND RecID = '$areaid'";
		  
		  
		  

	/*	echo  $sql ="SELECT *
				FROM areacabang a
				JOIN areacabang c on a.KodeAreaCabang = c.Area
				WHERE c.Aktif = 1  AND c.RecID = '$cabangid'
				ORDER BY c.KodeAreaCabang ASC";
	*/
		}else{

		$sql="SELECT  a.KodeAreaCabang, a.NamaAreaCabang
			,PBSUM.Bimbingan,PIUSUM.piutang,TRANSSUM.total as PembayaranBCA
			FROM areacabang a
			JOIN areacabang c ON a.KodeAreaCabang = c.Area
			LEFT JOIN (
					SELECT a.KodeAreaCabang, a.NamaAreaCabang, SUM(pd.SisaPembayaran) AS Bimbingan
					 ,SUM(DISTINCT pb.SisaPembayaran) AS TotalPiutang	 
					FROM pembayaran pb
					JOIN pembayarandetail pd ON pd.Pembayaran = pb.RecID
					JOIN programsiswa ps ON ps.RecID = pb.ProgramSiswa
					JOIN siswa s ON s.RecID = ps.Siswa
					JOIN areacabang c ON c.RecID = s.Cabang
					JOIN areacabang a ON a.KodeAreaCabang = c.Area
					WHERE pd.PembayaranUntuk = 'Pendaftaran' 
					Group BY a.KodeAreaCabang,a.NamaAreaCabang
					  ) PBSUM
					ON a.KodeAreaCabang = PBSUM.KodeAreaCabang
			JOIN(
					SELECT a.KodeAreaCabang, a.NamaAreaCabang,
					SUM(pb.SisaPembayaran)as piutang
					FROM transaksibank tx
					JOIN siswa s ON s.RecID=tx.Siswa
					JOIN areacabang c ON c.KodeAreaCabang = tx.KodeCabang
					JOIN areacabang a ON a.KodeAreaCabang = c.Area
					JOIN programsiswa ps ON ps.Siswa = s.RecID
					JOIN pembayaran pb ON pb.ProgramSiswa = ps.RecID
					JOIN pembayarandetail pd ON pd.Pembayaran = pb.RecID
					WHERE pd.PembayaranUntuk = 'Pendaftaran' 
					Group BY a.KodeAreaCabang, a.NamaAreaCabang
				) PIUSUM ON a.KodeAreaCabang = PIUSUM.KodeAreaCabang
			
			LEFT JOIN(
					SELECT a.KodeAreaCabang, a.NamaAreaCabang
				,SUM(DISTINCT pb.JumlahTotal) - SUM(CASE WHEN pd.PembayaranUntuk = 'Pendaftaran'  THEN pd.Jumlah END) AS BiayaBimbingan
						,ISNULL(SUM(CASE WHEN pd.PembayaranUntuk = 'Bimbingan' THEN pd.Jumlah END),0) AS TotalPembayaran		
						 , SUM(DISTINCT pb.SisaPembayaran) AS TotalPiutang	
						,SUM(tx.Nominal) AS TotalPembayaranVA
					FROM siswa s
					JOIN programsiswa ps ON s.RecID = ps.Siswa
					JOIN pembayaran pb ON ps.RecID = pb.ProgramSiswa
					JOIN pembayarandetail pd ON pb.RecID = pd.Pembayaran
					LEFT JOIN transaksibank tx on pd.RecID = tx.RefRecID
					JOIN areacabang c ON c.KodeAreaCabang = tx.KodeCabang
					JOIN areacabang a ON a.KodeAreaCabang = c.Area
					Group BY a.KodeAreaCabang, a.NamaAreaCabang	
				) 	SUMSIS ON A.KodeAreaCabang= SUMSIS.KodeAreaCabang
			
			LEFT JOIN (
						select a.KodeAreaCabang, a.NamaAreaCabang, sum(tb.Nominal) as total 
						from transaksibank tb
						join areacabang c on c.KodeAreaCabang = tb.KodeCabang
						join areacabang a on a.KodeAreaCabang = c.Area
						Group BY a.KodeAreaCabang, a.NamaAreaCabang	
					    )TRANSSUM ON a.KodeAreaCabang = TRANSSUM.KodeAreaCabang
			
			WHERE a.Area IS NULL AND c.Aktif = 1
					Group by a.KodeAreaCabang, a.NamaAreaCabang,PBSUM.Bimbingan,PIUSUM.piutang,TRANSSUM.total";
	

		//  $sql = "SELECT * FROM areacabang WHERE Aktif = 1 AND Area is NULL ";
		  
		  

	/*	 echo $sql = "SELECT *
				FROM areacabang a
				JOIN areacabang c on a.KodeAreaCabang = c.Area
				WHERE c.Aktif = 1  AND c.RecID = '$cabangid'  OR a.RecID = '$areaid'
				ORDER BY c.KodeAreaCabang ASC";
	*/
		}


        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = date('d/m/Y', strtotime($datefrom)).' - '.date('d/m/Y', strtotime($dateto));
        
	//	$this->view->result = $query->fetchAll($query);
		
		$result2 = $query->fetchAll($query);
		$this->view->result = $result2;
	
		 $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';	
		
	
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
