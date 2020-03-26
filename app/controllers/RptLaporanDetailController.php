<?php

class RptLaporanDetailController extends ReportBase
{

    protected $sql = <<<SQL

	select areacabang.RecID, a.NamaAreaCabang,areacabang.KodeAreaCabang,areacabang.NamaAreaCabang, 
    count(siswa.RecID) as total_siswa,
(select count(siswa.RecID) from siswa
join programsiswa on siswa.RecID=programsiswa.Siswa
Join program ON program.RecID = programsiswa.program
 Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
where program.tahunajaran = '%2' and siswa.MD =0 and siswa.cabang = areacabang.RecID
) as MD, (select count(siswa.RecID) from siswa
join programsiswa on siswa.RecID=programsiswa.Siswa
Join program ON program.RecID = programsiswa.program
 Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
where program.tahunajaran = '%2' and siswa.MD =1 and siswa.cabang = areacabang.RecID
) as aktif,
   sum (pembayaran.JumlahTotal-pembayarandetail.Jumlah)as total_hutang, (select isnull(sum(Nominal),0) as Uang_masuk from transaksibank
  -- join areacabang on transaksibank.KodeCabang= areacabang.KodeAreaCabang
    where transaksibank.KodeCabang = areacabang.KodeAreaCabang and transaksibank.tahunajaran = program.tahunajaran
   and len(NoReferensi) = 11 or Auth_Cd is not null and transaksibank.KodeCabang = areacabang.KodeAreaCabang and transaksibank.tahunajaran = program.tahunajaran) as Uang_masuk,
  sum (isnull(pembayaran.JumlahTotal,0)-isnull(pembayarandetail.Jumlah,0))- (select isnull(sum(Nominal),0) as Uang_masuk from transaksibank
    where transaksibank.KodeCabang = areacabang.KodeAreaCabang and transaksibank.tahunajaran = program.tahunajaran) as hutang_siswa
     ,areacabang.TanggalBerlaku as tanggalberlaku,
   areacabang.TanggalBerakhir as tanggalberakhir
  from pembayaran
  join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
join programsiswa on ProgramSiswa.RecID=pembayaran.ProgramSiswa
 join siswa on siswa.RecID=programsiswa.Siswa
 Join program ON program.RecID = programsiswa.program
 Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
 join areacabang on areacabang.RecID=siswa.Cabang
join areacabang b on siswa.Cabang= b.RecID
join areacabang a on areacabang.Area = a.KodeAreaCabang
where  pembayarandetail.PembayaranUntuk='Pendaftaran' and a.KodeAreaCabang='uuu' and program.tahunajaran = '%2'
group by  areacabang.KodeAreaCabang,areacabang.NamaAreaCabang,a.NamaAreaCabang,siswa.Cabang, areacabang.TanggalBerlaku, areacabang.TanggalBerakhir
,areacabang.RecID, program.tahunajaran, a.KodeAreaCabang, a.RecID order by   areacabang.KodeAreaCabang,areacabang.NamaAreaCabang


SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan detail');
        parent::initialize();
        $this->view->rpt_title = 'Laporan detail';
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
            return $this->forward('rptLaporanDetail/index');
        }
       
        $areaid = $this->request->getPost('Area');
		$cabang = Areacabang::findFirstByRecID($areaid);
		$area= $cabang->KodeAreaCabang;
		$tahun = $this->request->getPost('tahun');
		$tahunajr = tahunajaran::findFirstByRecID($tahun);
		$tahun1=$tahunajr->RecID;
		
        $sql = str_replace(['uuu','%2'],[$area,$tahun1], $this->sql);
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
        $this->view->username = $this->auth['username'];
        $tahunajarans = Tahunajaran::findFirstByRecID($tahun);
        $this->view->rpt_tahunid = $tahun ? $tahunajarans->RecID : 'all';
    }
}