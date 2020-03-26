<form action="#" id="myform" class="form-horizontal">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list"> Laporan Data Cabang Aktif / Tidak Aktif</i></p>
                <legend></legend>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-3">
                    <label>Pilih Status</label>
                    <select id="Status" name="Status" class="form-control">
                       <option value=""> - - Pilih Status - - </option>
                       <option value="1"> Aktif </option>
                       <option value="0"> Tidak Aktif </option>
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
            <div class="wrapper1">
                <div class="div1">
                </div>
            </div>
            <div class="table-responsive wrapper2">
                <table class="table table-bordered table-hover div2" cellspacing="0" id="tableMenu" style="width: 500%;">
                            <thead>
                                <tr>
                                    <th data-sortable="false">No</th>
                                    <th style="text-align: center;">Area</th>
                                    <th style="text-align: center;">Kode Cabang</th>
                                    <th style="text-align: center;">Nama Cabang</th>
                                    <th style="text-align: center;">Tanggal Berlaku</th>
                                    <th style="text-align: center;">Tanggal Berakhir</th>
                                    <th style="text-align: center;">Propinsi</th>
                                    <th style="text-align: center;">Kota</th>
                                    <th style="text-align: center;">Alamat</th>
                                    <th style="text-align: center;">Kode Pos</th>
                                    <th style="text-align: center;">No. Telp</th>
                                    <th style="text-align: center;">Email</th>
                                    <th style="text-align: center;">Rek BCA</th>
                                    <th style="text-align: center;">Rek BCA A.n</th>
                                    <th style="text-align: center;">Kode Bank Non-BCA</th>
                                    <th style="text-align: center;">Rek Non-BCA</th>
                                    <th style="text-align: center;">Rek Non-BCA A.n</th>
                                    <th style="text-align: center;">Manager</th>
                                    <th style="text-align: center;">No. HP</th>
                                    <th style="text-align: center;">Alamat Manager</th>
                                    <th style="text-align: center;">PAC</th>
                                    <th style="text-align: center;">No. Telp PAC</th>
                                    <th style="text-align: center;">ISmart</th>
                                    <th style="text-align: center;">No. Telp ISmart</th>
                                    <th style="text-align: center;">Nama Franchisee</th>
                                    <th style="text-align: center;">No. Telp Franchisee</th>
                                    <th style="text-align: center;">Alamat Franchisee</th>
                                    <th style="text-align: center;">Status Kepemilikan</th>
                                    <th style="text-align: center;">Pemimpin</th>
                                    <th style="text-align: center;">SIUP</th>
                                    <th style="text-align: center;">TDP</th>
                                    <th style="text-align: center;">No. KTP</th>
                                    <th style="text-align: center;">No. NPWP</th>
                                    <th style="text-align: center;">Status Yang Lain</th>
                                    <th style="text-align: center;">Bentuk Bangunan</th>
                                    <th style="text-align: center;">Status Bangunan</th>
                                    <th style="text-align: center;">Saldo Awal Hutang</th>
                                    <th style="text-align: center;">Nilai Franchisee</th>
                                    <th style="text-align: center;">Diskon</th>
                                    <th style="text-align: center;">DPP</th>
                                    <th style="text-align: center;">Pajak</th>
                                    <th style="text-align: center;">Tagihan FF</th>
                                    <th style="text-align: center;">Pembayaran</th>
                                    <th style="text-align: center;">Sisa Pembayaran</th>
                                    <th style="text-align: center;">Tanggal MOU</th>
                                </tr>
                            </thead>
                </table>
            </div>
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
                                                <th colspan="2" width="60%" style="text-align: left">Saldo Awal Hutang</th>
                                                <th width="40%" style="text-align: right;" id="SA"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="2" width="60%" style="text-align: left">Tagihan FF</th>
                                                <th width="40%" style="text-align: right;" id="TFF"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="2" width="60%" style="text-align: left">Total</th>
                                                <th width="40%" style="text-align: right;" id="TotTag"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="3" width="100%" style="text-align: center">Detail Pembayaran</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th width="10%" style="text-align: center">#</th>
                                                <th width="50%" style="text-align: center">Tanggal Transaksi</th>
                                                <th width="40%" style="text-align: center">Jumlah Bayar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_pay"></tbody>
                                        <tfoot>
                                            <tr class="text-center">
                                                <th colspan="2" width="60%" style="text-align: left"> Pembayaran Sebelum Sistem</th>
                                                <th width="40%" style="text-align: right;" id="PSS"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="2" width="60%" style="text-align: left">Total Pembayaran</th>
                                                <th width="40%" style="text-align: right;" id="TOTPAY"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="2" width="60%" style="text-align: left">Sisa Pembayaran / Saldo Akhir Hutang</th>
                                                <th width="40%" style="text-align: right;" id="BILL"></th>
                                            </tr>
                                        </tfoot>
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<!-- <script type="text/javascript" src="<?php echo base_url()?>assets/js/jQueryBarcode.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<script src="<?=base_url('assets/js/autoNumeric.js'); ?>"></script>
<style type="text/css">
.wrapper1, .wrapper2{width: 100%; border: none 0px RED;
overflow-x: scroll; overflow-y:hidden;}
.wrapper1{height: 20px; }
.wrapper2{height: 100%; }
.div1 {width:530%; height: 20px; }
.div2 {width:530%; height: 100%; overflow: auto;}
</style>
<script type="text/javascript">

