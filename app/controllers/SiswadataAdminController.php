<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
require_once('/../../public/phpmailer/PHPMailerAutoload.php');

class SiswadataAdminController extends ControllerBase
{

    public function initialize() {
        //$this->tag->setTitle("Siswa Login");
        //parent::initialize();

       /// if($this->session->has("auth")) {
          ///  $this->auth = $this->session->get("auth");
        //}
    }

  /*  private function _registerSession(Barcode $code)
    {
    $this->session->set('auth', [
           // 'isLog' => 'Y',
            'NoVA' => $code->NoVA,
            'bcode' => $code->bcode
        ]);
    }*/

    public function indexAction()
    {
        $this->tag->setTitle("Siswa Login");




//require_once('class.phpmailer.php');

    }

    public function registerAction()
    {
        $this->tag->setTitle("Data Siswa");


        $sql2 = "SELECT top 1  (RecID + 1) as iduser from iduser_temp order by RecID desc";
        $query2 = $this->getDI()->getShared('db2')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ); 
        $temp = $query2->fetchAll($query2);
        $this->view->result2 = $temp;

        foreach ($temp as $row) {
            $RecID = $row->iduser;
            
        $sql = "INSERT into iduser_temp values ('$RecID')";

                $query = $this->getDI()->getShared('db2')->query($sql);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        } 


