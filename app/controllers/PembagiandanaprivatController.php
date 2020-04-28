<?php
  
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PembagiandanaprivatController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle("Pembagian Dana Kelas Online");
        parent::initialize();
    }

    /**
     * Index action
     */
    public function indexAction() {

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
            //$this->view->link89 = $this->url->get("pembagiandana/download90/" . $bank . "/" . date("Ymd", strtotime($date)));
            //$this->view->link89edc = $this->url->get("pembagiandana/download90edc/" . $bank . "/" . date("Ymd", strtotime($date)));
            //$this->view->link89edcbri = $this->url->get("pembagiandana/download90edcbri/" . $bank . "/" . date("Ymd", strtotime($date)));
            //$this->view->link89nonbca = $this->url->get("pembagiandana/download90nonbca/" . $bank . "/" . date("Ymd", strtotime($date)));
            //$this->view->link11 = $this->url->get("pembagiandana/download10/" . $bank . "/" . date("Ymd", strtotime($date)));
            //$this->view->link11edc = $this->url->get("pembagiandana/download10edc/" . $bank . "/" . date("Ymd", strtotime($date)));
            //$this->view->link11edcbri = $this->url->get("pembagiandana/download10edcbri/" . $bank . "/" . date("Ymd", strtotime($date)));
        }
    }

    //$tgl formatnya yyyymmdd
    public function download90Action() {
        $this->view->disable();
       // $bank = 'BCA';
        $tgl = '20190904';
        $contentType = "text/plain";
        $fileName = "BCA_90_" . $tgl . ".txt";
        $rekeningDebet = $this->getRekeningOperasional("BCA");
        $prefix = $this->getPrefix("BCA");

        $contentFile = "";
        $resultset = $this->getTransaksi(date("Y-m-d", strtotime($tgl)), $bank, 1);

        //if ($bank == "BCA") {
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
        //}
        $this->response->setHeader("Content-Type", $contentType);
        $this->response->setHeader("Content-Disposition", 'attachment; filename="' . $fileName . '"');
        $this->response->setContent($contentFile);
        return $this->response;
    }

    //$tgl formatnya yyyymmdd
    public function download10Action() { 
        //$this->view->disable();
        $bank = 'BCA';
        $tgl = '04-09-2019';
        $tglfix = date("Y-m-d", strtotime($tgl));
        $contentType = $bank == "BCA" ? "text/plain" : "text/csv";
        $fileName = $bank == "BCA" ? "BCA_10_" . $tglfix . ".txt" : "MANDIRI_10_" . $tglfix . ".csv";

        $rekeningDebet = $bank == "BCA" ? $this->getRekeningOperasional("BCA") : $this->getRekeningOperasional("MANDIRI");
        $rekeningPusat = $bank == "BCA" ? $this->getRekeningPusat("BCA") : $this->getRekeningPusat("MANDIRI");
        // TOC-RB
        $namaRekPusat = $bank == "BCA" ? $this->getNamaRekeningPusat("BCA") : $this->getNamaRekeningPusat("MANDIRI");
        $prefix = $bank == "BCA" ? $this->getPrefix("BCA") : $this->getPrefix("MANDIRI");

        $contentFile = "";

         $sql = "SELECT Transaksibank.KodeCabang, SUM(Transaksibank.Nominal) AS jumlah, c.NoRekMandiri AS rekmandiri, c.NoRekBCA AS rekbca
                    from Transaksibank
                    left Join areacabang c on Transaksibank.KodeCabang = c.KodeAreaCabang
                    where TanggalImport = '$tglfix' and NamaBank = '$bank' and len(NoReferensi) != '4' and len(NoReferensi) != '6' and c.Aktif = 1 
                    group By Transaksibank.KodeCabang,c.NoRekMandiri,c.NoRekBCA
         ";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);              
        $Resultset = $query->fetchAll($query);

        $transaksi = array();
        $i = 0;

        $total = 0;

        foreach ($Resultset as $row) {
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

            foreach ($Resultset as $trans) {
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

    private function getTransaksi($date = NULL, $bank = 'BCA') {
        //$bca = $this->request->getPost('Bank');
        
        $sql = "SELECT Transaksibank.KodeCabang, SUM(Transaksibank.Nominal) AS jumlah, c.NoRekMandiri AS rekmandiri, c.NoRekBCA AS rekbca
                    from Transaksibank
                    left Join areacabang c on Transaksibank.KodeCabang = c.KodeAreaCabang
                    where TanggalImport = '2019' and NamaBank = '$bank' and len(NoReferensi) != '4' and len(NoReferensi) != '6' and c.Aktif = 1 
                    group By Transaksibank.KodeCabang,c.NoRekMandiri,c.NoRekBCA
         ";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);              
        $query->fetchAll($query);
        

    }
    //$tgl formatnya yyyymmdd
    public function test10Action() { 
        //$this->view->disable();
        $bank = 'BCA';
        $tgl = '04-09-2019';
        $tglfix = date("Y-m-d", strtotime($tgl));
        $fileName = $bank == "BCA" ? "BCA_10_" . $tgl . ".txt" : "MANDIRI_10_" . $tgl . ".csv";

        $rekeningDebet = $bank == "BCA" ? $this->getRekeningOperasional("BCA") : $this->getRekeningOperasional("MANDIRI");
        $rekeningPusat = $bank == "BCA" ? $this->getRekeningPusat("BCA") : $this->getRekeningPusat("MANDIRI");
        // TOC-RB
        $namaRekPusat = $bank == "BCA" ? $this->getNamaRekeningPusat("BCA") : $this->getNamaRekeningPusat("MANDIRI");
        $prefix = $bank == "BCA" ? $this->getPrefix("BCA") : $this->getPrefix("MANDIRI");

        $contentFile = "";

        //$resultset = $this->getTransaksi(date("Y-m-d", strtotime($tgl)), $bank, 1);

      
         $sql = "SELECT 
                    c.KodeAreaCabang + ' / ' + c.NamaAreaCabang AS cabang
                    , SUM(tx.Nominal) AS jumlahtotal
                    , CAST(SUM(tx.Nominal) * 0.89 AS money) AS jumlah89
                    , CAST(SUM(tx.Nominal) * 0.11 AS money) AS jumlah11
                    , c.NoRekBCA AS rekbca
                    , c.NamaRekBCA AS namabca
                    , c.NoRekNonBCA AS reknonbca
                    , c.NamaRekNonBCA AS namanonbca
                    , c.KodeBankNonBCA AS kodebank
                    , b.Nama AS namabank
                     From Transaksibank tx join areacabang c on tx.KodeCabang=c.KodeAreaCabang left join Bank b on c.KodeBankNonBCA=b.Kode where tx.TanggalImport = '$tglfix' AND len(tx.NoVA) != 6 AND len(tx.NoVA) != 4 AND tx.NamaBank = '$bank' AND c.Aktif = 1 group by c.KodeAreaCabang
                    , c.NamaAreaCabang
                    , c.NoRekBCA
                    , c.NamaRekBCA 
                    , c.NoRekNonBCA
                    , c.NamaRekNonBCA
                    , c.KodeBankNonBCA
                    , b.Nama";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);              
        $queryfor = $query->fetchAll($query);
        //$queryfor = array();
        //var_dump($queryfor);
        //var_dump($queryfor->toArray());
        $transaksi = array();
        $i = 0;

        $total = 0;

        foreach ($queryfor as $row) {
            $transaksi[$i]['KodeCabang'] = $row['KodeCabang'];
            $transaksi[$i]['NoRekeningMandiri'] = $row['rekmandiri'];
            $transaksi[$i]['NoRekeningBCA'] = $row ['rekbca'];
            $transaksi[$i]['Total'] = $row['jumlah'];
            $transaksi[$i]['Dana90'] = $row['jumlah'] * 0.89;
            $transaksi[$i]['Dana10'] = $row['jumlah'] * 0.11;

            $total+=$transaksi[$i]['Dana10'];

            $i++;
        }


    }    public function download10tesAction() { 
        //$this->view->disable();
        $bank = 'BCA';
        $tgl = '04-09-2019';
        $tglfix = date("Y-m-d", strtotime($tgl));
        $contentType = $bank == "BCA" ? "text/plain" : "text/csv";
        $fileName = $bank == "BCA" ? "BCA_10_" . $tglfix . ".txt" : "MANDIRI_10_" . $tglfix . ".csv";

        $rekeningDebet = $bank == "BCA" ? $this->getRekeningOperasional("BCA") : $this->getRekeningOperasional("MANDIRI");
        $rekeningPusat = $bank == "BCA" ? $this->getRekeningPusat("BCA") : $this->getRekeningPusat("MANDIRI");
        // TOC-RB
        $namaRekPusat = $bank == "BCA" ? $this->getNamaRekeningPusat("BCA") : $this->getNamaRekeningPusat("MANDIRI");
        $prefix = $bank == "BCA" ? $this->getPrefix("BCA") : $this->getPrefix("MANDIRI");

        $contentFile = "";

         $sql = "SELECT Transaksibank.KodeCabang, SUM(Transaksibank.Nominal) AS jumlah, c.NoRekMandiri AS rekmandiri, c.NoRekBCA AS rekbca
                    from Transaksibank
                    left Join areacabang c on Transaksibank.KodeCabang = c.KodeAreaCabang
                    where TanggalImport = '$tglfix' and NamaBank = '$bank' and len(NoReferensi) != '4' and len(NoReferensi) != '6' and c.Aktif = 1 
                    group By Transaksibank.KodeCabang,c.NoRekMandiri,c.NoRekBCA
         ";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);              
        $queryfor = $query->fetchAll($query);

        $transaksi = array();
        $i = 0;

        $total = 0;

        foreach ($queryfor as $row) {
            $transaksi[$i]['KodeCabang'] = $row['KodeCabang'];
            $transaksi[$i]['NoRekeningMandiri'] = $row['rekmandiri'];
            $transaksi[$i]['NoRekeningBCA'] = $row ['rekbca'];
            $transaksi[$i]['Total'] = $row['jumlah'];
            $transaksi[$i]['Dana90'] = $row['jumlah'] * 0.89;
            $transaksi[$i]['Dana10'] = $row['jumlah'] * 0.11;

            $total+=$transaksi[$i]['Dana10'];

            $i++;
            echo $transaksi[$i]['Dana10'];
        }
    }

}
