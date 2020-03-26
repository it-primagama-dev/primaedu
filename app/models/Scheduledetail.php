<?php

class Scheduledetail extends \Phalcon\Mvc\Model {

    /**
     *
     * @var integer
     */
    public $RecId;

    /**
     *
     * @var string
     */
    public $KodeScheduleDetail;

    /**
     *
     * @var integer
     */
    public $Schedule;

    /**
     *
     * @var string
     */
    public $Tanggal;

    /**
     *
     * @var string
     */
    public $Jam;

    /**
     *
     * @var integer
     */
    public $Ruangan;

    /**
     *
     * @var integer
     */
    public $Guru;
    public $BidangStudi;

    /**
     * Initialize method for model.
     */
    public function initialize() {
        $this->belongsTo('Schedule', 'Scheduleheader', 'RecId', array('alias' => 'Scheduleheader'));
        $this->belongsTo('Guru', 'Ismart', 'RecID', array('alias' => 'Ismart'));
        $this->belongsTo('Ruangan', 'Ruangan', 'RecID', array('alias' => 'Ruangan'));
    }

    public function getNamaRuangan() {
        return Ruangan::findFirst($this->Ruangan)->NamaRuangan;
    }

    public function getNamaGuru() {
        return Ismart::findFirst($this->Guru)->NamaISmart;
    }

    public function getBidangStudi() {
        return Bidangstudi::findFirstByKodeBidangStudi($this->BidangStudi)->NamaBidangStudi;
    }

}
