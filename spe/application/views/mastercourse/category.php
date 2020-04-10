<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-list"> Kategori Paket </i></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <legend></legend>
        <div id="isi" class="table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example">
                <thead>
                    <tr class="text-center">
                        <th width="1%">No</th>
                        <th width="23%">Nama Kategori Paket</th>
                        <th width="20%">Deskripsi</th>
                        <th width="24%">Total</th>
                        <th width="8%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="data_paket"></tbody>
            </table>
        </div>
        <legend></legend>
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
                            <label class="control-label col-md-3">Nama Paket</label>
                            <div class="col-md-9">
                                <input type="text" name="CatName" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Deskripsi</label>
                            <div class="col-md-9">
                               <textarea id="Description" name="Description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Total Siswa</label>
                            <div class="col-md-9">
                                <input type="text" name="TotalStudents" class="form-control" value="">
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
<!-- datatables css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?=base_url('assets/js/autoNumeric.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script>
<script type="text/javascript">


$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('Description');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
});

$(document).ready(function(){
    reload_data();

});
var save_method;
var table;
function modal_form(RecID=null)
{
    $(".text-danger").remove();
    if (!RecID) {
        save_method = 'add';
        $('#modal_form').modal({backdrop: 'static', keyboard: false});
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Paket'); 
    } else {
        save_method = 'update';
        $('#form')[0].reset();

        $.ajax({
            url : base_url + "mastercourse/edit_paket/"+RecID,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form').modal({backdrop: 'static', keyboard: false});
                $('[name="CatName"]').val(data.CatName);
                //$('[name="Description"]').text(data.Description);
                CKEDITOR.instances['Description'].setData(data.Description);
                $('[name="TotalStudents"]').val(data.TotalStudents);
                $('#RecID').val(RecID);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Paket');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
}

function save()
{

    ck = CKEDITOR.instances['Description'].getData();

    $(".text-danger").remove();
    if($('[name="CatName"]').val() == "") {
        $('[name="CatName"]').after('<p class="text-danger">This field is CatName</p>');
        $('[name="CatName"]').focus();
        return false;
    }
    if(ck == "") {
        $('[name="Description"]').after('<p class="text-danger">This field is Deskripsi</p>');
        $('[name="Description"]').focus();
        return false;
    }
    if($('[name="TotalStudents"]').val() == "") {
        $('[name="TotalStudents"]').after('<p class="text-danger">This field is Total</p>');
        $('[name="TotalStudents"]').focus();
        return false;
    } else {
        var url;
        
            url = base_url + "mastercourse/update_paket";

        $('#data_paket').empty();
        $.ajax({
            url : url,
            type: "POST",
            data: ({CatName:$('[name="CatName"]').val() ,Description:ck,TotalStudents:$('[name="TotalStudents"]').val(),RecID:$('#RecID').val()}),
            dataType: "JSON",
            success: function(data)
            {
                if(save_method == 'add') {
                    $.notify(data.message,data.notify);
                } else {
                    $.notify(data.message,data.notify);
                }
                $('#modal_form').modal('hide');
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
}

function reload_data() {
    $.ajax({
        url : base_url+"mastercourse/get_data_paket",
        type: 'GET',
        dataType: 'json',
        beforeSend: function(){
            $("#ajax-loader").show();
        },
        complete: function() {
            $("#ajax-loader").hide();
        },
        success: function(data){
            var jml_data = Object.keys(data.rows).length;
            if (jml_data > 0) {
                $('#data_paket').empty();
                $.each(data.rows, function(i, item) {
                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.CatName),
                        $('<td>').html(item.Description),
                        $('<td>').text(item.TotalStudents),
                        $('<td>').html('<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" onclick="modal_form('+item.RecID+');"><span class="glyphicon glyphicon-pencil"></span> Edit</button>'),
                    ).appendTo('#data_paket');
                });
                $('#example').dataTable();
            } else {
                $('#data_paket').empty();
                var $tr = $('<tr>').append(
                          $('<td colspan="12" style="text-align: center;">').text('- - - No Data - - -'),
                          ).appendTo('#data_paket');
            }
        }
    });
};

</script>