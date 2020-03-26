<?php
 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;

class Konfirmasipembayaran2Controller extends ControllerBase {
	
protected $sql = <<<SQL

select pembayaranfranchisee.Total,pembayaranfranchisee.Pembayaran, pembayaranfranchisee.KodeCabang, pembayaranfranchisee.Pembayaran, 
konfirmasipembayaran2.Cabang, areacabang.KodeAreaCabang, a.NamaAreaCabang, pembayaranfranchisee.NilaiFranchisee, 
pembayaranfranchisee.TglMou, areacabang.TanggalBerlaku, areacabang.TanggalBerakhir,
konfirmasipembayaran2.Nominal, konfirmasipembayaran2.CreatedDateTime, konfirmasipembayaran2.CreatedBy, 
konfirmasipembayaran2.ConfirmId, konfirmasipembayaran2.ApprovalDate, konfirmasipembayaran2.TahunMulai
from pembayaranfranchisee
join areacabang on pembayaranfranchisee.KodeCabang = areacabang.KodeAreaCabang
join konfirmasipembayaran2 on areacabang.RecID =konfirmasipembayaran2.Cabang
join areacabang a on areacabang.Area = a.KodeAreaCabang
where konfirmasipembayaran2.Status ='Approved' and areacabang.RecID ='uuu' and konfirmasipembayaran2.TahunMulai = 
(select top 1 TahunMulai from pembayaranfranchisee where pembayaranfranchisee.KodeCabang = areacabang.KodeAreaCabang 
order by pembayaranfranchisee.TahunMulai desc )
group by pembayaranfranchisee.Total, konfirmasipembayaran2.Cabang, konfirmasipembayaran2.TahunMulai, 
areacabang.KodeAreaCabang, pembayaranfranchisee.KodeCabang, pembayaranfranchisee.Pembayaran, a.NamaAreaCabang, 
pembayaranfranchisee.NilaiFranchisee, pembayaranfranchisee.TglMou, areacabang.TanggalBerlaku,areacabang.TanggalBerakhir, 
konfirmasipembayaran2.Nominal, konfirmasipembayaran2.CreatedDateTime, konfirmasipembayaran2.CreatedBy, konfirmasipembayaran2.ConfirmId, 
konfirmasipembayaran2.ApprovalDate

SQL;

      protected $auth;

    public function initialize() {
        $this->tag->setTitle("Konfirmasi Pembayaran franchisee");
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
    }

