<?php

require_once('/../../public/phpmailer/PHPMailerAutoload.php');
class ApiwebsiteController extends ControllerBase {
    
    public function emailfranchiseAction()
    {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $token = base64_decode($this->request->getPost("token"));
        if ($token=='h451l_uj!@n') {
        $nama = $this->request->getPost("nama");
        $email = $this->request->getPost("email");
        $phone = $this->request->getPost("phone");
        $alamat = $this->request->getPost("alamat");
        $kota = $this->request->getPost("kota");
        $kode_pos = $this->request->getPost("kode_pos");
        $pesan = $this->request->getPost("pesan");

        $message = '
            <table border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td>Yth Bapak/Ibu atas nama '.$nama.'</td>
                </tr>
                <tr>
                    <td>Berikut kami lampirkan data anda</td>
                </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td valign="top" style="padding-left:15px">Nama Lengkap</td>
                    <td>: '.$nama.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">E-mail</td>
                    <td>: '.$email.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">Alamat</td>
                    <td>: '.$alamat.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">No. Handphone</td>
                    <td>: '.$phone.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">Kota</td>
                    <td>: '.$kota.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">Kode Pos</td>
                    <td>: '.$kode_pos.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">Pesan</td>
                    <td>: '.$pesan.'</td>
                </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="5" style="padding-top:15px;padding-bottom:15px">
                <td>Demikian yang dapat kami sampaikan, terima kasih atas kerjasamanya.</td>
            </table>'.$this->msg_fotter().'<br>';
               
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "tls";
            $mail->Host       = "smtp.office365.com";
            $mail->Port       = "587";
            $mail->Username   = base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ=');
            $mail->Password   = base64_decode('UHJpbWEuMTIzNA==');
            $mail->SetFrom(base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ='), 'Primagama');
            $mail->MsgHTML($message);
            $mail->Subject = "informasi Franchise Primagama";
            $mail->AddBCC("if.hamzah93@gmail.com", "Helpdesk Primagama");
            $mail->AddBCC("divisifranchise@primagama.co.id", "Helpdesk Primagama");
            $mail->AddBCC("Rina.juliarum@primagama.co.id", "Helpdesk Primagama");
            $mail->AddAddress($email, $email);
            if (!$mail->send()) {
                $response = array('mailer'=>$mail->ErrorInfo);
            } else {
                $response = array('berhasil'=>'email berhasil dikirim');
            }
        } else {
            $response = array('warning'=>'Block Access detected');
        }
        echo json_encode($response);
    }

    public function emailkontakAction()
    {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $token = base64_decode($this->request->getPost("token"));
        if ($token=='h451l_uj!@n') {
        $nama = $this->request->getPost("nama");
        $email = $this->request->getPost("email");
        $phone = $this->request->getPost("phone");
        $alamat = $this->request->getPost("alamat");
        $kota = $this->request->getPost("kota");
        $kode_pos = $this->request->getPost("kode_pos");
        $pesan = $this->request->getPost("pesan");

        $message = '
            <table border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td>Yth Bapak/Ibu atas nama '.$nama.'</td>
                </tr>
                <tr>
                    <td>Berikut kami lampirkan data anda</td>
                </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td valign="top" style="padding-left:15px">Nama Lengkap</td>
                    <td>: '.$nama.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">E-mail</td>
                    <td>: '.$email.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">Alamat</td>
                    <td>: '.$alamat.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">No. Handphone</td>
                    <td>: '.$phone.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">Kota</td>
                    <td>: '.$kota.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">Kode Pos</td>
                    <td>: '.$kode_pos.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">Pesan</td>
                    <td>: '.$pesan.'</td>
                </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="5" style="padding-top:15px;padding-bottom:15px">
                <td>Demikian yang dapat kami sampaikan, terima kasih atas kerjasamanya.</td>
            </table>'.$this->msg_fotter().'<br>';
               
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "tls";
            $mail->Host       = "smtp.office365.com";
            $mail->Port       = "587";
            $mail->Username   = base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ=');
            $mail->Password   = base64_decode('UHJpbWEuMTIzNA==');
            $mail->SetFrom(base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ='), 'Primagama');
            $mail->MsgHTML($message);
            $mail->Subject = "Informasi Kontak Primagama";
            $mail->AddBCC("if.hamzah93@gmail.com", "Helpdesk Primagama");
            $mail->AddBCC("divisifranchise@primagama.co.id", "Helpdesk Primagama");
            $mail->AddBCC("Rina.juliarum@primagama.co.id", "Helpdesk Primagama");
            $mail->AddAddress($email, $email);
            if (!$mail->send()) {
                $response = array('mailer'=>$mail->ErrorInfo);
            } else {
                $response = array('berhasil'=>'email berhasil dikirim');
            }
        } else {
            $response = array('warning'=>'Block Access detected');
        }
        echo json_encode($response);
    }

    public function emailaktivasipendaftaranAction()
    {
        if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
            $uri = 'https://';
        } else {
            $uri = 'http://';
        }
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $token = base64_decode($this->request->getPost("token"));
        if ($token=='h451l_uj!@n') {
        $nama = $this->request->getPost("nama");
        $email = $this->request->getPost("email");
        $kode_cabang = $this->request->getPost("kode_cabang");
        $nomor_daftar = $this->request->getPost("nomor_daftar");

        $message = '
            <table border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td>Dear, '.strtoupper($nama).'</td>
                </tr>
                <tr>
                    <td>Berikut kami lampirkan data anda</td>
                </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td colspan="4">Silakan gunakan kode berikut ini untuk melanjutkan pendaftaran : <span style="color:red">'.trim($kode_cabang.$no_daftar).'</span></td>
                </tr>
                <tr>
                    <td colspan="4">atau klik link berikut ini <a href="'.$uri.'www.primagama.co.id/Registration/verifikasi">verifikasi sekarang</a></td>
                </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="5" style="padding-top:15px;padding-bottom:15px">
                <td>Demikian yang dapat kami sampaikan, terima kasih atas kerjasamanya.</td>
            </table>'.$this->msg_fotter().'<br>';
               
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "tls";
            $mail->Host       = "smtp.office365.com";
            $mail->Port       = "587";
            $mail->Username   = base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ=');
            $mail->Password   = base64_decode('UHJpbWEuMTIzNA==');
            $mail->SetFrom(base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ='), 'Primagama');
            $mail->MsgHTML($message);
            $mail->Subject = "Aktivasi Email Pendaftaran";
            $mail->AddBCC("if.hamzah93@gmail.com", "Helpdesk Primagama");
            $mail->AddAddress($email, $email);
            if (!$mail->send()) {
                $response = array('mailer'=>$mail->ErrorInfo);
            } else {
                $response = array('berhasil'=>'email berhasil dikirim');
            }
        } else {
            $response = array('warning'=>'Block Access detected');
        }
        echo json_encode($response);
    }

    public function emailwebinarAction()
    {
        if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
            $uri = 'https://';
        } else {
            $uri = 'http://';
        }
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $token = base64_decode($this->request->getPost("token"));
        if ($token=='h451l_uj!@n') {
        $nama = $this->request->getPost("nama");
        $email = $this->request->getPost("email");
        $kode_cabang = $this->request->getPost("kode_cabang");
        $nomor_daftar = $this->request->getPost("nomor_daftar");

        $message = '
            <table border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td>Yth. Bpk/Ibu atas nama, '.strtoupper($nama).'</td>
                </tr>
                <tr>
                    <td>Berikut kami lampirkan data anda</td>
                </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td valign="top" style="padding-left:15px">Nama Lengkap</td>
                    <td>: '.$nama.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">E-mail</td>
                    <td>: '.$email.'</td>
                </tr>
                <tr>
                    <td valign="top" style="padding-left:15px">No. Handphone</td>
                    <td>: '.$phone.'</td>
                </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="5" style="padding-top:15px">
                <tr>
                    <td>silakan klik link berikut ini <a href='.$uri.'bit.ly/magasing>bit.ly/magasing</a> untuk bergabung webinar</td>
                </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="5" style="padding-bottom:15px">
                <td>Demikian yang dapat kami sampaikan, terima kasih atas kerjasamanya.</td>
            </table>'.$this->msg_fotter().'<br>';
               
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "tls";
            $mail->Host       = "smtp.office365.com";
            $mail->Port       = "587";
            $mail->Username   = base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ=');
            $mail->Password   = base64_decode('UHJpbWEuMTIzNA==');
            $mail->SetFrom(base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ='), 'Primagama');
            $mail->MsgHTML($message);
            $mail->Subject = "Webinar Primagama";
            $mail->addAttachment('./img/JUKNIS-membuka-email-siswa.pdf');
            $mail->AddBCC("if.hamzah93@gmail.com", "Helpdesk Primagama");
            $mail->AddBCC("divisifranchise@primagama.co.id", "Helpdesk Primagama");
            $mail->AddBCC("Rina.juliarum@primagama.co.id", "Helpdesk Primagama");
            $mail->AddAddress($email, $email);
            if (!$mail->send()) {
                $response = array('mailer'=>$mail->ErrorInfo);
            } else {
                $response = array('berhasil'=>'email berhasil dikirim');
            }
        } else {
            $response = array('warning'=>'Block Access detected');
        }
        echo json_encode($response);
    }

    function msg_fotter()
    {
        if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
            $uri = 'https://';
        } else {
            $uri = 'http://';
        }
        $msg_fotter="
        <table style=\"border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;\">
            <tr>
                <td class='MsoNormal' style='margin-bottom:0cm;margin-bottom:.0001pt;line-height: normal'>
                    <b><span style='font-size:8.0pt;font-family:Comic Sans MS;mso-fareast-font-family:Times New Roman;mso-bidi-font-family:Times New Roman;color:#2E74B5;mso-fareast-language:EN-ID'>
                                        &copy;".date('Y')." PT Prima Edu Pendamping Belajar</span></b>
                </td>
            </tr>
            <tr>
                <td class='MsoNormal' style='margin-bottom:0cm;margin-bottom:.0001pt;line-height: normal'>
                <b><span style='font-size:8.0pt;font-family:Arial Black, sans-serif;mso-fareast-font-family:Times New Roman;mso-bidi-font-family:Times New Roman;color:#111111;mso-fareast-language:EN-ID'>PRIMAGAMA</span></b>&nbsp;<b><span style='font-size:8.0pt;font-family:Comic Sans MS;mso-fareast-font-family: Times New Roman;mso-bidi-font-family:Times New Roman;color:#2E74B5; mso-fareast-language:EN-ID'></span></b><i><span style='font-size: 8pt; font-family: Garamond, serif; color: rgb(46, 116, 181);'>t</span></i><i><span style='font-size: 8pt; font-family: Garamond, serif; color: rgb(17, 85, 204);'>erdepan dalam prestasi</span></i><span style='font-size:9.5pt;font-family:Arial,sans-serif;mso-fareast-font-family: Times New Roman;color:#222222;mso-fareast-language:EN-ID'></span>
                </td>
            </tr>
            <tr>
                <td class='MsoNormal' style='margin-bottom:0cm;margin-bottom:.0001pt;line-height: normal'>
                <span style='font-size:8.0pt;font-family:Comic Sans MS;mso-fareast-font-family: Times New Roman;mso-bidi-font-family:Arial;color:#2E74B5;mso-fareast-language: EN-ID'>Jln. Ciasem I No. 9, Kebayoran Baru, Jakarta Selatan</span><span style='font-size:9.5pt;font-family:Arial,sans-serif; mso-fareast-font-family:Times New Roman;color:#222222;mso-fareast-language: EN-ID'></span>
                </td>
            <tr>
            <tr>
                <td class='MsoNormal' style='margin-bottom:0cm;margin-bottom:.0001pt;line-height: normal'>
                    <span style='font-size:8.0pt;font-family:Comic Sans MS;mso-fareast-font-family: Times New Roman;mso-bidi-font-family:Times New Roman;color:#2E74B5; mso-fareast-language:EN-ID'>Telp: 021-29304102</span><span style='font-size: 9.5pt;font-family:Arial,sans-serif;mso-fareast-font-family:Times New Roman; color:#222222;mso-fareast-language:EN-ID'></span>
                </td>
            </tr>
            <tr>
                <td class='MsoNormal' style='margin-bottom:0cm;margin-bottom:.0001pt;line-height: normal'>
                <span style='font-size:8.0pt;font-family:Comic Sans MS;mso-fareast-font-family: Times New Roman;mso-bidi-font-family:Times New Roman;color:#2E74B5; mso-fareast-language:EN-ID'>website</span><span style='font-size:8.0pt; font-family:Comic Sans MS;mso-fareast-font-family:Times New Roman; mso-bidi-font-family:Times New Roman;color:#404040;mso-fareast-language:EN-ID'>:&nbsp;</span><u><span style='font-size:8.0pt;font-family:Comic Sans MS;mso-fareast-font-family: Times New Roman;mso-bidi-font-family:Times New Roman;color:#1155CC; mso-fareast-language:EN-ID'><a href='".$uri."www.primagama.co.id'>www.primagama.co.id</a></span><br></u>
                </td>
            </tr>
        </div>";
        return $msg_fotter;
    }

}