<?php

class RptrekapsiswabnykareaController extends ControllerBase
{

    protected $auth;

    protected $sql = <<<SQL
	SELECT A.NamaAreaCabang AS NamaArea, C.KodeAreaCabang AS KodeCabang, C.NamaAreaCabang AS NamaCabang
	,ISNULL(SISSUM.JumlahSiswa,0) AS jum_a
	,ISNULL(PBSUM.JumlahSettle,0) AS jum_b
	,ISNULL(PBSUM.nilai_a,0) AS nilai_a
	,ISNULL(PBSUM.nilai_b,0) AS nilai_b
	FROM areacabang A
	JOIN areacabang C ON A.KodeAreaCabang = C.Area
	LEFT JOIN (
	SELECT s.Cabang
		,COUNT(DISTINCT CASE WHEN CAST(s.CreatedAt AS date) BETWEEN '%0' AND '%1' THEN s.RecID END) AS JumlahSiswa
	FROM siswa s
	GROUP BY s.Cabang) SISSUM ON C.RecID = SISSUM.Cabang

	LEFT JOIN (
	SELECT s.Cabang
		,COUNT(DISTINCT CASE WHEN CAST(pd.TanggalPembayaran AS date) BETWEEN '%0' AND '%1' AND pd.Status='1' THEN pd.RecID END) AS JumlahSettle
		,ISNULL(SUM(CASE WHEN pd.PembayaranUntuk = 'Bimbingan' AND CAST(pd.TanggalPembayaran AS date) BETWEEN '%0' AND '%1' THEN pd.Jumlah END),0) AS nilai_a		
		,ISNULL(SUM(CASE WHEN CAST(tx.TanggalTransaksi AS date) BETWEEN '%0' AND '%1' THEN tx.Nominal END),0) AS nilai_b
	FROM siswa s
	JOIN programsiswa ps ON s.RecID = ps.Siswa
	JOIN pembayaran pb ON ps.RecID = pb.ProgramSiswa
	JOIN pembayarandetail pd ON pb.RecID = pd.Pembayaran
	LEFT JOIN transaksibank tx on pd.RecID = tx.RefRecID
	GROUP BY s.Cabang) PBSUM
	ON C.RecID = PBSUM.Cabang
	WHERE A.KodeAreaCabang LIKE '%%2%' AND A.Area IS NULL AND C.Aktif = 1
	ORDER BY KodeCabang
SQL;

/* 
SELECT 
     a.NamaAreaCabang AS NamaArea, rtrim(c.KodeAreaCabang) AS KodeCabang, c.NamaAreaCabang AS NamaCabang
    ,ISNULL(SUM(CASE WHEN pd.PembayaranUntuk = 'Bimbingan' AND pd.TanggalPembayaran >= '%0' AND pd.TanggalPembayaran <= '%1' THEN pd.Jumlah END),0) AS nilai_a
		,COUNT( DISTINCT (rtrim(c.KodeAreaCabang) + s.VirtualAccount)) AS jum_a		
		,ISNULL(SUM(CASE WHEN tx.TanggalTransaksi >= '%0' AND tx.TanggalTransaksi <= '%1' THEN tx.Nominal END),0) AS nilai_b
		,COUNT( DISTINCT (rtrim(tx.NoVA))) AS jum_b
	FROM areacabang a
	JOIN areacabang c on a.KodeAreaCabang = c.Area
	JOIN siswa s on c.RecID = s.Cabang
	JOIN programsiswa ps on s.RecID = ps.Siswa
	JOIN pembayaran pb on ps.RecID = pb.ProgramSiswa
	JOIN pembayarandetail pd on pb.RecID = pd.Pembayaran
	LEFT JOIN transaksibank tx on pd.RecID = tx.RefRecID
	WHERE c.Aktif = 1 AND CAST(s.CreatedAt as date) >= '%0' AND CAST(s.CreatedAt as date) <= '%1' AND pb.SisaPembayaran > 0 AND a.KodeAreaCabang LIKE '%%2%' 
	GROUP BY
		 a.NamaAreaCabang, c.KodeAreaCabang, c.NamaAreaCabang
	ORDER BY KodeCabang

*/
    public function initialize() {
        $this->tag->setTitle('Laporan Cash Flow Cabang');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
    }

    public function indexAction() {
		$this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('AreaID', $this->auth['kodeareacabang']);
		
        $this->view->rpt_auth = $this->auth;
    }

    public function viewAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('rptrekapsiswabnykarea/index');
        }
        $datefrom = $this->request->getPost('DateFrom', 'int') ? : date('Y-m-d');
        $dateto = $this->request->getPost('DateTo', 'int') ? : date('Y-m-d');
		$areaid = $this->_validateArea($this->request->getPost('AreaID'));

		$sql = str_replace(['%0', '%1', '%2'], [$datefrom, $dateto, $areaid], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
		
       /*  $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->rpt_title = 'Laporan Jumlah Siswa Terbanyak Per Area}';
        $this->view->periode = date('d/m/Y', strtotime($datefrom)).' - '.date('d/m/Y', strtotime($dateto));
        $this->view->result = $query->fetchAll($query );*/

		$this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->rpt_title = 'Laporan Cash Flow Cabang Per Area';
        $this->view->periode = date('d/m/Y', strtotime($datefrom)).' - '.date('d/m/Y', strtotime($dateto));
        $this->view->result = $query->fetchAll($query);
        $area = Areacabang::findFirst(["Area IS NULL AND KodeAreaCabang = ?0", "bind" => [0 => $areaid]]);
        $this->view->area = $areaid ? $area->NamaAreaCabang : 'All';	
    }
	
	private function _validateArea($areaid) {
        if ($this->auth['areaparent']) {
            return NULL;
        } else if ($this->auth['areacabang']) {
            return $this->auth['kodeareacabang'];
        } else {
            return $areaid ? : NULL;
        }
    }
}