<?php

class Bukusiswa extends \Phalcon\Mvc\Model
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
    public $ProgramSiswa;

    /**
     *
     * @var string
     */
    public $InventItem;

    /**
     *
     * @var string
     */
    public $TanggalTerima;

    /**
     *
     * @var integer
     */
    public $Jumlah;

    /**
     *
     * @var string
     */
    public $SerialNumber;

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
        $this->skipAttributesOnCreate(array('RecID'));
        $this->belongsTo('ProgramSiswa', 'ProgramSiswa', 'RecID', array('alias' => 'ProgramSiswa'));
        $this->belongsTo('Cabang', 'Areacabang', 'RecID', array('alias' => 'Areacabang'));
        $this->belongsTo('InventItem', 'Inventitem', 'KodeItem', array('alias' => 'Inventitem'));
    }
}
