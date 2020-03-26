<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Tanda Terima Buku</title>
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
            #tableReport .tablePrintContent, .tablePrintContent th, .tablePrintContent td { border: none; padding-top: 6px; }
            #tableReport .tablePrintContent td:nth-child(1) { width: 27%; }
            #tableReport .tablePrintContent td:nth-child(2) { width: 2%; text-align: center; }
            #tableReport .tablePrintContent td:nth-child(3) { border-bottom: 1px solid #000000; }
            #tableReport .tablePrintBottom { width: 100%; padding-top: 12px; }
            #tableReport .tablePrintBottom, .tablePrintBottom td { border: none; }
            #tableReport .tablePrintBottom td { width: 100% }
            #tableReport .signature { display: inline-block; width: 100% }
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
            #footer, .navbar, .page-title, .panel {display: none;}
        </style>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".idrCurrency").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
            });</script>
    </head>
    <body id="bodyPrint">
            <table id="tableReport" border="0" style="border:#000 solid 2px; padding: 5px; width:700px;">
                <tr>
                    <td colspan="7">
                        <table style="width:100%;">
                            <tr>
                                <td align="center"><img src="<?php echo base_url()?>assets/images/logo-primagama-kiri-small.png" width="120"></td>
                                <td align="center" width="75%">
                                    <h2><u>TANDA TERIMA BUKU</u></h2>
                                </td>
                                <td width="20%" align="right">
                                        <a href="#" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
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
                                <td>Tanggal</td>
                                <td>:</td>
                                <td><?php echo $tanggal ?></td>
                            </tr>
                            <tr>
                                <td>Nama Siswa</td>
                                <td>:</td>
                                <td><?php echo $namasiswa ?></td>
                            </tr>
                            <tr>
                                <td>Program</td>
                                <td>:</td>
                                <td><?php echo $program ?></td>
                            </tr>
                            <tr>
                                <td>Nama Buku</td>
                                <td>:</td>
                                <td><?php echo $namabuku ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Buku</td>
                                <td>:</td>
                                <td><?php echo $jumlah ?></td>
                            </tr>
                            <tr>
                                <td>Barcode</td>
                                <td>:</td>
                                <td><?php echo $barcode ?></td>
                            </tr>
                        </table>
                        <table class="tablePrintBottom">
                            <tr>
                                <td class="posLeft" style="width: 20%">
                                    <table class="signature">
                                        <tr>
                                            <td colspan="2" align="center">Diserahkan oleh,</td>
                                        </tr>
                                        <tr>
                                            <td class="signatureFiller" colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="posLeft">(</td>
                                            <td class="posRight">)</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 60%">&nbsp;</td>
                                <td class="posRight" style="width: 20%">
                                    <table class="signature">
                                        <tr>
                                            <td colspan="2" align="center">Diterima oleh,</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="signatureFiller"></td>
                                        </tr>
                                        <tr>
                                            <td class="posLeft">(</td>
                                            <td class="posRight">)</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div style="display: block; height: 48px"></div>
            <div style="page-break-after: always"></div>
            <table id="tableReport" border="0" style="border:#000 solid 2px; padding: 5px; width:700px;">
                <tr>
                    <td colspan="7">
                        <table style="width:100%;">
                            <tr>
                                <td align="center"><img src="<?php echo base_url()?>assets/images/logo-primagama-kiri-small.png" width="120"></td>
                                <td align="center" width="75%">
                                    <h2><u>TANDA TERIMA BUKU</u></h2> 
                                </td>
                                <td width="20%" align="right">
                                        <a href="#" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
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
                                <td>Tanggal</td>
                                <td>:</td>
                                <td><?php echo $tanggal ?></td>
                            </tr>
                            <tr>
                                <td>Nama Siswa</td>
                                <td>:</td>
                                <td><?php echo $namasiswa ?></td>
                            </tr>
                            <tr>
                                <td>Program</td>
                                <td>:</td>
                                <td><?php echo $program ?></td>
                            </tr>
                            <tr>
                                <td>Nama Buku</td>
                                <td>:</td>
                                <td><?php echo $namabuku ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Buku</td>
                                <td>:</td>
                                <td><?php echo $jumlah ?></td>
                            </tr>
                            <tr>
                                <td>Barcode</td>
                                <td>:</td>
                                <td><?php echo $barcode ?></td>
                            </tr>
                        </table>
                        <table class="tablePrintBottom">
                            <tr>
                                <td class="posLeft" style="width: 20%">
                                    <table class="signature">
                                        <tr>
                                            <td colspan="2" align="center">Diserahkan oleh,</td>
                                        </tr>
                                        <tr>
                                            <td class="signatureFiller" colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="posLeft">(</td>
                                            <td class="posRight">)</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 60%">&nbsp;</td>
                                <td class="posRight" style="width: 20%">
                                    <table class="signature">
                                        <tr>
                                            <td colspan="2" align="center">Diterima oleh,</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="signatureFiller"></td>
                                        </tr>
                                        <tr>
                                            <td class="posLeft">(</td>
                                            <td class="posRight">)</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div style="display: block; height: 48px"></div>
            <div style="page-break-after: always"></div>
            <table id="tableReport" border="0" style="border:#000 solid 2px; padding: 5px; width:700px;">
                <tr>
                    <td colspan="7">
                        <table style="width:100%;">
                            <tr>
                                <td align="center"><img src="<?php echo base_url()?>assets/images/logo-primagama-kiri-small.png" width="120"></td>
                                <td align="center" width="75%">
                                    <h2><u>TANDA TERIMA BUKU</u></h2>
                                </td>
                                <td width="20%" align="right">
                                        <a href="#" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
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
                                <td>Tanggal</td>
                                <td>:</td>
                                <td><?php echo $tanggal ?></td>
                            </tr>
                            <tr>
                                <td>Nama Siswa</td>
                                <td>:</td>
                                <td><?php echo $namasiswa ?></td>
                            </tr>
                            <tr>
                                <td>Program</td>
                                <td>:</td>
                                <td><?php echo $program ?></td>
                            </tr>
                            <tr>
                                <td>Nama Buku</td>
                                <td>:</td>
                                <td><?php echo $namabuku ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Buku</td>
                                <td>:</td>
                                <td><?php echo $jumlah ?></td>
                            </tr>
                            <tr>
                                <td>Barcode</td>
                                <td>:</td>
                                <td><?php echo $barcode ?></td>
                            </tr>
                        </table>
                        <table class="tablePrintBottom">
                            <tr>
                                <td class="posLeft" style="width: 20%">
                                    <table class="signature">
                                        <tr>
                                            <td colspan="2" align="center">Diserahkan oleh,</td>
                                        </tr>
                                        <tr>
                                            <td class="signatureFiller" colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="posLeft">(</td>
                                            <td class="posRight">)</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 60%">&nbsp;</td>
                                <td class="posRight" style="width: 20%">
                                    <table class="signature">
                                        <tr>
                                            <td colspan="2" align="center">Diterima oleh,</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="signatureFiller"></td>
                                        </tr>
                                        <tr>
                                            <td class="posLeft">(</td>
                                            <td class="posRight">)</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div style="display: block; height: 48px"></div>
    </body>
</html>
<script>

$(document).ready(function(){
var tbl = document.getElementById("tableReport");
var text = "";
var i;
for (i = 0; i < 3; i++) {
    text += tbl;
}
document.getElementById("tableReport");
});

</script>
<script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>