<?php
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class BarcodeInvalidController extends ControllerBase
{
   
     public function initialize() {
       
        \Phalcon\Tag::setTitle('Barcode Invalid');
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
        $this->view->rpt_title = 'Barcode Invalid';
    }
     
    public function indexAction() { 

        parent::initialize();
        $sql = "SELECT barcode as barcode, inventitem.NamaItem as buku ,count(a.RecId) as jumlah,(select top 1 masterbarcode.recid from masterbarcode
             where masterbarcode.Barcode=a.Barcode
             order by masterbarcode.RecID desc) as recid from masterbarcode a 
             join purchreqheader on a.PurchReqId=purchreqheader.RecId
             join barcodeitem on SUBSTRING(a.barcode,5,2)=barcodeitem.jenjang and SUBSTRING(a.barcode,7,2) = barcodeitem.kurikulum
             join inventitem on barcodeitem.kodeitem=inventitem.KodeItem
             where  purchreqheader.ApprovalDate >= '2017-06-01'
             group by barcode, inventitem.NamaItem  
             having count(a.RecId)!=1";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);

        $sql2 = "SELECT a.Barcode as barcode, inventitem.NamaItem as buku from masterbarcode a 
             join purchreqheader on a.PurchReqId=purchreqheader.RecId
             left join barcodeitem on SUBSTRING(a.barcode,5,2)=barcodeitem.jenjang and SUBSTRING(a.barcode,7,2) = barcodeitem.kurikulum
             left join inventitem on barcodeitem.kodeitem=inventitem.KodeItem
             where purchreqheader.ApprovalDate >= '2017-06-01' AND LEN(a.Barcode) != '14'";
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result2 = $query2->fetchAll($query2);

        $this->view->leveluser = $this->auth['usergroup'];

    }

    public function invalidAction() { 

        parent::initialize();
        $sql = "SELECT * from invalidbarcode a
                join areacabang b on a.Cabang=b.RecID";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);

    }

    public function detailAction($barcode) { 

        $sql = "SELECT a.RecID,a.Barcode, a.Status, d.NamaItem, b.KodeAreaCabang,b.NamaAreaCabang, a.CreatedBy, a.CreatedAt , e.PurchReqId
                from masterbarcode a 
                join areacabang b on a.Cabang=b.RecID
                left join barcodeitem c on SUBSTRING(a.barcode,5,2)=c.jenjang and SUBSTRING(a.barcode,7,2) = c.kurikulum
                left join inventitem d on c.kodeitem=d.KodeItem
                join purchreqheader e on a.PurchReqId=e.RecId
                where a.Barcode = '$barcode'";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);

        $this->view->bc = $barcode;

        $sql2 = "SELECT Top 1 d.NamaItem 
                from masterbarcode a 
                join areacabang b on a.Cabang=b.RecID
                join barcodeitem c on SUBSTRING(a.barcode,5,2)=c.jenjang and SUBSTRING(a.barcode,7,2) = c.kurikulum
                join inventitem d on c.kodeitem=d.KodeItem
                join purchreqheader e on a.PurchReqId=e.RecId
                where a.Barcode = '$barcode'";
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result2 = $query2->fetchAll($query2);

    }

    public function updateAction($RecId) { 

        $sql = "SELECT a.RecID,a.Barcode, a.Status, d.NamaItem, b.KodeAreaCabang,b.NamaAreaCabang, a.CreatedBy, a.CreatedAt, a.Cabang, a.PurchReqId, a.TypeUpload  ,e.PurchReqId as PR
                from masterbarcode a 
                join areacabang b on a.Cabang=b.RecID
                left join barcodeitem c on SUBSTRING(a.barcode,5,2)=c.jenjang and SUBSTRING(a.barcode,7,2) = c.kurikulum
                left join inventitem d on c.kodeitem=d.KodeItem
                join purchreqheader e on a.PurchReqId=e.RecId
                where a.RecID = '$RecId'";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);

        $this->view->bc = $barcode;

        $sql2 = "SELECT Top 1 d.NamaItem,a.Barcode 
                from masterbarcode a 
                join areacabang b on a.Cabang=b.RecID
                left join barcodeitem c on SUBSTRING(a.barcode,5,2)=c.jenjang and SUBSTRING(a.barcode,7,2) = c.kurikulum
                left join inventitem d on c.kodeitem=d.KodeItem
                join purchreqheader e on a.PurchReqId=e.RecId
                where a.RecID = '$RecId'";
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result2 = $query2->fetchAll($query2);

    }

    public function deleteAction($RecId) { 

        $sql = "SELECT a.RecID,a.Barcode, a.Status, d.NamaItem, b.KodeAreaCabang,b.NamaAreaCabang, a.CreatedBy, a.CreatedAt, a.Cabang, a.PurchReqId, a.TypeUpload  ,e.PurchReqId as PR
                from masterbarcode a 
                join areacabang b on a.Cabang=b.RecID
                left join barcodeitem c on SUBSTRING(a.barcode,5,2)=c.jenjang and SUBSTRING(a.barcode,7,2) = c.kurikulum
                left join inventitem d on c.kodeitem=d.KodeItem
                join purchreqheader e on a.PurchReqId=e.RecId
                where a.RecID = '$RecId'";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);

        $this->view->bc = $barcode;

        $sql2 = "SELECT Top 1 d.NamaItem,a.Barcode 
                from masterbarcode a 
                join areacabang b on a.Cabang=b.RecID
                left join barcodeitem c on SUBSTRING(a.barcode,5,2)=c.jenjang and SUBSTRING(a.barcode,7,2) = c.kurikulum
                left join inventitem d on c.kodeitem=d.KodeItem
                join purchreqheader e on a.PurchReqId=e.RecId
                where a.RecID = '$RecId'";
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result2 = $query2->fetchAll($query2);

    }

    public function saveupdateAction()
    {
        
        $BarcodePengganti = $this->request->getPost("BarcodePengganti");
        $RecId = $this->request->getPost("RecId");

        $sql = "UPDATE masterbarcode
                SET Barcode='$BarcodePengganti', Status=0
                WHERE RecID='$RecId'";

        $invbarcode = new invalidbarcode();

        $invbarcode->Cabang = $this->request->getPost("Cabang");
        $invbarcode->PurchReqId = $this->request->getPost("PurchReqId");
        $invbarcode->Barcode = $this->request->getPost("Barcode");
        $invbarcode->Status = $this->request->getPost("Status");
        $invbarcode->CreatedAtBarcode = $this->request->getPost("CreatedAt");
        $invbarcode->CreatedByBarcode = $this->request->getPost("CreatedBy");
        $invbarcode->TypeUpload = $this->request->getPost("TypeUpload");
        $invbarcode->CreatedAt = date("Y-m-d H:i:s");
        $invbarcode->CreatedBy = $this->auth['username'];
        $invbarcode->Aksi = 'Update';
        $invbarcode->Keterangan = $this->request->getPost("Keterangan");
        $invbarcode->BarcodePengganti = $this->request->getPost("BarcodePengganti");
        
        $invbarcode->save();

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->flash->success("Update barcode berhasil...");
        return $this->dispatcher->forward(array(
            "controller" => "barcodeinvalid",
            "action" => "invalid"
        ));


    }

    public function savedeleteAction($RecId)
    {
        
        $RecId = $this->request->getPost("RecId");

        $sql = "DELETE from masterbarcode
                WHERE RecID='$RecId'";

        $invbarcode = new invalidbarcode();

        $invbarcode->Cabang = $this->request->getPost("Cabang");
        $invbarcode->PurchReqId = $this->request->getPost("PurchReqId");
        $invbarcode->Barcode = $this->request->getPost("Barcode");
        $invbarcode->Status = $this->request->getPost("Status");
        $invbarcode->CreatedAtBarcode = $this->request->getPost("CreatedAt");
        $invbarcode->CreatedByBarcode = $this->request->getPost("CreatedBy");
        $invbarcode->TypeUpload = $this->request->getPost("TypeUpload");
        $invbarcode->CreatedAt = date("Y-m-d H:i:s");
        $invbarcode->CreatedBy = $this->auth['username'];
        $invbarcode->Aksi = 'Delete';
        $invbarcode->Keterangan = $this->request->getPost("Keterangan");
       // $invbarcode->BarcodePengganti = $this->request->getPost("BarcodePengganti");
        
        $invbarcode->save();

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->flash->success("Hapus barcode berhasil...");
        return $this->dispatcher->forward(array(
            "controller" => "barcodeinvalid",
            "action" => "invalid"
        ));


    }
}