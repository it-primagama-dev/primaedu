<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Franchise extends CI_Controller {
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

	public function get_area()
	{
		if($this->session->userdata('UserGroup')==13){
			$where = "a.Area is null AND a.KodeAreaCabang='".$this->session->userdata('KodeAreaCabang')."'";
		} else {
			$where = "a.Area is null";
		}
		$arr = array(
				'from' => $this->db2.'areacabang a',
				'where' => $where,
				'order_by' => array('a.KodeAreaCabang' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function get_bank()
	{
		$arr = array(
				'from' => $this->db2.'bank',
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function get_propinsi()
	{
		$arr = array(
				'from' => $this->db2.'propinsi a',
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function get_kota($Propinsi)
	{
		$arr = array(
				'from' => $this->db2.'kotakab a',
				'where' => array('a.Propinsi' => $Propinsi),
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);		
	}

	public function get_kotaall()
	{
		$arr = array(
				'from' => $this->db2.'kotakab a',
				'order_by' => array('a.RecID' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function newbranch()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Tambah Cabang Baru</a>';
		$this->template->set('title', 'Tambah Cabang Baru');
		$this->template->load('template', 'Franchise/newbranch',$data);
	}

	public function save()
	{
		$token = $this->input->post('token');
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {
			$BranchCode = base64_decode($this->input->post('BranchCode'));

			$PicFileKTP = $this->input->post('PicKTPFile');
			$typeKTP = explode('/', explode(':', substr($PicFileKTP, 0, strpos($PicFileKTP, ';')))[1]);
			$acakKTP = rand(00000000000,99999999999);
			$PicNameKTP   = ('KTP_'.$BranchCode.'_'.$acakKTP.'.'.$typeKTP[1]);

			$PicFileNPWP = $this->input->post('PicNPWPFile');
			$typeNPWP = explode('/', explode(':', substr($PicFileNPWP, 0, strpos($PicFileNPWP, ';')))[1]);
			$acakNPWP = rand(00000000000,99999999999);
			$PicNameNPWP = ('NPWP_'.$BranchCode.'_'.$acakNPWP.'.'.$typeNPWP[1]);

			if (isset($PicFileKTP) && !empty($PicFileKTP)) {
				list($typeKTP, $PicFileKTP) = explode(';', $PicFileKTP);
				list(, $PicFileKTP)      = explode(',', $PicFileKTP);
			}
			if (isset($PicFileNPWP) && !empty($PicFileNPWP)) {
				list($typeNPWP, $PicFileNPWP) = explode(';', $PicFileNPWP);
				list(, $PicFileNPWP)      = explode(',', $PicFileNPWP);
			}

			if($PicFileKTP != ''){
				$KTPName = $PicNameKTP;
			} else {
				$KTPName = null;
			}

			if($PicFileNPWP != ''){
				$NPWPName = $PicNameNPWP;
			} else {
				$NPWPName = null;
			}

			$SektorPost = base64_decode($this->input->post('Sektor'));
			if($SektorPost != '' || $SektorPost != 0){
				$Sektor = $SektorPost;
			} else {
				$Sektor = null;
			}
			$master = array(
				'params' => array(
					'KodeAreaCabang' => base64_decode($this->input->post('BranchCode')),
					'Area' => base64_decode($this->input->post('Area')),
					'NamaAreaCabang' => base64_decode($this->input->post('BranchName')),
					'Aktif' => base64_decode($this->input->post('Status')),
					'NoRekBCA' => base64_decode($this->input->post('RekBCA')),
					'NamaRekBCA' => base64_decode($this->input->post('RekBCAName')),
					'KodeBankNonBCA' => base64_decode($this->input->post('BankName')),
					'NoRekNonBCA' => base64_decode($this->input->post('RekNonBCA')),
					'NamaRekNonBCA' => base64_decode($this->input->post('RekNonBCAName')),

					'NoTelp' => base64_decode($this->input->post('NoTelp')),
					'Alamat' => base64_decode($this->input->post('AlamatCabang')),
					'Email' => base64_decode($this->input->post('Email')),
					'Propinsi' => base64_decode($this->input->post('Propinsi')),
					'Kota' => base64_decode($this->input->post('Kota')),
					'KodePos' => base64_decode($this->input->post('KodePos')),

					'NamaFranchisee' => base64_decode($this->input->post('NamaFranchisee')),
					'AlamatFranchisee' => base64_decode($this->input->post('AlamatFranchisee')),
					'NoTelpFranchisee' => base64_decode($this->input->post('NoTelpFranchisee')),
					'EmailFranchisee' => base64_decode($this->input->post('EmailFranchisee')),
					'KTP' => $KTPName,
					'NoKTP' => base64_decode($this->input->post('NoKTP')),
					'NPWP' => $NPWPName,
					'NoNPWP' => base64_decode($this->input->post('NoNPWP')),
					'Statuskepemilikan' => $this->input->post('StatusKepemilikan'),
					'YStatuskepemilikan' => base64_decode($this->input->post('YangLain')),
					'Direktur' => base64_decode($this->input->post('NamaPemimpin')),
					'SIUP' => base64_decode($this->input->post('NoSIUP')),
					'TDP' => base64_decode($this->input->post('NoTDP')),

					'NamaManager' => base64_decode($this->input->post('NamaManager')),
					'NoHandPhone' => base64_decode($this->input->post('NoTelpManager')),
					'AlamatKC' => base64_decode($this->input->post('AlamatManager')),
					'Ismart' => base64_decode($this->input->post('iSmart')),
					'TelpIsmart' => base64_decode($this->input->post('NoTelpISmart')),
					'PAC' => base64_decode($this->input->post('PAC')),
					'telpPAC' => base64_decode($this->input->post('NoTelpPAC')),

					'Bentuk' => base64_decode($this->input->post('BentukB')),
					'StatusB' => base64_decode($this->input->post('StatusB')),

					'TanggalBerlaku' => base64_decode($this->input->post('TglBerlaku')),
					'TanggalBerakhir' => base64_decode($this->input->post('TglBerakhir')),
					'Sektor' => $Sektor,

				),
				'from' => $this->db2.'Areacabang'
			);
			$rslt = $this->config_model->insert($master);

			$fee = array(
				'params' => array(
					'BranchCode' => base64_decode($this->input->post('BranchCode')),
					'FFID' => 'PF-'.base64_decode($this->input->post('BranchCode')).'-1',
					'Value' => base64_decode($this->input->post('NilaiFF')),
					'Discount' => (!empty(base64_decode($this->input->post('Diskon')))) ? base64_decode($this->input->post('Diskon')) : NULL,
					//'PurchaseAmount' => base64_decode($this->input->post('TglBerakhir')),
					'TotalValue' => base64_decode($this->input->post('NilaiTotal')),
					'DateFrom' => base64_decode($this->input->post('TglBerlaku')),
					'DateTo' => base64_decode($this->input->post('TglBerakhir')),
					'DateMOU' => (!empty(base64_decode($this->input->post('TglMOU')))) ? base64_decode($this->input->post('TglMOU')) : NULL,
					'MOUNumber' => (!empty(base64_decode($this->input->post('NoMOU')))) ? base64_decode($this->input->post('NoMOU')) : NULL,
					//'BGNBalance' => base64_decode($this->input->post('Kota')),
					'Description' => base64_decode($this->input->post('Keterangan')),
					'PayMethod' => base64_decode($this->input->post('Metode')),
					'IsActive' => 1,
				),
				'from' => 'Franchise_Fee'
			);
			$rslt2 = $this->config_model->insert($fee);

			if(base64_decode($this->input->post('Metode'))=='Termin'){
				$Nominal = $this->input->post('Nominal');
				$DDate = $this->input->post('DueDate');
				$FFID = 'PF-'.base64_decode($this->input->post('BranchCode')).'-1';
				$data = [];
				for ($i=0; $i < count($Nominal); $i++) { 
					array_push($data, [
						'Nominal'=>str_replace(array('Rp ',',00','.'), '',$Nominal[$i]),
						'DueDate'=>$DDate[$i],
						'FFID'=>$FFID,
						'CreatedBy' => $this->session->userdata('Username'),
						'CreatedDateTime' => date('Y-m-d H:i:s'),
					]);
				}
				$msg = $this->config_model->insert_multiple($data,'Franchise_Termin');
			}

			if (isset($PicFileKTP) && !empty($PicFileKTP)) {
				$xdata = base64_decode($PicFileKTP);
				$file_path = 'assets/upload/ff/';
				file_put_contents($file_path.$PicNameKTP, $xdata);
			}
			if (isset($PicFileNPWP) && !empty($PicFileNPWP)) {
				$xdata = base64_decode($PicFileNPWP);
				$file_path = 'assets/upload/ff/';
				file_put_contents($file_path.$PicNameNPWP, $xdata);
			}
					$data['message'] = 'Data berhasil disimpan';
			         $data['notify'] = 'success';
			         echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
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

	public function editbranch()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Edit Data Cabang</a>';
		$this->template->set('title', 'Edit Data Cabang');
		$this->template->load('template', 'Franchise/editbranch',$data);
	}

	public function loadeditbranch()
	{
		$Cabang =  base64_decode($this->input->post('BranchCode'));
		$arr = array(/*
				'select' => array(
					'a.*',
					'b.*'
				),*/
				'from' => $this->db2.'areacabang a',
				'join' => array(
					'Franchise_Fee b' => array(
						'on' => 'a.KodeAreaCabang=b.BranchCode',
						'type' => 'left'
					),
					'Legal_Docs c' => array(
						'on' => 'a.KodeAreaCabang=c.BranchCode',
						'type' => 'left'
					)
				),
				'where' => array('a.KodeAreaCabang' => $Cabang, 'b.IsActive' => 1),
			);
		$item = $this->config_model->find($arr);		
		$sql = $item->row_array();
		$FFID = $sql['FFID'];
		$PAY = $sql['PayMethod'];
		if($PAY=='Termin'){
			$arr2 = array(
					'from' => 'Franchise_Termin a',
					'where' => array('a.FFID' => $FFID),
				);
			$item2 = $this->config_model->find($arr2);
			$data['rowse'] = $item2->result_array();
		} else {
			$data['rowse'] = 0;
		}
		$data['rows'] = $item->result_array();
		echo json_encode($data);	

	}

	public function saveedit()
	{
		$token = $this->input->post('token');
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {
			$BranchCode = base64_decode($this->input->post('BranchCode'));

			$SektorPost = base64_decode($this->input->post('Sektor'));
			if($SektorPost != '' || $SektorPost != 0){
				$Sektor = $SektorPost;
			} else {
				$Sektor = null;
			}
			$master = array(
				'params' => array(
					'Area' => base64_decode($this->input->post('Area')),
					'NamaAreaCabang' => base64_decode($this->input->post('BranchName')),
					'Aktif' => base64_decode($this->input->post('Status')),
					'NoRekBCA' => base64_decode($this->input->post('RekBCA')),
					'NamaRekBCA' => base64_decode($this->input->post('RekBCAName')),
					'KodeBankNonBCA' => base64_decode($this->input->post('BankName')),
					'NoRekNonBCA' => base64_decode($this->input->post('RekNonBCA')),
					'NamaRekNonBCA' => base64_decode($this->input->post('RekNonBCAName')),

					'NoTelp' => base64_decode($this->input->post('NoTelp')),
					'Alamat' => base64_decode($this->input->post('AlamatCabang')),
					'Email' => base64_decode($this->input->post('Email')),
					'Propinsi' => base64_decode($this->input->post('Propinsi')),
					'Kota' => base64_decode($this->input->post('Kota')),
					'KodePos' => base64_decode($this->input->post('KodePos')),

					'NamaFranchisee' => base64_decode($this->input->post('NamaFranchisee')),
					'AlamatFranchisee' => base64_decode($this->input->post('AlamatFranchisee')),
					'NoTelpFranchisee' => base64_decode($this->input->post('NoTelpFranchisee')),
					'EmailFranchisee' => base64_decode($this->input->post('EmailFranchisee')),
					'KTP' => (!empty(base64_decode($this->input->post('tmpktp')))) ? base64_decode($this->input->post('tmpktp')) : NULL,
					'NoKTP' => base64_decode($this->input->post('NoKTP')),
					'NPWP' => (!empty(base64_decode($this->input->post('tmpnpwp')))) ? base64_decode($this->input->post('tmpnpwp')) : NULL,
					'NoNPWP' => base64_decode($this->input->post('NoNPWP')),
					'Statuskepemilikan' => $this->input->post('StatusKepemilikan'),
					'YStatuskepemilikan' => base64_decode($this->input->post('YangLain')),
					'Direktur' => base64_decode($this->input->post('NamaPemimpin')),
					'SIUP' => base64_decode($this->input->post('NoSIUP')),
					'TDP' => base64_decode($this->input->post('NoTDP')),

					'NamaManager' => base64_decode($this->input->post('NamaManager')),
					'NoHandPhone' => base64_decode($this->input->post('NoTelpManager')),
					'AlamatKC' => base64_decode($this->input->post('AlamatManager')),
					'Ismart' => base64_decode($this->input->post('iSmart')),
					'TelpIsmart' => base64_decode($this->input->post('NoTelpISmart')),
					'PAC' => base64_decode($this->input->post('PAC')),
					'telpPAC' => base64_decode($this->input->post('NoTelpPAC')),

					'Bentuk' => base64_decode($this->input->post('BentukB')),
					'StatusB' => base64_decode($this->input->post('StatusB')),

					'TanggalBerlaku' => base64_decode($this->input->post('TglBerlaku')),
					'TanggalBerakhir' => base64_decode($this->input->post('TglBerakhir')),
					'Sektor' => $Sektor,

				),
				'from' => $this->db2.'Areacabang',
				'where' => array('KodeAreaCabang'=> base64_decode($this->input->post('BranchCode'))),
			);
			$rslt = $this->config_model->update($master);

			$fee = array(
				'params' => array(
					'Value' => base64_decode($this->input->post('NilaiFF')),
					'Discount' => (!empty(base64_decode($this->input->post('Diskon')))) ? base64_decode($this->input->post('Diskon')) : NULL,
					//'PurchaseAmount' => base64_decode($this->input->post('TglBerakhir')),
					'TotalValue' => base64_decode($this->input->post('NilaiTotal')),
					'DateFrom' => base64_decode($this->input->post('TglBerlaku')),
					'DateTo' => base64_decode($this->input->post('TglBerakhir')),
					'DateMOU' => (!empty(base64_decode($this->input->post('TglMOU')))) ? base64_decode($this->input->post('TglMOU')) : NULL,
					'MOUNumber' => (!empty(base64_decode($this->input->post('NoMOU')))) ? base64_decode($this->input->post('NoMOU')) : NULL,
					//'BGNBalance' => base64_decode($this->input->post('Kota')),
					'Description' => base64_decode($this->input->post('Keterangan')),
				),
				'from' => 'Franchise_Fee',
				'where' => array('FFID'=> base64_decode($this->input->post('FFID'))),
			);
			$rslt2 = $this->config_model->update($fee);

			$rec = array(
				'params' => array(
					'StatusApproval' => 1,
					'ApprovalBy' => $this->session->userdata('Username'),
					'ApprovalDateTime' => date('Y-m-d H:i:s'),
				),
				'from' => 'Franchise_Records',
				'where' => array('RecID'=> base64_decode($this->input->post('RecID'))),
			);
			$rslt3 = $this->config_model->update($rec);

				$data['message'] = 'Data berhasil disimpan';
			    $data['notify'] = 'success';
			    echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function renewal()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Input Data Perpanjangan Franchisee</a>';
		$this->template->set('title', 'Input Data Perpanjangan Franchisee');
		$this->template->load('template', 'Franchise/renewal',$data);
	}

	public function loadrenewal()
	{
		$Cabang =  base64_decode($this->input->post('BranchCode'));
		$arr = array(
				'select' => array(
					'a.FFID',
					'a.NoPay',
					'substring(a.FFID,9,2) as FFIDNUMB',
					'a.DateFrom',
					'a.DateTo',
					'isnull(a.BGNBALANCE,0) as BGN',
					'isnull(a.TotalValue,0) as TOT',
					'isnull(a.PurchaseAmount,0) + isnull(sum(b.AMOUNT),0) as PAY',
					'(isnull(a.BGNBALANCE,0) + isnull(a.TotalValue,0)) - (isnull(a.PurchaseAmount,0) + (isnull(sum(b.AMOUNT),0))) as BILL',
					'c.KodeAreaCabang as KodeCabang',
					'c.NamaAreaCabang as NamaCabang'
				),
				'from' => 'Franchise_Fee a',
				'join' => array(
					'Franchise_Transactions b' => array(
						'on' => 'a.FFID=b.FFID',
						'type' => 'left'
					),
					$this->db2.'areacabang c' => array(
						'on' => 'a.BranchCode=c.KodeAreaCabang',
						'type' => 'inner'
					)
				),
				'where' => array('a.BranchCode' => $Cabang, 'a.IsActive' => 1),
				'group_by' => array(
					'a.FFID',
					'a.NoPay',
					'substring(a.FFID,9,2)',
					'a.DateFrom',
					'a.DateTo',
					'isnull(a.BGNBALANCE,0)',
					'a.TotalValue',
					'isnull(a.PurchaseAmount,0)',
					'c.KodeAreaCabang',
					'c.NamaAreaCabang'
				),
			);
		$item = $this->config_model->find($arr);		
		$data = $item->row_array();
		echo json_encode($data);	
	}

	public function saverenewal()
	{
		$token = $this->input->post('token');
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {
			$BranchCode = base64_decode($this->input->post('BranchCode'));
			$Cabang = substr(base64_decode($this->input->post('BranchCode')),0,4);
			$FFID = base64_decode($this->input->post('FFIDNUMB'));
			$FFIDNUMB = $FFID+1;
			$fee = array(
				'params' => array(
					'BranchCode' => base64_decode($this->input->post('BranchCode')),
					'FFID' => 'PF-'.$Cabang.'-'.$FFIDNUMB,
					'Value' => base64_decode($this->input->post('NilaiFF')),
					'Discount' => (!empty(base64_decode($this->input->post('Diskon')))) ? base64_decode($this->input->post('Diskon')) : NULL,
					//'PurchaseAmount' => base64_decode($this->input->post('TglBerakhir')),
					'TotalValue' => base64_decode($this->input->post('NilaiTotal')),
					'DateFrom' => base64_decode($this->input->post('TglBerlaku')),
					'DateTo' => base64_decode($this->input->post('TglBerakhir')),
					'DateMOU' => (!empty(base64_decode($this->input->post('TglMOU')))) ? base64_decode($this->input->post('TglMOU')) : NULL,
					'MOUNumber' => (!empty(base64_decode($this->input->post('NoMOU')))) ? base64_decode($this->input->post('NoMOU')) : NULL,
					'BGNBalance' => base64_decode($this->input->post('BGN')),
					'Description' => base64_decode($this->input->post('Keterangan')),
					'PayMethod' => base64_decode($this->input->post('Metode')),
					'IsActive' => 1,
				),
				'from' => 'Franchise_Fee'
			);
			$rslt2 = $this->config_model->insert($fee);

			$master = array(
				'params' => array(
					'TanggalBerlaku' => base64_decode($this->input->post('TglBerlaku')),
					'TanggalBerakhir' => base64_decode($this->input->post('TglBerakhir')),
				),
				'from' => $this->db2.'Areacabang',
				'where' => array('KodeAreaCabang'=> base64_decode($this->input->post('BranchCode'))),
			);
			$rslt = $this->config_model->update($master);

			$feeupdt = array(
				'params' => array(
					'IsActive' => 0,
				),
				'from' => 'Franchise_Fee',
				'where' => array('FFID'=> base64_decode($this->input->post('FFID'))),
			);
			$rsltfeeupdt = $this->config_model->update($feeupdt);

				if(base64_decode($this->input->post('Metode'))=='Termin'){
					$Nominal = $this->input->post('Nominal');
					$DDate = $this->input->post('DueDate');
					$FFID = 'PF-'.$Cabang.'-'.$FFIDNUMB;
					$data = [];
					for ($i=0; $i < count($Nominal); $i++) { 
						array_push($data, [
							'Nominal'=>str_replace(array('Rp ',',00','.'), '',$Nominal[$i]),
							'DueDate'=>$DDate[$i],
							'FFID'=>$FFID,
							'CreatedBy' => $this->session->userdata('Username'),
							'CreatedDateTime' => date('Y-m-d H:i:s'),
						]);
					}
					$msg = $this->config_model->insert_multiple($data,'Franchise_Termin');
				}

				$data['message'] = 'Data berhasil disimpan';
			    $data['notify'] = 'success';
			    echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function listarea()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Laporan Detail Franchise Fee Per-Area</a>';
		$this->template->set('title', 'Laporan Detail Franchise Fee Per-Area');
		$this->template->load('template', 'Franchise/listarea',$data);
	}

	public function loadlistarea()
	{

		$token = $this->input->post('token');/*
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {*/
			$Area = base64_decode($this->input->post('Area'));
			$sql = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'b.RecID as ID',
					'b.FFID',
					'b.DateFrom',
					'b.DateTo',
					'isnull(b.BGNBALANCE,0) as BGN',
					'isnull(b.Value,0) as VAL',
					'isnull(b.Discount,0) as DIS',
					'isnull(b.TotalValue,0) as TOT',
					'isnull(b.PurchaseAmount,0) + isnull(sum(c.AMOUNT),0) as PAY',
					'(isnull(b.BGNBALANCE,0) + isnull(b.TotalValue,0)) - (isnull(b.PurchaseAmount,0) + (isnull(sum(c.AMOUNT),0))) as BILL',
					'(isnull(b.BGNBALANCE,0) + isnull(b.TotalValue,0)) as NET',
					'(isnull(b.Value,0) - isnull(b.Discount,0)) as DPP',
					'a.KodeAreaCabang as KodeCabang',
					'a.NamaAreaCabang as NamaCabang',
					"isnull(a.NoNPWP,'-') as NoNPWP",
					"isnull(a.NoKTP,'-') as NoKTP",
					'b.DateMOU',
					"KTP",
					"NPWP",
					"CAST(b.Description AS NVARCHAR(100)) Description"
				),
				'from' => $this->db2.'areacabang a',
				'join' => array(
					'Franchise_Fee b' => array(
						'on' => 'a.KodeAreaCabang=b.BranchCode',
						'type' => 'left'
					),
					'Franchise_Transactions c' => array(
						'on' => 'b.FFID=c.FFID',
						'type' => 'left'
					)
				),
				'where' => array('a.Area' => $Area, 'b.IsActive' => 1, 'a.Aktif' => 1),
				'group_by' => array(
					'b.RecID',
					'a.RecID',
					'b.FFID',
					'b.DateFrom',
					'b.DateTo',
					'isnull(b.BGNBALANCE,0)',
					'isnull(b.Value,0)',
					'isnull(b.Discount,0)',
					'b.TotalValue',
					'isnull(b.PurchaseAmount,0)',
					'a.KodeAreaCabang',
					'a.NamaAreaCabang',
					'a.NoNPWP',
					'a.NoKTP',
					'b.DateMOU',
					"KTP",
					"NPWP",
					"CAST(b.Description AS NVARCHAR(100))"
				)
			));
			$output['data'] = $sql->result_array();
			$output['rows'] = $sql->result_array();
			echo data_json($output);/*
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}

	public function loaddetailtrx($RecID)
	{
					
			$sql = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'b.RecID as ID',
					'isnull(b.BGNBALANCE,0) as BGN',
					'isnull(b.TotalValue,0) as TOT',
					'(isnull(b.BGNBALANCE,0) + isnull(b.TotalValue,0)) as NET',
					'a.KodeAreaCabang as KodeCabang',
					'a.NamaAreaCabang as NamaCabang',
					'b.PurchaseAmount as PCA',
					'c.AMOUNT as AMN',
					'c.PAYMENTDATETIME as DATE',
					'c.ReceiptId as Receipt',
					'c.RecID as RecID'
				),
				'from' => $this->db2.'areacabang a',
				'join' => array(
					'Franchise_Fee b' => array(
						'on' => 'a.KodeAreaCabang=b.BranchCode',
						'type' => 'left'
					),
					'Franchise_Transactions c' => array(
						'on' => 'b.FFID=c.FFID',
						'type' => 'left'
					)
				),
				'where' => array('b.RecID' => $RecID),
			));
			$output['rows'] = $sql->result_array();
			echo data_json($output);
	}

	public function listdatefrom()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Laporan Detail Franchise Fee Per-Tahun Akhir</a>';
		$this->template->set('title', 'Laporan Detail Franchise Fee Per-Tahun Akhir');
		$this->template->load('template', 'Franchise/listdatefrom',$data);
	}

	public function loadlistdatefrom()
	{

		$token = $this->input->post('token');/*
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {*/
			$DateFrom = base64_decode($this->input->post('DateFrom'));
			if($this->session->userdata('UserGroup')==13){
				//array('YEAR(b.DateTo)' => $DateFrom, 'b.IsActive' => 1, 'a.Aktif' => 1)
				$where = "YEAR(b.DateTo)=$DateFrom AND b.IsActive = 1 AND a.Aktif = 1 AND a.Area='".$this->session->userdata('KodeAreaCabang')."'";
			} else {
				$where = "YEAR(b.DateTo)=$DateFrom AND b.IsActive = 1 AND a.Aktif = 1";
			}
			$sql = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'b.RecID as ID',
					'b.FFID',
					'b.DateFrom',
					'b.DateTo',
					'isnull(b.BGNBALANCE,0) as BGN',
					'isnull(b.Value,0) as VAL',
					'isnull(b.Discount,0) as DIS',
					'isnull(b.TotalValue,0) as TOT',
					'isnull(b.PurchaseAmount,0) + isnull(sum(c.AMOUNT),0) as PAY',
					'(isnull(b.BGNBALANCE,0) + isnull(b.TotalValue,0)) - (isnull(b.PurchaseAmount,0) + (isnull(sum(c.AMOUNT),0))) as BILL',
					'(isnull(b.BGNBALANCE,0) + isnull(b.TotalValue,0)) as NET',
					'(isnull(b.Value,0) - isnull(b.Discount,0)) as DPP',
					'a.KodeAreaCabang as KodeCabang',
					'a.NamaAreaCabang as NamaCabang',
					"isnull(a.NoNPWP,'-') as NoNPWP",
					"isnull(a.NoKTP,'-') as NoKTP",
					"KTP",
					"NPWP",
					'b.DateMOU',
					"CAST(b.Description AS NVARCHAR(100)) Description"
				),
				'from' => $this->db2.'areacabang a',
				'join' => array(
					'Franchise_Fee b' => array(
						'on' => 'a.KodeAreaCabang=b.BranchCode',
						'type' => 'left'
					),
					'Franchise_Transactions c' => array(
						'on' => 'b.FFID=c.FFID',
						'type' => 'left'
					)
				),
				'where' => $where,
				'group_by' => array(
					'b.RecID',
					'a.RecID',
					'b.FFID',
					'b.DateFrom',
					'b.DateTo',
					'isnull(b.BGNBALANCE,0)',
					'isnull(b.Value,0)',
					'isnull(b.Discount,0)',
					'b.TotalValue',
					'isnull(b.PurchaseAmount,0)',
					'a.KodeAreaCabang',
					'a.NamaAreaCabang',
					'a.NoNPWP',
					'a.NoKTP',
					"KTP",
					"NPWP",
					'b.DateMOU',
					"CAST(b.Description AS NVARCHAR(100))"
				)
			));
			$output['data'] = $sql->result_array();
			$output['rows'] = $sql->result_array();
			echo data_json($output);/*
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}

	public function saverecord()
	{
		$token = $this->input->post('token');
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {
			$BranchCode = base64_decode($this->input->post('BranchCode'));

			$PicFileKTP = $this->input->post('PicKTPFile');
			$typeKTP = explode('/', explode(':', substr($PicFileKTP, 0, strpos($PicFileKTP, ';')))[1]);
			$acakKTP = rand(00000000000,99999999999);
			$PicNameKTP   = ('KTP_'.$BranchCode.'_'.$acakKTP.'.'.$typeKTP[1]);

			$PicFileNPWP = $this->input->post('PicNPWPFile');
			$typeNPWP = explode('/', explode(':', substr($PicFileNPWP, 0, strpos($PicFileNPWP, ';')))[1]);
			$acakNPWP = rand(00000000000,99999999999);
			$PicNameNPWP = ('NPWP_'.$BranchCode.'_'.$acakNPWP.'.'.$typeNPWP[1]);

			if (isset($PicFileKTP) && !empty($PicFileKTP)) {
				list($typeKTP, $PicFileKTP) = explode(';', $PicFileKTP);
				list(, $PicFileKTP)      = explode(',', $PicFileKTP);
			}
			if (isset($PicFileNPWP) && !empty($PicFileNPWP)) {
				list($typeNPWP, $PicFileNPWP) = explode(';', $PicFileNPWP);
				list(, $PicFileNPWP)      = explode(',', $PicFileNPWP);
			}

			if(isset($PicFileKTP) && !empty($PicFileKTP)){
				$KTPName = $PicNameKTP;
			} else {
				$KTPName = (!empty(base64_decode($this->input->post('tmpktp')))) ? base64_decode($this->input->post('tmpktp')) : NULL;
			}

			if(isset($PicFileNPWP) && !empty($PicFileNPWP)){
				$NPWPName = $PicNameNPWP;
			} else {
				$NPWPName = (!empty(base64_decode($this->input->post('tmpnpwp')))) ? base64_decode($this->input->post('tmpnpwp')) : NULL;
			}

			$SektorPost = base64_decode($this->input->post('Sektor'));
			if($SektorPost != '' || $SektorPost != 0){
				$Sektor = $SektorPost;
			} else {
				$Sektor = null;
			}
			$master = array(
				'params' => array(
					'KodeAreaCabang' => base64_decode($this->input->post('BranchCode')),
					'Area' => base64_decode($this->input->post('Area')),
					'NamaAreaCabang' => base64_decode($this->input->post('BranchName')),
					'Aktif' => base64_decode($this->input->post('Status')),
					'NoRekBCA' => base64_decode($this->input->post('RekBCA')),
					'NamaRekBCA' => base64_decode($this->input->post('RekBCAName')),
					'KodeBankNonBCA' => base64_decode($this->input->post('BankName')),
					'NoRekNonBCA' => base64_decode($this->input->post('RekNonBCA')),
					'NamaRekNonBCA' => base64_decode($this->input->post('RekNonBCAName')),

					'NoTelp' => base64_decode($this->input->post('NoTelp')),
					'Alamat' => base64_decode($this->input->post('AlamatCabang')),
					'Email' => base64_decode($this->input->post('Email')),
					'Propinsi' => base64_decode($this->input->post('Propinsi')),
					'Kota' => base64_decode($this->input->post('Kota')),
					'KodePos' => base64_decode($this->input->post('KodePos')),

					'NamaFranchisee' => base64_decode($this->input->post('NamaFranchisee')),
					'AlamatFranchisee' => base64_decode($this->input->post('AlamatFranchisee')),
					'NoTelpFranchisee' => base64_decode($this->input->post('NoTelpFranchisee')),
					'EmailFranchisee' => base64_decode($this->input->post('EmailFranchisee')),
					'KTP' => $KTPName,
					'NoKTP' => base64_decode($this->input->post('NoKTP')),
					'NPWP' => $NPWPName,
					'NoNPWP' => base64_decode($this->input->post('NoNPWP')),
					'Statuskepemilikan' => $this->input->post('StatusKepemilikan'),
					'YStatuskepemilikan' => base64_decode($this->input->post('YangLain')),
					'Direktur' => base64_decode($this->input->post('NamaPemimpin')),
					'SIUP' => base64_decode($this->input->post('NoSIUP')),
					'TDP' => base64_decode($this->input->post('NoTDP')),

					'NamaManager' => base64_decode($this->input->post('NamaManager')),
					'NoHandPhone' => base64_decode($this->input->post('NoTelpManager')),
					'AlamatKC' => base64_decode($this->input->post('AlamatManager')),
					'Ismart' => base64_decode($this->input->post('iSmart')),
					'TelpIsmart' => base64_decode($this->input->post('NoTelpISmart')),
					'PAC' => base64_decode($this->input->post('PAC')),
					'telpPAC' => base64_decode($this->input->post('NoTelpPAC')),

					'Bentuk' => base64_decode($this->input->post('BentukB')),
					'StatusB' => base64_decode($this->input->post('StatusB')),

					'TanggalBerlaku' => base64_decode($this->input->post('TglBerlaku')),
					'TanggalBerakhir' => base64_decode($this->input->post('TglBerakhir')),
					'Sektor' => $Sektor,
					'FFID' => base64_decode($this->input->post('FFID')),
					'Value' => base64_decode($this->input->post('NilaiFF')),
					'Discount' => (!empty(base64_decode($this->input->post('Diskon')))) ? base64_decode($this->input->post('Diskon')) : NULL,
					'TotalValue' => base64_decode($this->input->post('NilaiTotal')),
					'DateMOU' => (!empty(base64_decode($this->input->post('TglMOU')))) ? base64_decode($this->input->post('TglMOU')) : NULL,
					'MOUNumber' => (!empty(base64_decode($this->input->post('NoMOU')))) ? base64_decode($this->input->post('NoMOU')) : NULL,
					'Description' => base64_decode($this->input->post('Keterangan')),
					'CreatedBy' => $this->session->userdata('Username'),
					'CreatedDateTime' => date('Y-m-d H:i:s'),
					'StatusApproval' => 1,
					//'ApprovalBy' =>
					//'ApprovalDateTime' =>

				),
				'from' => 'Franchise_Records'
			);
			$rslt = $this->config_model->insert($master);

			$master2 = array(
				'params' => array(
					'Area' => base64_decode($this->input->post('Area')),
					'NamaAreaCabang' => base64_decode($this->input->post('BranchName')),
					'Aktif' => base64_decode($this->input->post('Status')),
					'NoRekBCA' => base64_decode($this->input->post('RekBCA')),
					'NamaRekBCA' => base64_decode($this->input->post('RekBCAName')),
					'KodeBankNonBCA' => base64_decode($this->input->post('BankName')),
					'NoRekNonBCA' => base64_decode($this->input->post('RekNonBCA')),
					'NamaRekNonBCA' => base64_decode($this->input->post('RekNonBCAName')),

					'NoTelp' => base64_decode($this->input->post('NoTelp')),
					'Alamat' => base64_decode($this->input->post('AlamatCabang')),
					'Email' => base64_decode($this->input->post('Email')),
					'Propinsi' => base64_decode($this->input->post('Propinsi')),
					'Kota' => base64_decode($this->input->post('Kota')),
					'KodePos' => base64_decode($this->input->post('KodePos')),

					'NamaFranchisee' => base64_decode($this->input->post('NamaFranchisee')),
					'AlamatFranchisee' => base64_decode($this->input->post('AlamatFranchisee')),
					'NoTelpFranchisee' => base64_decode($this->input->post('NoTelpFranchisee')),
					'EmailFranchisee' => base64_decode($this->input->post('EmailFranchisee')),
					'KTP' => (!empty(base64_decode($this->input->post('tmpktp')))) ? base64_decode($this->input->post('tmpktp')) : NULL,
					'NoKTP' => base64_decode($this->input->post('NoKTP')),
					'NPWP' => (!empty(base64_decode($this->input->post('tmpnpwp')))) ? base64_decode($this->input->post('tmpnpwp')) : NULL,
					'NoNPWP' => base64_decode($this->input->post('NoNPWP')),
					'Statuskepemilikan' => $this->input->post('StatusKepemilikan'),
					'YStatuskepemilikan' => base64_decode($this->input->post('YangLain')),
					'Direktur' => base64_decode($this->input->post('NamaPemimpin')),
					'SIUP' => base64_decode($this->input->post('NoSIUP')),
					'TDP' => base64_decode($this->input->post('NoTDP')),

					'NamaManager' => base64_decode($this->input->post('NamaManager')),
					'NoHandPhone' => base64_decode($this->input->post('NoTelpManager')),
					'AlamatKC' => base64_decode($this->input->post('AlamatManager')),
					'Ismart' => base64_decode($this->input->post('iSmart')),
					'TelpIsmart' => base64_decode($this->input->post('NoTelpISmart')),
					'PAC' => base64_decode($this->input->post('PAC')),
					'telpPAC' => base64_decode($this->input->post('NoTelpPAC')),

					'Bentuk' => base64_decode($this->input->post('BentukB')),
					'StatusB' => base64_decode($this->input->post('StatusB')),

					'TanggalBerlaku' => base64_decode($this->input->post('TglBerlaku')),
					'TanggalBerakhir' => base64_decode($this->input->post('TglBerakhir')),
					'Sektor' => $Sektor,

				),
				'from' => $this->db2.'Areacabang',
				'where' => array('KodeAreaCabang'=> base64_decode($this->input->post('BranchCode'))),
			);
			$rslt2 = $this->config_model->update($master2);

			$fee = array(
				'params' => array(
					'Value' => base64_decode($this->input->post('NilaiFF')),
					'Discount' => (!empty(base64_decode($this->input->post('Diskon')))) ? base64_decode($this->input->post('Diskon')) : NULL,
					//'PurchaseAmount' => base64_decode($this->input->post('TglBerakhir')),
					'TotalValue' => base64_decode($this->input->post('NilaiTotal')),
					'DateFrom' => base64_decode($this->input->post('TglBerlaku')),
					'DateTo' => base64_decode($this->input->post('TglBerakhir')),
					'DateMOU' => (!empty(base64_decode($this->input->post('TglMOU')))) ? base64_decode($this->input->post('TglMOU')) : NULL,
					'MOUNumber' => (!empty(base64_decode($this->input->post('NoMOU')))) ? base64_decode($this->input->post('NoMOU')) : NULL,
					//'BGNBalance' => base64_decode($this->input->post('Kota')),
					'Description' => base64_decode($this->input->post('Keterangan')),
				),
				'from' => 'Franchise_Fee',
				'where' => array('FFID'=> base64_decode($this->input->post('FFID'))),
			);
			$rslt2 = $this->config_model->update($fee);

			/*$rec = array(
				'params' => array(
					'StatusApproval' => 1,
					'ApprovalBy' => $this->session->userdata('Username'),
					'ApprovalDateTime' => date('Y-m-d H:i:s'),
				),
				'from' => 'Franchise_Records',
				'where' => array('RecID'=> base64_decode($this->input->post('RecID'))),
			);
			$rslt3 = $this->config_model->update($rec);*/

			if (isset($PicFileKTP) && !empty($PicFileKTP)) {
				$xdata = base64_decode($PicFileKTP);
				$file_path = 'assets/upload/ff/';
				file_put_contents($file_path.$PicNameKTP, $xdata);
			}
			if (isset($PicFileNPWP) && !empty($PicFileNPWP)) {
				$xdata = base64_decode($PicFileNPWP);
				$file_path = 'assets/upload/ff/';
				file_put_contents($file_path.$PicNameNPWP, $xdata);
			}
					$data['message'] = 'Data berhasil disimpan';
			        $data['notify'] = 'success';
			        echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function approval()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Approval Perubahan Data</a>';
		$this->template->set('title', 'Approval Perubahan Data');
		$this->template->load('template', 'Franchise/approval',$data);
	}

	public function statusapproval()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Data Perubahan</a>';
		$this->template->set('title', 'Data Perubahan');
		$this->template->load('template', 'Franchise/statusapproval',$data);
	}

	public function loadlistapproval()
	{

		$token = $this->input->post('token');/*
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {*/
			$DateFrom = base64_decode($this->input->post('DateFrom'));
			$sql = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'a.RecID as ID',
					'a.CreatedBy',
					'a.CreatedDateTime',
					'a.ApprovalBy',
					'a.ApprovalDateTime',
					'a.KodeAreaCabang',
					'a.NamaAreaCabang',
					"CASE a.StatusApproval 
					  WHEN 0 THEN 'Menunggu'
					  WHEN 1 THEN 'Approved'
					  WHEN 2 THEN 'Reject'
					END as StatusApproval"
				),
				'from' => 'Franchise_Records a',
				'order_by' => array('a.RecID' => DESC)
			));
			$output['data'] = $sql->result_array();
			//$output['rows'] = $sql->result_array();
			echo data_json($output);/*
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}

	public function loaddetailapproval($RecID)
	{
					
			$sql = $this->config_model->find(array(
				'from' => 'Franchise_Records a',
				'where' => array('a.RecID' => $RecID),
			));
			$data = $sql->row_array();
			echo data_json($data);
	}

	public function savereject()
	{
		$token = $this->input->post('token');
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {
			$rec = array(
				'params' => array(
					'StatusApproval' => 2,
					'ApprovalBy' => $this->session->userdata('Username'),
					'ApprovalDateTime' => date('Y-m-d H:i:s'),
				),
				'from' => 'Franchise_Records',
				'where' => array('RecID'=> base64_decode($this->input->post('RecID'))),
			);
			$rslt3 = $this->config_model->update($rec);
				$data['message'] = 'Data berhasil disimpan';
			    $data['notify'] = 'success';
			    echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}


	public function branch()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Data Pembayaran Franchise Fee</a>';
		$this->template->set('title', 'Data Pembayaran Franchise Fee');
		$this->template->load('template', 'Franchise/branch',$data);
	}

	public function loaddetailtrxbranch()
	{
					
			$sql = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'b.RecID as ID',
					'isnull(b.BGNBALANCE,0) as BGN',
					'isnull(b.TotalValue,0) as TOT',
					'(isnull(b.BGNBALANCE,0) + isnull(b.TotalValue,0)) as NET',
					'a.KodeAreaCabang as KodeCabang',
					'a.NamaAreaCabang as NamaCabang',
					'b.PurchaseAmount as PCA',
					'c.AMOUNT as AMN',
					'c.PAYMENTDATETIME as DATE'
				),
				'from' => $this->db2.'areacabang a',
				'join' => array(
					'Franchise_Fee b' => array(
						'on' => 'a.KodeAreaCabang=b.BranchCode',
						'type' => 'left'
					),
					'Franchise_Transactions c' => array(
						'on' => 'b.FFID=c.FFID',
						'type' => 'left'
					)
				),
				'where' => array('a.KodeAreaCabang' => $this->session->userdata('KodeAreaCabang'),'b.IsActive' => 1),
			));
			$output['rows'] = $sql->result_array();
			echo data_json($output);
	}	

	public function download($img){				
		$this->load->helper(array('url','download'));
		//force_download('assets/upload/ff/'.,NULL);
		$data = file_get_contents(base_url("assets/upload/ff/".$img)); // Read the file's contents
        $name = $img;
        force_download($name, $data);
	}	

	public function reportbranch()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Laporan Data Cabang Aktif / Tidak Aktif</a>';
		$this->template->set('title', 'Laporan Data Cabang Aktif / Tidak Aktif');
		$this->template->load('template', 'Franchise/reportbranch',$data);
	}

	public function loadreportbranch()
	{

		$token = $this->input->post('token');/*
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {*/
			$Status = base64_decode($this->input->post('Status'));
			$sql = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'b.RecID as ID',
					'b.FFID',
					'b.DateFrom',
					'b.DateTo',
					'isnull(b.BGNBALANCE,0) as BGN',
					'isnull(b.Value,0) as VAL',
					'isnull(b.Discount,0) as DIS',
					'isnull(b.TotalValue,0) as TOT',
					'isnull(b.PurchaseAmount,0) + isnull(sum(c.AMOUNT),0) as PAY',
					'(isnull(b.BGNBALANCE,0) + isnull(b.TotalValue,0)) - (isnull(b.PurchaseAmount,0) + (isnull(sum(c.AMOUNT),0))) as BILL',
					'(isnull(b.BGNBALANCE,0) + isnull(b.TotalValue,0)) as NET',
					'(isnull(b.Value,0) - isnull(b.Discount,0)) as DPP',
					'a.KodeAreaCabang as KodeCabang',
					'a.NamaAreaCabang as NamaCabang',
					"isnull(a.NoNPWP,'-') as NoNPWP",
					"isnull(a.NoKTP,'-') as NoKTP",
					'b.DateMOU',
					"a.KTP as KTP",
					"a.NPWP as NPWP",
					"CAST(b.Description AS NVARCHAR(100)) Description",
					"d.NamaAreaCabang as Area",
					"e.NamaPropinsi as Propinsi",
					"f.NamaKotaKab as Kota",
					"a.Alamat",
					"a.KodePos",
					"a.NoTelp",
					"a.NamaManager",
					"a.NoHandPhone",
					"a.NoRekBCA",
					"a.NamaRekBCA",
					"a.KodeBankNonBCA",
					"a.NoRekNonBCA",
					"a.NamaRekNonBCA",
					"a.Email",
					"a.NamaFranchisee",
					"a.AlamatFranchisee",
					"a.NoTelpFranchisee",
					"a.EmailFranchisee",
					"a.Sektor",
					"a.Statuskepemilikan",
					"a.YStatuskepemilikan",
					"a.AlamatKC",
					"a.Ismart",
					"a.TelpIsmart",
					"a.PAC",
					"a.telpPAC",
					"a.YStatus",
					"a.Bentuk",
					"a.YBentuk",
					"a.StatusB",
					"a.SIUP",
					"a.TDP",
					"a.Direktur"
				),
				'from' => $this->db2.'areacabang a',
				'join' => array(
					'Franchise_Fee b' => array(
						'on' => 'a.KodeAreaCabang=b.BranchCode',
						'type' => 'left'
					),
					'Franchise_Transactions c' => array(
						'on' => 'b.FFID=c.FFID',
						'type' => 'left'
					),
					$this->db2.'areacabang d' => array(
						'on' => 'a.Area=d.KodeAreaCabang',
						'type' => 'inner',
					),
					$this->db2.'propinsi e' => array(
						'on' => 'a.Propinsi=e.RecID',
						'type' => 'inner',
					),
					$this->db2.'kotakab f' => array(
						'on' => 'a.Kota=f.RecID',
						'type' => 'inner',
					),
				),
				'where' => array('b.IsActive' => 1, 'a.Aktif' => $Status),
				'group_by' => array(
					'b.RecID',
					'a.RecID',
					'b.FFID',
					'b.DateFrom',
					'b.DateTo',
					'isnull(b.BGNBALANCE,0)',
					'isnull(b.Value,0)',
					'isnull(b.Discount,0)',
					'b.TotalValue',
					'isnull(b.PurchaseAmount,0)',
					'a.KodeAreaCabang',
					'a.NamaAreaCabang',
					'a.NoNPWP',
					'a.NoKTP',
					'b.DateMOU',
					"a.KTP",
					"a.NPWP",
					"CAST(b.Description AS NVARCHAR(100))",
					"d.NamaAreaCabang",
					"e.NamaPropinsi",
					"f.NamaKotaKab",
					"a.Alamat",
					"a.KodePos",
					"a.NoTelp",
					"a.NamaManager",
					"a.NoHandPhone",
					"a.NoRekBCA",
					"a.NamaRekBCA",
					"a.KodeBankNonBCA",
					"a.NoRekNonBCA",
					"a.NamaRekNonBCA",
					"a.Email",
					"a.NamaFranchisee",
					"a.AlamatFranchisee",
					"a.NoTelpFranchisee",
					"a.EmailFranchisee",
					"a.Sektor",
					"a.Statuskepemilikan",
					"a.YStatuskepemilikan",
					"a.AlamatKC",
					"a.Ismart",
					"a.TelpIsmart",
					"a.PAC",
					"a.telpPAC",
					"a.YStatus",
					"a.Bentuk",
					"a.YBentuk",
					"a.StatusB",
					"a.SIUP",
					"a.TDP",
					"a.Direktur"
				)
			));
			$output['data'] = $sql->result_array();
			$output['rows'] = $sql->result_array();
			echo data_json($output);/*
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}

	public function test()
	{
		$Nominal = $this->input->post('Nominal');
		$DDate = $this->input->post('DueDate');
		$FFID = '9999-01';
		$data = [];
		for ($i=0; $i < count($Nominal); $i++) { 
			array_push($data, [
				'Nominal'=>str_replace(array('Rp ',',00','.'), '',$Nominal[$i]),
				'DueDate'=>$DDate[$i],
				'FFID'=>$FFID,
				'CreatedBy' => $this->session->userdata('Username'),
				'CreatedDateTime' => date('Y-m-d H:i:s'),
			]);
		}
		$msg = $this->config_model->insert_multiple($data,'Franchise_Termin');
	}

	public function searchbranch()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Cari Data Cabang</a>';
		$this->template->set('title', 'Cari Data Cabang');
		$this->template->load('template', 'Franchise/searchbranch',$data);
	}

	public function loadsearchbranch()
	{
		$Cabang =  base64_decode($this->input->post('BranchCode'));
		$arr = array(
				'from' => $this->db2.'areacabang a',
				'join' => array(
					'Franchise_Fee b' => array(
						'on' => 'a.KodeAreaCabang=b.BranchCode',
						'type' => 'left'
					)
				),
				'where' => array('a.KodeAreaCabang' => $Cabang, 'b.IsActive' => 1),
			);
		$item = $this->config_model->find($arr);		
		$sql = $item->row_array();
		$FFID = $sql['FFID'];
		$PAY = $sql['PayMethod'];
		if($PAY=='Termin'){
			$arr2 = array(
					'from' => 'Franchise_Termin a',
					'where' => array('a.FFID' => $FFID),
				);
			$item2 = $this->config_model->find($arr2);
			$data['rowse'] = $item2->result_array();
		} else {
			$data['rowse'] = 0;
		}
		$data['rows'] = $item->result_array();
		echo json_encode($data);	

	}

	public function resettenor() 
	{
		$token = $this->input->post('token');
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {

			$this->config_model->delete(array(
				'from' => 'Franchise_Termin',
				'where' => array('FFID' => base64_decode($this->input->post('FFID')))
			));
			$data['message'] = 'Termin Berhasil di Reset';
			$data['notify'] = 'success';
			echo json_encode($data);

		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function simpantenor() 
	{
		$token = $this->input->post('token');/*
		if (isset($token) && base64_decode($token) == 'Cr34t3d_by.H@mZ4h') {*/

			$Nominal = $this->input->post('Nominal');
			$DDate = $this->input->post('DueDate');
			$FFID = $this->input->post('FFID');
			$data = [];
			for ($i=0; $i < count($Nominal); $i++) { 
				array_push($data, [
					'Nominal'=>str_replace(array('Rp ',',00','.'), '',$Nominal[$i]),
					'DueDate'=>$DDate[$i],
					'FFID'=>$FFID,
					'CreatedBy' => $this->session->userdata('Username'),
					'CreatedDateTime' => date('Y-m-d H:i:s'),
				]);
			}
			$msg = $this->config_model->insert_multiple($data,'Franchise_Termin');
			
			$data['message'] = 'Termin Berhasil disimpan';
			$data['notify'] = 'success';
			echo json_encode($data);

		/*} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}

	public function receipt($RecID)
	{
		restrict();
		$data['RecID'] = $RecID;
		$this->template->set('title', 'Cari Data Cabang');
		$this->template->load('template', 'Franchise/receipt',$data);
	}

	public function loaddetailreceipt($RecID)
	{
					
			$sql = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'b.RecID as ID',
					'isnull(b.BGNBALANCE,0) as BGN',
					'isnull(b.TotalValue,0) as TOT',
					'(isnull(b.BGNBALANCE,0) + isnull(b.TotalValue,0)) as NET',
					'a.KodeAreaCabang as KodeCabang',
					'a.NamaAreaCabang as NamaCabang',
					'b.PurchaseAmount as PCA',
					'CAST(c.AMOUNT AS decimal(34,0)) as AMN',
					'c.PAYMENTDATETIME as DATE',
					'c.ReceiptId as Receipt',
					'c.RecID as RecID'
				),
				'from' => $this->db2.'areacabang a',
				'join' => array(
					'Franchise_Fee b' => array(
						'on' => 'a.KodeAreaCabang=b.BranchCode',
						'type' => 'left'
					),
					'Franchise_Transactions c' => array(
						'on' => 'b.FFID=c.FFID',
						'type' => 'left'
					)
				),
				'where' => array('c.RecID' => $RecID),
			));
			$output['rows'] = $sql->result_array();
			echo data_json($output);
	}

	public function loadpaymentmethod($FFID)
	{
		//$FFID =  base64_decode($this->input->post('BranchCode'));
		$arr = array(
				'from' => $this->db2.'areacabang a',
				'join' => array(
					'Franchise_Fee b' => array(
						'on' => 'a.KodeAreaCabang=b.BranchCode',
						'type' => 'left'
					)
				),
				'where' => array('b.RecID' => $FFID),
			);
		$item = $this->config_model->find($arr);		
		$sql = $item->row_array();
		$FFID = $sql['FFID'];
		$PAY = $sql['PayMethod'];
		if($PAY=='Termin'){
			$arr2 = array(
					'from' => 'Franchise_Termin a',
					'where' => array('a.FFID' => $FFID),
				);
			$item2 = $this->config_model->find($arr2);
			$data['rowse'] = $item2->result_array();
		} else {
			$data['rowse'] = 0;
		}
		$data['rows'] = $item->result_array();
		echo json_encode($data);	

	}

	public function updatepay()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Alokasi Pembayaran</a>';
		$this->template->set('title', 'Alokasi Pembayaran');
		$this->template->load('template', 'Franchise/updatepay',$data);
	}

	public function loadupdatepay()
	{
		$BranchCode =  substr($this->input->post('BranchCode'),0,4);
		$arr = array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY a.RecID DESC) as RowNum',
					'a.RecID',
					'a.FFID',
					'a.AMOUNT',
					'a.PAYMENTDATETIME'
				),
				'from' => 'Franchise_Transactions a',
				'where' => "a.FFID like '%$BranchCode%'",
			);
		$item = $this->config_model->find($arr);	
		$data['data'] = $item->result_array();
		echo json_encode($data);	

	}

	public function edit_pay($RecID)
	{
		$arr = array(
				'from' => 'Franchise_Transactions a',
				'where' => array('a.RecID' => $RecID)
			);
		$data = $this->config_model->find($arr)->row();
		echo json_encode($data);
	}

	public function get_kontrak($BranchCode)
	{
		$BranchCodeFix = substr($BranchCode,3,4);
		$arr = array(
				'from' => 'Franchise_Fee a',
				'where' => array('a.BranchCode '=> $BranchCodeFix)
			);	
		$item = $this->config_model->find($arr);	
		$data = $item->result_array();
		echo json_encode($data);	
	}

	public function edit_kontrak()
	{
		$data = array(
	    	'params' => array(
		    	'FFID' => $this->input->post('FF'),
		    ),
		    'from' => 'Franchise_Transactions',
			'where' => array('RecID' => $this->input->post('RecID'))
	    );
	    $msg = $this->config_model->update($data);
			echo data_json(array("message"=>"Data berhasil diubah.","notify"=>"success"));
	}
		
}