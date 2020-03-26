<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
 

class trackingfinanceController extends ControllerBase {


    

    public function initialize() {
        $this->tag->setTitle("Tracking");
        parent::initialize();
    
    }

   
    public function indexAction() {
	        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);

        $this->persistent->parameters = null;
    }

 
	   public function getcabangAction($area = 0) {
        $this->view->disable();
        $cabang = Areacabang::query()
                ->columns("c.*")
                ->join("Areacabang", "Areacabang.KodeAreaCabang = c.Area", "c")
                ->where("Areacabang.RecID = :area:")
                ->orderBy("c.KodeAreaCabang")
                ->bind(["area" => $this->filter->sanitize($area, "int")])
                ->execute();
        echo "<option value=\"\">---</option>";
        if (!count($cabang)) {
            return;
        }
        foreach ($cabang as $rec) {
            echo "<option value=\"" . $rec->RecID . "\">" . $rec->KodeNamaAreaCabang . "</option>";
        }
    }
	
	    private function _getCriteria($areaid, $cabangid) {
        $temp = "WHERE ";
        if ($areaid){
            $temp .= "a.RecID = ".$areaid;
        }
        if ($cabangid){
            $temp .= $areaid ? " AND " : "";
            $temp .= "c.RecID = ".$cabangid;
        }
        return $temp == "WHERE " ? "" : $temp;
    }

    private function _validateArea($areaid) {
        if ($this->auth['areaparent']) {
            return $this->auth['areaparent'];
        } else if ($this->auth['areacabang']) {
            return $this->auth['areacabang'];
        } else {
            return $areaid ? : NULL;
        }
    }

    private function _validateCabang($cabangid) {
        if ($this->auth['areaparent']) {
            return $this->auth['areacabang'];
        } else {
            return $cabangid ? : NULL;
        }
    }

	
	
	
	
	
	

}
