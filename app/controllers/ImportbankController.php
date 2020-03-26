<?php 

class ImportbankController extends ControllerBase
{
	
	protected $sql_1 = <<<SQL
UPDATE tx SET tx.RefRecID = settle.pd_id
FROM transaksibank tx JOIN (
    SELECT min(tx.RecID) AS tx_id, min(pd.RecID) AS pd_id
    FROM transaksibank tx 
	JOIN pembayarandetail pd ON tx.NoReferensi = pd.NoAgreement
         AND tx.NamaBank = pd.NamaBank
    WHERE tx.RefRecID IS NULL AND pd.Status = '1'
    GROUP BY tx.Nominal, tx.NoReferensi
) settle ON tx.RecID = settle.tx_id
SQL;

    protected $sql_2 = <<<SQL
UPDATE pd SET pd.Status = '1'
FROM transaksibank tx
JOIN pembayarandetail pd ON tx.RefRecID = pd.RecID
WHERE pd.Status = '0'
SQL;

protected $sql_CardBca = <<<SQL
	UPDATE tx SET tx.RefRecID = settle.pd_id
	FROM transaksibank tx JOIN (
		SELECT (tx.RecID) AS tx_id, (pd.RecID) AS pd_id FROM transaksibank tx
		JOIN pembayarandetail pd ON tx.CardNo = pd.CardNo OR tx.Auth_Cd = pd.AuthCd 
		WHERE tx.RefRecID IS NULL AND pd.Status = '1'
	) settle ON tx.RecID = settle.tx_id
SQL;
protected $sql_CardBri = <<<SQL
	UPDATE tx SET tx.RefRecID = settle.pd_id
	FROM transaksibank tx JOIN (
		SELECT (tx.RecID) AS tx_id, (pd.RecID) AS pd_id FROM transaksibank tx
		JOIN pembayarandetail pd ON tx.CardNo = pd.CardNo OR tx.Auth_Cd = pd.AuthCd 
		WHERE tx.RefRecID IS NULL AND pd.Status = '1'
	) settle ON tx.RecID = settle.tx_id
SQL;

    public function initialize() {
        $this->tag->setTitle("Import File Bank");
        parent::initialize();
    }

    public function indexAction()
    {
        // Method Get, only return view
        if($this->request->isPost()){
            if($this->request->hasFiles() == FALSE || $this->request->getPost("Tanggal") == NULL){
                $this->flash->error("Masukkan Tanggal dan File Bank");
                return;
            }
            $bank = $this->request->getPost("Bank");
            $tanggal = $this->request->getPost("Tanggal");
            foreach($this->request->getUploadedFiles() as $upload){
                $file = $upload;
            }

            $data = $this->readFile($file->getTempName());

            switch ($bank){
                case "BCA":
                    $result = $this->parseBCA($data, $tanggal);
                    break;
				case "CardBCA":
                    $result = $this->parseCardBCA($data, $tanggal);
                    break;
		               case "CardBRI":
                    $result = $this->parseCardBRI($data, $tanggal);
                    break;
				case "KreditPlus":
                    $result = $this->parseKredit($data, $tanggal);
                    break;
                case "Mandiri":
                    break;
                default :
                    $this->flash->warning("Bank ".$bank." Masih Belum Support");
                    return;
            }
            $this->flash->success(
                    "Kode Perusahaan : ".$result["kode"].
                    ", Jumlah Transaksi : ".$result["countTX"]."<br/>".
                    "Berhasil : ".$result["countOK"].
                    ", Gagal : ".$result["countNotOK"].
                    ", Duplikat : ".$result["countDupe"]
//                    ."<br/>"."DupeRecs : ".  join(", ", $result["dupeRec"])
            );
        }
    }

	//BRI
	
