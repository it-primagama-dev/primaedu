<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>OneCheckout - Payment Page - Tester</title>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-cart-arrow-down" id="header"> </i> <b id="pr"> </b> <b id="cbgnm"></b> </p>
                <legend></legend>
                </div>
                <label style="font-size: 18px;" class="col-md-12">No. Invoice / Tanggal : <b id="invdate"> </b></label>
                <input type="hidden" id="inv" name="inv" value="<?php echo $INV ;?>">
                <input name="invoice_number" type="hidden" id="invoice_number" value="" size="12" />
                <input name="EMAIL" type="hidden" id="EMAIL" value="" size="12" />
                <input name="NAME" type="hidden" id="NAME" size="30" maxlength="50"/>
                <input name="BASKET" type="hidden" id="BASKET" value="" size="100" />
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
                            <th width="35%" style="text-align:center;">Nama Paket</th>
                            <th width="10%" style="text-align:center;">Qty</th>
                            <th width="25%" style="text-align:center;">Harga Satuan</th>
                            <th width="25%" style="text-align:center;">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody id="data_item"></tbody>
                    <tbody id="data_item_total">
                        <tr>
                            <th colspan="4" style="text-align: right;">Total</th>
                            <th id="total_t" style="text-align: right;"></th>
                        </tr>
                        <tr>
                            <th colspan="4" style="text-align: right;">Deposit</th>
                            <th id="Discount" style="text-align: right;"></th>
                        </tr>
                        <tr>
                            <th colspan="4" style="text-align: right;">Total Tagihan</th>
                            <th id="total_tagihan" style="text-align: right;"></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group" id="btnpay" style="display: none;">
                <div class="col-md-12" style="text-align: right">
                    <button name="button" type="button" class="btn btn-primary" id="submit" onClick="pay();"><i class="fa fa-paypal"> </i>  Request Kode Pembayaran </button>
                </div>
            </div>
            <div class="form-group" id="btncancel" style="display: none;">
                <div class="col-md-12" style="text-align: right">
                    <button name="button" type="button" class="btn btn-danger" id="submitcancel" onClick="Cancel();"><i class="fa fa-close"> </i>  Batalkan Pemesanan </button>
                </div>
            </div>
        </div>
        <div class="col-lg-12" style="display: none;" id="noteproblem">
            <div class="form-group">
                <label style="font-size: 16px;" class="col-md-12">
                    <i class="fa" style="font-size: 16px;color:red;">*Note : <br> 
                    1. Sehubungan dengan adanya masalah limit transaksi antar bank, maka pembayaran dapat dilakukan melalui VA BCA 01782-ABCD-02. <br> &nbsp;&nbsp;&nbsp; (ABCD = Kode Cabang)<br>
                    2. Batas maksimal pembayaran 2 hari akan dihapuskan.<br>
                    3. Ketentuan ini berlaku mulai Hari Senin, 9 Juli 2018.<br> &nbsp;&nbsp;&nbsp;&nbsp;Terima Kasih.</i></label>
            </div>
        </div>
        <div class="col-lg-12" style="display: none;" id="timer">
            <div class="form-group">
                <label style="font-size: 17px;" class="col-md-12">Batas Maksimal Pembayaran : <b style="color:green;" id="expiredva"></b><br></label>
                <label style="font-size: 17px;" class="col-md-12">
                    <i style="font-size: 17px;color:red;">*Note : <br> Apabila tidak melakukan pembayaran melebihi batas waktu yang ditentukan, maka status pemesanan tersebut akan otomatis expired dan akan mengurangi 1 gratis ongkir (total 6x gratis ongkir dalam satu tahun ajaran).</i></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
                <legend></legend>
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-truck"> Tracking Pemesanan </i></p>
                <legend></legend>
        <div class="col-xs-1">
        </div>
        <div class="col-xs-11">
            <div id="element"></div>
        </div>
        </div>
    </div>
        <!--Description transaction-->
        <div id="BASKETVAL" type="text" value="" style="display: none;"></div>
