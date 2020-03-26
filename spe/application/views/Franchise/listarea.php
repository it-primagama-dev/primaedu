<form action="#" id="myform" class="form-horizontal">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list"> Laporan Detail Franchise Fee Per-Area</i></p>
                <legend></legend>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-6">
                    <label>Pilih Area</label>
                    <select id="Area" name="Area" class="form-control">
                        <option value=""> - - Pilih Area - - </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-5">
                    <button type="button" class="btn btn-success print-hidden" onclick="load_data()"><span class="glyphicon glyphicon-search"></span> Cari</button>
                </div>
            </div>
            <legend></legend>
        </div>
    </div>
    <div class="row" id="idtable" style="display: none;">
        <div class="col-lg-12">
            <table class="display nowrap table-bordered table-hover" style="width:100%;" cellpadding="0" cellspacing="0" border="0" id="tableMenu">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="text-align: center;">Kode Cabang</th>
                        <th style="text-align: center;">Nama Cabang</th>
                        <th style="text-align: center;">Awal Kontrak</th>
                        <th style="text-align: center;">Akhir Kontrak</th>
                        <th style="text-align: center;">Saldo Awal Hutang</th>
                        <th style="text-align: center;">Nilai Franchisee</th>
                        <th style="text-align: center;">Diskon</th>
                        <th style="text-align: center;">DPP</th>
                        <th style="text-align: center;">Pajak</th>
                        <th style="text-align: center;">Tagihan FF</th>
                        <th style="text-align: center;">Pembayaran</th>
                        <th style="text-align: center;">Sisa Pembayaran</th>
                        <th style="text-align: center;">Tanggal MOU</th>
                        <th style="text-align: center;">No. KTP</th>
                        <th style="text-align: center;">NO. NPWP</th>
                        <th style="text-align: center;">Keterangan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</form>

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Title</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" id="RecID" name="RecID" />
                    <div class="form-body"> 
                        <i class="fa" id="Cabang" style="font-size: 25px;"></i>  <br> </br>              
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="isi" class="table-responsive">
                                    <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="example2">
                                        <thead>
                                            <tr class="text-center">
                                                <th colspan="3" width="60%" style="text-align: left">Saldo Awal Hutang</th>
                                                <th width="40%" style="text-align: right;" id="SA"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="3" width="60%" style="text-align: left">Tagihan FF</th>
                                                <th width="40%" style="text-align: right;" id="TFF"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="3" width="60%" style="text-align: left">Total</th>
                                                <th width="40%" style="text-align: right;" id="TotTag"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="4" width="100%" style="text-align: center">Detail Pembayaran</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th width="5%" style="text-align: center">#</th>
                                                <th width="35%" style="text-align: center">No. Kwitansi</th>
                                                <th width="30%" style="text-align: center">Tanggal Transaksi</th>
                                                <th width="30%" style="text-align: center">Jumlah Bayar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_pay"></tbody>
                                        <tfoot>
                                            <tr class="text-center">
                                                <th colspan="3" width="60%" style="text-align: left"> Pembayaran Sebelum Sistem</th>
                                                <th width="40%" style="text-align: right;" id="PSS"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="3" width="60%" style="text-align: left">Total Pembayaran</th>
                                                <th width="40%" style="text-align: right;" id="TOTPAY"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="3" width="60%" style="text-align: left">Sisa Pembayaran / Saldo Akhir Hutang</th>
                                                <th width="40%" style="text-align: right;" id="BILL"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <b><i><u>Keterangan :</u></i></b><br/>
                                <span style="margin: 5px; padding:0px 5px 0px 5px; background-color: red">&nbsp;&nbsp;</span> <i>dialihkan</i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal_form2" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Title</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" id="RecID" name="RecID" />
                    <div class="form-body"> <!-- 
                        <i class="fa" id="Cabang" style="font-size: 25px;"></i>  <br> </br>      -->         
                        <div class="row">
                            <div class="col-lg-12">
                                    <div id="divtenor" class="col-lg-12">
                                        <label>Tabel Tenor</label>
                                        <table class="table table-bordered table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%; text-align: center;">Tenor Ke-</th>
                                                    <th style="text-align: center;">Nominal</th>
                                                    <th style="text-align: center;">Jatuh Tempo</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ttenor"></tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.css">-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/datatables/responsive.bootstrap.min.css">
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jQueryBarcode.js"></script> -->
<!--<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datatables/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/js/css/select2.custom.min.css">
<script src="<?= base_url('assets/js/autoNumeric.js'); ?>"></script>
<style type="text/css">
    .table-total td{
        background: #337ab7 !important;
        color: #fff;
        font-weight: bold;
    }
    .border-0{
        border: 0px #337ab7 !important;
    }
