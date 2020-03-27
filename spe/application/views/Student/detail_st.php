<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>assets/js/dateformat.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>assets/js/sha-1.js"></script>
</head>
<form action="#" id="form" class="form-horizontal">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list"> Detail Program & Pembayaran Siswa / <u><span id="student"></span></u></i></p>
                <legend></legend>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
          <div class="col-lg-12">
            <input type="hidden" id="sid" value="<?php echo $sid; ?>">
            <i class="fa" style="font-size: 18px; padding-bottom: 10px;">Detail Program & Biaya :</i>
            <table class="table table-bordered table-hover dt-responsive" width="100%" id="tableMenu3">
                <thead>
                  <tr>
                    <th style="text-align: center;">Nama Paket Program</th>
                    <th style="text-align: center;">Harga Pendaftaran</th>
                    <th style="text-align: center;">Harga Pembayaran</th>
                    <th style="text-align: center;">Detail Mata Pelajaran</th>
                  </tr>
                </thead>
                <tbody id="data_program"></tbody>
            </table>
          </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
          <legend></legend>
          <div class="form-group">
          <div class="col-lg-12">
            <div id="element"></div>
          </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
          <div class="col-lg-12">
            <i class="fa" style="font-size: 18px; padding-bottom: 20px; font-weight: bold;"><u>Jumlah Total Tagihan & Pembayaran :</u></i>
            <table class='table table-bordered table-hover dt-responsive' width='100%' id='tableMenu3'>
              <thead>
                <tr style='background-color: #DCDCDC;'>
                  <th style='text-align: left;' width="75%">Jumlah Total Biaya Bimbingan</th>
                  <th style='text-align: right;' id='totallpay'></th>
                </tr>
                <tr style='background-color: #C0C0C0;'>
                  <th style='text-align: left;' width="75%">Jumlah Total Pembayaran</th>
                  <th style='text-align: right;' id='totallnom'></th>
                </tr>
                <tr style='background-color: #A9A9A9;'>
                  <th style='text-align: left;' width="75%">Jumlah Total Sisa Pembayaran</th>
                  <th style='text-align: right;' id='totallbill'></th>
                </tr>
              </thead>
            </table>
          </div>
          </div>
        </div>
    </div>
</form>
</html>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="text-align: center;">
            <h4 class="modal-title">Form Pembayaran Program Siswa</h4>
          </div>
          <div class="modal-body">
          <form action="#" id="form2" class="form-horizontal">
            <div class="row">
                <div class="col-lg-12">
                  <input type="hidden" class="form-control" id="psdc">
                  <div class="form-group">
                  <div class="col-lg-12">
                    <i class="fa" style="font-size: 18px; padding-bottom: 20px; font-weight: bold;"><u id="programname"></u></i>
                    <table class='table table-bordered table-hover dt-responsive' width='100%' id='tableMenu3'>
                      <thead>
                        <tr>
                          <th style='text-align: left;' width="60%">Jumlah Tagihan</th>
                          <th style='text-align: right;' id='totallpay2'></th>
                        </tr>
                        <tr>
                          <th style='text-align: left;' width="60%">Jumlah Pembayaran</th>
                          <th style='text-align: right;' id='totallnom2'></th>
                        </tr>
                        <tr>
                          <th style='text-align: left;' width="60%">Sisa Tagihan</th>
                          <th style='text-align: right;' id='totallbill2'></th>
                        </tr>
                        <tr>
                          <th style='text-align: left;' width="60%">Jumlah yang akan dibayarkan</th>
                          <th style='text-align: right;' id='totallbill'>
                            <input type="text" id="nompay" class="Idr form-control" style="text-align: right;" onblur="ceknominal();">
                          </th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                  </div>
                </div>
            </div>
          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnpay" onClick="Checkout();" disabled="disabled">Checkout</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          </div>
        </div>

      </div>
    </div><!-- Modal -->

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
    reload_data();
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
});

function Checkout() {
    alert('MENUNGGU KEPUTUSAN PADUKA');
}

