<?php

class Scheduleheader extends \Phalcon\Mvc\Model
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
    public $TahunAjaran;

    /**
     *
     * @var string
     */
    public $KodeJadwal;

    /**
     *
     * @var string
     */
    public $Description;

    /**
     *
     * @var integer
     */
    public $Program;

    /**
     *
     * @var integer
     */
    public $Cabang;

    public function initialize() {
        $this->hasMany('RecId', 'Scheduledetail', 'Schedule', array('alias' => 'Scheduledetail'));
        $this->hasMany('RecId', 'Schedulesiswa', 'Schedule', array('alias' => 'Schedulesiswa'));
        $this->belongsTo('Cabang', 'Areacabang', 'RecID', array('alias' => 'Areacabang'));
        $this->belongsTo('Program', 'Program', 'RecID', array('alias' => 'Program'));
    }
    public function getNamaProgram() {
        return Program::findFirst($this->Program)->NamaProgram;
    }
    public function beforeValidationOnCreate() {
        $auth = $this->getDI()->getShared("session")->get("auth");
        $this->KodeJadwal = 'SCH-' . sprintf("%'.06d\n", $this->count(["Cabang = ?0", "bind" => [$auth["areacabang"]]]) + 1);
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecId' => 'RecId', 
            'TahunAjaran' => 'TahunAjaran', 
            'KodeJadwal' => 'KodeJadwal', 
            'Description' => 'Description', 
            'Program' => 'Program', 
            'Cabang' => 'Cabang'
        );
    }

}
