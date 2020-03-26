<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ProgramtipeController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for programtipe
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Programtipe", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "KodeTipeProgram";

        $programtipe = Programtipe::find($parameters);
        if (count($programtipe) == 0) {
            $this->flash->notice("The search did not find any programtipe");

            return $this->dispatcher->forward(array(
                "controller" => "programtipe",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $programtipe,
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
     * Edits a programtipe
     *
     * @param string $KodeTipeProgram
     */
    public function editAction($KodeTipeProgram)
    {

        if (!$this->request->isPost()) {

            $programtipe = Programtipe::findFirstByKodeTipeProgram($KodeTipeProgram);
            if (!$programtipe) {
                $this->flash->error("programtipe was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "programtipe",
                    "action" => "index"
                ));
            }

            $this->view->KodeTipeProgram = $programtipe->KodeTipeProgram;

            $this->tag->setDefault("KodeTipeProgram", $programtipe->KodeTipeProgram);
            $this->tag->setDefault("NamaTipeProgram", $programtipe->NamaTipeProgram);
            
        }
    }

    /**
     * Creates a new programtipe
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "programtipe",
                "action" => "index"
            ));
        }

        $programtipe = new Programtipe();

        $programtipe->NamaTipeProgram = $this->request->getPost("NamaTipeProgram");
        

        if (!$programtipe->save()) {
            foreach ($programtipe->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "programtipe",
                "action" => "new"
            ));
        }

        $this->flash->success("programtipe was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "programtipe",
            "action" => "index"
        ));

    }

    /**
     * Saves a programtipe edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "programtipe",
                "action" => "index"
            ));
        }

        $KodeTipeProgram = $this->request->getPost("KodeTipeProgram");

        $programtipe = Programtipe::findFirstByKodeTipeProgram($KodeTipeProgram);
        if (!$programtipe) {
            $this->flash->error("programtipe does not exist " . $KodeTipeProgram);

            return $this->dispatcher->forward(array(
                "controller" => "programtipe",
                "action" => "index"
            ));
        }

        $programtipe->NamaTipeProgram = $this->request->getPost("NamaTipeProgram");
        

        if (!$programtipe->save()) {

            foreach ($programtipe->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "programtipe",
                "action" => "edit",
                "params" => array($programtipe->KodeTipeProgram)
            ));
        }

        $this->flash->success("programtipe was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "programtipe",
            "action" => "index"
        ));

    }

    /**
     * Deletes a programtipe
     *
     * @param string $KodeTipeProgram
     */
    public function deleteAction($KodeTipeProgram)
    {

        $programtipe = Programtipe::findFirstByKodeTipeProgram($KodeTipeProgram);
        if (!$programtipe) {
            $this->flash->error("programtipe was not found");

            return $this->dispatcher->forward(array(
                "controller" => "programtipe",
                "action" => "index"
            ));
        }

        if (!$programtipe->delete()) {

            foreach ($programtipe->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "programtipe",
                "action" => "search"
            ));
        }

        $this->flash->success("programtipe was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "programtipe",
            "action" => "index"
        ));
    }

}
