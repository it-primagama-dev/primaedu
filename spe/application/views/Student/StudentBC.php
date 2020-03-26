<form action="#" id="form" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-6">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-book"> Penyerahan Buku</i></p>
            </div>
        </div>
            <legend></legend>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-5">
                <input type="text" id="KS" maxlength="7" class="form-control" placeholder="- - Input 7 Digit Kode Siswa - - (Cth : 0000001)">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success print-hidden" onclick="get_data()"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
        </div>
        <legend></legend>
    </div>
</div>
<div class="row" id="table" style="display: none;">
    <div class="col-lg-12">
            <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                <thead>
                    <tr>
                        <th style="width: 5px;text-align: center;">No.</th>
                        <th style="width: 80px;text-align: center;">Siswa</th>
                        <th style="width: 80px;text-align: center;">Program</th>
                        <th style="width: 80px;text-align: center;">Tanggal Pendaftaran</th>
                        <th style="width: 80px;text-align: center;">Tanggal Terima Buku</th>
                        <th style="width: 80px;text-align: center;">Barcode</th>
                        <th style="width: 80px;text-align: center;">Aksi</th>
                    </tr>
                </thead>
            </table> 
    </div>
</div>
</form>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" id="form2" class="form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Title</h3>
            </div>
            <div class="modal-body form">
                <form action="javascript:void(0)" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="RecID" id="RecID"/>
                    <input type="hidden" value="" name="Stage" id="Stage"/>
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <label class="control-label">Barcode</label>
                                <input type="text" id="barcode" class="form-control" placeholder="input 14 digit barcode. . ." maxlength="14" onblur="cek_bc()">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <label class="control-label">Nama Buku</label>
                                <input type="text" id="namabuku" class="form-control" placeholder="Nama Buku. . ." readonly="readonly">
                                <input type="hidden" id="kodebuku" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <label class="control-label">Tanggal Terima</label>
                                <input type="text" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal Terima. . .">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <label class="control-label">Jumlah Buku</label>
                                <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah Buku. . .">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript">
$(function(){
    var d = new Date();
    var n = d.getFullYear();
    $('[name="tanggal"]').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "2017:"+n
    });
})
var jQueryTable;
function get_data(){
    var KS = $('#KS').val();
    $("#tableMenu").DataTable().destroy();
    if(KS==''){
        alert('Input Kode Siswa . . ! !');
    } else {
    $('#table').css('display','block');
    jQueryTable = $("#tableMenu").DataTable({
        "ajax": {
            "url":base_url + "Student/find_student",
            "type":"GET",
            "data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Kode":window.btoa(0),KS:window.btoa(KS)}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","width":"5px"},
            {"data":"siswa","autoWidth":true},
            {"data":"program","autoWidth":true},
            {"data":"tgldaftar","autoWidth":true,"render":
                function(data){
                    return tgl_indo_time2(data);
                }},
            {"data":"tglterima","autoWidth":true,"render":
                function(data){
                    if(data==null){
                    return "-";
                    } else {
                    return tgl_indo(data);  
                    }
                }},
            {"data":"barcode","autoWidth":true,"render":
                function(data){
                    if(data==null){
                    return "-";
                    } else {
                    return data;  
                    }
                }},
            {"data":"RecID","width":"10%","sClass": "text-center","render": 
                function (data, type, full, meta ) {
                var button = '<a class="btn btn-warning btn-xs" href="javascript:void(0)" type="button" data-toggle="modal" onclick="modal_form(RecID='+data+',Stage='+full.Stage+')"> Proses</a>';
                var button2 = '<a class="btn btn-info btn-xs" href="javascript:void(0)" type="button" data-toggle="modal" onclick="print(RecID='+data+')"> Cetak</a>';
                if(full.barcode==null){
                    return button;
                } else {
                    return button2;
                }
            }
            },
        ],
        "columnDefs":[
        {
            "targets": [0,1,2],
            "createdCell": function (td, cellData, rowData, row, col) {
                $(td).css({'text-align':'left'});
            }
        }],
        "paging": false,
        "filter": false,
        "info": false,
    }); 
    }
}

var RecID;
var Stage;
function modal_form() {
    //alert(nova);
    $(".text-danger").remove();
    //$('#form')[0].reset();
    $('[name="RecID"]').val(encodeURIComponent(RecID));
    $('[name="Stage"]').val(encodeURIComponent(Stage));
    //$('#myModal').modal('show');
    $('#myModal').modal({show: 'show',backdrop: 'static', keyboard: false});
    $('.modal-title').text('Penyerahan Buku');
    $("#btnSave").prop("disabled", true);
}

