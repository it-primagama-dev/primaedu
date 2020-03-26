<?php

class Pengeluaranbiayagroup extends \Phalcon\Mvc\Model
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
    public $NamaBiayaGroup;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecID' => 'RecID', 
            'NamaBiayaGroup' => 'NamaBiayaGroup'
        );
    }

}
