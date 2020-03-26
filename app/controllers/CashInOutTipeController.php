<?php
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CashInOutTipeController extends ControllerBase
{
	public function initialize() {
        $this->tag->setTitle("Cash In / Out Cabang");
        parent::initialize();        

        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    
    }

    public function indexAction()
    {
    	$numberPage = 1;
        if(!$this->request->isPost()){
            $numberPage = $this->request->getQuery("page", "int");
        }

        $laporan =  CashInOutType::query()
                ->columns(array("COALESCE(CashInOutGroup.GroupName,'Tidak ada') as GroupName, COALESCE(CashInOutHuruf.Deskripsi,'Tidak ada') as HurufName, COALESCE(CashInOutTypeClass.ClassName,'Tidak ada') as ClassName, CashInOutType.Deskripsi as TipeName, CashInOutType.RecID, IIF(Status = 1, 'Aktif', 'Tidak Aktif') As Status"))
                ->leftJoin("CashInOutGroup", "CashInOutType.GroupId = CashInOutGroup.RecId")
                ->leftJoin("CashInOutHuruf", "CashInOutType.HurufId = CashInOutHuruf.RecID")
                ->leftJoin("CashInOutTypeClass", "CashInOutType.ClassId =CashInOutTypeClass.RecId")
                ->orderBy("CashInOutType.RecId DESC")
                ->execute();

        $paginator = new Paginator(array(
                    "data" => $laporan,
                    "limit" => 10,
                    "page" => $numberPage
                ));

        $this->view->page = $paginator->getPaginate();

    }
	
	public function createAction()
	{
		if (!$this->request->isPost()) {
            return $this->forward("CashInOutType");
        }
        $IDGroup = $this->request->getPost("Group");
        $IDHuruf = $this->request->getPost("Huruf");
        $IDClass = $this->request->getPost("Class");

        $CashInOutType = new CashInOutType();
        $CashInOutType->RecID = $this->request->getPost("KodeTipe");
        /*
        if (!empty($IDGroup && empty($IDHuruf) && empty($IDClass))) {
        */
        $CashInOutType->GroupId = $this->request->getPost("Group");
        /*
        }
        elseif (!empty($IDGroup && !empty($IDHuruf) && empty($IDClass))) {
        */
        $CashInOutType->HurufId = $this->request->getPost("Huruf");
        /*
        }
        elseif (!empty($IDGroup && !empty($IDHuruf) && !empty($IDClass))) {
        */
        $CashInOutType->ClassId = $this->request->getPost("Class");
        /*
        }
        */
        $CashInOutType->CashInOutCode = $this->request->getPost("KodeUnix");
        $CashInOutType->Deskripsi = $this->request->getPost("Tipe");
        $CashInOutType->Status = 1;
        $CashInOutType->Create_at = date('Y-m-d H:i:s');


        if (!$CashInOutType->save()) 
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
	  
	public function tambahAction()
	{
		$sql = "SELECT TOP 1 CONVERT(int,(replace(RecID,'TP-','')))+1 as NoUrut, SUBSTRING('0000', 1, len('0000') - len(CONVERT(int,(replace(RecID,'TP-','')))+1)) + CONVERT(varchar,(replace(RecID,'TP-',''))+1) as IdBaru FROM CashInOutType order by NoUrut desc";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $numRows = $query->numRows();
        $result = $query->fetchAll($query);
        
        if($numRows>0){
            foreach($result as $row) {
                $kd = $row->IdBaru;
                $Kode = $row->IdBaru;
            }
        }else{
            $kd = '0001';
            $Kode = '0001';
        }
        $this->view->IdBaru = 'TP-'.$kd;
        $this->view->KodeUnix = 'EXP'.$Kode;
        $this->view->group = CashInOutGroup::find(["order" => "RecId"]);
	}
	
	public function hapusAction($id)
    {
        $result = CashInOutType::findFirstByRecID($id);
        
        if (!$result->delete())
        {
            $this->flash->success("Data cash in out Item gagal dihapus");
            return $this->forward('CashInOutTipe');
        }
        else
        {
            $this->flash->success("Data cash in out item berhasil dihapus");
            return $this->forward('CashInOutTipe');
        }
    }

    public function editAction($id)
    {
        $result = CashInOutType::findFirstByRecID($id);
        $this->view->RecID = $result->RecID;
        $this->view->Deskripsi = $result->Deskripsi;
        $this->view->Status = $result->Status;
        $this->view->IdGroup = $result->GroupId;
        $this->view->Group = CashInOutGroup::find(["order" => "RecId"]);
        $ClassId = CashInOutTypeClass::findFirstByRecId($result->ClassId);
        $HurufId = CashInOutHuruf::findFirstByRecID($result->HurufId);
        $this->view->ClassId = $ClassId->ClassName;
        $this->view->HurufId = $HurufId->Deskripsi;
    }
    
    public function updateAction()
    {
        $id = $this->request->getPost("kode");
        $CashInOutType = CashInOutType::findFirstByRecID($id);
        $CashInOutType->GroupId = $this->request->getPost("Group");
        $CashInOutType->HurufId = $this->request->getPost("Huruf");
        $CashInOutType->ClassId = $this->request->getPost("Class");
        $CashInOutType->CashInOutCode = $this->request->getPost("KodeUnix");
        $CashInOutType->Deskripsi = $this->request->getPost("Deskripsi");
        $CashInOutType->Status = '1';
        $CashInOutType->Create_at = date('Y-m-d H:i:s');
        if (!$CashInOutType->save())
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
                alert("Data Cash In Out Item Berhasil Diubah...!!!");
            </script>
            <?php
        }
	}
	
}