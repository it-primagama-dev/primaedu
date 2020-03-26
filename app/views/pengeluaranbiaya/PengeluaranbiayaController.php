<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PengeluaranbiayaController extends ControllerBase {

    protected $auth;

    public function initialize() {
        $this->tag->setTitle('Pengeluaran Biaya');
        parent::initialize();
        
        if ($this->session->has('auth')){
            $this->auth = $this->session->get('auth');
        }
    }

    /**
     * Index action
     */
    public function indexAction() {
        $this->persistent->parameters = null;

        $this->view->setVar("pengeluaran", Pengeluarantipe::find());
        $this->view->tahunajaran = tahunajaran::find();
    }

    /**
     * Searches for pengeluaranbiaya
     */
    public function searchAction() {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Pengeluaranbiaya", $_POST);
            if ($this->auth['areaparent']) {
                $query->andWhere("Cabang = :cabang:", ["cabang" => $this->auth['areacabang']]);
            }
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecId";

        $pengeluaranbiaya = Pengeluaranbiaya::find($parameters);
        if (count($pengeluaranbiaya) == 0) {
            $this->flash->notice("The search did not find any pengeluaranbiaya");

            return $this->dispatcher->forward(array(
                        "controller" => "pengeluaranbiaya",
                        "action" => "index"
                    ));
        }

        $paginator = new Paginator(array(
                    "data" => $pengeluaranbiaya,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        $this->view->setVar("pengeluaran", Pengeluarantipe::find());
        $this->view->biayagroup = Pengeluaranbiayagroup::find();
        $this->view->tahunajaran = tahunajaran::find();
    }

    /**
     * Edits a pengeluaranbiaya
     *
     * @param string $RecId
     */
    public function editAction($RecId) {

        $this->view->setVar("pengeluaran", Pengeluarantipe::find());
        $this->view->biayagroup = Pengeluaranbiayagroup::find();
        $this->view->tahunajaran = tahunajaran::find();

        if (!$this->request->isPost()) {

            $pengeluaranbiaya = Pengeluaranbiaya::findFirstByRecId($RecId);
            if (!$pengeluaranbiaya) {
                $this->flash->error("pengeluaranbiaya was not found");

                return $this->dispatcher->forward(array(
                            "controller" => "pengeluaranbiaya",
                            "action" => "index"
                        ));
            }

            $this->view->RecId = $pengeluaranbiaya->RecId;

            $this->tag->setDefault("RecId", $pengeluaranbiaya->RecId);
            $this->tag->setDefault("BiayaGroup", $pengeluaranbiaya->BiayaGroup);
            $this->tag->setDefault("Pengeluaran", $pengeluaranbiaya->Pengeluaran);
            $this->tag->setDefault("Description", $pengeluaranbiaya->Description);
            $this->tag->setDefault("Tanggal", $pengeluaranbiaya->Tanggal);
            $this->tag->setDefault("Jumlah", $pengeluaranbiaya->Jumlah);
            $this->tag->setDefault("TahunAjaran", $pengeluaranbiaya->TahunAjaran);
            $this->tag->setDefault("CreatedBy", $pengeluaranbiaya->CreatedBy);
        }
    }

    /**
     * Creates a new pengeluaranbiaya
     */
    public function createAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "pengeluaranbiaya",
                        "action" => "index"
                    ));
        }

        $pengeluaranbiaya = new Pengeluaranbiaya();

        $pengeluaranbiaya->Pengeluaran = $this->request->getPost("Pengeluaran");
        $pengeluaranbiaya->BiayaGroup = $this->request->getPost("BiayaGroup");
        $pengeluaranbiaya->Description = $this->request->getPost("Description");
        $pengeluaranbiaya->Tanggal = $this->request->getPost("Tanggal");
        $pengeluaranbiaya->Jumlah = substr($this->request->getPost("Jumlah", "int"), 0 ,-2);
        $pengeluaranbiaya->Cabang = $this->auth["areacabang"];
        $pengeluaranbiaya->CreatedBy = $this->session->auth['username'];
        $pengeluaranbiaya->CreatedDateTime = date('Y-m-d H:i:s');
        $pengeluaranbiaya->TahunAjaran = $this->request->getPost("TahunAjaran");


        if (!$pengeluaranbiaya->save()) {
            foreach ($pengeluaranbiaya->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->response->redirect('pengeluaranbiaya/index');
        }

        $this->flash->success("pengeluaranbiaya was created successfully");

        return $this->response->redirect('pengeluaranbiaya/index');
    }

    /**
     * Saves a pengeluaranbiaya edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "pengeluaranbiaya",
                        "action" => "index"
                    ));
        }

        $RecId = $this->request->getPost("RecId");

        $pengeluaranbiaya = Pengeluaranbiaya::findFirstByRecId($RecId);
        if (!$pengeluaranbiaya) {
            $this->flash->error("pengeluaranbiaya does not exist " . $RecId);

            return $this->dispatcher->forward(array(
                        "controller" => "pengeluaranbiaya",
                        "action" => "index"
                    ));
        }

        $pengeluaranbiaya->Pengeluaran = $this->request->getPost("Pengeluaran");
        $pengeluaranbiaya->BiayaGroup = $this->request->getPost("BiayaGroup");
        $pengeluaranbiaya->Description = $this->request->getPost("Description");
        $pengeluaranbiaya->Tanggal = $this->request->getPost("Tanggal");
        $pengeluaranbiaya->Jumlah = substr($this->request->getPost("Jumlah", "int"), 0 ,-2);
        $pengeluaranbiaya->CreatedBy = $this->session->auth['username'];
        $pengeluaranbiaya->CreatedDateTime = date('Y-m-d H:i:s');
        $pengeluaranbiaya->TahunAjaran = $this->request->getPost("TahunAjaran");


        if (!$pengeluaranbiaya->save()) {

            foreach ($pengeluaranbiaya->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "pengeluaranbiaya",
                        "action" => "edit",
                        "params" => array($pengeluaranbiaya->RecId)
                    ));
        }

        $this->flash->success("pengeluaranbiaya was updated successfully");

        return $this->response->redirect('pengeluaranbiaya/index');
    }

    public function getTipeExpAction($param) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $records = [];
        $kota = Pengeluarantipe::find(array(
            'conditions' => 'BiayaGroup = ?0',
            'order' => 'Description',
            'bind' => array(0 => $this->filter->sanitize($param, "int"))
        ));
        if (!count($kota)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($kota as $record) {
                $records[] = [
                    'id' => $record->RecId,
                    'desc' => $record->Description,
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'listData' => $records
            ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

    /**
     * Deletes a pengeluaranbiaya
     *
     * @param string $RecId
     */
    public function deleteAction($RecId) {

        $pengeluaranbiaya = Pengeluaranbiaya::findFirstByRecId($RecId);
        if (!$pengeluaranbiaya) {
            $this->flash->error("pengeluaranbiaya was not found");

            return $this->dispatcher->forward(array(
                        "controller" => "pengeluaranbiaya",
                        "action" => "index"
                    ));
        }

        if (!$pengeluaranbiaya->delete()) {

            foreach ($pengeluaranbiaya->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "pengeluaranbiaya",
                        "action" => "search"
                    ));
        }

        $this->flash->success("pengeluaranbiaya was deleted successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "pengeluaranbiaya",
                    "action" => "index"
                ));
    }

}
