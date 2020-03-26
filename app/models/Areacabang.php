<?php

class Areacabang extends \Phalcon\Mvc\Model {

    /**
     *
     * @var integer
     */
    public $RecID;

    /**
     *
     * @var string
     */
    public $KodeAreaCabang;

    /**
     *
     * @var string
     */
    public $Area;

    /**
     *
     * @var string
     */
    public $NamaAreaCabang;

    /**
     *
     * @var string
     */
    public $TanggalBerlaku;

    /**
     *
     * @var string
     */
    public $TanggalBerakhir;

    /**
     *
     * @var string
     */
    public $Alamat;

    /**
     *
     * @var integer
     */
    public $Propinsi;

    /**
     *
     * @var integer
     */
    public $Kota;

    /**
     *
     * @var integer
     */
    public $KodePos;

    /**
     *
     * @var string
     */
    public $NoTelp;

    /**
     *
     * @var string
     */
    public $NamaManager;

    /**
     *
     * @var string
     */
    public $NoHandPhone;

    /**
     *
     * @var string
     */
    public $NoRekBCA;

    /**
     *
     * @var string
     */
    public $NamaRekBCA;

    /**
     *
     * @var string
     */
    public $KodeBankNonBCA;

    /**
     *
     * @var string
     */
    public $NoRekNonBCA;

    /**
     *
     * @var string
     */
    public $NamaRekNonBCA;

    /**
     *
     * @var string
     */
    public $NoRekMandiri;

    /**
     *
     * @var string
     */
    public $NamaRekMandiri;

    /**
     *
     * @var string
     */
    public $Email;

    /**
     *
     * @var double
     */
    public $Longitude;

    /**
     *
     * @var double
     */
    public $Latitude;

    /**
     *
     * @var string
     */
    public $NamaFranchisee;

    /**
     *
     * @var string
     */
    public $AlamatFranchisee;

    /**
     *
     * @var string
     */
    public $NoTelpFranchisee;

    /**
     *
     * @var string
     */
    public $EmailFranchisee;

    /**
     *
     * @var integer
     */
    public $Aktif;

    /**
     *
     * @var string
     */
    public $KodeNamaAreaCabang;

    /**
     *
     * @var string
     */
    public $Cilegal;

    public function beforeValidationOnCreate() {
        if (is_null($this->Area)) {
            $this->KodeAreaCabang = "A-" . sprintf("%04d", $this->count("Area IS NULL") + 1);
        }
//        else
//        {
//            $this->KodeAreaCabang = sprintf("%04d", $this->count("Area IS NOT NULL")+1);
//        }
    }

    public function initialize() {
        $this->skipAttributesOnCreate(array('RecID'));
        $this->belongsTo('Propinsi', 'Propinsi', 'RecID', ['alias' => 'PropinsiModel']);
        $this->belongsTo('Kota', 'Kotakab', 'RecID', ['alias' => 'KotaModel']);
    }

    public function getNamaArea() {
        $area = Areacabang::findFirst(array(
                    'conditions' => 'KodeAreaCabang = ?0',
                    'bind' => array(
                        0 => $this->Area
                    ),
        ));
        return $area !== FALSE ? $area->NamaAreaCabang : "-";
    }

    public function afterFetch() {
        $this->KodeAreaCabang = trim($this->KodeAreaCabang);
        $this->Area = !is_null($this->Area) ? trim($this->Area) : NULL;
        $this->KodeNamaAreaCabang = $this->KodeAreaCabang . " - " . $this->NamaAreaCabang;
    }

}
