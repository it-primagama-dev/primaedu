<?php

class Usergroups extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $GroupName;

    /**
     *
     * @var integer
     */
    public $RecID;

    public function initialize(){
        $this->hasMany('RecID', 'Users', 'UserGroup');
        $this->hasMany('RecID', 'Usergroupsdetail', 'UserGroup');
        $this->hasManyToMany(
                'RecID', 'Usergroupsdetail', 'UserGroup',
                'MenuItems', 'Menuitems', 'RecID');
        $this->skipAttributesOnCreate(array('RecID'));
        //$this->skipAttributesOnUpdate(array('RecID','GroupName'));
    }
}
