<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ismart extends CI_Controller {
	private $db2 = "TPrimaEdu_Prod.dbo.";

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('config_model');
    }

	public function index()
	{
		$this->load->view('ismart/new');
	}

  public function get_area() {
      $arr = array(
          'from' => $this->db2 . 'areacabang a',
          'where' => 'a.Area is null',
          'order_by' => array('a.KodeAreaCabang' => '')
      );
      $item = $this->config_model->find($arr);
      $data = $item->result_array();
      echo json_encode($data);
	}

	public function get_cabang($Area)
	{

		if (!$this->input->is_ajax_request()) {
			redirect('ismart');
		};

		$arr = array(
			'from' => $this->db2.'areacabang a',
			'where' => "a.Area = '$Area'",
			'order_by' => array('a.KodeAreaCabang' => '')
		);
		$item 	= $this->config_model->find($arr);
		$data 	= $item->row();
		$datas 	= $item->result();

		// print_r($data);

		if ($item->num_rows() > 0) {

			echo '<option value="">-- Pilih Cabang --</option>';

			foreach ($datas as $key => $value) {

				echo '<option value="'.trim($value->KodeAreaCabang).'">'.$value->NamaAreaCabang.'</option>';

			}
		}


		//echo json_encode($data);
	}

	public function get_BidangStudi() {
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
					'a.MapelName'
				),
      'from' => $this->db2 . 'mapel a',
      'order_by' => array('a.StageCat' => '')
    );

    $item = $this->config_model->find($arr);
    $data = $item->result_array();
    echo json_encode($data);
	}

	public function get_BidangStudi2() {
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
					'a.MapelName'
				),
		      'from' => $this->db2 . 'mapel a',
		      'order_by' => array('a.StageCat' => ''),
		    );

	    $item = $this->config_model->find($arr);
	    $data = $item->result_array();
	    echo json_encode($data);
		}

