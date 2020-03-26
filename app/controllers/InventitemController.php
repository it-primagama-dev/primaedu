<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class InventitemController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for inventitem
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Inventitem", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "KodeItem";

        $inventitem = Inventitem::find($parameters);
        if (count($inventitem) == 0) {
            $this->flash->notice("The search did not find any inventitem");

            return $this->dispatcher->forward(array(
                "controller" => "inventitem",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $inventitem,
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
     * Edits a inventitem
     *
     * @param string $KodeItem
     */
    public function editAction($KodeItem)
    {

        if (!$this->request->isPost()) {

            $inventitem = Inventitem::findFirstByKodeItem($KodeItem);
            if (!$inventitem) {
                $this->flash->error("inventitem was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "inventitem",
                    "action" => "index"
                ));
            }

            $this->view->KodeItem = $inventitem->KodeItem;

            $this->tag->setDefault("KodeItem", $inventitem->KodeItem);
            $this->tag->setDefault("NamaItem", $inventitem->NamaItem);
            $this->tag->setDefault("TipeInvent", $inventitem->TipeInvent);
            $this->tag->setDefault("StatusItem", $inventitem->StatusItem);
            
        }
    }

    /**
     * Creates a new inventitem
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "inventitem",
                "action" => "index"
            ));
        }

        $inventitem = new Inventitem();

        $inventitem->KodeItem = $this->request->getPost("KodeItem");
        $inventitem->NamaItem = $this->request->getPost("NamaItem");
        $inventitem->TipeInvent = $this->request->getPost("TipeInvent");
        $inventitem->StatusItem = $this->request->getPost("StatusItem");
        

        if (!$inventitem->save()) {
            foreach ($inventitem->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "inventitem",
                "action" => "new"
            ));
        }

        $this->flash->success("inventitem was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "inventitem",
            "action" => "index"
        ));

    }

    /**
     * Saves a inventitem edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "inventitem",
                "action" => "index"
            ));
        }

        $KodeItem = $this->request->getPost("KodeItem");

        $inventitem = Inventitem::findFirstByKodeItem($KodeItem);
        if (!$inventitem) {
            $this->flash->error("inventitem does not exist " . $KodeItem);

            return $this->dispatcher->forward(array(
                "controller" => "inventitem",
                "action" => "index"
            ));
        }

        $inventitem->KodeItem = $this->request->getPost("KodeItem");
        $inventitem->NamaItem = $this->request->getPost("NamaItem");
        $inventitem->TipeInvent = $this->request->getPost("TipeInvent");
        $inventitem->StatusItem = $this->request->getPost("StatusItem");
        

        if (!$inventitem->save()) {

            foreach ($inventitem->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "inventitem",
                "action" => "edit",
                "params" => array($inventitem->KodeItem)
            ));
        }

        $this->flash->success("inventitem was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "inventitem",
            "action" => "index"
        ));

    }

    /**
     * Deletes a inventitem
     *
     * @param string $KodeItem
     */
    public function deleteAction($KodeItem)
    {

        $inventitem = Inventitem::findFirstByKodeItem($KodeItem);
        if (!$inventitem) {
            $this->flash->error("inventitem was not found");

            return $this->dispatcher->forward(array(
                "controller" => "inventitem",
                "action" => "index"
            ));
        }

        if (!$inventitem->delete()) {

            foreach ($inventitem->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "inventitem",
                "action" => "search"
            ));
        }

        $this->flash->success("inventitem was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "inventitem",
            "action" => "index"
        ));
    }

}
