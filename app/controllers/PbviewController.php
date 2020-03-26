<?php

use Phalcon\Mvc\Model\Criteria;

class PbviewController extends ControllerBase
{

    protected $auth;

    public function initialize() {
        $this->tag->setTitle("Inquiry Pembayaran");
        parent::initialize();
        if ($this->session->has("auth")) {
            $this->auth = $this->session->get("auth");
            $this->_validateSession($this->auth);
        }
    }

    public function indexAction()
    {
        $this->view->cabang = Areacabang::find(['Area IS NOT NULL', 'order' => 'KodeAreaCabang']);
    }

    public function viewAction() {
        if (!$this->request->isPost()) {
            return $this->forward('pbview/index');
        }
        $cabangId = $this->request->getPost('Cabang', 'int');
        $siswatxt = $this->request->getPost('Siswa');
        $query = Criteria::fromInput($this->di, 'Siswa', ['Cabang' => $cabangId]);
        if ($siswatxt) {
            $query->andWhere("VirtualAccount LIKE :vacc: OR NamaSiswa LIKE :name:",
                    ['vacc' => '%'.$siswatxt.'%', 'name' => '%'.$siswatxt.'%']);
        }
        $siswa = Siswa::find($query->getParams());
        if (count($siswa) == 0) {
            $this->flash->notice('Tidak ada data siswa ditemukan');
            return $this->forward('pbadmin/index');
        }
        $siswaid = [];
        foreach ($siswa as $rec) {
            $siswaid[] = $rec->RecID;
        }
        $this->view->cabang = Areacabang::findFirst($cabangId);
        $this->view->pembayaran = $this->modelsManager->createBuilder()
                ->columns([
                    's.VirtualAccount AS KodeSiswa', 's.NamaSiswa',
                    'p.NamaProgram AS Program', 'pb.RecID AS Pembayaran',
                    'pb.JumlahTotal', 'pb.JatuhTempo', 'pb.PembayaranTipe',
                    'pb.AngsuranKe', 'pb.SisaPembayaran'])
                ->addFrom('Siswa', 's')
                ->join('Programsiswa', 's.RecID = ps.Siswa', 'ps')
                ->join('Pembayaran', 'ps.RecID = pb.ProgramSiswa', 'pb')
                ->join('Program', 'ps.Program = p.RecID', 'p')
                ->inWhere('s.RecID', $siswaid)
                ->orderBy(['p.RecID', 'KodeSiswa'])
                ->getQuery()->execute()
                ->setHydrateMode(Phalcon\Mvc\Model\Resultset::HYDRATE_OBJECTS);
        $this->tag->setDefault('Cabang', $cabangId);
        $this->tag->setDefault('Siswa', $siswatxt);
    }

    public function detailAction() {
        if (!$this->request->isPost()) {
            return $this->forward('pbview/index');
        }
        $RecID = $this->request->getPost('RecID', 'int');
        $pembayaran = Pembayaran::findFirstByRecID($RecID);
        if ($pembayaran === FALSE) {
            $this->flash->error('Pembayaran tidak ditemukan');
            return $this->forward('pbview/detail');
        }
        $siswa = $pembayaran->Programsiswa->getObjSiswa();

        $this->view->pb = $pembayaran;
        $this->view->pd = $pembayaran->Pembayarandetail;
        $this->view->s = $siswa;
        $this->view->c = $siswa->Areacabang;
        $this->view->program = $pembayaran->Programsiswa->P;
        $this->view->cabang = $this->request->getPost('Cabang', 'int');
        $this->view->siswa = $this->request->getPost('Siswa');
    }

    public function creditNoteAction() {
        if (!$this->request->isPost()) {
            return $this->forward('pbview/index');
        }
        $RecID = $this->request->getPost('RecID', 'int');
        $pembayaran = Pembayaran::findFirstByRecID($RecID);
        if ($pembayaran === FALSE) {
            $this->flash->error('Pembayaran tidak dapat ditemukan');
            return $this->forward('pbadmin/detail');
        }
        if (!$this->_insertCreditNoteTx($pembayaran)) {
            $this->flash->error('Transaksi Diskon Khusus Gagal');
        }
        return $this->forward('pbview/detail');
    }

