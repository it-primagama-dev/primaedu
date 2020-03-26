<?php

use Phalcon\Crypt;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PymtController
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
class PymtController extends ControllerBase {

    public function qrAction($qrCodeNumber) {
        $status = false;
        $id = 0;
        $qrCodeNumberDecoded = base64_decode($this->encrypt_decrypt('decrypt', $qrCodeNumber));
        if($qrCodeNumberDecoded){
           $id = $qrCodeNumberDecoded; 
        }

        $detailPembayaran = Pembayarandetail::findFirstByRecID($this->filter->sanitize($id, "int"));
        if($detailPembayaran){
            $status = true;
        }

        $pembayaran = Pembayaran::findFirstByRecID($detailPembayaran->Pembayaran);
        $programsiswa = Programsiswa::findFirst($pembayaran->ProgramSiswa);
        $siswa = Siswa::findFirstByRecID($programsiswa->Siswa);
        $cabang = Areacabang::findFirst($siswa->Cabang);
        $tanggalBayar = new DateTime($detailPembayaran->TanggalPembayaran);
        $jatuhTempo = new DateTime($detailPembayaran->TanggalJatuhTempo);

        $dataReport = [];
        $dataReport["documentno"] = $detailPembayaran->DocumentNo;
        $dataReport["cabang"] = $cabang->KodeAreaCabang . " - " . $cabang->NamaAreaCabang;
        $dataReport["nosiswa"] = $cabang->KodeAreaCabang . $siswa->VirtualAccount;
        //$dataReport["tanggal"] = $tanggalBayar->format("d F Y");
        $dataReport["tanggal"] = strftime('%d %B %Y', $tanggalBayar->getTimestamp());
        $dataReport["namasiswa"] = $siswa->NamaSiswa;
        $dataReport["jumlahuang"] = $detailPembayaran->Jumlah;
        $dataReport["bayaruntuk"] = $detailPembayaran->PembayaranUntuk;
        $dataReport["sisabayar"] = $detailPembayaran->SisaPembayaran;
        $dataReport["terbilang"] = $this->terbilang($detailPembayaran->Jumlah) . " Rupiah";
        //$dataReport["jatuhtempo"] = $jatuhTempo->format("d F Y");
        $dataReport["jatuhtempo"] = strftime('%d %B %Y', $jatuhTempo->getTimestamp());
        $dataReport["location"] = $cabang->KotaModel->NamaKotaKab;
        $dataReport["now"] = strftime('%d %B %Y');
        $dataReport["program"] = $programsiswa->getProgram();

        $this->view->datareport = $dataReport;
        $this->view->qrCodeNumberEncoded = $qrCodeNumber;
        $this->view->status = $status;
        $this->view->setMainView('Pymt/qr');
    }

}
