<?php

class Menuitemsgroup extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $MenuItemsGroupId;

    /**
     *
     * @var string
     */
    public $MenuItemsGroupName;

    /**
     *
     * @var integer
     */
    public $MenuItemsGroupOrder;

    public function initialize() {
        $this->skipAttributesOnCreate(array('MenuItemsGroupId'));
    }
}
