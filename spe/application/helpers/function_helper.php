<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
/**
 * Fungsi yang berguna untuk mendapatkan data tertentu dari model tertentu
 *
 * @param  string $model
 * @param  string $func
 * @param  array  $args
 * @param  string $field_name
 * @return array|string
 */
function load_comp_css($target_href = array())
{
    $return = '';
    foreach ($target_href as $value) {
        $return .= '<link type="text/css" href="'.$value.'" rel="stylesheet">'.PHP_EOL;
    }
    return $return;
}

/**
 * Method untuk load js komponent tambahan
 *
 * @param  array  $target_src
 * @return string
 */
function load_comp_js($target_src = array())
{
    $return = '';
    foreach ($target_src as $value) {
        $return .= '<script src="'.$value.'" type="text/javascript"></script>'.PHP_EOL;
    }
    return $return;
}

function get_row_data($model, $func, $args = array(), $field_name = '')
{
    $CI =& get_instance();
    $CI->load->model($model);

    $retrieve = call_user_func_array(array($CI->$model, $func), $args);

    if (empty($field_name)) {
        return $retrieve;
    } else {
        return isset($retrieve[$field_name]) ? $retrieve[$field_name] : '';
    }
}

/**
 * Method untuk mendapatkan data site config
 *
 * @param  string $id
 * @param  string $get   nama atau value
 * @return string data
 */
function get_pengaturan($id, $get = null)
{
    $result = get_row_data('config_model', 'retrieve', array($id), $get);
    return $result;
}

/**
 * Method untuk mendapatkan link base url ke template yang sedang aktif
 *
 * @param  string $add_link string tambahan untuk link
 * @return string link template
 */
function base_url_theme($add_link = '')
{
    $active_theme = get_active_theme();
    return base_url('assets/themes/'.$active_theme.'/'.$add_link);
}

/**
 * Method untuk mendapatkan link logo elearning
 *
 * @param  string $size pilihan small|medium|large
 * @return string link image
 */
function get_logo_url($size = 'small') {
    return base_url('assets/images/logo-'.strtolower($size).'.png');
}

/**
 * Method untuk mendapatkan nama template yang aktif
 *
 * @return string nama template
 */
function get_active_theme()
{
    return 'default';
}

/**
 * Method untuk mendapatkan css alert
 *
 * @param  string $notif
 * @param  string $msg
 * @return string
 */
function get_alert($notif = 'success', $msg = '')
{
    return '<div class="alert alert-'.$notif.'"><button type="button" class="close" data-dismiss="alert">×</button> '.$msg.'</div>';
}

/**
 * Method untuk panggil component tinymc
 *
 * @param  string $element_id
 * @return string
 */
