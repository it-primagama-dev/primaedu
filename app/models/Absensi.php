<?php

class Absensi extends \Phalcon\Mvc\Model
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
    public $KodeSiswa;

    /**
     *
     * @var string
     */
    public $AbsenDate;

    /**
     *
     * @var string
     */
    public $AbsenTime;

    /**
     *
     * @var integer
     */
    public $Cabang;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'RecId' => 'RecId', 
            'KodeSiswa' => 'KodeSiswa', 
            'AbsenDate' => 'AbsenDate', 
            'AbsenTime' => 'AbsenTime', 
            'Cabang' => 'Cabang'
        );
    }

}
