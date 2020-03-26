<?php

class RptDetailFranchiseController extends ReportBase
{
    protected $sql = <<<SQL
select   
    a.NamaAreaCabang as Area,
    areacabang.RecID as RecID,
    areacabang.KodeAreaCabang as KodeCabang,
    areacabang.NamaAreaCabang as NamaCabang, 
    Pembayaranfranchisee.FranchisefeeID as FFID,
    Pembayaranfranchisee.AwalKontrak,
    Pembayaranfranchisee.AkhirKontrak,
    isnull(pembayaranfranchisee.NilaiFranchisee,0) as NilaiFF, 
    isnull(Pembayaranfranchisee.Diskon,0) as Diskon,
    isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0) as DPP,
    (isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100 as Pajak,

    (isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))+((isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100) as TotalPenagihan,       
    (isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))+((isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100)+(ISNULL(Pembayaranfranchisee.SaldoAwal,0)) as SaldoAkhir, 
    isnull(pembayaranfranchisee.Pembayaran,0) as PembayaranFF,
    isnull((select sum(TransaksiFranchise.Nominal) from TransaksiFranchise where TransaksiFranchise.KodeCabang = areacabang.KodeAreaCabang and 
                NoReferensi like '%03' and len(NoReferensi) = '6' and TransaksiFranchise.FFid=Pembayaranfranchisee.FranchisefeeID ),0) as PembayaranTransaksiBank,
    ISNULL(pembayaranfranchisee.Pembayaran,0)+isnull((select sum(TransaksiFranchise.Nominal) from TransaksiFranchise where TransaksiFranchise.KodeCabang = areacabang.KodeAreaCabang and 
                NoReferensi like '%03' and len(NoReferensi) = '6' and TransaksiFranchise.FFid=Pembayaranfranchisee.FranchisefeeID ),0) as TotalPembayaran,
    ((isnull(pembayaranfranchisee.NilaiFranchisee,0)-(isnull(Pembayaranfranchisee.Diskon,0)))+((isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100)+(ISNULL(Pembayaranfranchisee.SaldoAwal,0)))-
    (ISNULL(pembayaranfranchisee.Pembayaran,0)+isnull((select sum(TransaksiFranchise.Nominal) from TransaksiFranchise where TransaksiFranchise.KodeCabang = areacabang.KodeAreaCabang and 
                NoReferensi like '%03' and len(NoReferensi) = '6' and TransaksiFranchise.FFid=Pembayaranfranchisee.FranchisefeeID ),0)) As SisaPembayaran,
    isnull(areacabang.NoNPWP,'-') as NPWP, 
    isnull(areacabang.NoKTP,'-') as KTP,
    cast(pembayaranfranchisee.Keterangan as varchar(500)) as Keterangan, 
    Pembayaranfranchisee.TglMou,
    Pembayaranfranchisee.SaldoAwal,
    Pembayaranfranchisee.TidakAktif
    from areacabang
        join Pembayaranfranchisee on areacabang.KodeAreaCabang=pembayaranfranchisee.KodeCabang
        join areacabang a on areacabang.Area= a.KodeAreaCabang
    where a.RecID like '%%' and areacabang.aktif = 1
    group by a.NamaAreaCabang,
    areacabang.RecID,
    areacabang.KodeAreaCabang,
    areacabang.NoNPWP, 
    areacabang.NoKTP ,
    areacabang.NamaAreaCabang,
    Pembayaranfranchisee.FranchisefeeID,
    Pembayaranfranchisee.FranchisefeeID,
    Pembayaranfranchisee.AwalKontrak,
    Pembayaranfranchisee.AkhirKontrak,
    pembayaranfranchisee.NilaiFranchisee,
    Pembayaranfranchisee.Diskon,
    pembayaranfranchisee.NilaiFranchisee*10/100,
    pembayaranfranchisee.Pembayaran, 
    pembayaranfranchisee.Total,
    cast(pembayaranfranchisee.Keterangan as varchar(500)),
    Pembayaranfranchisee.TglMou,
    Pembayaranfranchisee.SaldoAwal,
    Pembayaranfranchisee.TidakAktif
    order by a.NamaAreaCabang,areacabang.KodeAreaCabang
SQL;

    protected $sql3 = <<<SQL
select   
    a.NamaAreaCabang as Area,
    areacabang.RecID as RecID,
    areacabang.KodeAreaCabang as KodeCabang,
    areacabang.NamaAreaCabang as NamaCabang, 
    Pembayaranfranchisee.FranchisefeeID as FFID,
    Pembayaranfranchisee.AwalKontrak,
    Pembayaranfranchisee.AkhirKontrak,
    isnull(pembayaranfranchisee.NilaiFranchisee,0) as NilaiFF, 
    isnull(Pembayaranfranchisee.Diskon,0) as Diskon,
    isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0) as DPP,
    (isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100 as Pajak,
    (isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))+((isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100) as TotalPenagihan,    
    (isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))+((isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100)+(ISNULL(Pembayaranfranchisee.SaldoAwal,0)) as SaldoAkhir, 
    isnull(pembayaranfranchisee.Pembayaran,0) as PembayaranFF, 
    isnull((select sum(TransaksiFranchise.Nominal) from TransaksiFranchise where TransaksiFranchise.KodeCabang = areacabang.KodeAreaCabang and 
                NoReferensi like '%03' and len(NoReferensi) = '6' and TransaksiFranchise.FFid=Pembayaranfranchisee.FranchisefeeID ),0) as PembayaranTransaksiBank,
    ISNULL(pembayaranfranchisee.Pembayaran,0)+isnull((select sum(TransaksiFranchise.Nominal) from TransaksiFranchise where TransaksiFranchise.KodeCabang = areacabang.KodeAreaCabang and 
                NoReferensi like '%03' and len(NoReferensi) = '6' and TransaksiFranchise.FFid=Pembayaranfranchisee.FranchisefeeID ),0) as TotalPembayaran,
    ((isnull(pembayaranfranchisee.NilaiFranchisee,0)-(isnull(Pembayaranfranchisee.Diskon,0)))+((isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100)+(ISNULL(Pembayaranfranchisee.SaldoAwal,0)))-
    (ISNULL(pembayaranfranchisee.Pembayaran,0)+isnull((select sum(TransaksiFranchise.Nominal) from TransaksiFranchise where TransaksiFranchise.KodeCabang = areacabang.KodeAreaCabang and 
                NoReferensi like '%03' and len(NoReferensi) = '6' and TransaksiFranchise.FFid=Pembayaranfranchisee.FranchisefeeID ),0)) As SisaPembayaran,
    isnull(areacabang.NoNPWP,'-') as NPWP, 
    isnull(areacabang.NoKTP,'-') as KTP,
    cast(pembayaranfranchisee.Keterangan as varchar(500)) as Keterangan, 
    Pembayaranfranchisee.TglMou,
    Pembayaranfranchisee.SaldoAwal,
    Pembayaranfranchisee.TidakAktif
    from areacabang
        join Pembayaranfranchisee on areacabang.KodeAreaCabang=pembayaranfranchisee.KodeCabang
        join areacabang a on areacabang.Area= a.KodeAreaCabang
    where year(pembayaranfranchisee.AkhirKontrak) like '%%'
    group by a.NamaAreaCabang,
    areacabang.RecID,
    areacabang.KodeAreaCabang,
    areacabang.NoNPWP, 
    areacabang.NoKTP ,
    areacabang.NamaAreaCabang,
    Pembayaranfranchisee.FranchisefeeID,
    Pembayaranfranchisee.FranchisefeeID,
    Pembayaranfranchisee.AwalKontrak,
    Pembayaranfranchisee.AkhirKontrak,
    pembayaranfranchisee.NilaiFranchisee,
    Pembayaranfranchisee.Diskon,
    pembayaranfranchisee.NilaiFranchisee*10/100,
    pembayaranfranchisee.Pembayaran, 
    pembayaranfranchisee.Total,
    cast(pembayaranfranchisee.Keterangan as varchar(500)),
    Pembayaranfranchisee.TglMou,
    Pembayaranfranchisee.SaldoAwal,
    Pembayaranfranchisee.TidakAktif
    order by a.NamaAreaCabang,areacabang.KodeAreaCabang
SQL;

    protected $sql1 = <<<SQL
    select TransaksiFranchise.KodeCabang, TransaksiFranchise.Nominal, TransaksiFranchise.TanggalTransaksi
    from TransaksiFranchise
    where NoReferensi like '%03' and len(NoReferensi) = '6' and TransaksiFranchise.FFid = 'uuu'
    order by TanggalTransaksi
SQL;


    protected $sql2 = <<<SQL
    select pembayaranfranchisee.SaldoAwal,
    (isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))+((isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100) as Total,
    (isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))+((isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100)+(ISNULL(Pembayaranfranchisee.SaldoAwal,0)) as SaldoAkhir, 
    Pembayaranfranchisee.Pembayaran
    from Pembayaranfranchisee where FranchisefeeID = 'uuu'
SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan detail Franchise');
        parent::initialize();

        $insert = "EXEC SP_TransaksiFranchiseFee"; 
        $query = $this->getDI()->getShared('db')->query($insert);

        $Update = "UPDATE TransaksiFranchise
                    SET FFid = b.FranchisefeeID
                    FROM TransaksiFranchise a
                    join Pembayaranfranchisee b on a.KodeCabang=b.KodeCabang
                    where b.TidakAktif is null and a.FFid is null"; 
        $updateq = $this->getDI()->getShared('db')->query($Update);
    }

    public function indexAction() {
        $this->view->rpt_title = 'Laporan Detail Franchise Fee Per-Area';
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('AreaID', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
    }
	
   public function indexyearAction() {
        $this->view->rpt_title = 'Laporan Detail Franchise Fee Per-Tahun Berakhir';
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
            return $this->forward('rptDetailFranchise/index');
        }
       
        $this->view->rpt_title = 'Laporan Detail Franchise Fee Per-Area';
        $areaid = $this->request->getPost('AreaID');
        $area= $cabang->KodeAreaCabang;
		
        $sql = str_replace(['%%'],[$areaid], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->result = $query->fetchAll($query);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $this->view->today = date('Y-m-d');
    }
	
    public function viewyearAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('rptDetailFranchise/indexyear');
        }
       
        $this->view->rpt_title = 'Laporan Detail Franchise Fee Per-Tahun Berakhir';
        $tahun = $this->request->getPost('tahun');
		
        $sql3 = str_replace(['%%'],[$tahun], $this->sql3);
        $query = $this->getDI()->getShared('db')->query($sql3);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->result = $query->fetchAll($query);
        $this->view->tahun = $tahun;
    }

    public function viewpayAction($ffid)
    {
        
        $date = date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = substr($ffid,3,4);
        $cabang = Areacabang::findFirstByRecID($cabangid);
        //$ffid = $this->uri->segment(3);
        
        $sql1 = str_replace(
                ['uuu'],[$ffid], $this->sql1);
        $query1 = $this->getDI()->getShared('db')->query($sql1);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $sql2 = str_replace(
                ['uuu'],[$ffid], $this->sql2);
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->rpt_title = 'Laporan Detail Pembayaran Franchise';
        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = date('d/m/Y', strtotime($date));
        $this->view->result = $query1->fetchAll($query1);
        $this->view->result2 = $query2->fetchAll($query2);
        $cabang = Areacabang::findFirstByKodeAreaCabang($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'all';
        $this->view->rpt_area = $cabangid ? $cabang->NamaArea : 'all';

    }
}
