<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
    
class cashinoutController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle("Cash In / Out Cabang");
        parent::initialize();        

        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    
    }

    public function indexAction() {
        $numberPage = 1;
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }

        $sid = $this->auth['kodeareacabang'];
        $laporan =  cashinout::query()
                ->columns(array("
                    CashInOut.Cabang as KodeCabang,COALESCE(CashInOutGroup.GroupName,'Tidak ada') as IdGroup, COALESCE(CashInOutHuruf.Deskripsi,'Tidak ada') as IdHuruf, COALESCE(CashInOutTypeClass.ClassName,'Tidak ada') as IdClass, COALESCE(CashInOutType.Deskripsi,'Tidak ada') as IdTipe, CashInOut.Nominal, CashInOut.Description, CashInOut.Tanggal ,CashInOut.CreatedBy,CashInOut.RecId"))
                ->leftJoin("CashInOutGroup", "CashInOut.IDGroup = CashInOutGroup.RecId")
                ->leftJoin("CashInOutHuruf", "CashInOut.IDHuruf = CashInOutHuruf.RecID")
                ->leftJoin("CashInOutTypeClass", "CashInOut.IDClass =CashInOutTypeClass.RecId")
                ->leftJoin("CashInOutType", "CashInOut.IDTipe = CashInOutType.RecID")
                ->where("Cabang = '$sid'")
                ->orderBy("CashInOut.RecId DESC")
                ->execute();

        $paginator = new Paginator(array(
                    "data" => $laporan,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();
    }

    public function getHurufAction($param) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $records = [];
        $qry = CashInOutHuruf::find(array(
                    'conditions' => 'KodeGroup = ?0',
                    'order' => 'Deskripsi',
                    'bind' => array(0 => $param),
        ));
        if (!count($qry)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($qry as $record) {
                $records[] = [
                    'RecID' => $record->RecID,
                    'Deskripsi' => $record->Deskripsi,
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'listData' => $records
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

    public function getClassAction($param) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $records = [];
        $qry = CashInOutTypeClass::find(array(
                    'conditions' => 'KodeHuruf = ?0',
                    'order' => 'ClassName',
                    'bind' => array(0 => $param),
        ));
        if (!count($qry)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($qry as $record) {
                $records[] = [
                    'RecId' => $record->RecId,
                    'ClassName' => $record->ClassName,
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'listData' => $records
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

    public function getTipeAction($param) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $records = [];
        $qry = CashInOutType::find(array(
                    'conditions' => 'ClassId = ?0',
                    'order' => 'Deskripsi',
                    'bind' => array(0 => $param),
        ));
        if (!count($qry)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($qry as $record) {
                $records[] = [
                    'RecID' => $record->RecID,
                    'Deskripsi' => $record->Deskripsi,
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'listData' => $records
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

    public function getTipeGroupAction($param) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $records = [];
        $qry = CashInOutType::find(array(
                    'conditions' => 'GroupId = ?0',
                    'order' => 'Deskripsi',
                    'bind' => array(0 => $param),
        ));
        if (!count($qry)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($qry as $record) {
                $records[] = [
                    'RecID' => $record->RecID,
                    'Deskripsi' => $record->Deskripsi,
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'listData' => $records
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

    public function getTipeHurufAction($param) {
        $this->view->disable();
        $response = new Phalcon\Http\Response();
        $response->setContentType('application/json');
        $records = [];
        $qry = CashInOutType::find(array(
                    'conditions' => 'HurufId = ?0',
                    'order' => 'Deskripsi',
                    'bind' => array(0 => $param),
        ));
        if (!count($qry)) {
            $response->setJsonContent(array('status' => 'Not Found'));
        } else {
            foreach ($qry as $record) {
                $records[] = [
                    'RecID' => $record->RecID,
                    'Deskripsi' => $record->Deskripsi,
                ];
            }
            $response->setJsonContent(array(
                'status' => 'OK',
                'listData' => $records
                    ), JSON_NUMERIC_CHECK);
        }
        return $response;
    }

    public function tambahAction() {
        $this->view->group = CashInOutGroup::find(["order" => "RecId"]);
    }

    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->forward("cashinout");
        }

        $cashinout = new CashInOut();

        $cashinout->Cabang = $this->auth['kodeareacabang'];
        $cashinout->IDGroup = $this->request->getPost("Group");
        $cashinout->IDHuruf = $this->request->getPost("Huruf");
        $cashinout->IDClass = $this->request->getPost("Class");
        $cashinout->IDTipe = $this->request->getPost("Tipe");
        $cashinout->Tanggal = $this->request->getPost("Tanggal");
        $cashinout->Nominal = substr($this->request->getPost("Nominal", "int"), 0, -2);
        $cashinout->Description = $this->request->getPost("Description");
        $cashinout->CreatedBy = $this->auth['username'];
        $cashinout->CreatedAt = date('Y-m-d H:i:s');


        if (!$cashinout->save()) 
        {
            ?>
            <meta http-equiv='refresh' content='0; url=index'>
            <script type="text/javascript">
                alert("Data Gagal disimpan pastikan jaringan anda stabil...!!!");
            </script>
            <?php
        }
        else
        {
            ?>
            <meta http-equiv='refresh' content='0; url=index'>
            <script type="text/javascript">
                alert("Data Cash In Out Berhasil Disimpan...!!!");
            </script>
            <?php
        }
    }

    /* fungsi dropdown
    public function gettipeAction($group = 0) {
        $this->view->disable();
        $tipe = CashInOutType::query()
                ->columns("CashInOutType.*")
                ->join("CashInOutTypeClass", "CashInOutType.ClassId = c.RecId", "c")
                ->join("CashInOutGroup", "c.GroupId = d.RecId", "d")
                ->where("d.RecId = :group:")
                ->orderBy("CashInOutType.RecId")
                ->bind(["group" => $this->filter->sanitize($group, "int")])
                ->execute();
        echo "<option value=\"\">---</option>";
        if (!count($tipe)) {
            return;
        }
        foreach ($tipe as $rec) {
            echo "<option value=\"" . $rec->RecId . "\">" . $rec->Description . "</option>";
        }
    }
    */
    public function hapusAction($id)
    {
        $result = CashInOut::findFirstByRecId($id);
        
        if (!$result->delete())
        {
            $this->flash->success("Data cash in out gagal dihapus");
            return $this->forward('cashinout');
        }
        else
        {
            $this->flash->success("Data cash in out berhasil dihapus");
            return $this->forward('cashinout');
        }
    }

    public function editAction($id)
    {
        $result = CashInOut::findFirstByRecId($id);
        $this->view->RecId = $result->RecId;
        $this->view->IDGroup = $result->IDGroup;
        $this->view->IDHuruf = $result->IDHuruf;
        $this->view->IDClass = $result->IDClass;
        $this->view->IDTipe = $result->IDTipe;
        $this->view->Tanggal = $result->Tanggal;
        $this->view->Nominal = $result->Nominal;
        $this->view->Description = $result->Description;
        $this->view->group = CashInOutGroup::find(["order" => "RecId"]);
        $TipeId = CashInOutType::findFirstByRecID($result->IDTipe);
        $ClassId = CashInOutTypeClass::findFirstByRecId($result->IDClass);
        $HurufId = CashInOutHuruf::findFirstByRecID($result->IDHuruf);
        $this->view->TipeId = $TipeId->Deskripsi;
        $this->view->ClassId = $ClassId->ClassName;
        $this->view->HurufId = $HurufId->Deskripsi;
    }
    
    public function updateAction()
    {
        $id = $this->request->getPost("RecId");
        $cashinout = cashinout::findFirstByRecId($id);
        $cashinout->Cabang = $this->auth['kodeareacabang'];
        $cashinout->IDGroup = $this->request->getPost("Group");
        $cashinout->IDHuruf = $this->request->getPost("Huruf");
        $cashinout->IDClass = $this->request->getPost("Class");
        $cashinout->IDTipe = $this->request->getPost("Tipe");
        $cashinout->Tanggal = $this->request->getPost("Tanggal");
        $cashinout->Nominal = substr($this->request->getPost("Nominal", "int"), 0, -2);
        $cashinout->Description = $this->request->getPost("Description");
        $cashinout->CreatedBy = $this->auth['username'];
        if (!$cashinout->save())
        {
            ?>
            <meta http-equiv='refresh' content='0; url=index'>
            <script type="text/javascript">
                alert("Data Gagal diubah pastikan jaringan anda stabil...!!!");
            </script>
            <?php
        }
        else
        {
            ?>
            <meta http-equiv='refresh' content='0; url=index'>
            <script type="text/javascript">
                alert("Data Cash In Out Berhasil Diubah...!!!");
            </script>
            <?php
        }
        
        
    }

}