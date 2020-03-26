{{ content() }}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Kuitansi Pembayaran</title>
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
            #bodyPrint a{display: block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 1.42857143;color: #333;white-space: nowrap;}
            #tableReport .tablePrintContent { width: 100%; }
            #tableReport .tablePrintContent, .tablePrintContent th, .tablePrintContent td { border: none; padding-top: 3px; }
            #tableReport .tablePrintContent td:nth-child(1) { width: 20%; }
            #tableReport .tablePrintContent td:nth-child(2) { width: 2%; text-align: center; }
            #tableReport .tablePrintContent td:nth-child(3) { border-bottom: 1px solid #000000; width: 27%; }
            #tableReport .tablePrintContent td:nth-child(4) { width: 1% }
            #tableReport .tablePrintContent td:nth-child(5) { width: 20%; }
            #tableReport .tablePrintContent td:nth-child(6) { width: 2%; text-align: center; }
            #tableReport .tablePrintContent td:nth-child(7) { border-bottom: 1px solid #000000; width: 27%; }
            #tableReport .tablePrintBottom { width: 100%; padding-top: 8px; }
            #tableReport .tablePrintBottom, .tablePrintBottom td { border: none; }
            #tableReport .tablePrintBottom td { width: 50% }
            #tableReport .signature { display: inline-block; }
            #tableReport .signatureFiller { display: inline-block; height: 8mm; }
            #tableReport .totalAmount { font-size: 12px; font-style: italic}
            #tableReport .posLeft { text-align: left; }
            #tableReport .posRight { text-align: right; }
            @media print {
                table {width: 100% !important;} 
            }
        </style>
        <style type="text/css" media="print">
            #bodyPrint #printLink {display: none;}
            #footer, .navbar, .page-title, .panel {display: none;}
        </style>
        {{ javascript_include('js/jquery/jquery.min.js') }}
        {{ javascript_include('js/autoNumeric.js') }}
        {{ javascript_include('js/qrcode.min.js') }}
        <script type="text/javascript">$(document).ready(function () {
                $(".idrCurrency").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
            });</script>
    </head>
    <body id="bodyPrint">
        <span onclick="cetak({{PembayaranDetailID}});" id="printLink" class="btn btn-success" style="float:right">Print</span>
        <br/>
        {% set no = 1%}
        {% for datareport in data %}
            
            <table id="tableReport" border="0" style="border:#000 solid 2px; padding: 3px; width:700px;">
                <tr>
                    <td colspan="7">
                        <table style="width:100%;">
                            <tr>
                                <td style="text-align:center;vertical-align:middle;">
                                    <img src="{{ url("img/logo_new_web.png") }}" width="140">
                                </td>
                                <td align="center" width="75%">
                                    <h2 style="margin:5px"><u>KUITANSI PEMBAYARAN</u></h2>No. {{ datareport["documentno"] }}
                                </td>
                                <td width="25%" align="right">
                                    <div id="qrcode-{{no}}"></div>
                                </td>
                            </tr>
                        </table>    
                    </td>
                </tr>
                <tr>
                    <td colspan="7"><hr color="#000000"/></td>
                </tr>
                <tr>
                    <td colspan="7">
                        <table class="tablePrintContent">
                            <tr>
                                <td>Cabang</td>
                                <td>:</td>
                                <td colspan="5">{{ datareport["cabang"] }}</td>
                            </tr>
                            <tr>
                                <td>Sudah diterima dari</td>
                                <td>:</td>
                                <td>{{ datareport["namasiswa"] }}</td>
                                <td></td>
                                <td>No. Siswa</td>
                                <td>:</td>
                                <td>{{ datareport["nosiswa"] }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{{ datareport["tanggal"] }}</td>
                                <td></td>
                                <td>Program</td>
                                <td>:</td>
                                <td>{{ datareport["program"] }}</td>
                            </tr>
                            <tr>
                            </tr>
                            <tr>
                                <td>Jumlah Pembayaran</td>
                                <td>:</td>
                                <td class="idrCurrency">{{ datareport["jumlahuang"] }}</td>
                                <td></td>
                                <td>Sisa Pembayaran</td>
                                <td>:</td>
                                <td class="idrCurrency">{{ datareport["sisabayar"] }}</td>
                            </tr>
                            <tr>
                                <td>Untuk Pembayaran</td>
                                <td>:</td>
                                <td>{{ datareport["bayaruntuk"]|capitalize }}</td>
                                <td></td>
                                <td>Tanggal Jatuh Tempo</td>
                                <td>:</td>
                                <td>{{ datareport["jatuhtempo"] }}</td>
                            </tr>
                        </table>
                        <table class="tablePrintBottom">
                            <tr>
                                <td class="posLeft">
                                    <table style="width:100%; margin-bottom: 70px">
                                        <tr>
                                            <td class="totalAmount">Terbilang : {{ datareport["terbilang"]|capitalize }}</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width:20%">
                                    <table style="width:100%; margin-bottom: 70px">
                                        <tr>
                                            <td colspan="2" align="center">{{ datareport["location"]|default("Jakarta") }}, {{ datareport["now"]|default(date('d-m-Y')) }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="posLeft">
                                    <table style="width:100%">
                                        <tr>
                                            <td align="left" style="font-weight:bold; font-size: 10px"><em><i>Dokumen ini merupakan bukti pembayaran resmi yg dicetak oleh sistem<br/>(Cetakan Ke-<span class="print-counter">{{PrintCounter}}</span>)</i></em></td>
                                        </tr>

                                    </table>
                                </td>
                                <td style="width:20%">
                                    <table style="width:100%">
                                        <tr>
                                            <td colspan="2" align="center">(...............................................................)</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            {% set no = no + 1 %}
            {% if not loop.last %}
                <div style="display: block; height: 5px"></div>
            {% endif %}
        {% endfor %}

        <script type="text/javascript">
            var link = "{{url()}}pymt/qr/{{QRCodeNumber}}";
            console.log(link);
            var qrcode = new QRCode(document.getElementById("qrcode-1"), {
                text: link,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            var qrcode = new QRCode(document.getElementById("qrcode-2"), {
                text: link,
                width: 70,
                height: 70,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            function cetak(pembayaranDetalID){
                var base_url = "{{url()}}";
                $.ajax({
                    "url": base_url + 'Pembayaran/updatePrintCounter',
                    "type": 'POST',
                    "data": {id: pembayaranDetalID},
                    "dataType": 'json',
                    "success": function (res) {
                        if(res.status === true){
                            $(".print-counter").html(res.message);
                            window.print();
                        }
                        console.log(res.message);
                    },
                    "error": function (errMsg) {
                        console.log(errMsg);
                    }
                });
            };
        </script>
    </body>
</html>