function modal_pay(psdc) {
    $('#myModal').modal({
        show: 'show',
        backdrop: 'static',
        keyboard: false
    })
    $('#psdc').val(psdc);
    var totallreg2 = 0;
    var totallnom2 = 0;
    var totallpro2 = 0;
    $.ajax({
        url : base_url+"student/get_detailpay",
        type: 'POST',
        data: ({psdc:psdc}),
        dataType: 'json',
        success: function(data){
                $.each(data.rows, function(i, item) {
                  totallnom2 += parseFloat(item.TotNom);
                  totallreg2 += parseFloat(item.RegisterPrice)
                  totallpro2 += parseFloat(item.ProgramPrice);
                  PackName = item.PackName;
                });
                
                  $('#totallpay2').text(convertToRupiah(totallreg2+totallpro2));
                  $('#totallnom2').text(convertToRupiah(totallnom2));
                  $('#totallbill2').text(convertToRupiah((totallreg2+totallpro2)-totallnom2));
                  $('#programname').text(PackName);
        }
      });
}

function ceknominal() {
    var nompay = parseInt(convertToAngka($('#nompay').val()));
    var totallbill = parseInt(convertToAngka($('#totallbill2').text()));
    var totallpay2 = parseInt(convertToAngka($('#totallpay2').text()));
        min = (20/100)*totallpay2;
            //alert(nompay);
        nmnull = isNaN(nompay) ? 0 : nompay;
    $(".text-danger").remove();
    if(nmnull==0){
        $('#nompay').after('<p class="text-danger" style="font-size: 11px;">Input nominal pembayaran</p>');
        $('#nompay').focus();
        $('#btnpay').attr('disabled','disabled');
            return false;
    } else if (nompay > totallbill) {
        $('#nompay').after('<p class="text-danger" style="font-size: 11px;">Nominal Melebihi Jumlah Sisa Tagihan</p>');
        $('#nompay').focus();
        $('#btnpay').attr('disabled','disabled');
            return false;
    } else if(nompay < min) {
        $('#nompay').after('<p class="text-danger" style="font-size: 11px;">Minimal Pembayaran adalah 20% dari jumlah tagihan</p>');
        $('#nompay').focus();
        $('#btnpay').attr('disabled','disabled');
            return false;
    } else {
        $('#btnpay').removeAttr('disabled');
    }
}

