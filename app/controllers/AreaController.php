<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class AreaController extends ControllerBase
{

    public function indexAction() {
        $this->persistent->parameters = null;
    }

    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Areacabang", $_POST);
            $query->andWhere("Area IS NULL");
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "KodeAreaCabang";

        $area = Areacabang::find($parameters);

        if (count($area) == 0) {
            $this->flash->notice("The search did not find any area");

            return $this->dispatcher->forward(array(
                "controller" => "area",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $area,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    public function newAction() {
        $this->view->propinsi = Propinsi::find();
    }
    
    public function editAction($RecID) {
        if (!$this->request->isPost()) {
            $area = Areacabang::findFirstByRecID($RecID);
            if (!$area) {
                $this->flash->error("area was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "area",
                    "action" => "index"
                ));
            }

            $this->view->RecID = $area->RecID;
            $this->view->propinsi = Propinsi::find();
            $this->view->kotakab = Kotakab::find();
             
            $this->tag->setDefault("RecID", $area->RecID);
            $this->tag->setDefault("NamaCabang", $area->NamaAreaCabang);
            $this->tag->setDefault("Alamat", $area->Alamat);
            $this->tag->setDefault("Propinsi", $area->Propinsi);
            $this->tag->setDefault("Kota", $area->Kota);
            $this->tag->setDefault("KodePos", $area->KodePos);
            $this->tag->setDefault("NoTelp", $area->NoTelp);
            $this->tag->setDefault("NamaManager", $area->NamaManager);
            $this->tag->setDefault("NoHandPhone", $area->NoHandPhone);
            $this->tag->setDefault("Email", $area->Email);
        }
    }
    
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "area",
                "action" => "index"
            ));
        }

        $area = new Areacabang();

        $area->NamaAreaCabang = $this->request->getPost("NamaCabang");
        $area->Alamat = $this->request->getPost("Alamat");
        $area->Propinsi = $this->request->getPost("Propinsi");
        $area->Kota = $this->request->getPost("Kota");
        $area->KodePos = $this->request->getPost("KodePos");
        $area->NoTelp = $this->request->getPost("NoTelp");
        $area->NamaManager = $this->request->getPost("NamaManager");
        $area->NoHandPhone = $this->request->getPost("NoHandPhone");
        $area->Email = $this->request->getPost("Email");
        
        

        if (!$area->save()) {
            foreach ($area->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "area",
                "action" => "new"
            ));
        }

        $this->flash->success("area was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "area",
            "action" => "index"
        ));
    }
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "area",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $area = Areacabang::findFirstByRecID($RecID);
        if (!$area) {
            $this->flash->error("area does not exist " . $RecID);

            return $this->dispatcher->forward(array(
                "controller" => "area",
                "action" => "index"
            ));
        }

        $area->NamaAreaCabang = $this->request->getPost("NamaCabang");
        $area->Alamat = $this->request->getPost("Alamat");
        $area->Propinsi = $this->request->getPost("Propinsi");
        $area->Kota = $this->request->getPost("Kota");
        $area->KodePos = $this->request->getPost("KodePos");
        $area->NoTelp = $this->request->getPost("NoTelp");
        $area->NamaManager = $this->request->getPost("NamaManager");
        $area->NoHandPhone = $this->request->getPost("NoHandPhone");
        $area->Email = $this->request->getPost("Email");
        

        if (!$area->save()) {

            foreach ($area->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "area",
                "action" => "edit",
                "params" => array($area->RecID)
            ));
        }

        $this->flash->success("area was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "area",
            "action" => "index"
        ));

    }
    public function deleteAction($RecID)
    {

        $area = Areacabang::findFirstByRecID($RecID);
        if (!$area) {
            $this->flash->error("area was not found");

            return $this->dispatcher->forward(array(
                "controller" => "area",
                "action" => "index"
            ));
        }

        if (!$area->delete()) {

            foreach ($area->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "area",
                "action" => "index"
            ));
        }

        $this->flash->success("area was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "area",
            "action" => "index"
        ));
    }
}
