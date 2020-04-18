<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	private $db2 = "TPrimaEdu_Prod.dbo.";

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('config_model');
    } 

	public function index()
	{	
		restrict();
	}

	public function get_area()
	{
		$arr = array(
				'from' => $this->db2.'areacabang a',
				'where' => 'a.Area is null',
				'order_by' => array('a.KodeAreaCabang' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function get_cabang()
	{
		$arr = array(
				'from' => $this->db2.'areacabang a',
				'where' => 'a.Area is not null',
				'order_by' => array('a.KodeAreaCabang' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function Smartbook()
	{
		restrict();
			$data['breadcrumb_1'] = '<a href="#">Laporan Pemesanan Buku</a>';
			$this->template->set('title', 'Laporan Pemesanan Buku');
			$this->template->load('template', 'Report/Smartbook',$data);
	}

	public function find_smartbook()
	{
		$token = base64_decode($this->input->post('token'));
		$cabang = base64_decode($this->input->post('cabang'));
		$area = base64_decode($this->input->post('area'));
		$tglawal = date('Y-m-d',strtotime(base64_decode($this->input->post('tglawal'))));
		$tglakhir = date('Y-m-d',strtotime(base64_decode($this->input->post('tglakhir'))));
		$tglawalp = date('Y-m-d',strtotime(base64_decode($this->input->post('tglawalp'))));
		$tglakhirp = date('Y-m-d',strtotime(base64_decode($this->input->post('tglakhirp'))));/*
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {*/
			if($cabang != "- - Pilih Cabang - -"){
			$where = "c.KodeAreaCabang = '$cabang' AND b.Status = 2 OR c.KodeAreaCabang = '$cabang' AND b.Status = 3";
			} else if($area != "- - Pilih Area - -") {
			$where = "d.NamaAreaCabang = '$area' AND b.Status = 2 OR d.NamaAreaCabang = '$area' AND b.Status = 3";
			} else if($tglawal != "1970-01-01" && $tglakhir != '1970-01-01') {
			$where = "convert(date, STUFF(STUFF(STUFF(f.PAYMENTDATETIME,13,0,':'),11,0,':'),9,0,' ')) between '$tglawal' and '$tglakhir'";
			} else {
			$where = "b.PR_Date between '$tglawalp' and '$tglakhirp' AND b.Status = 3 OR b.PR_Date between '$tglawalp' and '$tglakhirp' AND b.Status = 2";
			}
			//$where = "a.PR_Number = 'PR2019-9999-78'";
			$item = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'g.PackCode',
					'a.ItemCode',
					'a.Quantity',
					'a.Price',
					'(select Sum(i.Price) from Logistics_PODetail i where i.PR_Number=a.PR_Number AND i.PackCode=a.PackCode) AS PricePack',
					'(select Sum(i.DelivFee) from Logistics_PODetail i where i.PR_Number=a.PR_Number AND i.PackCode=a.PackCode) AS DelivFee',
					'((select Sum(i.Price) from Logistics_PODetail i where i.PR_Number=a.PR_Number AND i.PackCode=a.PackCode)+(select Sum(i.DelivFee) from Logistics_PODetail i where i.PR_Number=a.PR_Number AND i.PackCode=a.PackCode))*a.Quantity AS TotalPrice',
					'b.PR_Date',
					'b.PR_Number',
					'e.Invoice_Number',
					'f.PAYMENTDATETIME as Pay_Date',
					"(c.KodeAreaCabang+'-'+c.NamaAreaCabang) as BranchCode",
					'd.NamaAreaCabang as Area'
				),
				'from' => 'Logistics_PODetail a',
				'join' => array(
					'Logistics_POHeader b' => array(
						'on' => 'a.PR_Number=b.PR_Number',
						'type' => 'inner'
					),
					'Logistics_Invoice e' => array(
						'on' => 'b.PR_Number=e.PR_Number',
						'type' => 'inner'
					),
					'Logistics_Transactions f' => array(
						'on' => 'e.Invoice_Number=f.TRANSIDMERCHANT',
						'type' => 'inner'
					),
					$this->db2.'areacabang c' => array(
						'on' => 'b.BranchCode=c.KodeAreaCabang',
						'type' => 'inner',
					),
					$this->db2.'areacabang d' => array(
						'on' => 'c.Area=d.KodeAreaCabang',
						'type' => 'left',
					),
					'Logistics_PackageItem g' => array(
						'on' => 'a.PackCode=g.RecID',
						'type' => 'inner'
					),
					'Logistics_MasterItem h' => array(
						'on' => 'a.ItemCode=h.ItemCode',
						'type' => 'inner'
					),
				),
				'where' => $where,
				'order_by' => array('b.RecID' => '','g.RecID'=>'','h.RecID'=>'')
			));
			$data['data'] = $item->result_array();
			echo json_encode($data);
		/*} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}

    // DOWNLOAD TXTX INI DI PAKAI UNTUK TABEL MANA
	public function downloadFile(){ 
        $yourFile = "Sample-Format.txt";
        $file = @fopen($yourFile, "rb");

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=ContohFileDownload.txt');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($yourFile));
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }
    }
}