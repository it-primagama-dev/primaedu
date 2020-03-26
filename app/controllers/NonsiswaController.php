<?php

class NonsiswaController extends ControllerBase {

    protected $auth;
    
    public function initialize() {
        $this->tag->setTitle("Daftar Non Siswa");
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
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
    }

    public function loadSiswaAction()
    {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        
        $sql = "SELECT *,
                (select count(recid) from siswa where NamaSiswa=nama) as status
                from dataNonSiswa order by id desc";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);

        $Siswa = Siswa::find();

        $no = 1;
        $output = array('data' => array());
        foreach($result as $row) {            
	if($row->status!='0'){
                    $status = 'Sudah Join';
                } else {
                    $status = 'Belum Join';
                }
            $mailto = '<a href="mailto:'.$row->email.'">'.$row->email.'</a>';
            $cabang = ''.$row->kodecabang.' - '.$row->namaareacabang.'';
            $output['data'][] = array(
                $no,
                $row->nama,
                $mailto,
                $row->phone,
                $row->jenjang,
                $cabang,
                $this->tgl_indo(date('Y-m-d',strtotime($row->created))),
		$status
            );
            $no++;
        }
        echo json_encode($output);
    }

    public function insertdatanonsiswaAction()
    {
        $this->view->disable();
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        
        $nonsiswa = new Datanonsiswa();

        $nonsiswa->id             = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('id'),ENT_QUOTES)));
        $nonsiswa->nama           = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('nama'),ENT_QUOTES)));
        $nonsiswa->email          = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('email'),ENT_QUOTES)));
        $nonsiswa->alamat         = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('alamat'),ENT_QUOTES)));
        $nonsiswa->phone          = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('phone'),ENT_QUOTES)));
        $nonsiswa->jenjang        = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('jenjang'),ENT_QUOTES)));
        $nonsiswa->emailcabang    = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('emailcabang'),ENT_QUOTES)));
        $nonsiswa->kodecabang     = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('kodecabang'),ENT_QUOTES)));
        $nonsiswa->namaarea       = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('namaarea'),ENT_QUOTES)));
        $nonsiswa->namaareacabang = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('namaareacabang'),ENT_QUOTES)));
        $nonsiswa->alamatcabang   = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('alamatcabang'),ENT_QUOTES)));
        $nonsiswa->phonecabang    = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('phonecabang'),ENT_QUOTES)));
        $nonsiswa->userfile       = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('userfile'),ENT_QUOTES)));
        $nonsiswa->created        = stripslashes(strip_tags(htmlspecialchars($this->request->getPost('created'),ENT_QUOTES)));
        $nonsiswa->modified       = stripslashes(strip_tags(htmlspecialchars(date('Y-m-d H:i:s'),ENT_QUOTES)));
        
        $id_cek = str_replace('%20', ' ', $this->request->getPost('id'));
        
        $sql = "DELETE FROM dataNonSiswa WHERE id ='$id_cek'";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        if (!$nonsiswa->save()) {
            foreach ($nonsiswa->getMessages() as $message) {
                $pesan = array('pesan'=>0,'kd'=>$message);
                echo json_encode($pesan);
            }
        } else {
            $pesan = array('pesan'=>1,'kd'=>$id_cek);
            echo json_encode($pesan);
        }
    }

    public function getareacabangAction()
    {
        $this->view->disable();
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        if (!empty($_POST['KodeAreaCabang'])) {
            $hasil = $_POST['KodeAreaCabang'];
        } else {
            $hasil = '0';
        }
        $sql = "WITH CTE AS (
            SELECT  *,ROW_NUMBER() OVER (ORDER BY RecID DESC) as RowNumber
            FROM areacabang
            where RecID not in ($hasil)
        )
        SELECT * FROM CTE WHERE RowNumber BETWEEN 1 AND 20";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);
        echo json_encode($result);
    }

}