<?php

class IndexController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Selamat Datang');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        } 
    }

    public function indexAction() {                


        $cekPembayaran = Konfirmasipembayaran::query()
                        ->where("Status = 'Inreview'")
                        ->execute();

        $cabang = $this->session->has('auth') ? $this->session->get('auth')['areacabang'] : '';
        $purchreqheader = $this->modelsManager->createBuilder()
                ->columns(array("Purchreqheader.RecId as RecIdd,PurchReqId,PurchReqName,Requester,PurchReqDate,Status,Cabang,
                sum(d.price*d.Qty) as harga"))
                ->from("Purchreqheader")
                ->join("Areacabang", "Purchreqheader.Cabang = c.RecID", "c")
                ->join("Areacabang", "c.Area = a.KodeAreaCabang", "a")
                ->join("Purchreqline", "Purchreqheader.RecId = d.Purchreqheader","d")
                ->where("Purchreqheader.Status = :status: AND a.RecID = :area:")
                ->groupby("Purchreqheader.RecId,PurchReqId,PurchReqName,Requester,PurchReqDate,Status,Cabang")
                ->getQuery()
                ->execute(["status" => "Inreview", "area" => $cabang]);

        $syscms = Syscmshome::findFirst();
        $this->view->paneltitle    = $syscms->PanelTitle;
        $this->view->panelcontent  = $syscms->PanelContent;
        $this->view->headercontent = $syscms->HeaderContent;
        $this->view->panel         = strlen($syscms->PanelContent) > 0 ? TRUE : FALSE;      
        $this->view->leveluser = $this->auth['usergroup'];  
        $this->view->cekkonfirm = count($cekPembayaran);
       // $this->view->cekapproval = count($purchreqheader);
        $this->view->cekapproval = count($purchreqheader);
        //$leveluser = $this->auth['usergroup'];
        //$this->flash->success("Selamat Datang !!!");
		
	
}
	
	
	 public function kuesaction() {
		
        $cekPembayaran = Konfirmasipembayaran::query()
                        ->where("Status = 'Inreview'")
                        ->execute();
        $cabang = $this->session->has('auth') ? $this->session->get('auth')['areacabang'] : '';
        $purchreqheader = $this->modelsManager->createBuilder()
                ->columns(array("Purchreqheader.RecId as RecIdd,PurchReqId,PurchReqName,Requester,PurchReqDate,Status,Cabang,
                sum(d.price*d.Qty) as harga"))
                ->from("Purchreqheader")
                ->join("Areacabang", "Purchreqheader.Cabang = c.RecID", "c")
                ->join("Areacabang", "c.Area = a.KodeAreaCabang", "a")
                ->join("Purchreqline", "Purchreqheader.RecId = d.Purchreqheader","d")
                ->where("Purchreqheader.Status = :status: AND a.RecID = :area:")
                ->groupby("Purchreqheader.RecId,PurchReqId,PurchReqName,Requester,PurchReqDate,Status,Cabang")
                ->getQuery()
                ->execute(["status" => "Inreview", "area" => $cabang]);  

	$syscms = Syscmshome::findFirst();
        $this->view->paneltitle    = $syscms->PanelTitle;
        $this->view->panelcontent  = $syscms->PanelContent;
        $this->view->headercontent = $syscms->HeaderContent;
        $this->view->panel         = strlen($syscms->PanelContent) > 0 ? TRUE : FALSE;
	$this->view->setTemplateAfter('main');        
        $this->view->leveluser = $this->auth['usergroup'];  
        $this->view->cekkonfirm = count($cekPembayaran);
        $this->view->cekapproval = count($purchreqheader);
		
		
	 }
	 
	
	
		
    
    public function testAction() {
//        //var_dump($this->session->auth);
        if (!$this->request->isPost()) {
            return;
        }
        $fileUpload = $this->request->getUploadedFiles()[0];
        
        if ($fileUpload->getExtension() == 'xlsx') {
            $data = $this->excel->uploadRekening($fileUpload);

            $cntAll = count($data);
            $cntErr = 0;
            $cntIgn = 0;
            $cntOK  = 0;
            $cntOKNonBCA = 0;
            $errors = [];

            foreach ($data as $key => $rec) {
                if ($rec['KodeAreaCabang'] == NULL) {
                    $cntIgn++;
                    $errors[] = $key+2;
                } else {
                    $cabang = Areacabang::findFirstByKodeAreaCabang($rec['KodeAreaCabang']);
                    if ($cabang != FALSE) {
                        if ($rec['NamaBank'] == "BCA") {
                            $cntOK++;
                            $cabang->NoRekBCA = $rec['NoRekening'];
                            $cabang->NamaRekBCA = $rec['NamaRekening'];
                            $cabang->save();
                        } else if ($rec['NoRekening'] != '') {
                            $cntOKNonBCA++;
                            $cabang->NoRekNonBCA = $rec['NoRekening'];
                            $cabang->NamaRekNonBCA = $rec['NamaRekening'];
                            $cabang->KodeBankNonBCA = $rec['KodeBank'];
                            $cabang->save();
                        } else {
                            $cntErr++;
                            $errors[] = ($key+2)."B";
                        }
                    } else {
                        $cntErr++;
                        $errors[] = ($key+2)."E";
                    }
                }
            }
        }
        
        $this->flash->success("Number of Records Read : ".$cntAll.", Success : ".$cntOK." (BCA),".$cntOKNonBCA." (Non-BCA), Ignored : ".$cntIgn.", Error : ".$cntErr."<br/>(".implode(",", $errors).")");
    }

    public function inventoryAppAction()
    {
        if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
        } else {
            $uri = 'http://';
        }
        $uri .= $_SERVER['HTTP_HOST'];
        header('Location: '.$uri.'./inventory_app?Username='.base64_encode($this->auth['username']).'&Password='.base64_encode($this->auth['password']));
        exit;
    }

}