		private function parseCardBRI($data, $tanggal) {
		if (!$this->request->isPost()) {
            return;
        }
        $fileUpload = $this->request->getUploadedFiles()[0];
		
		$sysparm = Sysparameter::findFirst(["NamaBank = 'CardBRI'"]);
		
		if ($fileUpload->getExtension() == 'xls' || $fileUpload->getExtension() == 'xlsx') {
			
            $data = $this->excel->readCardBRI($fileUpload);
			$isValid = FALSE;
			$isValidSub = FALSE;
			$isEndProcess = FALSE;

			$trans = array();
			$trans["countTX"] = 0;
			$trans["countOK"] = 0;
			$trans["countNotOK"] = 0;
			$trans["countDupe"] = 0;
			$trans["dupeRec"] = [];
			foreach ($data as $key => $rec) {
			/*	if (($rec['trans_time'] == '' or $rec['trans_time'] == 0)) {
                    $errors[] = $key+2;
                } 
			*/	if (($rec["cardno"] == '' or $rec['cardno'] == 0 )){ //Unsettle 05122016	
				}
				else {
					try {
						$trans["countTX"]++;
						$txBank = new Transaksibank();
						
						
						$txBank->tahunajaran = '3';
						$txBank->NamaBank = 'CardBRI';
					//	$txBank->mercno = $rec["mercno"];
						$txBank->term_id = $rec["term_id"];
					//	$txBank->batch_ptlf = $rec["batch_ptlf"];
						$txBank->CardNo = $rec["cardno"];
						$txBank->seq = $rec["seq"];
						$txBank->Auth_cd = isset($rec["auth_cd"])? $rec["auth_cd"] : NULL;
						$txBank->Nominal = $rec["nett_amt"];
						$txBank->gros_amt = $rec["gros_amt"];
                     //                           $txBank->Status = $rec["status"];
						$txBank->TanggalImport = $tanggal;
						$txBank->TanggalTransaksi = date("Y-m-d", strtotime($rec["trans_date"]));
					//	$jam = substr($rec["trans_time"],0,6);
					//	$txBank->WaktuTransaksi = date("H:i:s", strtotime($jam));
						
						$pos1 = substr($rec["cardno"],0,6);
						$pos2 = substr($rec["cardno"],-3,3);
						
						$pdBuilder = $this->modelsManager->createBuilder()
						->columns(array('Pembayarandetail.RecID', 
							'Pembayarandetail.NamaBank',
							'Pembayarandetail.CardNo',
							'Pembayarandetail.AuthCd',
							'Pembayarandetail.NoReferensi',
							'Pembayarandetail.TanggalPembayaran',
							'Pembayarandetail.Jumlah',
							'd.RecID as RecSiswa',
							'e.KodeAreaCabang',
							'RTRIM(e.KodeAreaCabang)+d.VirtualAccount as NoVA'))
						->from('Pembayarandetail')
						->join('pembayaran', 'Pembayarandetail.Pembayaran = b.RecID', 'b')
						->join('programsiswa', 'b.ProgramSiswa = c.RecID', 'c')
						->join('siswa', 'c.Siswa = d.RecID', 'd')
						->join('areacabang', 'd.Cabang = e.RecID', 'e')
						->where('Pembayarandetail.AuthCd = :1:')
						->andWhere('Pembayarandetail.PembayaranUntuk <> \'Pendaftaran\'')
						->getQuery()
						->execute(array('1' => $txBank->Auth_cd));
						
						
						
						foreach ($pdBuilder->toArray() as $pd) {
							if ((substr($pd['CardNo'],0,6) == $pos1 AND substr($pd['CardNo'],-3,3) == $pos2) and $pd['TanggalPembayaran'] == $txBank->TanggalTransaksi and $pd['Jumlah'] == $txBank->Nominal) {
								$txBank->NamaBank = isset($pd['NamaBank'])? $pd['NamaBank'] : NULL;
								$txBank->NoReferensi = isset($pd['NoReferensi'])? $pd['NoReferensi'] : NULL;
								$ref = isset($pd['RecID'])? $pd['RecID'] : NULL;
								$txBank->RefRecID = isset($pd['RecID'])? $pd['RecID'] : NULL;
								$txBank->NoVA = isset($pd['NoVA'])? $pd['NoVA'] : NULL;
								$txBank->Siswa = isset($pd['RecSiswa'])? $pd['RecSiswa'] : NULL;
								$txBank->KodeCabang = isset($pd['KodeAreaCabang'])? $pd['KodeAreaCabang'] : NULL;
							}
						}
						
						if (substr($txBank->term_id,0,2) == "CD"){
							$ket = "Payment by Credit Card of Bank ";
						} else if (substr($txBank->term_id,0,2) == "DD"){
							$ket = "Payment by Debit Card of Bank ";
						} else {
							$ket = "";
						}
						
						$txBank->Keterangan = $ket.$txBank->NamaBank;
						
						if ($txBank->RefRecID != NULL){
							$upd = Pembayarandetail::findFirst("RecID='".$txBank->RefRecID."'");
							$upd->Status = "1";
							$upd->update();
						} 
						if(!$txBank->save()){
							
							$trans["countNotOK"]++;	
						} else {$trans["countOK"]++;}
					} catch (Exception $ex) {
                        $trans["countDupe"]++;
                        $trans["dupeRec"][] = $rec['auth_cd'].$rec['cardno'];
                        $this->flash->error($ex->getMessage());
                    }
				}
				
				
			}
			
			
			$this->db->begin();
			$this->db->execute($this->sql_CardBri);	
			$this->db->commit();
			
			$trans["kode"] = $sysparm->Prefix;
			return $trans;
		}
	}
	
