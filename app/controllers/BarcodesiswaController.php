<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class BarcodesiswaController extends ControllerBase
{
   
     public function initialize() {
       
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Packing Slip susulan';
    }
     
     
    public function indexAction() { 
    //    $this->persistent->parameters = null;
        
        $numberPage = 1;
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }

        $deliveryreqheader = $this->modelsManager->createBuilder()
                 ->columns(array('NoVA,bcode'))
                ->from('Barcode')  
                ->getQuery()
                ->execute();

        $paginator = new Paginator(array(
                    "data" => $deliveryreqheader,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();

        $this->view->setVar("session",$this->session->get('auth'));
    }

    public function cariAction() { 
    //    $this->persistent->parameters = null;
        
        $numberPage = 1;
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }

        $kode = $this->request->getPost("KodeCabang");

        $deliveryreqheader = $this->modelsManager->createBuilder()
                 ->columns(array('NoVA,bcode'))
                ->from('Barcode')  
                ->where("NoVA like '%$kode%' or bcode like'%$kode%'")
                ->getQuery()
                ->execute();

        if (count($deliveryreqheader) == 0) { 
        }

        $paginator = new Paginator(array(
                    "data" => $deliveryreqheader,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();

        $this->view->setVar("session",$this->session->get('auth'));
    }

}
