<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class InquirybankController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
	
	
    {
		
	 $phql = "update transaksibank set KodeCabang=mesin.KodeCabang from transaksibank
				join mesin on  term_id=mesin.KodeMesin ";

            $ret = $this->db->query($phql);
			
				 $phq = "update transaksibank set Siswa=programsiswa.Siswa from pembayarandetail join pembayaran  on pembayaran.RecID=
pembayarandetail.Pembayaran join programsiswa on programsiswa.RecID=pembayaran.ProgramSiswa
  where pembayarandetail.AuthCd=transaksibank.Auth_Cd and transaksibank.Siswa is null ";

            $re = $this->db->query($phq);
		
		$this->tag->setTitle("Prima Edu | Inquiry Transaksi Bank");
		
		$numberPage = $this->request->getQuery("page", "int");
		$numberPage = isset($numberPage) ? $numberPage : 1;
		
		$usePost = $this->request->getQuery("use", "int");
		$usePost = isset($usePost) ? $usePost : 0;
		$this->view->setVar("use",$usePost);
		
		if($usePost=="0")$this->persistent->parameters = null;
		
		$pembayaran=null;
		
		if ($this->request->isPost())$this->persistent->parameters=$_POST;
		
        if ($this->persistent->parameters!=null) {

			if($this->persistent->parameters['Bank']=="" AND $this->persistent->parameters['Tanggal']=="")
			{
				$pembayaran = Transaksibank::find();
				$this->view->setVar("judul","Transaksi bank keseluruhan");
			}
			else if($this->persistent->parameters['Bank']!="")
			{
				$pembayaran = Transaksibank::find(
					"TanggalImport = '".$this->persistent->parameters['Tanggal']."' 
					AND NamaBank='".$this->persistent->parameters['Bank']."'");
					
				$this->view->setVar("judul","Transaksi bank ".$this->persistent->parameters['Bank']." tanggal ".$this->persistent->parameters['Tanggal']);
			}
			else
			{	
				$pembayaran = Transaksibank::find(
					"TanggalImport = '".$this->persistent->parameters['Tanggal']."'");
					
				$this->view->setVar("judul","Transaksi bank ".$this->persistent->parameters['Bank']." tanggal ".$this->persistent->parameters['Tanggal']);
			}
			$this->view->setVar("use","1");
        } 
		else
		{
			$pembayaran = Transaksibank::find();
			$this->view->setVar("judul","Transaksi bank keseluruhan");
		}
					
        if (count($pembayaran) == 0) {
            $this->flash->notice("Tidak ada data pencarian");
        }

        $paginator = new Paginator(array(
            "data" => $pembayaran,
            "limit"=> 25,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
		
    }

}
