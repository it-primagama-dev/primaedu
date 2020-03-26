<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class UsersController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
        $this->view->usergroup = Usergroups::find();
        $this->view->areacabang = Areacabang::find(["order" => "KodeAreaCabang"]);
    }

    /**
     * Searches for users
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Users", $_POST);
            $query->andWhere("Disabled = 0");
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }

        $parameters["order"] = "Username";        

        $users = Users::find($parameters);
        if (count($users) == 0) {
            $this->flash->notice("The search did not find any users");

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $users,
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
        $this->view->usergroup = Usergroups::find();
        $this->view->areacabang = Areacabang::find(["order" => "KodeAreaCabang"]);
    }

    /**
     * Edits a user
     *
     * @param string $RecID
     */
    public function editAction($RecID)
    {

        if (!$this->request->isPost()) {

            $user = Users::findFirstByRecID($RecID);
            if (!$user) {
                $this->flash->error("user was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "users",
                    "action" => "index"
                ));
            }

            $this->view->usergroup = Usergroups::find();
            $this->view->areacabang = Areacabang::find(["order" => "KodeAreaCabang"]);

            $this->view->RecID = $user->RecID;

            $this->tag->setDefault("RecID", $user->RecID);
            $this->tag->setDefault("Username", $user->Username);
            $this->tag->setDefault("Fullname", $user->Fullname);
            $this->tag->setDefault("Email", $user->Email);
            $this->tag->setDefault("UserGroup", $user->UserGroup);
            $this->tag->setDefault("AreaCabang", $user->AreaCabang);
        }
    }

    /**
     * Creates a new user
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $user = new Users();

        $user->Username = $this->request->getPost("Username");
        $user->Password = sha1(Users::DFT_PASS);
        $user->Fullname = $this->request->getPost("Fullname");
        $user->Email = $this->request->getPost("Email");
        $user->UserGroup = $this->request->getPost("UserGroup");
        $user->AreaCabang = $this->request->getPost("AreaCabang");
        //$user->CreatedBy = $this->request->getPost("CreatedBy");
        

        if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "new"
            ));
        }

        $this->flash->success("user was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "users",
            "action" => "search"
        ));

    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $user = Users::findFirstByRecID($RecID);
        if (!$user) {
            $this->flash->error("user does not exist " . $RecID);

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $user->Username = $this->request->getPost("Username");
        $user->Fullname = $this->request->getPost("Fullname");
        $user->Email = $this->request->getPost("Email");
        $user->UserGroup = $this->request->getPost("UserGroup");
        $user->AreaCabang = $this->request->getPost("AreaCabang");
        $user->CreatedBy = $this->request->getPost("CreatedBy");
        

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "edit",
                "params" => array($user->RecID)
            ));
        }

        $this->flash->success("user was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "users",
            "action" => "index"
        ));

    }

    /**
     * Deletes a user
     *
     * @param string $RecID
     */
    public function deleteAction($RecID)
    {

        $user = Users::findFirstByRecID($RecID);
        if (!$user) {
            $this->flash->error("user was not found");

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        if (!$user->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "search"
            ));
        }

        $this->flash->success("user was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "users",
            "action" => "index"
        ));
    }

    public function resetAction($RecID)
    {

        if (!$this->request->isPost()) {

            $user = Users::findFirstByRecID($RecID);
            if (!$user) {
                $this->flash->error("user was not found");
                return $this->forward("users/index");
            }
            // RESET TO DEFAULT
            $user->Password = sha1(Users::DFT_PASS);
            if (!$user->save()) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error($message);
                }
                return $this->forward("users/index");
            }
            $this->flash->success("Reset Password untuk user ".$user->Username." berhasil");
            return $this->response->redirect("users/index");
        }
    }
}
