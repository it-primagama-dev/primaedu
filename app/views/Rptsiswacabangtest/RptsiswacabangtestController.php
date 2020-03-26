<?php


class RptsiswacabangtestController extends ControllerBase
{

    protected $sql = <<<SQL

    select VirtualAccount,MD, NamaProgram, NamaSiswa, Cabang,sum(JumlahTotal)as JumlahTotal,
(select sum(transaksibank.Nominal) as Uang_masuk from transaksibank where transaksibank.Siswa = cte.RecID and 
tahunajaran='01' and KodeCabang=cte.KodeAreaCabang)as Uang_masuk ,
+(select sum(jumlah) as uang from pembayarandetail join pembayaran on pembayaran.RecID=pembayarandetail.Pembayaran
                join programsiswa on programsiswa.RecID=pembayaran.ProgramSiswa where programsiswa.Siswa
                =cte.RecID and pembayaranmetode=8) as uang
                from
(select siswa.VirtualAccount,Siswa.RecId,Siswa.MD,areacabang.kodeareacabang, program.NamaProgram, siswa.NamaSiswa,siswa.cabang, 
               (pembayaran.JumlahTotal-pembayarandetail.Jumlah) as
                JumlahTotal From Siswa
                Join programsiswa ON siswa.RecID = programsiswa.siswa
                Join program ON program.RecID = programsiswa.program
                Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
                Join pembayaran ON pembayaran.ProgramSiswa = programsiswa.RecID
                join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
                Join areacabang ON areacabang.RecID = siswa.cabang
               Where program.tahunajaran = '01' and siswa.cabang = '02'
               and pembayarandetail.pembayaranuntuk='Pendaftaran'
                group by siswa.VirtualAccount,Siswa.MD,pembayaran.JumlahTotal, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, siswa.RecID,
                tahunajaran.Description,pembayarandetail.Jumlah,areacabang.kodeareacabang) as cte
                group by VirtualAccount,MD,NamaSiswa,Cabang,RecID,kodeareacabang,NamaProgram

SQL;

protected $sql2 = <<<SQL
select VirtualAccount,MD, NamaSiswa,Cabang,sum(JumlahTotal)as JumlahTotal, 
(select sum(transaksibank.Nominal) as Uang_masuk from transaksibank where transaksibank.Siswa = cte.RecID and 
tahunajaran='01' and KodeCabang=cte.KodeAreaCabang)as Uang_masuk,
+(select sum(jumlah) as uang from pembayarandetail join pembayaran on pembayaran.RecID=pembayarandetail.Pembayaran
                join programsiswa on programsiswa.RecID=pembayaran.ProgramSiswa where programsiswa.Siswa
                =cte.RecID and pembayaranmetode=8) as uang
                from
(select siswa.VirtualAccount,Siswa.RecId,Siswa.MD,areacabang.kodeareacabang, siswa.NamaSiswa,siswa.cabang, 
               (pembayaran.JumlahTotal-pembayarandetail.Jumlah) as
                JumlahTotal From Siswa
                Join programsiswa ON siswa.RecID = programsiswa.siswa
                Join program ON program.RecID = programsiswa.program
                Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
                Join pembayaran ON pembayaran.ProgramSiswa = programsiswa.RecID
                join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
                Join areacabang ON areacabang.RecID = siswa.cabang
               Where program.tahunajaran = '01' and siswa.cabang ='02'
               and pembayarandetail.pembayaranuntuk='Pendaftaran'
                group by siswa.VirtualAccount,Siswa.MD,pembayaran.JumlahTotal, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, siswa.RecID,
                tahunajaran.Description,pembayarandetail.Jumlah,areacabang.kodeareacabang) as cte
                group by VirtualAccount,MD,NamaSiswa,Cabang,RecID,kodeareacabang
SQL;
  

    public function initialize() {
        $this->tag->setTitle('Laporan Kinerja per Jenjang');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        } 
        $this->view->rpt_title = 'Laporan Periode';
    }

    public function indexAction() {
        ?>
<script language="Javascript">
            
window.alert('Laporan periode masih dalam tahap perbaikan sampai dengan 25 Oktober 2016');
            
</script>
            
            <?php
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

 public function viewAction() {


        if (!$this->request->isPost()) {
            return $this->forward('Rptsiswacabangtest/index');
        }

        $tahun = $this->request->getPost('tahun');
        $cabang = $this->request->getPost('Cabang');
        if ($cabang==''){
            $cabang = $this->auth['areacabang'];
        }

        $sql = str_replace(
                ['01', '02'],[$tahun,$cabang], $this->sql);
         $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);

        $sql2 = str_replace(
                ['01', '02'],[$tahun,$cabang], $this->sql2);
         $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result2 = $query2->fetchAll($query2);

        $sql3 = "select siswa.VirtualAccount,Siswa.MD, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, 
                tahunajaran.Description, (pembayaran.JumlahTotal-pembayarandetail.Jumlah) as
                JumlahTotal,
                (select sum(transaksibank.Nominal) as Uang_masuk from transaksibank where transaksibank.Siswa = siswa.RecID and 
                tahunajaran=$tahun) as Uang_masuk
                From Siswa

                Join programsiswa ON siswa.RecID = programsiswa.siswa
                Join program ON program.RecID = programsiswa.program
                Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
                Join pembayaran ON pembayaran.ProgramSiswa = programsiswa.RecID
                join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
                Join areacabang ON areacabang.RecID = siswa.cabang
               Where program.tahunajaran = $tahun and siswa.cabang =$cabang and siswa.MD= '0'
               and pembayarandetail.pembayaranuntuk='Pendaftaran'
                group by siswa.VirtualAccount,Siswa.MD,pembayaran.JumlahTotal, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, siswa.RecID,
                tahunajaran.Description,pembayarandetail.Jumlah";
         $query3 = $this->getDI()->getShared('db')->query($sql3);
        $query3->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result3 = $query3->fetchAll($query3);
                
                
        $sql1 = "select sum(Nominal) Nominal from feemanagement join areacabang on feemanagement.KodeCabang=areacabang.KodeAreaCabang
                    where areacabang.RecID=$cabang and feemanagement.keterangan='$tahun'";
      
        
        $query1 = $this->getDI()->getShared('db')->query($sql1);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result1 = $query1->fetchAll($query1);


        $date = date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->auth['areacabang'];
        $cabangidd = $this->_validateArea($this->request->getPost('Cabang'));

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangidd);
        $this->view->rpt_cabang = $cabangidd ? $cabang->NamaAreaCabang : 'all';
        $tahunajaran = Tahunajaran::findFirstByRecID($tahun);
        $this->view->periode = $tahun ? $tahunajaran->Description : 'all';

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

