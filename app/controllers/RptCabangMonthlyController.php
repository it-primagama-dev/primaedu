<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;

class RptcabangmonthlyController extends ControllerBase {

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Laporan Data Cabang Per-Bulan");
        parent::initialize();
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }

    public function indexAction() {

        if ($this->auth['username']=='ridwan.sobar')
        {
        $this->view->cabangtx = $this->getTransaction();

        } else {
            echo "<script>alert('Akses anda ditolak !!'); window.history.go(-1)</script>";
        }
    }
    
    public function searchAction() {

        $tahun = $this->request->getPost('TA');
        $cabangid = $this->request->getPost('Cabang');
        $this->view->rpt_title = "Laporan Data Cabang Per-Bulan";
        
        
        $sql = "DECLARE @year int
set @year = YEAR(GETDATE());

SELECT  a.KodeAreaCabang,m.number as mth, DATENAME(MONTH, cast(@year*100+number as varchar) + '01') as monthname, isnull(JumlahSiswa,0) as total_qty,JumlahTotal,Uang_masuk
from (
 select number
 from    master.dbo.spt_values 
 where type = 'P' and number between 1 and 12
) m 
left join (
select KodeCabang,NamaCabang,Bulan,
(select count(siswa.RecID) from siswa 
join programsiswa on siswa.RecID = programsiswa.Siswa
join program on programsiswa.Program=program.RecID
join areacabang on siswa.Cabang=areacabang.RecID
Join CabangPWE pwe ON pwe.KodeCabang = areacabang.KodeAreaCabang 
where pwe.KodeCabang=cte.KodeCabang and program.tahunajaran = '$tahun' and month(siswa.CreatedAt)=cte.Bulan) as JumlahSiswa,
sum(JumlahTotal)as JumlahTotal, 
(select sum(transaksibank.Nominal) as Uang_masuk from transaksibank
join siswa on transaksibank.Siswa=siswa.RecID
join programsiswa on siswa.RecID = programsiswa.Siswa
join program on programsiswa.Program=program.RecID 
where transaksibank.tahunajaran = '$tahun' and program.tahunajaran = '$tahun' and KodeCabang=cte.KodeCabang and 
MONTH(transaksibank.TanggalTransaksi)=cte.Bulan and 
transaksibank.Siswa is not null)as Uang_masuk
                from
(select month(siswa.CreatedAt) As Bulan,pwe.KodeCabang,areacabang.NamaAreaCabang as NamaCabang,
               (pembayaran.JumlahTotal-pembayarandetail.Jumlah) as JumlahTotal From Siswa
                Join programsiswa ON siswa.RecID = programsiswa.siswa
                Join program ON program.RecID = programsiswa.program
                Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
                Join pembayaran ON pembayaran.ProgramSiswa = programsiswa.RecID
                join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
                Join areacabang ON areacabang.RecID = siswa.cabang
                Join CabangPWE pwe ON pwe.KodeCabang = areacabang.KodeAreaCabang 
               Where program.tahunajaran = '$tahun' and pembayarandetail.pembayaranuntuk='Pendaftaran' and pwe.KodeCabang = '$cabangid'
                group by MONTH(siswa.CreatedAt),pembayaran.JumlahTotal,pembayarandetail.Jumlah,pwe.KodeCabang,areacabang.NamaAreaCabang) as cte
                group by KodeCabang,NamaCabang,Bulan
) s on m.number = s.Bulan
left join areacabang a on s.KodeCabang=a.KodeAreaCabang
order by mth asc";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);
        $cabang = Areacabang::findFirstByKodeAreaCabang($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeAreaCabang.' - '.$cabang->NamaAreaCabang : 'all';
        $tahunajaran = Tahunajaran::findFirstByRecID($tahun);
        $this->view->rpt_tahun = $tahun ? $tahunajaran->Description : 'all';
        $cabangs = Areacabang::findFirstByRecID($cabangid);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);

    }


    private function getTransaction() {
        $column = ['a.RecID','a.KodeAreaCabang', 'a.KodeAreaCabang + " - " + a.NamaAreaCabang AS NamaCabang'];

        $query = $this->modelsManager->createBuilder()
                ->columns($column)->groupBy($groupBy)
                ->addFrom('areacabang', 'a')
                ->join('areacabang', 'a.Area = b.KodeAreaCabang', 'b')
                ->orderBy('a.KodeAreaCabang');
    
        return $query->getQuery()->execute()->setHydrateMode(Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
    }
}
