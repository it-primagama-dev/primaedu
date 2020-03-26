<?php

class Kotakab extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $RecID;

    /**
     *
     * @var integer
     */
    public $Propinsi;

    /**
     *
     * @var string
     */
    public $NamaKotaKab;

    public function initialize() {
        $this->skipAttributesOnCreate(['RecID']);
        $this->belongsTo('Propinsi', 'Propinsi', 'RecID');
    }
    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecID' => 'RecID', 
            'Propinsi' => 'Propinsi', 
            'NamaKotaKab' => 'NamaKotaKab'
        );
    }

}
