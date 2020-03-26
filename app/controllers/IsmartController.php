<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class IsmartController extends ControllerBase {

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("I-Smart");
        parent::initialize();
        if($this->session->has("auth")) {
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
     * Searches for ismart
     */
    public function searchAction() {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Ismart", $_POST);
			if($this->auth['areaparent']) {
				$query->andWhere("Cabang = :cabang:", ["cabang" => $this->auth['areacabang']]);
                $query->andWhere("Pendidikan is null");
			}
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecID";

        $ismart = Ismart::find($parameters);
        if (count($ismart) == 0) {
            $this->flash->notice("Data I-Smart Tidak Ditemukan");

            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "index"
                    ));
        }

        $paginator = new Paginator(array(
                    "data" => $ismart,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        $this->view->cabang = Areacabang::find();
		$this->view->propinsi = Propinsi::find();
                $this->view->bidangstudi = Bidangstudi::find();
    }

    /**
     * Edits a ismart
     *
     * @param string $RecID
     */
    public function editAction($RecID) {
        
        $this->view->bidangstudi = Bidangstudi::find();
        $this->view->propinsi = Propinsi::find();

        if (!$this->request->isPost()) {

            $ismart = Ismart::findFirstByRecID($RecID);
            if (!$ismart) {
                $this->flash->error("Data I-Smart Tidak Ditemukan");

                return $this->dispatcher->forward(array(
                            "controller" => "ismart",
                            "action" => "index"
                        ));
            }

            $this->view->RecID = $ismart->RecID;

            $this->tag->setDefault("RecID", $ismart->RecID);
            $this->tag->setDefault("KodeISmart", $ismart->KodeISmart);
            $this->tag->setDefault("NamaISmart", $ismart->NamaISmart);
            $this->tag->setDefault("Grade", $ismart->Grade);
            $this->tag->setDefault("JenisKelamin", $ismart->JenisKelamin);
            $this->tag->setDefault("TipeISmart", $ismart->TipeISmart);
            $this->tag->setDefault("TanggalLahir", $ismart->TanggalLahir);
            $this->tag->setDefault("TanggalGabung", $ismart->TanggalGabung);
            $this->tag->setDefault("Telepon", $ismart->Telepon);
            $this->tag->setDefault("Alamat", $ismart->Alamat);
            $this->tag->setDefault("Pekerjaan", $ismart->Pekerjaan);
            $this->tag->setDefault("Email", $ismart->Email);
            $this->tag->setDefault("Cabang", $ismart->Cabang);
            $this->tag->setDefault("BidangStudi", $ismart->BidangStudi);
            $this->tag->setDefault("BidangStudi2", $ismart->BidangStudi2);
            $this->tag->setDefault("Kota", $ismart->Kota);
            $this->tag->setDefault("Propinsi", $ismart->Propinsi);
            $this->tag->setDefault("Kota", $ismart->Kota);
            
            $this->view->kotakab = Kotakab::findByPropinsi($ismart->Propinsi);
        }
    }

    /**
     * Creates a new ismart
     */
    public function createAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "index"
                    ));
        }

        $ismart = new Ismart();

        $ismart->BidangStudi = $this->request->getPost("BidangStudi");
        $ismart->TanggalGabung = $this->request->getPost("TanggalGabung");
        //$ismart->KodeISmart = $this->request->getPost("KodeISmart");
        $ismart->NamaISmart = $this->request->getPost("NamaISmart");
        $ismart->Grade = $this->request->getPost("Grade");
        $ismart->JenisKelamin = $this->request->getPost("JenisKelamin");
        $ismart->TipeISmart = $this->request->getPost("TipeISmart");
        $ismart->TanggalLahir = $this->request->getPost("TanggalLahir");
        $ismart->Telepon = $this->request->getPost("Telepon");
        $ismart->Alamat = $this->request->getPost("Alamat");
        $ismart->Pekerjaan = $this->request->getPost("Pekerjaan");
        $ismart->Email = $this->request->getPost("Email");
        $ismart->BidangStudi2 = $this->request->getPost("BidangStudi2");
        $ismart->Kota = $this->request->getPost("Kota");
        $ismart->Propinsi = $this->request->getPost("Propinsi");
        $ismart->Cabang = $this->request->getPost("Cabang");
        //$ismart->Cabang = $this->auth['areacabang'];
        $ismart->Pendidikan = $this->request->getPost("Pendidikan");
        $ismart->Jurusan = $this->request->getPost("Jurusan");

        if (strlen($ismart->BidangStudi) == 0 || strlen($ismart->Pendidikan) == 0) {
            $field = strlen($ismart->BidangStudi) == 0 ? "Bidang Studi" : "Pendidikan";
            $this->flash->error("Data I-Smart ".$field." Harus Diisi");
            return $this->forward("ismart/new");
        }

        if (!$ismart->save()) {
            foreach ($ismart->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "new"
                    ));
        }

        $this->flash->success("Data I-Smart Berhasil Ditambahkan");

        return $this->dispatcher->forward(array(
                    "controller" => "ismart",
                    "action" => "index"
                ));
    }

    /**
     * Saves a ismart edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "index"
                    ));
        }

        $RecID = $this->request->getPost("RecID");

        $ismart = Ismart::findFirstByRecID($RecID);
        if (!$ismart) {
            $this->flash->error("Data I-Smart Tidak Ada " . $RecID);

            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "index"
                    ));
        }

        $ismart->KodeISmart = $this->request->getPost("KodeISmart");
        $ismart->NamaISmart = $this->request->getPost("NamaISmart");
        $ismart->Grade = $this->request->getPost("Grade");
        $ismart->JenisKelamin = $this->request->getPost("JenisKelamin");
        $ismart->TipeISmart = $this->request->getPost("TipeISmart");
        $ismart->TanggalLahir = $this->request->getPost("TanggalLahir");
        $ismart->TanggalGabung = $this->request->getPost("TanggalGabung");
        $ismart->Telepon = $this->request->getPost("Telepon");
        $ismart->Alamat = $this->request->getPost("Alamat");
        $ismart->Pekerjaan = $this->request->getPost("Pekerjaan");
        $ismart->Email = $this->request->getPost("Email");
        $ismart->BidangStudi = $this->request->getPost("BidangStudi");
        $ismart->BidangStudi2 = $this->request->getPost("BidangStudi2");
        $ismart->Kota = $this->request->getPost("Kota");
        $ismart->Propinsi = $this->request->getPost("Propinsi");
        //$ismart->Cabang = $this->request->getPost("Cabang");
        $ismart->Cabang = $this->auth['areacabang'];


        if (!$ismart->save()) {

            foreach ($ismart->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "edit",
                        "params" => array($ismart->RecID)
                    ));
        }

        $this->flash->success("Data I-Smart Berhasil Diupdate");

        return $this->dispatcher->forward(array(
                    "controller" => "ismart",
                    "action" => "index"
                ));
    }

    /**
     * Deletes a ismart
     *
     * @param string $RecID
     */
    public function deleteAction($RecID) {

        $ismart = Ismart::findFirstByRecID($RecID);
        if (!$ismart) {
            $this->flash->error("Data I-Smart Tidak Ditemukan");

            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "index"
                    ));
        }

        if (!$ismart->delete()) {

            foreach ($ismart->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "search"
                    ));
        }

        $this->flash->success("Data I-Smart Berhasil Dihapus");

        return $this->dispatcher->forward(array(
                    "controller" => "ismart",
                    "action" => "index"
                ));
    }

}
