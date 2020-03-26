<?php

class Purchreqline extends \Phalcon\Mvc\Model
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
    public $Purchreqheader;

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
        $this->hasMany('RecId', 'Inventreceipt', 'PurchReqLineRecId', array('alias' => 'Inventreceipt'));
        $this->belongsTo('ItemId', 'Inventitem', 'KodeItem', array('alias' => 'Inventitem'));
        $this->belongsTo('Purchreqheader', 'Purchreqheader', 'RecId', array('alias' => 'Purchreqheader'));
    }

    public function afterFetch() {
        $this->QtyReceived = $this->Qty - $this->QtyRemaining;
    }
}
