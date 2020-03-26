<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class UsergroupsController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for usergroups
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Usergroups", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecID";

        $usergroups = Usergroups::find($parameters);
        if (count($usergroups) == 0) {
            $this->flash->notice("The search did not find any usergroups");

            return $this->dispatcher->forward(array(
                "controller" => "usergroups",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $usergroups,
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
     * Edits a usergroup
     *
     * @param string $RecID
     */
    public function editAction($RecID)
    {

        if (!$this->request->isPost()) {

            $usergroup = Usergroups::findFirstByRecID($RecID);
            if (!$usergroup) {
                $this->flash->error("usergroup was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "usergroups",
                    "action" => "index"
                ));
            }

            $this->view->RecID = $usergroup->RecID;

            $this->tag->setDefault("RecID", $usergroup->RecID);
            $this->tag->setDefault("GroupName", $usergroup->GroupName);
            $this->tag->setDefault("dataTableUrl", $this->url->get("usergroups/details/{$usergroup->RecID}"));
            
        }
    }

    /**
     * Creates a new usergroup
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "usergroups",
                "action" => "index"
            ));
        }

        $usergroup = new Usergroups();

        $usergroup->GroupName = $this->request->getPost("GroupName");
        

        if (!$usergroup->save()) {
            foreach ($usergroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "usergroups",
                "action" => "new"
            ));
        }

        $this->flash->success("usergroup was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "usergroups",
            "action" => "index"
        ));

    }

    /**
     * Saves a usergroup edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "usergroups",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $usergroup = Usergroups::findFirstByRecID($RecID);
        if (!$usergroup) {
            $this->flash->error("usergroup does not exist " . $RecID);

            return $this->dispatcher->forward(array(
                "controller" => "usergroups",
                "action" => "index"
            ));
        }

        $usergroup->GroupName = $this->request->getPost("GroupName");

        $phql = "UPDATE Usergroups SET GroupName = '{$usergroup->GroupName}' WHERE RecID = {$RecID}";

        $ret = $this->db->query($phql);

//        if (!$usergroup->save()) {
        if (!$ret) {

            foreach ($usergroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "usergroups",
                "action" => "edit",
                "params" => array($usergroup->RecID)
            ));
        }

        $this->flash->success("usergroup was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "usergroups",
            "action" => "index"
        ));

    }

    /**
     * Deletes a usergroup
     *
     * @param string $RecID
     */
    public function deleteAction($RecID)
    {

        $usergroup = Usergroups::findFirstByRecID($RecID);
        if (!$usergroup) {
            $this->flash->error("usergroup was not found");

            return $this->dispatcher->forward(array(
                "controller" => "usergroups",
                "action" => "index"
            ));
        }

        if (!$usergroup->delete()) {

            foreach ($usergroup->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "usergroups",
                "action" => "search"
            ));
        }

        $this->flash->success("usergroup was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "usergroups",
            "action" => "index"
        ));
    }

    public function detailsAction($id) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $details = [];
        $groupdetail = Usergroupsdetail::findByUserGroup($id);
        if (!count($groupdetail)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($groupdetail as $detail) {
                $details[] = [
                    'id' => $detail->RecID,
                    'menuitems' => $detail->getMenuItem(),
                    'actionname' => $detail->ActionName
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'deleteUrl' => $this->url->get("usergroupsdetail/delete"),
                'listData' => $details
            ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }
}
