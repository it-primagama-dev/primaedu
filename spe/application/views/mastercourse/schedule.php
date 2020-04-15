<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-list"> Data Jadwal </i></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="text-align: right;">
        <div class="form-group">
            <div class="col-lg-12"><button type="button" class="btn btn-primary pull-right" data-toggle="modal" onclick="modal_form();"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Jadwal</button>
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
                        <th>Cabang</th>
                        <th>Nama iSmart</th>
                        <th>Jenjang</th>
                        <th>Mapel</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
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
                            <label class="control-label col-md-3">Pilih Cabang</label>
                            <div class="col-md-9">
                               <select class="form-control" id="BranchCode" style="width: 100%;">
                                   <option value="">Pilih Cabang</option>
                               </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama iSmart</label>
                            <div class="col-md-9">
                                <input type="text" id="IsmartName" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jenjang</label>
                            <div class="col-md-9">
                               <select class="form-control" id="StageCat">
                                   <option value="">Pilih Jenjang</option>
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
                                <input type="text" id="Date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Waktu Mulai</label>
                            <div class="col-md-9">
                               <select class="form-control" id="TimeFrom">
                                   <option value="">Pilih Waktu Mulai</option>
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<script src="<?=base_url('assets/js/autoNumeric.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">

<script type="text/javascript">    

$(function () {
  $('#BranchCode').select2();
});

$(function(){
    var d = new Date();
    var n = d.getFullYear()+1;
    $('#Date').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "2020:"+n
    });
})

$(document).ready(function(){
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    reload_data();
    get_jadwal();
    get_cabang();
});

function get_hari(date) {
  //var date = tambah;

  var today = new Date(date);
  today.setDate(today.getDate());

  var options = {  weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
  return today.toLocaleDateString('id-id', options);
}

var save_method;
var table;
function modal_form(RecID=null)
{
    $(".text-danger").remove();
        $('#modal_form').modal({backdrop: 'static', keyboard: false});
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Jadwal');
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
      if (confirm("Anda yakin data sudah terinput dengan benar ?")) {

      var formdata = {};
      formdata['IsmartName'] = $('#IsmartName').val();
      formdata['StageCat'] = $('#StageCat').val();
      formdata['SubID'] = $('#SubID').val();
      formdata['Date'] = $('#Date').val();
      formdata['TimeFrom'] = $('#TimeFrom').val();
      //formdata['TimeTo'] = $('#TimeTo').val();
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

                    if (item.Status==null) {
                        Status = "<font color='green'>Available";
                    } else {
                        Status = "<font color='red'>Booked</font>";
                    }

                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.BranchCode+' - '+item.BranchName),
                        $('<td>').text(item.IsmartName),
                        $('<td>').text(item.StageCat),
                        $('<td>').text(item.SubjectsID),
                        $('<td>').text(get_hari(item.Date)),
                        $('<td>').text(TimeFrom+' - '+TimeTo+' WIB'),
                        $('<td>').html(Status),
                        //$('<td>').text(TimeTo)
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
        $('#SubID').append($('<option>').text("- - Pilih Mapel - -").attr('value',''));
        $.each(json, function(i, obj){
    $('#SubID').append($('<option>').text(obj.SubName).attr('value', obj.RecID));
        });
    });
})

function get_jadwal() {
    $.getJSON(base_url+"mastercourse/get_jadwal", function(json){
        $('#TimeFrom').empty();
        $('#TimeFrom').append($('<option>').text("- - Pilih Waktu - -").attr('value',''));
        $.each(json, function(i, obj){
        $('#TimeFrom').append($('<option>').text(obj.TimeFrom.substring(0,5)+' - '+obj.TimeTo.substring(0,5)+' WIB').attr('value', obj.RecID));
        });
    });
}

function get_cabang() {
    $.getJSON(base_url+"mastercourse/get_cabang", function(json){
        $('#BranchCode').empty();
        $('#BranchCode').append($('<option>').text("- - Pilih Cabang - -").attr('value',''));
        $.each(json, function(i, obj){
        $('#BranchCode').append($('<option>').text(obj.BranchCode+' - '+obj.BranchName).attr('value', obj.BranchCode));
        });
    });
}
</script>