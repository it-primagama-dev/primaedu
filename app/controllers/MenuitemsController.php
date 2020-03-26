<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MenuitemsController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
        $this->view->group = Menuitemsgroup::find();
    }

    /**
     * Searches for menuitems
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Menuitems", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "MenuItem";

        $menuitems = Menuitems::find($parameters);
        if (count($menuitems) == 0) {
            $this->flash->notice("The search did not find any menuitems");

            return $this->dispatcher->forward(array(
                "controller" => "menuitems",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $menuitems,
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
        $this->view->group = Menuitemsgroup::find();
    }

    /**
     * Edits a menuitem
     *
     * @param string $RecID
     */
    public function editAction($RecID)
    {

        if (!$this->request->isPost()) {

            $menuitem = Menuitems::findFirstByRecID($RecID);
            if (!$menuitem) {
                $this->flash->error("menuitem was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "menuitems",
                    "action" => "index"
                ));
            }

            $this->view->group = Menuitemsgroup::find();
            $this->view->RecID = $menuitem->RecID;

            $this->tag->setDefault("RecID", $menuitem->RecID);
            $this->tag->setDefault("MenuItemsGroup", $menuitem->MenuItemsGroup);
            $this->tag->setDefault("MenuItem", $menuitem->MenuItem);
            $this->tag->setDefault("ControllerName", $menuitem->ControllerName);
            
        }
    }

    /**
     * Creates a new menuitem
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "menuitems",
                "action" => "index"
            ));
        }

        $menuitem = new Menuitems();

        $menuitem->MenuItemsGroup = $this->request->getPost("MenuItemsGroup");
        $menuitem->MenuItem = $this->request->getPost("MenuItem");
        $menuitem->ControllerName = $this->request->getPost("ControllerName");
        

        if (!$menuitem->save()) {
            foreach ($menuitem->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "menuitems",
                "action" => "new"
            ));
        }

        $this->flash->success("menuitem was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "menuitems",
            "action" => "index"
        ));

    }

    /**
     * Saves a menuitem edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "menuitems",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $menuitem = Menuitems::findFirstByRecID($RecID);
        if (!$menuitem) {
            $this->flash->error("menuitem does not exist " . $RecID);

            return $this->dispatcher->forward(array(
                "controller" => "menuitems",
                "action" => "index"
            ));
        }

        $menuitem->MenuItemsGroup = $this->request->getPost("MenuItemsGroup");
        $menuitem->MenuItem = $this->request->getPost("MenuItem");
        $menuitem->ControllerName = $this->request->getPost("ControllerName");
        

        if (!$menuitem->save()) {

            foreach ($menuitem->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "menuitems",
                "action" => "edit",
                "params" => array($menuitem->RecID)
            ));
        }

        $this->flash->success("menuitem was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "menuitems",
            "action" => "index"
        ));

    }

    /**
     * Deletes a menuitem
     *
     * @param string $RecID
     */
    public function deleteAction($RecID)
    {

        $menuitem = Menuitems::findFirstByRecID($RecID);
        if (!$menuitem) {
            $this->flash->error("menuitem was not found");

            return $this->dispatcher->forward(array(
                "controller" => "menuitems",
                "action" => "index"
            ));
        }

        if (!$menuitem->delete()) {

            foreach ($menuitem->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "menuitems",
                "action" => "search"
            ));
        }

        $this->flash->success("menuitem was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "menuitems",
            "action" => "index"
        ));
    }

}
