<?php

class Purchreqheader extends \Phalcon\Mvc\Model {

    /**
     *
     * @var integer
     */
    public $RecId;

    /**
     *
     * @var string
     */
    public $PurchReqId;

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
    public $PurchReqDate;
    
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
        $this->hasMany('RecId', 'Purchreqline', 'Purchreqheader', array('alias' => 'Purchreqline'));
        $this->belongsTo('Cabang', 'Areacabang', 'RecID', ['alias' => 'Areacabang']);
    }

    public function totalRecord() {
        $auth = $this->getDI()->getShared("session")->get("auth");
        return $this->count(["Cabang = ?0", "bind" => [$auth["areacabang"]]]);
    }

    public function getTotalOrderQty() {
        return Purchreqline::sum([
            'column' => 'Qty', 'Purchreqheader = ?0', 'bind' => [0 => $this->RecId]
        ]);
    }
}
