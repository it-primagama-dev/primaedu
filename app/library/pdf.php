<?php

require_once __DIR__ . '/../../vendor/mpdf/mpdf.php';
require_once 'HTMLTemplate.php';

class pdf extends \Phalcon\Mvc\User\Component {

    function pdf_output($title, $content, $copy = 0) {
        $mpdf = new mPDF();
        $mpdf->SetDisplayMode('fullpage');

        //load style sheet
        $stylesheet = file_get_contents('css/print.css');
        $mpdf->WriteHTML($stylesheet, 1); // The parameter 1 tells that this is css/style only and no body/html/text
        //write HTML
        $header = new HTMLtemplate();
        $mpdf->WriteHTML($header->bodyHTML($title, $content));

        //Generate Copy(s)
        for ($copys = 0; $copys < $copy; $copys++) {
            $mpdf->WriteHTML($header->bodyHTML($title, $content));
        }

        $mpdf->Output();
        exit;
    }

    function pdf_output_l($title, $content, $copy = 0) {
        $mpdf = new mPDF('s','A4-L');
        $mpdf->SetDisplayMode('fullpage');

        //load style sheet
        $stylesheet = file_get_contents('css/print.css');
        $mpdf->WriteHTML($stylesheet, 1); // The parameter 1 tells that this is css/style only and no body/html/text
        //write HTML
        $header = new HTMLtemplate();
        $mpdf->WriteHTML($header->bodyHTML($title, $content));

        //Generate Copy(s)
        for ($copys = 0; $copys < $copy; $copys++) {
            $mpdf->WriteHTML($header->bodyHTML($title, $content));
        }

        $mpdf->Output();
        exit;
    }
}

?>
