<?php

class Konfirmasipembayaran2 extends \Phalcon\Mvc\Model {

    /**
     *
     * @var integer
     */
    public $RecID;

    /**
     *
     * @var string
     */
    public $Cabang;
    /**
     *
     * @var string
     */
	  public $ConfirmId;
    /**
     *
     * @var string
     */
    public $PurchReqName;
    /**
     *
     * @var string
     */
    public $Nominal;
	
	  
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
    public $Remarks;
	
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
     *
     * @var string
     */
	 public $Bank;
 /**
     *
     * @var string
     */

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

}