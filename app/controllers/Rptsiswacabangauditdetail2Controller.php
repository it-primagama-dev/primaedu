<?php
set_time_limit(120);
class Rptsiswacabangauditdetail2Controller extends ControllerBase
{

    protected $auth;

   

    public function initialize() {
        $this->tag->setTitle('Laporan Periode');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Laporan Periode';
    }

    public function indexAction() {

        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('Area', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
        
        $this->view->tahun = Tahunajaran::find();
    
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

public function viewAction($id)
    {
        $ids=substr($id,7);
        //echo "$ids <br>";
        $idsub=substr($ids,0,1);
       // echo "$idsub <br>";
        $idsub2=substr($id,0,7);
       // echo "$idsub2 <br>";
        $idsub3=substr($id,8);    
        //echo "$idsub3";
       
       $sql2="select * from areacabang where RecID='$idsub'";

       
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result2 = $query2->fetchAll($query2);

        $sql3="select siswa.NamaSiswa, pembayarandetail.DocumentNo,pembayarandetail.TanggalPembayaran,
            SUM(Jumlah) AS JUMLAHBIMBINGAN   
            from pembayarandetail
            join pembayaran on pembayaran.RecID=pembayarandetail.Pembayaran
            join programsiswa on programsiswa.RecID=pembayaran.ProgramSiswa
            join program on program.RecID=programsiswa.Program
            join siswa on siswa.RecID=programsiswa.Siswa
            where siswa.Cabang='$idsub3' and siswa.VirtualAccount='$idsub2'and 
            pembayarandetail.PembayaranUntuk='Bimbingan' and program.tahunajaran='$idsub'
            group by siswa.NamaSiswa, pembayarandetail.DocumentNo,pembayarandetail.TanggalPembayaran";

       
        $query3 = $this->getDI()->getShared('db')->query($sql3);
        $query3->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result3 = $query3->fetchAll($query3);

        $date = date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->request->getPost('Cabang');
       

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->NamaAreaCabang : 'all';
        $tahunajaran = Tahunajaran::findFirstByRecID($tahun);
        $this->view->rpt_tahun = $tahun ? $tahunajaran->Description : 'all';
        $cabangs = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabangid = $cabangid ? $cabangs->RecID : 'All';
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

