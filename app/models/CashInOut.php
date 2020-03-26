<?php

use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class CashInOut extends \Phalcon\Mvc\Model
{

    public function initialize() {
        $this->setSource('CashInOut');
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
    public $Cabang;    

    /**
     *
     * @var integer
     */
    public $IDGroup;

    /**
     *
     * @var integer
     */
    public $IDHuruf;

    /**
     *
     * @var integer
     */
    public $IDClass;

    /**
     *
     * @var integer
     */
    public $IDTipe;

    /**
     *
     * @var integer
     */
    public $Tanggal;

    /**
     *
     * @var integer
     */
    public $Nominal;


    /**
     *
     * @var integer
     */
    public $Description;


    /**
     *
     * @var integer
     */
    public $CreatedBy;
    /**
     *
     * @var integer
     */
    public $CreatedAt;
}
