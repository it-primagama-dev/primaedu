<?php

class RptdetailpengirimanController extends ControllerBase
{


    public function initialize() {
        $this->tag->setTitle('Laporan pengiriman buku');
       parent::initialize();
        $this->view->rpt_title = 'Laporan pengiriman buku';
    }

    public function indexAction() {
      
        $this->view->rpt_auth = $this->auth;
    }

   

    public function viewAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward(' Rptpengirimanbuku/index');
        }
        $datefrom = $this->request->getPost('DateFrom', 'int') ? : date('Y-m-d');
        $dateto = $this->request->getPost('DateTo', 'int') ? : date('Y-m-d');
		if($datefrom="" or $dateto=""){
			$test="";
		}else{
		$test=("where DeliveryReqDate between '$datefrom' and '$dateto'");
		}


        $sql = "select deliveryreqline.*,areacabang.kodeareacabang,areacabang.namaareacabang,deliveryreqheader.purchreqid 
		,x.NamaAreaCabang as area,deliveryreqheader.DeliveryReqDate from deliveryreqline join deliveryreqheader on
		deliveryreqheader.recid=deliveryreqline.deliveryreqheader join  areacabang
		on deliveryreqheader.Cabang=areacabang.RecID join areacabang x on areacabang.Area=x.KodeAreaCabang order by deliveryreqheader.DeliveryReqDate ASC";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = $datefrom.' - '.$dateto;
        $this->view->result = $query->fetchAll($query);  
    }
}

    
