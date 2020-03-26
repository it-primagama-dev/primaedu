<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class RuanganController extends ControllerBase {

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Ruangan");
        parent::initialize();
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }

    /**
     * Index action
     */
    public function indexAction() {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for ruangan
     */
    public function searchAction() {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Ruangan", $_POST);
            $query->andWhere("Cabang = :cabang:", ["cabang" => $this->auth["areacabang"]]);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecID";

        $ruangan = Ruangan::find($parameters);
        if (count($ruangan) == 0) {
            $this->flash->notice("The search did not find any ruangan");

            return $this->dispatcher->forward(array(
                        "controller" => "ruangan",
                        "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $ruangan,
            "limit" => 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        
    }

    /**
     * Edits a ruangan
     *
     * @param string $RecID
     */
    public function editAction($RecID) {

        if (!$this->request->isPost()) {

            $ruangan = Ruangan::findFirstByRecID($RecID);
            if (!$ruangan) {
                $this->flash->error("ruangan was not found");

                return $this->dispatcher->forward(array(
                            "controller" => "ruangan",
                            "action" => "index"
                ));
            }

            $this->view->RecID = $ruangan->RecID;

            $this->tag->setDefault("RecID", $ruangan->RecID);
            $this->tag->setDefault("KodeRuangan", $ruangan->KodeRuangan);
            $this->tag->setDefault("NamaRuangan", $ruangan->NamaRuangan);
            $this->tag->setDefault("Kapasitas", $ruangan->Kapasitas);
            $this->tag->setDefault("Cabang", $ruangan->Cabang);
        }
    }

    /**
     * Creates a new ruangan
     */
    public function createAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "ruangan",
                        "action" => "index"
            ));
        }

        $ruangan = new Ruangan();

        $ruangan->KodeRuangan = $this->request->getPost("KodeRuangan");
        $ruangan->NamaRuangan = $this->request->getPost("NamaRuangan");
        $ruangan->Kapasitas = $this->request->getPost("Kapasitas", "int");
        $ruangan->Cabang = $this->auth['areacabang'];
        
        if (Ruangan::findFirst([
            "conditions" => "KodeRuangan = ?1 AND Cabang = ?2",
            "bind" => [1 => $ruangan->KodeRuangan, 2 => $this->auth['areacabang']]
        ]) !== FALSE) {
            $this->flash->error("Tambah ruangan gagal. Ruangan dengan kode " . $ruangan->KodeRuangan . " sudah ada");
            return $this->forward('ruangan/new');
        }

        if (!$ruangan->save()) {
            foreach ($ruangan->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "ruangan",
                        "action" => "new"
            ));
        }

        $this->flash->success("Ruangan berhasil ditambahkan");

        return $this->dispatcher->forward(array(
                    "controller" => "ruangan",
                    "action" => "index"
        ));
    }

    /**
     * Saves a ruangan edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "ruangan",
                        "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $ruangan = Ruangan::findFirstByRecID($RecID);
        if (!$ruangan) {
            $this->flash->error("ruangan does not exist " . $RecID);

            return $this->dispatcher->forward(array(
                        "controller" => "ruangan",
                        "action" => "index"
            ));
        }

        $ruangan->KodeRuangan = $this->request->getPost("KodeRuangan");
        $ruangan->NamaRuangan = $this->request->getPost("NamaRuangan");
        $ruangan->Kapasitas = $this->request->getPost("Kapasitas");
        $ruangan->Cabang = $this->session->auth['areacabang'];


        if (!$ruangan->save()) {

            foreach ($ruangan->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "ruangan",
                        "action" => "edit",
                        "params" => array($ruangan->RecID)
            ));
        }

        $this->flash->success("ruangan was updated successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "ruangan",
                    "action" => "index"
        ));
    }

    /**
     * Deletes a ruangan
     *
     * @param string $RecID
     */
    public function deleteAction($RecID) {

        $ruangan = Ruangan::findFirstByRecID($RecID);
        if (!$ruangan) {
            $this->flash->error("ruangan was not found");

            return $this->dispatcher->forward(array(
                        "controller" => "ruangan",
                        "action" => "index"
            ));
        }

        if (!$ruangan->delete()) {

            foreach ($ruangan->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "ruangan",
                        "action" => "search"
            ));
        }

        $this->flash->success("ruangan was deleted successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "ruangan",
                    "action" => "index"
        ));
    }

}
