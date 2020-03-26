<?php

class Programsiswa extends \Phalcon\Mvc\Model
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
    public $Siswa;

    /**
     *
     * @var integer
     */
    public $Program;

    /**
     *
     * @var integer
     */
    public $ScheduleHeader;

    /**
     *
     * @var string
     */
    public $CreatedAt;

    /**
     *
     * @var integer
     */
    public $CreatedBy;

    public function initialize() {
        $this->skipAttributesOnCreate(array('RecID'));
        $this->hasOne("RecID", "Bukusiswa", "ProgramSiswa", array('alias' => 'Bukusiswa'));
        $this->hasMany("RecID", "Nilai", "ProgramSiswaRecId");
        $this->belongsTo("Program", "Program", "RecID", ['alias' => 'P']);
    }

    public function getObjSiswa() {
        return Siswa::findFirstByRecID($this->Siswa);
    }

    public function getSiswa() {
        return Siswa::findFirst($this->Siswa)->NamaSiswa;
    }

    public function getJenjang() {
        return Program::findFirst($this->Program)->Jenjang;
    }

    public function getKodeSiswa() {
        return Siswa::findFirst($this->Siswa)->VirtualAccount;
    }

    public function getProgram() {
        return Program::findFirst($this->Program)->NamaProgram;
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecID' => 'RecID', 
            'Siswa' => 'Siswa', 
            'Program' => 'Program', 
            'ScheduleHeader' => 'ScheduleHeader', 
            'CreatedAt' => 'CreatedAt', 
            'CreatedBy' => 'CreatedBy'
        );
    }
}
