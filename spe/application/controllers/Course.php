<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('config_model');
    } 

	public function index()
	{	
		$this->load->view('Course/index');
	}
	
	public function detail()
	{
		$this->load->view('Course/detail');
	}

	public function get_category()
	{
        $arr = array(
            'from' => 'Course_Category a',
            'order_by' => array('a.RecID' => '')
        );
        $sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function get_pack()
	{
        $arr = array(
			'select' => array(
				'b.RecID',
				'b.PackName',
				'b.Description',
				'b.Price',
				'a.CatName',
				'a.TotalStudents as Tot',
				'b.bgimage'
			),
            'from' => 'Course_Category a',
			'join' => array(
				'Course_Pack b' => array(
					'on' => 'a.RecID=b.CatID',
					'type' => 'inner'
				),
			),
            'where' => array('a.RecID' => base64_decode($this->input->post('id'))),
            'order_by' => array('a.RecID' => '')
        );
        $sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}
	
	public function checkout()
	{
		$id = base64_decode($this->input->post('id'));
        $arr = array(
            'from' => 'Course_Category a',
			'join' => array(
				'Course_Pack b' => array(
					'on' => 'a.RecID=b.CatID',
					'type' => 'inner'
				),
			),
            'where' => array('b.RecID' => $id),
        );
		$query = $this->config_model->find($arr)->row_array();
		$data['PackName'] = $query['CatName'].' - '.$query['PackName']; 
		$data['PackName2'] = $query['PackName'].' - '.$query['CatName']; 
		$data['price'] = $query['Price']; 
		$data['totstu'] = $query['TotalStudents']; 
		$data['stagecat'] = $query['StageCat']; 
		$data['id'] = $id;
		$this->load->view('Course/checkout',$data);
	}

	public function save_ordertmp()
	{
		$data = array(
			'params' => array(
				'SubID' => base64_decode($this->input->post('id')),
				'SessionID' => $this->input->post('session'),
				'Price' => base64_decode($this->input->post('price')),
				'CreatedDate'=> date('Y-m-d H:i:s'),
			),
			'from' => 'Course_OrderDetailTmp',
		);
		$msg = $this->config_model->insert($data);

		$sesid = $this->input->post('session');
        $arr = array(
            'from' => 'Course_OrderDetailTmp a',
			'join' => array(
				'Course_Subjects b' => array(
					'on' => 'a.SubID=b.RecID',
					'type' => 'left'
				),
			),
            'where' => array('a.SessionID' => $sesid),
        );
        $sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function del_ordertmp()
	{
		$this->config_model->delete(array(
			'from' => 'Course_OrderDetailTmp',
			'where' => array('SubID' => base64_decode($this->input->post('id')), 'SessionID' => $this->input->post('session'))
		));

		$sesid = $this->input->post('session');
        $arr = array(
            'from' => 'Course_OrderDetailTmp a',
			'join' => array(
				'Course_Subjects b' => array(
					'on' => 'a.SubID=b.RecID',
					'type' => 'left'
				),
			),
            'where' => array('a.SessionID' => $sesid),
        );
        $sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function get_sesi()
	{
		$packid = base64_decode($this->input->post('packid'));
        $arr = array(
            'from' => 'Course_PackDetail a',
            'where' => array('a.PackID' => $packid),
        );
        $sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function get_packdetail()
	{
		$id = base64_decode($this->input->post('id'));
        $arr = array(
        	'select' => array(
        		'a.RecID',
        		'a.PackID',
        		'a.PackDetailName',
        		'a.PriceDetail',
        		'a.TotalMeet','b.PackName',
        		'b.StageCat',
        		'c.TotalStudents',
        		'b.TotalSub',
        		'b.CatID'
        	),
            'from' => 'Course_PackDetail a',
			'join' => array(
				'Course_Pack b' => array(
					'on' => 'a.PackID=b.RecID',
					'type' => 'inner'
				),
				'Course_Category c' => array(
					'on' => 'b.CatID=c.RecID',
					'type' => 'inner'
				),
			),
            'where' => array('a.RecID' => $id),
        );
        $sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function get_stage($id)
	{
		$arr = array(
				'from' => 'Student_Stage',
				'where' => array('StageCat' => $id),
			);

		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function get_mapel($StageCat)
	{
        $arr = array(
            'from' => 'Course_Subjects a',
            'where' => array('a.StageCat' => $StageCat),
        );
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

}