<?php
set_time_limit(300);
class Rptlaporancashinoutcontroller extends ControllerBase
{
    public function initialize() {
        $this->tag->setTitle('Laporan Cash In & Cash Out');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        } 
        $this->view->rpt_title = 'Laporan Cash In & Cash Out';
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

 public function viewAction() {

        if (!$this->request->isPost()) {
            return $this->forward('RptlaporancashinoutController/index');
        }

        //$tahun = $this->request->getPost('tahun');
        $cabang = $this->request->getPost('Cabang');
        if ($cabang==''){
            $cabang = $this->auth['kodeareacabang'];

       
        }
        $sqltype="select a.RecId,a.ClassId as Kelas,a.CashInOutCode,a.Deskripsi as dec from CashInOutType a ";

        $querytype = $this->getDI()->getShared('db')->query($sqltype);
        $querytype->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->resulttype = $querytype->fetchAll($querytype); 

        /*$sql2="select  DATENAME(month, Tanggal) as bulan, MONTH(Tanggal) as bln,
             SUM(Nominal) as Jumlah, YEAR(Tanggal) as tahun, CashInOut.TypeId, CashInOutType.Description as dec
             from CashInOut join areacabang on CashInOut.Cabang=areacabang.KodeAreaCabang 
            join CashInOutType on CashInOutType.RecId=CashInOut.TypeId
            join CashInOutTypeClass on CashInOutTypeClass.RecId=CashInOutType.ClassId 
            join CashInOutGroup on CashInOutTypeClass.GroupId=CashInOutGroup.RecId  
            where Cabang=$cabang
            GROUP BY DATENAME(month, Tanggal),MONTH(Tanggal),YEAR(Tanggal),CashInOut.TypeId, CashInOutType.Description
            ORDER BY bln asc";*/
        //echo "$cabang";
        $sql1="Select * from areacabang where KodeAreaCabang='$cabang'";
        
        $query1 = $this->getDI()->getShared('db')->query($sql1);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result1 = $query1->fetchAll($query1);

        $sql2="Select DATENAME(month, Tanggal) as bulan, MONTH(Tanggal) as bln, SUM(Nominal) as Jumlah
                , Year(Tanggal) as tahun, CashInOut.IDTipe as TypeId,CashInOutType.Deskripsi as dec,CashInOut.IDHuruf
                from CashInOut join areacabang on CashInOut.Cabang=areacabang.KodeAreaCabang
                join CashInOutType on CashInOutType.RecID=CashInOut.IDTipe
                where cabang=$cabang
                GROUP BY DATENAME(month, Tanggal),MONTH(Tanggal),YEAR(Tanggal),
                CashInOut.IDTipe, CashInOutType.Deskripsi,CashInOut.IDHuruf
                ORDER BY bln asc";
        
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result2 = $query2->fetchAll($query2);
        
        /*$sql3="select  DATENAME(month, TanggalPembayaran) as bulan, MONTH(TanggalPembayaran) as bln,
                YEAR(TanggalPembayaran) as tahun ,SUM(Jumlah * 0.89) as Jumlah,areacabang.NamaAreaCabang
                from pembayarandetail join pembayaran on pembayaran.RecID=pembayarandetail.Pembayaran
                join programsiswa on programsiswa.Siswa=pembayaran.ProgramSiswa
                join siswa on siswa.RecID=programsiswa.Siswa
                join areacabang on areacabang.RecID=siswa.Cabang
                where pembayarandetail.PembayaranUntuk='Bimbingan' and areacabang.KodeAreaCabang='$cabang'   
                GROUP BY DATENAME(month, TanggalPembayaran),MONTH(TanggalPembayaran),YEAR(TanggalPembayaran),
                areacabang.NamaAreaCabang
                ORDER BY bln asc";*/
        $sql3="select DATENAME(MONTH,TanggalTransaksi) as bulan, MONTH(TanggalTransaksi) as bln,
                 YEAR(TanggalTransaksi) as tahun, Sum(Nominal) as 
                Jumlah,areacabang.NamaAreaCabang  from transaksibank 
                join siswa on siswa.RecID=transaksibank.Siswa
                join areacabang on siswa.Cabang=areacabang.RecID
                where  areacabang.KodeAreaCabang='$cabang'   
                GROUP BY DATENAME(month, TanggalTransaksi),MONTH(TanggalTransaksi),YEAR(TanggalTransaksi),
                areacabang.NamaAreaCabang
                 ORDER BY bln asc";
        
        $query3 = $this->getDI()->getShared('db')->query($sql3);
        $query3->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result3= $query3->fetchAll($query3);

        $sql4="select DATENAME(MONTH,TanggalTransaksi) as bulan, MONTH(TanggalTransaksi) as bln,
                 YEAR(TanggalTransaksi) as tahun, Sum(Nominal * 0.11) as 
                Jumlah,areacabang.NamaAreaCabang  from transaksibank 
                join siswa on siswa.RecID=transaksibank.Siswa
                join areacabang on siswa.Cabang=areacabang.RecID
                where  areacabang.KodeAreaCabang='$cabang'   
                GROUP BY DATENAME(month, TanggalTransaksi),MONTH(TanggalTransaksi),YEAR(TanggalTransaksi),
                areacabang.NamaAreaCabang
                 ORDER BY bln asc";
        
        $query4 = $this->getDI()->getShared('db')->query($sql4);
        $query4->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result4= $query4->fetchAll($query4);

        $sql5="Select DATENAME(month, Tanggal) as bulan, MONTH(Tanggal) as bln, SUM(Nominal) as Jumlah
                , Year(Tanggal) as tahun, CashInOut.IDTipe as TypeId,CashInOut.IDHuruf 
                from CashInOut join areacabang on CashInOut.Cabang=areacabang.KodeAreaCabang
                where cabang='$cabang'
                GROUP BY DATENAME(month, Tanggal),MONTH(Tanggal),YEAR(Tanggal),CashInOut.IDHuruf,
                CashInOut.IDTipe
                ORDER BY TypeId asc
                ";
        
        $query5 = $this->getDI()->getShared('db')->query($sql5);
        $query5->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result5 = $query5->fetchAll($query5);

        $date = date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->request->getPost('Cabang');
        //$cabangidd = $this->_validateArea($this->request->getPost('Cabang'));
      
        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $cabang->NamaAreaCabang : 'all';
        $tahunajaran = Tahunajaran::findFirstByRecID($tahun);
        $this->view->periode = $tahun ? $tahunajaran->Description : 'all';
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

