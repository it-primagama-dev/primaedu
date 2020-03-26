<?php

class RptOperasionalController extends ReportBase
{
    protected $sql = <<<SQL
select NamaAreaCabang, RecIDcbg,KodeAreaCabang,NamaCabang, 
        (select count(siswa.RecID) from siswa 
            join programsiswa on siswa.RecID = programsiswa.Siswa
            join program on programsiswa.Program=program.RecID
            where siswa.Cabang=cte.RecIDcbg and program.tahunajaran = '3' ) as JumlahSiswa,
        (select ISNULL(sum(b.Qty),0) as Jumlah from purchreqheader a 
            join purchreqline b on a.RecId=b.Purchreqheader
            join (SELECT PurchReqId from Konfirmasipembayaran Group BY PurchReqId) c on a.PurchReqId=c.PurchReqId
            where a.Cabang=cte.RecIDcbg and a.ApprovalDate >= '2017-07-01') AS JumlahBuku,
        (SELECT isnull(sum(JumlahTotal),0) from
            (select siswa.VirtualAccount,Siswa.RecId,Siswa.MD,areacabang.RecID as RecIDCabang,areacabang.kodeareacabang,
                areacabang.NamaAreaCabang as NamaCabang,a.NamaAreaCabang, siswa.NamaSiswa,siswa.cabang,
                (pembayaran.JumlahTotal-pembayarandetail.Jumlah) as
                JumlahTotal, program.NamaProgram From areacabang
                Join siswa ON siswa.cabang = areacabang.RecID
                join areacabang a ON areacabang.Area = a.KodeAreaCabang
                Join programsiswa ON siswa.RecID = programsiswa.siswa
                Join program ON program.RecID = programsiswa.program
                Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
                Join pembayaran ON pembayaran.ProgramSiswa = programsiswa.RecID
                join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
                Where program.tahunajaran = '3' and siswa.cabang != '1259' and a.NamaAreaCabang like '%%'
                and pembayarandetail.pembayaranuntuk='Pendaftaran'
                group by siswa.VirtualAccount,Siswa.MD,pembayaran.JumlahTotal, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, 
                siswa.RecID, tahunajaran.Description,pembayarandetail.Jumlah,areacabang.RecID,areacabang.kodeareacabang,
                a.NamaAreaCabang,areacabang.NamaAreaCabang) as cte2 where cte2.KodeAreaCabang=cte.KodeAreaCabang)  as JumlahBiayaBimbingan,
        (select isnull(sum(transaksibank.Nominal),0) as Uang_masuk from transaksibank
            join siswa on transaksibank.Siswa=siswa.RecID
            join programsiswa on siswa.RecID = programsiswa.Siswa
            join program on programsiswa.Program=program.RecID 
            where program.tahunajaran='3' and transaksibank.tahunajaran='3' 
            and KodeCabang=cte.KodeAreaCabang and transaksibank.Siswa is not null) as JumlahUangMasuk
                from
        (select areacabang.RecID as RecIDcbg, areacabang.kodeareacabang,areacabang.NamaAreaCabang as NamaCabang,a.NamaAreaCabang From areacabang
                join areacabang a ON areacabang.Area = a.KodeAreaCabang
                group by areacabang.RecID, areacabang.kodeareacabang,
                a.NamaAreaCabang,areacabang.NamaAreaCabang) as cte
                where KodeAreaCabang != '9999' and ((select ISNULL(sum(b.Qty),0) as Jumlah from purchreqheader a 
            join purchreqline b on a.RecId=b.Purchreqheader
            join (SELECT PurchReqId from Konfirmasipembayaran Group BY PurchReqId) c on a.PurchReqId=c.PurchReqId
            where a.Cabang=cte.RecIDcbg and a.ApprovalDate >= '2017-07-01')+ 
            (select count(siswa.RecID) from siswa 
                join programsiswa on siswa.RecID = programsiswa.Siswa
                join program on programsiswa.Program=program.RecID
                where siswa.Cabang=cte.RecIDcbg and program.tahunajaran = '3')) != 0 and NamaAreaCabang like '%%'
                group by RecIDcbg,kodeareacabang,NamaAreaCabang,NamaCabang
                order by NamaAreaCabang,KodeAreaCabang
SQL;


