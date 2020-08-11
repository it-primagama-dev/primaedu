<?php defined('BASEPATH') OR exit('No direct script access allowed');

class stpayment extends CI_Controller {
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

	public function doku_notify()
	{
	  	#check if IP ADDRESS request != DOKU IP
		/*if($this->input->ip_address() != '103.10.129.7' OR $this->input->ip_address() != '103.10.129.8' OR $this->input->ip_address() != '103.10.129.9' OR $this->input->ip_address() != '103.10.129.20'){*/
		if(/*$this->input->ip_address() != '103.10.129.9' AND */$this->input->ip_address() != '103.10.130.75'){
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
		$WORDS_GENERATED = sha1("$AMOUNT"."8087"."FLdaGUv0YL8gin"."$TRANSIDMERCHANT"."$RESULTMSG"."$VERIFYSTATUS");
	       
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

		    		//validasi email lebih dari 1x
					$cekstatus = array(
						'select' => array(
							'Count(RecID) as JML'
						),
						'from' => 'Logistics_Transactions',
						'where' => array('TRANSIDMERCHANT'=>$TRANSIDMERCHANT,'RESULTMSG'=>'SUCCESS'),
					);
					$cekstatus = $this->config_model->find($cekstatus)->row_array();
					if($cekstatus['JML']==0){

					//notif ke telegram
						$teledata = "<strong>Horeee ".$sql['NAME']." sudah berhasil membayar Paket ".$sql['CatName']." - ".$sql['PackName']." - ".$sql['PackDetailName'].". . .</strong>\n\n<a href='http://pintarbersama.primagama.co.id/info/paket/".$sql['SessionID']."'>Klik Disini Untuk Lihat Detail</a>";
						$data = $this->telegram_lib->sendmsg($teledata);

					//notif ke email
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

	function doku_inquiry()
	{
		/*if($this->input->ip_address() != '103.10.130.75'){
	      echo "IP NOT ALLOWED";
	      die;
	  	} else {*/
	    $MALLID = $this->input->post('MALLID');
	    $CHAINMERCHANT = $this->input->post('CHAINMERCHANT');
	    $PAYMENTCHANNEL = $this->input->post('PAYMENTCHANNEL');
	    $PAYMENTCODE = $this->input->post('PAYMENTCODE');
	    $WORDS = sha1("$MALLID"."FLdaGUv0YL8gin"."$PAYMENTCODE");
		$trx = array(
			'from' => 'Logistics_Transactions a',
			'where' => array('a.PAYMENTCODE'=>$PAYMENTCODE,'a.PAYMENTCHANNEL'=>$PAYMENTCHANNEL,'a.RESULTMSG' => null),
		);
		$sql = $this->config_model->find($trx)->row_array();
		$AMOUNT = $sql['AMOUNT'];
		$TRANSIDMERCHANT = $sql['TRANSIDMERCHANT'];
		$WORDS2 = sha1("$AMOUNT"."8087"."FLdaGUv0YL8gin"."TRANSIDMERCHANT");
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
		/*}*/
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
		$TRANSIDMERCHANT = 'PG/IV/20/00009';
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

		    		//validasi email lebih dari 1x
					$cekstatus = array(
						'select' => array(
							'Count(RecID) as JML'
						),
						'from' => 'Logistics_Transactions',
						'where' => array('TRANSIDMERCHANT'=>$TRANSIDMERCHANT,'RESULTMSG'=>'SUCCESS'),
					);
					$cekstatus = $this->config_model->find($cekstatus)->row_array();
					if($cekstatus['JML']==0){

					//notif ke telegram
					$teledata = "<strong>Horeee ".$sql['NAME']." sudah berhasil membayar Paket ".$sql['CatName']." - ".$sql['PackName']." - ".$sql['PackDetailName'].". . .</strong>\n\n<a href='http://pintarbersama.primagama.co.id/info/paket/".$sql['SessionID']."'>Klik Disini Untuk Lihat Detail</a>";
					$data = $this->telegram_lib->sendmsg($teledata);

				    //Notif ke email
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
			        $mail->Password   = "Prima.2020";
			        $mail->SetFrom('no-reply@primagama.co.id', 'Auto Reply Primagama');
			        $mail->Subject    = "Primagama - Pembayaran Berhasil";
			        $mail->MsgHTML($this->template_email($data,$data2));
			        $mail->AddAddress('oni.restu@primagama.co.id', $sql['NAME']);
			        $mail->AddCC("oni.restu@primagama.co.id", "Helpdesk Primagama");


			        if(!$mail->Send()) {
			        	echo "Mailer Error: " . $mail->ErrorInfo;
			        } else {
			         	echo "Mailer berhasil";
			        }
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