<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class RptCabangController extends ControllerBase
{
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
        $rptcabang = Areacabang::find($parameters);

        if (count($rptcabang) == 0) {
            $this->flash->notice("Data cabang tidak dapat ditemukan");
            return $this->forward('rptcabang/index');
        }

        $paginator = new Paginator(array(
            "data" => $rptcabang,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    public function newAction() {
        if (!$this->isAdmin) {
            return $this->forward("rptcabang/index");
        }
        $this->view->area = Areacabang::find(array(
                    "Area IS NULL", "order" => "KodeAreaCabang"
        ));
        $this->view->propinsi = Propinsi::find();
        $this->view->bank = Bank::find();
    }

    public function detailAction($RecID) {
        if (!$this->request->isPost()) {
            // TOC-RB 3 Juli 2015
            $rptcabang = Areacabang::findFirstByRecID($RecID);
            if (!$rptcabang) {
                $this->flash->error("Data cabang tidak dapat ditemukan");
                return $this->forward("rptcabang/index");
            }
            // TOC-RB 3 Juli 2015
            if (!$this->validateSession($rptcabang)) {
                $this->flash->error("Data cabang tidak dapat ditemukan");
                return $this->forward("rptcabang/index");
            }

            $this->tag->setDefaults($rptcabang->toArray());
            $this->tag->setDefault("NamaCabang", $rptcabang->NamaAreaCabang);
            // View Components
            $this->view->RecID = $rptcabang->RecID;
            $this->view->area = Areacabang::find(array(
                "Area IS NULL", "order" => "KodeAreaCabang"
            ));
            $this->view->propinsi = Propinsi::find();
            $this->view->kotakab = Kotakab::findByPropinsi($rptcabang->Propinsi);
            $this->view->branchcode = $rptcabang->KodeAreaCabang;
            $this->view->bank = Bank::find();
        }
    }
    
    public function createAction()
    {

        if (!($this->request->isPost() && $this->isAdmin)) {
            return $this->forward('rptcabang/index');
        }

        $rptcabang = new Areacabang();

        $rptcabang->NamaAreaCabang = $this->request->getPost("NamaCabang");
        $rptcabang->Area = $this->request->getPost("Area");
        $rptcabang->TanggalBerlaku = $this->request->getPost("TanggalBerlaku")?:NULL;;
        $rptcabang->TanggalBerakhir = $this->request->getPost("TanggalBerakhir")?:NULL;;
        $rptcabang->Alamat = $this->request->getPost("Alamat");
        $rptcabang->Propinsi = $this->request->getPost("Propinsi");
        $rptcabang->Kota = $this->request->getPost("Kota");
        $rptcabang->KodePos = $this->request->getPost("KodePos");
        $rptcabang->NoTelp = $this->request->getPost("NoTelp");
        $rptcabang->NamaManager = $this->request->getPost("NamaManager");
        $rptcabang->NoHandPhone = $this->request->getPost("NoHandPhone");
        $rptcabang->Email = $this->request->getPost("Email");
        // NEW ADDED
        $rptcabang->Aktif = is_null($this->request->getPost("Aktif")) ? FALSE : TRUE;
        $rptcabang->NamaFranchisee = $this->request->getPost("NamaFranchisee");
        $rptcabang->EmailFranchisee = $this->request->getPost("EmailFranchisee");
        $rptcabang->NoTelpFranchisee = $this->request->getPost("NoTelpFranchisee");
        $rptcabang->NoRekBCA = $this->request->getPost("NoRekBCA", "int")?:NULL;
        $rptcabang->NamaRekBCA = $this->request->getPost("NamaRekBCA", "upper")?:NULL;
//        $rptcabang->NoRekMandiri = $this->request->getPost("NoRekMandiri", "int");
//        $rptcabang->NamaRekMandiri = $this->request->getPost("NamaRekMandiri", "upper");
        $rptcabang->KodeAreaCabang = $this->request->getPost("KodeCabang", "int");
        $rptcabang->KodeBankNonBCA = $this->request->getPost("KodeBankNonBCA", "int")?:NULL;
        $rptcabang->NoRekNonBCA = $this->request->getPost("NoRekNonBCA", "int")?:NULL;
        $rptcabang->NamaRekNonBCA = $this->request->getPost("NamaRekNonBCA", "upper")?:NULL;

        if (!$rptcabang->save()) {
            foreach ($rptcabang->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('rptcabang/new');
        }

        $this->flash->success("Data cabang berhasil ditambahkan");
        return $this->forward('rptcabang/index');
    }
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('rptcabang/index');
        }
        // TOC-RB 03 Juli 2015
        $rptcabang = Areacabang::findFirstByRecID($this->request->getPost("RecID"));

        if (!$rptcabang) {
            $this->flash->error("Data cabang tidak dapat ditemukan");
            return $this->forward('rptcabang/index');
        }
        if (!$this->validateSession($rptcabang)) {
            $this->flash->error("Data cabang tidak dapat ditemukan");
            return $this->forward('rptcabang/index');
        }
        $rptcabang->Alamat = $this->request->getPost("Alamat");
        $rptcabang->Propinsi = $this->request->getPost("Propinsi");
        $rptcabang->Kota = $this->request->getPost("Kota");
        $rptcabang->KodePos = $this->request->getPost("KodePos");
        $rptcabang->NoTelp = $this->request->getPost("NoTelp");
        $rptcabang->NamaManager = $this->request->getPost("NamaManager");
        $rptcabang->NoHandPhone = $this->request->getPost("NoHandPhone");

        if ($this->isAdmin) {
            $rptcabang->Email = $this->request->getPost("Email");
            $rptcabang->NamaAreaCabang = $this->request->getPost("NamaCabang");
            $rptcabang->Area = $this->request->getPost("Area");
            $rptcabang->TanggalBerlaku = $this->request->getPost("TanggalBerlaku") ? : NULL;
            $rptcabang->TanggalBerakhir = $this->request->getPost("TanggalBerakhir") ? : NULL;
            // NEW ADDED
            $rptcabang->Aktif = is_null($this->request->getPost("Aktif")) ? FALSE : TRUE;
            $rptcabang->NamaFranchisee = $this->request->getPost("NamaFranchisee");
            $rptcabang->EmailFranchisee = $this->request->getPost("EmailFranchisee");
            $rptcabang->NoTelpFranchisee = $this->request->getPost("NoTelpFranchisee");
            $rptcabang->NoRekBCA = $this->request->getPost("NoRekBCA", "int")?:NULL;
            $rptcabang->NamaRekBCA = $this->request->getPost("NamaRekBCA", "upper")?:NULL;
            $rptcabang->KodeBankNonBCA = $this->request->getPost("KodeBankNonBCA", "int")?:NULL;
            $rptcabang->NoRekNonBCA = $this->request->getPost("NoRekNonBCA", "int")?:NULL;
            $rptcabang->NamaRekNonBCA = $this->request->getPost("NamaRekNonBCA", "upper")?:NULL;
        }

        if (!$rptcabang->save()) {
            foreach ($rptcabang->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "cabang",
                "action" => "edit",
                "params" => array($rptcabang->RecID)
            ));
        }

        $this->flash->success("Data cabang berhasil diubah");
        return $this->forward("rptcabang/index");

    }
//    public function deleteAction($RecID)
//    {
//
//        $rptcabang = Areacabang::findFirstByRecID($RecID);
//        if (!$rptcabang) {
//            $this->flash->error("cabang was not found");
//  
//            return $this->dispatcher->forward(array(
//                "controller" => "cabang",
//                "action" => "index"
//            ));
//        }
//
//        if (!$rptcabang->delete()) {
//
//            foreach ($rptcabang->getMessages() as $message) {
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

    private function validateSession(Areacabang $rptcabang) {
        if ($this->auth['areaparent']) {
            // FROM CABANG
            return $rptcabang->RecID == $this->auth['areacabang'] ? : FALSE;
        } else if ($this->auth['areacabang']) {
            // FROM AREA
            return $rptcabang->Area == $this->auth['kodeareacabang'] ? : FALSE;
        }
        // FROM ADMIN
        return TRUE;
    }
}
