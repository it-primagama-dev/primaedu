<?php

class Pengeluaranbiaya extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $RecId;

    /**
     *
     * @var integer
     */
    public $Cabang;

    /**
     *
     * @var integer
     */
    public $Pengeluaran;

    /**
     *
     * @var integer
     */
    public $BiayaGroup;

    /**
     *
     * @var string
     */
    public $Description;

    /**
     *
     * @var string
     */
    public $Tanggal;

    /**
     *
     * @var string
     */
    public $Jumlah;

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
    public $TahunAjaran;
	
    public function getGrupPengeluaran() {
        $gr = Pengeluaranbiayagroup::findFirst($this->BiayaGroup);
        return $gr !== FALSE ? $gr->NamaBiayaGroup : "";
    }

    public function getTipePengeluaran() {
        return Pengeluarantipe::findFirst($this->Pengeluaran)->Description;
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecId' => 'RecId', 
            'Cabang' => 'Cabang', 
            'Pengeluaran' => 'Pengeluaran', 
            'BiayaGroup' => 'BiayaGroup', 
            'Description' => 'Description', 
            'Tanggal' => 'Tanggal', 
            'Jumlah' => 'Jumlah', 
            'CreatedBy' => 'CreatedBy', 
            'CreatedDateTime' => 'CreatedDateTime',
            'TahunAjaran' => 'TahunAjaran'
        );
    }

}
