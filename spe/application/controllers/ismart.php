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
		$arr = array(
				'from' => $this->db2.'areacabang a',
				'where' => "a.Area = '$Area'",
				'order_by' => array('a.KodeAreaCabang' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);		
	}

	public function get_BidangStudi() {
        $arr = array(
            'from' => $this->db2 . 'bidangstudi a',
            'order_by' => array('a.KodeBidangStudi' => '')
        );
        $item = $this->config_model->find($arr);
        $data = $item->result_array();
        echo json_encode($data);
    }

	public function save_addiSmart()
	{

			$IjazahFile = $this->input->post('IjazahFile');
			$typeIjazah = explode('/', explode(':', substr($IjazahFile, 0, strpos($IjazahFile, ';')))[1]);
			$acakIjazah = rand(00000000000,99999999999);
			$NameIjazah  = ('Ijazah_'.$acakIjazah.'.'.$typeIjazah[1]);

			$SertifikatFile = $this->input->post('SertifikatFile');
			$typeSertifikat = explode('/', explode(':', substr($SertifikatFile, 0, strpos($SertifikatFile, ';')))[1]);
			$acakSertifikat = rand(00000000000,99999999999);
			$NameSertifikat  = ('Sertifikat_'.$acakSertifikat.'.'.$typeSertifikat[1]);

			$KTPFile = $this->input->post('KTPFile');
			$typeKTP = explode('/', explode(':', substr($KTPFile, 0, strpos($KTPFile, ';')))[1]);
			$acakKTP = rand(00000000000,99999999999);
			$NameKTP  = ('KTP_'.$acakKTP.'.'.$typeKTP[1]);


			if (isset($IjazahFile) && !empty($IjazahFile)) {
				list($typeIjazah, $IjazahFile) = explode(';', $IjazahFile);
				list(, $IjazahFile)      = explode(',', $IjazahFile);
			}

			if (isset($SertifikatFile) && !empty($SertifikatFile)) {
				list($typeSertifikat, $SertifikatFile) = explode(';', $SertifikatFile);
				list(, $SertifikatFile)      = explode(',', $SertifikatFile);
			}

			if (isset($KTPFile) && !empty($KTPFile)) {
				list($typeKTP, $KTPFile) = explode(';', $KTPFile);
				list(, $KTPFile)      = explode(',', $KTPFile);
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
			if($KTPFile != ''){
				$KTPName = $NameKTP;
			} else {
				$KTPName = null;
			}

			$Nama = $this->input->post('Name');
			$BidangStudi = $this->input->post('BidangStudi');
			$Email = $this->input->post('Email');
			$NoTelp = $this->input->post('Telepon');
			$Cabang = $this->input->post('Cabang');

			$KodeBidangStudi['KodeBidangStudi'] = $BidangStudi;
			$query = $this->config_model->getSelectedData($this->db2 .'bidangstudi',$KodeBidangStudi)->row_array();
			$NamaBidangStudi = $query['NamaBidangStudi']; 

			$KodeCabang['KodeAreaCabang'] = $Cabang;
			$querycabang = $this->config_model->getSelectedData($this->db2 .'areacabang',$KodeCabang)->row_array();
			$NamaCabang = $querycabang['NamaAreaCabang']; 
			$EmailCabang = $querycabang['Email']; 

		    $data2 = array(
		    	'params' => array(
			   		'Nama' => $Nama,
			   		'NoKTP' => $this->input->post('NoKTP'),
			   		'TipeISmart' => $this->input->post('TipeiSmart'),
			   		'KodeAreaCabang' => $this->input->post('Area'),
			   		'KodeAreaCabang' => $Cabang,
			   		'BidStudi' => $BidangStudi,
			   		'BidangStudi2' => $this->input->post('BidangStudi2'),
			   		'AlamatRumah' => $this->input->post('Alamat'),
			   		'Email' => $Email,
			   		'PendidikanAkhir' => $this->input->post('Pendidikan'),
			   		'Pekerjaan' => $this->input->post('Pekerjaan'),
			   		'ScanIjazah' => $IjazahName,
			   		'Notelp' => $NoTelp,
			   		'Jurusan' => $this->input->post('Jurusan'),
			   		'ScanCertificate' => $SertifikatName,
			   		'ScanKTP' => $KTPName,
					'CreateDate'=> date('Y-m-d H:i:s'),
			   	),
			   	'from' => $this->db2 .'iSmartNew',
		    );
		    $msg2 = $this->config_model->insert($data2);

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

			if (isset($KTPFile) && !empty($KTPFile)) {
				$xdata = base64_decode($KTPFile);
				$file_path = 'assets/upload/ismart/KTP/';
				file_put_contents($file_path.$NameKTP, $xdata);
			}		
			if ($msg2==true) {

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
				'penerima' => array('erik.alfredo@primagama.co.id'/*,$EmailCabang*/),
				'subjek' => array('Data iSmart Baru'),
				'body' => array($body)
			));
				echo data_json(array("message"=>"Data iSmart berhasil disimpan.","notify"=>"success"));
			} else {
				echo data_json(array("message"=>"Data iSmart gagal disimpan.","notify"=>"error"));
			}

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
					'a.TipeISmart',
					'a.KodeAreaCabang',
					'a.BidStudi',
					'a.BidangStudi2',
					'a.AlamatRumah',
					'a.Email',
					'a.PendidikanAkhir',
					'a.Pekerjaan',
					'a.ScanIjazah',
					'a.NoTelp',
					'a.Jurusan',
					'a.ScanCertificate',
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
					'a.TipeISmart',
					'a.KodeAreaCabang',
					'a.BidStudi',
					'a.BidangStudi2',
					'a.AlamatRumah',
					'a.Email',
					'a.PendidikanAkhir',
					'a.Pekerjaan',
					'a.ScanIjazah',
					'a.NoTelp',
					'a.Jurusan',
					'a.ScanCertificate',
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
					'a.TipeISmart',
					'a.KodeAreaCabang',
					'a.BidStudi',
					'a.BidangStudi2',
					'a.AlamatRumah',
					'a.Email',
					'a.PendidikanAkhir',
					'a.Pekerjaan',
					'a.ScanIjazah',
					'a.NoTelp',
					'a.Jurusan',
					'a.ScanCertificate',
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

	/*public function test(){
		$BidangStudi['KodeBidangStudi'] = "IPA";
		$query = $this->config_model->getSelectedData($this->db2 .'bidangstudi',$BidangStudi)->row_array();
		echo $query['NamaBidangStudi']; 
	}*/
}