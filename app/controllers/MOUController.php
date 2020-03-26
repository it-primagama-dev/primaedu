<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MOUController extends ControllerBase
{
    protected $auth;

    public function initialize() {
        $this->tag->setTitle("MOU");
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Input MOU Franchise Fee';
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
	
    /**
     * Searches for program
     */
    public function searchAction()
    {
		$areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang')); 

		$sql1 = "select top 1 a.RecID, REPLACE (areacabang.KodeAreaCabang, ' ', '' ) as KodeAreaCabang,
            areacabang.NamaAreaCabang, pembayaranfranchisee.NilaiFranchisee,pembayaranfranchisee.Pembayaran,
            pembayaranfranchisee.TglMou,pembayaranfranchisee.NoMOU, pembayaranfranchisee.keterangan ,areacabang.TanggalBerlaku,FranchiseFeeId,
            day(areacabang.TanggalBerlaku) as hariBerlaku, month(areacabang.TanggalBerlaku) as bulanBerlaku, 
            pembayaranfranchisee.TahunMulai as tahunBerlaku, areacabang.TanggalBerakhir,
            day(areacabang.TanggalBerakhir) as hariBerakhir, month(areacabang.TanggalBerakhir) as bulanBerakhir,
            year(areacabang.TanggalBerakhir) as tahunBerakhir,
            pembayaranfranchisee.NilaiFranchisee * 10/100 as Ppn, 
            pembayaranfranchisee.NilaiFranchisee + (pembayaranfranchisee.NilaiFranchisee * 10/100) as Total,
            (select SUM(konfirmasipembayaran2.nominal) from konfirmasipembayaran2 where konfirmasipembayaran2.Status = 'Approved') as Bayar, 
            (select count(pembayaranfranchisee.kodecabang)from pembayaranfranchisee where pembayaranfranchisee.KodeCabang = areacabang.KodeAreaCabang) as FFID
            from pembayaranfranchisee
            right join areacabang on pembayaranfranchisee.KodeCabang = areacabang.KodeAreaCabang
            left join areacabang b on pembayaranfranchisee.KodeCabang = b.KodeAreaCabang
            join areacabang a on areacabang.Area = a.KodeAreaCabang
            --join konfirmasipembayaran2 on areacabang.RecID =konfirmasipembayaran2.Cabang
            WHERE areacabang.RecID= '$cabangid' order by FranchiseFeeId desc";
        
		
		$query1 = $this->getDI()->getShared('db')->query($sql1);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$this->view->result1 = $query1->fetchAll($query1);

		

		
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $this->view->programtipe = Programtipe::find();
        $this->view->jenjang = Jenjang::find();
		$this->view->tahunajaran = Tahunajaran::find();
    }

    /**
     * Edits a program
     *
     * @param string $RecID
     */
    public function editAction($RecID)
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
     * Creates a new program
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "program",
                "action" => "index"
            ));
        }
		
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));

        $pembayaranfranchisee = new Pembayaranfranchisee();
		
        $pembayaranfranchisee->KodeCabang = $this->request->getPost("KodeAreaCabang");
        $pembayaranfranchisee->NilaiFranchisee = $this->request->getPost("NilaiFranchisee");
        $pembayaranfranchisee->TglMOU= $this->request->getPost("TglMOU");
		$pembayaranfranchisee->TahunMulai = $this->request->getPost("tahunBerlaku");
		$pembayaranfranchisee->TahunBerakhir = $this->request->getPost("tahunBerakhir");
		$pembayaranfranchisee->Total = $this->request->getPost("total");
		
        if (!$program->save()) {
            foreach ($program->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "program",
                "action" => "new"
            ));
        }

        $update = "update areacabang set TanggalBerlaku = '$berlaku2', TanggalBerakhir = '$berakhir2' where KodeAreaCabang = '$kodeAreaCabang'";
        
        $query1 = $this->getDI()->getShared('db')->query($update);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->flash->success("program was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "program",
            "action" => "index"
        ));

    }

    /**
     * Saves a program edited
     *
     */
    public function saveAction()
    {
		if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "MOU",
                "action" => "search"
            ));
        }
		
		$kodeAreaCabang =  $this->request->getPost('kodeAreaCabang');
		$kodeAreaCabangtrim = trim($kodeAreaCabang); 
		$TglMou =  $this->request->getPost('TglMou');
		$NoMOU = $this->request->getPost('NoMOU');
        $FFID = $this->request->getPost('FFID');
        $tFFID = str_replace(' ', '', $FFID);
		
		
        $insert = "update pembayaranfranchisee set TglMOU = '$TglMou',NoMOU = '$NoMOU' where FranchiseFeeId = '$tFFID' ";
        echo $insert;
        $query = $this->getDI()->getShared('db')->query($insert);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        
	
		$this->flash->success("No MOU sudah diinputkan");

        return $this->dispatcher->forward(array(
            "controller" => "MOU",
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
