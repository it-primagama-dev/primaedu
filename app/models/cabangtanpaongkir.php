<?php

class cabangtanpaongkir extends \Phalcon\Mvc\Model
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
    public $KodeCabang;

    /**
     *
     * @var integer
     */
    public $Status;

    /**
     *
     * @var datetime
     */
    public $CreateAt;

    /**
     * Independent Column Mapping.
     */

    public function columnMap()
    {
        return array(
            'RecID' => 'RecID', 
            'KodeCabang' => 'KodeCabang', 
            'Status' => 'Status', 
            'CreateAt' => 'CreateAt'
        );
    }

}