        if ($this->request->isPost()) {
                $NoVA = $this->request->getPost('NoVA');
                $bcode = $this->request->getPost('bcode');
                $barcode = Barcode::findFirst(array("NoVA='$NoVA'"));
    
    
        if($barcode)
        {
         //$NoVA = $this->uri->segment(3);
         $bcode = SUBSTR($NoVA,0,4);
         $VirtualAccount = SUBSTR($NoVA,5,8);
         $barcode = $this->request->getPost('bcode');
      
         $sql = "select siswa.RecID as siswa, siswa.EmailSiswa, siswa.TempatLahir, siswa.TanggalLahir, siswa.NamaAyah, siswa.NamaIbu, siswa.EmailAyah, siswa.EmailIbu, SUBSTRING(siswa.NamaSiswa,0,30) as NamaSiswa, siswa.VirtualAccount, barcode.NoVA, areacabang.NamaAreaCabang, siswa.VirtualAccount, siswa.Cabang, siswa.Jenjang, siswa.CreatedBy, siswa.status, siswa.NoKartuSiswa, Siswa.AsalSekolah, siswa.TeleponSiswa, siswa.MD, siswa.PekerjaanAyah, siswa.PekerjaanIbu, siswa.TeleponAyah, siswa.TeleponIbu, siswa.Alamat, siswa.KodePos, siswa.Kota, Siswa.Propinsi, siswa.JenisKelamin, siswa.Agama from siswa
                    join barcode on SUBSTRING(barcode.NoVA,5,8) = siswa.VirtualAccount
                    join areacabang on siswa.cabang = areacabang.RecID
                    where barcode.NoVA = '$NoVA' and Areacabang.KodeAreaCabang = '$bcode'";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);              
        $queryfor = $query->fetchAll($query);
        $this->view->result = $queryfor;

        $sql1 = "SELECT COUNT(user_name) as total FROM [dbo].[user] where user_name =  '$NoVA'";
        $query1 = $this->getDI()->getShared('db2')->query($sql1);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ); 
        $this->view->result1 = $query1->fetchAll($query1);

       /* $sql2 = "SELECT top 1 RecID as iduser from iduser_temp order by RecID desc
 ";
        $query2 = $this->getDI()->getShared('db2')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ); 
        $this->view->result2 = $query2->fetchAll($query2); */
        
        foreach ($queryfor as $row) {
        $this->tag->setDefault("Agama", $row->Agama);
        $this->tag->setDefault("Propinsi", $row->Propinsi);
        $this->tag->setDefault("Kota", $row->Kota);
        $this->tag->setDefault("JenisKelamin", $row->JenisKelamin);
        $this->view->propinsi = Propinsi::find();
        $this->view->kotakab = Kotakab::findByPropinsi($row->Propinsi);
        $this->view->barcode = $barcode;
        }

        //$this->tag->setDefault("Propinsi", $result->Propinsi);
        //$this->tag->setDefault("NamaCabang", $area->NamaAreaCabang);

        //$areaid = $this->auth['NoVA'];
       // $area = Siswa::findFirstByRecID($areaid);
       // $this->view->rpt_area = $areaid ? $area->NamaSiswa : 'All';

        $siswa = Siswa::findFirstByVirtualAccount($VirtualAccount);  
               // $this->view->NoVA = $siswa->NoVA;

        $this->tag->setDefault("TempatLahir", $siswa->TempatLahir);

    } else {
        $this->flash->error("Barcode tidak sesuai dengan No.VA");
            return $this->dispatcher->forward(array(
                "controller" => "SiswadataAdmin",
                "action" => "index"
            ));
    }
        
    }
    
    }

        public function saveAction()
        {
        $this->tag->setTitle("Data Siswa");
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "siswa",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $siswa = Siswa::findFirstByRecID($RecID);
        if (!$siswa) {
            $this->flash->error("siswa does not exist " . $RecID);

            return $this->dispatcher->forward(array(
                "controller" => "SiswadataAdmin",
                "action" => "index"
            ));
        }

        $siswa->NamaSiswa = $this->request->getPost("NamaSiswa");
        $siswa->TempatLahir = $this->request->getPost("TempatLahir");
        $siswa->TanggalLahir = $this->request->getPost("TanggalLahir");
        $siswa->Agama = $this->request->getPost("Agama");
        $siswa->AsalSekolah = $this->request->getPost("AsalSekolah");
        $siswa->Jenjang = $this->request->getPost("Jenjang");
        $siswa->JenisKelamin = $this->request->getPost("JenisKelamin");
        $siswa->TeleponSiswa = $this->request->getPost("TeleponSiswa");
        $siswa->EmailSiswa = $this->request->getPost("EmailSiswa");
        $siswa->NamaAyah = $this->request->getPost("NamaAyah");
        $siswa->EmailAyah = $this->request->getPost("EmailAyah");
        $siswa->TeleponAyah = $this->request->getPost("TeleponAyah");
        $siswa->PekerjaanAyah = $this->request->getPost("PekerjaanAyah");
        $siswa->NamaIbu = $this->request->getPost("NamaIbu");
        $siswa->EmailIbu = $this->request->getPost("EmailIbu");
        $siswa->TeleponIbu = $this->request->getPost("TeleponIbu");
        $siswa->PekerjaanIbu = $this->request->getPost("PekerjaanIbu");
        $siswa->Alamat = $this->request->getPost("Alamat");
        $siswa->Kota = $this->request->getPost("Kota");
        $siswa->Propinsi = $this->request->getPost("Propinsi");
        $siswa->KodePos = $this->request->getPost("KodePos");
        $siswa->NoKartuSiswa = $this->request->getPost("NoKartuSiswa");
        $siswa->PekerjaanAyah = $this->request->getPost("PekerjaanAyah");
        $siswa->PekerjaanIbu = $this->request->getPost("PekerjaanIbu");
        $siswa->MD = $this->request->getPost("MD");
        $siswa->Aktivasi = '1';

        //$Unique = $this->request->getPost("EmailSiswa");
       // $paramCount = [
       //     "EmailSiswa = :es:", "bind" => ["es" => $Unique]
      //  ];
      //  if (siswa::count($paramCount)) {
      //      $this->flash->error("Email <u>$Unique</u> sudah terdaftar, silahkan gunakan email lain.");
      //      return $this->forward("SiswadataAdmin/register");
     //   }

        if (!$siswa->save()) {

            foreach ($siswa->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "SiswadataAdmin",
                "action" => "register",
                "params" => array($siswa->RecID)
            ));
        }

       
        $kdcabang         = $this->request->getPost("Cabang");
        $nama             = $this->request->getPost("NamaSiswa");
        $cabang           = $this->request->getPost("NamaAreaCabang");
        $VA               = $this->request->getPost("VirtualAccount"); 
        $username         = $this->request->getPost("NoVA");
        $pass1            = "siswa";
        $password         = ("$pass1");
        $password2        = md5(("$pass1"));
        $mail             = new PHPMailer();
        $body             = "
        <pre><font size='2'><b>
