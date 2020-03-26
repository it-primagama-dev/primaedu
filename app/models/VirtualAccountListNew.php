<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VirtualAccountListNew
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
class VirtualAccountListNew extends \Phalcon\Mvc\Model {
    
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
     * @var string
     */
    public $KodeSiswa;

    /**
     *
     * @var integer
     */
    public $IsUsed;
    
    /**
     *
     * @var integer
     */
    public $TahunAjaran;

    /**
     *
     * @var integer
     */
    public $Create_at;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecID' => 'RecID', 
            'KodeCabang' => 'KodeCabang', 
            'KodeSiswa' => 'KodeSiswa', 
            'IsUsed' => 'IsUsed',
            'TahunAjaran' => 'TahunAjaran',
            'Create_at' => 'Create_at'
        );
    }
    
    public function getSource()
    {
        return "VirtualAccountListNew";
    }
}
