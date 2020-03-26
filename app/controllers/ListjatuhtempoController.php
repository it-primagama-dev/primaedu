<?php

class ListjatuhtempoController extends ControllerBase
{

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Jatuh Tempo");
        parent::initialize();
        if($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }

    public function indexAction()
    {
        $tanggal = $this->request->getPost("Tanggal", "int") ? : date("Y-m-d");
        $this->view->date = $tanggal;
        if($this->request->isPost()) {           
            $jatuhtempo = $this->modelsManager->createBuilder()
                    ->columns("Pembayaran.JatuhTempo, Pembayaran.SisaPembayaran, p.NamaProgram, s.NamaSiswa, s.VirtualAccount")
                    ->from("Pembayaran")
                    ->join("Programsiswa", "Pembayaran.ProgramSiswa = ps.RecID", "ps")
                    ->join("Siswa", "ps.Siswa = s.RecID", "s")
                    ->join("Program", "ps.Program = p.RecID", "p")
                    ->where("Pembayaran.SisaPembayaran > 0 AND Pembayaran.JatuhTempo <= :tanggal:")
                    ->andWhere("s.Cabang = :cabang:", ["cabang" => $this->auth['areacabang']])
                    ->getQuery()
                    ->execute(["tanggal" => $tanggal]);

            $this->view->jatuhtempo = $jatuhtempo;
        }
    }

}

