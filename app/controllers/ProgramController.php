<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ProgramController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
        $this->view->programtipe = Programtipe::find();
        $this->view->jenjang = Jenjang::find();
    }

    /**
     * Searches for program
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Program", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecID";

        $program = Program::find($parameters);
        if (count($program) == 0) {
            $this->flash->notice("The search did not find any program");

            return $this->dispatcher->forward(array(
                "controller" => "program",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $program,
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
        $this->view->programtipe = Programtipe::find();
        $this->view->jenjang = Jenjang::find();
		$this->view->tahunajaran = Tahunajaran::find();
    }

    /**
     * Edits a program
     *
     * @param string $RecID
     */
    public function editAction($RecID)
    {

        if (!$this->request->isPost()) {

            $program = Program::findFirstByRecID($RecID);
            if (!$program) {
                $this->flash->error("program was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "program",
                    "action" => "index"
                ));
            }

            $this->view->RecID = $program->RecID;
            $this->view->programtipe = Programtipe::find();
            $this->view->jenjang = Jenjang::find();

            $this->tag->setDefault("RecID", $program->RecID);
            $this->tag->setDefault("TipeProgram", $program->TipeProgram);
            $this->tag->setDefault("NamaProgram", $program->NamaProgram);
            $this->tag->setDefault("Jenjang", $program->Jenjang);
            $this->tag->setDefault("dataTableUrl", $this->url->get("program/details/{$program->RecID}"));
            
        }
    }

    /**
     * Creates a new program
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "program",
                "action" => "index"
            ));
        }

        $program = new Program();
		

        $program->Jenjang = $this->request->getPost("Jenjang");
        $program->TipeProgram = $this->request->getPost("TipeProgram");
        $program->NamaProgram = $this->request->getPost("NamaProgram");
		 $program->tahunajaran = $this->request->getPost("TahunAjaran");  

        if (!$program->save()) {
            foreach ($program->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "program",
                "action" => "new"
            ));
        }

        $this->flash->success("program was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "program",
            "action" => "index"
        ));

    }

    /**
     * Saves a program edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "program",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $program = Program::findFirstByRecID($RecID);
        if (!$program) {
            $this->flash->error("program does not exist " . $RecID);

            return $this->dispatcher->forward(array(
                "controller" => "program",
                "action" => "index"
            ));
        }

        $program->KodeProgram = $this->request->getPost("KodeProgram");
        $program->TipeProgram = $this->request->getPost("TipeProgram");
        $program->NamaProgram = $this->request->getPost("NamaProgram");
        $program->TanggalBerlaku = $this->request->getPost("TanggalBerlaku");
        $program->TanggalBerakhir = $this->request->getPost("TanggalBerakhir");
        

        if (!$program->save()) {

            foreach ($program->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "program",
                "action" => "edit",
                "params" => array($program->RecID)
            ));
        }

        $this->flash->success("program was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "program",
            "action" => "index"
        ));

    }

    /**
     * Deletes a program
     *
     * @param string $RecID
     */
    public function deleteAction($RecID)
    {

        $program = Program::findFirstByRecID($RecID);
        if (!$program) {
            $this->flash->error("program was not found");

            return $this->dispatcher->forward(array(
                "controller" => "program",
                "action" => "index"
            ));
        }

        if (!$program->delete()) {

            foreach ($program->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "program",
                "action" => "search"
            ));
        }

        $this->flash->success("program was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "program",
            "action" => "index"
        ));
    }

    public function detailsAction($id) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $details = [];
        $programdetail = Programdetail::findByProgram($id);
        if (!count($programdetail)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($programdetail as $detail) {
                $details[] = [
                    'id' => $detail->RecID,
                    'nama' => $detail->NamaProgramDetail,
                    'bidangstudi' => $detail->getBidangStudi(),
                    'bobot' => $detail->Bobot
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'deleteUrl' => $this->url->get("programdetail/delete"),
                'listData' => $details
            ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }
}
