<?php

class RptsiswapiutangController extends ReportBase
{

    protected $sql = <<<SQL
select  areacabang.KodeAreaCabang as KodeCabang,siswa.VirtualAccount as NIS,siswa.NamaSiswa,
areacabang.NamaAreaCabang as NamaCabang,jenjang.NamaJenjang,
(
select top 1 jumlahtotal from pembayaran join programsiswa on programsiswa.recid=pembayaran.ProgramSiswa
where programsiswa.Siswa=siswa.RecID) as BiayaBimbingan,
(select SUM(nominal) from transaksibank where transaksibank.KodeCabang=areacabang.KodeAreaCabang and
siswa.VirtualAccount=SUBSTRING(transaksibank.NoVA,5,8)) as TotalPembayaran
from siswa join jenjang on siswa.jenjang=jenjang.KodeJenjang join areacabang on siswa.Cabang=areacabang.RecID
where areacabang.KodeAreaCabang='0009'
order by siswa.VirtualAccount

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
            return $this->forward('rptpiutangsiswa/index');
        }
        $date = $this->request->getPost('Date', 'int') ? : date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->request->getPost('Cabang');
		 $cabang = Areacabang::findFirstByRecID($cabangid);
        $sql = str_replace(
                ['0009', '%1'],[$cabang->KodeAreaCabang,$date], $this->sql);
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
