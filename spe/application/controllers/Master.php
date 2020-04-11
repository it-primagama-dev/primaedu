<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	private $db2 = "TPrimaEdu_Prod.dbo.";
	private $web = "webPrimagama.dbo.";
	private $ems = "eLPrimagama.dbo.";

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('config_model');
		$this->load->library(array('PHPExcel/PHPExcel'));
	}

	public function index()
	{	
		$dataEncryption = base64_decode($this->input->get('q'));
		if (isset($dataEncryption) && !empty($dataEncryption)) {
			$Username = base64_decode(explode('-', $dataEncryption)[0]);
			$Password = base64_decode(explode('-', $dataEncryption)[1]);
		} else {
			$Username = $this->session->userdata('Username');
			$Password = $this->session->userdata('Password');
		}

		$arr = array(
			'select' => array(
				'a.*',
				'(ltrim(rtrim(b.KodeAreaCabang))) as KodeAreaCabang',
				'(ltrim(rtrim(b.NamaAreaCabang))) as NamaAreaCabang',
				'(ltrim(rtrim(ac.KodeAreaCabang))) as KodeArea',
				'(ltrim(rtrim(ac.NamaAreaCabang))) as NamaArea',
			),
			'from' => $this->db2.'users a',
			'join' => array(
				$this->db2.'areacabang b' => array(
					'on' => 'a.AreaCabang=b.RecID',
					'type' => 'left',
				),
				$this->db2.'areacabang ac' => array(
					'on' => 'b.Area=ac.KodeAreaCabang',
					'type' => 'left',
				),
			),
			'where' => array('a.Username' => $Username,'a.Password'=>$Password),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows() > 0) {
			foreach ($sql->result_array() as $sess) {
				$sess_data['logged_in'] = true;
				$sess_data['Username'] = $sess['Username'];
				$sess_data['Password'] = $sess['Password'];
				$sess_data['Fullname'] = $sess['Fullname'];
				$sess_data['Email'] = $sess['Email'];
				$sess_data['UserGroup'] = $sess['UserGroup'];
				$sess_data['AreaCabang'] = $sess['AreaCabang'];
				$sess_data['KodeAreaCabang'] = $sess['KodeAreaCabang'];
				$sess_data['NamaAreaCabang'] = $sess['NamaAreaCabang'];
				$sess_data['KodeArea'] = $sess['KodeArea'];
				$sess_data['NamaArea'] = $sess['NamaArea'];
				$this->session->set_userdata($sess_data);
			}
			
			$data['breadcrumb_1'] = '<a href="'.base_url().'">Dashboard</a>';
			$this->template->set('title', 'PrimaEdu');
			$this->template->load('template', 'dashboard',$data);

		} else {
			echo '<script type="text/javascript" src="'.base_url('assets/js/jquery-1.10.2.js').'"></script>'.PHP_EOL;
			echo '<script type="text/javascript" src="'.base_url('assets/plugins/notify/notify.js').'"></script>'.PHP_EOL;
			echo '<script type="text/javascript">
			$(document).ready(function () {
				$.notify("Username atau password anda salah","warn");
				setTimeout(function(){window.top.location="'.str_replace('spe/', '', base_url().'session/end').'"} , 1000);
			});
			</script>'.PHP_EOL;
		}
	}

	public function logout()
	{
		$data = array('Username', 'Password','Fullname','Email','UserGroup','AreaCabang','KodeAreaCabang','NamaAreaCabang','KodeArea','NamaArea');
		$this->session->unset_userdata($data);
		$this->output->set_header("Cache-Control:no-store,no-cache,must-revalidate,no-transform,max-age=0,post-check=0,pre-check=0");
		$this->output->set_header("Pragma:no-cache");
		$this->session->sess_destroy();
		redirect(str_replace('spe/', '', base_url().'session/end'),'refresh');
	}

	public function checkconnection()
	{
		echo 'true';
	}

	public function Ctr_429fd9d1e9d794b43190316b390e368c(){

		restrict();
		if ($this->input->server('REQUEST_METHOD') == 'GET') {
			$token = base64_decode($this->input->get('token'));
			$Kode = base64_decode($this->input->get('Kode'));
		} else if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$token = base64_decode($this->input->post('token'));
			$Kode = base64_decode($this->input->post('Kode'));
		} else {
			$token = null;
			$Kode = null;
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
					$this->config_model->delete(array('where'=>array('Barcode'=> addslashes($bcode)),'or_where'=>array('len(Barcode) <>'=>'14','isnumeric(Barcode)'=>''),'from'=>'PrimaDB.dbo.Logistics_ItemBarcodeTmp'));
					array_push($data, [
						'Barcode' => $bcode
					]);
				}
				$sql = $this->config_model->insert_multiple($data,'PrimaDB.dbo.Logistics_ItemBarcodeTmp');
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
					'a.Barcode',
					'd.ItemCode',
					"CASE WHEN d.ItemCode is null THEN 'Yes' ELSE 'No' END as NoValid",
					"CASE WHEN b.Barcode ='' OR b.Barcode is null OR b.Years = 4 THEN 'No' ELSE 'Yes' END as DuplicateDB",
					"CASE WHEN c.Barcode ='' OR c.Barcode is null THEN 'No' ELSE 'Yes' END as DuplicateExcel",
				),
				'from' => 'Logistics_ItemBarcodeTmp a',
				'join' => array(
					'Logistics_ItemBarcode b' => array(
						'on' => 'a.Barcode=b.Barcode AND b.Years != 4',
						'type' => 'left',
					),
					'(SELECT Barcode FROM Logistics_ItemBarcodeTmp GROUP BY Barcode HAVING   COUNT(Barcode) > 1) c' => array(
						'on' => 'a.Barcode=c.Barcode',
						'type' => 'left',
					),
					'Logistics_MasterItem d' => array(
						'on' => 'SUBSTRING(a.Barcode,5,4)=d.BarcodeId',
						'type' => 'left',
					),
				),
			))->result_array();
			echo data_json($output);
		} elseif (isset($token) && !empty($token) && $Kode == 1) {
			$output['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY d.RecID DESC) as RowNum',
					'd.ItemCode',
					'COUNT(a.Barcode) AS jmlBC',
				),
				'from' => 'Logistics_ItemBarcodeTmp a',
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
				$this->config_model->manualQuery("TRUNCATE TABLE Logistics_ItemBarcodeTmp");
				echo json_encode(array('message'=>'Data berhasil direset.','notify'=>'success'));
			} catch (Exception $e) {
				echo json_encode(array('message'=>$e,'notify'=>'error'));
			}
		} else {
			$data['breadcrumb_1'] = '<a href="#">Barcode Pusat</a>';
			$this->template->set('title', 'PrimaEdu');
			$this->template->load('template', 'ImportBarcode', $data);
		}
	}
	
	public function Ctr_aaa23f56280dce7fdb965e1e280a52d1()
	{
		date_default_timezone_set("Asia/Jakarta");
		$Barcode = $this->input->post('Barcode');
		$data = [];
		for ($i=0; $i < count($Barcode); $i++) { 
			array_push($data, [
				'Barcode'=>$Barcode[$i],
				'CreatedDate'=>date('Y-m-d H:i:s'),
				'CreatedBy'=> $this->session->userdata('Username'),
				'Years'=>5
			]);
		}
		$msg = $this->config_model->insert_multiple($data,'PrimaDB.dbo.Logistics_ItemBarcode');
		if ($msg==true) {
			$this->config_model->manualQuery("DELETE a FROM Logistics_ItemBarcodeTmp a left join Logistics_ItemBarcode b ON a.Barcode=b.Barcode where b.Barcode is not null");
			
			$CreatedDate = date('Y-m-d H:i:s');
			$CreatedBy = $this->session->userdata('Username');
			$this->config_model->manualQuery("
				UPDATE Logistics_MasterItem
				SET
				TotalStock = TotalStock + (t.jmlBC),
				CreatedBy = '{$CreatedBy}',
				CreatedDate = '{$CreatedDate}'
				FROM 
				(
				SELECT
				d.RecID as ID,d.ItemCode,
				COUNT(a.Barcode) AS jmlBC,
				a.CreatedDate
				from Logistics_ItemBarcode a
				join Logistics_MasterItem d ON SUBSTRING(a.Barcode,5,4)=d.BarcodeId 
				where a.CreatedDate = (select MAX(CreatedDate) from Logistics_ItemBarcode)
				group by d.RecID,d.ItemCode,a.CreatedDate
				) t
				WHERE RecID = t.ID");
			$output['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY d.RecID DESC) as RowNum',
					'd.ItemCode',
					'COUNT(a.Barcode) AS jmlBC',
					'a.CreatedDate',
				),
				'from' => 'Logistics_ItemBarcode a',
				'join' => array(
					'Logistics_MasterItem d' => array(
						'on' => 'SUBSTRING(a.Barcode,5,4)=d.BarcodeId',
						'type' => 'inner',
					),
				),
				'where' => 'a.CreatedDate = (select MAX(CreatedDate) from Logistics_ItemBarcode)',
				'group_by' => array('d.RecID','d.ItemCode','a.CreatedDate'),
				'order_by' => array('a.CreatedDate'=>'DESC'),
			))->result_array();
			echo data_json($output);
		} else {
			echo data_json(array('message'=>'Data gagal disimpan.','notify'=>'error'));
		}
	}

	public function profile()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="'.base_url().'master/profile">Profile</a>';
		$data['usergroups'] = $this->config_model->find(array('from'=>$this->db2.'usergroups','order_by'=>array('RecID'=>'desc')));
		$data['access'] = ($this->session->userdata('UserGroup')==14);
		$this->template->set('title', 'Profile');
		$this->template->load('template', 'master/profile',$data);
	}

	public function load_profile()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$usergroups = $this->session->userdata('UserGroup');
			if (isset($usergroups) && $usergroups == 14) {
				$where = null;
			} else {
				$where = array('Username' => $this->session->userdata('Username'));
			}
			$query = array(
				'select' => array(
					'a.RecID',
					'a.Username',
					'a.Password',
					'a.Fullname',
					'a.Email',
					'a.UserGroup',
					'c.GroupName',
					'a.AreaCabang',
					'b.NamaAreaCabang',
					'a.Disabled',
					'a.CreatedAt',
					'a.CreatedBy',
					'a.LastLogin',
					'a.is_web',
					'a.is_ems',
					'a.is_sc'
				),
				'from' => $this->db2.'users a',
				'join' => array(
					$this->db2.'areacabang b' => array(
						'on' => 'a.AreaCabang=b.RecID',
						'type' => 'left'
					),
					$this->db2.'usergroups c' => array(
						'on' => 'a.UserGroup=c.RecID',
						'type' => 'left'
					)
				),
				'where' => $where,
				'order_by' => array('a.RecID' => 'desc')
			);

			$output = array(
                "draw" => isset($_POST['draw'])?$_POST['draw']:die,
                "recordsTotal" => $this->config_model->count_all($query),
                "recordsFiltered" => $this->config_model->count_filtered($query),
                "data" => $this->config_model->get_datatables($query)
            );
            echo json_encode($output);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function find_profile()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$usergroups = $this->session->userdata('UserGroup');
			$data = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'a.Username',
					'a.Password',
					'a.Fullname',
					'a.Email',
					'a.UserGroup',
					'c.GroupName',
					'a.AreaCabang',
					'b.NamaAreaCabang',
					'a.Disabled',
					'a.CreatedAt',
					'a.CreatedBy',
					'a.LastLogin',
					'a.is_web',
					'a.is_ems',
					'a.is_sc'
				),
				'from' => $this->db2.'users a',
				'join' => array(
					$this->db2.'areacabang b' => array(
						'on' => 'a.AreaCabang=b.RecID',
						'type' => 'left'
					),
					$this->db2.'usergroups c' => array(
						'on' => 'a.UserGroup=c.RecID',
						'type' => 'left'
					)
				),
				'where' => array('a.RecID' => base64_decode($this->input->get('RecID')))
			))->row_array();
            echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function add_profile()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$user = base64_decode($this->input->post('Username'));
			$cek_username = $this->config_model->find(array(
				'select' => array('Username'),
				'from' => $this->db2.'users',
				'where' => array('Username' => $user)
			))->num_rows();
			if ($cek_username > 0) {
				echo json_encode(array('message'=>'Username sudah digunakan','notify'=>'info'));
			} else {
				try {
					$this->config_model->insert(array(
						'params' => array(
							'Username' => base64_decode($this->input->post('Username')),
							'Fullname' => base64_decode($this->input->post('Fullname')),
							'Email' => base64_decode($this->input->post('Email')),
							'Password' => sha1(base64_decode($this->input->post('Password'))),
							'UserGroup' => base64_decode($this->input->post('UserGroup')),
							'AreaCabang' => base64_decode($this->input->post('AreaCabang')),
							'Disabled' => base64_decode($this->input->post('Disabled')),
							'CreatedBy' => $this->session->userdata('Username'),
							'LastLogin' => null
						),
						'from' => $this->db2.'users'
					));
					echo json_encode(array('message'=>'Data berhasil disimpan','notify'=>'success'));
				} catch (Exception $e) {
					echo json_encode(array('message'=>'Data gagal disimpan','notify'=>'warning'));
				}
			}
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function edit_profile()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$sql = $this->config_model->find(array(
					'from' => $this->db2.'users',
					'where' => array('RecID'=>base64_decode($this->input->post('RecID')),'Password'=> base64_decode($this->input->post('Password'))),
				));
				if ($sql->num_rows()>0) {
					$this->config_model->update(array(
						'params'=>array(
							'Username' => base64_decode($this->input->post('Username')),
							'Fullname' => base64_decode($this->input->post('Fullname')),
							'Email' => base64_decode($this->input->post('Email')),
							'UserGroup' => base64_decode($this->input->post('UserGroup')),
							'AreaCabang' => base64_decode($this->input->post('AreaCabang')),
							'Disabled' => base64_decode($this->input->post('Disabled')),
							'CreatedBy' => $this->session->userdata('Username')
						),
						'from' => $this->db2.'users',
						'where' => array('RecID'=> base64_decode($this->input->post('RecID'))),
					));
				} else {
					$this->config_model->update(array(
						'params'=>array(
							'Username' => base64_decode($this->input->post('Username')),
							'Fullname' => base64_decode($this->input->post('Fullname')),
							'Email' => base64_decode($this->input->post('Email')),
							'Password' => sha1(base64_decode($this->input->post('Password'))),
							'UserGroup' => base64_decode($this->input->post('UserGroup')),
							'AreaCabang' => base64_decode($this->input->post('AreaCabang')),
							'Disabled' => base64_decode($this->input->post('Disabled')),
							'CreatedBy' => $this->session->userdata('Username')
						),
						'from' => $this->db2.'users',
						'where' => array('RecID'=>base64_decode($this->input->post('RecID'))),
					));
				}
				echo data_json(array("message"=>"Data berhasil diubah.","notify"=>"success"));
			} catch (Exception $ex) {
				echo data_json(array("message"=>$ex,"notify"=>"error"));
			}
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function get_areacabang()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$sql = $this->config_model->find(array(
				'select' => array(
					'RecID',
					'NamaAreaCabang',
					'KodeAreaCabang'
				),
				'from' => $this->db2.'areacabang',
				'where' => array('Area !=' => null),
				'like' => array(
					'NamaAreaCabang' => $this->input->get('search'),
				),
				'items_per_page' => 10,
				'order_by' => array('RecID'=>'DESC')
			));
			if ($sql->num_rows() >0) {
				foreach ($sql->result_array() as $row) {
					$data['results'][] = array(
						"id"=> $row['RecID'],
						"text"=> $row['NamaAreaCabang'],
					);
				}
			} else {
				$data['results'][] = array(
					"id"=> 0,
					"text"=> "Data tidak ditemukan.",
				);
			}
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function reset_password()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'Password' => sha1('pass@primaedu')
					),
					'from' => $this->db2.'users',
					'where' => array('RecID' => base64_decode($this->input->post('RecID')))
				));
				echo json_encode(array('message'=>'Data berhasil direset','notify'=>'success'));
			} catch (Exception $e) {
				echo json_encode(array('message'=>'Data gagal direset','notify'=>'warning'));
			}
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function delete_profile()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->delete(array(
					'from' => $this->db2.'users',
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

	public function sinkron_web()
	{
		$spe = $this->config_model->find(array(
			'select' => array(
				"a.Username",
				"a.Fullname",
				"a.Email",
				"b.RecID",
				"RTRIM(b.KodeAreaCabang) AS cabang",
				"b.NamaAreaCabang",
			),
			"from" => $this->db2."users a",
			"join" => array(
				$this->db2."areacabang b" => array(
					"on" => "a.AreaCabang=b.RecID",
					"type" => "left"
				),
			),
			"where" => array("a.RecID" => $this->input->post('RecID'))
		))->row_array();

		$web = $this->config_model->find(array(
			'select' => array("username","id"),
			"from" => $this->web."users",
			"where" => array("username" => $spe['Username'])
		));
		$datas = $web->row_array();

		if ($web->num_rows() < 1) {
			$this->config_model->insert(array(
				'params' => array(
					"username" => $spe['Username'],
					"password" => md5('1sampai8'),
					"nama" => $spe['Fullname'],
					"jk" => null,
					"email" => $spe['Email'],
					"foto" => null,
					"role" => 14,
					"KodeCabang" => $spe['RecID'],
					"created" => date('Y-m-d H:i:s'),
					"PicName" => null,
					"PicMime" => null,
					"PicFile" => null,
					"aktif" => 1
				),
				"from" => $this->web."users"
			));
		} else {
			$this->config_model->update(array(
				'params' => array(
					"username" => $spe['username'],
					"nama" => $spe['Fullname'],
					"email" => $spe['Email'],
					"role" => 14,
					"KodeCabang" => $spe['AreaCabang'],
					"modified" => date('Y-m-d H:i:s'),
					"aktif" => 1
				),
				"from" => $this->web."users",
				"where" => array("id" => $datas['id'])
			));
		}
		$body = '
		<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:15px;">
			<tr>
				<td>Yth, Cabang '.$spe['NamaAreaCabang'].'. Berikut kami lampirkan akun untuk login ke web primagama.co.id:</td>
			</tr>
		</table>
		<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:15px;">
			<tr>
				<td width="150px;">Username</td>
				<td width="5px;">:</td>
				<th>'.$spe['Username'].'</th>
			</tr>
			<tr>
				<td width="150px;">Password</td>
				<td width="5px;">:</td>
				<th>1sampai8</th>
			</tr>
		</table>
		<table border="0" cellspacing="0" cellpadding="5" style="padding-top:15px;padding-bottom:15px">
			<td>Demikian yang dapat kami sampaikan, terima kasih.</td>
		</table>'.msg_fotter();

		$asg = batch_email(array(
			// 'penerima' => array('if.hamzah93@gmail.com'),
			'penerima' => array($spe['Email'],'helpdesk@primagama.co.id'),
			'subjek' => array('Informasi Akun Web primagama.co.id'),
			'body' => array($body)
		));
		if ($asg==true) {
			$this->config_model->update(array(
				'params' => array("is_web" => 1),
				"from" => $this->db2."users",
				"where" => array("RecID" => $this->input->post('RecID'))
			));
			echo json_encode(array('message'=>'Data berhasil disinkronkan','notify'=>'success'));
		} else {
			echo json_encode(array('message'=>'Data berhasil disinkronkan','notify'=>'error'));
		}
	}

	public function sinkron_ems()
	{
		$spe = $this->config_model->find(array(
			'select' => array(
				"a.Username",
				"a.Fullname",
				"a.Email",
				"b.RecID",
				"RTRIM(b.KodeAreaCabang) AS cabang",
				"b.NamaAreaCabang",
			),
			"from" => $this->db2."users a",
			"join" => array(
				$this->db2."areacabang b" => array(
					"on" => "a.AreaCabang=b.RecID",
					"type" => "left"
				),
			),
			"where" => array("a.RecID" => $this->input->post('RecID'))
		))->row_array();

		$ems = $this->config_model->find(array(
			'select' => array("user_name","id_user"),
			"from" => $this->ems."user",
			"where" => array("user_name" => $spe['Username'])
		));

		$ems_num = $this->config_model->find(array(
			'select' => array("COUNT(*) as total"),
			"from" => $this->ems."user"
		))->row_array();
		$datas = $ems->row_array();

		if ($ems->num_rows() < 1) {
			if ($ems_num) {
				$this->config_model->insert(array(
					'params' => array(
						"id_user" => $ems_num['total']+1,
						"user_name" => $spe['Username'],
						"password" => md5('ismart'),
						"type" => "62900",
						"nama" => $spe['Fullname'],
						"cabang" => $spe['RecID'],
						"lastlog" => date('Y-m-d H:i:s')
					),
					"from" => $this->ems."user"
				));
			}
		} else {
			$this->config_model->update(array(
				'params' => array(
					"user_name" => $spe['Username'],
					"password" => md5('ismart'),
					"type" => "62900",
					"nama" => $spe['Fullname'],
					"cabang" => $spe['RecID'],
					"lastlog" => date('Y-m-d H:i:s')
				),
				"from" => $this->ems."user",
				"where" => array("id_user" => $datas['id_user'])
			));
		}
		$body = '
		<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:15px;">
			<tr>
				<td>Yth, Cabang '.$spe['NamaAreaCabang'].'. Berikut kami lampirkan akun untuk login ke EMS ems.primagama.co.id:</td>
			</tr>
		</table>
		<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:15px;">
			<tr>
				<td width="150px;">Username</td>
				<td width="5px;">:</td>
				<th>'.$spe['Username'].'</th>
			</tr>
			<tr>
				<td width="150px;">Password</td>
				<td width="5px;">:</td>
				<th>ismart</th>
			</tr>
		</table>
		<table border="0" cellspacing="0" cellpadding="5" style="padding-top:15px;padding-bottom:15px">
			<td>Demikian yang dapat kami sampaikan, terima kasih.</td>
		</table>'.msg_fotter();

		$asg = batch_email(array(
			// 'penerima' => array('if.hamzah93@gmail.com'),
			'penerima' => array($spe['Email'],'helpdesk@primagama.co.id'),
			'subjek' => array('Informasi Akun Web primagama.co.id'),
			'body' => array($body)
		));
		if ($asg==true) {
			$this->config_model->update(array(
				'params' => array("is_ems" => 1),
				"from" => $this->db2."users",
				"where" => array("RecID" => $this->input->post('RecID'))
			));
			echo json_encode(array('message'=>'Data berhasil disinkronkan','notify'=>'success'));
		} else {
			echo json_encode(array('message'=>'Data berhasil disinkronkan','notify'=>'error'));
		}
	}

	public function sinkron_SC()
	{
		$spe = $this->config_model->find(array(
			'select' => array(
				"a.Username",
				"a.Fullname",
				"a.Email",
				"b.RecID",
				"RTRIM(b.KodeAreaCabang) AS cabang",
				"b.NamaAreaCabang",
			),
			"from" => $this->db2."users a",
			"join" => array(
				$this->db2."areacabang b" => array(
					"on" => "a.AreaCabang=b.RecID",
					"type" => "left"
				),
			),
			"where" => array("a.RecID" => $this->input->post('RecID'))
		))->row_array();

		$sc = $this->config_model->find(array(
			'select' => array("noid","RecID"),
			"from" => $this->ems."tblusersc",
			"where" => array("cabang" => $spe['RecID'])
		));
		$datas = $sc->row_array();

		if ($sc->num_rows() < 1) {
			$this->config_model->insert(array(
				'params' => array(
					"noid" => $spe['cabang'].'.pkc1',
					"Nama" => $spe['NamaAreaCabang'],
					"password" => md5('konselor'),
					"aktif" => 1,
					"lastlog" => date('Y-m-d H:i:s'),
					"cabang" => $spe['RecID']
				),
				"from" => $this->ems."tblusersc"
			));
		} else {
			$this->config_model->update(array(
				'params' => array(
					"Nama" => $spe['NamaAreaCabang'],
					"password" => md5('konselor'),
					"aktif" => 1,
					"lastlog" => date('Y-m-d H:i:s'),
					"cabang" => $spe['RecID']
				),
				"from" => $this->ems."tblusersc",
				"where" => array("RecID" => $datas['RecID'])
			));
		}
		$body = '
		<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:15px;">
			<tr>
				<td>Yth, Cabang '.$spe['NamaAreaCabang'].'. Berikut kami lampirkan akun untuk login ke Smart Consultation ems.primagama.co.id:</td>
			</tr>
		</table>
		<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:15px;">
			<tr>
				<td width="150px;">Username</td>
				<td width="5px;">:</td>
				<th>'.$spe['cabang'].'.pkc1'.'</th>
			</tr>
			<tr>
				<td width="150px;">Password</td>
				<td width="5px;">:</td>
				<th>konselor</th>
			</tr>
		</table>
		<table border="0" cellspacing="0" cellpadding="5" style="padding-top:15px;padding-bottom:15px">
			<td>Demikian yang dapat kami sampaikan, terima kasih.</td>
		</table>'.msg_fotter();

		$asg = batch_email(array(
			'penerima' => array($spe['Email'],'helpdesk@primagama.co.id'),
			'subjek' => array('Informasi Akun Web primagama.co.id'),
			'body' => array($body)
		));
		if ($asg==true) {
			$this->config_model->update(array(
				'params' => array("is_sc" => 1),
				"from" => $this->db2."users",
				"where" => array("RecID" => $this->input->post('RecID'))
			));
			echo json_encode(array('message'=>'Data berhasil disinkronkan','notify'=>'success'));
		} else {
			echo json_encode(array('message'=>'Data berhasil disinkronkan','notify'=>'error'));
		}
	}

	public function menuitems()
	{
		restrict();
		if ($this->session->userdata('UserGroup')==14) {
			$data['breadcrumb_1'] = '<a href="'.base_url().'master/menuitems">Menu Items</a>';
			$data['MenuItemsGroup'] = $this->config_model->find(array('from'=>$this->db2.'menuitemsgroup','order_by'=>array('MenuItemsGroupId'=>'desc')));
			$this->template->set('title', 'Menu Items');
			$this->template->load('template', 'master/menuitems',$data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function find_menuitems()
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
					'a.MenuItemsGroup',
					'b.MenuItemsGroupName',
					'a.MenuItem',
					'a.ControllerName',
					'a.Hide',
					'a.Status'
				),
				'from' => $this->db2.'menuitems a',
				'join' => array(
					$this->db2.'menuitemsgroup b' => array(
						'on' => 'a.MenuItemsGroup=b.MenuItemsGroupId',
						'type' => 'inner'
					)
				),
				'where' => $where,
				'order_by' => array('a.RecID' => 'DESC')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function add_menuitems()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->insert(array(
					'params' => array(
						'MenuItemsGroup' => base64_decode($this->input->post('MenuItemsGroup')),
						'MenuItem' => base64_decode($this->input->post('MenuItem')),
						'ControllerName' => base64_decode($this->input->post('ControllerName')),
						'Hide' => base64_decode($this->input->post('Hide')),
						'Status' => base64_decode($this->input->post('Status'))
					),
					'from' => $this->db2.'menuitems'
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
	
	public function edit_menuitems()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'MenuItemsGroup' => base64_decode($this->input->post('MenuItemsGroup')),
						'MenuItem' => base64_decode($this->input->post('MenuItem')),
						'ControllerName' => base64_decode($this->input->post('ControllerName')),
						'Hide' => base64_decode($this->input->post('Hide')),
						'Status' => base64_decode($this->input->post('Status'))
					),
					'from' => $this->db2.'menuitems',
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
	
	public function delete_menuitems()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->delete(array(
					'from' => $this->db2.'menuitems',
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

	public function menuitemsgroup()
	{
		restrict();
		if ($this->session->userdata('UserGroup')==14) {
			$data['breadcrumb_1'] = '<a href="'.base_url().'master/menuitems">Menu Items Group</a>';
			$this->template->set('title', 'Menu Items Group');
			$this->template->load('template', 'master/MenuItemsGroup',$data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function find_menuitemsgroup()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$RecID = base64_decode($this->input->get('RecID'));
			if (isset($RecID) && !empty($RecID)) {
				$where = array('a.MenuItemsGroupId' => $RecID);
			} else {
				$where = null;
			}
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.MenuItemsGroupId as RecID',
					'a.MenuItemsGroupName',
					'a.MenuItemsGroupOrder',
					'(SELECT COUNT(RecID) AS Total FROM '.$this->db2.'menuitems WHERE MenuItemsGroup=a.MenuItemsGroupId) AS Total'
				),
				'where' => $where,
				'from' => $this->db2.'menuitemsgroup a',
				'order_by' => array('a.MenuItemsGroupId' => 'DESC')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function add_menuitemsgroup()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->insert(array(
					'params' => array(
						'MenuItemsGroupName' => base64_decode($this->input->post('MenuItemsGroupName')),
						'MenuItemsGroupOrder' => base64_decode($this->input->post('MenuItemsGroupOrder'))
					),
					'from' => $this->db2.'MenuItemsGroup'
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
	
	public function adit_menuitemsgroup()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'MenuItemsGroupName' => base64_decode($this->input->post('MenuItemsGroupName')),
						'MenuItemsGroupOrder' => base64_decode($this->input->post('MenuItemsGroupOrder'))
					),
					'from' => $this->db2.'menuitemsgroup',
					'where' => array('MenuItemsGroupId' => base64_decode($this->input->post('RecID')))
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
	
	public function delete_menuitemsgroup()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->delete(array(
					'from' => $this->db2.'menuitemsgroup',
					'where' => array('MenuItemsGroupId' => base64_decode($this->input->post('RecID')))
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

	public function usergroups()
	{
		restrict();
		if ($this->session->userdata('UserGroup')==14) {
			$data['breadcrumb_1'] = '<a href="'.base_url().'master/usergroups">User Groups</a>';
			$this->template->set('title', 'User Groups');
			$this->template->load('template', 'master/usergroups',$data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function find_usergroups()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$RecID = base64_decode($this->input->get('RecID'));
			if (isset($RecID) && !empty($RecID)) {
				$where = array('RecID' => $RecID);
			} else {
				$where = null;
			}
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'a.GroupName',
					'(SELECT COUNT(RecID) AS Total FROM '.$this->db2.'usergroupsdetail WHERE UserGroup=a.RecID) AS Total'
				),
				'where' => $where,
				'from' => $this->db2.'usergroups a',
				'order_by' => array('RecID' => 'DESC')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function add_usergroups()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->insert(array(
					'params' => array(
						'GroupName' => base64_decode($this->input->post('GroupName'))
					),
					'from' => $this->db2.'usergroups'
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
	
	public function edit_usergroups()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'GroupName' => base64_decode($this->input->post('GroupName'))
					),
					'from' => $this->db2.'usergroups',
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
	
	public function delete_usergroups()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->delete(array(
					'from' => $this->db2.'usergroups',
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

	public function usergroupsdetail()
	{
		restrict();
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h') && $this->session->userdata('UserGroup')==14) {
			$data['breadcrumb_1'] = '<a href="'.base_url().'master/usergroups">User Groups</a>';
			$data['breadcrumb_2'] = '<a href="'.base_url().'master/usergroupsdetail">User Groups Detail</a>';
			$data['MenuItems'] = $this->config_model->find(array('from'=>$this->db2.'menuitems','order_by'=>array('RecID'=>'desc')));
			$data['UserGroupID'] = base64_decode($this->input->post('RecID'));
			$this->template->set('title', 'User Groups Detail');
			$this->template->load('template', 'master/usergroupsdetail',$data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function find_usergroupsdetail()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$RecID = base64_decode($this->input->get('RecID'));
			if (isset($RecID) && !empty($RecID)) {
				$where = array('a.RecID' => $RecID);
				$type = 'left';
			} else {
				$where = array('a.UserGroup' => base64_decode($this->input->get('UserGroupID')));
				$type = 'inner';
			}
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'a.UserGroup',
					'b.GroupName',
					'a.MenuItems',
					'c.MenuItem',
					'a.ActionName'
				),
				'from' => $this->db2.'usergroupsdetail a',
				'join' => array(
					$this->db2.'usergroups b' => array(
						'on' => 'a.UserGroup=b.RecID',
						'type' => $type
					),
					$this->db2.'menuitems c' => array(
						'on' => 'a.MenuItems=c.RecID',
						'type' => $type
					),
				),
				'where' => $where,
				'order_by' => array('a.RecID' => 'DESC')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function add_usergroupsdetail()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->insert(array(
					'params' => array(
						'UserGroup' => base64_decode($this->input->post('UserGroup')),
						'MenuItems' => base64_decode($this->input->post('MenuItems')),
						'ActionName' => base64_decode($this->input->post('ActionName'))
					),
					'from' => $this->db2.'usergroupsdetail'
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
	
	public function edit_usergroupsdetail()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'UserGroup' => base64_decode($this->input->post('UserGroup')),
						'MenuItems' => base64_decode($this->input->post('MenuItems')),
						'ActionName' => base64_decode($this->input->post('ActionName'))
					),
					'from' => $this->db2.'usergroupsdetail',
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
	
	public function delete_usergroupsdetail()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->delete(array(
					'from' => $this->db2.'usergroupsdetail',
					'where' => array('RecID' => base64_decode($this->input->post('RecID')))
				));
				echo json_encode(array('message'=>'Data berhasil dihapus','notify'=>'success'));
			} catch (Exception $e) {
				echo json_encode(array('message'=>'Data gagal diubah','notify'=>'warning'));
			}
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function template_email($data='',$data2)
	{
		$htmlContent = '
		<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#f4f4f4">
			<tbody>
				<tr>
					<td>
						<img style="padding:10px;" src="'.base_url().'assets/images/logo_new_web.png" alt="logo" width="250"/>
					</td>
				</tr>
			</tbody>
			<tbody>
				<tr>
					<td valign="top" width="200">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td align="left" valign="top" style="font-size:14px;font-weight:bold;color:#00af41;padding-left: 15px;">Detail Pesanan</td>
								</tr>
								<tr>
									<td valign="top">
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tbody>
												<tr>
													<td align="left" valign="top">
														<table border="0" cellspacing="0" cellpadding="0" width="100%">
															<tbody>';
																foreach ($data as $row) {
																	foreach ($row as $key => $val) {
																		$htmlContent .= '<tr>';
																			$htmlContent .= '<td align="left" class="m_-83677845150779067tdp5">';
																				$htmlContent .= '<span style="font-size:10px;color:#9e9e9e;line-height:16px;padding-left: 15px;">'.$key.':</span><br>';
																				$htmlContent .= '<span style="font-size:12px;line-height:16px;font-weight:bold;padding-left: 15px;">'.$val.'</span>';
																			$htmlContent .= '</td>';
																		$htmlContent .= '</tr>';
																	}
																}
															$htmlContent .= '</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td valign="top" width="270">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="border:1px solid #dddddd">
							<tbody>
								<tr>
									<td height="10px" align="left"></td>
									<td height="10px" colspan="2"></td>
									<td height="10px" align="left"></td>
								</tr>
								<tr>
									<td height="5px" align="left"></td>
									<td height="5px" colspan="2" align="left">
										 Detail Pembayaran:
									</td>
									<td height="25px" align="left"></td>
								</tr>
								<tr>
									<td height="3px" align="left"></td>
									<td height="3px" colspan="2" align="left" style="border-top:1px dashed #9e9e9e"></td>
									<td height="3px" align="left"></td>
								</tr>';
								foreach ($data2 as $row) {
									foreach ($row as $key => $val) {
										$htmlContent .= '<tr>';
											$htmlContent .= '<td align="left" width="15"></td>';
											$htmlContent .= '<td width="171" align="left">';
												$htmlContent .= '<span style="font-size:11px;color:#9e9e9e;line-height:21px">'.$key.'</span>';
											$htmlContent .= '</td>';
											$htmlContent .= '<td width="80" align="left">';
												$htmlContent .= '<span style="font-size:11px;color:#9e9e9e;line-height:28px">&nbsp;&nbsp;'.$val.'</span>';
											$htmlContent .= '</td>';
											$htmlContent .= '<td align="left" width="15"></td>';
										$htmlContent .= '</tr>';
										$htmlContent .= '<tr>';
											$htmlContent .= '<td height="5px" align="left"></td>';
											$htmlContent .= '<td height="5px" colspan="2" align="left" style="border-top:1px dashed #9e9e9e"></td>';
											$htmlContent .= '<td height="5px" align="left"></td>';
										$htmlContent .= '</tr>';
									}
								}
								$htmlContent .= '<tr>
									<td align="left" width="15"></td>
									<td align="right">
										<span style="font-size:12px;font-weight:bolder;color:#000000;line-height:28px">TOTAL&nbsp;&nbsp;&nbsp;&nbsp;</span>
									</td>
									<td align="left">
										<span style="font-size:12px;font-weight:bolder;color:#000000;line-height:28px">&nbsp;&nbsp;RP 18000</span>
									</td>
									<td align="left" width="15"></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>';
		return $htmlContent;
	}

	public function tes()
	{
		require_once(APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php');
		$data = array(
			array(
				'nama' => 'hamzah',
				'alamat' => 'payuputat'
			)
		);

		$data2 = array(
			array(
				'Pembayaran 1' => 'Rp. 100000',
				'Pembayaran 2' => 'Rp. 200000'
			)
		);

		$mail             = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = "smtp.office365.com";
        $mail->Port       = "587";
        $mail->Username   = "noreply@primagama.co.id";
        $mail->Password   = "Prima.1234";
        $mail->SetFrom('noreply@primagama.co.id', 'Primagama');
        $mail->Subject    = "Email Konfirmasi";
        $mail->MsgHTML($this->template_email($data,$data2));
        $mail->AddAddress('hamzah@primagama.co.id', 'hamzah');
        $mail->AddCC("oni.restu@primagama.co.id", "Helpdesk Primagama");


        if(!$mail->Send()) {
        	echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
         	echo "Mailer berhasil";
        }
	}

	public function tesEmail($nama='',$email='',$subject='',$body='') {
		
		 $config = Array(  
		'protocol' => 'smtp',  
		'smtp_host' => 'ssl://smtp.office365.com', 
		'smtpauth' => true,
		'smtp_port' => 587,  
		'smtp_user' => 'noreply@primagama.co.id',   
		'smtp_pass' => 'Prima.1234',   
		'mailtype' => 'html',   
		'charset' => 'iso-8859-1'  
		);  
		$this->load->library('email', $config);  

		$this->email->set_newline("\r\n");

		$this->$name = "Selamat Bergabung Sahabat Primagama...";
		$this->email->from('noreply@primagama.co.id', 'HUT Primagama 34th');   
		$this->email->to('Budi.Hartanto@primagama.co.id');   
		$this->email->subject('Peserta Tryout Smart Generation Award');   
		$this->email->message('Selamat Berjuang'); 

	
		if (!$this->email->send()) {  
		echo 'Email gagal terkirim';   
		}else{  
		echo 'Email terkirim';   
		}

	 }

	public function pdf_viewer()
	{
		$this->load->view('pdfviewer');
	}

	public function checknotif()
	{
		$arr = array(
			'select' => array(
				'count(a.RecID) as Waiting',
			),
			'from' => 'Logistics_POHeader a',
			'where' => array('a.Status'=>1, 'a.BranchCode' => $this->session->userdata('KodeAreaCabang')),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'][] = $sql->row_array();
		} else {
			$data['rows'][] = array('Waiting'=>0);
		}
		echo json_encode($data);
	}

	public function ordersp()
	{
		restrict();/*
		if ($this->session->userdata('UserGroup')==14) {*/
			$data['breadcrumb_1'] = '<a href="'.base_url().'Master/ordersp">Data Cabang Order Khusus</a>';
			$this->template->set('title', 'Data Cabang Order Khusus');
			$this->template->load('template', 'Master/ordersp',$data);
		/*} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}
	
	public function find_ordersp()
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
					'a.BranchCode',
					'b.NamaAreaCabang',
					'a.Category',
					'a.Status as StatusID',
					"CASE a.Category
						WHEN 1 THEN 'PIKSUN'
						WHEN 2 THEN 'PIKSE'
						WHEN 3 THEN 'Paket SE'
					END as Category",
					"CASE a.Status 
					  WHEN 0 THEN 'Tidak Aktif'
					  WHEN 1 THEN 'Aktif'
					END as Status"
				),
				'from' => 'Logistics_BranchOrderSP a',
				'join' => array(
					 $this->db2.'AreaCabang b' => array(
						'on' => 'a.BranchCode=b.KodeAreaCabang',
						'type' => 'inner'
					)
				),
				'where' => $where,
				'order_by' => array('a.RecID' => 'DESC')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function edit_ordersp()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'Status' => base64_decode($this->input->post('Status'))
					),
					'from' => 'Logistics_BranchOrderSP',
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

	public function add_ordersp()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->insert(array(
					'params' => array(
						'BranchCode' => base64_decode($this->input->post('BranchCode')),
						'Category' => base64_decode($this->input->post('Category')),
						'Status' => 1,
						'CreatedDate' => date("Y-m-d H:i:s"),
						'CreatedBy' => $this->session->userdata('Username')
					),
					'from' => 'Logistics_BranchOrderSP'
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
}