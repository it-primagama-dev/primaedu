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
    <!-- CSS-KU -->
    <style type="text/css">
      section {
        min-height: 300px;
        font-family: 'Raleway';
      }

      .navbar-brand {
        font-family: 'Raleway';
        font-size: 22px;
      }

      footer {
        font-family: 'Raleway';
      }

      .btnbg {
        background-image: url('<?php echo base_url(); ?>assets/images/img/btn.jpg');
      }

      .judul {
        background-image: url('<?php echo base_url(); ?>assets/images/img/bg.jpg');
      }

      .fa-vertical-bar-medium:after {
        content: "\007C" 
      };

      /*tr.noBorder td {
        border: 0;
      }*/
    </style>
    <title>Kelas Tatap Muka Online - Primagama</title>
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
                    <li>Masa berlaku paket adalah 2 minggu.</li>
                    <li>Siswa dapat memilih jadwal sesi belajar dalam 2 minggu ke depan.</li>
                    <li>Jadwal yang sudah dipilih tidak dapat di-reschedule.</li>
                    <li>Jika siswa tidak hadir pada jadwal yang sudah dipilih maka tidak dapat diganti menjadi jadwal lain.</li>
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
                      <th colspan="3"><font style="font-size: 20px; color: #230346;"> <li>Pilih Mata Pelajaran & Jadwal</li></font></th>
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-image: url('<?php echo base_url(); ?>assets/images/img/bg.jpg')">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pt-0">
                <div class="row" id="divjadwal">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="tablemapel">
                      <!-- <thead class="judul">
                        <tr>
                          <th colspan="9" scope="col">Jadwal Tersedia</th>
                        </tr>
                      </thead> -->
                      <thead>
                        <tr class="text-center">
                          <th rowspan="2" scope="col" class="pb-5">Pilih Jadwal</th>
                          <th colspan="2" scope="col">Pertemuan 1</th>
                          <th colspan="2" scope="col">Pertemuan 2</th>
                          <th colspan="2" scope="col">Pertemuan 3</th>
                          <th colspan="2" scope="col">Pertemuan 4</th>
                        </tr>
                        <tr class="text-center">
                          <th scope="col">Hari</th>
                          <th scope="col">Jam</th>
                          <th scope="col">Hari</th>
                          <th scope="col">Jam</th>
                          <th scope="col">Hari</th>
                          <th scope="col">Jam</th>
                          <th scope="col">Hari</th>
                          <th scope="col">Jam</th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        <tr>
                          <th scope="row" class="text-center">
                            <label class="labelradio">
                              <input type="radio" name="radio" >
                              <span class="checkmarkradio"></span>
                            </label>
                          </th>
                          <th scope="row">Senin</th>
                          <th scope="row">14:00</th>
                          <th scope="row">Selasa</th>
                          <th scope="row">14:00</th>
                          <th scope="row">Rabu</th>
                          <th scope="row">14:00</th>
                          <th scope="row">Kamis</th>
                          <th scope="row">14:00</th>
                        </tr>
                        <tr>
                          <th scope="row" class="text-center">
                            <label class="labelradio">
                              <input type="radio" name="radio">
                              <span class="checkmarkradio"></span>
                            </label>
                          </th>
                          <th scope="row">Senin</th>
                          <th scope="row">15:00</th>
                          <th scope="row">Selasa</th>
                          <th scope="row">15:00</th>
                          <th scope="row">Rabu</th>
                          <th scope="row">15:00</th>
                          <th scope="row">Kamis</th>
                          <th scope="row">15:00</th>
                        </tr>
                        <tr>
                          <th scope="row" class="text-center">
                            <label class="labelradio">
                              <input type="radio" name="radio">
                              <span class="checkmarkradio"></span>
                            </label>
                          </th>
                          <th scope="row">Senin</th>
                          <th scope="row">17:00</th>
                          <th scope="row">Selasa</th>
                          <th scope="row">17:00</th>
                          <th scope="row">Rabu</th>
                          <th scope="row">17:00</th>
                          <th scope="row">Kamis</th>
                          <th scope="row">17:00</th>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                </div>
            <button type="button" class="btn btn-success">Pilih Jadwal</button>
            <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Kembali</button>
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
                        <p style="font-size: 12px;"> - Klik tombol "Tampilkan Kode Pembayaran" dan catat kode yang muncul. <br> 
                         - Cara melakukan pembayaran akan ditampilkan setelah klik tombol tersebut dan dikirim ke Email.<br>
                      </p>
                    </div>
                </div>
                <div class="row pr-2">
                  <div class="col-md-4">
                        <img style="width: 100px;" src="<?php echo base_url(); ?>assets/images/bca.png"/>
                  </div>
                  <div class="col-md-8 text-right">
                        <button type="button" class="btn btn-warning btn-md" onClick="saveprnew(29);">Tampilkan Kode Pembayaran</button>
                  </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          </div>
        </div>

      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Custom Js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom-scripts.js"></script>
  <!-- notify -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/notify/notify.js" type="text/javascript"></script>
  </body>
