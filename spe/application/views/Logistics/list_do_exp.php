<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-6">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-truck"> Input Detail Expedisi</i></p>
            </div>
            <div class="col-lg-6" style="text-align: right;">
            <p><a href="javascript:void(0)" class="btn btn-warning" id="btnbc"> <i class="fa fa-file">  Data Detail Expedisi</i></a></p>
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
                    <tr>
                        <th style="text-align: center;" width="5%">No</th>
                        <th style="text-align: center;" width="20%">PR</th>
                        <th style="text-align: center;" width="20%">No. Pengiriman</th>
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
                            <label class="control-label col-md-3">PR</label>
                            <div class="col-md-9">
                                <input type="text" name="PR_Number" class="form-control" value="" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No. Pengiriman</label>
                            <div class="col-md-9">
                                <input type="text" name="DO_Number" class="form-control" value="" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Expedisi</label>
                            <div class="col-md-9">
                                <select name="Expedisi" id="Expedisi" class="form-control">
                                    <option value="">--Pilih Expedisi--</option>
                                    <?php foreach ($item->result() as $r) { ?>
                                        <option value="<?php echo $r->RecID ?>"><?php echo $r->Exp_Name ?></option>
                                    <?php } ?>
                                </select>
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
                                <input type="text" name="Link" class="form-control" value="" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No. Resi</label>
                            <div class="col-md-9">
                                <input type="text" name="Resi" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Kirim</label>
                            <div class="col-md-9">
                                <input type="text" name="Deliv_Date" id="Deliv_Date" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Estimasi</label>
                            <div class="col-md-9">
                                <input type="text" name="Est_Date" id="Est_Date" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Koli</label>
                            <div class="col-md-9">
                                <input type="text" name="Koli" class="form-control" value="">
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>
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

$("#btnbc").click(function(e) {
    window.location.href = base_url + "Logistics/list_do_exp_edit";
});

$(function(){
    var d = new Date();
    var n = d.getFullYear();
    $('[name="Est_Date"],[name="Deliv_Date"]').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "2017:"+n
    });
})
$(document).ready(function(){
    reload_data();
});

function reload_data() {
    //var PR = $('#PR').val();
    $.ajax({
        url : base_url+"Logistics/get_list_do_exp",
        type: 'GET',
        //data: ({PR:PR}),
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
                $('#data_po').empty();
                $.each(data.rows, function(i, item) {

                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.PR_Number),
                        $('<td>').text(item.DO_Number),
                        $('<td>').text(item.Area+' / '+item.KodeAreaCabang+' - '+item.NamaAreaCabang),    
                        $('<td style="text-align: center;">').html('<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" onclick="modal_form('+item.RecID+');"><span class="glyphicon glyphicon-pencil"></span> Input Detail</button>'),
                    ).appendTo('#data_po');
                });
                $('#example').dataTable();
            } else {
                $('#data_po').empty();
                var $tr = $('<tr>').append(
                        $('<td colspan="5" style="text-align:center;">').text('- - - Tidak Ada Data - - -'),
                        ).appendTo('#data_po');
            }
        }
    });
};

function modal_form(RecID)
{
        $('#form')[0].reset();

        $.ajax({
            url : base_url + "Logistics/Input_do_exp/"+RecID,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form').modal({backdrop: 'static', keyboard: false});
                $('[name="Expedisi"]').val(data.Expedisi);
                $('[name="PR_Number"]').val(data.PR_Number);
                $('[name="DO_Number"]').val(data.DO_Number);
                $('[name="CP"]').val(data.Contact);
                $('[name="Link"]').val(data.Link);
                $('[name="Deliv_Date"]').val(data.DO_Date);
                $('[name="Est_Date"]').val(data.Estimate_Date);
                $('[name="Resi"]').val(data.NoResi);
                $('[name="RecID"]').val(RecID);
                $('[name="Koli"]').val(data.Koli);
                $('#modal_form').modal('show');
                $('.modal-title').text('Input Detail Expedisi');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
}

function save()
{
    $(".text-danger").remove();
    if($('[name="Expedisi"]').val() == "") {
        $('[name="Expedisi"]').after('<p class="text-danger">This field is required</p>');
        $('[name="Expedisi"]').focus();
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
    if($('[name="Deliv_Date"]').val() == "") {
        $('[name="Deliv_Date"]').after('<p class="text-danger">This field is required</p>');
        $('[name="Deliv_Date"]').focus();
        return false;
    }
    if($('[name="Est_Date"]').val() == "") {
        $('[name="Est_Date"]').after('<p class="text-danger">This field is required</p>');
        $('[name="Est_Date"]').focus();
        return false;
    }
    if($('[name="Koli"]').val() == "") {
        $('[name="Koli"]').after('<p class="text-danger">This field is required</p>');
        $('[name="Koli"]').focus();
        return false;
    } else {
        url = base_url + "Logistics/save_input_exp";
        $('#data_po').empty();
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                $.notify(data.message,data.notify);
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

$("#Expedisi").change(function(e) {
    var RecID = e.target.value;
    //alert(RecID);
    $.ajax({
        url : base_url + "Logistics/edit_exp/"+RecID,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="CP"]').val(data.Contact);
            $('[name="Link"]').val(data.Link);
        }
    });
})
</script>