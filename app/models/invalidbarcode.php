<?php

use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class invalidbarcode extends \Phalcon\Mvc\Model
{


    /**
     *
     * @var Int
     */
    public $RecID;

    /**
     *
     * @var Int
     */
    public $Barcode;

        /**
     *
     * @var Int
     */
    public $Cabang;

        /**
     *
     * @var Int
     */
    public $CreatedByBarcode;


        /**
     *
     * @var Int
     */
    public $CreatedAtBarcode;


        /**
     *
     * @var Int
     */
    public $PurchReqId;


        /**
     *
     * @var Int
     */
    public $Status;

        /**
     *
     * @var Int
     */
    public $TypeUpload;


        /**
     *
     * @var Int
     */
    public $Keterangan;
        /**
     *
     * @var Int
     */
    public $Aksi;


        /**
     *
     * @var Int
     */
    public $BarcodePengganti;



        /**
     *
     * @var Int
     */
    public $CreatedAt;


        /**
     *
     * @var Int
     */
    public $CreatedBy;
}
