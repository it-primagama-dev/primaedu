<?php

class Programdetail extends \Phalcon\Mvc\Model
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
    public $NamaProgramDetail;

    /**
     *
     * @var integer
     */
    public $Program;

    /**
     *
     * @var string
     */
    public $BidangStudi;

    /**
     *
     * @var integer
     */
    public $Bobot;

    public function initialize() {
        $this->belongsTo('Program', 'Program', 'RecID');
        $this->belongsTo('BidangStudi', 'Bidangstudi', 'KodeBidangStudi');
        $this->skipAttributesOnCreate(array('RecID'));
    }

    public function getBidangStudi() {
        return Bidangstudi::findFirstByKodeBidangStudi($this->BidangStudi)->NamaBidangStudi;
    }
    /**
     * Independent Column Mapping.
     */


}