	//END BRI

	private function parseCardBCA($data, $tanggal) {
		if (!$this->request->isPost()) {
            return;
        }
        $fileUpload = $this->request->getUploadedFiles()[0];
		
		$sysparm = Sysparameter::findFirst(["NamaBank = 'BCA'"]);
		
		if ($fileUpload->getExtension() == 'xls' || $fileUpload->getExtension() == 'xlsx') {
			
            $data = $this->excel->readCardBCA($fileUpload);
			$isValid = FALSE;
			$isValidSub = FALSE;
			$isEndProcess = FALSE;

			$trans = array();
			$trans["countTX"] = 0;
			$trans["countOK"] = 0;
			$trans["countNotOK"] = 0;
			$trans["countDupe"] = 0;
			$trans["dupeRec"] = [];
			foreach ($data as $key => $rec) {
				if (($rec['trans_time'] == '' or $rec['trans_time'] == 0)) {
                    $errors[] = $key+2;
                } 
				if (($rec["cardno"] == '' or $rec['cardno'] == 0 or $rec['status'] == 'UNSETL')){ //Unsettle 05122016	
				}
				else {
					try {
						$trans["countTX"]++;
						$txBank = new Transaksibank();
						
						
						$txBank->tahunajaran = '3';
						$txBank->NamaBank = 'CardBCA';
					//	$txBank->mercno = $rec["mercno"];
						$txBank->term_id = $rec["term_id"];
						$txBank->batch_ptlf = $rec["batch_ptlf"];
						$txBank->CardNo = $rec["cardno"];
						$txBank->seq = $rec["seq"];
						$txBank->Auth_cd = isset($rec["auth_cd"])? $rec["auth_cd"] : NULL;
						$txBank->Nominal = $rec["nett_amt"];
						$txBank->gros_amt = $rec["gros_amt"];
                                                $txBank->Status = $rec["status"];
						$txBank->TanggalImport = $tanggal;
						$txBank->TanggalTransaksi = date("Y-m-d", strtotime($rec["trans_date"]));
						$jam = substr($rec["trans_time"],0,6);
						$txBank->WaktuTransaksi = date("H:i:s", strtotime($jam));
						
						$pos1 = substr($rec["cardno"],0,6);
						$pos2 = substr($rec["cardno"],-3,3);
						
						$pdBuilder = $this->modelsManager->createBuilder()
						->columns(array('Pembayarandetail.RecID', 
							'Pembayarandetail.NamaBank',
							'Pembayarandetail.CardNo',
							'Pembayarandetail.AuthCd',
							'Pembayarandetail.NoReferensi',
							'Pembayarandetail.TanggalPembayaran',
							'Pembayarandetail.Jumlah',
							'd.RecID as RecSiswa',
							'e.KodeAreaCabang',
							'RTRIM(e.KodeAreaCabang)+d.VirtualAccount as NoVA'))
						->from('Pembayarandetail')
						->join('pembayaran', 'Pembayarandetail.Pembayaran = b.RecID', 'b')
						->join('programsiswa', 'b.ProgramSiswa = c.RecID', 'c')
						->join('siswa', 'c.Siswa = d.RecID', 'd')
						->join('areacabang', 'd.Cabang = e.RecID', 'e')
						->where('Pembayarandetail.AuthCd = :1:')
						->andWhere('Pembayarandetail.PembayaranUntuk <> \'Pendaftaran\'')
						->getQuery()
						->execute(array('1' => $txBank->Auth_cd));
						
						
						
						foreach ($pdBuilder->toArray() as $pd) {
							if ((substr($pd['CardNo'],0,6) == $pos1 AND substr($pd['CardNo'],-3,3) == $pos2) and $pd['TanggalPembayaran'] == $txBank->TanggalTransaksi and $pd['Jumlah'] == $txBank->Nominal) {
								$txBank->NamaBank = isset($pd['NamaBank'])? $pd['NamaBank'] : NULL;
								$txBank->NoReferensi = isset($pd['NoReferensi'])? $pd['NoReferensi'] : NULL;
								$ref = isset($pd['RecID'])? $pd['RecID'] : NULL;
								$txBank->RefRecID = isset($pd['RecID'])? $pd['RecID'] : NULL;
								$txBank->NoVA = isset($pd['NoVA'])? $pd['NoVA'] : NULL;
								$txBank->Siswa = isset($pd['RecSiswa'])? $pd['RecSiswa'] : NULL;
								$txBank->KodeCabang = isset($pd['KodeAreaCabang'])? $pd['KodeAreaCabang'] : NULL;
							}
						}
						
						if (substr($txBank->term_id,0,2) == "CD"){
							$ket = "Payment by Credit Card of Bank ";
						} else if (substr($txBank->term_id,0,2) == "DD"){
							$ket = "Payment by Debit Card of Bank ";
						} else {
							$ket = "";
						}
						
						$txBank->Keterangan = $ket.$txBank->NamaBank;
						
						if ($txBank->RefRecID != NULL){
							$upd = Pembayarandetail::findFirst("RecID='".$txBank->RefRecID."'");
							$upd->Status = "1";
							$upd->update();
						} 
						if(!$txBank->save()){
							
							$trans["countNotOK"]++;	
						} else {$trans["countOK"]++;}
					} catch (Exception $ex) {
                        $trans["countDupe"]++;
                        $trans["dupeRec"][] = $rec['auth_cd'].$rec['cardno'];
                        $this->flash->error($ex->getMessage());
                    }
				}
				
				
			}
			
			
			$this->db->begin();
			$this->db->execute($this->sql_CardBca);	
			$this->db->commit();
			
			$trans["kode"] = $sysparm->Prefix;
			return $trans;
		}
	}
	
