<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list"> Data Order Kurang Kirim</i></p>
            <legend></legend>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-6">
                    <strong><u>*Cari order kurang kirim berdasarkan Item. . .</u></strong>
                </div>
            </div>
        <div class="form-group">
            <div class="col-lg-6">
                <select id="ItemCode" name="ItemCode" class="form-control">
                    <option value="-"> - - Pilih Item - - </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success print-hidden" onclick="reload_data()"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
        </div>
        <legend></legend>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div id="isi" class="table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="5%">No</th>
                        <th style="text-align: center;" width="20%">PR</th>
                        <th style="text-align: center;" width="20%">Tanggal</th>
                        <th style="text-align: center;" width="45%">Cabang</th>
                        <th style="text-align: center;" width="13%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="data_po"></tbody>
            </table>
        </div>
    </div>
</div>
</form>
<!-- datatables css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<script type="text/javascript">
function redirectPost(url, data) {
    var form = document.createElement('form');
    document.body.appendChild(form);
    form.method = 'post';
    form.action = url;
    for (var name in data) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = data[name];
        form.appendChild(input);
    }
    form.submit();
}

$(document).ready(function(){
    reload_data();
    get_item();
});

$(function () {
    $('#ItemCode').select2();
});

function get_item() {
$.getJSON(base_url+"Logistics/get_item_lessdo", function(json){
    $('#ItemCode').empty();
    $('#ItemCode').append($('<option>').text("- - Pilih Item - -").attr('value',''));/*
    $('#ItemCode').append($('<option>').text("Bonus (String Bag & Sticker)").attr('value','1'));*/
    $.each(json, function(i, obj){
$('#ItemCode').append($('<option>').text(obj.ItemName).attr('value', obj.ItemCode));
    });
});
}

function reload_data() {
    var ItemCode = $('#ItemCode').val();
    //alert(ItemCode);
    if(ItemCode==''){
    alert('Pilih Item...');
    } else {
    $.ajax({
        url : base_url+"Logistics/get_list_do_less",
        type: 'POST',
        data: ({ItemCode:ItemCode}),
        dataType: 'json',
        beforeSend: function(){
            $("#ajax-loader").show();
        },
        complete: function() {
            $("#ajax-loader").hide();
        },
        success: function(data){
            var jml_data = Object.keys(data.rows).length;
            var total = 0;
            if (jml_data > 0) {
                $("#example").DataTable().destroy();
                $('#data_po').empty();
                $.each(data.rows, function(i, item) {
                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.PR_Number),
                        $('<td>').text(tgl_indo(item.PR_Date)),
                        $('<td>').text(item.Area+' / '+item.KodeAreaCabang+' - '+item.NamaAreaCabang),    
                        $('<td style="text-align: center;">').html("<a href=\"javascript:void(0)\" class=\"btn btn-warning btn-xs\" onclick=\"print_ps('"+item.PR_Number+"')\"> Cetak Packing Slip Susulan</a><br><a href=\"javascript:void(0)\" class=\"btn btn-info btn-xs\" onclick=\"Input_DO('"+item.PR_Number+"')\"> Input Barang yang akan di Kirim</a>"),
                    ).appendTo('#data_po');
                });
                $('#example').dataTable();
            } else {
                $('#data_po').empty();
                var $tr = $('<tr>').append(
                        $('<td colspan="5" style="text-align:center;">').text('- - - Tidak Ada Data - - -'),
                        ).appendTo('#data_po');
                //$('#example').dataTable();
            }
        }
    });
}
};

function Input_DO(pr) {
    redirectPost(base_url+'Logistics/input_do_less',{PR:window.btoa(pr),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),kode:window.btoa(1)})
}

function print_ps(pr) {
    redirectPost(base_url+'Logistics/print_packing_less',{PR:window.btoa(pr),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),kode:window.btoa(1)})
}
</script>