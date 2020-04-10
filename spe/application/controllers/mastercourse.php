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
	/*
	public function find_coursee()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'a.CatName',
					'a.Description',
					'a.TotalStudents',
				),
				'from' => 'Course_Category a',
				'order_by' => array('a.RecID' => 'DESC')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function add_coursee()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->insert(array(
					'params' => array(
						'Description' => base64_decode($this->input->post('Description')),
						'CreatedDate' => date("Y-m-d H:i:s"),
						'CreatedBy' => $this->session->userdata('Username')
					),
					'from' => 'Course_Category'
				));
				echo json_encode(array('message'=>'Data berhasil disimpan','notify'=>'success'));
			} catch (Exception $e) {
				echo json_encode(array('message'=>'Data gagal disimpan','notify'=>'warning'));
			}
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function delete_coursee()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->delete(array(
					'from' => 'Course_Category',
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
	}*/

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

}
