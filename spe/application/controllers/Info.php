<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

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

	public function pembayaran($sess)
	{	
		$data['sessid'] = $sess;
		$this->load->view('info/pembayaran',$data);
	}

	public function get_detailpack()
	{
        $arr = array(
			'select' => array(
				'e.CatName',
				'c.PackName',
				'b.PackDetailName',
				'd.StageName',
				'a.ReferalCode',
				'b.TotalMeet',
				'e.TotalStudents',
				'a.Status',
				'a.TotalPrice'
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
				'Student_Stage d' => array(
					'on' => 'd.StageCode=a.StageCode',
					'type' => 'inner'
				),
				'Course_Category e' => array(
					'on' => 'c.CatID=e.RecID',
					'type' => 'inner'
				),
			),
            'where' => array('a.SessionID' => base64_decode($this->input->post('sessid'))),
        );
        $sql = $this->config_model->find($arr);

        $arr2 = array(
            'from' => 'Course_OrderDetail a',
			'join' => array(
				'Course_Subjects b' => array(
					'on' => 'a.SubID=b.RecID',
					'type' => 'inner'
				),
				'Course_ScheduleTemplate c' => array(
					'on' => 'a.TimeFromScheDule=c.TimeFrom',
					'type' => 'inner'
				),
			),
			'order_by' => array('a.RecID' => ''),
            'where' => array('a.SessionID' => base64_decode($this->input->post('sessid'))),
        );
        $sql2 = $this->config_model->find($arr2);

        $arr3 = array(
            'from' => 'Course_OrderStudent a',
            'where' => array('a.SessionID' => base64_decode($this->input->post('sessid'))),
        );
        $sql3 = $this->config_model->find($arr3);

        $arr4 = array(
            'from' => 'Course_OrderHeader a',
			'join' => array(
				'Logistics_Transactions b' => array(
					'on' => 'a.OrderCode=b.TRANSIDMERCHANT',
					'type' => 'inner'
				),
			),
            'where' => array('a.SessionID' => base64_decode($this->input->post('sessid'))),
        );
        $sql4 = $this->config_model->find($arr4);

		$data['rows'] = $sql->result_array();
		$data['rows2'] = $sql2->result_array();
		$data['rows3'] = $sql3->result_array();
		$data['rows4'] = $sql4->result_array();

		echo json_encode($data);
	}
}