    private function parseBCA($data, $tanggal) {

        $isValid = FALSE;
        $isValidSub = FALSE;
        $isEndProcess = FALSE;

        $trans = array();
        $trans["countTX"] = 0;
        $trans["countOK"] = 0;
        $trans["countNotOK"] = 0;
        $trans["countDupe"] = 0;
        // TOC-RB 9 Juni 2015
        $trans["dupeRec"] = [];

        $sysparm = Sysparameter::findFirst(["NamaBank = 'BCA'"]);

        foreach ($data as $dataLine) {
            if ($isEndProcess){
                break;
            }
            if (!$isValid){
                //Read and Validate Company
                if (substr($dataLine, 1, 15) == "NAMA PERUSAHAAN") {
                    $isValid = $sysparm->Prefix == $this->readBCACompany($dataLine)["Code"] ? TRUE : FALSE;
                }
            } else {
                //Valid Company! Go Ahead..
                //Read and Validate Sub Company
                if (!$isValidSub && substr($dataLine, 1, 8) == "SUB-COMP") {
                    $isValidSub = $this->readBCASubCompany($dataLine) == "00003" ? TRUE : FALSE;
                } elseif ($isValidSub && substr($dataLine, 1, 8) == "SUB-COMP") {
                    $isEndProcess = $this->readBCASubCompany($dataLine) != "00003" ? TRUE : FALSE;
                } else {
                    try {
                        //Go Read Details
                        if (trim(substr($dataLine, 46, 3)) == "IDR") {
                            $detail = $this->readBCADetails($dataLine);
                            $trans["countTX"]++;

                            $txBank = new Transaksibank();
							//test tahunajaran
							$txBank->tahunajaran = '3';
                            $txBank->NoVA = $detail["NumTxn"];
                            $txBank->NoReferensi = $txBank->NoVA;
                            $txBank->NamaBank = $sysparm->NamaBank;
                            $txBank->TanggalImport = $tanggal;
                            $txBank->TanggalTransaksi = date("Y-m-d", strtotime($detail["DateTxn"]));
                            //TOC RB 9 Juni 2015
                            $txBank->WaktuTransaksi = $detail["TimeTxn"];
                            $txBank->Nominal = substr($this->filter->sanitize($detail["Amount"], "int"), 0, -2);
                            $txBank->KodeCabang = substr($txBank->NoVA, 0, 4);

                            $cabang = Areacabang::findFirstByKodeAreaCabang($txBank->KodeCabang);
                            $siswa = Siswa::findFirst([
                                "Cabang = :cabang: AND VirtualAccount = :va:",
                                "bind" => ["cabang" => $cabang->RecID, "va" => substr($txBank->NoVA, 4, 7)]
                            ]);

                            if ($siswa) {
                                $txBank->Siswa = isset($siswa->RecID)? $siswa->RecID : NULL;
                            }

                            if(!$txBank->save()){$trans["countNotOK"]++;}
                            else{$trans["countOK"]++;}
                        }
                    } catch (Exception $ex) {
                        $trans["countDupe"]++;
                        $trans["dupeRec"][] = $this->readBCADetails($dataLine)["NumSeq"];
                        $this->flash->error($ex->getMessage());
                    }
                }
            }
        }

        $trans["kode"] = $sysparm->Prefix;
        return $trans;
    }
	
