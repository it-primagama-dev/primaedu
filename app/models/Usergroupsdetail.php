<?php

class Usergroupsdetail extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $UserGroup;

    /**
     *
     * @var integer
     */
    public $MenuItems;

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
        $this->belongsTo('UserGroup', 'Usergroups', 'RecID');
        $this->belongsTo('MenuItems', 'Menuitems', 'RecID');
        $this->skipAttributesOnCreate(array('RecID'));
    }

    public function getMenuItem() {
        return Menuitems::findFirst($this->MenuItems)->MenuItem;
    }
    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'UserGroup' => 'UserGroup', 
            'MenuItems' => 'MenuItems', 
            'ActionName' => 'ActionName', 
            'RecID' => 'RecID'
        );
    }

}
