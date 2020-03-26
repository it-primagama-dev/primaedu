<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class AreacabangController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for areacabang
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Areacabang", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecID";

        $areacabang = Areacabang::find($parameters);
        if (count($areacabang) == 0) {
            $this->flash->notice("The search did not find any areacabang");

            return $this->dispatcher->forward(array(
                "controller" => "areacabang",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $areacabang,
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
     * Edits a areacabang
     *
     * @param string $RecID
     */
    public function editAction($RecID)
    {

        if (!$this->request->isPost()) {

            $areacabang = Areacabang::findFirstByRecID($RecID);
            if (!$areacabang) {
                $this->flash->error("areacabang was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "areacabang",
                    "action" => "index"
                ));
            }

            $this->view->RecID = $areacabang->RecID;

            $this->tag->setDefault("RecID", $areacabang->RecID);
            $this->tag->setDefault("KodeAreaCabang", $areacabang->KodeAreaCabang);
            $this->tag->setDefault("Area", $areacabang->Area);
            $this->tag->setDefault("NamaAreaCabang", $areacabang->NamaAreaCabang);
            $this->tag->setDefault("TanggalBerlaku", $areacabang->TanggalBerlaku);
            $this->tag->setDefault("TanggalBerakhir", $areacabang->TanggalBerakhir);
            
        }
    }

    /**
     * Creates a new areacabang
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "areacabang",
                "action" => "index"
            ));
        }

        $areacabang = new Areacabang();

        if($this->request->getPost("KodeArea"))
        {
        $areacabang->KodeAreaCabang = $this->request->getPost("KodeArea");
        $areacabang->NamaAreaCabang = $this->request->getPost("NamaArea");
        }
        else
        {
        $areacabang->KodeAreaCabang = $this->request->getPost("KodeCabang");
        $areacabang->Area = $this->request->getPost("Area");
        $areacabang->NamaAreaCabang = $this->request->getPost("NamaCabang");
        $areacabang->TanggalBerlaku = $this->request->getPost("TanggalBerlaku");
        $areacabang->TanggalBerakhir = $this->request->getPost("TanggalBerakhir");
        }

        if (!$areacabang->save()) {
            foreach ($areacabang->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "areacabang",
                "action" => "new"
            ));
        }

        $this->flash->success("areacabang was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "areacabang",
            "action" => "index"
        ));

    }

    /**
     * Saves a areacabang edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "areacabang",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $areacabang = Areacabang::findFirstByRecID($RecID);
        if (!$areacabang) {
            $this->flash->error("areacabang does not exist " . $RecID);

            return $this->dispatcher->forward(array(
                "controller" => "areacabang",
                "action" => "index"
            ));
        }

        $areacabang->KodeAreaCabang = $this->request->getPost("KodeAreaCabang");
        $areacabang->Area = $this->request->getPost("Area");
        $areacabang->NamaAreaCabang = $this->request->getPost("NamaAreaCabang");
        $areacabang->TanggalBerlaku = $this->request->getPost("TanggalBerlaku");
        $areacabang->TanggalBerakhir = $this->request->getPost("TanggalBerakhir");
        

        if (!$areacabang->save()) {

            foreach ($areacabang->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "areacabang",
                "action" => "edit",
                "params" => array($areacabang->RecID)
            ));
        }

        $this->flash->success("areacabang was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "areacabang",
            "action" => "index"
        ));

    }

    /**
     * Deletes a areacabang
     *
     * @param string $RecID
     */
    public function deleteAction($RecID)
    {

        $areacabang = Areacabang::findFirstByRecID($RecID);
        if (!$areacabang) {
            $this->flash->error("areacabang was not found");

            return $this->dispatcher->forward(array(
                "controller" => "areacabang",
                "action" => "index"
            ));
        }

        if (!$areacabang->delete()) {

            foreach ($areacabang->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "areacabang",
                "action" => "search"
            ));
        }

        $this->flash->success("areacabang was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "areacabang",
            "action" => "index"
        ));
    }

}
