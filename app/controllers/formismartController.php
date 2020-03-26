<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class formismartController extends ControllerBase {


    public function initialize() {
        $this->tag->setTitle("I-Smart");
      //  parent::initialize();
       // if($this->session->has("auth")) {
         //   $this->auth = $this->session->get("auth");
        //}
    }

    /**
     * Index action
     */
    public function indexAction() {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for ismart
     */
    public function searchAction() {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Ismart", $_POST);
            if($this->auth['areaparent']) {
                $query->andWhere("Cabang = :cabang:", ["cabang" => $this->auth['areacabang']]);
            }
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecID";

        $ismart = Ismart::find($parameters);
        if (count($ismart) == 0) {
            $this->flash->notice("Data I-Smart Tidak Ditemukan");

            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "index"
                    ));
        }

        $paginator = new Paginator(array(
                    "data" => $ismart,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('Area', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
        $this->view->propinsi = Propinsi::find();
        $this->view->bidangstudi = Bidangstudi::find();
    }

    /**
     * Edits a ismart
     *
     * @param string $RecID
     */
    public function editAction($RecID) {
        
        $this->view->bidangstudi = Bidangstudi::find();
        $this->view->propinsi = Propinsi::find();

        if (!$this->request->isPost()) {

            $ismart = IsmartNew::findFirstByRecID($RecID);
            if (!$ismart) {
                $this->flash->error("Data I-Smart Tidak Ditemukan");

                return $this->dispatcher->forward(array(
                            "controller" => "ismart",
                            "action" => "index"
                        ));
            }

            $areaid = $this->_validateArea($this->request->getPost('Area'));
            $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));


            $this->view->RecID = $ismart->RecID;

            $this->tag->setDefault("RecID", $ismart->RecID);
            $this->tag->setDefault("KodeISmart", $ismart->KodeISmart);
            $this->tag->setDefault("NamaISmart", $ismart->NamaISmart);
            $this->tag->setDefault("Grade", $ismart->Grade);
            $this->tag->setDefault("JenisKelamin", $ismart->JenisKelamin);
            $this->tag->setDefault("TipeISmart", $ismart->TipeISmart);
            $this->tag->setDefault("TanggalLahir", $ismart->TanggalLahir);
            $this->tag->setDefault("TanggalGabung", $ismart->TanggalGabung);
            $this->tag->setDefault("Telepon", $ismart->Telepon);
            $this->tag->setDefault("Alamat", $ismart->Alamat);
            $this->tag->setDefault("Pekerjaan", $ismart->Pekerjaan);
            $this->tag->setDefault("Email", $ismart->Email);
            $this->tag->setDefault("Cabang", $ismart->Cabang);
            $this->tag->setDefault("BidangStudi", $ismart->BidangStudi);
            $this->tag->setDefault("BidangStudi2", $ismart->BidangStudi2);
            $this->tag->setDefault("Kota", $ismart->Kota);
            $this->tag->setDefault("Propinsi", $ismart->Propinsi);
            $this->tag->setDefault("Kota", $ismart->Kota);
            
            $this->view->kotakab = Kotakab::findByPropinsi($ismart->Propinsi);
        }
    }

    public function uploadAction()
    {
        // Check if the user has uploaded files
        if ($this->request->hasFiles()) {
            $files = $this->request->getUploadedFiles();

            // Print the real file names and sizes
            foreach ($files as $file) {
                // Print file details
                echo $file->getName(), ' ', $file->getSize(), '\n';

                // Move the file into the application
                $file->moveTo(
                    'files/' . $file->getName()
                );
            }
        }
    }

    /**
     * Creates a new ismart
     */
    public function createAction() {
        $helper = new Helpers();
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "formismart",
                        "action" => "new"
                    ));
        }

        $ismart = new Ismart();
        $dom = new DOMDocument;
        $dom->loadHTML($ismart);
        $images = $dom->getElementsByTagName('images');
        foreach ($images as $image){
            $src = $image->getAttribute('src');
            $data = str_replace('data:image/jpeg;base64,','',$src);
            $data = str_replace(' ','+',$data);
            $mimetype = "jpeg";
            $filepath = 'img/'. uniqid() .'.'. $mimetype;
            $new_src = '/'.$filepath;
            $image->removeAttribute('src');
            $image->setAttribute('src',$new_src);
            $success = file_put_contents($filepath, $data);

        }
        $str = $dom->saveHTML(); 
        $ismart->certificate = $str;
        $ismart->BidangStudi = $this->request->getPost("BidangStudi");
        $ismart->TanggalGabung = $this->request->getPost("TanggalGabung");
        //$ismart->KodeISmart = $this->request->getPost("KodeISmart");
        $ismart->NamaISmart = $this->request->getPost("NamaISmart");
        $ismart->Grade = $this->request->getPost("Grade");
        $ismart->JenisKelamin = $this->request->getPost("JenisKelamin");
        $ismart->TipeISmart = $this->request->getPost("TipeISmart");
        $ismart->TanggalLahir = $this->request->getPost("TanggalLahir");
        $ismart->Telepon = $this->request->getPost("Telepon");
        $ismart->Alamat = $this->request->getPost("Alamat");
        $ismart->Pekerjaan = $this->request->getPost("Pekerjaan");
        $ismart->Email = $this->request->getPost("Email");
        $ismart->BidangStudi2 = $this->request->getPost("BidangStudi2");
        $ismart->Kota = $this->request->getPost("Kota");
        $ismart->Propinsi = $this->request->getPost("Propinsi");
        $ismart->Cabang = $this->request->getPost("Cabang");
        //$ismart->Cabang = $this->auth['areacabang'];
        $ismart->Pendidikan = $this->request->getPost("Pendidikan");
        $ismart->Jurusan = $this->request->getPost("Jurusan");
        //$ismart->Ijazah = $this->
        
        $ismart->ijazah = $this->request->getPost("images");
        if ($this->request->hasFiles() == true) {
            $baseLocation = 'img/';
            foreach ($this->request->getUploadedFiles() as $file){
            var_dump($ismart);
          die();
                $data = $file->getKey();
                $dataError = $file->getError();
                if($data != "files"){
                    if ($dataError == 0){
                        $fileName= rand(0,100000). date('Ymdhis').".".$file->getExtension();
                        $file->moveTo($baseLocation . $fileName);
                        $ismart->ijazah = $fileName;
                    }
                }
            }
           
        var_dump($ismart);
          die();
        } else {
          echo 'File not uploaded';

            //echo $file->getKey();
        }



 
 /*       if (strlen($ismart->BidangStudi) == 0 ){
             $this->flash->notice("The search did not find any scheduledetail");

            return $this->dispatcher->forward(array(
                        "controller" => "formismart",
                        "action" => "new"
                    ));
        }
*/
       if (strlen($ismart->BidangStudi) == 0 || 
            strlen($ismart->Pendidikan) == 0  ) {
            $field = strlen($ismart->BidangStudi) == 0 ? "Bidang Studi" : "Pendidikan";
           // $this->flash->error("Data I-Smart ".$field." Harus Diisi");
            //return FALSE;
            $message = "Data I-Smart ".$field." Harus Diisi";
            echo "<script type='text/javascript'>alert('$message');</script>";
            //$this->flashSession->error($message);
            return $this->forward("formismart/new");
            //return FALSE;
        }

     if (strlen($ismart->NamaISmart) == 0 || 
            strlen($ismart->TipeISmart) == 0  ) {
            $field = strlen($ismart->NamaISmart) == 0 ? "Nama Ismart" : "Tipe ISmart";
            //$this->flash->error("Data ISmart ".$field." Harus Diisi");
            //return FALSE;
            $message = "Data I-Smart ".$field." Harus Diisi";
            echo "<script type='text/javascript'>alert('$message');</script>";
            return $this->forward("formismart/new");
            //return FALSE;
        }

        if (strlen($ismart->Email) == 0 || 
            strlen($ismart->Telepon) == 0  ) {
            $field = strlen($ismart->Email) == 0 ? "Email" : "Telepon";
           // $this->flash->error("Data I-Smart ".$field." Harus Diisi");
            //return FALSE;
            $message = "Data I-Smart ".$field." Harus Diisi";
            echo "<script type='text/javascript'>alert('$message');</script>";
            return $this->forward("formismart/new");
            //return FALSE;
        }

        if (strlen($ismart->Jurusan) == 0 || 
            strlen($ismart->Telepon) == 0  ) {
            $field = strlen($ismart->Jurusan) == 0 ? "Jurusan" : "Telepon";
            //$this->flash->error("Data I-Smart ".$field." Harus Diisi");
            //return FALSE;
            $message = "Data I-Smart ".$field." Harus Diisi";
            echo "<script type='text/javascript'>alert('$message');</script>";
            return $this->forward("formismart/new");
            //return FALSE;
        }

        if (strlen($ismart->Cabang) == 0 || 
            strlen($ismart->Pekerjaan) == 0  ) {
            $field = strlen($ismart->Cabang) == 0 ? "Cabang" : "Pekerjaan";
           // $this->flash->error("Data I-Smart ".$field." Harus Diisi");
            //return FALSE;
            $message = "Data I-Smart ".$field." Harus Diisi";
            echo "<script type='text/javascript'>alert('$message');</script>";
            return $this->forward("formismart/new");
            //return FALSE;
        }

        if (strlen($ismart->BidangStudi) == 0 || 
            strlen($ismart->Alamat) == 0  ) {
            $field = strlen($ismart->BidangStudi) == 0 ? "Bidang Studi" : "Alamat";
           // $this->flash->error("Data I-Smart ".$field." Harus Diisi");
            //return FALSE;
            $message = "Data I-Smart ".$field." Harus Diisi";
            echo "<script type='text/javascript'>alert('$message');</script>";
            return $this->forward("formismart/new");
            //return FALSE;
        }        


        if (!$ismart->save()) {
            foreach ($ismart->getMessages() as $message) {
                $this->flash->error($message);
            }

          return $this->dispatcher->forward(array(
                        "controller" => "formismart",
                        "action" => "new"
                    ));
        }
 
        //$this->flash->success("Data I-Smart Berhasil Ditambahkan");
        $cabang = $this->request->getPost("Cabang");
        $this->sendEmailAction($cabang);

        echo "<script type='text/javascript'>alert('Data I-Smart Berhasil Ditambahkan');</script>";

    }

    /**
     * Saves a ismart edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "index"
                    ));
        }

        $RecID = $this->request->getPost("RecID");

        $ismart = Ismart::findFirstByRecID($RecID);
        if (!$ismart) {
            $this->flash->error("Data I-Smart Tidak Ada " . $RecID);

            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "index"
                    ));
        }

        $ismart->KodeISmart = $this->request->getPost("KodeISmart");
        $ismart->NamaISmart = $this->request->getPost("NamaISmart");
        $ismart->Grade = $this->request->getPost("Grade");
        $ismart->JenisKelamin = $this->request->getPost("JenisKelamin");
        $ismart->TipeISmart = $this->request->getPost("TipeISmart");
        $ismart->TanggalLahir = $this->request->getPost("TanggalLahir");
        $ismart->TanggalGabung = $this->request->getPost("TanggalGabung");
        $ismart->Telepon = $this->request->getPost("Telepon");
        $ismart->Alamat = $this->request->getPost("Alamat");
        $ismart->Pekerjaan = $this->request->getPost("Pekerjaan");
        $ismart->Email = $this->request->getPost("Email");
        $ismart->BidangStudi = $this->request->getPost("BidangStudi");
        $ismart->BidangStudi2 = $this->request->getPost("BidangStudi2");
        $ismart->Kota = $this->request->getPost("Kota");
        $ismart->Propinsi = $this->request->getPost("Propinsi");
        //$ismart->Cabang = $this->request->getPost("Cabang");
        $ismart->Cabang = $this->auth['areacabang'];


        if (!$ismart->save()) {

            foreach ($ismart->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "edit",
                        "params" => array($ismart->RecID)
                    ));
        }

        $this->flash->success("Data I-Smart Berhasil Diupdate");

        return $this->dispatcher->forward(array(
                    "controller" => "ismart",
                    "action" => "index"
                ));
    }

    /**
     * Deletes a ismart
     *
     * @param string $RecID
     */
    public function deleteAction($RecID) {

        $ismart = Ismart::findFirstByRecID($RecID);
        if (!$ismart) {
            $this->flash->error("Data I-Smart Tidak Ditemukan");

            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "index"
                    ));
        }

        if (!$ismart->delete()) {

            foreach ($ismart->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "ismart",
                        "action" => "search"
                    ));
        }

        $this->flash->success("Data I-Smart Berhasil Dihapus");

        return $this->dispatcher->forward(array(
                    "controller" => "ismart",
                    "action" => "index"
                ));
    }

    public function sendEmailAction($cabang){
        $helper = new Helpers();
        $kodeAreaCabang = substr($cabang, 0, 4);
        $namaCabang = "";
        $emailPenerima = "";
        $area_cabang = Areacabang::findFirst("RecID = '" . $kodeAreaCabang . "'");
        if (count($area_cabang) > 0) {
            $namaCabang = $area_cabang->NamaAreaCabang;
            $emailPenerima = $area_cabang->Email;
        }
         $content = "<div style='font-family: Lucida Sans Typewriter'>
                Yth Bapak/Ibu Cabang " . $namaCabang . ",<br/><br/>
                Menyampaikan ada Ismart atau tentor cabang yang sudah mengisi form"
                . "Silahkan memerikan approval,, jika yang mengisi benar Ismart dari cabang ibu / bapak</b>.
                    
            <br><p>Demikian yang dapat kami sampaikan, terima kasih atas kerjasamanya.</p>
            </div>";

        $emailBody = $helper->emailTemplate($content);
        $emailCC = array();
        if ($this->environmentConfig == "production") {
            $this->sendEmail("Konfirmasi Pengisian Formulir", $emailBody, $emailPenerima, $namaCabang);
        } else {
            $this->sendEmail("Konfirmasi Pengisian Formulir", $emailBody);
        }
    }

}