<!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="text-align: center;">
            <h4 class="modal-title">Pemesanan <i class="fa" id="NoPR"></i> / <i class="fa" id="INV"></i></h4>
          </div>
          <div class="modal-body">
            <p style="color: red"><b>Ketentuan Pembatalan Pemesanan Buku :</b><br>
                1. Pemesanan yang dibatalkan akan mengurangi 1 gratis ongkir (total 6x gratis ongkir)<br>
                2. Alasan pembatalan : <br>
                <textarea type="text" class="form-control" id="alscancel" name="alscancel" placeholder="wajib diisi..."></textarea></p>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary" onClick="cancelpay();">Lanjutkan</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          </div>
        </div>

      </div>
    </div>

<!-- Modal PAYMENTCODE-->
    <div id="myModalPC" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="text-align: center;">
            <h4 class="modal-title">Request Kode Pembayaran</h4>
          </div>
          <div class="modal-body" style="text-align: center;">
            <p>Kode pembayaran anda adalah : <b style="color: green" id="paycode"></b></p>
            <p style="color: red; text-align: left;">*Note : <br>- Cara melakukan pembayaran dapat dilihat pada halaman ini (pada bagian Tracking Pemesanan).<br>
            - Pastikan anda melakukan pembayaran pada VA / Kode Pembayaran di atas.<br> </p>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
          </div>
        </div>

      </div>
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/jquery.timeline/jquery.timeline.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery.timeline/jquery.timeline.js"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 -->
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
    reload_data();
