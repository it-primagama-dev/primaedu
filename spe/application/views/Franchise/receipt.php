
<form action="#" id="form2" class="form-horizontal">
<div class="row" style="border: 3px solid; padding-top: 20px" id="content">
    <div class="col-lg-12">
        <input type="hidden" id="RecID" value="<?php echo $RecID ?>">
                <table class="table" cellspacing="0" width="100%" id="tableMenu" style=" border-width: 6px; border-color: #808080; border-style: double;">
            <tr>
                <th rowspan="8" width="10%" style="border-width: 6px; border-style: double; border-color: #808080; vertical-align: middle;"><img src="<?php echo base_url(); ?>assets/images/logo_kwitansi.png" width="100%"></th>
                <th colspan="5" style="text-align: center; font-size: 25px; border-width: 6px; border-color: #808080; border-style: double;">KWITANSI PEMBAYARAN</th>
            </tr>
            <tr>
                <th width="5%"></th>
                <th colspan="4" id="nokwi"></th>
            </tr>
            <tr>
                <th width="5%"></th>
                <th width="20%">Sudah terima dari</th>
                <th width="5%" style="text-align: right;"> : </th>
                <th colspan="2" id="cabang"></th>
            </tr>
            <tr>
                <th width="5%"></th>
                <th width="20%">Banyaknya uang</th>
                <th width="5%" style="text-align: right;"> : </th>
                <th colspan="2" id="terbilang"> </th>
            </tr>
            <tr>
                <th width="5%"></th>
                <th width="20%">Untuk pembayaran</th>
                <th width="5%" style="text-align: right;"> : </th>
                <th colspan="2" style="text-align: left;">Pembayaran Franchise Fee</th>
            </tr>
            <tr>
                <th width="5%"></th>
                <th colspan="3" style="border-bottom: transparent;"></th>
                <th style="text-align: center; padding-bottom: 70px;" width="25%"> <u id="tanggal"></u><br>Penerima,</th>
            </tr>
            <tr>
                <th style="border: transparent;" width="5%"></th>
                <th style="border: transparent;"><div class="row" style="border-top: 2px solid; padding-top: 10px; border-bottom: 2px solid; padding-bottom: 10px; margin-left: 0px; padding-left: 20px;">Jumlah Rp.</div></th>
                <th style="border: transparent; text-align: right;"><div id="uang" class="row" style="border-top: 2px solid; padding-top: 10px; border-bottom: 2px solid; padding-bottom: 10px; padding-right: 30px;"></div></th>
                <th style="border: transparent;"></th>
                <th style="text-align: center; border: transparent;" width="25%"><div class="row" style="padding-top: 10px;">Fin & Acc</div></th>
            </tr>
            <tr>
                <th colspan="5" style="border: transparent;"></th>
            </tr>
        </table>
    </div>
</div>
</form>

<script type="text/javascript">

window.onload = function() { window.print(); }

$(document).ready(function(){
    var RecID = $('#RecID').val();
    $.ajax({
        url: base_url + "Franchise/loaddetailreceipt/" + RecID,
        type: "GET",
        dataType: "JSON",
        success: function (data)
        {
            //$('#data_pay').empty();
            $.each(data.rows, function (i, item) {
                Receipt = item.Receipt;
                Cabang = item.KodeCabang +' - '+ item.NamaCabang;
                Nominal = item.AMN;
                date = item.DATE;
                datefrmt = date.replace(/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/, "$1-$2-$3 $4:$5:$6");
            });
            $('#nokwi').text('Nomor : '+ Receipt +'');
            $('#cabang').text(Cabang);
            $('#terbilang').text(terbilang(Nominal));
            $('#uang').text(convertToUang(Nominal));
            $('#tanggal').text(tgl_indo(datefrmt));
        }
    });
});

function convertToUang(angka){
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }
    return rev2.split('').reverse().join('');
}