function get_tinymce($element_id, $theme = 'advanced', $remove_plugins = array(), $str_options = null)
{
    $tiny_plugins = array('emotions','syntaxhl','wordcount','pagebreak','layer','table','save','advhr','advimage','advlink','insertdatetime','preview','searchreplace','contextmenu','paste','directionality','fullscreen','noneditable','visualchars','nonbreaking','xhtmlxtras','template','inlinepopups','autosave','print','media','youtubeIframe','syntaxhl','tiny_mce_wiris');
    if (!empty($remove_plugins)) {
        $copy_tiny_plugins = $tiny_plugins;
        $combine           = array_combine($tiny_plugins, $copy_tiny_plugins);
        foreach ($remove_plugins as $rm) {
            unset($combine[$rm]);
        }
        $tiny_plugins = array_values($combine);
    }

    $return = '<script type="text/javascript" src="'.base_url('assets/comp/tinymce/tiny_mce.js').'"></script>'.PHP_EOL;
    $return .= '<script type="text/javascript">
        tinyMCE.init({
            selector: "textarea#'.$element_id.'",
            theme : "'.$theme.'",
            plugins : "'.implode(',', $tiny_plugins).'",';

            if (empty($str_options)) {
                $return .= 'theme_advanced_buttons1 : "undo,redo,bold,italic,underline,strikethrough,bullist,numlist,justifyleft,justifycenter,justifyright,justifyfull,blockquote,link,unlink,sub,sup,charmap,tiny_mce_wiris_formulaEditor,emotions,image,media,youtubeIframe,syntaxhl,code",
                    theme_advanced_buttons2 : "",
                    theme_advanced_buttons3 : "",
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_toolbar_align : "left",
                    theme_advanced_statusbar_location : "bottom",
                    file_browser_callback : "openKCFinder",
                    theme_advanced_resizing : true,
                    theme_advanced_resize_horizontal : false,
                    content_css : "'.base_url('assets/comp/tinymce/com/content.css').'",
                    convert_urls: false,
                    force_br_newlines : false,
                    force_p_newlines : false';
            } else {
                $return .= $str_options;
            }
    $return .= '});';

    $return .= 'function openKCFinder(field_name, url, type, win) {
            tinyMCE.activeEditor.windowManager.open({
                file: "'.base_url('assets/comp/kcfinder/browse.php?opener=tinymce&type=').'" + type,
                title: "KCFinder",
                width: 700,
                height: 500,
                resizable: "yes",
                inline: true,
                close_previous: "no",
                popup_css: false
            }, {
                window: win,
                input: field_name
            });
            return false;
        }
    </script>';
    return $return;
}

function is_ajax()
{
    /* AJAX check  */
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }
    return false;
}

/**
 * Method untuk mendapatkan link gambar
 *
 * @param  string $img
 * @param  string $size
 * @return string
 *
 */
function get_url_image($img, $size = '')
{
    if (empty($size)) {
        return base_url('./assets/images/users/'.$img);
    } else {
        $pisah     = explode('.', $img);
        $ext       = end($pisah);
        $nama_file = $pisah[0];

        return base_url('./assets/images/users/'.$nama_file.'_'.$size.'.'.$ext);
    }
}

function get_url_slides($img, $size = '')
{
    if (empty($size)) {
        return base_url('userfiles/slides/'.$img);
    } else {
        $pisah     = explode('.', $img);
        $ext       = end($pisah);
        $nama_file = $pisah[0];

        return base_url('userfiles/slides/'.$nama_file.'_'.$size.'.'.$ext);
    }
}

/**
 * Method untuk mendapatkan link foto pegawai
 *
 * @param  string $img
 * @param  string $size
 * @param  string $jk
 * @return string url
 */

function get_url_image_pegawai($img = '', $size = 'medium', $jk = 'Laki-laki') {
    if (is_null($img) OR empty($img)) {
        if ($jk == 'Laki-laki') {
            $img = 'default_pl.png';
        } else {
            $img = 'default_pp.png';
        }
        return get_url_image($img);
    } else {
        return get_url_image($img, $size);
    }
}

/**
 * Method untuk mendapatkan link foto pegawai/admin/pelamar ketika sudah login
 *
 * @param  string $img
 * @param  string $size
 * @param  string $jk
 * @return string url
 */
function get_url_image_session($img = '', $size = 'medium', $jk = 'Laki-laki') {
    if (is_pegawai() OR is_admin()) {
        return get_url_image_pegawai($img, $size, $jk);
    }
}

/**
 * Method untuk mendapatkan path image
 *
 * @param  string $img
 * @param  string $size medium|small, kalau aslinya di kosongkan
 * @return string paht
 */
function get_path_image($img = '', $size = '')
{
    if (empty($size)) {
        return './assets/images/upload'.$img;
    } else {
        $pisah = explode('.', $img);
        $ext = end($pisah);
        $nama_file = $pisah[0];

        return './assets/images/'.$nama_file.'_'.$size.'.'.$ext;
    }
}

