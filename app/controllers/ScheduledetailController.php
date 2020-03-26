<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ScheduledetailController extends ControllerBase {

    protected $auth;

    public function initialize() {
        parent::initialize();
        if($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }

    /**
     * Index action
     */
    public function indexAction($paramSchedule) {
        $this->persistent->parameters = null;

        $this->view->ruangan = Ruangan::find();
        $this->view->guru = Ismart::find();
        $this->view->scheduleRecId = $paramSchedule;
        $this->view->bidangstudi = Bidangstudi::find();
    }

    /**
     * Searches for scheduledetail
     */
    public function searchAction($schedule) {
        $numberPage = 1;

        if ($this->request->isPost()) {

            $query = Criteria::fromInput($this->di, "Scheduledetail", $_POST);

            /* $query = Scheduledetail::query()
              ->where("Schedule = :Schedule:")
              ->bind(array("Schedule" => $schedule))
              ->execute(); */

            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "Schedule";

        //$scheduledetail = Scheduledetail::find($parameters);
        $scheduledetail = Scheduledetail::findBySchedule($schedule);
        if (count($scheduledetail) == 0) {
            $this->flash->notice("The search did not find any scheduledetail");

            return $this->dispatcher->forward(array(
                        "controller" => "scheduledetail",
                        "action" => "index"
                    ));
        }

        $this->view->ruangan = Ruangan::find();
        $this->view->guru = Ismart::find();
        $this->view->scheduleRecId = $schedule;

        $paginator = new Paginator(array(
                    "data" => $scheduledetail,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction($RecId) {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->view->ruangan = Ruangan::findByCabang($this->auth['areacabang']);
        $this->view->guru = Ismart::findByCabang($this->auth['areacabang']);
        $this->view->bidangstudi = Bidangstudi::find();
        $this->tag->setDefault("Schedule", $RecId);
    }

    /**
     * Edits a scheduledetail
     *
     * @param string $RecId
     */
    public function editAction($RecId) {
        $this->view->guru = Ismart::findByCabang($this->auth['areacabang']);
        $this->view->ruangan = Ruangan::findByCabang($this->auth['areacabang']);
        $this->view->bidangstudi = Bidangstudi::find();

        if (!$this->request->isPost()) {

            $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

            $scheduledetail = Scheduledetail::findFirstByRecId($RecId);
            if (!$scheduledetail) {
                $this->flash->error("scheduledetail was not found");

                return $this->dispatcher->forward(array(
                            "controller" => "scheduledetail",
                            "action" => "index"
                        ));
            }

            $this->view->RecId = $scheduledetail->RecId;

            $this->tag->setDefault("RecId", $scheduledetail->RecId);
            $this->tag->setDefault("KodeScheduleDetail", $scheduledetail->KodeScheduleDetail);
            $this->tag->setDefault("Schedule", $scheduledetail->Schedule);
            $this->tag->setDefault("Tanggal", $scheduledetail->Tanggal);
            $this->tag->setDefault("Jam", $scheduledetail->Jam);
            $this->tag->setDefault("Ruangan", $scheduledetail->Ruangan);
            $this->tag->setDefault("Guru", $scheduledetail->Guru);
            $this->tag->setDefault("BidangStudi", $scheduledetail->BidangStudi);
        }
    }

    /**
     * Creates a new scheduledetail
     */
    public function createAction() {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "scheduledetail",
                        "action" => "index"
                    ));
        }

        $scheduledetail = new Scheduledetail();

        $scheduledetail->KodeScheduleDetail = $this->request->getPost("KodeScheduleDetail");
        $scheduledetail->Schedule = $this->request->getPost("Schedule");
        $scheduledetail->Tanggal = $this->request->getPost("Tanggal");
        $scheduledetail->Jam = $this->request->getPost("Jam");
        $scheduledetail->Ruangan = $this->request->getPost("Ruangan");
        $scheduledetail->Guru = $this->request->getPost("Guru");
        $scheduledetail->BidangStudi = $this->request->getPost("BidangStudi");


        if (!$scheduledetail->save()) {
            foreach ($scheduledetail->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "scheduledetail",
                        "action" => "index"
                    ));
        }

        $this->flash->success("scheduledetail was created successfully");

        $scheduleRecId = $scheduledetail->Schedule;

        return $this->response->redirect("scheduleheader/edit/" . $scheduleRecId);
    }

    /**
     * Saves a scheduledetail edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "scheduledetail",
                        "action" => "index"
                    ));
        }

        $RecId = $this->request->getPost("RecId");

        $scheduledetail = Scheduledetail::findFirstByRecId($RecId);
        if (!$scheduledetail) {
            $this->flash->error("scheduledetail does not exist " . $RecId);

            return $this->dispatcher->forward(array(
                        "controller" => "scheduledetail",
                        "action" => "index",
                        "params" => array($scheduledetail->RecId)
                    ));
        }

        $scheduledetail->KodeScheduleDetail = $this->request->getPost("KodeScheduleDetail");
        $scheduledetail->Schedule = $this->request->getPost("Schedule");
        $scheduledetail->Tanggal = $this->request->getPost("Tanggal");
        $scheduledetail->Jam = $this->request->getPost("Jam");
        $scheduledetail->Ruangan = $this->request->getPost("Ruangan");
        $scheduledetail->Guru = $this->request->getPost("Guru");
        $scheduledetail->BidangStudi = $this->request->getPost("BidangStudi");

        if (!$scheduledetail->save()) {

            foreach ($scheduledetail->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "scheduledetail",
                        "action" => "edit",
                        "params" => array($scheduledetail->RecId)
                    ));
        }

        $this->flash->success("scheduledetail was updated successfully");

        return $this->response->redirect(
                        "scheduleheader/edit/" . $scheduledetail->Schedule);
    }

    /**
     * Deletes a scheduledetail
     *
     * @param string $RecId
     */
    public function deleteAction($RecId) {

        $scheduledetail = Scheduledetail::findFirstByRecId($RecId);
        if (!$scheduledetail) {
            $this->flash->error("scheduledetail was not found");

            return $this->dispatcher->forward(array(
                        "controller" => "scheduledetail",
                        "action" => "index"
                    ));
        }

        if (!$scheduledetail->delete()) {

            foreach ($scheduledetail->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "scheduledetail",
                        "action" => "search"
                    ));
        }

        $this->flash->success("scheduledetail was deleted successfully");

        return $this->response->redirect("scheduleheader/edit/" . $scheduledetail->Schedule);
    }

}
