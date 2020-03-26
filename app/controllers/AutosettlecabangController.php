<?php


use Phalcon\Paginator\Adapter\NativeArray as Paginator;

class AutosettlecabangController extends ControllerBase
{
    protected $auth;

/*
   protected $sql = <<<SQL
SELECT 
       a.KodeCabang,b.NamaAreaCabang AS NamaCabang , a.NamaBank, a.TanggalTransaksi, 
	   ISNULL(CAST(a.WaktuTransaksi as varchar), '-') AS [WaktuTransaksi],
       a.NoReferensi, a.Nominal, 
	   (CASE WHEN a.RefRecID is not null THEN 'Settled' ELSE 'Unsettled' END) AS [Status]
FROM transaksibank a
JOIN areacabang b ON b.KodeAreaCabang = a.KodeCabang
%0
AND a.TanggalTransaksi BETWEEN '%1' AND '%2'
ORDER BY a.NoReferensi, a.TanggalTransaksi
SQL;*/

    protected $sql = <<<SQL
SELECT 
       a.KodeCabang,b.NamaAreaCabang AS NamaCabang , a.NamaBank, a.TanggalTransaksi, 
	   ISNULL(CAST(a.WaktuTransaksi as varchar), '-') AS [WaktuTransaksi],
       a.NoReferensi, a.Nominal, 
	   (CASE WHEN a.RefRecID is not null THEN 'Settled' ELSE 'Unsettled' END) AS [Status]
	   ,pd.Jumlah AS [JumlahNominal],pd.TanggalPembayaran,pm.NamaMetode,pd.RecID AS [RecID]
FROM transaksibank a
JOIN areacabang b ON b.KodeAreaCabang = a.KodeCabang
JOIN pembayarandetail pd ON a.NoReferensi = pd.NoReferensi
     AND a.Nominal = pd.Jumlah
     AND a.NamaBank = pd.NamaBank
JOIN pembayaranmetode pm ON pd.PembayaranMetode = pm.MetodeId 
AND a.RefRecID is null
ORDER BY a.NoReferensi, a.TanggalTransaksi
SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan Aktifitas Auto Settle');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
    }

    public function indexAction()
    {
/*        if (is_null($this->auth['areaparent'])) {
            if ($this->auth['areacabang']) {
                $cabang = Areacabang::find([
                    "Area = :area:", "order" => "KodeAreaCabang",
                    "bind" => ["area" => $this->auth['kodeareacabang']]
                ]);
            } else {
                $cabang = Areacabang::find([
                    "Area IS NOT NULL", "order" => "KodeAreaCabang"
                ]);
            }
            $this->view->cabang = $cabang;
        }
*/		
		
		
        $this->view->rpt_auth = $this->auth;
    
	        $numberpage = 1;
        if (!$this->request->isPost()) {
            $numberpage = $this->request->get('page', 'int');
        }
        $sql = str_replace(['%0', '%1', '%2'], $this->getParm(), $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);
        
        $paginate = new Paginator([
            "data" => $result, "limit" => 20, "page" => $numberpage
        ]);

        $this->view->rpttype = $this->getParm()[1];
        $this->view->periode =
                $this->getDateFrom('d/m/Y', $this->getParm()[1]).' - '.
                $this->getDateTo('d/m/Y', $this->getParm()[2]);
       		   $this->view->page = $paginate->getPaginate();

	
	}


    public function dataAction()
    {
        if (!$this->_validatePusat()) {
            return $this->forward('index/index');
        }
        $this->view->disable();
        $query = $this->getDI()->getShared('db')->query($this->sql);
        $query->setFetchMode(Phalcon\Db::FETCH_ASSOC);
        $this->response->setContentType('application/json');
        return $this->response->setJsonContent([
            'status' => 'OK',
            'data' => $query->fetchAll($query)
        ], JSON_NUMERIC_CHECK);
    }
   
    public function editAction($RecID)
    {

        if (!$this->request->isPost()) {

            $autosettle = pembayarandetail::findFirstByRecID($RecID);
            if (!$autosettle) {
                $this->flash->error("autosettle was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "autosettlecabang",
                    "action" => "index"
                ));
            }

            $this->view->RecID = $brand->RecID;

            $this->tag->setDefault("RecID", $autosettle->RecID);
            $this->tag->setDefault("TanggalPembayaran", $autosettle->TanggalPembayaran);
            
        }
    
        
    }
	
	
	

    public function submitAction($RecID) {
	
	        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "autosettlecabang",
                "action" => "index"
            ));
        }

        $RecID = $this->request->getPost("RecID");

        $autosettle->TanggalPembayaran = $this->request->getPost("TanggalPembayaran");

        $phql = "UPDATE pembayarandetail SET TanggalPembayaran = '{$autosettle->TanggalPembayaran}' 
		                   WHERE RecID = {$RecID}";

        $ret = $this->db->query($phql);

//        if (!$brand->save()) {
  
        if (!$ret) {

            foreach ($brand->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "autosettlecabang",
                "action" => "edit",
                "params" => array($pembayarandetail->RecID)
            ));
        }

        $this->flash->success("auto settle was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "autosettlecabang",
            "action" => "index"
        ));

    
	
	 // $brand->Nama = $this->request->getPost("Nama");

       // $phql = "UPDATE pembayarandetail SET TanggalTransaksi = '{$brand->Nama}' 
		 //                  WHERE RecID = {$RecID}";

       // $ret = $this->db->query($phql);
		
		
		//   $this->flash->success("autosettle was updated successfully");

	
	//  $this->flash->success("Coba");
	  
