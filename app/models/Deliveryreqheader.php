<?php

class Deliveryreqheader extends \Phalcon\Mvc\Model {

    /**
     *
     * @var integer
     */
    public $RecId;

    /**
     *
     * @var string
     */
    public $DeliveryReqId;



    /**
     *
     * @var string
     */
    public $PurchReqId;


    /**
     *
     * @var string
     */
    public $Purchreqheader;


    /**
     *
     * @var string
     */
    public $PurchReqName;

    /**
     *
     * @var string
     */
    public $Requester;

    /**
     *
     * @var string
     */
    public $DeliveryReqDate;
    
    /**
     *
     * @var string
     */
    public $ApprovalDate;

    /**
     *
     * @var string
     */
    public $Status;

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

    public $Cabang;

    /**
     * Initialize method for model.
     */
    public function initialize() {
        $this->hasMany('RecId', 'Deliveryreqline', 'Deliveryreqheader', array('alias' => 'Deliveryreqline'));
        $this->belongsTo('Cabang', 'Areacabang', 'RecID', ['alias' => 'Areacabang']);
    }

    public function totalRecord() {
        $auth = $this->getDI()->getShared("session")->get("auth");
        return $this->count(["Cabang = ?0", "bind" => [$auth["areacabang"]]]);
    }

}
