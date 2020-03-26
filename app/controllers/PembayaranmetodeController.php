<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PembayaranmetodeController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for pembayaranmetode
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Pembayaranmetode", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "MetodeId";

        $pembayaranmetode = Pembayaranmetode::find($parameters);
        if (count($pembayaranmetode) == 0) {
            $this->flash->notice("The search did not find any pembayaranmetode");

            return $this->dispatcher->forward(array(
                "controller" => "pembayaranmetode",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $pembayaranmetode,
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

    }

    /**
     * Edits a pembayaranmetode
     *
     * @param string $MetodeId
     */
    public function editAction($MetodeId)
    {

        if (!$this->request->isPost()) {

            $pembayaranmetode = Pembayaranmetode::findFirstByMetodeId($MetodeId);
            if (!$pembayaranmetode) {
                $this->flash->error("pembayaranmetode was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "pembayaranmetode",
                    "action" => "index"
                ));
            }

            $this->view->MetodeId = $pembayaranmetode->MetodeId;

            $this->tag->setDefault("MetodeId", $pembayaranmetode->MetodeId);
            $this->tag->setDefault("NamaMetode", $pembayaranmetode->NamaMetode);
            $this->tag->setDefault("Aktif", $pembayaranmetode->Aktif);
            
        }
    }

    /**
     * Creates a new pembayaranmetode
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "pembayaranmetode",
                "action" => "index"
            ));
        }

        $pembayaranmetode = new Pembayaranmetode();

        $pembayaranmetode->NamaMetode = $this->request->getPost("NamaMetode");
        $pembayaranmetode->Aktif = $this->request->getPost("Aktif");
        

        if (!$pembayaranmetode->save()) {
            foreach ($pembayaranmetode->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "pembayaranmetode",
                "action" => "new"
            ));
        }

        $this->flash->success("pembayaranmetode was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "pembayaranmetode",
            "action" => "index"
        ));

    }

    /**
     * Saves a pembayaranmetode edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "pembayaranmetode",
                "action" => "index"
            ));
        }

        $MetodeId = $this->request->getPost("MetodeId");

        $pembayaranmetode = Pembayaranmetode::findFirstByMetodeId($MetodeId);
        if (!$pembayaranmetode) {
            $this->flash->error("pembayaranmetode does not exist " . $MetodeId);

            return $this->dispatcher->forward(array(
                "controller" => "pembayaranmetode",
                "action" => "index"
            ));
        }

        $pembayaranmetode->NamaMetode = $this->request->getPost("NamaMetode");
        $pembayaranmetode->Aktif = $this->request->getPost("Aktif");
        

        if (!$pembayaranmetode->save()) {

            foreach ($pembayaranmetode->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "pembayaranmetode",
                "action" => "edit",
                "params" => array($pembayaranmetode->MetodeId)
            ));
        }

        $this->flash->success("pembayaranmetode was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "pembayaranmetode",
            "action" => "index"
        ));

    }

    /**
     * Deletes a pembayaranmetode
     *
     * @param string $MetodeId
     */
    public function deleteAction($MetodeId)
    {

        $pembayaranmetode = Pembayaranmetode::findFirstByMetodeId($MetodeId);
        if (!$pembayaranmetode) {
            $this->flash->error("pembayaranmetode was not found");

            return $this->dispatcher->forward(array(
                "controller" => "pembayaranmetode",
                "action" => "index"
            ));
        }

        if (!$pembayaranmetode->delete()) {

            foreach ($pembayaranmetode->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "pembayaranmetode",
                "action" => "search"
            ));
        }

        $this->flash->success("pembayaranmetode was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "pembayaranmetode",
            "action" => "index"
        ));
    }

}
