<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>assets/js/dateformat.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>assets/js/sha-1.js"></script>
<script language="javascript" type="text/javascript">

function randomString(STRlen) {
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    var string_length = STRlen;
    var randomstring = '';
    for (var i=0; i<string_length; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars.substring(rnum,rnum+1);
    }

    return randomstring;
}
</script>
</head>
<form action="#" id="form" class="form-horizontal">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-cart-plus"> Form Pemesanan Buku</i></p>
                <legend></legend>
                <?php if($order>=6) { ?>
                <p style="color: red; font-weight: bold;">*Pemesanan buku anda telah mencapai 6 kali terhitung sejak tanggal 1 Juli 2019, pada pemesanan selanjutnya akan dikenakan biaya ongkir sebesar Rp 15.000,00 per buku  .</p>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="col-md-4">PR/No. Pemesanan</label>
            <div class="col-lg-8">
                <input type="text" id="PR" name="PR" class="form-control" value="<?php echo $PR; ?>" readonly="readonly">
            </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4">Tanggal Pemesanan</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="date" value="<?php echo date('d-m-Y'); ?>" readonly="readonly"/>
                    <input type="hidden" class="form-control" name="date_inv" value="<?php echo date('Y-m-d'); ?>" readonly="readonly"/>
                    <p style="display: none;" id="basket"></p>
                    <input type="hidden" id="name" name="name" value="<?php echo $Name ;?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $Email ;?>">
                    <input type="hidden" id="BranchCode" name="BranchCode" value="<?php echo $BranchCode ;?>">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label style="font-size: 17px;" class="col-md-12"><!-- Akan direset pada : <b style="color:red;" id="expiredva"></b><br> --><!-- <p id='timerr'></p> -->
                    <i style="font-size: 13px;color:red;">*Note : <br> Form Pemesanan akan direset setiap hari pada jam 00:00.</i></label>
            </div>
        </div>
    </div>
    <div class="row print-hidden">
        <div class="col-lg-6">
        <legend class="print-hidden"></legend>
            <div class="form-group">
                <div class="col-lg-12">
                    <select id="ItemCode" name="ItemCode" class="form-control">
                        <option value=""> - - Pilih Buku - - </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <legend class="print-hidden"></legend>
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th style="text-align:center;">#</th>
                            <th width="30%" style="text-align:center;">Paket Buku</th>
                            <th width="15%" style="text-align:center;">Qty</th>
                            <th width="20%" style="text-align:center;">Harga Satuan</th>
                            <th width="25%" style="text-align:center;">Sub Total</th>
                            <th class="print-hidden" style="text-align:center;" data-sortable="false">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="data_item"></tbody>
                    <tbody id="data_item_total">
                        <tr>
                            <th colspan="4" style="text-align: right;">Total</th>
                            <th id="total_t" style="text-align: right;"></th>
                            <th class="print-hidden"></th>
                        </tr>
                        <tr>
                            <th colspan="4" style="text-align: right;">Deposit<br><font color="red" size="1">*Maksimal deposit dapat digunakan adalah 80% dari total tagihan.</font></th>
                            <th>
                                <select id="Deposit" name="Deposit" class="form-control" onchange="add_deposit()">
                                    <option value=""> . . . </option>
                                </select>
                            </th>
                            <th class="print-hidden"></th>
                        </tr>
                        <tr>
                            <th colspan="4" style="text-align: right;">Total Tagihan</th>
                            <th id="total_tagihan" style="text-align: right;"></th>
                            <th class="print-hidden"></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group" id="btnSavehide" style="display: none;">
                <div class="col-md-12">
                    <button type="button" id="btnSave" class="btn btn-success" onclick="Checkout()"><i class="fa fa-paypal"> </i>  Checkout</button>
                </div>
            </div>
        </div>
    </div><!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="text-align: center;">
            <h4 class="modal-title">Pemesanan <i class="fa" id="NoPR"></i> <!-- / <i class="fa" id="INV"></i> --></h4>
          </div>
          <div class="modal-body">
            <p style="color: red;"><b><u>Pemesanan buku ini akan dikirim ke Alamat berikut :</u></b><br>
                
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th style="text-align:center;"><?php echo $Alamat; ?></th>
                        </tr>
                    </thead>
                </table>
                *Mohon untuk konfirmasi via email ke Helpdesk dan cc ke Logistik apabila alamat tersebut tidak sesuai, terima kasih.<br></p>
                <legend></legend>
            <p style="color: red;"><b><u>Informasi Estimasi Pengiriman Buku :</u></b><br>
                <?php echo $Estimasi; ?> </p>
                <legend></legend>
            <p style="color: red"><b><u>Ketentuan Pemesanan Buku :</u></b><br>
                <ol style="color: black;">
                <li>Setelah checkout detail pemesanan tidak dapat diubah.</li>
                <li>Batas maksimal pembayaran adalah 2 hari.</li>
                <li>Apabila tidak melakukan pembayaran melebihi batas waktu yang ditentukan, maka status pemesanan tersebut akan otomatis expired dan akan mengurangi 1 gratis ongkir (total 6x gratis ongkir).</li></ol></p>
          </div>
          <div class="modal-footer">
        <span class="form-control-static pull-left">
        <div class="checkbox checkbox-success checkbox-inline">
            <input type="checkbox" id="inlineCheckbox2" onchange="document.getElementById('Lanjutkan').disabled = !this.checked;" name='cek'>
            <label for="inlineCheckbox2"> Saya telah memahami ketentuan di atas.  </label>

        </div>
        </span>
            <button type="button" id="Lanjutkan" class="btn btn-primary" onClick="getpayment();" disabled="disabled">Lanjutkan</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          </div>
        </div>

      </div>
    </div><!-- Modal -->
    <div id="myModal2" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="text-align: center;">
            <h4 class="modal-title"><i class="fa">Pilih Metode Pembayaran</i> <!-- / <i class="fa" id="INV"></i> --></h4>
          </div>
          <div class="modal-body" style="text-align: left;">
            
                <div class="form-group">
                    <div class="col-lg-12">
                        <img style="width: 30%;" class="img-responsive" src="<?php echo base_url(); ?>assets/images/alto.jpg"/>
                    </div>
                    <div class="col-lg-12">
                        <p style="font-size: 12px;"> - Klik tombol "Tampilkan Kode Pembayaran" dan catat kode yang muncul. <br> 
                         - Cara melakukan pembayaran akan ditampilkan setelah klik tombol tersebut.<br>
                      </p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-6">
                        <img style="width: 45%;" class="img-responsive" src="<?php echo base_url(); ?>assets/images/bca.png"/>
                    </div>
                    <div class="col-lg-6" style="text-align: right;">
                        <button type="button" class="btn btn-warning btn-md" onClick="saveprnew(29);">Tampilkan Kode Pembayaran</button>
                    </div>
                </div>
                    <!-- <legend></legend>
                <div class="form-group">
                    <div class="col-lg-6">
                        <img style="width: 45%;" class="img-responsive" src="<?php echo base_url(); ?>assets/images/permata.png"/>
                    </div>
                    <div class="col-lg-6" style="text-align: right;">
                        <button type="button" class="btn btn-warning btn-md" onClick="saveprnew(36);">Tampilkan Kode Pembayaran</button>
                    </div>
                </div>
                    <legend></legend>
                <div class="form-group">
                    <div class="col-lg-6">
                        <img style="width: 45%;" class="img-responsive" src="<?php echo base_url(); ?>assets/images/cimb.png"/>
                    </div>
                    <div class="col-lg-6" style="text-align: right;">
                        <button type="button" class="btn btn-warning btn-md" onClick="saveprnew(32);">Tampilkan Kode Pembayaran</button>
                    </div>
                </div>
                    <legend></legend>
                <div class="form-group">
                    <div class="col-lg-6">
                        <img style="width: 45%;" class="img-responsive" src="<?php echo base_url(); ?>assets/images/danamon.png"/>
                    </div>
                    <div class="col-lg-6" style="text-align: right;">
                        <button type="button" class="btn btn-warning btn-md" onClick="saveprnew(33);">Tampilkan Kode Pembayaran</button>
                    </div>
                </div>
                    <legend></legend> -->
            
            <!-- <p style="text-align: center;">
            <button type="button" class="btn btn-primary btn-lg" onClick="saveprnew();">VA BCA OFFLINE</button>
            <button type="button" class="btn btn-success btn-lg Permata" onClick="savepr();">VA PERMATA ONLINE</button>
            </p>
            <p style="text-align: left; color: red;"><b>Ketentuan Metode Pembayaran :</b><br>
                1. Pilih "VA BCA OFFLINE" untuk melakukan pembayaran melalui VA BCA dan pemesanan buku akan di proses H+1 setelah melakukan pembayaran. *hari kerja<br>
                2. Pilih "VA PERMATA ONLINE" untuk melakukan pembayaran melalui VA Permata dan pemesanan buku akan diproses pada hari yang sama setelah melakukan pembayaran. *hari kerja<br>
                3. Untuk pembayaran melalui "VA PERMATA ONLINE" mohon agar dipastikan limit transaksi harian (transfer antar bank) mencukupi untuk melunasi tagihan.</p> -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          </div>
        </div>

      </div>
    </div>
<!-- Modal Info Pengiriman-->
    <div id="myModalPC" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="text-align: center;">
            <h3 class="modal-title"><b>Informasi Estimasi Pengiriman Buku</b></h3>
          </div>
          <div class="modal-body" style="text-align: left;">
            <i class="fa" style="color: black; font-size: 20px;"> 
                <?php 
                    if($Estimasi!=''){
                        echo $Estimasi; 
                    } else {
                        echo "Pengiriman Buku Normal";
                    }
                ?> 
            </i>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
          </div>
        </div>

      </div>
    </div>
</form>
</html>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<script type="text/javascript">
$(document).ready(function(){
    reload_data();
    get_item();
    $('.Permata').attr('disabled','disabled').removeAttr('onclick');
    //get_deposit();
    $('#myModalPC').modal({
        show: 'show',
        backdrop: 'static',
        keyboard: false
    })
});
$(function () {
    $('#ItemCode').select2();
});

function Checkout(){
    var PR = $('#PR').val();    
    var PriceTotal = convertToAngka(document.getElementById("total_t").innerHTML);
    $.ajax({
        url : base_url+"Logistics/cek_nominal",
        type: 'POST',
        data: ({PR:PR}),
        dataType: 'json',
        success: function(data){
            Nom=data.rows[0];
            Nom2=data.rows2[0];
            NomTot=Nom+Nom2;
            if(NomTot==PriceTotal){
            $('#NoPR').text(PR);
            //$('#INV').text(inv);
            //$('#myModal').modal('show');
            $('#myModal').modal({
                show: 'show',
                backdrop: 'static',
                keyboard: false
            })
            } else {
                alert("Gagal melakukan Checkout, silahkan ulangi...");
                reload_data();
            }
        }
    });
}

function getpayment(){ 
            $('#myModal2').modal({
                show: 'show',
                backdrop: 'static',
                keyboard: false
    });
}

function get_item() {
$.getJSON(base_url+"Logistics/get_item", function(json){
    $('#ItemCode').empty();
    $('#ItemCode').append($('<option>').text("- - Pilih Buku - -"));
    $.each(json, function(i, obj){
$('#ItemCode').append($('<option>').text(obj.PackName).attr('value', obj.RecID));
    });
});
}

$("#ItemCode").change(function(e) {
    var ItemCode = e.target.value;
    var PR = $('#PR').val();
    //var kodebarang = e.target.value;
    //alert(ItemCode);
    if(ItemCode=='- - Pilih Buku - -'){
        //alert('!!');
    } else {
            $.ajax({
                url : base_url+"Logistics/cek_order_tmp",
                type: "POST",
                data: ({ItemCode:ItemCode,PR:PR}),
                dataType: "JSON",
                success: function(data1)
                {
                    if (data1.rows[0].total_item > 0) {
                        alert("Barang sudah ada.");
                    } else {
                        $.ajax({
                            url : base_url + "Logistics/order_add",
                            type: "POST",
                            data: ({ItemCode:ItemCode,PR:PR,token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=")}),
                            dataType: "JSON",
                            beforeSend: function(){
                                $("#ajax-loader").show();
                            },
                            complete: function() {
                                $("#ajax-loader").hide();
                            },
                            success: function(data)
                            {
                                reload_data();
                                $.notify(data.message,data.notify);
                            }
                        });
                    } 
                }
            });
        }
});

var dataTampung;
function reload_data() {
    $('#basket').empty();
    var PR = $('#PR').val();
    $('#btnSavehide').css('display','none');
    $.ajax({
        url : base_url+"Logistics/get_order_tmp",
        type: 'POST',
        data: ({PR:PR}),
        dataType: 'json',
        success: function(data){
            var dataTampung = data;
            var jml_data = Object.keys(data.rows).length;
            var total = 0;
            if (jml_data > 0) {
                $('#data_item').empty();
                $('#btnSavehide').css('display','block');
                $.each(data.rows, function(i, item) {
                    if (item.PackType==8) {
                        PriceFix = item.PricePack;   
                    } else {
                        PriceFix = item.Price;
                    }
                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.PackName),
                        $('<td style="display:none">').html("<input class=\"form-control\" type=\"text\" name=\"ItemCodeVal\" id=\"ItemCodeVal"+item.RecID+"\" value=\""+item.RecID+"\">"),
                        $('<td style="display:none">').html("<input class=\"form-control\" type=\"text\" name=\"PackType\" id=\"PackType"+item.RecID+"\" value=\""+item.PackType+"\">"),
                        $('<td style="display:none">').html("<input class=\"form-control\" type=\"text\" name=\"PackCode\" id=\"PackCode"+item.RecID+"\" value=\""+item.PackCode+"\">"),
                        $('<td>').html("<input class=\"form-control\" type=\"text\" name=\"qty\" id=\"qty"+item.RecID+"\" onblur=\"ubah_qty("+item.RecID+",'"+item.ItemCode+"')\" value=\""+item.Quantity+"\"><input class=\"hidden\" type=\"text\" name=\"qty2\" id=\"qty2"+item.RecID+"\" value=\""+item.Quantity+"\">"),
                        $('<td style="text-align:right;">').text(convertToRupiah(PriceFix)),
                        $('<td style="display:none">').html("<input class=\"Idr form-control\" type=\"text\" style=\"text-align:right;\" name=\"harga\" id=\"harga"+item.RecID+"\" value=\""+convertToRupiah(PriceFix)+"\">"),
                        $('<td style="text-align:right;">').text(convertToRupiah(parseInt(PriceFix)*parseInt(item.Quantity))),
                        $('<td class="print-hidden">').html("<a href=\"javascript:void(0)\" onclick=\"delete_data("+item.RecID+",'"+item.ItemCode+"',"+item.Quantity+")\"><i style=\"color: red\" class=\"fa fa-trash\"></i></a>"),
                        $('<td style="display:none">').html('<input type="hidden" name="id" class="emp_checkbox" data-emp-id="'+item.RecID+'" value="'+item.RecID+'">')
                    ).appendTo('#data_item');
                    total += isNaN(parseInt(PriceFix)*parseInt(item.Quantity)) ? 0 : parseInt(parseInt(PriceFix)*parseInt(item.Quantity));
                    basket = item.PackCode+','+PriceFix+'.00'+','+item.Quantity+','+PriceFix*item.Quantity+'.00'+';';
                    $('#basket').append(basket);
                });
                $('#total_t').text(convertToRupiah(total));
                $('#total_tagihan').text(convertToRupiah(total));
                
                $.each(data.rows2, function(i, item2) {
                    deposit=item2.Nominal;
                });
                if(deposit=='' || deposit==null || deposit == 0){
                var total_dp = 0;
                } else {
                var total_dp = (80/100)*total;
                }
                $('#Deposit').empty();
                $('#Deposit').append($('<option>').text("- - -").attr('value', 0));
                if(deposit=='' || deposit==null || deposit == 0){
                $('#Deposit').append($('<option>').text('Anda tidak memiliki deposit.').attr('value', 0));
                } else if(deposit < total_dp){
                $('#Deposit').append($('<option>').text(convertToRupiah(deposit)+' dari total deposit '+convertToRupiah(deposit)).attr('value', deposit));
                } else {
                $('#Deposit').append($('<option>').text(convertToRupiah(total_dp)+' dari total deposit '+convertToRupiah(deposit)).attr('value', total_dp));
                }
            } else {
                $('#data_item').empty();
                $('#total_t').empty();
                $('#total_tagihan').empty();
                var $tr = $('<tr>').append(
                        $('<td colspan="7" style="text-align:center;">').text('- - - Belum ada detail item diinput - - -'),
                        ).appendTo('#data_item');
            }
        }
    });
};

function add_deposit(){
    var Deposit = document.getElementById("Deposit").value;
    var Total = convertToAngka(document.getElementById("total_t").innerHTML);
    var total_tagihan = Total-Deposit;
    $('#total_tagihan').text(convertToRupiah(total_tagihan));
}

function delete_data(RecID,ItemCode,Qty) {
    if (confirm("Are you sure you want to delete this ?")) {
        $('#basket').empty();
        var PR = $('#PR').val();
        $('#data_item').empty();
        $.ajax({
            url : base_url+"Logistics/delete_order_tmp",
            type: "POST",
            data: ({ItemCode:ItemCode,RecID:RecID,qty:Qty,PR:PR}),
            dataType: "JSON",
            beforeSend: function(){
                $("#ajax-loader").show();
            },
            complete: function() {
                $("#ajax-loader").hide();
            },
            success: function(data) 
            {
                reload_data();
                get_item();
                $.notify(data.message,data.notify);
            }
        });
    }
};

function ubah_qty(RecID,ItemCode) {
    var input_stokori = $('#qty'+RecID).val();
    var input_stok_tmp = parseInt($('#qty2'+RecID).val());
    var input_stok = parseInt($('#qty'+RecID).val());
    var ItemCode = $('#ItemCodeVal'+RecID).val();
    var PackType = $('#PackType'+RecID).val();
    var PackCode = $('#PackCode'+RecID).val();
    var PR = $('#PR').val();
    //alert(RecID);
    if(input_stokori==0 || input_stokori==''){
        alert('Qty tidak boleh 0 (Kosong)');
        reload_data();
    } else {
    $.ajax({
        url : base_url+"Logistics/cek_stok_item",
        type: "POST",
        data: ({ItemCode:ItemCode,PR:PR,PackType:PackType,PackCode:PackCode}),
        dataType: "JSON",
        beforeSend: function(){
            $("#ajax-loader").show();
        },
        complete: function() {
            $("#ajax-loader").hide();
        },
        success: function(data)
        {
            var total_stok = parseInt(data.rows[0].stok);
            //alert(ItemCode+' = '+input_stok+' / '+input_stokori+' / '+input_stok_tmp);
            //alert(PackType);
            if (input_stok > total_stok && PackType!=1 && PackType !=6 && PackType !=8) {
                alert('Stok item tidak mencukupi sisa stok adalah '+total_stok);
                reload_data();
            } else {
                    $.ajax({
                        url : base_url+"Logistics/update_qty_tmp",
                        type: "POST",
                        data: ({qty:input_stok,qtytmp:input_stok_tmp,RecID:RecID,ItemCode:ItemCode,PR:PR,token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=")}),
                        dataType: "JSON",
                        beforeSend: function(){
                            $("#ajax-loader").show();
                        },
                        complete: function() {
                            $("#ajax-loader").hide();
                        },
                        success: function(data)
                        {
                            $.notify(data.message,data.notify);
                            reload_data();
                            get_item();
                        }
                    });
            }
        }
    });
}
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

/*function savepr() {
    if (confirm("Anda yakin akan melanjutkan proses pembayaran dengan VA PERMATA ?")) {
    $.ajax({
        url : base_url+"Logistics/get_invoice_number",
        dataType: 'json',
        success: function(data){
            inv=data.rows;
            //alert(inv);
            $.ajax({
                url : base_url+"Logistics/cek_invoice",
                type: "POST",
                data: ({inv:inv}),
                dataType: "JSON",
                success: function(data1)
                {
                    if (data1.rows[0].Invoice > 0) {
                        alert("Gagal cetak invoice, silahkan ulangi.");
                    } else {
                        //alert('ok');
                    var Discount = document.getElementById("Deposit").value;
                    if (Discount == '') {
                    var Discount = 0;
                    } else {
                    var Discount = document.getElementById("Deposit").value;
                    }
                    var PriceTotal = convertToAngka(document.getElementById("total_t").innerHTML);
                    var Nominal = convertToAngka(document.getElementById("total_tagihan").innerHTML);
                    //alert(Discount);
                    var formdata = {};
                    //formdata['kode'] = window.btoa(1);
                    formdata['token'] = window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=");
                    formdata['PR'] = window.btoa($('[name="PR"]').val());
                    formdata['Invoice_Number'] = window.btoa(inv);
                    formdata['PR_Date'] = window.btoa($('[name="date"]').val());
                    formdata['Invoice_Date'] = window.btoa($('[name="date_inv"]').val());
                    formdata['PriceTotal'] = window.btoa(PriceTotal);
                    formdata['Discount'] = window.btoa(Discount);
                    formdata['Nominal'] = window.btoa(Nominal);
                    formdata['Note'] = window.btoa($('[name="note"]').val());
                    $.ajax({
                        url : base_url+"Logistics/save_pr",
                        type: "POST",
                        data: formdata,
                        dataType: "JSON",
                        success: function(data)
                        {
                            var formdata = {};
                            var now = new Date();
                            var Nominal = convertToAngka(document.getElementById("total_tagihan").innerHTML);
                            formdata['MALLID'] = decode64('MzM2Mw==');//decode64('NTU0Nw==');
                            formdata['CHAINMERCHANT'] = 'NA';
                            formdata['BASKET'] = document.getElementById("basket").innerHTML;
                            formdata['CURRENCY'] = decode64('MzYw');
                            formdata['PURCHASECURRENCY'] = decode64('MzYw');
                            formdata['AMOUNT'] = Nominal+'.00';
                            formdata['PURCHASEAMOUNT'] = Nominal+'.00';
                            formdata['TRANSIDMERCHANT'] = inv;
                            formdata['SHAREDKEY'] = decode64('UzlTZHVKTTA5Mnpj');
                            formdata['WORDS'] = SHA1(Nominal+'.00'+decode64('MzM2Mw==')+decode64('UzlTZHVKTTA5Mnpj')+inv);
                            formdata['REQUESTDATETIME'] = dateFormat(now, "yyyymmddHHMMss");
                            formdata['SESSIONID'] = randomString(20);
                            formdata['PAYMENTCHANNEL'] = '';
                            formdata['EMAIL'] = document.getElementById("email").value;
                            formdata['NAME'] = document.getElementById("name").value;
                            redirectPost('https://pay.doku.com/Suite/Receive',formdata);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            console.log(jqXHR.status);
                        }
                    });
            }
            }
        });
            }
        });
    }
}*/

function saveprnew(PC) {
    //$('#basket').empty();
    if(PC=='29'){
        Channel = 'VA BCA';
    } else if (PC=='36') {
        Channel = 'VA PERMATA';
    } else if(PC=='32') {
        Channel = 'VA CIMB';
    } else if(PC=='33'){
        Channel= 'VA DANAMON';
    }
    if (confirm("Anda yakin akan melanjutkan proses pembayaran dengan "+Channel+" ?")) { 
    //var BranchCode = '01782'+document.getElementById("BranchCode").value+'02';
    //alert('Sedang Maintenance');
    var Discount = document.getElementById("Deposit").value;
    if (Discount == '') {
    var Discount = 0;
    } else {
    var Discount = document.getElementById("Deposit").value;
    }
    var PriceTotal = convertToAngka(document.getElementById("total_t").innerHTML);
    var Nominal = convertToAngka(document.getElementById("total_tagihan").innerHTML);
    //alert(Discount);
    var formdata = {};
    var now = new Date();
    formdata['token'] = window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=");
    formdata['PR'] = window.btoa($('[name="PR"]').val());
    formdata['PR_Date'] = window.btoa($('[name="date"]').val());
    formdata['Invoice_Date'] = window.btoa($('[name="date_inv"]').val());
    formdata['PriceTotal'] = window.btoa(PriceTotal);
    formdata['Discount'] = window.btoa(Discount);
    formdata['Nominal'] = window.btoa(Nominal);
    formdata['CURRENCY'] = decode64('MzYw');
    formdata['PURCHASECURRENCY'] = decode64('MzYw');
    formdata['AMOUNT'] = Nominal+'.00';
    formdata['PURCHASEAMOUNT'] = Nominal+'.00';
    formdata['SESSIONID'] = randomString(20);
    formdata['PAYMENTCHANNEL'] = window.btoa(PC);
    formdata['CHANNEL'] = window.btoa(Channel);
    formdata['REQUESTDATETIME'] = dateFormat(now, "yyyymmddHHMMss");
    formdata['EMAIL'] = document.getElementById("email").value;
    formdata['NAME'] = document.getElementById("name").value;
    formdata['BASKET'] = document.getElementById("basket").innerHTML;
        $.ajax({
            url : base_url+"Payment/spe_identify",
            type: "POST",
            data: formdata,
            dataType: "JSON",
            success: function(data)
            {
                redirectPost(base_url+"Logistics/inv", {pr:window.btoa(document.getElementById("NoPR").innerHTML),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=")});
                $.notify(data.message,data.notify);  
            }
        });
    }
}
</script>
<style type="text/css">
    .checkbox {
  padding-left: 20px; }
  .checkbox label {
    display: inline-block;
    position: relative;
    padding-left: 5px; }
    .checkbox label::before {
      content: "";
      display: inline-block;
      position: absolute;
      width: 17px;
      height: 17px;
      left: 0;
      margin-left: -20px;
      border: 1px solid #cccccc;
      border-radius: 3px;
      background-color: #fff;
      -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
      -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
      transition: border 0.15s ease-in-out, color 0.15s ease-in-out; }
    .checkbox label::after {
      display: inline-block;
      position: absolute;
      width: 16px;
      height: 16px;
      left: 0;
      top: 0;
      margin-left: -20px;
      padding-left: 3px;
      padding-top: 1px;
      font-size: 11px;
      color: #555555; }
  .checkbox input[type="checkbox"] {
    opacity: 0; }
    .checkbox input[type="checkbox"]:focus + label::before {
      outline: thin dotted;
      outline: 5px auto -webkit-focus-ring-color;
      outline-offset: -2px; }
    .checkbox input[type="checkbox"]:checked + label::after {
      font-family: 'FontAwesome';
      content: "\f00c"; }
    .checkbox input[type="checkbox"]:disabled + label {
      opacity: 0.65; }
      .checkbox input[type="checkbox"]:disabled + label::before {
        background-color: #eeeeee;
        cursor: not-allowed; }
  .checkbox.checkbox-circle label::before {
    border-radius: 50%; }
  .checkbox.checkbox-inline {
    margin-top: 0; }

.checkbox-primary input[type="checkbox"]:checked + label::before {
  background-color: #428bca;
  border-color: #428bca; }
.checkbox-primary input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-danger input[type="checkbox"]:checked + label::before {
  background-color: #d9534f;
  border-color: #d9534f; }
.checkbox-danger input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-info input[type="checkbox"]:checked + label::before {
  background-color: #5bc0de;
  border-color: #5bc0de; }
.checkbox-info input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-warning input[type="checkbox"]:checked + label::before {
  background-color: #f0ad4e;
  border-color: #f0ad4e; }
.checkbox-warning input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-success input[type="checkbox"]:checked + label::before {
  background-color: #5cb85c;
  border-color: #5cb85c; }
.checkbox-success input[type="checkbox"]:checked + label::after {
  color: #fff; }

.radio {
  padding-left: 20px; }
  .radio label {
    display: inline-block;
    position: relative;
    padding-left: 5px; }
    .radio label::before {
      content: "";
      display: inline-block;
      position: absolute;
      width: 17px;
      height: 17px;
      left: 0;
      margin-left: -20px;
      border: 1px solid #cccccc;
      border-radius: 50%;
      background-color: #fff;
      -webkit-transition: border 0.15s ease-in-out;
      -o-transition: border 0.15s ease-in-out;
      transition: border 0.15s ease-in-out; }
    .radio label::after {
      display: inline-block;
      position: absolute;
      content: " ";
      width: 11px;
      height: 11px;
      left: 3px;
      top: 3px;
      margin-left: -20px;
      border-radius: 50%;
      background-color: #555555;
      -webkit-transform: scale(0, 0);
      -ms-transform: scale(0, 0);
      -o-transform: scale(0, 0);
      transform: scale(0, 0);
      -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33); }
  .radio input[type="radio"] {
    opacity: 0; }
    .radio input[type="radio"]:focus + label::before {
      outline: thin dotted;
      outline: 5px auto -webkit-focus-ring-color;
      outline-offset: -2px; }
    .radio input[type="radio"]:checked + label::after {
      -webkit-transform: scale(1, 1);
      -ms-transform: scale(1, 1);
      -o-transform: scale(1, 1);
      transform: scale(1, 1); }
    .radio input[type="radio"]:disabled + label {
      opacity: 0.65; }
      .radio input[type="radio"]:disabled + label::before {
        cursor: not-allowed; }
  .radio.radio-inline {
    margin-top: 0; }

.radio-primary input[type="radio"] + label::after {
  background-color: #428bca; }
.radio-primary input[type="radio"]:checked + label::before {
  border-color: #428bca; }
.radio-primary input[type="radio"]:checked + label::after {
  background-color: #428bca; }

.radio-danger input[type="radio"] + label::after {
  background-color: #d9534f; }
.radio-danger input[type="radio"]:checked + label::before {
  border-color: #d9534f; }
.radio-danger input[type="radio"]:checked + label::after {
  background-color: #d9534f; }

.radio-info input[type="radio"] + label::after {
  background-color: #5bc0de; }
.radio-info input[type="radio"]:checked + label::before {
  border-color: #5bc0de; }
.radio-info input[type="radio"]:checked + label::after {
  background-color: #5bc0de; }

.radio-warning input[type="radio"] + label::after {
  background-color: #f0ad4e; }
.radio-warning input[type="radio"]:checked + label::before {
  border-color: #f0ad4e; }
.radio-warning input[type="radio"]:checked + label::after {
  background-color: #f0ad4e; }

.radio-success input[type="radio"] + label::after {
  background-color: #5cb85c; }
.radio-success input[type="radio"]:checked + label::before {
  border-color: #5cb85c; }
.radio-success input[type="radio"]:checked + label::after {
  background-color: #5cb85c; }
</style>