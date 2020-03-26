<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CabangController extends ControllerBase
{
    protected $sql = <<<SQL
select   
    a.NamaAreaCabang as Area,
    areacabang.KodeAreaCabang as KodeCabang,
    areacabang.NamaAreaCabang as NamaCabang,
    areacabang.TanggalBerlaku,
    areacabang.TanggalBerakhir,
    b.NamaPropinsi,
    c.NamaKotaKab,
    areacabang.Alamat,
    areacabang.KodePos,
    areacabang.NoTelp,
    areacabang.Email,
    areacabang.NoRekBCA,
    areacabang.NamaRekBCA,
    areacabang.KodeBankNonBCA,
    areacabang.NamaRekNonBCA,
    areacabang.NamaManager,
    areacabang.NoHandPhone,
    isnull(areacabang.AlamatKC,'-') as AlamatKC,
    areacabang.PAC,
    areacabang.telpPAC,
    areacabang.Ismart,
    areacabang.TelpIsmart,
    areacabang.NamaFranchisee,
    areacabang.NoTelpFranchisee,
    areacabang.EmailFranchisee,
    areacabang.AlamatFranchisee,
    areacabang.Statuskepemilikan,
    areacabang.Direktur,
    areacabang.SIUP,
    areacabang.TDP,
    areacabang.YStatuskepemilikan,
    areacabang.Bentuk,
    areacabang.StatusB,
    isnull(areacabang.NoNPWP,'-') as NPWP, 
    isnull(areacabang.NoKTP,'-') as KTP,
    Pembayaranfranchisee.FranchisefeeID as FFID,
    Pembayaranfranchisee.AwalKontrak,
    Pembayaranfranchisee.AkhirKontrak,
    isnull(pembayaranfranchisee.NilaiFranchisee,0) as NilaiFF, 
    isnull(Pembayaranfranchisee.Diskon,0) as Diskon,
    isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0) as DPP,
    (isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100 as Pajak,

    (isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))+((isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100) as TotalPenagihan,    
    isnull(pembayaranfranchisee.Pembayaran,0) as PembayaranFF, 
    isnull((select sum(transaksibank.Nominal) from transaksibank where transaksibank.KodeCabang = areacabang.KodeAreaCabang and 
                NoReferensi like '%03' and len(NoReferensi) = '6' ),0) as PembayaranTransaksiBank,
    ISNULL(pembayaranfranchisee.Pembayaran,0)+isnull((select sum(transaksibank.Nominal) from transaksibank where transaksibank.KodeCabang = areacabang.KodeAreaCabang and 
                NoReferensi like '%03' and len(NoReferensi) = '6' ),0) as TotalPembayaran,
    ((isnull(pembayaranfranchisee.NilaiFranchisee,0)-(isnull(Pembayaranfranchisee.Diskon,0)))+((isnull(pembayaranfranchisee.NilaiFranchisee,0)-isnull(Pembayaranfranchisee.Diskon,0))*10/100))-
    (ISNULL(pembayaranfranchisee.Pembayaran,0)+isnull((select sum(transaksibank.Nominal) from transaksibank where transaksibank.KodeCabang = areacabang.KodeAreaCabang and 
                NoReferensi like '%03' and len(NoReferensi) = '6' ),0)) As SisaPembayaran,
    isnull(areacabang.NoNPWP,'-') as NPWP, 
    isnull(areacabang.NoKTP,'-') as KTP,
    cast(pembayaranfranchisee.Keterangan as varchar(500)) as Keterangan, 
    Pembayaranfranchisee.TglMou
    from areacabang
        left join Pembayaranfranchisee on areacabang.KodeAreaCabang=pembayaranfranchisee.KodeCabang
        join areacabang a on areacabang.Area= a.KodeAreaCabang
        left join propinsi b on areacabang.Propinsi=b.RecID
        left join kotakab c on areacabang.Kota=c.RecID
    where areacabang.aktif like '%%'
    group by a.NamaAreaCabang,
    areacabang.RecID,
    areacabang.KodeAreaCabang,
    areacabang.TanggalBerlaku,
    areacabang.TanggalBerakhir,
    b.NamaPropinsi,
    c.NamaKotaKab,
    areacabang.Alamat,
    areacabang.KodePos,
    areacabang.NoTelp,
    areacabang.Email,
    areacabang.NoRekBCA,
    areacabang.NamaRekBCA,
    areacabang.KodeBankNonBCA,
    areacabang.NamaRekNonBCA,
    areacabang.NamaManager,
    areacabang.NoHandPhone,
    areacabang.AlamatKC,
    areacabang.PAC,
    areacabang.telpPAC,
    areacabang.Ismart,
    areacabang.TelpIsmart,
    areacabang.NamaFranchisee,
    areacabang.NoTelpFranchisee,
    areacabang.EmailFranchisee,
    areacabang.AlamatFranchisee,
    areacabang.Statuskepemilikan,
    areacabang.Direktur,
    areacabang.SIUP,
    areacabang.TDP,
    areacabang.YStatuskepemilikan,
    areacabang.Bentuk,
    areacabang.StatusB,
    areacabang.NoNPWP, 
    areacabang.NoKTP,
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
    Pembayaranfranchisee.TglMou
    order by a.NamaAreaCabang ,areacabang.KodeAreaCabang
SQL;

    protected $sql3 = <<<SQL
select TOP 1
    a.NamaAreaCabang as Area,
    areacabang.RecID as RecID,
    areacabang.KodeAreaCabang as KodeCabang,
    areacabang.NamaAreaCabang as NamaCabang, 
    Pembayaranfranchisee.FranchisefeeID as FFID,
    Pembayaranfranchisee.AwalKontrak,
    Pembayaranfranchisee.AkhirKontrak,
    Pembayaranfranchisee.SaldoAwal,
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
    Pembayaranfranchisee.TglMou
    from areacabang
        join Pembayaranfranchisee on areacabang.KodeAreaCabang=pembayaranfranchisee.KodeCabang
        join areacabang a on areacabang.Area= a.KodeAreaCabang
    where areacabang.KodeAreaCabang like '%%'
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
    Pembayaranfranchisee.SaldoAwal,
    cast(pembayaranfranchisee.Keterangan as varchar(500)),
    Pembayaranfranchisee.TglMou
    order by Pembayaranfranchisee.FranchisefeeID DESC
SQL;

    protected $auth;

    protected $isAdmin;

    public function initialize() {
        $this->tag->setTitle("Data Cabang");
        parent::initialize();
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
            $this->isAdmin = $this->auth["areacabang"] ? FALSE : TRUE;
            $this->view->admin = $this->isAdmin;
        }
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
        $this->persistent->parameters = null;
    }



    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            // TOC-RB 27 Mei 2015
            $query = $this->addFilter();
            // END TOC-RB 27 Mei 2015
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "KodeAreaCabang";

        // TOC-RB 27 April 2015
        $cabang = Areacabang::find($parameters);

        if (count($cabang) == 0) {
            $this->flash->notice("Data cabang tidak dapat ditemukan");
            return $this->forward('cabang/index');
        }

        $paginator = new Paginator(array(
            "data" => $cabang,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    public function editAction($RecID) {
        if (!$this->request->isPost()) {
            // TOC-RB 3 Juli 2015
            $cabang = Areacabang::findFirstByRecID($RecID);
            if (!$cabang) {
                $this->flash->error("Data cabang tidak dapat ditemukan");
                return $this->forward("cabang/index");
            }
            // TOC-RB 3 Juli 2015
            if (!$this->validateSession($cabang)) {
                $this->flash->error("Data cabang tidak dapat ditemukan");
                return $this->forward("cabang/index");
            }

            $this->tag->setDefaults($cabang->toArray());
            $this->tag->setDefault("NamaCabang", $cabang->NamaAreaCabang);
            // View Components
            $this->view->RecID = $cabang->RecID;
            $this->view->area = Areacabang::find(array(
                "Area IS NULL", "order" => "KodeAreaCabang"
            ));
            $this->view->propinsi = Propinsi::find();
            $this->view->kotakab = Kotakab::findByPropinsi($cabang->Propinsi);
            $this->view->branchcode = $cabang->KodeAreaCabang;
            $this->view->bank = Bank::find();
        }
    }
   
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('cabang/index');
        }
        // TOC-RB 03 Juli 2015
        $cabang = Areacabang::findFirstByRecID($this->request->getPost("RecID"));

        if (!$cabang) {
            $this->flash->error("Data cabang tidak dapat ditemukan");
            return $this->forward('cabang/index');
        }
        if (!$this->validateSession($cabang)) {
            $this->flash->error("Data cabang tidak dapat ditemukan");
            return $this->forward('cabang/index');
        }
        $cabang->Alamat = $this->request->getPost("Alamat");
        $cabang->Propinsi = $this->request->getPost("Propinsi");
        $cabang->Kota = $this->request->getPost("Kota");
        $cabang->KodePos = $this->request->getPost("KodePos");
        $cabang->NoTelp = $this->request->getPost("NoTelp");
        $cabang->NamaManager = $this->request->getPost("NamaManager");
        $cabang->NoHandPhone = $this->request->getPost("NoHandPhone");

        if ($this->isAdmin) {
            $cabang->Email = $this->request->getPost("Email");
            $cabang->NamaAreaCabang = $this->request->getPost("NamaCabang");
            $cabang->Area = $this->request->getPost("Area");
            $cabang->TanggalBerlaku = $this->request->getPost("TanggalBerlaku") ? : NULL;
            $cabang->TanggalBerakhir = $this->request->getPost("TanggalBerakhir") ? : NULL;
            // NEW ADDED
            $cabang->Aktif = is_null($this->request->getPost("Aktif")) ? FALSE : TRUE;
            $cabang->NamaFranchisee = $this->request->getPost("NamaFranchisee");
            $cabang->EmailFranchisee = $this->request->getPost("EmailFranchisee");
            $cabang->NoTelpFranchisee = $this->request->getPost("NoTelpFranchisee");
            $cabang->NoRekBCA = $this->request->getPost("NoRekBCA", "int")?:NULL;
            $cabang->NamaRekBCA = $this->request->getPost("NamaRekBCA", "upper")?:NULL;
            $cabang->KodeBankNonBCA = $this->request->getPost("KodeBankNonBCA", "int")?:NULL;
            $cabang->NoRekNonBCA = $this->request->getPost("NoRekNonBCA", "int")?:NULL;
            $cabang->NamaRekNonBCA = $this->request->getPost("NamaRekNonBCA", "upper")?:NULL;
        }
 
        if (!$cabang->save()) {
            foreach ($cabang->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "cabang",
                "action" => "edit",
                "params" => array($cabang->RecID)
            ));
        }

        $this->flash->success("Data cabang berhasil diubah");
        return $this->forward("cabang/index");

    }

