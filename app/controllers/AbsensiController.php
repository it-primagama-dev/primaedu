<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class AbsensiController extends ControllerBase {

    private $auth;

    public function initialize() {
        $this->tag->setTitle('Presensi Siswa');
        parent::initialize();
        $this->auth = $this->session->has('auth') ? $this->session->get('auth') : [];
    }

    /**
     * Index action
     */
    public function indexAction() {
        $this->persistent->parameters = null;
        $this->tag->setDefault("KodeSiswa", "");
        $this->tag->setDefault("AbsenTime", date('H:i:s'));


        $cabang = $this->session->get('auth');
        $cabang = $cabang['areacabang'];
        $numberPage = 1;

        if (!$this->request->isPost()) {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $absensi = $this->modelsManager->createBuilder()
                ->columns(array('Absensi.KodeSiswa', 'Absensi.AbsenTime', 'Siswa.NamaSiswa', 'Siswa.NoKartuSiswa', 'Siswa.VirtualAccount'))
                ->from('Absensi')
                ->leftJoin("Siswa", "Absensi.KodeSiswa = Siswa.RecID")
                ->Where('Absensi.AbsenDate = "' . date('Ymd') . '" AND Absensi.Cabang = "'. $cabang .'"')
                ->getQuery()
                ->execute();

        $paginator = new Paginator(array(
            "data" => $absensi,
            "limit" => 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for absensi
     */
    public function searchAction() {

        $numberPage = 1;
        if ($this->request->isPost()) {
            //get cabang
            $cabang = $this->session->get('auth');
            $cabang = $cabang["areacabang"];

            //TOC RB - 4 mei 2015
            //$siswa = Siswa::findFirstByVirtualAccount($_POST["KodeSiswa"]);
            $siswa = Siswa::findFirst("NoKartuSiswa = \"".$this->request->getPost("KodeSiswa", "string")."\" AND Cabang = ".$this->auth['areacabang']);

            $this->persistent->parameters = null;

            if ($siswa) {
                $temp["KodeSiswa"] = $siswa->RecID;

                $query = Criteria::fromInput($this->di, "Absensi", $temp);
                $query->columns(array('Absensi.KodeSiswa', 'Absensi.AbsenDate', 'Absensi.AbsenTime', 'Siswa.NamaSiswa', 'Siswa.VirtualAccount'));
                $query->join("Siswa", "Absensi.KodeSiswa = Siswa.RecID");
                $query->where("Absensi.Cabang = '".$cabang."'");
                $this->persistent->parameters = $query->getParams();
            } else {
                $this->flash->notice("Siswa dengan nomor tersebut tidak ditemukan");

                return $this->dispatcher->forward(array(
                            "controller" => "absensi",
                            "action" => "index"
                ));
            }
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "AbsenDate DESC";

        $absensi = Absensi::find($parameters);
        if (count($absensi) == 0) {
            $this->flash->notice("Siswa dengan nomor tersebut tidak ditemukan");

            return $this->dispatcher->forward(array(
                        "controller" => "absensi",
                        "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $absensi,
            "limit" => 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        $this->tag->setDefault("AbsenTime", date('H:i:s'));
        $this->tag->setDefault("AbsenDate", date('ymd'));
    }

    /**
     * Edits a absensi
     *
     * @param string $RecId
     */
    public function editAction($RecId) {

        if (!$this->request->isPost()) {

            $absensi = Absensi::findFirstByRecId($RecId);
            if (!$absensi) {
                $this->flash->error("absensi was not found");

                return $this->dispatcher->forward(array(
                            "controller" => "absensi",
                            "action" => "index"
                ));
            }

            $this->view->RecId = $absensi->RecId;

            $this->tag->setDefault("RecId", $absensi->RecId);
            $this->tag->setDefault("KodeSiswa", $absensi->KodeSiswa);
            $this->tag->setDefault("AbsenDate", $absensi->AbsenDate);
            $this->tag->setDefault("AbsenTime", $absensi->AbsenTime);
            $this->tag->setDefault("Cabang", $absensi->Cabang);
        }
    }

    /**
     * Creates a new absensi
     */
    public function createAction() {

        $this->tag->setDefault("AbsenTime", date('H:i:s'));

        if (!$this->request->isPost() || $_POST["KodeSiswa"] == "") {
            $this->flash->success("Semua input belum diisi");
            return $this->dispatcher->forward(array(
                        "controller" => "absensi",
                        "action" => "new"
            ));
        }

        //$siswa = Siswa::findFirstByNoKartuSiswa($_POST["KodeSiswa"]);
        // TOC RB 4 mei 2015
        //$siswa = Siswa::findFirstByVirtualAccount($_POST["KodeSiswa"]);
        $siswa = Siswa::findFirst("NoKartuSiswa = \"".$this->request->getPost("KodeSiswa", "string")."\" AND Cabang = ".$this->auth['areacabang']);

        //$cekPembayaranSiswa = Pembayaran::findFirstBySiswa($_POST["KodeSiswa"]);
        //$cekPembayaranSiswa = Pembayaran::findFirstBySiswa($siswa->RecID);
        $cekPembayaranSiswa = Pembayaran::query()
                ->columns(array("Pembayaran.SisaPembayaran", "Pembayaran.JatuhTempo"))
                ->leftJoin("Programsiswa", "Pembayaran.ProgramSiswa = p.RecID", "p")
                ->limit("1")
                ->execute();

        //if (intval($cekPembayaranSiswa->SisaPembayaran) > 0 && $cekPembayaranSiswa->JatuhTempo < date('Ymd')) { //SQL
        if (intval($cekPembayaranSiswa[0]->SisaPembayaran) > 0 && $cekPembayaranSiswa[0]->JatuhTempo < date('Y-m-d')) { //MySQL
            $this->flash->notice("Anda Belum Melakukan Pembayaran");
            return $this->dispatcher->forward(array(
                        "controller" => "absensi",
                        "action" => "new"
            ));
        }

        //$cekSiswa = Siswa::findFirstByRecID($_POST["KodeSiswa"]);
        $cekSiswa = Siswa::findFirstByRecID($siswa->RecID);

        if (count($cekSiswa) == 0 || $cekSiswa == null) {
            $this->flash->notice("Kode siswa salah");
            return $this->dispatcher->forward(array(
                        "controller" => "absensi",
                        "action" => "new"
            ));
        }

        // Check input time
        if ($_POST['AbsenTime'] == "" || $_POST['AbsenTime'] == null)
            $_POST['AbsenTime'] = date('H:i:s');

        if ($_POST['AbsenDate'] == "" || $_POST['AbsenDate'] == null)
            $_POST['AbsenDate'] = date('Ymd');

        $absensi = new Absensi();
        $cabang = $this->session->get('auth');
        $cabang = $cabang['areacabang'];

        //$absensi->KodeSiswa = $_POST['KodeSiswa'];
        $absensi->KodeSiswa = $siswa->RecID;
        $absensi->AbsenDate = $_POST['AbsenDate'];
        $absensi->AbsenTime = $_POST['AbsenTime'];
        //$absensi->Cabang = $this->session->auth['areacabang'];//$cabang;


        if (!$absensi->save()) {
            foreach ($absensi->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "absensi",
                        "action" => "index"
            ));
        }

        $this->flash->success("absensi was created successfully");

        return $this->response->redirect('absensi');
        /*        return $this->dispatcher->forward(array(
          "controller" => "absensi",
          "action" => "index"
          ));
         */
    }

    /**
     * Saves a absensi edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "absensi",
                        "action" => "index"
            ));
        }

        $RecId = $this->request->getPost("RecId");

        $absensi = Absensi::findFirstByRecId($RecId);
        if (!$absensi) {
            $this->flash->error("absensi does not exist " . $RecId);

            return $this->dispatcher->forward(array(
                        "controller" => "absensi",
                        "action" => "index"
            ));
        }

        $absensi->KodeSiswa = $this->request->getPost("KodeSiswa");
        $absensi->AbsenDate = $this->request->getPost("AbsenDate");
        $absensi->AbsenTime = $this->request->getPost("AbsenTime");
        $absensi->Cabang = $this->request->getPost("Cabang");


        if (!$absensi->save()) {

            foreach ($absensi->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "absensi",
                        "action" => "edit",
                        "params" => array($absensi->RecId)
            ));
        }

        $this->flash->success("Prisensi Berhasil");

        return $this->dispatcher->forward(array(
                    "controller" => "absensi",
                    "action" => "index"
        ));
    }

    /**
     * Deletes a absensi
     *
     * @param string $RecId
     */
    public function deleteAction($RecId) {

        $absensi = Absensi::findFirstByRecId($RecId);
        if (!$absensi) {
            $this->flash->error("absensi was not found");

            return $this->dispatcher->forward(array(
                        "controller" => "absensi",
                        "action" => "index"
            ));
        }

        if (!$absensi->delete()) {

            foreach ($absensi->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "absensi",
                        "action" => "search"
            ));
        }

        $this->flash->success("absensi was deleted successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "absensi",
                    "action" => "index"
        ));
    }

    public function RFIDAction() {

        //TOC-RB 29-Apr-15
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        if (!$this->request->isPost() || $_POST["KodeSiswa"] == "") {
            
        } else {
            // Check student payment
            // TOC RB - 4 Mei 2015
            //$siswa = Siswa::findFirstByNoKartuSiswa($_POST["KodeSiswa"]);
            $siswa = Siswa::findFirst("NoKartuSiswa = \"".$this->request->getPost("KodeSiswa", "string")."\" AND Cabang = ".$this->auth['areacabang']);

            if (count($siswa) == 0 || $siswa == null) {
                $this->flash->error("Mohon Maaf Kartu Anda Belum Terdaftar, Silahkan Mencoba Lagi..");
            } else {

                /* $cekPembayaranSiswa = Pembayaran::findFirstBySiswa($siswa->RecID); */
                //$cekPembayaranSiswa = Pembayaran::findFirstByVirtualAccount($_POST["KodeSiswa"]);
                $cekPembayaranSiswa = Pembayaran::query()
                        ->join("ProgramSiswa", "Pembayaran.ProgramSiswa = ProgramSiswa.RecID")
                        ->where("ProgramSiswa.Siswa = '" . $siswa->RecID . "'")
                        ->limit("1")
                        ->execute();

                if (count($cekPembayaranSiswa) > 0) {

                    $cabang = $this->session->get('auth');
                    $cabang = $cabang['areacabang'];
                    $datacabang = Areacabang::findFirstByRecID($cabang);

                    if (intval($cekPembayaranSiswa[0]->SisaPembayaran) > 0 && $cekPembayaranSiswa[0]->JatuhTempo < date('Y-m-d')) { //SQL
                        //if (intval($cekPembayaranSiswa->SisaPembayaran) > 0 && $cekPembayaranSiswa->JatuhTempo < date('Y-m-d')) { //MySQL
                        $this->flash->notice(
                                "Selamat Datang, " . "<b>" . $siswa->NamaSiswa . "</b>" .
                                " di Primagama Cabang " .
                                "<b>" . ($datacabang !== FALSE ? $datacabang->NamaAreaCabang : $cabang) . "</b>" .
                                "<br/>Anda memiliki catatan di administrasi kami, silahkan hubungi Bagian Administrasi."
                        );
                    } else {

                        // Do insert record
                        $absensi = new Absensi();

                        $absensi->KodeSiswa = $siswa->RecID;
                        $absensi->AbsenDate = date('Ymd');
                        $absensi->AbsenTime = date('H:i:s');
                        $absensi->Cabang = $cabang;

                        if (!$absensi->save()) {
                            foreach ($absensi->getMessages() as $message) {
                                $this->flash->error($message);
                            }

                            return $this->dispatcher->forward(array(
                                        "controller" => "absensi",
                                        "action" => "RFID"
                            ));
                        } else {
                            $this->flash->success(
                                    "Selamat Datang, " . "<b>" . $siswa->NamaSiswa . "</b>" .
                                    " di Primagama Cabang " .
                                    "<b>" . ($datacabang !== FALSE ? $datacabang->NamaAreaCabang : $cabang) . "</b>" .
                                    "<br/>Anda Dapat Memasuki Ruang Kelas Sesuai Jadwal"
                            );
                        }
                    }
                } else {
                    $this->flash->error("Kode tidak terdaftar");
                }
            }
        }
    }

//    /*
//    Custom Alert
//    */
//    public static function getAlert($content){
//        
//        return "
//        <div id='alertContainer' style='position:absolute;z-index:10;width:100%;height:100%;left:0;top:0;background-color:#000;opacity:0.7;' onclick='closePopup();'>
//            &nbsp;
//            <script language='javascript'>
//                Element.prototype.remove = function() {
//                    this.parentElement.removeChild(this);
//                }
//                NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
//                    for(var i = 0, len = this.length; i < len; i++) {
//                        if(this[i] && this[i].parentElement) {
//                            this[i].parentElement.removeChild(this[i]);
//                        }
//                    }
//                }
//
//                function closePopup(){
//                    document.getElementById('alert').remove();
//                    document.getElementById('alertContainer').remove();
//                }
//            </script>
//        </div>
//
//        <div id='alert' style='position:absolute;z-index:1000;width:30%;height:30%;left:35%;top:30%;background-color:#DADADA;border-radius:3px;border:solid 1px #DADADA;' onclick='closePopup();'>
//            <div style='padding-top:10%;text-align:center;'>
//                <div style='font-size:2vw;font-weight:bold;padding-bottom:10px;'>Upss..!</div>
//                <div style='font-size:1vw;padding:2% 2%;background-color:#FFF;border-radius:3px;border:solid 1px #DADADA;'>$content</div>
//            </div>
//        </div>";
//    }
}
