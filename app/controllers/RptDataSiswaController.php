<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;

class RptDataSiswaController extends ControllerBase {

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Laporan Data Siswa");
        parent::initialize();
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }

    public function indexAction() {

    $this->view->cabangtx = $this->getTransaction();

    }

    public function aktivasiAction() {

    //$this->view->cabangtx = $this->getTransaction();

    }
    
    public function searchAction() {

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->rpt_title = 'Laporan Data Siswa';

        $Cabang = $this->request->getPost("Cabang");
        $ta = $this->request->getPost("TA");

        $this->view->cabang = areacabang::findFirstByRecID($Cabang);
        $this->view->ta = $ta;

        $Siswa = Siswa::query()
                    ->columns(array("Siswa.NamaSiswa,Siswa.VirtualAccount,
                        Siswa.TempatLahir,Siswa.TanggalLahir,
                        Siswa.Agama,Siswa.TeleponSiswa,Siswa.JenisKelamin,Siswa.Alamat,Siswa.NamaAyah,Siswa.NamaIbu,Siswa.EmailSiswa,Siswa.TeleponAyah, Siswa.TeleponIbu,
                        c.NamaProgram,Siswa.AsalSekolah"))
                    ->join('programsiswa','Siswa.RecID = b.Siswa', 'b')
                    ->join('program','b.Program = c.RecID','c')
                    ->leftjoin('areacabang','Siswa.Cabang = d.RecId','d')
                    ->where("d.RecId = '$Cabang' and c.tahunajaran = '$ta'")
                    ->execute();

        $paginator = new Paginator(array(
            "data" => $Siswa,
            "limit" => 10000,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    public function searchaktivasiAction() {

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->rpt_title = 'Laporan Data Siswa';

        $DateFrom = $this->request->getPost("DateFrom");
        $DateTo = $this->request->getPost("DateTo");

        $this->view->DateFrom = $this->request->getPost("DateFrom");
        $this->view->DateTo = $this->request->getPost("DateTo");

        $Siswa = Siswa::query()
                    ->columns(array("Siswa.NamaSiswa,
                        SUBSTRING(d.KodeAreaCabang,0,5)+Siswa.VirtualAccount As NoVA,
                        Siswa.TeleponSiswa,Siswa.EmailSiswa,Siswa.AktivasiCreatedAt,e.NamaAreaCabang as Area,d.KodeAreaCabang,d.NamaAreaCabang"))
                    ->join('programsiswa','Siswa.RecID = b.Siswa', 'b')
                    ->join('program','b.Program = c.RecID','c')
                    ->leftjoin('areacabang','Siswa.Cabang = d.RecId','d')
                    ->leftjoin('areacabang','d.Area = e.KodeAreaCabang','e')
                    ->where("Siswa.AktivasiCreatedAt <= '$DateTo' and Siswa.AktivasiCreatedAt >= '$DateFrom' and Siswa.EmailSiswa != '' and d.KodeAreaCabang != '9999' and Siswa.Aktivasi = '1'")
                    ->orderBy("Siswa.AktivasiCreatedAt")
                    ->execute();

        $paginator = new Paginator(array(
            "data" => $Siswa,
            "limit" => 10000,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    private function getTransaction() {
        $column = ['a.RecId', 'a.KodeAreaCabang + " - " + a.NamaAreaCabang AS NamaCabang'];

        $query = $this->modelsManager->createBuilder()
                ->columns($column)->groupBy($groupBy)
                ->addFrom('areacabang', 'a')
                ->join('areacabang', 'a.Area = b.KodeAreaCabang', 'b')
                ->orderBy('a.KodeAreaCabang');
    
        return $query->getQuery()->execute()->setHydrateMode(Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
    }
}
