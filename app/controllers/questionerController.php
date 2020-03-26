<?php
set_time_limit(60);
class QuestionerController extends ControllerBase
{ 

    public function initialize() {
        $this->tag->setTitle('Laporan Angket');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        } 
        $this->view->rpt_title = 'Laporan Angket';
    }

    public function indexAction() {

        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('Area', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
        
        $this->view->tahun = Tahunajaran::find(); 
    
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

 public function viewAction() {


        if (!$this->request->isPost()) {
            return $this->forward('questioner/index');
        }

        $cabang = $this->request->getPost('Cabang');
        if ($cabang==''){
            $cabang = $this->auth['areacabang'];
        }
                
                
        $sql = "SELECT Kuesioner.pertanyaan, pilihanbobot.Bobot
                From JawabanBobot 
                Join areacabang a ON JawabanBobot.IdCabang = a.RecID
                join areacabang on a.Area = areacabang.KodeAreaCabang
                join PilihanBobot ON JawabanBobot.IdPilihan = PilihanBobot.IdPilihan
                join Kuesioner ON JawabanBobot.IdPertanyaan = Kuesioner.RecID
                where jawabanBobot.kuesionerke = '1' and a.RecID = '$cabang'";
    
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);


        $date = date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->request->getPost('Cabang');
        //$cabangidd = $this->_validateArea($this->request->getPost('Cabang'));

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->NamaAreaCabang : 'all';

    }

 public function viewareaAction() {


        if (!$this->request->isPost()) {
            return $this->forward('questioner/index');
        }

        $cabang = $this->request->getPost('Area');
        if ($cabang==''){
            $cabang = $this->auth['areacabang'];
        }
                
                
        $sql = "SELECT Kuesioner.pertanyaan, CAST(sum(PilihanBobot.Bobot) as DECIMAL(5,2))/CAST(count(a.KodeAreaCabang)  as DECIMAL(5,2)) as Bobot
                From JawabanBobot 
                Join areacabang a ON JawabanBobot.IdCabang = a.RecID
                join areacabang on a.Area = areacabang.KodeAreaCabang
                join PilihanBobot ON JawabanBobot.IdPilihan = PilihanBobot.IdPilihan
                join Kuesioner ON JawabanBobot.IdPertanyaan = Kuesioner.RecID
                where jawabanBobot.kuesionerke = '2' and areacabang.RecID = '$cabang'
                group by Kuesioner.pertanyaan";
    
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);

        $sql1 = "SELECT top 1 count(areacabang.NamaAreaCabang) as Responden from areacabang a
                    join areacabang on a.Area = areacabang.KodeAreaCabang
                    join Jawabanbobot b on a.RecID = b.IdCabang
                    where a.Aktif = '1' and areacabang.RecID = '$cabang' and KuesionerKe = '2'  and a.KodeAreaCabang != 9999
                    group by  b.IdPertanyaan ";
    
        $query1 = $this->getDI()->getShared('db')->query($sql1);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result1 = $query1->fetchAll($query1);

        $sql2 = "SELECT count(a.RecID) as TotalResponden from areacabang a
                join areacabang on a.Area = areacabang.KodeAreaCabang where a.Aktif = '1' and areacabang.RecID = '$cabang'";
    
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result2 = $query2->fetchAll($query2);

        $date = date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->request->getPost('Cabang');
        //$cabangidd = $this->_validateArea($this->request->getPost('Cabang'));

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->NamaAreaCabang : 'all';

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

