<?php

class Inventstock extends \Phalcon\Mvc\Model {

    /**
     *
     * @var integer
     */
    public $RecId;

    /**
     *
     * @var string
     */
    public $ItemId;

    /**
     *
     * @var string
     */
    public $ItemName;

    /**
     *
     * @var string
     */
    public $QtyReceipt;

    /**
     *
     * @var string
     */
    public $QtyOrder;

    /**
     *
     * @var string
     */
    public $TransDate;
    public $Cabang;

    /**
     * Initialize method for model.
     */
    public function initialize() {
        $this->belongsTo('ItemId', 'Inventitem', 'KodeItem', array('alias' => 'Inventitem'));
    }

    public function getItemName() {
        return Inventitem::findFirstByKodeItem($this->ItemId)->NamaItem;
    }

    public function getSumQtyReceipt() {

        $totalReceipt = $this->sum(array(
            "column" => "QtyReceipt",
            "group" => "ItemId",
            "conditions" => "Cabang = ?0",
            "bind" => array($this->Cabang)));

        $totalOrder = $this->sum(array(
            "column" => "QtyOrder",
            "group" => "ItemId",
            "conditions" => "Cabang = ?0",
            "bind" => array($this->Cabang)));

        $totalStock = $totalReceipt[1]->sumatory - $totalOrder[1]->sumatory;

        return $totalStock;
    }

}
