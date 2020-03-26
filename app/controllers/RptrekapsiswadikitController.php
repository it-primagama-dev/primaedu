<?php

class rptrekapsiswadikitController extends ControllerBase
{

    protected $auth;

    protected $sql = <<<SQL
SELECT
       a.NamaAreaCabang AS [NamaArea]
       ,RTRIM(c.KodeAreaCabang)+' ' AS [KodeCabang]
       ,c.NamaAreaCabang AS [NamaCabang]
       ,COUNT(DISTINCT s.RecID) AS [JumlahSiswa]
	   ,COUNT(DISTINCT y.RecID) AS [Jumlahpesanan]
FROM users u
JOIN areacabang c on u.AreaCabang = c.RecID
JOIN areacabang a on c.Area = a.KodeAreaCabang
LEFT JOIN siswa s on c.RecID = s.Cabang
LEFT JOIN purchreqheader y on c.RecID = y.Cabang
WHERE  c.Area IS NOT NULL  AND c.Aktif='1'   
GROUP BY a.NamaAreaCabang, c.KodeAreaCabang, c.NamaAreaCabang
HAVING COUNT(DISTINCT s.RecID) <= 20
ORDER BY JumlahSiswa desc
SQL;

/*
SELECT
       a.NamaAreaCabang AS [NamaArea]
       ,RTRIM(c.KodeAreaCabang)+' ' AS [KodeCabang]
       ,c.NamaAreaCabang AS [NamaCabang]
       ,COUNT(DISTINCT s.RecID) AS [JumlahSiswa]
FROM users u
JOIN areacabang c on u.AreaCabang = c.RecID
JOIN areacabang a on c.Area = a.KodeAreaCabang
LEFT JOIN siswa s on c.RecID = s.Cabang
LEFT JOIN programsiswa ps on s.RecID = ps.Siswa
LEFT JOIN pembayaran pb on ps.RecID = pb.ProgramSiswa
LEFT JOIN pembayarandetail pd on pb.RecID = pd.Pembayaran
WHERE u.LastLogin IS NOT NULL AND c.Area IS NOT NULL  
GROUP BY a.NamaAreaCabang, c.KodeAreaCabang, c.NamaAreaCabang
HAVING COUNT(DISTINCT s.RecID) <= 20
ORDER BY JumlahSiswa desc
*/
    public function initialize() {
        $this->tag->setTitle('Laporan Jumlah Siswa Sedikit');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
    }

    public function indexAction() {
        $this->view->rpt_auth = $this->auth;
    }

    public function viewAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('rptrekapsiswadikit/index');
        }
        $datefrom = $this->request->getPost('DateFrom', 'int') ? : date('Y-m-d');
        $dateto = $this->request->getPost('DateTo', 'int') ? : date('Y-m-d');

        $sql = str_replace(['%0', '%1'], [$datefrom, $dateto], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->rpt_title = 'Laporan Jumlah Siswa Sedikit';
        $this->view->periode = date('d/m/Y', strtotime($datefrom)).' - '.date('d/m/Y', strtotime($dateto));
        $this->view->result = $query->fetchAll($query);

    }

}