function cek_bc() {
    $(".text-danger").remove();
    var bc = $('#barcode').val();
    var stg = $('[name="Stage"]').val();
    var countbc = bc.length;
    //alert(countbc);
    if(bc==''){
        $("#btnSave").prop("disabled", true);
        $('#barcode').after('<p class="text-danger">tidak boleh kosong...</p>');
        $('#barcode').focus();
        return false;
    } else if(countbc != 14){
        $("#btnSave").prop("disabled", true);
        $('#barcode').after('<p class="text-danger">barcode yang valid adalah 14 digit...</p>');
        $('#barcode').focus();
        return false;
    } else {
    $.ajax({
        url : base_url+"Student/find_item",
        type: "POST",
        data: ({bc:bc}),
        dataType: "JSON",
        success: function(data)
        {
            var jml_data = Object.keys(data.rows).length;
            var jml_databc = Object.keys(data.rowsbccbg).length;
           /* $.each(data.rowsstage, function(i, item) {
                stage=item.Stage;
            });*/
            if (jml_data <= 0) {
                $("#btnSave").prop("disabled", true);
                $('#barcode').after('<p class="text-danger">format barcode salah...</p>');
                $('#barcode').focus();
                return false;
            } else if (jml_databc <= 0) {
                $("#btnSave").prop("disabled", true);
                $('#barcode').after('<p class="text-danger">barcode tidak tersedia di stok cabang atau sudah digunakan oleh siswa lain...</p>');
                $('#barcode').focus();
                return false;
            /*} else if(stage!=stg){
                //alert(stg);
                $("#btnSave").prop("disabled", true);
                $('#barcode').after('<p class="text-danger">barcode tidak sesuai dengan jenjang siswa...</p>');
                $('#barcode').focus();
                return false;*/
            } else {
                $.each(data.rows, function(i, item) {
                $('#namabuku').val(item.ItemName);
                $('#kodebuku').val(item.ItemCode);
                $("#btnSave").prop("disabled", false);
                });
            }
        }
    });
}
};

function save()
{
    var barcode = window.btoa($('#barcode').val());
    var kodebuku = window.btoa($('#kodebuku').val());
    var tanggal = window.btoa($('#tanggal').val());
    var jumlah = window.btoa($('#jumlah').val());
    var programsiswa = window.btoa($('#RecID').val());
    $(".text-danger").remove();
    if($('[name="barcode"]').val() == "") {
        $('[name="barcode"]').after('<p class="text-danger">Barcode tidak boleh kosaong</p>');
        $('[name="barcode"]').focus();
        return false;
    }
    if($('[name="namabuku"]').val() == "") {
        $('[name="namabuku"]').after('<p class="text-danger">Nama buku tidak boleh kosong</p>');
        $('[name="namabuku"]').focus();
        return false;
    }
    if($('[name="tanggal"]').val() == "") {
        $('[name="tanggal"]').after('<p class="text-danger">Tanggal tidak boleh kosong</p>');
        $('[name="tanggal"]').focus();
        return false;
    }
    if($('[name="jumlah"]').val() == "") {
        $('[name="jumlah"]').after('<p class="text-danger">Jumlah tidak boleh kosong</p>');
        $('[name="jumlah"]').focus();
        return false;
    } else {
        $.ajax({
            url : base_url + "Student/savebc",
            type: "POST",
            data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),barcode:barcode,kodebuku:kodebuku,tanggal:tanggal,jumlah:jumlah,programsiswa:programsiswa}),
            dataType: "JSON",
            success: function(data)
            {
                $('#myModal').modal('hide');
                get_data();
                $.notify(data.message,data.notify);
            }
        });
    }
}
/*function printq(RecID) { 
    redirectPost(base_url+'Student/printbc',{RecID:window.btoa(RecID),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),kode:window.btoa(1)})
}*/
function print(RecID) {
    $("<iframe>")                             // create a new iframe element
        .hide()                               // make it invisible
        .attr("src", base_url+'Student/printbc/'+RecID) // point the iframe to the page you want to print
        .appendTo("body");                    // add iframe to the DOM to cause it to load the page

}
</script>