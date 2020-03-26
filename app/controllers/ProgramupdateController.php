<?php
 
class ProgramupdateController extends ControllerBase
{
    public function initialize() {
        $this->tag->setTitle('Update Program');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        } 
        $this->view->rpt_title = 'Update Program';
    }

    public function indexAction() {

        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('Area', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
    
    }

    public function saveAction()
    {
        
        if (isset($_POST["submit"]))
        //if (isset($_POST["Jawaban"]))
        foreach($_POST['psiswa'] AS $key=>$val)
        //foreach($_POST['Jawaban'] as $idd) 
        {
        $psiswa = $_POST['psiswa'][$key];
        $program = $_POST['Program'][$key];
       // $sarann = $_POST['isisaran'];            

        if ($program==0) {

        } else {
        $sql = "UPDATE programsiswa
                SET program = '$program'
                WHERE RecID = '$psiswa'";

                $query = $this->getDI()->getShared('db')->query($sql);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
            }
    }
        
        $this->flash->success("Data berhasil diubah...");
        return $this->dispatcher->forward(array(
            "controller" => "Programupdate",
            "action" => "index"
        ));

    }

    public function editAction($RecID) {
        if (!$this->request->isPost()) {
            // TOC-RB 3 Juli 2015
            $cabang = Areacabang::findFirstByRecID($RecID);

            $this->tag->setDefaults($cabang->toArray());
            $this->tag->setDefault("NamaCabang", $cabang->NamaAreaCabang);
            // View Components
            $this->view->RecID = $cabang->RecID;
            $this->view->area = Areacabang::find(array(
                "Area IS NULL", "order" => "KodeAreaCabang"
            ));
            $this->view->propinsi = Propinsi::find();
            $this->view->kotakab = Kotakab::findByPropinsi($cabang->Propinsi);
            $this->view->branchcode = $cabang->KodeAreaCabang;
            $this->view->sektor = $cabang->Sektor;
            $this->view->bank = Bank::find();
        }
    }

public function saveeditAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "sektorcabang",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $areacabang = Areacabang::findFirstByRecID($RecID);

        $areacabang->Sektor = $this->request->getPost("Sektor");
        

        if (!$areacabang->save()) {

            foreach ($areacabang->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "sektorcabang",
                "action" => "edit",
                "params" => $areacabang->RecID
            ));
        }

        $this->flash->success("Sektor Cabang Berhasil diubah");

        return $this->dispatcher->forward(array(
            "controller" => "sektorcabang",
            "action" => "index"
        ));

    }

    public function programsiswaAction() {

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);

        $this->view->program = Program::find(["tahunajaran='4'", "order" => "RecID"]);
        $RecID = $this->request->getPost("Cabang");

        $sql2="SELECT ps.RecID as Id, s.VirtualAccount, s.NamaSiswa, p.NamaProgram, p.tahunajaran  from programsiswa ps
        join siswa s on ps.siswa = s.RecID
        join areacabang c on s.Cabang = c.RecID
        join Program p on ps.Program = p.RecID
        where c.RecID='$RecID' and p.tahunajaran !='1' and p.tahunajaran !='2' and p.tahunajaran !='3'
	order by s.VirtualAccount";
        $q = $this->getDI()->getShared('db')->query($sql2);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->resultt = $q->fetchAll($q);        
    }

}

