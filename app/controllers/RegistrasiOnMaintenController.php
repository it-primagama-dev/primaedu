<?php

class RegistrasiOnMaintenController extends ControllerBase {

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Maintenance");
        parent::initialize();

        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
            /*            if(!is_numeric($this->auth['areaparent'])) {
              $this->flash->error("Unauthorized Request");
              return $this->dispatcher->forward(array(
              "controller" => "index",
              "action" => "index"
              ));
              } */
        }
    } 

    public function indexAction() {
        
    }

}
