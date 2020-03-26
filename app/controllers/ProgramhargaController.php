<?php 
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ProgramhargaController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
        $this->view->tahunajaran = tahunajaran::find();
        $this->view->program = Program::find();
        $this->view->area = Areacabang::find(array(
            "Area IS NULL",
            "order" => "KodeAreaCabang"
        ));        
        $sql2="select * from program where tahunajaran = '3'";
        $q = $this->getDI()->getShared('db')->query($sql2);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->resultt = $q->fetchAll($q); 
    }

    /**
     * Searches for programharga
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Programharga", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "RecID";

        $programharga = Programharga::find($parameters);
        if (count($programharga) == 0) {
            $this->flash->notice("The search did not find any programharga");

            return $this->dispatcher->forward(array(
                "controller" => "programharga",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $programharga,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $this->view->area = Areacabang::find(array(
            "Area IS NULL",
            "order" => "NamaAreaCabang"
        ));
        $this->view->program = Program::find();
        $this->view->tahunajaran = tahunajaran::find();
    }

    /**
     * Edits a programharga
     *
     * @param string $RecID
     */
    public function editAction($RecID)
    {

        if (!$this->request->isPost()) {

            $programharga = Programharga::findFirstByRecID($RecID);
            if (!$programharga) {
                $this->flash->error("programharga was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "programharga",
                    "action" => "index"
                ));
            }

            $this->view->RecID = $programharga->RecID;
            $this->view->program = Program::find();
            $this->view->area = Areacabang::find(array(
                        "Area IS NULL",
                        "order" => "KodeAreaCabang"
            ));

            $this->tag->setDefault("RecID", $programharga->RecID);
            $this->tag->setDefault("Program", $programharga->Program);
            $this->tag->setDefault("HargaBimbingan", $programharga->HargaBimbingan);
            $this->tag->setDefault("HargaPendaftaran", $programharga->HargaPendaftaran);
            $this->tag->setDefault("TanggalBerlaku", $programharga->TanggalBerlaku);
            $this->tag->setDefault("AreaCabang", $programharga->AreaCabang);
            $this->tag->setDefault("SektorCabang", $programharga->SektorCabang);
            
        }
    }

    /**
     * Creates a new programharga
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "programharga",
                "action" => "index"
            ));
        }

        $programharga = new Programharga();

        $programharga->Program = $this->request->getPost("Program");
        $programharga->HargaBimbingan = $this->request->getPost("HargaBimbingan");
        $programharga->HargaPendaftaran = $this->request->getPost("HargaPendaftaran");
        $programharga->TanggalBerlaku = $this->request->getPost("TanggalBerlaku");
        $programharga->AreaCabang = $this->request->getPost("AreaCabang");
        $programharga->SektorCabang = $this->request->getPost("Sektor");
        

        if (!$programharga->save()) {
            foreach ($programharga->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "programharga",
                "action" => "new"
            ));
        }

        $this->flash->success("programharga was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "programharga",
            "action" => "index"
        ));

    }

    /**
     * Creates a new programharga
     */
    public function createtabaruAction()
    {

        if (isset($_POST["submit"]))
        //if (isset($_POST["Jawaban"]))
        foreach($_POST['Program'] AS $key=>$val)
        //foreach($_POST['Jawaban'] as $idd) 
       {
        $Sektor = $_POST['Sektor'];
        $Pendaftaran = substr($this->request->getPost("Pendaftaran","int")[$key], 0, -2);
        $Bimbingan = substr($this->request->getPost("Bimbingan","int")[$key], 0, -2); 
        $Area = $_POST['Area'];
        $Program = $_POST['Program'][$key];
        $Tanggal = $_POST['Tanggal'][$key];
       //$sarann = $_POST['isisaran'];            

        $sql = "INSERT into Programharga values('$Program','$Bimbingan','$Pendaftaran','$Tanggal','$Area','$Sektor')";

                $query = $this->getDI()->getShared('db')->query($sql);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

    
        }
        $this->flash->success("programharga was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "programharga",
            "action" => "index"
        ));

    }

    /**
     * Saves a programharga edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "programharga",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $programharga = Programharga::findFirstByRecID($RecID);
        if (!$programharga) {
            $this->flash->error("programharga does not exist " . $RecID);

            return $this->dispatcher->forward(array(
                "controller" => "programharga",
                "action" => "index"
            ));
        }

        $programharga->Program = $this->request->getPost("Program");
        $programharga->HargaBimbingan = $this->request->getPost("HargaBimbingan");
        $programharga->HargaPendaftaran = $this->request->getPost("HargaPendaftaran");
        $programharga->TanggalBerlaku = $this->request->getPost("TanggalBerlaku");
        $programharga->AreaCabang = $this->request->getPost("AreaCabang");
        $programharga->SektorCabang = $this->request->getPost("SektorCabang");
        

        if (!$programharga->save()) {

            foreach ($programharga->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "programharga",
                "action" => "edit",
                "params" => array($programharga->RecID)
            ));
        }

        $this->flash->success("programharga was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "programharga",
            "action" => "index"
        ));

    }

    /**
     * Deletes a programharga
     *
     * @param string $RecID
     */
    public function deleteAction($RecID)
    {

        $programharga = Programharga::findFirstByRecID($RecID);
        if (!$programharga) {
            $this->flash->error("programharga was not found");

            return $this->dispatcher->forward(array(
                "controller" => "programharga",
                "action" => "index"
            ));
        }

        if (!$programharga->delete()) {

            foreach ($programharga->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "programharga",
                "action" => "search"
            ));
        }

        $this->flash->success("programharga was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "programharga",
            "action" => "index"
        ));
    }

    public function detailprogramAction() {

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);

        $Program = $this->request->getPost("TahunAjaran");
        if ($Program=='1'){
        $sql2="SELECT * from program where tahunajaran = '5' and NamaProgram like '%reguler%' and NamaProgram not like '%PIKSUN%' and NamaProgram not like '%PIKSE%' and NamaProgram not like '%PIKSTAN%' and TipeProgram != '7' ORDER BY RecID";
        } else if ($Program=='2') {
        $sql2="SELECT * from program where tahunajaran = '5' and NamaProgram like '%- PIKSE%' and NamaProgram not like '%- PIKSUN - PIKSE%' and NamaProgram not like '%- PIKSE - PIKSTAN%' ORDER BY RecID";
        } else if ($Program=='3') {
        $sql2="SELECT * from program where tahunajaran = '5' and NamaProgram like '%- PIKSUN' ORDER BY RecID";
        } else if ($Program=='4') {
        $sql2="SELECT * from program where tahunajaran = '5' and NamaProgram like '%- PIKSUN - PIKSE%' ORDER BY RecID";
        } else if ($Program=='0') {
        $sql2="SELECT * from program where tahunajaran = '5' and TipeProgram != '7'  ORDER BY RecID";
        } else if ($Program=='5') {
        $sql2="SELECT * from program where tahunajaran = '5' and NamaProgram like '%- PIKSTAN%' and NamaProgram not like '%- PIKSUN - PIKSTAN%'  and NamaProgram not like '%- PIKSE - PIKSTAN%' ORDER BY RecID";
        } else if ($Program=='6') {
        $sql2="SELECT * from program where tahunajaran = '5' and NamaProgram like '%- PIKSUN - PIKSTAN%' ORDER BY RecID";
        } else if ($Program=='7') {
        $sql2="SELECT * from program where tahunajaran = '5' and NamaProgram like '%- PIKSE - PIKSTAN%' ORDER BY RecID";
        } else if ($Program=='8') {
        $sql2="SELECT * from program where tahunajaran = '5' and TipeProgram = '2' and NamaProgram not like '%Reguler%' Order By RecID";
        } else if ($Program=='9') {
        $sql2="SELECT * from program where tahunajaran = '5' and TipeProgram = '7' and NamaProgram like '%2019/2020%' Order By RecID";
        }

        $q = $this->getDI()->getShared('db')->query($sql2);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->resultt = $q->fetchAll($q);        
    }

    public function getprogramAction($tahunajaran = 0) {
        $this->view->disable();
        $cabang = Program::query()
                ->columns("*")
                ->where("tahunajaran = :tahunajaran:")
                ->orderBy("NamaProgram")
                ->bind(["tahunajaran" => $this->filter->sanitize($tahunajaran, "int")])
                ->execute();
        echo "<option value=\"\">---</option>";
        if (!count($cabang)) {
            return;
        }
        foreach ($cabang as $rec) {
            echo "<option value=\"" . $rec->RecID . "\">" . $rec->NamaProgram . "</option>";
        }
    }

    public function uploadhargaAction() {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "programharga",
                        "action" => "index"
            ));
        }

            // TOC-RB : Validate File Uploaded
    
            $fileUpload = $this->request->getUploadedFiles()[0];

