<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;

class PembayaranController extends ControllerBase {

    //TOC-RB Add
    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Pembayaran Bimbingan");
        parent::initialize();
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }

    //TOC-RB End Add

    /**
     * Index action
     */
    public function indexAction() {
        $this->persistent->parameters = null;
        //TOC-RB
        //$this->tag->setTitle("Prima Edu | Pembayaran Bimbingan");
        //pembayaran metode data
        //TOC-RB 21-05-2015
        //$this->view->setVar("pembayaranmetode", Pembayaranmetode::find());
        $this->view->setVar("pembayaranmetode", Pembayaranmetode::find("IsPendaftaran = 0 AND Aktif = 1"));
        $this->view->siswatx = $this->getTransaction();

        if ($this->request->isPost()) {
            $this->view->setVar("nosiswa", $this->request->getPost("Siswa"));
            $jumlah = substr($this->request->getPost("Jumlah", "int"), 0, -2);

            if (($jumlah != "" && $jumlah != null) && intval($jumlah) >= 0) {
                $pembayaran = Pembayaran::findFirstByRecID($this->request->getPost("Program"));

                $detail = null;

                if ($pembayaran != null) {

                    if ($pembayaran->SisaPembayaran - $jumlah >= 0) {
                        try {
                            //$this->db->begin();
                            $transactionManager = new TransactionManager();
                            $transaction = $transactionManager->get();

                            $tglJatuhTempo = $pembayaran->JatuhTempo;

                            $pembayaran->setTransaction($transaction);
                            $pembayaran->SisaPembayaran = $pembayaran->SisaPembayaran - $jumlah;
                            //$pembayaran->JatuhTempo=date('Y-m-d', strtotime("+1 months", strtotime($pembayaran->JatuhTempo)));
                            $pembayaran->JatuhTempo = date('Ymd', strtotime("+1 months", strtotime($tglJatuhTempo)));
                            $pembayaran->AngsuranKe = $pembayaran->AngsuranKe + 1;


                            if (!$pembayaran->save()) {
                                //$this->db->rollback();
                                $transaction->rollback();

                                foreach ($pembayaran->getMessages() as $message) {
                                    $this->flash->error($message);
                                }
                            } else {
                                $user = $this->session->get('auth');

                                $detail = new Pembayarandetail();
                                $detail->setTransaction($transaction);
                                $detail->Pembayaran = $pembayaran->RecID;
                                $detail->TanggalPembayaran = $this->request->getPost("TanggalPembayaran");
                                $detail->TanggalJatuhTempo = $tglJatuhTempo;
                                $detail->PembayaranMetode = $this->request->getPost("Metode");
                                $detail->PembayaranUntuk = "Bimbingan";
								$detail->NoAgreement = $this->request->getPost("NoReferensi");
								$detail->CardNo = $this->request->getPost("CardNo");
								$detail->AuthCd = $this->request->getPost("AuthCd");
                                //TOC-RB

                                $detail->Jumlah = $jumlah;
                                $detail->SisaPembayaran = $pembayaran->SisaPembayaran;
                                //$detail->Status = '0';
                                //TOC-RB 11 Aug 2015
                                $detail->Status = Pembayarandetail::STD_UNSETTLED;
                                $detail->CreatedBy = $user['userid'];

                                //TOC-RB Add
//                                $docNoPart = Pembayarandetail::count(['column' => 'RecID']);
//                                $detail->DocumentNo = "PB";
//                                $detail->DocumentNo .= trim($this->auth["kodeareacabang"]);
//                                $detail->DocumentNo .= date("Y");
//                                $detail->DocumentNo .= str_pad($docNoPart++, 6, "0", STR_PAD_LEFT);
                                //TOC-RB 22-06-2015
                                $detail->DocumentNo = $this->getDocumentNo($detail, 'PB', $this->auth['kodeareacabang']);
                                $metode = Pembayaranmetode::findFirstByMetodeId($detail->PembayaranMetode);
                                if ($metode != FALSE) {
                                    $param = explode(';', $metode->Parameter);
									//print_r($param);
									
                                    if ($param[0] = 'VA') {
                                        $sysparm = Sysparameter::findFirstByNamaBank($param[1]);
                                        $detail->NoReferensi = trim($this->auth['kodeareacabang']) . $this->request->getPost("Siswa", "int");
                                        //TOC-RB 8-8-2015
                                        $detail->NamaBank = $param[1];
                                    } elseif ($param[0] = 'REF') {
										
                                        $detail->NoReferensi = $this->request->getPost("NoReferensi");
                                    } elseif ($param[0] = 'KP') {
										 $detail->NamaBank =  Sysparameter::findFirstByNamaBank($param[1]);
                                        
                                    }  else {
                                        $detail->NoReferensi = '';
                                    }
									//exit;
                                }
                                //TOC-RB End Add

                                if (!$detail->save()) {
									
                                    //$this->db->rollback();
                                    $transaction->rollback();

                                    foreach ($detail->getMessages() as $message) {
                                        $this->flash->error($message);
                                    }
                                } else {
                                    $transaction->commit();
                                    //$this->db->commit();

                                    $this->flash->success("Sukses menginput pembayaran");
                                    unset($_POST);
                                }
                            }
                        } catch (Exception $e) {
                            $this->flash->error("Operasi gagal");

                            try {
                                foreach ($pembayaran->getMessages() as $message) {
                                    $this->flash->error($message);
                                }
                            } catch (Exception $exc) {
                                
                            }

                            try {
                                foreach ($detail->getMessages() as $message) {
                                    $this->flash->error($message);
                                }
                            } catch (Exception $exc) {
                                
                            }
                        }
                    } else {
                        $this->flash->error("Jumlah bayar melebihi sisa tagihan");
                    }
                } else {
                    $this->flash->error("Silahkan masukkan siswa yang melakukan pembayaran");
                }
            } else {
                $this->flash->error("Silakan masukkan jumlah nominal pembayaran");
            }
        }
    }

    public function listpembayaranAction() {
        $this->tag->setTitle("Prima Edu | List Pembayaran Siswa");

        $numberPage = $this->request->getQuery("page", "int");
        $numberPage = isset($numberPage) ? $numberPage : 1;

        $usePost = $this->request->getQuery("use", "int");
        $usePost = isset($usePost) ? $usePost : 0;
        $this->view->setVar("use", $usePost);

        if ($usePost == "0")
            $this->persistent->parameters = null;

        $pembayaran = array();

        if ($this->request->isPost()) {
            $this->persistent->parameters = $_POST;

            $pembayaran = array();

            if (isset($this->persistent->parameters['Program'])) {
                $pembayaran = $this->modelsManager->createBuilder()
                        ->columns(array('s.NamaSiswa', 'PembayaranDetail.RecID', 'p.RecID AS headerid', 'pr.NamaProgram',
                            'PembayaranDetail.TanggalPembayaran', 'm.NamaMetode', 'PembayaranDetail.PembayaranUntuk',
                            'PembayaranDetail.Jumlah', 'PembayaranDetail.SisaPembayaran', 'PembayaranDetail.Status'))
                        ->from('PembayaranDetail')
                        ->leftJoin('Pembayaran', 'PembayaranDetail.Pembayaran = p.RecID', 'p')
                        ->leftJoin('ProgramSiswa', 'p.ProgramSiswa = ps.RecID', 'ps')
                        ->leftJoin('Siswa', 'ps.Siswa = s.RecID', 's')
                        ->leftJoin('Program', 'ps.Program = pr.RecID', 'pr')
                        ->leftJoin('PembayaranMetode', 'PembayaranDetail.PembayaranMetode = m.MetodeID', 'm')
                        ->where('p.RecID = :headerid: AND s.Cabang = :cabang:')
                        ->orderBy(array('p.RecID'))
                        ->getQuery()
                        ->execute(array('headerid' => $this->persistent->parameters['Program'], 'cabang' => $this->auth['areacabang']));
            }


            //data program
            $programs = $this->modelsManager->createBuilder()
                    ->columns(array('s.NamaSiswa', 'p.RecID', 'Pembayaran.RecID AS headerid', 'p.NamaProgram'))
                    ->from('Pembayaran')
                    ->leftJoin('Programsiswa', 'Pembayaran.ProgramSiswa = ps.RecID', 'ps')
                    ->leftJoin('Siswa', 'ps.Siswa = s.RecID', 's')
                    ->leftJoin('Program', 'ps.Program = p.RecID', 'p')
                    ->where('s.VirtualAccount = :nosiswa:  AND s.Cabang = :cabang:')
                    ->orderBy(array('p.RecID'))
                    ->getQuery()
                    ->execute(array('nosiswa' => $this->persistent->parameters['Siswa'], 'cabang' => $this->auth['areacabang']));

            $this->view->setVar("programs", $programs);

            if (count($pembayaran) == 0) {
                $this->flash->notice("Tidak ada data pembayaran");
                $this->view->setVar("judul", "");
            } else {
                $this->view->setVar("pembayarans", $pembayaran);

                $arr = $pembayaran->toArray();
                $this->view->setVar("judul", "Data pembayaran siswa : " . $arr[0]['NamaSiswa'] . " untuk program " . $arr[0]['NamaProgram']);
            }
        }
    }

    public function deleteDiscAction($pembayaranId) {
        $this->view->disable();
        $this->response->setContentType('application/json');

        $pb = Pembayaran::findFirst($this->filter->sanitize($pembayaranId, "int"));
        if ($pb === FALSE) {
            $this->response->setJsonContent(['status' => 'Not Found']);
        } else {
            $pb->SisaPembayaran += $pb->Diskon;
            $pb->JumlahTotal += $pb->Diskon;
            $pb->Diskon = 0;
            try {
                $pb->save();
                $this->response->setJsonContent(['status' => 'OK', 'sisabayar' => $pb->SisaPembayaran, 'jumlahtotal' => $pb->JumlahTotal]);
            } catch (\Exception $e) {
                $this->response->setJsonContent(['status' => 'Error']);
            }
        }
        return $this->response;
    }

    /**
     * Get inquiry daftar program siswa yang belum lunas
      diakses dengan AJAX
     *
     * @param string $no siswa
     */
    public function inquiryAction($siswaID, $all = 0) {
        $whereSisa = ' AND Pembayaran.SisaPembayaran > 0';
        if ($all == "1")
            $whereSisa = '';

        $programs = $this->modelsManager->createBuilder()
                ->columns(array('s.NamaSiswa', 'p.RecID', 'Pembayaran.RecID AS headerid', 'p.NamaProgram', 'Pembayaran.JumlahTotal', 'Pembayaran.AngsuranKe', 'Pembayaran.JatuhTempo'
                    , 'Pembayaran.Diskon', 'Pembayaran.SisaPembayaran'))
                ->from('Pembayaran')
                ->leftJoin('Programsiswa', 'Pembayaran.ProgramSiswa = ps.RecID', 'ps')
                ->leftJoin('Siswa', 'ps.Siswa = s.RecID', 's')
                ->leftJoin('Program', 'ps.Program = p.RecID', 'p')
                ->where('s.VirtualAccount = :nosiswa: AND s.Cabang = :cabang:' . $whereSisa)
                ->orderBy(array('p.RecID'))
                ->getQuery()
                ->execute(array('nosiswa' => $siswaID, 'cabang' => $this->auth['areacabang']));


        $namaSiswa = "";
        $strProgram = "";

        //start revised 
        $programArr = array();
        $output = array(
            "NoSiswa" => $siswaID
        );
        //end revised

        $i = 0;

        foreach ($programs->toArray() as $program) {
            // TOC-RB
            $detail = Pembayarandetail::count("Pembayaran = {$program["headerid"]} AND PembayaranUntuk LIKE \"%Bimbingan%\"");
            $deleteDiscount = $detail <= 1 && $program['Diskon'] != 0 ? "true" : "false";

            $namaSiswa = $program['NamaSiswa'];

            if ($i > 0)
                $strProgram.=',';

            $strProgram.="{\"KodeProgram\":\"" . $program['RecID'] . "\" , 
					\"NamaProgram\":\"" . $program['NamaProgram'] . "\" , 
					\"RecIDHeader\":\"" . $program['headerid'] . "\" , 
					\"BiayaTotal\":\"" . $program['JumlahTotal'] . "\" , 
					\"Diskon\":\"" . $program['Diskon'] . "\" , 
                                        \"DeleteDiskon\":\"" . $deleteDiscount . "\" , 
                                        \"AngsuranKe\":\"" . $program['AngsuranKe'] . "\" ,
					\"JatuhTempo\":\"" . $program['JatuhTempo'] . "\",
					\"SisaPembayaran\":\"" . $program['SisaPembayaran'] . "\"}";


            $i++;

            // start revised
            $pro = array(
                    "KodeProgram" => $program['RecID'],
                    "NamaProgram" => $program['NamaProgram'],
                    "RecIDHeader" => $program['headerid'],
                    "BiayaTotal" => $program['JumlahTotal'],
                    "Diskon" => $program['Diskon'],
                    "DeleteDiskon" => $deleteDiscount,
                    "AngsuranKe" => $program['AngsuranKe'],
                    "JatuhTempo" => $program['JatuhTempo'],
                    "SisaPembayaran" => $program['SisaPembayaran']
                );
            $programArr[] = $pro;
            //end revised
        }

        $jsonResp = "{\"NoSiswa\":\"" . $siswaID . "\" , 
					\"NamaSiswa\":\"" . $namaSiswa . "\",
					\"Program\":[" . $strProgram . "]}";

        //echo $jsonResp;

        //start revised
        $output["NamaSiswa"] = $namaSiswa;
        $output['Program'] = $programArr;
        echo json_encode($output);
        //end revised

        $this->view->disable();
    }

    public function detailsAction($id) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $details = [];
        $pembayarandetail = Pembayarandetail::findByPembayaran($id);
        if (!count($pembayarandetail)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($pembayarandetail as $detail) {
                $details[] = [
                    'id' => $detail->RecID,
                    'tanggal' => $detail->TanggalPembayaran,
                    'metode' => $detail->getMetodePembayaran(),
                    'jumlah' => $detail->Jumlah
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'data' => $details
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

    public function receiptAction($param) {
        $detailPembayaran = Pembayarandetail::findFirstByRecID($this->filter->sanitize($param, "int"));
        $pembayaran = Pembayaran::findFirstByRecID($detailPembayaran->Pembayaran);
        $cabang = Areacabang::findFirst($this->session->auth['areacabang']);
        $programsiswa = Programsiswa::findFirst($pembayaran->ProgramSiswa);
        $siswa = Siswa::findFirstByRecID($programsiswa->Siswa);
        $tanggalBayar = new DateTime($detailPembayaran->TanggalPembayaran);
        $jatuhTempo = new DateTime($detailPembayaran->TanggalJatuhTempo);

        if ($siswa->Cabang != $cabang->RecID) {
            return $this->response->redirect('index');
        }
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // loop to create copy's
        $data = [];
        for ($i = 0; $i < 2; $i++) {
            $dataReport = [];
            $dataReport["documentno"] = $detailPembayaran->DocumentNo;
            $dataReport["cabang"] = $cabang->KodeAreaCabang . " - " . $cabang->NamaAreaCabang;
            $dataReport["nosiswa"] = $cabang->KodeAreaCabang . $siswa->VirtualAccount;
            //$dataReport["tanggal"] = $tanggalBayar->format("d F Y");
            $dataReport["tanggal"] = strftime('%d %B %Y', $tanggalBayar->getTimestamp());
            $dataReport["namasiswa"] = $siswa->NamaSiswa;
            $dataReport["jumlahuang"] = $detailPembayaran->Jumlah;
            $dataReport["bayaruntuk"] = $detailPembayaran->PembayaranUntuk;
            $dataReport["sisabayar"] = $detailPembayaran->SisaPembayaran;
            $dataReport["terbilang"] = $this->terbilang($detailPembayaran->Jumlah) . " Rupiah";
            //$dataReport["jatuhtempo"] = $jatuhTempo->format("d F Y");
            $dataReport["jatuhtempo"] = strftime('%d %B %Y', $jatuhTempo->getTimestamp());
            $dataReport["location"] = $cabang->KotaModel->NamaKotaKab;
            $dataReport["now"] = strftime('%d %B %Y');
            $dataReport["program"] = $programsiswa->getProgram();

            $data[$i] = $dataReport;
        }

        //get print counter
		$printCounter = ($detailPembayaran->PrintCounter == null) ? 0 : $detailPembayaran->PrintCounter;
        $this->view->PrintCounter = $printCounter + 1;
        //get pembayaran detail id
        $this->view->PembayaranDetailID = $detailPembayaran->RecID;

        $this->view->QRCodeNumber = $this->encrypt_decrypt('encrypt', base64_encode($param));
        //$this->view->datareport = $dataReport;
        $this->view->data = $data;
        //$this->view->disable();
        //echo $this->printReport($this->filter->sanitize($param, "int"));
//        $pdf = new pdf();
//        $pdf->pdf_output("Kwitansi", $this->printReport($param), 2);
    }
	
	public function updatePrintCounterAction() {
        $this->view->disable();
        $this->response->setContentType('application/json');
        $response = array();

        $pembayaranDetailID = $this->request->getPost("id");
        $detailPembayaran = Pembayarandetail::findFirst($pembayaranDetailID);
        if ($detailPembayaran) {
            //get print counter
			$printCounter = ($detailPembayaran->PrintCounter == null) ? 0 : $detailPembayaran->PrintCounter;
            //update print counter
            $detailPembayaran->PrintCounter = $printCounter + 1;
            if ($detailPembayaran->save()) {
                $response = array("status" => true, "message" => $printCounter + 1);
            }else{
                $response = array("status" => false, "message" => "Update failed.");
            }
        } else {
            $response = array("status" => false, "message" => "Not found.");
        }


        echo json_encode($response);
    }

    public function confirmAction() {
        $this->view->disable();
        $this->response->setContentType('application/json');
        $content = [];
		
		 //TOC-Auth Add
		$Pemby = $this->request->getPost("Metode");
		$metode = Pembayaranmetode::findFirstByMetodeId($Pemby);
		if ($metode != FALSE) {
			$param = explode(';', $metode->Parameter);
			if ($param[1] == "DebitBCA") {
				if (empty($this->request->getPost("CardNo")) || is_null($this->request->getPost("CardNo"))) {
					$content['status'] = "Error";
					$content['message'] = "Pelase Insert Number Card And Fill Appr. Code";
					return false;
				} else if (empty($this->request->getPost("AuthCd")) || is_null($this->request->getPost("AuthCd"))) {
					$content['status'] = "Error";
					$content['message'] = "Pelase Insert Number Card And Fill Appr. Code";
					return false;
				}
			} else if ($param[1] == "KreditBCA") {
				if (empty($this->request->getPost("CardNo")) || is_null($this->request->getPost("CardNo"))) {
					$content['status'] = "Error";
					$content['message'] = "Pelase Insert Number Card And Fill Appr. Code";
					return false;
				} else if (empty($this->request->getPost("AuthCd")) || is_null($this->request->getPost("AuthCd"))) {
					$content['status'] = "Error";
					$content['message'] = "Pelase Insert Number Card And Fill Appr. Code";
					return false;
				}
			}
		}
		//TOC-Auth End Add
			
        if (!$this->request->getPost('Siswa', 'int')) {
            $content['status'] = "Error";
            $content['message'] = "Silahkan masukkan siswa yang melakukan pembayaran";
        } else if (!$this->request->getPost('TanggalPembayaran')) {
            $content['status'] = "Error";
            $content['message'] = "Silakan masukkan tanggal pembayaran";
        } else if (!$this->request->getPost('Jumlah', 'int')) {
            $content['status'] = "Error";
            $content['message'] = "Silakan masukkan jumlah nominal pembayaran";
        } else {
            $content['status'] = "OK";
            $content['message'] = ucwords($this->terbilang(substr($this->request->getPost('Jumlah', 'int'), 0, -2))) . " Rupiah";
        }
        return $this->response->setJsonContent($content);
    }

    private function getTransaction($siswa = NULL) {
        $column = ['s.VirtualAccount', 's.VirtualAccount + " - " + s.NamaSiswa AS NamaSiswa'];
        $groupBy = ['s.VirtualAccount', 's.NamaSiswa'];
        $cabang = $this->auth['areacabang'];
        $query = $this->modelsManager->createBuilder()
                ->columns($column)->groupBy($groupBy)
                ->addFrom('Siswa', 's')
                ->join('Programsiswa', 'ps.Siswa = s.RecID', 'ps')
                ->where('s.Cabang = :c:', ['c' => $cabang])
                ->orderBy('s.VirtualAccount');
        if ($siswa) {
            $query = $query->andWhere('s.VirtualAccount = :s:', ['c' => $siswa]);
        }
        return $query->getQuery()->execute()->setHydrateMode(Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
    }

}
