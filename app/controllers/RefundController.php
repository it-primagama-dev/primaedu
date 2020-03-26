<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

//use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;
require_once('/../../public/cetak.php');
require_once('/../../public/phpmailer/PHPMailerAutoload.php');

class RefundController extends ControllerBase {

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Refund");
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        } else {
            header('Location: /');
        }
    }

    function _decode($sData) {
        $sKey = 'cjN6NHI0MzU=';
        $sResult = '';
        $sData = $this->decode_base64($sData);
        for ($i = base64_decode('MA=='); $i < strlen($sData); $i ++) {
            $sChar = substr($sData, $i, base64_decode('MQ=='));
            $sKeyChar = substr(base64_decode($sKey), ($i % strlen(base64_decode($sKey))) - base64_decode('MQ=='), base64_decode('MQ=='));
            $sChar = chr(ord($sChar) - ord($sKeyChar));
            $sResult .= $sChar;
        }
        return $sResult;
    }

    private function decode_base64($sData) {
        $sBase64 = strtr($sData, '-_', '+/');
        return $this->_decrypt(base64_decode($sBase64));
    }

    private function _decrypt($sData) {
        $len = strlen($sData);
        $i = base64_decode('MA==');
        $chr = "";
        while ($i < $len) {
            $ord = ord($sData[$i]);
            $pos = $ord - base64_decode('MTA=');
            $chr .= chr($pos);
            $i++;
        }
        return $chr;
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
            $bln = (int) $bln;
            return $data[$bln];
        }
    }

    function format_number($n = '') {
        return ($n === '') ? '' : 'Rp. ' . number_format((float) $n, 2, ',', '.');
    }

    function tgl_indo($tgl = '') {
        if (!empty($tgl)) {
            $pisah = explode('-', $tgl);
            return $pisah[2] . ' ' . $this->get_indo_bulan($pisah[1]) . ' ' . $pisah[0];
        }
    }

    public function cabangrefundAction() {
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        //$this->tag->setDefault('Area', $this->auth['areacabang']);
        //$this->view->rpt_auth = $this->auth;    
    }

    /**
     * Index action
     */
    public function indexAction() {
/*
        //buat nomor surat
        $sql = "SELECT MAX(RIGHT(NoSurat,7)) AS KodeMax FROM nosuratpernyataan";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $numRows = $query->numRows();
        $result = $query->fetchAll($query);
        $kd = "";
        if ($numRows > 0) {
            foreach ($result as $row) {
                $tmp = ((int) $row->KodeMax) + 1;
                $kd = sprintf("%07s", $tmp);
            }
        } else {
            $kd = 'RF' . date('ymd') . '0000001';
        }
        $KodeMax = 'RF' . date('ymd') . $kd;

        $KodeCabang = $this->auth['kodeareacabang'];
        $TahunAjaran = date('Y-m-d H:i:s');
        $sql = "INSERT into nosuratpernyataan values ('$KodeMax','$KodeCabang','$TahunAjaran')";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->kdcabang = $KodeCabang;

        

        //set awal nomor surat ketika tahun ajaran baru.
        $sql = "SELECT MAX(cast(TahunAjaran as date)) AS TahunAjaran FROM nosuratpernyataan";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);
        $thn = date('Y') . '-07-01';
        foreach ($result as $row) {
            if ($row->TahunAjaran == $thn) {
                $sql = "DELETE FROM nosuratpernyataan";
                $query = $this->getDI()->getShared('db')->query($sql);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
            }
        }
*/

// this always increment when user refreshing page, i dont know why, previous programmer made it, i am just continue the project :D kwkwkw
        /**
         * The problem is user can't get letter number when on date(m-d) = "07-01"
         * 
         * Solved by Moh Eric 
         * Pseudocode :
         * 1. Cek apakah ditable nosuratpernyataan sudah pernah diinsert tahun ajaran >=(lebih besar sama dg) th saat ini bulan 7 tgl 1 ?
         * 2. Jika belum, cek apakah masih ada data tahun ajaran <=(lebih kecil sama dg) tahun saat ini bulan 6 tgl 30 ?
         *    2.1. Jika masih ada, delete semua nosuratpernyataan yg tahun ajarannya <=(lebih kecil sama dg) tahun ini bulan 6 tgl 30, dan insert dg tahun ajaran baru (th saat ini bulan 7 tgl 1)
         * 3. Jika sudah, insert dg tahun ajaran sekarang
         * 
         */
        $tahunAjaranBaru = date('Y') . "-07-01";
        $noSuratPernyataan = Nosuratpernyataan::find(array(
                    'conditions' => "cast(TahunAjaran as date) >= '" . $tahunAjaranBaru . "'",
                    'columns' => 'NoSurat, KodeCabang, TahunAjaran'
                ))->toArray();
        if (count($noSuratPernyataan) > 0) {
            $this->setNextNoSuratPernyataanByKodeCabang($this->auth['kodeareacabang']);
        } else {
            $tahunAjaranLama = ((int)(date('Y')) - 1) . "-06-30";
            $oldNoSuratPernyataan = Nosuratpernyataan::find(array(
                        'conditions' => "cast(TahunAjaran as date) <= '" . $tahunAjaranLama . "'",
                        'columns' => 'NoSurat, KodeCabang, TahunAjaran'
                    ))->toArray();
            if (count($oldNoSuratPernyataan) > 0) {
                $this->db->delete("nosuratpernyataan", "cast(TahunAjaran as date) <= '" . $tahunAjaranLama . "'");
            }
            $this->setNextNoSuratPernyataanByKodeCabang($this->auth['kodeareacabang']);
        }
// the end of revised

        $TahunAjaran = tahunajaran::query()
                ->columns(array("*"))
                ->execute();
        $this->view->TahunAjaran = $TahunAjaran;

        $areaCabangId = $this->session->get('auth')["areacabang"];
        $areaCabang = Areacabang::findFirst("RecID = " . $areaCabangId);
        $this->view->areaCabang = new Areacabang();
        if (count($areaCabang) > 0) {
            $this->view->areaCabang = $areaCabang;
        }

        $this->view->noSurat = "";
        if ($this->request->get("id") != NULL) {
            //download surat
            $noSurat = $this->request->get("id");
            $this->view->noSurat = $noSurat;
        }

        $this->view->jenisPengalihanList = $this->refundConfig->jenisPengalihan;
        $this->view->tipeTransaksiList = $this->refundConfig->tipeTransaksi;
    }

    public function lihatRefundSiswaAction() {
        $err_code = 0;
        $refund = array();
        $siswaBenar = array();
        $transaksiBank = array();

        $id = isset($_GET['id']) ? $_GET['id'] : "";
        if ($id == "") {
            $err_code++;
        }

        if ($err_code == 0) {
            try {
                $refund = Refund::findFirst(["RecID = :value:", 'bind' => ['value' => $id]]);
            } catch (\Exception $e) {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            if ($refund->count() > 0) {
                $rows = $refund;
                $this->view->RefundRecID = $rows->RecID;
                $this->view->NoSuratPernyataan = $rows->NoSuratPernyataan;
                $this->view->NamaPembuatPernyataan = $rows->NamaPembuatPernyataan;
                $this->view->JabatanPembuatPernyataan = $rows->JabatanPembuatPernyataan;
                $this->view->TelpCabang = $rows->TelpCabang;
                $this->view->AlamatCabang = $rows->AlamatCabang;
                $this->view->NoVaSalah = $rows->NoVaSalah;
                $this->view->NoVaBenar = $rows->NoVaBenar;
                $this->view->TanggalTransfer = $rows->TanggalTransfer;
                $this->view->LebihNominal = $rows->LebihNominal;
                $this->view->Nominal = $rows->Nominal;
                $this->view->Kronologi = $rows->Kronologi;
                $this->view->TrackAccountReceivable = strtoupper($rows->TrackFinance);
                $this->view->TrackFinance = strtoupper($rows->TrackGM);
                $this->view->Keterangan = $rows->Keterangan;
                $this->view->KeteranganGM = $rows->KeteranganGM;
                $this->view->tgl = $this->tgl_indo(date('Y-m-d', strtotime($rows->Modified)));
                $this->view->jam = date('H:i:s', strtotime($rows->Modified));
                $this->view->tglGM = $this->tgl_indo(date('Y-m-d', strtotime($rows->ModifiedGM)));
                $this->view->jamGM = date('H:i:s', strtotime($rows->ModifiedGM));
                $this->view->TahunAjaran = $rows->TahunAjaran;
                $this->view->TransaksiBankRecID = $rows->kodeTB;
            } else {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            try {
                $branchCode = substr($refund->NoVaSalah, 0, 4);
                $query = "SELECT transaksibank.RecID, siswa.NamaSiswa, tahunajaran.Description as TahunAjaranName  
                FROM transaksibank 
                JOIN siswa ON siswa.RecID = transaksibank.Siswa  
                JOIN areacabang ON areacabang.RecID = siswa.Cabang 
                JOIN tahunajaran ON tahunajaran.RecID = transaksibank.tahunajaran 
                WHERE transaksibank.KodeCabang = '" . $branchCode . "' 
                AND transaksibank.tahunajaran = " . $refund->TahunAjaran . "  
                AND transaksibank.NoVA = '" . $refund->NoVaSalah . "'
                ";
                $query = $this->getDI()->getShared('db')->query($query);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
                $transaksiBank = $query->fetch($query);
            } catch (\Exception $e) {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            if ($transaksiBank) {
                $this->view->TbRecID = $transaksiBank->RecID;
                $this->view->NamaSiswaSalah = $transaksiBank->NamaSiswa;
                $this->view->TahunAjaranName = $transaksiBank->TahunAjaranName;
            } else {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            try {
                $branchCode = substr($refund->NoVaBenar, 0, 4);
                $vaBenar = substr($refund->NoVaBenar, 4);
                $query = "
                SELECT siswa.RecID, siswa.NamaSiswa 
                FROM siswa 
                JOIN areacabang ON  areacabang.RecID = siswa.Cabang 
                WHERE areacabang.KodeAreaCabang = '" . $branchCode . "' AND siswa.VirtualAccount = '" . $vaBenar . "' 
                ";
                $query = $this->getDI()->getShared('db')->query($query);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
                $siswaBenar = $query->fetch($query);
            } catch (\Exception $e) {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            if ($siswaBenar) {
                $this->view->NamaSiswaBenar = $siswaBenar->NamaSiswa;
            } else {
                $err_code++;
            }
        }

        if ($err_code > 0) {
            $this->response->redirect("refund");
        }
    }

    public function lihatRefundNominalAction() {
        $err_code = 0;
        $refund = array();
        $transaksiBank = array();

        $id = isset($_GET['id']) ? $_GET['id'] : "";
        if ($id == "") {
            $err_code++;
        }

        if ($err_code == 0) {
            try {
                $refund = Refund::findFirst(["RecID = :value:", 'bind' => ['value' => $id]]);
            } catch (\Exception $e) {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            if ($refund) {
                $rows = $refund;
                $this->view->RefundRecID = $rows->RecID;
                $this->view->NoSuratPernyataan = $rows->NoSuratPernyataan;
                $this->view->NamaPembuatPernyataan = $rows->NamaPembuatPernyataan;
                $this->view->JabatanPembuatPernyataan = $rows->JabatanPembuatPernyataan;
                $this->view->TelpCabang = $rows->TelpCabang;
                $this->view->AlamatCabang = $rows->AlamatCabang;
                $this->view->NoVa = $rows->NoVaBenar;
                $this->view->TanggalTransfer = $rows->TanggalTransfer;
                $this->view->LebihNominal = $rows->LebihNominal;
                $this->view->Nominal = $rows->Nominal;
                $this->view->SelisihNominal = $rows->Selisih;
                $this->view->Kronologi = $rows->Kronologi;
                $this->view->TrackAccountReceivable = strtoupper($rows->TrackFinance);
                $this->view->TrackFinance = strtoupper($rows->TrackGM);
                $this->view->Keterangan = $rows->Keterangan;
                $this->view->KeteranganGM = $rows->KeteranganGM;
                $this->view->tgl = $this->tgl_indo(date('Y-m-d', strtotime($rows->Modified)));
                $this->view->jam = date('H:i:s', strtotime($rows->Modified));
                $this->view->tglGM = $this->tgl_indo(date('Y-m-d', strtotime($rows->ModifiedGM)));
                $this->view->jamGM = date('H:i:s', strtotime($rows->ModifiedGM));
                $this->view->TahunAjaran = $rows->TahunAjaran;
                $this->view->TransaksiBankRecID = $rows->kodeTB;
            } else {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            try {
                $query = "SELECT transaksibank.RecID, siswa.NamaSiswa, tahunajaran.Description as TahunAjaranName  
                FROM transaksibank 
                JOIN siswa ON siswa.RecID = transaksibank.Siswa  
                JOIN areacabang ON areacabang.RecID = siswa.Cabang 
                JOIN tahunajaran ON tahunajaran.RecID = transaksibank.tahunajaran 
                WHERE transaksibank.KodeCabang = '" . $refund->CreateBy . "' 
                AND transaksibank.tahunajaran = " . $refund->TahunAjaran . "  
                AND transaksibank.NoVA = '" . $refund->NoVaBenar . "'
                ";
                $query = $this->getDI()->getShared('db')->query($query);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
                $transaksiBank = $query->fetch($query);
            } catch (\Exception $e) {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            if ($transaksiBank) {
                $this->view->TbRecID = $transaksiBank->RecID;
                $this->view->NamaSiswa = $transaksiBank->NamaSiswa;
                $this->view->TahunAjaranName = $transaksiBank->TahunAjaranName;
            } else {
                $err_code++;
            }
        }

        if ($err_code > 0) {
            $this->response->redirect("refund");
        }
    }

    public function lihatRefundDoubleAction() {
        $err_code = 0;
        $refund = array();
        $transaksiBank = array();
        $transaksiBankSecondary = array();

        $id = isset($_GET['id']) ? $_GET['id'] : "";
        if ($id == "") {
            $err_code++;
        }

        if ($err_code == 0) {
            try {
                $refund = Refund::findFirst(["RecID = :value:", 'bind' => ['value' => $id]]);
            } catch (\Exception $e) {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            if ($refund) {
                $rows = $refund;
                $this->view->RefundRecID = $rows->RecID;
                $this->view->NoSuratPernyataan = $rows->NoSuratPernyataan;
                $this->view->NamaPembuatPernyataan = $rows->NamaPembuatPernyataan;
                $this->view->JabatanPembuatPernyataan = $rows->JabatanPembuatPernyataan;
                $this->view->TelpCabang = $rows->TelpCabang;
                $this->view->AlamatCabang = $rows->AlamatCabang;
                $this->view->NoVa = $rows->NoVaBenar;
                $this->view->TanggalTransfer = $rows->TanggalTransfer;
                $this->view->LebihNominal = $rows->LebihNominal;
                $this->view->Nominal = $rows->Nominal;
                $this->view->SelisihNominal = $rows->Selisih;
                $this->view->Kronologi = $rows->Kronologi;
                $this->view->TrackAccountReceivable = strtoupper($rows->TrackFinance);
                $this->view->TrackFinance = strtoupper($rows->TrackGM);
                $this->view->Keterangan = $rows->Keterangan;
                $this->view->KeteranganGM = $rows->KeteranganGM;
                $this->view->tgl = $this->tgl_indo(date('Y-m-d', strtotime($rows->Modified)));
                $this->view->jam = date('H:i:s', strtotime($rows->Modified));
                $this->view->tglGM = $this->tgl_indo(date('Y-m-d', strtotime($rows->ModifiedGM)));
                $this->view->jamGM = date('H:i:s', strtotime($rows->ModifiedGM));
                $this->view->TahunAjaran = $rows->TahunAjaran;
                $this->view->TransaksiBankRecID = $rows->kodeTB;
                $this->view->TransaksiBankRecIDSecondary = $rows->kodeTB2;
            } else {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            try {
                $query = "SELECT transaksibank.RecID, siswa.NamaSiswa, transaksibank.Nominal, transaksibank.NoVA, transaksibank.TanggalTransaksi, transaksibank.tahunajaran, tahunajaran.Description as TahunAjaranName  
                FROM transaksibank 
                JOIN siswa ON siswa.RecID = transaksibank.Siswa  
                JOIN areacabang ON areacabang.RecID = siswa.Cabang 
                JOIN tahunajaran ON tahunajaran.RecID = transaksibank.tahunajaran 
                WHERE transaksibank.KodeCabang = '" . $refund->CreateBy . "' 
                AND transaksibank.tahunajaran = " . $refund->TahunAjaran . "  
                AND transaksibank.NoVA = '" . $refund->NoVaBenar . "'
                ";
                $query = $this->getDI()->getShared('db')->query($query);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
                $transaksiBank = $query->fetch($query);
            } catch (\Exception $e) {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            if ($transaksiBank) {
                $this->view->TbRecID = $transaksiBank->RecID;
                $this->view->NamaSiswa = $transaksiBank->NamaSiswa;
                $this->view->Nominal = $transaksiBank->Nominal;
                $this->view->NoVA = $transaksiBank->NoVA;
                $this->view->TanggalTransaksi = $transaksiBank->TanggalTransaksi;
                $this->view->TahunAjaranID = $transaksiBank->tahunajaran;
                $this->view->TahunAjaranName = $transaksiBank->TahunAjaranName;
            } else {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            try {
                $query = "SELECT transaksibank.RecID, siswa.NamaSiswa, transaksibank.Nominal, transaksibank.NoVA, transaksibank.TanggalTransaksi, transaksibank.tahunajaran, tahunajaran.Description as TahunAjaranName  
                FROM transaksibank 
                JOIN siswa ON siswa.RecID = transaksibank.Siswa  
                JOIN areacabang ON areacabang.RecID = siswa.Cabang 
                JOIN tahunajaran ON tahunajaran.RecID = transaksibank.tahunajaran 
                WHERE transaksibank.KodeCabang = '" . $refund->CreateBy . "' 
                AND transaksibank.tahunajaran = " . $refund->TahunAjaran . "  
                AND transaksibank.NoVA = '" . $refund->NoVaBenar . "' 
                AND transaksibank.Nominal = " . $transaksiBank->Nominal . "
                ";
                $query = $this->getDI()->getShared('db')->query($query);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
                $transaksiBankSecondary = $query->fetch($query);
            } catch (\Exception $e) {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            if ($transaksiBankSecondary) {
                $this->view->TbRecIDSecondary = $transaksiBankSecondary->RecID;
                $this->view->NamaSiswaSecondary = $transaksiBankSecondary->NamaSiswa;
                $this->view->NominalSecondary = $transaksiBankSecondary->Nominal;
                $this->view->NoVASecondary = $transaksiBankSecondary->NoVA;
                $this->view->TanggalTransaksiSecondary = $transaksiBank->TanggalTransaksi;
                $this->view->TahunAjaranIDSecondary = $transaksiBankSecondary->tahunajaran;
                $this->view->TahunAjaranNameSecondary = $transaksiBankSecondary->TahunAjaranName;
            } else {
                $err_code++;
            }
        }

        if ($err_code > 0) {
            $this->response->redirect("refund");
        }
    }

    public function lihatRefundCabangAction() {
        $err_code = 0;
        $refund = array();
        $transaksiBank = array();

        $id = isset($_GET['id']) ? $_GET['id'] : "";
        if ($id == "") {
            $err_code++;
        }

        if ($err_code == 0) {
            try {
                $refund = Refund::findFirst(["RecID = :value:", 'bind' => ['value' => $id]]);
            } catch (\Exception $e) {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            if ($refund) {
                $rows = $refund;
                $this->view->RefundRecID = $rows->RecID;
                $this->view->NoSuratPernyataan = $rows->NoSuratPernyataan;
                $this->view->NamaPembuatPernyataan = $rows->NamaPembuatPernyataan;
                $this->view->JabatanPembuatPernyataan = $rows->JabatanPembuatPernyataan;
                $this->view->TelpCabang = $rows->TelpCabang;
                $this->view->AlamatCabang = $rows->AlamatCabang;
                $this->view->NoVa = $rows->NoVaSalah;
                $this->view->NoVaTujuan = $rows->NoVaBenar;
                $this->view->TanggalTransfer = $rows->TanggalTransfer;
                $this->view->LebihNominal = $rows->LebihNominal;
                $this->view->Nominal = $rows->Nominal;
                $this->view->SelisihNominal = $rows->Selisih;
                $this->view->Kronologi = $rows->Kronologi;
                $this->view->TrackAccountReceivable = strtoupper($rows->TrackFinance);
                $this->view->TrackFinance = strtoupper($rows->TrackGM);
                $this->view->Keterangan = $rows->Keterangan;
                $this->view->tgl = $this->tgl_indo(date('Y-m-d', strtotime($rows->Modified)));
                $this->view->jam = date('H:i:s', strtotime($rows->Modified));
                $this->view->tglGM = $this->tgl_indo(date('Y-m-d', strtotime($rows->ModifiedGM)));
                $this->view->jamGM = date('H:i:s', strtotime($rows->ModifiedGM));
                $this->view->TransaksiBankRecID = $rows->kodeTB;
                $this->view->TransaksiBankRecIDSecondary = $rows->kodeTB2;
                $this->view->TipeTrx = $rows->TipeTrx;
                $this->view->JenisDeposit = $rows->JenisDeposite;
            } else {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            try {
                $query = "SELECT transaksibank.RecID, transaksibank.Nominal, transaksibank.NoVA, transaksibank.TanggalTransaksi, areacabang.NamaAreaCabang
                FROM transaksibank 
                JOIN areacabang ON areacabang.KodeAreaCabang = transaksibank.KodeCabang
                WHERE transaksibank.RecID = " . $refund->kodeTB . "
                ";
                $query = $this->getDI()->getShared('db')->query($query);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
                $transaksiBank = $query->fetch($query);
            } catch (\Exception $e) {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            if ($transaksiBank) {
                $this->view->TbRecID = $transaksiBank->RecID;
                $this->view->Nominal = $transaksiBank->Nominal;
                $this->view->NoVA = $transaksiBank->NoVA;
                $this->view->TanggalTransaksi = $transaksiBank->TanggalTransaksi;
                $this->view->NamaCabang = $transaksiBank->NamaAreaCabang;
            } else {
                $err_code++;
            }
        }
//        var_dump($transaksiBank);
//        die();

        $this->view->jenisPengalihanList = $this->refundConfig->jenisPengalihan;
        $this->view->tipeTransaksiList = $this->refundConfig->tipeTransaksi;

        if ($err_code > 0) {
            $this->response->redirect("refund");
        }
    }

    public function createSiswaRefundAction() {
        $helper = new Helpers();
        $kodeCabang = $this->auth['kodeareacabang'];
        $kodeMax = $this->getNextNoSuratPernyataanByKodeCabang($kodeCabang);

        $namapembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("namapembuatpernyataan"));
        $jabatanpembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("jabatanpembuatpernyataan"));
        $telpcabang = $helper->convertHtmlEntities($this->request->getPost("telpcabang"));
        $alamatcabang = $helper->convertHtmlEntities($this->request->getPost("alamatcabang"));
        $novasalah = $this->request->getPost("va_siswa_salah");
        $namasalah = $this->request->getPost("nama_siswa_salah");
        $novabenar = $this->request->getPost("va_siswa_benar");
        $namabenar = $this->request->getPost("nama_siswa_benar");
        $tanggaltransfer = $this->request->getPost("tanggaltransfer");
        $nominal = $this->request->getPost("nominal", "int");
        $nominal11Persen = (11 / 100) * $nominal;
        $kronologi = "Telah terjadi kesalahan transfer dengan nomor VA " . $novasalah . " atas nama " . $namasalah . " "
                . "seharusnya transfer ke nomor VA " . $novabenar . " atas nama " . $namabenar . " "
                . "sejumlah Rp " . $helper->rupiah($nominal) . ". <br/><br/>Mohon dapat dilakukan refund 11% Rp. " . $helper->rupiah($nominal11Persen) . " atas kesalahan transfer tersebut.";
        $jumlahtransfer = $this->request->getPost("nominal");
        $TahunAjaran = $this->request->getPost("TahunAjaran");
        $TahunAjaranID = $this->request->getPost("TahunAjaranID");
        $kodeTB = $this->request->getPost("TbRecID");

        $sql_save = "EXEC dbo.TOC_CreateRefund
        @NoSuratPernyataan          = '" . $kodeMax . "',
        @JenisRefund                = 'Refund Siswa',
        @NamaPembuatPernyataan      = '" . $namapembuatpernyataan . "',
        @JabatanPembuatPernyataan   = '" . $jabatanpembuatpernyataan . "',
        @TelpCabang                 = '" . $telpcabang . "',
        @AlamatCabang               = '" . $alamatcabang . "',
        @NoVaSalah                  = '" . $novasalah . "',
        @NoVaBenar                  = '" . $novabenar . "',
        @TanggalTransfer            = '" . $tanggaltransfer . "',
        @LebihNominal               = null,
        @Nominal                    = '" . $nominal . "',
        @Kronologi                  = '" . $kronologi . "',
        @CreateBy                   = '" . $kodeCabang . "',
        @TrackFinance               = 'Pending',
        @TrackGM                    = 'Pending',
        @JenisDeposite              = null,
        @Deposite                   = null,
        @Created                    = '" . date('Y-m-d H:i:s') . "',
        @Modified                   = null,
        @ModifiedGM                 = null,
        @Keterangan                 = null,
        @KeteranganGM               = null,
        @DepositIsUsing             = null,
        @ApprovedBy                 = null,
        @ApprovedByGM               = null,
        @Selisih                    = null,
        @tahunajaran                = " . $TahunAjaranID . ",
        @kodeTB                     = '" . $kodeTB . "',
        @kodeTB2                    = null,
        @TipeTrx                    = null";

        $query_save = $this->getDI()->getShared('db')->query($sql_save);
        $query_save->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $kodeAreaCabangBenar = substr($novabenar, 0, 4);
        $kodeAreaCabangSalah = substr($novasalah, 0, 4);
        //if branch not equal send email
        if ($kodeAreaCabangBenar != $kodeAreaCabangSalah) {
            $this->sendEmailSiswaRefundAction($novasalah, $tanggaltransfer, $jumlahtransfer, $novabenar);
        }

        $this->response->redirect("refund?id=" . $kodeMax);
    }

    public function updateSiswaRefundAction() {
        $helper = new Helpers();
        $kodeCabang = $this->auth['kodeareacabang'];
        $refundRecID = $this->request->getPost("RefundRecID");
        $noSuratPernyataan = $this->request->getPost("NoSuratPernyataan");
        $namapembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("namapembuatpernyataan"));
        $jabatanpembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("jabatanpembuatpernyataan"));
        $telpcabang = $helper->convertHtmlEntities($this->request->getPost("telpcabang"));
        $alamatcabang = $helper->convertHtmlEntities($this->request->getPost("alamatcabang"));
        $novasalah = $this->request->getPost("va_siswa_salah");
        $namasalah = $this->request->getPost("nama_siswa_salah");
        $novabenar = $this->request->getPost("va_siswa_benar");
        $namabenar = $this->request->getPost("nama_siswa_benar");
        $tanggaltransfer = $this->request->getPost("tanggaltransfer");
        $nominal = $this->request->getPost("nominal", "int");
        $nominal11Persen = (11 / 100) * $nominal;
        $kronologi = "Telah terjadi kesalahan transfer dengan nomor VA " . $novasalah . " atas nama " . $namasalah . " "
                . "seharusnya transfer ke nomor VA " . $novabenar . " atas nama " . $namabenar . " "
                . "sejumlah Rp " . $helper->rupiah($nominal) . ". <br/><br/>Mohon dapat dilakukan refund 11% Rp. " . $helper->rupiah($nominal11Persen) . " atas kesalahan transfer tersebut.";
        $jumlahtransfer = $this->request->getPost("nominal");
        $TahunAjaran = $this->request->getPost("TahunAjaran");
        $TahunAjaranID = $this->request->getPost("TahunAjaranID");
        $kodeTB = $this->request->getPost("TransaksiBankRecID");

        //kirim email pemberitahuan pembatalan koreksi transfer jika va siswa yg salah berbeda dg va salah sebelumnya
        $q_refund = Refund::query()
                ->columns(array("*"))
                ->Where("RecID = " . $refundRecID)
                ->execute();
        if ($q_refund->count() > 0) {
            foreach ($q_refund as $rows) {
                if ($rows->NoVaSalah != $novasalah) {
                    $this->sendEmailCancelationAction($rows->NoVaSalah);
                }
            }
        }


        $sql = "UPDATE refund SET 
        NamaPembuatPernyataan      = '" . $namapembuatpernyataan . "',
        JabatanPembuatPernyataan   = '" . $jabatanpembuatpernyataan . "',
        TelpCabang                 = '" . $telpcabang . "',
        AlamatCabang               = '" . $alamatcabang . "',
        NoVaSalah                  = '" . $novasalah . "',
        NoVaBenar                  = '" . $novabenar . "',
        TanggalTransfer            = '" . $tanggaltransfer . "',
        LebihNominal               = null,
        Nominal                    = '" . $nominal . "',
        Kronologi                  = '" . $kronologi . "',
        CreateBy                   = '" . $kodeCabang . "',
        TrackFinance               = 'Pending',
        TrackGM                    = 'Pending',
        JenisDeposite              = null,
        Deposite                   = null,
        Created                    = '" . date('Y-m-d H:i:s') . "',
        Modified                   = null,
        ModifiedGM                 = null,
        Keterangan                 = null,
        KeteranganGM               = null,
        DepositIsUsing             = null,
        ApprovedBy                 = null,
        ApprovedByGM               = null,
        Selisih                    = null,
        tahunajaran                = " . $TahunAjaranID . ",
        kodeTB                     = '" . $kodeTB . "' 
        WHERE RecID                = '" . $refundRecID . "'";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $kodeAreaCabangBenar = substr($novabenar, 0, 4);
        $kodeAreaCabangSalah = substr($novasalah, 0, 4);
        //if branch not equal send email
        if ($kodeAreaCabangBenar != $kodeAreaCabangSalah) {
            $this->sendEmailSiswaRefundAction($novasalah, $tanggaltransfer, $jumlahtransfer, $novabenar);
        }

        $this->response->redirect("refund/lihatRefundSiswa?id=" . $refundRecID);
    }

    public function sendEmailSiswaRefundAction($vaSalah = "", $tglTransfer = "", $jumlahTransfer = 0, $vaBenar = "") {
        $helper = new Helpers();

        $kodeAreaCabangBenar = substr($vaBenar, 0, 4);
        $kodeAreaCabangSalah = substr($vaSalah, 0, 4);
        $nominal89Persen = $jumlahTransfer * 89 / 100;

        $namaAreaCabang = "";
        $telp = "";
        $noRekBCA = "";
        $namaRekBCA = "";
        $emailPengirim = "";

        $kodeAreaCabang = $this->session->get('auth')["kodeareacabang"];
        $sql_cabangview = "SELECT * FROM cabangview WHERE KodeAreaCabang = '$kodeAreaCabang'";
        $query_cabangview = $this->getDI()->getShared('db')->query($sql_cabangview);
        $query_cabangview->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result_cabangview = $query_cabangview->fetch($query_cabangview);
        if (count($result_cabangview) > 0) {
            $namaAreaCabang = $result_cabangview->NamaAreaCabang;
            $telp = $result_cabangview->NoTelp;
            $noRekBCA = $result_cabangview->NoRekBCA;
            $namaRekBCA = $result_cabangview->NamaRekBCA;
            $emailPengirim = $result_cabangview->Email;
        }

        $namaCabang = "";
        $emailPenerima = "";
        $area_cabang = Areacabang::findFirst("KodeAreaCabang = '" . $kodeAreaCabangSalah . "'");
        if (count($area_cabang) > 0) {
            $namaCabang = $area_cabang->NamaAreaCabang;
            $emailPenerima = $area_cabang->Email;
        }

        $content = "<div style='font-family: Lucida Sans Typewriter'>
                Yth Bapak/Ibu Cabang " . $namaCabang . ",<br/><br/>
                Berdasarkan informasi dari <b>cabang " . $namaAreaCabang . "</b>, kami "
                . "ingin menyampaikan bahwa pada <b>tanggal " . $helper->tanggalFormat($tglTransfer) . "</b> "
                . "Primagama cabang " . $namaAreaCabang . " melakukan <b>kesalahan transfer</b> sebesar "
                . "<b>Rp. " . $helper->rupiah($jumlahTransfer) . "</b> <i>(" . ltrim($this->terbilang($jumlahTransfer)) . " rupiah)</i> seharusnya <b>yang benar "
                . "ke VA " . $vaBenar . "</b> tetapi salah ke VA " . $vaSalah . " sehingga <b>pengembalian "
                . "dana 89%</b> yang seharusnya masuk ke cabang " . $kodeAreaCabangBenar . " tetapi tertransfer "
                . "ke cabang " . $kodeAreaCabangSalah . ", untuk itu mohon untuk melakukan pengembalian dana "
                . "<b>sebesar Rp. " . $helper->rupiah($nominal89Persen) . "</b> <i>(" . ltrim($this->terbilang($nominal89Persen)) . " rupiah)</i> <b>ke Primagama "
                . "cabang " . $namaAreaCabang . " <i>(" . $kodeAreaCabangBenar . ")</i></b> dengan <b>nomor "
                . "rekening " . $noRekBCA . " a/n " . $namaRekBCA . " bank BCA</b>.<br/>Informasi lebih lanjut silakan "
                . "hubungi PRIMAGAMA cabang " . $namaAreaCabang . " <b>No. Telp :" . $telp . "</b>.
                    
            <br><p>Demikian yang dapat kami sampaikan, terima kasih atas kerjasamanya.
            </div>";

        $emailBody = $helper->emailTemplate($content);
        $emailCC = array();
        if ($this->environmentConfig == "production") {
            $this->sendEmail("Kesalahan Transfer (VA Siswa)", $emailBody, $emailPenerima, $namaCabang);
        } else {
            $this->sendEmail("Kesalahan Transfer (VA Siswa)", $emailBody);
        }
    }

    public function sendEmailCancelationAction($vaSalah) {
        $helper = new Helpers();
        $kodeAreaCabangSalah = substr($vaSalah, 0, 4);
        $namaCabang = "";
        $emailPenerima = "";
        $area_cabang = Areacabang::findFirst("KodeAreaCabang = '" . $kodeAreaCabangSalah . "'");
        if (count($area_cabang) > 0) {
            $namaCabang = $area_cabang->NamaAreaCabang;
            $emailPenerima = $area_cabang->Email;
        }
        $content = "<div style='font-family: Lucida Sans Typewriter'>
                Yth Bapak/Ibu Cabang " . $namaCabang . ",<br/><br/>
                Menindak lanjuti email sebelumnya, kami "
                . "ingin menyampaikan bahwa <b>kesalahan transfer dibatalkan</b>.
                    
            <br><p>Demikian yang dapat kami sampaikan, terima kasih atas kerjasamanya.</p>
            </div>";

        $emailBody = $helper->emailTemplate($content);
        $emailCC = array();
        if ($this->environmentConfig == "production") {
            $this->sendEmail("Pembatalan Kesalahan Transfer", $emailBody, $emailPenerima, $namaCabang);
        } else {
            $this->sendEmail("Pembatalan Kesalahan Transfer", $emailBody);
        }
    }

    public function createNominalRefundAction() {
        $helper = new Helpers();
        $kodeCabang = $this->auth['kodeareacabang'];
        $kodeMax = $this->getNextNoSuratPernyataanByKodeCabang($kodeCabang);

        $namapembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("namapembuatpernyataan"));
        $jabatanpembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("jabatanpembuatpernyataan"));
        $telpcabang = $helper->convertHtmlEntities($this->request->getPost("telpcabang"));
        $alamatcabang = $helper->convertHtmlEntities($this->request->getPost("alamatcabang"));
        $va_siswa = $this->request->getPost("va_siswa");
        $nama_siswa = $this->request->getPost("nama_siswa");
        $tgl_transfer = $this->request->getPost("tgl_transfer");
        $nominal_salah = $this->request->getPost("nominal_salah");
        $nominal_benar = $this->request->getPost("nominal_benar");
        $nominal_selisih = $nominal_salah - $nominal_benar;
        $nominal_11_persen = (11 / 100) * $nominal_salah;
        $kronologi = "Telah terjadi kelebihan nominal transfer ke nomor VA " . $va_siswa . " atas nama " . $nama_siswa . ". "
                . "sebesar Rp. " . $helper->rupiah($nominal_selisih) . ". "
                . "<br/><br/>Mohon dapat dilakukan refund 11% dari Rp. " . $helper->rupiah($nominal_salah) . " yaitu Rp. " . $helper->rupiah($nominal_11_persen) . " atas kelebihan nominal transfer tersebut.";
        $TahunAjaran = $this->request->getPost("tahun_ajaran");
        $TahunAjaranID = $this->request->getPost("TahunAjaranID");
        $KodeTB = $this->request->getPost("TbRecID");

        $sql_save = "EXEC dbo.TOC_CreateRefund
        @NoSuratPernyataan          = '" . $kodeMax . "',
        @JenisRefund                = 'Refund Nominal',
        @NamaPembuatPernyataan      = '" . $namapembuatpernyataan . "',
        @JabatanPembuatPernyataan   = '" . $jabatanpembuatpernyataan . "',
        @TelpCabang                 = '" . $telpcabang . "',
        @AlamatCabang               = '" . $alamatcabang . "',
        @NoVaSalah                  = null,
        @NoVaBenar                  = '" . $va_siswa . "',
        @TanggalTransfer            = '" . $tgl_transfer . "',
        @LebihNominal               = '" . $nominal_salah . "',
        @Nominal                    = '" . $nominal_benar . "',
        @Kronologi                  = '" . $kronologi . "',
        @CreateBy                   = '" . $kodeCabang . "',
        @TrackFinance               = 'Pending',
        @TrackGM                    = 'Pending',
        @JenisDeposite              = null,
        @Deposite                   = null,
        @Created                    = '" . date('Y-m-d H:i:s') . "',
        @Modified                   = null,
        @ModifiedGM                 = null,
        @Keterangan                 = null,
        @KeteranganGM               = null,
        @DepositIsUsing             = null,
        @ApprovedBy                 = null,
        @ApprovedByGM               = null,
        @Selisih                    = '" . $nominal_selisih . "',
        @tahunajaran                = " . $TahunAjaranID . ",
        @kodeTB                     = '" . $KodeTB . "',
        @kodeTB2                    = null,
        @TipeTrx                    = null";

        $query_save = $this->getDI()->getShared('db')->query($sql_save);
        $query_save->setFetchMode(Phalcon\Db::FETCH_OBJ);

        //send email
        //$this->sendEmailNominalRefundAction($va_siswa, $nama_siswa, $tgl_transfer, $nominal_salah, $nominal_benar);

        $this->response->redirect("refund?id=" . $kodeMax);
    }

    public function updateNominalRefundAction() {
        $helper = new Helpers();
        $kodeCabang = $this->auth['kodeareacabang'];
        $refundRecID = $this->request->getPost("RefundRecID");
        $noSuratPernyataan = $this->request->getPost("NoSuratPernyataan");
        $namapembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("namapembuatpernyataan"));
        $jabatanpembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("jabatanpembuatpernyataan"));
        $telpcabang = $helper->convertHtmlEntities($this->request->getPost("telpcabang"));
        $alamatcabang = $helper->convertHtmlEntities($this->request->getPost("alamatcabang"));
        $va_siswa = $this->request->getPost("va_siswa");
        $nama_siswa = $this->request->getPost("nama_siswa");
        $tgl_transfer = $this->request->getPost("tgl_transfer");
        $nominal_salah = $this->request->getPost("nominal_salah");
        $nominal_benar = $this->request->getPost("nominal_benar");
        $nominal_selisih = $nominal_salah - $nominal_benar;
        $nominal_11_persen = (11 / 100) * $nominal_salah;
        $kronologi = "Telah terjadi kelebihan nominal transfer ke nomor VA " . $va_siswa . " atas nama " . $nama_siswa . ". "
                //. "sebesar Rp. " . $helper->rupiah($nominal_selisih) . ". "
                . "<br/><br/>Mohon dapat dilakukan refund 11% dari Rp. " . $helper->rupiah($nominal_salah) . " yaitu Rp. " . $helper->rupiah($nominal_11_persen) . " atas kelebihan nominal transfer tersebut.";
        $TahunAjaran = $this->request->getPost("tahun_ajaran");
        $TahunAjaranID = $this->request->getPost("TahunAjaranID");
        $kodeTB = $this->request->getPost("TransaksiBankRecID");

        $sql = "UPDATE refund SET 
        NamaPembuatPernyataan      = '" . $namapembuatpernyataan . "',
        JabatanPembuatPernyataan   = '" . $jabatanpembuatpernyataan . "',
        TelpCabang                 = '" . $telpcabang . "',
        AlamatCabang               = '" . $alamatcabang . "',
        NoVaSalah                  = null,
        NoVaBenar                  = '" . $va_siswa . "',
        TanggalTransfer            = '" . $tgl_transfer . "',
        LebihNominal               = '" . $nominal_salah . "',
        Nominal                    = '" . $nominal_benar . "',
        Kronologi                  = '" . $kronologi . "',
        CreateBy                   = '" . $kodeCabang . "',
        TrackFinance               = 'Pending',
        TrackGM                    = 'Pending',
        JenisDeposite              = null,
        Deposite                   = null,
        Created                    = '" . date('Y-m-d H:i:s') . "',
        Modified                   = null,
        ModifiedGM                 = null,
        Keterangan                 = null,
        KeteranganGM               = null,
        DepositIsUsing             = null,
        ApprovedBy                 = null,
        ApprovedByGM               = null,
        Selisih                    = '" . $nominal_selisih . "',
        tahunajaran                = " . $TahunAjaranID . ",
        kodeTB                     = '" . $kodeTB . "' 
        WHERE RecID                = '" . $refundRecID . "'";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->response->redirect("refund/lihatRefundNominal?id=" . $refundRecID);
    }

    public function sendEmailNominalRefundAction($vaSiswa = "", $namaSiswa = "", $tglTransfer = "", $jumlahTransfer = 0, $nominalBenar = 0) {
        $helper = new Helpers();

        $nominalLebih = $jumlahTransfer - $nominalBenar;

        $namaAreaCabang = "";
        $telp = "";
        $noRekBCA = "";
        $namaRekBCA = "";
        $emailPengirim = "";

        $kodeAreaCabang = $this->session->get('auth')["kodeareacabang"];
        $sql_cabangview = "SELECT * FROM cabangview WHERE KodeAreaCabang = '$kodeAreaCabang'";
        $query_cabangview = $this->getDI()->getShared('db')->query($sql_cabangview);
        $query_cabangview->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result_cabangview = $query_cabangview->fetch($query_cabangview);
        if (count($result_cabangview) > 0) {
            $namaAreaCabang = $result_cabangview->NamaAreaCabang;
            $telp = $result_cabangview->NoTelp;
            $noRekBCA = $result_cabangview->NoRekBCA;
            $namaRekBCA = $result_cabangview->NamaRekBCA;
            $emailPengirim = $result_cabangview->Email;
        }

        $namaCabangPenerima = "Finance Primagama Pusat";

        $content = "<div style='font-family: Lucida Sans Typewriter'>
            Yth Bapak/Ibu " . $namaCabangPenerima . ",<br/><br/>"
                . "Kami ingin menyampaikan bahwa pada <b>tanggal " . $helper->tanggalFormat($tglTransfer) . "</b> "
                . "telah terjadi <b>kelebihan transfer</b> dengan nomor <b>VA " . $vaSiswa . "</b> atas <b>nama " . $namaSiswa . "</b> "
                . "sebesar <b>Rp. " . $helper->rupiah($jumlahTransfer) . "</b> <i>(" . ltrim($this->terbilang($jumlahTransfer)) . " rupiah)</i> seharusnya <b>yang benar</b> "
                . "sebesar <b>Rp. " . $helper->rupiah($nominalBenar) . "</b> <i>(" . ltrim($this->terbilang($nominalBenar)) . " rupiah)</i>, untuk itu kami mohon <b>pengembalian dana</b> "
                . "sebesar <b>Rp. " . $helper->rupiah($nominalLebih) . "</b> <i>(" . ltrim($this->terbilang($nominalLebih)) . " rupiah)</i> <b>ke Primagama "
                . "cabang " . $namaAreaCabang . " <i>(" . $kodeAreaCabang . ")</i></b> dengan <b>nomor "
                . "rekening " . $noRekBCA . " a/n " . $namaRekBCA . " bank BCA</b>. <br/>Informasi lebih lanjut silakan "
                . "hubungi PRIMAGAMA cabang " . $namaAreaCabang . " <b>No. Telp :" . $telp . "</b>.

            <br><p>Demikian yang dapat kami sampaikan, terima kasih atas kerjasamanya.            
            </div>";

        $emailBody = $helper->emailTemplate($content);
        $this->sendEmail("Kesalahan Input Nominal Saat Transfer", $emailBody);
    }

    public function createDoubleRefundAction() {
        $helper = new Helpers();
        $kodeCabang = $this->auth['kodeareacabang'];
        $kodeMax = $this->getNextNoSuratPernyataanByKodeCabang($kodeCabang);

        $namapembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("namapembuatpernyataan"));
        $jabatanpembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("jabatanpembuatpernyataan"));
        $telpcabang = $helper->convertHtmlEntities($this->request->getPost("telpcabang"));
        $alamatcabang = $helper->convertHtmlEntities($this->request->getPost("alamatcabang"));
        $va_siswa = $this->request->getPost("va_siswa")[0];
        $nama_siswa = $this->request->getPost("nama_siswa")[0];
        $total_nominal = $this->request->getPost("total_nominal", "int");
        $selisih_nominal = $this->request->getPost("selisih_nominal", "int");
        $tanggaltransfer = $this->request->getPost("tgl_transfer")[0];
        $persen_nominal = (11 / 100) * $selisih_nominal;
        $kronologi = "Telah terjadi double transfer ke nomor VA " . $va_siswa . " atas nama " . $nama_siswa . " sebesar Rp. " . $helper->rupiah($total_nominal) . ". "
                . "Mohon dapat dilakukan refund 11% dari Rp. " . $helper->rupiah($selisih_nominal) . " yaitu Rp. " . $helper->rupiah($persen_nominal) . " atas double transfer tersebut.";

        $TahunAjaran = $this->request->getPost("tahun_ajaran")[0];
        $TahunAjaranID = $this->request->getPost("TahunAjaranID")[0];
        $kodeTB = $this->request->getPost("TbRecID")[0];
        $recIDSecondary = $this->request->getPost("TbRecID")[1];

        //Stored Procedures Refund siswa insert or update.
        $sql_save = "EXEC dbo.TOC_CreateRefund
        @NoSuratPernyataan          = '" . $kodeMax . "',
        @JenisRefund                = 'Refund Double',
        @NamaPembuatPernyataan      = '" . $namapembuatpernyataan . "',
        @JabatanPembuatPernyataan   = '" . $jabatanpembuatpernyataan . "',
        @TelpCabang                 = '" . $telpcabang . "',
        @AlamatCabang               = '" . $alamatcabang . "',
        @NoVaSalah                  = null,
        @NoVaBenar                  = '" . $va_siswa . "',
        @TanggalTransfer            = '" . $tanggaltransfer . "',
        @LebihNominal               = '" . $total_nominal . "',
        @Nominal                    = '" . $selisih_nominal . "',
        @Kronologi                  = '" . $kronologi . "',
        @CreateBy                   = '" . $kodeCabang . "',
        @TrackFinance               = 'Pending',
        @TrackGM                    = 'Pending',
        @JenisDeposite              = null,
        @Deposite                   = null,
        @Created                    = '" . date('Y-m-d H:i:s') . "',
        @Modified                   = null,
        @ModifiedGM                 = null,
        @Keterangan                 = null,
        @KeteranganGM               = null,
        @DepositIsUsing             = null,
        @ApprovedBy                 = null,
        @ApprovedByGM               = null,
        @Selisih                    = '" . $selisih_nominal . "',
        @tahunajaran                = " . $TahunAjaranID . ",
        @kodeTB                     = '" . $kodeTB . "',
        @kodeTB2                    = '" . $recIDSecondary . "',
        @TipeTrx                    = null";

        $query_save = $this->getDI()->getShared('db')->query($sql_save);
        $query_save->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $trxPrimary = new Transaksibank();
        $primary = Transaksibank::findFirst("RecID = " . $kodeTB);
        if (count($primary) > 0) {
            $trxPrimary = $primary;
        }

        $trxSecondary = new Transaksibank();
        $secondary = Transaksibank::findFirst("RecID = " . $recIDSecondary);
        if (count($secondary) > 0) {
            $trxSecondary = $secondary;
        }

        //send email
        //$this->sendEmailDoubleRefundAction($trxPrimary, $trxSecondary);

        $this->response->redirect("refund?id=" . $kodeMax);
    }

    public function updateDoubleRefundAction() {
        $helper = new Helpers();
        $kodeCabang = $this->auth['kodeareacabang'];
        $refundRecID = $this->request->getPost("RefundRecID");
        $noSuratPernyataan = $this->request->getPost("NoSuratPernyataan");
        $namapembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("namapembuatpernyataan"));
        $jabatanpembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("jabatanpembuatpernyataan"));
        $telpcabang = $helper->convertHtmlEntities($this->request->getPost("telpcabang"));
        $alamatcabang = $helper->convertHtmlEntities($this->request->getPost("alamatcabang"));
        $va_siswa = $this->request->getPost("va_siswa")[0];
        $nama_siswa = $this->request->getPost("nama_siswa")[0];
        $total_nominal = $this->request->getPost("total_nominal", "int");
        $selisih_nominal = $this->request->getPost("selisih_nominal", "int");
        $tanggaltransfer = $this->request->getPost("tgl_transfer")[0];
        $persen_nominal = (11 / 100) * $selisih_nominal;
        $kronologi = "Telah terjadi double transfer ke nomor VA " . $va_siswa . " atas nama " . $nama_siswa . " sebesar Rp. " . $helper->rupiah($total_nominal) . ". "
                . "Mohon dapat dilakukan refund 11% dari Rp. " . $helper->rupiah($selisih_nominal) . " yaitu Rp. " . $helper->rupiah($persen_nominal) . " atas double transfer tersebut.";

        $TahunAjaran = $this->request->getPost("tahun_ajaran")[0];
        $TahunAjaranID = $this->request->getPost("TahunAjaranID")[0];
        $kodeTB = $this->request->getPost("TransaksiBankRecID")[0];
        $kodeTB2 = $this->request->getPost("TransaksiBankRecID")[1];

        $sql = "UPDATE refund SET 
        NamaPembuatPernyataan      = '" . $namapembuatpernyataan . "',
        JabatanPembuatPernyataan   = '" . $jabatanpembuatpernyataan . "',
        TelpCabang                 = '" . $telpcabang . "',
        AlamatCabang               = '" . $alamatcabang . "',
        NoVaSalah                  = null,
        NoVaBenar                  = '" . $va_siswa . "',
        TanggalTransfer            = '" . $tanggaltransfer . "',
        LebihNominal               = '" . $total_nominal . "',
        Nominal                    = '" . $selisih_nominal . "',
        Kronologi                  = '" . $kronologi . "',
        CreateBy                   = '" . $kodeCabang . "',
        TrackFinance               = 'Pending',
        TrackGM                    = 'Pending',
        JenisDeposite              = null,
        Deposite                   = null,
        Created                    = '" . date('Y-m-d H:i:s') . "',
        Modified                   = null,
        ModifiedGM                 = null,
        Keterangan                 = null,
        KeteranganGM               = null,
        DepositIsUsing             = null,
        ApprovedBy                 = null,
        ApprovedByGM               = null,
        Selisih                    = '" . $selisih_nominal . "',
        tahunajaran                = " . $TahunAjaranID . ",
        kodeTB                     = '" . $kodeTB . "',
        kodeTB2                    = '" . $kodeTB2 . "' 
        WHERE RecID                = " . $refundRecID . "";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->response->redirect("refund/lihatRefundDouble?id=" . $refundRecID);
    }

    public function sendEmailDoubleRefundAction(Transaksibank $trxPrimary, Transaksibank $trxSecondary) {
        $helper = new Helpers();

        $siswaPrimary = Siswa::findFirst($trxPrimary->Siswa);
        $nominalLebih = ($trxPrimary->Nominal + $trxSecondary->Nominal) - $trxPrimary->Nominal;
        $nominal11Persen = (11 / 100) * $nominalLebih;

        $namaAreaCabang = "";
        $telp = "";
        $noRekBCA = "";
        $namaRekBCA = "";
        $emailPengirim = "";

        $kodeAreaCabang = $this->session->get('auth')["kodeareacabang"];
        $sql_cabangview = "SELECT * FROM cabangview WHERE KodeAreaCabang = '$kodeAreaCabang'";
        $query_cabangview = $this->getDI()->getShared('db')->query($sql_cabangview);
        $query_cabangview->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result_cabangview = $query_cabangview->fetch($query_cabangview);
        if (count($result_cabangview) > 0) {
            $namaAreaCabang = $result_cabangview->NamaAreaCabang;
            $telp = $result_cabangview->NoTelp;
            $noRekBCA = $result_cabangview->NoRekBCA;
            $namaRekBCA = $result_cabangview->NamaRekBCA;
            $emailPengirim = $result_cabangview->Email;
        }

        $namaCabangPenerima = "Finance Primagama Pusat";

        $content = "<div style='font-family: Lucida Sans Typewriter'>
                Yth Bapak/Ibu " . $namaCabangPenerima . ",<br/><br/>"
                . "Kami ingin menyampaikan bahwa "
                . "telah terjadi <b>double transfer</b> ke nomor <b>VA " . $trxPrimary->NoVA . "</b> atas <b>nama " . $siswaPrimary->NamaSiswa . "</b> yaitu :"
                . "<ol>"
                . "<li>Tanggal <b>" . $helper->tanggalFormat($trxPrimary->TanggalTransaksi) . "</b> sebesar <b>Rp. " . $helper->rupiah($trxPrimary->Nominal) . "</b> <i>(" . ltrim($this->terbilang($trxPrimary->Nominal)) . " rupiah)</i> </li>"
                . "<li>Tanggal <b>" . $helper->tanggalFormat($trxSecondary->TanggalTransaksi) . "</b> sebesar <b>Rp. " . $helper->rupiah($trxSecondary->Nominal) . "</b> <i>(" . ltrim($this->terbilang($trxSecondary->Nominal)) . " rupiah)</i> </li>"
                . "</ol>"
                . "Oleh karena itu, "
                . "kami mohon <b>pengembalian dana 11% dari Rp. " . $helper->rupiah($nominalLebih) . "</b> <i>(" . ltrim($this->terbilang($nominalLebih)) . " rupiah)</i> yaitu "
                . "sebesar <b>Rp. " . $helper->rupiah($nominal11Persen) . "</b> <i>(" . ltrim($this->terbilang($nominal11Persen)) . " rupiah)</i> <b>ke Primagama "
                . "cabang " . $namaAreaCabang . " <i>(" . $kodeAreaCabang . ")</i></b> dengan <b>nomor "
                . "rekening " . $noRekBCA . " a/n " . $namaRekBCA . " bank BCA</b>. <br/>Informasi lebih lanjut silakan "
                . "hubungi PRIMAGAMA cabang " . $namaAreaCabang . " <b>No. Telp :" . $telp . "</b>.
            <br><p>Demikian yang dapat kami sampaikan, terima kasih atas kerjasamanya.
            </div>";

        $emailBody = $helper->emailTemplate($content);
        $this->sendEmail("Kesalahan Input Double Saat Transfer", $emailBody);
    }

    public function createCabangRefundAction() {
        $helper = new Helpers();
        $kodeCabang = $this->auth['kodeareacabang'];
        $kodeMax = $this->getNextNoSuratPernyataanByKodeCabang($kodeCabang);

        $namapembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("namapembuatpernyataan"));
        $jabatanpembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("jabatanpembuatpernyataan"));
        $telpcabang = $helper->convertHtmlEntities($this->request->getPost("telpcabang"));
        $alamatcabang = $helper->convertHtmlEntities($this->request->getPost("alamatcabang"));
        $va_cabang = $this->request->getPost("va_cabang");
        $nama_cabang = $this->request->getPost("nama_cabang");
        $nominal = $this->request->getPost("nominal_disetor", "int");
        $tgl_transfer = $this->request->getPost("tgl_transfer");
        $jenis_pengalihan = $this->request->getPost("jenis_pengalihan");
        $jenis_pengalihan_text = $this->request->getPost("jenis_pengalihan_text");
        $jenis_transaksi = $this->request->getPost("jenis_transaksi");

        $typeId = $jenis_pengalihan;
        $va_tujuan = $this->getVirtualAccountByTypeId($typeId);

        $kronologi = "Sehubungan telah terjadinya kesalahan transfer dengan VA " . $va_cabang . " sebesar Rp. " . $helper->rupiah($nominal) . " maka kami minta dialihkan untuk " . $jenis_pengalihan_text;
        $kodeTB = $this->request->getPost("TbRecID");

        $sql_save = "EXEC dbo.TOC_CreateRefund
            @NoSuratPernyataan          = '" . $kodeMax . "',
            @JenisRefund                = 'Deposite',
            @NamaPembuatPernyataan      = '" . $namapembuatpernyataan . "',
            @JabatanPembuatPernyataan   = '" . $jabatanpembuatpernyataan . "',
            @TelpCabang                 = '" . $telpcabang . "',
            @AlamatCabang               = '" . $alamatcabang . "',
            @NoVaSalah                  = '" . $va_cabang . "',
            @NoVaBenar                  = '" . $va_tujuan . "',
            @TanggalTransfer            = '" . $tgl_transfer . "',
            @LebihNominal               = null,
            @Nominal                    = '" . $nominal . "',
            @Kronologi                  = '" . $kronologi . "',
            @CreateBy                   = '" . $kodeCabang . "',
            @TrackFinance               = 'Pending',
            @TrackGM                    = null,
            @JenisDeposite              = '" . $jenis_pengalihan . "',
            @Deposite                   = null,
            @Created                    = '" . date('Y-m-d H:i:s') . "',
            @Modified                   = null,
            @ModifiedGM                 = null,
            @Keterangan                 = null,
            @KeteranganGM               = null,
            @DepositIsUsing             = null,
            @ApprovedBy                 = null,
            @ApprovedByGM               = null,
            @Selisih                    = null,
            @tahunajaran                = null,
            @kodeTB                     = '" . $kodeTB . "',
            @kodeTB2                    = null,
            @TipeTrx                    = " . $jenis_transaksi . "";
        /* if ($jenis_transaksi == "1") {//Global
          $sql_save = "EXEC dbo.TOC_CreateRefund
          @NoSuratPernyataan          = '" . $kodeMax . "',
          @JenisRefund                = 'Deposite',
          @NamaPembuatPernyataan      = '" . $namapembuatpernyataan . "',
          @JabatanPembuatPernyataan   = '" . $jabatanpembuatpernyataan . "',
          @TelpCabang                 = '" . $telpcabang . "',
          @AlamatCabang               = '" . $alamatcabang . "',
          @NoVaSalah                  = '" . $va_cabang . "',
          @NoVaBenar                  = '" . $va_tujuan . "',
          @TanggalTransfer            = '" . $tgl_transfer . "',
          @LebihNominal               = null,
          @Nominal                    = '" . $nominal . "',
          @Kronologi                  = '" . $kronologi . "',
          @CreateBy                   = '" . $kodeCabang . "',
          @TrackFinance               = 'Pending',
          @TrackGM                    = null,
          @JenisDeposite              = '" . $jenis_pengalihan . "',
          @Deposite                   = null,
          @Created                    = '" . date('Y-m-d H:i:s') . "',
          @Modified                   = null,
          @ModifiedGM                 = null,
          @Keterangan                 = null,
          @KeteranganGM               = null,
          @DepositIsUsing             = null,
          @ApprovedBy                 = null,
          @ApprovedByGM               = null,
          @Selisih                    = null,
          @tahunajaran                = null,
          @kodeTB                     = null,
          @kodeTB2                    = null";
          } else {
          $sql_save = "EXEC dbo.TOC_CreateRefund
          @NoSuratPernyataan          = '" . $kodeMax . "',
          @JenisRefund                = 'Deposite',
          @NamaPembuatPernyataan      = '" . $namapembuatpernyataan . "',
          @JabatanPembuatPernyataan   = '" . $jabatanpembuatpernyataan . "',
          @TelpCabang                 = '" . $telpcabang . "',
          @AlamatCabang               = '" . $alamatcabang . "',
          @NoVaSalah                  = '" . $va_cabang . "',
          @NoVaBenar                  = '" . $va_tujuan . "',
          @TanggalTransfer            = '" . $tgl_transfer . "',
          @LebihNominal               = null,
          @Nominal                    = '" . $nominal . "',
          @Kronologi                  = '" . $kronologi . "',
          @CreateBy                   = '" . $kodeCabang . "',
          @TrackFinance               = 'Pending',
          @TrackGM                    = 'Pending',
          @JenisDeposite              = '" . $jenis_pengalihan . "',
          @Deposite                   = null,
          @Created                    = '" . date('Y-m-d H:i:s') . "',
          @Modified                   = null,
          @ModifiedGM                 = null,
          @Keterangan                 = null,
          @KeteranganGM               = null,
          @DepositIsUsing             = null,
          @ApprovedBy                 = null,
          @ApprovedByGM               = null,
          @Selisih                    = null,
          @tahunajaran                = null,
          @kodeTB                     = '" . $kodeTB . "',
          @kodeTB2                    = null";
          } */

        $query_save = $this->getDI()->getShared('db')->query($sql_save);
        $query_save->setFetchMode(Phalcon\Db::FETCH_OBJ);

        //send email
        //$this->sendEmailCabangRefundAction($va_cabang, $tgl_transfer, $nominal, $jenis_pengalihan_text);

        $this->response->redirect("refund?id=" . $kodeMax);
    }

    public function updateCabangRefundAction() {
        $helper = new Helpers();
        $kodeCabang = $this->auth['kodeareacabang'];
        $refundRecID = $this->request->getPost("RefundRecID");
        $noSuratPernyataan = $this->request->getPost("NoSuratPernyataan");
        $namapembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("namapembuatpernyataan"));
        $jabatanpembuatpernyataan = $helper->convertHtmlEntities($this->request->getPost("jabatanpembuatpernyataan"));
        $telpcabang = $helper->convertHtmlEntities($this->request->getPost("telpcabang"));
        $alamatcabang = $helper->convertHtmlEntities($this->request->getPost("alamatcabang"));
        $va_cabang = $this->request->getPost("va_cabang");
        $nama_cabang = $this->request->getPost("nama_cabang");
        $nominal = $this->request->getPost("nominal_disetor", "int");
        $tgl_transfer = $this->request->getPost("tgl_transfer");
        $jenis_pengalihan = $this->request->getPost("jenis_pengalihan");
        //$jenis_pengalihan_text = $this->request->getPost("jenis_pengalihan_text"); 
        $jenis_pengalihan_text = $this->refundConfig->jenisPengalihan[$jenis_pengalihan];
        $jenis_transaksi = $this->request->getPost("jenis_transaksi");

        $typeId = $jenis_pengalihan;
        $va_tujuan = $this->getVirtualAccountByTypeId($typeId);

        $kronologi = "Sehubungan telah terjadinya kesalahan transfer dengan VA " . $va_cabang . " sebesar Rp. " . $helper->rupiah($nominal) . " maka kami minta dialihkan untuk " . $jenis_pengalihan_text;
        $kodeTB = $this->request->getPost("TransaksiBankRecID");

        $sql = "UPDATE refund SET 
            NamaPembuatPernyataan      = '" . $namapembuatpernyataan . "',
            JabatanPembuatPernyataan   = '" . $jabatanpembuatpernyataan . "',
            TelpCabang                 = '" . $telpcabang . "',
            AlamatCabang               = '" . $alamatcabang . "',
            NoVaSalah                  = '" . $va_cabang . "',
            NoVaBenar                  = '" . $va_tujuan . "',
            TanggalTransfer            = '" . $tgl_transfer . "',
            LebihNominal               = null,
            Nominal                    = '" . $nominal . "',
            Kronologi                  = '" . $kronologi . "',
            CreateBy                   = '" . $kodeCabang . "',
            TrackFinance               = 'Pending',
            TrackGM                    = null,
            JenisDeposite              = '" . $jenis_pengalihan . "',
            Deposite                   = null,
            Created                    = '" . date('Y-m-d H:i:s') . "',
            Modified                   = null,
            ModifiedGM                 = null,
            Keterangan                 = null,
            KeteranganGM               = null,
            DepositIsUsing             = null,
            ApprovedBy                 = null,
            ApprovedByGM               = null,
            Selisih                    = null,
            tahunajaran                = null,
            kodeTB                     = '" . $kodeTB . "',
            kodeTB2                    = null,
            TipeTrx                    = " . $jenis_transaksi . "";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->response->redirect("refund/lihatRefundCabang?id=" . $refundRecID);
    }

    public function sendEmailCabangRefundAction($vaCabang = "", $tglTransfer = "", $jumlahTransfer = 0, $jenisDeposit = "") {
        $helper = new Helpers();

        $namaAreaCabang = "";
        $telp = "";
        $noRekBCA = "";
        $namaRekBCA = "";
        $emailPengirim = "";

        //$kodeAreaCabang = $this->session->get('auth')["kodeareacabang"];
        $sql_cabangview = "SELECT * FROM cabangview WHERE KodeAreaCabang = '$vaCabang'";
        $query_cabangview = $this->getDI()->getShared('db')->query($sql_cabangview);
        $query_cabangview->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result_cabangview = $query_cabangview->fetch($query_cabangview);
        if (count($result_cabangview) > 0) {
            $namaAreaCabang = $result_cabangview->NamaAreaCabang;
            $telp = $result_cabangview->NoTelp;
            $noRekBCA = $result_cabangview->NoRekBCA;
            $namaRekBCA = $result_cabangview->NamaRekBCA;
            $emailPengirim = $result_cabangview->Email;
        }

        $namaCabangPenerima = "Finance Primagama Pusat";

        $content = "<div style='font-family: Lucida Sans Typewriter'>
                Yth Bapak/Ibu " . $namaCabangPenerima . ",<br/><br/>"
                . "Kami ingin menyampaikan bahwa pada <b>tanggal " . $helper->tanggalFormat($tglTransfer) . "</b> "
                . "telah terjadi <b>kesalahan transfer</b> pada cabang " . $namaAreaCabang . " <i>(" . $vaCabang . ")</i> "
                . "sebesar <b>Rp. " . $helper->rupiah($jumlahTransfer) . "</b> <i>(" . ltrim($this->terbilang($jumlahTransfer)) . " rupiah)</i> maka kami minta <b>dialihkan "
                . "untuk " . $jenisDeposit . " "
                . "ke Primagama "
                . "cabang " . $namaAreaCabang . " <i>(" . $vaCabang . ")</i></b> dengan <b>nomor "
                . "rekening " . $noRekBCA . " a/n " . $namaRekBCA . " bank BCA</b>. <br/>Informasi lebih lanjut silakan "
                . "hubungi PRIMAGAMA cabang " . $namaAreaCabang . " <b>No. Telp :" . $telp . "</b>.
            <br><p>Demikian yang dapat kami sampaikan, terima kasih atas kerjasamanya.
            </div>";

        $emailBody = $helper->emailTemplate($content);
        $this->sendEmail("Kesalahan Input VA Cabang Saat Transfer", $emailBody);
    }

    /**
     * download surat as pdf file
     * @param string $noSuratPernyataan
     */
    function downloadSuratAction($noSuratPernyataan = "") {
        $this->view->disable();
        $err_code = 0;
        $tglTransfer = "";
        $kronologi = "";
        $namaAreaCabang = "";
        $alamat = "";
        $noTelp = "";
        $namaPembuatPernyataan = "";
        $jabatanPembuatPernyataan = "";
        $managerCabang = "";
        $shipmentStatus = "";
        $nominal = 0;
        $lebihNominal = 0;
        $jenisRefund = "";
        $jenisDeposit = "";

        $helper = new Helpers();

        if ($noSuratPernyataan == "") {
            $err_code++;
        }

        if ($err_code == 0) {
            $sql = "
                SELECT areacabang.NamaAreaCabang,
                areacabang.Alamat,
                areacabang.NoTelp,
                areacabang.NamaManager,
                refund.NoSuratPernyataan,
                refund.NamaPembuatPernyataan,
                refund.JabatanPembuatPernyataan,
                refund.TanggalTransfer,
                refund.Kronologi, 
                case 
                when refund.JenisRefund='Refund Siswa' OR refund.JenisRefund='Refund Nominal' OR refund.JenisRefund='Refund Double'
                        then 'Refund' 
                when refund.JenisRefund='Deposite' AND JenisDeposite='00' 
                        then 'Refund' 
                when refund.JenisRefund='Deposite' AND JenisDeposite='01' OR refund.JenisRefund='Deposite' AND JenisDeposite='02' 
                        then 'Deposit' 
                end AS shipmentstatus, 
                refund.Nominal,
                refund.LebihNominal,
                refund.JenisRefund, 
                refund.JenisDeposite  
                FROM refund 
                JOIN areacabang ON refund.CreateBy = LTRIM(RTRIM(areacabang.KodeAreaCabang)) 
                WHERE refund.NoSuratPernyataan = '" . $noSuratPernyataan . "'";
            $query = $this->getDI()->getShared('db')->query($sql);
            $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
            $result = $query->fetch($query);
            if (count($result) > 0) {
                $tglTransfer = $result->TanggalTransfer;
                $kronologi = $result->Kronologi;
                $namaAreaCabang = $result->NamaAreaCabang;
                $alamat = $result->Alamat;
                $noTelp = $result->NoTelp;
                $namaPembuatPernyataan = $result->NamaPembuatPernyataan;
                $jabatanPembuatPernyataan = $result->JabatanPembuatPernyataan;
                $managerCabang = $result->NamaManager;
                $shipmentStatus = $result->shipmentstatus;
                $nominal = $result->Nominal;
                $lebihNominal = $result->LebihNominal;
                $jenisRefund = $result->JenisRefund;
                $jenisDeposit = $result->JenisDeposite;
            } else {
                $err_code++;
            }
        }

        if ($err_code == 0) {
            $kejadian = "kesalahan";
            if (trim(strtolower($jenisRefund)) == "refund double") {
                $kejadian = "double";
            }
            if (trim(strtolower($jenisRefund)) == "refund nominal") {
                $kejadian = "kelebihan nominal";
            }

            $nominal11Persen = (11 / 100) * $nominal;

            $teks1 = "Saya yang bertanda tangan dibawah ini :";
            $teks2 = "Menerangkan bahwa pada hari " . $helper->hariFormat($tglTransfer) . " tanggal " . $helper->tanggalFormat($tglTransfer) . " telah terjadi " . $kejadian . " transfer, dengan kronologi sebagai berikut :";
            $teks3 = strip_tags($kronologi);
            /* $teks4 = "Mohon dapat dilakukan " . $shipmentStatus . " 11% Rp. " . $helper->rupiah($nominal11Persen) . " atas kesalahan transfer tersebut.";
              if($kejadian == "kelebihan nominal"){
              $teks4 = "Mohon dapat dilakukan " . $shipmentStatus . " 11% dari Rp. " . $helper->rupiah($lebihNominal) . " atas kelebihan transfer tersebut.";
              } */
            $teks4 = "Demikian yang dapat saya sampaikan, atas perhatiannya saya ucapkan terimakasih.";

            $pdf = new FPDF('p', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->SetTitle('Surat Pernyataan ' . $shipmentStatus . '');
            //logo
            $pdf->Image('img/logo_new_web.png');
            // judul
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, -15, strtoupper($namaAreaCabang), 0, 1, 'R');
            $pdf->Cell(0, 25, strtolower($alamat), 0, 1, 'R');
            $pdf->Cell(0, -15, 'No. telp. ' . $noTelp, 0, 1, 'R');
            //garis
            $pdf->SetLineWidth(1);
            $pdf->Line(10, 28, 200, 28);
            $pdf->SetLineWidth(0);
            $pdf->Line(10, 29, 200, 29);
            //surat
            $pdf->Ln(30);
            $pdf->SetFont('Times', 'BU', 16);
            $pdf->Cell(200, 5, 'SURAT PERNYATAAN', 0, 1, 'C');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(200, 5, 'No. ' . $noSuratPernyataan, 0, 1, 'C');
            //body 1
            $pdf->Ln(10);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(1);
            $pdf->MultiCell(0, 5, $teks1);
            //pembuat
            $pdf->Ln(2);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(1);
            $pdf->Cell(10, 5, 'Nama', 0, 0, 'L');
            $pdf->Cell(15);
            $pdf->Cell(2, 5, ':', 0, 0, 'L');
            $pdf->Cell(1);
            $pdf->Cell(1, 5, $namaPembuatPernyataan, 0, 1, 'L');
            $pdf->Cell(1);
            $pdf->Cell(10, 5, 'Jabatan', 0, 0, 'L');
            $pdf->Cell(15);
            $pdf->Cell(2, 5, ':', 0, 0, 'L');
            $pdf->Cell(1);
            $pdf->Cell(1, 5, $jabatanPembuatPernyataan, 0, 1, 'L');
            $pdf->Cell(1);
            $pdf->Cell(10, 5, 'Cabang', 0, 0, 'L');
            $pdf->Cell(15);
            $pdf->Cell(2, 5, ':', 0, 0, 'L');
            $pdf->Cell(1);
            $pdf->Cell(1, 5, $namaAreaCabang, 0, 1, 'L');
            //body 2
            $pdf->Ln(5);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(1);
            $pdf->MultiCell(0, 5, $teks2);
            //body 3
            $pdf->Ln(2);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(1);
            $pdf->MultiCell(0, 5, $teks3);
            //body 4
            $pdf->Ln(2);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(1);
            $pdf->MultiCell(0, 5, $teks4);

            //tgl dibuat
            $pdf->Ln(40);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(325, 5, $helper->tanggalFormat(date("Y-m-d")), 0, 0, 'C');

            //ttd 1
            $pdf->Ln(10);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(1);
            $pdf->Cell(60, 5, 'Dibuat oleh,', 0, 0, 'C');
            //ttd 2
            $pdf->Ln(20);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(1);
            $pdf->Cell(60, 5, '( ' . $namaPembuatPernyataan . ' )', 0, 1, 'C');

            //ttd 1
            $pdf->Ln(-25);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(325, 5, 'Disetujui oleh,', 0, 0, 'C');
            //ttd 2
            $pdf->Ln(20);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(1);
            $pdf->Cell(325, 5, '( ' . $managerCabang . ' )', 0, 1, 'C');
            $pdf->Ln();
            $pdf->SetFont('Times', 'BU', 12);
            $pdf->Cell(1);
            $pdf->Cell(325, 0, 'Manager', 0, 1, 'C');
            $pdf->Ln();

            //footer
            if (strtolower($jenisRefund) == "deposite" && $jenisDeposit == 1) {//Jika deposi buku
                $pdf->Ln(40);
                $pdf->SetFont('Times', 'BI', 10);
                $pdf->Cell(1);
                $pdf->MultiCell(0, 5, "Note :");
                $pdf->Ln(1);
                $pdf->SetFont('Times', 'I', 10);
                $pdf->Cell(1);
                $pdf->MultiCell(0, 5, "Deposit smart book/buku hanya dapat digunakan 80% dari total tagihan pembelian smart book");
            }

            $pdf->Output($noSuratPernyataan . '.pdf', 'D');
        }
    }

    function cetakAction() {
        $this->view->disable();
        $nocetek = $this->request->getPost("nocetek");
        $sql = "SELECT areacabang.NamaAreaCabang,areacabang.Alamat,areacabang.NoTelp,areacabang.NamaManager,refund.NoSuratPernyataan,refund.NamaPembuatPernyataan,refund.JabatanPembuatPernyataan,refund.TanggalTransfer,refund.Kronologi,case when refund.JenisRefund='Refund Siswa' OR refund.JenisRefund='Refund Nominal' then 'Refund' when refund.JenisRefund='Deposite' AND JenisDeposite='00' then 'Refund' when refund.JenisRefund='Deposite' AND JenisDeposite='01' OR refund.JenisRefund='Deposite' AND JenisDeposite='02' then 'Deposit' end AS shipmentstatus FROM refund JOIN areacabang ON refund.CreateBy=LTRIM(RTRIM(areacabang.KodeAreaCabang)) WHERE refund.NoSuratPernyataan = '$nocetek'";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);
        foreach ($result as $r) {
            $KodeMax = $r->NoSuratPernyataan;
            $tanggaltransfer = $r->TanggalTransfer;
            $kronologi = $r->Kronologi;
            $NamaAreaCabang = $r->NamaAreaCabang;
            $Alamat = $r->Alamat;
            $telp = $r->NoTelp;
            $namapembuatpernyataan = $r->NamaPembuatPernyataan;
            $jabatanpembuatpernyataan = $r->JabatanPembuatPernyataan;
            $Managercabang = $r->NamaManager;
            $shipmentstatus = $r->shipmentstatus;
        }

        //ouput after insert in database.
        $teks1 = "Saya yang bertanda tangan dibawah ini :";
        $teks2 = "Menerangkan bahwa pada hari " . $this->indo_hari($tanggaltransfer) . " tanggal " . $this->tgl_indo($tanggaltransfer) . " telah terjadi kesalahan transfer, dengan kronologi sebagai berikut :";
        $teks3 = $kronologi;
        $teks4 = "Mohon dapat dilakukan " . $shipmentstatus . " atas kesalahan transfer tersebut.\nDemikian yang dapat saya sampaikan, atas perhatiannya saya ucapkan terimakasih.";
        $pembuat = $namapembuatpernyataan;

        $pdf = new FPDF('p', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle('Surat Pernyataan ' . $shipmentstatus . '');
        //logo
        $pdf->Image('img/logo_new_web.png');
        // judul
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, -15, strtoupper($NamaAreaCabang), 0, 1, 'R');
        $pdf->Cell(0, 25, strtolower($Alamat), 0, 1, 'R');
        $pdf->Cell(0, -15, 'No. telp. ' . $telp, 0, 1, 'R');
        //garis
        $pdf->SetLineWidth(1);
        $pdf->Line(10, 28, 200, 28);
        $pdf->SetLineWidth(0);
        $pdf->Line(10, 29, 200, 29);
        //surat
        $pdf->Ln(30);
        $pdf->SetFont('Times', 'BU', 16);
        $pdf->Cell(200, 5, 'SURAT PERNYATAAN', 0, 1, 'C');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(200, 5, 'No. ' . $KodeMax, 0, 1, 'C');
        //body 1
        $pdf->Ln(10);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(1);
        $pdf->MultiCell(0, 5, $teks1);
        //pembuat
        $pdf->Ln(2);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(1);
        $pdf->Cell(10, 5, 'Nama', 0, 0, 'L');
        $pdf->Cell(15);
        $pdf->Cell(2, 5, ':', 0, 0, 'L');
        $pdf->Cell(1);
        $pdf->Cell(1, 5, $pembuat, 0, 1, 'L');
        $pdf->Cell(1);
        $pdf->Cell(10, 5, 'Jabatan', 0, 0, 'L');
        $pdf->Cell(15);
        $pdf->Cell(2, 5, ':', 0, 0, 'L');
        $pdf->Cell(1);
        $pdf->Cell(1, 5, $jabatanpembuatpernyataan, 0, 1, 'L');
        $pdf->Cell(1);
        $pdf->Cell(10, 5, 'Cabang', 0, 0, 'L');
        $pdf->Cell(15);
        $pdf->Cell(2, 5, ':', 0, 0, 'L');
        $pdf->Cell(1);
        $pdf->Cell(1, 5, $NamaAreaCabang, 0, 1, 'L');
        //body 2
        $pdf->Ln(5);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(1);
        $pdf->MultiCell(0, 5, $teks2);
        //body 3
        $pdf->Ln(2);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(1);
        $pdf->MultiCell(0, 5, $teks3);
        //body 3
        $pdf->Ln(2);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(1);
        $pdf->MultiCell(0, 5, $teks4);
        //ttd 1
        $pdf->Ln(50);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(1);
        $pdf->Cell(60, 5, 'Dibuat oleh,', 0, 0, 'C');
        //ttd 2
        $pdf->Ln(20);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(1);
        $pdf->Cell(60, 5, '( ' . $pembuat . ' )', 0, 1, 'C');
        //ttd 1
        $pdf->Ln(-25);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(325, 5, 'Disetujui oleh,', 0, 0, 'C');
        //ttd 2
        $pdf->Ln(20);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(1);
        $pdf->Cell(325, 5, '( ' . $Managercabang . ' )', 0, 1, 'C');
        $pdf->Ln();
        $pdf->SetFont('Times', 'BU', 12);
        $pdf->Cell(1);
        $pdf->Cell(325, 0, 'MANAGER CABANG', 0, 1, 'C');
        $pdf->Ln();
        $pdf->Output($KodeMax . '.pdf', 'D');
    }

    public function simpanrefundbertingkatAction() {

        //buat nomor surat
        $KodeCabang = $this->auth['kodeareacabang'];
        $sql = "SELECT top 1 NoSurat AS KodeMax FROM nosuratpernyataan WHERE KodeCabang = '$KodeCabang' ORDER BY RIGHT(NoSurat,7) DESC";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);
        foreach ($result as $r) {
            $KodeMax = $r->KodeMax;
        }

        $this->view->disable();
        //simpan ke database.
        $namapembuatpernyataan = $this->request->getPost("namapembuatpernyataan");
        $jabatanpembuatpernyataan = $this->request->getPost("jabatanpembuatpernyataan");
        $telpcabang = $this->request->getPost("telpcabang");
        $alamatcabang = $this->request->getPost("alamatcabang");
        $novasalahdari = $this->request->getPost("novasalahdari");
        $novasalahsampai = $this->request->getPost("novasalahsampai");
        $novabenardari = $this->request->getPost("novabenardari");
        $novabenarsampai = $this->request->getPost("novabenarsampai");
        $tanggaltransfer = $this->request->getPost("tanggaltransfer");
        $nominal = substr($this->request->getPost("nominal", "int"), 0, -2);
        $jumlahtransfer = $this->request->getPost("nominal");

        for ($i = $novasalahdari; $i <= $novasalahsampai; $i++) {
            $NoVaSalah[] = $i;
            $sql_ns = "SELECT siswa.NamaSiswa FROM siswa JOIN areacabang ON siswa.Cabang=areacabang.RecID WHERE concat(ltrim(rtrim(areacabang.KodeAreaCabang)),siswa.VirtualAccount) = '" . $i . "'";
            $query_ns = $this->getDI()->getShared('db')->query($sql_ns);
            $query_ns->setFetchMode(Phalcon\Db::FETCH_OBJ);
            $numRows_ns = $query_ns->numRows();
            $result_ns = $query_ns->fetchAll($query_ns);

            if ($numRows_ns > 0) {
                foreach ($result_ns as $row_ns) {
                    $namasalah[] = $row_ns->NamaSiswa;
                }
            }
        }

        for ($i = $novabenardari; $i <= $novabenarsampai; $i++) {
            $novabenar[] = $i;
            $sql_nb = "SELECT siswa.NamaSiswa FROM siswa JOIN areacabang ON siswa.Cabang=areacabang.RecID WHERE concat(ltrim(rtrim(areacabang.KodeAreaCabang)),siswa.VirtualAccount) = '" . $i . "'";
            $query_nb = $this->getDI()->getShared('db')->query($sql_nb);
            $query_nb->setFetchMode(Phalcon\Db::FETCH_OBJ);
            $numRows_nb = $query_nb->numRows();
            $result_nb = $query_nb->fetchAll($query_nb);

            if ($numRows_nb > 0) {
                foreach ($result_nb as $row_nb) {
                    $namabenar[] = $row_nb->NamaSiswa;
                }
            }
        }

        if (count($NoVaSalah) == count($novabenar)) {
            $N = count($NoVaSalah);

            $msg = "Sehubungan telah terjadi kesalahan transfer dengan \n";
            for ($j = 0; $j < $N; $j++) {
                $msg .= "- " . "NoVA " . $NoVaSalah[$j] . " atas nama " . $namasalah[$j] . " seharusnya NoVA " . $novabenar[$j] . " atas nama " . $namabenar[$j] . ".\n";
            }
            $msg .= "sejumlah " . $jumlahtransfer;

            for ($i = 0; $i < $N; $i++) {

                $Kronologi = "Sehubungan telah terjadi kesalahan transfer dengan nomor VA " . $NoVaSalah[$i] . " atas nama " . $namasalah[$i] . ", seharusnya transfer ke nomor VA " . $novabenar[$i] . " atas nama " . $namabenar[$i] . " sejumlah " . $jumlahtransfer . " ";

                $sql_save = "INSERT INTO Refund (
                NoSuratPernyataan,
                JenisRefund,
                NamaPembuatPernyataan,
                JabatanPembuatPernyataan,
                TelpCabang,
                AlamatCabang,
                NoVaSalah,
                NoVaBenar,
                TanggalTransfer,
                LebihNominal,
                Nominal,
                Kronologi,
                CreateBy,
                TrackFinance,
                TrackGM,
                JenisDeposite,
                Deposite,
                Created,
                Modified,
                ModifiedGM,
                Keterangan,
                KeteranganGM,
                DepositIsUsing,
                ApprovedBy,
                Selisih
                ) VALUES (
                '" . $KodeMax . "',
                'Refund Siswa',
                '" . $namapembuatpernyataan . "',
                '" . $jabatanpembuatpernyataan . "',
                '" . $telpcabang . "',
                '" . $alamatcabang . "',
                '" . $NoVaSalah[$i] . "',
                '" . $novabenar[$i] . "',
                '" . $tanggaltransfer . "',
                null,
                '" . $nominal . "',
                '" . $Kronologi . "',
                '" . $KodeCabang . "',
                'Pending',
                'Pending',
                null,
                null,
                '" . date('Y-m-d H:i:s') . "',
                null,
                null,
                null,
                null,
                null,
                null,
                null)";

                $query_save = $this->getDI()->getShared('db')->query($sql_save);
                $query_save->setFetchMode(Phalcon\Db::FETCH_OBJ);
            }

            // ambil data cabang
            $sid = $this->auth['kodeareacabang'];
            $sql5 = "SELECT * FROM cabangview WHERE KodeAreaCabang = '$sid'";
            $query5 = $this->getDI()->getShared('db')->query($sql5);
            $query5->setFetchMode(Phalcon\Db::FETCH_OBJ);
            $result5 = $query5->fetchAll($query5);
            foreach ($result5 as $rows) {
                $NamaAreaCabang = $rows->NamaAreaCabang;
                $Alamat = $rows->Alamat;
                $telp = $rows->NoTelp;
                $Managercabang = $rows->NamaManager;
                $NoRekBCA = $rows->NoRekBCA;
                $NamaRekBCA = $rows->NamaRekBCA;
                $Emailpengirim = $rows->Email;
            }

            //ouput after insert in database.
            $teks1 = "Saya yang bertanda tangan dibawah ini :";
            $teks2 = "Menerangkan bahwa pada hari " . $this->indo_hari($tanggaltransfer) . " tanggal " . $this->tgl_indo($tanggaltransfer) . " telah terjadi kesalahan transfer, dengan kronologi sebagai berikut :";
            $teks3 = $msg;
            $teks4 = "Mohon dapat dilakukan refund atas kesalahan transfer tersebut.\nDemikian yang dapat saya sampaikan, atas perhatiannya saya ucapkan terimakasih.";
            $pembuat = $namapembuatpernyataan;

            $pdf = new FPDF('p', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->SetTitle('Surat Pernyataan Refund');
            //logo
            $pdf->Image('img/logo_new_web.png');
            // judul
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, -15, strtoupper($NamaAreaCabang), 0, 1, 'R');
            $pdf->Cell(0, 25, strtolower($Alamat), 0, 1, 'R');
            $pdf->Cell(0, -15, 'No. telp. ' . $telp, 0, 1, 'R');
            //garis
            $pdf->SetLineWidth(1);
            $pdf->Line(10, 28, 200, 28);
            $pdf->SetLineWidth(0);
            $pdf->Line(10, 29, 200, 29);
            //surat
            $pdf->Ln(30);
            $pdf->SetFont('Times', 'BU', 16);
            $pdf->Cell(200, 5, 'SURAT PERNYATAAN', 0, 1, 'C');
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(200, 5, 'No. ' . $KodeMax, 0, 1, 'C');
            //body 1
            $pdf->Ln(10);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(1);
            $pdf->MultiCell(0, 5, $teks1);
            //pembuat
            $pdf->Ln(2);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(1);
            $pdf->Cell(10, 5, 'Nama', 0, 0, 'L');
            $pdf->Cell(15);
            $pdf->Cell(2, 5, ':', 0, 0, 'L');
            $pdf->Cell(1);
            $pdf->Cell(1, 5, $pembuat, 0, 1, 'L');
            $pdf->Cell(1);
            $pdf->Cell(10, 5, 'Jabatan', 0, 0, 'L');
            $pdf->Cell(15);
            $pdf->Cell(2, 5, ':', 0, 0, 'L');
            $pdf->Cell(1);
            $pdf->Cell(1, 5, $jabatanpembuatpernyataan, 0, 1, 'L');
            $pdf->Cell(1);
            $pdf->Cell(10, 5, 'Cabang', 0, 0, 'L');
            $pdf->Cell(15);
            $pdf->Cell(2, 5, ':', 0, 0, 'L');
            $pdf->Cell(1);
            $pdf->Cell(1, 5, $NamaAreaCabang, 0, 1, 'L');
            //body 2
            $pdf->Ln(5);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(1);
            $pdf->MultiCell(0, 5, $teks2);
            //body 3
            $pdf->Ln(2);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(1);
            $pdf->MultiCell(0, 5, $teks3);
            //body 3
            $pdf->Ln(2);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(1);
            $pdf->MultiCell(0, 5, $teks4);
            //ttd 1
            $pdf->Ln(50);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(1);
            $pdf->Cell(60, 5, 'Dibuat oleh,', 0, 0, 'C');
            //ttd 2
            $pdf->Ln(20);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(1);
            $pdf->Cell(60, 5, '( ' . $pembuat . ' )', 0, 1, 'C');
            //ttd 1
            $pdf->Ln(-25);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(325, 5, 'Disetujui oleh,', 0, 0, 'C');
            //ttd 2
            $pdf->Ln(20);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(1);
            $pdf->Cell(325, 5, '( ' . $Managercabang . ' )', 0, 1, 'C');
            $pdf->Ln();
            $pdf->SetFont('Times', 'BU', 12);
            $pdf->Cell(1);
            $pdf->Cell(325, 0, 'MANAGER CABANG', 0, 1, 'C');
            $pdf->Ln();
            $pdf->Output($KodeMax . '.pdf', 'I');
        } else {
            ?>
            <meta http-equiv='refresh' content='0; url=index'>
            <script type="text/javascript">
                alert("jumlah NoVa salah dan benar tidak sama...!!!");
            </script>
            <?php
        }
    }

    function daftarRefundAction() {
        $this->view->username = $this->auth['username'];
        $this->view->usergroup = $this->auth['usergroup'];
        $query_siswa = Refund::query()
                ->columns(array("*"))
                ->where("Created > '2019-01-01' AND JenisRefund = 'Refund Siswa' AND TrackFinance = 'Pending' OR Created > '2019-01-01' AND JenisRefund = 'Refund Siswa' AND TrackFinance = 'Approved' AND TrackGM = 'Pending'")
                ->order("Created DESC")
                ->execute();
        $this->view->list_refund_siswa = $query_siswa;
        $query_nominal = Refund::query()
                ->columns(array("*"))
                ->where("Created > '2019-01-01' AND JenisRefund = 'Refund Nominal' AND TrackFinance = 'Pending' OR Created > '2019-01-01' AND JenisRefund = 'Refund Nominal' AND TrackFinance = 'Approved' AND TrackGM = 'Pending'")
                ->order("Created DESC")
                ->execute();
        $this->view->list_refund_nominal = $query_nominal;
        $query_double = Refund::query()
                ->columns(array("*"))
                ->where("Created > '2019-01-01' AND JenisRefund = 'Refund Double' AND TrackFinance = 'Pending' OR Created > '2019-01-01' AND JenisRefund = 'Refund Double' AND TrackFinance = 'Approved' AND TrackGM = 'Pending'")
                ->order("Created DESC")
                ->execute();
        $this->view->list_refund_double = $query_double;

        $sql = "select
            refund.RecID,
            refund.NoSuratPernyataan,
            areacabang.NamaAreaCabang,
            refund.CreateBy,
            refund.NoVaSalah,
            refund.NoVaBenar,
            refund.TanggalTransfer,
            refund.LebihNominal as nominaltransfer,
            case when refund.Deposite = 0 then 0 else refund.Nominal end as nominalbenar,
            case when refund.Deposite = 0 then refund.Nominal else refund.Deposite end as Deposite,
            refund.Kronologi,
            refund.TrackFinance,
            refund.TrackGM,
            case when refund.JenisDeposite ='00' then 'Refund' when refund.JenisDeposite ='01' then 'pembayaran Ongkir / MD / RFID' when refund.JenisDeposite ='02' then 'pembelian buku' end as dialihkan,
            cast(refund.Created as date) as tglkoreksi,
            case when refund.DepositIsUsing=0 then 'belum' else 'sudah' end as digunakan
        from refund
        join areacabang on refund.CreateBy=LTRIM(RTRIM(areacabang.KodeAreaCabang))
        where refund.Created > '2019-01-01' AND refund.JenisRefund='Deposite' AND refund.TrackFinance = 'Pending' ORDER BY refund.Created DESC";
        $query_deposit = $this->getDI()->getShared('db')->query($sql);
        $query_deposit->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->list_refund_deposit = $query_deposit->fetchAll($query_deposit);
    }

    /**
     * Approval for refund
     */
    function ubahfinanceAction() {
        $helper = new Helpers();
        if (count($_POST['RecID']) < 1) {
            ?>
            <meta http-equiv='refresh' content='0; url=daftarRefund'>
            <script type="text/javascript">
                alert("Tidak ada data yang terpilih...!!!");
            </script>
            <?php
        } else {
            if (isset($_POST['ubahstatus'])) {
                $usergroup = $this->auth['usergroup'];
                $id = $_POST['RecID'];
                $ubahstatus = $this->request->getPost("ubahstatus");
                $Keterangan1 = $this->request->getPost("Keterangan");
                $ApprovedBy = $this->auth['fullname'];
                $Keterangan = "";
                $KeteranganGM = "";
                if ($usergroup == '21') {
                    if ($Keterangan1 != "") {
                        $Keterangan = $Keterangan1;
                    } else {
                        $Keterangan = 'NULL';
                    }
                } else {
                    if ($Keterangan1 != "") {
                        $KeteranganGM = $Keterangan1;
                    } else {
                        $KeteranganGM = 'NULL';
                    }
                }

                $authBranchCode = trim($this->session->get('auth')["kodeareacabang"]);
                $authBranchCode = ($authBranchCode != "") ? $authBranchCode : "0000";
                $username = $this->session->get('auth')["username"];
                $depositList = array();
                $isRequestAPI = false;
                $tglApproval = date('Y-m-d H:i:s');
                $N = count($id);
                for ($i = 0; $i < $N; $i++) {
                    //get refund data 
                    $sql = "
                            SELECT areacabang.NamaAreaCabang, areacabang.Email, areacabang.KodeAreaCabang, refund.NoSuratPernyataan, refund.ModifiedGM, refund.Modified, refund.Nominal, refund.JenisDeposite, refund.JenisRefund, TrackFinance, TrackGM, refund.TipeTrx, refund.kodeTB   
                            FROM refund 
                            JOIN areacabang ON areacabang.KodeAreaCabang = refund.CreateBy 
                            WHERE refund.RecID = '" . $id[$i] . "'";
                    $query = $this->getDI()->getShared('db')->query($sql);
                    $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
                    $result = $query->fetch($query);
                    $emailReceiver = "";
                    $emailReceiverName = "";
                    $messageApproved = "";
                    $messageRejected = "";
                    $trackAccountReceivable = "";
                    $trackFinance = "";
                    $jenisRefund = "";
                    $branchCode = "";
                    $nominal = "";
                    $jenisDeposite = "";
                    $jenisPengalihan = "";
                    $tipeTrx = "";
                    $kodeTB = "";
                    $NoSuratPernyataan = "";
                    if (count($result) > 0) {
                        $trackAccountReceivable = $result->TrackFinance;
                        $trackFinance = $result->TrackGM;
                        $jenisRefund = $result->JenisRefund;
                        $branchCode = $result->KodeAreaCabang;
                        $nominal = $result->Nominal;
                        $jenisDeposite = $result->JenisDeposite;
                        $tipeTrx = $result->TipeTrx;
                        $jenisPengalihan = $this->refundConfig->jenisPengalihan[$jenisDeposite];
                        $emailReceiver = $result->Email;
                        $emailReceiverName = $result->NamaAreaCabang;
                        $messageApproved = "Dear Bpk/Ibu Cabang " . $result->NamaAreaCabang . ",<br/><br/> <b>Refund</b> dengan no ref. <b>" . $result->NoSuratPernyataan . "</b> sudah berhasil dikembalikan pada tanggal <b>" . $tglApproval . "</b>";
                        $messageRejected = "Dear Bpk/Ibu Cabang " . $result->NamaAreaCabang . ",<br/><br/> <b>Refund</b> dengan no ref. <b>" . $result->NoSuratPernyataan . "</b> telah direject dengan alasan :<br/><i>" . $Keterangan1 . "</i>";

                        $kodeTB = $result->kodeTB;
                        $NoSuratPernyataan = $result->NoSuratPernyataan;
                    }

                    $this->db->begin();

                    if ($username == 'kitty' && $trackAccountReceivable == 'Pending' || $username == 'devyana' && $trackAccountReceivable == 'Pending' || $username == 'rini' && $trackAccountReceivable == 'Pending' || $username == 'ukky' && $trackAccountReceivable == 'Pending') {//ACCOUNT RECEIVABLE APPROVAL
                        $this->db->execute("UPDATE refund SET TrackFinance = '$ubahstatus', Modified = '" . $tglApproval . "', Keterangan = '$Keterangan', ApprovedBy = '$ApprovedBy' WHERE RecID = '" . $id[$i] . "'");
                        if (count($result) > 0) {
                            //REJECT
                            if (trim(strtolower($ubahstatus)) == "rejected") {
                                //send email notification to branch when account receivable rejected
                                $this->sendEmail("Refund", $messageRejected, $emailReceiver, $emailReceiverName);
                            }
                            //APPROVE
                            if (trim(strtolower($ubahstatus)) == "approved") {
                                //if refund type is deposit
                                if (trim(strtolower($jenisRefund)) == "deposite") {
                                    //send email notification to branch when AR approved for deposit
                                    $this->sendEmail("Refund", $messageApproved, $emailReceiver, $emailReceiverName);

                                    $description = "Kesalahan transfer dan dialihkan untuk " . $jenisPengalihan;
                                    if ($tipeTrx == 3) {//dari Franchise Fee
                                        $description = "Kesalahan transfer dari Franchise Fee";
                                    }
                                    //prepare data for API request
                                    $deposit = array(
                                        "BranchCode" => trim($branchCode),
                                        "Nominal" => $nominal,
                                        "CreatedBy" => $username,
                                        "Description" => $description,
                                        "IsInOrOut" => "1",
                                        "Status" => "1"
                                    );
                                    //jika jenis pengalihan deposit ke buku
                                    if ($jenisDeposite == 1) {
                                        $depositList[] = $deposit;
                                        $isRequestAPI = true;
                                    }
                                    //jika dana dialokasikan ke FF
                                    if ($jenisDeposite == 2) {
                                        $ffid = $this->__getFFID($branchCode);
                                        if ($ffid) {
                                            $amount = $nominal;
                                            $purchaseamount = $nominal;
                                            $paymentdatetime = date('YmdHis');
                                            $paymentcode = $NoSuratPernyataan;
                                            $recidbank = $kodeTB;
                                            $dataFF = array(
                                                'AMOUNT' => $amount,
                                                'PURCHASEAMOUNT' => $purchaseamount,
                                                'FFID' => $ffid,
                                                'TRANSIDMERCHANT' => '#',
                                                'RESULTMSG' => 'SUCCESS',
                                                'PAYMENTDATETIME' => $paymentdatetime,
                                                'PAYMENTCODE' => $paymentcode,
                                                'RecIdBank' => $recidbank
                                            );

                                            $this->__insertFranchiseFee($dataFF);
                                        }
                                    }
                                }
                            }
                        }
                    } else if ($username == 'ukky' && $trackAccountReceivable != 'Pending' && $trackFinance == 'Pending' || $username == 'endra' && $trackAccountReceivable != 'Pending' && $trackFinance == 'Pending') {//FINANCE APPROVAL
                        $this->db->execute("UPDATE refund SET TrackGM = '$ubahstatus', ModifiedGM = '" . $tglApproval . "', KeteranganGM = '$KeteranganGM', ApprovedByGM = '$ApprovedBy' WHERE RecID = '" . $id[$i] . "'");
                        if (count($result) > 0) {
                            //REJECT
                            if (trim(strtolower($ubahstatus)) == "rejected") {
                                //send email if not already rejected by account receivable
                                if (trim(strtolower($trackAccountReceivable)) != "rejected") {
                                    $this->sendEmail("Refund", $messageRejected, $emailReceiver, $emailReceiverName);
                                }
                            }
                            //APPROVE
                            if (trim(strtolower($ubahstatus)) == "approved") {
                                //send email notification to branch when finance approved
                                $this->sendEmail("Refund", $messageApproved, $emailReceiver, $emailReceiverName);
                            }
                        }
                    }

                    $this->db->commit();
                } //end loop each $N
//                var_dump($depositList);
//                die();
//                
                if ($isRequestAPI) {
                    //request API to create deposit details
                    $url = $this->apiConfig->baseUrl . "deposit/details";
                    $apiKey = $this->session->get('apiKey');
                    $response = $helper->requestAPI($url, "POST", json_encode($depositList), $apiKey, NULL);
                    if ($response["code"] == 200) {
                        
                    }
                    //save outgoing request
                    $http_response_code = $response["code"];
                    $this->saveOutgoingRequest(array(
                        'API_Key' => $apiKey,
                        'Branch_Code' => $authBranchCode,
                        'Request_Data' => json_encode($depositList),
                        'Resource_Name' => "Create Deposit Details",
                        'Endpoint' => $url,
                        'Status_Code' => $http_response_code,
                        'Created_At' => date('Y-m-d H:i:s'),
                        'Created_By' => $username,
                    ));
                }
            } //end if isset $_POST["ubahstatus"]

            $this->flash->success("Tracking berhasil diubah");
            $this->response->redirect("refund/daftarRefund");
        }
    }

    private function __getFFID($branch_code) {
        $sql = "SELECT * FROM Franchise_Fee WHERE BranchCode = '" . $branch_code . "' AND IsActive = 1";
        $query = $this->getDI()->getShared('db3')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $numRows = $query->numRows();
        $result = $query->fetch($query);
        if ($numRows > 0) {
            return $result->FFID;
        } else {
            return false;
        }
    }

    private function __insertFranchiseFee($data) {
        $sql = "INSERT INTO Franchise_Transactions (AMOUNT,PURCHASEAMOUNT,FFID,TRANSIDMERCHANT,RESULTMSG,PAYMENTDATETIME,PAYMENTCODE,RecIdBank) 
                VALUES (".$data['AMOUNT'].", ".$data['PURCHASEAMOUNT'].", '".$data['FFID']."', '".$data['TRANSIDMERCHANT']."', '".$data['RESULTMSG']."', '".$data['PAYMENTDATETIME']."', '".$data['PAYMENTCODE']."', ".$data['RecIdBank'].")";
        $this->getDI()->getShared('db3')->query($sql);
    }

    //detail permohonan refund cabang
    function detailAction($id) {
        //$query = "SELECT Refund.*,areacabang.NamaAreaCabang,areacabang.Email,tahunajaran.Description FROM [Refund] JOIN [areacabang] ON areacabang.KodeAreaCabang = Refund.CreateBy JOIN tahunajaran ON refund.TahunAjaran=tahunajaran.Description WHERE Refund.RecID = '$id'";
        $result = array();
        // Cache
        $cache_key = 'Refund-detailAction';
        if ($this->getDI()->has('dataCache') && $this->dataCache->exists($cache_key)) {
            $result = $this->dataCache->get($cache_key);
//            echo "<h1>CACHE</h1>";
//            var_dump($result);
        } else {

//            echo "<h1>DATABASE</h1>";
//            var_dump($result);
        }
        $query = "
            SELECT Refund.*,
areacabang.NamaAreaCabang,
areacabang.Email,
tahunajaran.Description 
FROM [Refund] 
JOIN [areacabang] ON areacabang.KodeAreaCabang = Refund.CreateBy 
LEFT JOIN tahunajaran ON refund.TahunAjaran=tahunajaran.RecID 
WHERE Refund.RecID = " . $id . "
                ";
        $query = $this->getDI()->getShared('db')->query($query);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);

        if ($this->getDI()->has('dataCache')) {
            $this->dataCache->save($cache_key, $result);
        }

        //delete cache
