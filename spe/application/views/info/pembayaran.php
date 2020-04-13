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
    <title>Kelas Tatap Muka Online - Primagama</title>
  </head>
  <body class="mt-5">
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary" style="background-image: url('<?php echo base_url(); ?>assets/images/img/nav.jpg')">
      <div class="container">
        <!-- <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> -->
          <a class="navbar-brand" href="javascript:void(0)">Informasi Pembayaran</a>
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
        <input type="hidden" id="sessid" value="<?= $sessid ?>">
        <div class="loader"></div>
        <div class="row">
            <div class="col-md">
              <div class="card mb-4 mt-5">
              <div class="card-header text-white judul">
                  <b style="font-size: 20px;">Ringkasan Pembelian Paket</b> 
              </div>
              <div class="card-body">
                <div class="row mt-3">
                  <div class="col-md">
                    <div  class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="text-center bg-light">
                            <th>Nama Paket</th>
                            <th>Kelas</th>
                            <th>Jumlah Pertemuan</th>
                            <th>Jumlah Siswa</th><!-- 
                            <th>Total Harga</th>
                            <th>Status Pembayaran</th> -->
                          </tr>
                        </thead>
                        <tbody id="dt_paket"></tbody>
                      </table>
                      </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md">
                    <h5> <li>Jadwal dan Mapel yang dipilih </li> </h5>
                    <div  class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="text-center bg-light">
                            <th>Pertemuan</th>
                            <th>Mapel</th>
                            <th>Hari & Tgl</th>
                            <th>Waktu / Jam</th>
                          </tr>
                        </thead>
                        <tbody id="dt_jadwal"></tbody>
                      </table>
                      </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md">
                    <h5> <li>Data Siswa </li> </h5>
                    <div  class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="text-center bg-light">
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                          </tr>
                        </thead>
                        <tbody id="dt_siswa"></tbody>
                      </table>
                      </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md">
                    <h5> <li>Informasi Pembayaran </li> </h5>
                    <div  class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="text-center bg-light">
                            <th>Kode Pembayaran</th>
                            <th>No. Invoice</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody id="dt_pay"></tbody>
                      </table>
                      </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md">
                    <div class="card" style="background-image: url('<?php echo base_url(); ?>assets/images/img/bg-cardgreen.jpg');background-size: cover;">
                      <div class="card-body">
                        <h4 class="card-title"><b>Cara Melakukan Pembayaran :</b></h4><br>
                        <p class="card-text">
                          <b>Cara Membayar di ATM :</b> <br>1. Masukkan kartu ATM BCA dan PIN <br>2. Pilih "Transaksi Lainnya" <br>3. Pilih "Transfer" <br>4. Pilih "ke Rekening BCA Virtual Account" <br>5. Masukkan nomor BCA Virtual Account <br>6. Pastikan Nama & Jumlah Tagihan Sesuai dengan yang ada di Sistem PrimaEdu  <br>7. Setelah Proses Validasi selesai dengan menekan tombol "Ya", simpan bukti transaksi anda.<br></br><b>Cara membayar menggunakan KlikBCA Individual :</b><br>1. Login pada aplikasi KlikBCA Individual <br>2. Masukkan User ID dan PIN <br>3. Pilih "Transfer Dana" <br>4. Pilih "Transfer ke BCA Virtual Account" <br>5. Masukkan nomor BCA Virtual <br>6. Pastikan Nama & Jumlah Tagihan Sesuai dengan yang ada di Sistem PrimaEdu  <br>7. Setelah Proses Validasi selesai dengan menekan tombol "Kirim", simpan bukti transaksi anda.<br></br><b>Cara membayar menggunakan Mobile BCA :</b><br>1. Login pada aplikasi Mobile BCA <br>2. Pilih "m-Transfer" <br>3. Pilih "Transfer - BCA Virtual Account" <br>4. Masukkan VA BCA / Kode Pembayaran <br>5. Pastikan Nama & Jumlah Tagihan Sesuai dengan yang ada di Sistem PrimaEdu <br>6. Pilih "OK", dan simpan bukti transaksi anda.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                </div>
              </div>
        </div>
      </div>
    </section> 

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
}


$(document).ready(function(){
    get_pack();
});

function get_pack() {
  $('#dt_meet').empty();
  $.ajax({
      url: base_url+"info/get_detailpack",
      type: "POST",
      data: ({sessid:window.btoa($('#sessid').val())}),
      dataType: 'JSON',
      beforeSend: function(){
          $("#ajax-loader").show();
      },
      complete: function() {
          $("#ajax-loader").hide();
      },
      success:function(data){
        $.each(data.rows, function(i, item) {
          var $tr = $("<tr>").append(
             $('<td>').text(item.CatName+' - '+item.PackDetailName),
             $('<td>').text(item.StageName),
             $('<td class="text-center">').text(item.TotalMeet),
             $('<td class="text-center">').text(item.TotalStudents),/*
             $('<td>').text(convertToRupiah(item.TotalPrice)),
             $('<td>').text(Status),*/
          ).appendTo('#dt_paket');
        });

        $.each(data.rows2, function(i2, item2) {
          var $tr = $("<tr>").append(
             $('<td class="text-center">').text('Ke - '+item2.MeetNumber),
             $('<td class="text-center">').text(item2.SubName),
             $('<td class="text-center">').text(get_hari(item2.DateSchedule)),
             $('<td class="text-center">').text(get_time(item2.TimeFromScheDule)+' - '+get_time(item2.TimeTo))
          ).appendTo('#dt_jadwal');
        });

        $.each(data.rows3, function(i3, item3) {
          var $tr = $("<tr>").append(
             $('<td class="text-center">').text(item3.Name),
             $('<td class="text-center">').text(item3.School),
             $('<td class="text-center">').text(item3.Email),
             $('<td class="text-center">').text(item3.PhoneNumber),
          ).appendTo('#dt_siswa');
        });

        $.each(data.rows4, function(i4, item4) {
          if (item4.Status==null) {
            Status = 'Menunggu Pembayaran';
          } else {
            Status = 'Sudah Dibayar';
          }
          var $tr = $("<tr>").append(
             $('<td class="text-center">').text(item4.PAYMENTCODE),
             $('<td class="text-center">').text(item4.OrderCode),
             $('<td class="text-center">').text(convertToRupiah(item4.TotalPrice)),
             $('<td class="text-center">').text(Status),
          ).appendTo('#dt_pay');
        });
      }
    });
}
</script>