/*    getRequestDateTime();
    genSessionID();*/
});
function reload_data() {
    var inv = window.btoa($('#inv').val());
    //var token = window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=");
    //var kode = window.btoa(1);
    //var kode2 = window.btoa(2);
    //alert(inv+'-'+inv);
    $.ajax({
        url : base_url+"Logistics/get_order_inv",
        type: 'POST',
        data: ({pr:inv}),
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
                $('#data_item').empty();
                $.each(data.rows, function(i, item) {
                    if (item.PackType==8) {
                        PriceFix = item.PricePack;   
                    } else {
                        PriceFix = item.Price;
                    }
                    var basket = item.PackName+','+PriceFix+'.00'+','+item.Quantity+','+PriceFix*item.Quantity+'.00'+';'; 
                    $('#BASKETVAL').append(basket);
                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.PackName),
                        $('<td style="text-align:center;">').text(item.Quantity),
                        $('<td style="text-align:right;">').text(convertToRupiah(PriceFix)),
                        $('<td style="text-align:right;">').text(convertToRupiah(PriceFix*item.Quantity)),
                    ).appendTo('#data_item');
                    //MergeGridCells();
                    PR = item.PR_Number;
                    EditDate = item.EditDate;
                    INV_DATE = item.Invoice_Date;
                    TotalPrice = item.TotalPrice;
                    Discount = item.Discount;
                    Nominal = item.Nominal;
                    Invoice_Number = item.Invoice_Number;
                    Status = item.Invoice_Status;
                    name = item.KodeCabang+' - '+item.NamaCabang;
                    cbgnm = ' - '+item.NamaCabang;
                    email = item.Email;
                    StatusPO = item.Status;
                    IsTrouble = item.IsTrouble;
                    Channel = item.Channel;
                    PAYMENTCODE = item.PAYMENTCODE;
                    $('#AMOUNT,#PURCHASEAMOUNT').val(Nominal+'.00');
                    $('#TRANSIDMERCHANT').val(Invoice_Number);    
                    mallid = '3363';
                    sharedkey = 'S9SduJM092zc';
                    words = SHA1(Nominal+'.00'+mallid+sharedkey+Invoice_Number);
                    $('#MALLID').val(mallid);
                    $('#SHAREDKEY').val(sharedkey);
                    $('#WORDS').val(words);
                    basket = document.getElementById('BASKETVAL').innerHTML;
                    $('#BASKET').val(basket);
                    //$('#EditDate').val(EditDate);
                });
                $('#pr').text(PR);
                $('#invdate').text(Invoice_Number+' / '+tgl_indo(INV_DATE));
                $('#total_t').text(convertToRupiah(TotalPrice));
                $('#Discount').text(convertToRupiah(Discount));
                $('#total_tagihan').text(convertToRupiah(Nominal));
                $('#NAME').val(name);
                $('#EMAIL').val(email);
                $('#invoice_number').val(Invoice_Number);
                //if(Channel==0){$('#timer').css('display','none');}
                if(StatusPO==1 && Channel != 0){
                    timer(EditDate);
                    $('#timer').css('display','block');
                }
                if(IsTrouble==1 && data.user==11){$('#noteproblem').css('display','block');}

                if(Status==0 && data.user==11){ 
                  $('#btnpay').css('display','block'); 
                  $('#header').text(" Invoice Pemesanan");
                } else {
                  $('#header').text(" Detail Pemesanan");
                  $('#cbgnm').text(cbgnm);
                }  

                if(Status==0 && data.user==11 || Status==1 && data.user==11){ 
                  $('#btncancel').css('display','block'); 
                }    

                if(Channel==29){
                NamaChannel = "VA BCA";
                CaraBayar = '<b>Cara Membayar di ATM :</b> <br>1. Masukkan kartu ATM BCA dan PIN <br>2. Pilih "Transaksi Lainnya" <br>3. Pilih "Transfer" <br>4. Pilih "ke Rekening BCA Virtual Account" <br>5. Masukkan nomor BCA Virtual Account <br>6. Pastikan Nama & Jumlah Tagihan Sesuai dengan yang ada di Sistem PrimaEdu  <br>7. Setelah Proses Validasi selesai dengan menekan tombol "Ya", simpan bukti transaksi anda.<br></br><b>Cara membayar menggunakan KlikBCA Individual :</b><br>1. Login pada aplikasi KlikBCA Individual <br>2. Masukkan User ID dan PIN <br>3. Pilih "Transfer Dana" <br>4. Pilih "Transfer ke BCA Virtual Account" <br>5. Masukkan nomor BCA Virtual <br>6. Pastikan Nama & Jumlah Tagihan Sesuai dengan yang ada di Sistem PrimaEdu  <br>7. Setelah Proses Validasi selesai dengan menekan tombol "Kirim", simpan bukti transaksi anda.<br></br><b>Cara membayar menggunakan Mobile BCA :</b><br>1. Login pada aplikasi Mobile BCA <br>2. Pilih "m-Transfer" <br>3. Pilih "Transfer - BCA Virtual Account" <br>4. Masukkan VA BCA / Kode Pembayaran <br>5. Pastikan Nama & Jumlah Tagihan Sesuai dengan yang ada di Sistem PrimaEdu <br>6. Pilih "OK", dan simpan bukti transaksi anda.';
                } else if(Channel==36){
                NamaChannel = "VA PERMATA";
                CaraBayar = '<b>Cara membayar di ATM :</b> <br>1. Masukkan PIN<br>2. Pilih "Transfer". Apabila menggunakan ATM Bank Lain, pilih "Transaksi lainnya" lalu "Transfer"<br>3. Pilih "Ke Rek Bank Lain"<br>4. Masukkan Kode Bank Permata (013) diikuti 16 digit kode bayar sebagai rekening tujuan, kemudian tekan "Benar"<br>5. Masukkan Jumlah pembayaran sesuai dengan yang ditagihkan (Jumlah yang ditransfer harus sama persis, tidak boleh lebih dan kurang). Jumlah nominal yang tidak sesuai dengan tagihan akan menyebabkan transaksi gagal<br>6. Muncul Layar Konfirmasi Transfer yang berisi nomor rekening tujuan Bank Permata dan Nama beserta jumlah yang dibayar, jika sudah benar, Tekan "Benar"<br>7. Selesai<br></br><b>Cara membayar di Internet Banking :</b><br><font color="red">Keterangan: Pembayaran tidak bisa dilakukan di Internet Banking BCA (KlikBCA)</font><br>1. Login ke dalam akun Internet Banking<br>2. Pilih "Transfer" dan pilih "Bank Lainnya". Pilih Bank Permata (013) sebagai rekening tujuan<br>3. Masukkan jumlah pembayaran sesuai dengan yang di tagihkan<br>4. Isi nomor rekening tujuan dengan 16 digit kode pembayaran<br>5. Muncul layar konfirmasi Transfer yang berisi nomor rekening tujuan Bank Permata dan Nama beserta jumlah yang dibayar. Jika sudah benar, tekan "Benar"<br>6. Selesai'
                } else if(Channel==32){
                NamaChannel = "VA CIMB";
                CaraBayar = '<b>Melalui ATM CIMB Niaga :</b><br>1. Masukkan kartu ATM CIMB Niaga, lalu masukkan "PIN ATM".<br>2. Pilih menu "Transfer".<br>3. Pilih menu "Rekening CIMB Niaga".<br>4. Masukkan "Jumlah" lalu masukkan "Nomor Virtual Account".<br>5. Ketika muncul konfirmasi transfer, pilih "Ya" / "Lanjut".<br>6. Transaksi selesai dan simpan bukti transaksi.<br></br><b>Melalui Mobile Banking CIMB NIAGA :</b><br>1. Login Mobile Banking CIMB Niaga.<br>2. Pilih menu "Transfer", lalu pilih "Rekening Ponsel/CIMB Niaga".<br>3. Pilih "Rekening sumber".<br>4. Pilih "Rekening Tujuan": CASA.<br>5. Masukkan "Nomor Virtual Account" dan "Jumlah".<br>6. Ketika muncul konfirmasi pembayaran, pilih "Ya" / "Lanjut".<br>7. Transaksi selesai dan simpan bukti transaksi.<br></br><b>Melalui Internet Banking CIMB Niaga :</b><br>1. Login ke Internet Banking CIMB Niaga.<br>2. Pilih Menu "TRANSFER".<br>3. Pilih rekening sumber dana pada bagian "Transfer From", masukkan "Jumlah", lalu pada bagian "Transfer To" pilih "Other Account (CIMB Niaga/Rekening Ponsel)", kemudian pilih "NEXT".<br>4. Pilih "BANK CIMB NIAGA", lalu masukkan Nomor Virtual Account di kolom "Rekening Penerima", kemudian pilih "NEXT".<br>5. Masukkan "mPIN" lalu pilih "Submit".6. Transaksi selesai dan simpan bukti transaksi.<br></br><b>Melalui ATM Bank Lain :</b><br>1. Masukkan kartu ATM, lalu masukkan PIN ATM.<br>2. Pilih Menu Transfer Antar Bank.<br>3. Masukan Kode Bank Tujuan : CIMB Niaga (Kode Bank : 022) + Nomor Virtual Account / Kode Bayar.<br>4. Masukan jumlah transfer sesuai Tagihan.<br>5. Ketika Muncul konfirmasi pembayaran, pilih "Ya" / "Lanjut".<br>6. Transaksi selesai dan ambil bukti transfer anda';
                } else if(Channel==33){
                NamaChannel = "VA Danamon";
                CaraBayar = '<b>Melalui ATM Danamon :</b><br>1. Masukkan kartu ATM Danamon, lalu masukkan PIN ATM.<br>2. Pilih menu "Pembayaran", kemudian menu "Lainnya".<br>3. Pilih menu "Virtual Account".<br>4. Masukkan Nomor Virtual Account / Kode Pembayaran.<br>5. Ketika muncul Konfirmasi Transfer, pilih "Ya" / "Lanjut".6. Transaksi selesai. Simpan bukti transaksi.<br></br><b>Melalui ATM Bank Lain :</b><br>1. Masukkan kartu ATM, lalu masukkan PIN ATM.<br>2. Pilih menu "Transfer Antar Bank".<br>3. Masukan Kode Bank Tujuan : Danamon (Kode Bank : 011) + Nomor Virtual Account / Kode Pembayaran.<br>4. Masukan jumlah sesuai tagihan.<br>5. Ketika muncul Konfirmasi Transfer, pilih "Ya" / "Lanjut".<br>6. Transaksi selesai dan ambil bukti transfer anda';
                } else {
                NamaChannel = 'VA BCA OFFLINE';
                CaraBayar = '';
                }
                    $.ajax({
                        url: base_url+"Logistics/tracking",
                        type: "POST",
                        data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"action":window.btoa(1),"pr":window.btoa(PR)}),
                        dataType: 'JSON',
                        success:function(data){
                            $.each(data.rows, function(i, item2) {
                            if(item2.DO_Number != null && item2.DO_Number != ''){
                            var timeline = "<li class='tl-item'><div class='tl-wrap'><span class='tl-date'>"+tgl_indo_time(item2.time)+"</span><div class='tl-content panel padder b-a' "+item2.style+"><span class='arrow left pull-up' "+item2.style2+"></span><div id='content'>"+item2.content+"</div></div><br></br><table class='table table-striped table-bordered table-hover' id=\"example"+item2.DO_Number+"\"><thead><tr></tr><th colspan='5'>#Detail Pengiriman</th><tr><th width='30%' style='text-align:center;'>Paket Buku</th><th style='text-align: center;' width='50%'>Nama Buku</th><th style='text-align: center;' width='20%'>Qty</th></tr></thead><tbody id=\"data_detail"+item2.DO_Number+"\"></tbody></table><div id=\"data_exp"+item2.DO_Number+"\"></div></li>";
                            } else if(item2.Description != null && item2.Description != '') {
                            var timeline = "<li class='tl-item'><div class='tl-wrap'><span class='tl-date'>"+tgl_indo_time(item2.time)+"</span><div class='tl-content panel padder b-a' "+item2.style+"><span class='arrow left pull-up' "+item2.style2+"></span><div id='content'>"+item2.content+"</div></div><br></br> "+item2.Description+"<br></br>"+CaraBayar+"</div></li>";
                            } else {
                            var timeline = "<li class='tl-item'><div class='tl-wrap'><span class='tl-date'>"+tgl_indo_time(item2.time)+"</span><div class='tl-content panel padder b-a' "+item2.style+"><span class='arrow left pull-up' "+item2.style2+"></span><div id='content'>"+item2.content+"</div></div></div></li>";    
                            }
                            var $tr = $('<div>').append(
                                $('<div>').html(timeline),
                            ).appendTo('#element');
                            })

                            $.each(data.rows2, function(i, item3) {
                                /*if(item3.TypeId==1 || item3.TypeId==2 && item3.ItemCode!='PB 12 SMK'){
                                SB=item3.QtySB;
                                SE1=item3.QtySE1;
                                SE2=item3.QtySE2;
                                SUP='-';
                                } else if(item3.TypeId==4 || item3.ItemCode=='PB 12 SMK') {
                                SB=item3.QtySB;
                                SE1='-';
                                SE2='-';
                                SUP='-';
                                } else if(item3.TypeId==3 && item3.ItemCode=='PB 7 SMP KURNAS' || item3.TypeId==3 && item3.ItemCode=='PB 8 SMP KURNAS' || item3.TypeId==3 && item3.ItemCode=='PB 9 SMP KURNAS') {
                                SB=item3.QtySB;
                                SE1=item3.QtySE1;
                                SE2='-';
                                QtySE2="-";
                                SUP=item3.QtySUP;
                                } else {
                                SB=item3.QtySB;
                                SE1=item3.QtySE1;
                                SE2=item3.QtySE2;
                                SUP=item3.QtySUP;
                                }*/
                                var $tr = $('<tr>').append(
                                    $('<td>').text(item3.PackName),
                                    $("<td style='text-align: left;'>").text(item3.ItemName),
                                    $("<td style='text-align: center;'>").text(item3.QtySB)
                                ).appendTo('#data_detail'+item3.DO_Number);
                            });
                            $.each(data.rows, function(i, itemm) {
                                MergeCommonRows($("#example"+itemm.DO_Number), 1);
                            });
                            //MergeGridCells();
                            $.each(data.rows3, function(i, item4) {
                                if(item4.Link!='#'){
                                    Link=item4.Link;
                                    CekResi="<div class='form-group'><label class='col-md-3'>Origin/Asal</label><div class='col-md-9'> : YOGYAKARTA</div></div><div class='form-group'><label class='col-md-3'>Document/Dokumen</label><div class='col-md-9'> : eKonosemen</div></div><div class='form-group'><label class='col-md-4'><a href='"+Link+item4.NoResi+"' target='_blank'>klik disini untuk cek resi</a></label></div>";
                                } else {
                                    CekResi="";
                                }
                                exp = "<div class='col-lg-12'><div class='form-group'><label class='col-md-3'>Expedisi</label><div class='col-md-9'> : "+item4.Exp_Name+"</div></div><div class='form-group'><label class='col-md-3'>CP Expedisi</label><div class='col-md-9'> : "+item4.CP+"</div></div><div class='form-group'><label class='col-md-3'>Tanggal Pengiriman</label><div class='col-md-9'> : "+tgl_indo(item4.DO_Date)+"</div></div><div class='form-group'><label class='col-md-3'>Tanggal Estimasi</label><div class='col-md-9'> : "+tgl_indo(item4.Estimate_Date)+"</div></div><div class='form-group'><label class='col-md-3'>Koli</label><div class='col-md-9'> : "+item4.Koli+"</div></div><div class='form-group'><label class='col-md-3'>No Resi</label><div class='col-md-9'> : "+item4.NoResi+"</div></div>"+CekResi+"</div>";
                                if(item4.Exp_Name==null){
                                $('#data_exp'+item4.DO_Number).html('-');
                                } else {
                                $('#data_exp'+item4.DO_Number).html(exp);
                                }/*
                                $('#bag'+item4.DO_Number).html('String Bag : '+item4.Bag);
                                $('#sticker'+item4.DO_Number).html('Sticker Digital Print (20x4cm) : '+item4.Sticker);
                                $('#stickers'+item4.DO_Number).html('Sticker Digital Print (10x2cm) : '+item4.StickerS);*/
                            });

                            $('#paycode').text(PAYMENTCODE+' - '+NamaChannel);
                            if(StatusPO==1){
                            $('#myModalPC').modal({
                                show: 'show',
                                backdrop: 'static',
                                keyboard: false
                            })
                            }
                        }
                    });
            } else {
                $('#total_t').empty();
                $('#total_tagihan').empty();
                var $tr = $('<tr>').append(
                        $('<td colspan="6" style="text-align:center;">').text('- - - Belum ada detail item diinput - - -'),
                        ).appendTo('#data_item');
            }
        }
    });
};

