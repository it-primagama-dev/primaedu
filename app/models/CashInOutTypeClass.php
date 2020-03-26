<?php

use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class CashInOutTypeClass extends \Phalcon\Mvc\Model
{

    public function initialize() {
        $this->setSource('CashInOutTypeClass');
    }

    /**
     *
     * @var integer
     */
    public $RecId;


    /**
     *
     * @var string
     */
    public $ClassName;    

    /**
     *
     * @var integer
     */
    public $KodeHuruf;

    /**
     *
     * @var integer
     */
    public $Create_at;

}
