<?php
 
                                require_once('/phpmailer/PHPMailerAutoload.php');
                                $mail = new PHPMailer;
 
                                $mail->isSMTP();
                                $mail->Host = 'smtp.office365.com'; 
                                $mail->SMTPAuth = true;
				$mail->SMTPSecure = "tls"; 
                                $mail->Username = 'noreply@primagama.co.id'; 
					
                                $mail->Password = 'Prima.1234'; 
                                $mail->Port = 587; //port tidak usah di ubah, biarkan 587
                               
                                $name = "Quality Control Soal";
                                $mail->setFrom('noreply@primagama.co.id', 'Konfirmasi Soal SIAPCBT Primagama'); //email pengirim
                                $mail->addAddress('oni.restu14@gmail.com', $name); //email penerima
                                $mail->isHTML(true);
 
                                ///atur pesan email disini
                                $mail->Subject = 'Konfirmasi Soal SIAPCBT Primagama';
                                $mail->Body    = "TEST"; //HTML Body
                               
                                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';                                                           
                                                                                               
                                if(!$mail->send()) {
                                                echo 'Email tidak terkirim';
                                                echo 'Jaringan Error: ';
						echo "Mailer Error: " . $mail->ErrorInfo;
                                } else {
                                                echo 'Email terkirim, silahkan buka email anda';
                                }      

?>

<?php echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n"; ?>