//            if ($this->request->hasFiles() == true && $_POST['Program'] != "") {
            if ($fileUpload->getExtension() == "xlsx" || $fileUpload->getExtension() == "xls") {
//                 var_dump($fileUpload);
// die();
                try {
                    //$this->flash->notice('qweqwe');
                    $dataExcel = $this->excel->readHarga($fileUpload, "");

                    foreach ($dataExcel AS $key => $value) {
                        
                        $date = date_create_from_format("d/m/Y",$value["TanggalBerlaku"]);
                        $tgl_berlaku = date_format($date, "Y-m-d");
                        $masterbarcode = new programharga();

                        $masterbarcode->Program = $value['Program'];
                        $masterbarcode->HargaBimbingan = $value['HargaBimbingan'];
                        $masterbarcode->HargaPendaftaran = $value['HargaPendaftaran'];
                        $masterbarcode->TanggalBerlaku = $tgl_berlaku;
                        $masterbarcode->AreaCabang = $value['AreaCabang'];
                        $masterbarcode->SektorCabang = $value['SektorCabang'];
                      
                        if (!$masterbarcode->save()) {
                            $this->flash->error("Import detail excel gagal");
                            return $this->response->redirect("programharga/index");
                        }
                    }
                } catch (Exception $e) {
                    //var_dump($e->getMessage());die();
                    $this->flash->error("Import data excel gagal");
                            return $this->response->redirect("programharga/index");
                }
            }

            $this->flash->success("Upload berhasil");
                            return $this->response->redirect("programharga/index");
    }
}