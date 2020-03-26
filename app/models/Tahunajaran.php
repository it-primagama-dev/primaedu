<?php

class Tahunajaran extends \Phalcon\Mvc\Model
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
    public $Description;

    /**
     *
     * @var string
     */
    public $FromDate;

    /**
     *
     * @var string
     */
    public $ToDate;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecID' => 'RecID', 
            'Description' => 'Description', 
            'FromDate' => 'FromDate', 
            'ToDate' => 'ToDate'
        );
    }

}
