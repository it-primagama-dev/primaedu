<?php

class RptkirimbukuController extends ControllerBase
{


    public function initialize() {
        $this->tag->setTitle('Laporan pengiriman buku');
       parent::initialize();
        $this->view->rpt_title = 'Laporan pengiriman buku';
		
        $this->view->rpt_title = 'Laporan Distribusi Buku';
        $this->view->rpt_img = '<img src=../img/logo_new_web.png width=220>';
	
	    $datefrom = $this->request->getPost('DateFrom', 'int') ? : date('Y-m-d');
        $dateto = $this->request->getPost('DateTo', 'int') ? : date('Y-m-d');

		$this->view->rpt_datefrom = $datefrom;
		$this->view->rpt_dateto = $dateto;

    }

    public function indexAction() {
      
        $this->view->rpt_auth = $this->auth;
    }

   

    public function viewAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('Rptkirimbuku/index');
        }

      $datefrom = $this->request->getPost('DateFrom', 'int') ? : date('Y-m-d');
        $dateto = $this->request->getPost('DateTo', 'int') ? : date('Y-m-d');
		
		
		if($datefrom="" or $dateto=""){
//			$test="";
	
	 	$datefrom = date('Y-m-d');
        $dateto = date('Y-m-d');
	
		$test=("AND CONVERT(date, ph.PurchReqDate, 111) between '$datefrom' and '$dateto'");

		}else{
		

 		$datefrom = $this->request->getPost('DateFrom', 'int') ? : date('Y-m-d');
        $dateto = $this->request->getPost('DateTo', 'int') ? : date('Y-m-d');
	
		$test=("AND CONVERT(date, ph.PurchReqDate, 111) between '$datefrom' and '$dateto'");


		}


        $sql = "SELECT
				a.KodeAreaCabang AS [KodeArea], a.NamaAreaCabang AS [NamaArea],c.KodeAreaCabang AS [KodeCabang], 
				c.NamaAreaCabang AS [NamaCabang],ph.PurchReqId, ph.PurchReqName, ph.[Status], ph.Requester, 
				ph.PurchReqDate,ph.ApprovalDate, ph.Remarks, ph.ImportAX,pl.ItemId, pl.ItemName, pl.Qty, 
				pl.Qty - pl.QtyRemaining AS QtyReceived, pl.QtyRemaining, pl.IsReceipt,ph.Deposit
				FROM areacabang a
				JOIN areacabang c on a.KodeAreaCabang = c.Area
				JOIN purchreqheader ph on c.RecID = ph.Cabang
				JOIN purchreqline pl on ph.RecId = pl.Purchreqheader
				WHERE c.Aktif = '1' $test
				ORDER by ph.PurchReqDate DESC";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
		
		
		$sql2="select TOP 1 status,convert(varchar,CreatedDateTime ,105) as tanggal ,convert(varchar,EstimasiDate ,105) as 
					ETA,koli,ResiId,convert(varchar,CreatedDateTime ,108)as waktu from deliveryreqheader
					where PurchReqId='$query->PurchReqId'";
		$q = $this->getDI()->getShared('db')->query($sql2);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->reslast = $q->fetchAll($q);


        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = $datefrom.' - '.$dateto;
        $this->view->result = $query->fetchAll($query);  
    
	
	
	}
	
	
}

    
