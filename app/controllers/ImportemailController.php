<?php
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
require_once('/../../public/phpmailer/PHPMailerAutoload.php');
require_once __DIR__ . '/../../vendor/PHPExcel/PHPExcel.php';
//set_time_limit(0);
ini_set('max_execution_time', 7200); // 2 jam
class ImportemailController extends ControllerBase {

 
protected $auth;

    public function initialize() {
        $this->tag->setTitle("Import Email");
        parent::initialize();        

        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }

    /* hari indonesia */
    function indo_hari($hari = '') {
        $day = date('D', strtotime($hari));
        $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );
        return $dayList[$day];
    }

    function get_indo_bulan($bln = '') {
        $data = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        if (empty($bln)) {
            return $data;
        } else {
            $bln = (int)$bln;
            return $data[$bln];
        }
    }

    function tgl_indo($tgl = '') {
        if (!empty($tgl)) {
            $pisah = explode('-', $tgl);
            return $pisah[2].' '.$this->get_indo_bulan($pisah[1]).' '.$pisah[0];
        }
    }

    public function indexAction() {
        $laporan =  broadcashemail::query()
            ->columns(array("RecID,KodeCabang,NoVa,NamaSiswa,EmailEksternal,EmailInternal,Password,Status,TanggalImport"))
            ->orderBy("RecID DESC")
            ->where("Status = '0'")
            ->execute();
        $this->view->page = $laporan;

	$sudahkirim =  broadcashemail::query()
            ->columns(array("RecID,KodeCabang,NoVa,NamaSiswa,EmailEksternal,EmailInternal,Password,Status,TanggalImport"))
            ->orderBy("RecID DESC")
            ->where("Status = '1'")
            ->execute();
        $this->view->result = $sudahkirim;
    }
    
    public function importAction() {
        $this->persistent->parameters = null;
        if($this->request->isPost()){
            if($this->request->hasFiles() == FALSE){
                $this->flash->error("Pilih File Excel");
                return;
            }else{
                $trans["countNotOK"]=0;
                $trans["countdup"]=0;
                $trans["countOK"]=0;
                $trans["countauto"]=0;
                $fileUpload = $this->request->getUploadedFiles()[0];
                if ($fileUpload->getExtension() == "xlsx") {
                    try {
                        $dataExcel = $this->excel->readEmail($fileUpload);
                        foreach ($dataExcel AS $key => $value) {

                            $NomorVa = $value['NomorVa'];
			    $KodeCabang = substr($value['NomorVa'], -20,4);
                            $NamaSiswa = $value['NamaSiswa'];
                            $EmailInternal = $value["EmailInternal"];
                            $Password =$value["Password"];
                            $Status = '0';
                            $TanggalImport = $this->request->getPost("Tanggal");
                            
                            $sql = "select siswa.EmailSiswa,areacabang.KodeAreaCabang from siswa join areacabang on siswa.Cabang=areacabang.RecID where CONCAT(LTRIM(RTRIM(areacabang.KodeAreaCabang)),siswa.VirtualAccount) = '$NomorVa'";
                            $query = $this->getDI()->getShared('db')->query($sql);
                            $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
                            $result = $query->fetchAll($query);
                            foreach ($result as $row) {
                                $EmailEksternal = $row->EmailSiswa;
                            }
                            $phql   = "INSERT INTO broadcashemail (KodeCabang,NoVa,NamaSiswa,EmailEksternal,EmailInternal,Password,Status,TanggalImport)"."values"."('$KodeCabang','$NomorVa','$NamaSiswa','$EmailEksternal','$EmailInternal','$Password','$Status','$TanggalImport')";

                        $db = $this->getDI()->get('db');
                            if (!$db->execute($phql)){
                                $this->db->rollback(); 
                                $trans["countNotOK"]++;
                                return $this->response->redirect("importemail/import");
                            } else {
                                $trans["countOK"]++;
                            }
                        }
                    } catch (Exception $e) {
                        $this->flash->error("Import data excel gagal");
                        return $this->response->redirect("importemail/import");
                        $trans["countdup"]++;
                    }
                }
                $this->flash->success("Import berhasil.<br> gagal: ".$trans["countNotOK"]."
                duplikat: ".$trans["countdup"]."
                berhasil: ".$trans["countOK"]);
                return $this->response->redirect("importemail/index");
            }
        }
    }

    public function sendmailAction() {
        $this->tag->setTitle("Data Siswa");

        if(count($_POST['checkbox']) < 1) {
            ?>
                <meta http-equiv='refresh' content='0; url=index'>
                <script type="text/javascript">
                    alert("Tidak ada data yang terpilih...!!!");
                </script>
            <?php
        } else {
            if (isset($_POST['kirim'])) {
                $id=$_POST['checkbox'];
                $N = count($id);
                for($i=0; $i <= $N; $i++) {
                    $sql2 = "SELECT * from broadcashemail where RecID = '".$id[$i]."'";
                    $query2 = $this->getDI()->getShared('db')->query($sql2);
                    $query2->setFetchMode(Phalcon\Db::FETCH_OBJ); 
                    $numRows = $query2->numRows();
                    $temp = $query2->fetchAll($query2);
                    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                        $uri = 'https://';
                    } else {
                        $uri = 'http://';
                    }

                    foreach($temp as $rows) {

                    $mail = new PHPMailer();
                    $message="
                    <div>
                        <table style=\"border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;\">
                            <tr>
                                <td>Kepada Yth : </td>
                            </tr>
                            <tr>
                                <td>".$rows->NamaSiswa."</td>
                            </tr>
                        </table>
                        <br>
                        <table style=\"border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;\">
                            <tr>
                                <td>Salam Smart,</td>
                            </tr>
                        </table>
                        <br>
                        <table style=\"border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;\">
                            <tr>
                                <td>Selamat bergabung bersama Primagama, untuk menjadi bagian dari ''Smart Generation'' yang selalu unggul dalam prestasi.
                                </td>
                            </tr>
                        </table>
                        <br>
                        <table style=\"border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;\">
                            <tr>
                                <td>Sebagai siswa Primagama, ".$rows->NamaSiswa." mendapatkan fasilitas Windows 10
                                (original) dan Program Microsoft Office 365 yang akan memudahkan Adik dalam belajar dan
                                selalu terhubung dengan Instruktur Smart terbaik di Primagama.
                                </td>
                            </tr>
                        </table>
                        <br>
                        <table style=\"border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;\">
                            <tr>
                                <td>Sebagai siswa Primagama, ".$rows->NamaSiswa." juga mendapatkan alamat email: <b>".$rows->EmailInternal."</b> yang  selain menjadi media komunikasi, alamat e-mail tersebut akan dipergunakan untuk melakukan registrasi dalam mendapatkan product key Windows 10, serta untuk login di Microsoft Office 365.
                                </td>
                            </tr>
                        </table>
                        <br>
                        <table style=\"border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;\">
                            <tr>
                                <td>Temporary Password untuk e-mail Adik adalah <b>".$rows->Password."</b> Mohon agar dapat dirubah pada kesempatan pertama, untuk memastikan keamanan serta kenyamanan Adik.
                                </td>
                            </tr>
                        </table>
                        <br>
                        <table style=\"border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;\">
                            <tr>
                                <td>Terlampir adalah petunjuk teknis tentang cara mendapatkan Windows 10  dan Microsoft Office 365.
                                </td>
                            </tr>
                        </table>
                        <br>
                        <table style=\"border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;\">
                            <tr>
                                <td>Jika ada pertanyaan lebih lanjut tentang program ini, silakan kirim email ke: helpdesk@primagama.co.id untuk mendapatkan bimbingan dan panduan.
                                </td>
                            </tr>
                        </table>
                        <br>
                        <table style=\"border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;\">
                            <tr>
                                <td>Selamat datang Generasi Millenial,  raihlah prestasi lebih tinggi dan sukses bersama Primagama.
                                </td>
                            </tr>
                        </table>
                        <br>
                        <table style=\"border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;\">
                            <tr>
                                <td>Salam<br> Primagama</td>
                            </tr>
                        </table>
                    </div>
                    <br>";

                    $mail->IsSMTP();
                    $mail->SMTPDebug  = 0;
                    $mail->SMTPAuth   = true;
                    $mail->SMTPSecure = "tls";
                    $mail->Host       = "smtp.office365.com";
                    $mail->Port       = "587";
                    $mail->Username   = base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ=');
                    $mail->Password   = base64_decode('UHJpbWEuMTIzNA==');
                    $mail->SetFrom(base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ='), 'Primagama');
                    $mail->Subject    = "Windows 10 Education dan Microsoft Office 365 for student";
                    $mail->MsgHTML($message);
                    $mail->AddAddress($rows->EmailEksternal, $rows->NamaSiswa);
                    //$mail->AddCC("if.hamzah93@gmail.com", "Helpdesk Primagama"); //masukkan cc
                    $mail->addBCC("blast@primagama.co.id", "Helpdesk Primagama");
                    $mail->addAttachment('./img/Panduan-Registrasi-Windows-10-Edu-Primagama.pdf');
                    $mail->addAttachment('./img/JUKNIS-membuka-email-siswa.pdf');
                    
                        if (!$mail->send()) {
                            $pesan = "Mailer Error: " . $mail->ErrorInfo;
                        }
                        else
                        {
                            unset($mail);
                            $pesan = "Pesan berhasil dikirim ke ".$N." email";
                            $this->db->execute("UPDATE broadcashemail SET Status = '1' WHERE RecID = '".$rows->RecID."' AND Status = '0'");
                        }
                    } 
                    //foreach($temp as $rows)
                } //for($i=0; $i <= $N; $i++) {
                ?>
                <meta http-equiv='refresh' content='0; url=index'>
                <script type="text/javascript">
                    alert("<?php echo $pesan; ?>");
                </script>
                <?php
                if ($mail->send()) {
                    ?>
                    <meta http-equiv='refresh' content='0; url=index'>
                    <script type="text/javascript">
                        alert("<?php echo $pesan; ?>");
                    </script>
                    <?php
                } else {
                    ?>
                    <meta http-equiv='refresh' content='0; url=index'>
                    <script type="text/javascript">
                        alert("Data gagal dikirim..!!!");
                    </script>
                    <?php
                }
            } else {
                $id=$_POST['checkbox'];
                $N = count($id);
                for($i=0; $i < $N; $i++) {
                    $sqlemail = "DELETE FROM broadcashemail WHERE RecID = '".$id[$i]."'";
                    $queryemail = $this->getDI()->getShared('db')->query($sqlemail);
                    $queryemail->setFetchMode(Phalcon\Db::FETCH_OBJ);
                }
                if (!$queryemail) {
                    ?>
                    <meta http-equiv='refresh' content='0; url=index'>
                    <script type="text/javascript">
                        alert("Data yang terpilih gagal dihapus..!!!");
                    </script>
                    <?php
                } else {
                    ?>
                    <meta http-equiv='refresh' content='0; url=index'>
                    <script type="text/javascript">
                        alert("Data yang terpilih berhasil dihapus..!!!");
                    </script>
                    <?php
                }
            }
        }
    }

    function excelAction() {
        // Load plugin PHPExcel nya
        //require_once 'PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        // Settingan awal file excel
        $excel->getProperties()->setCreator('HAMZAH')
                     ->setLastModifiedBy(date("Y-m-d"))
                     ->setTitle("Laporan Import Email")
                     ->setSubject("Laporan Import Email")
                     ->setDescription("Laporan Semua Data Info Import Email")
                     ->setKeywords("Data Import Email");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
          'font' => array('bold' => true), // Set font nya jadi bold
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA IMPORT EMAIL SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai F1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "No."); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "Kode Cabang"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "No. Va"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "Nama Siswa"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Email Eksternal"); // Set kolom E3 dengan tulisan "TELEPON"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Email Internal"); // Set kolom F3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "Password"); // Set kolom F3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "Dikirm"); // Set kolom F3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "Tanggal Import"); // Set kolom F3 dengan tulisan "ALAMAT"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);

        // Set height baris ke 1, 2 dan 3
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

        // Buat query untuk menampilkan semua data siswa
        $sql2 = "SELECT * from broadcashemail where Status = '1'";
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ); 
        $numRows = $query2->numRows();
        $temp = $query2->fetchAll($query2);
        $this->view->disable();
        
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($temp as $data) { // Ambil semua data dari hasil eksekusi $sql
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
          $excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $data->KodeCabang, PHPExcel_Cell_DataType::TYPE_STRING);
          // Khusus untuk no telepon. kita set type kolom nya jadi STRING
          $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$numrow, $data->NoVa, PHPExcel_Cell_DataType::TYPE_STRING);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->NamaSiswa);
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->EmailEksternal);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->EmailInternal);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->Password);
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, 'YA');
          $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $this->tgl_indo($data->TanggalImport));
          
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
          $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
          
          $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
          
          $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(40); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(40); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(7); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(25); // Set width kolom F

        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Import Email");
        $excel->setActiveSheetIndex(0);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Import Email '.date("Y-m-d").'.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

function tesemailAction() {
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = "outlook.office365.com";
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 587;
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication
        $mail->Username = "noreply@primagama.co.id";
        //Password to use for SMTP authentication
        $mail->Password = "Prima.1234";
        //Set who the message is to be sent from
        $mail->setFrom('noreply@primagama.co.id', 'First Last');
        //Set who the message is to be sent to
        $recipients = array(
        'if.hamzah93@gmail.com' => 'if.hamzah93@gmail.com'
        //'hamzahkerenz43@gmail.com' => 'hamzahkerenz43@gmail.com',
        //'masnaini96@gmail.com' => 'masnaini96@gmail.com',
        //'hamzah@primagama.co.id' => 'hamzah@primagama.co.id',
        //'megi.afrila92@gmail.com' => 'megi.afrila92@gmail.com'
        );

        foreach($recipients as $emailku => $name) {
            $mail->addAddress($emailku, $name);
        }
                
        //Set the subject line
        $mail->Subject = 'PHPMailer SMTP test';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->Body = 'hello';
        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        $mail->SMTPSecure = "tls";
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }
    

}
