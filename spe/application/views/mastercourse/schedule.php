<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-list"> Data Schedule </i></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="text-align: right;">
        <div class="form-group">
            <div class="col-lg-12"><button type="button" class="btn btn-primary pull-right" data-toggle="modal" onclick="modal_form();"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Schedule</button>
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
                        <th>No</th>
                        <th>Kode Cabang</th>
                        <th>Nama iSmart</th>
                        <th>Stage</th>
                        <th>Sub Nama</th>
                        <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                    </tr>
                </thead>
                <tbody id="data_schedule"></tbody>
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
                            <label class="control-label col-md-3">Kode Cabang</label>
                            <div class="col-md-9">
                                <input type="text" id="BranchCode" class="form-control" placeholder="input manual dulu ya kode cabangnya ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama iSmart</label>
                            <div class="col-md-9">
                                <input type="text" id="IsmartName" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Stage Nama</label>
                            <div class="col-md-9">
                               <select class="form-control" id="StageCat">
                                   <option value="">Pilih Nama Stage</option>
                                   <option value="20">SD</option>
                                   <option value="21">SMP</option>
                                   <option value="22">SMA IPA</option>
                                   <option value="23">SMA IPS</option>
                                   <option value="24">UTBK</option>
                               </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Mapel</label>
                            <div class="col-md-9">
                               <select class="form-control" id="SubID">
                                   <option value="">Pilih Mapel</option>
                               </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal</label>
                            <div class="col-md-9">
                                <input type="date" id="Date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Waktu Mulai</label>
                            <div class="col-md-9">
                               <select class="form-control" id="TimeFrom">
                                   <option value="">Pilih Waktu Mulai</option>
                                   <option value="07:30">07:30</option>
                                   <option value="09:00">09:00</option>
                                   <option value="10:30">10:30</option>
                                   <option value="13:00">13:00</option>
                                   <option value="14:30">14:30</option>
                                   <option value="16:00">16:00</option>
                                   <option value="18:30">18:30</option>
                               </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Waktu Selesai</label>
                            <div class="col-md-9">
                               <select class="form-control" id="TimeTo">
                                   <option value="">Pilih Waktu Mulai</option>
                                   <option value="09:00">09:00</option>
                                   <option value="10:30">10:30</option>
                                   <option value="12:00">12:00</option>
                                   <option value="14:30">14:30</option>
                                   <option value="16:00">16:00</option>
                                   <option value="17:30">17:30</option>
                                   <option value="20:00">20:00</option>
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
        $('#modal_form').modal({backdrop: 'static', keyboard: false});
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Schedule');
}

 function save() {
    //alert($('#Date').val());
    $(".text-danger").remove();
      if($('[name="IsmartName"]').val() == "") {
          $('[name="IsmartName"]').after('<p class="text-danger">Wajib diisi !!!</p>');
          $('[name="IsmartName"]').focus();
          return false;
      }
      if($('[name="StageCat"]').val() == "") {
          $('[name="StageCat"]').after('<p class="text-danger">Wajib diisi !!!</p>');
          $('[name="StageCat"]').focus();
          return false;
      }
      if($('[name="SubName"]').val() == "") {
          $('[name="SubName"]').after('<p class="text-danger">Wajib diisi !!!</p>');
          $('[name="SubName"]').focus();
          return false;
      }
      if($('[name="Date"]').val() == "") {
          $('[name="Date"]').after('<p class="text-danger">Pekerjaan Harus Diisi !!!</p>');
          $('[name="Date"]').focus();
          return false;
      }
      if($('[name="TimeFrom"]').val() == "") {
          $('[name="TimeFrom"]').after('<p class="text-danger">Alamat Harus Diisi !!!</p>');
          $('[name="TimeFrom"]').focus();
          return false;
      }
      if($('[name="TimeTo"]').val() == "") {
          $('[name="TimeTo"]').after('<p class="text-danger">Pilih Tipe iSmart !!!</p>');
          $('[name="TimeTo"]').focus();
          return false;
      }
      if (confirm("Anda yakin data sudah terinput dengan benar ?")) {

      var formdata = {};
      formdata['IsmartName'] = $('#IsmartName').val();
      formdata['StageCat'] = $('#StageCat').val();
      formdata['SubID'] = $('#SubID').val();
      formdata['Date'] = $('#Date').val();
      formdata['TimeFrom'] = $('#TimeFrom').val();
      formdata['TimeTo'] = $('#TimeTo').val();
      formdata['BranchCode'] = $('#BranchCode').val();
          $.ajax({
              url : base_url+"mastercourse/save_addschedule",
              type: "POST",
              data: formdata,
              dataType: "JSON",
              beforeSend: function(){
                  $("#ajax-loader").show();
              },
              complete: function() {
                  $("#ajax-loader").hide();
              },
              success: function(data)
              {
                    $('#form')[0].reset();
                    $("#modal_form").modal('hide');
                    $.notify(data.message,data.notify);
                    reload_data();
               
              }
        })
      }
    }

function reload_data() {
    $.ajax({
        url : base_url+"mastercourse/get_data_schedule",
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
                $('#data_schedule').empty();
                $.each(data.rows, function(i, item) {
                    TimeFromOri = item.TimeFrom;
                    TimeFrom = TimeFromOri.substring(0,5);

                    TimeToOri = item.TimeTo;
                    TimeTo = TimeToOri.substring(0,5);
                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.BranchCode),
                        $('<td>').text(item.IsmartName),
                        $('<td>').text(item.StageCat),
                        $('<td>').text(item.SubjectsID),
                        $('<td>').text(item.Date),
                        $('<td>').text(TimeFrom),
                        $('<td>').text(TimeTo)
                    ).appendTo('#data_schedule');
                });
                $('#example').dataTable();
            } else {
                $('#data_schedule').empty();
                var $tr = $('<tr>').append(
                          $('<td colspan="12" style="text-align: center;">').text('- - - No Data - - -'),
                          ).appendTo('#data_schedule');
            }
        }
    });
};

$("#StageCat").change(function(e) { //1
    var StageCat = e.target.value; //2
    $.getJSON(base_url+"mastercourse/get_SubjectsName/"+StageCat, function(json){
        $('#SubID').empty();
        $('#SubID').append($('<option>').text("- - Pilih Sub Nama - -").attr('value',''));
        $.each(json, function(i, obj){
    $('#SubID').append($('<option>').text(obj.SubName).attr('value', obj.RecID));
        });
    });
})
</script>