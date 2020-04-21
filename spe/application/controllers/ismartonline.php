<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ismartonline extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('config_model');
    } 

	public function index()
	{	
		$this->load->view('ismartonline/index');
	}

	public function get_cabang(){
		$arr = array(
				'from' => 'Course_Referal',
			);

		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
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

	public function get_subject(){
		$arr = array(
				'select' => array(
					"CASE a.StageCat 
					  WHEN 20 THEN 'SD'
					  WHEN 21 THEN 'SMP'
					  WHEN 22 THEN 'SMA IPA'
					  WHEN 23 THEN 'SMA IPS'
					  WHEN 24 THEN 'UTBK'
					END as StageCat",
					'a.RecID',
					'a.SubName'
				),
				'from' => 'Course_Subjects a',
				'order_by' => array('a.StageCat' => ''),
			);

		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}


}