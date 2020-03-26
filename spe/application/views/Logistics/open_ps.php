<form action="#" id="form" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-pencil"> Kelola Packing Slip</i></p>
        	<legend></legend>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-5">
                <select id="Cabang" name="Cabang" class="form-control">
                   <option value=""> - - Pilih Cabang - - </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success print-hidden" onclick="openps()"><span class="glyphicon glyphicon-search"></span> Cari</button>
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
                        <th style="width: 80px;text-align: center;">PR</th>
                        <th style="width: 80px;text-align: center;">Tanggal Pemesanan</th>
                        <th style="width: 80px;text-align: center;">Jumlah Cetak</th>
                        <th style="width: 80px;text-align: center;">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<!-- <script type="text/javascript" src="<?php echo base_url()?>assets/js/jQueryBarcode.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/buttons.html5.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    get_cbg();
});

$(function () {
    $('#Cabang').select2();
});

function get_cbg() {
$.getJSON(base_url+"Barcode/get_cabang", function(json){
    $('#Cabang').empty();
    $('#Cabang').append($('<option>').text("- - Pilih Cabang - -"));
    $.each(json, function(i, obj){
    $('#Cabang').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
    });
});
}

function openps() {
    Cabang = $('#Cabang').val();
    //alert(Cabang);
    $("#tableMenu").DataTable().destroy();
    if(Cabang=='- - Pilih Cabang - -' || Cabang==''){
        alert('Pilih Cabang...');
    } else {
    $('#table').css('display','block');
    $("#tableMenu").DataTable({
        "ajax": {
            "url":base_url + "Logistics/list_openps",
            "type":"POST",
            "data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Cabang":window.btoa(Cabang)}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","width":"5%"},
            {"data":"PR_Number","autoWidth":true},
            {"data":"PR_Date","width":"25%","render":
                function(data){
                    if(data==null){
                    return "-";
                    } else {
                    return tgl_indo(data);  
                    }
            }},
            {"data":"Print_PS","width":"20%"},
            {"data":"RecID","width":"10%","sClass": "text-center","render": function(data) {
                var button = '<a class="btn btn-success btn-xs" href="javascript:void(0)" type="button" data-toggle="modal" onclick="update('+data+')">Open</a>';
                    return button;
                }
            },
        ],
        "columnDefs":[
        {
            "targets": [0,1,2,3,4],
            "createdCell": function (td, cellData, rowData, row, col) {
                $(td).css({'text-align':'center'});
            }
        }],
        "aLengthMenu": [[20, 30, 50, -1], [20, 30, 50, "All"]],
        'iDisplayLength': 20,
        "order": [[ 0, "asc" ]],
        "pagingType": "full_numbers",
        dom: "<'row'<'col-lg-2 col-xs-12'l><'col-lg-10 col-xs-12'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-lg-5 col-sm-12'i><'col-lg-7 col-sm-12'p>>",
        buttons: []
    });
}
}


function update(RecID) {
    if (confirm("Anda yakin akan membuka Packing Slip ini ?")) {    
        $("#tableMenu").DataTable().destroy();
        $.ajax({
            url : base_url+"Logistics/updateps",
            type: "POST",
            data: ({RecID:window.btoa(RecID),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=")}),
            dataType: "JSON",
            success: function(data) 
            {
                openps();
                get_cbg();
                $.notify(data.message,data.notify);
            }
        });
    }
};
</script>