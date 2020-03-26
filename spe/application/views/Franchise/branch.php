<form action="#" id="myform" class="form-horizontal">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list"> Data Pembayaran Franchise Fee</i></p>
                <legend></legend>
                </div>
            </div>
        </div>
    </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="isi" class="table-responsive">
                                    <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="example2">
                                        <thead>
                                            <tr class="text-center">
                                                <th colspan="2" width="60%" style="text-align: left">Saldo Awal Hutang</th>
                                                <th width="40%" style="text-align: right;" id="SA"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="2" width="60%" style="text-align: left">Tagihan FF</th>
                                                <th width="40%" style="text-align: right;" id="TFF"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="2" width="60%" style="text-align: left">Total</th>
                                                <th width="40%" style="text-align: right;" id="TotTag"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="3" width="100%" style="text-align: center">Detail Pembayaran</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th width="10%" style="text-align: center">#</th>
                                                <th width="50%" style="text-align: center">Tanggal Transaksi</th>
                                                <th width="40%" style="text-align: center">Jumlah Bayar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data_pay"></tbody>
                                        <tfoot>
                                            <tr class="text-center">
                                                <th colspan="2" width="60%" style="text-align: left"> Pembayaran Sebelum Sistem</th>
                                                <th width="40%" style="text-align: right;" id="PSS"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="2" width="60%" style="text-align: left">Total Pembayaran</th>
                                                <th width="40%" style="text-align: right;" id="TOTPAY"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th colspan="2" width="60%" style="text-align: left">Sisa Pembayaran / Saldo Akhir Hutang</th>
                                                <th width="40%" style="text-align: right;" id="BILL"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/autoNumeric.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

<script type="text/javascript">

$(document).ready(function(){
    load_data();
});

function load_data()
{
        //alert(FFID);
        $.ajax({
            url : base_url + "Franchise/loaddetailtrxbranch",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#data_pay').empty();/*
                var jml_data = Object.keys(data.rows).length;
                if (jml_data > 0) {*/
                var SAL = 0;
                var TOT = 0;
                var PSS = 0;
                var TP = 0;
                var TT = 0;
                var BILL = 0;
                var TOTLIST = 0;
                $.each(data.rows, function(i, item) {

                    if(item.AMN == '' || item.AMN == null){
                        $('#data_item').empty();
                        var $tr = $('<tr>').append(
                                  $('<td colspan="3" style="text-align: center;">').text('- - - No Data - - -'),
                                  ).appendTo('#data_pay');
                    } else {
                        var $tr = $('<tr>').append(
                            $('<td>').text(i+1),
                            $("<td style='text-align: center;'>").text(item.DATE),
                            $("<td style='text-align: right;'>").text(convertToRupiah(item.AMN))
                        ).appendTo('#data_pay');
                    }
                SAL = parseInt(item.BGN) || 0 ;
                SAL = parseInt(item.BGN) || 0 ;
                PSS = parseInt(item.PCA) || 0 ;
                TOT = parseInt(item.TOT) || 0 ;
                TOTLIST += parseInt(item.AMN) || 0 ;
                PSS = parseInt(item.PCA) || 0 ;
                TT = TOT+SAL;
                TP = TOTLIST+PSS;
                Cabang = 'Cabang : ' + item.KodeCabang + ' - ' + item.NamaCabang;
                });
                
                $('#SA').text(convertToRupiah(SAL));
                $('#TFF').text(convertToRupiah(TOT));
                $('#TotTag').text(convertToRupiah(TOT+SAL));
                $('#PSS').text(convertToRupiah(PSS));
                $('#TOTPAY').text(convertToRupiah(TP));
                $('#BILL').text(convertToRupiah(TT-TP));
                $('#Cabang').text(Cabang);
                $('#modal_form').modal('show');
                $('.modal-title').text('Detail Transaksi Pembayaran Franchise');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
}
</script>