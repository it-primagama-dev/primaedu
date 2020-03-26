<?php

class Nosuratpernyataan extends \Phalcon\Mvc\Model {

    public $NoSurat;
    public $KodeCabang;
    public $TahunAjaran;

    public function columnMap() {
        return array(
            'NoSurat' => 'NoSurat',
            'KodeCabang' => 'KodeCabang',
            'TahunAjaran' => 'TahunAjaran'
        );
    }

}
