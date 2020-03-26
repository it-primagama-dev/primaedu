<?php

class Jenjang extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $KodeJenjang;

    /**
     *
     * @var string
     */
    public $NamaJenjang;

    public function initialize() {
        $this->hasMany('KodeJenjang', 'Program', 'Jenjang');
        $this->skipAttributesOnCreate(array('KodeJenjang'));
    }
}
