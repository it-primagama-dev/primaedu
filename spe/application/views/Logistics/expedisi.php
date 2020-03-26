<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-list"> Data Expedisi </i></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="text-align: right;">
        <div class="form-group">
            <div class="col-lg-12"><button type="button" class="btn btn-primary pull-right" data-toggle="modal" onclick="modal_form();"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Expedisi</button>
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
                        <th width="23%">Nama Expedisi</th>
                        <th width="20%">Contact Person</th>
                        <th width="24%">Link Cek Resi</th>
                        <th width="12%">Status</th>
                        <th width="8%">Aksi</th>
                        <th width="8%" data-sortable="false"><input type="checkbox" id="select_all">
                            <a href="" id="delete_records"><b>Delete</b></a>
                        </th>
                    </tr>
                </thead>
                <tbody id="data_exp"></tbody>
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
                            <label class="control-label col-md-3">Nama Expedisi</label>
                            <div class="col-md-9">
                                <input type="text" name="Name_Exp" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Contact Person</label>
                            <div class="col-md-9">
                                <input type="text" name="CP" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Link Web Cek Resi</label>
                            <div class="col-md-9">
                                <input type="text" name="Link" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="Status" class="form-control">
                                    <option value="">--Pilih Status--</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
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
<!-- datatables css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?=base_url('assets/js/autoNumeric.js'); ?>"></script>
<script type="text/javascript">

$(document).ready(function(){
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    reload_data();
    $('#select_all').on('click', function(e) {
        if($(this).is(':checked',true)) {
            $(".emp_checkbox").prop('checked', true);
        } else {
            $(".emp_checkbox").prop('checked',false);
        }
    });
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
        $('.modal-title').text('Tambah Expedisi'); 
    } else {
        save_method = 'update';
        $('#form')[0].reset();

        $.ajax({
            url : base_url + "Logistics/edit_exp/"+RecID,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form').modal({backdrop: 'static', keyboard: false});
                $('[name="Name_Exp"]').val(data.Exp_Name);
                $('[name="CP"]').val(data.Contact);
                $('[name="Link"]').val(data.Link);
                $('[name="Status"]').val(data.Status);
                $('#RecID').val(RecID);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Expedisi');
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
    $(".text-danger").remove();
    if($('[name="Name_Exp"]').val() == "") {
        $('[name="Name_Exp"]').after('<p class="text-danger">This field is required</p>');
        $('[name="Name_Exp"]').focus();
        return false;
    }
    if($('[name="CP"]').val() == "") {
        $('[name="CP"]').after('<p class="text-danger">This field is required</p>');
        $('[name="CP"]').focus();
        return false;
    }
    if($('[name="Link"]').val() == "") {
        $('[name="Link"]').after('<p class="text-danger">This field is required</p>');
        $('[name="Link"]').focus();
        return false;
    }
    if($('[name="Status"]').val() == "") {
        $('[name="Status"]').after('<p class="text-danger">This field is required</p>');
        $('[name="Status"]').focus();
        return false;
    } else {
        var url;
        if(save_method == 'add')
        {
            url = base_url + "Logistics/add_exp";
        }
        else
        {
            url = base_url + "Logistics/update_exp";
        }

        $('#data_exp').empty();
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
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
        url : base_url+"Logistics/get_data_exp",
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
                $('#data_exp').empty();
                $.each(data.rows, function(i, item) {
                    if(item.Status==1){
                        var Status = 'Aktif';
                    } else {
                        var Status = 'Tidak Aktif';
                    }
                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.Exp_Name),
                        $('<td>').text(item.Contact),
                        $('<td>').text(item.Link),
                        $('<td>').text(Status),
                        $('<td>').html('<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" onclick="modal_form('+item.RecID+');"><span class="glyphicon glyphicon-pencil"></span> Edit</button>'),
                        $('<td>').html('<input type="checkbox" class="emp_checkbox" data-emp-id="'+item.RecID+'">')
                    ).appendTo('#data_exp');
                });
                $('#example').dataTable();
            } else {
                $('#data_exp').empty();
                var $tr = $('<tr>').append(
                          $('<td colspan="12" style="text-align: center;">').text('- - - No Data - - -'),
                          ).appendTo('#data_exp');
            }
        }
    });
};

$('#delete_records').on('click', function(e) {
var employee = [];
$(".emp_checkbox:checked").each(function() {
    employee.push($(this).data('emp-id'));
});
    if(employee.length <=0) {
        alert("Please select records."); 
    } else {
        WRN_PROFILE_DELETE = "Are you sure you want to delete "+(employee.length>1?"these":"this")+" row?";
        var checked = confirm(WRN_PROFILE_DELETE);
        if(checked == true) {
            var RecID = employee.join(",");
            //alert(RecID);
            $.ajax({
                url : base_url + "Logistics/delete_exp",
                type: "POST",
                cache:false,
                data: {RecID : RecID},
                success: function(data)
                {
                    $.notify(data.message,data.notify);
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            }); 
        }
    }
});
</script>