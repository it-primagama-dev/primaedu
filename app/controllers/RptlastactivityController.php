<?php

class RptlastactivityController extends ControllerBase
{

    protected $auth;

    protected $sql = <<<SQL
SELECT
	a.NamaAreaCabang AS [NamaArea]
	,RTRIM(c.KodeAreaCabang)+' ' AS [KodeCabang]
	,c.NamaAreaCabang AS [NamaCabang]
	,COUNT(DISTINCT u.RecID) AS [JumlahUsers]
	,COUNT(DISTINCT s.RecID) AS [JumlahSiswa]
	,COUNT(DISTINCT pd.RecID) AS [TransaksiPembayaran]
	,MAX(u.LastLogin) AS [LoginTerakhir]
FROM users u
JOIN areacabang c on u.AreaCabang = c.RecID
JOIN areacabang a on c.Area = a.KodeAreaCabang
LEFT JOIN siswa s on c.RecID = s.Cabang
LEFT JOIN programsiswa ps on s.RecID = ps.Siswa
LEFT JOIN pembayaran pb on ps.RecID = pb.ProgramSiswa
LEFT JOIN pembayarandetail pd on pb.RecID = pd.Pembayaran
WHERE u.LastLogin IS NOT NULL AND c.Area IS NOT NULL
GROUP BY a.NamaAreaCabang, c.KodeAreaCabang, c.NamaAreaCabang
ORDER BY a.NamaAreaCabang, c.KodeAreaCabang
SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan Aktifitas Cabang');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
    }

    public function indexAction()
    {
        if (!$this->_validatePusat()) {
            return $this->forward('index/index');
        }

//        $query = $this->getDI()->getShared('db')->query($this->sql);
//        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

//        $this->view->setLayout('report');
//        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->rpt_title = 'Laporan Aktifitas Cabang';
        $this->view->periode = date('d/m/Y');
        //$this->view->result = $query->fetchAll($query);

    }

    public function dataAction()
    {
        if (!$this->_validatePusat()) {
            return $this->forward('index/index');
        }
        $this->view->disable();
        $query = $this->getDI()->getShared('db')->query($this->sql);
        $query->setFetchMode(Phalcon\Db::FETCH_ASSOC);
        $this->response->setContentType('application/json');
        return $this->response->setJsonContent([
            'status' => 'OK',
            'data' => $query->fetchAll($query)
        ], JSON_NUMERIC_CHECK);
    }

    private function _validatePusat() {
        if ($this->auth['areacabang']) {
            return FALSE;
        }
        return TRUE;
    }
}

