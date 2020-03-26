<?php

use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class CashInOutHuruf extends \Phalcon\Mvc\Model
{

    public function initialize() {
        $this->setSource('CashInOutHuruf');
    }

    /**
     *
     * @var integer
     */
    public $RecID;

    /**
     *
     * @var integer
     */
    public $KodeGroup;

    /**
     *
     * @var string
     */
    public $Deskripsi;   

    /**
     *
     * @var integer
     */
    public $Create_at;
}
