<?php

class Menuitems extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $MenuItemsGroup;

    /**
     *
     * @var string
     */
    public $MenuItem;

    /**
     *
     * @var string
     */
    public $ControllerName;

    /**
     *
     * @var string
     */
    public $ActionName;

    /**
     *
     * @var integer
     */
    public $RecID;

    public function initialize() {
        $this->belongsTo('MenuItemsGroup', 'Menuitemsgroup', 'MenuItemsGroupId');
        $this->hasMany('RecID', 'Usergroupsdetail', 'MenuItems');
        $this->skipAttributesOnCreate(array('RecID'));
    }

    public function getGroupName() {
        $menuitemsgroup = Menuitemsgroup::findFirst($this->MenuItemsGroup);
        return $menuitemsgroup !== FALSE ? $menuitemsgroup->MenuItemsGroupName:"-";
    }
}
