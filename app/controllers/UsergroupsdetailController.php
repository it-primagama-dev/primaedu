<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class UsergroupsdetailController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for usergroupsdetail
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Usergroupsdetail", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecID";

        $usergroupsdetail = Usergroupsdetail::find($parameters);
        if (count($usergroupsdetail) == 0) {
            $this->flash->notice("The search did not find any usergroupsdetail");

            return $this->dispatcher->forward(array(
                "controller" => "usergroupsdetail",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $usergroupsdetail,
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
        $this->view->menuitem = Menuitems::find();
        $this->tag->setDefault("UserGroup", $id);
    }

    /**
     * Edits a usergroupsdetail
     *
     * @param string $RecID
     */
    public function editAction($RecID)
    {

        if (!$this->request->isPost()) {
            $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
            $usergroupsdetail = Usergroupsdetail::findFirstByRecID($RecID);
            if (!$usergroupsdetail) {
                $this->flash->error("usergroupsdetail was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "usergroupsdetail",
                    "action" => "index"
                ));
            }

            $this->view->RecID = $usergroupsdetail->RecID;
            $this->view->menuitem = Menuitems::find();

            $this->tag->setDefault("RecID", $usergroupsdetail->RecID);
            $this->tag->setDefault("UserGroup", $usergroupsdetail->UserGroup);
            $this->tag->setDefault("MenuItems", $usergroupsdetail->MenuItems);
            $this->tag->setDefault("ActionName", $usergroupsdetail->ActionName);
            
        }
    }

    /**
     * Creates a new usergroupsdetail
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "usergroupsdetail",
                "action" => "index"
            ));
        }

        $usergroupsdetail = new Usergroupsdetail();

        $usergroupsdetail->UserGroup = $this->request->getPost("UserGroup");
        $usergroupsdetail->MenuItems = $this->request->getPost("MenuItems");
        $usergroupsdetail->ActionName = $this->request->getPost("ActionName");
        

        if (!$usergroupsdetail->save()) {
            foreach ($usergroupsdetail->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->response->redirect("usergroups/edit/".$usergroupsdetail->UserGroup);
        }

        $this->flash->success("usergroupsdetail was created successfully");

        return $this->response->redirect("usergroups/edit/".$usergroupsdetail->UserGroup);

    }

    /**
     * Saves a usergroupsdetail edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "usergroupsdetail",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $usergroupsdetail = Usergroupsdetail::findFirstByRecID($RecID);
        if (!$usergroupsdetail) {
            $this->flash->error("usergroupsdetail does not exist " . $RecID);

            return $this->dispatcher->forward(array(
                "controller" => "usergroupsdetail",
                "action" => "index"
            ));
        }

        $usergroupsdetail->UserGroup = $this->request->getPost("UserGroup");
        $usergroupsdetail->MenuItems = $this->request->getPost("MenuItems");
        $usergroupsdetail->ActionName = $this->request->getPost("ActionName");
        

        if (!$usergroupsdetail->save()) {

            foreach ($usergroupsdetail->getMessages() as $message) {
                $this->flash->error($message);
            }

//            return $this->dispatcher->forward(array(
//                "controller" => "usergroupsdetail",
//                "action" => "edit",
//                "params" => array($usergroupsdetail->RecID)
//            ));
            return $this->response->redirect("usergroups/edit/.$usergroupsdetail->UserGroup");
        }

        $this->flash->success("usergroupsdetail was updated successfully");

//        return $this->dispatcher->forward(array(
//            "controller" => "usergroupsdetail",
//            "action" => "index"
//        ));
        return $this->response->redirect("usergroups/edit/".$usergroupsdetail->UserGroup);

    }

    /**
     * Deletes a usergroupsdetail
     *
     * @param string $RecID
     */
    public function deleteAction($RecID)
    {

        $usergroupsdetail = Usergroupsdetail::findFirstByRecID($RecID);
        if (!$usergroupsdetail) {
            $this->flash->error("usergroupsdetail was not found");

            return $this->dispatcher->forward(array(
                "controller" => "usergroupsdetail",
                "action" => "index"
            ));
        }

        if (!$usergroupsdetail->delete()) {

            foreach ($usergroupsdetail->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->response->redirect(
                    "usergroups/edit/".$usergroupsdetail->UserGroup
            );
        }

        $this->flash->success("usergroupsdetail was deleted successfully");

        return $this->response->redirect(
                "usergroups/edit/".$usergroupsdetail->UserGroup
        );
    }

}
