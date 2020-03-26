<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class RptdtsiswaController extends ControllerBase
{
    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Data Siswa");
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
        $this->view->jenjang = Jenjang::find();
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('AreaID', $this->auth['areacabang']);
        $this->view->auth = $this->auth;
    }

    /**
     * Searches for siswa
     */
    public function searchAction()
    {

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->rpt_title = 'Laporan Data Siswa';

        /*
         * Check Session
         * TODO - Filter by Area
         */
        $areaid = $this->_validateArea($this->request->getPost('AreaID', 'int'));
        $cabangid = $this->_validateCabang($this->request->getPost('CabangID', 'int'));

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Siswa", $_POST);
            $cabang = $this->_getParmCabang($areaid, $cabangid);
            // Filter Result for Cabang
            if($cabang !== FALSE) {
                $query->inWhere("Cabang", $cabang);
            }
            
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            //$parameters = array();
            //TOC-RB 10 Aug 2015
            $query = new Criteria();
            $cabang = $this->_getParmCabang($areaid, $cabangid);
            // Filter Result for Cabang
            if($cabang !== FALSE) {
                $query->inWhere("Cabang", $cabang);
            }
            $parameters = $query->getParams();
        }
        $parameters["order"] = "Cabang, VirtualAccount";

        $siswa = Siswa::find($parameters);
        if (count($siswa) == 0) {
            $this->flash->notice("The search did not find any siswa");

            return $this->dispatcher->forward(array(
                "controller" => "siswa",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $siswa,
            "limit"=> 999999,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
        $this->view->nogroup = $this->auth['areaparent'] ? TRUE : FALSE;
        $this->view->admin = $this->auth['areacabang'] ? FALSE : TRUE;
    }


    public function getcabangAction($area = 0) {
        $this->view->disable();
        if ($this->auth['areaparent']) {
            return;
        }
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

    private function _getParmCabang($areaid, $cabangid) {
        $parm = [];
        $where = $this->_getCriteria($areaid, $cabangid);
        if ($where === NULL) {
            return FALSE;
        }
        $cabang = Areacabang::query()
                ->columns('c.RecID')
                ->join('Areacabang', 'Areacabang.KodeAreaCabang = c.Area', 'c')
                ->where($where)
                ->execute();
        foreach ($cabang as $rec) {
            $parm[] = $rec->RecID;
        }
        return $parm;
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
