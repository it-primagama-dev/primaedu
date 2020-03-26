<?php
error_reporting(0);
use Phalcon\Mvc\Controller;
require_once('/../../public/phpmailer/PHPMailerAutoload.php');

class ControllerBase extends Controller {

    protected function initialize() {
        $this->tag->prependTitle('PrimaEdu | ');
        if ($this->session->has('auth')) {
            $this->view->setVar('user', $this->session->get('auth'));
            $cabang = Areacabang::findFirst($this->session->get('auth')['areacabang']);
            $this->view->setVar('namacabang', $cabang != FALSE ? $cabang->NamaAreaCabang : "");
            $this->view->setVar('kodecabang', $this->session->get('auth')['kodeareacabang']);
            $this->view->setVar('printTitle', '');
            $this->view->setTemplateAfter('main');
        } else {
            return $this->forward('session/index');
        }
    }

    protected function forward($uri) {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
        return $this->dispatcher->forward([
                    'controller' => $uriParts[0],
                    'action' => $uriParts[1],
                    'params' => $params
        ]);
    }

    public function afterExecuteRoute() {
        if (!$this->request->isAjax()) {
            $this->assets->collection('cssHeader')
                    ->setTargetPath('css/prod-main.css')
                    ->setTargetUri('css/prod-main.css')
                    ->addCss('css/iconFont.min.css')
                    ->addCss('css/metro-bootstrap.min.css')
                    ->addCss('css/custom.min.css')
                    ->addCss('css/main.css')
                    ->join(TRUE)
            ; //->addFilter(new Phalcon\Assets\Filters\Cssmin());
            $this->assets->collection('jsHeader')
                    ->setTargetPath('js/prod-jshead.js')
                    ->setTargetUri('js/prod-jshead.js')
                    ->addJs('js/jquery/jquery.min.js')
                    ->addJs('js/jquery/jquery.widget.min.js')
                    ->addJs('js/jquery/jquery.slimscroll.min.js')
                    ->addJs('//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', false)
                    ->addJs('//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js', false)
                    ->join(TRUE)
            ; //->addFilter(new Phalcon\Assets\Filters\Jsmin());
        }
    }

    /*
     * Terbilang
     */

    public function terbilang($bilangan) {
        $bilangan = abs($bilangan);
        $angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($bilangan < 12) {
            $temp = " " . $angka[$bilangan];
        } else if ($bilangan < 20) {
            $temp = $this->terbilang($bilangan - 10) . " belas";
        } else if ($bilangan < 100) {
            $temp = $this->terbilang($bilangan / 10) . " puluh" . $this->terbilang($bilangan % 10);
        } else if ($bilangan < 200) {
            $temp = " seratus" . $this->terbilang($bilangan - 100);
        } else if ($bilangan < 1000) {
            $temp = $this->terbilang($bilangan / 100) . " ratus" . $this->terbilang($bilangan % 100);
        } else if ($bilangan < 2000) {
            $temp = " seribu" . $this->terbilang($bilangan - 1000);
        } else if ($bilangan < 1000000) {
            $temp = $this->terbilang($bilangan / 1000) . " ribu" . $this->terbilang($bilangan % 1000);
        } else if ($bilangan < 1000000000) {
            $temp = $this->terbilang($bilangan / 1000000) . " juta" . $this->terbilang($bilangan % 1000000);
        } else if ($bilangan < 1000000000000) {
            $temp = $this->terbilang(bcdiv($bilangan, 1000000000)) . " miliar" . $this->terbilang(bcmod($bilangan, 1000000000));
        }
        return $temp;
    }

    public function getDocumentNo(\Phalcon\Mvc\Model $model = null, $prefix = '00', $cabang = '0000') {
        $query = FALSE;
        $field = NULL;
        $length = 0;
        switch ($prefix) {
            case 'PB':
                $query = !is_null($model) ? $model->findFirst(["order" => "RecID DESC"]) : Pembayarandetail::findFirst(["order" => "RecID DESC"]);
                $field = 'DocumentNo';
                $length = 6;
                break;
            case 'BK':
                $query = !is_null($model) ? $model->findFirst(["order" => "RecID DESC"]) : Bukusiswa::findFirst(["order" => "RecID DESC"]);
                $field = 'DocumentNo';
                $length = 6;
                break;
            default:
                return FALSE;
        }
        if ($query !== FALSE) {
            $last = $this->_parseDocumentNo($query->{$field});
            $year = $last->year == date('Y') ? $last->year : date('Y');
            $sequence = $last->year == date('Y') ?
                    $this->_padnum($length, $last->sequence + 1) : $this->_padnum($length);
            return $prefix . $cabang . $year . $sequence;
        }
        return $prefix . $cabang . date('Y') . $this->_padnum($length);
    }

    private function _parseDocumentNo($documentNo) {
        $temp = new stdClass();
        $temp->prefix = substr($documentNo, 0, 2);
        $temp->cabang = substr($documentNo, 2, 4);
        $temp->year = substr($documentNo, 6, 4);
        $temp->sequence = (int) substr($documentNo, 10);
        return $temp;
    }

    private function _padnum($length = 0, $number = 0) {
        return str_pad($number, $length, '0', STR_PAD_LEFT);
    }

