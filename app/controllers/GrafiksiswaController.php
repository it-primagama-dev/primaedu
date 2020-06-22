<?php
 
class GrafiksiswaController extends ControllerBase
{

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Grafik Siswa");
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
    }

    function get_indo_bulan($bln = '') {
        $data = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        if (empty($bln)) {
            return $data;
        } else {
            $bln = (int)$bln;
            return $data[$bln];
        }
    }

    function tgl_indo($tgl = '') {
        if (!empty($tgl)) {
            $pisah = explode('-', $tgl);
            return $pisah[2].' '.$this->get_indo_bulan($pisah[1]).' '.$pisah[0];
        }
    }

    public function indexAction()
    {
        
        	$tahun = $this->request->getPost('tahun') ? $this->request->getPost('tahun'):'2017';
        	$this->view->tahun = $tahun;
		
    }
	
	public function load_drildownAction()
	{
		$this->view->disable();
		header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
		
		$id 	= $_GET['id'];
		$pisah    = explode('-', $id);
        $thn 	= $pisah[1];
		$bln 	= $pisah[0];
		
		$sql = "SELECT d.number as tgl,isnull(jml,0) as jml,created_at
		from (
		 select number
		 from    master.dbo.spt_values 
		 where type = 'P' and number between 1 and 31
		) d
		left join (
			SELECT isnull(COUNT(siswa.RecID),0) as jml,day(pembayarandetail.TanggalPembayaran) AS tgl,cast(pembayarandetail.TanggalPembayaran as date) as created_at
			from siswa
			join programsiswa on siswa.RecID=programsiswa.Siswa
			join pembayaran on programsiswa.RecID=pembayaran.ProgramSiswa
			join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
			where pembayarandetail.PembayaranUntuk='Pendaftaran' and year(TanggalPembayaran)='".$thn."'
			and MONTH(pembayarandetail.TanggalPembayaran) = '".$bln."'
			group by day(pembayarandetail.TanggalPembayaran),month(pembayarandetail.TanggalPembayaran),pembayarandetail.TanggalPembayaran
		) s on d.number = s.tgl order by d.number asc";
		$query = $this->getDI()->getShared('db')->query($sql);
		$query->setFetchMode(Phalcon\Db::FETCH_OBJ);

		$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$base_url .= "://".$_SERVER['HTTP_HOST'];
		$base_url .= str_replace(array(basename($_SERVER['SCRIPT_NAME']),"public/"),"",$_SERVER['SCRIPT_NAME'])."grafiksiswa/daftarDrildown?id=";

		$i = 1;
		foreach($query->fetchAll($query) as $result){
			$row[] = array(
				'name' => '<a href="'.$base_url.$result->created_at.'">tgl - '.$result->tgl.'</a>',
				'y' => (float)$result->jml
			);
			$i++;
		}
		echo json_encode($row);
	}

	public function daftarDrildownAction()
	{
		if ($this->auth['username']=='ridwan.sobar' || $this->auth['username']=='rini' || $this->auth['username']=='admin.pusat')
		{
			$this->view->tahun = $_GET['id'];
		} else {
			return $this->forward();
		}
	}

	public function loadDataAction()
    {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        
        $sql = "SELECT
		siswa.VirtualAccount as NIS
		,NamaSiswa,Jenjang.NamaJenjang as Jenjang
		,case when siswa.MD=0 then 'Ya' else 'Tidak' end as MD
		,areacabang.KodeAreaCabang
		,areacabang.NamaAreaCabang
		,cast(TanggalPembayaran as date) as created_at
		from siswa
		join programsiswa on siswa.RecID=programsiswa.Siswa
		join jenjang on siswa.Jenjang=jenjang.KodeJenjang
		join areacabang on siswa.Cabang=areacabang.RecID
		join pembayaran on programsiswa.RecID=pembayaran.ProgramSiswa
		join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
		where pembayarandetail.PembayaranUntuk='Pendaftaran' and cast(TanggalPembayaran as date)='".$_GET['tahun']."'";
		$query = $this->getDI()->getShared('db')->query($sql);
		$query->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$result = $query->fetchAll($query);

        $no = 1;
        $output = array('data' => array());
        foreach($result as $row) {
        	if ($row->MD=='Tidak') {
        		$md = $row->MD;
        	} else {
        		$md = '<span style="color:red">'.$row->MD.'</span>';
        	}
            $output['data'][] = array(
                $no,
                $row->NIS,
                $row->NamaSiswa,
                $row->Jenjang,
                $md,
                $row->KodeAreaCabang,
                $row->NamaAreaCabang,
                $this->tgl_indo(date('Y-m-d',strtotime($row->created_at)))
            );
            $no++;
        }
        print json_encode($output, JSON_NUMERIC_CHECK);
    }

    public function load_dataAction()
    {
    	$this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
		$tahun = $_GET['tahun'] ? $_GET['tahun']:'2017';
        $sql = "
		SELECT m.number as mth,concat(m.number,'-',thn) as drildown,DATENAME(MONTH, cast('".$tahun."'*100+number as varchar) + '01') as nama_bulan,isnull(total_siswa,0) as total_siswa
		from (
		 select number
		 from    master.dbo.spt_values 
		 where type = 'P' and number between 1 and 12
		) m
		left join (
			select   MONTH(pembayarandetail.TanggalPembayaran) as bulan_pembayaran,count(siswa.RecID) as total_siswa,year(TanggalPembayaran) as thn
			from siswa
			join programsiswa on siswa.RecID=programsiswa.Siswa
			join pembayaran on programsiswa.RecID=pembayaran.ProgramSiswa
			join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
			where pembayarandetail.PembayaranUntuk='Pendaftaran' and year(TanggalPembayaran)='".$tahun."'
			group by MONTH(pembayarandetail.TanggalPembayaran),YEAR(pembayarandetail.TanggalPembayaran)
		) s on m.number = s.bulan_pembayaran
		order by mth asc
		";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
		$i = 1;
        foreach($query->fetchAll($query) as $result){
            $row[] = array(
                'drilldown' => $result->drildown,
                'name' => $result->nama_bulan,
                'y' => (float)$result->total_siswa
            );
            $i++;
        }
        print json_encode($row, JSON_NUMERIC_CHECK);
    }
	
}
