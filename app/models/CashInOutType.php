<?php

use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class CashInOutType extends \Phalcon\Mvc\Model
{

    public function initialize() {
        $this->setSource('CashInOutType');
    }

    /**
     *
     * @var integer
     */
    public $RecID;

    /**
     *
     * @var string
     */
    public $ClassId;    

    /**
     *
     * @var integer
     */
    public $CashInOutCode;

    /**
     *
     * @var string
     */
    public $Deskripsi;   

    /**
     *
     * @var integer
     */
    public $Status;

    /**
     *
     * @var integer
     */
    public $Create_at;
}
