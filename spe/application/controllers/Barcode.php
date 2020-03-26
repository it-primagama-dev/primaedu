<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode extends CI_Controller {
	private $db2 = "TPrimaEdu_Prod.dbo.";

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('config_model');
        $this->load->library(array('PHPExcel/PHPExcel'));
    } 

	public function index()
	{	
		restrict();
				$output['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'a.PR_Number',
					'a.Barcode',
					'a.BranchCode',/*
					'd.ItemCode',*/
				),
				'from' => 'Logistics_BranchBarcodeTmp a',
				'join' => array(
					'Logistics_BranchBarcode b' => array(
						'on' => 'a.Barcode=b.Barcode',
						'type' => 'left',
					),
/*					'(SELECT Barcode FROM Logistics_BranchBarcodeTmp GROUP BY Barcode HAVING   COUNT(Barcode) > 1) c' => array(
						'on' => 'a.Barcode=c.Barcode',
						'type' => 'left',
					),
*/					/*'Logistics_MasterItem d' => array(
						'on' => 'SUBSTRING(a.Barcode,5,4)=d.BarcodeId',
						'type' => 'left',
					),*/
					'Logistics_ItemBarcode e' => array(
						'on' => 'a.Barcode=e.Barcode',
						'type' => 'left',
					),
				),
				/*'where' => array('e.Years' => 5),*/
			))->result_array();
			echo data_json($output);
	}

	public function Branch(){

		restrict();
		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$token = base64_decode($this->input->get('token'));
			$Kode = base64_decode($this->input->get('Kode'));
			$pr = $this->input->get('PR_Number');
		} else if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$token = base64_decode($this->input->post('token'));
			$Kode = base64_decode($this->input->post('Kode'));
			$pr = $this->input->post('PR_Number');
			$Cabang = $this->input->post('Branch');
		} else {
			$token = null;
			$Kode = null;
			$pr = $this->input->post('PR_Number');
			$Cabang = $this->input->post('Branch');
		}
		if(isset($_FILES["file"]["name"]) && !empty($_FILES["file"]["name"]) && $_FILES['file']['type']=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);

			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				$data = [];
				for($row=2; $row <= $highestRow; $row++)
				{
					$Barcode = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					if (empty($Barcode) || $Barcode == "" || $Barcode == null) {
						continue;
					} else if (strlen($Barcode) <> 14) {
						continue;
					} else {
						$bcode = $Barcode;
					}
					$this->config_model->delete(array('where'=>array('Barcode'=> addslashes($bcode)),'or_where'=>array('len(Barcode) <>'=>'14','isnumeric(Barcode)'=>''),'from'=>'PrimaDB.dbo.Logistics_BranchBarcodeTmp'));
					array_push($data, [
						'Barcode' => $bcode,
						'PR_Number' => $pr,
						'BranchCode' => $Cabang
					]);
				}
				$sql = $this->config_model->insert_multiple($data,'PrimaDB.dbo.Logistics_BranchBarcodeTmp');
				if ($sql==true ) {
					echo data_json(array("message"=>"Data berhasil diimport.","notify"=>"success"));
				} else {
					echo data_json(array("message"=>"Data gagal diimport.","notify"=>"error"));
				}
			}
		} elseif (isset($token) && !empty($token) && $Kode == 0) {
			$output['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'a.PR_Number',
					'a.Barcode',
					'a.BranchCode',
					'd.ItemCode',
					"CASE WHEN d.ItemCode is null THEN 'Yes' ELSE 'No' END as NoValid",
					"CASE WHEN b.Barcode ='' OR b.Barcode is null THEN 'No' ELSE 'Yes' END as DuplicateDB",
					"CASE WHEN c.Barcode ='' OR c.Barcode is null THEN 'No' ELSE 'Yes' END as DuplicateExcel",
					"CASE WHEN e.Barcode ='' OR e.Barcode is null THEN 'Yes' ELSE 'No' END as StokPusat",
				),
				'from' => 'Logistics_BranchBarcodeTmp a',
				'join' => array(
					'Logistics_BranchBarcode b' => array(
						'on' => 'a.Barcode=b.Barcode',
						'type' => 'left',
					),
					'(SELECT Barcode FROM Logistics_BranchBarcodeTmp GROUP BY Barcode HAVING   COUNT(Barcode) > 1) c' => array(
						'on' => 'a.Barcode=c.Barcode',
						'type' => 'left',
					),
					'Logistics_MasterItem d' => array(
						'on' => 'SUBSTRING(a.Barcode,5,4)=d.BarcodeId',
						'type' => 'left',
					),
					'Logistics_ItemBarcode e' => array(
						'on' => 'a.Barcode=e.Barcode AND e.Years=5',
						'type' => 'left',
					),
				),
				//'where' => array('e.Years' => 5),
			))->result_array();
			echo data_json($output);
		} elseif (isset($token) && !empty($token) && $Kode == 1) {
			$output['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY d.RecID DESC) as RowNum',
					'd.ItemCode',
					'COUNT(a.Barcode) AS jmlBC',
				),
				'from' => 'Logistics_BranchBarcodeTmp a',
				'join' => array(
					'Logistics_MasterItem d' => array(
						'on' => 'SUBSTRING(a.Barcode,5,4)=d.BarcodeId',
						'type' => 'inner',
					),
				),
				'group_by' => 'd.RecID,d.ItemCode',
			))->result_array();
			echo data_json($output);
		} elseif (isset($token) && !empty($token) && $Kode == 2) {
			try {
				$this->config_model->manualQuery("TRUNCATE TABLE Logistics_BranchBarcodeTmp");
				echo json_encode(array('message'=>'Data berhasil direset.','notify'=>'success'));
			} catch (Exception $e) {
				echo json_encode(array('message'=>$e,'notify'=>'error'));
			}
		} else {
			$data['breadcrumb_1'] = '<a href="#">Barcode Cabang</a>';
			$this->template->set('title', 'PrimaEdu');
			$this->template->load('template', 'Barcode/Branch',$data);
		}
	}
	
	public function BranchScan()
	{

		/*$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {*/
			$pr = $this->input->post('PR_Number');
			$Cabang = $this->input->post('Branch');
			$Barcode = $this->input->post('Barcode');

			$sql = $this->config_model->insert(array(
				'params' => array(
					'BranchCode' => $Cabang,
					'PR_Number' => $pr,
					'Barcode' => $Barcode,
			    ),
				'from' => 'Logistics_BranchBarcodeTmp'
			));

			if ($sql==true ) {
				echo data_json(array("message"=>"Data berhasil disimpan.","notify"=>"success"));
			} else {
				echo data_json(array("message"=>"Data gagal disimpan.","notify"=>"error"));
			}
		/*} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}

	public function import()
	{
		date_default_timezone_set("Asia/Jakarta");
		/*$Barcode = $this->input->post('Barcode');
		$PR = $this->input->post('PR_Number');
		$Cabang = $this->input->post('Cabang');*/
		$CreatedDate = date('Y-m-d H:i:s');
		$CreatedBy = $this->session->userdata('Username');
		$this->config_model->manualQuery("INSERT into Logistics_BranchBarcode (PR_Number,Barcode,Invalid,Status,CreatedDate,CreatedBy,BranchCode)
			SELECT a.PR_Number,a.Barcode,'0','0','$CreatedDate','$CreatedBy',a.BranchCode 
			from Logistics_BranchBarcodeTmp a
			left join Logistics_ItemBarcode b on a.Barcode=b.Barcode AND b.Years=5
			left join Logistics_BranchBarcode c on a.Barcode=c.Barcode
			where b.Barcode is not null and c.Barcode is null");
		/*if ($msg==true) {*/
			$this->config_model->manualQuery("DELETE a FROM Logistics_BranchBarcodeTmp a left join Logistics_BranchBarcode b ON a.Barcode=b.Barcode where b.Barcode is not null");
			
			$this->config_model->manualQuery("UPDATE
				    Logistics_ItemBarcode
				SET
				    DeliveryStatus = 1
				FROM
				    Logistics_ItemBarcode as a
				    LEFT JOIN Logistics_BranchBarcode AS b
				        ON a.Barcode = b.Barcode
				WHERE
				    b.Barcode is not null and a.Years=5");
			$output['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY d.RecID DESC) as RowNum',
					'd.ItemCode',
					'COUNT(a.Barcode) AS jmlBC',
					'a.CreatedDate',
				),
				'from' => 'Logistics_BranchBarcode a',
				'join' => array(
					'Logistics_MasterItem d' => array(
						'on' => 'SUBSTRING(a.Barcode,5,4)=d.BarcodeId',
						'type' => 'inner',
					),
				),
				'where' => 'a.CreatedDate = (select MAX(CreatedDate) from Logistics_BranchBarcode)',
				'group_by' => array('d.RecID','d.ItemCode','a.CreatedDate'),
				'order_by' => array('a.CreatedDate'=>'DESC'),
			))->result_array();
			echo data_json($output);
		/*} else {
			echo data_json(array('message'=>'Data gagal disimpan.','notify'=>'error'));
		}*/
	}

	public function get_item()
	{
		$arr = array(
				'from' => 'Logistics_MasterItem a',
				'order_by' => array('a.TypeId'=>'','a.PageId' => '')
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

	public function get_pr($Cabang)
	{
		$arr = array(
				'from' => 'Logistics_POHeader a',
				'where' => array('a.BranchCode' => $Cabang, 'a.PR_Date >' => '2019-07-01', 'a.Status' => '3'),
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);		
	}

	public function get_bc()
	{
		$PR = $this->uri->segment(3);
		$BranchCode = $this->uri->segment(4);
		$arr = array(
				'from' => 'Logistics_BranchBarcode a',
				'where' => array('a.PR_Number' => $PR/*,'a.BranchCode' => $BranchCode*/),
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);		
	}

	public function get_dn($pr)
	{
		$arr = array(
				'from' => 'Logistics_DOHeader a',
				'where' => array('a.PR_Number' => $pr),
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);		
	}

	public function list_bc(){
		restrict();
		$token = base64_decode($this->input->get('token'));
		$Kode = base64_decode($this->input->get('Kode'));
		if (isset($token) && !empty($token) && $Kode == 0) {
			$ItemCode = base64_decode($this->input->get('ItemCode'));
			$Barcode = base64_decode($this->input->get('Barcode'));
			if(isset($Barcode) && !empty($Barcode)){
				$where = array('a.Barcode' => $Barcode);
			} else {
				$where = array('d.ItemCode' => $ItemCode);
			}
			$output['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'a.Barcode',
					'a.RecID',
					'd.ItemCode',
					"CASE WHEN a.DeliveryStatus = 1 THEN 'No' ELSE 'Yes' END as Status",
				),
				'from' => 'Logistics_ItemBarcode a',
				'join' => array(
					'Logistics_MasterItem d' => array(
						'on' => 'SUBSTRING(a.Barcode,5,4)=d.BarcodeId',
						'type' => 'left',
					),
				),
				'where' => $where,
			))->result_array();
			echo data_json($output);
		} else {
		$data['breadcrumb_1'] = '<a href="'.base_url().'import-barcode">Barcode Pusat</a>';
		$data['breadcrumb_2'] = '<a href="#">Data Barcode Pusat</a>';
		$this->template->set('title', 'PrimaEdu');
		$this->template->load('template', 'Barcode/list_bc',$data);
		}
	}

	public function list_bcbranch(){
		restrict();
		$token = base64_decode($this->input->get('token'));
		$Kode = base64_decode($this->input->get('Kode'));
		$PR = $this->input->get('PR');
		$Cabang = $this->input->get('Branch');
		$BC = $this->input->get('BC');
		if(isset($BC) && !empty($BC)){
			$where = array('a.Barcode' => $BC);
		} else if(isset($PR) && !empty($PR)){
			$where = array('a.PR_Number' => $PR,'a.BranchCode' => $Cabang);
		} else {
			$where = array('a.BranchCode' => $Cabang);
		}
		if (isset($token) && !empty($token) && $Kode == 0) {
			$output['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'a.PR_Number',
					'a.RecID',
					'a.BranchCode',
					'a.Barcode',
					'e.NoVA',
					'd.ItemCode',
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
		$data['breadcrumb_1'] = '<a href="'.base_url().'Barcode/Branch">Barcode Cabang</a>';
		$data['breadcrumb_2'] = '<a href="#">Data Barcode Cabang</a>';
		$this->template->set('title', 'PrimaEdu');
		$this->template->load('template', 'Barcode/list_bcbranch',$data);
		}
	}
/*
	public function get_bcbranch(){
		restrict();
		$token = base64_decode($this->input->get('token'));
		$Kode = base64_decode($this->input->get('Kode'));
		$PR = $this->input->get('PR');
		if (isset($token) && !empty($token) && $Kode == 0) {
			$output['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'a.PR_Number',
					'a.Barcode',
					'd.ItemCode',
					"CASE WHEN a.Status = 1 THEN 'digunakan' ELSE 'Belum digunakan' END as Status",
					"CASE WHEN a.Invalid = 1 THEN 'Yes' ELSE 'No' END as Invalid",
				),
				'from' => 'Logistics_BranchBarcode a',
				'join' => array(
					'Logistics_MasterItem d' => array(
						'on' => 'SUBSTRING(a.Barcode,5,4)=d.BarcodeId',
						'type' => 'left',
					),
				),
				'where' => array('a.PR_Number' => 'PR2018-9999-02'),
			))->result_array();
			echo data_json($output);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}*/
	
	public function find_updateinvalid()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$RecID = base64_decode($this->input->get('RecID'));
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'a.Invalid',
					'a.Barcode',
				),
				'from' => 'Logistics_BranchBarcode a',
				'where' => array('a.RecID' => $RecID),
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function save_invalid()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'Invalid' => base64_decode($this->input->post('Invalid')),
					),
					'from' => 'Logistics_BranchBarcode',
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

	public function trouble(){
		restrict();
		$token = base64_decode($this->input->get('token'));
		$Kode = base64_decode($this->input->get('Kode'));
		if (isset($token) && !empty($token) && $Kode == 0) {
			$Barcode = base64_decode($this->input->get('Barcode'));
			$where = array('a.Barcode' => $Barcode);
			$output['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'a.Barcode',
					'd.ItemCode',
					"CASE WHEN a.DeliveryStatus = 1 THEN 'No' ELSE 'Yes' END as Status",
				),
				'from' => 'Logistics_ItemBarcode a',
				'join' => array(
					'Logistics_MasterItem d' => array(
						'on' => 'SUBSTRING(a.Barcode,5,4)=d.BarcodeId',
						'type' => 'left',
					),
				),
				'where' => $where,
			))->result_array();
			echo data_json($output);
		} else {
		$data['breadcrumb_1'] = '<a href="'.base_url().'Barcode/Branch">Barcode Cabang</a>';
		$data['breadcrumb_2'] = '<a href="'.base_url().'Barcode/list_bcbranch">Data Barcode Cabang</a>';
		$this->template->set('title', 'PrimaEdu');
		$this->template->load('template', 'Barcode/trouble',$data);
		}
	}
	
	public function find_bcbranch()
	{
			$bc = $this->input->post('bc');
			$data['rows'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'd.ItemCode',
					'a.Barcode',
					'a.BranchCode',
					'a.PR_Number'
				),
				'from' => 'Logistics_BranchBarcode a',
				'join' => array(
					'Logistics_MasterItem d' => array(
						'on' => 'SUBSTRING(a.Barcode,5,4)=d.BarcodeId',
						'type' => 'left',
					),
				),
				'where' => array('a.Barcode' => $bc)
			))->result_array();
			echo json_encode($data);
	}
	
	public function find_bcstok()
	{
			$bc = $this->input->post('bc');
			$data['rows'] = $this->config_model->find(array(
				'from' => 'Logistics_ItemBarcode a',
				'where' => array('a.Barcode' => $bc)
			))->result_array();
			echo json_encode($data);
	}

	public function save_updatebc()
	{
		$token = base64_decode($this->input->post('token'));
		$update = $this->input->post('Update');
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				if($update==1){
				$this->config_model->update(array(
					'params' => array(
						'Barcode' => $this->input->post('BC2'),
					),
					'from' => 'Logistics_BranchBarcode',
					'where' => array('RecID' => $this->input->post('RecID'))
				));
				$this->config_model->update(array(
					'params' => array(
						'Barcode' => $this->input->post('Barcode2'),
					),
					'from' => 'Logistics_BranchBarcode',
					'where' => array('RecID' => $this->input->post('RecID2'))
				));
				$this->config_model->insert(array(
					'params' => array(
						'Barcode1' => $this->input->post('Barcode2'),
						'Barcode2' => $this->input->post('BC2'),
						'Action' => 'Barter Barcode',
						'Description' => $this->input->post('desc'),
		    			'CreatedDate' => date('Y-m-d H:i:s'),
		    			'CreatedBy' => $this->session->userdata('Username'),
					),
					'from' => 'Logistics_BarcodeTrouble'
				));
				} else if($update==2){
				$this->config_model->update(array(
					'params' => array(
						'Barcode' => $this->input->post('BC3'),
					),
					'from' => 'Logistics_BranchBarcode',
					'where' => array('RecID' => $this->input->post('RecID'))
				));
				$this->config_model->insert(array(
					'params' => array(
						'Barcode1' => $this->input->post('Barcode2'),
						'Barcode2' => $this->input->post('BC3'),
						'Action' => 'Ganti Barcode',
						'Description' => $this->input->post('desc2'),
		    			'CreatedDate' => date('Y-m-d H:i:s'),
		    			'CreatedBy' => $this->session->userdata('Username'),
					),
					'from' => 'Logistics_BarcodeTrouble'
				));
				} else if($update==3){
				$this->config_model->delete(array(
					'from' => 'Logistics_BranchBarcode',
					'where' => array('RecID' => $this->input->post('RecID'))
				));
				$this->config_model->update(array(
					'params' => array(
						'DeliveryStatus' => null,
					),
					'from' => 'Logistics_ItemBarcode',
					'where' => array('Barcode' => $this->input->post('Barcode2'))
				));
				$this->config_model->insert(array(
					'params' => array(
						'Barcode1' => $this->input->post('Barcode2'),
						'Barcode2' => '-',
						'Action' => 'Hapus Barcode',
						'Description' => $this->input->post('desc3'),
		    			'CreatedDate' => date('Y-m-d H:i:s'),
		    			'CreatedBy' => $this->session->userdata('Username'),
					),
					'from' => 'Logistics_BarcodeTrouble'
				));
				} else if($update==4){
				$this->config_model->update(array(
					'params' => array(
						'BranchCode' => $this->input->post('Cabang3'),
						'PR_Number' => 'Barcode Mutasi',
		    			'EditDate' => date('Y-m-d H:i:s'),
		    			'EditBy' => $this->session->userdata('Username'),
					),
					'from' => 'Logistics_BranchBarcode',
					'where' => array('RecID' => $this->input->post('RecID'))
				));
				$this->config_model->insert(array(
					'params' => array(
						'Barcode1' => $this->input->post('Barcode2'),
						'Barcode2' => '-',
						'Action' => 'Mutasi Barcode',
						'Description' => $this->input->post('desc4'),
		    			'CreatedDate' => date('Y-m-d H:i:s'),
		    			'CreatedBy' => $this->session->userdata('Username'),
					),
					'from' => 'Logistics_BarcodeTrouble'
				));
				}
				echo json_encode(array('message'=>'Data berhasil diubah','notify'=>'success'));
			} catch (Exception $e) {
				echo json_encode(array('message'=>'Data gagal diubah','notify'=>'warning'));
			}
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function find_bctrouble()
	{
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY RecID DESC) as RowNum',
					'Barcode1',
					'Barcode2',
					'Action',
					'Description'
				),
				'from' => 'Logistics_BarcodeTrouble'
			))->result_array();
			echo json_encode($data);
	}
	
	public function delete_barcode()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
		 		$arr = array(
					'select' => array(
						'd.ItemCode as ItemCode',
					),
					'from' => 'Logistics_ItemBarcode a',
					'join' => array(
						'Logistics_MasterItem d' => array(
							'on' => 'SUBSTRING(a.Barcode,5,4)=d.BarcodeId',
							'type' => 'inner',
						),
					),
					'where' => array('a.RecID'=>base64_decode($this->input->post('RecID'))),
				);
				$sql = $this->config_model->find($arr)->row_array();

				$this->config_model->delete(array(
					'from' => 'Logistics_ItemBarcode',
					'where' => array('RecID' => base64_decode($this->input->post('RecID')))
				));

				$this->config_model->manualQuery("UPDATE Logistics_MasterItem set TotalStock=TotalStock-1
				where ItemCode='".$sql['ItemCode']."'");
				echo json_encode(array('message'=>'Barcode berhasil dihapus','notify'=>'success'));
			} catch (Exception $e) {
				echo json_encode(array('message'=>'Barcode gagal dihapus','notify'=>'warning'));
			}
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
}