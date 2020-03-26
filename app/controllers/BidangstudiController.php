<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class BidangstudiController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for bidangstudi
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Bidangstudi", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "KodeBidangStudi";

        $bidangstudi = Bidangstudi::find($parameters);
        if (count($bidangstudi) == 0) {
            $this->flash->notice("The search did not find any bidangstudi");

            return $this->dispatcher->forward(array(
                "controller" => "bidangstudi",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $bidangstudi,
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
     * Edits a bidangstudi
     *
     * @param string $KodeBidangStudi
     */
    public function editAction($KodeBidangStudi)
    {

        if (!$this->request->isPost()) {

            $bidangstudi = Bidangstudi::findFirstByKodeBidangStudi($KodeBidangStudi);
            if (!$bidangstudi) {
                $this->flash->error("bidangstudi was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "bidangstudi",
                    "action" => "index"
                ));
            }

            $this->view->KodeBidangStudi = $bidangstudi->KodeBidangStudi;

            $this->tag->setDefault("KodeBidangStudi", $bidangstudi->KodeBidangStudi);
            $this->tag->setDefault("NamaBidangStudi", $bidangstudi->NamaBidangStudi);
            
        }
    }

    /**
     * Creates a new bidangstudi
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "bidangstudi",
                "action" => "index"
            ));
        }

        $bidangstudi = new Bidangstudi();

        $bidangstudi->KodeBidangStudi = $this->request->getPost("KodeBidangStudi");
        $bidangstudi->NamaBidangStudi = $this->request->getPost("NamaBidangStudi");
        

        if (!$bidangstudi->save()) {
            foreach ($bidangstudi->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "bidangstudi",
                "action" => "new"
            ));
        }

        $this->flash->success("bidangstudi was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "bidangstudi",
            "action" => "index"
        ));

    }

    /**
     * Saves a bidangstudi edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "bidangstudi",
                "action" => "index"
            ));
        }

        $KodeBidangStudi = $this->request->getPost("KodeBidangStudi");

        $bidangstudi = Bidangstudi::findFirstByKodeBidangStudi($KodeBidangStudi);
        if (!$bidangstudi) {
            $this->flash->error("bidangstudi does not exist " . $KodeBidangStudi);

            return $this->dispatcher->forward(array(
                "controller" => "bidangstudi",
                "action" => "index"
            ));
        }

        $bidangstudi->KodeBidangStudi = $this->request->getPost("KodeBidangStudi");
        $bidangstudi->NamaBidangStudi = $this->request->getPost("NamaBidangStudi");
        

        if (!$bidangstudi->save()) {

            foreach ($bidangstudi->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "bidangstudi",
                "action" => "edit",
                "params" => array($bidangstudi->KodeBidangStudi)
            ));
        }

        $this->flash->success("bidangstudi was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "bidangstudi",
            "action" => "index"
        ));

    }

    /**
     * Deletes a bidangstudi
     *
     * @param string $KodeBidangStudi
     */
    public function deleteAction($KodeBidangStudi)
    {

        $bidangstudi = Bidangstudi::findFirstByKodeBidangStudi($KodeBidangStudi);
        if (!$bidangstudi) {
            $this->flash->error("bidangstudi was not found");

            return $this->dispatcher->forward(array(
                "controller" => "bidangstudi",
                "action" => "index"
            ));
        }

        if (!$bidangstudi->delete()) {

            foreach ($bidangstudi->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "bidangstudi",
                "action" => "search"
            ));
        }

        $this->flash->success("bidangstudi was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "bidangstudi",
            "action" => "index"
        ));
    }

}
