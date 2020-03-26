<?php

class Propinsi extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $RecID;

    /**
     *
     * @var string
     */
    public $NamaPropinsi;

    public function initialize() {
        $this->skipAttributesOnCreate(['RecID']);
        $this->hasMany('RecID', 'Kotakab', 'Propinsi');
    }
    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecID' => 'RecID', 
            'NamaPropinsi' => 'NamaPropinsi'
        );
    }

}
