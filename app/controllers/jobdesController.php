<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class jobdesController extends ControllerBase
{

    public function indexAction() {
        $this->persistent->parameters = null;
    }

    
}