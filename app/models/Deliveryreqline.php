<?php

class Deliveryreqline extends \Phalcon\Mvc\Model
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
    public $Deliveryreqheader;

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
     * @var integer
     */
    public $Qty;
    
    /**
     *
     * @var integer
     */
    public $QtyRemaining;
    
    /**
     *
     * @var integer
     */
    public $QtyReceived;

    /**
     *
     * @var integer
     */
    public $IsReceipt;

    /**
     *
     * @var string
     */
    public $CreatedBy;

    /**
     *
     * @var string
     */
    public $CreatedDateTime;

    
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('CreatedBy', 'Users', 'Username', array('alias' => 'Users'));
        $this->belongsTo('Cabang', 'Areacabang', 'RecID', array('alias' => 'Areacabang'));
        $this->belongsTo('ItemId', 'Inventitem', 'KodeItem', array('alias' => 'Inventitem'));
    }

    public function getRecId(){
        return $this->RecId;
    }

    public function getCabang(){
        return $this->Cabang();
    }

    public function getPurchReqLineRecId(){
        return $this->PurchReqLineRecId;
    }

    public function getPackingSlipId(){
        return $this->PackingSlipId;
    }

    public function getReceiptDate(){
        return $this->ReceiptDate;
    }

    public function getItemId(){
        return $this->ItemId;
    }

    public function getItemName(){
        return $this->ItemName;
    }

    public function getQtyReceipt(){
        return $this->QtyReceipt;
    }

    public function getRemainingQty(){
        return $this->RemainingQty;
    }

    public function getCreatedBy(){
        return $this->CreatedBy;
    }

    public function getCreatedDateTime(){
        return $this->CreatedDateTime;
    }
}
