<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{{ rpt_title }}</title>
        <style>
            @font-face {
                font-family: "Open Sans";
                font-style: normal;
                font-weight: 400;
                src: local("Segoe UI"), local("Open Sans"), local("OpenSans"), url(https://themes.googleusercontent.com/static/fonts/opensans/v8/K88pR3goAWT7BTt32Z01mz8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
            }
            /* Table or Tabel */
            #bodyPrint {
                font-family: "Open Sans",Arial;font-size: 12px;
            }
            #tableReport .table {
                border-width: 1px;border-style: solid;border-collapse: collapse;border-color: #d6ba93;overflow-x: auto;min-height: 0.01%;
            }
            .table.striped tbody tr:nth-child(odd) {background: #f0f0f0}
            .table.bordered td, .table.bordered th {
                border: 1px #ddd solid;
            }
            .text-right {text-align: right}
            .text-left {text-align: left}
            .text-center {text-align: center}
            #tableReport td {
                vertical-align: top;font-size: 12px;
            }
            #tableReport .td {
                vertical-align: top;padding: 0.3em;border-width: 1px;border-style: solid;border-collapse: collapse;border-color: #000;word-wrap: break-word;
            }
            #tableReport th {
                vertical-align: middle;font-size: 12px;padding: 0.5em;border-width: 1px;border-style: solid;border-color: #000;background-color: #ccc;color: #000;font-weight: bold;
            }
            #bodyPrint .btn{display: inline-block;padding: 6px 12px;margin-bottom: 0;font-size: 14px;font-weight: normal;line-height: 1.42857143;text-align: center;white-space: nowrap;vertical-align: middle;-ms-touch-action: manipulation;touch-action: manipulation;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;background-image: none;border: 1px solid transparent;border-radius: 4px;text-decoration: none;}
            #bodyPrint .btn-success{color: #fff;background-color: #5cb85c;border-color: #4cae4c;}
            #bodyPrint .btn-primary {color: #fff;background-color: #337ab7;border-color: #2e6da4;}
            #bodyPrint a{display: block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 1.42857143;color: #333;white-space: nowrap;}
            #tableReport .tablePrintContent { width: 100%; }
            #tableReport .tablePrintContent, .tablePrintContent th, .tablePrintContent td { border: none; padding-top: 6px; }
            #tableReport .tablePrintContent td:nth-child(1) { width: 27%; }
            #tableReport .tablePrintContent td:nth-child(2) { width: 2%; text-align: center; }
            #tableReport .tablePrintContent td:nth-child(3) { border-bottom: 1px solid #000000; }
            #tableReport .tablePrintBottom { width: 100%; padding-top: 12px; }
            #tableReport .tablePrintBottom, .tablePrintBottom td { border: none; }
            #tableReport .tablePrintBottom td { width: 50% }
            #tableReport .signature { display: inline-block; }
            #tableReport .signatureFiller { display: inline-block; height: 10mm; }
            #tableReport .totalAmount { font-size: 12px; font-style: italic}
            #tableReport .posLeft { text-align: left; }
            #tableReport .posRight { text-align: right; }
            @media print {
                table {width: 100% !important;} 
            }
        </style>
        <style type="text/css" media="print">
            #bodyPrint #printLink {display: none;}
            #bodyPrint #downloadBtn {display: none;}
            #footer, .navbar, .page-title, .panel {display: none;}
        </style>
        {{ javascript_include('js/jquery/jquery.min.js') }}
        {{ javascript_include('js/autoNumeric.js') }}
        {{ javascript_include('js/jquery/jquery.table2excel.js') }}
        <script type="text/javascript">$(document).ready(function () {
                $(".idrCurrency").autoNumeric('init', {aSign: '', aDec: ',', aSep: '.'});
            });</script>
    </head>
    <body id="bodyPrint">
        {{ content() }}
    </body>
</html>