function terbilang(bilangan) {

 bilangan    = String(bilangan);
 var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
 var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
 var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');

 var panjang_bilangan = bilangan.length;

 /* pengujian panjang bilangan */
 if (panjang_bilangan > 15) {
   kaLimat = "Diluar Batas";
   return kaLimat;
 }

 /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
 for (i = 1; i <= panjang_bilangan; i++) {
   angka[i] = bilangan.substr(-(i),1);
 }

 i = 1;
 j = 0;
 kaLimat = "";

 /* mulai proses iterasi terhadap array angka */
 while (i <= panjang_bilangan) {

   subkaLimat = "";
   kata1 = "";
   kata2 = "";
   kata3 = "";

   /* untuk Ratusan */
   if (angka[i+2] != "0") {
     if (angka[i+2] == "1") {
       kata1 = "Seratus";
     } else {
       kata1 = kata[angka[i+2]] + " Ratus";
     }
   }

   /* untuk Puluhan atau Belasan */
   if (angka[i+1] != "0") {
     if (angka[i+1] == "1") {
       if (angka[i] == "0") {
         kata2 = "Sepuluh";
       } else if (angka[i] == "1") {
         kata2 = "Sebelas";
       } else {
         kata2 = kata[angka[i]] + " Belas";
       }
     } else {
       kata2 = kata[angka[i+1]] + " Puluh";
     }
   }

   /* untuk Satuan */
   if (angka[i] != "0") {
     if (angka[i+1] != "1") {
       kata3 = kata[angka[i]];
     }
   }

   /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
   if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")) {
     subkaLimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
   }

   /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
   kaLimat = subkaLimat + kaLimat;
   i = i + 3;
   j = j + 1;

 }

 /* mengganti Satu Ribu jadi Seribu jika diperlukan */
 if ((angka[5] == "0") && (angka[6] == "0")) {
   kaLimat = kaLimat.replace("Satu Ribu","Seribu");
 }

 return kaLimat + "Rupiah";
}

/*$('#terbilang').text(terbilang('12305540'));
$('#uang').text('200.000.000');*/
 </script>
