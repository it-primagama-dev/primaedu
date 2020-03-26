<?php
  
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PembagiandanaController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle("Pembagian Dana");
        parent::initialize();
    }

    /**
     * Index action
     */
    public function indexAction() {
         $phql = "update transaksibank set KodeCabang=mesin.KodeCabang from transaksibank
                join mesin on  term_id=mesin.KodeMesin ";
        $ret = $this->db->query($phql);
        $phq = "update transaksibank set Siswa=programsiswa.Siswa from pembayarandetail join pembayaran  on pembayaran.RecID=
                pembayarandetail.Pembayaran join programsiswa on programsiswa.RecID=pembayaran.ProgramSiswa
                where pembayarandetail.AuthCd=transaksibank.Auth_Cd and transaksibank.Siswa is null ";
        $re = $this->db->query($phq);
        
        $be ="update pembayarandetail set Status='1' from pembayarandetail join pembayaran  on pembayaran.RecID=
                pembayarandetail.Pembayaran join programsiswa on programsiswa.RecID=pembayaran.ProgramSiswa
                  join transaksibank on pembayarandetail.AuthCd=transaksibank.Auth_Cd and (pembayarandetail.Status
                  is null or  pembayarandetail.Status='')";
        $be = $this->db->query($be);
    /** 
        $nore ="update transaksibank set NoVA=pembayarandetail.NoReferensi from pembayarandetail
                     where pembayarandetail.AuthCd=transaksibank.Auth_Cd and transaksibank.NoReferensi is null";
        $nore = $this->db->query($nore);
    */
        
        
        $numberPage = $this->request->getQuery("page", "int");
        $numberPage = isset($numberPage) ? $numberPage : 1;

            $date = $this->request->getPost('Tanggal' ,'int');
            $bank = $this->request->getPost('Bank');
            $this->tag->setDefault('Bank', $bank);
            $this->view->date = isset($date) ? $date : date('Y-m-d');

        if ($this->request->isPost()) {
            $resultset = $this->getTransaksi($date, $bank);

            if ($resultset->count() == 0) {
                $this->flash->notice("Tidak ada transaksi dari bank " . $bank . " pada tanggal " . $date);
                return;
            }
            $this->flash->success("Summary transaksi dari bank " . $bank . " pada tanggal " . $date);
            $this->view->trans = $resultset;
            $this->view->link89 = $this->url->get("pembagiandana/download90/" . $bank . "/" . date("Ymd", strtotime($date)));
            $this->view->link89edc = $this->url->get("pembagiandana/download90edc/" . $bank . "/" . date("Ymd", strtotime($date)));
            $this->view->link89edcbri = $this->url->get("pembagiandana/download90edcbri/" . $bank . "/" . date("Ymd", strtotime($date)));
            $this->view->link89nonbca = $this->url->get("pembagiandana/download90nonbca/" . $bank . "/" . date("Ymd", strtotime($date)));
            $this->view->link11 = $this->url->get("pembagiandana/download10/" . $bank . "/" . date("Ymd", strtotime($date)));
            $this->view->link11edc = $this->url->get("pembagiandana/download10edc/" . $bank . "/" . date("Ymd", strtotime($date)));
            $this->view->link11edcbri = $this->url->get("pembagiandana/download10edcbri/" . $bank . "/" . date("Ymd", strtotime($date)));
        }
    }

    //$tgl formatnya yyyymmdd
    public function download90nonbcaAction($bank, $tgl) {
        $this->view->disable();
        $contentType = $bank == "BCA" ? "text/plain" : "text/csv";
        $fileName = $bank == "BCA" ? "BCA_90_" . $tgl . "_NONBCA.txt" : "MANDIRI_90_" . $tgl . ".csv";
        $rekeningDebet = $bank == "BCA" ? $this->getRekeningOperasional("BCA") : $this->getRekeningOperasional("MANDIRI");
        $prefix = $bank == "BCA" ? $this->getPrefix("BCA") : $this->getPrefix("MANDIRI");

        $contentFile = "";
        $resultset = $this->getTransaksi(date("Y-m-d", strtotime($tgl)), $bank, 2);

        if ($bank == "BCA") {
            $total = 0;
            foreach ($resultset as $rec) {
                $total += $rec->jumlah89;
            }
            $total = number_format($total, 2, '.', ''); //buat selalu 2 angka dibelakang koma
            //generate header
            $contentFile = "0MP" .
                    // --- TOC-RB @2015-08-19, REF : KITTY
                    //$tgl . // tgl format yyyymmdd
                    str_pad(NULL, 8) .
                    // END TOC-RB @2015-08-19
                    str_pad($rekeningDebet, 10, " ") . // rekening yg akan didebet (data darimana???)
                    " " .
                    str_pad($prefix, 8, " ") . // kode perusahaan (data darimana???)
                    "        " . //Company code 8 karakter                  
                    "       " . //Company code 7 karakter
                    
                    "0000" . // emang formatnya 4 angka nol
                    str_pad(substr($total, 0, strlen($total) - 3), 13, "0", STR_PAD_LEFT) . // total dana yang akan ditransfer (tanpa nilai pecahan)
                    "." .
                    substr($total, strlen($total) - 2, 2) . // total dana yang akan ditransfer (2 digit belakang koma aja)
                    str_pad($resultset->count(), 5, "0", STR_PAD_LEFT) . // jumlah record yang akan ditransfer
                    "LLG" . // Jenis transfer, BCA jika sesama BCA (benar nggak ???)
                    "               " . //emang diisi spasi 15 karakter
                    "                  " . //isi berita 1 sebanyak 18 karakter
                    "                  " . //isi berita 2 sebanyak 18 karakter
                    "                                                       " .//filler  18     
                    str_pad("", 77, " ") . //emang diisi spasi sebanyak 77 karakter
                    PHP_EOL;

            foreach ($resultset as $trans) {
                $nominal = number_format($trans->jumlah89, 2, '.', '');

                $contentFile.="1" .
                        str_pad($trans->reknonbca, 16, " ") . // rekening yg akan dikredit
                        "                  " . //emang diisi spasi sebanyak 18 karakter
                        "                  " . //filler

                        "0000" . // emang formatnya 4 angka nol
                        str_pad(substr($nominal, 0, strlen($nominal) - 3), 13, "0", STR_PAD_LEFT) . // jumlah dana yang akan ditransfer (tanpa nilai pecahan)
                        "." .
                        substr($nominal, strlen($nominal) - 2, 2) . // jumlah dana yang akan ditransfer (2 digit belakang koma aja)
                        substr(str_pad($trans->namanonbca, 35, " "),0,35) . //nama rekening penerima sebanyak 35 karakter (dapat darimana????)
                        "                                   " . //spasi sebanyak 36 karakter
                        "N" . //LLG=N
                        "      " . // spasi sebanyak 6 karakter
                        substr(str_pad($trans->kodebank, 7, " "),0,7) . //sandi BI bank yang dituju sebanyak 7 karakter, spasi jika sesama BCA (bener nggak???)
                        "    " . //emang diisi spasi sebanyak 4 karakter
                        substr(str_pad($trans->namabank, 18, " "),0,18) . //nama bank yang dituju sebanyak 18 karakter, spasi jika sesama BCA (bener nggak???)
                        "                  " . //nama cabang bank yang dituju sebanyak 18 karakter, spasi jika sesama BCA
                        "                  " . //isi berita 1 sebanyak 18 karakter
                        "                  " . //isi berita 2 sebanyak 18 karakter
                        "                  " . //filler sebanyak 18 karakter
                        "1" . //1=perorangan
                        "R" . //R=penduduk
                        "888" . //014=BCA,888=NOn BCA
                        PHP_EOL;
            }
        }
        $this->response->setHeader("Content-Type", $contentType);
        $this->response->setHeader("Content-Disposition", 'attachment; filename="' . $fileName . '"');
        $this->response->setContent($contentFile);
        return $this->response;
    }
    //$tgl formatnya yyyymmdd
    public function download90Action($bank, $tgl) {
        $this->view->disable();
        $contentType = $bank == "BCA" ? "text/plain" : "text/csv";
        $fileName = $bank == "BCA" ? "BCA_90_" . $tgl . ".txt" : "MANDIRI_90_" . $tgl . ".csv";
        $rekeningDebet = $bank == "BCA" ? $this->getRekeningOperasional("BCA") : $this->getRekeningOperasional("MANDIRI");
        $prefix = $bank == "BCA" ? $this->getPrefix("BCA") : $this->getPrefix("MANDIRI");

        $contentFile = "";
        $resultset = $this->getTransaksi(date("Y-m-d", strtotime($tgl)), $bank, 1);

        if ($bank == "BCA") {
            $total = 0;
            foreach ($resultset as $rec) {
                $total += $rec->jumlah89;
            }
            $total = number_format($total, 2, '.', ''); //buat selalu 2 angka dibelakang koma
            //generate header
            $contentFile = "0SP" .
                    // --- TOC-RB @2015-08-19, REF : KITTY
                    //$tgl . // tgl format yyyymmdd
                    str_pad(NULL, 8) .
                    // END TOC-RB @2015-08-19
                    str_pad($rekeningDebet, 10, " ") . // rekening yg akan didebet 
                    " " .   //filler
                    str_pad($prefix, 8, " ") . // kode perusahaan (data darimana???)
                    "        " . //Company code 8 karakter
                    "       " . //Company code 7 karakter
                    "0000" . // emang formatnya 4 angka nol
                    str_pad(substr($total, 0, strlen($total) - 3), 13, "0", STR_PAD_LEFT) . // total dana yang akan ditransfer (tanpa nilai pecahan)
                    "." .
                    substr($total, strlen($total) - 2, 2) . // total dana yang akan ditransfer (2 digit belakang koma aja)
                    str_pad($resultset->count(), 5, "0", STR_PAD_LEFT) . // jumlah record yang akan ditransfer
                    "BCA" . // Transfer Type BCA/LLG/RTG
                    "               " . //emang diisi spasi 15 karakter
                    "                  " . //isi berita 1 sebanyak 18 karakter
                    "                  " . //isi berita 2 sebanyak 18 karakter
                    str_pad("", 132, " ") . //emang diisi spasi sebanyak 132 karakter
                    PHP_EOL;

            foreach ($resultset as $trans) {
                $nominal = number_format($trans->jumlah89, 2, '.', '');

                $contentFile.="1" . // record type
                        str_pad($trans->rekbca, 16, " ") . // credit account
//                        str_pad("", 18, " ") . //filler
//                      str_pad("", 17.2, " ") . //credit amount
                        "                  " . //filler 18
                        "                  " . //filler 18
                        "0000" . // emang formatnya 4 angka nol
                        str_pad(substr($nominal, 0, strlen($nominal) - 3), 13, "0", STR_PAD_LEFT) . // jumlah dana yang akan ditransfer (tanpa nilai pecahan)
                        "." .
                        substr($nominal, strlen($nominal) - 2, 2) . // jumlah dana yang akan ditransfer (2 digit belakang koma aja)
                        substr(str_pad($trans->namabca, 35, " "),0,35) . //nama rekening penerima sebanyak 35 karakter (dapat darimana????)
                        str_pad("", 6, " ") . //Transfer type
                        str_pad("", 1, " ") . //filler
                        str_pad("", 7, " ") . //BI Code
                        str_pad("", 4, " ") . //filler
                        str_pad("", 18, " ") . //Bank Name
                        str_pad("", 18, " ") . //Receive Bank
                        str_pad("", 18, " ") . //Remark1
                        str_pad("", 18, " ") . //Remark2
                        str_pad("", 18, " ") . //Filler
                        str_pad("", 1, " ") . //Cust type
                        str_pad("", 1, " ") . //Status penduduk
                        str_pad("", 35, " ") . //filler
                        "014" . //diisi 014 jika sesama BCA, diisi 888 jika ke bank lain (bener nggak???)
                        PHP_EOL;
            }
        }
        $this->response->setHeader("Content-Type", $contentType);
        $this->response->setHeader("Content-Disposition", 'attachment; filename="' . $fileName . '"');
        $this->response->setContent($contentFile);
        return $this->response;
    }
    
    
    
    //Import EDC
     public function download90edcAction($bank, $tgl) {
        $this->view->disable();
        $contentType = $bank == "CardBCA" ? "text/plain" : "text/csv";
        $fileName = $bank == "CardBCA" ? "BCA_90_" . $tgl . "_EDC.txt" : "MANDIRI_90_" . $tgl . ".csv";
        $rekeningDebet = $bank == "CardBCA" ? $this->getRekeningOperasional("CardBCA") : $this->getRekeningOperasional("MANDIRI");
        $prefix = $bank == "CardBCA" ? $this->getPrefix("CardBCA") : $this->getPrefix("MANDIRI");

        $contentFile = "";
        $resultset = $this->getTransaksi(date("Y-m-d", strtotime($tgl)), $bank, 1);

        if ($bank == "CardBCA") {
            $total = 0;
            foreach ($resultset as $rec) {
                $total += $rec->jumlah89;
            }
            $total = number_format($total, 2, '.', ''); //buat selalu 2 angka dibelakang koma
            //generate header
            $contentFile = "0SP" .
                    // --- TOC-RB @2015-08-19, REF : KITTY
                    //$tgl . // tgl format yyyymmdd
                    str_pad(NULL, 8) .
                    // END TOC-RB @2015-08-19
                    str_pad($rekeningDebet, 10, " ") . // rekening yg akan didebet 
                    " " .   //filler
                    str_pad($prefix, 8, " ") . // kode perusahaan (data darimana???)
                    "        " . //Company code 8 karakter
                    "       " . //Company code 7 karakter
                    "0000" . // emang formatnya 4 angka nol
                    str_pad(substr($total, 0, strlen($total) - 3), 13, "0", STR_PAD_LEFT) . // total dana yang akan ditransfer (tanpa nilai pecahan)
                    "." .
                    substr($total, strlen($total) - 2, 2) . // total dana yang akan ditransfer (2 digit belakang koma aja)
                    str_pad($resultset->count(), 5, "0", STR_PAD_LEFT) . // jumlah record yang akan ditransfer
                    "BCA" . // Transfer Type BCA/LLG/RTG
                    "               " . //emang diisi spasi 15 karakter
                    "                  " . //isi berita 1 sebanyak 18 karakter
                    "                  " . //isi berita 2 sebanyak 18 karakter
                    str_pad("", 132, " ") . //emang diisi spasi sebanyak 132 karakter
                    PHP_EOL;

            foreach ($resultset as $trans) {
                $nominal = number_format($trans->jumlah89, 2, '.', '');

                $contentFile.="1" . // record type
                        str_pad($trans->rekbca, 16, " ") . // credit account
//                        str_pad("", 18, " ") . //filler
//                      str_pad("", 17.2, " ") . //credit amount
                        "                  " . //filler 18
                        "                  " . //filler 18
                        "0000" . // emang formatnya 4 angka nol
                        str_pad(substr($nominal, 0, strlen($nominal) - 3), 13, "0", STR_PAD_LEFT) . // jumlah dana yang akan ditransfer (tanpa nilai pecahan)
                        "." .
                        substr($nominal, strlen($nominal) - 2, 2) . // jumlah dana yang akan ditransfer (2 digit belakang koma aja)
                        substr(str_pad($trans->namabca, 35, " "),0,35) . //nama rekening penerima sebanyak 35 karakter (dapat darimana????)
                        str_pad("", 6, " ") . //Transfer type
                        str_pad("", 1, " ") . //filler
                        str_pad("", 7, " ") . //BI Code
                        str_pad("", 4, " ") . //filler
                        str_pad("", 18, " ") . //Bank Name
                        str_pad("", 18, " ") . //Receive Bank
                        str_pad("", 18, " ") . //Remark1
                        str_pad("", 18, " ") . //Remark2
                        str_pad("", 18, " ") . //Filler
                        str_pad("", 1, " ") . //Cust type
                        str_pad("", 1, " ") . //Status penduduk
                        str_pad("", 35, " ") . //filler
                        "014" . //diisi 014 jika sesama BCA, diisi 888 jika ke bank lain (bener nggak???)
                        PHP_EOL;
            }
        }
        $this->response->setHeader("Content-Type", $contentType);
        $this->response->setHeader("Content-Disposition", 'attachment; filename="' . $fileName . '"');
        $this->response->setContent($contentFile);
        return $this->response;
    }
    
    
    
    //11% EDC
    
    
        public function download10edcAction($bank, $tgl) { 
        $this->view->disable();
        $contentType = $bank == "CardBCA" ? "text/plain" : "text/csv";
        $fileName = $bank == "CardBCA" ? "BCA_10_" . $tgl . "_EDC.txt" : "MANDIRI_10_" . $tgl . ".csv";

        $rekeningDebet = $bank == "CardBCA" ? $this->getRekeningOperasional("CardBCA") : $this->getRekeningOperasional("MANDIRI");
        $rekeningPusat = $bank == "CardBCA" ? $this->getRekeningPusat("CardBCA") : $this->getRekeningPusat("MANDIRI");
        // TOC-RB
        $namaRekPusat = $bank == "CardBCA" ? $this->getNamaRekeningPusat("CardBCA") : $this->getNamaRekeningPusat("MANDIRI");
        $prefix = $bank == "CardBCA" ? $this->getPrefix("CardBCA") : $this->getPrefix("MANDIRI");

        $contentFile = "";

        $resultset = $this->modelsManager->createBuilder()
                ->columns(array('Transaksibank.KodeCabang', 'SUM(Transaksibank.Nominal) AS jumlah', 'c.NoRekMandiri AS rekmandiri', 'c.NoRekBCA AS rekbca'))
                ->from('Transaksibank')
                ->where('TanggalImport = :import:', array('import' => date("Y-m-d", strtotime($tgl))))
                ->andWhere('NamaBank = :bank:', array('bank' => $bank), 'c.Aktif = 1')
                ->leftJoin('Areacabang', 'Transaksibank.KodeCabang = c.KodeAreaCabang', 'c')
                ->orderBy('Transaksibank.KodeCabang')
                ->groupBy('Transaksibank.KodeCabang,c.NoRekMandiri,c.NoRekBCA')
                ->getQuery()
                ->execute();

        $transaksi = array();
        $i = 0;

        $total = 0;

        foreach ($resultset->toArray() as $row) {
            $transaksi[$i]['KodeCabang'] = $row['KodeCabang'];
            $transaksi[$i]['NoRekeningMandiri'] = $row['rekmandiri'];
            $transaksi[$i]['NoRekeningBCA'] = $row['rekbca'];
            $transaksi[$i]['Total'] = $row['jumlah'];
            $transaksi[$i]['Dana90'] = $row['jumlah'] * 0.89;
            $transaksi[$i]['Dana10'] = $row['jumlah'] * 0.11;

            $total+=$transaksi[$i]['Dana10'];

            $i++;
        }



        if ($bank == "CardBCA") {
            $total = number_format($total, 2, '.', ''); //buat selalu 2 angka dibelakang koma
            //generate header
            $contentFile = "0SP" .
                    // --- TOC-RB @2015-08-19, REF : KITTY
                    //$tgl . // tgl format yyyymmdd
                    str_pad(NULL, 8) .
                    // END TOC-RB @2015-08-19
                    str_pad($rekeningDebet, 10, " ") . // rekening yg akan didebet (data darimana???)
                    " " . //filler 1 karakter
                    str_pad($prefix, 8, " ") . // Company code 
                    str_pad("", 15, " ") . //filler
                    "0000" . // emang formatnya 4 angka nol
                    str_pad(substr($total, 0, strlen($total) - 3), 13, "0", STR_PAD_LEFT) . // total dana yang akan ditransfer (tanpa nilai pecahan)
                    "." .
                    substr($total, strlen($total) - 2, 2) . // total dana yang akan ditransfer (2 digit belakang koma aja)
                    str_pad($i, 5, "0", STR_PAD_LEFT) . // Total Record
                    "BCA" . // Transfer type BCA/LLG/RTG
                    str_pad("", 15, " ") . //filler
                    str_pad("", 18, " ") . //Remark1
                    str_pad("", 18, " ") . //Remark2
                    str_pad("", 132, " ") . //filler
                    PHP_EOL;

            foreach ($transaksi as $trans) {
                $nominal = number_format($trans['Dana10'], 2, '.', '');

                $contentFile.="1" . //Detail
                        str_pad($rekeningPusat, 16, " ") . // Credit Account
                        "                  " . //Filler 18 karakter
                        "                  " . //Filler 18 karakter
                        "0000" . // emang formatnya 4 angka nol
                        str_pad(substr($nominal, 0, strlen($nominal) - 3), 13, "0", STR_PAD_LEFT) . // jumlah dana yang akan ditransfer (tanpa nilai pecahan)
                        "." .
                        substr($nominal, strlen($nominal) - 2, 2) . // jumlah dana yang akan ditransfer (2 digit belakang koma aja)
                        str_pad($namaRekPusat, 35, " ") . //nama rekening penerima sebanyak 35 karakter (dapat darimana????)
                    //    "       " . //emang diisi spasi sebanyak 7 karakter
                    //    "       " . //sandi BI bank yang dituju sebanyak 7 karakter, spasi jika sesama BCA (bener nggak???)
                    //    "    " . //emang diisi spasi sebanyak 4 karakter
                        "                  " . //nama bank yang dituju sebanyak 18 karakter, spasi jika sesama BCA (bener nggak???)
                        "                 " . //nama cabang bank yang dituju sebanyak 17 karakter, spasi jika sesama BCA (bener nggak???)
//  TOC-RB : 02 Jun 2015
//                    "                  " . //isi berita 1 sebanyak 18 karakter
                        str_pad("", 18, " ") . //Remark1                
                    //    str_pad($trans['KodeCabang'], 18, " ") . //isi berita 1 sebanyak 18 karakter
                        "BCA" . //Transfer Type BCA=B/LLG=N/RTGS=Y
                        str_pad("", 1, " ") . //Fillerss
                        str_pad("", 7, " ") . //BI Code
                        str_pad("", 4, " ") . //Filler
                        str_pad("", 21, " ") . //Filler
                        str_pad($trans['KodeCabang'], 18, " ") . //isi berita 1 sebanyak 18 karakter
                    
                        str_pad("", 18, " ") . //Remark2
                        str_pad("", 18, " ") . //Filler
                        str_pad("", 1, " ") . //Cust type
                        str_pad("", 1, " ") . //Cust resident
                 /*       "                  " . //isi berita 2 sebanyak 18 karakter                
                        "                  " . //emang diisi spasi sebanyak 18 karakter.
                        "                  " . //emang diisi spasi sebanyak 18 karakter     
                        "                  " . //emang diisi spasi sebanyak 18 karakter                 
                        "               " . //emang diisi spasi sebanyak 18 karakter                    
                */          
                        "014" . //diisi 014 jika sesama BCA, diisi 888 jika ke bank lain (bener nggak???)
                        PHP_EOL;
            }
        }

        $this->response->setHeader("Content-Type", $contentType);
        $this->response->setHeader("Content-Disposition", 'attachment; filename="' . $fileName . '"');

// TOC-RB
//        echo $contentFile;
        $this->response->setContent($contentFile);
        return $this->response;

    }
    
           //EDC BRI
     public function download90edcbriAction($bank, $tgl) {
        $this->view->disable();
        $contentType = $bank == "CardBRI" ? "text/plain" : "text/csv";
        $fileName = $bank == "CardBRI" ? "BCA_90_" . $tgl . "_EDC.txt" : "MANDIRI_90_" . $tgl . ".csv";
        $rekeningDebet = $bank == "CardBRI" ? $this->getRekeningOperasional("CardBRI") : $this->getRekeningOperasional("MANDIRI");
        $prefix = $bank == "CardBRI" ? $this->getPrefix("CardBRI") : $this->getPrefix("MANDIRI");

        $contentFile = "";
        $resultset = $this->getTransaksi(date("Y-m-d", strtotime($tgl)), $bank, 1);

        if ($bank == "CardBRI") {
            $total = 0;
            foreach ($resultset as $rec) {
                $total += $rec->jumlah89;
            }
            $total = number_format($total, 2, '.', ''); //buat selalu 2 angka dibelakang koma
            //generate header
            $contentFile = "0SP" .
                    // --- TOC-RB @2015-08-19, REF : KITTY
                    //$tgl . // tgl format yyyymmdd
                    str_pad(NULL, 8) .
                    // END TOC-RB @2015-08-19
                    str_pad($rekeningDebet, 10, " ") . // rekening yg akan didebet 
                    " " .   //filler
                    str_pad($prefix, 8, " ") . // kode perusahaan (data darimana???)
                    "        " . //Company code 8 karakter
                    "       " . //Company code 7 karakter
                    "0000" . // emang formatnya 4 angka nol
                    str_pad(substr($total, 0, strlen($total) - 3), 13, "0", STR_PAD_LEFT) . // total dana yang akan ditransfer (tanpa nilai pecahan)
                    "." .
                    substr($total, strlen($total) - 2, 2) . // total dana yang akan ditransfer (2 digit belakang koma aja)
                    str_pad($resultset->count(), 5, "0", STR_PAD_LEFT) . // jumlah record yang akan ditransfer
                    "BCA" . // Transfer Type BCA/LLG/RTG
                    "               " . //emang diisi spasi 15 karakter
                    "                  " . //isi berita 1 sebanyak 18 karakter
                    "                  " . //isi berita 2 sebanyak 18 karakter
                    str_pad("", 132, " ") . //emang diisi spasi sebanyak 132 karakter
                    PHP_EOL;

            foreach ($resultset as $trans) {
                $nominal = number_format($trans->jumlah89, 2, '.', '');

                $contentFile.="1" . // record type
                        str_pad($trans->rekbca, 16, " ") . // credit account
//                        str_pad("", 18, " ") . //filler
//                      str_pad("", 17.2, " ") . //credit amount
                        "                  " . //filler 18
                        "                  " . //filler 18
                        "0000" . // emang formatnya 4 angka nol
                        str_pad(substr($nominal, 0, strlen($nominal) - 3), 13, "0", STR_PAD_LEFT) . // jumlah dana yang akan ditransfer (tanpa nilai pecahan)
                        "." .
                        substr($nominal, strlen($nominal) - 2, 2) . // jumlah dana yang akan ditransfer (2 digit belakang koma aja)
                        substr(str_pad($trans->namabca, 35, " "),0,35) . //nama rekening penerima sebanyak 35 karakter (dapat darimana????)
                        str_pad("", 6, " ") . //Transfer type
                        str_pad("", 1, " ") . //filler
                        str_pad("", 7, " ") . //BI Code
                        str_pad("", 4, " ") . //filler
                        str_pad("", 18, " ") . //Bank Name
                        str_pad("", 18, " ") . //Receive Bank
                        str_pad("", 18, " ") . //Remark1
                        str_pad("", 18, " ") . //Remark2
                        str_pad("", 18, " ") . //Filler
                        str_pad("", 1, " ") . //Cust type
                        str_pad("", 1, " ") . //Status penduduk
                        str_pad("", 35, " ") . //filler
                        "014" . //diisi 014 jika sesama BCA, diisi 888 jika ke bank lain (bener nggak???)
                        PHP_EOL;
            }
        }
        $this->response->setHeader("Content-Type", $contentType);
        $this->response->setHeader("Content-Disposition", 'attachment; filename="' . $fileName . '"');
        $this->response->setContent($contentFile);
        return $this->response;
    }
    
    
    
    //11% EDC
    
    
        public function download10edcbriAction($bank, $tgl) { 
        $this->view->disable();
        $contentType = $bank == "CardBRI" ? "text/plain" : "text/csv";
        $fileName = $bank == "CardBRI" ? "BCA_10_" . $tgl . "_EDC.txt" : "MANDIRI_10_" . $tgl . ".csv";

        $rekeningDebet = $bank == "CardBRI" ? $this->getRekeningOperasional("CardBRI") : $this->getRekeningOperasional("MANDIRI");
        $rekeningPusat = $bank == "CardBRI" ? $this->getRekeningPusat("CardBRI") : $this->getRekeningPusat("MANDIRI");
        // TOC-RB
        $namaRekPusat = $bank == "CardBRI" ? $this->getNamaRekeningPusat("CardBRI") : $this->getNamaRekeningPusat("MANDIRI");
        $prefix = $bank == "CardBRI" ? $this->getPrefix("CardBRI") : $this->getPrefix("MANDIRI");

        $contentFile = "";

        $resultset = $this->modelsManager->createBuilder()
                ->columns(array('Transaksibank.KodeCabang', 'SUM(Transaksibank.Nominal) AS jumlah', 'c.NoRekMandiri AS rekmandiri', 'c.NoRekBCA AS rekbca'))
                ->from('Transaksibank')
                ->where('TanggalImport = :import:', array('import' => date("Y-m-d", strtotime($tgl))))
                ->andWhere('NamaBank = :bank:', array('bank' => $bank), 'c.Aktif = 1')
                ->leftJoin('Areacabang', 'Transaksibank.KodeCabang = c.KodeAreaCabang', 'c')
                ->orderBy('Transaksibank.KodeCabang')
                ->groupBy('Transaksibank.KodeCabang,c.NoRekMandiri,c.NoRekBCA')
                ->getQuery()
                ->execute();

        $transaksi = array();
        $i = 0;

        $total = 0;

        foreach ($resultset->toArray() as $row) {
            $transaksi[$i]['KodeCabang'] = $row['KodeCabang'];
            $transaksi[$i]['NoRekeningMandiri'] = $row['rekmandiri'];
            $transaksi[$i]['NoRekeningBCA'] = $row['rekbca'];
            $transaksi[$i]['Total'] = $row['jumlah'];
            $transaksi[$i]['Dana90'] = $row['jumlah'] * 0.89;
            $transaksi[$i]['Dana10'] = $row['jumlah'] * 0.11;

            $total+=$transaksi[$i]['Dana10'];

            $i++;
        }



        if ($bank == "CardBRI") {
            $total = number_format($total, 2, '.', ''); //buat selalu 2 angka dibelakang koma
            //generate header
            $contentFile = "0SP" .
                    // --- TOC-RB @2015-08-19, REF : KITTY
                    //$tgl . // tgl format yyyymmdd
                    str_pad(NULL, 8) .
                    // END TOC-RB @2015-08-19
                    str_pad($rekeningDebet, 10, " ") . // rekening yg akan didebet (data darimana???)
                    " " . //filler 1 karakter
                    str_pad($prefix, 8, " ") . // Company code 
                    str_pad("", 15, " ") . //filler
                    "0000" . // emang formatnya 4 angka nol
                    str_pad(substr($total, 0, strlen($total) - 3), 13, "0", STR_PAD_LEFT) . // total dana yang akan ditransfer (tanpa nilai pecahan)
                    "." .
                    substr($total, strlen($total) - 2, 2) . // total dana yang akan ditransfer (2 digit belakang koma aja)
                    str_pad($i, 5, "0", STR_PAD_LEFT) . // Total Record
                    "BCA" . // Transfer type BCA/LLG/RTG
                    str_pad("", 15, " ") . //filler
                    str_pad("", 18, " ") . //Remark1
                    str_pad("", 18, " ") . //Remark2
                    str_pad("", 132, " ") . //filler
                    PHP_EOL;

            foreach ($transaksi as $trans) {
                $nominal = number_format($trans['Dana10'], 2, '.', '');

                $contentFile.="1" . //Detail
                        str_pad($rekeningPusat, 16, " ") . // Credit Account
                        "                  " . //Filler 18 karakter
                        "                  " . //Filler 18 karakter
                        "0000" . // emang formatnya 4 angka nol
                        str_pad(substr($nominal, 0, strlen($nominal) - 3), 13, "0", STR_PAD_LEFT) . // jumlah dana yang akan ditransfer (tanpa nilai pecahan)
                        "." .
                        substr($nominal, strlen($nominal) - 2, 2) . // jumlah dana yang akan ditransfer (2 digit belakang koma aja)
                        str_pad($namaRekPusat, 35, " ") . //nama rekening penerima sebanyak 35 karakter (dapat darimana????)
                    //    "       " . //emang diisi spasi sebanyak 7 karakter
                    //    "       " . //sandi BI bank yang dituju sebanyak 7 karakter, spasi jika sesama BCA (bener nggak???)
                    //    "    " . //emang diisi spasi sebanyak 4 karakter
                        "                  " . //nama bank yang dituju sebanyak 18 karakter, spasi jika sesama BCA (bener nggak???)
                        "                 " . //nama cabang bank yang dituju sebanyak 17 karakter, spasi jika sesama BCA (bener nggak???)
//  TOC-RB : 02 Jun 2015
//                    "                  " . //isi berita 1 sebanyak 18 karakter
                        str_pad("", 18, " ") . //Remark1                
                    //    str_pad($trans['KodeCabang'], 18, " ") . //isi berita 1 sebanyak 18 karakter
                        "BCA" . //Transfer Type BCA=B/LLG=N/RTGS=Y
                        str_pad("", 1, " ") . //Fillerss
                        str_pad("", 7, " ") . //BI Code
                        str_pad("", 4, " ") . //Filler
                        str_pad("", 21, " ") . //Filler
                        str_pad($trans['KodeCabang'], 18, " ") . //isi berita 1 sebanyak 18 karakter
                    
                        str_pad("", 18, " ") . //Remark2
                        str_pad("", 18, " ") . //Filler
                        str_pad("", 1, " ") . //Cust type
                        str_pad("", 1, " ") . //Cust resident
                 /*       "                  " . //isi berita 2 sebanyak 18 karakter                
                        "                  " . //emang diisi spasi sebanyak 18 karakter.
                        "                  " . //emang diisi spasi sebanyak 18 karakter     
                        "                  " . //emang diisi spasi sebanyak 18 karakter                 
                        "               " . //emang diisi spasi sebanyak 18 karakter                    
                */          
                        "014" . //diisi 014 jika sesama BCA, diisi 888 jika ke bank lain (bener nggak???)
                        PHP_EOL;
            }
        }

        $this->response->setHeader("Content-Type", $contentType);
        $this->response->setHeader("Content-Disposition", 'attachment; filename="' . $fileName . '"');

// TOC-RB
//        echo $contentFile;
        $this->response->setContent($contentFile);
        return $this->response;

    }
    
    
       //END EDC BRI
    
    
    //selesai EDC
    
    
    
    
    

    //$tgl formatnya yyyymmdd
    public function download10Action($bank, $tgl) { 
        $this->view->disable();
        $contentType = $bank == "BCA" ? "text/plain" : "text/csv";
        $fileName = $bank == "BCA" ? "BCA_10_" . $tgl . ".txt" : "MANDIRI_10_" . $tgl . ".csv";

        $rekeningDebet = $bank == "BCA" ? $this->getRekeningOperasional("BCA") : $this->getRekeningOperasional("MANDIRI");
        $rekeningPusat = $bank == "BCA" ? $this->getRekeningPusat("BCA") : $this->getRekeningPusat("MANDIRI");
        // TOC-RB
        $namaRekPusat = $bank == "BCA" ? $this->getNamaRekeningPusat("BCA") : $this->getNamaRekeningPusat("MANDIRI");
        $prefix = $bank == "BCA" ? $this->getPrefix("BCA") : $this->getPrefix("MANDIRI");

        $contentFile = "";

        $resultset = $this->modelsManager->createBuilder()
                ->columns(array('Transaksibank.KodeCabang', 'SUM(Transaksibank.Nominal) AS jumlah', 'c.NoRekMandiri AS rekmandiri', 'c.NoRekBCA AS rekbca'))
                ->from('Transaksibank')
                ->where('TanggalImport = :import:', array('import' => date("Y-m-d", strtotime($tgl))))
                ->andWhere('NamaBank = :bank:', array('bank' => $bank))
                ->andWhere('len(NoReferensi) != 4')
                ->andWhere('len(NoReferensi) != 6')
                ->andWhere('c.Aktif = 1')
                ->leftJoin('Areacabang', 'Transaksibank.KodeCabang = c.KodeAreaCabang', 'c')
                ->orderBy('Transaksibank.KodeCabang')
                ->groupBy('Transaksibank.KodeCabang,c.NoRekMandiri,c.NoRekBCA')
                ->getQuery()
                ->execute();

        $transaksi = array();
        $i = 0;

        $total = 0;

        foreach ($resultset->toArray() as $row) {
            $transaksi[$i]['KodeCabang'] = $row['KodeCabang'];
            $transaksi[$i]['NoRekeningMandiri'] = $row['rekmandiri'];
            $transaksi[$i]['NoRekeningBCA'] = $row ['rekbca'];
            $transaksi[$i]['Total'] = $row['jumlah'];
            $transaksi[$i]['Dana90'] = $row['jumlah'] * 0.89;
            $transaksi[$i]['Dana10'] = $row['jumlah'] * 0.11;

            $total+=$transaksi[$i]['Dana10'];

            $i++;
        }



        if ($bank == "BCA") {
            $total = number_format($total, 2, '.', ''); //buat selalu 2 angka dibelakang koma
            //generate header
            $contentFile = "0SP" .
                    // --- TOC-RB @2015-08-19, REF : KITTY
                    //$tgl . // tgl format yyyymmdd
                    str_pad(NULL, 8) .
                    // END TOC-RB @2015-08-19
                    str_pad($rekeningDebet, 10, " ") . // rekening yg akan didebet (data darimana???)
                    " " . //filler 1 karakter
                    str_pad($prefix, 8, " ") . // Company code 
                    str_pad("", 15, " ") . //filler
                    "0000" . // emang formatnya 4 angka nol
                    str_pad(substr($total, 0, strlen($total) - 3), 13, "0", STR_PAD_LEFT) . // total dana yang akan ditransfer (tanpa nilai pecahan)
                    "." .
                    substr($total, strlen($total) - 2, 2) . // total dana yang akan ditransfer (2 digit belakang koma aja)
                    str_pad($i, 5, "0", STR_PAD_LEFT) . // Total Record
                    "BCA" . // Transfer type BCA/LLG/RTG
                    str_pad("", 15, " ") . //filler
                    str_pad("", 18, " ") . //Remark1
                    str_pad("", 18, " ") . //Remark2
                    str_pad("", 132, " ") . //filler
                    PHP_EOL;

            foreach ($transaksi as $trans) {
                $nominal = number_format($trans['Dana10'], 2, '.', '');

                $contentFile.="1" . //Detail
                        str_pad($rekeningPusat, 16, " ") . // Credit Account
                        "                  " . //Filler 18 karakter
                        "                  " . //Filler 18 karakter
                        "0000" . // emang formatnya 4 angka nol
                        str_pad(substr($nominal, 0, strlen($nominal) - 3), 13, "0", STR_PAD_LEFT) . // jumlah dana yang akan ditransfer (tanpa nilai pecahan)
                        "." .
                        substr($nominal, strlen($nominal) - 2, 2) . // jumlah dana yang akan ditransfer (2 digit belakang koma aja)
                        str_pad($namaRekPusat, 35, " ") . //nama rekening penerima sebanyak 35 karakter (dapat darimana????)
                    //    "       " . //emang diisi spasi sebanyak 7 karakter
                    //    "       " . //sandi BI bank yang dituju sebanyak 7 karakter, spasi jika sesama BCA (bener nggak???)
                    //    "    " . //emang diisi spasi sebanyak 4 karakter
                        "                  " . //nama bank yang dituju sebanyak 18 karakter, spasi jika sesama BCA (bener nggak???)
                        "                 " . //nama cabang bank yang dituju sebanyak 17 karakter, spasi jika sesama BCA (bener nggak???)
//  TOC-RB : 02 Jun 2015
//                    "                  " . //isi berita 1 sebanyak 18 karakter
                        str_pad("", 18, " ") . //Remark1                
                    //    str_pad($trans['KodeCabang'], 18, " ") . //isi berita 1 sebanyak 18 karakter
                        "BCA" . //Transfer Type BCA=B/LLG=N/RTGS=Y
                        str_pad("", 1, " ") . //Fillerss
                        str_pad("", 7, " ") . //BI Code
                        str_pad("", 4, " ") . //Filler
                        str_pad("", 21, " ") . //Filler
                        str_pad($trans['KodeCabang'], 18, " ") . //isi berita 1 sebanyak 18 karakter
                    
                        str_pad("", 18, " ") . //Remark2
                        str_pad("", 18, " ") . //Filler
                        str_pad("", 1, " ") . //Cust type
                        str_pad("", 1, " ") . //Cust resident
                 /*       "                  " . //isi berita 2 sebanyak 18 karakter                
                        "                  " . //emang diisi spasi sebanyak 18 karakter.
                        "                  " . //emang diisi spasi sebanyak 18 karakter     
                        "                  " . //emang diisi spasi sebanyak 18 karakter                 
                        "               " . //emang diisi spasi sebanyak 18 karakter                    
                */          
                        "014" . //diisi 014 jika sesama BCA, diisi 888 jika ke bank lain (bener nggak???)
                        PHP_EOL;
            }
        }

        $this->response->setHeader("Content-Type", $contentType);
        $this->response->setHeader("Content-Disposition", 'attachment; filename="' . $fileName . '"');

// TOC-RB
//        echo $contentFile;
        $this->response->setContent($contentFile);
        return $this->response;

    }

    public function getRekeningOperasional($namaBank) {
        $resultset = $this->modelsManager->createBuilder()
                ->columns(array('NoRekOperasional'))
                ->from('Sysparameter')
                ->where('NamaBank = "' . $namaBank . '"')
                ->getQuery()
                ->execute();

        $rows = $resultset->toArray();
        
        return count($rows) == 0 ? "" : $rows[0]['NoRekOperasional'];
    }

    public function getRekeningPusat($namaBank) {
        $resultset = $this->modelsManager->createBuilder()
                ->columns(array('NoRekPusat'))
                ->from('Sysparameter')
                ->where('NamaBank = "' . $namaBank . '"')
                ->getQuery()
                ->execute();

        $rows = $resultset->toArray();

        return count($rows) == 0 ? "" : $rows[0]['NoRekPusat'];
    }

    public function getNamaRekeningPusat($namaBank) {
        $resultset = $this->modelsManager->createBuilder()
                ->columns(array('NamaRekPusat'))
                ->from('Sysparameter')
                ->where('NamaBank = "' . $namaBank . '"')
                ->getQuery()
                ->execute();

        $rows = $resultset->toArray();

        if (count($rows) == 0)
            return "";
        else
            return $rows[0]['NamaRekPusat'];
    }

    public function getPrefix($namaBank) {
        $resultset = $this->modelsManager->createBuilder()
// TOC-RB
//                ->columns(array('Prefix'))
                ->columns(array('KodePerusahaan'))
                ->from('Sysparameter')
                ->where('NamaBank = "' . $namaBank . '"')
                ->getQuery()
                ->execute();

        $rows = $resultset->toArray();

        if (count($rows) == 0)
            return "";
        else
            return $rows[0]['KodePerusahaan'];
    }

    private function getTransaksi($date = NULL, $bank = NULL, $filter = 0) {
        //$bca = $this->request->getPost('Bank');
        
        if($bank=='BCA'){
        $qb = $this->modelsManager->createBuilder()
                ->columns([
                    'c.KodeAreaCabang + " / " + c.NamaAreaCabang AS cabang'
                    , 'SUM(tx.Nominal) AS jumlahtotal'
                    , 'CAST(SUM(tx.Nominal) * 0.89 AS money) AS jumlah89'
                    , 'CAST(SUM(tx.Nominal) * 0.11 AS money) AS jumlah11'
                    , 'c.NoRekBCA AS rekbca'
                    , 'c.NamaRekBCA AS namabca'
                    , 'c.NoRekNonBCA AS reknonbca'
                    , 'c.NamaRekNonBCA AS namanonbca'
                    , 'c.KodeBankNonBCA AS kodebank'
                    , 'b.Nama AS namabank'
                ])
                ->addFrom('Transaksibank', 'tx')
                ->join('Areacabang', 'tx.KodeCabang = c.KodeAreaCabang', 'c')
                ->leftJoin('Bank', 'c.KodeBankNonBCA = b.Kode', 'b')
                ->where('tx.TanggalImport = :date: AND len(tx.NoVA) != 6 AND len(tx.NoVA) != 4 AND tx.NamaBank = :bank: AND c.Aktif = 1')
                ->groupBy([
                    'c.KodeAreaCabang'
                    , 'c.NamaAreaCabang'
                    , 'c.NoRekBCA'
                    , 'c.NamaRekBCA' 
                    , 'c.NoRekNonBCA'
                    , 'c.NamaRekNonBCA'
                    , 'c.KodeBankNonBCA'
                    , 'b.Nama'
                ])
                ->orderBy('c.KodeAreaCabang');          
        } else {
        $qb = $this->modelsManager->createBuilder()
                ->columns([
                    'c.KodeAreaCabang + " / " + c.NamaAreaCabang AS cabang'
                    , 'SUM(tx.Nominal) AS jumlahtotal'
                    , 'CAST(SUM(tx.Nominal) * 0.89 AS money) AS jumlah89'
                    , 'CAST(SUM(tx.Nominal) * 0.11 AS money) AS jumlah11'
                    , 'c.NoRekBCA AS rekbca'
                    , 'c.NamaRekBCA AS namabca'
                    , 'c.NoRekNonBCA AS reknonbca'
                    , 'c.NamaRekNonBCA AS namanonbca'
                    , 'c.KodeBankNonBCA AS kodebank'
                    , 'b.Nama AS namabank'
                ])
                ->addFrom('Transaksibank', 'tx')
                ->join('Areacabang', 'tx.KodeCabang = c.KodeAreaCabang', 'c')
                ->leftJoin('Bank', 'c.KodeBankNonBCA = b.Kode', 'b')
                ->where('tx.TanggalImport = :date: AND tx.NamaBank = :bank: AND c.Aktif = 1')
                ->groupBy([
                    'c.KodeAreaCabang'
                    , 'c.NamaAreaCabang'
                    , 'c.NoRekBCA'
                    , 'c.NamaRekBCA' 
                    , 'c.NoRekNonBCA'
                    , 'c.NamaRekNonBCA'
                    , 'c.KodeBankNonBCA'
                    , 'b.Nama'
                ])
                ->orderBy('c.KodeAreaCabang');              
        }
        

                
                
                
        switch ($filter){
            case 1 :
                $qb->andWhere("c.NoRekBCA IS NOT NULL AND c.NoRekBCA != ''");
                break;
            case 2 :
                $qb->andWhere("c.NoRekBCA IS NULL OR c.NoRekBCA = ''");
                break;
            default :
                break;
        }
        return $qb->getQuery()
                ->execute(['date' => $date, 'bank' => $bank])
                ->setHydrateMode(\Phalcon\Mvc\Model\Resultset::HYDRATE_OBJECTS);
    }

}
