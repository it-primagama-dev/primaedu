<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('config_model');
    }

	public function index()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Program Header</a>';
		$data['stage'] = $this->config_model->find(array('from'=>'Student_Stage','order_by'=>array('RecID'=>'')));
		$this->template->set('title', 'Program Header');
		$this->template->load('template', 'program/programheader',$data);
	}
	
	public function find_programheader()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$RecID = base64_decode($this->input->get('RecID'));
			if (isset($RecID) && !empty($RecID)) {
				$where = array('a.RecID' => $RecID);
			} else {
				$where = null;
			}
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'a.ProgramName',
					'b.StageName',
					'b.StageCode',
					"CASE a.Status 
					  WHEN 0 THEN 'Tidak Aktif'
					  WHEN 1 THEN 'Aktif'
					END as Status",
					'a.Status as StatusID'
				),
				'from' => 'Program_Header a',
				'join' => array(
					'Student_Stage b' => array(
						'on' => 'a.StageCode=b.StageCode',
						'type' => 'inner'
					)
				),
				'where' => $where,
				'order_by' => array('a.RecID' => '')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function add_programheader()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->insert(array(
					'params' => array(
						'ProgramName' => base64_decode($this->input->post('ProgramName')),
						'StageCode' => base64_decode($this->input->post('StageCode')),
						'Status' => base64_decode($this->input->post('Status')),
						'CreatedDate'=> date('Y-m-d H:i:s'),
						'CreatedBy'=> $this->session->userdata('Username')
					),
					'from' => 'Program_Header'
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
	
	public function edit_programheader()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'ProgramName' => base64_decode($this->input->post('ProgramName')),
						'StageCode' => base64_decode($this->input->post('StageCode')),
						'Status' => base64_decode($this->input->post('Status')),
					),
					'from' => 'Program_Header',
					'where' => array('RecID' => base64_decode($this->input->post('RecID')))
				));
				echo json_encode(array('message'=>'Data berhasil diubah','notify'=>'success'));
			} catch (Exception $e) {
				echo json_encode(array('message'=>'Data gagal diubah','notify'=>'warning'));
			}
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function delete_programheader()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->delete(array(
					'from' => 'Program_Header',
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

	public function pack()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Paket Program</a>';
		$data['ProgramHeader'] = $this->config_model->find(array('from'=>'Program_Header','order_by'=>array('RecID'=>'')));
		$this->template->set('title', 'Paket Program');
		$this->template->load('template', 'program/programpack',$data);
	}
	
	public function find_pack()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$RecID = base64_decode($this->input->get('RecID'));
			if (isset($RecID) && !empty($RecID)) {
				$where = array('a.RecID' => $RecID);
			} else {
				$where = null;
			}
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'b.ProgramName',
					'c.StageName',
					'c.StageCode',
					'a.PackName',
					'a.PackType',
					"CASE a.Status 
					  WHEN 0 THEN 'Tidak Aktif'
					  WHEN 1 THEN 'Aktif'
					END as Status",
					'a.Status as StatusID',
					'a.ProgramHeaderID'
				),
				'from' => 'Program_Pack a',
				'join' => array(
					'Program_Header b' => array(
						'on' => 'a.ProgramHeaderID=b.RecID',
						'type' => 'inner'
					),
					'Student_Stage c' => array(
						'on' => 'b.StageCode=c.StageCode',
						'type' => 'inner'
					)
				),
				'where' => $where,
				'order_by' => array('a.RecID' => '')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function add_pack()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->insert(array(
					'params' => array(
						'PackName' => base64_decode($this->input->post('PackName')),
						'ProgramHeaderID' => base64_decode($this->input->post('ProgramHeader')),
						'Status' => base64_decode($this->input->post('Status')),
						'PackType' => base64_decode($this->input->post('PackType')),
						'CreatedDate'=> date('Y-m-d H:i:s'),
						'CreatedBy'=> $this->session->userdata('Username')
					),
					'from' => 'Program_Pack'
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
	
	public function edit_pack()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'PackName' => base64_decode($this->input->post('PackName')),
						'ProgramHeaderID' => base64_decode($this->input->post('ProgramHeader')),
						'Status' => base64_decode($this->input->post('Status')),
						'PackType' => base64_decode($this->input->post('PackType')),
					),
					'from' => 'Program_Pack',
					'where' => array('RecID' => base64_decode($this->input->post('RecID')))
				));
				echo json_encode(array('message'=>'Data berhasil diubah','notify'=>'success'));
			} catch (Exception $e) {
				echo json_encode(array('message'=>'Data gagal diubah','notify'=>'warning'));
			}
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function delete_pack()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->delete(array(
					'from' => 'Program_Pack',
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

	public function subjects()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Subjects Program</a>';
		$data['ProgramHeader'] = $this->config_model->find(array('from'=>'Program_Header','order_by'=>array('RecID'=>'')));
		$this->template->set('title', 'Subjects Program');
		$this->template->load('template', 'program/subjects',$data);
	}
	
	public function find_subjects()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$RecID = base64_decode($this->input->get('RecID'));
			if (isset($RecID) && !empty($RecID)) {
				$where = array('a.RecID' => $RecID);
			} else {
				$where = null;
			}
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'b.ProgramName',
					'a.SubjectsName',
					'a.ProgramHeaderID'
				),
				'from' => 'Program_Subjects a',
				'join' => array(
					'Program_Header b' => array(
						'on' => 'a.ProgramHeaderID=b.RecID',
						'type' => 'inner'
					),
				),
				'where' => $where,
				'order_by' => array('a.RecID' => '')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function add_subjects()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->insert(array(
					'params' => array(
						'ProgramHeaderID' => base64_decode($this->input->post('ProgramHeader')),
						'SubjectsName' => base64_decode($this->input->post('SubjectsName')),
						'CreatedDate'=> date('Y-m-d H:i:s'),
						'CreatedBy'=> $this->session->userdata('Username')
					),
					'from' => 'Program_Subjects'
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
	
	public function edit_subjects()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'ProgramHeaderID' => base64_decode($this->input->post('ProgramHeader')),
						'SubjectsName' => base64_decode($this->input->post('SubjectsName')),
					),
					'from' => 'Program_Subjects',
					'where' => array('RecID' => base64_decode($this->input->post('RecID')))
				));
				echo json_encode(array('message'=>'Data berhasil diubah','notify'=>'success'));
			} catch (Exception $e) {
				echo json_encode(array('message'=>'Data gagal diubah','notify'=>'warning'));
			}
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function delete_subjects()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->delete(array(
					'from' => 'Program_Subjects',
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
/*
	public function price()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Price Program</a>';
		$data['ProgramHeader'] = $this->config_model->find(array('from'=>'Program_Header','order_by'=>array('RecID'=>'')));
		$this->template->set('title', 'Price Program');
		$this->template->load('template', 'program/programprice',$data);
	}
	
	public function find_pack()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$RecID = base64_decode($this->input->get('RecID'));
			if (isset($RecID) && !empty($RecID)) {
				$where = array('a.RecID' => $RecID);
			} else {
				$where = null;
			}
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'b.ProgramName',
					'c.StageName',
					'c.StageCode',
					'a.PackName',
					'a.PackType',
					"CASE a.Status 
					  WHEN 0 THEN 'Tidak Aktif'
					  WHEN 1 THEN 'Aktif'
					END as Status",
					'a.Status as StatusID',
					'a.ProgramHeaderID'
				),
				'from' => 'Program_Pack a',
				'join' => array(
					'Program_Header b' => array(
						'on' => 'a.ProgramHeaderID=b.RecID',
						'type' => 'inner'
					),
					'Student_Stage c' => array(
						'on' => 'b.StageCode=c.StageCode',
						'type' => 'inner'
					)
				),
				'where' => $where,
				'order_by' => array('a.RecID' => '')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function add_pack()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->insert(array(
					'params' => array(
						'PackName' => base64_decode($this->input->post('PackName')),
						'ProgramHeaderID' => base64_decode($this->input->post('ProgramHeader')),
						'Status' => base64_decode($this->input->post('Status')),
						'PackType' => base64_decode($this->input->post('PackType')),
						'CreatedDate'=> date('Y-m-d H:i:s'),
						'CreatedBy'=> $this->session->userdata('Username')
					),
					'from' => 'Program_Pack'
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
	
	public function edit_pack()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'PackName' => base64_decode($this->input->post('PackName')),
						'ProgramHeaderID' => base64_decode($this->input->post('ProgramHeader')),
						'Status' => base64_decode($this->input->post('Status')),
						'PackType' => base64_decode($this->input->post('PackType')),
					),
					'from' => 'Program_Pack',
					'where' => array('RecID' => base64_decode($this->input->post('RecID')))
				));
				echo json_encode(array('message'=>'Data berhasil diubah','notify'=>'success'));
			} catch (Exception $e) {
				echo json_encode(array('message'=>'Data gagal diubah','notify'=>'warning'));
			}
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function delete_pack()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->delete(array(
					'from' => 'Program_Pack',
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

} 