// Set the date we're counting down tovar 
function timer(date){
//var EditDate = $('#EditDate').val();

var EditDate = new Date(date);
var wkt = new Date(date);
var tomorrow = EditDate.setDate(EditDate.getDate() + 2);
var waktu = wkt.setDate(wkt.getDate() + 2);
var countDownDate = new Date(tomorrow).getTime();


// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    document.getElementById("expiredva").innerHTML = tgl_indo_time2(waktu);
    
    if (distance < 0) {
        alert('Pemesanan Buku Expired!!');
        clearInterval(x);
        document.getElementById("expiredva").innerHTML = "EXPIRED";
        $('#element').empty();
        $('#btnpay').empty();
        $('#btncancel').empty();
        $('#timer').empty();
        var inv = window.btoa($('#invoice_number').val());
        $.ajax({
            url : base_url+"Logistics/expired",
            type: "POST",
            data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),inv:inv}),
            dataType: "JSON",
            beforeSend: function(){
                $("#ajax-loader").show();
            },
            complete: function() {
                $("#ajax-loader").hide();
            },
            success: function(data) 
            {
                //reload_data();
                //$.notify(data.message,data.notify);
            }
        });

        $.ajax({
            url : base_url+"Logistics/reset_stok",
            type: "POST",
            data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"kode":window.btoa(1),inv:inv}),
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
}, 1000);
}