    protected $sql2 = <<<SQL
      select NamaAreaCabang as Area,
        (select count(areacabang.RecID) from areacabang
                join areacabang b on areacabang.Area=b.KodeAreaCabang
                where b.NamaAreaCabang=cte.NamaAreaCabang and areacabang.TanggalBerlaku <= '2015-07-01' and areacabang.TanggalBerakhir >= '2015-06-30') as JumlahCabang1516,
        (select count(siswa.RecID) from siswa 
            join programsiswa on siswa.RecID = programsiswa.Siswa
            join program on programsiswa.Program=program.RecID
            join areacabang on siswa.Cabang=areacabang.RecID
            join areacabang b on areacabang.Area=b.KodeAreaCabang
            where b.NamaAreaCabang=cte.NamaAreaCabang and program.tahunajaran = '1'  and areacabang.KodeAreaCabang != '9999') as JumlahSiswa1516,
        (select ISNULL(sum(b.Qty),0) as Jumlah from purchreqheader a 
            join purchreqline b on a.RecId=b.Purchreqheader
            join (SELECT PurchReqId from Konfirmasipembayaran Group BY PurchReqId) c on a.PurchReqId=c.PurchReqId
            join areacabang on a.Cabang=areacabang.RecID
            join areacabang d on areacabang.Area=d.KodeAreaCabang
            where d.NamaAreaCabang=cte.NamaAreaCabang and areacabang.KodeAreaCabang != '9999' and a.ApprovalDate >= '2015-07-01' AND a.ApprovalDate <= '2016-06-30') AS JumlahBuku1516,
        (SELECT isnull(sum(JumlahTotal),0) from
            (select siswa.VirtualAccount,Siswa.RecId,Siswa.MD,areacabang.RecID as RecIDCabang,areacabang.kodeareacabang,
                areacabang.NamaAreaCabang as NamaCabang,a.NamaAreaCabang as Area, siswa.NamaSiswa,siswa.cabang,
                (pembayaran.JumlahTotal-pembayarandetail.Jumlah) as
                JumlahTotal, program.NamaProgram From areacabang
                Join siswa ON siswa.cabang = areacabang.RecID
                join areacabang a ON areacabang.Area = a.KodeAreaCabang
                Join programsiswa ON siswa.RecID = programsiswa.siswa
                Join program ON program.RecID = programsiswa.program
                Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
                Join pembayaran ON pembayaran.ProgramSiswa = programsiswa.RecID
                join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
                Where program.tahunajaran = '1' and siswa.cabang != '1259'
                and pembayarandetail.pembayaranuntuk='Pendaftaran'
                group by siswa.VirtualAccount,Siswa.MD,pembayaran.JumlahTotal, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, 
                siswa.RecID, tahunajaran.Description,pembayarandetail.Jumlah,areacabang.RecID,areacabang.kodeareacabang,
                a.NamaAreaCabang,areacabang.NamaAreaCabang) as cte2 where cte2.Area=cte.NamaAreaCabang)  as JumlahBiayaBimbingan1516,
        (select isnull(sum(transaksibank.Nominal),0) as Uang_masuk from transaksibank
            join siswa on transaksibank.Siswa=siswa.RecID
            join programsiswa on siswa.RecID = programsiswa.Siswa
            join program on programsiswa.Program=program.RecID
            join areacabang on siswa.Cabang=areacabang.RecID
            join areacabang d on areacabang.Area=d.KodeAreaCabang 
            where program.tahunajaran='1' and transaksibank.tahunajaran='1' 
            and d.NamaAreaCabang=cte.NamaAreaCabang and transaksibank.Siswa is not null) as JumlahUangMasuk1516,
        (select count(areacabang.RecID) from areacabang
                join areacabang b on areacabang.Area=b.KodeAreaCabang
                where b.NamaAreaCabang=cte.NamaAreaCabang and areacabang.TanggalBerlaku <= '2016-07-01' and areacabang.TanggalBerakhir >= '2016-06-30') as JumlahCabang1617,
        (select count(siswa.RecID) from siswa 
            join programsiswa on siswa.RecID = programsiswa.Siswa
            join program on programsiswa.Program=program.RecID
            join areacabang on siswa.Cabang=areacabang.RecID
            join areacabang b on areacabang.Area=b.KodeAreaCabang
            where b.NamaAreaCabang=cte.NamaAreaCabang and program.tahunajaran = '2'  and areacabang.KodeAreaCabang != '9999') as JumlahSiswa1617,
        (select ISNULL(sum(b.Qty),0) as Jumlah from purchreqheader a 
            join purchreqline b on a.RecId=b.Purchreqheader
            join (SELECT PurchReqId from Konfirmasipembayaran Group BY PurchReqId) c on a.PurchReqId=c.PurchReqId
            join areacabang on a.Cabang=areacabang.RecID
            join areacabang d on areacabang.Area=d.KodeAreaCabang
            where d.NamaAreaCabang=cte.NamaAreaCabang and areacabang.KodeAreaCabang != '9999' and a.ApprovalDate >= '2016-07-01' AND a.ApprovalDate <= '2017-06-30') AS JumlahBuku1617,
        (SELECT isnull(sum(JumlahTotal),0) from
            (select siswa.VirtualAccount,Siswa.RecId,Siswa.MD,areacabang.RecID as RecIDCabang,areacabang.kodeareacabang,
                areacabang.NamaAreaCabang as NamaCabang,a.NamaAreaCabang as Area, siswa.NamaSiswa,siswa.cabang,
                (pembayaran.JumlahTotal-pembayarandetail.Jumlah) as
                JumlahTotal, program.NamaProgram From areacabang
                Join siswa ON siswa.cabang = areacabang.RecID
                join areacabang a ON areacabang.Area = a.KodeAreaCabang
                Join programsiswa ON siswa.RecID = programsiswa.siswa
                Join program ON program.RecID = programsiswa.program
                Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
                Join pembayaran ON pembayaran.ProgramSiswa = programsiswa.RecID
                join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
                Where program.tahunajaran = '2' and siswa.cabang != '1259'
                and pembayarandetail.pembayaranuntuk='Pendaftaran'
                group by siswa.VirtualAccount,Siswa.MD,pembayaran.JumlahTotal, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, 
                siswa.RecID, tahunajaran.Description,pembayarandetail.Jumlah,areacabang.RecID,areacabang.kodeareacabang,
                a.NamaAreaCabang,areacabang.NamaAreaCabang) as cte2 where cte2.Area=cte.NamaAreaCabang)  as JumlahBiayaBimbingan1617,
        (select isnull(sum(transaksibank.Nominal),0) as Uang_masuk from transaksibank
            join siswa on transaksibank.Siswa=siswa.RecID
            join programsiswa on siswa.RecID = programsiswa.Siswa
            join program on programsiswa.Program=program.RecID
            join areacabang on siswa.Cabang=areacabang.RecID
            join areacabang d on areacabang.Area=d.KodeAreaCabang 
            where program.tahunajaran='2' and transaksibank.tahunajaran='2' 
            and d.NamaAreaCabang=cte.NamaAreaCabang and transaksibank.Siswa is not null) as JumlahUangMasuk1617,
        (select count(areacabang.RecID) from areacabang
                join areacabang b on areacabang.Area=b.KodeAreaCabang
                where b.NamaAreaCabang=cte.NamaAreaCabang and areacabang.TanggalBerlaku <= '2017-07-01' and areacabang.TanggalBerakhir >= '2017-06-30') as JumlahCabang1718,
        (select count(siswa.RecID) from siswa 
            join programsiswa on siswa.RecID = programsiswa.Siswa
            join program on programsiswa.Program=program.RecID
            join areacabang on siswa.Cabang=areacabang.RecID
            join areacabang b on areacabang.Area=b.KodeAreaCabang
            where b.NamaAreaCabang=cte.NamaAreaCabang and program.tahunajaran = '3' and areacabang.KodeAreaCabang != '9999') as JumlahSiswa1718,
        (select ISNULL(sum(b.Qty),0) as Jumlah from purchreqheader a 
            join purchreqline b on a.RecId=b.Purchreqheader
            join (SELECT PurchReqId from Konfirmasipembayaran Group BY PurchReqId) c on a.PurchReqId=c.PurchReqId
            join areacabang on a.Cabang=areacabang.RecID
            join areacabang d on areacabang.Area=d.KodeAreaCabang
            where d.NamaAreaCabang=cte.NamaAreaCabang and areacabang.KodeAreaCabang != '9999' and a.ApprovalDate >= '2017-07-01' AND a.ApprovalDate <= '2018-06-30') AS JumlahBuku1718,
        (SELECT isnull(sum(JumlahTotal),0) from
            (select siswa.VirtualAccount,Siswa.RecId,Siswa.MD,areacabang.RecID as RecIDCabang,areacabang.kodeareacabang,
                areacabang.NamaAreaCabang as NamaCabang,a.NamaAreaCabang as Area, siswa.NamaSiswa,siswa.cabang,
                (pembayaran.JumlahTotal-pembayarandetail.Jumlah) as
                JumlahTotal, program.NamaProgram From areacabang
                Join siswa ON siswa.cabang = areacabang.RecID
                join areacabang a ON areacabang.Area = a.KodeAreaCabang
                Join programsiswa ON siswa.RecID = programsiswa.siswa
                Join program ON program.RecID = programsiswa.program
                Join tahunajaran ON tahunajaran.RecID = program.tahunajaran
                Join pembayaran ON pembayaran.ProgramSiswa = programsiswa.RecID
                join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
                Where program.tahunajaran = '3' and siswa.cabang != '1259'
                and pembayarandetail.pembayaranuntuk='Pendaftaran'
                group by siswa.VirtualAccount,Siswa.MD,pembayaran.JumlahTotal, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, 
                siswa.RecID, tahunajaran.Description,pembayarandetail.Jumlah,areacabang.RecID,areacabang.kodeareacabang,
                a.NamaAreaCabang,areacabang.NamaAreaCabang) as cte2 where cte2.Area=cte.NamaAreaCabang)  as JumlahBiayaBimbingan1718,
        (select isnull(sum(transaksibank.Nominal),0) as Uang_masuk from transaksibank
            join siswa on transaksibank.Siswa=siswa.RecID
            join programsiswa on siswa.RecID = programsiswa.Siswa
            join program on programsiswa.Program=program.RecID
            join areacabang on siswa.Cabang=areacabang.RecID
            join areacabang d on areacabang.Area=d.KodeAreaCabang 
            where program.tahunajaran='3' and transaksibank.tahunajaran='3' 
            and d.NamaAreaCabang=cte.NamaAreaCabang and transaksibank.Siswa is not null) as JumlahUangMasuk1718
                from
        (select a.NamaAreaCabang From areacabang
                join areacabang a ON areacabang.Area = a.KodeAreaCabang
                group by a.NamaAreaCabang) as cte
                group by NamaAreaCabang
                order by NamaAreaCabang
SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan Data Operasional');
        parent::initialize();
    }

    public function indexAction() {
        $this->view->rpt_title = 'Laporan Data Operasional Cabang Per-Area TA 2017/2018';
        $this->view->rpt_title2 = 'Laporan Data Operasional Area TA 2015/2016 & 2016/2017 & 2017/2018';
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('AreaID', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
    }

    public function viewAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('RptOperasional/index');
        }
       
        $this->view->rpt_title = 'Laporan Data Operasional Cabang Per-Area';
        $areaid = $this->request->getPost('AreaID');
        $area = Areacabang::findFirstByRecID($areaid);
        $areakd = $area->NamaAreaCabang;
		
        $sql = str_replace(['%%'],[$areakd], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->result = $query->fetchAll($query);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $this->view->today = date('Y-m-d');
    }    

    public function viewareaAction()
    {
        $this->view->rpt_title = 'Laporan Data Operasional Area TA 2015/2016 & 2016/2017 & 2017/2018';
        
        $sql2 = str_replace(['%%'],[$areakd], $this->sql2);
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->result2 = $query2->fetchAll($query2);
    }

