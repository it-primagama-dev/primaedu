<?php

class Schedulesiswa extends \Phalcon\Mvc\Model
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
    public $KodeScheduleSiswa;

    /**
     *
     * @var integer
     */
    public $Siswa;

    /**
     *
     * @var integer
     */
    public $Schedule;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('Schedule', 'Scheduleheader', 'RecId', array('alias' => 'Scheduleheader'));
        $this->belongsTo('Siswa', 'Siswa', 'RecID', array('alias' => 'Siswa'));
    }

}
