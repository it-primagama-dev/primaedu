<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class AutosettleController extends ControllerBase {

    protected $auth;
    
// TOC-RB 30-Jul-2015
//    protected $sql_1 = <<<SQL
//UPDATE tx SET tx.RefRecID = pd.RecID
//FROM transaksibank tx
//JOIN pembayarandetail pd ON tx.NoReferensi = pd.NoReferensi
//     AND tx.Nominal = pd.Jumlah AND tx.TanggalTransaksi = pd.TanggalPembayaran
//WHERE tx.RefRecID IS NULL AND pd.Status = '0'
//AND tx.KodeCabang LIKE '?0'
//SQL;
  protected $sql_0=<<<SQL
UPDATE pdd SET pdd.TanggalPembayaran=tx.TanggalTransaksi
FROM pembayarandetail pdd JOIN  transaksibank tx ON tx.NoReferensi = pdd.NoReferensi
 WHERE tx.RefRecID =pdd.RecID  AND tx.KodeCabang='?0' AND tx.Nominal = pdd.Jumlah 
 AND tx.NamaBank = pdd.NamaBank AND pdd.Status = '0'
SQL;

    protected $sql_1 = <<<SQL
UPDATE tx SET tx.RefRecID = settle.pd_id
FROM transaksibank tx JOIN (
    SELECT min(tx.RecID) AS tx_id, min(pd.RecID) AS pd_id
    FROM transaksibank tx
    JOIN pembayarandetail pd ON tx.NoReferensi = pd.NoReferensi
         AND tx.Nominal = pd.Jumlah
         AND tx.NamaBank = pd.NamaBank
    WHERE tx.RefRecID IS NULL  AND tx.KodeCabang='?0'
    GROUP BY tx.Nominal, tx.NoReferensi
) settle ON tx.RecID = settle.tx_id
SQL;

    protected $sql_2 = <<<SQL
UPDATE pd SET pd.Status = '1'
FROM transaksibank tx
JOIN pembayarandetail pd ON tx.RefRecID = pd.RecID
WHERE pd.Status = '0'
SQL;

    public function initialize() {
        $this->tag->setTitle('Auto Settle');
        parent::initialize();
        if ($this->session->has('auth')) {
            $this->auth = $this->session->get('auth');
        }
    }

    public function indexAction() {
        $numberPage = $this->request->getQuery("page", "int");

        $cabang = $this->auth['kodeareacabang'] ;
        $query = Transaksibank::query()
                ->where('RefRecID IS NULL');
        if ($cabang) {
            $query->andWhere('KodeCabang = ?0', [0 => $cabang]);
        }
        $txbank = $query->execute();
        $paginator = new Paginator(array(
            "data" => $txbank,
            "limit"=> 10,
            "page" => $numberPage
        ));
        
        $this->view->txbank = $paginator->getPaginate();
    }

    public function prosesAction() {

        $this->db->begin();

        $cabang = $this->auth['kodeareacabang'];
       $sql = str_replace('?0', $cabang, $this->sql_1);
        // Update Transaksibank
        if (!$this->db->execute($sql)) {
            $this->db->rollback();
            $this->flash->error('Gagal melakukan Auto Settle');
            return $this->forward('autosettle/index');
        }

        $affRow = $this->db->affectedRows();
		$this->db->execute($this->sql_0);

        // Update Pembayarandetail
        if (!$this->db->execute($this->sql_2)) {
            $this->db->rollback();
            $this->flash->error('Gagal melakukan Auto Settle');
            return $this->forward('autosettle/index');
        }
        //Check Affected Rows
        //$affRow2 = $this->db->affectedRows();
        if ($this->db->affectedRows() !== $affRow) {
            $this->db->rollback();
            $this->flash->error("Gagal melakukan Auto Settle");
            return $this->forward('autosettle/index');
        }
        $this->db->commit();

        $this->flash->success('Sukses melakukan Auto Settle sebanyak '.$affRow.' transaksi');
        return $this->response->redirect('autosettle/index');
    }

}