//FF
    public function newAction() {
        if (!$this->isAdmin) {
            return $this->forward("cabang/index");
        }
        $this->view->area = Areacabang::find(array(
                    "Area IS NULL", "order" => "KodeAreaCabang"
        ));
        $this->view->propinsi = Propinsi::find();
        $this->view->bank = Bank::find();
    }

    public function ffAction() {
        $this->persistent->parameters = null;
    }

    public function searchffAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            // TOC-RB 27 Mei 2015
            $query = $this->addFilter();
            // END TOC-RB 27 Mei 2015
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "KodeAreaCabang";

        // TOC-RB 27 April 2015
        $cabang = Areacabang::find($parameters);

        if (count($cabang) == 0) {
            $this->flash->notice("Data cabang tidak dapat ditemukan");
            return $this->forward('cabang/index');
        }

        $paginator = new Paginator(array(
            "data" => $cabang,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    public function editffAction($RecID) {
        if (!$this->request->isPost()) {

            $cabang = Areacabang::findFirstByRecID($RecID);
            if (!$cabang) {
                $this->flash->error("Data cabang tidak dapat ditemukan");
                return $this->forward("cabang/ff");
            }

            if (!$this->validateSession($cabang)) {
                $this->flash->error("Data cabang tidak dapat ditemukan");
                return $this->forward("cabang/ff");
            }

            $this->tag->setDefaults($cabang->toArray());
            $this->tag->setDefault("NamaCabang", $cabang->NamaAreaCabang);

            $this->view->RecID = $cabang->RecID;
            $this->view->area = Areacabang::find(array(
                "Area IS NULL", "order" => "KodeAreaCabang"
            ));


            $KodeCabang = $cabang->KodeAreaCabang;
            $sql = "SELECT TOP 1 NilaiFranchisee, Diskon, TahunMulai, TahunAkhir, TglMou, NoMOU, RecID, Keterangan, day(AwalKontrak) as hariBerlaku, month(AwalKontrak) as bulanBerlaku, day(AkhirKontrak) as hariBerakhir, month(AkhirKontrak) as bulanBerakhir from pembayaranfranchisee where KodeCabang = '$KodeCabang' Order BY RecID DESC";
            $query = $this->getDI()->getShared('db')->query($sql);
            $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
            $this->view->result = $query->fetchAll($query);

            $this->view->propinsi = Propinsi::find();
            $this->view->kotakab = Kotakab::findByPropinsi($cabang->Propinsi);
            $this->view->branchcode = $cabang->KodeAreaCabang;
            $this->view->KTP = $cabang->KTP;
            $this->view->NPWP = $cabang->NPWP;
            $this->view->bank = Bank::find();
        }
    }
    
    public function createAction()
    {
        if (true == $this->request->hasFiles() && $this->request->isPost()) {
            $file_path = '../public/uploads/';
            if (!is_dir($file_path)) {
                mkdir($file_path, 0755);
            }
            $kodeAreaCabang =  $this->request->getPost('KodeCabang');
            foreach ($this->request->getUploadedFiles() as $file) {
                $jenis_gambar = strtolower(end(explode("/", $file->getType())));
                if($jenis_gambar=="jpeg" || $jenis_gambar=="jpg" || $jenis_gambar=="png") {
                    $Name = preg_replace("/[^A-Za-z0-9.]/", '-',  $file->getName());
                    $Nama = $kodeAreaCabang.'_'.$Name;
                    $gbr[] = preg_replace("/[^A-Za-z0-9.]/", '-', $file->getName());
                    $file->moveTo($file_path . $Nama);
                    $msg = "has been successfully uploaded.";
                } else {
                    $msg = "Jenis gambar yang anda kirim salah. Harus .jpg / .png / .jpeg";
                }
            }
            for ($i=0; $i < count($gbr); $i++) {
                $pic = $kodeAreaCabang.'_'.$gbr[0];
                $pic2 =$kodeAreaCabang.'_'.$gbr[1];
            }

        $kodeAreaCabangtrim = trim($kodeAreaCabang); 
        $NilaiFranchisee =  str_replace(array('Rp ',',00','.'), '', $this->request->getPost('NilaiFranchisee'));
        $tahunBerakhir =  $this->request->getPost('tahunBerakhir');
        $tahunBerlaku =  $this->request->getPost('tahunBerlaku');
        $TglMou =  $this->request->getPost('TglMou');
        $NoMOU =  $this->request->getPost('NoMOU');
        $total =  str_replace(array('Rp ',',00','.'), '', $this->request->getPost('total'));
        $Diskon = str_replace(array('Rp ',',00','.'), '', $this->request->getPost('Diskon'));
        $FFID =  "PF-$kodeAreaCabangtrim-1";
        $Keterangan = $this->request->getPost('Keterangan');
        
        $TanggalBerlaku = $this->request->getPost('hariBerlaku');
        $bulanBerlaku = $this->request->getPost('bulanBerlaku');
        $berlaku =  $TanggalBerlaku . '-' . $bulanBerlaku . '-' . $tahunBerlaku;
        $berlaku1 = strtotime($berlaku);
        $berlaku2 = date ('Y-m-d',$berlaku1);
        
        $TanggalBerakhir =$this->request->getPost('hariBerakhir');
        $bulanBerakhir = $this->request->getPost('bulanBerakhir');
        $berakhir =  $TanggalBerakhir . '-' . $bulanBerakhir . '-' . $tahunBerakhir;
        $berakhir1 = strtotime($berakhir);
        $berakhir2 = date ('Y-m-d',$berakhir1);

        $cabang = new Areacabang();

        $cabang->NamaAreaCabang = $this->request->getPost("NamaCabang");
        $cabang->Area = $this->request->getPost("Area");
        $cabang->TanggalBerlaku = $berlaku2;
        $cabang->TanggalBerakhir = $berakhir2;
        $cabang->Alamat = $this->request->getPost("Alamat");
        $cabang->Propinsi = $this->request->getPost("Propinsi");
        $cabang->Kota = $this->request->getPost("Kota");
        $cabang->KodePos = $this->request->getPost("KodePos");
        $cabang->NoTelp = $this->request->getPost("NoTelp");
        $cabang->NamaManager = $this->request->getPost("NamaManager");
        $cabang->NoHandPhone = $this->request->getPost("NoHandPhone");
        $cabang->AlamatKC = $this->request->getPost("AlamatKpl");
        $cabang->Email = $this->request->getPost("Email");
        // NEW ADDED
        $cabang->Aktif = is_null($this->request->getPost("Aktif")) ? FALSE : TRUE;
        $cabang->NamaFranchisee = $this->request->getPost("NamaFranchisee");
        $cabang->EmailFranchisee = $this->request->getPost("EmailFranchisee");
        $cabang->NoTelpFranchisee = $this->request->getPost("NoTelpFranchisee");
        $cabang->AlamatFranchisee = $this->request->getPost("AlamatKTP");
        $cabang->NoRekBCA = $this->request->getPost("NoRekBCA", "int")?:NULL;
        $cabang->NamaRekBCA = $this->request->getPost("NamaRekBCA", "upper")?:NULL;
//      $cabang->NoRekMandiri = $this->request->getPost("NoRekMandiri", "int");
//      $cabang->NamaRekMandiri = $this->request->getPost("NamaRekMandiri", "upper");
        $cabang->KodeAreaCabang = $this->request->getPost("KodeCabang", "int");
        $cabang->KodeBankNonBCA = $this->request->getPost("KodeBankNonBCA", "int")?:NULL;
        $cabang->NoRekNonBCA = $this->request->getPost("NoRekNonBCA", "int")?:NULL;
        $cabang->NamaRekNonBCA = $this->request->getPost("NamaRekNonBCA", "upper")?:NULL;
        $cabang->NoKTP = $this->request->getPost("NoKTP")?:NULL;
        $cabang->NoNPWP = $this->request->getPost("NoNPWP")?:NULL;
        $cabang->TDP = $this->request->getPost("TDP")?:NULL;
        $cabang->SIUP = $this->request->getPost("SIUP")?:NULL;
        $cabang->kplcab = $this->request->getPost("Kplcabang")?:NULL;
        $cabang->TKC = $this->request->getPost("TelpKplcabang")?:NULL;
        $cabang->AlamatKC = $this->request->getPost("AlamatKC")?:NULL;
        $cabang->PAC = $this->request->getPost("PAC")?:NULL;
        $cabang->telpPAC = $this->request->getPost("telpPAC")?:NULL;
        $cabang->Ismart = $this->request->getPost("Ismart","upper")?:NULL;
        $cabang->TelpIsmart = $this->request->getPost("TelpIsmart","upper")?:NULL;
        $cabang->Statuskepemilikan = $this->request->getPost("Statuskepemilikan")?:NULL;
        $cabang->YStatuskepemilikan = $this->request->getPost("Yanglain")?:NULL;
        $cabang->Bentuk = $this->request->getPost("Bentuk")?:NULL;
        $cabang->StatusB = $this->request->getPost("StatusB")?:NULL;
        $cabang->Direktur = $this->request->getPost("Direktur")?:NULL;
        //$cabang->YBentuk = $this->request->getPost("StatusYanglain")?:NULL;
        //$cabang->Yanglain = $this->request->getPost("Status")?:NULL;
        $cabang ->KTP = $pic;
        $cabang ->NPWP = $pic2;

        if (!$cabang->save()) {
            foreach ($cabang->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('cabang/new');
        }
      
        $insert = "INSERT into pembayaranfranchisee (RecID,KodeCabang, NilaiFranchisee, TglMou, Total, TahunMulai, TahunAkhir,Keterangan, FranchiseFeeID,Diskon, AwalKontrak, AkhirKontrak, NoMOU)
        values((SELECT ISNULL(MAX(RecID) + 1, 0) FROM pembayaranfranchisee), '$kodeAreaCabangtrim','$NilaiFranchisee','$TglMou','$total','$tahunBerlaku','$tahunBerakhir','$Keterangan','$FFID','$Diskon','$berlaku2','$berakhir2','$NoMOU')"; 
        $query = $this->getDI()->getShared('db')->query($insert);

        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->flash->success("Data Cabang berhasil ditambahkan");
        return $this->forward('cabang/ff');

        }
    }

    public function saveeditffAction()
    {        
        if (!$this->request->isPost()) {
            return $this->forward('cabang/ff');
        }

        // TOC-RB 03 Juli 2015
        $cabang = Areacabang::findFirstByRecID($this->request->getPost("RecID"));

        if (!$cabang) {
            $this->flash->error("Data cabang tidak dapat ditemukan");
            return $this->forward('cabang/ff');
        }
        if (!$this->validateSession($cabang)) {
            $this->flash->error("Data cabang tidak dapat ditemukan");
            return $this->forward('cabang/ff');
        }

        $file_path = '../public/uploads/';
            if (!is_dir($file_path)) {
                mkdir($file_path, 0755);
            }
            $kodeAreaCabang =  $this->request->getPost('KodeCabang2');
            foreach ($this->request->getUploadedFiles() as $file) {
                $jenis_gambar = strtolower(end(explode("/", $file->getType())));
                if($jenis_gambar=="jpeg" || $jenis_gambar=="jpg" || $jenis_gambar=="png") {
                    $Name = preg_replace("/[^A-Za-z0-9.]/", '-',  $file->getName());
                    $Nama = $kodeAreaCabang.'_'.$Name;
                    $gbr[] = preg_replace("/[^A-Za-z0-9.]/", '-', $file->getName());
                    $file->moveTo($file_path . $Nama);
                    $msg = "has been successfully uploaded.";
                } else {
                    $msg = "Jenis gambar yang anda kirim salah. Harus .jpg / .png / .jpeg";
                }
            }
            for ($i=0; $i <count($gbr); $i++) {
                    $pic = $kodeAreaCabang.'_'.$gbr[0];
                    $pic2 = $kodeAreaCabang.'_'.$gbr[1];
            }

        $kodeAreaCabangtrim = trim($kodeAreaCabang); 
        $NilaiFranchisee =  str_replace(array('Rp ',',00','.'), '', $this->request->getPost('NilaiFranchisee'));
        $tahunBerakhir =  $this->request->getPost('tahunBerakhir');
        $tahunBerlaku =  $this->request->getPost('tahunBerlaku');
        $TglMou =  $this->request->getPost('TglMou');
        $NoMOU =  $this->request->getPost('NoMOU');
        $total =  str_replace(array('Rp ',',00','.'), '', $this->request->getPost('total'));
        $Diskon = str_replace(array('Rp ',',00','.'), '', $this->request->getPost('Diskon'));
        //$FFID =  "PF-$kodeAreaCabangtrim-1";
        $Keterangan = $this->request->getPost('Keterangan');
        $RecIDff = $this->request->getPost('RecIDff');
        
        $TanggalBerlaku = $this->request->getPost('hariBerlaku');
        $bulanBerlaku = $this->request->getPost('bulanBerlaku');
        $berlaku =  $TanggalBerlaku . '-' . $bulanBerlaku . '-' . $tahunBerlaku;
        $berlaku1 = strtotime($berlaku);
        $berlaku2 = date ('Y-m-d',$berlaku1);
        
        $TanggalBerakhir =$this->request->getPost('hariBerakhir');
        $bulanBerakhir = $this->request->getPost('bulanBerakhir');
        $berakhir =  $TanggalBerakhir . '-' . $bulanBerakhir . '-' . $tahunBerakhir;
        $berakhir1 = strtotime($berakhir);
        $berakhir2 = date ('Y-m-d',$berakhir1);

        $cabang->NamaAreaCabang = $this->request->getPost("NamaCabang");
        $cabang->Area = $this->request->getPost("Area");
        $cabang->TanggalBerlaku = $berlaku2;
        $cabang->TanggalBerakhir = $berakhir2;
        $cabang->Alamat = $this->request->getPost("Alamat");
        $cabang->Propinsi = $this->request->getPost("Propinsi");
        $cabang->Kota = $this->request->getPost("Kota");
        $cabang->KodePos = $this->request->getPost("KodePos");
        $cabang->NoTelp = $this->request->getPost("NoTelp");
        $cabang->NamaManager = $this->request->getPost("NamaManager");
        $cabang->NoHandPhone = $this->request->getPost("NoHandPhone");
        $cabang->AlamatKC = $this->request->getPost("AlamatKpl");
        $cabang->Email = $this->request->getPost("Email");
        // NEW ADDED
        $cabang->Aktif = is_null($this->request->getPost("Aktif")) ? FALSE : TRUE;
        $cabang->NamaFranchisee = $this->request->getPost("NamaFranchisee");
        $cabang->EmailFranchisee = $this->request->getPost("EmailFranchisee");
        $cabang->NoTelpFranchisee = $this->request->getPost("NoTelpFranchisee");
        $cabang->AlamatFranchisee = $this->request->getPost("AlamatFranchisee");
        $cabang->NoRekBCA = $this->request->getPost("NoRekBCA", "int")?:NULL;
        $cabang->NamaRekBCA = $this->request->getPost("NamaRekBCA", "upper")?:NULL;
//      $cabang->NoRekMandiri = $this->request->getPost("NoRekMandiri", "int");
//      $cabang->NamaRekMandiri = $this->request->getPost("NamaRekMandiri", "upper");
        //$cabang->KodeAreaCabang = $this->request->getPost("KodeCabang", "int");
        $cabang->KodeBankNonBCA = $this->request->getPost("KodeBankNonBCA", "int")?:NULL;
        $cabang->NoRekNonBCA = $this->request->getPost("NoRekNonBCA", "int")?:NULL;
        $cabang->NamaRekNonBCA = $this->request->getPost("NamaRekNonBCA", "upper")?:NULL;
        $cabang->NoKTP = $this->request->getPost("NoKTP")?:NULL;
        $cabang->NoNPWP = $this->request->getPost("NoNPWP")?:NULL;
        $cabang->TDP = $this->request->getPost("TDP")?:NULL;
        $cabang->SIUP = $this->request->getPost("SIUP")?:NULL;
        $cabang->kplcab = $this->request->getPost("Kplcabang")?:NULL;
        $cabang->TKC = $this->request->getPost("TelpKplcabang")?:NULL;
        $cabang->AlamatKC = $this->request->getPost("AlamatKC")?:NULL;
        $cabang->PAC = $this->request->getPost("PAC")?:NULL;
        $cabang->telpPAC = $this->request->getPost("telpPAC")?:NULL;
        $cabang->Ismart = $this->request->getPost("Ismart","upper")?:NULL;
        $cabang->TelpIsmart = $this->request->getPost("TelpIsmart","upper")?:NULL;
        $cabang->Statuskepemilikan = $this->request->getPost("Statuskepemilikan")?:NULL;
        $cabang->YStatuskepemilikan = $this->request->getPost("Yanglain")?:NULL;
        $cabang->Bentuk = $this->request->getPost("Bentuk")?:NULL;
        $cabang->StatusB = $this->request->getPost("StatusB")?:NULL;
        $cabang->Direktur = $this->request->getPost("Direktur")?:NULL;
        if($gbr!=''){
        $cabang ->KTP = $pic;
        $cabang ->NPWP = $pic2;   
        }
        if (!$cabang->save()) {
            foreach ($cabang->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "cabang",
                "action" => "editff",
                "params" => array($cabang->RecID)
            ));
        }
      
        $Update = "UPDATE pembayaranfranchisee SET NilaiFranchisee='$NilaiFranchisee', TglMou='$TglMou', Total='$total', TahunMulai='$tahunBerlaku', TahunAkhir='$tahunBerakhir',Keterangan='$Keterangan', Diskon='$Diskon', AwalKontrak='$berlaku2', AkhirKontrak='$berakhir2', NoMOU='$NoMOU' WHERE RecID = '$RecIDff'"; 
        $query = $this->getDI()->getShared('db')->query($Update);

        $this->flash->success("Data cabang berhasil diubah");
        return $this->forward("cabang/ff");

    }
    
    public function renewalAction()
    {

        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        //$this->tag->setDefault('AreaID', $this->auth['areacabang']);
        $this->view->auth = $this->auth;
    }


    public function renewalffAction()
    {
        $RecID = $this->request->getPost("Cabang");
        $cabang = Areacabang::findFirstByRecID($RecID);

        $sql = "SELECT 'PF-'+KodeCabang + '-' + CAST(SUBSTRING(FranchisefeeID,9,1)+1 as varchar(10)) as FFID from Pembayaranfranchisee where KodeCabang = $cabang->KodeAreaCabang";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->ffid = $query->fetchAll($query);      

        $sql3 = str_replace(['%%'],[$cabang->KodeAreaCabang], $this->sql3);
        $query3 = $this->getDI()->getShared('db')->query($sql3);
        $query3->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query3->fetchAll($query3);  

        $this->view->cabang = $cabang->KodeAreaCabang.' - '.$cabang->NamaAreaCabang;
        $this->view->kodeAreaCabang = $cabang->KodeAreaCabang;
    }
	
    private function addFilter($RecID = NULL) {
        if ($this->auth["areaparent"]) {
            // FROM CABANG
            $query = new Criteria();
            $query->andWhere("Areacabang.RecID = :cabang:", ["cabang" => $this->auth["areacabang"]]);
        } else if ($this->auth["areacabang"]) {
            // FROM AREA MANAGER
            $query = new Criteria();
            $query->join("Areacabang", "Areacabang.Area = a.KodeAreaCabang", "a");
            $query->andWhere("a.RecID = :area:", ["area" => $this->auth["areacabang"]]);
        } else {
            // FROM SUPER ADMIN
            $query = Criteria::fromInput($this->di, "Areacabang", $_POST);
            $query->andWhere("Areacabang.Area IS NOT NULL");
            if (!is_null($RecID)) {
                $query->andWhere("Areacabang.RecID = :recid:", ["recid" => $RecID]);
            }
        }
        return $query;
    }

    public function saverenewalAction()
    {
        $ffidold = $this->request->getPost('ffidold');
        $kodecabang = $this->request->getPost('kodecabang');
        $ffid = $this->request->getPost('ffid');
        $saldoawal = $this->request->getPost('saldoawal');
        $kodeAreaCabangtrim = trim($kodecabang); 
        $NilaiFranchisee =  str_replace(array('Rp ',',00','.'), '', $this->request->getPost('NilaiFranchisee'));
        $tahunBerakhir =  $this->request->getPost('tahunBerakhir');
        $tahunBerlaku =  $this->request->getPost('tahunBerlaku');
        $TglMou =  $this->request->getPost('TglMou');
        $NoMOU =  $this->request->getPost('NoMOU');
        $total =  str_replace(array('Rp ',',00','.'), '', $this->request->getPost('total'));
        $Diskon = str_replace(array('Rp ',',00','.'), '', $this->request->getPost('Diskon'));
        $Keterangan = $this->request->getPost('Keterangan');

        $TanggalBerlaku = $this->request->getPost('hariBerlaku');
        $bulanBerlaku = $this->request->getPost('bulanBerlaku');
        $berlaku =  $TanggalBerlaku . '-' . $bulanBerlaku . '-' . $tahunBerlaku;
        $berlaku1 = strtotime($berlaku);
        $berlaku2 = date ('Y-m-d',$berlaku1);
        
        $TanggalBerakhir =$this->request->getPost('hariBerakhir');
        $bulanBerakhir = $this->request->getPost('bulanBerakhir');
        $berakhir =  $TanggalBerakhir . '-' . $bulanBerakhir . '-' . $tahunBerakhir;
        $berakhir1 = strtotime($berakhir);
        $berakhir2 = date ('Y-m-d',$berakhir1);
      
        $insert = "INSERT into pembayaranfranchisee (RecID,KodeCabang, NilaiFranchisee, TglMou, Total, TahunMulai, TahunAkhir,Keterangan, FranchiseFeeID,Diskon, AwalKontrak, AkhirKontrak, NoMOU, SaldoAwal)
        values((SELECT ISNULL(MAX(RecID) + 1, 0) FROM pembayaranfranchisee), '$kodeAreaCabangtrim','$NilaiFranchisee','$TglMou','$total','$tahunBerlaku','$tahunBerakhir','$Keterangan','$ffid','$Diskon','$berlaku2','$berakhir2','$NoMOU','$saldoawal')"; 
        $query = $this->getDI()->getShared('db')->query($insert);

        $Update = "UPDATE pembayaranfranchisee SET TidakAktif = '1' WHERE FranchiseFeeID = '$ffidold'"; 
        $query = $this->getDI()->getShared('db')->query($Update);

        $this->flash->success("Data perpanjangan franchisee berhasil ditambahkan...");
        return $this->forward("cabang/renewal");
    }

    public function indexreportAction() {
        $this->view->rpt_title = 'Data Cabang Aktif / Non-Aktif';
        $this->persistent->parameters = null;
    }

    public function reportaktifAction()
    {
       
        $this->view->rpt_title = 'Laporan Data Cabang Aktif';
        $aktif = 1;
        
        $sql = str_replace(['%%'],[$aktif], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->result = $query->fetchAll($query);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $this->view->today = date('Y-m-d');
    }

    public function reportnonaktifAction()
    {
       
        $this->view->rpt_title = 'Laporan Data Cabang Non-Aktif';
        $aktif = 0;
        
        $sql = str_replace(['%%'],[$aktif], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->result = $query->fetchAll($query);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $this->view->today = date('Y-m-d');
    }

    private function validateSession(Areacabang $cabang) {
        if ($this->auth['areaparent']) {
            // FROM CABANG
            return $cabang->RecID == $this->auth['areacabang'] ? : FALSE;
        } else if ($this->auth['areacabang']) {
            // FROM AREA
            return $cabang->Area == $this->auth['kodeareacabang'] ? : FALSE;
        }
        // FROM ADMIN
        return TRUE;
    }
}