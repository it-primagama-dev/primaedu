<?php

class Pengeluarantipe extends \Phalcon\Mvc\Model
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
    public $BiayaGroup;

    /**
     *
     * @var string
     */
    public $KodePengeluaran;

    /**
     *
     * @var string
     */
    public $Description;

    public function initialize()
    {
        $this->hasMany('RecId', 'Pengeluaranbiaya', 'Pengeluaran', array('alias' => 'Pengeluaranbiaya'));
        $this->belongsTo('BiayaGroup', 'Pengeluaranbiayagroup', 'RecID');
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecId' => 'RecId', 
            'BiayaGroup' => 'BiayaGroup', 
            'KodePengeluaran' => 'KodePengeluaran', 
            'Description' => 'Description'
        );
    }

}
