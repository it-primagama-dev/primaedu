<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PembayaranfranchiseeditController extends ControllerBase
{
    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Pembayaranfranchise");
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
		$this->view->rpt_title = 'Edit Data Pembayaran franchise';
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
		
			 $sql1 = "
select top 1 a.RecID, areacabang.KodeAreaCabang,
            areacabang.NamaAreaCabang, pembayaranfranchisee.NilaiFranchisee,pembayaranfranchisee.Pembayaran,
            pembayaranfranchisee.TglMou, pembayaranfranchisee.keterangan,pembayaranfranchisee.Diskon ,areacabang.TanggalBerlaku,FranchiseFeeId,
            day(areacabang.TanggalBerlaku) as hariBerlaku, month(areacabang.TanggalBerlaku) as bulanBerlaku, 
            pembayaranfranchisee.TahunMulai as tahunBerlaku, areacabang.TanggalBerakhir,
            day(areacabang.TanggalBerakhir) as hariBerakhir, month(areacabang.TanggalBerakhir) as bulanBerakhir,
            year(areacabang.TanggalBerakhir) as tahunBerakhir,
            Pembayaranfranchisee.NilaiFranchisee - pembayaranfranchisee.Diskon * 10/100 as Ppn, 
            pembayaranfranchisee.Total as Total,
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
                "controller" => "pembayaranfranchiseedit",
                "action" => "search"
            ));
        }
		
		$kodeAreaCabang =  $this->request->getPost('kodeAreaCabang');
		$NilaiFranchisee =  $this->request->getPost('NilaiFranchisee');
		$tahunBerakhir =  $this->request->getPost('tahunBerakhir');
		$tahunBerlaku =  $this->request->getPost('tahunBerlaku');
		$TglMou =  $this->request->getPost('TglMou');
		$Total =  $this->request->getPost('Total');
		$Keterangan = $this->request->getPost('Keterangan');
		$FFID = $this->request->getPost('FFID');
		$tFFID = str_replace(' ', '', $FFID);
		$Diskon = $this->request->getPost('Diskon');
		$TanggalBerlaku = $this->request->getPost('hariBerlaku');
		$bulanBerlaku = $this->request->getPost('bulanBerlaku');
		$berlaku =  $TanggalBerlaku . '-' . $bulanBerlaku . '-' . $tahunBerlaku;
		$berlaku1 = strtotime($berlaku);
		$berlaku2 = date ('Y-m-d',$berlaku1);
		$TanggalBerakhir =$this->request->getPost('hariBerakhir');
		$bulanBerakhir = $this->request->getPost('bulanBerakhir');
		$berakhir =  $TanggalBerakhir . '-' . $bulanBerakhir . '-' . $tahunBerakhir;
		$berakhir1 = strtotime($berakhir);
		$berakhir2 = date ('Y-m-d',$berakhir1);
		$CreatedAt = date("Y-m-d H:i:s");

         $insert = "update pembayaranfranchisee set TglMOU = '$TglMou', TahunMulai = '$tahunBerlaku', NilaiFranchisee = '$NilaiFranchisee',
        Total = '$Total',AkhirKontrak= '$berakhir2',TahunAkhir = '$tahunBerakhir', Keterangan = '$Keterangan', Diskon = '$Diskon', AwalKontrak = '$berlaku2' where FranchiseFeeId = '$tFFID' ";
        
        echo $insert;
        $query = $this->getDI()->getShared('db')->query($insert);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        
        
        $update = "update areacabang set TanggalBerlaku = '$berlaku2', TanggalBerakhir = '$berakhir2' where KodeAreaCabang = '$kodeAreaCabang'";
        
        $query1 = $this->getDI()->getShared('db')->query($update);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$this->flash->success("Franchise sudah berhasil dirubah");

        return $this->dispatcher->forward(array(
            "controller" => "pembayaranfranchiseedit",
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
