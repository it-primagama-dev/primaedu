
<?php

use Phalcon\Paginator\Adapter\Model as Paginator;

class BukusiswaController extends ControllerBase {

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Penyerahan Buku");
        parent::initialize();
        // Check Session
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
            if (!is_numeric($this->auth['areaparent'])) {
                $this->flash->error("Unauthorized Request");
                return $this->dispatcher->forward(array(
                            "controller" => "index",
                            "action" => "index"
                ));
            }
        }
    }

    /**
     * Index action
     */
    public function indexAction() {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for bukusiswa
     */
    public function searchAction() {

        $siswa = Siswa::findFirst(array(
                    "VirtualAccount = :va: AND Cabang = :cabang:",
                    "bind" => array("va" => $this->request->getPost("KodeSiswa", "int"), "cabang" => $this->auth['areacabang']),
                    "order" => "CreatedAt DESC"
        ));

        if (!$siswa) {
            $this->flash->error("Data siswa tidak ditemukan");
            return $this->forward("bukusiswa/index");
        }

        $programsiswa = Programsiswa::findBySiswa($siswa->RecID);  

        if (count($programsiswa) == 0) {
            $this->flash->error("Siswa belum mengikuti program");
            return $this->forward("bukusiswa/index");
        }

        $this->view->programsiswa = $programsiswa;
    }

    /**
     * Displays the creation form
     */
    public function newAction($kodesiswa) {
        $this->tag->setDefault("ProgramSiswa", $ProgramSiswa);
       // $this->view->buku = Inventitem::find();
         $this->view->propinsi = Propinsi::find();
        $cabang = $this->auth['areacabang'];

        //join jenjang on inventitem.KodeJenjang = jenjang.KodeJenjang
//join jenjangbarcode on jenjang.KodeJenjang = jenjangbarcode.kodejenjang

        //$this->view1->buku = inventitem::query()
           //     ->columns("Inventitem.KodeItem,Inventitem.NamaItem,inventstock.QtyReceipt,inventstock.RecId")
           //     ->join("inventstock", "Inventitem.KodeItem = inventstock.ItemId")
                //->join("jenjang", "inventitem.KodeJenjang = jenjang.KodeJenjang")
                //->join("jenjangbarcode", "enjang.KodeJenjang = jenjangbarcode.kodejenjang")
             //  ->where("inventstock.Cabang = '$cabang' AND Inventitem.KodeJenjang = '$jenjang'")
             //  ->orderBy("inventstock.ItemId")
             // ->execute();        

        /**$sql1 = "SELECT KodeItem, NamaItem, QtyReceipt from inventitem
                join inventstock on inventitem.KodeItem = inventstock.ItemId 
where inventstock.Cabang = '1259'";
        $query1 = $this->getDI()->getShared('db')->query($sql1);
        $query1->setFetchMode(Phalcon\Db::FETCH_OBJ); 
        $this->view->result1 = $query1->fetchAll($query1); */

        $kodesiswa = $_GET["siswa"];

        $program = SUBSTR($kodesiswa,9,22);
        $siswa = SUBSTR($kodesiswa,2,7);
        $jenjang = SUBSTR($kodesiswa,0,2);

        $this->view->buku = inventitem::query()
                ->columns("Inventitem.KodeItem,Inventitem.NamaItem")
                //->join("inventstock", "Inventitem.KodeItem = inventstock.ItemId")
               ->where("Inventitem.KodeJenjang = '$jenjang'")
               ->orderBy("Inventitem.KodeItem")
              ->execute();  


        $cabangg = $this->session->get('auth')['kodeareacabang'];

        $this->view->result = Siswa::query()
                ->columns("Siswa.NamaSiswa, jenjangbarcode.kodebarcode, Program.NamaProgram, Jenjang.KodeJenjang")
                ->join("Programsiswa", "Programsiswa.Siswa = Siswa.RecID")
                ->join("Program", "Program.RecID = Programsiswa.Program")
                ->join("Jenjang", "Jenjang.KodeJenjang = Program.Jenjang")
                ->join("jenjangbarcode", "jenjangbarcode.kodejenjang = Jenjang.KodeJenjang")
                ->join("Areacabang", "Areacabang.RecID = Siswa.Cabang")
               ->where("Siswa.VirtualAccount = '$siswa' and Areacabang.KodeAreaCabang = '$cabangg'")
              ->execute();
 
        $this->view->program = $program;
        $this->view->siswa = $siswa;
        $this->view->jenjang = $jenjang;
    }

    /**
     * Creates a new bukusiswa
     */
    public function createAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "bukusiswa",
                        "action" => "index"
            ));
        }

        $kodesiswa = $_GET["siswa"];
        $programSiswa = $this->request->getPost("ProgramSiswa");
        // Cek Stock
        $itemId = $this->request->getPost("InventItem");
        $SerialNumber = $this->request->getPost("SerialNumber");
        $qtyItem = $this->request->getPost("Jumlah");
        $status = 0;
        $paramStock = [
           'column' => 'RecID', 'Cabang = ?0 AND Barcode = ?1 AND Status = ?2',
            'bind' => [0 => $this->auth['areacabang'], 1 => $SerialNumber, 2 => $status]
       ];
        if (intval(Masterbarcode::count($paramStock)) < 1) {
            $this->flash->error("Barcode salah atau tidak tersedia di stok cabang");
            return $this->forward("bukusiswa");
        }

        // TOC-RB added 05 Oct 2015
        // Cek serial number tidak boleh di-input kedalam sistem lebih dari 1 kali
        $serialNumber = $this->request->getPost("SerialNumber");
        $paramCount = [
            "SerialNumber = :sn:", "bind" => ["sn" => $serialNumber]
        ];
        if (Bukusiswa::count($paramCount)) {
            $this->flash->error("Barcode $serialNumber sudah digunakan oleh siswa lain");
            return $this->forward("bukusiswa");
        }

        //validasi jenjang dan barcode

        $jenjangsiswa = $this->request->getPost("kodebarcode");
        $nama = $this->request->getPost("siswa");
        $program = $this->request->getPost("program");
        $karkelas = SUBSTR($serialNumber,4,2);

        if ( $karkelas != $jenjangsiswa ) {
            
            $this->flash->error("<strong>Buku tidak sesuai.</strong> $nama adalah Siswa Program <u>$program</u>.");
            return $this->forward("bukusiswa");

        } else {

            # code...

        }

       
         


        // end added

        $this->db->begin();

        $bukusiswa = new Bukusiswa();

        $bukusiswa->ProgramSiswa = $programSiswa;
        $bukusiswa->InventItem = $itemId;
        $bukusiswa->Jumlah = $qtyItem;
        // TOC-RB updated 05 Oct 2015
        //$bukusiswa->SerialNumber = $this->request->getPost("SerialNumber");
        $bukusiswa->SerialNumber = $serialNumber;
        // end updated
        $bukusiswa->TanggalTerima = $this->request->getPost("TanggalTerima");
        $bukusiswa->Cabang = $this->auth['areacabang'];

        if (!$bukusiswa->save()) {
            $this->db->rollback();
            foreach ($bukusiswa->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("bukusiswa");
        }

        /**$stock = new Inventstock();

        $stock->Cabang = $this->session->get('auth')['RecID'];
        $stock->ItemId = $bukusiswa->InventItem;
        $stock->QtyOrder = $bukusiswa->Jumlah;
        $stock->QtyReceipt = 0;
        $stock->TransDate = date('Y-m-d');
        $stock->ItemName = Inventitem::findFirstByKodeItem($stock->ItemId)->NamaItem;

        if (!$stock->save()) {
            $this->db->rollback();
            foreach ($bukusiswa->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("bukusiswa");
        } */

        //$stock->ItemName = Inventstock::findFirstByItemId($ItemId)->QtyReceipt;

  //      $sqlll = "SELECT QtyReceipt from inventstock where ItemId = '$ItemId'";

    //    $query = $this->getDI()->getShared('db')->query($sqlll);
      //  $query->setFetchMode(Phalcon\Db::FETCH_OBJ);


       // $bukukeluar = $bukusiswa->Jumlah;
       // $stok = inventstock::findFirstByItemId($bukusiswa->InventItem);
       // $jumlahstok = $stok->$QtyReceipt;
      //  $sisastok = intval(Inventstock::sum($paramStock)) - $bukukeluar;
       $sql = "UPDATE Masterbarcode
        SET Status ='1'
        WHERE Barcode = '$serialNumber'";

       $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $barcode = new barcode();

        $cabang = $this->session->get('auth')['kodeareacabang'];
        $kodesiswa = $this->request->getPost("kodesiswa");
        $barcode->NoVA = ("$cabang$kodesiswa");
        $barcode->bcode = $this->request->getPost("SerialNumber");

        if (!$barcode->save()) {
            $this->db->rollback();
            foreach ($bukusiswa->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("bukusiswa");
        }


        // Commit Transaction
        $this->db->commit();
        $this->flash->success("Proses penerimaan buku berhasil");
        return $this->forward('bukusiswa/index');
    }

        public function getStokAction($param) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $records = [];
        $stok = inventstock::find(array(
                    'conditions' => 'ItemId = ?0',
                    'order' => 'ItemName',
                    'bind' => array(0 => $param),
        ));
        if (!count($stok)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($stok as $record) {
                $records[] = [
                    'id' => $record->RecID,
                    'stok' => $record->stok,
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'listData' => $records
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

    public function receiptAction($id) {

        if (!$this->request->isGet()) {
            return $this->forward("index");
        }

        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $bukusiswa = Bukusiswa::findFirst($id);

        $inventitem = Inventitem::findFirstByKodeItem($bukusiswa->InventItem);
        $programsiswa = Programsiswa::findFirst($bukusiswa->ProgramSiswa);
        $tanggalTerima = new DateTime($bukusiswa->TanggalTerima);

        $data = [];

        for ($i = 0; $i < 3; $i++) {
            $dataReport = [];
            $dataReport["documentno"] = ""; // TODO
            $dataReport["tanggalterima"] = $tanggalTerima->format('d F Y');
            $dataReport["namasiswa"] = $programsiswa->getSiswa();
            $dataReport["namabuku"] = $inventitem->NamaItem;
            $dataReport["program"] = $programsiswa->getProgram();
            $dataReport["serialnumber"] = $bukusiswa->SerialNumber;
            $dataReport["jumlah"] = $bukusiswa->Jumlah;

            $data[$i] = $dataReport;
        }

        $this->view->data = $data;

        //$this->view->disable();        
        //$RecId = $this->request->get("RECID", "int");
        //$copy = $this->request->get("copy", "int");
        //$pdf = new pdf();
        //$pdf->pdf_output("Tanda Terima Buku", $this->printReport($id), 1);
    }

    private function printReport($RecId) {

        $bukusiswa = Bukusiswa::findFirst($RecId);

        $inventitem = Inventitem::findFirstByKodeItem($bukusiswa->InventItem);
        $programsiswa = Programsiswa::findFirst($bukusiswa->ProgramSiswa);

        $tanggalTerima = new DateTime($bukusiswa->TanggalTerima);

        $content = '<tr>
    <td class="pad1" colspan="2">
        <table class="tablePrintContent">
            <tr>
                <td>No.</td>
                <td>:</td>
                <td>' . $RecId . '</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>' . $tanggalTerima->format('d F Y') . '</td>
            </tr>
            <tr>
                <td>Nama Buku</td>
                <td>:</td>
                <td>' . $inventitem->NamaItem . '</td>
            </tr>
            <tr>
                <td>Program</td>
                <td>:</td>
                <td>' . $programsiswa->getProgram() . '</td>
            </tr>
            <tr>
                <td>Serial Number</td>
                <td>:</td>
                <td>' . $bukusiswa->SerialNumber . '</td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td>' . $bukusiswa->Jumlah . '</td>
            </tr>
        </table>
        <table class="tablePrintBottom">
            <tr>
                <td class="posLeft">
                    <table class="signature">
                        <tr>
                            <td colspan="2">Diserahkan oleh,</td>
                        </tr>
                        <tr>
                            <td class="signatureFiller" colspan="2"></td>
                        </tr>
                        <tr>
                            <td class="posLeft">(</td>
                            <td class="posRight">)</td>
                        </tr>
                    </table>
                </td>
                <td class="posRight">
                    <table class="signature">
                        <tr>
                            <td colspan="2">Diterima oleh,</td>
                        </tr>
                        <tr>
                            <td class="signatureFiller" colspan="2"></td>
                        </tr>
                        <tr>
                            <td class="posLeft">(</td>
                            <td class="posRight">)</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>';

        return $content;
    }

}