//        $this->getDI()->get('dataCache')->delete("Refund-detailAction");
//        $this->getDI()->get('dataCache')->flush();
        $this->view->usergroup = $this->auth['usergroup'];
        $this->view->username = $this->auth['username'];

        foreach ($result as $rows) {
            $this->view->NoSuratPernyataan = $rows->NoSuratPernyataan;
            $this->view->JenisRefund = $rows->JenisRefund;
            $this->view->NamaPembuatPernyataan = $rows->NamaPembuatPernyataan;
            $this->view->JabatanPembuatPernyataan = $rows->JabatanPembuatPernyataan;
            $this->view->TelpCabang = $rows->TelpCabang;
            $this->view->AlamatCabang = $rows->AlamatCabang;
            $this->view->NoVaSalah = $rows->NoVaSalah;
            $this->view->NoVaBenar = $rows->NoVaBenar;
            $this->view->TanggalTransfer = $this->tgl_indo($rows->TanggalTransfer);
            $this->view->LebihNominal = "Rp " . number_format($rows->LebihNominal, 2, ',', '.');
            $this->view->LebihNominalterbilang = $this->terbilang($rows->LebihNominal);
            $this->view->Nominal = "Rp " . number_format($rows->Nominal, 2, ',', '.');
            $this->view->Nominalterbilang = $this->terbilang($rows->Nominal);
            $this->view->Kronologi = $rows->Kronologi;
            $this->view->CreateBy = $rows->CreateBy;
            $this->view->NamaAreaCabang = $rows->NamaAreaCabang;
            $this->view->TrackFinance = $rows->TrackFinance;
            $this->view->TrackGM = $rows->TrackGM;
            $this->view->Keterangan = $rows->Keterangan;
            $this->view->JenisDeposite = ($rows->JenisDeposite != NULL) ? $this->refundConfig->jenisPengalihan[$rows->JenisDeposite] : $rows->JenisDeposite;
            $this->view->nominaldeposit = "Rp " . number_format($rows->Deposite, 2, ',', '.');
            $this->view->nominaldepositterbilang = $this->terbilang($rows->Deposite);
            $this->view->Created = "Tanggal : " . $this->tgl_indo(date('Y-m-d', strtotime($rows->Created))) . " Jam : " . date('H:i:s', strtotime($rows->Created));
            $this->view->Modified = "Tanggal : " . $this->tgl_indo(date('Y-m-d', strtotime($rows->Modified))) . " Jam : " . date('H:i:s', strtotime($rows->Modified));
            $this->view->ModifiedGM = "Tanggal : " . $this->tgl_indo(date('Y-m-d', strtotime($rows->ModifiedGM))) . " Jam : " . date('H:i:s', strtotime($rows->ModifiedGM));
            $this->view->EmailCabang = $rows->Email;
            $this->view->RecID = $rows->RecID;
            $this->view->TahunAjaran = $rows->Description;
            $this->view->AlasanRejectAccountReceivable = $rows->Keterangan;
            $this->view->AlasanRejectFinance = $rows->KeteranganGM;
        }
    }

    function trakAction() {
        $err_code = 0;
        $nosurat = isset($_GET['nosurat']) ? $_GET['nosurat'] : "";
        if ($nosurat == "") {
            $err_code++;
        }

        $query = Refund::query()
                ->columns(array("*"))
                ->Where("NoSuratPernyataan = '$nosurat'")
                ->execute();
        if ($query->count() > 0) {
            foreach ($query as $rows) {
                $this->view->nosurat = $rows->NoSuratPernyataan;
                $this->view->TrackFinance = strtoupper($rows->TrackFinance);
                $this->view->Keterangan = $rows->Keterangan;
                $this->view->tgl = $this->tgl_indo(date('Y-m-d', strtotime($rows->Modified)));
                $this->view->jam = date('H:i:s', strtotime($rows->Modified));
                $this->view->tglGM = $this->tgl_indo(date('Y-m-d', strtotime($rows->ModifiedGM)));
                $this->view->jamGM = date('H:i:s', strtotime($rows->ModifiedGM));
                $this->view->TrackGM = strtoupper($rows->TrackGM);
                $this->view->JenisRefund = $rows->JenisRefund;
            }
        } else {
            $err_code++;
        }

        if ($err_code > 0) {
            $this->response->redirect("refund");
        }
    }

    function sendapprovedallAction() {
        $NamaCabang = $this->request->getPost("NamaCabang");
        $EmailCabang = $this->request->getPost("EmailCabang");
        $JenisRefund = $this->request->getPost("JenisRefund");
        $NoSuratPernyataan = $this->request->getPost("NoSuratPernyataan");
        $RecID = $this->request->getPost("RecID");
        if ($JenisRefund == 'Deposite') {
            $jeniskesalahan = 'Deposite';
        } else {
            $jeniskesalahan = 'Refund';
        }

        $message = "<h3>Dear, " . $NamaCabang . "</h3>
        <div>
            <table style='border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;'>
                <tr>
                    <td>Terima kasih atas konfirmasinya proses " . $jeniskesalahan . " dengan no tiket " . $NoSuratPernyataan . " telah selesai dilakukan pada tanggal " . $this->tgl_indo(date('Y-m-d')) . ".</td>
                </tr>
            </table>
        </div>
        <br/>
        <div style=\"margin:0;\"><font face=\"Times New Roman,serif\" size=\"3\" style=\"font-family: &quot;Times New Roman&quot;, serif, serif, EmojiFont;\"><span style=\"font-size:12pt;\"><font face=\"Comic Sans MS\" size=\"2\" color=\"#2E74B5\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:11pt;\"><b>Best Regards,</b></span></font></span></font></div>
        <div style=\"margin:0;\"><font face=\"Times New Roman,serif\" size=\"3\" style=\"font-family: &quot;Times New Roman&quot;, serif, serif, EmojiFont;\"><span style=\"font-size:12pt;\"><font face=\"Comic Sans MS\" size=\"1\" color=\"#2E74B5\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\"><b>Finance &amp; Accounting </b></span></font></span></font></div>
        <div style=\"margin:0;\"><font face=\"Times New Roman,serif\" size=\"3\" style=\"font-family: &quot;Times New Roman&quot;, serif, serif, EmojiFont;\"><span style=\"font-size:12pt;\"><font face=\"Comic Sans MS\" size=\"1\" color=\"#2E74B5\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\"><b>PT Prima Edu Pendamping Belajar</b></span></font></span></font></div>
        <div style=\"margin:0;\"><font face=\"Times New Roman,serif\" size=\"3\" style=\"font-family: &quot;Times New Roman&quot;, serif, serif, EmojiFont;\"><span style=\"font-size:12pt;\"><font face=\"Comic Sans MS\" size=\"1\" color=\"#2E74B5\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\">Jln. Ciasem I No. 9, Kebayoran Baru</span></font></span></font></div>
        <div style=\"margin:0;\"><font face=\"Times New Roman,serif\" size=\"3\" style=\"font-family: &quot;Times New Roman&quot;, serif, serif, EmojiFont;\"><span style=\"font-size:12pt;\"><font face=\"Comic Sans MS\" size=\"1\" color=\"#2E74B5\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\">Telp: 021-29304102</span></font></span></font></div>
        <div style=\"margin:0;\"><font face=\"Times New Roman,serif\" size=\"3\" style=\"font-family: &quot;Times New Roman&quot;, serif, serif, EmojiFont;\"><span style=\"font-size:12pt;\"><font face=\"Comic Sans MS\" size=\"1\" color=\"#2E74B5\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\">email</span></font><font face=\"Comic Sans MS\" size=\"1\" color=\"#404040\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\">:
        </span></font><a href=\"mailto:finance@primagama.co.id\" target=\"_blank\" rel=\"noopener noreferrer\"><font face=\"Comic Sans MS\" size=\"1\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\"><font color=\"#0563C1\">finance@primagama.co.id</font></span></font></a></span></font></div>
        </div>
        <p>Silakan klik <a href=\"https://www.primagama.co.id\">www.primagama.co.id</a> untuk melihat informasi lainnya.</p>
        <p>Salam SMART,</p>
        <p>Copyright&copy; " . date("Y") . " PT. Prima Edu, Primagama<p>";

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.office365.com";
        $mail->Port = "587";
        $mail->Username = base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ=');
        $mail->Password = base64_decode('UHJpbWEuMTIzNA==');
        $mail->SetFrom(base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ='), 'Primagama');
        $mail->MsgHTML($message);
        $mail->Subject = 'Konfirmasi Refund';
        $mail->AddCC("if.hamzah93@gmail.com", "Helpdesk Primagama");
        $mail->AddCC("sulistia.oktaviani@primagama.co.id", "Helpdesk Primagama");
        /* $mail->AddCC("suciaty.kitty@primagama.co.id", "Helpdesk Primagama");
          $mail->AddAddress($EmailCabang, $NamaCabang); */

        if (!$mail->send()) {
            ?>
            <meta http-equiv='refresh' content='0; url=detail/<?php echo $RecID; ?>'>
            <script type="text/javascript">
                alert("<?php echo "Mailer Error: " . $mail->ErrorInfo; ?>");
            </script>
            <?php
        } else {
            ?>
            <meta http-equiv='refresh' content='0; url=detail/<?php echo $RecID; ?>'>
            <script type="text/javascript">
                alert("Pemberitahuan berhasil dikirim ke email <?php echo $EmailCabang; ?>");
            </script>
            <?php
        }
    }

    function laporanAction() {
        $tahunAjaran = Tahunajaran::find(['order' => 'RecID DESC']);
        $this->view->TahunAjaran = $tahunAjaran;
    }

    public function viewAction() {

        $DateFrom = $this->request->getPost('DateFrom');
        $DateTo = $this->request->getPost('DateTo');
        $tahunAjaran = $this->request->getPost('TahunAjaran');
        /*
          $sql = "SELECT KodeAreaCabang,NamaAreaCabang,VirtualAccount, CreatedAt ,MD, NamaSiswa,NamaJenjang,Cabang,isnull(sum(JumlahTotal),0) as JumlahTotal,isnull(cte.koreksi,0) as koreksi,cte.Keterangan,cte.tanggal,
          (select isnull(sum(transaksibank.Nominal),0) as Uang_masuk from transaksibank where transaksibank.Siswa = cte.RecID and tahunajaran=3 and KodeCabang=cte.KodeAreaCabang and len(NoReferensi) != 4 and len(NoReferensi) != 6)as Uang_masuk,
          (select isnull(sum(jumlah),0) as uang from pembayarandetail join pembayaran on pembayaran.RecID=pembayarandetail.Pembayaran join programsiswa on programsiswa.RecID=pembayaran.ProgramSiswa where programsiswa.Siswa=cte.RecID and pembayaranmetode=8) as uang
          from (select siswa.VirtualAccount,cast(siswa.CreatedAt as date) as CreatedAt,Siswa.RecId,Siswa.MD,areacabang.KodeAreaCabang,areacabang.NamaAreaCabang,siswa.NamaSiswa,siswa.cabang, jenjang.NamaJenjang,(pembayaran.JumlahTotal-pembayarandetail.Jumlah) as JumlahTotal,sum(cta.koreksi) as koreksi,cta.Keterangan,cta.tanggal
          From Siswa
          join programsiswa ON siswa.RecID = programsiswa.siswa
          join program ON program.RecID = programsiswa.program
          join tahunajaran ON tahunajaran.RecID = program.tahunajaran
          join pembayaran ON pembayaran.ProgramSiswa = programsiswa.RecID
          join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
          join areacabang ON areacabang.RecID = siswa.cabang
          join jenjang on siswa.Jenjang=jenjang.KodeJenjang
          left join
          (select ref.Siswa,ref.KodeCabang,ref.tahunajaran,ref.koreksi,ref.Keterangan,tanggal from
          (Select transaksibank.Siswa,transaksibank.KodeCabang,transaksibank.tahunajaran,refund.TanggalTransfer as tanggal,
          CASE WHEN refund.NoVaBenar = transaksibank.NoVa AND refund.TrackFinance = 'Approved' AND refund.TrackGM = 'Approved' THEN refund.Selisih WHEN refund.NovaSalah = transaksibank.NoVa AND refund.TrackFinance = 'Approved' AND refund.TrackGM = 'Approved' THEN refund.Nominal ELSE 0 END AS koreksi,
          CASE WHEN refund.NovaSalah = transaksibank.NoVa AND refund.TrackFinance = 'Approved' AND refund.TrackGM = 'Approved' THEN concat('refund kesalahan transfer ', refund.NoVaBenar) WHEN refund.NoVaBenar = transaksibank.NoVa AND refund.TrackFinance = 'Approved' AND refund.TrackGM = 'Approved' AND refund.Selisih IS NOT NULL THEN 'refund kelebihan nominal' WHEN refund.NoVaBenar = transaksibank.NoVa AND refund.TrackFinance = 'Approved' AND refund.TrackGM = 'Approved' AND refund.Selisih IS NULL THEN '' END AS Keterangan
          from dbo.transaksibank LEFT JOIN dbo.refund ON dbo.refund.NoVaBenar = transaksibank.NoVA AND dbo.refund.TrackFinance = 'Approved' AND dbo.refund.TrackGM = 'Approved' AND dbo.refund.TanggalTransfer = dbo.transaksibank.TanggalTransaksi AND dbo.refund.Selisih IS NOT NULL AND dbo.refund.TahunAjaran = dbo.transaksibank.tahunajaran
          AND (select cast(rf.LebihNominal as int)-cast(rf.Nominal as int) from refund rf where rf.RecID=refund.RecID) = dbo.transaksibank.Nominal
          OR dbo.refund.NoVaSalah = transaksibank.NoVA AND dbo.refund.TrackFinance = 'Approved' AND dbo.refund.TrackGM = 'Approved' AND dbo.refund.TanggalTransfer = dbo.transaksibank.TanggalTransaksi AND dbo.refund.TahunAjaran = dbo.transaksibank.tahunajaran AND dbo.refund.Nominal = dbo.transaksibank.Nominal OR dbo.refund.NoVaBenar = transaksibank.NoVA AND dbo.refund.TrackFinance = 'Approved' AND dbo.refund.TrackGM = 'Approved' AND dbo.refund.Selisih IS NULL) as ref where ref.koreksi !=0) cta on siswa.RecID=cta.Siswa and areacabang.KodeAreaCabang=cta.KodeCabang and cta.tahunajaran=3
          Where program.tahunajaran =3 and siswa.cabang =1259 and pembayarandetail.pembayaranuntuk='Pendaftaran' and tanggal BETWEEN '2010-01-01' AND '2018-01-01'
          group by siswa.VirtualAccount,Siswa.CreatedAt, Siswa.MD,Jenjang.NamaJenjang,pembayaran.JumlahTotal, siswa.NamaSiswa, program.NamaProgram, siswa.cabang, siswa.RecID,tahunajaran.Description,pembayarandetail.Jumlah,areacabang.KodeAreaCabang,areacabang.NamaAreaCabang,cta.koreksi,cta.Keterangan,cta.tanggal) as cte
          group by KodeAreaCabang,NamaAreaCabang,VirtualAccount,CreatedAt,MD,NamaJenjang,NamaSiswa,Cabang,RecID,kodeareacabang,koreksi,cte.Keterangan,cte.tanggal";
          echo $sql;
         */
        $sql = "
SELECT 
	KodeAreaCabang,
	NamaAreaCabang,
	VirtualAccount, 
	CreatedAt,
	MD, 
	NamaSiswa,
	NamaJenjang,
	Cabang,
	isnull(sum(JumlahTotal),0) AS TotalBiaya,
	isnull(cte.koreksi,0) AS Koreksi,
	cte.Keterangan,
	cte.Tanggal,
	(
		select 
			isnull(sum(transaksibank.Nominal),0) 
			as Uang_masuk 
		from 
			transaksibank 
		where 
			transaksibank.Siswa = cte.RecID  
			and KodeCabang=cte.KodeAreaCabang 
			and len(NoReferensi) != 4 
			and len(NoReferensi) != 6
	) 
	AS TotalPembayaran,
	(
		SELECT 
			isnull(sum(jumlah),0) 
			AS uang 
		FROM 
			pembayarandetail 
		JOIN 
			pembayaran 
			ON 
				pembayaran.RecID=pembayarandetail.Pembayaran 
		JOIN 
			programsiswa 
			ON 
				programsiswa.RecID=pembayaran.ProgramSiswa 
		WHERE 
			programsiswa.Siswa=cte.RecID 
			AND pembayaranmetode=8
	) 
	AS Diskon,
	cte.nosuratpernyataan AS NoSurat, 
	cte.TanggalPengajuan, 
	cte.TanggalApprovalAR,
	cte.TanggalApprovalFN,
	cte.StatusApprovalAR,
	cte.StatusApprovalFN, 
	cte.JenisRefund   
FROM 
	(
		SELECT 
			siswa.VirtualAccount,
			cast(siswa.CreatedAt as date) as CreatedAt,
			Siswa.RecId,
			Siswa.MD,
			areacabang.KodeAreaCabang,
			areacabang.NamaAreaCabang,
			siswa.NamaSiswa,
			siswa.cabang,
			jenjang.NamaJenjang,
			(pembayaran.JumlahTotal-pembayarandetail.Jumlah) as JumlahTotal,
			sum(cta.koreksi) as koreksi,
			cta.Keterangan,
			cta.tanggal, 
			cta.nosuratpernyataan, 
			cta.TanggalPengajuan, 
			cta.TanggalApprovalAR,
			cta.TanggalApprovalFN,
			cta.StatusApprovalAR,
			cta.StatusApprovalFN, 
			cta.JenisRefund       
		FROM 
			Siswa
		JOIN 
			programsiswa 
			ON 
				siswa.RecID = programsiswa.siswa
		JOIN 
			program 
			ON 
				program.RecID = programsiswa.program
		JOIN 
			tahunajaran 
			ON 
				tahunajaran.RecID = program.tahunajaran
		JOIN 
			pembayaran 
			ON 
				pembayaran.ProgramSiswa = programsiswa.RecID
		JOIN 
			pembayarandetail 
			ON 
				pembayaran.RecID=pembayarandetail.Pembayaran
		JOIN 
			areacabang 
			ON 
				areacabang.RecID = siswa.cabang
		JOIN 
			jenjang on siswa.Jenjang=jenjang.KodeJenjang
		JOIN
			(
				SELECT ref.Siswa,
				ref.KodeCabang,
				ref.tahunajaran,
				ref.koreksi,
				ref.Keterangan,
				tanggal, 
				ref.nosuratpernyataan, 
				ref.Created AS TanggalPengajuan, 
				ref.Modified AS TanggalApprovalAR,
				ref.ModifiedGM AS TanggalApprovalFN,
				ref.TrackFinance AS StatusApprovalAR,
				ref.TrackGM AS StatusApprovalFN, 
				ref.JenisRefund     
				FROM
				(
					SELECT transaksibank.Siswa,
					transaksibank.KodeCabang,
					transaksibank.tahunajaran,
					refund.TanggalTransfer AS tanggal,
					refund.nosuratpernyataan, 
					refund.Created, 
					refund.Modified,
					refund.ModifiedGM,
					refund.TrackFinance,
					refund.TrackGM,
					refund.JenisRefund,  
					CASE 
						WHEN 
							refund.JenisRefund = 'Refund Siswa' OR refund.JenisRefund = 'Refund Nominal' 
						THEN 
							refund.Nominal 
						WHEN 
							refund.JenisRefund = 'Refund Double'
						THEN 
							refund.Selisih 
						ELSE 
							0 
						END 
					AS koreksi,
					CASE 
						WHEN 
							refund.JenisRefund = 'Refund Siswa'
						THEN 
							concat('Refund Kesalahan Transfer ', refund.NoVaBenar) 
						WHEN 
							refund.JenisRefund = 'Refund Nominal'
						THEN 
							'Refund Kelebihan Nominal' 
						WHEN 
							refund.JenisRefund = 'Refund Double'
						THEN 
							'Refund Double Transfer'
						END 
					AS Keterangan 
					FROM 
						dbo.transaksibank 
					JOIN 
						dbo.refund 
						ON 
							dbo.refund.kodeTB = transaksibank.RecID
							
					WHERE 
						refund.TrackFinance != 'Pending' 
						AND refund.TrackGM != 'Pending' 
						AND refund.JenisRefund != 'Deposite'
				) 
				AS ref 
				WHERE ref.koreksi !=0 
			) 
			AS cta 
			ON 
				siswa.RecID=cta.Siswa 
				AND areacabang.KodeAreaCabang=cta.KodeCabang 
		WHERE 
			pembayarandetail.pembayaranuntuk='Pendaftaran' 
			AND CONVERT(VARCHAR(10),TanggalPengajuan, 120) BETWEEN '$DateFrom' AND '$DateTo'
		GROUP BY 
			siswa.VirtualAccount,
			Siswa.CreatedAt, 
			Siswa.MD,
			Jenjang.NamaJenjang,
			pembayaran.JumlahTotal, 
			siswa.NamaSiswa, 
			program.NamaProgram, 
			siswa.cabang, 
			siswa.RecID,
			tahunajaran.Description,
			pembayarandetail.Jumlah,
			areacabang.KodeAreaCabang,
			areacabang.NamaAreaCabang,
			cta.koreksi,
			cta.Keterangan,
			cta.tanggal, 
			cta.nosuratpernyataan, 
			cta.TanggalPengajuan, 
			cta.TanggalApprovalAR,
			cta.TanggalApprovalFN,
			cta.StatusApprovalAR,
			cta.StatusApprovalFN, 
			cta.JenisRefund 		
	)
	AS cte
GROUP BY 
	KodeAreaCabang,
	NamaAreaCabang,
	VirtualAccount,
	CreatedAt,
	MD,
	NamaJenjang,
	NamaSiswa,
	Cabang,
	RecID,
	kodeareacabang,
	koreksi,
	cte.Keterangan,
	cte.tanggal, 
	cte.nosuratpernyataan, 
	cte.TanggalPengajuan, 
	cte.TanggalApprovalAR,
	cte.TanggalApprovalFN,
	cte.StatusApprovalAR,
	cte.StatusApprovalFN, 
	cte.JenisRefund 
";
//echo $sql;
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->result = $query->fetchAll($query);
        $this->view->rpt_title = "Laporan Kesalahan Transfer" . date("Y-m-d H:i:s");
    }

    function laporandepositAction() {
        $this->view->jenisPengalihanList = $this->refundConfig->jenisPengalihan;
    }

    public function viewdepositAction() {

        $DateFrom = $this->request->getPost('DateFrom');
        $DateTo = $this->request->getPost('DateTo');
        $dialihkan = $this->request->getPost('dialihkan');
        $status = $this->request->getPost('status');

        $sql = "
SELECT 
	refund.NoSuratPernyataan, 
	areacabang.NamaAreaCabang, 
	refund.NoVaSalah, 
	refund.NoVaBenar, 
	refund.TanggalTransfer, 
	refund.Nominal, 
	refund.Kronologi, 
	refund.TrackFinance, 
	refund.JenisDeposite, 
	CAST(refund.Created AS DATE) AS tglkoreksi, 
	CASE 
		WHEN 
			refund.DepositIsUsing=0 
		THEN 
			'belum' 
		ELSE 
			'sudah' 
	END AS digunakan 
FROM 
	refund 
JOIN 
	areacabang 
	ON 
		refund.CreateBy=LTRIM(RTRIM(areacabang.KodeAreaCabang)) 
WHERE 
	CONVERT(VARCHAR(10),refund.Created, 120) BETWEEN '$DateFrom' 
	AND '$DateTo' 
	AND refund.JenisRefund = 'Deposite' 
        ";

        if ($status != "") {
            $sql .= "AND refund.TrackFinance = '" . $status . "'";
        }

        if ($dialihkan != "") {
            $sql .= "AND JenisDeposite = '$dialihkan'";
        }

//        echo $sql;
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->result = $query->fetchAll($query);
        $this->view->rpt_title = "Laporan Koreksi Transfer Deposit" . date("Y-m-d H:i:s");
        $this->view->jenisPengalihanList = $this->refundConfig->jenisPengalihan;
    }

    /**
     * ajax search transaction by kode cabang + VA
     */
    public function searchTransactionAction() {
        $this->view->disable();
        $q = strtolower($this->request->get("q"));
        $type = $this->request->get("type");
        $return = $this->request->get("return");
        $kode_cabang = $this->session->get('auth')["kodeareacabang"];
        //var_dump($areaCabangId);
        $sql = "
            SELECT
            DISTINCT
            a.RecID,
            a.Nominal,
            a.NoVA,
            a.TanggalTransaksi,
            b.NamaSiswa,
            c.Description as tahunAjaran
            FROM transaksibank a
            inner join siswa b on a.Siswa=b.RecID
            inner join tahunajaran c on a.tahunajaran=c.RecID 
WHERE DATEDIFF(MONTH, a.TanggalTransaksi, GETDATE()) < 3 AND a.NoVA LIKE '%" . $q . "%' ";



//where a.TanggalTransaksi >= DATEADD(MONTH, -3, GETDATE())
        if ($type == "1") {
            //Global
            $sql .= "AND LEN(a.NoVA) = 4 ";
        }
        if ($type == "2") {
            //Buku
            $sql .= "AND a.NoVA = '" . $kode_cabang . "02' ";
        }
        if ($type == "3") {
            //Franchise
            $sql .= "AND a.NoVA = '" . $kode_cabang . "03' ";
        }
        $sql .= "
            ORDER BY b.NamaSiswa asc
            OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY
            ";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);

        $result_formated = array();
        if ($return == NULL) {
            if (count($result) > 0) {
                foreach ($result as $rows) {
                    $result_formated[] = array(
                        'id' => $rows->RecID,
                        'text' => $rows->NoVA . ' --- ' . $rows->TanggalTransaksi . ' --- Rp.' . number_format($rows->Nominal, 2, ',', '.') . ' --- ' . $rows->tahunAjaran . ' --- ' . $rows->NamaSiswa
                    );
                }
            }
        } else {
            if ($return == "all_column") {
                $result_formated = $result;
            }
        }


        $response = array(
            'results' => $result_formated,
            'pagination' => array(
                'more' => false
            ),
        );

        $this->jsonResponse($response);
    }

    /**
     * ajax search refund by no surat pernyataan
     */
    public function searchRefundAction() {
        $this->view->disable();
        $q = strtolower($this->request->get("q"));
        $kode_cabang = $this->session->get('auth')["kodeareacabang"];
        $jenisRefund = $this->request->get("jenisRefund");
        $sql = "
            SELECT 
            a.RecID,
            a.NoSuratPernyataan, 
            a.TrackFinance as TrackAccountReceivable,
            a.TrackGM as TrackFinance 
            FROM refund a 
            WHERE a.JenisRefund = '" . $jenisRefund . "' AND a.NoSuratPernyataan LIKE '%" . $q . "%' ";

        $sql .= "ORDER BY a.RecID DESC";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);

        $response = array(
            'results' => $result,
            'pagination' => array(
                'more' => false
            ),
        );

        $this->jsonResponse($response);
    }

    /**
     * ajax search transaction cabang by kode cabang + VA
     */
    public function searchTransactionSiswaCabangAction() {
        $this->view->disable();
        $q = strtolower($this->request->get("q"));
        $return = strtolower($this->request->get("return"));
        $va = $this->request->get("va");
        $nominal = $this->request->get("nominal");
        $kode_cabang = $this->session->get('auth')["kodeareacabang"];

        $sql = "
            SELECT
            DISTINCT
            a.RecID,
            a.Nominal,
            a.NoVA,
            a.TanggalTransaksi,
            b.NamaSiswa,
            c.Description as tahunAjaran
            FROM transaksibank a
            inner join siswa b on a.Siswa=b.RecID
            inner join tahunajaran c on a.tahunajaran=c.RecID 
            left join areacabang d on b.Cabang=d.RecID 
            WHERE LTRim(RTRIM(d.KodeAreaCabang))='" . $kode_cabang . "' 
AND DATEDIFF(MONTH, a.TanggalTransaksi, GETDATE()) < 3
            ";



//AND a.TanggalTransaksi >= DATEADD(MONTH, -3, GETDATE()) 
//        a.TanggalTransaksi >= DATEADD(MONTH, -3, GETDATE()) AND

        if ($va != NULL) {
            $sql .= "AND a.NoVA = '" . $va . "'";
        }
        if ($nominal != NULL) {
            $sql .= " AND a.Nominal = " . $nominal . "";
        }
        $sql .= "
            AND a.NoVA LIKE '%" . $q . "%' 
            ORDER BY b.NamaSiswa asc
            OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY
                ";
        //where LTRim(RTRIM(d.KodeAreaCabang))='" . $this->auth['kodeareacabang'] . "'
//        echo $sql;
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);

        $result_formated = array();
        if ($return == NULL) {
            if (count($result) > 0) {
                foreach ($result as $rows) {
                    $result_formated[] = array(
                        'id' => $rows->RecID,
                        'text' => $rows->NoVA . ' --- ' . $rows->TanggalTransaksi . ' --- Rp.' . number_format($rows->Nominal, 2, ',', '.') . ' --- ' . $rows->tahunAjaran . ' --- ' . $rows->NamaSiswa
                    );
                }
            }
        } else {
            if ($return == "all_column") {
                $result_formated = $result;
            }
        }


        $response = array(
            'results' => $result_formated,
            'pagination' => array(
                'more' => false
            ),
        );

        $this->jsonResponse($response);
    }

    public function searchTransactionCabangAction() {
        $this->view->disable();
        $q = strtolower($this->request->get("q"));
        $type = $this->request->get("type");
        $return = $this->request->get("return");
        $kode_cabang = $this->session->get('auth')["kodeareacabang"];

        $sql = "
            SELECT
            DISTINCT
            a.RecID,
            a.Nominal,
            a.NoVA,
            a.TanggalTransaksi, 
            b.NamaAreaCabang 
            FROM transaksibank a 
            INNER JOIN areacabang b ON b.KodeAreaCabang = a.KodeCabang 
            
WHERE DATEDIFF(MONTH, a.TanggalTransaksi, GETDATE()) < 3
        ";
//WHERE a.TanggalTransaksi >= DATEADD(MONTH, -3, GETDATE())
        //WHERE a.KodeCabang = '" . $kode_cabang . "' 
        if ($type == "1") {
            //Global
            $sql .= "AND LEN(a.NoVA) = 4 ";
        }
        if ($type == "2") {
            //Buku
            $sql .= "AND LEN(a.NoVA) = 6 AND SUBSTRING(a.NoVA, 5, 2) = '02' ";
        }
        if ($type == "3") {
            //Franchise
            $sql .= "AND LEN(a.NoVA) = 6 AND SUBSTRING(a.NoVA, 5, 2) = '03' ";
        }
        $sql .= "AND a.NoVA LIKE '%" . $q . "%' 
            ORDER BY a.RecID desc 
            OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY
            ";

//        echo $sql;
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);

        $result_formated = array();
        if ($return == NULL) {
            if (count($result) > 0) {
                foreach ($result as $rows) {
                    $result_formated[] = array(
                        'id' => $rows->RecID,
                        'text' => $rows->NoVA . ' --- ' . $rows->TanggalTransaksi . ' --- Rp.' . number_format($rows->Nominal, 2, ',', '.')
                    );
                }
            }
        } else {
            if ($return == "all_column") {
                $result_formated = $result;
            }
        }


        $response = array(
            'results' => $result_formated,
            'pagination' => array(
                'more' => false
            ),
        );

        $this->jsonResponse($response);
    }

    /**
     * ajax get transaction by id
     */
    public function getTransactionAction() {
        $this->view->disable();
        $id = $this->request->get("id");

        $sql = "
            SELECT
            DISTINCT
            a.RecID,
            a.Nominal,
            a.NoVA,
            a.TanggalTransaksi,
            a.Siswa as SiswaID,
            b.NamaSiswa,
            c.Description as tahunAjaran,
            c.RecID as tahunAjaranID
            FROM transaksibank a
            inner join siswa b on a.Siswa=b.RecID
            inner join tahunajaran c on a.tahunajaran=c.RecID
            where a.RecID = {$id} 
            ORDER BY b.NamaSiswa asc
            OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY
        ";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetch($query);

        $response = array(
            'results' => $result,
        );

        $this->jsonResponse($response);
    }

    /**
     * ajax get transaction by id
     */
    public function getTransactionCabangAction() {
        $this->view->disable();
        $id = $this->request->get("id");

        $sql = "
            SELECT
            DISTINCT
            a.RecID,
            a.Nominal,
            a.NoVA,
            b.NamaAreaCabang,
            a.TanggalTransaksi 
            FROM transaksibank a 
            INNER JOIN areacabang b ON b.KodeAreaCabang = a.KodeCabang 
            where a.RecID = {$id} 
            ORDER BY a.RecID asc 
            OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY
        ";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetch($query);

        $response = array(
            'results' => $result,
        );

        $this->jsonResponse($response);
    }

    /**
     * ajax get siswa cabang
     */
    public function getSiswaCabangAction() {
        $this->view->disable();
        $id = $this->request->get("id");

        $sql = "
            select
            DISTINCT
            a.RecID,
            a.NamaSiswa,
            CONCAT(LTRim(RTRIM(b.KodeAreaCabang)),a.VirtualAccount) as NoVA
            from siswa a
            inner join areacabang b on a.Cabang=b.RecID 
            AND a.RecID = {$id} 
            ORDER BY a.NamaSiswa asc
            OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY
        ";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetch($query);

        $response = array(
            'results' => $result,
        );

        $this->jsonResponse($response);
    }

    /**
     * ajax search siswa cabang by kode cabang + VA
     */
    public function searchSiswaCabangAction() {
        $this->view->disable();
        $q = strtolower($this->request->get("q"));
        $return = strtolower($this->request->get("return"));
        $kode_cabang = $this->session->get('auth')["kodeareacabang"];

        $sql = "
            select
            DISTINCT
            a.RecID,
            a.NamaSiswa,
            b.KodeAreaCabang,
            CONCAT(LTRim(RTRIM(b.KodeAreaCabang)),a.VirtualAccount) as NoVa
            from siswa a
            inner join areacabang b on a.Cabang=b.RecID
            where LTRim(RTRIM(b.KodeAreaCabang))='" . $kode_cabang . "'
            AND CONCAT(LTRim(RTRIM(b.KodeAreaCabang)),a.VirtualAccount) LIKE '%" . $q . "%' 
            ORDER BY a.NamaSiswa asc
            OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY
        ";

        //echo $sql;
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);

        $result_formated = array();
        if ($return == NULL) {
            if (count($result) > 0) {
                foreach ($result as $rows) {
                    $result_formated[] = array(
                        'id' => $rows->RecID,
                        'text' => $rows->NoVa . ' / ' . $rows->NamaSiswa
                    );
                }
            }
        } else {
            if ($return == "all_column") {
                $result_formated = $result;
            }
        }


        $response = array(
            'results' => $result_formated,
            'pagination' => array(
                'more' => false
            ),
        );

        $this->jsonResponse($response);
    }

    public function Refort() {
        $sql = "
        SELECT 
            cte.KodeAreaCabang,
            cte.NamaAreaCabang,
            cte.VirtualAccount,
            cte.CreatedAt,
            cte.MD,
            cte.NamaSiswa,
            cte.NamaJenjang,
            cte.Cabang,
            isnull(sum(cte.JumlahTotal),0) as JumlahTotal,
            (select 
            isnull(sum(transaksibank.Nominal),0) as Uang_masuk
                from transaksibank 
                where transaksibank.Siswa = cte.RecID 
                and tahunajaran=3 
                and KodeCabang=cte.KodeAreaCabang 
                and len(NoReferensi) != 4 and len(NoReferensi) != 6
            )as Uang_masuk,
            (select 
                isnull(sum(jumlah),0) as diskon
                from pembayarandetail 
                join pembayaran on pembayaran.RecID=pembayarandetail.Pembayaran 
                join programsiswa on programsiswa.RecID=pembayaran.ProgramSiswa 
                where programsiswa.Siswa=cte.RecID and pembayaranmetode=8
            ) as diskon,
            isnull(sum(Koreksi),0) as Koreksi,
            cte.Keterangan,
            cte.Created
        from (
        select
        siswa.VirtualAccount,
        cast(siswa.CreatedAt as date) as CreatedAt,
        Siswa.RecId,
        Siswa.MD,
        siswa.NamaSiswa,
        siswa.cabang,
        areacabang.KodeAreaCabang,
        areacabang.NamaAreaCabang,
        jenjang.NamaJenjang,
        (pembayaran.JumlahTotal-pembayarandetail.Jumlah) as JumlahTotal,
        refund.Koreksi,
        refund.Keterangan,
        refund.Created
        From Siswa
        join programsiswa ON siswa.RecID = programsiswa.siswa
        join program ON program.RecID = programsiswa.program
        join tahunajaran ON tahunajaran.RecID = program.tahunajaran
        join pembayaran ON pembayaran.ProgramSiswa = programsiswa.RecID
        join pembayarandetail on pembayaran.RecID=pembayarandetail.Pembayaran
        join areacabang ON areacabang.RecID = siswa.cabang
        join jenjang on siswa.Jenjang=jenjang.KodeJenjang
        join (select 
            b.Siswa,
            CASE
                WHEN a.NoVaSalah is null OR a.NoVaSalah ='' THEN a.Selisih -- kelebihan transfer
                WHEN a.NovaSalah is not null OR a.NoVaSalah !='' THEN a.Nominal -- salah transfer
                ELSE 0 -- tidak ada refund
            END AS koreksi,
            CASE 
                WHEN a.NoVaSalah is null OR a.NoVaSalah ='' THEN 'refund kelebihan nominal'
                WHEN a.NoVaSalah is not null OR a.NoVaSalah !=0 THEN concat('refund kesalahan transfer ', a.NoVaBenar)
                ELSE NULL
            END AS Keterangan,
            a.Created
            from transaksibank b
            left join refund a on a.kodeTB=b.RecID
            WHERE a.TrackFinance = 'Approved' and a.TrackGM = 'Approved' 
                and b.tahunajaran=3
                and len(b.NoReferensi) != 4 and len(b.NoReferensi) != 6
        ) refund on siswa.RecID=refund.Siswa
        Where program.tahunajaran=2
            and siswa.cabang =1259
            and pembayarandetail.pembayaranuntuk='Pendaftaran'
            and siswa.RecID=91169
        group by 
            siswa.VirtualAccount,
            Siswa.CreatedAt,
            Siswa.MD,
            Jenjang.NamaJenjang,
            pembayaran.JumlahTotal,
            siswa.NamaSiswa,
            program.NamaProgram,
            siswa.cabang,
            siswa.RecID,
            tahunajaran.Description,
            pembayarandetail.Jumlah,
            areacabang.KodeAreaCabang,
            areacabang.NamaAreaCabang,
            refund.koreksi,
            refund.Keterangan,
            refund.Created) cte
        where cast(cte.Created as date) = '2017-10-25'
        group by
            cte.KodeAreaCabang,
            cte.NamaAreaCabang,
            cte.VirtualAccount,
            cte.CreatedAt,
            cte.MD,
            cte.NamaJenjang,
            cte.NamaSiswa,
            cte.Cabang,
            cte.RecID,
            cte.kodeareacabang,
            cte.koreksi,
            cte.Keterangan,
            cte.Created
        ";

        // query jika C end D end
        $sql = "
        SELECT * from transaksibank WHERE RecID not in (select kodeTB from refund where TrackFinance='Approved' and TrackGM='Approved') --Remove ID in Refund
        union all
        select 
        a.RecID,
        a.KodeCabang,
        a.Siswa,
        a.NamaBank,
        a.TanggalImport,
        a.TanggalTransaksi,
        a.WaktuTransaksi,
        a.NoReferensi,
        a.NoVA,
        CASE
            WHEN b.NoVaSalah is null OR b.NoVaSalah ='' THEN b.Selisih -- kelebihan transfer
            WHEN b.NovaSalah is not null OR b.NoVaSalah !='' THEN b.Nominal -- salah transfer
            ELSE 0 -- tidak ada refund
        END AS Nominal,
        a.RefRecID,
        a.Keterangan,
        a.CardNo,
        a.Auth_Cd,
        a.term_id,
        a.kdgrp,
        a.mercno,
        a.batch_ptlf,
        a.seq,
        a.tahunajaran,
        a.gros_amt
        from transaksibank a
        join refund b on a.RecID=b.kodeTB
        where b.TrackFinance='Approved' and b.TrackGM='Approved' -- gabungkan dengan table TB
        ";
    }

    function multipleAction() {
        
    }

    public function getTransaksiAction() {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        $KodeCabang = $_GET['KodeCabang'];
        $tahunajaran = $_GET['tahunajaran'];

        $sql = "
            SELECT
            a.RecID,
            a.TanggalTransaksi,
            a.Nominal,
            a.NoVA,
            b.NamaSiswa
            FROM transaksibank a
            inner join siswa b on a.Siswa=b.RecID
            where b.Cabang = '" . $KodeCabang . "' AND a.tahunajaran = '" . $tahunajaran . "' AND a.TanggalTransaksi LIKE '%" . $_GET['search'] . "%' OR
            b.Cabang = '" . $KodeCabang . "' AND a.tahunajaran = '" . $tahunajaran . "' AND a.Nominal LIKE '%" . $_GET['search'] . "%' OR
            b.Cabang = '" . $KodeCabang . "' AND a.tahunajaran = '" . $tahunajaran . "' AND a.NoVA LIKE '%" . $_GET['search'] . "%' OR
            b.Cabang = '" . $KodeCabang . "' AND a.tahunajaran = '" . $tahunajaran . "' AND b.NamaSiswa LIKE '%" . $_GET['search'] . "%'
            ORDER BY RecID DESC OFFSET 0 ROWS FETCH NEXT 5 ROWS ONLY
        ";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);
        if (count($result) > 0) {
            foreach ($result as $row) {
                $data['results'][] = array(
                    "id" => $row->RecID,
                    "text" => $this->tgl_indo($row->TanggalTransaksi) . ', ' . $this->format_number($row->Nominal) . ', ' . $row->NoVA . ', ' . $row->NamaSiswa
                );
            }
        } else {
            $data['results'][] = array(
                "id" => 0,
                "text" => 'Tidak ditemukan data'
            );
        }
        echo json_encode($data);
    }

    public function getTahunAjaranAction() {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        $sql = "SELECT * FROM tahunajaran ORDER BY RecID DESC OFFSET 0 ROWS FETCH NEXT 5 ROWS ONLY";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);
        foreach ($result as $row) {
            $data['results'][] = array(
                "id" => $row->RecID,
                "text" => $row->Description,
            );
        }
        echo json_encode($data);
    }

    public function getNoVaTransactionAction() {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        $sql = "SELECT
            DISTINCT
            a.RecID,
            a.NamaSiswa,
            CONCAT(LTRim(RTRIM(b.KodeAreaCabang)),a.VirtualAccount) as NoVa
            from siswa a
            inner join areacabang b on a.Cabang=b.RecID
            where LTRim(RTRIM(b.KodeAreaCabang))='" . $this->auth['kodeareacabang'] . "'
            AND CONCAT(LTRim(RTRIM(b.KodeAreaCabang)),a.VirtualAccount) LIKE '%" . $_GET['search'] . "%'
            ORDER BY a.NamaSiswa asc
            OFFSET 0 ROWS FETCH NEXT 5 ROWS ONLY";

        echo $sql;
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);
        foreach ($result as $row) {
            $data['results'][] = array(
                "id" => $row->RecID,
                "text" => $row->NamaSiswa,
            );
        }
        echo json_encode($data);
    }

    public function getBranchCodeAction() {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        $sql = "
        SELECT
        RecID,
        LTRIM(RTRIM(KodeAreaCabang)) as KodeAreaCabang,
        LTRIM(RTRIM(NamaAreaCabang)) as NamaAreaCabang
        FROM areacabang
        WHERE Area is not null and Aktif=1 AND KodeAreaCabang LIKE '%" . $_GET['search'] . "%' OR
        Area is not null and Aktif=1 AND NamaAreaCabang LIKE '%" . $_GET['search'] . "%'
        ORDER BY RecID DESC OFFSET 0 ROWS FETCH NEXT 5 ROWS ONLY";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);
        foreach ($result as $row) {
            $data['results'][] = array(
                "id" => $row->RecID,
                "text" => $row->KodeAreaCabang . ', ' . $row->NamaAreaCabang,
            );
        }
        echo json_encode($data);
    }

    public function simpanMultipleAction() {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $areacabang = $this->auth['areacabang'];
        $kodetransaksi = $this->request->getPost('kodetransaksi');

        $sql = "SELECT TOP 1 RIGHT(NoSuratPernyataan,7) AS KodeMax FROM refund WHERE CreateBy = '" . $areacabang . "' ORDER BY RecID DESC";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $numRows = $query->numRows();
        $result = $query->fetchAll($query);
        $kd = "";
        if ($numRows > 0) {
            foreach ($result as $row) {
                $tmp = ((int) $row->KodeMax) + 1;
                $kd = sprintf("%07s", $tmp);
                $KodeMax = 'RF' . date('ymd') . $kd;
            }
        } else {
            $KodeMax = 'RF' . date('ymd') . '0000001';
        }

        $sql2 = "INSERT into refund (NoSuratPernyataan,CreateBy,KodeTB) values ('" . $KodeMax . "','" . $areacabang . "','" . $kodetransaksi . "')";
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        echo json_encode(array('pesan' => 'data berhasil ditambah.'));
    }

    public function getTmpMultipleAction() {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $areacabang = $this->auth['areacabang'];
        $sql = "SELECT a.RecID,a.JenisRefund,b.NoVA,b.TanggalTransaksi,c.Description,b.Nominal,a.NoVaBenar,case when JenisRefund=1 OR JenisRefund=2 then a.Nominal else a.LebihNominal end as NominalRF FROM refund a join transaksibank b on a.KodeTB=b.RecID join tahunajaran c on b.tahunajaran=c.RecID WHERE Kronologi is null AND CreateBy = '" . $areacabang . "' ORDER BY a.RecID DESC";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $numRows = $query->numRows();
        if ($numRows > 0) {
            $result['rows'] = $query->fetchAll($query);
        } else {
            $result['rows'] = 0;
        }
        echo json_encode($result);
    }

    public function deleteTmpAction() {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $sql = "DELETE FROM refund WHERE RecID = '" . $this->request->getPost('id') . "'";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        echo json_encode(array('pesan' => 'data berhasil dihapus.'));
    }

    public function updateMultipleAction() {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        $RecID = $this->request->getPost('RecID');
        $NoVa1 = $this->request->getPost('NoVa1');
        $NoVa2 = $this->request->getPost('NoVa2');
        $Nominal1 = $this->request->getPost('Nominal1');
        $Nominal2 = $this->request->getPost('Nominal2');
        $NominalSelisi = $this->request->getPost('NominalSelisi');
        $JenisRF = $this->request->getPost('JenisRF');
        if ($JenisRF == 1 || $JenisRF == 2) {
            $sql = "UPDATE refund SET NoVaBenar = '" . $NoVa2 . "',NoVaSalah = '" . $NoVa1 . "', Nominal='" . $Nominal1 . "',JenisRefund='" . $JenisRF . "',LebihNominal=null,Selisih=null WHERE RecID = '" . $RecID . "'";
        } else {
            $sql = "UPDATE refund SET NoVaBenar = '" . $NoVa2 . "', Nominal='" . $Nominal1 . "',LebihNominal = '" . $Nominal2 . "',JenisRefund='" . $JenisRF . "',Selisih = '" . $NominalSelisi . "',NoVaSalah = null WHERE RecID = '" . $RecID . "'";
        }

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        echo json_encode(array('pesan' => 'data berhasil diubah.'));
    }

    public function saveMultipleAction() {
        $this->view->disable();
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        try {
            $sql = " SELECT * FROM refund WHERE RecID IN (" . $_POST['id'] . ")";
            $query = $this->getDI()->getShared('db')->query($sql);
            $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
            $result = $query->fetchAll($query);
            foreach ($result as $row) {
                $namapembuatpernyataan = $this->request->getPost('namapembuatpernyataan');
                $jabatanpembuatpernyataan = $this->request->getPost('jabatanpembuatpernyataan');
                $telpcabang = $this->request->getPost('telpcabang');
                $alamatcabang = $this->request->getPost('alamatcabang');
                $Kronologi = $this->request->getPost('Kronologi');
                $sql = "UPDATE refund SET NamaPembuatPernyataan = '" . $namapembuatpernyataan . "',JabatanPembuatPernyataan = '" . $jabatanpembuatpernyataan . "', TelpCabang='" . $telpcabang . "',AlamatCabang='" . $alamatcabang . "',Kronologi='" . $Kronologi . "' WHERE RecID = '" . $row->RecID . "'";
                $query = $this->getDI()->getShared('db')->query($sql);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
            }
            echo json_encode(array('pesan' => 'data berhasil diubah.'));
        } catch (Exception $e) {
            echo json_encode(array('pesan' => 'data gagal diubah.'));
        }
    }

}
