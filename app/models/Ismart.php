<?php

class Ismart extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $RecID;

    /**
     *
     * @var string
     */
    public $KodeISmart;

    /**
     *
     * @var string
     */
    public $NamaISmart;

    /**
     *
     * @var string
     */
    public $Grade;

    /**
     *
     * @var string
     */
    public $JenisKelamin;

    /**
     *
     * @var string
     */
    public $TipeISmart;

    /**
     *
     * @var string
     */
    public $TanggalLahir;

    /**
     *
     * @var string
     */
    public $TanggalGabung;

    /**
     *
     * @var string
     */
    public $Telepon;

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
     * @var string
     */
    public $Pekerjaan;

    /**
     *
     * @var string
     */
    public $Email;

    /**
     *
     * @var string
     */
    public $BidangStudi;

    /**
     *
     * @var string
     */
    public $BidangStudi2;

    public function initialize() {
        $this->skipAttributesOnCreate(array('RecID'));
    }

    public function beforeValidationOnCreate() {
        $recid = $this->maximum(["column" => "RecID"]);
        $ismart = $this->findFirst($recid);
        $exOld = explode("-",$ismart->KodeISmart);
        $exNew = explode(".",$ismart->KodeISmart);
        $numOld = isset($exOld[1]) ? $exOld[1] : NULL;
        $numNew = isset($exNew[2]) ? $exNew[2] : NULL;
        if ($numOld) {
            $this->KodeISmart = $this->BidangStudi . '.' . explode("-", $this->TanggalGabung)[0] . '.' . sprintf("%05d", (int) $numOld + 1);
        } else {
            $this->KodeISmart = $this->BidangStudi . '.' . explode("-", $this->TanggalGabung)[0] . '.' . sprintf("%05d", (int) $numNew + 1);
        }
    }

    public function getNamaCabang() {
        return Areacabang::findFirst($this->Cabang)->NamaAreaCabang;
    }

}
