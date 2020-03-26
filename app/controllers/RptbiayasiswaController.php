<?php

class RptbiayasiswaController extends ReportBase {

    protected $sql = <<<SQL
SELECT
    c.NamaAreaCabang AS NamaCabang
    , pd.DocumentNo, s.VirtualAccount, s.NamaSiswa
    , p.NamaProgram, j.NamaJenjang, pd.Jumlah, pd.TanggalPembayaran
FROM siswa s
JOIN programsiswa ps ON s.RecID = ps.Siswa
JOIN pembayaran pb ON ps.RecID = pb.ProgramSiswa
JOIN pembayarandetail pd ON pb.RecID = pd.Pembayaran
JOIN program p ON ps.Program = p.RecID
JOIN jenjang j ON p.Jenjang = j.KodeJenjang
JOIN areacabang c ON s.Cabang = c.RecID
JOIN areacabang a ON a.KodeAreaCabang = c.Area
WHERE pd.PembayaranUntuk = '%1'
AND pd.TanggalPembayaran BETWEEN '%2' AND '%3'
%0
ORDER BY c.KodeAreaCabang, ps.Program, s.VirtualAccount
SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan Penerimaan Biaya');
        parent::initialize();
        $this->view->rpt_title = 'Laporan Penerimaan Biaya';
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
        //echo '<option value="">---</option>';
        if (!count($cabang)) {
            return;
        }
        foreach ($cabang as $rec) {
            echo "<option value=\"" . $rec->RecID . "\">" . $rec->KodeNamaAreaCabang . "</option>";
        }
    }

    public function viewAction() {
        if (!$this->request->isPost()) {
            return $this->forward('rptbiayasiswa/index');
        }

        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));
        $param = [
            $this->_getCriteria($areaid, $cabangid, FALSE),
            $this->getType(), $this->getDateFrom(), $this->getDateTo()
        ];
        $sql = str_replace(['%0', '%1', '%2', '%3'], $param, $this->sql);

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = $this->getDateFrom('d/m/Y') . ' - ' . $this->getDateTo('d/m/Y');
        $this->view->result = $query->fetchAll($query);
        $this->view->rpt_title = 'Laporan Penerimaan Biaya ' . $this->getType();
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';
    }

    private function getType() {
        return $this->request->getPost('ViewType') === 'D' ? 'Pendaftaran' : 'Bimbingan';
    }

    private function getDateFrom($format = 'Y-m-d', $time = null) {
        $temp = $time ? strtotime($time) : strtotime($this->request->getPost('DateFrom', 'int'));
        return $temp === FALSE ? date($format) : date($format, $temp);
    }

    private function getDateTo($format = 'Y-m-d', $time = null) {
        $temp = $time ? strtotime($time) : strtotime($this->request->getPost('DateTo', 'int'));
        return $temp === FALSE ? date($format) : date($format, $temp);
    }

}
