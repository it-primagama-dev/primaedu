<?php 
 
class RptsiswapiutangcabangController extends ReportBase
{

    protected $sql = <<<SQL
SELECT VirtualAccount as NIS,NamaSiswa,Jenjang.NamaJenjang, NamaBank,TanggalTransaksi,
/* SUBSTRING(transaksibank.NoVA,5,8) as Virtual_Account, */
(select top 1 JumlahTotal-pembayarandetail.Jumlah from pembayaran 
join programsiswa on programsiswa.recid=pembayaran.ProgramSiswa
join program on program.RecID=programsiswa.Program
join tahunajaran on tahunajaran.RecID=program.tahunajaran
join pembayarandetail on pembayaran.recid=pembayarandetail.pembayaran
where programsiswa.Siswa=siswa.RecID and pembayarandetail.pembayaranuntuk='Pendaftaran' ) as BiayaBimbingan,
isnull(transaksibank.Nominal,0) as Nominal,
(select top 1 isnull(jumlah,0) as uang from pembayarandetail 
join pembayaran on pembayaran.RecID=pembayarandetail.Pembayaran 
join programsiswa on programsiswa.RecID=pembayaran.ProgramSiswa 
join program on program.RecID= programsiswa.Program
join tahunajaran on tahunajaran.RecID=program.tahunajaran
where programsiswa.Siswa =siswa.RecID and pembayaranmetode=8 ) as diskon,
--koreksi--
CASE WHEN refund.NoVaBenar = concat(ltrim(rtrim(areacabang.KodeAreaCabang)), Siswa.VirtualAccount) 
AND refund.TrackFinance = 'Approved' AND refund.TrackGM = 'Approved' THEN refund.Selisih 
WHEN refund.NovaSalah = concat(ltrim(rtrim(areacabang.KodeAreaCabang)), siswa.VirtualAccount) 
AND refund.TrackFinance = 'Approved' AND refund.TrackGM = 'Approved' THEN refund.Nominal ELSE 0 END AS koreksi,
--Keterangan--
CASE WHEN refund.NovaSalah = concat(ltrim(rtrim(areacabang.KodeAreaCabang)), siswa.VirtualAccount) 
AND refund.TrackFinance = 'Approved' AND refund.TrackGM = 'Approved' THEN concat('Refund kesalahan transfer ', refund.NoVaBenar)
WHEN refund.NoVaBenar = concat(ltrim(rtrim(areacabang.KodeAreaCabang)), siswa.VirtualAccount) AND refund.TrackFinance = 'Approved' 
AND refund.TrackGM = 'Approved' AND refund.Selisih IS NOT NULL THEN 'refund kelebihan nominal' 
WHEN refund.NoVaBenar = concat(ltrim(rtrim(areacabang.KodeAreaCabang)), siswa.VirtualAccount) AND refund.TrackFinance = 'Approved' 
AND refund.TrackGM = 'Approved' AND refund.Selisih IS NULL THEN '' END AS Keterangan,
case when siswa.MD=0 then 'Ya' else 'Tidak' end as MD
FROM transaksibank
join areacabang on areacabang.KodeAreaCabang=transaksibank.KodeCabang 
join siswa on areacabang.RecID=siswa.Cabang 
join jenjang on siswa.Jenjang=jenjang.KodeJenjang
LEFT OUTER JOIN dbo.refund ON dbo.refund.NoVaBenar = { fn CONCAT(LTRIM(RTRIM(dbo.areacabang.KodeAreaCabang)),
 dbo.siswa.VirtualAccount) } AND dbo.refund.TrackFinance = 'Approved' AND dbo.refund.TrackGM = 'Approved' 
/* AND dbo.refund.TanggalTransfer = dbo.transaksibank.TanggalTransaksi */
AND dbo.refund.Selisih IS NOT NULL AND
dbo.refund.TahunAjaran = dbo.transaksibank.tahunajaran AND dbo.refund.LebihNominal = dbo.transaksibank.Nominal 
OR dbo.refund.NoVaSalah = { fn CONCAT(LTRIM(RTRIM(dbo.areacabang.KodeAreaCabang)), dbo.siswa.VirtualAccount) } 
AND dbo.refund.TrackFinance = 'Approved' AND dbo.refund.TrackGM = 'Approved' 
/* AND dbo.refund.TanggalTransfer = dbo.transaksibank.TanggalTransaksi */
AND dbo.refund.TahunAjaran = dbo.transaksibank.tahunajaran 
AND dbo.refund.Nominal = dbo.transaksibank.Nominal OR dbo.refund.NoVaBenar = { fn CONCAT(LTRIM(RTRIM(dbo.areacabang.KodeAreaCabang)),
dbo.siswa.VirtualAccount) } AND dbo.refund.TrackFinance = 'Approved' AND dbo.refund.TrackGM = 'Approved' 
WHERE KodeCabang='0009' and transaksibank.siswa = siswa.RecID order by VirtualAccount 


SQL;

    public function initialize() {
        $this->tag->setTitle('Cash In Siswa');
        parent::initialize();
        $this->view->rpt_title = 'Cash In Siswa';
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
		
        
		
        $date = date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validatecabang($_GET["cabang"]);
		$cabang = Areacabang::findFirstByRecID($cabangid);
		
		
        $sql = str_replace(
                ['0009'],[$cabang->KodeAreaCabang], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);



        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = date('d/m/Y', strtotime($date));
        $this->view->result = $query->fetchAll($query);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $KodeNamaAreaCabang : 'all';
		
    }
}
