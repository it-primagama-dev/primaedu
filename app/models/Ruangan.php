<?php

class Ruangan extends \Phalcon\Mvc\Model
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
    public $KodeRuangan;

    /**
     *
     * @var string
     */
    public $NamaRuangan;

    /**
     *
     * @var integer
     */
    public $Kapasitas;

    /**
     *
     * @var integer
     */
    public $Cabang;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('RecID', 'Programruangan', 'Ruangan', array('alias' => 'Programruangan'));
        $this->hasMany('RecID', 'Scheduledetail', 'Ruangan', array('alias' => 'Scheduledetail'));
        $this->belongsTo('Cabang', 'Areacabang', 'RecID', array('alias' => 'Areacabang'));
		$this->skipAttributesOnCreate(array('RecID'));
    }

}
