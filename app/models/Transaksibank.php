<?php

use \Phalcon\Mvc\Model\Message;

class Transaksibank extends \Phalcon\Mvc\Model {

    /**
     *
     * @var integer
     */
    public $RecID;

    /**
     *
     * @var string
     */
    public $KodeCabang;

    /**
     *
     * @var integer
     */
    public $Siswa;

    /**
     *
     * @var string
     */
    public $NamaBank;

    /**
     *
     * @var string
     */
    public $TanggalImport;

    /**
     *
     * @var string
     */
    public $TanggalTransaksi;

    /**
     *
     * @var string
     */
    public $WaktuTransaksi;

    /**
     *
     * @var string
     */
    public $NoReferensi;

    /**
     *
     * @var string
     */
    public $NoVA;
	
    /**
     *
     * @var string
     */
    public $Keterangan;

    /**
     *
     * @var integer
     */
    public $Nominal;

    /**
     *
     * @var integer
     */
    public $RefRecID;
	
	/**
     *
     * @var string
     */
    public $CardNo;
	
	/**
     *
     * @var string
     */
    public $Auth_cd;
	
	/**
     *
     * @var string
     */
    public $term_id;

	/**
     *
     * @var string
     */
    public $kdgrp;
	
	/**
     *
     * @var string
     */
    public $mercno;
	
	/**
     *
     * @var string
     */
    public $batch_ptlf;
	
	/**
     *
     * @var string
     */
	  public $tahunajaran;
	
	/**
     *
     * @var string
     */
	 
    public $seq;
	
	
	
    public function initialize() {
        $this->belongsTo("RefRecID", "pembayarandetail", "RecID");
        $this->belongsTo("Siswa", "Siswa", "RecID");
        $this->belongsTo("Cabang", "Siswa", "RecID");
        $this->skipAttributesOnCreate(array('RecID','RefRecID'));
    }

    public function getNominal() {
        return number_format($this->Nominal, 0, ',', '.');
    }

    public function beforeSave() {
        if ($this->TanggalImport == "" || $this->TanggalImport == null) {
            $message = new Message(
                    "Tanggal Import tidak boleh kosong", "", ""
            );
            $this->appendMessage($message);

            return false;
        }
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap() {
        return array(
            'RecID' => 'RecID',
            'KodeCabang' => 'KodeCabang',
            'Siswa' => 'Siswa',
            'NamaBank' => 'NamaBank',
            'TanggalImport' => 'TanggalImport',
            'TanggalTransaksi' => 'TanggalTransaksi',
            'WaktuTransaksi' => 'WaktuTransaksi',
            'NoReferensi' => 'NoReferensi',
            'NoVA' => 'NoVA',
            'Nominal' => 'Nominal',
            'CardNo' => 'CardNo',
            'Auth_Cd' => 'Auth_cd',
            'kdgrp' => 'kdgrp',
            'mercno' => 'mercno',
            'batch_ptlf' => 'batch_ptlf',
            'seq' => 'seq',
            'term_id' => 'term_id',
            'RefRecID' => 'RefRecID',
			'Keterangan' => 'Keterangan',
			'tahunajaran' => 'tahunajaran'
, 'gros_amt' => 'gros_amt'        );
    }
}