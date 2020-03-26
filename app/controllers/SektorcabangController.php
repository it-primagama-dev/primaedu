<?php


class SektorcabangController extends ControllerBase
{
    public function initialize() {
        $this->tag->setTitle('Sektor Cabang');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        } 
        $this->view->rpt_title = 'Sektor Cabang';
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
        foreach($_POST['Cabang'] AS $key=>$val)
        //foreach($_POST['Jawaban'] as $idd) 
        {
        $Cabang = $_POST['Cabang'][$key];
        $Sektor = $_POST['Sektor'][$key];
       // $sarann = $_POST['isisaran'];            

        $sql = "UPDATE areacabang
                SET Sektor = '$Sektor'
                WHERE RecID = '$Cabang'";

                $query = $this->getDI()->getShared('db')->query($sql);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
    }
        
        $this->flash->success("Data Sektor Cabang Berhasil Disimpan...");
        return $this->dispatcher->forward(array(
            "controller" => "sektorcabang",
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

    public function detailcabangAction() {

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);

        $RecID = $this->request->getPost("Area");

        $sql2="select a.RecID, a.KodeAreaCabang, a.NamaAreaCabang, a.Sektor from areacabang a join areacabang b on a.Area = b.KodeAreaCabang where b.RecID = '$RecID' and a.Aktif = '1'";
        $q = $this->getDI()->getShared('db')->query($sql2);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->resultt = $q->fetchAll($q);        
    }

}

