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

	public function register()
	{	
		restrict();
		$data['breadcrumb_1'] = '<a href="'.base_url().'student/register">Pendaftaran Siswa</a>';
		$this->template->set('title', 'Pendaftaran Siswa');
		$this->template->load('template', 'student/register',$data);
	}

	public function get_stage()
	{
		$arr = array(
				'from' => 'Student_Stage a',
				'where' => array('a.Status' =>'1'),
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);		
	}

	public function get_programpack($stage)
	{
		$arr = array(
				'from' => 'Program_Pack a',
				'where' => array('a.StageCode' => $stage),
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);		
	}

	public function get_subjects()
	{
		$program = $this->input->post('program');
		$arr = array(
				'select' => array(
					'c.RecID',
					'a.PackName',
					'c.SubjectsName',
					'a.PackType'
				),
				'from' => 'Program_Pack a',
				'join' => array(
					'Program_Header b' => array(
						'on' => 'a.ProgramHeaderID=b.RecID',
						'type' => 'inner',
					),
					'Program_Subjects c' => array(
						'on' => 'b.RecID=c.ProgramHeaderID',
						'type' => 'inner',
					),
				),
				'where' => array('a.RecID' => $program),
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);	
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}	
		echo json_encode($data);	
	}

	public function input_program_tmp()
	{
		//$programval = $_POST['programdetail'];
		$program = explode(",", $_POST['programdetail']);

		$data = [];
		for ($i=0; $i < count($program); $i++) { 
			array_push($data, [
				'ProgramDetailID'=> $program[$i],
				'BranchCode'=> $this->session->userdata('KodeAreaCabang'),
				'CreatedDate'=> date('Y-m-d H:i:s'),
				'CreatedBy'=> $this->session->userdata('Username')
			]);
		}
		$msg = $this->config_model->insert_multiple($data,'Program_Student_Tmp');

		echo data_json(array("message"=>"Program Berhasil ditambahkan","notify"=>"success"));
	}

	public function get_program_tmp()
	{
		//$program = $this->input->get('program');
		$arr = array(
				'select' => array(
					'a.RecID',
					'b.ProgramDetailName'
				),
				'from' => 'Program_Student_Tmp a',
				'join' => array(
					'Program_Detail b' => array(
						'on' => 'a.ProgramDetailID=b.RecID',
						'type' => 'inner',
					),
				),
				'where' => array('a.BranchCode' => $this->session->userdata('KodeAreaCabang'), 'a.CreatedBy' => $this->session->userdata('Username')),
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);	
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);	
	}

	public function save_student()
	{
		$nisp = $this->config_model->get_nisp();
		$pscd = $this->config_model->get_studentprogramcode();
		$receiptid = $this->config_model->get_receiptid();
		//echo $pscd;

		    $data2 = array(
		    	'params' => array(
			   		'StudentID' => $nisp,
			   		'Name' => $this->input->post('Name'),
			   		'PhoneNumber' => $this->input->post('PhoneNumber'),
			   		'School' => $this->input->post('School'),
			   		'Stage' => $this->input->post('Stage'),
					'BranchCode'=> $this->session->userdata('KodeAreaCabang'),
					'CreatedDate'=> date('Y-m-d H:i:s'),
					'CreatedBy'=> $this->session->userdata('Username')
			   	),
			   	'from' => 'Student_Profile',
		    );
		    $msg1 = $this->config_model->insert($data2);

		    $data2 = array(
		    	'params' => array(
			   		'StudentID' => $nisp,
			   		'ProgramPackID' => $this->input->post('ProgramPack'),
			   		'RegisterPrice' => $this->input->post('RegPrice'),
			   		'ProgramPrice' => $this->input->post('ProPrice'),
			   		'Year' => 6,
			   		'ProgramStudentCode' => $pscd,
					'CreatedDate'=> date('Y-m-d H:i:s'),
					'CreatedBy'=> $this->session->userdata('Username')
			   	),
			   	'from' => 'Program_Student',
		    );
		    $msg2 = $this->config_model->insert($data2);

			$program = explode(",", $_POST['Subjects']);
			$data = [];
			for ($i=0; $i < count($program); $i++) { 
				array_push($data, [
					'SubjectsID'=> $program[$i],
					'ProgramStudentCode'=> $pscd,
					'CreatedDate'=> date('Y-m-d H:i:s'),
					'CreatedBy'=> $this->session->userdata('Username')
				]);
			}
			$msg3 = $this->config_model->insert_multiple($data,'Program_StudentDetail');

		    $data4 = array(
		    	'params' => array(
			   		'ProgramStudentCode' => $pscd,
			   		'ReceiptID' => $receiptid,
			   		'Method' => 1,
			   		'Amount' => $this->input->post('RegPrice'),
			   		'Status' => 2,
			   		'PaymentFor' => 1,
					'PaymentDateTime'=> date('Y-m-d H:i:s'),
					'CreatedDate'=> date('Y-m-d H:i:s'),
					'CreatedBy'=> $this->session->userdata('Username')
			   	),
			   	'from' => 'Program_Payment',
		    );
		    $msg4 = $this->config_model->insert($data4);

			if ($msg1==true && $msg2==true && $msg3==true && $msg4==true) {
				echo data_json(array("message"=>"Data siswa berhasil disimpan.","notify"=>"success","nisp"=>$nisp));
			} else {
				echo data_json(array("message"=>"Data siswa gagal disimpan.","notify"=>"error"));
			}

	}

	public function load_studentsave()
	{
		$nisp = $this->input->post('nisp');
		$arr = array(
				'select' => array(
					'a.RecID as RecIDStudent',
					'a.StudentID as NISP',
					'a.Name',
					'a.School',
					'a.PhoneNumber',
					'f.StageName',
					'd.PackName',
					'b.RegisterPrice',
					'b.ProgramPrice',
					'e.SubjectsName'
				),
				'from' => 'Student_Profile a',
				'join' => array(
					'Program_Student b' => array(
						'on' => 'a.StudentID=b.StudentID',
						'type' => 'inner',
					),
					'Program_StudentDetail c' => array(
						'on' => 'b.ProgramStudentCode=c.ProgramStudentCode',
						'type' => 'inner',
					),
					'Program_Pack d' => array(
						'on' => 'b.ProgramPackID=d.RecID',
						'type' => 'inner',
					),
					'Program_Subjects e' => array(
						'on' => 'c.SubjectsID=e.RecID',
						'type' => 'inner',
					),
					'Student_Stage f' => array(
						'on' => 'a.Stage=f.StageCode',
						'type' => 'inner',
					),
				),
				'where' => array('a.StudentID' => $nisp),
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);	
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);	
	}

	public function detail_st()
	{	
		$StudentID = base64_decode($this->input->post('StudentID'));
		$Code = base64_decode($this->input->post('Code'));
		restrict();
		if($Code==1){
		$data['breadcrumb_1'] = '<a href="'.base_url().'student/pay_st">Pembayaran Program Siswa</a>';
		$data['breadcrumb_2'] = '<a href="#">Data Program & Pembayaran Siswa</a>';
		} else {
		$data['breadcrumb_1'] = '<a href="'.base_url().'student/register">Pendaftaran Siswa</a>';
		$data['breadcrumb_2'] = '<a href="#">Data Program & Pembayaran Siswa</a>';
		}
		$data['sid'] = $StudentID;
		$this->template->set('title', 'Data Program & Pembayaran Siswa');
		$this->template->load('template', 'student/detail_st',$data);
	}

	public function get_detailst()
	{
		$StudentID = $this->input->post('StudentID');
		$arr = array(
				'select' => array(
					'a.RecID as RecIDStudent',
					'a.StudentID as NISP',
					'a.Name',
					'a.School',
					'a.PhoneNumber',
					'f.StageName',
					'd.PackName',
					'b.RegisterPrice',
					'b.ProgramPrice',
					'e.SubjectsName',
					'a.Stage'
				),
				'from' => 'Student_Profile a',
				'join' => array(
					'Program_Student b' => array(
						'on' => 'a.StudentID=b.StudentID',
						'type' => 'inner',
					),
					'Program_StudentDetail c' => array(
						'on' => 'b.ProgramStudentCode=c.ProgramStudentCode',
						'type' => 'inner',
					),
					'Program_Pack d' => array(
						'on' => 'b.ProgramPackID=d.RecID',
						'type' => 'inner',
					),
					'Program_Subjects e' => array(
						'on' => 'c.SubjectsID=e.RecID',
						'type' => 'inner',
					),
					'Student_Stage f' => array(
						'on' => 'a.Stage=f.StageCode',
						'type' => 'inner',
					),
				),
				'where' => array('a.RecID' => $StudentID),
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);

		$arr2 = array(
				'select' => array(
					'a.RecID as RecIDStudent',
					'a.StudentID as NISP',
					'c.PackName',
					'b.RegisterPrice',
					'b.ProgramPrice',
					'b.ProgramStudentCode',
					'b.ProgramPackID'
				),
				'from' => 'Student_Profile a',
				'join' => array(
					'Program_Student b' => array(
						'on' => 'a.StudentID=b.StudentID',
						'type' => 'inner',
					),
					'Program_Pack c' => array(
						'on' => 'b.ProgramPackID=c.RecID',
						'type' => 'inner',
					),
				),
				'where' => array('a.RecID' => $StudentID),
				'order_by' => array('a.RecID' => '')
			);
		$item2 = $this->config_model->find($arr2);

		$arr3 = array(
				'select' => array(
					'ReceiptID',
					'InvoiceNumber',
					'Method',
					"CASE a.Method 
					  WHEN 1 THEN 'Cash'
					  WHEN 2 THEN 'VA BCA'
					  WHEN 8 THEN 'VA Permata'
					END as Method",
					'Amount',
					"CASE a.Status 
					  WHEN 1 THEN 'Menunggu Pembayaran'
					  WHEN 2 THEN 'Lunas'
					  WHEN 8 THEN 'Pembayaran Gagal'
					  WHEN 9 THEN 'Expired'
					  WHEN 10 THEN 'Cancel'
					END as Status",
					"CASE a.PaymentFor 
					  WHEN 1 THEN 'Pendaftaran'
					  WHEN 2 THEN 'Bimbingan'
					END as PaymentFor",
					'PaymentDateTime',
					'b.ProgramStudentCode'
				),
				'from' => 'Program_Payment a',
				'join' => array(
					'Program_Student b' => array(
						'on' => 'a.ProgramStudentCode=b.ProgramStudentCode',
						'type' => 'inner',
					),
					'Student_Profile c' => array(
						'on' => 'b.StudentID=c.StudentID',
						'type' => 'inner',
					),
				),
				'where' => array('c.RecID' => $StudentID),
			);
		$item3 = $this->config_model->find($arr3);

		$arr4 = array(
				'select' => array(
					'b.ProgramStudentCode',
					'b.RegisterPrice',
					'b.ProgramPrice',
					'sum(a.Amount) as TotNom'
				),
				'from' => 'Program_Payment a',
				'join' => array(
					'Program_Student b' => array(
						'on' => 'a.ProgramStudentCode=b.ProgramStudentCode',
						'type' => 'inner',
					),
					'Student_Profile c' => array(
						'on' => 'b.StudentID=c.StudentID',
						'type' => 'inner',
					),
				),
				'where' => array('c.RecID' => $StudentID, 'a.Status' => 2),
				'group_by' => array('b.ProgramStudentCode','b.RegisterPrice','b.ProgramPrice'),
			);
		$item4 = $this->config_model->find($arr4);

		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
			$data['rows2'] = $item2->result_array();
			$data['rows3'] = $item3->result_array();
			$data['rows4'] = $item4->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);	
	}

	public function pay_st()
	{	
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Pembayaran Program Siswa</a>';
		$this->template->set('title', 'Pembayaran Program Siswa');
		$this->template->load('template', 'student/pay_st',$data);
	}

	public function get_branch_st()
	{
		$arr = array(
				'from' => 'Student_Profile a',
				'where' => array('a.BranchCode' =>$this->session->userdata('KodeAreaCabang')),
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);		
	}

	public function program_stadd()
	{	
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Tambah Program Siswa</a>';
		$this->template->set('title', 'Tambah Program Siswa');
		$this->template->load('template', 'student/program_stadd',$data);
	}

	public function add_programst()
	{	
		$StudentID = base64_decode($this->input->post('StudentID'));
		restrict();
		$data['breadcrumb_1'] = '<a href="'.base_url().'student/program_stadd">Tambah Program Siswa</a>';
		$data['breadcrumb_2'] = '<a href="#">Data Program Siswa</a>';

		$data['sid'] = $StudentID;
		$this->template->set('title', 'Data Program Siswa');
		$this->template->load('template', 'student/add_programst',$data);
	}

	public function get_programpack_add($stage,$StudentID)
	{
		$sql = "SELECT 
				ab.PackName,
				ab.StageCode,
				ab.PackType,
				ab.RecID,
				(select SUM(a.PackType) from Program_Pack a JOIN Program_Student b ON a.RecID=b.ProgramPackID where a.StageCode = ab.StageCode and b.StudentID = '$StudentID') as JML
			from Program_Pack ab 
			where ab.StageCode = '$stage'
			GROUP BY ab.PackName,ab.StageCode,ab.PackType,ab.RecID
			HAVING ab.PackType <= (SELECT COUNT(RecID) from Program_Pack where StageCode=ab.StageCode)-(select SUM(a.PackType) from Program_Pack a JOIN Program_Student b ON a.RecID=b.ProgramPackID where a.StageCode = ab.StageCode and b.StudentID = '$StudentID') ";
		$item = $this->db->query($sql);		
		$data = $item->result_array();
		echo json_encode($data);		
	}

	public function get_subjects_add()
	{
		$program = $this->input->post('program');
		$StudentID = $this->input->post('StudentID');
		$arr = "SELECT c.RecID,c.SubjectsName,a.RecID as PackID,a.PackType from Program_Pack a 
					join Program_Header b ON a.ProgramHeaderID=b.RecID
					join Program_Subjects c ON b.RecID=c.ProgramHeaderID
					left join (Select bc.SubjectsID from Program_Student ab
								join Program_StudentDetail bc on ab.ProgramStudentCode=bc.ProgramStudentCode 
								where StudentID = '$StudentID') d ON c.RecID=d.SubjectsID 
				WHERE a.RecID = '$program' and d.SubjectsID is null";
		$item = $this->db->query($arr);	
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}	
		echo json_encode($data);	
	}

	public function save_addprogram()
	{
		$nisp = $this->input->post('StudentID');
		$pscd = $this->config_model->get_studentprogramcode();
		$receiptid = $this->config_model->get_receiptid();
		//echo $pscd;

		    $data2 = array(
		    	'params' => array(
			   		'StudentID' => $nisp,
			   		'ProgramPackID' => $this->input->post('ProgramPack'),
			   		'RegisterPrice' => $this->input->post('RegPrice'),
			   		'ProgramPrice' => $this->input->post('ProPrice'),
			   		'Year' => 6,
			   		'ProgramStudentCode' => $pscd,
					'CreatedDate'=> date('Y-m-d H:i:s'),
					'CreatedBy'=> $this->session->userdata('Username')
			   	),
			   	'from' => 'Program_Student',
		    );
		    $msg2 = $this->config_model->insert($data2);

			$program = explode(",", $_POST['Subjects']);
			$data = [];
			for ($i=0; $i < count($program); $i++) { 
				array_push($data, [
					'SubjectsID'=> $program[$i],
					'ProgramStudentCode'=> $pscd,
					'CreatedDate'=> date('Y-m-d H:i:s'),
					'CreatedBy'=> $this->session->userdata('Username')
				]);
			}
			$msg3 = $this->config_model->insert_multiple($data,'Program_StudentDetail');

		    $data4 = array(
		    	'params' => array(
			   		'ProgramStudentCode' => $pscd,
			   		'ReceiptID' => $receiptid,
			   		'Method' => 1,
			   		'Amount' => $this->input->post('RegPrice'),
			   		'Status' => 2,
			   		'PaymentFor' => 1,
					'PaymentDateTime'=> date('Y-m-d H:i:s'),
					'CreatedDate'=> date('Y-m-d H:i:s'),
					'CreatedBy'=> $this->session->userdata('Username')
			   	),
			   	'from' => 'Program_Payment',
		    );
		    $msg4 = $this->config_model->insert($data4);

			if ($msg2==true && $msg3==true && $msg4==true) {
				echo data_json(array("message"=>"Data siswa berhasil disimpan.","notify"=>"success"));
			} else {
				echo data_json(array("message"=>"Data siswa gagal disimpan.","notify"=>"error"));
			}

	}

	public function get_detailpay()
	{
		$psdc = $this->input->post('psdc');
		$arr = array(
				'select' => array(
					'b.ProgramStudentCode',
					'b.RegisterPrice',
					'b.ProgramPrice',
					'c.PackName',
					'sum(a.Amount) as TotNom'
				),
				'from' => 'Program_Payment a',
				'join' => array(
					'Program_Student b' => array(
						'on' => 'a.ProgramStudentCode=b.ProgramStudentCode',
						'type' => 'inner',
					),
					'Program_Pack c' => array(
						'on' => 'b.ProgramPackID=c.RecID',
						'type' => 'inner',
					),
				),
				'where' => array('b.ProgramStudentCode' => $psdc, 'a.Status' => 2),
				'group_by' => array('b.ProgramStudentCode','b.RegisterPrice','b.ProgramPrice','c.PackName'),
			);
		$item = $this->config_model->find($arr);

		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);	
	}

	public function receipt()
	{	
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Tambah Program Siswa</a>';
		$this->template->set('title', 'Tambah Program Siswa');
		$this->load->view('student/receipt',$data);
	}

}