$(function(){
    $(".wrapper1").scroll(function(){
        $(".wrapper2")
            .scrollLeft($(".wrapper1").scrollLeft());
    });
    $(".wrapper2").scroll(function(){
        $(".wrapper1")
            .scrollLeft($(".wrapper2").scrollLeft());
    });
});

$(document).ready(function(){
    //get_area();
});

var jQueryTable;
var jQueryTable2;
function load_data() {
    Status = $('#Status').val();
    //alert(ItemCode);
    $("#tableMenu").DataTable().destroy();
    $('#tableMenuFoot').empty();
    if($('[name="Status"]').val() == "") {
        $('[name="Status"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Pilih Status !</p>');
        $('[name="Status"]').focus();
        return false;
    } else {
    $('#idtable').css('display','block');
    jQueryTable = $("#tableMenu").DataTable({
        "ajax": {
            "url":base_url + "Franchise/loadreportbranch",
            "type":"POST",
            "data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Status":window.btoa(Status)}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","autoWidth":true},
            {"data":"Area","autoWidth":true},
            {"data":"KodeCabang","autoWidth":true},
            {"data":"NamaCabang","autoWidth":true},
            {"data":"DateFrom","autoWidth":true},
            {"data":"DateTo","autoWidth":true},
            {"data":"Propinsi","autoWidth":true},
            {"data":"Kota","autoWidth":true},
            {"data":"Alamat","autoWidth":true},
            {"data":"KodePos","autoWidth":true},
            {"data":"NoTelp","autoWidth":true},
            {"data":"Email","autoWidth":true},
            {"data":"NoRekBCA","autoWidth":true},
            {"data":"NamaRekBCA","autoWidth":true},
            {"data":"KodeBankNonBCA","autoWidth":true},
            {"data":"NoRekNonBCA","autoWidth":true},
            {"data":"NamaRekNonBCA","autoWidth":true},
            {"data":"NamaManager","autoWidth":true},
            {"data":"NoHandPhone","autoWidth":true},
            {"data":"AlamatKC","autoWidth":true},
            {"data":"PAC","autoWidth":true},
            {"data":"telpPAC","autoWidth":true},
            {"data":"Ismart","autoWidth":true},
            {"data":"TelpIsmart","autoWidth":true},
            {"data":"NamaFranchisee","autoWidth":true},
            {"data":"NoTelpFranchisee","autoWidth":true},
            {"data":"AlamatFranchisee","autoWidth":true},
            {"data":"Statuskepemilikan","autoWidth":true},
            {"data":"Direktur","autoWidth":true},
            {"data":"SIUP","autoWidth":true},
            {"data":"TDP","autoWidth":true},
            {"data":null,"autoWidth":true, "render":
                function(data){
                    if(data.KTP==null){
                        return data.NoKTP;
                    } else {
                        return '<a href="'+base_url+'Franchise/download/'+data.KTP+'">'+data.NoKTP;+'</a>'
                    }
                }},
            {"data":null,"autoWidth":true, "render":
                function(data){
                    if(data.NPWP==null){
                        return data.NoNPWP;
                    } else {
                        return '<a href="'+base_url+'Franchise/download/'+data.NPWP+'">'+data.NoNPWP;+'</a>'
                    }
                }},
            {"data":"YStatuskepemilikan","autoWidth":true},
            {"data":"Bentuk","autoWidth":true},
            {"data":"StatusB","autoWidth":true},
            {"data":"BGN","autoWidth":true, "render":
                function(data){
                    if(data==0){
                        return convertToRupiah(0);
                    } else {
                        return convertToRupiah(data);
                    }
                }},
            {"data":"VAL","autoWidth":true, "render":
                function(data){
                    if(data==0){
                        return convertToRupiah(0);
                    } else {
                        return convertToRupiah(data);
                    }
                }},
            {"data":"DIS","autoWidth":true, "render":
                function(data){
                    if(data==0){
                        return convertToRupiah(0);
                    } else {
                        return convertToRupiah(data);
                    }
                }},
            {"data":"DPP","autoWidth":true, "render":
                function(data){
                    if(data==0){
                        return convertToRupiah(0);
                    } else {
                        return convertToRupiah(data);
                    }
                }},
            {"data":"DPP","autoWidth":true, "render":
                function(data){
                    ppn = 10/100*data;
                    if(data==0){
                        return convertToRupiah(0);
                    } else {
                        return convertToRupiah(ppn);
                    }
                }},
            {"data":"NET","autoWidth":true, "render":
                function(data){
                    if(data==0){
                        return convertToRupiah(0);
                    } else {
                        return convertToRupiah(data);
                    }
                }},
            {"data":null,"autoWidth":true, "render":
                function(data){
                    if(data.PAY==0){
                        return convertToRupiah(0);
                    } else {
                        return "<a href='#' onclick='load_modal("+data.ID+");'>"+convertToRupiah(data.PAY);+"</a>"
                    }
                }},
            {"data":"BILL","autoWidth":true, "render":
                function(data){
                    if(data==0){
                        return convertToRupiah(0);
                    } else {
                        return convertToRupiah(data);
                    }
                }},
            {"data":"DateMOU","autoWidth":true, "render":
                function(data){
                    if(data==null || data == '1900-01-01'){
                        return 'Belum MOU';
                    } else {
                        return data;
                    }
                }},
        ],
        'iDisplayLength': 10000,
        dom: "<'row'<'col-lg-1 col-xs-12'f><'col-lg-11 col-sm-12'B>>",
        buttons: [
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
        }]
    });
    /*$.ajax({
        url : base_url+"Franchise/loadlistarea",
        type: 'POST',
        data: ({Status:window.btoa(Status),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=")}),
        dataType: 'json',
        success: function(data){
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
                $.each(data.rows, function(i, item) {
                    SBGN += parseInt(item.BGN) || 0 ;
                    SVAL += parseInt(item.VAL) || 0 ;
                    SDIS += parseInt(item.DIS) || 0 ;
                    SDPP += parseInt(item.VAL-item.DIS) || 0 ;
                    SPPN += parseInt(10/100*(item.VAL-item.DIS)) || 0 ;
                    STOT += parseInt(item.TOT) || 0 ;
                    SPAY += parseInt(item.PAY) || 0 ;
                    SBILL += parseInt(item.BILL) || 0 ;
                });
                $("#tableMenu").append(
                $('<tfoot/>').append( 
                $("<tr id='tableMenuFoot'>").append(
                                $('<th colspan="5" style="text-align:center;">').text('Jumlah Total'),
                                $('<th style="text-align:center;">').text(convertToRupiah(SBGN)),
                                $('<th style="text-align:center;">').text(convertToRupiah(SVAL)),
                                $('<th style="text-align:center;">').text(convertToRupiah(SDIS)),
                                $('<th style="text-align:center;">').text(convertToRupiah(SDPP)),
                                $('<th style="text-align:center;">').text(convertToRupiah(SPPN)),
                                $('<th style="text-align:center;">').text(convertToRupiah(STOT)),
                                $('<th style="text-align:center;">').text(convertToRupiah(SPAY)),
                                $('<th style="text-align:center;">').text(convertToRupiah(SBILL)),
                                $('<th colspan="4" style="text-align:center;">').text(''),
                                ))
            );
        }
    });*/
}
}