</html>
<script type="text/javascript">
window.base_url = <?php echo json_encode(base_url()); ?>;

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

function pay(){ 
    $('.modal-title').empty();
            $('#myModal2').modal({
                show: true,
                backdrop: 'static',
                keyboard: false
    });
    $('.modal-title').text('Pilih Metode Pembayaran');
}

$(document).ready(function(){
    get_sesi();
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
                            <select id="Kelas" class="form-control">
                              <option value="">- - - wajib diisi - - -</option>
                            </select>
                          </div>`;
              referal = `
                        <div class="form-group">
                          <label for="Referal">Kode Referal</label>
                          <input type="email" name="Referal" class="form-control" placeholder="wajib diisi . . .">
                        </div>`;
          } else {
            kelas = ``;
            referal = ``;
          }
          var div = `<div class="card mb-4">
                  <div class="card-header text-white judul">
                      <b>Form Data Siswa `+i+`</b> 
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="Nama">Nama</label>
                          <input type="text" name="Nama" class="form-control" placeholder="wajib diisi . . .">
                        </div>
                        <div class="form-group">
                          <label for="AsalSekolah">Asal Sekolah</label>
                          <input type="text" name="AsalSekolah" class="form-control" placeholder="wajib diisi . . .">
                        </div>
                        `+kelas+`
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="NoHp">No. Handphone</label>
                          <input type="text" name="NoHp" class="form-control" placeholder="wajib diisi . . .">
                        </div>
                        <div class="form-group">
                          <label for="Email">Email</label>
                          <input type="email" name="Email" class="form-control" placeholder="wajib diisi . . .">
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
                    if(catid != 111) {
                      $('#divsk').css('display','block');
                      $('#jmlmapel').text(totalmapel);
                    }

                          
                      var stagecat = $('#stagecat').val();

                      for (i = 1; i < jmlsesi+1; ++i) {
                        var $tr = $("<tr>").append(
                            $('<td style="text-align:left;">').text('Pertemuan '+i),
                            $('<td style="text-align:center;">').html(`<select id="mapel`+i+`" class="form-control">
                                <option value="">- - - Pilih Mapel - - -</option>
                              </select>`),
                            $('<td style="text-align:right;">').html(`<button class="btn btn-dark btn-sm btnbg" onClick="jadwal();" name="btnmapel" disabled='disabled'>Jadwal Tersedia</button>`),
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

function jadwal() {
  var title = 'Pusing Jadwal Bingung Au Ah Lieur';
    $('#myModal').modal({
        show: true,
        backdrop: 'static',
        keyboard: false
    });
    $('.modal-title').text(title);
}

/*function get_packdetail() {
  $.ajax({
      url: base_url+"course/get_packdetail",
      type: "POST",
      data: ({id:window.btoa($('#packid').val())}),
      dataType: 'JSON',
      beforeSend: function(){
          $("#ajax-loader").show();
      },
      complete: function() {
          $("#ajax-loader").hide();
      },
      success:function(data){
        var $tr = $("<tr>").append(
           $('<td colspan="2" style="text-align:center;">').text('- - Belum Pilih Mata Pelajaran - -'),
        ).appendTo('#dt_ordertmp');
        $.each(data.rows, function(i, item) {
            var $tr = $("<tr>").append(
                $('<td style="text-align:left;">').text(item.SubName),
                $('<td style="text-align:center;">').html(`<button class="btn btn-dark btn-sm btnbg" onClick="jadwal();" name="btnmapel[`+item.RecID+`]" disabled='disabled'>Jadwal Tersedia</button>`),
            ).appendTo('#dt_mapel');
            $(document.getElementsByName('idmapel['+item.RecID+']')).click(function(){
              if($(this).prop("checked") == true){
                  $(document.getElementsByName('btnmapel['+item.RecID+']')).removeAttr('disabled');
                  add_mapel(item.RecID);
              }
              else if($(this).prop("checked") == false){
                  del_mapel(item.RecID);
                  $(document.getElementsByName('btnmapel['+item.RecID+']')).attr('disabled', true); //disable input
              }
            });
        });
      }
  });
}*/

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
</script>

<style type="text/css">
  /* The container */
.labelcheck {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.labelcheck input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.labelcheck:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.labelcheck input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.labelcheck input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.labelcheck .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

/* The container */
.labelradio {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.labelradio input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmarkradio {
  position: absolute;
  top: 0;
  right: 40%;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.labelradio:hover input ~ .checkmarkradio {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.labelradio input:checked ~ .checkmarkradio {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmarkradio:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.labelradio input:checked ~ .checkmarkradio:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.labelradio .checkmarkradio:after {
  top: 9px;
  left: 9px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
}
</style>