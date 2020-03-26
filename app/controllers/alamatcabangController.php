<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class AlamatcabangController extends ControllerBase
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
            return $this->forward('alamatcabang/index');
        }

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->result = $rptcabang;
        $this->view->kota = Kotakab::find();
        $this->view->propinsi = Propinsi::find();
    }

    public function logistikAction() {
        $this->persistent->parameters = null;
    }

    public function searchlogistikAction()
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
            return $this->forward('alamatcabang/index');
        }

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->result = $rptcabang;
        $this->view->kota = Kotakab::find();
        $this->view->propinsi = Propinsi::find();
        $this->view->judul = $this->request->getPost('Judul');
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
