<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-list"> Approve iSmart </i></p>
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
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">No.</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Cabang</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Nama_iSmart</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Posisi</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">No_Telp</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Tgl_Lahir</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Kendala_Teknis</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Penyampaian_Konten</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Kesiapan_Sinyal</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Mapel</th>
                        <th rowspan="2" style="text-align: center; padding-bottom: 32px;">Bab_dikuasai</th>
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

var save_method;
var table;

function reload_data() {
    $.ajax({
        url : base_url+"mastercourse/get_apprismart",
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
                        $('<td>').text(item.BranchCode),
                        $('<td>').text(item.IsmartName),
                        $('<td>').text(item.Position),
                        $('<td>').text(item.PhoneNumber),
                        $('<td>').text(item.BirthDate),
                        $('<td>').text(item.Opsi1),
                        $('<td>').text(item.Opsi2),
                        $('<td>').text(item.Opsi3),
                        $('<td>').text(item.SubName+' - '+item.StageCat),
                        $('<td>').text(item.SubjectBab),
                        $('<td>').html(`<label class="labelradio">
                                          <input type="radio" id="radiosesi" name="`+item.RecID+`" value='1'>
                                          <span class="checkmarkradio"></span>
                                        </label>`),
                        $('<td>').html(`<label class="labelradio">
                                          <input type="radio" id="radiosesi" name="`+item.RecID+`" value='2'>
                                          <span class="checkmarkradio"></span>
                                        </label>`),
                    ).appendTo('#data_list');
                });
                $('#example').dataTable();
            } else {
                $('#data_list').empty();
                var $tr = $('<tr>').append(
                          $('<td colspan="13" style="text-align: center;">').text('- - - No Data - - -'),
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
            url: base_url+"mastercourse/approve_ismart",
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