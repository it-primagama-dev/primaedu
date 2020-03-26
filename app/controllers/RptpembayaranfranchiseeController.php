<?php
 
class RptpembayaranfranchiseeController extends ReportBase
{

    protected $sql = <<<SQL
    


select Pembayaranfranchisee.KodeCabang, transaksibank.Nominal, transaksibank.TanggalTransaksi, Pembayaranfranchisee.Total, Pembayaranfranchisee.Pembayaran
from Pembayaranfranchisee
left join transaksibank on transaksibank.KodeCabang = Pembayaranfranchisee.KodeCabang
where Pembayaranfranchisee.KodeCabang = 'uuu' and NoReferensi like '%03' and len(NoReferensi) = '6'

SQL;

    public function initialize() {
        $this->tag->setTitle('Laporan pembayaran franchisee');
        parent::initialize();
        $this->view->rpt_title = 'Laporan pembayaran franchisee';
    }

    public function indexAction() {
        $this->view->area = Areacabang::find(["Area IS NULL", "order" => "NamaAreaCabang"]);
        $this->tag->setDefault('Area', $this->auth['areacabang']);
        $this->view->rpt_auth = $this->auth;
    }

    public function getcabangAction($area = 0) {
        $this->view->disable();
        $cabang = Areacabang::query()
                ->columns("c.*")
                ->join("Areacabang", "Areacabang.KodeAreaCabang = c.Area", "c")
                ->where("Areacabang.RecID = :area: AND Aktif = 1")
                ->orderBy("c.KodeAreaCabang")
                ->bind(["area" => $this->filter->sanitize($area, "int")])
                ->execute();
        echo '<option value="">---</option>';
        if (!count($cabang)) {
            return;
        }
        foreach ($cabang as $rec) {
            echo "<option value=\"" . $rec->RecID . "\">" . $rec->KodeNamaAreaCabang . "</option>";
        }
    }

    public function viewAction()
    {
        
       $date = date('Y-m-d');
        $areaid = $this->_validateArea($this->request->getPost('Area'));
        $cabangid = $this->_validatecabang($_GET["cabang"]);
        $cabang = Areacabang::findFirstByRecID($cabangid);
        
        
        $sql = str_replace(
                ['uuu'],[$cabang->KodeAreaCabang], $this->sql);
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);

        $this->view->setLayout('report');
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->periode = date('d/m/Y', strtotime($date));
        $this->view->result = $query->fetchAll($query);
        $area = Areacabang::findFirstByRecID($areaid);
        $this->view->rpt_area = $areaid ? $area->NamaAreaCabang : 'All';
        $cabang = Areacabang::findFirstByRecID($cabangid);
        $this->view->rpt_cabang = $cabangid ? $KodeNamaAreaCabang : 'all';

    }
}
