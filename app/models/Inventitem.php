<?php

class Inventitem extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $KodeItem;

    /**
     *
     * @var string
     */
    public $NamaItem;

    /**
     *
     * @var integer
     */
    public $TipeInvent;

    /**
     *
     * @var integer
     */
    public $StatusItem;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('KodeItem', 'Bukusiswa', 'InventItem', array('alias' => 'Bukusiswa'));
        $this->hasMany('KodeItem', 'Inventreceipt', 'ItemId', array('alias' => 'Inventreceipt'));
        $this->hasMany('KodeItem', 'Inventstock', 'ItemId', array('alias' => 'Inventstock'));
        $this->hasMany('KodeItem', 'Purchreqline', 'ItemId', array('alias' => 'Purchreqline'));
        $this->belongsTo('TipeInvent', 'Inventtipe', 'KodeTipeInvent', array('alias' => 'Inventtipe'));
    }

}
