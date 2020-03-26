<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Legal extends CI_Controller {
	private $db2 = "TPrimaEdu_Prod.dbo.";

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('config_model');
        $this->load->library('upload');
        $this->config_model->manualQuery('EXEC SP_TRXFF');
    } 

	public function index()
	{	
		restrict();
		/*$data['breadcrumb_1'] = '<a href="'.base_url().'Student">Penyerahan Buku</a>';
		$this->template->set('title', 'Penyerahan Buku');
		$this->template->load('template', 'Student/StudentBC',$data);*/
	}

	public function get_cabang2()
	{
		$arr = array(
				'from' => $this->db2.'areacabang a',
				'join' => array(
					'Legal_Docs b' => array(
						'on' => 'a.KodeAreaCabang=b.BranchCode',
						'type' => 'inner'
					)
				),
				'where' => 'a.Area is not null',
				'order_by' => array('a.KodeAreaCabang' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);		
	}

	public function upload()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Upload Dokumen Legal</a>';
		$this->template->set('title', 'Upload Dokumen Legal');
		$this->template->load('template', 'Legal/upload',$data);
	}

	public function upload2()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Upload Dokumen Legal</a>';
		$this->template->set('title', 'Upload Dokumen Legal');
		$this->template->load('template', 'Legal/upload2',$data);
	}

	public function saveupload()
	{
		$token = $this->input->post('token');
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {
			$BranchCode = SUBSTR(base64_decode($this->input->post('BranchCode')),0,4);

			$FormCabang01 = $this->input->post('FormCabang01File');
			$typeFormCabang01 = explode('/', explode(':', substr($FormCabang01, 0, strpos($FormCabang01, ';')))[1]);
			$NameFormCabang01  = ($BranchCode.'_FormCabang01.'.$typeFormCabang01[1]);

			$FormCabang02 = $this->input->post('FormCabang02File');
			$typeFormCabang02 = explode('/', explode(':', substr($FormCabang02, 0, strpos($FormCabang02, ';')))[1]);
			$NameFormCabang02  = ($BranchCode.'_FormCabang02.'.$typeFormCabang02[1]);

			$SuratSanggup = $this->input->post('SuratSanggupFile');
			$typeSuratSanggup = explode('/', explode(':', substr($SuratSanggup, 0, strpos($SuratSanggup, ';')))[1]);
			$NameSuratSanggup  = ($BranchCode.'_SuratSanggup.'.$typeSuratSanggup[1]);

			$SuratPernyataan = $this->input->post('SuratPernyataanFile');
			$typeSuratPernyataan = explode('/', explode(':', substr($SuratPernyataan, 0, strpos($SuratPernyataan, ';')))[1]);
			$NameSuratPernyataan  = ($BranchCode.'_SuratPernyataan.'.$typeSuratPernyataan[1]);

			$SuratPernyataanRek = $this->input->post('SuratPernyataanRekFile');
			$typeSuratPernyataanRek = explode('/', explode(':', substr($SuratPernyataanRek, 0, strpos($SuratPernyataanRek, ';')))[1]);
			$NameSuratPernyataanRek  = ($BranchCode.'_SuratPernyataanRekening.'.$typeSuratPernyataanRek[1]);

			$PengurusCabang = $this->input->post('PengurusCabangFile');
			$typePengurusCabang = explode('/', explode(':', substr($PengurusCabang, 0, strpos($PengurusCabang, ';')))[1]);
			$NamePengurusCabang  = ($BranchCode.'_PengurusCabang.'.$typePengurusCabang[1]);

			$FormSurvey = $this->input->post('FormSurveyFile');
			$typeFormSurvey = explode('/', explode(':', substr($FormSurvey, 0, strpos($FormSurvey, ';')))[1]);
			$NameFormSurvey  = ($BranchCode.'_FormSurvey.'.$typeFormSurvey[1]);

			$FotoKantor = $this->input->post('FotoKantorFile');
			$typeFotoKantor = explode('/', explode(':', substr($FotoKantor, 0, strpos($FotoKantor, ';')))[1]);
			$NameFotoKantor  = ($BranchCode.'_FotoKantor.'.$typeFotoKantor[1]);

			$FormDiskon = $this->input->post('FormDiskonFile');
			$typeFormDiskon = explode('/', explode(':', substr($FormDiskon, 0, strpos($FormDiskon, ';')))[1]);
			$NameFormDiskon  = ($BranchCode.'_FormDiskon.'.$typeFormDiskon[1]);

			$FotoKK = $this->input->post('FotoKKFile');
			$typeFotoKK = explode('/', explode(':', substr($FotoKK, 0, strpos($FotoKK, ';')))[1]);
			$NameFotoKK  = ($BranchCode.'_FotoKK.'.$typeFotoKK[1]);

			$FotoKTP = $this->input->post('FotoKTPFile');
			$typeFotoKTP = explode('/', explode(':', substr($FotoKTP, 0, strpos($FotoKTP, ';')))[1]);
			$NameFotoKTP  = ($BranchCode.'_FotoKTP.'.$typeFotoKTP[1]);

			$FotoNPWP = $this->input->post('FotoNPWPFile');
			$typeFotoNPWP = explode('/', explode(':', substr($FotoNPWP, 0, strpos($FotoNPWP, ';')))[1]);
			$NameFotoNPWP  = ($BranchCode.'_FotoNPWP.'.$typeFotoNPWP[1]);

			$LembarSetuju = $this->input->post('LembarSetujuFile');
			$typeLembarSetuju = explode('/', explode(':', substr($LembarSetuju, 0, strpos($LembarSetuju, ';')))[1]);
			$NameLembarSetuju  = ($BranchCode.'_LembarSetuju.'.$typeLembarSetuju[1]);

			if (isset($FormCabang01) && !empty($FormCabang01)) {
				list($typeFormCabang01, $FormCabang01) = explode(';', $FormCabang01);
				list(, $FormCabang01)      = explode(',', $FormCabang01);
			}
			if (isset($FormCabang02) && !empty($FormCabang02)) {
				list($typeFormCabang02, $FormCabang02) = explode(';', $FormCabang02);
				list(, $FormCabang02)      = explode(',', $FormCabang02);
			}
			if (isset($SuratSanggup) && !empty($SuratSanggup)) {
				list($typeSuratSanggup, $SuratSanggup) = explode(';', $SuratSanggup);
				list(, $SuratSanggup)      = explode(',', $SuratSanggup);
			}
			if (isset($SuratPernyataan) && !empty($SuratPernyataan)) {
				list($typeSuratPernyataan, $SuratPernyataan) = explode(';', $SuratPernyataan);
				list(, $SuratPernyataan)      = explode(',', $SuratPernyataan);
			}
			if (isset($SuratPernyataanRek) && !empty($SuratPernyataanRek)) {
				list($typeSuratPernyataanRek, $SuratPernyataanRek) = explode(';', $SuratPernyataanRek);
				list(, $SuratPernyataanRek)      = explode(',', $SuratPernyataanRek);
			}
			if (isset($PengurusCabang) && !empty($PengurusCabang)) {
				list($typePengurusCabang, $PengurusCabang) = explode(';', $PengurusCabang);
				list(, $PengurusCabang)      = explode(',', $PengurusCabang);
			}
			if (isset($FormSurvey) && !empty($FormSurvey)) {
				list($typeFormSurvey, $FormSurvey) = explode(';', $FormSurvey);
				list(, $FormSurvey)      = explode(',', $FormSurvey);
			}
			if (isset($FotoKantor) && !empty($FotoKantor)) {
				list($typeFotoKantor, $FotoKantor) = explode(';', $FotoKantor);
				list(, $FotoKantor)      = explode(',', $FotoKantor);
			}
			if (isset($FormDiskon) && !empty($FormDiskon)) {
				list($typeFormDiskon, $FormDiskon) = explode(';', $FormDiskon);
				list(, $FormDiskon)      = explode(',', $FormDiskon);
			}
			if (isset($FotoKK) && !empty($FotoKK)) {
				list($typeFotoKK, $FotoKK) = explode(';', $FotoKK);
				list(, $FotoKK)      = explode(',', $FotoKK);
			}
			if (isset($FotoKTP) && !empty($FotoKTP)) {
				list($typeFotoKTP, $FotoKTP) = explode(';', $FotoKTP);
				list(, $FotoKTP)      = explode(',', $FotoKTP);
			}
			if (isset($FotoNPWP) && !empty($FotoNPWP)) {
				list($typeFotoNPWP, $FotoNPWP) = explode(';', $FotoNPWP);
				list(, $FotoNPWP)      = explode(',', $FotoNPWP);
			}
			if (isset($LembarSetuju) && !empty($LembarSetuju)) {
				list($typeLembarSetuju, $LembarSetuju) = explode(';', $LembarSetuju);
				list(, $LembarSetuju)      = explode(',', $LembarSetuju);
			}

			if(isset($FormCabang01) && !empty($FormCabang01)){
				$NameFormCabang01Fix = $NameFormCabang01;
			} else {
				$NameFormCabang01Fix = NULL;
			}
			if(isset($FormCabang02) && !empty($FormCabang02)){
				$NameFormCabang02Fix = $NameFormCabang02;
			} else {
				$NameFormCabang02Fix = NULL;
			}
			if(isset($SuratSanggup) && !empty($SuratSanggup)){
				$NameSuratSanggupFix = $NameSuratSanggup;
			} else {
				$NameSuratPernyataanFix = NULL;
			}
			if(isset($SuratPernyataan) && !empty($SuratPernyataan)){
				$NameSuratPernyataanFix = $NameSuratPernyataan;
			} else {
				$NameSuratPernyataanFix = NULL;
			}
			if(isset($SuratPernyataanRek) && !empty($SuratPernyataanRek)){
				$NameSuratPernyataanRekFix = $NameSuratPernyataanRek;
			} else {
				$NameSuratPernyataanRekFix = NULL;
			}
			if(isset($PengurusCabang) && !empty($PengurusCabang)){
				$NamePengurusCabangFix = $NamePengurusCabang;
			} else {
				$NamePengurusCabangFix = NULL;
			}
			if(isset($FormSurvey) && !empty($FormSurvey)){
				$NameFormSurveyFix = $NameFormSurvey;
			} else {
				$NameFormSurveyFix = NULL;
			}
			if(isset($FotoKantor) && !empty($FotoKantor)){
				$NameFotoKantorFix = $NameFotoKantor;
			} else {
				$NameFotoKantorFix = NULL;
			}
			if(isset($FormDiskon) && !empty($FormDiskon)){
				$NameFormDiskonFix = $NameFormDiskon;
			} else {
				$NameFormDiskonFix = NULL;
			}
			if(isset($FotoKK) && !empty($FotoKK)){
				$NameFotoKKFix = $NameFotoKK;
			} else {
				$NameFotoKKFix = NULL;
			}
			if(isset($FotoKTP) && !empty($FotoKTP)){
				$NameFotoKTPFix = $NameFotoKTP;
			} else {
				$NameFotoKTPFix = NULL;
			}
			if(isset($FotoNPWP) && !empty($FotoNPWP)){
				$NameFotoNPWPFix = $NameFotoNPWP;
			} else {
				$NameFotoNPWPFix = NULL;
			}
			if(isset($LembarSetuju) && !empty($LembarSetuju)){
				$NameLembarSetujuFix = $NameLembarSetuju;
			} else {
				$NameLembarSetujuFix = NULL;
			}

			$master = array(
				'params' => array(
					'BranchCode' => base64_decode($this->input->post('BranchCode')),
					'FormCabang01' => $NameFormCabang01Fix,
					'FormCabang02' => $NameFormCabang02Fix,
					'SuratSanggup' => $NameSuratSanggupFix,
					'SuratPernyataan' => $NameSuratPernyataanFix,
					'SuratPernyataanRek' => $NameSuratPernyataanRekFix,
					'PengurusCabang' => $NamePengurusCabangFix,
					'FormSurvey' => $NameFormSurveyFix,
					'FotoKantor' => $NameFotoKantorFix,
					'FormDiskon' => $NameFormDiskonFix,
					'FotoKK' => $NameFotoKKFix,
					'FotoKTP' => $NameFotoKTPFix,
					'FotoNPWP' => $NameFotoNPWPFix,
					'LembarPersetujuan' => $NameLembarSetujuFix,
					'CreatedBy' => $this->session->userdata('Username'),
					'CreatedDate' => date('Y-m-d H:i:s'),

				),
				'from' => 'Legal_Docs'
			);
			$rslt = $this->config_model->insert($master);

			if (isset($FormCabang01) && !empty($FormCabang01)) {
				$xdata = base64_decode($FormCabang01);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFormCabang01, $xdata);
			}
			if (isset($FormCabang02) && !empty($FormCabang02)) {
				$xdata = base64_decode($FormCabang02);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFormCabang02, $xdata);
			}
			if (isset($SuratSanggup) && !empty($SuratSanggup)) {
				$xdata = base64_decode($SuratSanggup);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameSuratSanggup, $xdata);
			}
			if (isset($SuratPernyataan) && !empty($SuratPernyataan)) {
				$xdata = base64_decode($SuratPernyataan);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameSuratPernyataan, $xdata);
			}
			if (isset($SuratPernyataanRek) && !empty($SuratPernyataanRek)) {
				$xdata = base64_decode($SuratPernyataanRek);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameSuratPernyataanRek, $xdata);
			}
			if (isset($PengurusCabang) && !empty($PengurusCabang)) {
				$xdata = base64_decode($PengurusCabang);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NamePengurusCabang, $xdata);
			}
			if (isset($FormSurvey) && !empty($FormSurvey)) {
				$xdata = base64_decode($FormSurvey);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFormSurvey, $xdata);
			}
			if (isset($FotoKantor) && !empty($FotoKantor)) {
				$xdata = base64_decode($FotoKantor);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFotoKantor, $xdata);
			}
			if (isset($FormDiskon) && !empty($FormDiskon)) {
				$xdata = base64_decode($FormDiskon);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFormDiskon, $xdata);
			}
			if (isset($FotoKK) && !empty($FotoKK)) {
				$xdata = base64_decode($FotoKK);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFotoKK, $xdata);
			}
			if (isset($FotoKTP) && !empty($FotoKTP)) {
				$xdata = base64_decode($FotoKTP);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFotoKTP, $xdata);
			}
			if (isset($FotoNPWP) && !empty($FotoNPWP)) {
				$xdata = base64_decode($FotoNPWP);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFotoNPWP, $xdata);
			}
			if (isset($LembarSetuju) && !empty($LembarSetuju)) {
				$xdata = base64_decode($LembarSetuju);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameLembarSetuju, $xdata);
			}

					$data['message'] = 'Data berhasil disimpan';
			        $data['notify'] = 'success';
			        echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function list_docs()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Data Dokumen Legal</a>';
		$this->template->set('title', 'Data Dokumen Legal');
		$this->template->load('template', 'Legal/list_docs',$data);
	}

	public function loadlistdocs()
	{

		$token = $this->input->post('token');/*
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {*/
			$BranchCode = base64_decode($this->input->post('BranchCode'));
			$sql = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'a.KodeAreaCabang as BranchCode',
					'a.NamaAreaCabang as BranchName',
					'b.RecID as ID',
					'b.FormCabang01',
					'b.FormCabang02',
					'b.SuratSanggup',
					'b.SuratPernyataan',
					'b.SuratPernyataanRek',
					'b.PengurusCabang',
					'b.FormSurvey',
					'b.FotoKantor',
					'b.FotoTandaTangan',
					'b.FotoKK',
					'b.FotoKTP',
					'b.FotoNPWP',
					'b.LembarPersetujuan',
					'b.FormDiskon',
					'b.DaftarHadir',
					'b.SuratNotaris',
				),
				'from' => $this->db2.'areacabang a',
				'join' => array(
					'Legal_Docs b' => array(
						'on' => 'a.KodeAreaCabang=b.BranchCode',
						'type' => 'inner'
					),
				),
				//'where' => array('a.KodeAreaCabang' => $BranchCode),
			));
			$output['data'] = $sql->result_array();
			$output['rows'] = $sql->result_array();
			echo data_json($output);/*
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}

	public function loadupload2()
	{
		$Cabang =  base64_decode($this->input->post('BranchCode'));
		$arr = array(
				'from' => $this->db2.'areacabang a',
				'join' => array(
					'Legal_Docs b' => array(
						'on' => 'a.KodeAreaCabang=b.BranchCode',
						'type' => 'inner'
					)
				),
				'where' => array('a.KodeAreaCabang' => $Cabang),
			);
		$item = $this->config_model->find($arr);		
		//$sql = $item->row_array();
		$data['rows'] = $item->result_array();
		echo json_encode($data);	

	}

	public function updateupload2()
	{
		$token = $this->input->post('token');
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {
			$BranchCode = SUBSTR(base64_decode($this->input->post('BranchCode')),0,4);

			/*$FormCabang01 = $this->input->post('FormCabang01File');
			$typeFormCabang01 = explode('/', explode(':', substr($FormCabang01, 0, strpos($FormCabang01, ';')))[1]);
			$NameFormCabang01  = ($BranchCode.'_FormCabang01.'.$typeFormCabang01[1]);

			$FormCabang02 = $this->input->post('FormCabang02File');
			$typeFormCabang02 = explode('/', explode(':', substr($FormCabang02, 0, strpos($FormCabang02, ';')))[1]);
			$NameFormCabang02  = ($BranchCode.'_FormCabang02.'.$typeFormCabang02[1]);

			$SuratSanggup = $this->input->post('SuratSanggupFile');
			$typeSuratSanggup = explode('/', explode(':', substr($SuratSanggup, 0, strpos($SuratSanggup, ';')))[1]);
			$NameSuratSanggup  = ($BranchCode.'_SuratSanggup.'.$typeSuratSanggup[1]);

			$SuratPernyataan = $this->input->post('SuratPernyataanFile');
			$typeSuratPernyataan = explode('/', explode(':', substr($SuratPernyataan, 0, strpos($SuratPernyataan, ';')))[1]);
			$NameSuratPernyataan  = ($BranchCode.'_SuratPernyataan.'.$typeSuratPernyataan[1]);

			$SuratPernyataanRek = $this->input->post('SuratPernyataanRekFile');
			$typeSuratPernyataanRek = explode('/', explode(':', substr($SuratPernyataanRek, 0, strpos($SuratPernyataanRek, ';')))[1]);
			$NameSuratPernyataanRek  = ($BranchCode.'_SuratPernyataanRekening.'.$typeSuratPernyataanRek[1]);

			$PengurusCabang = $this->input->post('PengurusCabangFile');
			$typePengurusCabang = explode('/', explode(':', substr($PengurusCabang, 0, strpos($PengurusCabang, ';')))[1]);
			$NamePengurusCabang  = ($BranchCode.'_PengurusCabang.'.$typePengurusCabang[1]);

			$FormSurvey = $this->input->post('FormSurveyFile');
			$typeFormSurvey = explode('/', explode(':', substr($FormSurvey, 0, strpos($FormSurvey, ';')))[1]);
			$NameFormSurvey  = ($BranchCode.'_FormSurvey.'.$typeFormSurvey[1]);

			$FotoKantor = $this->input->post('FotoKantorFile');
			$typeFotoKantor = explode('/', explode(':', substr($FotoKantor, 0, strpos($FotoKantor, ';')))[1]);
			$NameFotoKantor  = ($BranchCode.'_FotoKantor.'.$typeFotoKantor[1]);

			$FormDiskon = $this->input->post('FormDiskonFile');
			$typeFormDiskon = explode('/', explode(':', substr($FormDiskon, 0, strpos($FormDiskon, ';')))[1]);
			$NameFormDiskon  = ($BranchCode.'_FormDiskon.'.$typeFormDiskon[1]);

			$FotoKK = $this->input->post('FotoKKFile');
			$typeFotoKK = explode('/', explode(':', substr($FotoKK, 0, strpos($FotoKK, ';')))[1]);
			$NameFotoKK  = ($BranchCode.'_FotoKK.'.$typeFotoKK[1]);

			$FotoKTP = $this->input->post('FotoKTPFile');
			$typeFotoKTP = explode('/', explode(':', substr($FotoKTP, 0, strpos($FotoKTP, ';')))[1]);
			$NameFotoKTP  = ($BranchCode.'_FotoKTP.'.$typeFotoKTP[1]);

			$FotoNPWP = $this->input->post('FotoNPWPFile');
			$typeFotoNPWP = explode('/', explode(':', substr($FotoNPWP, 0, strpos($FotoNPWP, ';')))[1]);
			$NameFotoNPWP  = ($BranchCode.'_FotoNPWP.'.$typeFotoNPWP[1]);

			$LembarSetuju = $this->input->post('LembarSetujuFile');
			$typeLembarSetuju = explode('/', explode(':', substr($LembarSetuju, 0, strpos($LembarSetuju, ';')))[1]);
			$NameLembarSetuju  = ($BranchCode.'_LembarSetuju.'.$typeLembarSetuju[1]);*/

			$FotoTT = $this->input->post('FotoTTFile');
			$typeFotoTT = explode('/', explode(':', substr($FotoTT, 0, strpos($FotoTT, ';')))[1]);
			$NameFotoTT  = ($BranchCode.'_FotoTT.'.$typeFotoTT[1]);

			$DaftarHadir = $this->input->post('DaftarHadirFile');
			$typeDaftarHadir = explode('/', explode(':', substr($DaftarHadir, 0, strpos($DaftarHadir, ';')))[1]);
			$NameDaftarHadir  = ($BranchCode.'_DaftarHadir.'.$typeDaftarHadir[1]);

			$SuratNotaris = $this->input->post('SuratNotarisFile');
			$typeSuratNotaris = explode('/', explode(':', substr($SuratNotaris, 0, strpos($SuratNotaris, ';')))[1]);
			$NameSuratNotaris  = ($BranchCode.'_SuratNotaris.'.$typeSuratNotaris[1]);

			/*if (isset($FormCabang01) && !empty($FormCabang01)) {
				list($typeFormCabang01, $FormCabang01) = explode(';', $FormCabang01);
				list(, $FormCabang01)      = explode(',', $FormCabang01);
			}
			if (isset($FormCabang02) && !empty($FormCabang02)) {
				list($typeFormCabang02, $FormCabang02) = explode(';', $FormCabang02);
				list(, $FormCabang02)      = explode(',', $FormCabang02);
			}
			if (isset($SuratSanggup) && !empty($SuratSanggup)) {
				list($typeSuratSanggup, $SuratSanggup) = explode(';', $SuratSanggup);
				list(, $SuratSanggup)      = explode(',', $SuratSanggup);
			}
			if (isset($SuratPernyataan) && !empty($SuratPernyataan)) {
				list($typeSuratPernyataan, $SuratPernyataan) = explode(';', $SuratPernyataan);
				list(, $SuratPernyataan)      = explode(',', $SuratPernyataan);
			}
			if (isset($SuratPernyataanRek) && !empty($SuratPernyataanRek)) {
				list($typeSuratPernyataanRek, $SuratPernyataanRek) = explode(';', $SuratPernyataanRek);
				list(, $SuratPernyataanRek)      = explode(',', $SuratPernyataanRek);
			}
			if (isset($PengurusCabang) && !empty($PengurusCabang)) {
				list($typePengurusCabang, $PengurusCabang) = explode(';', $PengurusCabang);
				list(, $PengurusCabang)      = explode(',', $PengurusCabang);
			}
			if (isset($FormSurvey) && !empty($FormSurvey)) {
				list($typeFormSurvey, $FormSurvey) = explode(';', $FormSurvey);
				list(, $FormSurvey)      = explode(',', $FormSurvey);
			}
			if (isset($FotoKantor) && !empty($FotoKantor)) {
				list($typeFotoKantor, $FotoKantor) = explode(';', $FotoKantor);
				list(, $FotoKantor)      = explode(',', $FotoKantor);
			}
			if (isset($FormDiskon) && !empty($FormDiskon)) {
				list($typeFormDiskon, $FormDiskon) = explode(';', $FormDiskon);
				list(, $FormDiskon)      = explode(',', $FormDiskon);
			}
			if (isset($FotoKK) && !empty($FotoKK)) {
				list($typeFotoKK, $FotoKK) = explode(';', $FotoKK);
				list(, $FotoKK)      = explode(',', $FotoKK);
			}
			if (isset($FotoKTP) && !empty($FotoKTP)) {
				list($typeFotoKTP, $FotoKTP) = explode(';', $FotoKTP);
				list(, $FotoKTP)      = explode(',', $FotoKTP);
			}
			if (isset($FotoNPWP) && !empty($FotoNPWP)) {
				list($typeFotoNPWP, $FotoNPWP) = explode(';', $FotoNPWP);
				list(, $FotoNPWP)      = explode(',', $FotoNPWP);
			}
			if (isset($LembarSetuju) && !empty($LembarSetuju)) {
				list($typeLembarSetuju, $LembarSetuju) = explode(';', $LembarSetuju);
				list(, $LembarSetuju)      = explode(',', $LembarSetuju);
			}*/

			if (isset($FotoTT) && !empty($FotoTT)) {
				list($typeFotoTT, $FotoTT) = explode(';', $FotoTT);
				list(, $FotoTT)      = explode(',', $FotoTT);
			}
			if (isset($DaftarHadir) && !empty($DaftarHadir)) {
				list($typeDaftarHadir, $DaftarHadir) = explode(';', $DaftarHadir);
				list(, $DaftarHadir)      = explode(',', $DaftarHadir);
			}
			if (isset($SuratNotaris) && !empty($SuratNotaris)) {
				list($typeSuratNotaris, $SuratNotaris) = explode(';', $SuratNotaris);
				list(, $SuratNotaris)      = explode(',', $SuratNotaris);
			}

			/*if(isset($FormCabang01) && !empty($FormCabang01)){
				$NameFormCabang01Fix = $NameFormCabang01;
			} else {
				$NameFormCabang01Fix = NULL;
			}
			if(isset($FormCabang02) && !empty($FormCabang02)){
				$NameFormCabang02Fix = $NameFormCabang02;
			} else {
				$NameFormCabang02Fix = NULL;
			}
			if(isset($SuratSanggup) && !empty($SuratSanggup)){
				$NameSuratSanggupFix = $NameSuratSanggup;
			} else {
				$NameSuratPernyataanFix = NULL;
			}
			if(isset($SuratPernyataan) && !empty($SuratPernyataan)){
				$NameSuratPernyataanFix = $NameSuratPernyataan;
			} else {
				$NameSuratPernyataanFix = NULL;
			}
			if(isset($SuratPernyataanRek) && !empty($SuratPernyataanRek)){
				$NameSuratPernyataanRekFix = $NameSuratPernyataanRek;
			} else {
				$NameSuratPernyataanRekFix = NULL;
			}
			if(isset($PengurusCabang) && !empty($PengurusCabang)){
				$NamePengurusCabangFix = $NamePengurusCabang;
			} else {
				$NamePengurusCabangFix = NULL;
			}
			if(isset($FormSurvey) && !empty($FormSurvey)){
				$NameFormSurveyFix = $NameFormSurvey;
			} else {
				$NameFormSurveyFix = NULL;
			}
			if(isset($FotoKantor) && !empty($FotoKantor)){
				$NameFotoKantorFix = $NameFotoKantor;
			} else {
				$NameFotoKantorFix = NULL;
			}
			if(isset($FormDiskon) && !empty($FormDiskon)){
				$NameFormDiskonFix = $NameFormDiskon;
			} else {
				$NameFormDiskonFix = NULL;
			}
			if(isset($FotoKK) && !empty($FotoKK)){
				$NameFotoKKFix = $NameFotoKK;
			} else {
				$NameFotoKKFix = NULL;
			}
			if(isset($FotoKTP) && !empty($FotoKTP)){
				$NameFotoKTPFix = $NameFotoKTP;
			} else {
				$NameFotoKTPFix = NULL;
			}
			if(isset($FotoNPWP) && !empty($FotoNPWP)){
				$NameFotoNPWPFix = $NameFotoNPWP;
			} else {
				$NameFotoNPWPFix = NULL;
			}
			if(isset($LembarSetuju) && !empty($LembarSetuju)){
				$NameLembarSetujuFix = $NameLembarSetuju;
			} else {
				$NameLembarSetujuFix = NULL;
			}*/

			if(isset($FotoTT) && !empty($FotoTT)){
				$NameFotoTTFix = $NameFotoTT;
			} else {
				$NameFotoTTFix = NULL;
			}
			if(isset($DaftarHadir) && !empty($DaftarHadir)){
				$NameDaftarHadirFix = $NameDaftarHadir;
			} else {
				$NameDaftarHadirFix = NULL;
			}
			if(isset($SuratNotaris) && !empty($SuratNotaris)){
				$NameSuratNotarisFix = $NameSuratNotaris;
			} else {
				$NameSuratNotarisFix = NULL;
			}

			$master = array(
				'params' => array(
					//'BranchCode' => base64_decode($this->input->post('BranchCode')),
					/*'FormCabang01' => $NameFormCabang01Fix,
					'FormCabang02' => $NameFormCabang02Fix,
					'SuratSanggup' => $NameSuratSanggupFix,
					'SuratPernyataan' => $NameSuratPernyataanFix,
					'SuratPernyataanRek' => $NameSuratPernyataanRekFix,
					'PengurusCabang' => $NamePengurusCabangFix,
					'FormSurvey' => $NameFormSurveyFix,
					'FotoKantor' => $NameFotoKantorFix,
					'FormDiskon' => $NameFormDiskonFix,
					'FotoKK' => $NameFotoKKFix,
					'FotoKTP' => $NameFotoKTPFix,
					'FotoNPWP' => $NameFotoNPWPFix,
					'LembarPersetujuan' => $NameLembarSetujuFix,*/
					'FotoTandaTangan' => $NameFotoTTFix,
					'SuratNotaris' => $NameSuratNotarisFix,
					'DaftarHadir' => $NameDaftarHadirFix,
					'EditBy' => $this->session->userdata('Username'),
					'EditDate' => date('Y-m-d H:i:s'),

				),
				'from' => 'Legal_Docs',
				'where' => array('BranchCode'=> base64_decode($this->input->post('BranchCode'))),
			);
			$rslt = $this->config_model->update($master);

			/*if (isset($FormCabang01) && !empty($FormCabang01)) {
				$xdata = base64_decode($FormCabang01);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFormCabang01, $xdata);
			}
			if (isset($FormCabang02) && !empty($FormCabang02)) {
				$xdata = base64_decode($FormCabang02);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFormCabang02, $xdata);
			}
			if (isset($SuratSanggup) && !empty($SuratSanggup)) {
				$xdata = base64_decode($SuratSanggup);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameSuratSanggup, $xdata);
			}
			if (isset($SuratPernyataan) && !empty($SuratPernyataan)) {
				$xdata = base64_decode($SuratPernyataan);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameSuratPernyataan, $xdata);
			}
			if (isset($SuratPernyataanRek) && !empty($SuratPernyataanRek)) {
				$xdata = base64_decode($SuratPernyataanRek);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameSuratPernyataanRek, $xdata);
			}
			if (isset($PengurusCabang) && !empty($PengurusCabang)) {
				$xdata = base64_decode($PengurusCabang);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NamePengurusCabang, $xdata);
			}
			if (isset($FormSurvey) && !empty($FormSurvey)) {
				$xdata = base64_decode($FormSurvey);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFormSurvey, $xdata);
			}
			if (isset($FotoKantor) && !empty($FotoKantor)) {
				$xdata = base64_decode($FotoKantor);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFotoKantor, $xdata);
			}
			if (isset($FormDiskon) && !empty($FormDiskon)) {
				$xdata = base64_decode($FormDiskon);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFormDiskon, $xdata);
			}
			if (isset($FotoKK) && !empty($FotoKK)) {
				$xdata = base64_decode($FotoKK);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFotoKK, $xdata);
			}
			if (isset($FotoKTP) && !empty($FotoKTP)) {
				$xdata = base64_decode($FotoKTP);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFotoKTP, $xdata);
			}
			if (isset($FotoNPWP) && !empty($FotoNPWP)) {
				$xdata = base64_decode($FotoNPWP);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFotoNPWP, $xdata);
			}
			if (isset($LembarSetuju) && !empty($LembarSetuju)) {
				$xdata = base64_decode($LembarSetuju);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameLembarSetuju, $xdata);
			}*/

			if (isset($FotoTT) && !empty($FotoTT)) {
				$xdata = base64_decode($FotoTT);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameFotoTT, $xdata);
			}
			if (isset($DaftarHadir) && !empty($DaftarHadir)) {
				$xdata = base64_decode($DaftarHadir);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameDaftarHadir, $xdata);
			}
			if (isset($SuratNotaris) && !empty($SuratNotaris)) {
				$xdata = base64_decode($SuratNotaris);
				$file_path = 'assets/upload/legal/';
				file_put_contents($file_path.$NameSuratNotaris, $xdata);
			}

					$data['message'] = 'Data berhasil disimpan';
			        $data['notify'] = 'success';
			        echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function download($img){				
		$this->load->helper(array('url','download'));
		//force_download('assets/upload/ff/'.,NULL);
		$data = file_get_contents(base_url("assets/upload/legal/".$img)); // Read the file's contents
        $name = $img;
        force_download($name, $data);
	}	

/*	public function downloadzip(){		
		//$files = array('readme.txt', 'test.html', 'image.gif');
		$files = "assets/upload/legal/0026_FormCabang01.pdf";
		$zipname = 'file.zip';
		$zip = new ZipArchive;
		$zip->open($zipname, ZipArchive::CREATE);
		foreach ($files as $file) {
		  $zip->addFile($file);
		}
		$zip->close();
		header('Content-Type: application/zip');
		header('Content-disposition: attachment; filename='.$zipname);
		header('Content-Length: ' . filesize($zipname));
		readfile($zipname);
	}*/
}