function pay(){
    var formdata = {};
    var now = new Date();
    var Nominal = convertToAngka(document.getElementById("total_tagihan").innerHTML);
    formdata['MALLID'] = decode64('MzM2Mw==');//decode64('NTU0Nw==');
    formdata['CHAINMERCHANT'] = 'NA';
    formdata['BASKET'] = document.getElementById("BASKET").value;
    formdata['CURRENCY'] = decode64('MzYw');
    formdata['PURCHASECURRENCY'] = decode64('MzYw');
    formdata['AMOUNT'] = Nominal+'.00';
    formdata['PURCHASEAMOUNT'] = Nominal+'.00';
    formdata['TRANSIDMERCHANT'] = document.getElementById("invoice_number").value;
    formdata['SHAREDKEY'] = decode64('UzlTZHVKTTA5Mnpj');
    formdata['WORDS'] = SHA1(Nominal+'.00'+decode64('MzM2Mw==')+decode64('UzlTZHVKTTA5Mnpj')+document.getElementById("invoice_number").value);
    formdata['REQUESTDATETIME'] = dateFormat(now, "yyyymmddHHMMss");
    formdata['SESSIONID'] = randomString(20);
    formdata['PAYMENTCHANNEL'] = '';
    formdata['EMAIL'] = document.getElementById("EMAIL").value;
    formdata['NAME'] = document.getElementById("NAME").value;
    redirectPost('https://pay.doku.com/Suite/Receive',formdata);
}