Dear $nama, </b>
        
Terimakasih telah melengkapi data diri anda sebagai siswa Primagama. Silahkan gunakan username dan password berikut untuk login di aplikasi EMS Primagama :
                            
    Nama             : $nama
    Cabang           : $cabang
    No.VA / Username : <u>$username</u>
    Password         : <u>$password</u>

Silahkan Klik link aktivasi http://ems.primagama.co.id
                            
Salam SMART,



@Copyright 2016 PT. Prima Edu, Primagama
        </font></pre>"; 




                //isi dari email
        $mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
       // $mail->SMTPDebug  = 2;                     // mengaktifkan debug mode (untuk ujicoba)
                                           // 1 = Error dan pesan
                                           // 2 = Pesan saja
        $mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
       // $mail->SMTPSecure = "tls";                 // jenis kemananan
        $mail->Host       = "smtp.office365.com";      // masukkan GMAIL sebagai smtp server
        $mail->Port       = "587";                   // masukkan port yang digunakan oleh SMTP Gmail
        $mail->Username   = "noreply@primagama.co.id";  // GMAIL username
        $mail->Password   = "Prima.1234";            // GMAIL password
        $mail->SetFrom('noreply@primagama.co.id', 'Primagama'); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
        $mail->Subject    = "Email Konfirmasi";//masukkan subject
        $mail->MsgHTML($body);//masukkan isi dari email

        $address = $this->request->getPost("EmailSiswa");
        $mail->AddCC("oni.restu@primagama.co.id", "Helpdesk Primagama"); //masukkan cc
	$mail->addBCC("hamzah@primagama.co.id", "Helpdesk Primagama");
        $mail->AddAddress($address, $this->request->getPost("NamaSiswa")); //masukkan penerima


        $novaems = $this->request->getPost("total");
        $id = $this->request->getPost("iduser");
	//$Binary = convert(Varbinary(25));
 
        if ($novaems == 0) {
	$sql = "INSERT into [dbo].[user] values ('$id','$username','$password2','5','$nama','$address',' $kdcabang','','','','','','','','','','','','','',null)";

                $query = $this->getDI()->getShared('db2')->query($sql); 
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo; // jika pesan tidak terkirim
        } else {
         echo $this->flash->success("Terimakasih $nama telah melengkapi data diri anda, silahkan cek email anda untuk mengetahui username dan password untuk login di EMS Primagama."); //jika pesan terkirim
        }

        return $this->dispatcher->forward(array(
            "controller" => "SiswadataAdmin",
            "action" => "end"
        ));

        } else {

        $sql = "UPDATE [dbo].[user]
                SET password='$password2', nama='$nama', email='$address'
                WHERE user_name='$username'";

                $query = $this->getDI()->getShared('db2')->query($sql);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        if(!$mail->Send()) {
        echo "Jaringan Error"; // jika pesan tidak terkirim
        } else {
         echo $this->flash->success("Terimakasih $nama telah melengkapi data diri anda, silahkan cek email anda untuk mengetahui username dan password untuk login di EMS Primagama."); //jika pesan terkirim
        }

        return $this->dispatcher->forward(array(
            "controller" => "SiswadataAdmin",
            "action" => "end"
        ));

        }
        }

    public function getKotaAction($param) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $records = [];
        $kota = Kotakab::find(array(
                    'conditions' => 'Propinsi = ?0',
                    'order' => 'NamaKotaKab',
                    'bind' => array(0 => $param),
        ));
        if (!count($kota)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($kota as $record) {
                $records[] = [
                    'id' => $record->RecID,
                    'namakotakab' => $record->NamaKotaKab,
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'listData' => $records
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

        public function endAction()
    {
        //$this->session->remove('auth');
        $this->session->destroy();
        //$this->response->redirect();
        $this->dispatcher->forward(array(
            "controller"=>"SiswadataAdmin",
            "action"=>"index"
            ));
    }

        public function gagalAction()
    {


    }

        public function selesaiAction()
    {

    }


}