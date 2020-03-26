<?php

class Pembayaran extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $RecID;

    /**
     *
     * @var integer
     */
    public $ProgramSiswa;

    /**
     *
     * @var string
     */
    public $PembayaranTipe;

    /**
     *
     * @var integer
     */
    public $JumlahTotal;

    /**
     *
     * @var integer
     */
    public $SisaPembayaran;

    /**
     *
     * @var integer
     */
    public $AngsuranKe;

    /**
     *
     * @var string
     */
    public $JatuhTempo;

    /**
     *
     * @var integer
     */
    public $Diskon;

    /**
     *
     * @var string
     */
    public $CreatedAt;

    /**
     *
     * @var integer
     */
    public $CreatedBy;

    /**
     *
     * @var integer
     */
    public $BiayaPendaftaran;

    /**
     *
     * @var integer
     */
    public $BiayaBimbingan;

    public function initialize() {
        $this->hasMany("RecID", "Pembayarandetail", "Pembayaran", array("alias" => "Pembayarandetail"));
        $this->belongsTo("ProgramSiswa", "Programsiswa", "RecID");
        $this->belongsTo("CreatedBy", "Users", "RecID");
        $this->skipAttributesOnCreate(array('RecID'));
    }

    public function getSisaPembayaran() {
        $jumlah = Pembayarandetail::sum(array(
                    'column' => 'Jumlah',
                    'conditions' => 'Pembayaran = ?0',
                    'bind' => array($this->RecID)
                ));
        return $this->JumlahTotal - $jumlah;
    }

    public function afterFetch() {
        $temp = Pembayarandetail::findFirst(array(
                    'column' => 'Jumlah',
                    'conditions' => 'Pembayaran = ?0 AND PembayaranUntuk LIKE ?1',
                    'bind' => array($this->RecID, 'P%')
                ));
        $this->BiayaPendaftaran = $temp ? $temp->Jumlah : 0;
        $this->BiayaBimbingan = $this->JumlahTotal - $this->BiayaPendaftaran;
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecID' => 'RecID', 
            'ProgramSiswa' => 'ProgramSiswa', 
            'PembayaranTipe' => 'PembayaranTipe', 
            'JumlahTotal' => 'JumlahTotal', 
            'SisaPembayaran' => 'SisaPembayaran', 
            'AngsuranKe' => 'AngsuranKe', 
            'JatuhTempo' => 'JatuhTempo', 
            'Diskon' => 'Diskon', 
            'CreatedAt' => 'CreatedAt', 
            'CreatedBy' => 'CreatedBy'
        );
    }

}
