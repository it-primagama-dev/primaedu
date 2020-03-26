<?php

class Programtipe extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $KodeTipeProgram;

    /**
     *
     * @var string
     */
    public $NamaTipeProgram;

    public function initialize() {
        $this->hasMany('KodeTipeProgram', 'Program', 'TipeProgram');
        $this->skipAttributesOnCreate(array('KodeTipeProgram'));
    }
}
