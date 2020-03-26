<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MenuitemsgroupController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for menuitemsgroup
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Menuitemsgroup", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "MenuItemsGroupId";

        $menuitemsgroup = Menuitemsgroup::find($parameters);
        if (count($menuitemsgroup) == 0) {
            $this->flash->notice("The search did not find any menuitemsgroup");

            return $this->dispatcher->forward(array(
                "controller" => "menuitemsgroup",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $menuitemsgroup,
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
     * Edits a menuitemsgroup
     *
     * @param string $MenuItemsGroupId
     */
    public function editAction($MenuItemsGroupId)
    {

        if (!$this->request->isPost()) {

            $menuitemsgroup = Menuitemsgroup::findFirstByMenuItemsGroupId($MenuItemsGroupId);
            if (!$menuitemsgroup) {
                $this->flash->error("menuitemsgroup was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "menuitemsgroup",
                    "action" => "index"
                ));
            }

            $this->view->MenuItemsGroupId = $menuitemsgroup->MenuItemsGroupId;

            $this->tag->setDefault("MenuItemsGroupId", $menuitemsgroup->MenuItemsGroupId);
            $this->tag->setDefault("MenuItemsGroupName", $menuitemsgroup->MenuItemsGroupName);
            $this->tag->setDefault("MenuItemsGroupOrder", $menuitemsgroup->MenuItemsGroupOrder);
            
        }
    }

    /**
     * Creates a new menuitemsgroup
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "menuitemsgroup",
                "action" => "index"
            ));
        }

        $menuitemsgroup = new Menuitemsgroup();

        $menuitemsgroup->MenuItemsGroupName = $this->request->getPost("MenuItemsGroupName");
        $menuitemsgroup->MenuItemsGroupOrder = $this->request->getPost("MenuItemsGroupOrder");
        

        if (!$menuitemsgroup->save()) {
            foreach ($menuitemsgroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "menuitemsgroup",
                "action" => "new"
            ));
        }

        $this->flash->success("menuitemsgroup was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "menuitemsgroup",
            "action" => "index"
        ));

    }

    /**
     * Saves a menuitemsgroup edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "menuitemsgroup",
                "action" => "index"
            ));
        }

        $MenuItemsGroupId = $this->request->getPost("MenuItemsGroupId");

        $menuitemsgroup = Menuitemsgroup::findFirstByMenuItemsGroupId($MenuItemsGroupId);
        if (!$menuitemsgroup) {
            $this->flash->error("menuitemsgroup does not exist " . $MenuItemsGroupId);

            return $this->dispatcher->forward(array(
                "controller" => "menuitemsgroup",
                "action" => "index"
            ));
        }

        $menuitemsgroup->MenuItemsGroupName = $this->request->getPost("MenuItemsGroupName");
        $menuitemsgroup->MenuItemsGroupOrder = $this->request->getPost("MenuItemsGroupOrder");
        

        if (!$menuitemsgroup->save()) {

            foreach ($menuitemsgroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "menuitemsgroup",
                "action" => "edit",
                "params" => array($menuitemsgroup->MenuItemsGroupId)
            ));
        }

        $this->flash->success("menuitemsgroup was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "menuitemsgroup",
            "action" => "index"
        ));

    }

    /**
     * Deletes a menuitemsgroup
     *
     * @param string $MenuItemsGroupId
     */
    public function deleteAction($MenuItemsGroupId)
    {

        $menuitemsgroup = Menuitemsgroup::findFirstByMenuItemsGroupId($MenuItemsGroupId);
        if (!$menuitemsgroup) {
            $this->flash->error("menuitemsgroup was not found");

            return $this->dispatcher->forward(array(
                "controller" => "menuitemsgroup",
                "action" => "index"
            ));
        }

        if (!$menuitemsgroup->delete()) {

            foreach ($menuitemsgroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "menuitemsgroup",
                "action" => "search"
            ));
        }

        $this->flash->success("menuitemsgroup was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "menuitemsgroup",
            "action" => "index"
        ));
    }

}
