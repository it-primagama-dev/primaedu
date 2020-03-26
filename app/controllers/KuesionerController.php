<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class KuesionerController extends ControllerBase
{
    protected $auth;
    
    public function initialize() {
        $this->tag->setTitle("Kuesioner");
        //parent::initialize();

        if($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
        }
    }

	public function indexAction()
    {
        
        $cabang=$this->auth['areacabang'];
        
        $cek= $this->modelsManager->createBuilder()
                ->columns("Jawabanbobot.IdCabang")
                ->from("Jawabanbobot")
                 ->where("Jawabanbobot.IdCabang = '$cabang' and Jawabanbobot.KuesionerKe = '2' ")
                ->getQuery()
                ->execute();

        if (count($cek) == 0) { 
             
            $this->view->setVar('user', $this->session->get('auth'));
            $cabang = Areacabang::findFirst($this->session->get('auth')['areacabang']);
            $this->view->setVar('namacabang', $cabang != FALSE ? $cabang->NamaAreaCabang : "");
            $this->view->setVar('kodecabang', $this->session->get('auth')['kodeareacabang']);
            $this->view->setVar('printTitle', '');
            

            $sql1 = "select * from kuesioner where KuesionerKe = '2'";
            $query1 = $this->getDI()->getShared('db')->query($sql1);
            $query1->setFetchMode(Phalcon\Db::FETCH_OBJ);

            $this->view->result1 = $query1->fetchAll($query1);

                
            $sql = "select * from pilihanbobot";
            $query = $this->getDI()->getShared('db')->query($sql);
            $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

            $this->view->result = $query->fetchAll($query);     
    }else{
    
            return $this->dispatcher->forward(array(
            "controller" => "Kuesioner",
            "action" => "selesai"
        ));
       
        }
	}
		
		
		

    public function selesaiAction()
    {
    	
    	if (isset($_POST["submit"]))
		//if (isset($_POST["Jawaban"]))
   		foreach($_POST['IdPertanyaan'] AS $key=>$val)
   		//foreach($_POST['Jawaban'] as $idd) 
   		{
        $id = $_POST['IdPertanyaan'][$key];
        $idd = $_POST['IdPilihan'][$key];
       // $sarann = $_POST['isisaran'];

        $kuesioner = new jawabanbobot();

        $kuesioner->IdCabang = $this->auth['areacabang'];
        $kuesioner->IdPertanyaan = $id;
        $kuesioner->IdPilihan = $idd;
        $kuesioner->saran = $this->request->getPost("saran");
        $kuesioner->CreatedAt = date('Y-m-d H:i:s');
        $kuesioner->CreatedBy = $this->auth['username'];
        $kuesioner->KuesionerKe = $this->request->getPost("KuesionerKe");
        
        $kuesioner->save();
        }

        $this->flash->success("Terimakasih...");
        return $this->dispatcher->forward(array(
            "controller" => "index",
            "action" => "kues"
        ));


    }

        public function gagalAction()
    {


    }

}