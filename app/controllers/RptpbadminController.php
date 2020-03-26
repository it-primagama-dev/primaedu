<?php

use Phalcon\Mvc\Model\Criteria;

class RptpbadminController extends ControllerBase
{

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Inquiry Pembayaran");
        parent::initialize();
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
            $this->_validateSession($this->auth);
        }
    }

    public function indexAction()
    {
        $this->view->cabang = Areacabang::find(['Area IS NOT NULL', 'order' => 'KodeAreaCabang']);
    }

    public function viewAction() {
        if (!$this->request->isPost()) {
            return $this->forward('pbadmin/index');
        }
		
        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);

		
        $cabangId = $this->request->getPost('Cabang', 'int');
        $siswatxt = $this->request->getPost('Siswa');
        $query = Criteria::fromInput($this->di, 'Siswa', ['Cabang' => $cabangId]);
        if ($siswatxt) {
            $query->andWhere("VirtualAccount LIKE :vacc: OR NamaSiswa LIKE :name:",
                    ['vacc' => '%'.$siswatxt.'%', 'name' => '%'.$siswatxt.'%']);
        }
        $siswa = Siswa::find($query->getParams());
        if (count($siswa) == 0) {
            $this->flash->notice('Tidak ada data siswa ditemukan');
            return $this->forward('pbadmin/index');
        }
        $siswaid = [];
        foreach ($siswa as $rec) {
            $siswaid[] = $rec->RecID;
        }
        $this->view->cabang = Areacabang::findFirst($cabangId);
        $this->view->pembayaran = $this->modelsManager->createBuilder()
                ->columns([
                    's.VirtualAccount AS KodeSiswa', 's.NamaSiswa',
                    'p.NamaProgram AS Program', 'pb.RecID AS Pembayaran',
                    'pb.JumlahTotal', 'pb.JatuhTempo', 'pb.PembayaranTipe',
                    'pb.AngsuranKe', 'pb.SisaPembayaran'])
                ->addFrom('Siswa', 's')
                ->join('Programsiswa', 's.RecID = ps.Siswa', 'ps')
                ->join('Pembayaran', 'ps.RecID = pb.ProgramSiswa', 'pb')
                ->join('Program', 'ps.Program = p.RecID', 'p')
                ->inWhere('s.RecID', $siswaid)
                ->orderBy(['p.RecID', 'KodeSiswa'])
                ->getQuery()->execute()
                ->setHydrateMode(Phalcon\Mvc\Model\Resultset::HYDRATE_OBJECTS);
        $this->tag->setDefault('Cabang', $cabangId);
        $this->tag->setDefault('Siswa', $siswatxt);
    }



    private function _validateSession($auth) {
        if ($auth['areacabang'] != 0) {
            return $this->forward('index/index');
        }
    }
}

