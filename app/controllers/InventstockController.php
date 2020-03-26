<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\NativeArray as Paginator;

class InventstockController extends ControllerBase {

    protected $auth;
    
    public function initialize() {
        $this->tag->setTitle("Stok Barang");
        parent::initialize();

        if($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }

    /**
     * Index action
     */
    public function indexAction() {
        $this->persistent->parameters = null;

        $this->view->itemid = Inventitem::find();
    }

    /**
     * Searches for inventstock
     */
    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $this->persistent->parameters = array(
                "datefrom" => $this->request->getPost("FromDate", null, date("Y-m-d")),
                "dateto" => $this->request->getPost("ToDate", null, date("Y-m-d")),
                "itemid" => $this->request->getPost("ItemId", null, null)
            );
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }

//        $stockQuery = $this->modelsManager->createBuilder()
//            ->columns([
//                "Inventitem.KodeItem","Inventitem.NamaItem"
//                ,"isnull(sum(sb.QtyReceipt-sb.QtyOrder),0) as BegBal"
//                ,"isnull(sum(st.QtyReceipt),0) as QtyIn"
//                ,"isnull(sum(st.QtyOrder),0) as QtyOut"
//                ,"isnull(sum(sb.QtyReceipt-sb.QtyOrder),0) + isnull(sum(st.QtyReceipt - st.QtyOrder),0) as Stock"
//                ])
//            ->from("Inventitem")
//            ->leftJoin("Inventstock",
//                "Inventitem.KodeItem = sb.ItemId AND sb.TransDate < :datefrom1: AND sb.Cabang = :cabang1:", "sb")
//            ->leftJoin("Inventstock",
//                "Inventitem.KodeItem = st.ItemId AND (st.TransDate BETWEEN :datefrom2: AND :dateto:) AND st.Cabang = :cabang2:", "st")
//            ->groupBy(["Inventitem.KodeItem, Inventitem.NamaItem"]);
//
//        if($parameters["itemid"]) {
//            $stockQuery->where("Inventitem.KodeItem = :itemid:", ["itemid" => $parameters["itemid"]]);
//        }
//
//        $inventstock = $stockQuery->getQuery()
//                ->execute([
//                    "cabang1" => $this->auth['areacabang'],
//                    "cabang2" => $this->auth['areacabang'],
//                    "datefrom1" => $parameters["datefrom"],
//                    "datefrom2" => $parameters["datefrom"],
//                    "dateto" => $parameters["dateto"]
//                ]);
        $sql = str_replace(['%0', '%1', '%2', '%3']
                ,[$parameters["datefrom"], $parameters["dateto"], $this->auth['areacabang'], $parameters["itemid"]]
                ,"SELECT * FROM GetStock('%0', '%1', %2) WHERE KodeItem LIKE '%%3'");

        $inventstock = $this->getDI()->getShared('db')->query($sql);        
        $inventstock->setFetchMode(Phalcon\Db::FETCH_ASSOC);
        $inventstock = $inventstock->fetchAll($inventstock);

        if (count($inventstock) == 0) {
            $this->flash->notice("Stok barang tidak ditemukan");

            return $this->forward("inventstock/index");
        }

        $paginator = new Paginator(array(
                    "data" => $inventstock,
                    "limit" => 20,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();

    }

}
