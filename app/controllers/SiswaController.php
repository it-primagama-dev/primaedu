<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class SiswaController extends ControllerBase
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
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
        $this->view->nogroup = $this->auth['areaparent'] ? TRUE : FALSE;
        $this->view->admin = $this->auth['areacabang'] ? FALSE : TRUE;
        $this->view->leveluser = $this->auth['usergroup'];
    }

    /**
     * Edits a siswa
     *
     * @param string $RecID
     */
    public function editAction($RecID)
    {

        if (!$this->request->isPost()) {

            $siswa = Siswa::findFirstByRecID($RecID);
            if (!$siswa) {
                $this->flash->error("Data siswa tidak dapat ditemukan");
                return $this->forward('siswa/index');
            }
			
		
			$this->view->cabang=$this->auth['areacabang'];
            $this->view->RecID = $siswa->RecID;
            $this->view->jenjang = Jenjang::find();
            $this->view->propinsi = Propinsi::find();
			$this->view->kota = Kotakab::find();       
            $this->tag->setDefault("RecID", $siswa->RecID);
            $this->tag->setDefault("NoKartuSiswa", $siswa->NoKartuSiswa);
            $this->tag->setDefault("NamaSiswa", $siswa->NamaSiswa);
            $this->tag->setDefault("TempatLahir", $siswa->TempatLahir);
            $this->tag->setDefault("TanggalLahir", $siswa->TanggalLahir);
            $this->tag->setDefault("Agama", $siswa->Agama);
			$this->tag->setDefault("MD", $siswa->MD);
			$this->tag->setDefault("status", $siswa->status);
            $this->tag->setDefault("AsalSekolah", $siswa->AsalSekolah);
            $this->tag->setDefault("Jenjang", $siswa->Jenjang);
            $this->tag->setDefault("JenisKelamin", $siswa->JenisKelamin);
            $this->tag->setDefault("TeleponSiswa", $siswa->TeleponSiswa);
            $this->tag->setDefault("EmailSiswa", $siswa->EmailSiswa);
            $this->tag->setDefault("NamaAyah", $siswa->NamaAyah);
            $this->tag->setDefault("EmailAyah", $siswa->EmailAyah);
            $this->tag->setDefault("TeleponAyah", $siswa->TeleponAyah);
            $this->tag->setDefault("PekerjaanAyah", $siswa->PekerjaanAyah);
            $this->tag->setDefault("NamaIbu", $siswa->NamaIbu);
            $this->tag->setDefault("EmailIbu", $siswa->EmailIbu);
            $this->tag->setDefault("TeleponIbu", $siswa->TeleponIbu);
            $this->tag->setDefault("PekerjaanIbu", $siswa->PekerjaanIbu);
            $this->tag->setDefault("Alamat", $siswa->Alamat);
            $this->tag->setDefault("Kota", $siswa->Kota);
            $this->tag->setDefault("Propinsi", $siswa->Propinsi);
            $this->tag->setDefault("KodePos", $siswa->KodePos);
            $this->tag->setDefault("Aktivasi", $siswa->Aktivasi);
            
        }
        
            $this->view->leveluser = $this->auth['usergroup'];
    }

    /**
     * Saves a siswa edited
     *
     */

  /**
     * Views a siswa
     *
     * @param string $RecID
     */
    public function viewAction($RecID)
    {

        if (!$this->request->isPost()) {

            $siswa = Siswa::findFirstByRecID($RecID);
            if (!$siswa) {
                $this->flash->error("Data siswa tidak dapat ditemukan");
                return $this->forward('siswa/index');
            }

            $this->view->RecID = $siswa->RecID;
            $this->view->jenjang = Jenjang::find();
            $this->view->propinsi = Propinsi::find();
     $this->view->kota = Kotakab::find();       
            $this->tag->setDefault("RecID", $siswa->RecID);
            $this->tag->setDefault("NoKartuSiswa", $siswa->NoKartuSiswa);
            $this->tag->setDefault("NamaSiswa", $siswa->NamaSiswa);
            $this->tag->setDefault("TempatLahir", $siswa->TempatLahir);
            $this->tag->setDefault("TanggalLahir", $siswa->TanggalLahir);
            $this->tag->setDefault("Agama", $siswa->Agama);
            $this->tag->setDefault("AsalSekolah", $siswa->AsalSekolah);
            $this->tag->setDefault("Jenjang", $siswa->Jenjang);
            $this->tag->setDefault("JenisKelamin", $siswa->JenisKelamin);
            $this->tag->setDefault("TeleponSiswa", $siswa->TeleponSiswa);
            $this->tag->setDefault("EmailSiswa", $siswa->EmailSiswa);
            $this->tag->setDefault("NamaAyah", $siswa->NamaAyah);
            $this->tag->setDefault("EmailAyah", $siswa->EmailAyah);
            $this->tag->setDefault("TeleponAyah", $siswa->TeleponAyah);
            $this->tag->setDefault("PekerjaanAyah", $siswa->PekerjaanAyah);
            $this->tag->setDefault("NamaIbu", $siswa->NamaIbu);
            $this->tag->setDefault("EmailIbu", $siswa->EmailIbu);
            $this->tag->setDefault("TeleponIbu", $siswa->TeleponIbu);
            $this->tag->setDefault("PekerjaanIbu", $siswa->PekerjaanIbu);
            $this->tag->setDefault("Alamat", $siswa->Alamat);
            $this->tag->setDefault("Kota", $siswa->Kota);
            $this->tag->setDefault("Propinsi", $siswa->Propinsi);
            $this->tag->setDefault("KodePos", $siswa->KodePos);
            $this->tag->setDefault("MD", $siswa->MD);
            $this->tag->setDefault("status", $siswa->status);
            
        }

            $this->view->leveluser = $this->auth['usergroup'];
    }
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "siswa",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $siswa = Siswa::findFirstByRecID($RecID);
        if (!$siswa) {
            $this->flash->error("siswa does not exist " . $RecID);

            return $this->dispatcher->forward(array(
                "controller" => "siswa",
                "action" => "index"
            ));
        }

        $siswa->NamaSiswa = $this->request->getPost("NamaSiswa");
        $siswa->TempatLahir = $this->request->getPost("TempatLahir");
        $siswa->TanggalLahir = $this->request->getPost("TanggalLahir");
        $siswa->Agama = $this->request->getPost("Agama");
        $siswa->AsalSekolah = $this->request->getPost("AsalSekolah");
        $siswa->Jenjang = $this->request->getPost("Jenjang");
        $siswa->JenisKelamin = $this->request->getPost("JenisKelamin");
        $siswa->TeleponSiswa = $this->request->getPost("TeleponSiswa");
        $siswa->EmailSiswa = $this->request->getPost("EmailSiswa");
        $siswa->NamaAyah = $this->request->getPost("NamaAyah");
		$siswa->MD = $this->request->getPost("MD");
		$siswa->status = $this->request->getPost("status");
        $siswa->EmailAyah = $this->request->getPost("EmailAyah");
        $siswa->TeleponAyah = $this->request->getPost("TeleponAyah");
        $siswa->PekerjaanAyah = $this->request->getPost("PekerjaanAyah");
        $siswa->NamaIbu = $this->request->getPost("NamaIbu");
        $siswa->EmailIbu = $this->request->getPost("EmailIbu");
        $siswa->TeleponIbu = $this->request->getPost("TeleponIbu");
        $siswa->PekerjaanIbu = $this->request->getPost("PekerjaanIbu");
        $siswa->Alamat = $this->request->getPost("Alamat");
        $siswa->Kota = $this->request->getPost("Kota");
        $siswa->Propinsi = $this->request->getPost("Propinsi");
        $siswa->KodePos = $this->request->getPost("KodePos");
        $siswa->NoKartuSiswa = $this->request->getPost("NoKartuSiswa");
        $siswa->Aktivasi = $this->request->getPost("Aktivasi");

        if (!$siswa->save()) {

            foreach ($siswa->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "siswa",
                "action" => "edit",
                "params" => array($siswa->RecID)
            ));
        }

        $this->flash->success("siswa was updated successfully");
		
		   return $this->forward('siswa/index');

    }

    /**
     * Deletes a siswa
     *
     * @param string $RecID
     */
    public function deleteAction($RecID)
    {
        if ($this->auth['areacabang']) {
            return $this->forward('siswa/index');
        }

        $siswa = Siswa::findFirstByRecID($RecID);
        if (!$siswa) {
            $this->flash->error("Data siswa tidak dapat ditemukan");
            return $this->forward('siswa/index');
        }

        $va = Virtualaccountlistnew::findFirst([
            "KodeCabang = ?0 AND KodeSiswa = ?1",
            "bind" => [0 => trim($siswa->Areacabang->KodeAreaCabang), 1 => $siswa->VirtualAccount]
        ]);
        if (!$va) {
            $this->flash->error("Data siswa tidak dapat ditemukan.");
            return $this->forward('siswa/index');
        }
        // Begin Transaction
        $this->db->begin();

        $va->IsUsed = 0;
        if (!$siswa->delete() || !$va->save()) {
            foreach ($siswa->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->db->rollback();
            return $this->forward('siswa/search');
        }

        //Commit Transaction on success
        $this->db->commit();
        $this->flash->success("Data siswa berhasil dihapus");
        return $this->forward('siswa/index');
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
