<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('config_model');
    } 

	public function index()
	{	
		$this->load->view('Course/index');
	}
	
	public function detail()
	{
		$this->load->view('Course/detail');
	}

	public function get_category()
	{
        $arr = array(
            'from' => 'Course_Category a',
            'order_by' => array('a.RecID' => '')
        );
        $sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function get_pack()
	{
        $arr = array(
			'select' => array(
				'b.RecID',
				'b.PackName',
				'b.Description',
				'b.Price',
				'a.CatName',
				'a.TotalStudents as Tot',
				'b.bgimage',
				'c.PriceDetail'
			),
            'from' => 'Course_Category a',
			'join' => array(
				'Course_Pack b' => array(
					'on' => 'a.RecID=b.CatID',
					'type' => 'inner'
				),
				'Course_PackDetail c' => array(
					'on' => 'b.RecID=c.PackID',
					'type' => 'inner'
				),
			),
            'where' => array('a.RecID' => base64_decode($this->input->post('id')), 'c.ShowPrice' => 1),
            'order_by' => array('a.RecID' => '')
        );
        $sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}
	
	public function checkout()
	{
		$id = base64_decode($this->input->post('id'));
        $arr = array(
            'from' => 'Course_Category a',
			'join' => array(
				'Course_Pack b' => array(
					'on' => 'a.RecID=b.CatID',
					'type' => 'inner'
				),
			),
            'where' => array('b.RecID' => $id),
        );
		$query = $this->config_model->find($arr)->row_array();
		$data['PackName'] = $query['CatName'].' - '.$query['PackName']; 
		$data['PackName2'] = $query['PackName'].' - '.$query['CatName']; 
		$data['price'] = $query['Price']; 
		$data['totstu'] = $query['TotalStudents']; 
		$data['stagecat'] = $query['StageCat']; 
		$data['id'] = $id;
		$this->load->view('Course/checkout',$data);
	}

	public function save_ordertmp()
	{
		$SessionID = base64_decode($this->input->post('session'));
		$PackDetailID = base64_decode($this->input->post('idpackdetail'));
		$MeetNumber = base64_decode($this->input->post('meetnumber'));

		$JumlahMapel = base64_decode($this->input->post('jumlahmapel'));
		$SubID = base64_decode($this->input->post('idsub'));
		$Referal = base64_decode($this->input->post('Referal'));

		//validai data sudah ada update / insert
        $arr = array(
            'from' => 'Course_OrderDetailTmp',
            'where' => array('SessionID'=>$SessionID,'PackDetailID'=>$PackDetailID,'MeetNumber'=>$MeetNumber),
        );
		$query = $this->config_model->find($arr);

		//validasi batas jumlah mapel
        $arr2 = array(
        	'select' => array(
						'SubID',
						'SessionID',
						'PackDetailID'
        	),
            'from' => 'Course_OrderDetailTmp',
            'where' => array('SessionID'=>$SessionID,'PackDetailID'=>$PackDetailID),
			'group_by' => array(
						'SubID',
						'SessionID',
						'PackDetailID'
					),
        );
		$query2 = $this->config_model->find($arr2);
		$CountMapel = $query2->num_rows();

		//validai cek mapel
        $arr3 = array(
            'from' => 'Course_OrderDetailTmp',
            'where' => array('SessionID'=>$SessionID,'PackDetailID'=>$PackDetailID,'SubID'=>$SubID),
        );
		$query3 = $this->config_model->find($arr3);
		$CekMapel = $query3->num_rows();

		if($query->num_rows() <= 0) {
			if($CountMapel < $JumlahMapel OR $CekMapel != 0) {
				$data = array(
					'params' => array(
						'SubID' => $SubID,
						'SessionID' => $SessionID,
						'PackID' => base64_decode($this->input->post('packid')),
						'MeetNumber' => $MeetNumber,
						'ScheduleDate' => date('Y-m-d',strtotime(base64_decode($this->input->post('date')))),
						'ScheduleTime' => base64_decode($this->input->post('time')),
						'PackDetailID' => $PackDetailID,
						'PriceDetail' => base64_decode($this->input->post('pricefix')),
						'PriceTot' => base64_decode($this->input->post('pricefixtot')),
						'CreatedDate'=> date('Y-m-d H:i:s'),
					),
					'from' => 'Course_OrderDetailTmp',
				);
				$this->config_model->insert($data);

				$datasche = array(
			    	'params' => array(
						'Status' => 1,
				    ),
				    'from' => 'Course_Schedule',
	            	'where' => array(
	            		'BranchCode'=>$Referal,
	            		'SubID'=>$SubID,
	            		'TimeFrom' => base64_decode($this->input->post('time')),
	            		'Date' => date('Y-m-d',strtotime(base64_decode($this->input->post('date'))))
	            	),
			    );
			    $this->config_model->update($datasche);

				echo data_json(array("message"=>"Berhasil pilih jadwal.","notify"=>"success"));
			} else {
				echo data_json(array("message"=>"Jumlah Mapel Melebihi Batas.","notify"=>"danger"));
			}
		} else {
			if($CountMapel < $JumlahMapel OR $CekMapel != 0) {
				$data = array(
			    	'params' => array(
						'SubID' => base64_decode($this->input->post('idsub')),
						'PackID' => base64_decode($this->input->post('packid')),
						'ScheduleDate' => date('Y-m-d',strtotime(base64_decode($this->input->post('date')))),
						'ScheduleTime' => base64_decode($this->input->post('time')),
						'PriceDetail' => base64_decode($this->input->post('pricefix')),
						'PriceTot' => base64_decode($this->input->post('pricefixtot')),
						'CreatedDate'=> date('Y-m-d H:i:s'),
				    ),
				    'from' => 'Course_OrderDetailTmp',
	            	'where' => array('SessionID'=>$SessionID,'PackDetailID'=>$PackDetailID,'MeetNumber'=>$MeetNumber),
			    );
			    $this->config_model->update($data);

				$datasche = array(
			    	'params' => array(
						'Status' => 1,
				    ),
				    'from' => 'Course_Schedule',
	            	'where' => array(
	            		'BranchCode'=>$Referal,
	            		'SubID'=>$SubID,
	            		'TimeFrom' => base64_decode($this->input->post('time')),
	            		'Date' => date('Y-m-d',strtotime(base64_decode($this->input->post('date'))))
	            	),
			    );
			    $this->config_model->update($datasche);
				echo data_json(array("message"=>"Berhasil ubah jadwal.","notify"=>"success"));
			} else {
				echo data_json(array("message"=>"Jumlah Mapel Melebihi Batas.","notify"=>"danger"));
			}
		}

		/*if($msg==true){
			echo data_json(array("message"=>"Berhasil pilih jadwal.","notify"=>"success"));
		} else {
			echo data_json(array("message"=>"Gagal pilih jadwal.","notify"=>"warning"));
		}*/
/*		$sesid = $this->input->post('session');
        $arr = array(
            'from' => 'Course_OrderDetailTmp a',
			'join' => array(
				'Course_Subjects b' => array(
					'on' => 'a.SubID=b.RecID',
					'type' => 'left'
				),
			),
            'where' => array('a.SessionID' => $sesid),
        );
        $sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);*/
	}

	public function del_ordertmp()
	{
		$this->config_model->delete(array(
			'from' => 'Course_OrderDetailTmp',
			'where' => array('SubID' => base64_decode($this->input->post('id')), 'SessionID' => $this->input->post('session'))
		));

		$sesid = $this->input->post('session');
        $arr = array(
            'from' => 'Course_OrderDetailTmp a',
			'join' => array(
				'Course_Subjects b' => array(
					'on' => 'a.SubID=b.RecID',
					'type' => 'left'
				),
			),
            'where' => array('a.SessionID' => $sesid),
        );
        $sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function get_sesi()
	{
		$packid = base64_decode($this->input->post('packid'));
        $arr = array(
            'from' => 'Course_PackDetail a',
            'where' => array('a.PackID' => $packid),
        );
        $sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function get_packdetail()
	{
		$id = base64_decode($this->input->post('id'));
        $arr = array(
        	'select' => array(
        		'a.RecID',
        		'a.PackID',
        		'a.PackDetailName',
        		'a.PriceDetail',
        		'a.TotalMeet','b.PackName',
        		'b.StageCat',
        		'c.TotalStudents',
        		'b.TotalSub',
        		'b.CatID'
        	),
            'from' => 'Course_PackDetail a',
			'join' => array(
				'Course_Pack b' => array(
					'on' => 'a.PackID=b.RecID',
					'type' => 'inner'
				),
				'Course_Category c' => array(
					'on' => 'b.CatID=c.RecID',
					'type' => 'inner'
				),
			),
            'where' => array('a.RecID' => $id),
        );
        $sql = $this->config_model->find($arr);
		if ($sql->num_rows()>0) {
			$data['rows'] = $sql->result_array();
		} else {
			$data['rows'] = 0;
		}
		echo json_encode($data);
	}

	public function get_stage($id)
	{
		$arr = array(
				'from' => 'Student_Stage',
				'where' => array('StageCat' => $id),
			);

		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function get_mapel($StageCat)
	{
        $arr = array(
            'from' => 'Course_Subjects a',
            'where' => array('a.StageCat' => $StageCat),
        );
		$item = $this->config_model->find($arr);		
		$data = $item->result_array();
		echo json_encode($data);
	}

	public function get_jadwal()
	{
		$id = base64_decode($this->input->post('id'));
		$Referal = base64_decode($this->input->post('Referal'));
        $arr = "SELECT * From (
					Select b.RecID,a.ScheduleName as IDTem,b.Date from Course_ScheduleTemplate a
					inner join Course_Schedule b On a.RecID=b.ScheduleTemplateID
					where b.SubID='$id' and Status is null --and BranchCode = '$Referal' --and b.Date <= '2020-04-13'
					group by a.ScheduleName, b.Date,b.RecID
				)src
				pivot
				(
					count(RecID)
					for IDTem in ([Jam1],[Jam2],[Jam3],[Jam4],[Jam5],[Jam6],[Jam7])
				) piv";
        $sql = $this->db->query($arr);

        $arr2 = array(
            'from' => 'Course_Subjects a',
            'where' => array('a.RecID' => $id),
        );
        $sql2 = $this->config_model->find($arr2);
        $resultsql2 = $sql2->row_array();


		if ($sql2->num_rows()>0) {
			$data['rows'] = $sql->result_array();
			$data['SubName'] = $resultsql2['SubName'];
		} else {
			$data['rows'] = 0;
			$data['SubName'] = $sql2['SubName'];
		}
		echo json_encode($data);
	}

	public function cek_referal()
	{

		$Referal = base64_decode($this->input->post('Referal'));
        $arr3 = array(
            'from' => 'Course_Referal a',
            'where' => array('a.ReferalCode' => $Referal),
        );
        $sql3 = $this->config_model->find($arr3);

		if ($sql3->num_rows()>0) {
			$data['rows3'] = $sql3->result_array();
		} else {
			$data['rows3'] = 0;
		}
		echo json_encode($data);
	}

	public function save_order()
	{
		$Nama = base64_decode($this->input->post('Nama'));
		$Email = base64_decode($this->input->post('Email'));
		$Sekolah = base64_decode($this->input->post('Sekolah'));
		$NoHp = base64_decode($this->input->post('NoHp'));
		$Jenjang = base64_decode($this->input->post('Jenjang'));
		$Referal = base64_decode($this->input->post('Referal'));
		$SessionID = base64_decode($this->input->post('sesid'));
		$arr2 = array(
			'params' => array(
				'Name' => $Nama,
				'Email' => $Email,
				'School' => $Sekolah,
				'PhoneNumber' => $NoHp,
				'SessionID' => $SessionID,
				//'OrderCode' => $this->config_model->get_ordercode(),
			),
			'from' => 'Course_OrderStudent',
		);
		$msg2 = $this->config_model->insert($arr2);
		if ($msg2==true) {
			echo data_json(array("message"=>" Berhasil disimpan.","notify"=>"success"));
		} else {
			echo data_json(array("message"=>" gagal disimpan.","notify"=>"warning"));
		}
	}

	public function save_orderheader()
	{

		$TotalPrice = base64_decode($this->input->post('TotalPrice'));
		$PackDetailID = base64_decode($this->input->post('PackDetailID'));
		$Referal = base64_decode($this->input->post('Referal'));
		$StageCode = base64_decode($this->input->post('StageCode'));
		$SessionID = base64_decode($this->input->post('SessionID'));
		$OrderCode = $this->config_model->get_ordercode();
		$arr2 = array(
			'params' => array(
				'TotalPrice' => $TotalPrice,
				'PackDetailID' => $PackDetailID,
				'ReferalCode' => $Referal,
				'StageCode' => $StageCode,
				'SessionID' => $SessionID,
				'OrderCode' => $OrderCode,
				'CreatedDate'=> date('Y-m-d H:i:s'),
			),
			'from' => 'Course_OrderHeader',
		);
		$msg2 = $this->config_model->insert($arr2);

		$arr = "INSERT INTO Course_OrderDetail ( PackDetailID, SubID, MeetNumber, PriceDetail, DateSchedule,TimeFromSchedule, SessionID)
			SELECT  a.PackDetailID, a.SubID, a.MeetNumber, a.PriceDetail, a.ScheduleDate, a.ScheduleTime, SessionID
			FROM    Course_OrderDetailTmp a
			WHERE a.SessionID = '$SessionID' AND PackDetailID = '$PackDetailID'";
        $sql = $this->db->query($arr);
		
		$PAYMENTCODE = '39206597';
		$REQUESTDATETIME = $this->input->post('REQUESTDATETIME');
		$NAME = $this->input->post('NAME');
		$EMAIL = $this->input->post('EMAIL');
		$BASKET = $this->input->post('BASKET');
		$BASKET = $this->input->post('BASKET');
		$KODE = $this->input->post('RANDOMNUMBER');//6 digit
		$data = array(
    		'params' => array(
				'AMOUNT' => $this->input->post('AMOUNT'),
				'PURCHASEAMOUNT' => $this->input->post('AMOUNT'),
				'TRANSIDMERCHANT' => $OrderCode,
				'PAYMENTCHANNEL' => 29,
				'SESSIONID' => $SessionID,
				'PURCHASECURRENCY' => $this->input->post('PURCHASECURRENCY'),
				'CURRENCY' => $this->input->post('CURRENCY'),
				'PAYMENTCODE' => $PAYMENTCODE.'05'.$KODE,
				'CreatedDate' => date("Y-m-d H:i:s"),
				'NAME' => $NAME,
				'EMAIL' => $EMAIL,
				'REQUESTDATETIME' => $REQUESTDATETIME,
				'BASKET' => $BASKET
			),
		  		'from' => 'Logistics_Transactions',
		);
	    $this->config_model->insert($data);
		echo data_json(array("message"=>" Berhasil disimpan 2.","notify"=>"success"));

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

	public function tesemail()
	{
		require_once(APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php');
		$data = array(
			array(
				'Nama' => 'Oni',
				'Paket' => 'Privat'
			)
		);

		$data2 = array(
			array(
				'Jumlah Pembayaran' => 'Rp. 10000'/*,
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
        $mail->AddAddress('oni.pamuji@gmail.com', 'Oni');
        $mail->AddCC("oni.restu@primagama.co.id", "Helpdesk Primagama");


        if(!$mail->Send()) {
        	echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
         	echo "Mailer berhasil";
        }
	}

	public function test()
	{
		echo base_url();
	}

}