    public function voidAction() {
        if (!$this->request->isPost()) {
            return $this->forward('pbview/index');
        }
        $pbdetail = Pembayarandetail::findFirstByRecID($this->request->getPost('Pbdetail'));
        if ($pbdetail === FALSE) {
            $this->flash->error('Detil Pembayaran tidak dapat ditemukan');
            return $this->forward('pbadmin/detail');
        }
        if (!$this->_insertVoidTx($pbdetail)) {
            $this->flash->error('Transaksi void gagal');
            return $this->forward('pbview/detail');
        }
        $pbdetail->Status = Pembayarandetail::ST_VOID;
        if (!$pbdetail->save()) {
           $this->flash->error('Detil Pembayaran tidak dapat di update');
        }
        return $this->forward('pbview/detail');
    }

    public function editAction() {
        if (!$this->request->isPost()) {
            return $this->forward('pbview/index');
        }
        $bimbingan = substr($this->request->getPost('Bimbingan', 'int'),0,-2);
        $jatuhtempo = $this->request->getPost('JatuhTempo', 'int') ? : NULL;
        $recid = $this->request->getPost('RecID', 'int');
        $pb = Pembayaran::findFirstByRecID($recid);
        $diff = ($bimbingan - $pb->BiayaBimbingan);
        $date = $jatuhtempo ? date('Y-m-d', strtotime($jatuhtempo)) : $pb->JatuhTempo;
        try {
            if ($this->_updatePembayaran($pb, $diff, $date)) {
                $this->flash->success('Update Pembayaran Berhasil');
            } else {
                $this->flash->error('Update Pembayaran Gagal..');
            }            
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->forward('pbview/detail');
    }

    public function chdateAction() {
        if (!$this->request->isPost()) {
            return $this->forward('pbview/index');
        }
        $date = $this->request->getPost('TanggalPembayaran', 'int');
        $recid = $this->request->getPost('Pbdetail', 'int');
        $detail = Pembayarandetail::findFirstByRecID($recid);
        if ($detail === FALSE) {
            $this->flash->error('Detil Pembayaran Tidak Ditemukan');
            return $this->forward('pbview/detail');
        }
        $detail->TanggalPembayaran = $date;
        if (!$detail->save()) {
            $this->flash->error('Detil Pembayaran Tidak Dapat Disimpan');
            return $this->forward('pbview/detail');
        }
        return $this->forward('pbview/detail');
    }

    public function receiptAction() {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $detailPembayaran = Pembayarandetail::findFirstByRecID($this->request->getPost('RecID'));
        $pembayaran = Pembayaran::findFirstByRecID($detailPembayaran->Pembayaran);
        $cabang = Areacabang::findFirst($this->request->getPost('Cabang'));
        $programsiswa = Programsiswa::findFirst($pembayaran->ProgramSiswa);
        $siswa = Siswa::findFirstByRecID($programsiswa->Siswa);
        $tanggalBayar = new DateTime($detailPembayaran->TanggalPembayaran);
        $jatuhTempo = new DateTime($detailPembayaran->TanggalJatuhTempo);

        // loop to create copy's
        $data = [];
        for ($i = 0; $i < 3; $i++) {
            $dataReport = [];
            $dataReport["documentno"] = $detailPembayaran->DocumentNo;
            $dataReport["cabang"] = $cabang->KodeAreaCabang . " - " . $cabang->NamaAreaCabang;
            $dataReport["nosiswa"] = $cabang->KodeAreaCabang . $siswa->VirtualAccount;
            $dataReport["tanggal"] = strftime('%d %B %Y', $tanggalBayar->getTimestamp());
            $dataReport["namasiswa"] = $siswa->NamaSiswa;
            $dataReport["jumlahuang"] = $detailPembayaran->Jumlah;
            $dataReport["bayaruntuk"] = $detailPembayaran->PembayaranUntuk;
            $dataReport["sisabayar"] = $detailPembayaran->SisaPembayaran;
            $dataReport["terbilang"] = $this->terbilang($detailPembayaran->Jumlah) . " Rupiah";
            $dataReport["jatuhtempo"] = strftime('%d %B %Y', $jatuhTempo->getTimestamp());
            $dataReport["now"] = strftime('%d %B %Y');
            $dataReport["location"] = $cabang->KotaModel->NamaKotaKab;
            $dataReport["program"] = $programsiswa->getProgram();
            
            $data[$i] = $dataReport;
        }
        $this->view->partial('pembayaran/receipt',['data' => $data]);
    }

    private function _updatePembayaran(Pembayaran $pb, $diff, $date) {
        $sum = 0; $rc = TRUE;
        $pb->JumlahTotal += $diff;
        $pb->JatuhTempo = $date;
        foreach ($pb->Pembayarandetail as $pd) {
            $sum += $pd->Jumlah;
            $pd->SisaPembayaran = $pb->JumlahTotal - $sum;
            $pd->JatuhTempo = $date;
            $rc &= $pd->save();
        }
        $pb->SisaPembayaran = $pb->JumlahTotal - $sum;
        $rc &= $pb->save();
        return $rc;
    }

    private function _insertVoidTx(Pembayarandetail $pd) {
        $pdvoid = new Pembayarandetail();
        $pdvoid->DocumentNo = $this->getDocumentNo($pd, 'PB');
        $pdvoid->Jumlah = -(abs($pd->Jumlah));
        $pdvoid->NoReferensi = join('-', [Pembayarandetail::ST_VOID, $pd->DocumentNo]);
        $pdvoid->Pembayaran = $pd->Pembayaran;
        $pdvoid->PembayaranMetode = $pd->PembayaranMetode;
        $pdvoid->PembayaranUntuk = $pd->PembayaranUntuk;
        $pdvoid->TanggalPembayaran = date('Y-m-d');
        // Calculate Sisa Pembayaran
        $pb = $pdvoid->Pb;
        $pdvoid->SisaPembayaran = $pb->SisaPembayaran - $pdvoid->Jumlah;
        $pb->SisaPembayaran = $pdvoid->SisaPembayaran;
        if ($pdvoid->save() && $pb->save()) {
            return TRUE;
        }
        return FALSE;
    }
    
    private function _insertCreditNoteTx(Pembayaran $pb) {
        $metode = Pembayaranmetode::findFirst(['Parameter = ?0', 'bind' => [0 => 'CN']]);
        if ($metode === FALSE) {
            $this->flash->error('Diskon khusus belum diaktifkan');
            return FALSE;
        }
        $pdcn = new Pembayarandetail();
        $pdcn->DocumentNo = $this->getDocumentNo(NULL, 'PB');
        $pdcn->Jumlah = substr($this->request->getPost('Jumlah', 'int'),0,-2);
        $pdcn->NoReferensi = $this->request->getPost('NoReferensi');
        $pdcn->TanggalPembayaran = $this->request->getPost('TanggalPembayaran', 'int');
        $pdcn->Keterangan = $this->request->getPost('Keterangan');
        $pdcn->Pembayaran = $pb->RecID;
        $pdcn->PembayaranMetode = $metode->MetodeId;
        $pdcn->PembayaranUntuk = Pembayarandetail::PB_BIMBINGAN;
        // Calculate Sisa Pembayaran
        $pdcn->SisaPembayaran = $pb->SisaPembayaran - $pdcn->Jumlah;
        $pb->SisaPembayaran = $pdcn->SisaPembayaran;
        if ($pdcn->save() && $pb->save()) {
            return TRUE;
        }
        return FALSE;
    }

    private function _validateSession($auth) {
        if ($auth['areacabang'] != 0) {
            return $this->forward('index/index');
        }
    }
}

