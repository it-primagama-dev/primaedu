<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-list"> Data Siswa Kelas Online </i></p>
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
                        <th>Kode Order</th>
                        <th>Paket</th>
                        <th>Nominal</th>
                        <th>Tanggal</th>
                        <th>Referal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="data_list"></tbody>
            </table>
        </div>
        <legend></legend>
    </div>
</div>
</form>

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
              <div class="row">
                  <div class="col-lg-12">
                      <div id="isi" class="table-responsive">
                          <h4><li>Data Siswa</li></h4>
                          <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example2">
                              <thead>
                                  <tr class="text-center">
                                      <th>No</th>
                                      <th>Nama</th>
                                      <th>Kelas</th>
                                      <th>Asal Sekolah</th>
                                      <th>Email</th>
                                      <th>No Telp</th>
                                  </tr>
                              </thead>
                              <tbody id="dt_siswa"></tbody>
                          </table>
                      </div>
                      <div id="isi" class="table-responsive">
                          <h4><li>Data Jadwal</li></h4>
                          <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example2">
                              <thead>
                                  <tr class="text-center">
                                      <th>Pertemuan</th>
                                      <th>Mapel</th>
                                      <th>Hari & Tgl</th>
                                      <th>Waktu</th>
                                      <th>iSmart</th>
                                  </tr>
                              </thead>
                              <tbody id="dt_jadwal"></tbody>
                          </table>
                      </div>
                  </div>
              </div>
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
        url : base_url+"mastercourse/get_datalistst",
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
                    
                    if(item.Status==null){
                      Status = 'Menunggu Pembayaran';
                    } else {
                      Status = 'Sudah Dibayar';
                    }
                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.OrderCode),
                        $('<td>').text(item.CatName+' - '+item.PackName+' - '+item.PackDetailName),
                        $('<td>').text(convertToRupiah(item.TotalPrice)),
                        $('<td>').text(tgl_indo(item.CreatedDate)),
                        $('<td>').text(item.ReferalCode),
                        $('<td>').text(Status),
                        $('<td>').html("<button class=\"btn btn-primary\" type=\"button\" data-toggle=\"modal\" onCLick=\"detail('"+item.SessionID+"');\">Liat Siswa & Jadwal</button"),
                    ).appendTo('#data_list');
                });
                $('#example').dataTable();
            } else {
                $('#data_list').empty();
                var $tr = $('<tr>').append(
                          $('<td colspan="7" style="text-align: center;">').text('- - - No Data - - -'),
                          ).appendTo('#data_list');
            }
        }
    });
};

function detail(SessionID)
{
        //$('#form')[0].reset();
    //$(".text-danger").remove();
    $.ajax({
        url : base_url+"mastercourse/get_liststdetail",
        type: 'POST',
        data:({SessionID:SessionID}),
        dataType: 'json',
        beforeSend: function(){
            $("#ajax-loader").show();
        },
        complete: function() {
            $("#ajax-loader").hide();
        },
        success: function(data){

            $('#modal_form').modal({backdrop: 'static', keyboard: false});
            $('#modal_form').modal('show');
            $('.modal-title').text('Data Siswa & Jadwal');

            var jml_data = Object.keys(data.rows).length;
            if (jml_data > 0) {
                $('#dt_siswa').empty();
                $('#dt_jadwal').empty();
                $.each(data.rows, function(i, item) {
                    
                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.Name),
                        $('<td>').text(item.StageName),
                        $('<td>').text(item.School),
                        $('<td>').text(item.Email),
                        $('<td>').text(item.PhoneNumber)
                    ).appendTo('#dt_siswa');
                });
                $.each(data.rows2, function(i2, item2) {
                    if(item2.IsmartName==null){
                      IsmartName = '-';
                    } else {
                      IsmartName = item2.IsmartName;
                    }
                    var $tr = $('<tr>').append(
                        $('<td>').text('Pertemuan Ke - '+item2.MeetNumber),
                        $('<td>').text(item2.SubName),
                        $('<td>').text(get_hari(item2.DateSchedule)),
                        $('<td>').text(item2.TimeFromScheDule.substring(0,5)),
                        $('<td>').text(IsmartName)
                    ).appendTo('#dt_jadwal');
                });
                //$('#example2').dataTable();
            } else {
                $('#dt_jadwal').empty();
                $('#dt_siswa').empty();
                var $tr = $('<tr>').append(
                          $('<td colspan="6" style="text-align: center;">').text('- - - No Data - - -'),
                          ).appendTo('#dt_siswa');
                var $tr = $('<tr>').append(
                          $('<td colspan="5" style="text-align: center;">').text('- - - No Data - - -'),
                          ).appendTo('#dt_jadwal');
            }
        }
    });
}
</script>