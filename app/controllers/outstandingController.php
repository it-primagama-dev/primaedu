<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class outstandingController extends ControllerBase {

    /** 
     * Index action
     */
    public function indexAction() { 
    //    $this->persistent->parameters = null;

        $numberPage = 1;
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }

        $cabang = $this->session->has('auth') ? $this->session->get('auth')['areacabang'] : '';


        $Konfirmasipembayaran= $this->modelsManager->createBuilder()
                ->columns(array("outstanding.KodeCabang,areacabang.NamaAreaCabang ,U.NamaAreaCabang as Area"))
                ->from("outstanding")
				->join("areacabang","areacabang.KodeAreaCabang=outstanding.KodeCabang")
				->join("areacabang","U.KodeAreaCabang=areacabang.Area","U")
				->groupby("outstanding.KodeCabang,U.NamaAreaCabang,areacabang.NamaAreaCabang")
                ->orderby("outstanding.KodeCabang")
                ->getQuery()
                ->execute();

        if (count($konfirmasipembayaran) == 0) { 
        }

        $paginator = new Paginator(array(
                    "data" => $Konfirmasipembayaran,
                    "limit" => 10,
                    "page" => $numberPage
                ));
		
		

        $this->view->page = $paginator->getPaginate();
			
        $this->view->setVar("session",$this->session->get('auth'));
    }
	
	

    public function deleteAction(){
		
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "outstanding",
                "action" => "index"
            ));
        }

        $Kode = $this->request->getPost("KodeCabang");
		
		 
		$this->db->begin();
		$test=  "delete from outstanding where KodeCabang='$Kode'";
		$this->db->execute($test);
		$this->db->commit();


       
		
		
        return $this->response->redirect('outstanding');


    }
	
	 public function newAction() {
		

      
    }
	
	public function createAction() {

       if (!$this->request->isPost()) {
            return $this->forward('outstanding/index');
        }

       
		
		$outstanding = new outstanding();

     
       $outstanding->jml = $this->request->getPost("Nominal");
	$outstanding->KodeCabang = $this->request->getPost("KodeCabang");

        if (!$outstanding->save()) {
            foreach ($outstanding->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward('outstanding/index');
        }
		 return $this->forward('outstanding/index');
    }
	
	

   

}
