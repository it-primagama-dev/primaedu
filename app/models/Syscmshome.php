
<?php

class Syscmshome extends \Phalcon\Mvc\Model
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
    public $HeaderContent;

    /**
     *
     * @var string
     */
    public $PanelTitle;

    /**
     *
     * @var string
     */
    public $PanelContent;

    public function initialize() {
        $this->skipAttributesOnCreate(array('RecID'));
    }

}
