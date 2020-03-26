<?php

class RegistrasiController extends ControllerBase {

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Pendaftaran");
        parent::initialize();

        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
            /*            if(!is_numeric($this->auth['areaparent'])) {
              $this->flash->error("Unauthorized Request");
              return $this->dispatcher->forward(array(
              "controller" => "index",
              "action" => "index"
              ));
              } */
        }
    } 

    public function indexAction() {
        
    }

    public function mulaiAction() {
        if ($this->request->isPost()) {
            $noIndukSiswa = $this->request->getPost("NoIndukSiswa");
            $siswa = Siswa::findFirstByVirtualAccount($noIndukSiswa);
            if ($siswa === FALSE) {
                $this->flash->notice("Siswa belum terdaftar");
                return $this->response->redirect("registrasi/index");
            }
            $this->tag->setDefaults($siswa->toArray());
//            $this->session->set("noIndukSiswa", $noIndukSiswa);
        }
        $this->persistent->parameters = null;
        $this->view->jenjang = Jenjang::find();
        $this->view->program = Program::find();
        $this->view->metode = Pembayaranmetode::find();
        $this->view->propinsi = Propinsi::find();
    }

    public function programAction($RecID) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $records = [];
        $program= Program::find(["Jenjang ='$RecID' AND TipeProgram <> 5 AND tahunajaran='3' and NamaProgram not like '%2016/2017%'"]);       
	if (!count($program)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($program as $record) {
                $records[] = [
                    'id' => $record->RecID,
                    'nama' => $record->NamaProgram,
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'listData' => $records
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

    public function program2Action($RecID) {
        $this->view->disable(); 
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $records = [];
        $program= Program::find(["tahunajaran='4' and Jenjang ='$RecID'"]);       
    if (!count($program)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($program as $record) {
                $records[] = [
                    'id' => $record->RecID,
                    'nama' => $record->NamaProgram,
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'listData' => $records
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }


    public function scheduleAction($RecID) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $records = [];
        $jadwal = Scheduleheader::find(array(
                    "Program = :program: AND Cabang = :cabang:",
                    "bind" => ["program" => $RecID, "cabang" => $this->auth['areacabang']]
        ));
        if (!count($jadwal)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($jadwal as $record) {
                $records[] = [
                    'id' => $record->RecId,
                    'kodejadwal' => $record->KodeJadwal,
                    'description' => $record->Description,
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'listData' => $records
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

    public function kartuAction() {
        $nokartu = $this->request->get("lookup", "int", NULL, TRUE);
        $this->view->disable();
        if ($nokartu == NULL) {
            return $this->response->setStatusCode(400, "Bad Request");
        }
        $this->response->setContentType('application/json');
        $siswa = Siswa::findFirstByNoKartuSiswa($nokartu);
        if ($siswa === FALSE) {
            $this->response->setJsonContent(array('status' => '0'));
        } else {
            $this->response->setJsonContent(array('status' => '1'));
        }
        return $this->response;
    }

    //TOC-RB ADD 11 Jun 2015
    public function metodeAction($d) {
        $this->view->disable();
        $date = strtotime($this->filter->sanitize($d, 'int'));
        $metode = Pembayaranmetode::find(["IsPendaftaran = 0 AND Aktif = 1", "order" => "NamaMetode"]);
        if (!count($metode)) {
            return $this->response->setStatusCode(400, "Bad Request");
        }
        echo "<option value=\"\">---</option>";
        foreach ($metode as $rec) {
            $parm = explode(";", $rec->Parameter);
            if ($parm[0] === "MAXDATE" && $date > strtotime($parm[1])) {
                continue;
            }
            echo "<option value=\"" . $rec->MetodeId . "\">" . $rec->NamaMetode . "</option>";
        }
    }

    //TOC-RB END ADD 11 Jun 2015

    public function hargaAction($programid) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $records = [];
        $program = Program::findFirst($programid);
        $programharga = $program->getProgramharga([
            "AreaCabang = :area: AND SektorCabang = :sektor: AND TanggalBerlaku <= :tanggal:",
            "bind" => ["area" => $this->auth["areaparent"], "sektor" => $this->auth["sektorcabang"], "tanggal" => date("Y-m-d")],
            "order" => "TanggalBerlaku DESC"
        ]);
        if (!count($programharga)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($programharga as $record) {
                $records[] = [
                    'hargabimbinganmin' => $record->HargaBimbingan,
                    'hargapendaftaran' => $record->HargaPendaftaran
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'listData' => $records
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
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

    public function prosesAction() {
        if (!$this->request->isPost()) {
            return $this->forward('registrasi/index');
        }

        if ($this->validate() === FALSE) {
            //return $this->forward('registrasi/siswabaru');
            return $this->response->redirect("registrasi/siswabaru");
        }

        $transactManager = new Phalcon\Mvc\Model\Transaction\Manager;
        $transact = $transactManager->get(TRUE);

        $noIndukSiswa = $this->request->getPost("RecID", "int");
        // MEMBER AREA
        if ($noIndukSiswa) {
            $siswa = Siswa::findFirstByRecID($noIndukSiswa);
            $siswa->setTransaction($transact);

            $siswa->NamaSiswa = $this->request->getPost("NamaSiswa");
            $siswa->TempatLahir = $this->request->getPost("TempatLahir");
            $siswa->TanggalLahir = $this->request->getPost("TanggalLahir") ? : NULL;
            $siswa->EmailSiswa = $this->request->getPost("EmailSiswa");
            $siswa->JenisKelamin = $this->request->getPost("JenisKelamin");
            $siswa->Jenjang = $this->request->getPost("Jenjang");
            $siswa->NamaAyah = $this->request->getPost("NamaAyah");
            $siswa->EmailAyah = $this->request->getPost("EmailAyah");
            $siswa->TeleponAyah = $this->request->getPost("TeleponAyah");
            $siswa->NamaIbu = $this->request->getPost("NamaIbu");
            $siswa->EmailIbu = $this->request->getPost("EmailIbu");
            $siswa->TeleponIbu = $this->request->getPost("TeleponIbu");
			$siswa->MD ='1';
            $siswa->Aktivasi ='0';
        } else {
            // NEW MEMBER
            $siswa = new Siswa();
            $siswa->setTransaction($transact);
            //$kodeCabang = Areacabang::findFirst($this->auth['areacabang']);
            $kodeVA = Virtualaccountlist::findFirst(array(
                        "KodeCabang = :cabang: AND (IsUsed = 0 OR IsUsed = NULL)",
                        "bind" => array("cabang" => $this->auth['kodeareacabang'])
            ));
            //UPDATE VA LIST
            if ($kodeVA !== FALSE) {
                $siswa->VirtualAccount = $kodeVA->KodeSiswa;
                $kodeVA->IsUsed++;
                $kodeVA->setTransaction($transact);
                if (!$kodeVA->save()) {
                    $transact->rollback("Proses update VA gagal");
                    foreach ($siswa->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                    return $this->forward("registrasi/index");
                }
            } else {
                $transact->rollback("Virtual Account habis");
                return $this->forward("registrasi/index");
            }
            // DATA FILL
            $siswa->NamaSiswa = $this->request->getPost("NamaSiswa");
            $siswa->TempatLahir = $this->request->getPost("TempatLahir");
            $siswa->TanggalLahir = $this->request->getPost("TanggalLahir") ? : NULL;
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
            $siswa->Cabang = $this->session->auth["areacabang"];
            $siswa->CreatedAt = date("Y-m-d H:i:s");
            $siswa->CreatedBy = $this->auth['userid'];
            $siswa->MD ='1';
            $siswa->Aktivasi ='0';
            $siswa->Nisn = $this->request->getPost("nisn");
        }

        if (!$siswa->save()) {
            $transact->rollback("Data siswa tidak bisa disimpan");
            foreach ($siswa->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                        "controller" => "registrasi",
                        "action" => "index"
            ));
        }

        //TOC-RB Cibubur
        $idSiswa = is_null($noIndukSiswa) ? $transact->getConnection()->lastInsertId() : $idSiswa = $siswa->RecID;

        // Save Program Siswa
        $programsiswa = new Programsiswa();
        $programsiswa->setTransaction($transact);
        $programsiswa->Siswa = $idSiswa;
        $programsiswa->Program = $this->request->getPost("Program");
        $programsiswa->ScheduleHeader = $this->request->getPost("Jadwal");
        $programsiswa->CreatedAt = date("Y-m-d H:i:s");
        $programsiswa->CreatedBy = $this->auth['userid'];

        if (!$programsiswa->save()) {
            var_dump($programsiswa);
            $transact->rollback("Pendaftaran program bimbingan tidak berhasil");
            foreach ($programsiswa->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("registrasi/index");
        }

        $idProgramSiswa = $transact->getConnection()->lastInsertId();

        // TOC-RB 16 April 2015
        $biayaPendaftaran = substr($this->request->getPost("BiayaPendaftaran", "int"), 0, -2);
        $biayaBimbingan = substr($this->request->getPost("BiayaBimbingan", "int"), 0, -2);
        //$diskon = substr($this->request->getPost("Diskon", "int"),0,-2);
        //$diskon = $diskon == NULL ? 0 : $diskon;
        // TOC-RB : No more discount
        $diskon = 0;

        $jumlahBayar = substr($this->request->getPost("JumlahBayar", "int"), 0, -2);
        // Create Pembayaran
        $pembayaran = new Pembayaran();
        $pembayaran->setTransaction($transact);

        $pembayaran->ProgramSiswa = $idProgramSiswa;
        $pembayaran->PembayaranTipe = $this->request->getPost("TipePembayaran");
        $pembayaran->JatuhTempo = $this->request->getPost("TanggalJatuhTempo") ? : NULL;
        $pembayaran->JumlahTotal = $biayaBimbingan - $diskon + $biayaPendaftaran;
        $pembayaran->SisaPembayaran = $jumlahBayar > 0 ? $biayaBimbingan - $diskon - $jumlahBayar : $biayaBimbingan - $diskon;
        $pembayaran->AngsuranKe = $jumlahBayar > 0 ? 1 : 0;
        $pembayaran->Diskon = $diskon;
        $pembayaran->CreatedAt = date('Y-m-d H:i:s');
        $pembayaran->CreatedBy = $this->auth['userid'];

        if (!$pembayaran->save()) {
            $transact->rollback("Transaksi pembayaran gagal");
            foreach ($pembayaran->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("registrasi/index");
        }

        // Create Pembayaran Detail
        $idPembayaran = $transact->getConnection()->lastInsertId();

        $pembayarandetail = new Pembayarandetail();
        $pembayarandetail->setTransaction($transact);

        $docNoPart = Pembayarandetail::count(['column' => 'RecID']);

        $pembayarandetail->Pembayaran = $idPembayaran;
        $pembayarandetail->PembayaranUntuk = "Pendaftaran";
        $pembayarandetail->Jumlah = $biayaPendaftaran;
        $pembayarandetail->PembayaranMetode = $this->request->getPost("MetodePembayaran");
        $pembayarandetail->SisaPembayaran = $pembayaran->JumlahTotal - $biayaPendaftaran;
        $pembayarandetail->NoAgreement = $this->request->getPost("NoReferensi");
        $pembayarandetail->CardNo = $this->request->getPost("CardNo");
        $pembayarandetail->AuthCd = $this->request->getPost("AuthCd");
        //$pembayarandetail->TanggalPembayaran = date('Y-m-d');
        $pembayarandetail->TanggalPembayaran = $this->request->getPost("TanggalBayar", "int");
        $pembayarandetail->CreatedBy = $this->auth['userid'];
        $pembayarandetail->DocumentNo = "PB";
        $pembayarandetail->DocumentNo .= trim($this->auth["kodeareacabang"]);
        $pembayarandetail->DocumentNo .= date("Y");
        $pembayarandetail->DocumentNo .= str_pad($docNoPart++, 6, "0", STR_PAD_LEFT);

        if (!$pembayarandetail->save()) {
            $transact->rollback("Transaksi pembayaran gagal," . $idPembayaran . "-" . print_r($pembayarandetail->getMessages()));
            foreach ($pembayarandetail->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("registrasi/index");
        }

        //$jumlahBayar = substr($this->request->getPost("JumlahBayar", "int"),0,-2);
        // Create Pembayaran Detail Bimbingan

        if ($jumlahBayar > 0) {
            $pembayarandetail2 = new Pembayarandetail();
            $pembayarandetail2->setTransaction($transact);
            $pembayarandetail2->Pembayaran = $idPembayaran;
            $pembayarandetail2->PembayaranUntuk = "Bimbingan";
            $pembayarandetail2->Jumlah = $jumlahBayar;
            $pembayarandetail2->PembayaranMetode = $this->request->getPost("MetodePembayaran2", "int");
            $pembayarandetail2->SisaPembayaran = $pembayarandetail->SisaPembayaran - $jumlahBayar;
            $pembayarandetail2->TanggalJatuhTempo = $pembayaran->JatuhTempo;
            //TOC-RB
            $pembayarandetail2->NoAgreement = $this->request->getPost("NoReferensi");
			$pembayarandetail2->CardNo = $this->request->getPost("CardNo");
			$pembayarandetail2->AuthCd = $this->request->getPost("AuthCd");
            $pembayarandetail2->DocumentNo = "PB";
            $pembayarandetail2->DocumentNo .= trim($this->auth["kodeareacabang"]);
            $pembayarandetail2->DocumentNo .= date("Y");
            $pembayarandetail2->DocumentNo .= str_pad($docNoPart++, 6, "0", STR_PAD_LEFT);
            //$pembayarandetail2->TanggalPembayaran = date('Y-m-d');
            $pembayarandetail2->TanggalPembayaran = $this->request->getPost("TanggalBayar", "int");
            $pembayarandetail2->CreatedBy = $this->auth['userid'];
            //TOC-RB 6 Mei 2015
            //$pembayarandetail2->Status = 0;
            //TOC-RB 11 Aug 2015
            $pembayarandetail2->Status = Pembayarandetail::STD_UNSETTLED;

            //TOC-Auth Add
            $metode = Pembayaranmetode::findFirstByMetodeId($pembayarandetail2->PembayaranMetode);
            if ($metode != FALSE) {
                $param = explode(';', $metode->Parameter);
                if ($param[0] == 'VA') {
                    $sysparm = Sysparameter::findFirstByNamaBank($param[1]);
                    $cabang = Areacabang::findFirst($this->auth['areacabang']);
                    $pembayarandetail2->NoReferensi = trim($cabang->KodeAreaCabang) . $siswa->VirtualAccount;
                    //TOC-RB 8-8-2015
                    $pembayarandetail2->NamaBank = $param[1];
                } elseif ($param[0] == 'REF') {
                    $pembayarandetail2->NamaBank = $param[1];
                    $pembayarandetail2->NoReferensi = $this->request->getPost("NoReferensi");
					$pembayarandetail2->CardNo = $this->request->getPost("CardNo");
					$pembayarandetail2->AuthCd = $this->request->getPost("AuthCd");
                } elseif ($param[0] = 'KP') {
					$pembayarandetail2->NamaBank =  Sysparameter::findFirstByNamaBank($param[1]);
					$pembayarandetail2->NoAgreement = $this->request->getPost("NoReferensi");
				}else {
                    $pembayarandetail2->NoReferensi = '';
                }
            }
            //TOC-Auth End Add

            if (!$pembayarandetail2->save()) {
                $transact->rollback("Transaksi pembayaran bimbingan gagal," . $idPembayaran . "-" . print_r($pembayarandetail2->getMessages()));
                foreach ($pembayarandetail2->getMessages() as $message) {
                    $this->flash->error($message);
                }
                return $this->forward("registrasi/index");
            }
        }

        $transact->commit();
        $this->flash->success("Registrasi Berhasil");

        return $this->dispatcher->forward(array(
                    "controller" => "siswa",
                    "action" => "search"
        ));
    }

    public function siswabaruAction($kode) {
        //TODO
        if ($this->request->isPost()) {
            $noIndukSiswa = $this->request->getPost("NoIndukSiswa", "int");
            $siswa = Siswa::findFirst([
                        "VirtualAccount = :va: AND Cabang = :cabang:",
                        "bind" => ["va" => $noIndukSiswa, "cabang" => $this->auth['areacabang']]
            ]);
            if ($siswa === FALSE) {
                $this->flash->notice("Siswa belum terdaftar");
                return $this->response->redirect("registrasi/index");
            }
            $this->tag->setDefaults($siswa->toArray());
            $this->view->memberarea = TRUE;
        }
        $this->persistent->parameters = null;
        $this->view->jenjang = Jenjang::find();
        $this->view->program = Program::find();
        $this->view->kode = $kode;
        $this->view->metode = Pembayaranmetode::find("IsPendaftaran = 1 AND Aktif = 1");
        //$this->view->metode2 = Pembayaranmetode::find("IsPendaftaran = 0 AND Aktif = 1");
        $this->view->propinsi = Propinsi::find();
    }

    private function validate() {
		$Pemby = $this->request->getPost("MetodePembayaran2");
		$metode = Pembayaranmetode::findFirstByMetodeId($Pemby);
		if ($metode != FALSE) {
			$param = explode(';', $metode->Parameter);
			
			if ($param[1] == "DebitBCA") {
				print_r($this->request->getPost("CardNo"));
				if (empty($this->request->getPost("CardNo")) || is_null($this->request->getPost("CardNo"))) {
					$this->flash->error('Pelase Insert Number Card And Fill Appr. Code');
					return FALSE;
				} else if (empty($this->request->getPost("AuthCd")) || is_null($this->request->getPost("AuthCd"))) {
					$this->flash->error('Pelase Insert Number Card And Fill Appr. Code');
					return FALSE;
				}
			} else if ($param[1] == "KreditBCA") {
				if (empty($this->request->getPost("CardNo")) || is_null($this->request->getPost("CardNo"))) {
					$this->flash->error('Pelase Insert Number Card And Fill Appr. Code');
					return FALSE;
				} else if (empty($this->request->getPost("AuthCd")) || is_null($this->request->getPost("AuthCd"))) {
					$this->flash->error('Pelase Insert Number Card And Fill Appr. Code');
					return FALSE;
				}
			}
		}
		
        if (is_null($this->request->getPost('Program', 'int'))) {
            $this->flash->error('Jenjang / Program harus diisi');
            return FALSE;
        }
        if (is_null($this->request->getPost('Jadwal', 'int'))) {
            $this->flash->error('Jadwal harus diisi');
            return FALSE;
        }
        if (is_null($this->request->getPost('BiayaBimbingan', 'int'))) {
            $this->flash->error('Biaya Bimbingan harus diisi');
            return FALSE;
        } else {
            $programharga = Programharga::findFirst([
                        "AreaCabang = :area: AND Program = :prog: AND TanggalBerlaku <= :date: AND HargaBimbingan <= :harga:",
                        "bind" => [
                            "area" => $this->auth['areaparent'],
                            "prog" => $this->request->getPost('Program', 'int'),
                            "date" => date("Y-m-d"),
                            "harga" => substr($this->request->getPost('BiayaBimbingan', 'int'), 0, -2)
                        ]
            ]);
            if ($programharga === FALSE) {
                $this->flash->error('Not this time bro..');
                return FALSE;
            }
        }
        return TRUE;
    }

}