</style>
<script type="text/javascript">

                        $(document).ready(function () {
                            var table = $('#example').DataTable({
                                "scrollY": 200,
                                "scrollX": true
                            });
                            $('#idtable').css('display', 'block');
                            table.columns.adjust().draw();
                            get_area();
                        });

                        $(function () {
                            $('#Area').select2();
                        });

                        function get_area() {
                            $.getJSON(base_url + "Franchise/get_area", function (json) {
                                $('#Area').empty();
                                $('#Area').append($('<option>').text("- - Pilih Area - -").attr('value', ''));
                                $.each(json, function (i, obj) {
                                    $('#Area').append($('<option>').text(obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
                                });
                            });
                        }
                        var jQueryTable;
                        var jQueryTable2;
                        var footerData = [];
                        $("#tableMenu").DataTable({
                            "scrollY": 0,
                            "scrollX": true
                        });
                        function load_data() {
                            Area = $('#Area').val();
                            //alert(ItemCode);
                            $("#tableMenu").DataTable().destroy();
                            $('#tableMenuFoot').empty();
                            if ($('[name="Area"]').val() == "") {
                                $('[name="Area"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Pilih Area !</p>');
                                $('[name="Area"]').focus();
                                return false;
                            } else {
                                $('#idtable').css('display', 'block');
                                jQueryTable = $("#tableMenu").DataTable({
                                    "scrollY": 400,
                                    "scrollX": true,
                                    "scrollCollapse": true,
                                    "ajax": {
                                        "url": base_url + "Franchise/loadlistarea",
                                        "type": "POST",
                                        "data": ({"token": window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="), "Area": window.btoa(Area)}),
                                        "dataType": "JSON",
                                        "dataSrc": function (json) {
                                            addRow(json);
                                            return json.data;
                                        }
                                    },
                                    "columns": [
                                        {"data": "RowNum", "autoWidth": true},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                            return "<a href='#' onclick='load_modal2(" + data.ID + ");'>" + data.KodeCabang;
                                                            +"</a>"
                                                    }},
                                        {"data": "NamaCabang", "autoWidth": true},
                                        {"data": "DateFrom", "autoWidth": true},
                                        {"data": "DateTo", "autoWidth": true},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.BGN == 0) {
                                                            if (data.SBGN != undefined) {
                                                                return convertToRupiah(data.SBGN);
                                                            } else {
                                                                return convertToRupiah(0);
                                                            }
                                                        } else {
                                                            return convertToRupiah(data.BGN);
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.VAL == 0) {
                                                            if (data.SVAL != undefined) {
                                                                return convertToRupiah(data.SVAL);
                                                            } else {
                                                                return convertToRupiah(0);
                                                            }
                                                        } else {
                                                            return convertToRupiah(data.VAL);
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.DIS == 0) {
                                                            if (data.SDIS != undefined) {
                                                                return convertToRupiah(data.SDIS);
                                                            } else {
                                                                return convertToRupiah(0);
                                                            }
                                                        } else {
                                                            return convertToRupiah(data.DIS);
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.DPP == 0) {
                                                            if (data.SDPP != undefined) {
                                                                return convertToRupiah(data.SDPP);
                                                            } else {
                                                                return convertToRupiah(0);
                                                            }
                                                        } else {
                                                            return convertToRupiah(data.DPP);
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        ppn = 10 / 100 * data.DPP;
                                                        if (data.DPP == 0) {
                                                            if (data.SPPN != undefined) {
                                                                return convertToRupiah(data.SPPN);
                                                            } else {
                                                                return convertToRupiah(0);
                                                            }
                                                        } else {
                                                            return convertToRupiah(ppn);
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.NET == 0) {
                                                            if (data.STOT != undefined) {
                                                                return convertToRupiah(data.STOT);
                                                            } else {
                                                                return convertToRupiah(0);
                                                            }
                                                        } else {
                                                            return convertToRupiah(data.NET);
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.PAY == 0) {
                                                            if (data.SPAY != undefined) {
                                                                return convertToRupiah(data.SPAY);
                                                            } else {
                                                                return convertToRupiah(0);
                                                            }
                                                        } else {
                                                            var pay = parseInt(data.PAY) || 0;
                                                            var dialihkan = parseInt(data.Dialihkan) || 0;
                                                            var tot = pay - dialihkan;
                                                            return "<a href='#' onclick='load_modal(" + data.ID + ");'>" + convertToRupiah(tot);
                                                            +"</a>"
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.BILL == 0) {
                                                            if (data.SBILL != undefined) {
                                                                return convertToRupiah(data.SBILL);
                                                            } else {
                                                                return convertToRupiah(0);
                                                            }
                                                        } else {
                                                            var bill = parseInt(data.BILL) || 0;
                                                            var dialihkan = parseInt(data.Dialihkan) || 0;
                                                            var tot = bill + dialihkan;
                                                            return convertToRupiah(tot);
                                                        }
                                                    }},
                                        {"data": "DateMOU", "autoWidth": true},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.KTP == null) {
                                                            return data.NoKTP;
                                                        } else {
                                                            return '<a href="' + base_url + 'Franchise/download/' + data.KTP + '">' + data.NoKTP;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.NPWP == null) {
                                                            return data.NoNPWP;
                                                        } else {
                                                            return '<a href="' + base_url + 'Franchise/download/' + data.NPWP + '">' + data.NoNPWP;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": "Description", "autoWidth": true},
                                    ],
                                    'iDisplayLength': 10000,
                                    dom: 'Bfrtip',
                                    buttons: [
                                        'excel'
                                    ],
                                    "initComplete": function (settings, json) {
//                                        console.log("init complete");
//                                        console.log(footerData);
                                        $('#idtable').css('display', 'block');
                                        jQueryTable.columns.adjust().draw();
                                        jQueryTable.row.add(footerData).draw(false);
//                                        $("#tableMenu").append(addRowHTML);
                                    },
                                    createdRow: function (row, data, dataIndex) {
                                        if (data.RowNum == "") {
                                            $(row).addClass('table-total');
                                        }
                                    },
                                    "columnDefs": [
                                        {
                                            "targets": [0,1,2,3,4,13,14,15,16],
                                            "createdCell": function (td, cellData, rowData, row, col) {
//                                                console.log(rowData);
                                                if (rowData.RowNum == "") {
                                                    $(td).addClass('border-0');
                                                }
                                            }
                                        }
                                    ]
                                            //dom: "<'row'<'col-lg-1 col-xs-12'f><'col-lg-11 col-sm-12'B>>",
                                            /*buttons: [
                                             {
                                             extend: 'excel', footer: true,
                                             text: '<button type="button" class="btn btn-info pull-right"><span class="glyphicon glyphicon-download"></span> Download</button>',
                                             className: 'exportExcel',
                                             filename: 'Laporan FF Per-Area',
                                             exportOptions: {
                                             modifier: {
                                             page: 'all'
                                             }
                                             }
                                             }]*/

                                });
                                if ($.fn.DataTable.isDataTable('#tableMenu')) {
//                                    console.log("init");
                                }

//                                jQueryTable.columns.adjust().fixedColumns().relayout().draw();

                                $.ajax({
                                    url: base_url + "Franchise/loadlistarea",
                                    type: 'POST',
                                    data: ({Area: window.btoa(Area), token: window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=")}),
                                    dataType: 'json',
                                    success: function (data) {
                                        //$('#tableMenuFoot').empty();
                                        //alert('TES');
                                        var jml_data = Object.keys(data.rows).length;
                                        var SBGN = 0;
                                        var SVAL = 0;
                                        var SDIS = 0;
                                        var SDPP = 0;
                                        var SPPN = 0;
                                        var STOT = 0;
                                        var SPAY = 0;
                                        var SBILL = 0;
                                        $.each(data.rows, function (i, item) {
                                            var itemPay = parseInt(item.PAY) || 0;
                                            var itemDialihkan = parseInt(item.Dialihkan) || 0;
                                            var itemBill = parseInt(item.BILL) || 0;
                                            var pay = itemPay - itemDialihkan;
                                            var bill = itemBill + itemDialihkan;
                                            SBGN += parseInt(item.BGN) || 0;
                                            SVAL += parseInt(item.VAL) || 0;
                                            SDIS += parseInt(item.DIS) || 0;
                                            SDPP += parseInt(item.VAL - item.DIS) || 0;
                                            SPPN += parseInt(10 / 100 * (item.VAL - item.DIS)) || 0;
                                            STOT += parseInt(item.TOT) || 0;
                                            SPAY += parseInt(pay) || 0;
                                            SBILL += parseInt(bill) || 0;
                                        });
//                                        $("#tableMenu").append(
//                                                $('<tfoot/>').append(
//                                                $("<tr id='tableMenuFoot'>").append(
//                                                $('<th colspan="5" style="text-align:center;">').text('Jumlah Total'),
//                                                $('<th style="text-align:center;">').text(convertToRupiah(SBGN)),
//                                                $('<th style="text-align:center;">').text(convertToRupiah(SVAL)),
//                                                $('<th style="text-align:center;">').text(convertToRupiah(SDIS)),
//                                                $('<th style="text-align:center;">').text(convertToRupiah(SDPP)),
//                                                $('<th style="text-align:center;">').text(convertToRupiah(SPPN)),
//                                                $('<th style="text-align:center;">').text(convertToRupiah(STOT)),
//                                                $('<th style="text-align:center;">').text(convertToRupiah(SPAY)),
//                                                $('<th style="text-align:center;">').text(convertToRupiah(SBILL)),
//                                                $('<th colspan="4" style="text-align:center;">').text(''),
//                                                ))
//                                                );
                                    }
                                });
                            }
                        }

                        function load_modal(FFID)
                        {
                            //alert(FFID);
                            $.ajax({
                                url: base_url + "Franchise/loaddetailtrx/" + FFID,
                                type: "GET",
                                dataType: "JSON",
                                success: function (data)
                                {
                                    $('#data_pay').empty();/*
                                     var jml_data = Object.keys(data.rows).length;
                                     if (jml_data > 0) {*/
                                    var SAL = 0;
                                    var TOT = 0;
                                    var PSS = 0;
                                    var TP = 0;
                                    var TT = 0;
                                    var BILL = 0;
                                    var TOTLIST = 0;
                                    var DIALIHKAN = 0;
                                    $.each(data.rows, function (i, item) {

                                        if (item.AMN == '' || item.AMN == null) {
                                            $('#data_item').empty();
                                            var $tr = $('<tr>').append(
                                                    $('<td colspan="3" style="text-align: center;">').text('- - - No Data - - -'),
                                                    ).appendTo('#data_pay');
                                        } else {
                                            date = item.DATE;
                                            datefrmt = date.replace(/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/, "$1-$2-$3 $4:$5:$6");

                                            var dialihkan_mark = '';
                                            if (item.AMN == item.Dialihkan) {
                                                dialihkan_mark = 'style="background-color:red;color:white"';
                                            }
                                            if(item.Receipt=='#' || item.Receipt == null){
                                                Receipt = item.Receipt;
                                            } else {
                                                Receipt = '<a href="javascript:void(0)" onclick="print('+item.RecID+')">'+item.Receipt+'</a>';
                                            }
                                            var $tr = $('<tr ' + dialihkan_mark + '>').append(
                                                    $('<td>').text(i + 1),
                                                    $("<td style='text-align: center;'>").html(Receipt),
                                                    $("<td style='text-align: center;'>").text(tgl_indo_time2(datefrmt)),
                                                    $("<td style='text-align: right;'>").text(convertToRupiah(item.AMN))
                                                    ).appendTo('#data_pay');
                                        }
                                        DIALIHKAN = parseInt(item.Dialihkan) || 0;
                                        SAL = parseInt(item.BGN) || 0;
                                        SAL = parseInt(item.BGN) || 0;
                                        PSS = parseInt(item.PCA) || 0;
                                        TOT = parseInt(item.TOT) || 0;
                                        TOTLIST += parseInt(item.AMN) || 0;
                                        PSS = parseInt(item.PCA) || 0;
                                        TT = TOT + SAL;
                                        TP = (TOTLIST + PSS) - DIALIHKAN;
                                        Cabang = 'Cabang : ' + item.KodeCabang + ' - ' + item.NamaCabang;
                                    });

                                    $('#SA').text(convertToRupiah(SAL));
                                    $('#TFF').text(convertToRupiah(TOT));
                                    $('#TotTag').text(convertToRupiah(TOT + SAL));
                                    $('#PSS').text(convertToRupiah(PSS));
                                    $('#TOTPAY').text(convertToRupiah(TP));
                                    $('#BILL').text(convertToRupiah(TT - TP));
                                    $('#Cabang').text(Cabang);
                                    $('#modal_form').modal('show');
                                    $('.modal-title').text('Detail Transaksi Pembayaran Franchise');
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });
                        }

                        function addRow(data) {
                            var SBGN = 0;
                            var SVAL = 0;
                            var SDIS = 0;
                            var SDPP = 0;
                            var SPPN = 0;
                            var STOT = 0;
                            var SPAY = 0;
                            var SBILL = 0;
                            $.each(data.rows, function (i, item) {
                                var itemPay = parseInt(item.PAY) || 0;
                                var itemDialihkan = parseInt(item.Dialihkan) || 0;
                                var itemBill = parseInt(item.BILL) || 0;
                                var pay = itemPay - itemDialihkan;
                                var bill = itemBill + itemDialihkan;
                                SBGN += parseInt(item.BGN) || 0;
                                SVAL += parseInt(item.VAL) || 0;
                                SDIS += parseInt(item.DIS) || 0;
                                SDPP += parseInt(item.VAL - item.DIS) || 0;
                                SPPN += parseInt(10 / 100 * (item.VAL - item.DIS)) || 0;
                                STOT += parseInt(item.TOT) || 0;
                                SPAY += parseInt(pay) || 0;
                                SBILL += parseInt(bill) || 0;
                            });

                            footerData = {
                                "RowNum": "",
                                "KodeCabang": "",
                                "NamaCabang": "JUMLAH TOTAL",
                                "DateFrom": "",
                                "DateTo": "",
                                "BGN": 0,
                                "VAL": 0,
                                "DIS": 0,
                                "DPP": 0,
                                "NET": 0,
                                "PAY": 0,
                                "BILL": 0,
                                "DateMOU": "",
                                "KTP": null,
                                "NoKTP": "",
                                "NPWP": null,
                                "NoNPWP": "",
                                "Description": "",
                                "SBGN": SBGN,
                                "SVAL": SVAL,
                                "SDIS": SDIS,
                                "SDPP": SDPP,
                                "SPPN": SPPN,
                                "STOT": STOT,
                                "SPAY": SPAY,
                                "SBILL": SBILL
                            }
                        }

                        function load_modal2(FFID)
                        {
                            //alert(FFID);
                            $.ajax({
                                url: base_url + "Franchise/loadpaymentmethod/" + FFID,
                                type: "GET",
                                dataType: "JSON",
                                success: function (data)
                                {
                                    $('#ttenor').empty();
                                    var jml_data = Object.keys(data.rowse).length;
                                    if(jml_data > 0){
                                        $.each(data.rowse, function(i, item) {
                                        var $tr = $('<tr>').append(
                                            $('<td style="text-align: center;">').text(i+1),
                                            $('<td style="text-align: right;">').text(convertToRupiah(item.Nominal)),
                                            $('<td style="text-align: center;">').text(tgl_indo(item.DueDate)),
                                            ).appendTo('#ttenor');
                                        });
                                        $('#modal_form2').modal('show');
                                       // $('#divtenor').css('display','block')
                                        $('.modal-title').html('Metode Pembayaran <b>TERMIN</b>');
                                    } else {
                                        var $tr = $('<tr>').append(
                                                $('<td colspan="3" style="text-align:center;">').text('- - - Tidak Ada Data - - -'),
                                                ).appendTo('#ttenor');
                                        $('#modal_form2').modal('show');
                                        //$('#divtenor').css('display','none')
                                        $('.modal-title').html('Metode Pembayaran <b>CASH</b>');
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });
                        }

                        function print(RecID) {
                            //alert(RecID);
                            $("<iframe>")                             // create a new iframe element
                                .hide()                               // make it invisible
                                .attr("src", base_url+'Franchise/receipt/'+RecID) // point the iframe to the page you want to print
                                .appendTo("body");                    // add iframe to the DOM to cause it to load the page

                        }
</script>