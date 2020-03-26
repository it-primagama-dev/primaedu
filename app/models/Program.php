<?php

class Program extends \Phalcon\Mvc\Model
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
    public $TipeProgram;

    /**
     *
     * @var string
     */
    public $NamaProgram;

    /**
     *
     * @var integer
     */
    public $Jenjang;

    public function initialize() {
        $this->hasMany('RecID', 'Programdetail', 'Program');
        $this->hasMany('RecID', 'Programharga', 'Program');
        $this->hasMany('RecID', 'Pembayaran', 'Program');
        $this->belongsTo('TipeProgram', 'Programtipe', 'KodeTipeProgram');
        $this->belongsTo('Jenjang', 'Jenjang', 'KodeJenjang');
        $this->skipAttributesOnCreate(array('RecID'));
    }
    public function getTipeProgram() {
        return Programtipe::findFirst($this->TipeProgram)->NamaTipeProgram;
    }
    public function getJenjang() {
        return Jenjang::findFirst($this->Jenjang)->NamaJenjang;
    }
    public function getHargaPendaftaran() {
        $harga = Programharga::findFirstByProgram($this->RecID);
        return $harga === FALSE ? 0 : $harga->HargaPendaftaran;
    }
    public function getHargaBimbingan() {
        $harga = Programharga::findFirstByProgram($this->RecID);
        return $harga === FALSE ? 0 : $harga->HargaBimbingan;
    }
    public function getHargaTotal() {
        $harga = Programharga::findFirstByProgram($this->RecID);
        return $harga === FALSE ? 0 : $harga->HargaBimbingan + $harga->HargaPendaftaran;
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecID' => 'RecID', 
            'TipeProgram' => 'TipeProgram', 
            'NamaProgram' => 'NamaProgram', 
            'Jenjang' => 'Jenjang',
			'tahunajaran'=>'tahunajaran'
        );
    }

}
