<?php

class laporanedcController extends ControllerBase 
{

    protected $sql = <<<SQL


select transaksibank.NoVA,siswa.VirtualAccount,siswa.NamaSiswa, transaksibank.TanggalTransaksi, transaksibank.gros_amt,
transaksibank.TanggalImport, transaksibank.CardNo, transaksibank.NamaBank ,siswa.Cabang,areacabang.NamaAreaCabang,
transaksibank.Nominal, transaksibank.Keterangan, transaksibank.seq,areacabang.KodeAreaCabang,
areacabang.NoRekBCA, areacabang.NamaRekBCA  from transaksibank
join areacabang on transaksibank.KodeCabang = areacabang.KodeAreaCabang
left join siswa on transaksibank.Siswa = siswa.RecID
left join bank on areacabang.KodeBankNonBCA = bank.Kode
where transaksibank.TanggalImport ='uuu' and auth_cd is not null and transaksibank.Nominal != '0'

SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan Pembagian Dana');
        parent::initialize();
        $this->view->rpt_title = 'Laporan Pembagian Dana';
		
    }

    public function indexAction() {
        
        $this->view->rpt_auth = $this->auth;
		$this->view->date = isset($date) ? $date : date('Y-m-d');
    }

    public function getcabangAction($area = 0) {
        $this->view->disable();
        $cabang = Areacabang::query()
                ->columns("c.*")
                ->join("Areacabang", "Areacabang.KodeAreaCabang = c.Area", "c")
                ->where("Areacabang.RecID = :area: AND Aktif = 1")
                ->orderBy("c.KodeAreaCabang")
                ->bind(["area" => $this->filter->sanitize($area, "int")])
                ->execute();
        echo '<option value="">---</option>';
        if (!count($cabang)) {
            return;
        }
        foreach ($cabang as $rec) {
            echo "<option value=\"" . $rec->RecID . "\">" . $rec->KodeNamaAreaCabang . "</option>";
        }
    }

    public function viewAction()
    {
		
        if (!$this->request->isPost()) {
            return $this->forward('Pembayarandana/index');
        }
		$date = $this->request->getPost('Tanggal' ,'int');
		
        $sql = str_replace( 
                ['uuu'],[$date], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = date('d/m/Y', strtotime($date));
        $this->view->result = $query->fetchAll($query);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';

    }
}