/*	public function get_BidangStudi2(){
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
					'a.MapelName'
				),
				'from' => $this->db2 . 'mapel a',
				'order_by' => array('a.StageCat' => ''),
			);

		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}*/

	public function get_BidangStudi3(){
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
					'a.MapelName'
				),
				'from' => $this->db2 . 'mapel a',
				'order_by' => array('a.StageCat' => ''),
			);

		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function save_addiSmart()
	{

		require_once(APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php');

			$FotoFile = $this->input->post('FotoFile');
			$typeFoto = explode('/', explode(':', substr($FotoFile, 0, strpos($FotoFile, ';')))[1]);
			$acakFoto = rand(00000000000,99999999999);
			$NameFoto  = ('Foto_'.$acakFoto.'.'.$typeFoto[1]);

			$IjazahFile = $this->input->post('IjazahFile');
			$typeIjazah = explode('/', explode(':', substr($IjazahFile, 0, strpos($IjazahFile, ';')))[1]);
			$acakIjazah = rand(00000000000,99999999999);
			$NameIjazah  = ('Ijazah_'.$acakIjazah.'.'.$typeIjazah[1]);

			$SertifikatFile = $this->input->post('SertifikatFile');
			$typeSertifikat = explode('/', explode(':', substr($SertifikatFile, 0, strpos($SertifikatFile, ';')))[1]);
			$acakSertifikat = rand(00000000000,99999999999);
			$NameSertifikat  = ('Sertifikat_'.$acakSertifikat.'.'.$typeSertifikat[1]);

			$SertifikattFile = $this->input->post('SertifikattFile');
			$typeSertifikatt = explode('/', explode(':', substr($SertifikattFile, 0, strpos($SertifikattFile, ';')))[1]);
			$acakSertifikatt = rand(00000000000,99999999999);
			$NameSertifikatt  = ('Sertifikatt_'.$acakSertifikatt.'.'.$typeSertifikatt[1]);

			$SertifikatttFile = $this->input->post('SertifikatttFile');
			$typeSertifikattt = explode('/', explode(':', substr($SertifikatttFile, 0, strpos($SertifikatttFile, ';')))[1]);
			$acakSertifikattt = rand(00000000000,99999999999);
			$NameSertifikattt  = ('Sertifikattt_'.$acakSertifikattt.'.'.$typeSertifikattt[1]);

			$KTPFile = $this->input->post('KTPFile');
			$typeKTP = explode('/', explode(':', substr($KTPFile, 0, strpos($KTPFile, ';')))[1]);
			$acakKTP = rand(00000000000,99999999999);
			$NameKTP  = ('KTP_'.$acakKTP.'.'.$typeKTP[1]);



			if (isset($FotoFile) && !empty($FotoFile)) {
				list($typeFoto, $FotoFile) = explode(';', $FotoFile);
				list(, $FotoFile)      = explode(',', $FotoFile);
			}

			if (isset($IjazahFile) && !empty($IjazahFile)) {
				list($typeIjazah, $IjazahFile) = explode(';', $IjazahFile);
				list(, $IjazahFile)      = explode(',', $IjazahFile);
			}

			if (isset($SertifikatFile) && !empty($SertifikatFile)) {
				list($typeSertifikat, $SertifikatFile) = explode(';', $SertifikatFile);
				list(, $SertifikatFile)      = explode(',', $SertifikatFile);
			}

			if (isset($SertifikattFile) && !empty($SertifikattFile)) {
				list($typeSertifikatt, $SertifikattFile) = explode(';', $SertifikattFile);
				list(, $SertifikattFile)      = explode(',', $SertifikattFile);
			}


			if (isset($SertifikatttFile) && !empty($SertifikatttFile)) {
				list($typeSertifikattt, $SertifikatttFile) = explode(';', $SertifikatttFile);
				list(, $SertifikatttFile)      = explode(',', $SertifikatttFile);
			}

			if (isset($KTPFile) && !empty($KTPFile)) {
				list($typeKTP, $KTPFile) = explode(';', $KTPFile);
				list(, $KTPFile)      = explode(',', $KTPFile);
			}

			if($FotoFile != ''){
				$FotoName = $NameFoto;
			} else {
				$FotoName = null;
			}
			if($IjazahFile != ''){
				$IjazahName = $NameIjazah;
			} else {
				$IjazahName = null;
			}
			if($SertifikatFile != ''){
				$SertifikatName = $NameSertifikat;
			} else {
				$SertifikatName = null;
			}
			if($SertifikattFile != ''){
				$SertifikattName = $NameSertifikatt;
			} else {
				$SertifikattName = null;
			}
			if($SertifikatttFile != ''){
				$SertifikatttName = $NameSertifikattt;
			} else {
				$SertifikatttName = null;
			}
			if($KTPFile != ''){
				$KTPName = $NameKTP;
			} else {
				$KTPName = null;
			}

			$Nama = $this->input->post('Name');
			$BidangStudi = $this->input->post('BidangStudi');
			$BidangStudi2 = $this->input->post('BidangStudi2');
			$BidangStudi3 = $this->input->post('BidangStudi3');
			$Email = $this->input->post('Email');
			$NoTelp = $this->input->post('Telepon');
			$Cabang = $this->input->post('Cabang');
			$NamaRek = $this->input->post('NamaRek');
			$NoRek = $this->input->post('NoRek');
			$subject1 = $this->input->post('subject1');
			$subject2 = $this->input->post('subject2');
			$subject3 = $this->input->post('subject3');
			$CabangRek = $this->input->post('CabangRek');
			$NoNPWP = $this->input->post('NoNPWP');
			$NSPK = $this->input->post('NSPK');
			$AlamatKTP = $this->input->post('AlamatKTP');


	/*		$StageCat['StageCat'] = $BidangStudi;
			$query = $this->config_model->getSelectedData($this->db2 .'mapel',$StageCat)->row_array();
			$MapelName = $query['MapelName'];*/

/*			$StageCat['StageCat'] = $BidangStudi2;
			$query = $this->config_model->getSelectedData($this->db2 .'mapel',$StageCat)->row_array();
			$MapelName = $query['MapelName'];

			$StageCat['StageCat'] = $BidangStudi3;
			$query = $this->config_model->getSelectedData($this->db2 .'mapel',$StageCat)->row_array();
			$MapelName = $query['MapelName'];*/

			$KodeCabang['KodeAreaCabang'] = $Cabang;
			$querycabang = $this->config_model->getSelectedData($this->db2 .'areacabang',$KodeCabang)->row_array();
			$NamaCabang = $querycabang['NamaAreaCabang'];
			$EmailCabang = $querycabang['Email'];

			if (isset($_POST['NoKTP'])) {

				$no_ktp = $this->input->post('NoKTP', true);

					$arr = array(
						'from' => $this->db2.'iSmartNew',
						'where' => "NoKTP = '$no_ktp'",
					);

					$item 	= $this->config_model->find($arr);

				if ($item->num_rows() > 0) {
					echo data_json(array("message"=>"Data iSmart gagal disimpan, No KTP sudah tersedia.","status"=>"warning"));
				}else {
					$data2 = array(
			    	'params' => array(
				   		'Nama' => $Nama,
				   		'NoKTP' => $this->input->post('NoKTP'),
				   		'Posisi' => $this->input->post('Posisi'),
				   		'KodeAreaCabang' => $this->input->post('Area'),
				   		'KodeAreaCabang' => $Cabang,
				   		'BidStudi' => $BidangStudi,
				   		'BidStudi1' => $BidangStudi2,
				   		'BidStudi2' => $BidangStudi3,
				   		'AlamatRumah' => $this->input->post('Alamat'),
				   		'Email' => $Email,
				   		'PendidikanAkhir' => $this->input->post('Pendidikan'),
				   		'Pekerjaan' => $this->input->post('Pekerjaan'),
				   		'Foto' => $FotoName,
				   		'ScanIjazah' => $IjazahName,
				   		'Notelp' => $NoTelp,
				   		'Jurusan' => $this->input->post('Jurusan'),
				   		'ScanCertificate' => $SertifikatName,
				   		'ScanCertificate1' => $SertifikattName,
				   		'ScanCertificate2' => $SertifikatttName,
				   		'ScanKTP' => $KTPName,
				   		'NamaRek' => $NamaRek,
				   		'NoRek' => $this->input->post('NoRek'),
				   		'CabangRek' => $this->input->post('CabangRek'),
				   		'NoNPWP' => $NoNPWP,
				   		'NoSurat' => $NSPK,
				   		'subject1' => $subject1,
				   		'subject2' => $subject2,
				   		'subject3' => $subject3,
				   		'AlamatKTP' => $this->input->post('AlamatKTP'),
						'CreateDate'=> date('Y-m-d H:i:s'),
				   	),
				   	'from' => $this->db2 .'iSmartNew',
			    );

					$msg2 = $this->config_model->insert($data2);

					if (isset($FotoFile) && !empty($FotoFile)) {
						$xdata = base64_decode($FotoFile);
						$file_path = 'assets/upload/ismart/foto/';
						file_put_contents($file_path.$NameFoto, $xdata);
					}

					if (isset($IjazahFile) && !empty($IjazahFile)) {
						$xdata = base64_decode($IjazahFile);
						$file_path = 'assets/upload/ismart/ijazah/';
						file_put_contents($file_path.$NameIjazah, $xdata);
					}

					if (isset($SertifikatFile) && !empty($SertifikatFile)) {
						$xdata = base64_decode($SertifikatFile);
						$file_path = 'assets/upload/ismart/sertifikat/';
						file_put_contents($file_path.$NameSertifikat, $xdata);
					}

					if (isset($SertifikattFile) && !empty($SertifikattFile)) {
						$xdata = base64_decode($SertifikattFile);
						$file_path = 'assets/upload/ismart/sertifikat1/';
						file_put_contents($file_path.$NameSertifikatt, $xdata);
					}

					if (isset($SertifikatttFile) && !empty($SertifikatttFile)) {
						$xdata = base64_decode($SertifikatttFile);
						$file_path = 'assets/upload/ismart/sertifikat2/';
						file_put_contents($file_path.$NameSertifikattt, $xdata);
					}

					if (isset($KTPFile) && !empty($KTPFile)) {
						$xdata = base64_decode($KTPFile);
						$file_path = 'assets/upload/ismart/KTP/';
						file_put_contents($file_path.$NameKTP, $xdata);
					}

					if ($msg2) {

					$body = '
					<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:15px;">
						<tr>
							<td>Yth, Cabang '.$NamaCabang.', </td>
						</tr>
						<tr>
							<td>Anda menerima data Tim AKademik Cabang yang membutuhkan approval. Silahkan login ke PrimaEdu dan melakukan approval dari menu Data Master -> Approval iSmart. <br></br>Terima kasih. </td>
						</tr>
					</table>'.msg_fotter();

					$mail             = new PHPMailer();
					$mail->IsSMTP();
					//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
					//$mail->SMTPDebug =2;
					$mail->SMTPAuth   = true;
					$mail->Host       = "smtp.office365.com";
					$mail->Port       = "587";
					//$mail->Username   = "no-reply@primagama.co.id";
					//$mail->Password   = "Prima.1234";
					$mail->Username   = "erik.alfredo@primagama.co.id";
					$mail->Password   = "Erik.ginting123";
					$mail->SetFrom('erik.alfredo@primagama.co.id', 'NoReply Primagama');
					$mail->Subject    = "Data iSmart Baru";
					$mail->MsgHTML($body);
					$mail->AddAddress($EmailCabang, $NamaCabang);
					$mail->AddCC("laili@primagama.co.id", "Helpdesk Primagama");
					$mail->Send();

						echo data_json(array("message"=>"Data iSmart berhasil disimpan.","status"=>"success"));

					} else {
						echo data_json(array("message"=>"Data iSmart gagal disimpan.","status"=>"error"));
					}
				}
			}

	}

	public function check_ktp()
	{
		$no_ktp = $this->input->post('NoKTP', true);

		if (isset($no_ktp)) {

			$arr = array(
				'from' => $this->db2.'iSmartNew',
				'where' => "NoKTP = '$no_ktp'",
			);

			$item 	= $this->config_model->find($arr);

			if ($item->num_rows() > 0) {
				echo 1;
			}else {
				0;
			}
		}
	}

	public function test_email()
	{			
		require_once(APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php');
		$NamaCabang = 'Ciasem ';
		$body = '
		<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:15px;">
			<tr>
				<td>Yth, Cabang '.$NamaCabang.', </td>
			</tr>
			<tr>
				<td>Anda menerima data iSmart / IBM / Tentor yang membutuhkan approval. Silahkan login ke PrimaEdu dan melakukan approval dari menu Data Master -> Approval iSmart. <br></br>Terima kasih. </td>
			</tr>
		</table>'.msg_fotter();

		$asg = batch_email(array(
		'penerima' => array('oni.pamuji@gmail.com'/*,$EmailCabang*/),
			'subjek' => array('Data iSmart Baru'),
			'body' => array($body)
		));

					<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:15px;">
						<tr>
							<td>Yth, Cabang '.$NamaCabang.', </td>
						</tr>
						<tr>
							<td>Anda menerima data iSmart / IBM / Tentor yang membutuhkan approval. Silahkan login ke PrimaEdu dan melakukan approval dari menu Data Master -> Approval iSmart. <br></br>Terima kasih. </td>
						</tr>
					</table>'.msg_fotter();

		$mail             = new PHPMailer();
		$mail->IsSMTP();
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
		//$mail->SMTPDebug =2;
		$mail->SMTPAuth   = true;
		$mail->Host       = "smtp.office365.com";
		$mail->Port       = "587";
		//$mail->Username   = "no-reply@primagama.co.id";
		$mail->Username   = "erik.alfredo@primagama.co.id";
		//$mail->Password   = "Prima.1234";
		$mail->Password   = "Erik.ginting123";
		$mail->SetFrom('erik.alfredo@primagama.co.id', 'NoReply Primagama');
		$mail->Subject    = "Data iSmart Baru";
		$mail->MsgHTML($body);
		$mail->AddAddress('erikginting.a@gmail.com', 'Erik KON');
		//$mail->AddCC("oni.restu@primagama.co.id", "Helpdesk Primagama");
		$mail->Send();
		// if(!$mail->Send()) {
		// 	echo "Mailer Error: " . $mail->ErrorInfo;
		// } else {
		//  	echo "Mailer berhasil";
		// }
	}

	public function testing()
	{
		$data = $this->db->query('SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES');

		foreach ($data->result_array() as $key => $value) {
			echo $value['TABLE_NAME'] .'<br />';
		}
		echo '<h1>COBA</h1>';

		$cek = $this->db->get('Franchise_Fee')->row();

		print_r($cek);

		echo '<br /> <br />';

		var_dump($cek);

		$arr = array(
			'from' => $this->db2.'iSmartNew'
		);

		$item 	= $this->config_model->find($arr);

		print_r($item->row_array());
	}

	public function list_ismart()
	{
		restrict();
		$data = array(
			'title' => 'Data iSmart',
			'breadcrumb_1' => '<a href="#">Data iSmart</a>',
		);
		$this->template->load('template', 'ismart/list_ismart',$data);
	}

	public function get_data_ismart()
	{
		$arr = array(
				'select' => array(
					'a.RecID',
					'a.Nama',
					'a.NoKTP',
					'a.Email',
					'a.NoTelp',
					'a.Pekerjaan',
					'a.PendidikanAkhir',
					'a.Jurusan',
					'a.AlamatRumah',
					'a.Posisi',
					'a.KodeAreaCabang',
					'a.BidStudi',
					'a.BidStudi1',
					'a.BidStudi2',
					'a.subject1',
					'a.subject2',
					'a.subject3',
					'a.NamaRek',
					'a.NoRek',
					'a.CabangRek',
					'a.NoNPWP',
					'a.NoSurat',
					'a.AlamatKTP',
					'a.Foto',
					'a.ScanIjazah',
					'a.ScanCertificate',
					'a.ScanCertificate1',
					'a.ScanCertificate2',
					'a.ScanKTP',
					"CASE a.Status
					  WHEN 1 THEN 'Approve'
					  WHEN 2 THEN 'Reject'
					  ELSE 'Menunggu'
					END as Status",
				),
				'from' => $this->db2 .'iSmartNew a',
				'where' => array('a.KodeAreaCabang' => $this->session->userdata('KodeAreaCabang'),'a.Status'=>null),
				'order_by' => array('a.RecID' => 'desc'),
			);
		$item = $this->config_model->find($arr);
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function approve_ismart($RecID)
	{
		$arr = array(
				'from' =>  $this->db2 .'iSmartNew a',
				'where' => array('a.RecID' => $RecID)
			);
		$data = $this->config_model->find($arr)->row();
		echo json_encode($data);
	}

	public function save_approve()
	{
		$data = array(
	    	'params' => array(
		    	'Grade' => $this->input->post('Grade'),
		    	'Status' => 1,
				'EditDate' => date("Y-m-d H:i:s"),
				'EditBy' => $this->session->userdata('Username'),
		    ),
		    'from' =>  $this->db2 .'iSmartNew',
			'where' => array('RecID' => $this->input->post('RecID'))
	    );
	    $msg = $this->config_model->update($data);
		echo data_json(array("message"=>"iSmart berhasil diApprove.","notify"=>"success"));
	}

	public function reject_ismart($RecID)
	{
		$arr = array(
				'from' =>  $this->db2 .'iSmartNew a',
				'where' => array('a.RecID' => $RecID)
			);
		$data = $this->config_model->find($arr)->row();
		echo json_encode($data);
	}

	public function save_reject()
	{
		$data = array(
	    	'params' => array(
		    	'Status' => 2,
				'EditDate' => date("Y-m-d H:i:s"),
				'EditBy' => $this->session->userdata('Username'),
		    ),
		    'from' =>  $this->db2 .'iSmartNew',
			'where' => array('RecID' => $this->input->post('RecID2'))
	    );
	    $msg = $this->config_model->update($data);
		echo data_json(array("message"=>"iSmart berhasil direject.","notify"=>"success"));
	}

	public function list_approve()
	{
		restrict();
		$data = array(
			'title' => 'Data iSmart Approve',
			'breadcrumb_1' => '<a href="'.base_url().'ismart/list_ismart">Data iSmart</a>',
			'breadcrumb_2' => '<a href="#">Data iSmart Approve</a>',
		);
		$this->template->load('template', 'ismart/list_approve',$data);
	}

	public function list_reject()
	{
		restrict();
		$data = array(
			'title' => 'Data iSmart Reject',
			'breadcrumb_1' => '<a href="'.base_url().'ismart/list_ismart">Data iSmart</a>',
			'breadcrumb_2' => '<a href="#">Data iSmart Reject</a>',
		);
		$this->template->load('template', 'ismart/list_reject',$data);
	}

	public function get_data_approve()
	{
		$arr = array(
				'select' => array(
					'a.RecID',
					'a.Nama',
					'a.NoKTP',
					'a.Email',
					'a.NoTelp',
					'a.Pekerjaan',
					'a.PendidikanAkhir',
					'a.Jurusan',
					'a.AlamatRumah',
					'a.Posisi',
					'a.KodeAreaCabang',
					'a.BidStudi',
					'a.BidStudi1',
					'a.BidStudi2',
					'a.subject1',
					'a.subject2',
					'a.subject3',
					'a.NamaRek',
					'a.NoRek',
					'a.CabangRek',
					'a.NoNPWP',
					'a.NoSurat',
					'a.AlamatKTP',
					'a.Foto',
					'a.ScanIjazah',
					'a.ScanCertificate',
					'a.ScanCertificate1',
					'a.ScanCertificate2',
					'a.ScanKTP',
					"CASE a.Status
					  WHEN 1 THEN 'Approve'
					  WHEN 2 THEN 'Reject'
					  ELSE 'Menunggu'
					END as Status",
				),
				'from' => $this->db2 .'iSmartNew a',
				'where' => array('a.KodeAreaCabang' => $this->session->userdata('KodeAreaCabang'),'a.Status'=>1),
				'order_by' => array('a.RecID' => 'desc'),
			);
		$item = $this->config_model->find($arr);
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function get_data_reject()
	{
		$arr = array(
				'select' => array(
					'a.RecID',
					'a.Nama',
					'a.NoKTP',
					'a.Email',
					'a.NoTelp',
					'a.Pekerjaan',
					'a.PendidikanAkhir',
					'a.Jurusan',
					'a.AlamatRumah',
					'a.Posisi',
					'a.KodeAreaCabang',
					'a.BidStudi',
					'a.BidStudi1',
					'a.BidStudi2',
					'a.subject1',
					'a.subject2',
					'a.subject3',
					'a.NamaRek',
					'a.NoRek',
					'a.CabangRek',
					'a.NoNPWP',
					'a.NoSurat',
					'a.AlamatKTP',
					'a.Foto',
					'a.ScanIjazah',
					'a.ScanCertificate',
					'a.ScanCertificate1',
					'a.ScanCertificate2',
					'a.ScanKTP',
					"CASE a.Status
					  WHEN 1 THEN 'Approve'
					  WHEN 2 THEN 'Reject'
					  ELSE 'Menunggu'
					END as Status",
				),
				'from' => $this->db2 .'iSmartNew a',
				'where' => array('a.KodeAreaCabang' => $this->session->userdata('KodeAreaCabang'),'a.Status'=>2),
				'order_by' => array('a.RecID' => 'desc'),
			);
		$item = $this->config_model->find($arr);
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function detail_ismart($RecID)
	{
		$arr = array(
				'from' =>  $this->db2 .'iSmartNew a',
				'where' => array('a.RecID' => $RecID)
			);
		$data = $this->config_model->find($arr)->row();
		echo json_encode($data);
	}

	public function test(){

			$body = '
			<table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:15px;">
				<tr>
					<td>Yth, Cabang </td>
				</tr>
				<tr>
					<td>Anda menerima data iSmart / IBM / Tentor yang membutuhkan approval. Silahkan login ke PrimaEdu dan melakukan approval dari menu Data Master -> Approval iSmart. <br></br>Terima kasih. </td>
				</tr>
			</table>'.msg_fotter();

			$asg = batch_email(array(
				'penerima' => array('oni.restu@primagama.co.id'/*,$EmailCabang*/),
				'subjek' => array('Data iSmart Baru'),
				'body' => array($body)
			));
	}

	public function test2()
	{
		echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n";
	}
}
