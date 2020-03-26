<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helpers
 *
 * @author Moh Eric <moh.eric@primagama.co.id>
 */
class Helpers extends Phalcon\Mvc\User\Component {

    /**
     * Format number to rupiah
     * @param int $angka
     * @return string
     */
    function rupiah($angka) {
        $hasil_rupiah = number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }

    /**
     * get email template
     * @param String $content
     * @return String
     */
    function emailTemplate($content = "") {
        $footer = "
            <br/>
            <div style=\"margin:0;\"><font face=\"Times New Roman,serif\" size=\"3\" style=\"font-family: &quot;Times New Roman&quot;, serif, serif, EmojiFont;\"><span style=\"font-size:12pt;\"><font face=\"Comic Sans MS\" size=\"2\" color=\"#2E74B5\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:11pt;\"><b>Best Regards,</b></span></font></span></font></div>
            <div style=\"margin:0;\"><font face=\"Times New Roman,serif\" size=\"3\" style=\"font-family: &quot;Times New Roman&quot;, serif, serif, EmojiFont;\"><span style=\"font-size:12pt;\"><font face=\"Comic Sans MS\" size=\"1\" color=\"#2E74B5\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\"><b>Finance &amp; Accounting </b></span></font></span></font></div>
            <div style=\"margin:0;\"><font face=\"Times New Roman,serif\" size=\"3\" style=\"font-family: &quot;Times New Roman&quot;, serif, serif, EmojiFont;\"><span style=\"font-size:12pt;\"><font face=\"Comic Sans MS\" size=\"1\" color=\"#2E74B5\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\"><b>PT Prima Edu Pendamping Belajar</b></span></font></span></font></div>
            <div style=\"margin:0;\"><font face=\"Times New Roman,serif\" size=\"3\" style=\"font-family: &quot;Times New Roman&quot;, serif, serif, EmojiFont;\"><span style=\"font-size:12pt;\"><font face=\"Comic Sans MS\" size=\"1\" color=\"#2E74B5\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\">Jln. Ciasem I No. 9, Kebayoran Baru</span></font></span></font></div>
            <div style=\"margin:0;\"><font face=\"Times New Roman,serif\" size=\"3\" style=\"font-family: &quot;Times New Roman&quot;, serif, serif, EmojiFont;\"><span style=\"font-size:12pt;\"><font face=\"Comic Sans MS\" size=\"1\" color=\"#2E74B5\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\">Telp: 021-29304102</span></font></span></font></div>
            <!--<div style=\"margin:0;\"><font face=\"Times New Roman,serif\" size=\"3\" style=\"font-family: &quot;Times New Roman&quot;, serif, serif, EmojiFont;\"><span style=\"font-size:12pt;\"><font face=\"Comic Sans MS\" size=\"1\" color=\"#2E74B5\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\">email</span></font><font face=\"Comic Sans MS\" size=\"1\" color=\"#404040\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\">:
            </span></font><a href=\"mailto:finance@primagama.co.id\" target=\"_blank\" rel=\"noopener noreferrer\"><font face=\"Comic Sans MS\" size=\"1\" style=\"font-family: &quot;Comic Sans MS&quot;, serif, EmojiFont;\"><span style=\"font-size:8pt;\"><font color=\"#0563C1\">finance@primagama.co.id</font></span></font></a></span></font></div>
            </div>-->
            <br>Silakan klik <a href=\"https://www.primagama.co.id\">www.primagama.co.id</a> untuk melihat informasi lainnya.</p>
            <br><p>Salam SMART,</p>
            <br><p>&copy; Copyright " . date("Y") . " PT. Prima Edu Pendamping Belajar<p>";

        return $content . $footer;
    }

    /**
     * Format tanggal
     * @param String $tanggal
     * @return String
     */
    function tanggalFormat($tanggal = "1945-08-17") {
        $bulan = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        );
        $arr = explode('-', $tanggal);
        return $arr[2] . ' ' . $bulan[(int) $arr[1]] . ' ' . $arr[0];
    }

    /**
     * Print as json format
     * @param Array $array
     */
    protected function jsonResponse($array = array()) {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        echo json_encode($array);
    }

    /**
     * Format hari
     * @param string $hari
     * @return string
     */
    function hariFormat($hari = '') {
        $day = date('D', strtotime($hari));
        $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );
        return $dayList[$day];
    }

    /**
     * Request API
     * @param string $url
     * @param string $method
     * @param array $data
     * @param string $apiKey
     * @param string $secretKey
     * @param boolean $debug
     * @return mix boolean/json
     */
    function requestAPI($url, $method = "GET", $data = array(), $apiKey = NULL, $secretKey = NULL, $debug = false) {
        $data = (count($data) > 0) ? $data : false;

        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // OPTIONS
        curl_setopt($curl, CURLOPT_URL, $url);
        $header = array(
            'Content-Type: application/json'
        );
        if ($apiKey != NULL) {
            $header[] = "API-KEY: " . $apiKey;
        }
        if ($secretKey != NULL) {
            $header[] = "SECRET-KEY: " . $secretKey;
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, true);

        // EXECUTE
        $responseBody = curl_exec($curl);
        if ($responseBody === false) {
            
        }

        $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($responseCode >= 400) {
            
        }

        // DEBUG for development only
        if ($debug) {
            curl_setopt($curl, CURLOPT_HEADER, 1);
            $info = curl_getinfo($curl);
            var_dump($info);
        }

        curl_close($curl);

        return array(
            "code" => $responseCode,
            "message" => ($this->isJSON($responseBody)) ? json_decode($responseBody) : $responseBody,
        );
    }

    /**
     * Check if string is json format
     * @param json string $string
     * @return boolean
     */
    function isJSON($string) {
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }
    
    /**
     * Convert special character to html entities
     * @param string $string
     * @return string
     */
    function convertHtmlEntities($string){
        return htmlspecialchars($string);
    }

}
