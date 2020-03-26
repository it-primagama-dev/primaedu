<?php

class Nilai extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $RecId;

    /**
     *
     * @var integer
     */
    public $ProgramSiswaRecId;

    /**
     *
     * @var string
     */
    public $BidangStudi;

    /**
     *
     * @var integer
     */
    public $Nilai1;

    /**
     *
     * @var integer
     */
    public $Nilai2;

    /**
     *
     * @var integer
     */
    public $Nilai3;

    /**
     *
     * @var integer
     */
    public $Nilai4;

    /**
     *
     * @var integer
     */
    public $Nilai5;

    /**
     *
     * @var integer
     */
    public $Nilai6;

    /**
     *
     * @var integer
     */
    public $Nilai7;

    /**
     *
     * @var integer
     */
    public $Nilai8;

    /**
     *
     * @var integer
     */
    public $Nilai9;

    /**
     *
     * @var integer
     */
    public $Nilai10;

    public function initialize() {
        $this->belongsTo("BidangStudi", "Bidangstudi", "KodeBidangStudi");
        $this->belongsTo("ProgramSiswaRecId", "Programsiswa", "RecID");
		 $this->skipAttributesOnCreate(array('RecId'));
    }

    public function getBidangStudi() {
        return Bidangstudi::findFirstByKodeBidangStudi($this->BidangStudi)->NamaBidangStudi;
    }
    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecId' => 'RecId', 
            'ProgramSiswaRecId' => 'ProgramSiswaRecId', 
            'BidangStudi' => 'BidangStudi', 
            'Nilai1' => 'Nilai1', 
            'Nilai2' => 'Nilai2', 
            'Nilai3' => 'Nilai3', 
            'Nilai4' => 'Nilai4', 
            'Nilai5' => 'Nilai5', 
            'Nilai6' => 'Nilai6', 
            'Nilai7' => 'Nilai7', 
            'Nilai8' => 'Nilai8', 
            'Nilai9' => 'Nilai9', 
            'Nilai10' => 'Nilai10'
        );
    }

}
