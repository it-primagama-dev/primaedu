
<?php

use Phalcon\Paginator\Adapter\Model as Paginator;

class BarcodebukuController extends ControllerBase { 

     public function initialize() {
       parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Packing Slip susulan';
    }
     
     
    public function indexAction() { 
    //    $this->persistent->parameters = null;
        
        $numberPage = 1;
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }

        $cabang = $this->auth['areacabang'];
        $barcode = $this->modelsManager->createBuilder()
                 ->columns(array('(SUBSTRING(areacabang.KodeAreaCabang,0,5)+siswa.VirtualAccount) as NoVA, siswa.NamaSiswa as nama, program.NamaProgram as program, bukusiswa.SerialNumber as barcode, bukusiswa.TanggalTerima as tgl, siswa.Aktivasi as aktivasi'))
                ->from('bukusiswa')
                ->join("programsiswa","bukusiswa.ProgramSiswa = programsiswa.RecID")
                ->join("program", "programsiswa.Program = program.RecID")
                ->join("siswa", "programsiswa.Siswa = siswa.RecID")  
                ->join("areacabang", "siswa.Cabang = areacabang.RecID")  
                ->where("areacabang.RecID = '$cabang'")
                ->orderby("siswa.VirtualAccount DESC")
                ->getQuery()
                ->execute();

        $paginator = new Paginator(array(
                    "data" => $barcode,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();

        $this->view->setVar("session",$this->session->get('auth'));
    }

    public function cariAction() { 
    //    $this->persistent->parameters = null;
        
        $numberPage = 1;
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }

  //      $cabang = $this->session->has('auth') ? $this->session->get('auth')['areacabang'] : '';

        $where = "Deliveryreqheader.Status = 'Approved' Order by Deliveryreqheader.RecId DESC";

        $kode = $this->request->getPost("KodeCabang");

        $cabang = $this->auth['areacabang'];
        $barcode = $this->modelsManager->createBuilder()
                 ->columns(array('(SUBSTRING(areacabang.KodeAreaCabang,0,5)+siswa.VirtualAccount) as NoVA, siswa.NamaSiswa as nama, program.NamaProgram as program, bukusiswa.SerialNumber as barcode, bukusiswa.TanggalTerima as tgl, siswa.Aktivasi as aktivasi'))
                ->from('bukusiswa')
                ->join("programsiswa","bukusiswa.ProgramSiswa = programsiswa.RecID")
                ->join("program", "programsiswa.Program = program.RecID")
                ->join("siswa", "programsiswa.Siswa = siswa.RecID")  
                ->join("areacabang", "siswa.Cabang = areacabang.RecID")  
                ->where("areacabang.RecID = '$cabang' and (SUBSTRING(areacabang.KodeAreaCabang,0,5)+siswa.VirtualAccount) like '%$kode%' or areacabang.RecID = '$cabang' and bukusiswa.SerialNumber like '%$kode%' or areacabang.RecID = '$cabang' and siswa.NamaSiswa like '%$kode%'")
                ->orderby("siswa.VirtualAccount DESC")
                ->getQuery()
                ->execute();

        $paginator = new Paginator(array(
                    "data" => $barcode,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();

        $this->view->setVar("session",$this->session->get('auth'));
    }

}
