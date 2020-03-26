<?php

class Programharga extends \Phalcon\Mvc\Model
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
    public $Program;

    /**
     *
     * @var integer
     */
    public $HargaBimbingan;

    /**
     *
     * @var integer
     */
    public $HargaPendaftaran;

    /**
     *
     * @var string
     */
    public $TanggalBerlaku;

    /**
     *
     * @var integer
     */
    public $AreaCabang;
    public function initialize() {
        $this->belongsTo('Program', 'Program', 'RecID');
        $this->belongsTo('AreaCabang', 'Areacabang', 'RecID');
        $this->skipAttributesOnCreate(array('RecID'));
    }
    public function getNamaProgram() {
        return Program::findFirst($this->Program)->NamaProgram;
    }
    public function getNamaArea() {
        return Areacabang::findFirst($this->AreaCabang)->NamaAreaCabang;
    }

    /**
     * Independent Column Mapping.
     */


}
