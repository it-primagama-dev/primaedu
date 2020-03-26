<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class AutosettleController extends ControllerBase {

    /**
     * Index action
     */
    public function indexAction() {
        $this->tag->setTitle("Prima Edu | AutoSettle");

        $numberPage = $this->request->getQuery("page", "int");
        $numberPage = isset($numberPage) ? $numberPage : 1;

        if ($this->request->isPost()) {
            //proses edit no siswa
            $trans = Transaksibank::findFirstByRecID($this->request->getPost("recid"));
            if ($trans) {
                try {
                    $siswa = Siswa::findFirstByVirtualAccount($this->request->getPost("nosiswa"));

                    if ($siswa) {
                        $trans->Siswa = $siswa->RecID;
                        $trans->save();
                    } else
                        $this->flash->notice("Edit gagal, tidak ada siswa dengan No " . $this->request->getPost("nosiswa"));
                } catch (Exception $e) {
                    
                }
            }
        }

        $kodeCabang = $this->session->auth['kodeareacabang'];

        //print_r($this->session->auth);

        $pembayaran = null;

        //$this->flash->notice("asd".$kodeCabang);

        if ($kodeCabang == null || $kodeCabang == "0") {
            $pembayaran = Transaksibank::query()
                    ->where("RefRecID = 0 OR RefRecID IS NULL")
                    ->execute();
        } else {
            $pembayaran = Transaksibank::query()
                    ->where("(RefRecID = 0 OR RefRecID IS NULL)")
                    ->andWhere("KodeCabang ='" . $kodeCabang . "'")
                    ->execute();
        }



        if (count($pembayaran) == 0) {
            $this->flash->notice("Semua transaksi telah settle");
        }

        $paginator = new Paginator(array(
            "data" => $pembayaran,
            "limit" => 25,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    public function prosesAction() {
        $kodeCabang = $this->session->get('auth')['kodeareacabang'];

        $transMatch = null;

        if ($kodeCabang == null || $kodeCabang == "0") {

            $transMatch = $this->modelsManager->createBuilder()
                    ->columns(array('Transaksibank.RecID', 'pd.RecID AS detailID'))
                    ->from('Transaksibank')
                    ->join('Pembayarandetail', 'pd.TanggalPembayaran = Transaksibank.TanggalTransaksi AND pd.Jumlah=Transaksibank.Nominal', 'pd')
                    ->join('Pembayaran', 'pd.Pembayaran = p.RecID', 'p')
                    ->join('Siswa', 's.RecID = Transaksibank.Siswa', 's')
                    ->where('(pd.Status = "0" OR pd.Status = NULL) AND (Transaksibank.RefRecID IS NULL OR Transaksibank.RefRecID=0)')
                    ->getQuery()
                    ->execute();
        } else {
            $transMatch = $this->modelsManager->createBuilder()
                    ->columns(array('Transaksibank.RecID', 'pd.RecID AS detailID'))
                    ->from('Transaksibank')
                    ->join('Pembayarandetail', 'pd.TanggalPembayaran = Transaksibank.TanggalTransaksi AND pd.Jumlah=Transaksibank.Nominal', 'pd')
                    ->join('Pembayaran', 'pd.Pembayaran = p.RecID', 'p')
                    ->join('Siswa', 's.RecID = Transaksibank.Siswa', 's')
                    ->where('(pd.Status = "0" OR pd.Status = NULL) AND (Transaksibank.RefRecID IS NULL OR Transaksibank.RefRecID=0) AND KodeCabang ="' . $kodeCabang . '"')
                    ->getQuery()
                    ->execute();
        }



        foreach ($transMatch->toArray() as $trans) {
            $transaksiBank = Transaksibank::findFirst(array("RecID='" . $trans['RecID'] . "' AND (RefRecID=0 OR RefRecID IS NULL)"));

            if ($transaksiBank) {
                $this->db->begin();

                $transaksiBank->RefRecID = $trans['detailID'];

                if (!$transaksiBank->save()) {
                    $this->db->rollback();
                } else {
                    $pembayaranDetail = Pembayarandetail::findFirst(array("RecID='" . $trans['detailID'] . "' AND Status='0'"));

                    if ($pembayaranDetail) {
                        $pembayaranDetail->Status = '1';

                        if (!$pembayaranDetail->save()) {
                            $this->db->rollback();
                        } else {
                            $this->db->commit();
                        }
                    }
                }
            }
        }

        /*
          $menus = $this->modelsManager->createBuilder()
          ->columns(array('RecID','pd.RecID AS detailID'))
          ->from('Transaksibank')
          ->join('Pembayarandetail', 'pd.TanggalPembayaran = Transaksibank.TanggalTransaksi AND pd.Jumlah=Transaksibank.Nominal', 'pd')
          ->join('Pembayaran', 'pd.Pembayaran = p.RecID', 'p')
          ->where('pd.status = '0' AND (Transaksibank.RefRecID IS NULL OR Transaksibank.RefRecID=0)')
          ->getQuery()
          ->execute();
          $element = []; $i = 0;
          foreach ($menus->toArray() as $menu)
          {
          $element[$menu['MenuItemsGroupName']][$i] = array(
          'MenuItem' => $menu['MenuItem'],
          'ControllerName' => $menu['ControllerName'],
          'ActionName' => $menu['ActionName']
          );
          $i++;
          }
          $this->session->set('menu', $element);
         */

        return $this->dispatcher->forward(array(
                    "controller" => "autosettle",
                    "action" => "index"
        ));
    }

}
