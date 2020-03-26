<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CabangviewController extends ControllerBase
{
    protected $auth;

    protected $isAdmin;

    public function initialize() {
        $this->tag->setTitle("Data Cabang View");
        parent::initialize();
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
            $this->isAdmin = $this->auth["areacabang"] ? FALSE : TRUE;
            $this->view->admin = $this->isAdmin;
        }
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
            return $this->forward('cabangview/index');
        }

        $paginator = new Paginator(array(
            "data" => $cabang,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    public function newAction() {
        if (!$this->isAdmin) {
            return $this->forward("cabangview/index");
        }
        $this->view->area = Areacabang::find(array(
                    "Area IS NULL", "order" => "KodeAreaCabang"
        ));
        $this->view->propinsi = Propinsi::find();
        $this->view->bank = Bank::find();
    }

    public function editAction($RecID) {
        if (!$this->request->isPost()) {
            // TOC-RB 3 Juli 2015
            $cabang = Areacabang::findFirstByRecID($RecID);
            if (!$cabang) {
                $this->flash->error("Data cabang tidak dapat ditemukan");
                return $this->forward("cabangview/index");
            }
            // TOC-RB 3 Juli 2015
            if (!$this->validateSession($cabang)) {
                $this->flash->error("Data cabang tidak dapat ditemukan");
                return $this->forward("cabangview/index");
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
    
    public function createAction()
    {

        if (!($this->request->isPost() && $this->isAdmin)) {
            return $this->forward('cabangview/index');
        }

        $cabang = new Areacabang();

        $cabang->NamaAreaCabang = $this->request->getPost("NamaCabang");
        $cabang->Area = $this->request->getPost("Area");
        $cabang->TanggalBerlaku = $this->request->getPost("TanggalBerlaku")?:NULL;;
        $cabang->TanggalBerakhir = $this->request->getPost("TanggalBerakhir")?:NULL;;
        $cabang->Alamat = $this->request->getPost("Alamat");
        $cabang->Propinsi = $this->request->getPost("Propinsi");
        $cabang->Kota = $this->request->getPost("Kota");
        $cabang->KodePos = $this->request->getPost("KodePos");
        $cabang->NoTelp = $this->request->getPost("NoTelp");
        $cabang->NamaManager = $this->request->getPost("NamaManager");
        $cabang->NoHandPhone = $this->request->getPost("NoHandPhone");
        $cabang->Email = $this->request->getPost("Email");
        // NEW ADDED
        $cabang->Aktif = is_null($this->request->getPost("Aktif")) ? FALSE : TRUE;
        $cabang->NamaFranchisee = $this->request->getPost("NamaFranchisee");
        $cabang->EmailFranchisee = $this->request->getPost("EmailFranchisee");
        $cabang->NoTelpFranchisee = $this->request->getPost("NoTelpFranchisee");
        $cabang->NoRekBCA = $this->request->getPost("NoRekBCA", "int")?:NULL;
        $cabang->NamaRekBCA = $this->request->getPost("NamaRekBCA", "upper")?:NULL;
//        $cabang->NoRekMandiri = $this->request->getPost("NoRekMandiri", "int");
//        $cabang->NamaRekMandiri = $this->request->getPost("NamaRekMandiri", "upper");
        $cabang->KodeAreaCabang = $this->request->getPost("KodeCabang", "int");
        $cabang->KodeBankNonBCA = $this->request->getPost("KodeBankNonBCA", "int")?:NULL;
        $cabang->NoRekNonBCA = $this->request->getPost("NoRekNonBCA", "int")?:NULL;
        $cabang->NamaRekNonBCA = $this->request->getPost("NamaRekNonBCA", "upper")?:NULL;

        if (!$cabang->save()) {
            foreach ($cabang->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('cabangview/new');
        }

        $this->flash->success("Data cabang berhasil ditambahkan");
        return $this->forward('cabangview/index');
    }
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('cabangview/index');
        }
        // TOC-RB 03 Juli 2015
        $cabang = Areacabang::findFirstByRecID($this->request->getPost("RecID"));

        if (!$cabang) {
            $this->flash->error("Data cabang tidak dapat ditemukan");
            return $this->forward('cabangview/index');
        }
        if (!$this->validateSession($cabang)) {
            $this->flash->error("Data cabang tidak dapat ditemukan");
            return $this->forward('cabangview/index');
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
                "controller" => "cabangview",
                "action" => "edit",
                "params" => array($cabang->RecID)
            ));
        }

        $this->flash->success("Data cabang berhasil diubah");
        return $this->forward("cabangview/index");

    }
//    public function deleteAction($RecID)
//    {
//
//        $cabang = Areacabang::findFirstByRecID($RecID);
//        if (!$cabang) {
//            $this->flash->error("cabang was not found");
//  
//            return $this->dispatcher->forward(array(
//                "controller" => "cabang",
//                "action" => "index"
//            ));
//        }
//
//        if (!$cabang->delete()) {
//
//            foreach ($cabang->getMessages() as $message) {
//                $this->flash->error($message);
//            }
//
//            return $this->dispatcher->forward(array(
//                "controller" => "cabang",
//                "action" => "index"
//            ));
//        }
//
//        $this->flash->success("cabang was deleted successfully");
//
//        return $this->dispatcher->forward(array(
//            "controller" => "cabang",
//            "action" => "index"
//        ));
//    }

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
