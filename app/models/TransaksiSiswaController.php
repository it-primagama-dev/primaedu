<?php

class TransaksiSiswaController extends ReportBase
{

    protected $sql = <<<SQL

select Transaksibank.RecID,TanggalTransaksi,NoVA, siswa.NamaSiswa, Nominal  from transaksibank
join siswa on transaksibank.siswa = siswa.RecID
join areacabang on transaksibank.KodeCabang = areacabang.KodeAreaCabang
where areacabang.KodeAreaCabang = 'uuu' and tahunajaran=''



SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan detail');
        parent::initialize();
        $this->view->rpt_title = 'Laporan detail';
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
       
       
        $areaid= $this->auth['areacabang'];
    
		$cabang = Areacabang::findFirstByRecID($areaid);
		$area= $cabang->KodeAreaCabang;
		
        $sql = str_replace('uuu',$area, $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->periode = date('d/m/Y', strtotime($date));
        $this->view->result = $query->fetchAll($query);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->KodeNamaAreaCabang : 'All';

    }
	
	public function UpdateAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('TransaksiSiswa/index');
        }
       
        $tahunajaran = $this->request->getPost('tahun');
		$ajaran = $this->request->getPost('ajaran');
		$phql = "UPDATE transaksibank SET tahunajaran = '$ajaran' WHERE RecId = '$tahunajaran'";

            $ret = $this->db->query($phql);

            if (!$ret) {
                foreach ($purchreqheader->getMessages() as $message) {
                    $this->flash->error($message);
                }

                return $this->forward('TransaksiSiswa/index');
            }
           
            return $this->response->redirect("TransaksiSiswa/view");
		
		
       

    }
}
