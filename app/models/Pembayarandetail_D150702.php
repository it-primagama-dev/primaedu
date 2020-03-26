<?php

use Phalcon\Mvc\Model\Message;

class Pembayarandetail extends \Phalcon\Mvc\Model {

    const ST_SETTLED = '1';
    const ST_UNSETTLED = '0';
    const ST_VOID = 'V';
    

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
     * @var integer
     */
    public $CreatedBy;

    /**
     *
     * @var integer
     */
    public $Voidable;

    public function initialize() {
        $this->hasOne('RecID', 'transaksibank', 'RefRecID');
        $this->belongsTo("Pembayaran", "Pembayaran", "RecID", array("alias" => "Pb"));
        $this->skipAttributesOnCreate(array('RecID'));
    }

    public function beforeSave() {
        if ($this->Jumlah <= 0 || $this->Jumlah == "" || $this->Jumlah == null) {
            if ($this->NoReferensi[0] == self::ST_VOID) {
                return TRUE;
            }
            $message = new Message(
                    "Jumlah Bayar Tidak Valid", "", ""
            );
            $this->appendMessage($message);
            return FALSE;
        }

//        // ADIT | 13 Apr 2015 20:17
//        if ($this->NoReferensi != "" && ( $this->NoReferensi <= 0 || $this->NoReferensi == null)) {
//
//            $message = new Message(
//                    "No Referensi Tidak Valid", "", ""
//            );
//            $this->appendMessage($message);
//
//            return false;
//        }


// TOC-RB | 7 Apr 2015 20:17
        /* 		if ($this->NoReferensi <= 0 || $this->NoReferensi=="" || $this->NoReferensi==null) {

          $message = new Message(
          "No Referensi Tidak Valid",
          "",
          ""
          );
          $this->appendMessage($message);

          return false;
          }
         */
    }

    public function getMetodePembayaran() {
        $metode = Pembayaranmetode::findFirst($this->PembayaranMetode);
        return $metode->NamaMetode;
    }

    public function afterFetch() {
        $this->Voidable = $this->PembayaranUntuk[0] == "B" && $this->Status == self::ST_UNSETTLED ? TRUE : FALSE;
        $this->StatusDetail = $this->setStatus();
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
            'Jumlah' => 'Jumlah',
            'TanggalJatuhTempo' => 'TanggalJatuhTempo',
            'SisaPembayaran' => 'SisaPembayaran',
            'Status' => 'Status',
            'Remarks' => 'Keterangan',
            'CreatedBy' => 'CreatedBy'
        );
    }

    private function setStatus() {
        switch ($this->Status) {
            case Pembayarandetail::ST_SETTLED:
                return "Settled";
            case Pembayarandetail::ST_UNSETTLED:
                return "Unsettled";
            case Pembayarandetail::ST_VOID:
                return "Void";
            default:
                return "-";
        }
    }
}
