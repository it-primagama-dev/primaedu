<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
	private $db2 = "TPrimaEdu_Prod.dbo.";

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('config_model');
        $this->load->helper('xml');
    } 

	public function index()
	{	
		restrict();
	}

	public function doku_identify()
	{	
		//check if POST parameter = empty
/*		if(empty($this->input->post('AMOUNT')) AND empty($this->input->post('TRANSIDMERCHANT'))) {
		      echo "STOP: ACCESS NOT VALID";
		      //die;
		}*/
	 
	  	#check if IP ADDRESS request != DOKU IP 
	  	//103.10.129.16 dev / 103.10.129.9 pro
		if($this->input->ip_address() != '103.10.129.9' OR $this->input->ip_address() != '103.10.130.35'){
	      echo "STOP: IP NOT ALLOWED";
	      //die;
	  	} else {
	      	//prepare get POST parameter;       
			$AMOUNT = $this->input->post('AMOUNT');
			$TRANSIDMERCHANT = $this->input->post('TRANSIDMERCHANT');
			$PAYMENTCHANNEL = $this->input->post('PAYMENTCHANNEL');
			$SESSIONID = $this->input->post('SESSIONID');
			$PAYMENTCODE = $this->input->post('PAYMENTCODE');
			$data = array(
    			'params' => array(
					'AMOUNT' => $AMOUNT,
					'PURCHASEAMOUNT' => $AMOUNT,
					'TRANSIDMERCHANT' => $TRANSIDMERCHANT,
					'PAYMENTCHANNEL' => $PAYMENTCHANNEL,
					'SESSIONID' => $SESSIONID,
					'PURCHASECURRENCY' => $this->input->post('PURCHASECURRENCY'),
					'CURRENCY' => $this->input->post('CURRENCY'),
					'PAYMENTCODE' => $this->input->post('PAYMENTCODE'),
					'CreatedDate' => date("Y-m-d H:i:s")
				),
		    	'from' => 'Logistics_Transactions',
			);
	    	$this->config_model->insert($data);
	 		$arr2 = array(
				'select' => array(
					'a.PR_Number as PR_Number',
				),
				'from' => 'Logistics_Invoice a',
				'where' => array('a.Invoice_Number'=>$TRANSIDMERCHANT),
			);
			$sql = $this->config_model->find($arr2)->row_array();
			$data2 = array(
    			'params' => array(
	    			'PR_Number' => $sql['PR_Number'],
	    			'Tracking_Name' => 'Request Kode Pembayaran : '.$PAYMENTCODE.' - VA PERMATA',
	    			'Status' => 1,
	    			'CreatedDate' => date('Y-m-d H:i:s'),
	    			'CreatedBy' => 'doku'
	    		),
	    		'from' => 'Logistics_Tracking',
    		);
    		$this->config_model->insert($data2);
			$arr = array(
				'params' => array(
					'Invoice_Status' => 1,
				),
				'from' => 'Logistics_Invoice',
				'where' => array('Invoice_Number'=>$TRANSIDMERCHANT),
			);
			$this->config_model->update($arr);
			$arr4 = array(
				'params' => array(
	    			'EditDate' => date('Y-m-d H:i:s'),
	    			'EditBy' => 'doku'
				),
				'from' => 'Logistics_POHeader',
				'where' => array('PR_Number'=>$sql['PR_Number']),
			);
			$this->config_model->update($arr4);
			//echo data_json(array("message"=>"Data berhasil disimpan.","notify"=>"success"));
			//echo $PAYMENTCHANNEL;
	  	}

	}

	public function doku_notify()
	{
	  	#check if IP ADDRESS request != DOKU IP
		/*if($this->input->ip_address() != '103.10.129.7' OR $this->input->ip_address() != '103.10.129.8' OR $this->input->ip_address() != '103.10.129.9' OR $this->input->ip_address() != '103.10.129.20'){*/
		if(/*$this->input->ip_address() != '103.10.129.9' AND */$this->input->ip_address() != '103.10.130.35'){
	      echo "STOP: IP NOT ALLOWED";
	      //die;
	  	} else {
	      //prepare get POST parameter;       
		$WORDS = $this->input->post('WORDS');
		$AMOUNT = $this->input->post('AMOUNT');
		$TRANSIDMERCHANT = $this->input->post('TRANSIDMERCHANT');
		$RESULTMSG = $this->input->post('RESULTMSG');
		$VERIFYSTATUS = $this->input->post('VERIFYSTATUS');   

	    # Compare WORDS receive with WORDS generate
	    //WORDS_GENERATE = sha1( AMOUNT + MALLID + SHAREDKEY + TRANSIDMERCHANT + RESULTMSG + VERIFYSTATUS ); 
	    // mallid pro 3363 / dev 5547
		$WORDS_GENERATED = sha1("$AMOUNT"."3363"."S9SduJM092zc"."$TRANSIDMERCHANT"."$RESULTMSG"."$VERIFYSTATUS");
	       
	    # check if WORDS_GENERATE = WORDS
		if($WORDS==$WORDS_GENERATED){
	           
	          #check if TRANSIDMERCHANT with AMOUNT and SESSIONID is exist
			if(!empty($this->input->post('WORDS')) AND !empty($this->input->post('AMOUNT'))){
				$data = array(
    				'params' => array(
						'RESULTMSG' => $this->input->post('RESULTMSG'),
						'RESPONSECODE' => $this->input->post('RESPONSECODE'),
						'APPROVALCODE' => $this->input->post('APPROVALCODE'),
						'MCN' => $this->input->post('MCN'),
						'PAYMENTDATETIME' => $this->input->post('PAYMENTDATETIME'),
						'VERIFYID' => $this->input->post('VERIFYID'),
						'VERIFYSCORE' => $this->input->post('VERIFYSCORE'),
						'VERIFYSTATUS' => $this->input->post('VERIFYSTATUS'),
						'STATUSTYPE' => $this->input->post('STATUSTYPE'),
						'CreatedDatePayment' => date("Y-m-d H:i:s")
					),
			    	'from' => 'Logistics_Transactions',
					'where' => array('TRANSIDMERCHANT'=>$TRANSIDMERCHANT, 'PAYMENTCODE'=>$this->input->post('PAYMENTCODE')),
				);
		    	$msg = $this->config_model->update($data);

		    	$PAYCODE = $this->input->post('PAYMENTCODE');
		    	
		    	//validation for  course payment
		    	if(substr($PAYCODE, 8,2) != '05') {
		    		//BUKU
			 		$arr2 = array(
						'select' => array(
							'a.PR_Number as PR_Number',
							'a.BranchCode as BranchCode'
						),
						'from' => 'Logistics_Invoice a',
						'where' => array('a.Invoice_Number'=>$TRANSIDMERCHANT),
					);
					$sql = $this->config_model->find($arr2)->row_array();
					if($RESULTMSG=='SUCCESS'){
						$RESULT='Pembayaran Berhasil';
						$statuspo=2;
					} else {
						$RESULT='Pembayaran Gagal';
						$statuspo=8;
					}

					if($this->input->post('PAYMENTCODE')!=''){

						$cektrack = array(
							'select' => array(
								'Count(a.RecID) as JML'
							),
							'from' => 'Logistics_Tracking a',
							'join' => array(
								'Logistics_Invoice b' => array(
									'on' => 'a.PR_Number=b.PR_Number',
									'type' => 'inner',
								),
							),
							'where' => array('b.Invoice_Number'=>$this->input->post('TRANSIDMERCHANT'),'a.Tracking_Name' => 'Pembayaran Berhasil'),
						);
						$cektracksql = $this->config_model->find($cektrack)->row_array();
						if($cektracksql['JML']==0){
							$data2 = array(
				    			'params' => array(
					    			'PR_Number' => $sql['PR_Number'],
					    			'Tracking_Name' => $RESULT,
					    			'Status' => 1,
					    			'CreatedDate' => date('Y-m-d H:i:s'),
					    			'CreatedBy' => 'doku'
					    		),
					    		'from' => 'Logistics_Tracking',
				    		);
				    		$this->config_model->insert($data2);
				    	}

			    	$data3 = array(
			    		'params' => array(
				    		'Status' => $statuspo,
				    		'EditDate' => date('Y-m-d H:i:s'),
				    		'EditBy' => 'doku',
				    	),
				    	'from' => 'Logistics_POHeader',
						'where' => array('PR_Number'=>$sql['PR_Number']),
			    	);
		    		$this->config_model->update($data3);
					$arr = array(
						'params' => array(
							'Invoice_Status' => $statuspo,
						),
						'from' => 'Logistics_Invoice',
						'where' => array('Invoice_Number'=>$TRANSIDMERCHANT),
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
		    		}

		    	} else {
		    		//COURSE

			 		$arr = array(
						'select' => array(
							'a.SessionID',
							'a.TotalPrice',
							'b.PackDetailName',
							'c.PackName',
							'd.CatName',
							'e.NAME',
							'e.EMAIL',
							'e.AMOUNT'
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
							'Course_Category d' => array(
								'on' => 'c.CatID=d.RecID',
								'type' => 'inner'
							),
							'Logistics_Transactions e' => array(
								'on' => 'a.OrderCode=e.TRANSIDMERCHANT',
								'type' => 'inner'
							),
						),
						'where' => array('a.OrderCode'=>$TRANSIDMERCHANT),
					);
					$sql = $this->config_model->find($arr)->row_array();

					$course = array(
						'params' => array(
							'Status' => 1,
						),
						'from' => 'Course_OrderHeader',
						'where' => array('OrderCode'=>$TRANSIDMERCHANT),
					);
					$this->config_model->update($course);

					require_once(APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php');
					$data = array(
						array(
							'Nama' => $sql['NAME'],
							'Paket' => $sql['CatName'].' - '.$sql['PackName'].' - '.$sql['PackDetailName'],
							'Link' => "http://pintarbersama.primagama.co.id/info/paket/".$sql['SessionID']."'>klik disini untuk melihat detail paket</a>"
						)
					);

					$data2 = array(
						array(
							'Jumlah Pembayaran' => $this->rupiah($sql['AMOUNT'])/*,
							'Pembayaran 2' => 'Rp. 200000'*/
						)
					);

					$mail             = new PHPMailer();
			        $mail->IsSMTP();
			        $mail->SMTPAuth   = true;
			        $mail->Host       = "smtp.office365.com";
			        $mail->Port       = "587";
			        $mail->Username   = "no-reply@primagama.co.id";
			        $mail->Password   = "Prima.1234";
			        $mail->SetFrom('no-reply@primagama.co.id', 'Auto Reply Primagama');
			        $mail->Subject    = "Primagama - Pembayaran Berhasil";
			        $mail->MsgHTML($this->template_email($data,$data2));
			        $mail->AddAddress($sql['EMAIL'], $sql['NAME']);
			        $mail->AddCC("oni.restu@primagama.co.id", "Helpdesk Primagama");


			        if(!$mail->Send()) {
			        	echo "Mailer Error: " . $mail->ErrorInfo;
			        } else {
			         	echo "Mailer berhasil";
			        }
		    	}

				echo data_json(array("message"=>"Data berhasil disimpan.","notify"=>"success"));
	             // CASE RESULTMSG is SUCCESS and PAYMENTCHANNEL using other than CREDIT CARD
	                  //transaction status = SUCCESS
	           
				//DISINI VA 05
	        } else {
	            echo "STOP: TRANSACTION NOT FOUND";
	            //die;        
	        } // WORDS & AMOUNT
	    } else {
	          echo "STOP: REQUEST NOT VALID";
	          //die;
	    } // WORDS_GENERATE
	  	} //IP VAL
	}

	function doku_redirect()
	{
/*		if(!empty($this->input->post('WORDS')) AND !empty($this->input->post('AMOUNT'))) {
		      echo "STOP: ACCESS NOT VALID";
		}*/

		$WORDS = $this->input->post('WORDS');
		$AMOUNT = $this->input->post('AMOUNT');
		$TRANSIDMERCHANT = $this->input->post('TRANSIDMERCHANT');
		$STATUSCODE = $this->input->post('STATUSCODE');   

		$WORDS_GENERATED = sha1("$AMOUNT"."S9SduJM092zc"."$TRANSIDMERCHANT"."$STATUSCODE");
	       
	    # check if WORDS_GENERATE = WORDS
		if($WORDS==$WORDS_GENERATED){
			$PAYMENTCHANNEL = $this->input->post('PAYMENTCHANNEL');
			$SESSIONID = $this->input->post('SESSIONID');
			$PAYMENTCODE = $this->input->post('PAYMENTCODE');
			//$TES = "$PAYMENTCHANNEL"."$SESSIONID"."$PAYMENTCODE"."OK";
	           
	          #check if TRANSIDMERCHANT with AMOUNT and SESSIONID is exist
			/*if(!empty($this->input->post('TRANSIDMERCHANT')) AND !empty($this->input->post('SESSIONID'))){*/

				//echo "Please Do Payment Before Transaction Expired $TES";
		 	$arr2 = array(
				'select' => array(
					'a.PR_Number as PR_Number'
				),
				'from' => 'Logistics_Invoice a',
				'where' => array('a.Invoice_Number'=>$this->input->post('TRANSIDMERCHANT')),
			);
			$sql = $this->config_model->find($arr2)->row_array();
			$data = array(
				'title' => 'Data Pemesanan Buku',
				'breadcrumb_1' => '<a href="'.base_url().'Logistics/list_po">Data Pemesanan Buku</a>',
				'INV' => $sql['PR_Number']
			);
			$this->template->load('template', 'Logistics/invoice',$data);	

	        //}
	    } else {
	          echo "STOP: REQUEST NOT VALID";
	          //die;
	    }
	}

	public function check_notify()
	{
		$token = base64_decode($this->input->post('token'));
		if (isset($token) && !empty($token) && $token == base64_encode('Cr34t3d_by.H@mZ4h')) {
			$sql = $this->config_model->find(array(
				'select' => array(
					'b.Invoice_Number',
					'a.RESULTMSG',
					'a.PAYMENTDATETIME'
				),
				'from' => 'Logistics_Transactions a',
				'join' => array(
					'Logistics_Invoice b' => array(
						'on' => 'a.TRANSIDMERCHANT=b.Invoice_Number',
						'type' => 'inner'
					),
					'Logistics_POHeader c' => array(
						'on' => 'b.PR_Number=c.PR_Number',
						'type' => 'inner'
					)
				),
				'where' => array(
					'c.BranchCode' => $this->session->userdata('KodeAreaCabang'),
					'a.RESULTMSG' => 'FAILED'
				),
				'or_where' => "c.BranchCode = '".$this->session->userdata('KodeAreaCabang')."' AND a.RESULTMSG = 'SUCCESS'",
				'order_by' => array(
					'a.RecID' => 'desc'
				)
			));

			if ($sql->num_rows()>0) {
				$query['data'] = $sql->result_array();
				$query['count'] = $sql->num_rows();
			} else {
				$query['data'] = '';
				$query['count'] = 0;
			}

			echo json_encode($query);
		} else {
			header("HTTP/1.1 403 Origin Denied");
			exit();
		}
	}

	public function spe_identify()
	{		       
	    	$token = base64_decode($this->input->post('token'));
	    	$PR = base64_decode($this->input->post('PR'));
		    $PR_Date = date('Y-m-d',strtotime(base64_decode($this->input->post('PR_Date'))));
		    $Invoice_Date = base64_decode($this->input->post('Invoice_Date'));
		    $PriceTotal = base64_decode($this->input->post('PriceTotal'));
		    $Discount = base64_decode($this->input->post('Discount'));
		    $Nominal = base64_decode($this->input->post('Nominal'));
		    $Note = base64_decode($this->input->post('Note'));
			$AMOUNT = $this->input->post('AMOUNT');
			$Invoice_Number = $this->config_model->get_invoice();
			$SESSIONID = $this->input->post('SESSIONID');
			$BranchCode = $this->session->userdata('KodeAreaCabang');
			$PAYMENTCHANNEL = base64_decode($this->input->post('PAYMENTCHANNEL'));
			$CHANNEL = base64_decode($this->input->post('CHANNEL'));
			$NAME = $this->input->post('NAME');
			$EMAIL = $this->input->post('EMAIL');
			$REQUESTDATETIME = $this->input->post('REQUESTDATETIME');
			$BASKET = $this->input->post('BASKET');
			//36 Permata : 88560597
			//32 CIMB : 51491079
			//33 Danamon : 89220064
			//29 BCA : 39206597
			if($PAYMENTCHANNEL==29){
				$PAYMENTCODE='39206597';
			} else if($PAYMENTCHANNEL==36){
				$PAYMENTCODE='88560597';
			} else if($PAYMENTCHANNEL==32){
				$PAYMENTCODE='51491079';
			} else if($PAYMENTCHANNEL==33){
				$PAYMENTCODE='89220064';
			}
		 	$cpr = array(
				'select' => array(
					'count(a.RecID) as Total'
				),
				'from' => 'Logistics_Invoice a',
				'where' => array('a.PR_Number'=>$PR),
			);
			$sqlpr = $this->config_model->find($cpr)->row_array();
			if($sqlpr['Total']<1){
			$data = array(
	    		'params' => array(
		    		'TotalPrice' => $PriceTotal,
		    		'Discount' => $Discount,
		    		'PR_Date' => $PR_Date,
		    		'Status' => 1,
		    		'Print_PS' => 0,
		    		'EditDate' => date('Y-m-d H:i:s'),
		    		'EditBy' => $this->session->userdata('Username'),
		    	),
		    	'from' => 'Logistics_POHeader',
				'where' => array('PR_Number'=>$PR),
	    	);
	    	$this->config_model->update($data);
	    	$data2 = array(
	    		'params' => array(
		    		'Invoice_Number' => $Invoice_Number,
		    		'PR_Number' => $PR,
		    		'Invoice_Date' => $Invoice_Date,
		    		'BranchCode' => $this->session->userdata('KodeAreaCabang'),
		    		'Nominal' => $Nominal,
		    		'Invoice_Status' => 1,
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
		    			'Description' => 'Kode Pembayaran : <font color="green">'.$PAYMENTCODE.'00'.$BranchCode.'02'.'</font> - '.$CHANNEL.'',
		    			'CreatedBy' => $this->session->userdata('Username')
		    		),
		    		'from' => 'Logistics_Tracking',
	    		);
	    	$this->config_model->insert($data3);
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
			$data = array(
    			'params' => array(
					'AMOUNT' => $AMOUNT,
					'PURCHASEAMOUNT' => $AMOUNT,
					'TRANSIDMERCHANT' => $Invoice_Number,
					'PAYMENTCHANNEL' => $PAYMENTCHANNEL,
					'SESSIONID' => $SESSIONID,
					'PURCHASECURRENCY' => $this->input->post('PURCHASECURRENCY'),
					'CURRENCY' => $this->input->post('CURRENCY'),
					'PAYMENTCODE' => $PAYMENTCODE.'00'.$BranchCode.'02',
					'CreatedDate' => date("Y-m-d H:i:s"),
					'NAME' => $NAME,
					'EMAIL' => $EMAIL,
					'REQUESTDATETIME' => $REQUESTDATETIME,
					'BASKET' => $BASKET
				),
		    	'from' => 'Logistics_Transactions',
			);
	    	$this->config_model->insert($data);
			echo data_json(array("message"=>"Request Kode Pembayaran Berhasil","notify"=>"success"));
		} else {
			echo data_json(array("message"=>"Request Kode Pembayaran Berhasil","notify"=>"success"));
		}
	}

	function doku_inquiry()
	{
	    $MALLID = $this->input->post('MALLID');
	    $CHAINMERCHANT = $this->input->post('CHAINMERCHANT');
	    $PAYMENTCHANNEL = $this->input->post('PAYMENTCHANNEL');
	    $PAYMENTCODE = $this->input->post('PAYMENTCODE');
	    $WORDS = sha1("$MALLID"."S9SduJM092zc"."$PAYMENTCODE");
		$trx = array(
			'from' => 'Logistics_Transactions a',
			'where' => array('a.PAYMENTCODE'=>$PAYMENTCODE,'a.PAYMENTCHANNEL'=>$PAYMENTCHANNEL,'a.RESULTMSG' => null),
		);
		$sql = $this->config_model->find($trx)->row_array();
		$AMOUNT = $sql['AMOUNT'];
		$TRANSIDMERCHANT = $sql['TRANSIDMERCHANT'];
		$WORDS2 = sha1("$AMOUNT"."3363"."S9SduJM092zc"."TRANSIDMERCHANT");
		$dom = xml_dom();
		$INQUIRY_RESPONSE = xml_add_child($dom, 'INQUIRY_RESPONSE');
		xml_add_child($INQUIRY_RESPONSE, 'PAYMENTCODE', $sql['PAYMENTCODE']);
		xml_add_child($INQUIRY_RESPONSE, 'AMOUNT', $AMOUNT);
		xml_add_child($INQUIRY_RESPONSE, 'PURCHASEAMOUNT', $AMOUNT);
		xml_add_child($INQUIRY_RESPONSE, 'TRANSIDMERCHANT', $TRANSIDMERCHANT);
		xml_add_child($INQUIRY_RESPONSE, 'WORDS', $WORDS2);
		xml_add_child($INQUIRY_RESPONSE, 'REQUESTDATETIME', $sql['REQUESTDATETIME']);
		xml_add_child($INQUIRY_RESPONSE, 'CURRENCY', $sql['CURRENCY']);
		xml_add_child($INQUIRY_RESPONSE, 'PURCHASECURRENCY', $sql['PURCHASECURRENCY']);
		xml_add_child($INQUIRY_RESPONSE, 'SESSIONID', $sql['SESSIONID']);
		xml_add_child($INQUIRY_RESPONSE, 'NAME', $sql['NAME']);
		xml_add_child($INQUIRY_RESPONSE, 'EMAIL', $sql['EMAIL']);
		xml_add_child($INQUIRY_RESPONSE, 'BASKET', $sql['BASKET']);
		xml_add_child($INQUIRY_RESPONSE, 'ADDITIONALDATA', 'Pemesanan Buku');
		header('Content-type: text/xml');
		header('Pragma: public');
		header('Cache-control: private');
		header('Expires: -1');
		echo xml_print($dom);
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
									<td align="left" valign="top" style="font-size:14px;font-weight:bold;color:#00af41;padding-left: 15px;">Detail Pembelian Paket</td>
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
										<span style="font-size:12px;font-weight:bolder;color:#000000;line-height:28px">- - - - -&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									</td>
									<td align="left">
										<span style="font-size:12px;font-weight:bolder;color:#000000;line-height:28px"></span>
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
		$va = '3920659700038402';
		$va2 = '3920659705038402';
		$TRANSIDMERCHANT = 'PG/IV/20/00004';
		//echo substr($va2,8,2);
		if(substr($va2, 8,2) != '05') {
			echo 'BUKU';
		} else {

			 		$arr = array(
						'select' => array(
							'a.SessionID',
							'a.TotalPrice',
							'b.PackDetailName',
							'c.PackName',
							'd.CatName',
							'e.NAME',
							'e.EMAIL',
							'e.AMOUNT'
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
							'Course_Category d' => array(
								'on' => 'c.CatID=d.RecID',
								'type' => 'inner'
							),
							'Logistics_Transactions e' => array(
								'on' => 'a.OrderCode=e.TRANSIDMERCHANT',
								'type' => 'inner'
							),
						),
						'where' => array('a.OrderCode'=>$TRANSIDMERCHANT),
					);
					$sql = $this->config_model->find($arr)->row_array();

					$course = array(
						'params' => array(
							'Status' => 1,
						),
						'from' => 'Course_OrderHeader',
						'where' => array('OrderCode'=>$TRANSIDMERCHANT),
					);
					$this->config_model->update($course);

					require_once(APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php');
					$data = array(
						array(
							'Nama' => $sql['NAME'],
							'Paket' => $sql['CatName'].' - '.$sql['PackName'].' - '.$sql['PackDetailName'],
							'Link' => "<a href='http://pintarbersama.primagama.co.id/info/paket/".$sql['SessionID']."'>klik disini untuk melihat detail paket</a>"
						)
					);

					$data2 = array(
						array(
							'Jumlah Pembayaran' => $this->rupiah($sql['AMOUNT'])/*,
							'Pembayaran 2' => 'Rp. 200000'*/
						)
					);

					$mail             = new PHPMailer();
			        $mail->IsSMTP();
			        $mail->SMTPAuth   = true;
			        $mail->Host       = "smtp.office365.com";
			        $mail->Port       = "587";
			        $mail->Username   = "no-reply@primagama.co.id";
			        $mail->Password   = "Prima.1234";
			        $mail->SetFrom('no-reply@primagama.co.id', 'Auto Reply Primagama');
			        $mail->Subject    = "Primagama - Pembayaran Berhasil";
			        $mail->MsgHTML($this->template_email($data,$data2));
			        $mail->AddAddress($sql['EMAIL'], $sql['NAME']);
			        $mail->AddCC("oni.restu@primagama.co.id", "Helpdesk Primagama");


			        if(!$mail->Send()) {
			        	echo "Mailer Error: " . $mail->ErrorInfo;
			        } else {
			         	echo "Mailer berhasil";
			        }
		}
	}

	public function rupiah($angka){
		
		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;
	 
	}

	public function tesrp() {
		$nom = '10000.0000';
		$hasil_rupiah = $this->rupiah($nom);
		echo $hasil_rupiah;
	}
}