function get_path_studi_luar_negeri($img = '', $size = '')
{
    if (empty($size)) {
        return './assets/images/studi-luar-negeri'.$img;
    } else {
        $pisah = explode('.', $img);
        $ext = end($pisah);
        $nama_file = $pisah[0];

        return './assets/images/'.$nama_file.'_'.$size.'.'.$ext;
    }
}

function get_path_penghargaan($img = '', $size = '')
{
    if (empty($size)) {
        return './assets/images/penghargaan'.$img;
    } else {
        $pisah = explode('.', $img);
        $ext = end($pisah);
        $nama_file = $pisah[0];

        return './assets/images/'.$nama_file.'_'.$size.'.'.$ext;
    }
}

function get_path_berita($img = '', $size = '')
{
    if (empty($size)) {
        return './assets/images/berita'.$img;
    } else {
        $pisah = explode('.', $img);
        $ext = end($pisah);
        $nama_file = $pisah[0];

        return './assets/images/'.$nama_file.'_'.$size.'.'.$ext;
    }
}

function get_path_fakta($img = '', $size = '')
{
    if (empty($size)) {
        return './assets/images/Fakta-Fakta'.$img;
    } else {
        $pisah = explode('.', $img);
        $ext = end($pisah);
        $nama_file = $pisah[0];

        return './assets/images/'.$nama_file.'_'.$size.'.'.$ext;
    }
}

function get_path_slides($img = '', $size = '')
{
    if (empty($size)) {
        return './assets/images/slideshow/'.$img;
    } else {
        $pisah = explode('.', $img);
        $ext = end($pisah);
        $nama_file = $pisah[0];

        return './assets/images/slideshow/'.$nama_file.'_'.$size.'.'.$ext;
    }
}

function get_path_videos($img = '', $size = '')
{
    if (empty($size)) {
        return './assets/videos/'.$img;
    } else {
        $pisah = explode('.', $img);
        $ext = end($pisah);
        $nama_file = $pisah[0];

        return './assets/videos/'.$nama_file.'_'.$size.'.'.$ext;
    }
}

function get_path_users($img = '', $size = '')
{
    if (empty($size)) {
        return './assets/images/users/'.$img;
    } else {
        $pisah = explode('.', $img);
        $ext = end($pisah);
        $nama_file = $pisah[0];

        return './assets/images/users/'.$nama_file.'_'.$size.'.'.$ext;
    }
}

/**
 * Deklarasi path file
 *
 * @param  string $file
 * @return string
 */
function get_path_file($file = '')
{

    $user_folder = './assets/files/' . get_post_data('userfiles');
    mkdir($user_folder, 0755);

    return $user_folder.'/'.$file;
}

/**
 * Method untuk mendapatkan flashdata
 *
 * @param  string $key
 * @return string
 */
function get_flashdata($key)
{
    $CI =& get_instance();

    return $CI->session->flashdata($key);
}

/**
 * Fungsi untuk mendapatkan bulan dengan nama indonesia
 *
 * @param  string $bln
 * @return string
 */
function get_indo_bulan($bln = '')
{
    $data = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    if (empty($bln)) {
        return $data;
    } else {
        $bln = (int)$bln;
        return $data[$bln];
    }
}

function get_indo_rmw($bln = '')
{
    $data = array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
    if (empty($bln)) {
        return $data;
    } else {
        $bln = (int)$bln;
        return $data[$bln];
    }
}
/**
 * Fungsi untuk mendapatkan bulan dengan nama indonesia
 *
 * @param  string $bln
 * @return string
 */
function get_indo_bln($bln = '')
{
    $data = array(1 => 'JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGT', 'SEP', 'OKT', 'NOV', 'DES');
    if (empty($bln)) {
        return $data;
    } else {
        $bln = (int)$bln;
        return $data[$bln];
    }
}

/**
 * Fungsi untuk mendapatkan nama hari indonesia
 *
 * @param  string $hari
 * @return string
 */
