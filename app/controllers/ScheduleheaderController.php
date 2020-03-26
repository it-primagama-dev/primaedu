<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;

class ScheduleheaderController extends ControllerBase {

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Jadwal");
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

        $this->view->program = Program::find();
    }

    /**
     * Searches for scheduleheader
     */
    public function searchAction() {
        //$this->view->program = Program::find();

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Scheduleheader", $_POST);
            $query->andWhere("Cabang = :cabang:", ["cabang" => $this->auth["areacabang"]]);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecId";

        $scheduleheader = Scheduleheader::find($parameters);
        if (count($scheduleheader) == 0) {
            $this->flash->notice("The search did not find any scheduleheader");

            return $this->dispatcher->forward(array(
                        "controller" => "scheduleheader",
                        "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $scheduleheader,
            "limit" => 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        $this->view->program = Program::find();
        $this->view->tahunajaran = Tahunajaran::find();
    }

    /**
     * Edits a scheduleheader
     *
     * @param string $RecId
     */
    public function editAction($RecId) {

        $this->view->program = Program::find();
        $this->view->tahunajaran = Tahunajaran::find();

        if (!$this->request->isPost()) {

            $scheduleheader = Scheduleheader::findFirstByRecId($RecId);
            if (!$scheduleheader) {
                $this->flash->error("scheduleheader was not found");

                return $this->dispatcher->forward(array(
                            "controller" => "scheduleheader",
                            "action" => "index"
                ));
            }

            $this->view->RecId = $scheduleheader->RecId;
            $this->tag->setDefault("RecId", $scheduleheader->RecId);
            $this->tag->setDefault("KodeJadwal", $scheduleheader->KodeJadwal);
            $this->tag->setDefault("TahunAjaran", $scheduleheader->TahunAjaran);
            $this->tag->setDefault("Description", $scheduleheader->Description);
            $this->tag->setDefault("Program", $scheduleheader->Program);
            $this->tag->setDefault("Cabang", $scheduleheader->Cabang);
            $this->tag->setDefault("dataTableUrl", $this->url->get("scheduleheader/details/{$scheduleheader->RecId}"));

            //$this->view->setVar('scheduledetail', $scheduleheader->scheduledetail);
        }
    }

    /**
     * Creates a new scheduleheader
     */
    public function createAction() {
        $scheduleheaderRecIdtemp = null;

        //$this->view->program = Program::find();

        if ($this->request->isPost()) {
            $scheduleheader = new Scheduleheader();

            $scheduleheader->Description = $this->request->getPost('Description');
            $scheduleheader->Program = $this->request->getPost('Program');
            $scheduleheader->Cabang = $this->auth['areacabang'];
            $scheduleheader->TahunAjaran = $this->request->getPost("TahunAjaran");

            if (!$scheduleheader->save()) {
                $this->flash->error("Insert jadwal gagal");
                return $this->forward('scheduleheader/new');
            } else {
                $this->flash->notice("Insert jadwal berhasil");
                return $this->forward('scheduleheader/index');
            }

//			return $this->dispatcher->forward(array(
//                        "controller" => "scheduleheader",
//                        "action" => "index"
//                    ));
        } else {
            // show shecule
            if (isset($_GET['Schedule'])) {
                $this->request->
                        $numberPage = 1;
                $phql = "SELECT DISTINCT Scheduleheader.KodeJadwal, Scheduleheader.Description, Scheduleheader.Cabang, Scheduledetail.Tanggal,Scheduledetail.Jam,Scheduledetail.Ruangan, Scheduledetail.RecId, Scheduledetail.KodeScheduleDetail , Ismart.NamaIsmart, Scheduledetail.BidangStudi, Program.NamaProgram " .
                        "FROM Scheduledetail LEFT JOIN Scheduleheader ON Scheduledetail.Schedule = Scheduleheader.RecId LEFT JOIN Ismart ON Scheduledetail.Guru = Ismart.RecID LEFT JOIN Program ON Scheduleheader.Program = Program.RecID " .
                        "WHERE Scheduleheader.Cabang = '" . $this->auth['areacabang'] . "' AND Scheduledetail.Schedule = '" . $_GET['Schedule'] . "'";
                $scheduledetail = $this->modelsManager->executeQuery($phql);

                $paginator = new Paginator(array(
                    "data" => $scheduledetail,
                    "limit" => 25,
                    "page" => $numberPage
                ));

                $this->view->page = $paginator->getPaginate();
            }
        }
    }

    /**
     * Creates a new scheduleheader
     */
    public function downloadScheduleAction() {
        $ismart = Ismart::findByCabang($this->auth['areacabang']);
        $ruangan = Ruangan::findByCabang($this->auth['areacabang']);
        $bidangStudi = Bidangstudi::find();

        $fileName = $this->excel->downloadSchedule($ismart, $ruangan, $bidangStudi);
        //$this->response->redirect("scheduleheader/");
    }

    /**
     * Saves a scheduleheader edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "scheduleheader",
                        "action" => "index"
            ));
        }

        $RecId = $this->request->getPost("RecId");

        $scheduleheader = Scheduleheader::findFirstByRecId($RecId);
        if (!$scheduleheader) {
            $this->flash->error("scheduleheader does not exist " . $RecId);

            return $this->dispatcher->forward(array(
                        "controller" => "scheduleheader",
                        "action" => "index"
            ));
        }

        $scheduleheader->KodeJadwal = $this->request->getPost("KodeJadwal");
        $scheduleheader->Description = $this->request->getPost("Description");
        $scheduleheader->Program = $this->request->getPost("Program");
        $scheduleheader->Cabang = $this->auth['areacabang']; //$this->request->getPost("Cabang");
        $scheduleheader->TahunAjaran = $this->request->getPost("TahunAjaran");


        if (!$scheduleheader->save()) {

            foreach ($scheduleheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "scheduleheader",
                        "action" => "edit",
                        "params" => array($scheduleheader->RecId)
            ));
        } else { //sukses
            // TOC-RB : Validate File Uploaded
            $fileUpload = $this->request->getUploadedFiles()[0];

//            if ($this->request->hasFiles() == true && $_POST['Program'] != "") {
            if ($fileUpload->getExtension() == "xlsx" && $_POST['Program'] != "") {
                try {
                    $this->flash->notice('qweqwe');
                    $dataExcel = $this->excel->readSchedule($fileUpload, "");

                    foreach ($dataExcel AS $key => $value) {
                        //$this->flash->error("GURU :".$value['Guru']." ".$value['Ruangan']." ".$value['BidangStudi']. " tanggal=".$value['Tanggal']." ,jam=".$value['Jam']);
                        //$ismart = Ismart::findFirstByKodeISmart($value['Guru']);

                        $pos = strrpos($value['Ruangan'], "(");
                        $pos2 = strrpos($value['Ruangan'], ")");
                        $ruanganRecID = substr($value['Ruangan'], $pos + 1, $pos2 - $pos - 1);

                        $pos = strrpos($value['Guru'], "(");
                        $pos2 = strrpos($value['Guru'], ")");
                        $ismartRecID = substr($value['Guru'], $pos + 1, $pos2 - $pos - 1);

                        $pos = strrpos($value['BidangStudi'], "(");
                        $pos2 = strrpos($value['BidangStudi'], ")");
                        $kodeBidStudi = substr($value['BidangStudi'], $pos + 1, $pos2 - $pos - 1);

                        $scheduledetail = new Scheduledetail();

                        $scheduledetail->KodeScheduleDetail = $scheduleheader->RecId . $kodeBidStudi . $value['Tanggal'];
                        $scheduledetail->Schedule = $scheduleheader->RecId;
                        $scheduledetail->Tanggal = $value['Tanggal'];
                        $scheduledetail->Jam = $value['Jam'];
                        $scheduledetail->Ruangan = $ruanganRecID;
                        $scheduledetail->Guru = $ismartRecID;
                        $scheduledetail->BidangStudi = $kodeBidStudi;

                        //$this->flash->error("GURU :".$ismartRecID." ".$ruanganRecID." ".$kodeBidStudi);

                        if (!$scheduledetail->save()) {
                            $this->flash->error("Import detail excel gagal : ".$scheduledetail->KodeScheduleDetail);
                            return $this->response->redirect("scheduleheader/edit/" . $scheduleheader->RecId);
                        }
                    }
                } catch (Exception $e) {
                    $this->flash->error("Import data excel gagal");
                    return $this->response->redirect("scheduleheader/edit/" . $scheduleheader->RecId);
                }
            }

            $this->flash->success("Master Jadwal berhasil diubah");
            return $this->forward("scheduleheader/index");
        }
    }

    /**
     * Deletes a scheduleheader
     *
     * @param string $RecId
     */
    public function deleteAction($RecId) {

        $scheduleheader = Scheduleheader::findFirstByRecId($RecId);
        if (!$scheduleheader) {
            $this->flash->error("scheduleheader was not found");

            return $this->dispatcher->forward(array(
                        "controller" => "scheduleheader",
                        "action" => "index"
            ));
        }

        if (!$scheduleheader->delete()) {

            foreach ($scheduleheader->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "scheduleheader",
                        "action" => "search"
            ));
        }

        $this->flash->success("scheduleheader was deleted successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "scheduleheader",
                    "action" => "search"
        ));
    }

    public function detailsAction($id) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $details = array();

        $scheduledetail = ScheduleDetail::findBySchedule($id);

        if (!count($scheduledetail)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($scheduledetail as $detail) {
                $details [] = array(
                    'id' => $detail->RecId,
                    'Tanggal' => $detail->Tanggal,
                    'Jam' => $detail->Jam,
                    'Ruangan' => $detail->getNamaRuangan(),
                    'Guru' => $detail->getNamaGuru(),
                    'BidangStudi' => $detail->getBidangStudi()
                );
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'deleteUrl' => $this->url->get("scheduledetail/delete"),
                'listData' => $details
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

}
