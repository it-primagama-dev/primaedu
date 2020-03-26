<?php


class DepositController extends ControllerBase
{
    public function initialize() {
        $this->tag->setTitle('Deposit Cabang');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        } 
        $this->view->rpt_title = 'Deposit Cabang';
    }

    public function indexAction() {

        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('Area', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
    
    }

    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->forward("Deposit");
        }

        $PurchReqId = $this->request->getPost("kodeprdeposit");
        $Nominal = substr($this->request->getPost("Nominal", "int"), 0, -2);
        $CreatedAtDeposit = date('Y-m-d H:i');
        $CreatedByDeposit = $this->auth['username'];
        $NominalKet = $this->request->getPost("Nominal");
        $ket = $this->request->getPost("Keterangan");
        $Keterangan = " $NominalKet - $ket - $CreatedByDeposit ($CreatedAtDeposit).";
        $NoSuratPernyataan = $this->request->getPost("NoSuratPernyataan");


        $cekdeposit = Purchreqheader::query()
                ->columns(array("DepositLain"))
                ->where("PurchReqId = '$PurchReqId' and DepositLain is null")
                ->execute();
       
        if (count($cekdeposit) == 0) {

            $sql = "UPDATE Purchreqheader
                SET DepositLain = DepositLain + '$Nominal',
                Keterangan = Keterangan + '$Keterangan'
                WHERE PurchReqId = '$PurchReqId'";

                $query = $this->getDI()->getShared('db')->query($sql);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

            $sqlrefund = "UPDATE refund SET DepositIsUsing='1' WHERE NoSuratPernyataan='".$NoSuratPernyataan."'";
            $queryrefund = $this->getDI()->getShared('db')->query($sqlrefund);
            $queryrefund->setFetchMode(Phalcon\Db::FETCH_OBJ);

            $this->flash->success("Deposit Berhasil ditambah");
            return $this->response->redirect("Deposit");

        }else{

            $sql = "UPDATE Purchreqheader
                SET DepositLain = '$Nominal',
                Keterangan = '$Keterangan'
                WHERE PurchReqId = '$PurchReqId'";

                $query = $this->getDI()->getShared('db')->query($sql);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

            $sqlrefund = "UPDATE refund SET DepositIsUsing='1' WHERE NoSuratPernyataan='".$NoSuratPernyataan."'";
            $queryrefund = $this->getDI()->getShared('db')->query($sqlrefund);
            $queryrefund->setFetchMode(Phalcon\Db::FETCH_OBJ);

            $this->flash->success("Deposit Berhasil ditambah");
            return $this->response->redirect("Deposit");

        }
        
    }

    public function savepindahdepoAction() {

        if (!$this->request->isPost()) {
            return $this->forward("Deposit");
        }

        $PurchReqId = $this->request->getPost("kodeprdeposit");
        $PurchReqIdDepo = $this->request->getPost("pindahdeposit");
        $PurchReqIdOld = $this->request->getPost("PRlama");
        $Nominal = $this->request->getPost("Deposit", "int");
        $NominalOld = $this->request->getPost("Deposit2");
        $CreatedAtDeposit = date('Y-m-d H:i:s');
        $CreatedByDeposit = $this->auth['username'];
        $Keterangan = $this->request->getPost("Keterangan");
        $KeteranganVoid = "Deposit $NominalOld dipindahkan ke $PurchReqIdDepo";


        $cekdeposit = Purchreqheader::query()
                ->columns(array("Deposit"))
                ->where("PurchReqId = '$PurchReqId' and Deposit is null")
                ->execute();
       
        if (count($cekdeposit) == 0) {

            $sql = "UPDATE Purchreqheader
                SET Deposit = Deposit + '$Nominal'
                WHERE PurchReqId = '$PurchReqId'";

                $query = $this->getDI()->getShared('db')->query($sql);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

            $sql2 = "UPDATE Purchreqheader
                SET Deposit = 0,
                VoidCreatedBy = '$CreatedByDeposit',
                VoidCreatedAt = '$CreatedAtDeposit',
                KeteranganVoid = '$KeteranganVoid'
                WHERE PurchReqId = '$PurchReqIdOld'";

                $query2 = $this->getDI()->getShared('db')->query($sql2);
                $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);

            $this->flash->success("Deposit Berhasil dipndahkan");
            return $this->response->redirect("Deposit");

        }else{

            $sql = "UPDATE Purchreqheader
                SET Deposit = '$Nominal'
                WHERE PurchReqId = '$PurchReqId'";

                $query = $this->getDI()->getShared('db')->query($sql);
                $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

            $sql2 = "UPDATE Purchreqheader
                SET Deposit = 0,
                VoidCreatedBy = '$CreatedByDeposit',
                VoidCreatedAt = '$CreatedAtDeposit',
                KeteranganVoid = '$KeteranganVoid'
                WHERE PurchReqId = '$PurchReqIdOld'";

                $query2 = $this->getDI()->getShared('db')->query($sql2);
                $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);

            $this->flash->success("Deposit Berhasil dipndahkan");
            return $this->response->redirect("Deposit");

        }
        
    }

    public function viewAction($RecID) {

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);

        $RecID = $this->request->getPost("Kodepr1");

        $pr = Purchreqheader::findFirstByRecId($RecID);
        $sql2="select  TOP 1 * from Purchreqheader where Cabang='$pr->Cabang' and PurchReqId!='$pr->PurchReqId' AND PurchReqDate < '$pr->PurchReqDate' order by PurchReqDate DESC";
        $q = $this->getDI()->getShared('db')->query($sql2);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $q->fetchAll($q);

        if ($pr === FALSE) {
            $this->flash->error('Detil pembelian tidak dapat ditemukan');
            return $this->forward('Deposit/index');
        }
         $this->view->pr = $pr;

        $prcbg = Purchreqheader::query()
                    ->columns("*")
                    ->where("Cabang = '$pr->Cabang'")
                    ->execute();

        $this->view->prcabang = $prcbg;

    }

    public function detailkodeprdepoAction() {

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);

        $RecID = $this->request->getPost("Kodeprdepo");

        $pr = Purchreqheader::findFirstByRecId($RecID);
        $sql2="select  TOP 1 * from Purchreqheader where Cabang='$pr->Cabang' and PurchReqId!='$pr->PurchReqId' AND PurchReqDate < '$pr->PurchReqDate' order by PurchReqDate DESC";
        $q = $this->getDI()->getShared('db')->query($sql2);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->resultt = $q->fetchAll($q);
        $this->view->pr =$pr->PurchReqId;         
    }

    public function detailkodeprAction() {

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);

        $RecID = $this->request->getPost("Kodepr");

        $pr = Purchreqheader::findFirstByRecId($RecID);
        $sql2="select  TOP 1 * from Purchreqheader where Cabang='$pr->Cabang' and PurchReqId!='$pr->PurchReqId' AND PurchReqDate < '$pr->PurchReqDate' order by PurchReqDate DESC";
        $q = $this->getDI()->getShared('db')->query($sql2);
        $q->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->resultt = $q->fetchAll($q);

        $cabang = $this->request->getPost("Cabang");
        $sql = "SELECT case when refund.Deposite=0 then refund.Nominal else refund.Deposite end AS Deposite,refund.NoSuratPernyataan,areacabang.RecID from refund join areacabang on refund.CreateBy=LTRIM(RTRIM(areacabang.KodeAreaCabang)) WHERE areacabang.RecID='".$cabang."' AND JenisRefund='Deposite' AND JenisDeposite='02' AND TrackGM='Approved' AND TrackFinance='Approved' AND DepositIsUsing = '0'";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);
    }

    public function getcabangAction($area = 0) {
        $this->view->disable();
        $cabang = Areacabang::query()
                ->columns("c.*")
                ->join("Areacabang", "Areacabang.KodeAreaCabang = c.Area", "c")
                ->where("Areacabang.RecID = :area:")
                ->orderBy("c.KodeAreaCabang")
                ->bind(["area" => $this->filter->sanitize($area, "int")])
                ->execute();
        echo "<option value=\"\">---</option>";
        if (!count($cabang)) {
            return;
        }
        foreach ($cabang as $rec) {
            echo "<option value=\"" . $rec->RecID . "\">" . $rec->KodeNamaAreaCabang . "</option>";
        }
    }

    public function getkodeprAction($cabang = 0) {
        $this->view->disable();
        $kodepr = Purchreqheader::query()
                ->columns("Purchreqheader.PurchReqId,Purchreqheader.RecID")
                ->join("Areacabang", "Areacabang.RecID = Purchreqheader.Cabang")
                ->where("Areacabang.RecID = :cabang: AND Purchreqheader.Status = 'Approved'")
                ->orderBy("Purchreqheader.PurchReqId")
                ->bind(["cabang" => $this->filter->sanitize($cabang, "int")])
                ->execute();
        echo "<option value=\"\">---</option>";
        if (!count($kodepr)) {
            return;
        }
        foreach ($kodepr as $rec) {

            echo "<option value=\"" . $rec->RecID . "\">" . $rec->PurchReqId . "</option>";
        }
    }

    public function getkodepr1Action($cabang = 0) {
        $this->view->disable();
        $kodepr = Purchreqheader::query()
                ->columns("Purchreqheader.PurchReqId,Purchreqheader.RecID")
                ->join("Areacabang", "Areacabang.RecID = Purchreqheader.Cabang")
                ->where("Areacabang.RecID = :cabang: AND Purchreqheader.Status = 'Approved'")
                ->orderBy("Purchreqheader.PurchReqId")
                ->bind(["cabang" => $this->filter->sanitize($cabang, "int")])
                ->execute();
        echo "<option value=\"\">---</option>";
        if (!count($kodepr)) {
            return;
        }
        foreach ($kodepr as $rec) {

            echo "<option value=\"" . $rec->RecID . "\">" . $rec->PurchReqId . "</option>";
        }
    }

}

