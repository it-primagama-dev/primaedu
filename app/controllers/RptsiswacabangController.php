<?php

class RptsiswacabangController extends ControllerBase
{

    protected $auth;

   

    public function initialize() {
        $this->tag->setTitle('Laporan Kinerja per Jenjang');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Laporan Priode';
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
            return $this->forward('Rptsiswacabangtestmd/index');
        }

        $tahun = $this->request->getPost('tahun');
        $cabang = $this->request->getPost('Cabang');
        if ($cabang==''){
            $cabang = $this->auth['areacabang'];
        }

        
        
        $sql = "SELECT VirtualAccount, CreatedAt ,MD, NamaSiswa,NamaJenjang,Cabang,isnull(sum(JumlahTotal),0) as JumlahTotal,isnull(cte.koreksi,0) as koreksi,cte.Keterangan,
(select isnull(sum(transaksibank.Nominal),0) as Uang_masuk from transaksibank where transaksibank.Siswa = cte.RecID and tahunajaran=$tahun and len(NoReferensi) = 11 or Auth_Cd is not null and KodeCabang=cte.KodeAreaCabang and tahunajaran = $tahun and transaksibank.Siswa = cte.RecID and KodeCabang=cte.KodeAreaCabang)as Uang_masuk,
(select isnull(sum(jumlah),0) as uang
 from pembayarandetail 
join pembayaran on pembayaran.RecID=pembayarandetail.Pembayaran
join programsiswa on programsiswa.RecID=pembayaran.ProgramSiswa
join program on program.RecID= programsiswa.Program
join tahunajaran on tahunajaran.RecID=program.tahunajaran
join siswa on siswa.RecID=programsiswa.Siswa
Join areacabang ON areacabang.RecID = siswa.cabang where programsiswa.Siswa
 =cte.RecID and pembayaranmetode=8 and tahunajaran= $tahun) as uang
from (select siswa.VirtualAccount,siswa.CreatedAt,Siswa.RecId,Siswa.MD,areacabang.kodeareacabang, siswa.NamaSiswa,siswa.cabang, jenjang.NamaJenjang,(pembayaran.JumlahTotal-pembayarandetail.Jumlah) as JumlahTotal,sum(cta.koreksi) as koreksi,cta.Keterangan
From Siswa
join programsiswa ON siswa.RecID = programsiswa.siswa
join program ON program.RecID = programsiswa.program
join tahunajaran ON tahunajaran.RecID = program.tahunajaran
join pembayaran ON pembayaran.ProgramSiswa = programsiswa.RecID
join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
join areacabang ON areacabang.RecID = siswa.cabang
join jenjang on siswa.Jenjang=jenjang.KodeJenjang
left join
(select ref.Siswa,ref.KodeCabang,ref.tahunajaran,ref.koreksi,ref.Keterangan from
(Select transaksibank.Siswa,transaksibank.KodeCabang,transaksibank.tahunajaran,
CASE 
    WHEN 
        refund.NoVaBenar = transaksibank.NoVa 
        AND refund.TrackFinance = 'Approved' 
        AND refund.TrackGM = 'Approved' 
    THEN 
        refund.Selisih 
    WHEN 
        refund.NovaSalah = transaksibank.NoVa 
        AND refund.TrackFinance = 'Approved' 
        AND refund.TrackGM = 'Approved' 
    THEN 
        refund.Nominal 
    ELSE 
        0
    END AS koreksi,
CASE 
    WHEN 
        refund.NovaSalah = transaksibank.NoVa 
        AND refund.TrackFinance = 'Approved' 
        AND refund.TrackGM = 'Approved' 
    THEN 
        concat('refund kesalahan transfer ', refund.NoVaBenar) 
    WHEN 
        refund.NoVaBenar = transaksibank.NoVa 
        AND refund.TrackFinance = 'Approved' 
        AND refund.TrackGM = 'Approved' 
        AND refund.Selisih IS NOT NULL 
    THEN 
        'refund kelebihan nominal' 
    WHEN 
        refund.NoVaBenar = transaksibank.NoVa 
        AND refund.TrackFinance = 'Approved' 
        AND refund.TrackGM = 'Approved' 
        AND refund.Selisih IS NULL 
    THEN 
        '' 
    END AS Keterangan
from 
    dbo.transaksibank 
LEFT JOIN 
    dbo.refund 
    ON 
        dbo.refund.NoVaBenar = transaksibank.NoVA 
        AND dbo.refund.TrackFinance = 'Approved' 
        AND dbo.refund.TrackGM = 'Approved' 
        AND dbo.refund.TanggalTransfer = dbo.transaksibank.TanggalTransaksi  
        AND dbo.refund.Selisih IS NOT NULL 
        AND dbo.refund.TahunAjaran = dbo.transaksibank.tahunajaran 
        /*AND (
            select cast(rf.LebihNominal as int)-cast(rf.Nominal as int) 
            from refund rf where rf.RecID=refund.RecID) = dbo.transaksibank.Nominal*/
        OR 
            dbo.refund.NoVaSalah = transaksibank.NoVA 
            AND dbo.refund.TrackFinance = 'Approved' 
            AND dbo.refund.TrackGM = 'Approved' 
            AND dbo.refund.TahunAjaran = dbo.transaksibank.tahunajaran 
            AND dbo.refund.Nominal = dbo.transaksibank.Nominal 
        OR
            dbo.refund.NoVaBenar = transaksibank.NoVA 
            AND dbo.refund.TrackFinance = 'Approved' 
            AND dbo.refund.TrackGM = 'Approved' 
            AND dbo.refund.Selisih IS NULL
) as ref where ref.koreksi !=0) cta on siswa.RecID=cta.Siswa and areacabang.KodeAreaCabang=cta.KodeCabang and cta.tahunajaran=$tahun
Where program.tahunajaran =$tahun and siswa.cabang =$cabang 
 and pembayarandetail.pembayaranuntuk='Pendaftaran'
 group by siswa.VirtualAccount,Siswa.CreatedAt, Siswa.MD,Jenjang.NamaJenjang,pembayaran.JumlahTotal, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, siswa.RecID,tahunajaran.Description,pembayarandetail.Jumlah,areacabang.kodeareacabang,cta.koreksi,cta.Keterangan) as cte
group by VirtualAccount,CreatedAt,MD,NamaJenjang,NamaSiswa,Cabang,RecID,kodeareacabang,koreksi,cte.Keterangan";
         $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);
                
                
        $sql3 = "select siswa.VirtualAccount,Siswa.MD, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, 
                tahunajaran.Description, (pembayaran.JumlahTotal-pembayarandetail.Jumlah) as
                JumlahTotalmd,
                (select sum(transaksibank.Nominal) as Uang_masuk from transaksibank where transaksibank.Siswa = siswa.RecID and 
                tahunajaran=$tahun) as Uang_masukmd
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
         $query3 = $this->getDI()->getShared('db')->query($sql3);
        $query3->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result3 = $query3->fetchAll($query3);
        
             $sql1 = "select sum(Nominal) Nominal from feemanagement join areacabang on feemanagement.KodeCabang=areacabang.KodeAreaCabang
                    where areacabang.RecID=$cabang and feemanagement.keterangan='$tahun'";
        

      
        
        $query1 = $this->getDI()->getShared('db')->query($sql1);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result1 = $query1->fetchAll($query1);

        
        

        $date = date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->request->getPost('Cabang');
       

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->NamaAreaCabang : 'all';
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

