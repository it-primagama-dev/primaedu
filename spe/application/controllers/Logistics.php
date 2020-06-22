<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logistics extends CI_Controller {
	private $filename = "import_data"; // Kita tentukan nama filenya

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('config_model');
        $this->load->library(array('PHPExcel/PHPExcel'));
    }
//ITEM
    public function index()
    {
		restrict();
		$data = array(
			'title' => 'Dashboard',
		);
		$this->template->load('template', 'dashboard',$data);
    }

	public function stockitem()
	{	
		restrict();
		$this->config_model->manualQuery("UPDATE Logistics_StockItem set Logistics_StockItem.TotalStock = bc.Qty 
			from
			(select a.ItemCode,a.BarcodeId,COUNT(b.Barcode) as Qty from Logistics_MasterItem a
			join Logistics_ItemBarcode b on a.BarcodeId=SUBSTRING(b.Barcode,5,4)
			join Logistics_StockItem c on a.RecID=c.ItemID
			where c.Years=5 and b.Years=5 and b.BackupStatus is null
			group by a.ItemCode,a.BarcodeId) bc
			where Logistics_StockItem.ItemCode=bc.ItemCode and Logistics_StockItem.Years=5");
		$this->config_model->manualQuery("UPDATE Logistics_StockItem set Logistics_StockItem.OrderedStock = bc.Qty 
			from
			(select a.ItemCode, sum(a.Quantity) as Qty from Logistics_PODetail a
			join Logistics_POHeader b on a.PR_Number=b.PR_Number
			join Logistics_MasterItem c on a.ItemCode=c.ItemCode
			where b.Status = 2 and b.PR_Date > '2019-07-14' or b.Status = 0 and a.CreatedDate > '2019-07-14' or b.Status = 1 and b.PR_Date > '2019-07-14' or b.Status = 3 and b.PR_Date > '2019-07-14'
			group by a.ItemCode) bc
			where Logistics_StockItem.ItemCode=bc.ItemCode and Logistics_StockItem.Years = 5");
		$arr = array(
				'from' => 'Logistics_TypeItem',
			);
		$item = $this->config_model->find($arr);
		$data = array(
			'title' => 'Data Stok Item',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics">Data Stok Item</a>',
			'item' => $item,
		);
		$this->template->load('template', 'Logistics/stockitem',$data);

	}

	public function item()
	{	
		restrict();
		$arr = array(
				'from' => 'Logistics_TypeItem',
			);
		$item = $this->config_model->find($arr);
		$arr2 = array(
				'from' => 'Logistics_PackageItem',
			);
		$pack = $this->config_model->find($arr2);
		$data = array(
			'title' => 'Data Item / Buku',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics">Data Item / Buku</a>',
			'item' => $item,
			'pack' => $pack,
		);
		$this->template->load('template', 'Logistics/item',$data);

	}

	public function get_data_stockitem()
	{
		$ta = $this->input->post('TA');
		if($ta!=5){
			$where = 'e.Years = 4';
		} else {
			$where = 'e.Years = 5';	
		}
		$arr = array(
				'select' => array(
					'a.RecID',
					'a.ItemCode',
					'b.TypeName',
					'a.ItemName',
					'a.OrderStatus',
					'a.BarcodeId',
					'a.Price',
					'e.TotalStock',
					'e.OrderedStock',
					'd.PackCode',
					"(SELECT count(d.Barcode) from Logistics_ItemBarcode d where SUBSTRING(d.Barcode,5,4)=a.BarcodeId AND d.Years='$ta') as TotalStockBC",
					"(SELECT count(d.Barcode) from Logistics_ItemBarcode d where SUBSTRING(d.Barcode,5,4)=a.BarcodeId AND d.Years='$ta' and d.DeliveryStatus=1) as OrderedStockBC"
				),
				'from' => 'Logistics_MasterItem a',
				'join' => array(
					'Logistics_TypeItem b' => array(
						'on' => 'a.TypeId=b.RecID',
						'type' => 'left',
					),
					'Logistics_PackageItem d' => array(
						'on' => 'a.PackId=d.RecID',
						'type' => 'left',
					),
					'Logistics_StockItem e' => array(
						'on' => 'a.RecID=e.ItemID',
						'type' => 'inner',
					),
				),
				'where' => $where,
				'order_by' => array('a.PageId'=>'','d.Pack' => '','a.RecID' => ''),
			);
		$item = $this->config_model->find($arr);
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function get_data_item()
	{
		$arr = array(
				'select' => array(
					'a.RecID',
					'a.ItemCode',
					'b.TypeName',
					'a.ItemName',
					'a.OrderStatus',
					'a.BarcodeId',
					'a.Price',
					'd.PackCode',
				),
				'from' => 'Logistics_MasterItem a',
				'join' => array(
					'Logistics_TypeItem b' => array(
						'on' => 'a.TypeId=b.RecID',
						'type' => 'left',
					),
					'Logistics_PackageItem d' => array(
						'on' => 'a.PackId=d.RecID',
						'type' => 'left',
					),
				),
				'order_by' => array('a.PageId' => ''),
			);
		$item = $this->config_model->find($arr);
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function edit_item($RecID)
	{
		$arr = array(
				'from' => 'Logistics_MasterItem a',
				'where' => array('a.RecID' => $RecID)
			);
		$data = $this->config_model->find($arr)->row();
		echo json_encode($data);
	}

	public function add_item()
	{
		$data = array(
	    	'params' => array(
		    	'ItemCode' => $this->input->post('ItemCode'),
		    	'TypeId' => $this->input->post('ItemType'),
		    	'ItemName' => $this->input->post('ItemName'),
		    	'Price' => str_replace(array('Rp ',',00','.'), '', $this->input->post('Price')),
		    	'BarcodeId' => $this->input->post('Digit'),
		    	'OrderStatus' => 1,//$this->input->post('Status'),
		    	'AvailableStock' => 0,
		    	'OrderedStock' => 0,
		    	'TotalStock' => 0,
				'CreatedDate' => date("Y-m-d H:i:s"),
				'CreatedBy' => $this->session->userdata('Username'),
		    	'PackId' => $this->input->post('PackItem')
		    ),
		    'from' => 'Logistics_MasterItem',
	    );
	    $msg = $this->config_model->insert($data);
			echo data_json(array("message"=>"Data berhasil disimpan.","notify"=>"success"));
	}

	public function update_item()
	{
		$data = array(
	    	'params' => array(
		    	'ItemCode' => $this->input->post('ItemCode'),
		    	'TypeId' => $this->input->post('ItemType'),
		    	'ItemName' => $this->input->post('ItemName'),
		    	'Price' => str_replace(array('Rp ',',00','.'), '', $this->input->post('Price')),
		    	'BarcodeId' => $this->input->post('Digit'),
		    	'OrderStatus' => 1,
				'EditDate' => date("Y-m-d H:i:s"),
				'EditBy' => $this->session->userdata('Username'),
		    	'PackId' => $this->input->post('PackItem')
		    ),
		    'from' => 'Logistics_MasterItem',
			'where' => array('RecID' => $this->input->post('RecID'))
	    );
	    $msg = $this->config_model->update($data);
			echo data_json(array("message"=>"Data berhasil diubah.","notify"=>"success"));
	}

	public function delete_item()
	{
		$id = $this->input->post('RecID');
		if(isset($id)) {
			$msg = $this->config_model->delete_item($id);
			echo data_json(array("message"=>"Data berhasil dihapus.","notify"=>"success"));
		}
	}

	//Ekspedisi
	public function expedisi()
	{	
		restrict();
		$data = array(
			'title' => 'Data Expedisi',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics">Data Expedisi</a>'
		);
		$this->template->load('template', 'Logistics/expedisi',$data);

	}

	public function edit_exp($RecID)
	{
		$arr = array(
				'from' => 'Logistics_Expedisi a',
				'where' => array('a.RecID' => $RecID)
			);
		$data = $this->config_model->find($arr)->row();
		echo json_encode($data);
	}

	public function add_exp()
	{
		$data = array(
	    	'params' => array(
		    	'Exp_Name' => $this->input->post('Name_Exp'),
		    	'Contact' => $this->input->post('CP'),
		    	'Link' => $this->input->post('Link'),
		    	'Status' => $this->input->post('Status'),
				'CreatedDate' => date("Y-m-d H:i:s"),
				'CreatedBy' => $this->session->userdata('Username')
		    ),
		    'from' => 'Logistics_Expedisi',
	    );
	    $msg = $this->config_model->insert($data);
			echo data_json(array("message"=>"Data berhasil disimpan.","notify"=>"success"));
	}

	public function update_exp()
	{
		$data = array(
	    	'params' => array(
		    	'Exp_Name' => $this->input->post('Name_Exp'),
		    	'Contact' => $this->input->post('CP'),
		    	'Link' => $this->input->post('Link'),
		    	'Status' => $this->input->post('Status'),
				'EditDate' => date("Y-m-d H:i:s"),
				'EditBy' => $this->session->userdata('Username')
		    ),
		    'from' => 'Logistics_Expedisi',
			'where' => array('RecID' => $this->input->post('RecID'))
	    );
	    $msg = $this->config_model->update($data);
			echo data_json(array("message"=>"Data berhasil diubah.","notify"=>"success"));
	}

	public function delete_exp()
	{
		$id = $this->input->post('RecID');
		if(isset($id)) {
			$msg = $this->config_model->delete_exp($id);
			echo data_json(array("message"=>"Data berhasil dihapus.","notify"=>"success"));
		}
	}

	public function get_data_exp()
	{
		$arr = array(
				'from' => 'Logistics_Expedisi a',
			);
		$item = $this->config_model->find($arr);
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function list_po()
	{
		restrict();
		$arr = array(
				'from' => 'Logistics_TypeItem',
			);
		$item = $this->config_model->find($arr);
		$this->config_model->manualQuery("UPDATE Logistics_POHeader set Status=0
			from Logistics_POHeader a
			left join Logistics_Invoice b on a.PR_Number=b.PR_Number
			where b.RecID is null and a.Status != 0");
		/*if($this->session->userdata('Username')=='ciasem' OR $this->session->userdata('Username')=='0160.pac2') {*/
		$data = array(
			'title' => 'Data Pemesanan Buku',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics/list_po">Data Pemesanan Buku</a>',
			'item' => $item,
		);
//add here
        $qArr = array(
            'from' => 'TPrimaEdu_Prod.dbo.AreaCabang',
            'where' => 'RecID = '.$this->session->userdata("AreaCabang")
        );
        $sql = $this->config_model->find($qArr);
        $data["AreaCabang"] = $sql->row();
        
		$this->template->load('template', 'Logistics/list_po',$data);
		/*} else {
		$this->template->load('template', 'Logistics/comingsoon');
		}*/
	}

	public function order()
	{
		restrict();/*
		if($this->session->userdata('KodeAreaCabang')!='9999' && $this->session->userdata('KodeAreaCabang')!='0160'){
		$data = array(
			'title' => 'Form Pemesanan Buku',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics/list_po">Data Pemesanan Buku</a>',
			'breadcrumb_2' => '<a href="#">Order Buku</a>',
		);
		$this->template->load('template', 'Logistics/comingsoon',$data);	
		} else {*/
    	$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token)) {
		$where['BranchCode'] = $this->session->userdata('KodeAreaCabang');
		$where['Status'] = 0;
		$prdraft = $this->config_model->getSelectedData('Logistics_POHeader',$where)->row_array();
		//echo $prdraft['PR_Number'];
		if($prdraft['PR_Number']==''){
		$PR = $this->config_model->get_pr();
		} else {
		$PR = $prdraft['PR_Number'];
		}
		$this->config_model->manualQuery("UPDATE Logistics_POHeader set Status=0
			from Logistics_POHeader a
			left join Logistics_Invoice b on a.PR_Number=b.PR_Number
			where b.RecID is null and a.Status != 0");
		$this->config_model->manualQuery("UPDATE Logistics_MasterItem 
			set OrderedStock = Logistics_MasterItem.OrderedStock-a.Quantity
			from Logistics_PODetail a
			join Logistics_POHeader b on a.PR_Number=b.PR_Number 
			where b.Status = 0 and Logistics_MasterItem.ItemCode=a.ItemCode and a.CreatedDate<DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE()))");
		$this->config_model->manualQuery("DELETE a from Logistics_PODetail a
			join Logistics_POHeader b on a.PR_Number=b.PR_Number 
			where b.Status = 0 and a.CreatedDate<DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE()))");

		$arr2 = array(
			'select' => array(
				'a.Email as Email',
				'a.Alamat',
				'a.NoTelp as notelp',
				'a.NoHandPhone as nohp'
			),
			'from' => 'TPrimaEdu_Prod.dbo.areacabang a',
			'where' => array('a.KodeAreaCabang'=>$this->session->userdata('KodeAreaCabang')),
		);
		$sql = $this->config_model->find($arr2)->row_array();
		$estsql = array(
			'select' => array(
				'a.Description',
			),
			'from' => 'Logistics_Info a',
			'order_by' => array('a.RecID'=> DESC),
			'limit' => 1,
		);
		$est = $this->config_model->find($estsql)->row_array();
		$order6 = array(
			'select' => array(
				'count(a.RecID) as Order6',
			),
			'from' => 'Logistics_POHeader a',
			'where' => "a.BranchCode = '".$this->session->userdata('KodeAreaCabang')."' AND a.PR_Date >= '2019-07-14' AND a.Status != 0",
		);
		$sqlorder6 = $this->config_model->find($order6)->row_array();
		$ceknoexp = array(
			'from' => 'Logistics_NoExpedisi a',
			'where' => "a.BranchCode = '".$this->session->userdata('KodeAreaCabang')."' AND a.Status = 1",
		);
		$sqlcekno = $this->config_model->find($ceknoexp)->num_rows();
		if($sqlcekno > 0){
			$ongkir = 0;
		} else {
			$ongkir = $sqlorder6['Order6'];
		}
		$data = array(
			'title' => 'Form Pemesanan Buku',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics/list_po">Data Pemesanan Buku</a>',
			'breadcrumb_2' => '<a href="#">Order Buku</a>',
			'item' => $item,
			'order' => $ongkir,
			'PR' => $PR,
			'INV' => $this->config_model->get_invoice(),
			'Date' => $date,
			'Name' => $this->session->userdata('KodeAreaCabang').' - '.$this->session->userdata('NamaAreaCabang'),
			'Email' => $sql['Email'],
			'Alamat' => $sql['Alamat'].' / CP : '.$sql['notelp'].' / '.$sql['nohp'],
			'Estimasi' => $est['Description'],
			'BranchCode' => $this->session->userdata('KodeAreaCabang')
		);
		$this->template->load('template', 'Logistics/order',$data);	
	} else {
		echo data_json("Oops akses ditolak.");
	}
		//}
	}

	public function get_item()
	{

		/*$Piksun = array(
				'from' => 'Logistics_BranchOrderSP',
				'where' => array('Status' => '1','Category' => '1' ,'BranchCode' => $this->session->userdata('KodeAreaCabang')),
			);
		$CekPiksun = $this->config_model->find($Piksun)->num_rows();*/
		//echo $CekPiksun;
		$Pikse = array(
				'from' => 'Logistics_BranchOrderSP',
				'where' => array('Status' => '1','Category' => '2' ,'BranchCode' => $this->session->userdata('KodeAreaCabang')),
			);
		$CekPikse = $this->config_model->find($Pikse)->num_rows();
		//echo $CekPikse;
		/*$SE = array(
				'from' => 'Logistics_BranchOrderSP',
				'where' => array('Status' => '1','Category' => '3' ,'BranchCode' => $this->session->userdata('KodeAreaCabang')),
			);
		$CekSE = $this->config_model->find($SE)->num_rows();*/

		/*if($CekPiksun!=0 AND $CekPikse==0 AND $CekSE==0){
			$where = "PackType != '6' AND PackType != '5' AND Status = '1' OR PackCode = 'PB 12 SMK' AND Status = '1' OR PackCode like '%PIKSUN%' AND Status = '1'";
		} else if($CekPiksun!=0 AND $CekPikse!=0 AND $CekSE==0){
			$where = "PackType != '6' AND Status = '1' OR PackCode = 'PB 12 SMK' AND Status = '1'";
		} else if($CekPiksun==0 AND $CekPikse!=0 AND $CekSE==0){
			$where = "PackType != '6' AND PackType != '5' AND Status = '1' OR PackCode = 'PB 12 SMK' AND Status = '1' OR PackCode like '%PIKSE%' AND Status = '1'";
		} else if($CekPiksun==0 AND $CekPikse==0 AND $CekSE!=0){
			$where = "PackType != '5' AND Status = '1' OR PackCode = 'PB 12 SMK' AND Status = '1'";
		} else if($CekPiksun!=0 AND $CekPikse==0 AND $CekSE!=0){
			$where = "PackType != '5' AND Status = '1' OR PackCode = 'PB 12 SMK' AND Status = '1' OR PackCode like '%PIKSUN%' AND Status = '1'";
		} else if($CekPiksun==0 AND $CekPikse!=0 AND $CekSE!=0){
			$where = "PackType != '5' AND Status = '1' OR PackCode = 'PB 12 SMK' AND Status = '1' OR PackCode like '%PIKSE%' AND Status = '1'";
		} else if($CekPiksun!=0 AND $CekPikse!=0 AND $CekSE!=0){
			$where = "Status = '1'";
		} else {
			$where = "PackType != '6' AND PackType != '5' AND Status = '1' OR PackCode = 'PB 12 SMK' AND Status = '1'";
		}*/

		if($CekPikse == 0){
			$where = "Status = 1 AND PackType !=5 OR PackType = 5 AND PackCode not like '%PIKSE%' AND Status = 1";
		} else {
			$where = "Status = 1";
		}

		$arr = array(
				'from' => 'Logistics_PackageItem',
				'where' => $where,
				'order_by' => array('Number' => '')
			);

		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function get_item_lessdo()
	{
		$arr = array(
				'from' => 'Logistics_MasterItem',
				'where' => array('TypeId' => '5'),
				'order_by' => array('PackId' => '')
			);
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function cek_order_tmp()
	{
		$arr = array(
			'select' => array(
				'count(a.RecID) as total_item',
			),
			'from' => 'Logistics_PODetail a',
			'where' => array('a.PR_Number'=>$this->input->post('PR'),'a.ItemCode'=>$this->input->post('ItemCode')),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'][] = $sql->row_array();
		} else {
			$data['rows'][] = array('total_item'=>0);
		}
		echo json_encode($data);
	}

  	public function order_add()
	{
		restrict();
    	/*$token = base64_decode($this->input->post('token'));
		if(isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {*/
		//$ItemCode['ItemCode'] = $this->input->post('ItemCode');
		//$Item = $this->config_model->getSelectedData('Logistics_MasterItem',$ItemCode)->row_array();
		$order6 = array(
			'select' => array(
				'count(a.RecID) as Order6',
			),
			'from' => 'Logistics_POHeader a',
			'where' => "a.BranchCode = '".$this->session->userdata('KodeAreaCabang')."' AND a.PR_Date >= '2019-06-14' AND a.Status != 0",
		);
		$sqlorder6 = $this->config_model->find($order6)->row_array();
		$ceknoexp = array(
			'from' => 'Logistics_NoExpedisi a',
			'where' => "a.BranchCode = '".$this->session->userdata('KodeAreaCabang')."' AND a.Status = 1",
		);
		$sqlcekno = $this->config_model->find($ceknoexp)->num_rows();
		//validasi PR sudah ada
 		$arr = array(
			'select' => array(
				'count(a.RecID) as total',
			),
			'from' => 'Logistics_POHeader a',
			'where' => array('a.PR_Number'=>$this->input->post('PR')),
		);
		$sql = $this->config_model->find($arr)->row_array();
		//cek paket sama
		$cekpack = array(
			'from' => 'Logistics_PODetail a',
			'where' => "a.PR_Number = '".$this->input->post('PR')."' AND a.PackCode = '".$this->input->post('ItemCode')."'",
		);
		$sqlcekpack = $this->config_model->find($cekpack)->num_rows();
		$itempack=$this->input->post('ItemCode');
		$pr=$this->input->post('PR');
	    $date = date('Y-m-d H:i:s');
	    $user = $this->session->userdata('Username');
	    //Cek PackType
 		$pk = array(
			'select' => array(
				'a.PackType',
			),
			'from' => 'Logistics_PackageItem a',
			'where' => array('a.RecID'=>$itempack),
		);
		$sqlpk = $this->config_model->find($pk)->row_array();
	    /*if($itempack==5 OR $itempack==6 OR $itempack==7) {
			$where = "a.PackId = '$itempack' or a.PackId='14'";
	    } else if($itempack==8 OR $itempack==10 OR $itempack==12) {
	    	$where = "a.PackId = '$itempack' or a.PackId='17' or a.PackId='15'";
	    } else if($itempack==9 OR $itempack==11 OR $itempack==13) {
	    	$where = "a.PackId = '$itempack' or a.PackId='17' or a.PackId='16'";
	    } else {
	    	$where = "a.PackId = '$itempack'";
	    }*/
		$PackType=$sqlpk['PackType'];
	    $IC = 'a.ItemCode';
	    if($sqlcekpack <= 0){
			if($sqlorder6['Order6']>=6 AND $sqlcekno <= 0 AND $PackType!=6 AND $PackType!=8){  
				$DelivFee = 'a.DelivFee';
				$Price = 'a.Price';
			} else if($sqlorder6['Order6']>=6 AND $sqlcekno <= 0 AND $PackType==6){ 	
				$DelivFee = 'a.DelivFeeB';
				$Price = 'a.PriceB';
			} else if($sqlorder6['Order6'] >=6 AND $sqlcekno > 0 AND $PackType!=6 AND $PackType!=8){ 	
				$DelivFee = 0;
				$Price = 'a.Price';
			} else if($sqlorder6['Order6'] >=6 AND $sqlcekno > 0 AND $PackType==8){ 	
				$DelivFee = 0;
				$Price = 'c.PricePack';
			} else if($sqlorder6['Order6'] < 6 AND $PackType!=6 AND $PackType!=8){ 	
				$DelivFee = 0;
				$Price = 'a.Price';
			} else if($sqlorder6['Order6'] < 6 AND $PackType==6){ 	
				$DelivFee = 0;
				$Price = 'a.PriceB';
			} 	 	
				$this->config_model->manualQuery("
					INSERT INTO Logistics_PODetail
					SELECT  
						'$pr',
						$IC,
						$Price,
						0,
						null,
						'$user',
						'$date',
						null,
						null,
						'$itempack',
						$DelivFee
					FROM Logistics_PackageDetail b
					JOIN Logistics_MasterItem a ON b.ItemCode=a.ItemCode
					JOIN Logistics_PackageItem c ON b.PackId=c.RecID
					where b.PackId='$itempack'");	 
		}

					if ($sql['total']<=0) {    	
						$data2 = array(
		    			'params' => array(
			    			'PR_Number' => $this->input->post('PR'),
			    			'Status' => 0,
			    			'BranchCode' => $this->session->userdata('KodeAreaCabang'),
			    			'CreatedDate' => date('Y-m-d H:i:s'),
			    			'CreatedBy' => $this->session->userdata('Username')
			    		),
			    		'from' => 'Logistics_POHeader',
		    		);
		    		$this->config_model->insert($data2);
						$data3 = array(
		    			'params' => array(
			    			'PR_Number' => $this->input->post('PR'),
			    			'Tracking_Name' => 'Request Pemesanan',
			    			'Status' => 1,
			    			'CreatedDate' => date('Y-m-d H:i:s'),
			    			'CreatedBy' => $this->session->userdata('Username')
			    		),
			    		'from' => 'Logistics_Tracking',
		    		);
		    		$this->config_model->insert($data3);
		    		}
		echo data_json(array("message"=>"Item berhasil ditambahkan.","notify"=>"success"));
		/*} else {
		echo data_json("Oops akses ditolak.");
		}*/
	}

	public function get_order_tmp()
	{
		//note : delivfee packtype 8 belum
		$arr = array(
			'select' => array(
				'isnull(a.Quantity,0) as Quantity',
				'sum(a.Price) + sum(a.DelivFee) as Price',
				'c.PricePack',
				'c.PackName',
				'c.RecID',
				'c.PackType',
				'c.PackCode'
			),
			'from' => 'Logistics_PODetail a',
			'join' => array(
				'Logistics_MasterItem b' => array(
					'on' => 'a.ItemCode=b.ItemCode',
					'type' => 'inner',
				),
				'Logistics_PackageItem c' => array(
					'on' => 'a.PackCode=c.RecID',
					'type' => 'inner',
				),
			),
			'where' => array('a.PR_Number' => $this->input->post('PR')),
			'group_by' => array(
						'a.Quantity',
						'c.PackName',
						'c.PricePack',
						'c.RecID',
						'c.PackType',
						'c.PackCode'
					),
			'order_by' => array('c.PackType' => '','c.RecID' => ''),
		);
		$sql = $this->config_model->find($arr);
		$arr2 = array(
			'select' => array(
				'a.Nominal',
			),
			'from' => 'TPrimaEdu_Prod.dbo.areacabang b',
			'join' => array(
				'FA_Deposit a' => array(
					'on' => 'b.KodeAreaCabang=a.BranchCode',
					'type' => 'left',
				),
			),
			'where' => array('b.KodeAreaCabang' => $this->session->userdata('KodeAreaCabang')),
		);
		$sql2 = $this->config_model->find($arr2);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
			$data['rows2'] = $sql2->result_array();
		} else {
			$data['rows'] = 0;
			$data['rows2'] = $sql2->result_array();
		}
		echo json_encode($data);
	}

	public function delete_order_tmp()
	{
		$RecID = $this->input->post('RecID');
		$ItemCode = $this->input->post('ItemCode');
		$qty = $this->input->post('qty');
		if (isset($RecID) && !empty($RecID)) {
			/*$query = array(
				'from' => 'Logistics_MasterItem',
				'where' => array('ItemCode'=>$RecID),
			);
			$sql = $this->Config_model->find($query)->row_array();*//*
			$this->db->query("UPDATE Logistics_MasterItem set OrderedStock=OrderedStock-(".$qty.") WHERE ItemCode = '".$ItemCode."'");*/
			$arr = array(
				'from' => 'Logistics_PODetail',
				'where' => array('PackCode'=>$RecID,'PR_Number'=>$this->input->post('PR')),
			);
			$msg = $this->config_model->delete($arr);/*
			$this->db->query("UPDATE Logistics_MasterItem set OrderedStock=isnull(stok.SOLD,0)
			from (
			select sum(a.Quantity) as SOLD 
			from Logistics_PODetail a
			join Logistics_POHeader b on a.PR_Number=b.PR_Number
			where b.Status != '10' and b.Status!='9' and b.BranchCode !='9999' 
			AND a.ItemCode = '$ItemCode') stok 
			where Logistics_MasterItem.ItemCode='$ItemCode'");*/
			if ($msg==true) {
				echo data_json(array("message"=>"Item berhasil dihapus.","notify"=>"success"));
			} else {
				echo data_json(array("message"=>"Item gagal dihapus.","notify"=>"warning"));
			}
		}
	}

	public function update_qty_tmp()
	{
		restrict();
    	$token = base64_decode($this->input->post('token'));/*
		if(isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {*/
		$qty = $this->input->post('qty');
		$qtytmp = $this->input->post('qtytmp');
		$rqty = $qty-$qtytmp;/*
		//validasi diluar PR ini
		$cek = array(
			'select' => array(
				'a.ItemCodes',
				'(a.TotalStock-sum(ISNULL(d.Quantity,0))) as stok',
			),
			'from' => 'Logistics_MasterItem a',
			'join' => array(
				'Logistics_PODetail d' => array(
					'on' => 'a.ItemCode = d.ItemCode',
					'type' => 'inner',
				),
				'Logistics_POHeader e' => array(
					'on' => 'd.PR_Number = e.PR_Number',
					'type' => 'inner',
				),
			),
			'where' => "a.ItemCode = '".$this->input->post('ItemCode')."' AND e.Status != 9 AND e.Status != 10 AND e.BranchCode !='9999' AND d.PR_Number != '".$this->input->post('PR')."'",
			'group_by' => array('a.ItemCode','a.TotalStock'),
		);
		$sqlcek = $this->config_model->find($cek);
		$cek2 = array(
			'select' => array(
				'((a.TotalStock-a.OrderedStock)+ISNULL(d.Quantity,0)) as stok',
			),
			'from' => 'Logistics_MasterItem a',
			'join' => array(
				'Logistics_PODetail d' => array(
					'on' => 'a.ItemCode = d.ItemCode',
					'type' => 'left',
				),
			),
			'where' => array('a.ItemCode' => $this->input->post('ItemCode'),'d.PR_Number'=>$this->input->post('PR')),
		);
		$sqlcek2 = $this->config_model->find($cek2);
		if ($sqlcek->num_rows()>0){
		$rsltsqlcek = $sqlcek->row_array();
		$rowsqlcek = $rsltsqlcek['stok'];
		} else {
		$rsltsqlcek2 = $sqlcek2->row_array();
		$rowsqlcek = $rsltsqlcek2['stok'];
		} 
			if($rowsqlcek > 0 AND $rowsqlcek >= $this->input->post('qty')){*/
			$arr = array(
				'params' => array(
					'Quantity' => $this->input->post('qty')
				),
				'from' => 'Logistics_PODetail',
				'where' => array('PackCode'=>$this->input->post('RecID'),'PR_Number'=>$this->input->post('PR')),
			);
			$this->config_model->update($arr);/*
			$IC = $this->input->post('ItemCode');
			$this->db->query("UPDATE Logistics_MasterItem set OrderedStock=stok.SOLD
			from (
			select a.ItemCode, sum(a.Quantity) as SOLD 
			from Logistics_PODetail a
			join Logistics_POHeader b on a.PR_Number=b.PR_Number
			where b.Status != '10' and b.Status!='9' and b.BranchCode !='9999' 
			AND a.ItemCode = '$IC'
			group by a.ItemCode) stok 
			where Logistics_MasterItem.ItemCode=stok.ItemCode");*/
			$this->config_model->manualQuery("UPDATE Logistics_StockItem set Logistics_StockItem.OrderedStock = bc.Qty 
			from
			(select a.ItemCode, sum(a.Quantity) as Qty from Logistics_PODetail a
			join Logistics_POHeader b on a.PR_Number=b.PR_Number
			join Logistics_MasterItem c on a.ItemCode=c.ItemCode
			where b.Status = 2 and b.PR_Date > '2019-07-13' or b.Status = 0 and a.CreatedDate > '2019-07-13' or b.Status = 1 and b.PR_Date > '2019-07-13' or b.Status = 3 and b.PR_Date > '2019-07-13'
			group by a.ItemCode) bc
			where Logistics_StockItem.ItemCode=bc.ItemCode and Logistics_StockItem.Years = 5");
			echo data_json(array("message"=>"Qty berhasil diubah.","notify"=>"success"));
			/*} else {
			echo data_json(array("message"=>"Qty gagal diubah.","notify"=>"warning"));
			}*//*
		} else {
		echo data_json("Oops akses ditolak.");
		}*/
	}

	public function cek_stok_item()
	{
		$arr = array(
			'select' => array(
				'a.ItemCode',
				'(a.TotalStock-sum(ISNULL(d.Quantity,0))) as stok',
			),
			'from' => 'Logistics_StockItem a',
			'join' => array(
				'Logistics_PODetail d' => array(
					'on' => 'a.ItemCode = d.ItemCode',
					'type' => 'inner',
				),
				'Logistics_POHeader e' => array(
					'on' => 'd.PR_Number = e.PR_Number',
					'type' => 'inner',
				),
			),
			'where' => "a.ItemCode = '".$this->input->post('PackCode')."' AND e.Status != 9 AND e.Status != 10 AND a.Years=5 AND d.CreatedDate >= '2019-07-14' AND d.PR_Number != '".$this->input->post('PR')."'",
			'group_by' => array('a.ItemCode','a.TotalStock'),
		);
		$sql = $this->config_model->find($arr);
		$arr2 = array(
			'select' => array(
				'((a.TotalStock-a.OrderedStock)+ISNULL(d.Quantity,0)) as stok',
			),
			'from' => 'Logistics_StockItem a',
			'join' => array(
				'Logistics_PODetail d' => array(
					'on' => 'a.ItemCode = d.ItemCode',
					'type' => 'left',
				),
			),
			'where' => array('a.ItemCode' => $this->input->post('PackCode'),'d.PR_Number'=>$this->input->post('PR'),'a.Years'=>5),
		);
		$sql2 = $this->config_model->find($arr2);
		if ($sql->num_rows()>0) {
			$data['rows'][] = $sql->row_array();
		} else if ($sql->num_rows()<=0 AND $sql2->num_rows()>0) {
			$data['rows'][] = $sql2->row_array();
		} else {
			$data['rows'][] = array('stok'=>0);
		}
		echo json_encode($data);
	}

	public function cek_order_cabang()
	{
		restrict();
		$arr = array(
			'select' => array(
				'a.RecID',
				'b.Invoice_Number',
				'a.PR_Number'
			),
			'from' => 'Logistics_POHeader a',
			'join' => array(
				'Logistics_Invoice b' => array(
					'on' => 'a.PR_Number = b.PR_Number',
					'type' => 'inner',
				),
			),
			'where' => array('a.BranchCode' => $this->session->userdata('KodeAreaCabang'),'a.Status'=>1),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'][] = $sql->row_array();
		} else {
			$data['rows'][] = array('RecID'=>0);
		}
		echo json_encode($data);
	}

	public function get_order_cabang()
	{
		$arr = array(
			'select' => array(
				'a.RecID',
				'a.PR_Number',
				'a.PR_Date',
				'isnull(a.TotalPrice,0) as TotalPrice',
				'isnull(a.Discount,0) as Discount',
				'isnull(b.Nominal,0) as Nominal',
				'b.Invoice_Number as Invoice_Number',
				"CASE a.Status 
				  WHEN 1 THEN 'Menunggu Pembayaran'
				  WHEN 2 THEN 'Menunggu Pengiriman'
				  WHEN 3 THEN 'Dikirim'
				  WHEN 8 THEN 'Pembayaran Gagal'
				  WHEN 9 THEN 'Expired'
				  WHEN 10 THEN 'Cancel'
				END as Status"
			),
			'from' => 'Logistics_POHeader a',
			'join' => array(
				'Logistics_Invoice b' => array(
					'on' => 'a.PR_Number=b.PR_Number',
					'type' => 'left',
				),
			),
			'where' => "a.BranchCode = '".$this->session->userdata('KodeAreaCabang')."' AND a.Status != 0",
			'order_by' => array('a.PR_Date' => 'DESC','a.RecID' => 'DESC'),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function save_pr()
    {
    	$token = base64_decode($this->input->post('token'));
    	$PR = base64_decode($this->input->post('PR'));
	    $Invoice_Number = base64_decode($this->input->post('Invoice_Number'));
	    $PR_Date = date('Y-m-d',strtotime(base64_decode($this->input->post('PR_Date'))));
	    $Invoice_Date = base64_decode($this->input->post('Invoice_Date'));
	    $PriceTotal = base64_decode($this->input->post('PriceTotal'));
	    $Discount = base64_decode($this->input->post('Discount'));
	    $Nominal = base64_decode($this->input->post('Nominal'));
	    $Note = base64_decode($this->input->post('Note'));
		if (isset($token) && !empty($token)) {
    	$data = array(
    		'params' => array(
	    		'TotalPrice' => $PriceTotal,
	    		'Discount' => $Discount,
	    		'Status' => 1,
	    		'PR_Date' => $PR_Date,
	    		'Print_PS' => 0,
	    		'EditDate' => date('Y-m-d H:i:s'),
	    		'EditBy' => $this->session->userdata('Username'),
	    	),
	    	'from' => 'Logistics_POHeader',
			'where' => array('PR_Number'=>$PR),
    	);
    	$this->config_model->update($data);
		$cpr = array(
				'select' => array(
					'count(a.RecID) as Total'
				),
				'from' => 'Logistics_Invoice a',
				'where' => array('a.PR_Number'=>$PR),
			);
		$sqlpr = $this->config_model->find($cpr)->row_array();
		if($sqlpr['Total']<1){
    	$data2 = array(
    		'params' => array(
	    		'Invoice_Number' => $Invoice_Number,
	    		'PR_Number' => $PR,
	    		'Invoice_Date' => $Invoice_Date,
	    		'BranchCode' => $this->session->userdata('KodeAreaCabang'),
	    		'Nominal' => $Nominal,
	    		'Invoice_Status' => 0,
	    		'CreatedDate' => date('Y-m-d H:i:s'),
	    		'CreatedBy' => $this->session->userdata('Username'),
	    	),
	    	'from' => 'Logistics_Invoice',
    	);
    	$this->config_model->insert($data2);
				$data3 = array(
    			'params' => array(
	    			'PR_Number' => $PR,
	    			'Tracking_Name' => 'Menunggu Pembayaran',
	    			'Status' => 1,
	    			'CreatedDate' => date('Y-m-d H:i:s'),
	    			'CreatedBy' => $this->session->userdata('Username')
	    		),
	    		'from' => 'Logistics_Tracking',
    		);
    	$this->config_model->insert($data3);
    	}
    	if($Discount!=0){
		$this->db->query("UPDATE FA_Deposit set Nominal=Nominal-(".$Discount."), EditDate = '".date('Y-m-d H:i:s')."', EditBy = '".$this->session->userdata('Username')."' WHERE BranchCode = '".$this->session->userdata('KodeAreaCabang')."'");
		$this->config_model->insert(array(
			'params' => array(
				'BranchCode' => $this->session->userdata('KodeAreaCabang'),
				'Nominal' => $Discount,
				'Description' => "Order ".$PR."",
		   		'CreatedDate' => date('Y-m-d H:i:s'),
		   		'CreatedBy' => $this->session->userdata('Username'),
		   		'IsInOrOut' => 2,
		   		'Status' => 0
			),
			'from' => 'FA_DepositDetail'
		));
		}
		echo data_json(array("message"=>"Data berhasil disimpan.","notify"=>"success"));
	} else {
		echo data_json("Oops akses ditolak.");
	}
    }

	public function inv()
	{
		restrict();
    	$token = base64_decode($this->input->post('token'));
    	//$Kode = base64_decode($this->input->post('kode'));
    	$group = $this->session->userdata('UserGroup');
    	if($group==11){
    		$bread = '<a href="'.base_url().'Logistics/list_po">Data Pemesanan Buku</a>';
    	} else {
    		$bread = '<a href="'.base_url().'Logistics/list_po_log">Data Pemesanan Buku</a>';
    	}
		if(isset($token) && !empty($token)) {
		$data = array(
			'title' => 'Data Pemesanan Buku',
			'breadcrumb_1' => $bread,
			'INV' => base64_decode($this->input->post('pr'))
		);
		$this->template->load('template', 'Logistics/invoice',$data);	
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function get_order_inv()
	{
		$inv=base64_decode($this->input->post('pr'));
		//delivfeepack belum
		$arr = array(
			'select' => array(
				'g.PackName',
				'g.RecID',
				//'b.ItemName',
				//'b.ItemCode',
				'a.Quantity as Quantity',
				'sum(a.Price+a.DelivFee) as Price',
				'c.PR_Number',
				'c.PR_Date',
				'c.TotalPrice',
				'c.Discount',
				'd.Nominal',
				'd.Invoice_Number',
				'd.Invoice_Date',
				'd.Invoice_Status',
				'SUBSTRING(e.KodeAreaCabang,0,5) as KodeCabang',
				'e.NamaAreaCabang as NamaCabang',
				'e.Email',
				'c.EditDate',
				'c.Status',
				'c.IsTrouble',
				'f.PAYMENTCHANNEL as Channel',
				'f.PAYMENTCODE',
				'g.PricePack',
				'g.PackType'
			),
			'from' => 'Logistics_PODetail a',
			'join' => array(
				'Logistics_MasterItem b' => array(
					'on' => 'a.ItemCode=b.ItemCode',
					'type' => 'inner',
				),
				'Logistics_POHeader c' => array(
					'on' => 'c.PR_Number=a.PR_Number',
					'type' => 'inner',
				),
				'Logistics_Invoice d' => array(
					'on' => 'd.PR_Number=c.PR_Number',
					'type' => 'inner',
				),
				'TPrimaEdu_Prod.dbo.areacabang e' => array(
					'on' => 'c.BranchCode=e.KodeAreaCabang',
					'type' => 'inner',
				),
				'Logistics_Transactions f' => array(
					'on' => 'd.Invoice_Number=f.TRANSIDMERCHANT',
					'type' => 'left',
				),
				'Logistics_PackageItem g' => array(
					'on' => 'a.PackCode=g.RecID',
					'type' => 'left',
				),
			),
			'where' => array('d.PR_Number' => $inv),
			'group_by' => array(
				'g.PackName',
				'g.RecID',
				//'b.ItemName',
				//'b.ItemCode',
				'a.Quantity',
				'c.PR_Number',
				'c.PR_Date',
				'c.TotalPrice',
				'c.Discount',
				'd.Nominal',
				'd.Invoice_Number',
				'd.Invoice_Date',
				'd.Invoice_Status',
				'SUBSTRING(e.KodeAreaCabang,0,5)',
				'e.NamaAreaCabang',
				'e.Email',
				'c.EditDate',
				'c.Status',
				'c.IsTrouble',
				'f.PAYMENTCHANNEL',
				'f.PAYMENTCODE',
				'g.PricePack',
				'g.PackType'
			),
			'order_by' => array('g.RecID' => ''),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
			$data['user'] = $this->session->userdata('UserGroup');
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function packing()
	{
		restrict();
		$arr = array(
				'from' => 'Logistics_TypeItem',
			);
		$item = $this->config_model->find($arr);
		$data = array(
			'title' => 'Cetak Packing Slip',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics/packing">Data Cetak Packing Slip</a>',
			'item' => $item,
		);
		$this->template->load('template', 'Logistics/packing',$data);
	}

	public function get_packing_slip()
	{
		$arr = array(
			'select' => array(
				'a.RecID',
				'a.PR_Number',
				'a.PR_Date',
				'b.KodeAreaCabang',
				'b.NamaAreaCabang',
				'c.NamaAreaCabang as Area',
			),
			'from' => 'Logistics_POHeader a',
			'join' => array(
				'TPrimaEdu_Prod.dbo.areacabang b' => array(
					'on' => 'a.BranchCode=b.KodeAreaCabang',
					'type' => 'inner',
				),
				'TPrimaEdu_Prod.dbo.areacabang c' => array(
					'on' => 'b.Area=c.KodeAreaCabang',
					'type' => 'inner',
				),
			),
			'where' => array('a.Status' => 2, 'a.Print_PS' => 0),
			'order_by' => array('a.PR_Date' => ''),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
			$data['group'] = $this->session->userdata('UserGroup');
		} else {
			$data['rows'] = 0;
			$data['group'] = $this->session->userdata('UserGroup');
		}
		echo json_encode($data);
	}

	public function print_packing()
	{
		restrict();
		$PR = base64_decode($this->input->post('PR'));
    	$token = base64_decode($this->input->post('token'));
    	//$Kode = base64_decode($this->input->post('kode'));
		if(isset($token) && !empty($token)) {
		$data = array(
			'title' => 'Cetak Packing Slip',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics/packing">Data Cetak Packing Slip</a>',
			'breadcrumb_2' => '<a href="#">Packing Slip '.$PR.'</a>',
			'PR' => $PR
		);
		$this->template->load('template', 'Logistics/print_packing',$data);	
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function get_detail_packing()
	{
    	$token = base64_decode($this->input->post('token'));
    	//$Kode = base64_decode($this->input->post('kode'));
		//if(isset($token) && !empty($token)) {
		$pr = base64_decode($this->input->post('PR'));

		$sql = $this->db->query("SELECT *
				from 
				(
				select b.PS_Pack,c.ItemStage,a.Quantity from Logistics_PODetail a
				join Logistics_PackageItem b on a.PackCode=b.RecID
				join Logistics_MasterItem c on a.ItemCode=c.ItemCode
				where a.PR_Number = '$pr' and b.stage=1
				) src
				pivot
				(
				  sum(Quantity)
				  for ItemStage in ([MTKSD],[TEMATIKSD],[SE12MTKSD],[SE1TEMATIKSD],[SE2TEMATIKSD])
				) piv");
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		$sql2 = $this->db->query("SELECT *
				from 
				(
				select b.PS_Pack,c.ItemStage,a.Quantity from Logistics_PODetail a
				join Logistics_PackageItem b on a.PackCode=b.RecID
				join Logistics_MasterItem c on a.ItemCode=c.ItemCode
				where a.PR_Number = '$pr' and b.stage=2 and b.PackType != 6
				) src
				pivot
				(
				  sum(Quantity)
				  for ItemStage in ([MTKSMP],[BINDSMP],[BINGSMP],[IPASMP],[IPSSMP],[SE1SMP],[SE2SMP])
				) piv");
		if ($sql2->num_rows()>0) {
			$data['rowssmp'] = $sql2->result_array();
		} else {
			$data['rowssmp'] = 0;
		}
		$sql3 = $this->db->query("SELECT *
				from 
				(
				select b.PS_Pack,c.ItemStage,a.Quantity from Logistics_PODetail a
				join Logistics_PackageItem b on a.PackCode=b.RecID
				join Logistics_MasterItem c on a.ItemCode=c.ItemCode
				where a.PR_Number = '$pr' and b.stage=3 AND PackName LIKE '%IPA%' and b.PackType != 6
				) src
				pivot
				(
				  sum(Quantity)
				  for ItemStage in ([MTKSMA],[BINDSMA],[BINGSMA],[MTKM],[BIO],[FIS],[KIM],[SE1IPA],[SE2IPA])
				) piv");
		if ($sql3->num_rows()>0) {
			$data['rowsipa'] = $sql3->result_array();
		} else {
			$data['rowsipa'] = 0;
		}
		$sql4 = $this->db->query("SELECT *
				from 
				(
				select b.PS_Pack,c.ItemStage,a.Quantity from Logistics_PODetail a
				join Logistics_PackageItem b on a.PackCode=b.RecID
				join Logistics_MasterItem c on a.ItemCode=c.ItemCode
				where a.PR_Number = '$pr' and b.stage=3 AND PackName LIKE '%IPS%' and b.PackType != 6
				) src
				pivot
				(
				  sum(Quantity)
				  for ItemStage in ([MTKSMA],[BINDSMA],[BINGSMA],[EKO],[GEO],[SOS],[SEJ],[SE1IPS],[SE2IPS])
				) piv");
		if ($sql4->num_rows()>0) {
			$data['rowsips'] = $sql4->result_array();
		} else {
			$data['rowsips'] = 0;
		}	
		$sql5 = $this->db->query("SELECT c.PS_Name,a.Quantity from Logistics_PODetail a
				join Logistics_PackageItem b on a.PackCode=b.RecID
				join Logistics_MasterItem c on a.ItemCode=c.ItemCode
				where a.PR_Number = '$pr' AND PackName LIKE '%2006%'
				order by c.PageId");
		if ($sql5->num_rows()>0) {
			$data['rows2006'] = $sql5->result_array();
		} else {
			$data['rows2006'] = 0;
		}		
		$sql6 = $this->db->query("SELECT c.PS_Name,a.Quantity from Logistics_PODetail a
				join Logistics_PackageItem b on a.PackCode=b.RecID
				join Logistics_MasterItem c on a.ItemCode=c.ItemCode
				where a.PR_Number = '$pr' AND PackName LIKE '%Nasional%'
				order by c.PageId");
		if ($sql6->num_rows()>0) {
			$data['rowsnas'] = $sql6->result_array();
		} else {
			$data['rowsnas'] = 0;
		}			
		$sql7 = $this->db->query("SELECT c.PS_Name,a.Quantity from Logistics_PODetail a
				join Logistics_PackageItem b on a.PackCode=b.RecID
				join Logistics_MasterItem c on a.ItemCode=c.ItemCode
				where a.PR_Number = '$pr' AND b.PackType = '5' OR a.PR_Number = '$pr' AND b.PackType = '7'
				order by c.PageId");
		if ($sql7->num_rows()>0) {
			$data['rowsinten'] = $sql7->result_array();
		} else {
			$data['rowsinten'] = 0;
		}	
		$sql8 = $this->db->query("SELECT *
				from 
				(
				select b.RecID,b.PS_Pack,SUBSTRING(c.ItemStage,1,3) as ItemStage,a.Quantity from Logistics_PODetail a
				join Logistics_PackageItem b on a.PackCode=b.RecID
				join Logistics_MasterItem c on a.ItemCode=c.ItemCode
				where a.PR_Number = '$pr' and b.PackType = 6
				) src
				pivot
				(
				  sum(Quantity)
				  for ItemStage in (SE1,SE2)
				) piv
				order by RecID");
		if ($sql8->num_rows()>0) {
			$data['rowsse'] = $sql8->result_array();
		} else {
			$data['rowsse'] = 0;
		}				
		$sql9 = $this->db->query("SELECT SUBSTRING(b.PackCode,4,14) as PackCode, LEFT(c.ItemCode, LEN(c.ItemCode) - 3) as ItemCode,a.Quantity from Logistics_PODetail a
				join Logistics_PackageItem b on a.PackCode=b.RecID
				join Logistics_MasterItem c on a.ItemCode=c.ItemCode
				where a.PR_Number = '$pr' AND b.PackType = '8' AND b.PackCode like '%MB%'
				order by b.RecID,c.RecID");
		if ($sql9->num_rows()>0) {
			$data['rowsmbmapel'] = $sql9->result_array();
		} else {
			$data['rowsmbmapel'] = 0;
		}				
		$sql10 = $this->db->query("SELECT SUBSTRING(b.PackCode,4,14) as PackCode, LEFT(c.ItemCode, LEN(c.ItemCode) - 3) as ItemCode,a.Quantity from Logistics_PODetail a
				join Logistics_PackageItem b on a.PackCode=b.RecID
				join Logistics_MasterItem c on a.ItemCode=c.ItemCode
				where a.PR_Number = '$pr' AND b.PackType = '8' AND b.PackCode like '%SE %'
				order by b.RecID,c.RecID");
		if ($sql10->num_rows()>0) {
			$data['rowssemapel'] = $sql10->result_array();
		} else {
			$data['rowssemapel'] = 0;
		}	
		$arr = array(
			'select' => array(
				'a.PR_Number',
				'a.Print_PS',
				'e.KodeAreaCabang',
				'e.NamaAreaCabang',
				'f.NamaAreaCabang as Area',
				'e.Alamat as alamat',
				'e.NoTelp as notelp',
				'e.NoHandPhone as nohp',
				'e.KodePos',
				'g.NamaKotaKab as Kota',
				'h.NamaPropinsi as Propinsi',
				'e.NamaManager'
			),
			'from' => 'Logistics_POHeader a',
			'join' => array(
				'TPrimaEdu_Prod.dbo.areacabang e' => array(
					'on' => 'a.BranchCode=e.KodeAreaCabang',
					'type' => 'inner',
				),
				'TPrimaEdu_Prod.dbo.areacabang f' => array(
					'on' => 'e.Area=f.KodeAreaCabang',
					'type' => 'inner',
				),
				'TPrimaEdu_Prod.dbo.kotakab g' => array(
					'on' => 'e.Kota=g.RecID',
					'type' => 'inner',
				),
				'TPrimaEdu_Prod.dbo.Propinsi h' => array(
					'on' => 'g.Propinsi=h.RecID',
					'type' => 'inner',
				),
			),
			'where' => array('a.PR_Number' => $pr)
		);
		$sqlinfo = $this->config_model->find($arr);
		if ($sqlinfo->num_rows()>0) {
			$data['rowsinfo'] = $sqlinfo->result_array();
		} else {
			$data['rowsinfo'] = 0;
		}
		echo json_encode($data);	
		/*} else {
		echo data_json("Oops akses ditolak.");
		}*/
	}

	public function update_print()
	{
    	$token = base64_decode($this->input->post('token'));
    	//$Kode = base64_decode($this->input->post('kode'));
		if(isset($token) && !empty($token)) {
		$pr = base64_decode($this->input->post('PR'));
		$print = base64_decode($this->input->post('print_ps'));
		$arr = array(
			'params' => array(
				'Print_PS' => $print
			),
			'from' => 'Logistics_POHeader',
			'where' => array('PR_Number'=>$pr),
		);
		$msg = $this->config_model->update($arr);
		if($print<=1){
			$TrackingName = 'Packing Oleh Logistik';
		} else {
			$TrackingName = 'Packing Susulan Oleh Logistik';
		}
		$data3 = array(
    		'params' => array(
	    		'PR_Number' => $pr,
	    		'Tracking_Name' => $TrackingName,
	    		'Status' => 1,
	    		'CreatedDate' => date('Y-m-d H:i:s'),
	    		'CreatedBy' => $this->session->userdata('Username')
	    	),
	    	'from' => 'Logistics_Tracking',
    	);
    	$this->config_model->insert($data3);
			if ($msg==true) {
				echo data_json(array("message"=>"Packing Slip Berhasil dicetak.","notify"=>"success"));
			} else {
				echo data_json(array("message"=>"Qty gagal diubah.","notify"=>"warning"));
			}
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function list_do()
	{
		restrict();
		$arr = array(
				'from' => 'Logistics_TypeItem',
			);
		$item = $this->config_model->find($arr);
		$data = array(
			'title' => 'Input Barang yang akan di Kirim',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics/list_do">Input Barang yang akan di Kirim</a>',
			'item' => $item,
		);
		$this->template->load('template', 'Logistics/list_do',$data);
	}

	public function get_list_do()
	{
		$arr = array(
			'select' => array(
				'a.RecID',
				'a.PR_Number',
				'a.PR_Date',
				'b.KodeAreaCabang',
				'b.NamaAreaCabang',
				'c.NamaAreaCabang as Area'
			),
			'from' => 'Logistics_POHeader a',
			'join' => array(
				'TPrimaEdu_Prod.dbo.areacabang b' => array(
					'on' => 'a.BranchCode=b.KodeAreaCabang',
					'type' => 'inner',
				),
				'TPrimaEdu_Prod.dbo.areacabang c' => array(
					'on' => 'b.Area=c.KodeAreaCabang',
					'type' => 'inner',
				),
				'dbo.Logistics_DOHeader d' => array(
					'on' => 'a.PR_Number=d.PR_Number',
					'type' => 'left',
				),
			),
			'where' => array('a.Status' => 2, 'a.Print_PS >' => 0, 'd.Status' => null, 'd.IsLess' => null),
			'group_by' => array(
				'a.RecID',
				'a.PR_Number',
				'a.PR_Date',
				'b.KodeAreaCabang',
				'b.NamaAreaCabang',
				'c.NamaAreaCabang'
			),
			'order_by' => array('a.PR_Date' => ''),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
			$data['group'] = $this->session->userdata('UserGroup');
		} else {
			$data['rows'] = 0;
			$data['group'] = $this->session->userdata('UserGroup');
		}
		echo json_encode($data);
	}

	public function list_po_log()
	{
		restrict();
		$arr = array(
				'from' => 'Logistics_TypeItem',
			);
		$item = $this->config_model->find($arr);
		$this->config_model->manualQuery("UPDATE Logistics_POHeader set Status=0
			from Logistics_POHeader a
			left join Logistics_Invoice b on a.PR_Number=b.PR_Number
			where b.RecID is null and a.Status != 0");
		$data = array(
			'title' => 'Data Pemesanan Buku',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics/list_po_log">Data Pemesanan Buku</a>',
			'item' => $item,
		);
		$this->template->load('template', 'Logistics/list_po_log',$data);
	}

	public function get_order_cabang_log()
	{
		$ta = $this->input->post('TA');
		$Status = $this->input->post('Status');
		if($ta!=5 && $Status == ''){
			$where = "a.Status != 0 AND a.Status !=9 AND a.Status !=10 AND a.Status !=8 AND a.PR_Date < '2019-07-14'";
		} else if($ta==5 && $Status == ''){
			$where = "a.Status != 0 AND a.Status !=9 AND a.Status !=10 AND a.Status !=8 AND a.PR_Date >= '2019-07-14'";	
		} else if($ta==5 && $Status != ''){
			$where = "a.Status = '$Status' AND a.PR_Date >= '2019-07-14'";	
		} else if($ta==4 && $Status != ''){
			$where = "a.Status = '$Status' AND a.PR_Date < '2019-07-14'";	
		}
		$arr = array(
			'select' => array(
				'a.RecID',
				'a.PR_Number',
				'a.PR_Date',
				'd.NamaAreaCabang',
				'isnull(a.TotalPrice,0) as TotalPrice',
				'isnull(a.Discount,0) as Discount',
				'isnull(b.Nominal,0) as Nominal',
				'b.Invoice_Number as Invoice_Number',
				'c.PAYMENTDATETIME as TRX_Date',
				"CASE a.Status 
				  WHEN 1 THEN 'Menunggu Pembayaran'
				  WHEN 2 THEN 'Menunggu Pengiriman'
				  WHEN 3 THEN 'Dikirim'
				  WHEN 8 THEN 'Pembayaran Gagal'
				  WHEN 9 THEN 'Expired'
				  WHEN 10 THEN 'Cancel'
				END as Status",
				"CASE c.PAYMENTCHANNEL
					WHEN 0 THEN 'VA BCA OFFLINE'
					WHEN 36 THEN 'VA PERMATA'
					WHEN 29 THEN 'VA BCA ONLINE'
					WHEN 32 THEN 'VA CIMB'
					WHEN 33 THEN 'VA DANAMON'
				END as Payment"
			),
			'from' => 'Logistics_POHeader a',
			'join' => array(
				'Logistics_Invoice b' => array(
					'on' => 'a.PR_Number=b.PR_Number',
					'type' => 'left',
				),
				'Logistics_Transactions c' => array(
					'on' => 'b.Invoice_Number=c.TRANSIDMERCHANT',
					'type' => 'left',
				),
				'TPrimaEdu_Prod.dbo.areacabang d' => array(
					'on' => 'a.BranchCode=d.KodeAreaCabang',
					'type' => 'inner',
				),
			),
			'where' => $where,
			'order_by' => array('a.PR_Date' => 'DESC','a.RecID' => 'DESC'),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['data'] = $sql->result_array();
		} else {
			$data['data'] = 0;
		}
		echo json_encode($data);
	}

	public function input_do()
	{
		restrict();
    	$token = base64_decode($this->input->post('token'));
		if(isset($token) && !empty($token)) {
		$pr = base64_decode($this->input->post('PR'));
		$do = $this->config_model->get_do();
		$arr2 = array(
				'from' => 'Logistics_DOHeader a',
				'where' => array('a.PR_Number' => $pr,'a.Status' => null),
			);
		$item2 = $this->config_model->find($arr2);
		$data=$item2->result_array();
		//echo json_encode($data);
		if ($item2->num_rows()==0) {
		$this->db->query("INSERT INTO Logistics_DOHeader (DO_Number,PR_Number)
							SELECT '$do',PR_Number FROM Logistics_POHeader where PR_Number = '$pr'");
		$this->db->query("INSERT INTO Logistics_DODetail (DO_Number,PO_Detail,ItemCode,QtySB)
							SELECT '$do',Logistics_PODetail.RecID,Logistics_PODetail.ItemCode,0 FROM Logistics_PODetail 
							JOIN Logistics_POHeader on Logistics_PODetail.PR_Number=Logistics_POHeader.PR_Number
							where Logistics_POHeader.PR_Number = '$pr'");
		}
		$data = array(
			'title' => 'Input Detail Pengiriman',
			'breadcrumb_1' => '<a href="#">Input Detail Pengiriman</a>',
			'pr' => $pr,
			'dr' => $do,
		);
		$this->template->load('template', 'Logistics/input_do',$data);
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function get_detail_do()
	{
		restrict();
    	$token = base64_decode($this->input->post('token'));/*
		if(isset($token) && !empty($token)) {*/
		$pr = base64_decode($this->input->post('PR'));
		$arr = array(
				'select' => array(
					'DENSE_RANK() OVER(ORDER BY e.Number) RowNum',
					'a.RecID',
					'e.PackName',
					'a.DO_Number',
					'b.PR_Number',
					'a.ItemCode',
					'c.ItemName',
					'c.TypeId',
					'isnull(b.Quantity,0) as Quantity',
					'isnull(a.QtySB,0) as QtySB',
				),
				'from' => 'Logistics_DODetail a',
				'join' => array(
					'Logistics_PODetail b' => array(
						'on' => 'a.PO_Detail=b.RecID',
						'type' => 'inner',
					),
					'Logistics_MasterItem c' => array(
						'on' => 'c.ItemCode=b.ItemCode',
						'type' => 'inner',
					),
					'Logistics_DOHeader d' => array(
						'on' => 'a.DO_Number=d.DO_Number',
						'type' => 'inner',
					),
					'Logistics_PackageItem e' => array(
						'on' => 'b.PackCode=e.RecID',
						'type' => 'inner',
					),
				),
				'where' => array('b.PR_Number' => $pr),
				'order_by' => array('e.Number' => '','e.PackType'=>'','e.Pack' => '','e.RecID' => '', 'c.RecID' => ''),
			);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
		/*} else {
		echo data_json("Oops akses ditolak.");
		}*/	
	}

	public function update_qty_input_do()
	{
		$Kode = $this->input->post('Kode');
		$Qty = $this->input->post('Qty');
		/*if($Kode==1){*/
		$arr = array(
			'params' => array(
				'QtySB' => $Qty,
	    		'CreatedDate' => date('Y-m-d H:i:s'),
	    		'CreatedBy' => $this->session->userdata('Username'),
			),
			'from' => 'Logistics_DODetail',
			'where' => array('RecID'=>$this->input->post('RecID')),
		);/*
		} else if($Kode==2){
		$arr = array(
			'params' => array(
				'QtySE1' => $Qty,
	    		'CreatedDate' => date('Y-m-d H:i:s'),
	    		'CreatedBy' => $this->session->userdata('Username'),
			),
			'from' => 'Logistics_DODetail',
			'where' => array('RecID'=>$this->input->post('RecID')),
		);	
		} else if($Kode==3){
		$arr = array(
			'params' => array(
				'QtySE2' => $Qty,
	    		'CreatedDate' => date('Y-m-d H:i:s'),
	    		'CreatedBy' => $this->session->userdata('Username'),
			),
			'from' => 'Logistics_DODetail',
			'where' => array('RecID'=>$this->input->post('RecID')),
		);	
		} else if($Kode==4){
		$arr = array(
			'params' => array(
				'QtySUP' => $Qty,
	    		'CreatedDate' => date('Y-m-d H:i:s'),
	    		'CreatedBy' => $this->session->userdata('Username'),
			),
			'from' => 'Logistics_DODetail',
			'where' => array('RecID'=>$this->input->post('RecID')),
		);	
		}*/
		$msg = $this->config_model->update($arr);
			if ($msg==true) {
				echo data_json(array("message"=>"Qty berhasil diinput.","notify"=>"success"));
			} else {
				echo data_json(array("message"=>"Qty gagal diinput.","notify"=>"warning"));
			}
	}

	public function save_do()
	{
		restrict();
    	$token = base64_decode($this->input->post('token'));
		if(isset($token) && !empty($token)) {
		$DO = base64_decode($this->input->post('DO'));
		$pr = base64_decode($this->input->post('pr'));
		$arr = array(
			'params' => array(
				'Status' => 0,
	    		'CreatedDate' => date('Y-m-d H:i:s'),
	    		'CreatedBy' => $this->session->userdata('Username'),
			),
			'from' => 'Logistics_DOHeader',
			'where' => array('DO_Number'=>$DO),
		);
		$msg = $this->config_model->update($arr);
		$arr2 = array(
			'params' => array(
				'Status' => 3,
	    		'EditDate' => date('Y-m-d H:i:s'),
	    		'EditBy' => $this->session->userdata('Username'),
			),
			'from' => 'Logistics_POHeader',
			'where' => array('PR_Number'=>$pr),
		);
		$msg2 = $this->config_model->update($arr2);
		$TrackingName = "Pengiriman - $DO";
		$ctr = array(
			'select' => array(
				'count(a.RecID) as Total'
			),
			'from' => 'Logistics_Tracking a',
			'where' => array('a.PR_Number'=>$pr, 'Tracking_Name'=>$TrackingName),
		);
		$sqltr = $this->config_model->find($ctr)->row_array();
		if($sqltr['Total']<1){
		$data3 = array(
    		'params' => array(
	    		'PR_Number' => $pr,
	    		'Tracking_Name' => $TrackingName,
	    		'DO_Number' => $DO,
	    		'Status' => 1,
	    		'CreatedDate' => date('Y-m-d H:i:s'),
	    		'CreatedBy' => $this->session->userdata('Username')
	    	),
	    	'from' => 'Logistics_Tracking',
    	);
    	$this->config_model->insert($data3);
    	}
			if ($msg==true) {
				echo data_json(array("message"=>"Data berhasil disimpan.","notify"=>"success"));
			} else {
				echo data_json(array("message"=>"Data gagal disimpan.","notify"=>"warning"));
			}
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function save_dodetail()
	{
		$RecID = $this->input->post('RecID');
		$Qty = $this->input->post('Qty');
		$ItemName = $this->input->post('ItemName');
		$arr2 = array(
			'params' => array(
				'QtySB' => $Qty,
	    		'CreatedDate' => date('Y-m-d H:i:s'),
	    		'CreatedBy' => $this->session->userdata('Username'),
			),
			'from' => 'Logistics_DODetail',
			'where' => array('RecID'=>$RecID),
		);
		$msg2 = $this->config_model->update($arr2);
		if ($msg2==true) {
			echo data_json(array("message"=>"$ItemName Berhasil disimpan.","notify"=>"success"));
		} else {
			echo data_json(array("message"=>"$ItemName gagal disimpan.","notify"=>"warning"));
		}
	}

	public function list_do_exp()
	{
		restrict();
		$arr = array(
				'from' => 'Logistics_Expedisi',
				'where' => array('Status' => 1),
			);
		$item = $this->config_model->find($arr);
		$data = array(
			'title' => 'Data Input Detail Expedisi',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics/list_do_exp">Data Input Detail Expedisi</a>',
			'item' => $item,
		);
		$this->template->load('template', 'Logistics/list_do_exp',$data);
	}

	public function get_list_do_exp()
	{
		$arr = array(
			'select' => array(
				'd.RecID',
				'd.DO_Number',
				'a.PR_Number',
				'a.PR_Date',
				'b.KodeAreaCabang',
				'b.NamaAreaCabang',
				'c.NamaAreaCabang as Area',
			),
			'from' => 'Logistics_POHeader a',
			'join' => array(
				'TPrimaEdu_Prod.dbo.areacabang b' => array(
					'on' => 'a.BranchCode=b.KodeAreaCabang',
					'type' => 'inner',
				),
				'TPrimaEdu_Prod.dbo.areacabang c' => array(
					'on' => 'b.Area=c.KodeAreaCabang',
					'type' => 'inner',
				),
				'dbo.Logistics_DOHeader d' => array(
					'on' => 'a.PR_Number=d.PR_Number',
					'type' => 'left',
				),
			),
			'where' => array('a.Print_PS >' => 0, 'd.DO_Number !=' => null, 'd.Status' => 0),
			'order_by' => array('a.PR_Date' => DESC,'a.PR_Number'=> '', 'd.DO_Number' => ''), 
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}


	public function Input_do_exp($RecID)
	{
		$arr = array(
				'from' => 'Logistics_DOHeader a',
				'where' => array('a.RecID' => $RecID)
			);
		$data = $this->config_model->find($arr)->row();
		echo json_encode($data);
	}

	public function save_input_exp()
	{
		$data = array(
	    	'params' => array(
		    	'Expedisi' => $this->input->post('Expedisi'),
		    	'CP' => $this->input->post('CP'),
		    	'NoResi' => $this->input->post('Resi'),
		    	'DO_Date' => date('Y-m-d',strtotime($this->input->post('Deliv_Date'))),
		    	'Estimate_Date' => date('Y-m-d',strtotime($this->input->post('Est_Date'))),
		    	'Koli' => $this->input->post('Koli'),
		    	'Status' => 1,
				'EditDate' => date("Y-m-d H:i:s"),
				'EditBy' => $this->session->userdata('Username')
		    ),
		    'from' => 'Logistics_DOHeader',
			'where' => array('RecID' => $this->input->post('RecID'))
	    );
	    $msg = $this->config_model->update($data);
			echo data_json(array("message"=>"Data berhasil disimpan.","notify"=>"success"));
	}


	public function list_do_less()
	{
		restrict();
		$data = array(
			'title' => 'Data Order Kurang Kirim',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics/list_do_less">Data Order Kurang Kirim</a>',
			'item' => $item,
		);
		$this->template->load('template', 'Logistics/list_do_less',$data);
	}

	public function get_list_do_less()
	{
		$ItemCode = $this->input->post('ItemCode');
		if($ItemCode=='-'){
			$where = "c.Status is not null and p.PR_Date > '2019-06-15'";
		} else {
			$where = "c.Status is not null and p.PR_Date > '2019-06-15' and a.ItemCode = '$ItemCode'";
		}
		$arr = array(
				'select' => array(
					'Det.PR_Number',
					'Det.BranchCode',
					'Det.PR_Date',
					'd.KodeAreaCabang',
					'd.NamaAreaCabang',
					'e.NamaAreaCabang as Area'
				),
				'from' => "(SELECT b.PR_Number,p.PR_Date,p.BranchCode, a.ItemCode, b.Quantity, d.TypeId, 
							a.PO_Detail, 
							((Quantity)-(sum(isnull(a.QtySB,0)))) as SisaSB
							 FROM Logistics_DODetail a 
							INNER JOIN Logistics_PODetail b ON a.PO_Detail=b.RecID 
							INNER JOIN Logistics_POHeader p ON b.PR_Number=p.PR_Number 
							INNER JOIN Logistics_DOHeader c ON a.DO_Number=c.DO_Number 
							INNER JOIN Logistics_MasterItem d ON b.ItemCode=d.ItemCode 
							where $where
							GROUP BY b.PR_Number,a.ItemCode,b.Quantity,d.TypeId,a.PO_Detail,p.PR_Date,p.BranchCode
							HAVING ((Quantity)-(sum(isnull(a.QtySB,0)))) !=0
						) as Det",
				'join' => array(
					'TPrimaEdu_Prod.dbo.areacabang d' => array(
						'on' => 'Det.BranchCode=d.KodeAreaCabang',
						'type' => 'inner',
					),
					'TPrimaEdu_Prod.dbo.areacabang e' => array(
						'on' => 'd.Area=e.KodeAreaCabang',
						'type' => 'inner',
					),
				),
				'group_by' => array('Det.PR_Number',
									'Det.BranchCode',
									'Det.PR_Date',
									'd.KodeAreaCabang',
									'd.NamaAreaCabang',
									'e.NamaAreaCabang'),
				'order_by' => array('Det.PR_Date' => ''),
			);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function input_do_less()
	{
		restrict();
    	$token = base64_decode($this->input->post('token'));
		if(isset($token) && !empty($token)) {
		$pr = base64_decode($this->input->post('PR'));
		$do = $this->config_model->get_do();
		$arr2 = array(
				'from' => 'Logistics_DOHeader a',
				'where' => array('a.PR_Number' => $pr,'a.Status' => null),
			);
		$item2 = $this->config_model->find($arr2);
		$data=$item2->result_array();
		//echo json_encode($data);
		if ($item2->num_rows()==0) {
		$this->db->query("INSERT INTO Logistics_DOHeader (DO_Number,PR_Number,IsLess,Bag,Sticker,StickerS)
							SELECT '$do',PR_Number,1,0,0,0 FROM Logistics_POHeader where PR_Number = '$pr'");
		$this->db->query("INSERT INTO Logistics_DODetail (DO_Number,PO_Detail,ItemCode,QtySB,QtySE1,QtySE2,QtySUP)
							SELECT '$do',Logistics_PODetail.RecID,Logistics_PODetail.ItemCode,0,0,0,0 FROM Logistics_PODetail 
							JOIN Logistics_POHeader on Logistics_PODetail.PR_Number=Logistics_POHeader.PR_Number
							where Logistics_POHeader.PR_Number = '$pr'");
		}
		$data = array(
			'title' => 'Input Detail Pengiriman',
			'breadcrumb_1' => '<a href="#">Input Detail Pengiriman</a>',
			'pr' => $pr,
			'dr' => $do,
		);
		$this->template->load('template', 'Logistics/input_do_less',$data);
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function get_detail_do_less()
	{
		restrict();/*
    	$token = base64_decode($this->input->post('token'));
		if(isset($token) && !empty($token)) {*/
		$pr = base64_decode($this->input->post('PR'));
		$arr = array(
				'select' => array(
					'DENSE_RANK() OVER(ORDER BY f.RecID) RowNum',
					'b.PR_Number',
					'a.ItemCode', 
					'b.Quantity', 
					'd.TypeId',
					'a.PO_Detail',
					'((Quantity)-(sum(isnull(a.QtySB,0)))) as SisaSB',
					'e.QtySB as SB',
					'e.RecID',
					'f.PackName',
					'f.RecID as PackId',
					'd.ItemName',
					'f.Pack',
					'd.RecID as ID',
					'f.Number'
				),
				'from' => 'Logistics_DODetail a',
				'join' => array(
					'Logistics_PODetail b' => array(
						'on' => 'a.PO_Detail=b.RecID',
						'type' => 'inner',
					),
					'Logistics_DOHeader c' => array(
						'on' => 'a.DO_Number=c.DO_Number',
						'type' => 'inner',
					),
					'Logistics_MasterItem d' => array(
						'on' => 'b.ItemCode=d.ItemCode',
						'type' => 'inner',
					),
					"(SELECT Logistics_DODetail.RecID,PO_Detail,QtySB FROM Logistics_DODetail join Logistics_DOHeader on Logistics_DODetail.DO_Number=Logistics_DOHeader.DO_Number where Logistics_DOHeader.Status is null AND Logistics_DOHeader.PR_Number='$pr') e" => array(
						'on' => 'a.PO_Detail=e.PO_Detail',
						'type' => 'inner',
					),
					'Logistics_PackageItem f' => array(
						'on' => 'b.PackCode=f.RecID',
						'type' => 'inner',
					),
				),
				'where' => "b.PR_Number = '$pr' AND c.Status is not null",
				'group_by' => array('b.PR_Number', 'a.ItemCode', 'b.Quantity','d.TypeId','a.PO_Detail','e.QtySB','e.RecID','f.PackName','f.RecID','d.ItemName','f.Pack','d.RecID','f.Number'),
				'order_by' => array('f.Number' =>'' ,'f.Pack' => '','f.RecID' => '','d.RecID' => ''),
				'having' => "((Quantity)-(sum(isnull(a.QtySB,0)))) !=0"
			);

		$arr2 = array(
				'select' => array(
					'a.PR_Number',
					'a.DO_Number' 
				),
				'from' => 'Logistics_DOHeader a',
				'where' => "a.PR_Number = '$pr' AND a.Status is null"
			);
		$sql = $this->config_model->find($arr);
		$sql2 = $this->config_model->find($arr2);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
			$data['rows2'] = $sql2->result_array();
		} else {
			$data['rows'] = 0;
			$data['rows2'] = $sql2->result_array();
		}
		echo json_encode($data);/*
		} else {
		echo data_json("Oops akses ditolak.");
		}*/
	}

	public function print_packing_less()
	{
		restrict();
		$PR = base64_decode($this->input->post('PR'));
    	$token = base64_decode($this->input->post('token'));
    	//$Kode = base64_decode($this->input->post('kode'));
		if(isset($token) && !empty($token)) {
		$data = array(
			'title' => 'Cetak Packing Slip',
			'breadcrumb_1' => '<a href="#">Data Cetak Packing Slip</a>',
			'breadcrumb_2' => '<a href="#">Packing Slip '.$PR.'</a>',
			'PR' => $PR
		);
		$this->template->load('template', 'Logistics/print_packing_less',$data);	
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function get_detail_packing_less()
	{
    	$token = base64_decode($this->input->post('token'));
    	//$Kode = base64_decode($this->input->post('kode'));
		/*if(isset($token) && !empty($token)) {*/
		$pr = base64_decode($this->input->post('PR'));

		$sql = $this->db->query("SELECT 
					PS_Pack,
					Quantity-isnull([MTKSD],0) as MTKSD,
					Quantity-isnull([TEMATIKSD],0) as TEMATIKSD,
					Quantity-isnull([SE12MTKSD],0) as SE12MTKSD,
					Quantity-isnull([SE1TEMATIKSD],0) as SE1TEMATIKSD,
					Quantity-isnull([SE2TEMATIKSD],0) as SE2TEMATIKSD
				from 
				(
				select b.PS_Pack,c.ItemStage,d.Quantity, sum(a.QtySB) as QtySB from Logistics_DODetail a
				join Logistics_PODetail d on a.PO_Detail=d.RecID
				join Logistics_DOHeader e on a.DO_Number=e.DO_Number
				join Logistics_PackageItem b on d.PackCode=b.RecID
				join Logistics_MasterItem c on d.ItemCode=c.ItemCode
				where e.PR_Number = '$pr' and b.stage=1 and e.Status is not null
				group by b.PS_Pack,c.ItemStage,d.Quantity,a.QtySB
				) src
				pivot
				(
				  sum(QtySB)
				  for ItemStage in ([MTKSD],[TEMATIKSD],[SE12MTKSD],[SE1TEMATIKSD],[SE2TEMATIKSD])
				) piv
				where 
					Quantity-isnull([MTKSD],0) !=0 or
					Quantity-isnull([TEMATIKSD],0) !=0 or
					Quantity-isnull([SE12MTKSD],0) !=0 or 
					Quantity-isnull([SE1TEMATIKSD],0) !=0 or
					Quantity-isnull([SE2TEMATIKSD],0)  !=0
				ORDER by PS_Pack");
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		$sql2 = $this->db->query("SELECT 
					PS_Pack,
					Quantity-isnull([MTKSMP],0) as MTKSMP,
					Quantity-isnull([BINDSMP],0) as BINDSMP,
					Quantity-isnull([BINGSMP],0) as BINGSMP,
					Quantity-isnull([IPASMP],0) as IPASMP,
					Quantity-isnull([IPSSMP],0) as IPSSMP,
					Quantity-isnull([SE1SMP],0) as SE1SMP,
					Quantity-isnull([SE2SMP],0) as SE2SMP
				from 
				(
				select b.PS_Pack,c.ItemStage,d.Quantity, sum(a.QtySB) as QtySB from Logistics_DODetail a
				join Logistics_PODetail d on a.PO_Detail=d.RecID
				join Logistics_DOHeader e on a.DO_Number=e.DO_Number
				join Logistics_PackageItem b on d.PackCode=b.RecID
				join Logistics_MasterItem c on d.ItemCode=c.ItemCode
				where e.PR_Number = '$pr' and b.stage=2 and e.Status is not null
				group by b.PS_Pack,c.ItemStage,d.Quantity,a.QtySB
				) src
				pivot
				(
				  sum(QtySB)
				  for ItemStage in ([MTKSMP],[BINDSMP],[BINGSMP],[IPASMP],[IPSSMP],[SE1SMP],[SE2SMP])
				) piv
				where
					Quantity-isnull([MTKSMP],0) !=0 OR
					Quantity-isnull([BINDSMP],0) !=0 OR
					Quantity-isnull([BINGSMP],0) !=0 OR
					Quantity-isnull([IPASMP],0) !=0 OR
					Quantity-isnull([IPSSMP],0) !=0 OR
					Quantity-isnull([SE1SMP],0) !=0 OR
					Quantity-isnull([SE2SMP],0) !=0
				ORDER by PS_Pack");
		if ($sql2->num_rows()>0) {
			$data['rowssmp'] = $sql2->result_array();
		} else {
			$data['rowssmp'] = 0;
		}
		$sql3 = $this->db->query("SELECT 
					PS_Pack,
					Quantity-isnull([MTKSMA],0) as MTKSMA,
					Quantity-isnull([BINDSMA],0) as BINDSMA,
					Quantity-isnull([BINGSMA],0) as BINGSMA,
					Quantity-isnull([MTKM],0) as MTKM,
					Quantity-isnull([BIO],0) as BIO,
					Quantity-isnull([FIS],0) as FIS,
					Quantity-isnull([KIM],0) as KIM,
					Quantity-isnull([SE1IPA],0) as SE1IPA,
					Quantity-isnull([SE2IPA],0) as SE2IPA
				from 
				(
				select b.PS_Pack,c.ItemStage,d.Quantity,sum(a.QtySB) as QtySB from Logistics_DODetail a
				join Logistics_PODetail d on a.PO_Detail=d.RecID
				join Logistics_DOHeader e on a.DO_Number=e.DO_Number
				join Logistics_PackageItem b on d.PackCode=b.RecID
				join Logistics_MasterItem c on d.ItemCode=c.ItemCode
				where e.PR_Number = '$pr' and b.stage=3 and e.Status is not null AND PackName LIKE '%IPA%'
				group by b.PS_Pack,c.ItemStage,d.Quantity,a.QtySB
				) src
				pivot
				(
				  sum(QtySB)
				  for ItemStage in ([MTKSMA],[BINDSMA],[BINGSMA],[MTKM],[BIO],[FIS],[KIM],[SE1IPA],[SE2IPA])
				) piv
				where
					Quantity-isnull([MTKSMA],0) !=0 OR
					Quantity-isnull([BINDSMA],0) !=0 OR
					Quantity-isnull([BINGSMA],0) !=0 OR
					Quantity-isnull([MTKM],0) !=0 OR
					Quantity-isnull([BIO],0) !=0 OR
					Quantity-isnull([FIS],0) !=0 OR
					Quantity-isnull([KIM],0) !=0 OR
					Quantity-isnull([SE1IPA],0) !=0 OR
					Quantity-isnull([SE2IPA],0) !=0
				ORDER by PS_Pack");
		if ($sql3->num_rows()>0) {
			$data['rowsipa'] = $sql3->result_array();
		} else {
			$data['rowsipa'] = 0;
		}
		$sql4 = $this->db->query("SELECT 
					PS_Pack,
					Quantity-isnull([MTKSMA],0) as MTKSMA,
					Quantity-isnull([BINDSMA],0) as BINDSMA,
					Quantity-isnull([BINGSMA],0) as BINGSMA,
					Quantity-isnull([EKO],0) as EKO,
					Quantity-isnull([GEO],0) as GEO,
					Quantity-isnull([SOS],0) as SOS,
					Quantity-isnull([SEJ],0) as SEJ,
					Quantity-isnull([SE1IPS],0) as SE1IPS,
					Quantity-isnull([SE2IPS],0) as SE2IPS
				from 
				(
				select b.PS_Pack,c.ItemStage,d.Quantity,sum(a.QtySB) as QtySB from Logistics_DODetail a
				join Logistics_PODetail d on a.PO_Detail=d.RecID
				join Logistics_DOHeader e on a.DO_Number=e.DO_Number
				join Logistics_PackageItem b on d.PackCode=b.RecID
				join Logistics_MasterItem c on d.ItemCode=c.ItemCode
				where e.PR_Number = '$pr' and b.stage=3 and e.Status is not null AND PackName LIKE '%IPS%'
				group by b.PS_Pack,c.ItemStage,d.Quantity,a.QtySB
				) src
				pivot
				(
				  sum(QtySB)
				  for ItemStage in ([MTKSMA],[BINDSMA],[BINGSMA],[EKO],[GEO],[SOS],[SEJ],[SE1IPS],[SE2IPS])
				) piv
				where
					Quantity-isnull([MTKSMA],0) !=0 OR
					Quantity-isnull([BINDSMA],0) !=0 OR
					Quantity-isnull([BINGSMA],0) !=0 OR
					Quantity-isnull([EKO],0) !=0 OR
					Quantity-isnull([GEO],0) !=0 OR
					Quantity-isnull([SOS],0) !=0 OR
					Quantity-isnull([SEJ],0) !=0 OR
					Quantity-isnull([SE1IPS],0) !=0 OR
					Quantity-isnull([SE2IPS],0) !=0
				ORDER by PS_Pack");
		if ($sql4->num_rows()>0) {
			$data['rowsips'] = $sql4->result_array();
		} else {
			$data['rowsips'] = 0;
		}	
		$sql5 = $this->db->query("SELECT c.PS_NAME,d.Quantity, sum(a.QtySB) as Qty, b.Number as QtySB from Logistics_DODetail a
				join Logistics_PODetail d on a.PO_Detail=d.RecID
				join Logistics_DOHeader e on a.DO_Number=e.DO_Number
				join Logistics_PackageItem b on d.PackCode=b.RecID
				join Logistics_MasterItem c on d.ItemCode=c.ItemCode
				where e.PR_Number = '$pr' and b.PackName like '%2006%' and e.Status is not null
				group by c.PS_NAME,d.Quantity,b.Number
				having d.Quantity - SUM(a.QtySB) != 0
				order by b.Number");
		if ($sql5->num_rows()>0) {
			$data['rows2006'] = $sql5->result_array();
		} else {
			$data['rows2006'] = 0;
		}		
		$sql6 = $this->db->query("SELECT c.PS_NAME,d.Quantity, sum(a.QtySB) as Qty, b.Number as QtySB from Logistics_DODetail a
				join Logistics_PODetail d on a.PO_Detail=d.RecID
				join Logistics_DOHeader e on a.DO_Number=e.DO_Number
				join Logistics_PackageItem b on d.PackCode=b.RecID
				join Logistics_MasterItem c on d.ItemCode=c.ItemCode
				where e.PR_Number = '$pr' and b.PackName like '%Nasional%' and e.Status is not null
				group by c.PS_NAME,d.Quantity,b.Number
				having d.Quantity - SUM(a.QtySB) != 0
				order by b.Number");
		if ($sql6->num_rows()>0) {
			$data['rowsnas'] = $sql6->result_array();
		} else {
			$data['rowsnas'] = 0;
		}			
		$sql7 = $this->db->query("SELECT c.PS_NAME,d.Quantity, sum(a.QtySB) as Qty, b.Number as QtySB from Logistics_DODetail a
				join Logistics_PODetail d on a.PO_Detail=d.RecID
				join Logistics_DOHeader e on a.DO_Number=e.DO_Number
				join Logistics_PackageItem b on d.PackCode=b.RecID
				join Logistics_MasterItem c on d.ItemCode=c.ItemCode
				where e.PR_Number = '$pr' and b.PackType = '5' and e.Status is not null OR e.PR_Number = '$pr' and b.PackType = '7' and e.Status is not null
				group by c.PS_NAME,d.Quantity,b.Number
				having d.Quantity - SUM(a.QtySB) != 0
				order by b.Number");
		if ($sql7->num_rows()>0) {
			$data['rowsinten'] = $sql7->result_array();
		} else {
			$data['rowsinten'] = 0;
		}	
		$arr = array(
			'select' => array(
				'a.PR_Number',
				'a.Print_PS',
				'e.KodeAreaCabang',
				'e.NamaAreaCabang',
				'f.NamaAreaCabang as Area',
				'e.Alamat as alamat',
				'e.NoTelp as notelp',
				'e.NoHandPhone as nohp',
				'e.KodePos',
				'g.NamaKotaKab as Kota',
				'h.NamaPropinsi as Propinsi',
				'e.NamaManager'
			),
			'from' => 'Logistics_POHeader a',
			'join' => array(
				'TPrimaEdu_Prod.dbo.areacabang e' => array(
					'on' => 'a.BranchCode=e.KodeAreaCabang',
					'type' => 'inner',
				),
				'TPrimaEdu_Prod.dbo.areacabang f' => array(
					'on' => 'e.Area=f.KodeAreaCabang',
					'type' => 'inner',
				),
				'TPrimaEdu_Prod.dbo.kotakab g' => array(
					'on' => 'e.Kota=g.RecID',
					'type' => 'inner',
				),
				'TPrimaEdu_Prod.dbo.Propinsi h' => array(
					'on' => 'g.Propinsi=h.RecID',
					'type' => 'inner',
				),
			),
			'where' => array('a.PR_Number' => $pr)
		);
		$sqlinfo = $this->config_model->find($arr);
		if ($sqlinfo->num_rows()>0) {
			$data['rowsinfo'] = $sqlinfo->result_array();
		} else {
			$data['rowsinfo'] = 0;
		}
		echo json_encode($data);	
		/*
		} else {
		echo data_json("Oops akses ditolak.");
		}*/
	}

	public function update_qty_bonus()
	{
		$Kode = $this->input->post('Kode');
		$DO = $this->input->post('DO');
		$Qty = $this->input->post('Qty');
		if($Kode==1){
		$arr = array(
			'params' => array(
				'Bag' => $Qty,
			),
			'from' => 'Logistics_DOHeader',
			'where' => array('DO_Number'=>$this->input->post('DO')),
		);
		} else if($Kode==2){
		$arr = array(
			'params' => array(
				'Sticker' => $Qty,
			),
			'from' => 'Logistics_DOHeader',
			'where' => array('DO_Number'=>$this->input->post('DO')),
		);	
		} else if($Kode==3){
		$arr = array(
			'params' => array(
				'StickerS' => $Qty,
			),
			'from' => 'Logistics_DOHeader',
			'where' => array('DO_Number'=>$this->input->post('DO')),
		);	
		}
		$msg = $this->config_model->update($arr);
			if ($msg==true) {
				echo data_json(array("message"=>"Qty berhasil diinput.","notify"=>"success"));
			} else {
				echo data_json(array("message"=>"Qty gagal diinput.","notify"=>"warning"));
			}
	}

	public function pay()
	{
		restrict();
    	$token = base64_decode($this->input->post('token'));
		if(isset($token) && !empty($token)) {
		$inv = base64_decode($this->input->post('inv'));
		$nominal = base64_decode($this->input->post('nominal'));
		$arr = array(
			'params' => array(
				'Invoice_Status' => 1,
			),
			'from' => 'Logistics_Invoice',
			'where' => array('Invoice_Number'=>$inv),
		);
		$this->config_model->update($arr);
		echo data_json(array("message"=>"direct ke doku, nominal = $nominal , invoice = $inv"));
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function tracking()
	{
		$pr = base64_decode($this->input->post('pr'));
	    $arr = array(
	    		'select'=>array(
	    			'DO_Number',
	    			'Description',
	    			'Tracking_Name AS content',
	    			'CreatedDate AS time',
	    			'CASE WHEN Status=\'0\' THEN \'style="border: 1px solid #30f;"\' ELSE \'\' END AS style2',
	    			'CASE WHEN Status=\'1\' THEN \'style="border-right-color: #30f;"\' ELSE \'\' END AS style',
	    		),
	    		'from' => 'Logistics_Tracking',
				'where' => array('PR_Number'=>$pr),
	    		'order_by' => array('RecID'=>''),
	    	);
		$sql = $this->config_model->find($arr);
		$arr2 = array(
	    		'select'=>array(
	    			'a.DO_Number',
	    			'b.ItemCode',
	    			'c.ItemName',
	    			'e.PackName',
	    			'b.QtySB',
	    			'c.TypeId',
	    		),
				'from' => 'Logistics_DOHeader a',
				'join' => array(
					'Logistics_DODetail b' => array(
						'on' => 'a.DO_Number=b.DO_Number',
						'type' => 'inner',
					),
					'Logistics_MasterItem c' => array(
						'on' => 'b.ItemCode=c.ItemCode',
						'type' => 'inner',
					),
					'Logistics_PODetail d' => array(
						'on' => 'd.RecID=b.PO_Detail',
						'type' => 'inner',
					),
					'Logistics_PackageItem e' => array(
						'on' => 'd.PackCode=e.RecID',
						'type' => 'inner',
					),
				),
				'where' => "a.PR_Number='$pr' and b.QtySB != 0",
				'order_by' => array('e.RecID'=>'','c.RecID'=>''),
			);
		$sql2 = $this->config_model->find($arr2);
		$arr3 = array(
				'from' => 'Logistics_DOHeader a',
				'join' => array(
					'Logistics_Expedisi b' => array(
						'on' => 'a.Expedisi=b.RecID',
						'type' => 'left',
					),
				),
				'where' => "a.PR_Number='$pr'",
			);
		$sql3 = $this->config_model->find($arr3);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
			$data['rows2'] = $sql2->result_array();
			$data['rows3'] = $sql3->result_array();
		} else {
			$data['rows'] = 0;
			$data['rows2'] = 0;
			$data['rows3'] = 0;
		}
		echo json_encode($data);
	}

	public function get_detail_deliv()
	{
		$inv = base64_decode($this->input->post('inv'));
		$arr = array(
				'from' => 'Logistics_DOHeader a',
				'join' => array(
					'Logistics_Invoice b' => array(
						'on' => 'a.PR_Number=b.PR_Number',
						'type' => 'inner',
					),
				),
				'where' => array('b.Invoice_Number'=>$inv),
			);
		$item = $this->config_model->find($arr);
		if ($item->num_rows()>0) {
			$data['rows'] = $item->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function expired()
	{
    	$token = base64_decode($this->input->post('token'));
    	//$Kode = base64_decode($this->input->post('kode'));
		$cekst = array(
			'select' => array(
				'Count(a.RecID) as JML'
			),
			'from' => 'Logistics_Invoice a',
			'where' => array('a.Invoice_Number'=>base64_decode($this->input->post('inv')),'a.Invoice_Status' => 2),
					);
		$cekstsql = $this->config_model->find($cekst)->row_array();

		if(isset($token) && !empty($token) && $cekstsql['JML']==0) {
		$inv = base64_decode($this->input->post('inv'));
		$arr2 = array(
			'select' => array(
				'a.PR_Number as PR_Number',
			),
			'from' => 'Logistics_Invoice a',
			'where' => array('a.Invoice_Number'=>$inv),
		);
		$sql = $this->config_model->find($arr2)->row_array();
		$arr = array(
			'params' => array(
				'Status' => 9
			),
			'from' => 'Logistics_POHeader',
			'where' => array('PR_Number'=>$sql['PR_Number']),
		);
		$this->config_model->update($arr);
		$arr3 = array(
			'params' => array(
				'Invoice_Status' => 9
			),
			'from' => 'Logistics_Invoice',
			'where' => array('Invoice_Number'=>$inv),
		);
		$this->config_model->update($arr3);
		$arr4 = array(
			'params' => array(
				'RESULTMSG' => 'EXPIRED'
			),
			'from' => 'Logistics_Transactions',
			'where' => array('TRANSIDMERCHANT'=>$inv),
		);
		$this->config_model->update($arr4);
		$ctr = array(
			'select' => array(
				'count(a.RecID) as Total'
			),
			'from' => 'Logistics_Tracking a',
			'where' => array('a.PR_Number'=>$sql['PR_Number'], 'Tracking_Name'=>'Expired'),
		);
		$sqltr = $this->config_model->find($ctr)->row_array();
		if($sqltr['Total']<1){
		$data2 = array(
	    	'params' => array(
		    	'PR_Number' => $sql['PR_Number'],
		    	'Tracking_Name' => 'Expired',
		    	'Status' => 1,
		    	'CreatedDate' => date('Y-m-d H:i:s'),
		    	'CreatedBy' => 'doku'
		    ),
		    'from' => 'Logistics_Tracking',
	    );
	    $this->config_model->insert($data2);
		}
		echo data_json(array("message"=>"Pemesanan / Kode Pembayaran Expired","notify"=>"success"));
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function cancelpay()
	{
    	$token = base64_decode($this->input->post('token'));
    	$Als = base64_decode($this->input->post('alscancel'));
		if(isset($token) && !empty($token)) {
		$inv = base64_decode($this->input->post('inv'));
		$arr2 = array(
			'select' => array(
				'a.Invoice_Number as Invoice_Number',
			),
			'from' => 'Logistics_Invoice a',
			'where' => array('a.PR_Number'=>$inv),
		);
		$sql = $this->config_model->find($arr2)->row_array();
		$arr = array(
			'params' => array(
				'Status' => 10
			),
			'from' => 'Logistics_POHeader',
			'where' => array('PR_Number'=>$inv),
		);
		$this->config_model->update($arr);
		$arr3 = array(
			'params' => array(
				'Invoice_Status' => 10
			),
			'from' => 'Logistics_Invoice',
			'where' => array('PR_Number'=>$inv),
		);
		$this->config_model->update($arr3);
		$arr4 = array(
			'params' => array(
				'RESULTMSG' => 'CANCEL'
			),
			'from' => 'Logistics_Transactions',
			'where' => array('TRANSIDMERCHANT'=>$sql['Invoice_Number']),
		);
		$this->config_model->update($arr4);
		$ctr = array(
			'select' => array(
				'count(a.RecID) as Total'
			),
			'from' => 'Logistics_Tracking a',
			'where' => array('a.PR_Number'=>$inv, 'Tracking_Name'=>'Cancel : '.$Als),
		);
		$sqltr = $this->config_model->find($ctr)->row_array();
		if($sqltr['Total']<1){
		$data2 = array(
	    	'params' => array(
		    	'PR_Number' => $inv,
		    	'Tracking_Name' => 'Cancel : '.$Als,
		    	'Status' => 1,
		    	'CreatedDate' => date('Y-m-d H:i:s'),
		    	'CreatedBy' => 'doku'
		    ),
		    'from' => 'Logistics_Tracking',
	    );
	    $this->config_model->insert($data2);
		}
		echo data_json(array("message"=>"Pemesanan berhasil dibatalkan","notify"=>"success"));
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function reset_stok()
	{
    	$token = base64_decode($this->input->post('token'));
    	$Kode = base64_decode($this->input->post('kode'));
    	$inv = base64_decode($this->input->post('inv'));
	 	/*$arr2 = array(
			'select' => array(
				'a.PR_Number as PR_Number',
			),
			'from' => 'Logistics_Invoice a',
			'where' => array('a.Invoice_Number'=>$inv),
		);
		$sql = $this->config_model->find($arr2)->row_array();
		$pr = $sql['PR_Number'];*/
		/*if(isset($token) && !empty($token) && $Kode==0) {
		$this->config_model->manualQuery("UPDATE Logistics_MasterItem 
			set OrderedStock = Logistics_MasterItem.OrderedStock-a.Quantity
			from Logistics_PODetail a
			join Logistics_POHeader b on a.PR_Number=b.PR_Number 
			where b.Status = 0 and Logistics_MasterItem.ItemCode=a.ItemCode and a.CreatedDate<DATEADD(dd, 1, DATEDIFF(dd, 0, GETDATE()))");
		$this->config_model->manualQuery("DELETE a from Logistics_PODetail a
			join Logistics_POHeader b on a.PR_Number=b.PR_Number 
			where b.Status = 0 and a.CreatedDate<DATEADD(dd, 1, DATEDIFF(dd, 0, GETDATE()))");
		echo data_json(array("message"=>"Form Pemesanan sudah direset.","notify"=>"success"));
		} else*/
		if(isset($token) && !empty($token) && $Kode==1){
		$this->config_model->manualQuery("UPDATE Logistics_MasterItem 
			set OrderedStock = Logistics_MasterItem.OrderedStock-a.Quantity
			from Logistics_PODetail a
			join Logistics_POHeader b on a.PR_Number=b.PR_Number 
			where Logistics_MasterItem.ItemCode=a.ItemCode and a.PR_Number='$inv'");
		echo data_json(array("message"=>"Expired","notify"=>"success"));
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function get_invoice_number()
	{		
		$data['rows'] = $this->config_model->get_invoice();
		echo json_encode($data);
	}

	public function cek_invoice()
	{
		$arr = array(
			'select' => array(
				'count(a.RecID) as Invoice',
			),
			'from' => 'Logistics_Invoice a',
			'where' => array('a.Invoice_Number'=>$this->input->post('inv')),
		);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'][] = $sql->row_array();
		} else {
			$data['rows'][] = array('total_item'=>0);
		}
		echo json_encode($data);
	}

	public function list_edit_do()
	{	
		restrict();
		$data = array(
			'title' => 'Ubah Detail Pengiriman',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics/list_do"> Input Barang yang akan di Kirim</a>',
			'breadcrumb_2' => '<a href="'.base_url().'Logistics/list_edit_do"> Ubah Detail Pengiriman</a>',
		);
		$this->template->load('template', 'Logistics/list_edit_do',$data);
	}

	public function edit_do()
	{
		restrict();
    	$token = base64_decode($this->input->post('token'));
		if(isset($token) && !empty($token)) {
		$dn = base64_decode($this->input->post('dn'));
		$data = array(
			'title' => 'Ubah Detail Pengiriman',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics/list_do"> Input Barang yang akan di Kirim </a>',
			'breadcrumb_2' => '<a href="'.base_url().'Logistics/list_edit_do"> Ubah Detail Pengiriman</a>',
			'dn' => $dn,
		);
		$this->template->load('template', 'Logistics/edit_do',$data);
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function get_detail_do_edit()
	{
		restrict();
    	$token = base64_decode($this->input->post('token'));
		if(isset($token) && !empty($token)) {
		$dn = base64_decode($this->input->post('dn'));
		$arr = array(
				'select' => array(
					'DENSE_RANK() OVER(ORDER BY e.Number) RowNum',
					'a.RecID',
					'a.DO_Number',
					'b.PR_Number',
					'a.ItemCode',
					'c.TypeId',
					'isnull(b.Quantity,0) as Quantity',
					'isnull(a.QtySB,0) as QtySB',
					'd.StickerS',
					'e.PackCode'
				),
				'from' => 'Logistics_DODetail a',
				'join' => array(
					'Logistics_PODetail b' => array(
						'on' => 'a.PO_Detail=b.RecID',
						'type' => 'inner',
					),
					'Logistics_MasterItem c' => array(
						'on' => 'c.ItemCode=b.ItemCode',
						'type' => 'inner',
					),
					'Logistics_DOHeader d' => array(
						'on' => 'a.DO_Number=d.DO_Number',
						'type' => 'inner',
					),
					'Logistics_PackageItem e' => array(
						'on' => 'b.PackCode=e.RecID',
						'type' => 'inner',
					),
				),
				'where' => array('d.DO_Number' => $dn),
				'order_by' => array('e.Number' => '','e.PackType'=>'','e.Pack' => '', 'c.RecID' => ''),
			);
		$sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
			$data['group'] = $this->session->userdata('UserGroup');
		} else {
			$data['rows'] = 0;
			$data['group'] = $this->session->userdata('UserGroup');
		}
		echo json_encode($data);
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function open_ps()
	{
		restrict();
    	$token = base64_decode($this->input->post('token'));
		if(isset($token) && !empty($token)) {
		$data = array(
			'title' => 'Kelola Packing Slip',
			'breadcrumb_1' => '<a href="'.base_url().'Logistics/packing">Data Cetak Packing Slip </a>',
			'breadcrumb_2' => '<a href="'.base_url().'Logistics/list_edit_do"> Kelola Packing Slip</a>',
		);
		$this->template->load('template', 'Logistics/open_ps',$data);
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function list_openps()
	{
		restrict();
    	$cabang = base64_decode($this->input->post('Cabang'));
    	$token = base64_decode($this->input->post('token'));
		if(isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'ROW_NUMBER() OVER (ORDER BY RecID DESC) as RowNum',
					'PR_Number',
					'PR_Date',
					'Print_PS',
					'RecID'
				),
				'from' => 'Logistics_POHeader',
				'where' => "BranchCode = '$cabang' AND Status = 2 AND Print_PS = 1",
			))->result_array();
			echo json_encode($data);
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function updateps()
	{
    	$token = base64_decode($this->input->post('token'));
    	//$Kode = base64_decode($this->input->post('kode'));
		if(isset($token) && !empty($token)) {
		$RecID = base64_decode($this->input->post('RecID'));
		$arr2 = array(
			'select' => array(
				'a.PR_Number as PR_Number',
			),
			'from' => 'Logistics_POHeader a',
			'where' => array('a.RecID'=>$RecID),
		);
		$sql = $this->config_model->find($arr2)->row_array();
		$pr = $sql['PR_Number'];
		$arr = array(
			'params' => array(
				'Print_PS' => 0
			),
			'from' => 'Logistics_POHeader',
			'where' => array('RecID'=>$RecID),
		);
		$this->config_model->update($arr);
		$arrdel = array(
				'from' => 'Logistics_Tracking',
				'where' => array('PR_Number'=>$pr, 'Tracking_Name' => 'Packing Oleh Logistik'),
			);
		$this->config_model->delete($arrdel);
		echo data_json(array("message"=>"Packing Slip berhasil dibuka.","notify"=>"success"));
		} else {
		echo data_json("Oops akses ditolak.");
		}
	}

	public function cek_nominal()
	{
		//note delivefeepack belum
		$arr = array(
			'select' => array(
				'sum(a.Quantity*(a.Price+a.DelivFee)) as Nominal',
			),
			'from' => 'Logistics_PODetail a',
				'join' => array(
					'Logistics_PackageItem b' => array(
						'on' => 'a.PackCode=b.RecID',
						'type' => 'inner',
					),
				),
			'where' => array('a.PR_Number'=>$this->input->post('PR'),'b.PackType !='=>8),
		);
		$sql = $this->config_model->find($arr)->row_array();
		
		$sql2 = $this->db->query("
			SELECT SUM(Price*Quantity) as Nominal from (
				SELECT 
				a.Price,
				a.DelivFee,
				a.Quantity,
				a.PackCode
				from Logistics_PODetail a
				join Logistics_PackageItem b on a.PackCode=b.RecID
				where a.PR_Number = '".$this->input->post('PR')."' and b.PackType = 8
				group by 
				a.PackCode,
				a.DelivFee,
				a.Quantity,
				a.PackCode ,
				a.Price
			) cte
			")->row_array();
		//echo $sql['Nominal']+$sql2['Nominal'];
		$data['rows'][] = $sql['Nominal'];
		$data['rows2'][] = $sql2['Nominal'];
		echo json_encode($data);
	}

	public function estimate()
	{
		restrict();/*
		if ($this->session->userdata('UserGroup')==14) {*/
			$data['breadcrumb_1'] = '<a href="'.base_url().'Logistics/estimate">Estimasi Pengiriman</a>';
			$this->template->set('title', 'Estimasi Pengiriman');
			$this->template->load('template', 'Logistics/estimate',$data);
		/*} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}
	
	public function find_estimate()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'a.Description',
				),
				'from' => 'Logistics_Info a',
				'order_by' => array('a.RecID' => 'DESC')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function add_estimate()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->insert(array(
					'params' => array(
						'Description' => base64_decode($this->input->post('Description')),
						'CreatedDate' => date("Y-m-d H:i:s"),
						'CreatedBy' => $this->session->userdata('Username')
					),
					'from' => 'Logistics_Info'
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
	
	public function delete_estimate()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->delete(array(
					'from' => 'Logistics_Info',
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

	public function packitem()
	{
		restrict();/*
		if ($this->session->userdata('UserGroup')==14) {*/
			$data['usergroup'] = $this->session->userdata('UserGroup');
			$data['breadcrumb_1'] = '<a href="'.base_url().'Logistics/packitem">Paket Item</a>';
			$this->template->set('title', 'Paket Item');
			$this->template->load('template', 'Logistics/packitem',$data);
		/*} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}
	
	public function find_packitem()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$RecID = base64_decode($this->input->get('RecID'));
			if (isset($RecID) && !empty($RecID)) {
				$where = array('b.RecID' => $RecID);
			} else {
				$where = 'b.PackType is not null';
			}
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'b.RecID',
					'b.PackCode',
					'b.PackName',
					'b.PackType',
					'b.Status as StatusID',
					'sum(c.Price) as Price',
					'sum(c.DelivFee) as DelivFee',
					'sum(c.PriceB) as PriceB',
					'sum(c.DelivFeeB) as DelivFeeB',
					'b.PricePack',
					'b.DelivFeePack',
					"CASE b.Status 
					  WHEN 0 THEN 'Tutup'
					  WHEN 1 THEN 'Buka'
					END as Status"
				),
				'from' => 'Logistics_PackageDetail a',
				'join' => array(
					'Logistics_PackageItem b' => array(
						'on' => 'a.PackId=b.RecID',
						'type' => 'inner'
					),
					'Logistics_MasterItem c' => array(
						'on' => 'a.ItemCode=c.ItemCode',
						'type' => 'inner'
					)
				),
				'where' => $where,
				'group_by' => array(
					'b.RecID',
					'b.PackCode',
					'b.PackName',
					'b.Status',
					'b.PricePack',
					'b.DelivFeePack',
					'b.PackType',
					'c.PageId'
				),
				'order_by' => array('b.PackType' => '','c.PageId'=>'')
			))->result_array();
			echo json_encode($data);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}
	
	public function find_packitemdetail()
	{
		$token = base64_decode($this->input->get('token'));/*
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {*/
			$RecID = base64_decode($this->input->get('RecID'));
			
			$where = array('b.RecID' => $RecID);
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'b.RecID',
					'b.PackCode',
					'b.PackName',
					'c.ItemCode',
					'c.ItemName',
					'c.Price',
					'c.PriceB',
					'b.PackType'
				),
				'from' => 'Logistics_PackageDetail a',
				'join' => array(
					'Logistics_PackageItem b' => array(
						'on' => 'a.PackId=b.RecID',
						'type' => 'inner'
					),
					'Logistics_MasterItem c' => array(
						'on' => 'a.ItemCode=c.ItemCode',
						'type' => 'inner'
					)
				),
				'where' => $where,
				'order_by' => array('b.RecID' => '')
			))->result_array();
			echo json_encode($data);/*
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}
	
	public function edit_packitem()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'PackName' => base64_decode($this->input->post('PackName')),
						'Status' => base64_decode($this->input->post('Status'))
					),
					'from' => 'Logistics_PackageItem',
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

	public function list_do_exp_edit()
	{
		restrict();/*
		if ($this->session->userdata('UserGroup')==14) {*/
			$data['breadcrumb_1'] = '<a href="'.base_url().'Logistics/list_do_exp">Input Detail Ekspedisi</a>';
			$data['breadcrumb_2'] = '<a href="'.base_url().'Logistics/list_do_exp_edit">Edit Detail Ekspedisi</a>';
			$arr = array(
					'from' => 'Logistics_Expedisi',
					'where' => array('Status' => 1),
				);
			$item = $this->config_model->find($arr);
			$data['item']= $item;
			$this->template->set('title', 'Edit Detail Ekspedisi');
			$this->template->load('template', 'Logistics/list_do_exp_edit',$data);
		/*} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}*/
	}
	
	public function find_list_do_exp_edit()
	{
		$token = base64_decode($this->input->get('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$RecID = base64_decode($this->input->get('RecID'));
			if (isset($RecID) && !empty($RecID)) {
				$where = array('a.RecID' => $RecID);
			} else {
				$where = "a.DO_Date > '2019-07-01'";
			}
			$data['data'] = $this->config_model->find(array(
				'select' => array(
					'a.RecID',
					'a.PR_Number',
					'a.DO_Number',
					'a.DO_Date',
					'a.Estimate_Date',
					'a.CP',
					'a.NoResi',
					'b.Exp_Name',
					'b.Link',
					'a.Koli',
					'b.RecID as ExpID'
				),
				'from' => 'Logistics_DOHeader a',
				'join' => array(
					'Logistics_Expedisi b' => array(
						'on' => 'a.Expedisi=b.RecID',
						'type' => 'inner'
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
	
	public function edit_list_do_exp_edit()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			try {
				$this->config_model->update(array(
					'params' => array(
						'Expedisi' => base64_decode($this->input->post('Expedisi')),
				    	'DO_Date' => date('Y-m-d',strtotime($this->input->post('Deliv_Date'))),
				    	'Estimate_Date' => date('Y-m-d',strtotime($this->input->post('Est_Date'))),
						'Koli' => base64_decode($this->input->post('Koli')),
						'NoResi' => base64_decode($this->input->post('Resi')),
						'CP' => base64_decode($this->input->post('CP')),
						'EditDate' => date("Y-m-d H:i:s"),
						'EditBy' => $this->session->userdata('Username')
					),
					'from' => 'Logistics_DOHeader',
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

	public function changestatus()
	{
		restrict();
		$data['breadcrumb_1'] = '<a href="#">Ubah Status PO</a>';
		$this->template->set('title', 'Ubah Status PO');
		$this->template->load('template', 'Logistics/changestatus',$data);
	}

	public function loadchange()
	{
		$PR =  base64_decode($this->input->post('PR'));
		$arr = array(
				'from' => 'Logistics_Invoice a',
				'where' => array('a.PR_Number' => $PR),
			);
		$item = $this->config_model->find($arr);		
		//$sql = $item->row_array();
		$data['rows'] = $item->result_array();
		echo json_encode($data);	

	}

	public function settle()
	{

		$PR =  base64_decode($this->input->post('PR'));
		$INV =  base64_decode($this->input->post('INV'));
		$TDATE =  base64_decode($this->input->post('TDATE'));

		$master = array(
			'params' => array(
				'Status' => 2,
			),
			'from' => 'Logistics_POHeader',
			'where' => array('PR_Number'=> $PR),
		);
		$this->config_model->update($master);

		$master2 = array(
			'params' => array(
				'Invoice_Status' => 2,
			),
			'from' => 'Logistics_Invoice',
			'where' => array('Invoice_Number'=> $INV),
		);
		$this->config_model->update($master2);

		$master3 = array(
			'params' => array(
				'RESULTMSG' => 'SUCCESS',
				'PAYMENTDATETIME' => $TDATE
			),
			'from' => 'Logistics_Transactions',
			'where' => array('TRANSIDMERCHANT'=> $INV),
		);
		$this->config_model->update($master3);

		$data2 = array(
	    	'params' => array(
		    	'PR_Number' => $PR,
		    	'Tracking_Name' => 'Pembayaran Berhasil',
		    	'Status' => 1,
		    	'CreatedDate' => date('Y-m-d H:i:s'),
		    	'CreatedBy' => 'SPE'
		    ),
		    'from' => 'Logistics_Tracking',
	    );
	    $this->config_model->insert($data2);

		$data['message'] = 'Berhasil gaeeessss MANTUULLLL !!!!';
		$data['notify'] = 'success';
		echo json_encode($data);
	
	}
}