//PWE
    public function pweAction() {
        $this->view->tahun = tahunajaran::find();
        $this->view->rpt_title = 'Laporan Data Operasional Cabang PWE';
$tahun_end = date('Y')+1;
        $tahun_arr = array();
        for($i=2015; $i<=$tahun_end; $i++){
            $tahun_arr[] = $i;
        }
        $this->view->tahun = $tahun_arr;
    }   

    public function viewpweAction()
    {
        $this->view->rpt_title = 'Laporan Data Operasional Cabang PWE';
        $date_start = $this->request->getPost('DateFrom');
        $date_end = $this->request->getPost('DateTo');
        
$sql = "
SELECT 
	qw1.KodeAreaCabang, 
	qw1.NamaAreaCabang, 
	qw1.TargetNilai,
	qw1.TargetPersentase,
	qw1.SisJan, 
	qw1.SisFeb, 
	qw1.SisMar, 
	qw1.SisApr, 
	qw1.SisMei, 
	qw1.SisJun, 
	qw1.SisJul, 
	qw1.SisAgu, 
	qw1.SisSep, 
	qw1.SisOkt, 
	qw1.SisNov, 
	qw1.SisDes,
    qw2.PenJan,
	qw2.PenFeb,
	qw2.PenMar,
	qw2.PenApr,
	qw2.PenMei,
	qw2.PenJun, 
	qw2.PenJul, 
	qw2.PenAgu, 
	qw2.PenSep, 
	qw2.PenOkt, 
	qw2.PenNov, 
	qw2.PenDes,
    qw3.BimJan,
	qw3.BimFeb,
	qw3.BimMar,
	qw3.BimApr,
	qw3.BimMei,
	qw3.BimJun, 
	qw3.BimJul, 
	qw3.BimAgu, 
	qw3.BimSep, 
	qw3.BimOkt, 
	qw3.BimNov, 
	qw3.BimDes,
    qw4.UangJan,
	qw4.UangFeb,
	qw4.UangMar,
	qw4.UangApr,
	qw4.UangMei,
	qw4.UangJun, 
	qw4.UangJul, 
	qw4.UangAgu, 
	qw4.UangSep, 
	qw4.UangOkt, 
	qw4.UangNov, 
	qw4.UangDes 
FROM 
    (
		SELECT 
			KodeAreaCabang,
			NamaAreaCabang,
			TargetNilai,
			TargetPersentase,
			[1] as SisJan, 
			[2] as SisFeb, 
			[3] as SisMar, 
			[4] as SisApr, 
			[5] as SisMei, 
			[6] as SisJun, 
			[7] as SisJul, 
			[8] as SisAgu, 
			[9] as SisSep, 
			[10] as SisOkt, 
			[11] as SisNov, 
			[12] as SisDes
        FROM 
			(
				SELECT 
					d.KodeAreaCabang,
					d.NamaAreaCabang, 
					f.Nilai as TargetNilai,
					f.Persentase as TargetPersentase,
					a.recid, 
					MONTH(a.CreatedAt) as bulan
				FROM 
					siswa a
				/*JOIN 
					programsiswa b 
					on 
						a.RecID = b.Siswa
				JOIN 
					program c 
					on 
						b.Program=c.RecID
						*/
				JOIN 
					areacabang d 
					on 
						a.Cabang=d.RecID
				JOIN 
					CabangPWE e 
					on 
						d.KodeAreaCabang=e.KodeCabang
				JOIN 
					PWE_Target f
					ON 
						f.CabangPWE = e.RecID 
                        AND f.Tahun = 2018 
				WHERE 
					d.KodeAreaCabang IN ('0854','0405','0005','0829','0296','0571','0834') 
					and 
					cast(a.CreatedAt as date) between '$date_start' and '$date_end'
			) src
        PIVOT
			(
				count(recid)
				for bulan in ([1], [2], [3], [4], [5], [6], [7], [8], [9], [10], [11], [12])
			) piv
	) qw1,
    (
		SELECT 
			KodeAreaCabang,
			NamaCabang,
			[1] as PenJan, 
			[2] as PenFeb, 
			[3] as PenMar, 
			[4] as PenApr, 
			[5] as PenMei, 
			[6] as PenJun, 
			[7] as PenJul, 
			[8] as PenAgu, 
			[9] as PenSep, 
			[10] as PenOkt, 
			[11] as PenNov, 
			[12] as PenDes
		FROM 
			(
                SELECT 
					KodeAreaCabang,
					NamaCabang,
					isnull(sum(JumlahTotal),0) as jumlah, 
					month(TanggalPembayaran) as bulan 
				FROM
                    (
						SELECT
							c.KodeAreaCabang,
							c.NamaAreaCabang AS NamaCabang,	
							pd.Jumlah as JumlahTotal,
							pd.TanggalPembayaran
						FROM 
							siswa s
						JOIN 
							programsiswa ps 
							ON 
								s.RecID = ps.Siswa
						JOIN 
							pembayaran pb 
							ON 
								ps.RecID = pb.ProgramSiswa
						JOIN 
							pembayarandetail pd 
							ON 
								pb.RecID = pd.Pembayaran
						JOIN 
							program p 
							ON 
								ps.Program = p.RecID
						JOIN 
							jenjang j 
							ON 
								p.Jenjang = j.KodeJenjang
						JOIN 
							areacabang c 
							ON 
								s.Cabang = c.RecID
						JOIN 
							areacabang a 
							ON 
								a.KodeAreaCabang = c.Area
						WHERE 
							pd.PembayaranUntuk = 'Pendaftaran'
							AND pd.TanggalPembayaran between '$date_start' and '$date_end'
							and c.KodeAreaCabang IN ('0854','0405','0005','0829','0296','0571','0834') 
					) as cte2
                GROUP BY 
					KodeAreaCabang,
					NamaCabang,
					month(TanggalPembayaran)
			) src
        PIVOT
			(
				sum(jumlah)
				for bulan in ([1], [2], [3], [4], [5], [6], [7], [8], [9], [10], [11], [12])
			) piv
	) as qw2,
    (
		SELECT 
			KodeAreaCabang,
			NamaCabang,
			[1] as BimJan, 
			[2] as BimFeb, 
			[3] as BimMar, 
			[4] as BimApr, 
			[5] as BimMei, 
			[6] as BimJun, 
			[7] as BimJul, 
			[8] as BimAgu, 
			[9] as BimSep, 
			[10] as BimOkt, 
			[11] as BimNov, 
			[12] as BimDes
		FROM 
			(
                SELECT 
					KodeAreaCabang,
					NamaCabang,
					isnull(sum(JumlahTotal),0) as jumlah, 
					month(TanggalPembayaran) as bulan 
				FROM
                    (
						SELECT
							c.KodeAreaCabang,
							c.NamaAreaCabang AS NamaCabang,	
							pd.SisaPembayaran as JumlahTotal,
							pd.TanggalPembayaran
						FROM 
							siswa s
						JOIN 
							programsiswa ps 
							ON 
								s.RecID = ps.Siswa
						JOIN 
							pembayaran pb 
							ON 
								ps.RecID = pb.ProgramSiswa
						JOIN 
							pembayarandetail pd 
							ON 
								pb.RecID = pd.Pembayaran
						JOIN 
							program p 
							ON 
								ps.Program = p.RecID
						JOIN 
							jenjang j 
							ON 
								p.Jenjang = j.KodeJenjang
						JOIN 
							areacabang c 
							ON 
								s.Cabang = c.RecID
						JOIN 
							areacabang a 
							ON 
								a.KodeAreaCabang = c.Area
						WHERE 
							pd.PembayaranUntuk = 'Pendaftaran'
							AND pd.TanggalPembayaran between '$date_start' and '$date_end'
							and c.KodeAreaCabang IN ('0854','0405','0005','0829','0296','0571','0834')
					) as cte2
                GROUP BY 
					KodeAreaCabang,
					NamaCabang,
					month(TanggalPembayaran)
			) src
        PIVOT
			(
				sum(jumlah)
				for bulan in ([1], [2], [3], [4], [5], [6], [7], [8], [9], [10], [11], [12])
			) piv
	) as qw3,
    (
		SELECT 
			KodeAreaCabang,
			NamaAreaCabang,[1] as UangJan, 
			[2] as UangFeb, 
			[3] as UangMar, 
			[4] as UangApr, 
			[5] as UangMei, 
			[6] as UangJun, 
			[7] as UangJul, 
			[8] as UangAgu, 
			[9] as UangSep, 
			[10] as UangOkt, 
			[11] as UangNov, 
			[12] as UangDes
        FROM 
			(
				SELECT 
					a.KodeAreaCabang,
					a.NamaAreaCabang,
					isnull(sum(transaksibank.Nominal),0) as jumlah, 
					month(TanggalTransaksi) as bulan 
				FROM 
					transaksibank
                JOIN 
					siswa 
					on 
						transaksibank.Siswa=siswa.RecID
                JOIN 
					programsiswa 
					on 
						siswa.RecID = programsiswa.Siswa
                JOIN 
					program 
					on 
						programsiswa.Program=program.RecID 
                JOIN 
					areacabang a 
					on 
						siswa.Cabang=a.RecID
                JOIN 
					CabangPWE c 
					on 
						a.KodeAreaCabang=c.KodeCabang
                WHERE 
					transaksibank.KodeCabang IN ('0854','0405','0005','0829','0296','0571','0834')
					and cast(transaksibank.TanggalTransaksi as date) between '$date_start' and '$date_end'
					and transaksibank.Siswa is not null
                GROUP BY 
					a.KodeAreaCabang,
					a.NamaAreaCabang,
					month(TanggalTransaksi)
			) src
        PIVOT
			(
				sum(jumlah)
				for bulan in ([1], [2], [3], [4], [5], [6], [7], [8], [9], [10], [11], [12])
			) piv
	) as qw4
WHERE 
	qw1.KodeAreaCabang=qw2.KodeAreaCabang 
	and qw1.KodeAreaCabang=qw3.KodeAreaCabang 
	and qw1.KodeAreaCabang=qw4.KodeAreaCabang
";

$sql_ = "
SELECT 
	qw1.KodeAreaCabang, 
	qw1.NamaAreaCabang, 
	qw1.TargetNilai,
	qw1.TargetPersentase,
	qw1.SisJan, 
	qw1.SisFeb, 
	qw1.SisMar, 
	qw1.SisApr, 
	qw1.SisMei, 
	qw1.SisJun, 
	qw1.SisJul, 
	qw1.SisAgu, 
	qw1.SisSep, 
	qw1.SisOkt, 
	qw1.SisNov, 
	qw1.SisDes,
    qw2.PenJan,
	qw2.PenFeb,
	qw2.PenMar,
	qw2.PenApr,
	qw2.PenMei,
	qw2.PenJun, 
	qw2.PenJul, 
	qw2.PenAgu, 
	qw2.PenSep, 
	qw2.PenOkt, 
	qw2.PenNov, 
	qw2.PenDes,
    qw3.BimJan,
	qw3.BimFeb,
	qw3.BimMar,
	qw3.BimApr,
	qw3.BimMei,
	qw3.BimJun, 
	qw3.BimJul, 
	qw3.BimAgu, 
	qw3.BimSep, 
	qw3.BimOkt, 
	qw3.BimNov, 
	qw3.BimDes,
    qw4.UangJan,
	qw4.UangFeb,
	qw4.UangMar,
	qw4.UangApr,
	qw4.UangMei,
	qw4.UangJun, 
	qw4.UangJul, 
	qw4.UangAgu, 
	qw4.UangSep, 
	qw4.UangOkt, 
	qw4.UangNov, 
	qw4.UangDes 
FROM 
    (
		SELECT 
			KodeAreaCabang,
			NamaAreaCabang,
			TargetNilai,
			TargetPersentase,
			[1] as SisJan, 
			[2] as SisFeb, 
			[3] as SisMar, 
			[4] as SisApr, 
			[5] as SisMei, 
			[6] as SisJun, 
			[7] as SisJul, 
			[8] as SisAgu, 
			[9] as SisSep, 
			[10] as SisOkt, 
			[11] as SisNov, 
			[12] as SisDes
        FROM 
			(
				SELECT 
					d.KodeAreaCabang,
					d.NamaAreaCabang, 
					f.Nilai as TargetNilai,
					f.Persentase as TargetPersentase,
					a.recid, 
					MONTH(a.CreatedAt) as bulan
				FROM 
					siswa a
				JOIN 
					programsiswa b 
					on 
						a.RecID = b.Siswa
				JOIN 
					program c 
					on 
						b.Program=c.RecID
				JOIN 
					areacabang d 
					on 
						a.Cabang=d.RecID
				JOIN 
					CabangPWE e 
					on 
						d.KodeAreaCabang=e.KodeCabang
				JOIN 
					PWE_Target f
					ON 
						f.CabangPWE = e.RecID 
                        AND f.Tahun = 2018 
				WHERE 
					d.KodeAreaCabang IN ('0854','0405','0005','0829','0296','0571','0834') 
					and 
					cast(a.CreatedAt as date) between '$date_start' and '$date_end'
			) src
        PIVOT
			(
				count(recid)
				for bulan in ([1], [2], [3], [4], [5], [6], [7], [8], [9], [10], [11], [12])
			) piv
	) qw1,
    (
		SELECT 
			KodeAreaCabang,
			NamaCabang,
			[1] as PenJan, 
			[2] as PenFeb, 
			[3] as PenMar, 
			[4] as PenApr, 
			[5] as PenMei, 
			[6] as PenJun, 
			[7] as PenJul, 
			[8] as PenAgu, 
			[9] as PenSep, 
			[10] as PenOkt, 
			[11] as PenNov, 
			[12] as PenDes
		FROM 
			(
                SELECT 
					KodeAreaCabang,
					NamaCabang,
					isnull(sum(JumlahTotal),0) as jumlah, 
					month(CreatedAt) as bulan 
				FROM
                    (
						SELECT 
							areacabang.KodeAreaCabang,
							areacabang.NamaAreaCabang as NamaCabang,
							pembayarandetail.Jumlah as JumlahTotal, 
							siswa.CreatedAt
						FROM 
							areacabang
                        JOIN 
							siswa 
							ON 
								siswa.cabang = areacabang.RecID
                        JOIN 
							areacabang a 
							ON 
								areacabang.Area = a.KodeAreaCabang
                        JOIN 
							CabangPWE 
							ON 
								areacabang.KodeAreaCabang = CabangPWE.KodeCabang
                        JOIN 
							programsiswa 
							ON 
								siswa.RecID = programsiswa.siswa
                        JOIN 
							program 
							ON 
								program.RecID = programsiswa.program
                        JOIN 
							tahunajaran 
							ON 
								tahunajaran.RecID = program.tahunajaran
                        JOIN 
							pembayaran 
							ON 
								pembayaran.ProgramSiswa = programsiswa.RecID
                        JOIN 
							pembayarandetail 
							ON 
								pembayaran.RecID=pembayarandetail.Pembayaran 
                        WHERE 
							areacabang.KodeAreaCabang IN ('0854','0405','0005','0829','0296','0571','0834') 
							and cast(siswa.CreatedAt as date) between '$date_start' and '$date_end'
							and 
							siswa.cabang != '1259'
							and pembayarandetail.pembayaranuntuk='Pendaftaran'
                        GROUP BY 
							 
							pembayarandetail.Jumlah,
							areacabang.KodeAreaCabang,
							areacabang.NamaAreaCabang,
							siswa.CreatedAt
					) as cte2
                GROUP BY 
					KodeAreaCabang,
					NamaCabang,
					month(CreatedAt)
			) src
        PIVOT
			(
				sum(jumlah)
				for bulan in ([1], [2], [3], [4], [5], [6], [7], [8], [9], [10], [11], [12])
			) piv
	) as qw2,
    (
		SELECT 
			KodeAreaCabang,
			NamaCabang,
			[1] as BimJan, 
			[2] as BimFeb, 
			[3] as BimMar, 
			[4] as BimApr, 
			[5] as BimMei, 
			[6] as BimJun, 
			[7] as BimJul, 
			[8] as BimAgu, 
			[9] as BimSep, 
			[10] as BimOkt, 
			[11] as BimNov, 
			[12] as BimDes
		FROM 
			(
                SELECT 
					KodeAreaCabang,
					NamaCabang,
					isnull(sum(JumlahTotal),0) as jumlah, 
					month(CreatedAt) as bulan 
				FROM
                    (
						SELECT
							areacabang.KodeAreaCabang,
							areacabang.NamaAreaCabang as NamaCabang,
							(pembayaran.JumlahTotal-pembayarandetail.Jumlah) as JumlahTotal, 
							siswa.CreatedAt
						FROM 
							areacabang
                        JOIN 
							siswa 
							ON 
								siswa.cabang = areacabang.RecID
                        JOIN 
							areacabang a 
							ON 
								areacabang.Area = a.KodeAreaCabang
                        JOIN 
							CabangPWE 
							ON 
								areacabang.KodeAreaCabang = CabangPWE.KodeCabang
                        JOIN 
							programsiswa 
							ON 
								siswa.RecID = programsiswa.siswa
                        JOIN 
							program 
							ON 
								program.RecID = programsiswa.program
                        JOIN 
							tahunajaran 
							ON 
								tahunajaran.RecID = program.tahunajaran
                        JOIN 
							pembayaran 
							ON 
								pembayaran.ProgramSiswa = programsiswa.RecID
                        JOIN 
							pembayarandetail 
							ON 
								pembayaran.RecID=pembayarandetail.Pembayaran 
                        WHERE 
							areacabang.KodeAreaCabang IN ('0854','0405','0005','0829','0296','0571','0834')  
							and cast(siswa.CreatedAt as date) between '$date_start' and '$date_end'
							and siswa.cabang != '1259'
							and pembayarandetail.pembayaranuntuk='Bimbingan'
                        GROUP BY 
							pembayaran.JumlahTotal, 
							pembayarandetail.Jumlah,
							areacabang.KodeAreaCabang,
							areacabang.NamaAreaCabang,
							siswa.CreatedAt
					) as cte2
                GROUP BY 
					KodeAreaCabang,
					NamaCabang,
					month(CreatedAt)
			) src
        PIVOT
			(
				sum(jumlah)
				for bulan in ([1], [2], [3], [4], [5], [6], [7], [8], [9], [10], [11], [12])
			) piv
	) as qw3,
    (
		SELECT 
			KodeAreaCabang,
			NamaAreaCabang,[1] as UangJan, 
			[2] as UangFeb, 
			[3] as UangMar, 
			[4] as UangApr, 
			[5] as UangMei, 
			[6] as UangJun, 
			[7] as UangJul, 
			[8] as UangAgu, 
			[9] as UangSep, 
			[10] as UangOkt, 
			[11] as UangNov, 
			[12] as UangDes
        FROM 
			(
				SELECT 
					a.KodeAreaCabang,
					a.NamaAreaCabang,
					isnull(sum(transaksibank.Nominal),0) as jumlah, 
					month(TanggalTransaksi) as bulan 
				FROM 
					transaksibank
                JOIN 
					siswa 
					on 
						transaksibank.Siswa=siswa.RecID
                JOIN 
					programsiswa 
					on 
						siswa.RecID = programsiswa.Siswa
                JOIN 
					program 
					on 
						programsiswa.Program=program.RecID 
                JOIN 
					areacabang a 
					on 
						siswa.Cabang=a.RecID
                JOIN 
					CabangPWE c 
					on 
						a.KodeAreaCabang=c.KodeCabang
                WHERE 
					transaksibank.KodeCabang IN ('0854','0405','0005','0829','0296','0571','0834')
					and cast(transaksibank.TanggalTransaksi as date) between '$date_start' and '$date_end'
					and transaksibank.Siswa is not null
                GROUP BY 
					a.KodeAreaCabang,
					a.NamaAreaCabang,
					month(TanggalTransaksi)
			) src
        PIVOT
			(
				sum(jumlah)
				for bulan in ([1], [2], [3], [4], [5], [6], [7], [8], [9], [10], [11], [12])
			) piv
	) as qw4
WHERE 
	qw1.KodeAreaCabang=qw2.KodeAreaCabang 
	and qw1.KodeAreaCabang=qw3.KodeAreaCabang 
	and qw1.KodeAreaCabang=qw4.KodeAreaCabang
";

$sql__ = "
            SELECT 
    qw1.KodeAreaCabang, 
    qw1.NamaAreaCabang, 
    qw1.TargetNilai,
    qw1.TargetPersentase,
    qw1.SisJan, 
    qw1.SisFeb, 
    qw1.SisMar, 
    qw1.SisApr, 
    qw1.SisMei, 
    qw1.SisJun, 
    qw1.SisJul, 
    qw1.SisAgu, 
    qw1.SisSep, 
    qw1.SisOkt, 
    qw1.SisNov, 
    qw1.SisDes,
    qw3.BimJan,
    qw3.BimFeb,
    qw3.BimMar,
    qw3.BimApr,
    qw3.BimMei,
    qw3.BimJun, 
    qw3.BimJul, 
    qw3.BimAgu, 
    qw3.BimSep, 
    qw3.BimOkt, 
    qw3.BimNov, 
    qw3.BimDes,
    qw4.UangJan,
    qw4.UangFeb,
    qw4.UangMar,
    qw4.UangApr,
    qw4.UangMei,
    qw4.UangJun, 
    qw4.UangJul, 
    qw4.UangAgu, 
    qw4.UangSep, 
    qw4.UangOkt, 
    qw4.UangNov, 
    qw4.UangDes 
FROM 
    (
        SELECT 
            KodeAreaCabang,
            NamaAreaCabang,
            TargetNilai,
            TargetPersentase,
            [1] as SisJan, 
            [2] as SisFeb, 
            [3] as SisMar, 
            [4] as SisApr, 
            [5] as SisMei, 
            [6] as SisJun, 
            [7] as SisJul, 
            [8] as SisAgu, 
            [9] as SisSep, 
            [10] as SisOkt, 
            [11] as SisNov, 
            [12] as SisDes
        FROM 
            (
                SELECT 
                    d.KodeAreaCabang,
                    d.NamaAreaCabang, 
                    f.Nilai as TargetNilai,
                    f.Persentase as TargetPersentase,
                    a.recid, 
                    MONTH(a.CreatedAt) as bulan
                FROM 
                    siswa a
                JOIN 
                    programsiswa b 
                    on 
                        a.RecID = b.Siswa
                JOIN 
                    program c 
                    on 
                        b.Program=c.RecID
                JOIN 
                    areacabang d 
                    on 
                        a.Cabang=d.RecID
                JOIN 
                    CabangPWE e 
                    on 
                        d.KodeAreaCabang=e.KodeCabang
                JOIN 
                    PWE_Target f
                    ON 
                        f.CabangPWE = e.RecID 
                        AND f.Tahun = 2018 
                JOIN
                    transaksibank
                    ON
                        transaksibank.Siswa = a.RecID
                WHERE 
                    
                    year(a.CreatedAt) between '$dari_tahun/01/01' and '$sampai_tahun/12/31'
            ) src
        PIVOT
            (
                count(recid)
                for bulan in ([1], [2], [3], [4], [5], [6], [7], [8], [9], [10], [11], [12])
            ) piv
    ) qw1,
    (
        SELECT 
            KodeAreaCabang,
            NamaCabang,
            [1] as BimJan, 
            [2] as BimFeb, 
            [3] as BimMar, 
            [4] as BimApr, 
            [5] as BimMei, 
            [6] as BimJun, 
            [7] as BimJul, 
            [8] as BimAgu, 
            [9] as BimSep, 
            [10] as BimOkt, 
            [11] as BimNov, 
            [12] as BimDes
        FROM 
            (
                SELECT 
                    KodeAreaCabang,
                    NamaCabang,
                    isnull(sum(JumlahTotal),0) as jumlah, 
                    month(CreatedAt) as bulan 
                FROM
                    (
                        SELECT 
                            siswa.VirtualAccount,
                            Siswa.RecId,
                            Siswa.MD,
                            areacabang.RecID as RecIDCabang,
                            areacabang.kodeareacabang,
                            areacabang.NamaAreaCabang as NamaCabang,
                            a.NamaAreaCabang, 
                            siswa.NamaSiswa,
                            siswa.cabang,
                            (pembayaran.JumlahTotal-pembayarandetail.Jumlah) as JumlahTotal, 
                            program.NamaProgram,
                            siswa.CreatedAt 
                        FROM 
                            areacabang
                        JOIN 
                            siswa 
                            ON 
                                siswa.cabang = areacabang.RecID
                        JOIN 
                            areacabang a 
                            ON 
                                areacabang.Area = a.KodeAreaCabang
                        JOIN 
                            CabangPWE 
                            ON 
                                areacabang.KodeAreaCabang = CabangPWE.KodeCabang
                        JOIN 
                            programsiswa 
                            ON 
                                siswa.RecID = programsiswa.siswa
                        JOIN 
                            program 
                            ON 
                                program.RecID = programsiswa.program
                        JOIN 
                            tahunajaran 
                            ON 
                                tahunajaran.RecID = program.tahunajaran
                        JOIN 
                            pembayaran 
                            ON 
                                pembayaran.ProgramSiswa = programsiswa.RecID
                        JOIN 
                            pembayarandetail 
                            ON 
                                pembayaran.RecID=pembayarandetail.Pembayaran 
                        JOIN 
                            transaksibank 
                            ON
                                transaksibank.Siswa = siswa.RecID
                        WHERE 
                             
                            year(pembayarandetail.TanggalPembayaran) between '$dari_tahun/01/01' and '$sampai_tahun/12/31'
                            and 
                            siswa.cabang != '1259'
                            and pembayarandetail.pembayaranuntuk!='Pendaftaran'
                        GROUP BY 
                            siswa.VirtualAccount,
                            Siswa.MD,
                            pembayaran.JumlahTotal, 
                            siswa.NamaSiswa, 
                            program.NamaProgram, 
                            siswa.cabang, 
                            siswa.RecID, 
                            tahunajaran.Description,
                            pembayarandetail.Jumlah,
                            areacabang.RecID,
                            areacabang.kodeareacabang,
                            a.NamaAreaCabang,
                            areacabang.NamaAreaCabang,
                            siswa.CreatedAt
                    ) as cte2
                GROUP BY 
                    KodeAreaCabang,
                    NamaCabang,
                    month(CreatedAt)
            ) src
        PIVOT
            (
                sum(jumlah)
                for bulan in ([1], [2], [3], [4], [5], [6], [7], [8], [9], [10], [11], [12])
            ) piv
    ) as qw3,
    (
        SELECT 
            KodeAreaCabang,
            NamaAreaCabang,[1] as UangJan, 
            [2] as UangFeb, 
            [3] as UangMar, 
            [4] as UangApr, 
            [5] as UangMei, 
            [6] as UangJun, 
            [7] as UangJul, 
            [8] as UangAgu, 
            [9] as UangSep, 
            [10] as UangOkt, 
            [11] as UangNov, 
            [12] as UangDes
        FROM 
            (
                SELECT 
                    a.KodeAreaCabang,
                    a.NamaAreaCabang,
                    isnull(sum(transaksibank.Nominal),0) as jumlah, 
                    month(TanggalTransaksi) as bulan 
                FROM 
                    transaksibank
                JOIN 
                    siswa 
                    on 
                        transaksibank.Siswa=siswa.RecID
                JOIN 
                    programsiswa 
                    on 
                        siswa.RecID = programsiswa.Siswa
                JOIN 
                    program 
                    on 
                        programsiswa.Program=program.RecID 
                JOIN 
                    areacabang a 
                    on 
                        siswa.Cabang=a.RecID
                JOIN 
                    CabangPWE c 
                    on 
                        a.KodeAreaCabang=c.KodeCabang
                WHERE 
                    
                    year(transaksibank.TanggalTransaksi) between '$dari_tahun/01/01' and '$sampai_tahun/12/31'
                    and transaksibank.Siswa is not null
                GROUP BY 
                    a.KodeAreaCabang,
                    a.NamaAreaCabang,
                    month(TanggalTransaksi)
            ) src
        PIVOT
            (
                sum(jumlah)
                for bulan in ([1], [2], [3], [4], [5], [6], [7], [8], [9], [10], [11], [12])
            ) piv
    ) as qw4
WHERE 
    qw1.KodeAreaCabang=qw3.KodeAreaCabang 
    and qw1.KodeAreaCabang=qw4.KodeAreaCabang

            ";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->result = $query->fetchAll($query);
        $tahunajaran = tahunajaran::findFirstByRecID($tahun);
        $this->view->tahun = $tahunajaran->Description;

    }
	
}
