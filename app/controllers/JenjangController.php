<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class JenjangController extends ControllerBase
{

//    /**
//     * Index action
//     */
//    public function indexAction()
//    {
//        $this->persistent->parameters = null;
//    }

    /**
     * Searches for jenjang
     */
    public function indexAction()
    {

        $numberPage = $this->request->getQuery("page", "int")?$this->request->getQuery("page", "int"):1;

        $parameters["order"] = "KodeJenjang";

        $jenjang = Jenjang::find($parameters);
        if (count($jenjang) == 0) {
            $this->flash->notice("The search did not find any jenjang");

            return $this->dispatcher->forward(array(
                "controller" => "jenjang",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $jenjang,
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
     * Edits a jenjang
     *
     * @param string $KodeJenjang
     */
    public function editAction($KodeJenjang)
    {

        if (!$this->request->isPost()) {

            $jenjang = Jenjang::findFirstByKodeJenjang($KodeJenjang);
            if (!$jenjang) {
                $this->flash->error("jenjang was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "jenjang",
                    "action" => "index"
                ));
            }

            $this->view->KodeJenjang = $jenjang->KodeJenjang;

            $this->tag->setDefault("KodeJenjang", $jenjang->KodeJenjang);
            $this->tag->setDefault("NamaJenjang", $jenjang->NamaJenjang);
            
        }
    }

    /**
     * Creates a new jenjang
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "jenjang",
                "action" => "index"
            ));
        }

        $jenjang = new Jenjang();

        $jenjang->NamaJenjang = $this->request->getPost("NamaJenjang");
        

        if (!$jenjang->save()) {
            foreach ($jenjang->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "jenjang",
                "action" => "new"
            ));
        }

        $this->flash->success("jenjang was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "jenjang",
            "action" => "index"
        ));

    }

    /**
     * Saves a jenjang edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "jenjang",
                "action" => "index"
            ));
        }

        $KodeJenjang = $this->request->getPost("KodeJenjang");

        $jenjang = Jenjang::findFirstByKodeJenjang($KodeJenjang);
        if (!$jenjang) {
            $this->flash->error("jenjang does not exist " . $KodeJenjang);

            return $this->dispatcher->forward(array(
                "controller" => "jenjang",
                "action" => "index"
            ));
        }

        $jenjang->NamaJenjang = $this->request->getPost("NamaJenjang");
        

        if (!$jenjang->save()) {

            foreach ($jenjang->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "jenjang",
                "action" => "edit",
                "params" => array($jenjang->KodeJenjang)
            ));
        }

        $this->flash->success("jenjang was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "jenjang",
            "action" => "index"
        ));

    }

    /**
     * Deletes a jenjang
     *
     * @param string $KodeJenjang
     */
    public function deleteAction($KodeJenjang)
    {

        $jenjang = Jenjang::findFirstByKodeJenjang($KodeJenjang);
        if (!$jenjang) {
            $this->flash->error("jenjang was not found");

            return $this->dispatcher->forward(array(
                "controller" => "jenjang",
                "action" => "index"
            ));
        }

        if (!$jenjang->delete()) {

            foreach ($jenjang->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "jenjang",
                "action" => "index"
            ));
        }

        $this->flash->success("jenjang was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "jenjang",
            "action" => "index"
        ));
    }

}
