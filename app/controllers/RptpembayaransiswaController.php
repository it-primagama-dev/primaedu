<?php

class RptpembayaransiswaController extends ReportBase
{

    protected $sql = <<<SQL
SELECT a.NamaAreaCabang AS NamaArea, rtrim(c.KodeAreaCabang) AS KodeCabang, 
	      c.NamaAreaCabang AS NamaCabang,rtrim(c.KodeAreaCabang) + s.VirtualAccount AS NIS,
		s.NamaSiswa AS NamaSiswa, j.NamaJenjang AS Jenjang,tx.TanggalTransaksi,
		pb.JumlahTotal, tx.Nominal as sudahdibayar, tx.RefRecID
	 ,pb.SisaPembayaran as piutangsiswa,pb.PembayaranTipe,pb.AngsuranKe
	from transaksibank tx 
	JOIN siswa s on s.RecID = tx.Siswa
	JOIN programsiswa ps ON s.RecID = ps.Siswa
	JOIN pembayaran pb ON ps.RecID = pb.ProgramSiswa
	JOIN areacabang c on s.Cabang = c.RecID
	JOIN areacabang a on a.KodeAreaCabang = c.Area
	JOIN program p on ps.Program = p.RecID
	JOIN jenjang j on p.Jenjang = j.KodeJenjang
	WHERE c.Aktif = 1  AND CAST(s.CreatedAt as date) <= '%1' %0
	order by  KodeCabang, NIS ASC
SQL;
/* SELECT 
     a.NamaAreaCabang AS NamaArea, rtrim(c.KodeAreaCabang) AS KodeCabang, c.NamaAreaCabang AS NamaCabang
    ,rtrim(c.KodeAreaCabang) + s.VirtualAccount AS NIS
    ,s.NamaSiswa AS NamaSiswa, j.NamaJenjang AS Jenjang
    ,SUM(DISTINCT pb.JumlahTotal) - SUM(CASE WHEN pd.PembayaranUntuk = 'Pendaftaran' THEN pd.Jumlah END) AS BiayaBimbingan
    ,ISNULL(SUM(CASE WHEN pd.PembayaranUntuk = 'Bimbingan' AND pd.TanggalPembayaran <= '%1' THEN pd.Jumlah END),0) AS TotalPembayaran
    ,(SUM(DISTINCT pb.JumlahTotal) - SUM(CASE WHEN pd.PembayaranUntuk = 'Pendaftaran' THEN pd.Jumlah END))
     - ISNULL(SUM(CASE WHEN pd.PembayaranUntuk = 'Bimbingan' AND pd.TanggalPembayaran <= '%1' THEN pd.Jumlah END),0) AS TotalPiutang
    ,ISNULL(SUM(CASE WHEN tx.TanggalTransaksi <= '%1' THEN tx.Nominal END),0) AS TotalPembayaranVA
FROM areacabang a
JOIN areacabang c on a.KodeAreaCabang = c.Area
JOIN siswa s on c.RecID = s.Cabang
JOIN programsiswa ps on s.RecID = ps.Siswa
JOIN program p on ps.Program = p.RecID
JOIN jenjang j on p.Jenjang = j.KodeJenjang
JOIN pembayaran pb on ps.RecID = pb.ProgramSiswa
JOIN pembayarandetail pd on pb.RecID = pd.Pembayaran
LEFT JOIN transaksibank tx on pd.RecID = tx.RefRecID
WHERE c.Aktif = 1 AND CAST(s.CreatedAt as date) <= '%1' AND pb.SisaPembayaran > 0 %0
GROUP BY
     a.NamaAreaCabang, c.KodeAreaCabang, c.NamaAreaCabang
    ,s.VirtualAccount, s.NamaSiswa, j.NamaJenjang
ORDER BY KodeCabang, NIS */

    public function initialize() {
        $this->tag->setTitle('Laporan Pembayaran Siswa');
        parent::initialize();
        $this->view->rpt_title = 'Laporan Pembayaran Siswa';
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
                ->where("Areacabang.RecID = :area: AND Aktif = 1")
                ->orderBy("c.KodeAreaCabang")
                ->bind(["area" => $this->filter->sanitize($area, "int")])
                ->execute();
        echo '<option value="">---</option>';
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
            return $this->forward('rptpembayaransiswa/index');
        }
        $date = $this->request->getPost('Date', 'int') ? : date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));

        $sql = str_replace(
                ['%0', '%1'], [$this->_getCriteria($areaid, $cabangid, FALSE), $date], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = date('d/m/Y', strtotime($date));
        $this->view->result = $query->fetchAll($query);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';

    }
}
