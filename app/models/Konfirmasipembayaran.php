<?php

class Konfirmasipembayaran extends \Phalcon\Mvc\Model {

    /**
     *
     * @var integer
     */
    public $RecId;

    /**
     *
     * @var string
     */
    public $Confirmreqid;
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
    public $Nominal;

    /**
     *
     * @var string
     */
	  public $areacabang;
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
 /**
     *
     * @var string
     */
	 public $Bank;
 /**
     *
     * @var string
     */
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

}