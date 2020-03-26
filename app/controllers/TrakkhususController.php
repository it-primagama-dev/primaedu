<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class TrakkhususController extends ControllerBase
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
