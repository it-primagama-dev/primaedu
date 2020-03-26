<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class TidakInputPengirimanController extends ControllerBase {

    /** 
     * Index action
     */
    public function indexAction() { 
    //    $this->persistent->parameters = null;

        $numberPage = 1;
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }

        $sql = " select PurchReqId,c.NamaAreaCabang as Area, areacabang.NamaAreaCabang from Konfirmasipembayaran join areacabang
				 join areacabang c on areacabang.Area=c.KodeAreaCabang on Konfirmasipembayaran.Cabang=
				 areacabang.RecID where Konfirmasipembayaran.PurchReqId not in 
				 (select PurchReqId from deliveryreqheader) and Konfirmasipembayaran.Status='Approved' group by PurchReqId,
				 areacabang.NamaAreaCabang,c.NamaAreaCabang";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

       // $this->view->setLayout('report');
       // $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
       // $this->view->periode = date('d/m/Y', strtotime($datefrom)).' - '.date('d/m/Y', strtotime($dateto));
        $this->view->result = $query->fetchAll($query); 
	
}
}
	
  

  
   

  
      

  
   