    /**
     * Index action
     */
    public function indexAction() {
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('Area', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
    }
	
	
    /**
     * Searches for program
     */
    public function searchAction()
    {
		$areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang')); 
		
		$tahun = "select top 1 pembayaranfranchisee.TahunMulai, pembayaranfranchisee.RecId as pf, areacabang.RecID from pembayaranfranchisee
				join areacabang on pembayaranfranchisee.KodeCabang = areacabang.KodeAreaCabang
				where areacabang.RecID = '$cabangid' order by TahunMulai desc";
		$query1 = $this->getDI()->getShared('db')->query($tahun); 
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
    public function nominalAction($RecID)
    {

		$areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));
		
		$TahunMulai =  $this->request->getPost('TahunMulai');
		
		
		$sql = str_replace(['uuu','iii'],[$cabangid,$TahunMulai], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->periode = date('d/m/Y', strtotime($date));
        $this->view->result = $query->fetchAll($query);
		
		$sql1 = "
		select top 1 areacabang.RecID, areacabang.KodeAreaCabang,
			a.NamaAreaCabang, pembayaranfranchisee.NilaiFranchisee,pembayaranfranchisee.Pembayaran,
			pembayaranfranchisee.TglMou, areacabang.TanggalBerlaku, areacabang.TanggalBerakhir,
			pembayaranfranchisee.NilaiFranchisee * 10/100 as Ppn,
			pembayaranfranchisee.RecID as pf,
			pembayaranfranchisee.NilaiFranchisee + (pembayaranfranchisee.NilaiFranchisee * 10/100) as Total,
			(select SUM(konfirmasipembayaran2.nominal) from konfirmasipembayaran2 where konfirmasipembayaran2.Status = 'Approved') as Bayar
			from pembayaranfranchisee
			join areacabang on pembayaranfranchisee.KodeCabang = areacabang.KodeAreaCabang
			join areacabang b on pembayaranfranchisee.KodeCabang = b.KodeAreaCabang
			join areacabang a on areacabang.Area = a.KodeAreaCabang
			--join konfirmasipembayaran2 on areacabang.RecID =konfirmasipembayaran2.Cabang
			WHERE areacabang.RecID= '$cabangid' order by TglMOU desc";

        $que = $this->getDI()->getShared('db')->query($sql1);
        $que->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->rest = $que->fetchAll($que);
		
		$sql2 = "select top 1 TahunMulai from pembayaranfranchisee join areacabang on pembayaranfranchisee.KodeCabang = areacabang.KodeAreaCabang where areacabang.RecID = '$cabangid' order by TahunMulai desc";
		$que1 = $this->getDI()->getShared('db')->query($sql2);
		$que1->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$this->view->tahun = $que1->fetchAll($que1);
		
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';
    }

    /**
     * Creates a new program
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "Konfirmasipembayaran2",
                "action" => "search"
            ));
        }
		$Konfirmasipembayaran = new Konfirmasipembayaran2();
		$bank=$this->request->getPost("bank");
			if ($bank==""){
				$bank=$this->request->getPost("bank");
			}
		$cabang = $this->request->getPost('recID');
		$jumlah = substr($this->request->getPost("Nominal", "int"), 0, -2);
		$prcabangnum = sprintf("%02d", $Konfirmasipembayaran->totalRecord() + 1);
		$ConfirmId = 'KP' . date('Y') . '-' . trim($this->auth['kodeareacabang']) . '-' . $prcabangnum;
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));
        $deskripsi =  $this->request->getPost('deskripsi');
		$PurchReqDate =  $this->request->getPost('PurchReqDate');
		$CreatedBy = $this->auth['username'];
		$CreatedDateTime = date('Y-m-d H:i:s');

		$tahunMulai = $this->request->getPost('TahunMulai');
		$pf = $this->request->getPost('pf');
		
		$insert = "
		SET IDENTITY_INSERT konfirmasipembayaran2 ON
		
		insert into konfirmasipembayaran2 (RecID, Cabang,ConfirmId,PurcReqName, Nominal, PurchReqDate, Status, CreatedBy, CreatedDateTime, Bank, TahunMulai, Pembayaranfranchise)
		values((SELECT ISNULL(MAX(RecId) + 1, 0) FROM konfirmasipembayaran2), '$cabang', '$ConfirmId', '$deskripsi', '$jumlah', '$PurchReqDate', 'Draft', '$CreatedBy', '$CreatedDateTime', '$bank', '$tahunMulai','$pf')
		
		SET IDENTITY_INSERT konfirmasipembayaran2 OFF";
		$query = $this->getDI()->getShared('db')->query($insert);
       $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

		

        $this->flash->success("program was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "Konfirmasipembayaran2",
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
                "controller" => "pembayaranfranchise",
                "action" => "search"
            ));
        }
		
		$kodeAreaCabang =  $this->request->getPost('kodeAreaCabang');
		$NilaiFranchisee =  $this->request->getPost('NilaiFranchisee');
		$tahunBerakhir =  $this->request->getPost('tahunBerakhir');
		$tahunBerlaku =  $this->request->getPost('tahunBerlaku');
		$TglMou =  $this->request->getPost('TglMou');
		$total =  $this->request->getPost('total');
		$Keterangan = $this->request->getPost('Keterangan');
		
        $insert = "insert into pembayaranfranchisee (RecID,KodeCabang, NilaiFranchisee, TglMOU, Total, TahunMulai, TahunBerakhir,Keterangan)
		values((SELECT ISNULL(MAX(RecID) + 1, 0) FROM pembayaranfranchisee), '$kodeAreaCabang','$NilaiFranchisee','$TglMou','$total','$tahunBerlaku','$tahunBerakhir','$Keterangan')"; 
		$query = $this->getDI()->getShared('db')->query($insert);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
		
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
		
		$update = "update areacabang set TanggalBerlaku = '$berlaku2', TanggalBerakhir = '$berakhir2' where KodeAreaCabang = '$kodeAreaCabang'";
		
		$query1 = $this->getDI()->getShared('db')->query($update);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
		
		$this->flash->success("Data sudah terinput");

        return $this->dispatcher->forward(array(
            "controller" => "pembayaranfranchise",
            "action" => "index"
        ));
    }
	
	public function receiptAction($param) {
        $Konfirmasipembayaran2 = Konfirmasipembayaran2::findFirstByRecID($this->filter->sanitize($param, "int"));
        $cabang = Areacabang::findFirst($this->session->auth['areacabang']);
        $pembayaranfranchise= Pembayaranfranchisee::findFirst($Konfirmasipembayaran2->Pembayaranfranchise);
        $tanggalBayar = new DateTime($Konfirmasipembayaran2->PurchReqDate);
        $jatuhTempo = new DateTime($cabang->TanggalBerakhir);

        if ($siswa->Cabang != $cabang->RecID) {
            return $this->response->redirect('index');
        }
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // loop to create copy's
        $data = [];
        for ($i = 0; $i < 3; $i++) {
            $dataReport = [];
            $dataReport["documentno"] = $detailPembayaran->DocumentNo;
            $dataReport["cabang"] = $cabang->KodeAreaCabang . " - " . $cabang->NamaAreaCabang;
            $dataReport["nosiswa"] = $cabang->KodeAreaCabang . $siswa->VirtualAccount;
            //$dataReport["tanggal"] = $tanggalBayar->format("d F Y");
            $dataReport["tanggal"] = strftime('%d %B %Y', $tanggalBayar->getTimestamp());
            $dataReport["namasiswa"] = $siswa->NamaSiswa;
            $dataReport["jumlahuang"] = $detailPembayaran->Jumlah;
            $dataReport["bayaruntuk"] = $detailPembayaran->PembayaranUntuk;
            $dataReport["sisabayar"] = $detailPembayaran->SisaPembayaran;
            $dataReport["terbilang"] = $this->terbilang($detailPembayaran->Jumlah) . " Rupiah";
            //$dataReport["jatuhtempo"] = $jatuhTempo->format("d F Y");
            $dataReport["jatuhtempo"] = strftime('%d %B %Y', $jatuhTempo->getTimestamp());
            $dataReport["location"] = $cabang->KotaModel->NamaKotaKab;
            $dataReport["now"] = strftime('%d %B %Y');
            $dataReport["program"] = $programsiswa->getProgram();

            $data[$i] = $dataReport;
        }

        //$this->view->datareport = $dataReport;
        $this->view->data = $data;
        //$this->view->disable();
        //echo $this->printReport($this->filter->sanitize($param, "int"));
//        $pdf = new pdf();
//        $pdf->pdf_output("Kwitansi", $this->printReport($param), 2);
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
	
	private function getTransaction($siswa = NULL) {
        $column = ['s.VirtualAccount', 's.VirtualAccount + " - " + s.NamaSiswa AS NamaSiswa'];
        $groupBy = ['s.VirtualAccount', 's.NamaSiswa'];
        $cabang = $this->auth['areacabang'];
        $query = $this->modelsManager->createBuilder()
                ->columns($column)->groupBy($groupBy)
                ->addFrom('Siswa', 's')
                ->join('Programsiswa', 'ps.Siswa = s.RecID', 'ps')
                ->where('s.Cabang = :c:', ['c' => $cabang])
                ->orderBy('s.VirtualAccount');
        if ($siswa) {
            $query = $query->andWhere('s.VirtualAccount = :s:', ['c' => $siswa]);
        }
        return $query->getQuery()->execute()->setHydrateMode(Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
    }

}
