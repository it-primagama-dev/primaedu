<?php

//use Phalcon\Mvc\Controller;

class PartitionedBase extends ControllerBase {

    protected $auth;

    protected function initialize() {
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
    }

    public function _getParmCabang($areaid = null, $cabangid = null) {
        $parm = [];
        if (is_null($areaid)) {
            $areaid = $this->_validateArea();
        }
        if (is_null($cabangid)) {
            $cabangid = $this->_validateCabang();
        }
        $where = $this->_getCriteria($areaid, $cabangid);
        if ($where === NULL) {
            return FALSE;
        }
        $cabang = Areacabang::query()
                ->columns('c.RecID')
                ->join('Areacabang', 'Areacabang.KodeAreaCabang = c.Area', 'c')
                ->where($where)->execute();
        foreach ($cabang as $rec) {
            $parm[] = $rec->RecID;
        }
        return $parm;
    }

    public function _validateArea($areaid = NULL) {
        if ($this->auth['areaparent']) {
            return $this->auth['areaparent'];
        } else if ($this->auth['areacabang']) {
            return $this->auth['areacabang'];
        } else {
            return $areaid ? : NULL;
        }
    }

    public function _validateCabang($cabangid = NULL) {
        if ($this->auth['areaparent']) {
            return $this->auth['areacabang'];
        } else {
            return $cabangid ? : NULL;
        }
    }

    private function _getCriteria($areaid, $cabangid) {
        $temp = "";
        if ($areaid){
            $temp .= "Areacabang.RecID = ".$areaid;
        }
        if ($cabangid){
            $temp .= $areaid ? " AND " : "";
            $temp .= "c.RecID = ".$cabangid;
        }
        return $temp == "" ? NULL : $temp;
    }
}