	private function parseKredit($data, $tanggal) {

        $isValid = FALSE;
        $isValidSub = FALSE;
        $isEndProcess = FALSE;

        $trans = array();
        $trans["countTX"] = 0;
        $trans["countOK"] = 0;
        $trans["countNotOK"] = 0;
        $trans["countDupe"] = 0;
        // TOC-RB 9 Juni 2015
        $trans["dupeRec"] = [];

        $sysparm = Sysparameter::findFirst(["NamaBank = 'KreditPlus'"]);

        foreach ($data as $dataLine) {
            if ($isEndProcess){
                break;
            }if (!$isValid){
                //Read and Validate Company
                if (substr($dataLine, 1, 15) == "NAMA PERUSAHAAN") {
                    $isValid = $sysparm->Prefix == $this->readBCACompany($dataLine)["Code"] ? TRUE : FALSE;
                }
            } 
            else {
                //Valid Company! Go Ahead..
                //Read and Validate Sub Company
                if (!$isValidSub && substr($dataLine, 1, 8) == "SUB-COMP") {
                    $isValidSub = $this->readBCASubCompany($dataLine) == "00003" ? TRUE : FALSE;
                } elseif ($isValidSub && substr($dataLine, 1, 8) == "SUB-COMP") {
                    $isEndProcess = $this->readBCASubCompany($dataLine) != "00003" ? TRUE : FALSE;
                } else {
                    try {
                        //Go Read Details
                        if (trim(substr($dataLine, 46, 3)) == "IDR") {
                            $detail = $this->readBCADetails($dataLine);
                            $trans["countTX"]++;

                            $txBank = new Transaksibank();
							//test tahunajaran
							$txBank->tahunajaran = '3';
                            $txBank->NoVA = $detail["NumTxn"];
							$txBank->Keterangan =  $detail["Keterangan2"];
                            $txBank->NoReferensi =  $detail["Keterangan1"];
                            $txBank->NamaBank =  $sysparm->NamaBank;
                            $txBank->TanggalImport = $tanggal;
                            $txBank->TanggalTransaksi = date("Y-m-d", strtotime($detail["DateTxn"]));
                            //TOC RB 9 Juni 2015
                            $txBank->WaktuTransaksi = $detail["TimeTxn"];
                            $txBank->Nominal = substr($this->filter->sanitize($detail["Amount"], "int"), 0, -2);
                            $txBank->KodeCabang = substr($txBank->NoVA, 0, 4);

                            $cabang = Areacabang::findFirstByKodeAreaCabang($txBank->KodeCabang);
                            $siswa = Siswa::findFirst([
                                "Cabang = :cabang: AND VirtualAccount = :va:",
                                "bind" => ["cabang" => $cabang->RecID, "va" => substr($txBank->NoVA, 4, 7)]
                            ]);

                            if ($siswa) {
                                $txBank->Siswa = isset($siswa->RecID)? $siswa->RecID : NULL;
                            }

                            if(!$txBank->save()){$trans["countNotOK"]++;}
                            else{$trans["countOK"]++;}
                        }
                    } catch (Exception $ex) {
                        $trans["countDupe"]++;
                        $trans["dupeRec"][] = $this->readBCADetails($dataLine)["NumSeq"];
                        $this->flash->error($ex->getMessage());
						}
                
				
				}
            }
				
        }
		$this->db->begin();
		$this->db->execute($this->sql_1);	
		$this->db->execute($this->sql_2);
		// Update Transaksibank
		$this->db->commit();
			
		 
		

        $trans["kode"] = $sysparm->Prefix;
        return $trans;
    }
	

