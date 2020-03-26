<?php

use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class CashInOutGroup extends \Phalcon\Mvc\Model
{

    public function initialize() {
        $this->setSource('CashInOutGroup');
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
    public $GroupName;

}