function load_modal(FFID)
{
        //alert(FFID);
        $.ajax({
            url : base_url + "Franchise/loaddetailtrx/"+FFID,
            type: "GET",
            dataType: "JSON",
            success: function(data)
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
                $.each(data.rows, function(i, item) {

                    if(item.AMN == '' || item.AMN == null){
                        $('#data_item').empty();
                        var $tr = $('<tr>').append(
                                  $('<td colspan="3" style="text-align: center;">').text('- - - No Data - - -'),
                                  ).appendTo('#data_pay');
                    } else {
                        var $tr = $('<tr>').append(
                            $('<td>').text(i+1),
                            $("<td style='text-align: center;'>").text(item.DATE),
                            $("<td style='text-align: right;'>").text(convertToRupiah(item.AMN))
                        ).appendTo('#data_pay');
                    }
                SAL = parseInt(item.BGN) || 0 ;
                SAL = parseInt(item.BGN) || 0 ;
                PSS = parseInt(item.PCA) || 0 ;
                TOT = parseInt(item.TOT) || 0 ;
                TOTLIST += parseInt(item.AMN) || 0 ;
                PSS = parseInt(item.PCA) || 0 ;
                TT = TOT+SAL;
                TP = TOTLIST+PSS;
                Cabang = 'Cabang : ' + item.KodeCabang + ' - ' + item.NamaCabang;
                });
                
                $('#SA').text(convertToRupiah(SAL));
                $('#TFF').text(convertToRupiah(TOT));
                $('#TotTag').text(convertToRupiah(TOT+SAL));
                $('#PSS').text(convertToRupiah(PSS));
                $('#TOTPAY').text(convertToRupiah(TP));
                $('#BILL').text(convertToRupiah(TT-TP));
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
</script>