<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class GrafikkuesionerController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {

    	$sql = "SELECT b.NamaAreaCabang as Area, sum(pilihanbobot.Bobot) as TotalBobot, count(areacabang.KodeAreaCabang) as totalKues, (((sum(pilihanbobot.Bobot)*10)/count(areacabang.KodeAreaCabang)*100)/40) as NilaiArea
				from Jawabanbobot
				join areacabang on Jawabanbobot.IdCabang = areacabang.RecID
				join areacabang b on areacabang.Area = b.KodeAreaCabang
				join pilihanbobot on Jawabanbobot.IdPilihan = pilihanbobot.IdPilihan
				where jawabanbobot.kuesionerke = '1'
				group by b.NamaAreaCabang";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);

    	$sql2 = "SELECT @@ROWCOUNT as Row, b.NamaAreaCabang as Area, sum(pilihanbobot.Bobot) as TotalBobot, count(areacabang.KodeAreaCabang) as totalKues, (((sum(pilihanbobot.Bobot)*10)/count(areacabang.KodeAreaCabang)*100)/40) as NilaiArea
				from Jawabanbobot
				join areacabang on Jawabanbobot.IdCabang = areacabang.RecID
				join areacabang b on areacabang.Area = b.KodeAreaCabang
				join pilihanbobot on Jawabanbobot.IdPilihan = pilihanbobot.IdPilihan
				where jawabanbobot.kuesionerke = '2'
				group by b.NamaAreaCabang";
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result2 = $query2->fetchAll($query2);

        $this->view->result3 = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);

    }

    public function AreaAction()
    {

        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $area = $this->request->getPost("area");
        $sql = "SELECT b.NamaAreaCabang, Jawabanbobot.IdCabang, areacabang.KodeAreaCabang as KodeCabang, areacabang.NamaAreaCabang as NamaCabang,  sum(pilihanbobot.Bobot)*100/(4*COUNT(Jawabanbobot.IdCabang)) as TotalBobot, Jawabanbobot.saran from Jawabanbobot
                join areacabang on Jawabanbobot.IdCabang = areacabang.RecID
                join areacabang b on areacabang.Area = b.KodeAreaCabang
                join pilihanbobot on Jawabanbobot.IdPilihan = pilihanbobot.IdPilihan
                where b.KodeAreaCabang = '$area' and Jawabanbobot.KuesionerKe = '1'
                group by b.NamaAreaCabang, Jawabanbobot.IdCabang, areacabang.KodeAreaCabang, areacabang.NamaAreaCabang, Jawabanbobot.saran
                order by Jawabanbobot.IdCabang";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result = $query->fetchAll($query);

        $sql2 = "SELECT b.NamaAreaCabang, Jawabanbobot.IdCabang, areacabang.KodeAreaCabang as KodeCabang, areacabang.NamaAreaCabang as NamaCabang,  sum(pilihanbobot.Bobot)*100/(4*COUNT(Jawabanbobot.IdCabang)) as TotalBobot, Jawabanbobot.saran from Jawabanbobot
                join areacabang on Jawabanbobot.IdCabang = areacabang.RecID
                join areacabang b on areacabang.Area = b.KodeAreaCabang
                join pilihanbobot on Jawabanbobot.IdPilihan = pilihanbobot.IdPilihan
                where b.KodeAreaCabang = '$area' and Jawabanbobot.KuesionerKe = '2'
                group by b.NamaAreaCabang, Jawabanbobot.IdCabang, areacabang.KodeAreaCabang, areacabang.NamaAreaCabang, Jawabanbobot.saran
                order by Jawabanbobot.IdCabang";
        $query2 = $this->getDI()->getShared('db')->query($sql2);
        $query2->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->result2 = $query2->fetchAll($query2);
    }

}
