<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller {
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
	}

	public function Deposit()
	{
		restrict();/*
		if ($this->session->userdata('UserGroup')==21) {*/
			$data['breadcrumb_1'] = '<a href="'.base_url().'Finance/Deposit">Deposit</a>';
			$this->template->set('title', 'Deposit');
			$this->template->load('template', 'Finance/Deposit',$data);
		/*} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
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
	
	public function find_deposit()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$Cabang = base64_decode($this->input->get('Cabang'));
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'a.BranchCode as Cabang',
					'a.Nominal',
					'a.CreatedDate as Tanggal',
					'a.Description'
				),
				'from' => 'FA_DepositDetail a',
				'where' => array('a.BranchCode' => $Cabang, 'a.IsInOrOut' => 1),
				'order_by' => array('a.RecID' => '')
			))->result_array();
			$data['data2'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'b.KodeAreaCabang as KodeCabang',
					'a.Nominal',
					'b.NamaAreaCabang as NamaCabang',
				),
				'from' => $this->db2.'areacabang b',
				'join' => array(
					'FA_Deposit a' => array(
						'on' => 'a.BranchCode=b.KodeAreaCabang',
						'type' => 'left'
					)
				),
				'where' => array('b.KodeAreaCabang' => $Cabang),
				'order_by' => array('a.RecID' => '')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function find_depositout()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$Cabang = base64_decode($this->input->get('Cabang'));
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'a.BranchCode as Cabang',
					'a.Nominal',
					'a.CreatedDate as Tanggal',
					'a.Description',
					"CASE a.Status 
					  WHEN 0 THEN 'Proses'
					  WHEN 1 THEN 'Ok'
					  WHEN 2 THEN 'Cancel'
					END as Status"
				),
				'from' => 'FA_DepositDetail a',
				'where' => array('a.BranchCode' => $Cabang, 'a.IsInOrOut' => 2),
				'order_by' => array('a.RecID' => '')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function add_deposit()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$Cabang = base64_decode($this->input->post('Cabang'));
				$Nominal = base64_decode($this->input->post('Nominal'));
				$arr = array(
						'from' => 'FA_Deposit a',
						'where' => array('a.BranchCode' => $Cabang),
					);
				$item = $this->config_model->find($arr);
				//echo json_encode($data);
				if ($item->num_rows()==0) {
					$this->config_model->insert(array(
						'params' => array(
							'BranchCode' => base64_decode($this->input->post('Cabang')),
							'Nominal' => base64_decode($this->input->post('Nominal')),
							//'Description' => base64_decode($this->input->post('Description')),
		    				'EditDate' => date('Y-m-d H:i:s'),
		    				'EditBy' => $this->session->userdata('Username'),
						),
						'from' => 'FA_Deposit'
					));
				} else {	
					$this->db->query("UPDATE FA_Deposit set Nominal=Nominal+(".$Nominal."), EditDate = '".date('Y-m-d H:i:s')."', EditBy = '".$this->session->userdata('Username')."' WHERE BranchCode = '".$Cabang."'");
				}
					$this->config_model->insert(array(
						'params' => array(
							'BranchCode' => base64_decode($this->input->post('Cabang')),
							'Nominal' => base64_decode($this->input->post('Nominal')),
							'Description' => base64_decode($this->input->post('Description')),
		    				'CreatedDate' => date('Y-m-d H:i:s'),
		    				'CreatedBy' => $this->session->userdata('Username'),
		    				'IsInOrOut' => 1,
		    				'Status' => 1
						),
						'from' => 'FA_DepositDetail'
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
	
	public function Logtrans(){

		restrict();
		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$token = base64_decode($this->input->get('token'));
			$Kode = base64_decode($this->input->get('Kode'));
			//$pr = $this->input->get('PR_Number');
		} else if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$token = base64_decode($this->input->post('token'));
			$Kode = base64_decode($this->input->post('Kode'));
			//$pr = $this->input->post('PR_Number');
			//$Cabang = $this->input->post('Branch');
		} else {
			$token = null;
			$Kode = null;
			//$pr = $this->input->post('PR_Number');
			//$Cabang = $this->input->post('Branch');
		}
		if (isset($token) && !empty($token) && $Kode == 0) {
			$Status = base64_decode($this->input->get('Status'));
			if($Status==''){
			$where = "b.BranchCode != '9999' AND a.RESULTMSG is null OR b.BranchCode != '9999' AND a.RESULTMSG = 'SETTLE'";
			} else if($Status=='WAITING'){
			$where = "b.BranchCode != '9999' AND a.RESULTMSG is null";
			} else {
			$where = "b.BranchCode != '9999' AND a.RESULTMSG = '$Status'";
			}
			$output['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'a.RecID',
					'a.TRANSIDMERCHANT',
					'a.AMOUNT',
					'a.RESULTMSG',
					'b.PR_Number',
					'a.PAYMENTDATETIME',
					'a.PAYMENTCODE'
				),
				'from' => 'Logistics_Transactions a',
				'join' => array(
					'Logistics_Invoice b' => array(
						'on' => 'a.TRANSIDMERCHANT=b.Invoice_Number',
						'type' => 'inner',
					),
				),
				'where' => $where,
				'order_by' => array('a.RecID' => DESC ),
			))->result_array();
			echo data_json($output);
		} else {
			$this->db->query("INSERT INTO  Logistics_TransactionsBankTmp (
								RecIDTrans,
								BranchCode,
								ImportDate,
								TransDate,
								TransTime,
								PayCode,
								Amount,
								IsSettle)
						    SELECT 
								a.RecID,
								a.KodeCabang,
								a.TanggalImport,
								a.TanggalTransaksi,
								a.WaktuTransaksi,
								'01782'+a.NoVA,
								a.Nominal,
								0
						    FROM TPrimaEdu_Prod.dbo.transaksibank a
						        LEFT JOIN Logistics_TransactionsBankTmp b ON a.RecID = b.RecIDTrans
						    WHERE
						        b.RecIDTrans IS NULL and a.NoReferensi like '%02' and 
						        len(a.NoReferensi) = '6' and a.TanggalTransaksi >= '2018-07-07'");
			$this->db->query("UPDATE Logistics_Transactions set RESULTMSG = 'SETTLE' 
								from (select a.PAYMENTCODE AS PayCode, a.AMOUNT as AMOUNT, sum(b.Amount) as AMOUNT2
								from Logistics_Transactions a 
								join Logistics_TransactionsBankTmp b on a.PAYMENTCODE=b.PayCode
								where a.PAYMENTCODE = b.PayCode and a.RESULTMSG is null and b.IsSettle = 0
								group by a.PAYMENTCODE, a.AMOUNT 
								having sum(b.Amount)=a.AMOUNT) Grouped where Logistics_Transactions.PAYMENTCODE=Grouped.PayCode and 
								Logistics_Transactions.AMOUNT=Grouped.AMOUNT and Logistics_Transactions.RESULTMSG is null");
			$this->db->query("UPDATE Logistics_TransactionsBankTmp  set IsSettle = 1
								from (select a.RecID as RecID from Logistics_TransactionsBankTmp a
								join Logistics_Transactions b on a.PayCode=b.PAYMENTCODE
								where RESULTMSG = 'SETTLE') AB where Logistics_TransactionsBankTmp.RecID=AB.RecID");
			$this->db->query("UPDATE Logistics_Transactions SET Logistics_Transactions.PAYMENTDATETIME = format(CAST(b.TransDate AS DATETIME) + CAST(b.TransTime AS DATETIME),'yyyyMMddHHmmss')
								from Logistics_Transactions a
								join Logistics_TransactionsBankTmp b on a.PAYMENTCODE=b.PayCode and a.AMOUNT=b.Amount
								where a.PAYMENTDATETIME is null and PAYMENTCHANNEL='0' and RESULTMSG = 'SUCCESS'");
			$data['breadcrumb_1'] = '<a href="#">Transaksi Pembelian Buku</a>';
			$this->template->set('title', 'PrimaEdu');
		/*if ($this->session->userdata('UserGroup')!=45) {
			$this->template->load('template', 'Logistics/comingsoon',$data);
		} else {*/
			$this->template->load('template', 'Finance/Logtrans',$data);
		/*}*/
		}
	}

	public function settle(){
			restrict();
			$token = base64_decode($this->input->post('token'));
			$RecID = base64_decode($this->input->post('inv'));
			if (isset($token) && !empty($token)) {
				$data = array(
    				'params' => array(
						'RESULTMSG' => 'SUCCESS',
						'CreatedDatePayment' => date("Y-m-d H:i:s")
					),
			    	'from' => 'Logistics_Transactions',
					'where' => array('RecID'=>$RecID),
				);
		    	$msg = $this->config_model->update($data);
		 		$arr2 = array(
					'select' => array(
						'a.PR_Number as PR_Number',
						'a.BranchCode as BranchCode',
						'a.Invoice_Number as Invoice_Number'
					),
					'from' => 'Logistics_Invoice a',
					'join' => array(
						'Logistics_Transactions b' => array(
							'on' => 'a.Invoice_Number=b.TRANSIDMERCHANT',
							'type' => 'inner',
						),
					),
					'where' => array('b.RecID'=>$RecID),
				);
				$sql = $this->config_model->find($arr2)->row_array();
				$data2 = array(
	    			'params' => array(
		    			'PR_Number' => $sql['PR_Number'],
		    			'Tracking_Name' => 'Pembayaran Berhasil',
		    			'Status' => 1,
		    			'CreatedDate' => date('Y-m-d H:i:s'),
		    			'CreatedBy' => 'doku'
		    		),
		    		'from' => 'Logistics_Tracking',
	    		);
	    		$this->config_model->insert($data2);
		    	$data3 = array(
		    		'params' => array(
			    		'Status' => 2,
			    		'EditDate' => date('Y-m-d H:i:s'),
			    		'EditBy' => 'doku',
			    	),
			    	'from' => 'Logistics_POHeader',
					'where' => array('PR_Number'=>$sql['PR_Number']),
		    	);
	    		$this->config_model->update($data3);
				$arr = array(
					'params' => array(
						'Invoice_Status' => 2,
					),
					'from' => 'Logistics_Invoice',
					'where' => array('Invoice_Number'=>$sql['Invoice_Number']),
				);
				$this->config_model->update($arr);
				$arr3 = array(
					'params' => array(
						'Status' => 1,
			    		'EditDate' => date('Y-m-d H:i:s'),
			    		'EditBy' => 'doku',
					),
					'from' => 'FA_DepositDetail',
					'where' => array('BranchCode'=>$sql['BranchCode'],'Status'=>0,'IsInOrOut'=>2),
				);
				$this->config_model->update($arr3);
				$this->db->query("UPDATE Logistics_Transactions SET Logistics_Transactions.PAYMENTDATETIME = format(CAST(b.TransDate AS DATETIME) + CAST(b.TransTime AS DATETIME),'yyyyMMddHHmmss')
								from Logistics_Transactions a
								join Logistics_TransactionsBankTmp b on a.PAYMENTCODE=b.PayCode and a.AMOUNT=b.Amount
								where a.PAYMENTDATETIME is null and PAYMENTCHANNEL='0' and RESULTMSG = 'SUCCESS'");
				echo data_json(array("message"=>"Status transaksi SUCCESS.","notify"=>"success"));
			} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
}