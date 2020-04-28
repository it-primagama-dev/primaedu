<?php
  
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class testController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle("Pembagian Dana Kelas Online");
        parent::initialize();
    }

    /**
     * Index action
     */
    public function indexAction() {

    }

    //$tgl formatnya yyyymmdd
    public function download90Action() {
        //$this->view->disable();
        $bank = 'BCA';
        $tgl = '20190905';
        $contentType = "text/plain";
        $fileName = "BCA_90_" . $tgl . ".txt";
        $rekeningDebet = $this->getRekeningOperasional("BCA");
        $prefix = $this->getPrefix("BCA");

        $contentFile = "";
        $resultset = $this->getTransaksi(date("Y-m-d", strtotime($tgl)), $bank);

        //var_dump($resultset);

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
                    //str_pad('10', 5, "0", STR_PAD_LEFT) . // jumlah record yang akan ditransfer
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


    private function getTransaksi($date = NULL, $bank = NULL) {
        //$bca = $this->request->getPost('Bank');
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
                     From Transaksibank tx join areacabang c on tx.KodeCabang=c.KodeAreaCabang left join Bank b on c.KodeBankNonBCA=b.Kode where tx.TanggalImport = '$date' AND len(tx.NoVA) != 6 AND len(tx.NoVA) != 4 AND tx.NamaBank = '$bank' AND c.Aktif = 1 group by c.KodeAreaCabang
                    , c.NamaAreaCabang
                    , c.NoRekBCA
                    , c.NamaRekBCA 
                    , c.NoRekNonBCA
                    , c.NamaRekNonBCA
                    , c.KodeBankNonBCA
                    , b.Nama";

        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);              
        $return = $query->fetchAll($query);
        return $return;
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
}