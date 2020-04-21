<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-list"> Approve Jadwal </i></p>
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
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">No</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Cabang</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Nama iSmart</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Jenjang</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Mapel</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Tanggal</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Waktu</th>
                        <th colspan="2" style="text-align: center;"><button type="button" class="btn btn-success btn-block" onclick="save();">Simpan</button></th>
                    </tr>
                    <tr class="text-center">
                        <th>Approve</th>
                        <th>Reject</th>
                    </tr>
                </thead>
                <tbody id="data_list"></tbody>
            </table>
        </div>
        <legend></legend>
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
<script src="<?=base_url('assets/js/autoNumeric.js'); ?>"></script>
    <link href="<?php echo base_url(); ?>assets/course/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript">

$(document).ready(function(){
    reload_data();
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

function reload_data() {
    $.ajax({
        url : base_url+"mastercourse/get_appr_schedule",
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
                $('#data_list').empty();
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
                        $('<td>').html(`<label class="labelradio">
                                          <input type="radio" id="radiosesi" name="`+item.RecID+`" value='11'>
                                          <span class="checkmarkradio"></span>
                                        </label>`),
                        $('<td>').html(`<label class="labelradio">
                                          <input type="radio" id="radiosesi" name="`+item.RecID+`" value='12'>
                                          <span class="checkmarkradio"></span>
                                        </label>`),
                    ).appendTo('#data_list');
                });
                $('#example').dataTable();
            } else {
                $('#data_list').empty();
                var $tr = $('<tr>').append(
                          $('<td colspan="10" style="text-align: center;">').text('- - - No Data - - -'),
                          ).appendTo('#data_list');
            }
        }
    });
};

function save() {
  //count = $('input:radio:checked').length;
      $('input[type=radio]:checked').each(function(i) {
        numb = i+1;
        getval = $(this).val();
        getid = this.name;
        $.ajax({
            url: base_url+"mastercourse/approve_schedule",
            type: "POST",
            data: ({RecID:getid,Status:getval,numb:numb}),
            dataType: 'JSON',
            success:function(data){
              $.notify(data.message,data.notify);
              reload_data();
            }
          });
      });
}
</script>