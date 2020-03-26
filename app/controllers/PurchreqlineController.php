<?php

//use Phalcon\Mvc\Model\Criteria;
//use Phalcon\Paginator\Adapter\Model as Paginator;

class PurchreqlineController extends ControllerBase {
   
    public function initialize() {
        parent::initialize();
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }
    /**
     * Displays the creation form
     */
    public function newAction($RecId) {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $this->view->item = InventItem::find(array(
            "StatusItem = '1'",
              ));
        $this->tag->setDefault("Purchreqheader", $RecId);
    }

    /**
     * Edits a purchreqline
     *
     * @param string $RecId
     */
    public function editAction($RecId) {

       $this->view->item = InventItem::find(array(
            "StatusItem = '1'",
              ));

        if (!$this->request->isPost()) {

            $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

            $purchreqline = Purchreqline::findFirstByRecId($RecId);
            if (!$purchreqline) {
                $this->flash->error("Detil pembelian tidak dapat ditemukan");
                return $this->forward("purchreqheader/index");
            }

            $this->view->RecId = $purchreqline->RecId;

            $this->tag->setDefault("RecId", $purchreqline->RecId);
            $this->tag->setDefault("Purchreqheader", $purchreqline->Purchreqheader);
            $this->tag->setDefault("ItemId", $purchreqline->ItemId);
            $this->tag->setDefault("ItemName", $purchreqline->ItemName);
            $this->tag->setDefault("Qty", $purchreqline->Qty);
            $this->tag->setDefault("IsReceipt", $purchreqline->IsReceipt);
            $this->tag->setDefault("CreatedBy", $purchreqline->CreatedBy);
            $this->tag->setDefault("CreatedDateTime", $purchreqline->CreatedDateTime);
        }
    }

    /**
     * Creates a new purchreqline
     */
        public function createAction() {

        if (!$this->request->isPost()) {
            return $this->forward("purchreqheader/index");
        }


        $Purchreqheader = $this->request->getPost("Purchreqheader");
        $ItemId = $this->request->getPost("ItemId");
        $qty = $this->request->getPost("Qty");
        $cabang = $this->auth['areacabang'];

        $order = Purchreqheader::query()
                ->columns("count(RecId) as TotalOrder")
                ->where("Cabang = '$cabang' and Status = 'Approved' and ApprovalDate >= '2017-06-01'")
                ->execute();

         foreach ($order as $row) {
            $TotalOrder = $row->TotalOrder;
        } 
        
 	$cek=CabangTanpaOngkir::query()
            ->columns("count(KodeCabang) as CekCabang")
            ->where("KodeCabang = '$cabang'")
            ->execute();

        foreach ($cek as $row) {
            $cekcabangtanpaongkir = $row->CekCabang;
        } 

        $getharga = Inventitem::query()
                    ->where("KodeItem = '$ItemId'")
                    ->execute();

        foreach ($getharga as $row) {
            $HargaBuku = $row->harga;
            $HargaOngkir = 10000;
            if ($cekcabangtanpaongkir > 0 AND $TotalOrder >= 6){
            $Harga = $HargaBuku;
        } else if ($cekcabangtanpaongkir == 0 AND $TotalOrder >= 6){
            $Harga = $HargaBuku+$HargaOngkir;
        } else {
            $Harga = $HargaBuku;
        }
        }

        $purchreqline = new Purchreqline();

        $purchreqline->Purchreqheader = $Purchreqheader;
        $purchreqline->ItemId = $ItemId;
        $purchreqline->ItemName = Inventitem::findFirstByKodeItem($purchreqline->ItemId)->NamaItem;
        $purchreqline->price = $Harga;
        $purchreqline->Qty = $qty;
        $purchreqline->QtyRemaining = $purchreqline->Qty;
        $purchreqline->IsReceipt = $this->request->getPost("IsReceipt");
        $purchreqline->CreatedBy = $this->session->auth['username'];
        $purchreqline->CreatedDateTime = date('Y-m-d H:i:s');

        $cekstokitem = Purchreqline::query()
                ->columns(array(" ItemId "))
                ->where("Purchreqheader = '$Purchreqheader' and ItemId = '$ItemId'")
                ->execute();
       
        if (count($cekstokitem) == 0) {

            $purchreqline->save();
            $this->flash->success("Detail pembelian berhasil ditambahkan");
            return $this->response->redirect("purchreqheader/edit/" . $purchreqline->Purchreqheader);

        }else{

            $sql = "UPDATE Purchreqline
                SET Qty = Qty + '$qty'
                WHERE purchreqheader = '$Purchreqheader' and ItemId = '$ItemId'";

                $query = $this->getDI()->getShared('db')->query($sql);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

            $this->flash->success("Jumlah Pesanan Detail Pembelian berhasil diubah");
            return $this->response->redirect("purchreqheader/edit/" . $purchreqline->Purchreqheader);

        }
        
    }

    /**
     * Saves a purchreqline edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->forward("purchreqheader/index");
        }

        $RecId = $this->request->getPost("RecId");

        $purchreqline = Purchreqline::findFirstByRecId($RecId);
        if (!$purchreqline) {
            $this->flash->error("purchreqline does not exist " . $RecId);

            return $this->dispatcher->forward(array(
                        "controller" => "purchreqline",
                        "action" => "index",
                        "params" => array($purchreqline->RecId)
                    ));
        }

        $purchreqline->Purchreqheader = $this->request->getPost("Purchreqheader");
        $purchreqline->ItemId = $this->request->getPost("ItemId");
        $purchreqline->ItemName = Inventitem::findFirstByKodeItem($purchreqline->ItemId)->NamaItem;
        $purchreqline->Qty = $this->request->getPost("Qty");
        $purchreqline->QtyRemaining = $purchreqline->Qty;
        $purchreqline->IsReceipt = $this->request->getPost("IsReceipt");

        if (!$purchreqline->save()) {

            foreach ($purchreqline->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "purchreqline",
                        "action" => "edit",
                        "params" => array($purchreqline->RecId)
                    ));
        }

        $this->flash->success("Detil pembelian berhasil diubah");
        return $this->response->redirect("purchreqheader/edit/" . $purchreqline->Purchreqheader);
    }

    /**
     * Deletes a purchreqline
     *
     * @param string $RecId
     */

    public function deleteAction($RecId) {

        $purchreqline = Purchreqline::findFirstByRecId($RecId);
        if (!$purchreqline) {
            $this->flash->error("Detil pembelian tidak dapat ditemukan");
            return $this->forward("purchreqheader/index");
        }

        if (!$purchreqline->delete()) {

            foreach ($purchreqline->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("purchreqheader/index");
        }

        $this->flash->success("Detil pembelian berhasil dihapus");
        return $this->response->redirect("purchreqheader/edit/" . $purchreqline->Purchreqheader);
    }

}
 