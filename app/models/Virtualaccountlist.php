<?php

class Virtualaccountlist extends \Phalcon\Mvc\Model
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
            'Create_at' => 'Create_at'
        );
    }

}
