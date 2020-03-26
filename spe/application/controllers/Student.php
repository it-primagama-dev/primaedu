<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
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
		$data['breadcrumb_1'] = '<a href="'.base_url().'Student">Penyerahan Buku</a>';
		$this->template->set('title', 'Penyerahan Buku');
		$this->template->load('template', 'Student/StudentBC',$data);
	}
	
	public function find_student()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$KS = base64_decode($this->input->get('KS'));
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'a.NamaSiswa as siswa', 
					'd.NamaProgram as program',
					'd.Jenjang as Stage',
					'a.CreatedAt as tgldaftar',
					'c.TanggalTerima as tglterima',
					'c.SerialNumber as barcode',
					'b.RecID',
					'SUBSTRING(e.KodeAreaCabang,0,5)+a.VirtualAccount as nova'
				),
				'from' => $this->db2.'siswa a',
				'join' => array(
					$this->db2.'programsiswa b' => array(
						'on' => 'a.RecID=b.Siswa',
						'type' => 'inner'
					),
					$this->db2.'bukusiswa c' => array(
						'on' => 'b.RecID=c.ProgramSiswa',
						'type' => 'left'
					),
					$this->db2.'program d' => array(
						'on' => 'b.Program=d.RecID',
						'type' => 'inner'
					),
					$this->db2.'areacabang e' => array(
						'on' => 'a.Cabang=e.RecID',
						'type' => 'inner'
					)
				),
				'where' => array('a.VirtualAccount' => $KS,'e.KodeAreaCabang' => $this->session->userdata('KodeAreaCabang'))
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function get_student()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$KS = base64_decode($this->input->get('RecID'));
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'b.RecID', 
					'a.NamaSiswa as siswa', 
					'd.NamaProgram as program',
					'd.Jenjang as Stage'
				),
				'from' => $this->db2.'siswa a',
				'join' => array(
					$this->db2.'programsiswa b' => array(
						'on' => 'a.RecID=b.Siswa',
						'type' => 'inner'
					),
					$this->db2.'program d' => array(
						'on' => 'b.Program=d.RecID',
						'type' => 'inner'
					),
				),
				'where' => array('b.RecID' => $KS)
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function find_item()
	{
			$bc = $this->input->post('bc');
			$data['rows'] = $this->config_model->find(array(
				'select' => array(
					'a.ItemCode',
					'a.ItemName'
				),
				'from' => 'Logistics_MasterItem a',
				'where' => array('a.BarcodeId' => substr($bc,4,4))
			))->result_array();/*
			$data['rowsbc'] = $this->config_model->find(array(
				'select' => array(
					'a.NoVA'
				),
				'from' => $this->db2.'barcode a',
				'where' => array('a.bcode' => $bc)
			))->result_array();*/
			$data['rowsbccbg'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID'
				),
				'from' => 'Logistics_BranchBarcode a',
				'where' => array('a.Barcode' => $bc,'a.Status' => 0, 'a.Invalid' => 0, 'a.BranchCode' => $this->session->userdata('KodeAreaCabang'))
			))->result_array();
			$data['rowsstage'] = $this->config_model->find(array(
				'select' => array(
					'a.StageCode as Stage'
				),
				'from' => 'Student_Stage a',
				'where' => array('a.BarcodeId' => substr($bc,4,2))
			))->result_array();
			echo json_encode($data);
	}

	public function savebc()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$barcode = base64_decode($this->input->post('barcode'));
			$tanggal = date('Y-m-d',strtotime(base64_decode($this->input->post('tanggal'))));
			$kodebuku = base64_decode($this->input->post('kodebuku'));
			$jumlah = base64_decode($this->input->post('jumlah'));
			$nova = base64_decode($this->input->post('nova'));
			$programsiswa = base64_decode($this->input->post('programsiswa'));
			$arr = array(
			 		'select' => array(
						'SUBSTRING(c.KodeAreaCabang,0,5)+a.VirtualAccount as nova'
					),
					'from' => $this->db2.'siswa a',
					'join' => array(
						$this->db2.'programsiswa b' => array(
							'on' => 'a.RecID=b.Siswa',
							'type' => 'inner'
						),
						$this->db2.'areacabang c' => array(
							'on' => 'a.Cabang=c.RecID',
							'type' => 'inner'
						)
					),
					'where' => array('b.RecID' => $programsiswa)
			);
			$sql = $this->config_model->find($arr)->row_array();
			$cekbc = array(
					'from' => $this->db2.'bukusiswa a',
					'where' => array('a.SerialNumber' => $barcode)
			);
			$itemcekbc = $this->config_model->find($cekbc);
			if($itemcekbc->num_rows()<=0){
	    	$data = array(
	    		'params' => array(
		    		'Status' => 1,
		    		'EditDate' => date('Y-m-d H:i:s'),
		    		'EditBy' => $this->session->userdata('Username'),
		    	),
		    	'from' => 'Logistics_BranchBarcode',
				'where' => array('Barcode' => $barcode)
	    	);
	    	$this->config_model->update($data);
	    	$data2 = array(
	    		'params' => array(
		    		'NoVA' => $sql['nova'],
		    		'bcode' => $barcode,
		    	),
		    	'from' => $this->db2.'barcode',
	    	);
	    	$this->config_model->insert($data2);
	    	$data3 = array(
	    		'params' => array(
		    		'ProgramSiswa' => $programsiswa,
		    		'InventItem' => $kodebuku,
		    		'TanggalTerima' => $tanggal,
		    		'Jumlah' => $jumlah,
		    		'SerialNumber' => $barcode,
		    		'Cabang' => $this->session->userdata('AreaCabang'),
		    	),
		    	'from' => $this->db2.'bukusiswa',
	    	);
	    	$this->config_model->insert($data3);
	    	}
			echo data_json(array("message"=>"Data berhasil disimpan.","notify"=>"success"));
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function printbc($RecID)
	{	
		restrict();
		 $arr = array(
		 		'select' => array(
					'a.NamaSiswa as siswa', 
					'd.NamaProgram as program',
					'c.TanggalTerima as tglterima',
					'c.SerialNumber as barcode',
					'e.ItemName as namabuku',
					'c.Jumlah as jumlah'
				),
				'from' => $this->db2.'siswa a',
				'join' => array(
					$this->db2.'programsiswa b' => array(
						'on' => 'a.RecID=b.Siswa',
						'type' => 'inner'
					),
					$this->db2.'bukusiswa c' => array(
						'on' => 'b.RecID=c.ProgramSiswa',
						'type' => 'inner'
					),
					$this->db2.'program d' => array(
						'on' => 'b.Program=d.RecID',
						'type' => 'inner'
					),
					'Logistics_MasterItem e' => array(
						'on' => 'SUBSTRING(c.SerialNumber,5,4)=e.BarcodeId',
						'type' => 'inner'
					)
				),
				'where' => array('c.ProgramSiswa' => $RecID)
		);
		$sql = $this->config_model->find($arr)->row_array();
		$data['namasiswa'] = $sql['siswa'];
		$data['program'] = $sql['program'];
		$data['namabuku'] = $sql['namabuku'];
		$data['barcode'] = $sql['barcode'];
		$data['tanggal'] = tgl_indo($sql['tglterima']);
		$data['jumlah'] = $sql['jumlah'];
		$this->load->view('Student/print',$data);
	}

	public function list_bcbranch(){
		restrict();
		$token = base64_decode($this->input->get('token'));
		$Kode = base64_decode($this->input->get('Kode'));
		$PR = $this->input->get('PR');
		$Cabang = $this->session->userdata('KodeAreaCabang');
		if(isset($PR) && !empty($PR)){
			$where = array('a.PR_Number' => $PR,'a.BranchCode' => $Cabang);
		} else {
			$where = array('a.BranchCode' => $Cabang, 'a.CreatedDate >' => '2019-07-15');
		}
		if (isset($token) && !empty($token) && $Kode == 0) {
			$output['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'a.PR_Number',
					'a.RecID',
					'a.BranchCode',
					'a.Barcode',
					'd.ItemCode',
					'e.NoVA',
					"CASE WHEN a.Status = 1 THEN 'digunakan' ELSE 'Belum digunakan' END as Status",
					"CASE WHEN a.Invalid = 1 THEN 'Yes' ELSE 'No' END as Invalid",
				),
				'from' => 'Logistics_BranchBarcode a',
				'join' => array(
					'Logistics_MasterItem d' => array(
						'on' => 'SUBSTRING(a.Barcode,5,4)=d.BarcodeId',
						'type' => 'left',
					),
					$this->db2.'barcode e' => array(
						'on' => 'a.Barcode=e.bcode',
						'type' => 'left',
					),
				),
				'where' => $where,
			))->result_array();
			echo data_json($output);
		} else {
		$data['breadcrumb_1'] = '<a href="#">Data Stok Barcode Cabang</a>';
		$this->template->set('title', 'Data Stok Barcode Cabang');
		$this->template->load('template', 'Student/list_bcbranch',$data);
		}
	}

	public function get_pr()
	{
		$arr = array(
				'from' => 'Logistics_POHeader a',
				'where' => array('a.BranchCode' => $this->session->userdata('KodeAreaCabang'),'a.PR_Date >'=>'2019-07-14','a.Status' =>'3'),
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);		
	}

}