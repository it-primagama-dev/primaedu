<form action="#" id="myform" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-edit"> Alokasi Pembayaran Franchise Fee</i></p>
        	<legend></legend>
            </div>
            <!-- <div id="content">
                 <h3>Hello, this is a H3 tag</h3>

                <p>a pararaph</p>
            </div>
            <div id="editor"></div>
            <button id="cmd">generate PDF</button> -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-6">
                <label>Pilih Cabang</label>
                <select id="BranchCode" name="BranchCode" class="form-control">
                   <option value=""> - - Pilih Cabang - - </option>
                </select>
                <input type="hidden" id="UserGroup" value="<?php echo $this->session->userdata('UserGroup'); ?>">
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
<div class="row" id="table" style="display: none;">
    <div class="col-lg-12">
        <div class="active tab-pane" id="tabs1">
            <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                <thead>
                    <tr>
                        <th style="width: 5px;text-align: center;">No.</th>
                        <th style="width: 80px;text-align: center;">No. Kontrak</th>
                        <th style="width: 80px;text-align: center;">Nominal</th>
                        <th style="width: 80px;text-align: center;">Tanggal Transaksi</th>
                        <th style="width: 80px;text-align: center;">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</form>
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Title</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" id="RecID" name="RecID" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Kontrak</label>
                            <div class="col-md-8">
                                <select name="FF" id="FF" class="form-control">
                                    <option value="">--Pilih Kontrak--</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/autoNumeric.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<!-- <script type="text/javascript" src="<?php echo base_url()?>assets/js/jQueryBarcode.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    get_cabang();
});

$(function () {
    $('#BranchCode').select2();
});

function get_cabang() {
$.getJSON(base_url+"Franchise/get_cabang", function(json){
    $('#BranchCode').empty();
    $('#BranchCode').append($('<option>').text("- - Pilih Cabang - -").attr('value', ''));
    $.each(json, function(i, obj){
    $('#BranchCode').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
    });
});
}

function get_kontrak(BranchCode) {
//BranchCode = $('#BranchCode').val();
$.getJSON(base_url+"Franchise/get_kontrak/"+BranchCode, function(json){
    $('#FF').empty();
    $('#FF').append($('<option>').text("- - Pilih Kontrak - -").attr('value', ''));
    $.each(json, function(i, obj){
    $('#FF').append($('<option>').text(obj.FFID).attr('value', obj.FFID));
    });
});
}

var jQueryTable;
function load_data() {
    BranchCode = $('#BranchCode').val();
    //Barcode = $('#BC').val();
    //alert(BranchCode);
    $("#tableMenu").DataTable().destroy();
    if(BranchCode==''){
        alert('Pilih Cabang...');
    } else {
    $('#table').css('display','block');
    jQueryTable = $("#tableMenu").DataTable({
        "ajax": {
            "url":base_url + "Franchise/loadupdatepay",
            "type":"POST",
            "data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"BranchCode":BranchCode}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","autoWidth":true},
            {"data":"FFID","autoWidth":true},
            {"data":"AMOUNT","autoWidth":true,"sClass": "text-right","render": function(data) {
                    return convertToRupiah(data);
                }
            },
            {"data":"PAYMENTDATETIME","autoWidth":true,"render": function(data) {
                    date = data;
                    if(date=='' || date == null){
                        return '-';
                    } else {
                        datefrmt = date.replace(/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/, "$1-$2-$3 $4:$5:$6");
                        return tgl_indo_time2(datefrmt);
                    }
                }
            },
            {"data":"RecID","width":"80px","sClass": "text-center","render": function(data) {
                var button = '<div class="btn-group" data-toggle="buttons">';
                button += '<a class="btn btn-warning btn-xs aktif" href="javascript:void(0)" type="button" data-toggle="modal" onclick="edit_form('+data+')">Edit</a>';
                button += '</div>';
                    return button;
                }
            },
        ],
        "columnDefs":[
        {
            "targets": [0,1],
            "createdCell": function (td, cellData, rowData, row, col) {
                $(td).css({'text-align':'center'});
            }
        }],
        "aLengthMenu": [[1000, 5000, 10000, -1], [1000, 5000, 10000, "All"]],
        'iDisplayLength': 10000,
        "order": [[ 0, "asc" ]],
        "pagingType": "full_numbers",
        dom: "<'row'<'col-lg-2 col-xs-12'l><'col-lg-10 col-xs-12'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-lg-5 col-sm-12'i><'col-lg-7 col-sm-12'p>>",
    });
}
}

function edit_form(RecID)
{
    $(".text-danger").remove();
        $('#form')[0].reset();
        $.ajax({
            url : base_url + "Franchise/edit_pay/"+RecID,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form').modal({backdrop: 'static', keyboard: false});
                $('#RecID').val(data.RecID);
                $('#modal_form').modal('show');
                $('.modal-title').text('Ubah Kontrak');
                get_kontrak(data.FFID);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
}

function save()
{
    //alert($('#form').serialize());

    $(".text-danger").remove();
    if($('[name="FF"]').val() == "") {
        $('[name="FF"]').after('<p class="text-danger">This field is required</p>');
        $('[name="FF"]').focus();
        return false;
    } else {
        //$('#data_item').empty();
        $.ajax({
            url : base_url + "Franchise/edit_kontrak",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                $.notify(data.message,data.notify);
                $('#modal_form').modal('hide');
                load_data();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
}
</script>