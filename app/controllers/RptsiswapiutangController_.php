<?php

class RptsiswapiutangController extends ReportBase
{
    protected $sql = <<<SQL
	select c.RecID,c.KodeAreaCabang,c.NamaAreaCabang,tb.KodeCabang,tb.NoVA, a.NamaAreaCabang AS NamaCabang
		   ,rtrim(c.KodeAreaCabang) + s.VirtualAccount AS NIS, a.NamaAreaCabang
		   ,s.NamaSiswa,rtrim(a.KodeAreaCabang) + s.VirtualAccount AS NIS,c.NamaAreaCabang AS NamaCabang
		   ,pb.JumlahTotal-pd.Jumlah as BiayaBimbingan
		   ,sum(tb.Nominal) as TotalPembayaran
		   ,(pb.JumlahTotal-pd.Jumlah)-sum(tb.Nominal) as TotalPiutang
	from transaksibank tb
	left join areacabang a on a.KodeAreaCabang =tb.KodeCabang
	join areacabang c on c.KodeAreaCabang = a.Area
	left join siswa s on s.RecID = tb.Siswa
	join programsiswa ps on ps.Siswa=s.RecID 
	join pembayaran pb on pb.ProgramSiswa=ps.RecID 
	join pembayarandetail pd on pd.Pembayaran=pb.RecID
	where 
	(pd.PembayaranUntuk='pendaftaran' or pb.CreatedAt<='%1' and a.RecID='%1') or 
	(pd.PembayaranUntuk='pendaftaran' or pb.CreatedAt<='%1' and c.RecID='%0') or 
	(pd.PembayaranUntuk='pendaftaran' or pb.CreatedAt<='%1' and c.RecID='%0' and a.RecID='%1')
	group by c.KodeAreaCabang,tb.KodeCabang,tb.NoVA,tb.Siswa,a.NamaAreaCabang, s.NamaSiswa, c.NamaAreaCabang,pb.ProgramSiswa
             ,pb.JumlahTotal,pd.Jumlah,s.VirtualAccount,a.KodeAreaCabang,c.RecID
    order by c.KodeAreaCabang,tb.KodeCabang,tb.NoVA
SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan Piutang Siswa');
        parent::initialize();
        $this->view->rpt_title = 'Laporan Piutang Siswa';
    }

    public function indexAction() {
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('Area', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
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
            return $this->forward('rptsiswapiutang/index');
        }
        $date = $this->request->getPost('Date', 'int') ? : date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));
				
		$sql = str_replace(['%0', '%1', '%2'], [$areaid, $cabangid, $date], $this->sql);
	
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
