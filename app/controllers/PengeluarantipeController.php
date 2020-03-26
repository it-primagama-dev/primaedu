<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PengeluarantipeController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for pengeluarantipe
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Pengeluarantipe", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecId";

        $pengeluarantipe = Pengeluarantipe::find($parameters);
        if (count($pengeluarantipe) == 0) {
            $this->flash->notice("The search did not find any pengeluarantipe");

            return $this->dispatcher->forward(array(
                "controller" => "pengeluarantipe",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $pengeluarantipe,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $this->view->biayagroup = Pengeluaranbiayagroup::find();
    }

    /**
     * Edits a pengeluarantipe
     *
     * @param string $RecId
     */
    public function editAction($RecId)
    {

        if (!$this->request->isPost()) {

            $pengeluarantipe = Pengeluarantipe::findFirstByRecId($RecId);
            if (!$pengeluarantipe) {
                $this->flash->error("pengeluarantipe was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "pengeluarantipe",
                    "action" => "index"
                ));
            }

            $this->view->RecId = $pengeluarantipe->RecId;
            $this->view->biayagroup = Pengeluaranbiayagroup::find();

            $this->tag->setDefault("RecId", $pengeluarantipe->RecId);
            $this->tag->setDefault("KodePengeluaran", $pengeluarantipe->KodePengeluaran);
            $this->tag->setDefault("BiayaGroup", $pengeluarantipe->BiayaGroup);
            $this->tag->setDefault("Description", $pengeluarantipe->Description);
            
        }
    }

    /**
     * Creates a new pengeluarantipe
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "pengeluarantipe",
                "action" => "index"
            ));
        }

        $pengeluarantipe = new Pengeluarantipe();

        $pengeluarantipe->KodePengeluaran = $this->request->getPost("KodePengeluaran");
        $pengeluarantipe->BiayaGroup = $this->request->getPost("BiayaGroup");
        $pengeluarantipe->Description = $this->request->getPost("Description");
        

        if (!$pengeluarantipe->save()) {
            foreach ($pengeluarantipe->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "pengeluarantipe",
                "action" => "new"
            ));
        }

        $this->flash->success("pengeluarantipe was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "pengeluarantipe",
            "action" => "index"
        ));

    }

    /**
     * Saves a pengeluarantipe edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "pengeluarantipe",
                "action" => "index"
            ));
        }

        $RecId = $this->request->getPost("RecId");

        $pengeluarantipe = Pengeluarantipe::findFirstByRecId($RecId);
        if (!$pengeluarantipe) {
            $this->flash->error("pengeluarantipe does not exist " . $RecId);

            return $this->dispatcher->forward(array(
                "controller" => "pengeluarantipe",
                "action" => "index"
            ));
        }

        $pengeluarantipe->KodePengeluaran = $this->request->getPost("KodePengeluaran");
        $pengeluarantipe->BiayaGroup = $this->request->getPost("BiayaGroup");
        $pengeluarantipe->Description = $this->request->getPost("Description");
        

        if (!$pengeluarantipe->save()) {

            foreach ($pengeluarantipe->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "pengeluarantipe",
                "action" => "edit",
                "params" => array($pengeluarantipe->RecId)
            ));
        }

        $this->flash->success("pengeluarantipe was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "pengeluarantipe",
            "action" => "index"
        ));

    }

    /**
     * Deletes a pengeluarantipe
     *
     * @param string $RecId
     */
    public function deleteAction($RecId)
    {

        $pengeluarantipe = Pengeluarantipe::findFirstByRecId($RecId);
        if (!$pengeluarantipe) {
            $this->flash->error("pengeluarantipe was not found");

            return $this->dispatcher->forward(array(
                "controller" => "pengeluarantipe",
                "action" => "index"
            ));
        }

        if (!$pengeluarantipe->delete()) {

            foreach ($pengeluarantipe->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "pengeluarantipe",
                "action" => "search"
            ));
        }

        $this->flash->success("pengeluarantipe was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "pengeluarantipe",
            "action" => "index"
        ));
    }

}
