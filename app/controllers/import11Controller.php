<?php
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class import11Controller extends ControllerBase {

 
  protected $auth;

    public function initialize() {
        $this->tag->setTitle("Import 11");
        parent::initialize();
    }
	
    public function indexAction() {
        $this->persistent->parameters = null;
			if($this->request->isPost()){
				if($this->request->hasFiles() == FALSE){
					$this->flash->error("Pilih File Excel");
						return;
				}else{
					$trans["countNotOK"]=0;
					$trans["countdup"]=0;
					$trans["countOK"]=0;
					$trans["countauto"]=0;
					$fileUpload = $this->request->getUploadedFiles()[0];
					if ($fileUpload->getExtension() == "xlsx") {
						try {
								$dataExcel = $this->excel->readFile($fileUpload);
								foreach ($dataExcel AS $key => $value) {
									$KodeCabang = $value['BidangStudi'];
									$NoSiswa = $value['nilai1'];
									$NamaSiswa = $value['nilai3'];
									$TGLTransfer = date("Y-m-d", strtotime($value["nilai8"]));
									$UangBimble =$value["nilai4"];
									
									$phql   = "INSERT INTO transaksibank (NamaBank,Nominal,KodeCabang,TanggalTransaksi,Keterangan,TanggalImport,NoVA,NoReferensi)"."VALUES('BCA','$UangBimble','$KodeCabang','$TGLTransfer','$NamaSiswa','$TGLTransfer','$KodeCabang$NoSiswa','$KodeCabang$NoSiswa')";
									$db = $this->getDI()->get('db');
									if (!$db->execute($phql)){
									 $this->db->rollback();	
									 $trans["countNotOK"]++;
									return $this->response->redirect("import11/index");
									}else{
							
										$trans["countOK"]++;
									}
								
				
								}
						} catch (Exception $e) {
									//$this->flash->error("Import data excel gagal");
									return $this->response->redirect("import11/index");
									 $trans["countdup"]++;
						}
				
            
					}
						 $sql_1="UPDATE pdd SET pdd.TanggalPembayaran=tx.TanggalTransaksi
									FROM pembayarandetail pdd JOIN  transaksibank tx ON tx.NoReferensi = pdd.NoReferensi
									 WHERE tx.RefRecID =pdd.RecID  AND tx.Nominal = pdd.Jumlah 
									 AND tx.NamaBank = pdd.NamaBank AND pdd.Status = '0'";

						$sql_0="UPDATE tx SET tx.RefRecID = settle.pd_id
								FROM transaksibank tx JOIN (
									SELECT min(tx.RecID) AS tx_id, min(pd.RecID) AS pd_id
									FROM transaksibank tx
									JOIN pembayarandetail pd ON tx.NoReferensi = pd.NoReferensi
										 AND tx.Nominal = pd.Jumlah
										 AND tx.NamaBank = pd.NamaBank
									WHERE tx.RefRecID IS NULL 
									GROUP BY tx.Nominal, tx.NoReferensi
								) settle ON tx.RecID = settle.tx_id";
    

						 $sql_2 = "UPDATE pd SET pd.Status = '1'
									FROM transaksibank tx
									JOIN pembayarandetail pd ON tx.RefRecID = pd.RecID
									WHERE pd.Status = '0'";

									$db = $this->getDI()->get('db');
									if (!$db->execute($sql_0) AND !$db->execute($sql_2) AND !$db->execute($sql_1)){
									 $this->db->rollback();	
									 $this->flash->error("autoseattle gagal");
									return $this->response->redirect("import11/index");
									}
							
							
							$this->flash->success("import berhasil");
							$this->flash->success("gagal: ".$trans["countNotOK"]."
							 duplikat: ".$trans["countdup"]."
							berhasil: ".$trans["countOK"]);
							
							return $this->forward("import11/index");
				}
		
	
		 
			}
	}
	

}
