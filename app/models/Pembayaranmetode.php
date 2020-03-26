<?php

class Pembayaranmetode extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $MetodeId;

    /**
     *
     * @var string
     */
    public $NamaMetode;

    /**
     *
     * @var string
     */
    public $Parameter;

    /**
     *
     * @var integer
     */
    public $Aktif;

    /**
     *
     * @var integer
     */
    public $IsPendaftaran;

    public function initialize() {
        $this->hasMany('MetodeId', 'Pembayarandetail', 'PembayaranMetode');
        $this->skipAttributesOnCreate(array('MetodeId'));
    }
}