    private function readBCACompany($dataLine) {
        $comp = [];
        $comp["Code"] = trim(substr($dataLine, 19, 5));
        $comp["Name"] = trim(substr($dataLine, 25, 30));
        
        return $comp;
    }

    private function readBCASubCompany($dataLine) {
        return trim(substr($dataLine, 10, 5));
    }

    private function readBCADetails($dataLine) {
        $detail = [];
        $detail["NumSeq"]   = trim(substr($dataLine, 1, 5));
        $detail["NumTxn"]   = trim(substr($dataLine, 8, 18));
        $detail["CustName"] = trim(substr($dataLine, 28, 16));
        $detail["Currency"] = trim(substr($dataLine, 46, 3));
        $detail["Amount"]   = trim(substr($dataLine, 51, 20));
        //Convert Format Date to yy-mm-dd
        $date = explode("/", trim(substr($dataLine, 73, 8)));
        $detail["DateTxn"]  = $date[2]."-".$date[1]."-".$date[0];
        $detail["TimeTxn"]  = trim(substr($dataLine, 83, 8));
        $detail["Location"] = trim(substr($dataLine, 93, 5));
		$detail["Keterangan1"] = trim(substr($dataLine, 98, 16));
		 $detail["Keterangan2"] = trim(substr($dataLine, 114, 20));
        
        return $detail;
    }

    private function readFile($fileName) {
        $data = [];

        try {
            $myfile = fopen($fileName, "r");
            // Output one line until end-of-file
            if ($myfile) {
                while (!feof($myfile)) {
                    $data[] = fgets($myfile);
                }
                fclose($myfile);
            }
        } catch (Exception $e) {
            
        }
        return $data;
    }

}