    public function getNumberSequence($prefix = '00', $cabang = '0000') {
        $query = FALSE; $field = NULL; $length = 0;
        $find = Areacabang::findFirstByKodeAreaCabang($cabang);
        if (!$find) {
            return FALSE;
        }
        switch ($prefix) {
            case 'PR':
                $query = Purchreqheader::findFirst([
                    "Cabang = :cabang:", "order" => "RecId DESC", "bind" => ["cabang" => $find->RecID]
                ]);
                $field = 'PurchReqId'; $length = 2; break;
            default :
                return FALSE;
        }
        if ($query !== FALSE) {
            $last = (int) substr($query->{$field}, -$length);
            return $prefix . date('Y') . '-' . $cabang . '-' . $this->_padnum($length, $last + 1);
        }
        return $prefix . date('Y') . '-' . $cabang . '-' . $this->_padnum($length);
    }
    
    /**
     * print as json type
     * @param type $array
     */
    protected function jsonResponse($array = array()){
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        echo json_encode($array);
    }
    
    /**
     * Generate No Surat Pernyataan
     * 
     * @param string $kodeCabang
     * @return string
     */
    protected function getNextNoSuratPernyataanByKodeCabang($kodeCabang = ""){
        $kodeMax = "";
        $sql = "SELECT top 1 NoSurat AS KodeMax FROM nosuratpernyataan WHERE KodeCabang = '$kodeCabang' ORDER BY RIGHT(NoSurat,7) DESC";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $result = $query->fetchAll($query);
        foreach ($result as $r) {
            $kodeMax = $r->KodeMax;
        }
        return $kodeMax;
    }

/**
     * Set Next No Surat Pernyataan
     * 
     * @param string $kodeCabang
     * @return string
     */
    protected function setNextNoSuratPernyataanByKodeCabang($kodeCabang = "") {
        $nextKode = "0000001";

        $noSuratPernyataan = $this->getNextNoSuratPernyataanByKodeCabang($kodeCabang);
        if ($noSuratPernyataan != "") {
            $kodeMax = (int) substr($noSuratPernyataan, 8) + 1;
            $nextKode = sprintf("%07s", $kodeMax);
        }

        $nextNoSurat = 'RF' . date('ymd') . $nextKode;

        $noSurat = new Nosuratpernyataan();
        $noSurat->NoSurat = $nextNoSurat;
        $noSurat->KodeCabang = $kodeCabang;
        $noSurat->TahunAjaran = date('Y-m-d H:i:s');
        if ($noSurat->save() == false) {
//            echo "Umh, We can't store robots right now: \n";
//            foreach ($noSurat->getMessages() as $message) {
//                echo $message, "\n";
//            }
            return false;
        } else {
//            echo "Great, a new robot was saved successfully!";
        }

        return true;
    }
    
    /**
     * Send email
     * 
     * @param string $emailSubject
     * @param string $emailBody
     * @param string $emailSender
     * @param string $emailSenderName
     * @param string $emailReceiver
     * @param string $emailReceiverName
     * @param array $emailCC
     */
    public function sendEmail($emailSubject = "", $emailBody = "", $emailReceiver = NULL, $emailReceiverName = NULL, $emailSender = NULL, $emailSenderName = NULL, $emailCC = array()){
        $mail = new PHPMailer;
        
        $emailReceiver = $emailReceiver==NULL?"moh.eric@primagama.co.id":$emailReceiver;
        $emailReceiverName = $emailReceiverName==NULL?"Moh Eric":$emailReceiverName;
        $emailSender = $emailSender==NULL?"noreply@primagama.co.id":$emailSender;
        $emailSenderName = $emailSenderName==NULL?"Primagama":$emailSenderName;
        $emailCC = (count($emailCC) > 0)?$emailCC:array("andin.eka@primagama.co.id");
        try {
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->Host = "smtp.office365.com";
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
            $mail->Username = "noreply@primagama.co.id";
            $mail->Password = "Prima.1234";
            $mail->SetFrom($emailSender, $emailSenderName);
            $mail->AddAddress($emailReceiver, $emailReceiverName);
            if(count($emailCC) > 0){
                foreach ($emailCC as $value) {
                    if(array_key_exists("email", $value)){
                       $emailCCName = array_key_exists("name", $value)?$value["name"]:"";
                       $mail->AddCC($value["email"], $emailCCName);
                    }
                } 
            }
            $mail->Subject = $emailSubject;
            $mail->MsgHTML($emailBody);
            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
    
    public function getGlobalVA(){
        return $this->session->get("auth")["kodeareacabang"];
    }
    public function getBookVA(){
        return $this->session->get("auth")["kodeareacabang"]."02";
    }
    public function getFranchiseVA(){
        return $this->session->get("auth")["kodeareacabang"]."03";
    }
    
    public function getVirtualAccountByTypeId($typeId=""){
        if($typeId == 1){
            return $this->getBookVA();
        }else if($typeId == 2){
            return $this->getFranchiseVA();
        }else{
            return $this->getGlobalVA();
        }
    }
    
    public function saveOutgoingRequest($data = array()){
        $sql = "INSERT into API_OutgoingRequest "
                . "(API_Key, Branch_Code, Request_Data, Resource_Name, Endpoint, Status_Code, Created_At, Created_By) "
                . "values ('" . $data["API_Key"] . "','" . $data["Branch_Code"] . "','" . $data["Request_Data"] . "','" . $data["Resource_Name"] . "','" . $data["Endpoint"] . "',".$data["Status_Code"].",'" . $data["Created_At"] . "','" . $data["Created_By"] . "')";
        $query = $this->getDI()->getShared('db')->query($sql);
        $query->setFetchMode(Phalcon\Db::FETCH_OBJ);
    }

function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'Pymt';
        $secret_iv = 'qr';
        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}