function Cancel(){
    var PR = document.getElementById("pr").innerHTML; 
    $('#NoPR').text(PR);
    $('#INV').text($('#inv').val());
    $('#myModal').modal({
        show: 'show',
        backdrop: 'static',
        keyboard: false
    })
}

function cancelpay(){

        if($('[name="alscancel"]').val() == "") {
            alert('Alasan pembatalan wajib diisi');
            //reload_data();
        } else {
        $('#element').empty();
        $('#btnpay').empty();
        $('#btncancel').empty();
        $('#timer').empty();
        var inv = window.btoa($('#inv').val());
        var alscancel = window.btoa($('#alscancel').val());
        $.ajax({
            url : base_url+"Logistics/cancelpay",
            type: "POST",
            data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),inv:inv,alscancel:alscancel}),
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
                //get_item();
                $.notify(data.message,data.notify);
            }
        });

        $.ajax({
            url : base_url+"Logistics/reset_stok",
            type: "POST",
            data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"kode":window.btoa(1),inv:inv}),
            dataType: "JSON",
            beforeSend: function(){
                $("#ajax-loader").show();
            },
            complete: function() {
                $("#ajax-loader").hide();
            },
            success: function(data) 
            {
                //reload_data(); 
                //get_item();
                //$.notify(data.message,data.notify);
            }
        });
    }
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

/*//rowspan table
function MergeGridCells() {
    var dimension_cells = new Array();
    var dimension_col = null;
    var columnCount = $("#tableMenu tr:first th").length;
    for (dimension_col = 0; dimension_col <= columnCount-2; dimension_col++) {
        // first_instance holds the first instance of identical td
        var first_instance = null;
        var rowspan = 1;
        // iterate through rows
        $("#tableMenu").find('tr').each(function () {

            // find the td of the correct column (determined by the dimension_col set above)
            var dimension_td = $(this).find('td:nth-child(' + dimension_col + ')');



            if (first_instance === null) {
                // must be the first row
                first_instance = dimension_td;
            } else if (dimension_td.text() === first_instance.text()) {
                // the current td is identical to the previous
                // remove the current td
               // dimension_td.remove();
                dimension_td.attr('hidden', true);
                ++rowspan;
                // increment the rowspan attribute of the first instance
                first_instance.attr('rowspan', rowspan);
            } else {
                // this cell is different from the last
                first_instance = dimension_td;
                rowspan = 1;
            }
        });
    }
}*/
</script>
