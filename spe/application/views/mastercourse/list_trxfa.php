<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-list"> Data Transaksi Kelas Online </i></p>
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
                        <th>No. Inv</th>
                        <th>Paket</th>
                        <th>VA</th>
                        <th>Nominal</th>
                        <th>Tgl Trx</th>
                        <th>Cabang</th>
                        <th>Status</th>
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

function covert_date(data) {
  return data.replace(/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/,"$1/$2/$3 $4:$5:$6");
}

var save_method;
var table;

function reload_data() {
    $.ajax({
        url : base_url+"mastercourse/get_datatrxfa",
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
                      Status = 'WAITING';
                    } else if(item.Status==1) {
                      Status = 'SUCCESS';
                    } else if(item.Status==2) {
                      Status = 'EXPIRED';
                    }
                    PAYDATEORI = item.PAYMENTDATETIME;
                    if (PAYDATEORI==null) {
                      PAYDATE = '-';
                    } else {
                      PAYDATE = tgl_indo(covert_date(PAYDATEORI));
                    }
                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.OrderCode),
                        $('<td>').text(item.CatName+' - '+item.PackName+' - '+item.PackDetailName),
                        $('<td>').text(item.PAYMENTCODE),
                        $('<td>').text(convertToRupiah(item.AMOUNT)),
                        $('<td>').text(PAYDATE),
                        $('<td>').text(item.ReferalCode),
                        $('<td>').text(Status),
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
</script>