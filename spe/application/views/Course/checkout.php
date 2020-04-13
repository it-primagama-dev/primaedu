<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- fONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/course/style.css" rel="stylesheet" type="text/css">
    <style type="text/css">
      .btnbg {
        background-image: url('<?php echo base_url(); ?>assets/images/img/btn.jpg');
      }

      .judul {
        background-image: url('<?php echo base_url(); ?>assets/images/img/bg.jpg');
      }

      @media (min-width: 768px) {
      .modal-xl {
        width: 100%;
        max-width:1200px;
        margin: 30px auto;
      }
    </style>
    <title>Kelas Online Live - Primagama</title>
  </head>
  <body class="mt-5">
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary" style="background-image: url('<?php echo base_url(); ?>assets/images/img/nav.jpg')">
      <div class="container">
        <!-- <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> -->
          <a class="navbar-brand" href="javascript:void(0)">Form Pembelian Paket - <?= $PackName ?></a>
        <!-- </div> -->
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
            <img src="<?php echo base_url(); ?>assets/images/img/LogoPrima.png" width="75%">
          </div>
        </div>
      </div>
    </nav>

    <section id="detailpaket" class="detailpaket mb-4">
      <div class="container">
        <div class="loader"></div>
        <div class="row">
          <div class="col">       
              <!-- <nav class="navbar mt-5" style="background-image: linear-gradient(white, blue 200%);">
                <font style="font-size: 20px;">Form Pembelian Paket - <?= $PackName ?> </font>  
              </nav> -->
              <input type="hidden" id="packid" class="form-control" value="<?= $id ?>">
              <input type="hidden" id="sesid" class="form-control">
              <input type="hidden" id="pricetot" class="form-control" value="<?= $pricetot ?>">
              <input type="hidden" id="totstu" class="form-control" value="<?= $totstu ?>">
              <input type="hidden" id="stagecat" class="form-control" value="<?= $stagecat ?>">
              <input type="hidden" id="idpackdetail" class="form-control">
              <input type="hidden" id="pricefixtot" class="form-control">
              <input type="hidden" id="pricefix" class="form-control">
              <input type="hidden" id="jumlahmapel" class="form-control">
              <input type="hidden" id="namapaket" value="<?= $PackName ?>">
              <p style="display: none;" id="basket"></p>
          </div>
        </div>

        <div class="row mt-5 mb-3">
          <div class="col" id="divform">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-4">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="2"><font style="font-size: 20px; color: #230346;"> <li>Pilih Sesi</li></font></th>
                </tr>
              </thead>
              <tbody id="dt_sesi">
              </tbody>
            </table>
            <div class="card" style="background-image: url('<?php echo base_url(); ?>assets/images/img/bg-cardred.jpg');background-size: cover;">
              <div class="card-body">
                <h6 class="card-title"><b>Syarat & Ketentuan Berlaku :</b></h6>
                <p class="card-text">
                  <ul style="padding-left: 20px; font-size: 14px;">
                    <li>Masa berlaku paket adalah 2 minggu sejak dilakukan pembayaran.</li>
                    <li>Siswa dapat memilih jadwal sesi belajar dalam 2 minggu ke depan.</li>
                    <li>Jadwal yang sudah dipilih setelah melakukan pembayaran tidak dapat di-reschedule.</li>
                    <li>Jika siswa tidak hadir pada jadwal yang sudah dipilih maka tidak dapat diganti ke jadwal lain.</li>
                    <font id="divsk" style="display: none;"><li>Maksimal pilih <b id="jmlmapel"></b> Mapel</li></font> 
                  </ul>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-8 mb-4"> 
                <table class="table">
                  <thead>
                    <tr>
                      <th colspan="4"><font style="font-size: 20px; color: #230346;"> <li>Pilih Mata Pelajaran & Jadwal</li></font></th>
                    </tr>
                  </thead>
                  <tbody id="dt_meet">
                  </tbody>
                </table>
          </div>
        </div>

        <div class="row">
              <div class="col-md-12 mb-4"> 
                <table class="table">
                  <thead>
                    <tr>
                      <th colspan="3"><font style="font-size: 20px; color: #230346;"> <li>Total Biaya - <?= $PackName2 ?> :</li></font></th>
                    </tr>
                  </thead>
                  <thead>
                    <tr>
                      <th class="text-left">Total Siswa</th>
                      <th class="text-center">Total Pertemuan</th>
                      <th class="text-right">Harga Per Siswa</th>
                    </tr>
                  </thead>
                  <tbody id="dt_pricefix">
                  </tbody>
                  <tfoot id="dt_pricefixtot">
                  </tfoot>
                </table>
              <!-- <nav class="navbar text-white rounded" style="background-image: url('<?php echo base_url(); ?>assets/images/img/nav.jpg')">
                <font style="font-size: 20px;" id="pricefix"></font>  
                <button class="btn btn-success text-right" style="background-image: url('<?php echo base_url(); ?>assets/images/img/btn-green.jpg')" id="btnbyr" onClick="pay()">Lanjut Ke Pembayaran</button>
              </nav> -->

                  <button class="btn btn-success btn-block" style="background-image: url('<?php echo base_url(); ?>assets/images/img/btn-green.jpg')" id="btnbyr" onClick="pay()">Lanjut Ke Pembayaran</button>
                   
              </div>
        </div>
      </div>
    </section> 

    <!-- Modal -->
    <div class="modal fade modal-xl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-image: url('<?php echo base_url(); ?>assets/images/img/bg.jpg')">
            <h5 class="modal-title text-white"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pt-3">
              <div class="row">
                <div class="col-md">
                  <div  class="table-responsive" id="divjadwal" style="max-height: 300px;">
                  <table class="table table-bordered table-striped">
                    <thead id="jadwalhead"></thead>
                    <tbody id="jadwaldetail"></tbody>
                  </table>
                </div>
                </div>
              </div>
              <div class="row pt-3">
                <div class="col-md text-center">
                  <div class="tersedia">
                    <input type="radio" id="biru" disabled="disabled">
                    <label for="biru"> Jadwal Tersedia</label>
                  </div>
                </div>
                <div class="col-md text-center">
                  <div class="penuh">
                    <input type="radio" id="biru" disabled="disabled">
                    <label for="biru"> Jadwal Digunakan Siswa Lain</label>
                  </div>
                </div>
               <!--  <div class="col-md text-center">
                  <div class="pilihan">
                    <input type="radio" id="biru" disabled="disabled">
                    <label for="biru"> Jadwal Pilihan Kamu</label>
                  </div>
                </div> -->
              </div>
              <div class="row mt-2">
                <div class="col-md text-right">
                  <button type="button" class="btn btn-success btn-md" onClick=pilihjadwal();>Pilih Jadwal</button>
                  <!-- <button type="button" class="btn btn-danger text-left btn-md" data-dismiss="modal">Batal</button> -->
                </div>
              </div>
            <input type="hidden" id="idsub" class="form-control">
            <input type="hidden" id="meetnumber" class="form-control">
          </div>
        </div>
      </div>
    </div><!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header" style="text-align: center;">
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- <p style="font-size: 14px;"> - Klik tombol "Tampilkan Kode Pembayaran" dan catat kode yang muncul. <br> 
                         - Cara melakukan pembayaran akan ditampilkan setelah klik tombol tersebut dan dikirim ke Email.<br>
                      </p> -->
                    </div>
                </div>
                <div class="row pr-2">
                  <div class="col-md-4">
                        <img style="width: 100px;" src="<?php echo base_url(); ?>assets/images/bca.png"/>
                  </div>
                  <div class="col-md-8 text-right">
                        <button type="button" class="btn btn-warning btn-md" onClick="savedata();">Tampilkan Kode Pembayaran</button>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md">
                    <div class="card" style="background-image: url('<?php echo base_url(); ?>assets/images/img/bg-cardgreen.jpg');background-size: cover;">
                      <div class="card-body">
                        <h6 class="card-title text-center"><b>Klik tombol "Tampilkan Kode Pembayaran" <br>untuk mendapatkan kode pembayaran.</b></h6>
                        <p class="card-text" style="font-size: 12px;">
                          <b>Cara Membayar di ATM :</b> <br>1. Masukkan kartu ATM BCA dan PIN <br>2. Pilih "Transaksi Lainnya" <br>3. Pilih "Transfer" <br>4. Pilih "ke Rekening BCA Virtual Account" <br>5. Masukkan nomor BCA Virtual Account <br>6. Pastikan Nama & Jumlah Tagihan Sesuai dengan yang ada di Sistem PrimaEdu  <br>7. Setelah Proses Validasi selesai dengan menekan tombol "Ya", simpan bukti transaksi anda.<br></br><b>Cara membayar menggunakan KlikBCA Individual :</b><br>1. Login pada aplikasi KlikBCA Individual <br>2. Masukkan User ID dan PIN <br>3. Pilih "Transfer Dana" <br>4. Pilih "Transfer ke BCA Virtual Account" <br>5. Masukkan nomor BCA Virtual <br>6. Pastikan Nama & Jumlah Tagihan Sesuai dengan yang ada di Sistem PrimaEdu  <br>7. Setelah Proses Validasi selesai dengan menekan tombol "Kirim", simpan bukti transaksi anda.<br></br><b>Cara membayar menggunakan Mobile BCA :</b><br>1. Login pada aplikasi Mobile BCA <br>2. Pilih "m-Transfer" <br>3. Pilih "Transfer - BCA Virtual Account" <br>4. Masukkan VA BCA / Kode Pembayaran <br>5. Pastikan Nama & Jumlah Tagihan Sesuai dengan yang ada di Sistem PrimaEdu <br>6. Pilih "OK", dan simpan bukti transaksi anda.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
          </div>
        </div>

      </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Custom Js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom-scripts.js"></script>
    <!-- notify -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/notify/notify.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>assets/js/dateformat.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>assets/js/sha-1.js"></script>
</body>
</html>
<script type="text/javascript">
window.base_url = <?php echo json_encode(base_url()); ?>;

function get_time(time) {
  time2 = time.substring(0,5);
  return time2;
}

function get_hari(date) {
  //var date = tambah;

  var today = new Date(date);
  today.setDate(today.getDate());

  var options = {  weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
  return today.toLocaleDateString('id-id', options);
}

function get_tgl(tambah) {

  //date = 'Thu Apr 20 2020 00:00:00 UTC +7 0530 (Western Indonesian Time)"';
  var today = new Date();
  var now = today.setDate(today.getDate() + tambah);

 // var now = new Date();
  var yy = today.getFullYear();
  var m = today.getMonth()+1;
  var d = today.getDate();
  var mm = m < 10 ? '0' + m : m;
  var dd = d < 10 ? '0' + d : d;
  return dd+'-'+mm+'-'+yy;

/*  var date = tambah;

  var today = new Date();
  today.setDate(today.getDate() + tambah);
  var options = {  year: 'numeric', day: 'numeric', month: 'numeric'};
  return today.toLocaleDateString('id-id', options);*/
}

function tgl_indo_angka(date) {
  var now = new Date(date);
  var yy = now.getFullYear();
  var m = now.getMonth() + 1;
  var d = now.getDate();
  var mm = m < 10 ? '0' + m : m;
  var dd = d < 10 ? '0' + d : d;
  return dd+'-'+mm+'-'+yy;
}

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

function RandomNumber() {
  return Math.floor(100000 + Math.random() * 900000);
}

function pay(){ 
      $(".text-danger").remove();
      var Referal = $('#Referal').val();
      var Kelas = $('#Kelas').val();
      var n = $("input[name^='Nama']").length;
      var array1 = $("input[name^='Nama']");
      var array2 = $("input[name^='AsalSekolah']");
      var array3 = $("input[name^='Email']");
      var array4 = $("input[name^='NoHp']");

      for(i=0;i<n;i++)
      {
          Nama =  array1[i].value;
          AsalSekolah =  array2[i].value;
          Email =  array3[i].value;
          NoHp =  array4[i].value;
          //alert(Nama);
          numb = i+1;
            if(Nama == "") {
                alert('Nama Siswa Ke - '+numb+' Belum diisi');
                return false;
            }  
            if(AsalSekolah == "") {
                alert('Asal Sekolah Siswa Ke - '+numb+' Belum diisi');
                return false;
            } 
            if(Email == "") {
                alert('Email Siswa Ke - '+numb+' Belum diisi');
                return false;
            } 
            if(NoHp == "") {
                alert('No Telp Siswa Ke - '+numb+' Belum diisi');
                return false;
            } 
        }
        if(Referal == "") {
          //alert('Isi Kode Referal Dulu . . .');
          $('[id="Referal"]').after('<p class="text-danger text-left">Isi Kode Referal Dulu . . .</p>');
          $('[id="Referal"]').focus();
          return false;
        } else if(Kelas == "") {
          //alert('Isi Kode Referal Dulu . . .');
          $('[id="Kelas"]').after('<p class="text-danger text-left">Pilih Kelas Dulu . . .</p>');
          $('[id="Kelas"]').focus();
          return false;
        } else {

        $.ajax({
            url: base_url+"course/cek_referal",
            type: "POST",
            data: ({Referal:window.btoa(Referal)}),
            dataType: 'JSON',
            success:function(data){

              var cekreferal = Object.keys(data.rows3).length;

              if(cekreferal > 0) {
                $('.modal-title').empty();
                        $('#myModal2').modal({
                            show: true,
                            backdrop: 'static',
                            keyboard: false
                });
                $('.modal-title').text('Pilih Metode Pembayaran');
              } else {
                alert('Kode Referal Salah');
                $('[id="Referal"]').after('<p class="text-danger text-left">Isi Kode Referal yg benar . . .</p>');
                $('[id="Referal"]').focus();
              } 
            }
          })
      }
}

$(document).ready(function(){
    get_sesi();
    get_stage();
    $('#sesid').val(randomString(20));
    var $tr = $("<tr>").append(
       $('<td colspan="3" style="text-align:center;">').text('- - - Belum Pilih Sesi Pertemuan - - -'),
    ).appendTo('#dt_pricefix');

});

function get_sesi() {
  packid = $('#packid').val();
  $.ajax({
      url: base_url+"course/get_sesi",
      type: "POST",
      data: ({packid:window.btoa($('#packid').val())}),
      dataType: 'JSON',
      beforeSend: function(){
          $("#ajax-loader").show();
      },
      complete: function() {
          $("#ajax-loader").hide();
      },
      success:function(data){
      $('#dt_meet').empty();
        var $tr = $("<tr>").append(
           $('<td colspan="3" style="text-align:center;">').text('- - Belum Pilih Sesi Pertemuan - -'),
        ).appendTo('#dt_meet');
        $.each(data.rows, function(i, item) {
            var $tr = $("<tr class='noBorder'>").append(
                $('<th height="50" style="text-align:left;" width="10%">').html(`<label class="labelradio">
                      <input type="radio" name="sesi" value=`+item.RecID+`>
                      <span class="checkmarkradio"></span>
                    </label>`),
                $('<th height="50" style="text-align:left;">').text(item.PackDetailName),
            ).appendTo('#dt_sesi');
        });

        var TotStudent = parseInt($('#totstu').val());
          //$i = 0;
        for (i = 1; i < TotStudent+1; ++i) {
          if(i===1){
            kelas = `<div class="form-group">
                            <label for="Kelas">Kelas</label>
                            <select id="Kelas" name="Kelas" class="form-control">
                              <option value="">- - - wajib diisi - - -</option>
                            </select>
                          </div>`;
              referal = `
                        <div class="form-group">
                          <label for="Referal">Kode Referal</label>
                          <input type="text" id="Referal" name="Referal" class="form-control" placeholder="wajib diisi . . .">
                        </div>`;
          } else {
            kelas = ``;
            referal = ``;
          }
          var div = `<div class="card mb-4">
                  <div class="card-header text-white judul">
                      <b>Yuk isi datamu disini . . . ( Form Siswa `+i+` )</b> 
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="Nama">Nama</label>
                          <input type="text" id="Nama`+i+`" name="Nama" class="form-control" placeholder="wajib diisi . . .">
                        </div>
                        <div class="form-group">
                          <label for="AsalSekolah">Asal Sekolah</label>
                          <input type="text" id="AsalSekolah`+i+`" name="AsalSekolah" class="form-control" placeholder="wajib diisi . . .">
                        </div>
                        `+kelas+`
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="NoHp">No. Handphone</label>
                          <input type="text" id="NoHp`+i+`" name="NoHp" class="form-control" placeholder="wajib diisi . . .">
                        </div>
                        <div class="form-group">
                          <label for="Email">Email <font color='red' style='font-size: 12px;'>*Pastikan email valid, untuk notifikasi pembayaran</font></label>
                          <input type="email" id="Email`+i+`" name="Email" class="form-control" placeholder="wajib diisi . . . ">
                        </div>
                        `+referal+`
                      </div>
                    </div>
                  </div>
                </div>`;
          var $tr2 = $('<div class="row">').append(
              $('<div class="col">').html(div),
          ).appendTo('#divform');
        }

        get_stage();
        $('input:radio[name="sesi"]').change(function() {
            var id = $(this).val();
            var namapaket = $('#namapaket').val();
            $('#dt_meet').empty();
            $.ajax({
                url: base_url+"course/get_packdetail",
                type: "POST",
                data: ({id:window.btoa(id)}),
                dataType: 'JSON',
                success:function(data2){
                    $.each(data2.rows, function(i2, item2) {
                      jmlsesi = item2.TotalMeet;
                      pricetot = item2.PriceDetail;
                      jmlsiswa = item2.TotalStudents;
                      totalmapel = item2.TotalSub;
                      catid = item2.CatID;
                      idpackdetail = item2.RecID;
                    });
                    $('#dt_pricefix,#dt_pricefixtot').empty();
                    var $tr = $("<tr>").append(
                       $('<td style="text-align:left;" width="25%">').text(jmlsiswa),
                       $('<td style="text-align:center;">').text(jmlsesi),
                       $('<td style="text-align:right;">').text(convertToRupiah(pricetot)),
                    ).appendTo('#dt_pricefix');
                    var $tr = $("<tr>").append(
                       $('<th colspan="2" style="text-align:left;">').text('Jumlah Total Biaya'),
                       $('<th style="text-align:right;">').text(convertToRupiah(pricetot*jmlsiswa)),
                    ).appendTo('#dt_pricefixtot');
                    // alert(catid);
                    $('#pricefixtot').val(pricetot*jmlsiswa);
                    $('#pricefix').val(pricetot);
                    if(totalmapel != 1) {
                      $('#divsk').css('display','block');
                      $('#jmlmapel').text(totalmapel);
                      $('#jumlahmapel').val(totalmapel);
                    } else {
                      $('#jumlahmapel').val(1);
                    }
                      $('#basket').text(namapaket+','+pricetot+'.00,'+jmlsiswa+','+pricetot*jmlsiswa+'.00;');
                      $('#idpackdetail').val(idpackdetail);
                      var stagecat = $('#stagecat').val();

                      for (i = 1; i < jmlsesi+1; ++i) {
                        var $tr = $("<tr>").append(
                            $('<td style="text-align:left;">').text('Pertemuan '+i),
                            $('<td style="display: none;">').html(`<input id="meetnumber`+i+`" value="`+i+`">`),
                            $('<td style="text-align:center;">').html(`<select id="mapel`+i+`" class="form-control">
                                <option value="">- - - Pilih Mapel - - -</option>
                              </select>`),
                            $('<td> style="text-center"').html(`<i id="jadwaldipilih`+i+`"></>`),
                            $('<td style="text-align:right;">').html(`<button class="btn btn-dark btn-sm btnbg btnjadwal`+i+`" onClick="jadwal(`+i+`);" name="btnjadwal`+i+`" id="btnjadwal`+i+`">Pilih Jadwal</button>`),
                        ).appendTo('#dt_meet');
                      }

                      $.getJSON(base_url+"course/get_mapel/"+stagecat, function(json){
                        for (i = 1; i < jmlsesi+1; ++i) {
                          $.each(json, function(i2, obj2){
                            $('#mapel'+i).append($('<option>').text(obj2.SubName).attr('value', obj2.RecID));
                          });
                        }
                      });
                }
              })

        });
      }
  });
}

function jadwal(id) {

  $('#jadwaldetail').empty();
  $('#jadwalhead').empty();
  idmapel=$('#mapel'+id).val();
  meetnumber=$('#meetnumber'+id).val();
  Referal = $('#Referal').val();
  /*alert(referal);*/
  $(".text-danger").remove();
  if(idmapel == "") {
      $('[id="mapel'+id+'"]').after('<p class="text-danger text-left">Pilih Mapel Dulu . . .</p>');
      $('[id="mapel'+id+'"]').focus();
      return false;
  } else {
    $.ajax({
        url: base_url+"course/get_jadwal",
        type: "POST",
        data: ({id:window.btoa(idmapel),Referal:window.btoa(Referal)}),
        dataType: 'JSON',
        success:function(data){

          $('#idsub').val(idmapel);
          $('#meetnumber').val(meetnumber);
          //alert(date2);

          var title = 'Pilih Jadwal Pertemuan '+id+' - '+data.SubName+'';
          $('#myModal').modal({
              show: true,
              backdrop: 'static',
              keyboard: false
          });
          $('.modal-title').text(title);

          var jml_data = Object.keys(data.rows).length;
          //alert(jml_data);

          if(jml_data > 0){
          $.each(data.rows, function(i, item) {
            
            if(item.Jam1 > 0) {
              Jam1 = `<td  class="radio-toolbar">
                      <input type="radio" id="jam1`+item.Date+`" name="jadwal" value="07:30,`+item.Date+`">
                      <label for="jam1`+item.Date+`">07:30 - 09:00</label>
                    </td>`;
            } else {
              Jam1 = `<td  class="NoAvailable">
                      <input type="radio" id="jam1`+item.Date+`" name="jadwal" value="07:30,`+item.Date+`" disabled="disabled">
                      <label for="jam1`+item.Date+`">07:30 - 09:00</label>
                    </td>`;
            }
            if(item.Jam2 > 0) {
              Jam2 = `<td  class="radio-toolbar">
                      <input type="radio" id="jam2`+item.Date+`" name="jadwal" value="09:00,`+item.Date+`">
                      <label for="jam2`+item.Date+`">09:00 - 10:30</label>
                    </td>`;
            } else {
              Jam2 = `<td  class="NoAvailable">
                      <input type="radio" id="jam2`+item.Date+`" name="jadwal" value="09:00,`+item.Date+`" disabled="disabled">
                      <label for="jam2`+item.Date+`">09:00 - 10:30</label>
                    </td>`;
            }
            if(item.Jam3 > 0) {
              Jam3 = `<td  class="radio-toolbar">
                      <input type="radio" id="jam3`+item.Date+`" name="jadwal" value="10:30,`+item.Date+`">
                      <label for="jam3`+item.Date+`">10:30 - 12:00</label>
                    </td>`;
            } else {
              Jam3 = `<td  class="NoAvailable">
                      <input type="radio" id="jam3`+item.Date+`" name="jadwal" value="10:30,`+item.Date+`" disabled="disabled">
                      <label for="jam3`+item.Date+`">10:30 - 12:00</label>
                    </td>`;
            }
            if(item.Jam4 > 0) {
              Jam4 = `<td  class="radio-toolbar">
                      <input type="radio" id="jam4`+item.Date+`" name="jadwal" value="13:00,`+item.Date+`">
                      <label for="jam4`+item.Date+`">13:00 - 14:30</label>
                    </td>`;
            } else {
              Jam4 = `<td  class="NoAvailable">
                      <input type="radio" id="jam4`+item.Date+`" name="jadwal" value="13:00,`+item.Date+`" disabled="disabled">
                      <label for="jam4`+item.Date+`">13:00 - 14:30</label>
                    </td>`;
            }
            if(item.Jam5 > 0) {
              Jam5 = `<td  class="radio-toolbar">
                      <input type="radio" id="jam5`+item.Date+`" name="jadwal" value="14:30,`+item.Date+`">
                      <label for="jam5`+item.Date+`">14:30 - 16:00</label>
                    </td>`;
            } else {
              Jam5 = `<td  class="NoAvailable">
                      <input type="radio" id="jam5`+item.Date+`" name="jadwal" value="14:30,`+item.Date+`" disabled="disabled">
                      <label for="jam5`+item.Date+`">14:30 - 16:00</label>
                    </td>`;
            }
            if(item.Jam6 > 0) {
              Jam6 = `<td  class="radio-toolbar">
                      <input type="radio" id="jam6`+item.Date+`" name="jadwal" value="16:00,`+item.Date+`">
                      <label for="jam6`+item.Date+`">16:00 - 17:30</label>
                    </td>`;
            } else {
              Jam6 = `<td  class="NoAvailable">
                      <input type="radio" id="jam6`+item.Date+`" name="jadwal" value="16:00,`+item.Date+`" disabled="disabled">
                      <label for="jam6`+item.Date+`">16:00 - 17:30</label>
                    </td>`;
            }
            if(item.Jam7 > 0) {
              Jam7 = `<td  class="radio-toolbar">
                      <input type="radio" id="jam7`+item.Date+`" name="jadwal" value="18:30,`+item.Date+`">
                      <label for="jam7`+item.Date+`">18:30 - 20:00</label>
                    </td>`;
            } else {
              Jam7 = `<td  class="NoAvailable">
                      <input type="radio" id="jam7`+item.Date+`" name="jadwal" value="18:30,`+item.Date+`" disabled="disabled">
                      <label for="jam7`+item.Date+`">18:30 - 20:00</label>
                    </td>`;
            }
            //alert('OK');
            var $tr = $("<tr>").append(
               $('<th style="font-size: 13px;">').text(get_hari(item.Date)),
               Jam1,
               Jam2,
               Jam3,
               Jam4,
               Jam5,
               Jam6,
               Jam7,
            ).appendTo('#jadwaldetail');
          });
        } else {
            var $tr = $("<tr>").append(
               $('<th colspan="7" style="font-size: 20px; text-align: center; color: red;">').text('Oops Jadwal Sudah Terisi Penuh.'),
            ).appendTo('#jadwaldetail');
        }
      }
      });
  }
}

function pilihjadwal() {
  var idjadwal = document.getElementsByName('jadwal');
      idpackdetail = $('#idpackdetail').val();
      idsub = $('#idsub').val();
      packid = $('#packid').val();
      sesid = $('#sesid').val(); 
      meetnumber = $('#meetnumber').val();
      pricefixtot = $('#pricefixtot').val();
      pricefix = $('#pricefix').val();
      jumlahmapel = $('#jumlahmapel').val();
      Referal = $('#Referal').val();

      for (var i = 0, length = idjadwal.length; i < length; i++) {
        if (idjadwal[i].checked) {
          var dateandtime = idjadwal[i].value;
              arraylist = dateandtime.split(",");
              time2 = arraylist[0];
              date2 = arraylist[1];
          break;
        }
      }

      //date3 = tgl_indo_angka(date2);
      //alert(date2);
      $.ajax({
          url: base_url+"course/save_ordertmp",
          type: "POST",
          data: ({
            idpackdetail:window.btoa(idpackdetail),
            idsub:window.btoa(idsub),
            packid:window.btoa(packid),
            session:window.btoa(sesid),
            meetnumber:window.btoa(meetnumber),
            pricefixtot:window.btoa(pricefixtot),
            pricefix:window.btoa(pricefix),
            date:window.btoa(date2),
            time:window.btoa(time2),
            jumlahmapel:window.btoa(jumlahmapel),
            Referal:window.btoa(Referal),
          }),
          dataType: 'JSON',
          beforeSend: function(){
              $("#ajax-loader").show();
          },
          complete: function() {
              $("#ajax-loader").hide();
          },
          success:function(data){
            $('#jadwaldipilih'+meetnumber).text(get_hari(date2)+' - '+time2);
            $.notify(data.message,data.notify); 
            $('#myModal').modal('hide');
          }
        });
  }

function add_mapel(id) {
  //alert(id);
  var Total = 0;
  //var Total;
  $.ajax({
      url: base_url+"course/save_ordertmp",
      type: "POST",
      data: ({id:window.btoa(id),session:$('#sesid').val(),pricetot:window.btoa($('#pricetot').val())}),
      dataType: 'JSON',
      success:function(data){
        $('#dt_ordertmp,#foottot').empty();
        $.each(data.rows, function(i, item) {
          var $tr = $("<tr>").append(
              $('<td style="text-align:left;">').text(item.SubName),
              $('<td style="text-align:right;">').text(convertToRupiah(item.Pricetot)),
          ).appendTo('#dt_ordertmp');
          Total += parseFloat(item.Pricetot);
          $('#btnbyr').removeAttr("disabled");
        });
          var $tr = $("<tr>").append(
              $('<th style="text-align:left;">').text('Total'),
              $('<th style="text-align:right;">').text(convertToRupiah(Total)),
          ).appendTo('#foottot');
      }
    });
}

function del_mapel(id) {
  //alert(id);
  var Total = 0;
  $.ajax({
      url: base_url+"course/del_ordertmp",
      type: "POST",
      data: ({id:window.btoa(id),session:$('#sesid').val()}),
      dataType: 'JSON',
      success:function(data){
        $('#dt_ordertmp,#foottot').empty();
        var jml_data = Object.keys(data.rows).length;
        if(jml_data > 0){
        $.each(data.rows, function(i, item) {
          var $tr = $("<tr>").append(
              $('<td style="text-align:left;">').text(item.SubName),
              $('<td style="text-align:right;">').text(convertToRupiah(item.Pricetot)),
          ).appendTo('#dt_ordertmp');
          Total += parseFloat(item.Pricetot);
        });
          var $tr = $("<tr>").append(
              $('<th style="text-align:left;">').text('Total'),
              $('<th style="text-align:right;">').text(convertToRupiah(Total)),
          ).appendTo('#foottot');
          $('#btnbyr').removeAttr("disabled");
        } else {
          $('#btnbyr').attr("disabled", true);
          var $tr = $("<tr>").append(
             $('<td colspan="2" style="text-align:center;">').text('- - Belum Pilih Mata Pelajaran - -'),
          ).appendTo('#dt_ordertmp');
        }
      }
    });
}

function get_stage() {
  var stagecat = $('#stagecat').val();
  $.getJSON(base_url+"course/get_stage/"+stagecat, function(json){
      $('#Kelas').empty();
      $('#Kelas').append($('<option>').text("- - Pilih Kelas - -").attr('value', ''));
      $.each(json, function(i, obj){
      $('#Kelas').append($('<option>').text(obj.StageName).attr('value', obj.StageCode));
      });
  });
}

function savedata() {
      idpackdetail = $('#idpackdetail').val();
      idsub = $('#idsub').val();
      packid = $('#packid').val();
      sesid = $('#sesid').val(); 
      meetnumber = $('#meetnumber').val();
      pricefixtot = $('#pricefixtot').val();
      pricefix = $('#pricefix').val();
      jumlahmapel = $('#jumlahmapel').val();
      Referal = $('#Referal').val();
      Kelas = $('#Kelas').val();

      var n = $("input[name^='Nama']").length;
      var array1 = $("input[name^='Nama']");
      var array2 = $("input[name^='AsalSekolah']");
      var array3 = $("input[name^='Email']");
      var array4 = $("input[name^='NoHp']");
      //alert(array1);
      //alert(RandomNumber());
      for(i=0;i<n;i++)
      {
          Nama =  array1[i].value;
          AsalSekolah =  array2[i].value;
          Email =  array3[i].value;
          NoHp =  array4[i].value;
          EmailPertama = array3[0].value;
          NamaPertama = array1[0].value;
          //alert(Nama);
            //alert('ok');
              $.ajax({
                  url : base_url+"course/save_order",
                  type: 'POST',
                  data: ({
                    Nama:window.btoa(Nama),
                    Sekolah:window.btoa(AsalSekolah),
                    Email:window.btoa(Email),
                    NoHp:window.btoa(NoHp),
                    sesid:window.btoa(sesid)
                  }),
                  dataType: 'json',
                  beforeSend: function(){
                      $("#ajax-loader").show();
                  },
                  complete: function() {
                      $("#ajax-loader").hide();
                  },
                  success: function(data){
                      //redirectPost(base_url+'Logistics/list_do');
                      //$.notify(data.message,data.notify);
                  }
              })
       }

       //alert(EmailPertama);

              var now = new Date();
              //formdata['token'] = window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=");

              $.ajax({
                  url : base_url+"course/save_orderheader",
                  type: 'POST',
                  data: ({
                    TotalPrice:window.btoa(pricefixtot),
                    PackDetailID:window.btoa(idpackdetail),
                    SessionID:window.btoa(sesid),
                    StageCode:window.btoa(Kelas),
                    Referal:window.btoa(Referal),
                    CURRENCY:decode64('MzYw'),
                    PURCHASECURRENCY:decode64('MzYw'),
                    AMOUNT:pricefixtot+'.00',
                    PURCHASEAMOUNT:pricefixtot+'.00',
                    REQUESTDATETIME:dateFormat(now, "yyyymmddHHMMss"),
                    EMAIL:EmailPertama,
                    NAME:NamaPertama,
                    BASKET:document.getElementById("basket").innerHTML,
                    RANDOMNUMBER:RandomNumber(),
                  }),
                  dataType: 'json',
                  beforeSend: function(){
                      $("#ajax-loader").show();
                  },
                  complete: function() {
                      $("#ajax-loader").hide();
                  },
                  success: function(data){
                      redirectPost(base_url+'info/pembayaran/'+sesid);
                      $.notify(data.message,data.notify);
                  }
              })


}

</script>
<style type="text/css">
.radio-toolbar {
  margin: 10px;
}

.radio-toolbar input[type="radio"] {
  opacity: 0;
  position: fixed;
  width: 0;
}

.radio-toolbar label {
    display: inline-block;
    background-color: #87CEFA;
    padding: 10px 15px;
    font-family: sans-serif, Arial;
    font-size: 12px;
    font-weight: bold;
    border: 2px solid #87CEFA;
    border-radius: 4px;
    min-width: 110px;
    text-align: center;
}

.radio-toolbar label:hover {
  background-color: #dfd;
}

.radio-toolbar input[type="radio"]:focus + label {
    font-size: 12px; 
    font-weight: bold;
    border: 2px dashed #444;
}

.radio-toolbar input[type="radio"]:checked + label {
    background-color: #bfb;
    border-color: #4c4;
    font-weight: bold;
}

.NoAvailable {
  margin: 10px;
}

.NoAvailable input[type="radio"] {
  opacity: 0;
  position: fixed;
  width: 0;
}

.NoAvailable label {
    display: inline-block;
    background-color: #FF0000;
    padding: 10px 15px;
    font-family: sans-serif, Arial;
    font-size: 12px;
    font-weight: bold;
    border: 2px solid #FF0000;
    border-radius: 4px;
    min-width: 110px;
    text-align: center;
}

.NoAvailable label:hover {
  background-color: #FF0000;
}

.NoAvailable input[type="radio"]:focus + label {
    font-size: 12px; 
    font-weight: bold;
    border: 2px dashed #FF0000;
}

.NoAvailable input[type="radio"]:checked + label {
    background-color: #FF0000;
    border-color: #FF0000;
    font-weight: bold;
}

.pilihan {
  margin: 4px;
}

.pilihan input[type="radio"] {
  opacity: 0;
  position: fixed;
  width: 0;
}

.pilihan label {
    display: inline-block;
    background-color: #bfb;
    padding: 5px 10px;
    font-family: sans-serif, Arial;
    font-size: 12px;
    font-weight: bold;
    border: 2px solid #4c4;
    border-radius: 4px;
    min-width: 200px;
    text-align: center;
}

.pilihan label:hover {
  background-color: #bfb;
}

.pilihan input[type="radio"]:focus + label {
    font-size: 12px; 
    font-weight: bold;
    border: 2px dashed #444;
}

.pilihan input[type="radio"]:checked + label {
    background-color: #bfb;
    border-color: #4c4;
    font-weight: bold;
}

.tersedia {
  margin: 4px;
}

.tersedia input[type="radio"] {
  opacity: 0;
  position: fixed;
  width: 0;
}

.tersedia label {
    display: inline-block;
    background-color: #87CEFA;
    padding: 5px 10px;
    font-family: sans-serif, Arial;
    font-size: 12px;
    font-weight: bold;
    border: 2px solid #87CEFA;
    border-radius: 4px;
    min-width: 200px;
    text-align: center;
}

.tersedia label:hover {
  background-color: #87CEFA;
}

.tersedia input[type="radio"]:focus + label {
    font-size: 12px; 
    font-weight: bold;
    border: 2px dashed #87CEFA;
}

.tersedia input[type="radio"]:checked + label {
    background-color: #87CEFA;
    border-color: #87CEFA;
    font-weight: bold;
}

.penuh {
  margin: 4px;
}

.penuh input[type="radio"] {
  opacity: 0;
  position: fixed;
  width: 0;
}

.penuh label {
    display: inline-block;
    background-color: #FF0000;
    padding: 5px 10px;
    font-family: sans-serif, Arial;
    font-size: 12px;
    font-weight: bold;
    border: 2px solid #FF0000;
    border-radius: 4px;
    min-width: 200px;
    text-align: center;
}

.penuh label:hover {
  background-color: #FF0000;
}

.penuh input[type="radio"]:focus + label {
    font-size: 12px; 
    font-weight: bold;
    border: 2px dashed #FF0000;
}

.penuh input[type="radio"]:checked + label {
    background-color: #FF0000;
    border-color: #FF0000;
    font-weight: bold;
}
</style>