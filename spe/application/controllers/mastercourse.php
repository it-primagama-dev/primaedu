<?php defined('BASEPATH') OR exit('No direct script access allowed');

class mastercourse extends CI_Controller {
	private $filename = "import_data"; // Kita tentukan nama filenya

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('config_model');
        $this->load->library(array('PHPExcel/PHPExcel'));
    }
//ITEM
    public function index()
    {
		restrict();
		$data = array(
			'title' => 'Dashboard',
		);
		$this->template->load('template', 'dashboard',$data);
    }

	public function category()
	{
		restrict();/*
		if ($this->session->userdata('UserGroup')==14) {*/
			$data['breadcrumb_1'] = '<a href="'.base_url().'mastercourse/category">Data Siswa Dan Paket</a>';
			$this->template->set('title', 'Data Siswa Dan Paket');
			$this->template->load('template', 'mastercourse/category',$data);
		/*} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}

	public function edit_paket($RecID)
	{
		$arr = array(
				'from' => 'Course_Category a',
				'where' => array('a.RecID' => $RecID)
			);
		$data = $this->config_model->find($arr)->row();
		echo json_encode($data);
	}

	public function add_paket()
	{
		$data = array(
	    	'params' => array(
		    	'CatName' => $this->input->post('CatName'),
		    	'Description' => $this->input->post('Description'),
		    	'TotalStudents' => $this->input->post('TotalStudents'),
				'CreatedDate' => date("Y-m-d H:i:s"),
				'CreatedBy' => $this->session->userdata('Username')
		    ),
		    'from' => 'Course_Category',
	    );
	    $msg = $this->config_model->insert($data);
			echo data_json(array("message"=>"Data berhasil disimpan.","notify"=>"success"));
	}

	public function update_paket()
	{
		$data = array(
	    	'params' => array(
		    	'CatName' => $this->input->post('CatName'),
		    	'Description' => $this->input->post('Description'),
		    	'TotalStudents' => $this->input->post('TotalStudents'),
		    ),
		    'from' => 'Course_Category',
			'where' => array('RecID' => $this->input->post('RecID'))
	    );
	    $msg = $this->config_model->update($data);
			echo data_json(array("message"=>"Data berhasil diubah.","notify"=>"success"));
	}

	public function delete_paket()
	{
		$id = $this->input->post('RecID');
		if(isset($id)) {
			$msg = $this->config_model->delete_paket($id);
			echo data_json(array("message"=>"Data berhasil dihapus.","notify"=>"success"));
		}
	}

	public function get_data_paket()
	{
		$arr = array(
				'from' => 'Course_Category a',
			);
		$item = $this->config_model->find($arr);
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}
	public function test()
	{	
		restrict();
		$data = array(
			'title' => 'Data Paket',
			'breadcrumb_1' => '<a href="'.base_url().'mastercourse">Data Paket</a>'
		);
		$this->template->load('template', 'mastercourse/category',$data);

	}

	public function packcourse()
	{	
		restrict();
		$arr = array(
				'from' => 'Course_Pack a',
			);
		$item = $this->config_model->find($arr);
		$data = array(
			'title' => 'Data Paket Course',
			'breadcrumb_1' => '<a href="'.base_url().'mastercourse">Data Paket Course</a>',
			'item' => $item,
		);
		$this->template->load('template', 'mastercourse/packcourse',$data);

	}

	public function edit_packcourse($RecID)
	{
		$arr = array(
				'select' => array(
					'a.RecID',
					'c.RecID as PackDetailID',
					'a.CatID',
					'a.Description',
					'a.PackName',
					'b.CatName',
					'c.TotalMeet',
					'c.PackDetailName',
					'c.PriceDetail'
				),
				'from' => 'Course_Pack a',
				'join' => array(
					'Course_Category b' => array(
						'on' => 'a.CatID=b.RecID',
						'type' => 'inner'
					),
					'Course_PackDetail c' => array(
						'on' => 'c.PackID=a.RecID',
						'type' => 'inner'
					),
				),
				'where' => array('c.RecID' => $RecID)
			);
		$data = $this->config_model->find($arr)->row();
		echo json_encode($data);
	}

	public function add_packcourse()
	{
		$data = array(
	    	'params' => array(
		    	'CatID' => $this->input->post('CatID'),
		    	'PackName' => $this->input->post('PackName'),
		    	'Description' => $this->input->post('Description'),
		    	'StageCat' => $this->input->post('StageCat'),
				'CreatedDate' => date("Y-m-d H:i:s"),
				'CreatedBy' => $this->session->userdata('Username')
		    ),
		    'from' => 'Course_Pack',
	    );
	    $msg = $this->config_model->insert($data);
			echo data_json(array("message"=>"Data berhasil disimpan.","notify"=>"success"));
	}

	public function update_packcourse()
	{
		$data = array(
	    	'params' => array(
		    	'CatID' => $this->input->post('CatID'),
		    	'PackName' => $this->input->post('PackName'),
		    	'Description' => $this->input->post('Description'),
		    	//'StageCat' => $this->input->post('StageCat'),
		    ),
		    'from' => 'Course_Pack',
			'where' => array('RecID' => $this->input->post('RecID'))
	    );
	    $msg = $this->config_model->update($data);

		$data2 = array(
	    	'params' => array(
		    	'PackDetailName' => $this->input->post('PackDetailName'),
		    	'TotalMeet' => $this->input->post('TotalMeet'),
		    	'PriceDetail' => $this->input->post('PriceDetail'),
		    	//'StageCat' => $this->input->post('StageCat'),
		    ),
		    'from' => 'Course_PackDetail',
			'where' => array('RecID' => $this->input->post('PackDetailID'))
	    );
	    $msg2 = $this->config_model->update($data2);
			echo data_json(array("message"=>"Data berhasil diubah.","notify"=>"success"));
	}

	public function delete_packcourse()
	{
		$id = $this->input->post('RecID');
		if(isset($id)) {
			$msg = $this->config_model->delete_packcourse($id);
			echo data_json(array("message"=>"Data berhasil dihapus.","notify"=>"success"));
		}
	}

	public function get_data_packcourse()
	{
		$arr = array(
				'select' => array(
					'a.RecID',
					'a.Description',
					'c.RecID as PackDetailID',
					'a.PackName',
					'b.CatName',
					'c.TotalMeet',
					'c.PackDetailName',
					'c.PriceDetail'
				),
				'from' => 'Course_Pack a',
				'join' => array(
					'Course_Category b' => array(
						'on' => 'a.CatID=b.RecID',
						'type' => 'inner'
					),
					'Course_PackDetail c' => array(
						'on' => 'c.PackID=a.RecID',
						'type' => 'inner'
					),
				),
				'order_by' => array('b.RecID'=>'','a.RecID'=>'','c.RecID'=>'')
			);
		$item = $this->config_model->find($arr);
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}
	public function test_packcourse()
	{	
		restrict();
		$data = array(
			'title' => 'Data Paket Course',
			'breadcrumb_1' => '<a href="'.base_url().'mastercourse">Data Paket Course</a>'
		);
		$this->template->load('template', 'mastercourse/packcourse',$data);

	}

	public function get_kategory(){
		$arr = array(
				'from' => 'Course_Category',
			);

		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	// SCHEDULE
	public function schedule(){
		restrict();
		$arr = array(
				'from' => 'Course_Schedule a',
			);
		$item = $this->config_model->find($arr);
		$data = array(
			'title' => 'Data Jadwal',
			'breadcrumb_1' => '<a href="'.base_url().'mastercourse">Data Jadwal</a>',
			'item' => $item,
		);
		$this->template->load('template', 'mastercourse/schedule',$data);
	}

	public function edit_schedule($RecID)
	{
		$arr = array(
				'from' => 'Course_Schedule a',
				'where' => array('a.RecID' => $RecID)
			);
		$data = $this->config_model->find($arr)->row();
		echo json_encode($data);
	}

	public function add_schedule()
	{
		$data = array(
	    	'params' => array(
		    	'BranchCode' => $this->input->post('BranchCode'),
		    	'IsmartID' => $this->input->post('IsmartID'),
		    	'StageCat' => $this->input->post('StageCat'),
		    	'SubID' => $this->input->post('SubID'),
		    	'Date' => $this->input->post('Date'),
		    	'TimeFrom' => $this->input->post('TimeFrom'),
				'CreatedDate' => date("Y-m-d H:i:s"),
				'CreatedBy' => $this->session->userdata('Username')
		    ),
		    'from' => 'Course_Schedule',
	    );
	    $msg = $this->config_model->insert($data);
			echo data_json(array("message"=>"Data berhasil disimpan.","notify"=>"success"));
	}

	public function update_schedule()
	{
		$data = array(
	    	'params' => array(
		    	'BranchCode' => $this->input->post('BranchCode'),
		    	'IsmartID' => $this->input->post('IsmartID'),
		    	'StageCat' => $this->input->post('StageCat'),
		    	'SubID' => $this->input->post('SubID'),
		    	'Date' => $this->input->post('Date'),
		    	'TimeFrom' => $this->input->post('TimeFrom'),
				'CreatedDate' => date("Y-m-d H:i:s"),
				'CreatedBy' => $this->session->userdata('Username')
		    ),
		    'from' => 'Course_Schedule',
			'where' => array('RecID' => $this->input->post('RecID'))
	    );
	    $msg = $this->config_model->update($data);
			echo data_json(array("message"=>"Data berhasil diubah.","notify"=>"success"));
	}
/*
	public function delete_schedule()
	{
		$id = $this->input->post('RecID');
		if(isset($id)) {
			$msg = $this->config_model->delete_schedule($id);
			echo data_json(array("message"=>"Data berhasil dihapus.","notify"=>"success"));
		}
	}*/
	
	public function delete_schedule($RecID)
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->delete(array(
					'from' => 'Course_Schedule',
					'where' => array('RecID' => base64_decode($this->input->post('RecID')))
				));
				echo json_encode(array('message'=>'Data berhasil dihapus','notify'=>'success'));
			} catch (Exception $e) {
				echo json_encode(array('message'=>'Data gagal dihapus','notify'=>'warning'));
			}
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function get_data_schedule()
	{
		$arr = array(
			'select' => array(
					'a.RecID',
					'a.BranchCode',
					'a.IsmartName',
					"CASE a.StageCat 
					  WHEN 20 THEN 'SD'
					  WHEN 21 THEN 'SMP'
					  WHEN 22 THEN 'SMA IPA'
					  WHEN 23 THEN 'SMA IPS'
					  WHEN 24 THEN 'UTBK'
					END as StageCat",
					'b.SubName as SubjectsID',
					'a.Date',
					'c.TimeFrom',
					'c.TimeTo',
					'd.BranchName',
					'a.Status'
				),
				'from' => 'Course_Schedule a',
				'join' => array(
					'Course_Subjects b' => array(
						'on' => 'a.SubID=b.RecID',
						'type' => 'inner'
					),
					'Course_ScheduleTemplate c' => array(
						'on' => 'a.ScheduleTemplateID=c.RecID',
						'type' => 'inner'
					),
					'Course_Referal d' => array(
						'on' => 'a.BranchCode=d.BranchCode',
						'type' => 'inner'
					),
				),
				'where' => 'a.Status != 10 OR a.Status is null OR a.Status = 1',
				'order_by' => array('a.RecID'=>'DESC')
			);
		$item = $this->config_model->find($arr);
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function get_SubjectsName($ID){
		$arr = array(
				'from' => 'Course_Subjects',
				'where' => array('StageCat'=>$ID)
			);

		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function cek_jadwalsama(){

		$ScheduleTemplateID = $this->input->post('TimeFrom');
		$SubID = $this->input->post('SubID');
		$Date = date('Y-m-d',strtotime($this->input->post('Date')));

        $arr1 = array(
            'from' => 'Course_Ismart a',
            'where' => array('a.RecID' => $this->input->post('IsmartID')),
        );
		$query1 = $this->config_model->find($arr1)->row_array();

		$IsmartName = $query1['IsmartName'];
		$arr = array(
				'from' => 'Course_Schedule',
				'where' => array('IsmartName'=>$IsmartName,'ScheduleTemplateID' => $ScheduleTemplateID,'SubID' => $SubID,'Date' => $Date)
			);

		$item = $this->config_model->find($arr);	

		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function save_addschedule()
	{
		$ScheduleTemplateID = $this->input->post('TimeFrom');
		$SubID = $this->input->post('SubID');
		$Date = date('Y-m-d',strtotime($this->input->post('Date')));

        $arr = array(
            'from' => 'Course_ScheduleTemplate a',
            'where' => array('a.RecID' => $this->input->post('TimeFrom')),
        );
		$query = $this->config_model->find($arr)->row_array();

        $arr1 = array(
            'from' => 'Course_Ismart a',
            'where' => array('a.RecID' => $this->input->post('IsmartID')),
        );
		$query1 = $this->config_model->find($arr1)->row_array();

		$IsmartName = $query1['IsmartName'];
		$arr2 = array(
				'from' => 'Course_Schedule',
				'where' => array('IsmartName'=>$IsmartName,'ScheduleTemplateID' => $ScheduleTemplateID,'SubID' => $SubID,'Date' => $Date)
			);

		$item2 = $this->config_model->find($arr2);	

		if($item2->num_rows()==0) {
		    $data2 = array(
		    	'params' => array(
			   		'BranchCode' => $this->input->post('BranchCode'),
			   		'IsmartName' => $query1['IsmartName'],
			   		'IsmartID' => $query1['RecID'],
			   		'StageCat' => $this->input->post('StageCat'),
			   		'SubID' => $this->input->post('SubID'),
			   		'Date' => date('Y-m-d',strtotime($this->input->post('Date'))),
			   		'ScheduleTemplateID' => $this->input->post('TimeFrom'),
			   		'TimeFrom' => $query['TimeFrom'],
			   		'TimeTo' => $query['TimeTo'],
			   		'BranchCode' => $this->input->post('BranchCode'),
			   	),
				'from' => 'Course_Schedule',
		    );
		    $msg2 = $this->config_model->insert($data2);
			//echo data_json(array("message"=>"Data jadwal berhasil disimpan.","notify"=>"success"));

		}		
			/*if ($msg2==true) {*/
			/*} else {
				echo data_json(array("message"=>"Data jadwal gagal disimpan.","notify"=>"error"));
			}*/
			echo data_json(array("message"=>"Data jadwal berhasil disimpan.","notify"=>"success"));

	}

	public function list_st()
	{	
		restrict();
		$data = array(
			'title' => 'Data Siswa Kelas Online',
			'breadcrumb_1' => '<a href="'.base_url().'mastercourse">Data Siswa Kelas Online</a>',
		);
		$this->template->load('template', 'mastercourse/list_st',$data);

	}

	public function get_datalistst()
	{

		$arr = array(
		'select' => array(
			'a.SessionID',
			'a.TotalPrice',
			'b.PackDetailName',
			'c.PackName',
			'd.CatName',
			'e.NAME',
			'e.EMAIL',
			'e.AMOUNT',
			'a.CreatedDate',
			'a.ReferalCode',
			'a.Status',
			'a.OrderCode'
		),
		'from' => 'Course_OrderHeader a',
		'join' => array(
			'Course_PackDetail b' => array(
				'on' => 'a.PackDetailID=b.RecID',
					'type' => 'inner'
				),
				'Course_Pack c' => array(
					'on' => 'b.PackID=c.RecID',
					'type' => 'inner'
				),
				'Course_Category d' => array(
					'on' => 'c.CatID=d.RecID',
					'type' => 'inner'
				),
				'Logistics_Transactions e' => array(
					'on' => 'a.OrderCode=e.TRANSIDMERCHANT',
					'type' => 'inner'
				),
			),
			'order_by' => array('a.RecID'=>'DESC'),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function get_jadwal(){
		$arr = array(
				'from' => 'Course_ScheduleTemplate',
			);

		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function get_Cabang(){
		$arr = array(
				'from' => 'Course_Referal',
			);

		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function get_liststdetail()
	{

		$SessionID = $this->input->post('SessionID');
		$arr = array(
		'from' => 'Course_OrderHeader a',
		'join' => array(
			'Course_OrderStudent b' => array(
				'on' => 'a.SessionID=b.SessionID',
					'type' => 'inner'
				),
			'Student_Stage c' => array(
				'on' => 'a.StageCode=c.StageCode',
					'type' => 'inner'
				),
			),
			'where' => array('a.SessionID'=>$SessionID),
			'order_by' => array('b.RecID' => '')
		);
		$sql = $this->config_model->find($arr);

		$arr2 = array(
		'from' => 'Course_OrderDetail a',
		'join' => array(
			'Course_Subjects b' => array(
				'on' => 'a.SubID=b.RecID',
					'type' => 'inner'
				),
			'Course_Schedule c' => array(
				'on' => 'a.ScheduleID=c.RecID',
					'type' => 'left'
				),
			'Course_ScheduleTemplate d' => array(
				'on' => 'c.ScheduleTemplateID=d.RecID',
					'type' => 'inner'
				),
			),
			'where' => array('a.SessionID'=>$SessionID),
			'order_by' => array('b.RecID' => '')
		);
		$sql2 = $this->config_model->find($arr2);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
			$data['rows2'] = $sql2->result_array();
		} else {
			$data['rows'] = 0;
			$data['rows2'] = 0;
		}
		echo json_encode($data);
	}

	public function get_ismart($id){
		$arr = array(
				'from' => 'Course_Ismart',
				'where' => array('BranchCode' => $id),
			);

		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function appr_ismart()
	{	
		restrict();
		$data = array(
			'title' => 'Approve iSmart',
			'breadcrumb_1' => '<a href="'.base_url().'mastercourse">Approve iSmart</a>',
		);
		$this->template->load('template', 'mastercourse/appr_ismart',$data);

	}

	public function get_apprismart()
	{

		$arr = array(
		'select' => array(
			'a.BranchCode',
			'a.IsmartName',
			'a.RecID IsmartID',
			"CASE a.Position 
			  WHEN 1 THEN 'IBM'
			  WHEN 2 THEN 'Staff Akademik'
			  WHEN 3 THEN 'iSmart'
			END as Position",
			"CASE a.Opsi1 
			  WHEN 1 THEN 'Sangat Tidak Siap'
			  WHEN 2 THEN 'Tidak Siap'
			  WHEN 3 THEN 'Cukup Siap'
			  WHEN 4 THEN 'Siap'
			  WHEN 5 THEN 'Sangat Siap'
			END as Opsi1",
			"CASE a.Opsi2 
			  WHEN 1 THEN 'Sangat Tidak Siap'
			  WHEN 2 THEN 'Tidak Siap'
			  WHEN 3 THEN 'Cukup Siap'
			  WHEN 4 THEN 'Siap'
			  WHEN 5 THEN 'Sangat Siap'
			END as Opsi2",
			"CASE a.Opsi3 
			  WHEN 1 THEN 'Sangat Tidak Siap'
			  WHEN 2 THEN 'Tidak Siap'
			  WHEN 3 THEN 'Cukup Siap'
			  WHEN 4 THEN 'Siap'
			  WHEN 5 THEN 'Sangat Siap'
			END as Opsi3",
			'd.SubName',
			'b.SubjectBab',
			'b.RecID',
			"CASE d.StageCat 
			  WHEN 20 THEN 'SD'
			  WHEN 21 THEN 'SMP'
			  WHEN 22 THEN 'SMA IPA'
			  WHEN 23 THEN 'SMA IPS'
			  WHEN 24 THEN 'UTBK'
			END as StageCat",
			'a.PhoneNumber',
			'a.BirthDate'

		),
		'from' => 'Course_Ismart a',
		'join' => array(
			'Course_IsmartSubjects b' => array(
				'on' => 'a.RecID=b.IsmartID',
					'type' => 'inner'
				),/*
				'Course_Referal c' => array(
					'on' => 'a.BranchCode=c.BranchCode',
					'type' => 'inner'
				),*/
				'Course_Subjects d' => array(
					'on' => 'b.SubjectID=d.RecID',
					'type' => 'inner'
				),
			),
			'where' => array('b.Status'=>0),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function approve_ismart()
	{
		$numb = $this->input->post('numb');
		$data = array(
	    	'params' => array(
		    	'Status' => $this->input->post('Status'),
		    ),
		    'from' => 'Course_IsmartSubjects',
			'where' => array('RecID' => $this->input->post('RecID'))
	    );
	    $msg = $this->config_model->update($data);
		echo data_json(array("message"=>"Data berhasil di simpan ( $numb ).","notify"=>"success"));
	}

	public function appr_schedule()
	{	
		restrict();
		$data = array(
			'title' => 'Approve Jadwal',
			'breadcrumb_1' => '<a href="'.base_url().'mastercourse">Approve Jadwal</a>',
		);
		$this->template->load('template', 'mastercourse/appr_schedule',$data);

	}

	public function get_appr_schedule()
	{
		$arr = array(
			'select' => array(
					'a.RecID',
					'a.BranchCode',
					'a.IsmartName',
					"CASE a.StageCat 
					  WHEN 20 THEN 'SD'
					  WHEN 21 THEN 'SMP'
					  WHEN 22 THEN 'SMA IPA'
					  WHEN 23 THEN 'SMA IPS'
					  WHEN 24 THEN 'UTBK'
					END as StageCat",
					'b.SubName as SubjectsID',
					'a.Date',
					'c.TimeFrom',
					'c.TimeTo',
					'd.BranchName'
				),
				'from' => 'Course_Schedule a',
				'join' => array(
					'Course_Subjects b' => array(
						'on' => 'a.SubID=b.RecID',
						'type' => 'inner'
					),
					'Course_ScheduleTemplate c' => array(
						'on' => 'a.ScheduleTemplateID=c.RecID',
						'type' => 'inner'
					),
					'Course_Referal d' => array(
						'on' => 'a.BranchCode=d.BranchCode',
						'type' => 'inner'
					),
				),
				'where' => array('a.Status'=>10)
			);
		$item = $this->config_model->find($arr);
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function approve_schedule()
	{
		$numb = $this->input->post('numb');
		$StatusID = $this->input->post('Status');
		if($StatusID==11) {
			$Status = null;
		} else {
			$Status = $StatusID;
		}
		$data = array(
	    	'params' => array(
		    	'Status' => $Status,
		    ),
		    'from' => 'Course_Schedule',
			'where' => array('RecID' => $this->input->post('RecID'))
	    );
	    $msg = $this->config_model->update($data);
		echo data_json(array("message"=>"Data berhasil di simpan ( $numb ).","notify"=>"success"));
	}

	public function list_ismart()
	{	
		restrict();
		$data = array(
			'title' => 'Data iSmart',
			'breadcrumb_1' => '<a href="'.base_url().'mastercourse">Data iSmart</a>',
		);
		$this->template->load('template', 'mastercourse/list_ismart',$data);

	}

	public function get_dataismart()
	{

		$arr = array(
		'select' => array(
			'a.BranchCode',
			'a.IsmartName',
			'a.RecID IsmartID',
			"CASE a.Position 
			  WHEN 1 THEN 'IBM'
			  WHEN 2 THEN 'Staff Akademik'
			  WHEN 3 THEN 'iSmart'
			END as Position",
			"CASE a.Opsi1 
			  WHEN 1 THEN 'Sangat Tidak Siap'
			  WHEN 2 THEN 'Tidak Siap'
			  WHEN 3 THEN 'Cukup Siap'
			  WHEN 4 THEN 'Siap'
			  WHEN 5 THEN 'Sangat Siap'
			END as Opsi1",
			"CASE a.Opsi2 
			  WHEN 1 THEN 'Sangat Tidak Siap'
			  WHEN 2 THEN 'Tidak Siap'
			  WHEN 3 THEN 'Cukup Siap'
			  WHEN 4 THEN 'Siap'
			  WHEN 5 THEN 'Sangat Siap'
			END as Opsi2",
			"CASE a.Opsi3 
			  WHEN 1 THEN 'Sangat Tidak Siap'
			  WHEN 2 THEN 'Tidak Siap'
			  WHEN 3 THEN 'Cukup Siap'
			  WHEN 4 THEN 'Siap'
			  WHEN 5 THEN 'Sangat Siap'
			END as Opsi3",
			'd.SubName',
			'b.SubjectBab',
			'b.RecID',
			"CASE d.StageCat 
			  WHEN 20 THEN 'SD'
			  WHEN 21 THEN 'SMP'
			  WHEN 22 THEN 'SMA IPA'
			  WHEN 23 THEN 'SMA IPS'
			  WHEN 24 THEN 'UTBK'
			END as StageCat",
			"CASE b.Status 
			  WHEN 1 THEN 'Approved'
			  WHEN 2 THEN 'Rejected'
			END as Status",
			'a.PhoneNumber',
			'a.BirthDate'

		),
		'from' => 'Course_Ismart a',
		'join' => array(
			'Course_IsmartSubjects b' => array(
				'on' => 'a.RecID=b.IsmartID',
					'type' => 'inner'
				),/*
				'Course_Referal c' => array(
					'on' => 'a.BranchCode=c.BranchCode',
					'type' => 'inner'
				),*/
				'Course_Subjects d' => array(
					'on' => 'b.SubjectID=d.RecID',
					'type' => 'inner'
				),
			),
			'where' => array('b.Status !=' => '0'),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function list_trxfa()
	{	
		restrict();
		$data = array(
			'title' => 'Data Transaksi Kelas Online',
			'breadcrumb_1' => '<a href="'.base_url().'mastercourse">Data Transaksi Kelas Online</a>',
		);
		$this->template->load('template', 'mastercourse/list_trxfa',$data);

	}

	public function get_datatrxfa()
	{

		$arr = array(
		'select' => array(
			'a.SessionID',
			'a.TotalPrice',
			'b.PackDetailName',
			'c.PackName',
			'd.CatName',
			'e.NAME',
			'e.EMAIL',
			'e.AMOUNT',
			'a.CreatedDate',
			'a.ReferalCode',
			'a.Status',
			'a.OrderCode',
			'e.PAYMENTCODE',
			'e.PAYMENTDATETIME'
		),
		'from' => 'Course_OrderHeader a',
		'join' => array(
			'Course_PackDetail b' => array(
				'on' => 'a.PackDetailID=b.RecID',
					'type' => 'inner'
				),
				'Course_Pack c' => array(
					'on' => 'b.PackID=c.RecID',
					'type' => 'inner'
				),
				'Course_Category d' => array(
					'on' => 'c.CatID=d.RecID',
					'type' => 'inner'
				),
				'Logistics_Transactions e' => array(
					'on' => 'a.OrderCode=e.TRANSIDMERCHANT',
					'type' => 'inner'
				),
			),
			'where' => array('a.Status' => 1),
			'order_by' => array('a.RecID'=>'DESC'),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

}