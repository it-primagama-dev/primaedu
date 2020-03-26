<?php

class RptjenjangsiswaController extends ControllerBase
{

    protected $auth;

    protected $sql = <<<SQL
SELECT  j.NamaJenjang %3 ,p.NamaProgram
	,ISNULL(SUM(DISTINCT PBSUM.JumlahSiswaLalu),0) AS JumlahSiswaLalu, ISNULL(SUM(DISTINCT PBSUM.JumlahSiswa),0) AS JumlahSiswa
	,ISNULL(SUM(CAST(PBSUM.PendaftaranLalu as money)),0) AS PendaftaranLalu, ISNULL(SUM(CAST(PBSUM.Pendaftaran as money)),0) AS Pendaftaran
	,ISNULL(SUM(CAST(PBSUM.BimbinganLalu as money)),0) AS BimbinganLalu, ISNULL(SUM(CAST(PBSUM.Bimbingan as money)),0) AS Bimbingan
FROM jenjang j
JOIN program p ON j.KodeJenjang = p.Jenjang
LEFT JOIN (
SELECT  ps.Program
        ,COUNT(DISTINCT CASE WHEN CAST(s.CreatedAt AS date) < '%0' THEN s.RecID END) AS JumlahSiswaLalu
	,COUNT(DISTINCT CASE WHEN CAST(s.CreatedAt AS date) BETWEEN '%0' AND '%1' THEN s.RecID END) AS JumlahSiswa
	,SUM(CASE WHEN pd.PembayaranUntuk = 'Pendaftaran' AND pd.TanggalPembayaran < '%0' THEN CAST(pd.Jumlah as money) END) AS PendaftaranLalu
	,SUM(CASE WHEN pd.PembayaranUntuk = 'Pendaftaran' AND pd.TanggalPembayaran BETWEEN '%0' AND '%1' THEN CAST(pd.Jumlah as money) END) AS Pendaftaran
	,SUM(CASE WHEN pd.PembayaranUntuk = 'Bimbingan' AND pd.TanggalPembayaran < '%0' THEN CAST(pd.Jumlah as money) END) AS BimbinganLalu
	,SUM(CASE WHEN pd.PembayaranUntuk = 'Bimbingan' AND pd.TanggalPembayaran BETWEEN '%0' AND '%1' THEN CAST(pd.Jumlah as money) END) AS Bimbingan
FROM areacabang a
JOIN areacabang c ON a.KodeAreaCabang = c.Area
JOIN siswa s ON c.RecID = s.Cabang
JOIN programsiswa ps ON s.RecID = ps.Siswa
JOIN pembayaran pb ON ps.RecID = pb.ProgramSiswa
JOIN pembayarandetail pd ON pb.RecID = pd.Pembayaran
%2
GROUP BY ps.Program) PBSUM
ON p.RecID = PBSUM.Program
GROUP BY j.KodeJenjang,j.NamaJenjang %3 ,p.NamaProgram,p.TipeProgram
ORDER BY j.KodeJenjang %3 ,p.TipeProgram
SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan Jumlah Siswa per Jenjang');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Laporan Jumlah Siswa per Jenjang';
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

    public function viewAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('rptjenjangsiswa/index');
        }
        $datefrom = $this->request->getPost('DateFrom', 'int') ? : date('Y-m-d');
        $dateto = $this->request->getPost('DateTo', 'int') ? : date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));

        $sql = str_replace(
                ['%0', '%1', '%2', '%3'], [$datefrom, $dateto, $this->_getCriteria($areaid, $cabangid), ""], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = date('d/m/Y', strtotime($datefrom)).' - '.date('d/m/Y', strtotime($dateto));
        $this->view->result = $query->fetchAll($query);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';

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
