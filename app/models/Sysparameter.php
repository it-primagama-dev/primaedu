
<?php

class Sysparameter extends \Phalcon\Mvc\Model
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
    public $NamaBank;

    /**
     *
     * @var string
     */
    public $NoRekPusat;

    /**
     *
     * @var string
     */
    public $NamaRekPusat;

    /**
     *
     * @var string
     */
    public $NoRekOperasional;

    /**
     *
     * @var string
     */
    public $Prefix;

    /**
     *
     * @var string
     */
    public $KodePerusahaan;

    
    
    public function initialize() {
        $this->skipAttributesOnCreate(array('RecID'));
    }

}