function reload_data() {
    $.ajax({
        url : base_url+"student/get_detailst",
        type: 'POST',
        data: ({StudentID:$('#sid').val()}),
        dataType: 'json',
        success: function(data){
            $('#data_program').empty();
            var jml_data = Object.keys(data.rows).length;
            var total = 0;
            if (jml_data > 0) {
                $.each(data.rows, function(i, item) {
                    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.PackName),
                        $('<td>').text(convertToRupiah(item.RegisterPrice)),
                        $('<td>').text(convertToRupiah(item.ProgramPrice)),
                        $('<td>').text(item.SubjectsName),
                    ).appendTo('#data_program');
                    nisp = item.NISP;
                    name = item.Name;
                });
                    MergeCommonRows($("#tableMenu3"),3);
                    MergeCommonRows($("#tableMenu3"),2);
                    MergeCommonRows($("#tableMenu3"),1);
                    $('#student').text(nisp+' - '+name);
                $.each(data.rows2, function(i, item2) {
                  table = "<i class='fa' style='font-size: 18px;'>Detail Tagihan & Pembayaran : <u>Program "+item2.PackName+"</u></i><button type='button' id='tambah' class='btn btn-success btn-sm pull-right' data-toggle='modal' onclick='modal_pay("+item2.ProgramStudentCode+");'> Bayar Program Ini</button><br></br><table class='table table-bordered table-hover dt-responsive' width='100%' id='tableMenu3'><thead><tr style='background-color: #DCDCDC;'><th style='text-align: left;' colspan='6'>Jumlah Biaya Bimbingan</th><th style='text-align: right;' colspan='2' id='totpaypro"+item2.ProgramStudentCode+"'></th><th></th><thead><tr><th style='text-align: center;'>Pembayaran Untuk</th><th style='text-align: center;'>No. Kwitansi</th><th style='text-align: center;'>No. Invoice</th><th style='text-align: center;'>Metode</th><th style='text-align: center;'>Kode Pembayaran</th><th style='text-align: center;'>Tgl Transaksi</th><th style='text-align: center;'>Status</th><th style='text-align: center;'>Nominal</th><th style='text-align: center;'>Aksi</th></tr></thead><tbody id='data_payment"+item2.ProgramStudentCode+"'></tbody><thead><tr style='background-color: #C0C0C0;'><th style='text-align: left;' colspan='6'>Jumlah Pembayaran</th><th style='text-align: right;' colspan='2' id='totnompro"+item2.ProgramStudentCode+"'></th><th></th><thead><thead><tr style='background-color: #A9A9A9;'><th style='text-align: left;' colspan='6'>Sisa Pembayaran</th><th style='text-align: right;' colspan='2' id='billpro"+item2.ProgramStudentCode+"'></th><th></th><thead></table><legend></legend>";
                  var $tr = $('<div>').append(
                      $('<div>').html(table),
                  ).appendTo('#element');
                     $('#totpaypro'+item2.ProgramStudentCode).text(convertToRupiah(parseFloat(item2.RegisterPrice)+parseFloat(item2.ProgramPrice)));
                });
                $.each(data.rows3, function(i, item3) {
                  //alert(item3.PaymentFor);
                    if(item3.InvoiceNumber==null){
                      inv = '-';
                    } else {
                      inv = item3.InvoiceNumber;
                    }
                    if(item3.PaymentCode==null){
                      paycode = '-';
                    } else {
                      paycode = item3.PaymentCode;
                    }
                    var $tr = $('<tr>').append(
                        $('<td>').text(item3.PaymentFor),
                        $("<td style='text-align: center'>").text(item3.ReceiptID),
                        $("<td style='text-align: center'>").text(inv),
                        $("<td style='text-align: center'>").text(item3.Method),
                        $("<td style='text-align: center'>").text(paycode),
                        $('<td>').text(tgl_indo(item3.PaymentDateTime)),
                        $("<td style='text-align: center'>").text(item3.Status),
                        $("<td style='text-align: right'>").text(convertToRupiah(item3.Amount)),
                        $('<td>').html("<button type='button' id='tambah' class='btn btn-warning btn-xs pull-center' data-toggle='modal' onclick='modal_form();'> Cetak</button>")
                     ).appendTo('#data_payment'+item3.ProgramStudentCode);
                });
                var totallreg = 0;
                var totallnom = 0;
                var totallpro = 0;
                $.each(data.rows4, function(i, item4) {
                  $('#totnompro'+item4.ProgramStudentCode).text(convertToRupiah(item4.TotNom));
                  $('#billpro'+item4.ProgramStudentCode).text(convertToRupiah(parseFloat(item4.RegisterPrice)+parseFloat(item4.ProgramPrice)-parseFloat(item4.TotNom)));
                  totallnom += parseFloat(item4.TotNom);
                  totallreg += parseFloat(item4.RegisterPrice)
                  totallpro += parseFloat(item4.ProgramPrice);
                });
                
                  $('#totallpay').text(convertToRupiah(totallreg+totallpro));
                  $('#totallnom').text(convertToRupiah(totallnom));
                  $('#totallbill').text(convertToRupiah((totallreg+totallpro)-totallnom));

            } else {
                $('#data_program').empty();
                var $tr = $('<tr>').append(
                        $('<td colspan="4" style="text-align:center;">').text('- - - tidak ada detail program - - -'),
                        ).appendTo('#data_program');
            }

        }
      });
}

function MergeCommonRows(table, columnIndexToMerge){
    previous = null;
    cellToExtend = null;
    table.find("td:nth-child("+columnIndexToMerge+")").each(function(){
        jthis = $(this);
        content = jthis.text()
        if(previous == content){
            jthis.remove();
            if(cellToExtend.attr("rowspan") == undefined){
                cellToExtend.attr("rowspan", 2);
            }
            else{
                currentrowspan = parseInt(cellToExtend.attr("rowspan"));
                cellToExtend.attr("rowspan", currentrowspan+1);
            }
        }
        else{
            previous = content;
            cellToExtend = jthis;
        }
    });
};

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
</script>