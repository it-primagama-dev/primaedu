<?php

use Phalcon\Mvc\Model\Message;

class Pembayarandetail extends \Phalcon\Mvc\Model {

    const ST_UNSETTLED = '0';
    const ST_SETTLED = '1';
    const ST_VOID = 'V';
    const STD_UNSETTLED = 'Unsettled';
    const STD_SETTLED = 'Settled';
    const STD_VOID = 'Void';

    const PB_BIMBINGAN = 'Bimbingan';
    const PB_PENDAFTARAN = 'Pendaftaran';
    

    /**
     *
     * @var integer
     */
    public $RecID;

    /**
     *
     * @var integer
     */
    public $Pembayaran;

    /**
     *
     * @var string
     */
    public $DocumentNo;

    /**
     *
     * @var string
     */
    public $TanggalPembayaran;

    /**
     *
     * @var integer
     */
    public $PembayaranMetode;

    /**
     *
     * @var string
     */
    public $PembayaranUntuk;

    /**
     *
     * @var string
     */
    public $NoReferensi;
    
	/* 
		Add By Anton 7-10-2015
	*/
	public $CardNo;
	
	public $AuthCd;
    
    /**
     * TOC-RB : 8-8-2015
     * @var string
     */
    public $NamaBank;

    /**
     *
     * @var integer
     */
    public $Jumlah;

    /**
     *
     * @var string
     */
    public $TanggalJatuhTempo;

    /**
     *
     * @var integer
     */
    public $SisaPembayaran;

    /**
     *
     * @var string
     */
    public $Status;

    /**
     *
     * @var string
     */
    public $StatusDetail;

    /**
     *
     * @var string
     */
    public $Keterangan;
 /**
     *
     * @var string
     */
    public $NoAgreement;
    /**
     *
     * @var integer
     */
    public $CreatedBy;

    /**
     *
     * @var integer
     */
    public $Voidable;
    
    /**
     *
     * @var integer
     */
    public $Editable;
	
	/**
     *
     * @var integer
     */
    public $PrintCounter;

    public function initialize() {
        $this->hasOne('RecID', 'transaksibank', 'RefRecID');
        $this->belongsTo("Pembayaran", "Pembayaran", "RecID", array("alias" => "Pb"));
        $this->skipAttributesOnCreate(array('RecID'));
    }

    public function beforeSave() {
        if ($this->Jumlah <= 0 || $this->Jumlah == "" || $this->Jumlah == null) {
            if (substr($this->NoReferensi,0,1) == self::ST_VOID) {
                return TRUE;
            }
            $message = new Message(
                    "Jumlah Bayar Tidak Valid", "", ""
            );
            $this->appendMessage($message);
            return FALSE;
        }
        
        //TOC-RB 01-Jul-2015
        $this->Status = $this->setStatus($this->Status);
    }

    public function getMetodePembayaran() {
        $metode = Pembayaranmetode::findFirst($this->PembayaranMetode);
        return $metode->NamaMetode;
    }

    public function afterFetch() {
        $this->Voidable = $this->PembayaranUntuk[0] == "B" && $this->Status == self::ST_UNSETTLED ? TRUE : FALSE;
        $this->Editable = $this->PembayaranUntuk[0] == "B" && $this->Status == self::ST_UNSETTLED ? TRUE : FALSE;
        $this->StatusDetail = $this->getStatus();
        $this->Status = $this->getStatus();
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap() {
        return array(
            'RecID' => 'RecID',
            'Pembayaran' => 'Pembayaran',
            'DocumentNo' => 'DocumentNo',
            'TanggalPembayaran' => 'TanggalPembayaran',
            'PembayaranMetode' => 'PembayaranMetode',
            'PembayaranUntuk' => 'PembayaranUntuk',
            'NoReferensi' => 'NoReferensi',
            'NamaBank' => 'NamaBank',
            'Jumlah' => 'Jumlah',
            'CardNo' => 'CardNo',
            'AuthCd' => 'AuthCd',
            'TanggalJatuhTempo' => 'TanggalJatuhTempo',
            'SisaPembayaran' => 'SisaPembayaran',
            'Status' => 'Status',
            'Remarks' => 'Keterangan',
            'CreatedBy' => 'CreatedBy',
			'NoAgreement' => 'NoAgreement',
			'PrintCounter' => 'PrintCounter'
        );
    }

    private function getStatus() {
        switch ($this->Status) {
            case self::ST_UNSETTLED:
                return self::STD_UNSETTLED;
            case self::ST_SETTLED:
                return self::STD_SETTLED;
            case self::ST_VOID:
                return self::STD_VOID;
            default:
                return "-";
        }
    }

    private function setStatus($status) {
        switch ($status) {
            case self::STD_UNSETTLED:
                return self::ST_UNSETTLED;
            case self::STD_SETTLED:
                return self::ST_SETTLED;
            case self::STD_VOID:
                return self::ST_VOID;
            default:
                return $status;
        }
    }
}
