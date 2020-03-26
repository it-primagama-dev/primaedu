<?php

class CabangcetakController extends ControllerBase
{

    protected $auth;

   

    public function initialize() {
        $this->tag->setTitle('Laporan Data Cabang');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Data Cabang Aktif';
    }

    public function indexAction() {

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);

        $cabang = Areacabang::query()
                ->columns("Areacabang.NamaAreaCabang as area, b.KodeAreaCabang as KodeCabang,b.NamaAreaCabang as cabang, b.Alamat as alamat")
                ->join("Areacabang", "Areacabang.KodeAreaCabang=b.Area","b")
               ->where("b.KodeAreaCabang != '9999' AND b.aktif=1")
               ->orderBy("area")
              ->execute();

        $this->view->result = $cabang;
	

    }

    public function alamatAction() {

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);

        $cabang = Areacabang::query()
                ->columns("Areacabang.NamaAreaCabang as area, b.NamaManager as namamanager, b.KodeAreaCabang as KodeCabang,b.NamaAreaCabang as cabang, b.Alamat as alamat, b.NoTelp as telp, b.NoHandphone as nohp")
                ->join("Areacabang", "Areacabang.KodeAreaCabang=b.Area","b")
               ->where("b.KodeAreaCabang != '9999' and b.Aktif = '1'")
               ->orderBy("area")
              ->execute();

        $this->view->result = $cabang;
    

    }

}

