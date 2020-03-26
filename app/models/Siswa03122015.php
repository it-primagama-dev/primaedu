<?php

class Siswa extends \Phalcon\Mvc\Model
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
    public $NamaSiswa;

    /**
     *
     * @var string
     */
    public $TempatLahir;

    /**
     *
     * @var string
     */
    public $TanggalLahir;

    /**
     *
     * @var string
     */
    public $Agama;

    /**
     *
     * @var string
     */
    public $AsalSekolah;

    /**
     *
     * @var integer
     */
    public $Jenjang;

    /**
     *
     * @var string
     */
    public $JenisKelamin;

    /**
     *
     * @var string
     */
    public $TeleponSiswa;

    /**
     *
     * @var string
     */
    public $EmailSiswa;

    /**
     *
     * @var string
     */
    public $AlamatSiswa;

    /**
     *
     * @var integer
     */
    public $PropinsiSiswa;

    /**
     *
     * @var integer
     */
    public $KotaSiswa;

    /**
     *
     * @var integer
     */
    public $KodeposSiswa;

    /**
     *
     * @var string
     */
    public $NamaAyah;

    /**
     *
     * @var string
     */
    public $TeleponAyah;

    /**
     *
     * @var string
     */
    public $PekerjaanAyah;

    /**
     *
     * @var string
     */
    public $EmailAyah;

    /**
     *
     * @var string
     */
    public $NamaIbu;

    /**
     *
     * @var string
     */
    public $TeleponIbu;

    /**
     *
     * @var string
     */
    public $PekerjaanIbu;

    /**
     *
     * @var string
     */
    public $EmailIbu;

    /**
     *
     * @var string
     */
    public $Alamat;

    /**
     *
     * @var integer
     */
    public $Kota;

    /**
     *
     * @var integer
     */
    public $Propinsi;

    /**
     *
     * @var integer
     */
    public $KodePos;

    /**
     *
     * @var integer
     */
    public $BukuSiswa;

    /**
     *
     * @var integer
     */
    public $Cabang;

    /**
     *
     * @var string
     */
    public $VirtualAccount;

    /**
     *
     * @var string
     */
    public $NoKartuSiswa;

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
    public function initialize() {
        $this->skipAttributesOnCreate(array('RecID'));
        $this->belongsTo('Cabang', 'Areacabang', 'RecID');
    }
    public function getJenjang() {
        $jenjang = Jenjang::findFirstByKodeJenjang($this->Jenjang);
        return $jenjang !== FALSE ? $jenjang->NamaJenjang : "";
    }
    public function getJenisKelamin() {
        switch ($this->JenisKelamin) {
            case "L":
                return "Laki laki";
            case "P":
                return "Perempuan";
            default :
                return "";
        }
    }

    public function getNamaCabang($kode = FALSE) {
        $cabang = Areacabang::findFirstByRecID($this->Cabang);
        return $cabang === FALSE ? : ($kode ? $cabang->KodeAreaCabang." - ".$cabang->NamaAreaCabang : $cabang->NamaAreaCabang);
    }
    public function getNamaArea($kode = FALSE) {
        $area = Areacabang::query()
                ->columns(["area.KodeAreaCabang AS KodeArea", "area.NamaAreaCabang AS NamaArea"])
                ->join("Areacabang", "Areacabang.Area = area.KodeAreaCabang", "area")
                ->where("Areacabang.RecID = ?0")
                ->bind([0 => $this->Cabang])
                ->execute()->getFirst();
        return $area === FALSE ? "" : ($kode ? $area->KodeArea." - ".$area->NamaArea : $area->NamaArea);
    }
    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecID' => 'RecID', 
            'NamaSiswa' => 'NamaSiswa', 
            'TempatLahir' => 'TempatLahir', 
            'TanggalLahir' => 'TanggalLahir', 
            'Agama' => 'Agama', 
            'AsalSekolah' => 'AsalSekolah', 
            'Jenjang' => 'Jenjang', 
            'JenisKelamin' => 'JenisKelamin', 
            'TeleponSiswa' => 'TeleponSiswa', 
            'EmailSiswa' => 'EmailSiswa', 
            'AlamatSiswa' => 'AlamatSiswa', 
            'PropinsiSiswa' => 'PropinsiSiswa', 
            'KotaSiswa' => 'KotaSiswa', 
            'KodeposSiswa' => 'KodeposSiswa', 
            'NamaAyah' => 'NamaAyah', 
            'TeleponAyah' => 'TeleponAyah', 
            'PekerjaanAyah' => 'PekerjaanAyah', 
            'EmailAyah' => 'EmailAyah', 
            'NamaIbu' => 'NamaIbu', 
            'TeleponIbu' => 'TeleponIbu', 
            'PekerjaanIbu' => 'PekerjaanIbu', 
            'EmailIbu' => 'EmailIbu', 
            'Alamat' => 'Alamat', 
            'Kota' => 'Kota', 
            'Propinsi' => 'Propinsi', 
            'KodePos' => 'KodePos', 
            'BukuSiswa' => 'BukuSiswa', 
            'Cabang' => 'Cabang', 
            'VirtualAccount' => 'VirtualAccount', 
            'NoKartuSiswa' => 'NoKartuSiswa', 
            'CreatedAt' => 'CreatedAt', 
            'CreatedBy' => 'CreatedBy'
        );
    }

}