function get_indo_hari($hari = '')
{
    $data = array(1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu');
    if (empty($hari)) {
        return $data;
    } else {
        $hari = (int)$hari;
        return $data[$hari];
    }
}

/**
 * Method untuk memformat tanggal ke indonesia
 *
 * @param  string $tgl
 * @return string
 */
function tgl_indo($tgl = '')
{
    if (!empty($tgl)) {
        $pisah = explode('-', $tgl);
        return $pisah[2].' '.get_indo_bulan($pisah[1]).' '.$pisah[0];
    }
}

/**
 * Method untuk memformat tanggal dan jam ke format indonesia
 *
 * @param  string $tgl_jam
 * @return string
 */
function tgl_jam_indo($tgl_jam = '')
{
    if (!empty($tgl_jam)) {
        $pisah = explode(' ', $tgl_jam);
        return tgl_indo($pisah[0]).' '.date('H:i:s', strtotime($tgl_jam));
    }
}

/**
 * Metho untuk mendapatkan array post
 *
 * @param  string $key
 * @return string
 */
function get_post_data($key = '')
{
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }

    return;
}

/**
 * Method untuk mendapatkan huruf berdasarkan nomornya
 *
 * @param  integer $index
 * @return string
 */
function get_abjad($index)
{
    $abjad = array(1 => 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    return $abjad[$index];
}

/**
 * Method untuk enkripsi url
 *
 * @param  string $current_url
 * @return string
 */
function enurl_redirect($current_url)
{
    return str_replace(array("%2F","%5C"), array("%252F","%255C"), urlencode($current_url));
}

/**
 * Method untuk deskripsi url
 *
 * @param  string $url
 * @return string
 */
function deurl_redirect($url)
{
    return urldecode(urldecode($url));
}

function pr($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function get_data_array($array, $index1, $index2) {
    return $array[$index1][$index2];
}


/**
 * Method untuk mengaktifkan natif session
 * http://stackoverflow.com/questions/6249707/check-if-php-session-has-already-started
 */
function start_native_session()
{
    if (session_id() == '') {
        session_start();
    }
}

/**
 * Method untuk mendapatkan satu record tambahan
 *
 * @param  string $id
 * @return array
 */
function retrieve_field($id)
{
    return get_row_data('config_model', 'retrieve_field', array('id' => $id));
}

/**
 * Method untuk update field tambahan
 *
 * @param  string $id
 * @param  string $nama
 * @param  string $value
 * @return boolean
 */
function update_field($id, $nama = null, $value = null)
{
    return get_row_data('config_model', 'update_field', array($id, $nama, $value));
}

/**
 * Method untuk menghapus field tambahan berdasarkan id
 *
 * @param  string $id
 * @return boolean
 */
function delete_field($id)
{
    return get_row_data('config_model', 'delete_field', array('id' => $id));
}

/**
 * Method untuk membuat field tambahan
 *
 * @param  string $id
 * @param  string $nama
 * @param  string $value
 * @return boolean
 */
function create_field($id, $nama = null, $value = null)
{
    return get_row_data('config_model', 'create_field', array('id' => $id, 'nama' => $nama, 'value' => $value));
}


/**
 * Method untuk mendapatkan ip pengakses
 * @return string
 */
function get_ip()
{
    return $_SERVER['REMOTE_ADDR'];
}

/**
 * Method untuk mendapatkan email dari string
 *
 * @param  string $str
 * @return array
 */
function get_email_from_string($str)
{
    $pattern = '/[a-z\d._%+-]+@[a-z\d.-]+\.[a-z]{2,4}\b/i';

    preg_match_all($pattern, $str, $results);

    return $results[0];
}

/**
 * Method untuk ngecek sedang demo aplikasi atau tidak
 *
 * @return boolean
 */
function is_demo_app()
{
    $CI =& get_instance();
    $CI->load->config();
    return $CI->config->item('is_demo_app');
}

/**
 * Method untuk mendapatkan pesan jika sedang demo
 * @return string
 */
function get_demo_msg()
{
    return "Maaf, untuk keperluan demo aplikasi, halaman ini tidak dapat diperbaharui.";
}

/**
 * http://stackoverflow.com/questions/3475646/undefined-date-diff
 */
if (!function_exists('date_diff')) {
    function date_diff($date1, $date2)
    {
        $current = $date1;
        $datetime2 = date_create($date2);
        $count = 0;
        while(date_create($current) < $datetime2){
            $current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current)));
            $count++;
        }
        return $count;
    }
}