//	   $this->flash->success("NoReferensi");
	   
	  //  $autosettle->TanggalPembayaran = $this->request->getPost("TanggalPembayaran");

/*
        $phql = "UPDATE pd
				SET   pd.TanggalPembayaran ='{$autosettle->TanggalPembayaran}' 
				FROM transaksibank a
				JOIN areacabang b ON b.KodeAreaCabang = a.KodeCabang
				JOIN pembayarandetail pd ON a.NoReferensi = pd.NoReferensi
					 AND a.Nominal = pd.Jumlah
					 AND a.NamaBank = pd.NamaBank
				JOIN pembayaranmetode pm ON pd.PembayaranMetode = pm.MetodeId 
				WHERE pd.RecID = {$RecID}";*/
            //$phql = "UPDATE pembayarandetail SET TanggalPembayaran = '{$autosettle->TanggalPembayaran}' WHERE RecId = {$RecId}";


       // $ret = $this->db->query($phql);
	   
	    //    $this->flash->success("autosettle was updated successfully");

	
			/*
        if (!$this->request->isPost()) {
            $purchreqheader = Purchreqheader::findFirstByRecId($RecId);
            if (!$purchreqheader) {
                $this->flash->error("Permintaan pembelian tidak dapat ditemukan");
                return $this->forward('purchreqheader/index');
            }
            $purchreqheader->status = "Inreview";

            $phql = "UPDATE purchreqheader SET Status = '{$purchreqheader->status}' WHERE RecId = {$RecId}";

            $ret = $this->db->query($phql);

//        	if (!$usergroup->save()) {
            if (!$ret) {
                foreach ($purchreqheader->getMessages() as $message) {
                    $this->flash->error($message);
                }

                return $this->forward('purchreqheader/index');
            }
            $this->flash->success("Permintaan pembelian berhasil diubah");

            return $this->response->redirect("purchreqheader/search");
        }*/
    }


    public function chdateAction() {
        if (!$this->request->isPost()) {
            return $this->forward('autosettlecabang/index');
        }
        $date = $this->request->getPost('TanggalPembayaran', 'int');
        $recid = $this->request->getPost('Pbdetail', 'int');
        $detail = Pembayarandetail::findFirstByRecID($recid);
        if ($detail === FALSE) {
            $this->flash->error('Detil Pembayaran Tidak Ditemukan');
            return $this->forward('autosettlecabang/detail');
        }
        $detail->TanggalPembayaran = $date;
        if (!$detail->save()) {
            $this->flash->error('Detil Pembayaran Tidak Dapat Disimpan');
            return $this->forward('autosettlecabang/detail');
        }
        return $this->forward('autosettlecabang/detail');
    }


    public function viewAction() {
        $numberpage = 1;
        if (!$this->request->isPost()) {
            $numberpage = $this->request->get('page', 'int');
        }
        $sql = str_replace(['%0', '%1', '%2'], $this->getParm(), $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);
        
        $paginate = new Paginator([
            "data" => $result, "limit" => 20, "page" => $numberpage
        ]);

        $this->view->rpttype = $this->getParm()[1];
        $this->view->periode =
                $this->getDateFrom('d/m/Y', $this->getParm()[1]).' - '.
                $this->getDateTo('d/m/Y', $this->getParm()[2]);
       		   $this->view->page = $paginate->getPaginate();
    }

    private function getParm() {
        if ($this->request->isPost()) {
            $cabang = $this->auth['areacabang'];
            if (!$this->auth['areacabang']) {
                $cabang = $this->request->getPost('Cabang', 'int');
            }
            $areaid = $this->_validateArea($this->request->getPost('Area'));
            $cabangid = $this->_validateCabang($this->request->getPost('Cabang'));
            $where = $this->_getCriteria($areaid, $cabangid);
            $this->persistent->parameters = array(
                    $where,
                    $this->getDateFrom(),
                    $this->getDateTo()
            );
        }
        return $this->persistent->parameters;
    }

    private function getDateFrom($format = 'Y-m-d', $time = null) {
        $temp = $time ? strtotime($time) : strtotime($this->request->getPost('DateFrom', 'int'));
        return $temp === FALSE ? date($format) : date($format, $temp);
    }

    private function getDateTo($format = 'Y-m-d', $time = null) {
        $temp = $time ? strtotime($time) : strtotime($this->request->getPost('DateTo', 'int'));
        return $temp === FALSE ? date($format) : date($format, $temp);
    }

    private function _getCriteria($areaid, $cabangid) {
        $temp = "WHERE ";
        if ($areaid){
            $temp .= "a.RecID = ".$areaid;
        }
        if ($cabangid){
            $temp .= $areaid ? " AND " : "";
            $temp .= "b.RecID = ".$cabangid;
        }
        return $temp == "WHERE " ? "WHERE 1 = 1" : $temp;
    }

    private function _validateArea($areaid) {
        if ($this->auth['areaparent']) {
            return $this->auth['areaparent'];
        } else if ($this->auth['areacabang']) {
            return $this->auth['areacabang'];
        } else {
            return $areaid ? : NULL;
        }
    }

    private function _validateCabang($cabangid) {
        if ($this->auth['areaparent']) {
            return $this->auth['areacabang'];
        } else {
            return $cabangid ? : NULL;
        }
    }
}

