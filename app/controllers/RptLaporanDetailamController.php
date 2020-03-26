<?php

class RptLaporanDetailamController extends ReportBase
{

    protected $sql = <<<SQL

select (select sum(Jumlah)
from pembayarandetail 
join pembayaran on pembayaran.RecID=pembayarandetail.Pembayaran
join programsiswa on programsiswa.RecID=pembayaran.ProgramSiswa
join program on program.RecID= programsiswa.Program
join tahunajaran on tahunajaran.RecID=program.tahunajaran
join siswa on siswa.RecID=programsiswa.Siswa
Join areacabang ON areacabang.RecID = siswa.cabang
where pembayaranmetode='8' and siswa.Cabang=cte.RecID and program.tahunajaran = '%2') as diskon,
 RecID,NamaAreaCabang,KodeAreaCabang,namacb,total_siswa,hutang_MD,TanggalBerlaku,TanggalBerakhir,Uang_masuk,hutang_siswa,
(select sum (pembayaran.JumlahTotal-pembayarandetail.Jumlah)as hutang_MD1 from pembayaran
join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
join programsiswa on ProgramSiswa.RecID=pembayaran.ProgramSiswa
join siswa on siswa.RecID=programsiswa.Siswa
Join program ON program.RecID = programsiswa.program
Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
join areacabang on areacabang.RecID=siswa.Cabang
join areacabang b on siswa.Cabang= b.RecID
join areacabang a on areacabang.Area = a.KodeAreaCabang
where areacabang.Aktif='1' and pembayarandetail.PembayaranUntuk='Pendaftaran' 
and a.KodeAreaCabang='uuu' and program.tahunajaran = '%2' and siswa.MD='0' and areacabang.RecID=cte.RecID
group by  areacabang.KodeAreaCabang,areacabang.NamaAreaCabang,a.NamaAreaCabang,siswa.Cabang
,areacabang.RecID, program.tahunajaran, a.KodeAreaCabang) as hutangg
from
(select areacabang.RecID, a.NamaAreaCabang,areacabang.KodeAreaCabang,areacabang.NamaAreaCabang as namacb, 
count(siswa.RecID) as total_siswa,
sum (pembayaran.JumlahTotal-pembayarandetail.Jumlah)as hutang_MD,
(select isnull(sum(Nominal),0) as Uang_masuk from transaksibank
 -- join areacabang on transaksibank.KodeCabang= areacabang.KodeAreaCabang
where transaksibank.KodeCabang = areacabang.KodeAreaCabang 
and transaksibank.tahunajaran = program.tahunajaran
and len(NoReferensi) != 4 and len(NoReferensi) != 6) as Uang_masuk,
sum (isnull(pembayaran.JumlahTotal,0)-isnull(pembayarandetail.Jumlah,0))-
(select isnull(sum(Nominal),0) as Uang_masuk from transaksibank
where transaksibank.KodeCabang = areacabang.KodeAreaCabang 
and transaksibank.tahunajaran = program.tahunajaran) as hutang_siswa
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
where areacabang.Aktif='1' and pembayarandetail.PembayaranUntuk='Pendaftaran' and a.KodeAreaCabang='uuu' and program.tahunajaran = '%2' 
group by  areacabang.KodeAreaCabang,areacabang.NamaAreaCabang,a.NamaAreaCabang,siswa.Cabang,areacabang.RecID, program.tahunajaran, a.KodeAreaCabang,areacabang.TanggalBerlaku,areacabang.TanggalBerakhir) cte
group by RecID,NamaAreaCabang,KodeAreaCabang,namacb,total_siswa,hutang_MD,TanggalBerlaku,TanggalBerakhir,Uang_masuk,hutang_siswa

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
            return $this->forward('rptLaporanDetailam/index');
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

    }
}
