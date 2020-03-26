<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ProgramdetailController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for programdetail
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Programdetail", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecID";

        $programdetail = Programdetail::find($parameters);
        if (count($programdetail) == 0) {
            $this->flash->notice("The search did not find any programdetail");

            return $this->dispatcher->forward(array(
                "controller" => "programdetail",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $programdetail,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction($id)
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->view->bidangstudi = Bidangstudi::find();
        $this->tag->setDefault("Program", $id);
    }

    /**
     * Edits a programdetail
     *
     * @param string $RecID
     */
    public function editAction($RecID)
    {

        if (!$this->request->isPost()) {
            $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
            $programdetail = Programdetail::findFirstByRecID($RecID);
            if (!$programdetail) {
                $this->flash->error("programdetail was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "programdetail",
                    "action" => "index"
                ));
            }

            $this->view->RecID = $programdetail->RecID;
            $this->view->bidangstudi = Bidangstudi::find();

            $this->tag->setDefault("RecID", $programdetail->RecID);
            $this->tag->setDefault("NamaProgramDetail", $programdetail->NamaProgramDetail);
            $this->tag->setDefault("Program", $programdetail->Program);
            $this->tag->setDefault("BidangStudi", $programdetail->BidangStudi);
            $this->tag->setDefault("Bobot", $programdetail->Bobot);
            
        }
    }

    /**
     * Creates a new programdetail
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "programdetail",
                "action" => "index"
            ));
        }

        $programdetail = new Programdetail();

        $programdetail->NamaProgramDetail = $this->request->getPost("NamaProgramDetail");
        $programdetail->Program = $this->request->getPost("Program");
        $programdetail->Jenjang = $this->request->getPost("Jenjang");
        $programdetail->BidangStudi = $this->request->getPost("BidangStudi");
        $programdetail->Bobot = $this->request->getPost("Bobot");
        

        if (!$programdetail->save()) {
            foreach ($programdetail->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->response->redirect(
                    "program/edit/".$programdetail->Program
            );
        }

        $this->flash->success("programdetail was created successfully");

        return $this->response->redirect(
                "program/edit/".$programdetail->Program
        );

    }

    /**
     * Saves a programdetail edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "programdetail",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $programdetail = Programdetail::findFirstByRecID($RecID);
        if (!$programdetail) {
            $this->flash->error("programdetail does not exist " . $RecID);

            return $this->dispatcher->forward(array(
                "controller" => "programdetail",
                "action" => "index"
            ));
        }

        $programdetail->NamaProgramDetail = $this->request->getPost("NamaProgramDetail");
        $programdetail->Program = $this->request->getPost("Program");
        $programdetail->Jenjang = $this->request->getPost("Jenjang");
        $programdetail->BidangStudi = $this->request->getPost("BidangStudi");
        $programdetail->Bobot = $this->request->getPost("Bobot");
        

        if (!$programdetail->save()) {

            foreach ($programdetail->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->response->redirect(
                    "program/edit/".$programdetail->Program
            );
        }

        $this->flash->success("programdetail was updated successfully");

        return $this->response->redirect(
                "program/edit/".$programdetail->Program
        );

    }

    /**
     * Deletes a programdetail
     *
     * @param string $RecID
     */
    public function deleteAction($RecID)
    {

        $programdetail = Programdetail::findFirstByRecID($RecID);
        if (!$programdetail) {
            $this->flash->error("programdetail was not found");

            return $this->dispatcher->forward(array(
                "controller" => "programdetail",
                "action" => "index"
            ));
        }

        if (!$programdetail->delete()) {

            foreach ($programdetail->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->response->redirect(
                "program/edit/".$programdetail->Program
            );
        }

        $this->flash->success("programdetail was deleted successfully");

        return $this->response->redirect(
                "program/edit/".$programdetail->Program
        );
    }

}