/**
 * Method untuk mendapatkan data dari url
 *
 * @param  string $url
 * @return string body
 */
function get_url_data($url)
{
    # jika curl hidup
    if (function_exists('curl_version')) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $response    = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header      = substr($response, 0, $header_size);
        $body        = substr($response, $header_size);
        $code        = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    } else {
        $body = file_get_contents($url);
    }

    return $body;
}

function slug($str) {
    $str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$str = preg_replace('/-+/', "-", $str);
	return rtrim($str, '-');
}

/* hari indonesia */
function indo_hari($hari = '') {
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

/* hari english */
function ing_hari($hari = '') {
    $day = date('l', strtotime($hari));
    return $day;
}

/* fungsi jam am atau pm */
function indo_time($time = '') {
    $jam = date("g:i a", strtotime($time));
    return $jam;
}

/* fungsi tanggal english */
function eng_tgl($tgl = '') {
    $tgl_eng = date('F jS, Y', strtotime($tgl));
    return $tgl_eng;
}

function folder_exist($folder)
{
    if (file_exists($folder==true))
    {
        // Return canonicalized absolute pathname
        return $folder;
    }

    // Path/folder does not exist
    return false;
}

function capitalize($str) {
    $data = strtolower($str);

    return ucfirst($data);
}

function slug_text($str) {
    $str = strtolower(trim($str));
    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = preg_replace('/-+/', "+", $str);
    return rtrim($str, '+');
}

// Nama Panggilan
function nama_panggilan()
{
    $CI =& get_instance();
    if ($CI->session->userdata('jk')=='1') {
        $panggilan = $CI->session->userdata('Fullname');
    } elseif($CI->session->userdata('jk')=='0') {
        $panggilan = $CI->session->userdata('Fullname');
    } else {
        $panggilan = $CI->session->userdata('Fullname');
    }
    return $panggilan;
}

// cek sudah login atau belum
function is_logged_in()
{
    $CI =& get_instance();
    if(empty($CI->session->userdata('UserGroup')))
    {
        return false;
    }
    return true;
}

// automatis logout
function restrict()
{
    if(is_logged_in() == false)
    {
        redirect(base_url().'master','refresh');
    }
}

function msg_fotter()
{
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $msg_fotter="
    <table style=\"border-collapse: collapse;border-spacing: 0;margin:0px;padding:0px;\">
        <tr>
            <td class='MsoNormal' style='margin-bottom:0cm;margin-bottom:.0001pt;line-height: normal'>
                <b><span style='font-size:8.0pt;font-family:Comic Sans MS;mso-fareast-font-family:Times New Roman;mso-bidi-font-family:Times New Roman;color:#2E74B5;mso-fareast-language:EN-ID'>
                                    &copy;".date('Y')." PT Prima Edu Pendamping Belajar</span></b>
            </td>
        </tr>
        <tr>
            <td class='MsoNormal' style='margin-bottom:0cm;margin-bottom:.0001pt;line-height: normal'>
            <b><span style='font-size:8.0pt;font-family:Arial Black, sans-serif;mso-fareast-font-family:Times New Roman;mso-bidi-font-family:Times New Roman;color:#111111;mso-fareast-language:EN-ID'>PRIMAGAMA</span></b>&nbsp;<b><span style='font-size:8.0pt;font-family:Comic Sans MS;mso-fareast-font-family: Times New Roman;mso-bidi-font-family:Times New Roman;color:#2E74B5; mso-fareast-language:EN-ID'></span></b><i><span style='font-size: 8pt; font-family: Garamond, serif; color: rgb(46, 116, 181);'>t</span></i><i><span style='font-size: 8pt; font-family: Garamond, serif; color: rgb(17, 85, 204);'>erdepan dalam prestasi</span></i><span style='font-size:9.5pt;font-family:Arial,sans-serif;mso-fareast-font-family: Times New Roman;color:#222222;mso-fareast-language:EN-ID'></span>
            </td>
        </tr>
        <tr>
            <td class='MsoNormal' style='margin-bottom:0cm;margin-bottom:.0001pt;line-height: normal'>
            <span style='font-size:8.0pt;font-family:Comic Sans MS;mso-fareast-font-family: Times New Roman;mso-bidi-font-family:Arial;color:#2E74B5;mso-fareast-language: EN-ID'>Jln. Ciasem I No. 9, Kebayoran Baru, Jakarta Selatan</span><span style='font-size:9.5pt;font-family:Arial,sans-serif; mso-fareast-font-family:Times New Roman;color:#222222;mso-fareast-language: EN-ID'></span>
            </td>
        <tr>
        <tr>
            <td class='MsoNormal' style='margin-bottom:0cm;margin-bottom:.0001pt;line-height: normal'>
                <span style='font-size:8.0pt;font-family:Comic Sans MS;mso-fareast-font-family: Times New Roman;mso-bidi-font-family:Times New Roman;color:#2E74B5; mso-fareast-language:EN-ID'>Telp: 021-29304102</span><span style='font-size: 9.5pt;font-family:Arial,sans-serif;mso-fareast-font-family:Times New Roman; color:#222222;mso-fareast-language:EN-ID'></span>
            </td>
        </tr>
        <tr>
            <td class='MsoNormal' style='margin-bottom:0cm;margin-bottom:.0001pt;line-height: normal'>
            <span style='font-size:8.0pt;font-family:Comic Sans MS;mso-fareast-font-family: Times New Roman;mso-bidi-font-family:Times New Roman;color:#2E74B5; mso-fareast-language:EN-ID'>website</span><span style='font-size:8.0pt; font-family:Comic Sans MS;mso-fareast-font-family:Times New Roman; mso-bidi-font-family:Times New Roman;color:#404040;mso-fareast-language:EN-ID'>:&nbsp;</span><u><span style='font-size:8.0pt;font-family:Comic Sans MS;mso-fareast-font-family: Times New Roman;mso-bidi-font-family:Times New Roman;color:#1155CC; mso-fareast-language:EN-ID'><a href='".$uri."www.primagama.co.id'>www.primagama.co.id</a></span><br></u>
            </td>
        </tr>
    </div>";
    return $msg_fotter;
}

function batch_email($params=array())
{
    $type = 1;
    if (isset($type) && $type==0) {
        require_once(APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php');
        $mail             = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = "smtp.office365.com";
        $mail->Port       = "587";
        $mail->Username   = "no-reply@primagama.co.id";
        $mail->Password   = "Prima.1234";
        $mail->SetFrom('no-reply@primagama.co.id', 'Primagama');
        //$mail->addReplyTo('helpdesk@primagama.co.id', 'Peserta Tryout Smart CBT');
        if (isset($params['penerima']) && !empty($params['penerima'])) {
            foreach ($params['penerima'] as $key => $value) {
                $mail->AddAddress($value);
            }
        }
        if (isset($params['addcc']) && !empty($params['addcc'])) {
            foreach ($params['addcc'] as $key => $value) {
                $mail->AddCC($value);
            }
        }
        if (isset($params['lampiran']) && !empty($params['lampiran'])) {
            foreach ($params['lampiran'] as $key => $value) {
                $mail->addAttachment($value);
            }
        }
        if (isset($params['subjek']) && !empty($params['subjek'])) {
            foreach ($params['subjek'] as $key => $value) {
                $mail->Subject = $value;
            }
        }
        if (isset($params['body']) && !empty($params['body'])) {
            foreach ($params['body'] as $key => $value) {
                $mail->MsgHTML($value);
            }
        }
        if(!$mail->send()) {
            $msg = $mail->ErrorInfo;
        } else {
            $msg = '1';
        }
        $mail->ClearAddresses();
        $mail->ClearAttachments();
        $mail->ClearAllRecipients();
        $mail->ClearCCs();
        $mail->ClearBCCs();
        return $msg;
    } else {
        $CI =& get_instance();
        $CI->load->library('email');
        $config = array(
            //'protocol'  => 'smtp',
            'protocol'  => 'sendmail',
            'smtp_host' => 'smtp.office365.com',
            'smtp_port' => 465,
            'smtp_user' => base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ='),
            'smtp_pass' => base64_decode('UHJpbWEuMTIzNA=='),
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'mailpath'  => '/usr/sbin/sendmail',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );
        $CI->email->initialize($config);
        $CI->email->set_mailtype("html");
        $CI->email->set_newline("\r\n");
        $mail_count= count($recipients);
        for($i=0;$i<$mail_count;$i++) {
            $CI->email->from(base64_decode('bm9yZXBseUBwcmltYWdhbWEuY28uaWQ='), 'PRIMAGAMA');
            $CI->email->to(TRIM($recipients[$i]));
            $CI->email->bcc('if.hamzah93@gmail.com');
            $CI->email->subject($subject[$i]);
            $CI->email->message($message[$i]);
            // $CI->email->attach($attach[$i]);
            if($CI->email->send()) {
                $msg = '1';
            } else {
                $msg = $CI->email->print_debugger();
            }
            $CI->email->clear(true);
        }
        return $msg;
    }
}

function getImageFromURL($path)
{
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;

}

function format_datetime($datetime)
{
    # format tanggal, jika hari ini
    if (date('Y-m-d') == date('Y-m-d', strtotime($datetime))) {
        $selisih = time() - strtotime($datetime) ;

        $detik = $selisih ;
        $menit = round($selisih / 60);
        $jam   = round($selisih / 3600);

        if ($detik <= 60) {
            if ($detik == 0) {
                $waktu = "baru saja";
            } else {
                $waktu = $detik.' detik yang lalu';
            }
        } else if ($menit <= 60) {
            $waktu = $menit.' menit yang lalu';
        } else if ($jam <= 24) {
            $waktu = $jam.' jam yang lalu';
        } else {
            $waktu = date('H:i', strtotime($datetime));
        }

        $datetime = $waktu;
    }
    # kemarin
    elseif (date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d')))) == date('Y-m-d', strtotime($datetime))) {
        $datetime = 'Kemarin ' . date('H:i', strtotime($datetime));
    }
    # lusa
    elseif (date('Y-m-d', strtotime('-2 day', strtotime(date('Y-m-d')))) == date('Y-m-d', strtotime($datetime))) {
        $datetime = '2 hari yang lalu ' . date('H:i', strtotime($datetime));
    }
    else {
        $datetime = tgl_jam_indo($datetime);
    }

    return $datetime;
}

function search_duplicate($array)
{
    $array_temp = array();

    foreach($array as $val)
    {
        if (!in_array($val, $array_temp)) {
            $array_temp[] = $val;
        } else {
            $data[] = $val;
        }
    }
   return $data;
}

/*function search_duplicate($array)
{
    $array_temp = array();

    $total=0;
    foreach($array as $val)
    {
        if (!in_array($val, $array_temp)) {
            $array_temp[] = $val;
        } else {
            foreach ($val as $key => $value) {
                $json .= $key.' : '.$value."<br>";
            }
            $total += count(json_encode($val));
        }
    }

    $data['duplicate'] = $json;
    $data['total'] = $total;
    return $data;
}*/

function data_json($output)
{
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json; charset=UTF-8');
    return json_encode($output);
}
