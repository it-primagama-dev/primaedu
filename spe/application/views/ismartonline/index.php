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
    <title>Form iSmart Kelas Online</title>
  </head>
  <body class="mt-5">
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary" style="background-image: url('<?php echo base_url(); ?>assets/images/img/nav.jpg')">
      <div class="container">
        <!-- <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> -->
          <a class="navbar-brand" href="javascript:void(0)">Form iSmart Kelas Online</a>
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

        <div class="row mt-5 mb-3 mt-5 pt-5">
          <div class="col">
            <div class="card mb-4">
                  <div class="card-header text-white judul">
                      <b>Form Data iSmart</b> 
                  </div>
                  <div class="card-body">
                    <div class="row mt-4">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="BranchCode">Cabang</label>
                          <select class="form-control" id="BranchCode">  
                              <option value="">- - - Pilih Cabang - - - </option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="AsalSekolah">Nama iSmart</label>
                          <select class="form-control" id="Name">  
                              <option value="">- - - Pilih Nama iSmart - - - </option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="AsalSekolah">Posisi</label>
                          <select class="form-control" id="Name">  
                              <option value="">- Pilih Posisi - </option>
                              <option value="1">IBM</option>
                              <option value="2">Staff Akademik</option>
                              <option value="3">I-Smart</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="AsalSekolah">Bidang Studi 1</label>
                          <select class="form-control" id="Subject1">  
                              <option value="">- - - Pilih Bidang Studi - - - </option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="AsalSekolah">Bab yang paling dkuasai</label>
                            <input class="form-control" type="text" name="BabSubject1" id="BabSubject1" placeholder="Wajib diisi . . .">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="AsalSekolah">Bidang Studi 2</label>
                          <select class="form-control" id="Subject2">  
                              <option value="">- - - Pilih Bidang Studi - - - </option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="AsalSekolah">Bab yang paling dkuasai</label>
                            <input class="form-control" type="text" name="BabSubject2" id="BabSubject2" placeholder="Wajib diisi . . .">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-4">
                      <div class="col-md">
                          <h5>Kemampuan Menyampaikan Pembelejaran Secara Virtual Melalui Media Zoom/Skype</h5>
                        <table class="table">
                          <thead>
                            <tr>
                              <th colspan="2" style="text-align: left;"><font style="font-size: 16px;"> Tanggap Darurat Kendala Teknis</font></th>
                              <th colspan="2" style="text-align: left;"><font style="font-size: 16px;"> Penyampaian Konten</font></th>
                              <th colspan="2" style="text-align: left;"><font style="font-size: 16px;"> Kesiapan Sinyal</font></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi1" name="opsi1" value="1">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Sangat Tidak Siap</td>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi2" name="opsi2" value="1">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Sangat Tidak Siap</td>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi3" name="opsi3" value="1">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Sangat Tidak Siap</td>
                            </tr>
                            <tr>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi1" name="opsi1" value="2">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Tidak Siap</td>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi2" name="opsi2" value="2">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Tidak Siap</td>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi3" name="opsi3" value="2">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Tidak Siap</td>
                            </tr>
                            <tr>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi1" name="opsi1" value="3">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Cukup Siap</td>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi2" name="opsi2" value="3">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Cukup Siap</td>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi3" name="opsi3" value="3">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Cukup Siap</td>
                            </tr>
                            <tr>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi1" name="opsi1" value="4">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Siap</td>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi2" name="opsi2" value="4">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Siap</td>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi3" name="opsi3" value="4">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Siap</td>
                            </tr>
                            <tr>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi1" name="opsi1" value="5">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Sangat Siap</td>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi2" name="opsi2" value="5">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Sangat Siap</td>
                              <td style="text-align:left;" width="10%"><label class="labelradio">
                                    <input type="radio" id="opsi3" name="opsi3" value="5">
                                    <span class="checkmarkradio"></span> 
                                  </label>
                              </td>
                              <td>Sangat Siap</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <button class="btn btn-dark btnbg">Simpan</button>
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
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
</body>
</html>
<script type="text/javascript">
window.base_url = <?php echo json_encode(base_url()); ?>;

function get_time(time) {
  time2 = time.substring(0,5);
  return time2;
}

function get_hari(date) {

  var today = new Date(date);
  today.setDate(today.getDate());

  var options = {  weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
  return today.toLocaleDateString('id-id', options);
}

function get_tgl(tambah) {

  var today = new Date();
  var now = today.setDate(today.getDate() + tambah);

  var yy = today.getFullYear();
  var m = today.getMonth()+1;
  var d = today.getDate();
  var mm = m < 10 ? '0' + m : m;
  var dd = d < 10 ? '0' + d : d;
  return dd+'-'+mm+'-'+yy;

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

$(document).ready(function(){
    get_cabang();
    get_subject();
});

$(function () {
  $('#BranchCode').select2();
  $('#Name').select2();
  $('#Subject1,#Subject2').select2();
});

function get_cabang() {
    $.getJSON(base_url+"ismartonline/get_cabang", function(json){
        $('#BranchCode').empty();
        $('#BranchCode').append($('<option>').text("- - Pilih Cabang - -").attr('value',''));
        $.each(json, function(i, obj){
        $('#BranchCode').append($('<option>').text(obj.BranchCode+' - '+obj.BranchName).attr('value', obj.BranchCode));
        });
    });
}

$("#BranchCode").change(function(e) { 
  var BranchCode = e.target.value; 

  $.getJSON(base_url+"ismartonline/get_ismart/"+BranchCode, function(json){ 
      $('#Name').empty();
      $('#Name').append($('<option>').text("- - Pilih Nama - -").attr('value',''));
       $.each(json, function(i, obj){
        $('#Name').append($('<option>').text(obj.IsmartName).attr('value', obj.RecID));
       });
  });
});

function get_subject() {
    $.getJSON(base_url+"ismartonline/get_subject", function(json){
        $('#Subject1,#Subject2').empty();
        $('#Subject1,#Subject2').append($('<option>').text("- - Pilih Bidang Studi - -").attr('value',''));
        $.each(json, function(i, obj){
        $('#Subject1,#Subject2').append($('<option>').text(obj.SubName+' - '+obj.StageCat).attr('value', obj.RecID));
        });
    });
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

</style>