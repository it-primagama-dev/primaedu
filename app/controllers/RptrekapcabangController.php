<?php

class RptrekapcabangController extends ControllerBase
{

    protected $auth;

    protected $sql_ = <<<SQL
SELECT   A.RecID AS AreaID, A.KodeAreaCabang AS KodeArea, A.NamaAreaCabang AS NamaArea
	,C.RecID AS CabangID, C.KodeAreaCabang AS KodeCabang, C.NamaAreaCabang AS NamaCabang
	,ISNULL(PBSUM.JumlahSiswaLalu,0) AS JumlahSiswaLalu, ISNULL(PBSUM.JumlahSiswa,0) AS JumlahSiswa
	,ISNULL(PBSUM.PendaftaranLalu,0) AS PendaftaranLalu, ISNULL(PBSUM.Pendaftaran,0) AS Pendaftaran
	,ISNULL(PBSUM.BimbinganLalu,0) AS BimbinganLalu, ISNULL(PBSUM.Bimbingan,0) AS Bimbingan
FROM areacabang A
JOIN areacabang C ON A.KodeAreaCabang = C.Area
LEFT JOIN (
SELECT s.Cabang
	,COUNT(DISTINCT CASE WHEN CAST(s.CreatedAt AS date) < '%0' THEN s.RecID END) AS JumlahSiswaLalu
	,COUNT(DISTINCT CASE WHEN CAST(s.CreatedAt AS date) BETWEEN '%0' AND '%1' THEN s.RecID END) AS JumlahSiswa
	,SUM(CASE WHEN pd.PembayaranUntuk = 'Pendaftaran' AND pd.TanggalPembayaran < '%0' THEN pd.Jumlah END) AS PendaftaranLalu
	,SUM(CASE WHEN pd.PembayaranUntuk = 'Pendaftaran' AND pd.TanggalPembayaran BETWEEN '%0' AND '%1' THEN pd.Jumlah END) AS Pendaftaran
	,SUM(CASE WHEN pd.PembayaranUntuk = 'Bimbingan' AND pd.TanggalPembayaran < '%0' THEN pd.Jumlah END) AS BimbinganLalu
	,SUM(CASE WHEN pd.PembayaranUntuk = 'Bimbingan' AND pd.TanggalPembayaran BETWEEN '%0' AND '%1' THEN pd.Jumlah END) AS Bimbingan
FROM siswa s
JOIN programsiswa ps ON s.RecID = ps.Siswa
JOIN pembayaran pb ON ps.RecID = pb.ProgramSiswa
JOIN pembayarandetail pd ON pb.RecID = pd.Pembayaran
GROUP BY s.Cabang) PBSUM
ON C.RecID = PBSUM.Cabang
WHERE A.KodeAreaCabang LIKE '%%2%' AND A.Area IS NULL AND C.Aktif = 1
ORDER BY KodeArea, KodeCabang
SQL;

protected $sql = <<<SQL
SELECT   A.RecID AS AreaID, A.KodeAreaCabang AS KodeArea, A.NamaAreaCabang AS NamaArea
	,C.RecID AS CabangID, C.KodeAreaCabang AS KodeCabang, C.NamaAreaCabang AS NamaCabang
	,ISNULL(PBSUM.JumlahSiswaLalu,0) AS JumlahSiswaLalu, ISNULL(PBSUM.JumlahSiswa,0) AS JumlahSiswa
	,ISNULL(PBSUM.PendaftaranLalu,0) AS PendaftaranLalu, ISNULL(PBSUM.Pendaftaran,0) AS Pendaftaran
	,ISNULL(PBSUM.BimbinganLalu,0) AS BimbinganLalu, ISNULL(PBSUM.Bimbingan,0) AS Bimbingan
FROM areacabang A
JOIN areacabang C ON A.KodeAreaCabang = C.Area
LEFT JOIN (
SELECT s.Cabang
	,COUNT(DISTINCT CASE WHEN CAST(s.CreatedAt AS date) < '%0' THEN s.RecID END) AS JumlahSiswaLalu
	,COUNT(DISTINCT CASE WHEN CAST(s.CreatedAt AS date) BETWEEN '%0' AND '%1' THEN s.RecID END) AS JumlahSiswa
	,SUM(CASE WHEN pd.PembayaranUntuk = 'Pendaftaran' AND pd.TanggalPembayaran < '%0' THEN pd.Jumlah END) AS PendaftaranLalu
	,SUM(CASE WHEN pd.PembayaranUntuk = 'Pendaftaran' AND pd.TanggalPembayaran BETWEEN '%0' AND '%1' THEN pd.Jumlah END) AS Pendaftaran
	,SUM(
		CASE 
			WHEN 
				pd.PembayaranUntuk = 'Bimbingan' 
				AND pd.TanggalPembayaran < '%0' 
				--AND pd.Jumlah != NULL
			THEN
				CAST(pd.Jumlah AS bigint)
		END) AS BimbinganLalu,
	SUM(
		CASE 
			WHEN 
				pd.PembayaranUntuk = 'Bimbingan' 
				AND pd.TanggalPembayaran BETWEEN '%0' AND '%1' 
			THEN 
				CAST(pd.Jumlah AS bigint)
		END) AS Bimbingan 
FROM siswa s
JOIN programsiswa ps ON s.RecID = ps.Siswa
JOIN pembayaran pb ON ps.RecID = pb.ProgramSiswa
JOIN pembayarandetail pd ON pb.RecID = pd.Pembayaran
GROUP BY s.Cabang) PBSUM
ON C.RecID = PBSUM.Cabang
WHERE A.KodeAreaCabang LIKE '%%2%' AND A.Area IS NULL AND C.Aktif = 1
ORDER BY KodeArea, KodeCabang
SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan Kinerja Cabang');
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
            return $this->forward('rptrekapcabang/index');
        }
        $datefrom = $this->request->getPost('DateFrom', 'int') ? : date('Y-m-d');
        $dateto = $this->request->getPost('DateTo', 'int') ? : date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('AreaID'));

        $sql = str_replace(['%0', '%1', '%2'], [$datefrom, $dateto, $areaid], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->rpt_title = 'Laporan Kinerja Cabang';
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

