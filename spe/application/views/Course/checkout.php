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

      .btn {
        background-image: url('<?php echo base_url(); ?>assets/images/img/btn.jpg');
      }

      .judul {
        background-image: url('<?php echo base_url(); ?>assets/images/img/bg.jpg');
      }
      .fa-vertical-bar-medium:after {
        content: "\007C" };
    </style>
    <title>Primagama</title>
  </head>
  <body class="mt-5">
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary" style="background-image: url('<?php echo base_url(); ?>assets/images/img/nav.jpg')">
    <div class="container">
      <a class="navbar-brand" href="javascript:void(0)">Primagama - Terdepan Dalam Prestasi</a>
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
            <div class="card mt-5">
              <div class="card-header judul">
                <h4 class="pt-2">
                  Form Pembelian Paket <!-- <o class="fa fa-vertical-bar-medium"></o> Silahkan Isi Form Berikut :  -->
                </h4>
              </div>
              <div class="card-body">
                <div class="row mt-4">
                  <div class="col">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="text-center">
                          <th scope="col">#</th>
                          <th scope="col">Paket</th>
                          <th scope="col">Mapel</th>
                          <th scope="col">Jumlah Siswa</th>
                          <th scope="col">Harga</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Privat One On One - SD</td>
                          <td>Tematik</td>
                          <td class="text-center">1</td>
                          <td class="text-right">Rp. 500.000,00</td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th scope="row" colspan="4">Total Harga</th>
                          <th class="text-right">Rp. 500.000,00</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="table-responsive mb-4 mt-4">
                    <table class="table table-bordered">
                      <thead class="judul">
                        <tr>
                          <th colspan="9" scope="col">Jadwal Tersedia</th>
                        </tr>
                      </thead>
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
                            <div class="radio radio-primary radio-inline">
                              <input type="radio" id="pilih1" name="pilih" value="1">
                              <label for="pilih1"></label>
                            </div>
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
                            <div class="radio radio-primary radio-inline">
                              <input type="radio" id="pilih2" name="pilih" value="2">
                              <label for="pilih2"></label>
                            </div>
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
                            <div class="radio radio-primary radio-inline">
                              <input type="radio" id="pilih3" name="pilih" value="3">
                              <label for="pilih3"></label>
                            </div>
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
                </div>
                
                <div class="card">
                  <div class="card-header judul">
                      <b>Form Data Siswa </b> 
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="Nama">Nama</label>
                          <input type="text" name="Nama" class="form-control" placeholder="Isi Nama disini . . .">
                        </div>
                        <div class="form-group">
                          <label for="AsalSekolah">Asal Sekolah</label>
                          <input type="text" name="AsalSekolah" class="form-control" placeholder="Isi Asal Sekolah . . .">
                        </div>
                        <div class="form-group">
                          <label for="Kelas">Kelas</label>
                          <select id="Kelas" class="form-control">
                            <option value="">- - - Pilih Kelas - - -</option>
                            <option value="1"> 3 SD </option>
                            <option value="1"> 4 SD </option>
                            <option value="1"> 5 SD </option>
                            <option value="1"> 6 SD </option><!-- 
                            <option value="1"> 7 SMP </option>
                            <option value="1"> 8 SMP </option>
                            <option value="1"> 9 SMP </option>
                            <option value="1"> 10 SMA IPA </option>
                            <option value="1"> 10 SMA IPS </option>
                            <option value="1"> 11 SMA IPA </option>
                            <option value="1"> 11 SMA IPS </option>
                            <option value="1"> 12 SMA IPA </option>
                            <option value="1"> 12 SMA IPS </option> -->
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="NoHp">No. Handphone</label>
                          <input type="text" name="NoHp" class="form-control" placeholder="Isi No. Handphone . . .">
                        </div>
                        <div class="form-group">
                          <label for="Email">Email</label>
                          <input type="email" name="Email" class="form-control" placeholder="Isi Email . . .">
                        </div>
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

    <footer class="bg-primary text-white" style="background-image: url('<?php echo base_url(); ?>assets/images/img/nav.jpg')">
      <div class="container">
        <div class="row text-center pt-3">
          <div class="col">
            <p>Copyright &copy; 2020. PRIMAGAMA</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
<script type="text/javascript">
    window.base_url = <?php echo json_encode(base_url()); ?>;
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