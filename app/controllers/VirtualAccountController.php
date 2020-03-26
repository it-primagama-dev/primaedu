<?php

use Phalcon\Mvc\Model\Criteria; 
use Phalcon\Paginator\Adapter\Model as Paginator;

class VirtualAccountController extends ControllerBase {

    protected $auth;
    protected $isAdmin;

    public function initialize() {
        $this->tag->setTitle("Virtual Account");
        parent::initialize();
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
            $this->isAdmin = $this->auth["Virtualaccountlist"] ? FALSE : TRUE;
            $this->view->admin = $this->isAdmin;
        }
    }

    public function indexAction() {
        
    }

    public function createAction() {
        $KodeCabang = $this->request->getPost("KodeCabang");
        $NoVaDari = $this->request->getPost("NoVaDari");
        $NoVaSampai = $this->request->getPost("NoVaSampai");
        $jenis = $this->request->getPost("Jenis");
        $tahunAjaranRecId = $this->request->getPost("TahunAjaran");
        
        $tahunAjaran = Tahunajaran::findFirstByRecID($tahunAjaranRecId);

        if ($NoVaDari > $NoVaSampai) {
            ?>
            <meta http-equiv='refresh' content='0; url=index'>
            <script type="text/javascript">
                alert("Data Gagal disimpan No Va sampai tidak boleh kurang No VA dari...!!!");
            </script>
            <?php
        } else {

            if($jenis == "old") {
                $sql = "exec TOC_CreateVirtualAccountListPerCabang '" . $KodeCabang . "', '" . $NoVaDari . "', '" . $NoVaSampai . "'";
            }else{
                $sql = "EXEC TOC_CreateVirtualAccountListPerCabangNew '" . $KodeCabang . "', " . $NoVaDari . ", " . $NoVaSampai . ", '".$tahunAjaran->Description."'";
            }
            //var_dump($sql);die();
            

            $query = $this->getDI()->getShared('db')->query($sql);
            $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

            if (!$query) {
                ?>
                <meta http-equiv='refresh' content='0; url=index'>
                <script type="text/javascript">
                    alert("Data Gagal disimpan pastikan jaringan anda stabil...!!!");
                </script>
                <?php
            } else {
                ?>
                <meta http-equiv='refresh' content='0; url=index'>
                <script type="text/javascript">
                    alert("Data Berhasil Disimpan...!!!");
                </script>
                <?php
            }
        }
    }

    public function tambahAction($jenis, $id) {
        $this->view->Jenis = $jenis;
        $this->view->KodeCabang = $id;
        $sql2 = "";
        if ($jenis == "old") {
            $sql2 = "SELECT top 1  (KodeSiswa + 1) as KodeSiswa from Virtualaccountlist where KodeCabang = '$id' order by RecID desc";
        } else {
            $sql2 = "SELECT top 1  (KodeSiswa + 1) as KodeSiswa from VirtualAccountListNew where KodeCabang = '$id' order by RecID desc";
        }

        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $count = $query2->numRows();
        $temp = $query2->fetchAll($query2);
        foreach ($temp as $row) {
            $NoVaDari = $row->KodeSiswa;
        }
        if ($count > 0) {
            $this->view->NoVaDari = $NoVaDari;
        } else {
            $this->view->NoVaDari = '1';
        }

        $tahunAjaranList = Tahunajaran::find();
        $this->view->TahunAjaran = $tahunAjaranList;
    }

    public function getLastNewVirtualAccountAction() {
        $kodeCabang = $this->request->getPost("kc");
        $tahun = $this->request->getPost("th", "int");
        $lastVa = 0;

        $sql = "SELECT top 1 KodeSiswa from VirtualAccountListNew where KodeCabang = '$kodeCabang' AND TahunAjaran = $tahun order by RecID desc";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        if ($query->numRows() > 0) {
            $vaList = $query->fetchAll($query);
            foreach ($vaList as $row) {
                $va_without_prefix = substr($row->KodeSiswa, 2);
                $lastVa = intval($va_without_prefix);
            }
        }

        $response = array(
            'kode_cabang' => $kodeCabang,
            'tahun' => $tahun,
            'last_va' => $lastVa
        );
        
        header('Content-type: application/json');
        echo json_encode($response);
        exit();
    }

    public function searchAction() {
        $jenis_va = ($this->request->getPost("jenis_va")!=null)?$this->request->getPost("jenis_va"):$this->request->getQuery("jenis");
        $kode = $this->request->getPost("KodeCabang");
        $sql = "SELECT * FROM areacabang WHERE Area is not null AND KodeAreaCabang = '$kode'";
        $result = $this->getDI()->getShared('db')->query($sql);
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $cek = $result->numRows();

        if (isset($kode) && $cek == 0) {
            $this->view->disable();
            ?>
            <meta http-equiv='refresh' content='0; url=index'>
            <script type="text/javascript">
                alert("Kode cabang yang anda masukkan tidak ada di sistem, silakan masukkan dengan benar...!!!");
            </script>
            <?php
        }

        $numberPage = 1;
        $query = (object) array();
        if ($this->request->isPost()) {
            if ($jenis_va == "old") {
                $query = Criteria::fromInput($this->di, "Virtualaccountlist", array('KodeCabang' => $kode));
            } else {
                $query = Criteria::fromInput($this->di, "VirtualAccountListNew", array('KodeCabang' => $kode));
            }

            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }
        
        $user = (object) array();
        if ($jenis_va == "old") {
            $user = Virtualaccountlist::find($parameters);
        }else{
            $user = VirtualAccountListNew::find($parameters);
        }
        

        $paginator = new Paginator(array(
            "data" => $user,
            "limit" => 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
        $this->view->KodeCabang = $this->request->getPost("KodeCabang");
        $this->view->Jenis = $jenis_va;
    }

}
