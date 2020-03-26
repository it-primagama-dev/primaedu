<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CabanginputController extends ControllerBase
{
    protected $auth;

   public function initialize() {
        $this->tag->setTitle("Pembayaranfranchisee");
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
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('AreaID', $this->auth['areacabang']);
        $this->view->auth = $this->auth;
    }
	
	public function cabangAction()
	{
		
	}

    /**
     * Displays the creation form
     */
    public function newAction()
    {
		if (!$this->request->isPost()) {
            return $this->forward('cabanginput/index');
        }
		 $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));
		
		$tahun = "select areacabang.KodeAreaCabang from areacabang where RecID = '$cabangid' ";
		$query1 = $this->getDI()->getShared('db')->query($tahun); 
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$this->view->result1 = $query1->fetchAll($query1);
		
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : '-';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : '-';

        $sql= "select KodeCabang,NamaFSEE, Telepon, AlamatSurat, Ismart,TelpIsmart ,PAC, telpPAC, NoKTP, AlamatKTP, NPWP, SIUP, TDP, Direktur, DataKTP, KepalaCabang, AlamatKpCb from DataCabang
            join areacabang on DataCabang.KodeCabang = areacabang.KodeAreaCabang
         where KodeCabang = '$cabangid' ";
        $query2 = $this->getDI()->getShared('db')->query($sql); 
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result2 = $query2->fetchAll($query2);
    }

    /**
     * Edits a program
     *
     * @param string $RecID
     */
    public function badanusahaAction($RecID)
    {

        if (!$this->request->isPost()) {

            $program = Program::findFirstByRecID($RecID);
            if (!$program) {
                $this->flash->error("program was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "program",
                    "action" => "index"
                ));
            }

            $this->view->RecID = $program->RecID;
            $this->view->programtipe = Programtipe::find();
            $this->view->jenjang = Jenjang::find();

            $this->tag->setDefault("RecID", $program->RecID);
            $this->tag->setDefault("TipeProgram", $program->TipeProgram);
            $this->tag->setDefault("NamaProgram", $program->NamaProgram);
            $this->tag->setDefault("Jenjang", $program->Jenjang);
            $this->tag->setDefault("dataTableUrl", $this->url->get("program/details/{$program->RecID}"));
            
        }
    }

    
    /**
     * Saves a program edited
     *
     */
    public function saveAction()
    {
		if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "Cabanginput",
                "action" => "index"
            ));
        }
		
		$areaid = $this->_validateArea($this->request->getPost('Area'));
        $recID = $this->request->getPost('recID');
		$NamaFSEE =  $this->request->getPost('NamaFSEE');
        $rab = $this->request->getPost('rab');
		$AlamatSurat =  $this->request->getPost('AlamatSurat');
		$BadanUsaha =  $this->request->getPost('BadanUsaha');
		$Direktur =  $this->request->getPost('Direktur');
		$SIUP = $this->request->getPost('SIUP');
		$NPWP = $this->request->getPost('NPWP');
		$TDP = $this->request->getPost('TDP');
        $NoKTP = $this->request->getPost('NoKTP');
		$DataKTP = $this->request->getPost('DataKTP');
		$Telp = $this->request->getPost('Telp');
		$KepalaCabang = $this->request->getPost('KepalaCabang');
		$AlamatKpCb = $this->request->getPost('AlamatKpCb');
		$SDM = $this->request->getPost('SDM');
        $PAC = $this->request->getPost('PAC');
		$TelKpCb = $this->request->getPost('TelpKpCb');
        $Ismart = $this->request->getPost('ismart');
        $TelpIsmart = $this->request->getPost('TelpIsmart');
        $telpPAC = $this->request->getPost('telpPAC');
        $rad = $this->request->getPost('rad');
        $rac = $this->request->getPost('rac');
        $yanglain1 = $this->request->getPost('yanglain1');
        $sewa = $this->request->getPost('sewa');
        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        $YBentuk = $this->request->getPost('akhir');

		$insert = "insert into DataCabang (KodeCabang, NamaFSEE,Telepon, AlamatSurat,Ismart,TelpIsmart, PAC,telpPAC,NoKTP, AlamatKTP, Status ,Statuskepemilikan, Direktur, DataKTP, SIUP, NPWP, TDP, KepalaCabang, AlamatKpCb, YStatuskepemilikan, Sewa, Awalsewa, Akhirsewa, Bentuk, YBentuk) values
		('$recID', '$NamaFSEE','$Telp', '$AlamatSurat','$Ismart','$TelpIsmart','$PAC','$telpPAC','$NoKTP','$AlamatKTP','$rad' ,'$rab', '$Direktur', '$DataKTP', '$SIUP', '$NPWP', '$TDP', '$KepalaCabang', '$AlamatKpCb', '$yanglain1', '$sewa', '$awal', '$akhir','$rac','$YBentuk')";
		echo $insert;
		$query = $this->getDI()->getShared('db')->query($insert);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
		
		
		$this->flash->success("Data Cabang Sudah Terinput");
		
        return $this->dispatcher->forward(array(
            "controller" => "Cabanginput",
            "action" => "index"
        ));
    }

    /**
     * Deletes a program
     *
     * @param string $RecID
     */
     private function _getCriteria($areaid, $cabangid) {
        $temp = "WHERE status = 'APPROVED'";
        if ($areaid){
            $temp .= "AND area.RecID = ".$areaid;
        }
        if ($cabangid){
            $temp .= $areaid ? " AND " : "";
            $temp .= "b.RecID = ".$cabangid;
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

?>