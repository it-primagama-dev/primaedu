<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-list"> Data Item / Buku </i></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="text-align: right;">
        <div class="form-group">
            <div class="col-lg-12"><button type="button" id="tambah" class="btn btn-primary pull-right" data-toggle="modal" onclick="modal_form();" style="display: none;"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Item</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <input type="hidden" name="grup" id="grup" value="<?php echo $this->session->userdata('UserGroup'); ?>">
        <legend></legend>
        <div id="isi" class="table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example">
                <thead>
                    <tr class="text-center">
                        <th width="1%">No</th>
                        <th width="10%">Tipe Item</th>
                        <th width="10%">Paket Item</th>
                        <th width="20%">Kode Item</th>
                        <th width="30%">Nama Item</th>
                        <th width="21%">Harga Satuan</th>
                        <th width="8%">Digit 5-8 Barcode</th><!-- 
                        <th width="5%">Status Order</th> -->
                        <th width="5%">Aksi</th>
                        <!-- <th width="5%" data-sortable="false"><input type="checkbox" id="select_all">
                            <a href="" id="delete_records"><b>Delete</b></a>
                        </th> -->
                    </tr>
                </thead>
                <tbody id="data_item"></tbody>
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
                            <label class="control-label col-md-3">Tipe Item</label>
                            <div class="col-md-9">
                                <select name="ItemType" class="form-control">
                                    <option value="">--Pilih Tipe Item--</option>
                                    <?php foreach ($item->result() as $r) { ?>
                                        <option value="<?php echo $r->RecId ?>"><?php echo $r->TypeName ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kode Item</label>
                            <div class="col-md-9">
                                <input type="text" name="ItemCode" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Item</label>
                            <div class="col-md-9">
                                <input type="text" name="ItemName" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Harga Jual</label>
                            <div class="col-md-9">
                                <input type="text" name="Price" class="Idr form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Digit 5-8 Barcode</label>
                            <div class="col-md-9">
                                <input type="text" name="Digit" class="form-control" value="" maxlength="4">
                            </div>
                        </div><!-- 
                        <div class="form-group">
                            <label class="control-label col-md-3">Status Order</label>
                            <div class="col-md-9">
                                <select name="Status" class="form-control">
                                    <option value="">--Pilih Status Order--</option>
                                    <option value="1">Buka</option>
                                    <option value="0">Tutup</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="control-label col-md-3">Paket Item</label>
                            <div class="col-md-9">
                                <select name="PackItem" class="form-control">
                                    <option value="">--Pilih Paket Item--</option>
                                    <?php foreach ($pack->result() as $r) { ?>
                                        <option value="<?php echo $r->RecID ?>"><?php echo $r->PackName ?></option>
                                    <?php } ?>
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
    grup = $('#grup').val();
    //alert(grup);
    if(grup == 30){
        $('#tambah').css('display','block');
    }
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
        $('.modal-title').text('Tambah Item'); 
    } else {
        save_method = 'update';
        $('#form')[0].reset();

        $.ajax({
            url : base_url + "Logistics/edit_item/"+RecID,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form').modal({backdrop: 'static', keyboard: false});
                if(document.getElementById("grup").value == 30){
                $('[name="ItemCode"]').val(data.ItemCode).attr('readonly', true);
                $('[name="ItemType"]').val(data.TypeId);
                $('[name="ItemName"]').val(data.ItemName);
                $('[name="Price"]').val(convertToRupiah(data.Price))/*.attr('readonly', true)*/;
                $('[name="Digit"]').val(data.BarcodeId);
                $('[name="PackItem"]').val(data.PackId);
                } else if(document.getElementById("grup").value == 21) {
                $('[name="ItemCode"]').val(data.ItemCode).attr('readonly', true);
                $('[name="ItemType"]').val(data.TypeId).attr("style", "pointer-events: none;").attr('readonly', true);
                $('[name="ItemName"]').val(data.ItemName).attr('readonly', true);
                $('[name="Price"]').val(convertToRupiah(data.Price));
                $('[name="Digit"]').val(data.BarcodeId).attr('readonly', true);
                $('[name="PackItem"]').val(data.PackId).attr("style", "pointer-events: none;").attr('readonly', true);
                } else {
                $('[name="ItemCode"]').val(data.ItemCode).attr('readonly', true);
                $('[name="ItemType"]').val(data.TypeId).attr("style", "pointer-events: none;").attr('readonly', true);
                $('[name="ItemName"]').val(data.ItemName).attr('readonly', true);
                $('[name="Price"]').val(convertToRupiah(data.Price)).attr('readonly', true);
                $('[name="Digit"]').val(data.BarcodeId).attr('readonly', true);
                $('[name="PackItem"]').val(data.PackId).attr("style", "pointer-events: none;").attr('readonly', true);
                }
                $('#RecID').val(RecID);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Item');
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
    //alert($('#form').serialize());

    $(".text-danger").remove();
    if($('[name="ItemType"]').val() == "") {
        $('[name="ItemType"]').after('<p class="text-danger">This field is required</p>');
        $('[name="ItemType"]').focus();
        return false;
    }
    if($('[name="ItemCode"]').val() == "") {
        $('[name="ItemCode"]').after('<p class="text-danger">This field is required</p>');
        $('[name="ItemCode"]').focus();
        return false;
    }
    if($('[name="ItemName"]').val() == "") {
        $('[name="ItemName"]').after('<p class="text-danger">This field is required</p>');
        $('[name="ItemName"]').focus();
        return false;
    }
    if($('[name="Price"]').val() == "") {
        $('[name="Price"]').after('<p class="text-danger">This field is required</p>');
        $('[name="Price"]').focus();
        return false;
    }
    if($('[name="Digit"]').val() == "") {
        $('[name="Digit"]').after('<p class="text-danger">This field is required</p>');
        $('[name="Digit"]').focus();
        return false;
    }/*
    if($('[name="Status"]').val() == "") {
        $('[name="Status"]').after('<p class="text-danger">This field is required</p>');
        $('[name="Status"]').focus();
        return false;
    }*/ else {
        var url;
        if(save_method == 'add')
        {
            url = base_url + "Logistics/add_item";
        }
        else
        {
            url = base_url + "Logistics/update_item";
        }

        $('#data_item').empty();
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
                reload_data();
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
        url : base_url+"Logistics/get_data_item",
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
                $('#data_item').empty();
                $.each(data.rows, function(i, item) {
                    if(item.OrderStatus==1){
                        var Status = 'Buka';
                    } else {
                        var Status = 'Tutup';
                    }
                    Packs = item.PackCode;
                    if(item.PackCode == null){
                        var Pack = '-';
                    } else {
                        var Pack = Packs;
                    }
                    /*if($('#grup').val()==30){*/
                        button = '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" onclick="modal_form('+item.RecID+');"><span class="glyphicon glyphicon-pencil"></span> Edit</button>';
                    /*} else {
                        button = '-';
                    }*/
                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.TypeName),
                        $('<td>').text(Pack),
                        $('<td>').text(item.ItemCode),
                        $('<td>').text(item.ItemName),
                        $('<td>').text(convertToRupiah(item.Price)),
                        $('<td>').text(item.BarcodeId),
                        /*$('<td>').text(Status),*/
                        $("<td style='text-align: center;'>").html(button),
                        /*$('<td>').html('<input type="checkbox" class="emp_checkbox" data-emp-id="'+item.RecID+'">')*/
                    ).appendTo('#data_item');
                });
                $('#example').dataTable({
                    "aLengthMenu": [[50, 100, -1], [50, 100, "All"]],
                    "pageLength": 50
                    });
            } else {
                $('#data_item').empty();
                var $tr = $('<tr>').append(
                          $('<td colspan="12" style="text-align: center;">').text('- - - No Data - - -'),
                          ).appendTo('#data_item');
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
                url : base_url + "Logistics/delete_item",
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