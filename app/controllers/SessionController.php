<?php

class SessionController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle("Login");
        // TOC-RB Dispatcher Cycling Error
        //parent::initialize();
    }

    public function indexAction() {
        
    }

    private function _registerSession(Users $user) {
        $areacabang = Areacabang::findFirst([
                    "RecID = :recid: AND Aktif = 1", "bind" => ["recid" => $user->AreaCabang]
        ]);
        if ($user->AreaCabang && $areacabang === FALSE) {
            return FALSE;
        }
        $this->session->set('auth', [
            'username' => $user->Username,
            'fullname' => $user->Fullname,
            'password' => $user->Password,
            'userid' => $user->RecID,
            'areaparent' => $user->getArea(),
            'areacabang' => $user->AreaCabang,
            'sektorcabang' => $user->getSektor(),
            'kodeareacabang' => $areacabang->KodeAreaCabang,
            'usergroup' => $user->UserGroup,
        ]);
        return TRUE;
    }

    private function _saveMenus(Users $user) {
        $menus = $this->modelsManager->createBuilder()
                ->columns(array('MenuItemsGroupName', 'MenuItem', 'ControllerName', 'ActionName', 'm.Status'))
                ->from('Usergroupsdetail')
                ->leftJoin('Menuitems', 'Usergroupsdetail.MenuItems = m.RecID', 'm')
                ->leftJoin('Menuitemsgroup', 'm.MenuItemsGroup = n.MenuItemsGroupId', 'n')
                ->where('Usergroupsdetail.UserGroup = :group: AND m.Hide = 0')
                ->orderBy(array('n.MenuItemsGroupOrder', 'm.MenuItem'))
                ->getQuery()
                ->execute(array('group' => $user->UserGroup));
        $element = [];
        $i = 0;
        foreach ($menus->toArray() as $menu) {
            $element[$menu['MenuItemsGroupName']][$i] = array(
                'MenuItem' => $menu['MenuItem'],
                'ControllerName' => $menu['ControllerName'],
                'ActionName' => $menu['ActionName'],
                'Status' => $menu['Status'],
            );
            $i++;
        }
        $this->session->set('menu', $element);
    }

    public function startAction() {
        if ($this->request->isPost()) {
            $username = $this->request->getPost("username");
            $password = sha1($this->request->getPost("password"));

            $user = Users::findFirst(
                            array(
                                "Username = :user: AND Password = :pass: AND Disabled = 0",
                                'bind' => array('user' => $username, 'pass' => $password)
            ));
            if ($user !== FALSE && $this->_registerSession($user)) {
                $this->_saveMenus($user);
                $user->LastLogin = date('Y-m-d H:i:s');

                //automatic register api auth if not exist
                $helper = new Helpers();
                $secretKey = $this->apiConfig->secretKey;
                $createdBy = $this->apiConfig->createdBy;
                $branchCode = $this->session->get('auth')["kodeareacabang"];
                $url = $this->apiConfig->baseUrl . "auth/register";
                $data = array(
                    'Branch_Code' => ($branchCode!="")?$branchCode:"0000",
                    'Created_By' => $createdBy,
                );
                $response = $helper->requestAPI($url, "POST", json_encode($data), NULL, $secretKey);

                $apiKey = $user->API_Key;
                if ($response["code"] == 200) {

                    $message = $response["message"];
                    $apiKey = $message->api_key;

                    if ($apiKey !== $user->API_Key) {
                        $user->API_Key = $apiKey;
                    }
                }

                $this->session->set('apiKey', $apiKey);
                //$user->save();
                /*
                  if ($user->UserGroup==30 OR $user->UserGroup==11) { */
                if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                    $uri = 'https://';
                } else {
                    $uri = 'http://';
                }
                $uri .= $_SERVER['HTTP_HOST'];
                header('Location: ' . $uri . '/primaedu/spe?q=' . base64_encode(base64_encode($username) . '-' . base64_encode($password)));
                exit; /*
                  } else {
                  return $this->dispatcher->forward(array(
                  "controller"=>"kuesioner",
                  "action"=>"index"
                  ));
                  } */
            }
            $this->flash->error("Username atau Password Salah..");
        }
        return $this->forward('session/index');
    }

    public function endAction() {
        //$this->session->remove('auth');
        $this->session->destroy();
        //$this->response->redirect();
        $this->dispatcher->forward(array(
            "controller" => "session",
            "action" => "index"
        ));
    }

//    public function testAction() {
//        $this->getDI()->getMail()->send(
//                ['roby.i@hotmail.com' => 'Roby Istighfari'], "Reset your password", 'reset', ['resetUrl' => 'test params']
//        );
//    }
}