<style type="text/css">
.header-laporan {display: none;}
th {
    height: 10px;
}
@media print {
    @page {size: A4;margin: 0px auto;}
    html, body {
        -webkit-print-color-adjust: exact;
        zoom: 95%;
    }
    textarea {border-style: none;border-color: Transparent;overflow: auto;resize: none;}
    select {-moz-appearance: none;-webkit-appearance:none;}
    select::-ms-expand {display: none;}
    .hr {border-bottom: 1px solid black;}
    .header-laporan {display: block;padding-bottom: 25px;padding-top: 25px}
    .doble-border {border-bottom-style: double !important;}
    .navbar-default,.print-hidden,.ibox-title,.breadcrumb,.theme-config,.footer,#btnSave { display: none; }
    .ibox-content {border-color: transparent;}
    .form-control,.form-control[readonly] {background-color:transparent;border:none;/*overflow-wrap: break-word;*//*word-wrap: break-word;*/}
    .ibox-content {border-color: transparent;}
    .print-block {margin-top: 350px;margin-bottom: 350px;}
    .font-print {font-size: 12px;}
    .chosen-container-single .chosen-single {border: none;background:transparent;-moz-appearance: none;-webkit-appearance:none;border-top-right-radius: 0px;-webkit-box-shadow: none;box-shadow: none;}
    .chosen-container-single .chosen-single div b {display: none;}
    .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12,
    .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12,
    .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12,
    .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 { float: left; }
    .col-sm-12,.col-xs-12,.col-md-12,.col-lg-12 { width: 100%; }
    .col-sm-11,.col-xs-11,.col-md-11,.col-lg-11 { width: 91.66666666666666%; }
    .col-sm-10,.col-xs-10,.col-md-10,.col-lg-10 { width: 83.33333333333334%; }
    .col-sm-9,.col-xs-9,.col-md-9,.col-lg-9 { width: 75%; }
    .col-sm-8,.col-xs-8,.col-md-8,.col-lg-8 { width: 66.66666666666666%; }
    .col-sm-7,.col-xs-7,.col-md-7,.col-lg-7 { width: 58.333333333333336%; }
    .col-sm-6,.col-xs-6,.col-md-6,.col-lg-6 { width: 50%; }
    .col-sm-5,.col-xs-5,.col-md-5,.col-lg-5 { width: 41.66666666666667%; }
    .col-sm-4,.col-xs-4,.col-md-4,.col-lg-4 { width: 33.33333333333333%; }
    .col-sm-3,.col-xs-3,.col-md-3,.col-lg-3 { width: 25%; }
    .col-sm-2,.col-xs-2,.col-md-2,.col-lg-2 { width: 16.666666666666664%; }
    .col-sm-1,.col-xs-1,.col-md-1,.col-lg-1 { width: 8.333333333333332%; }
    .col-xs-offset-12 {margin-left: 100%;}
    .col-xs-offset-11 {margin-left: 91.66666667%;}
    .col-xs-offset-10 {margin-left: 83.33333333%;}
    .col-xs-offset-9 {margin-left: 75%;}
    .col-xs-offset-8 {margin-left: 66.66666667%;}
    .col-xs-offset-7 {margin-left: 58.33333333%;}
    .col-xs-offset-6 {margin-left: 50%;}
    .col-xs-offset-5 {margin-left: 41.66666667%;}
    .col-xs-offset-4 {margin-left: 33.33333333%;}
    .col-xs-offset-3 {margin-left: 25%;}
    .col-xs-offset-2 {margin-left: 16.66666667%;}
    .col-xs-offset-1 {margin-left: 8.33333333%;}
    .col-xs-offset-0 {margin-left: 0;}
    .col-sm-offset-12 {margin-left: 100%;}
    .col-sm-offset-11 {margin-left: 91.66666667%;}
    .col-sm-offset-10 {margin-left: 83.33333333%;}
    .col-sm-offset-9 {margin-left: 75%;}
    .col-sm-offset-8 {margin-left: 66.66666667%;}
    .col-sm-offset-7 {margin-left: 58.33333333%;}
    .col-sm-offset-6 {margin-left: 50%;}
    .col-sm-offset-5 {margin-left: 41.66666667%;}
    .col-sm-offset-4 {margin-left: 33.33333333%;}
    .col-sm-offset-3 {margin-left: 25%;}
    .col-sm-offset-2 {margin-left: 16.66666667%;}
    .col-sm-offset-1 {margin-left: 8.33333333%;}
    .col-sm-offset-0 {margin-left: 0;}
    .col-md-offset-12 {margin-left: 100%;}
    .col-md-offset-11 {margin-left: 91.66666667%;}
    .col-md-offset-10 {margin-left: 83.33333333%;}
    .col-md-offset-9 {margin-left: 75%;}
    .col-md-offset-8 {margin-left: 66.66666667%;}
    .col-md-offset-7 {margin-left: 58.33333333%;}
    .col-md-offset-6 {margin-left: 50%;}
    .col-md-offset-5 {margin-left: 41.66666667%;}
    .col-md-offset-4 {margin-left: 33.33333333%;}
    .col-md-offset-3 {margin-left: 25%;}
    .col-md-offset-2 {margin-left: 16.66666667%;}
    .col-md-offset-1 {margin-left: 8.33333333%;}
    .col-md-offset-0 {margin-left: 0;}
    .col-lg-offset-12 {margin-left: 100%;}
    .col-lg-offset-11 {margin-left: 91.66666667%;}
    .col-lg-offset-10 {margin-left: 83.33333333%;}
    .col-lg-offset-9 {margin-left: 75%;}
    .col-lg-offset-8 {margin-left: 66.66666667%;}
    .col-lg-offset-7 {margin-left: 58.33333333%;}
    .col-lg-offset-6 {margin-left: 50%;}
    .col-lg-offset-5 {margin-left: 41.66666667%;}
    .col-lg-offset-4 {margin-left: 33.33333333%;}
    .col-lg-offset-3 {margin-left: 25%;}
    .col-lg-offset-2 {margin-left: 16.66666667%;}
    .col-lg-offset-1 {margin-left: 8.33333333%;}
    .col-lg-offset-0 {margin-left: 0;}
    .select2-container--default .select2-selection--single {
        border: none;
        padding: 0px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        display: none;
    }
    #page-wrapper {
        margin-left: 0px;
        margin-top: -80px;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > thead > tr > td {
        border-bottom-width: 1px;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > th,
    .table-bordered > tfoot > tr > th,
    .table-bordered > thead > tr > td,
    .table-bordered > tbody > tr > td,
    .table-bordered > tfoot > tr > td {
        border: 1px solid #333 !important;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f9f9f9 !important;
    }
    .table > tbody + tbody {
        border-top: 1px solid #333 !important;
    }
    .table > tbody > tr > td,
    .table > tfoot > tr > td,
    .table-bordered > tbody > tr > th {
        line-height: 0.5;
    }
    .table-responsive {
        overflow-x: unset;
    }
    .printheight {
        display: block !important;
    }
    .printheight2 {
        display: block !important;
    }
}
</style>