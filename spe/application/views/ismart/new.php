<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="" name="description" />
    <meta content="Primagama" name="Hamzah" />
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>">
    <title><?php echo (isset($title) && !empty($title))?$title:'Form iSmart'; ?></title>
    <!-- Bootstrap Styles-->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <!-- Custom Styles-->
    <link href="<?php echo base_url(); ?>assets/css/custom-styles.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='<?php echo base_url(); ?>assets/plugins/fonts-open/fonts-open.css?family=Open+Sans' rel='stylesheet' type='text/css'/>
    <!-- jQuery Js -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <!-- Custom Js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom-scripts.js"></script>
    <!-- Bootstrap Js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- notipy -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/notify/notify.js" type="text/javascript"></script>
    <!-- base url -->
    <script type="text/javascript">
        window.base_url = <?php echo json_encode(base_url()); ?>;
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics app.primagama.co.id-->
    <script async src="//www.googletagmanager.com/gtag/js?id=UA-148088236-4"></script>
    <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-148088236-4');</script>
    <div class="loader"></div>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div id="wrapper">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <img style="margin-top: -5px;" class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_new_putih_web.png" alt="logo-primagama"/>
                </a>
                <div id="sideNav" href="javascript:void(0)">
                    <i class="fa fa-bars icon"></i>
                </div>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li style="padding-left:25px;color:#FFFFFF;padding-top: 17px;"><p>Form Data Instruktur Smart</p></li>
                </ul>

            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div id="page-wrapper" style="margin-left: 0px;">

        <div id="page-inner" style="padding-top: 0px">
            <!-- /. ROW  -->
            <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="panel">
                          <div class="panel-body">

                              <form action="#" id="form" class="form-horizontal">
                                  <div class="row">
                                      <div class="col-lg-12">
                                          <div class="form-group">
                                              <div class="col-lg-12">
                                              <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-file">  Form Isian Data Instruktur Smart</i></p>
                                              <legend></legend>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-4">
                                          <div class="form-group">
                                              <label class="col-md-4">Nama Lengkap</label>
                                              <div class="col-lg-8">
                                                  <input type="text" id="Name" name="Name" class="form-control" placeholder="Isi Sesuai KTP Anda">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Nomor KTP</label>
                                              <div class="col-lg-8">
                                                  <input type="text" id="NoKTP" name="NoKTP" class="form-control" placeholder="Wajib di isi Sesuai KTP">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Email</label>
                                              <div class="col-lg-8">
                                                  <input type="text" id="Email" name="Email" class="form-control" placeholder="Wajib di isi">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Nomor Telepon</label>
                                              <div class="col-lg-8">
                                                  <input type="text" id="Telepon" name="Telepon" class="form-control" placeholder="Wajib di isi">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Pekerjaan</label>
                                              <div class="col-lg-8">
                                                  <input type="text" id="Pekerjaan" name="Pekerjaan" class="form-control" placeholder="Wajib Di Isi">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Alamat</label>
                                              <div class="col-lg-8">
                                                  <textarea class="form-control" id="Alamat" name="Alamat" placeholder="Wajib Di Isi"></textarea>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-lg-4">
                                          <div class="form-group">
                                              <label class="col-md-4">Tipe iSmart</label>
                                              <div class="col-lg-8">
                                                  <select class="form-control" id="TipeiSmart" name="TipeiSmart">
                                                      <option value="">- - - Pilih Tipe iSmart - - -</option>
                                                      <option value="ITBM/ISH">iSmart Tidak Berikat Manajemen(ITBM) / iSmart Honorer(ISH)</option>
                                                      <option value="IBM/ISB">iSmart Berikat Manajemen(IBM) / iSmart Berikat(ISB)</option>
                                                      <option value="Staff Cabang">Staff Cabang</option>

                                                  </select>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Area</label>
                                              <div class="col-lg-8">
                                                  <select class="form-control" id="Area" name="Area">
                                                      <option value="">- - - Pilih Area - - -</option>
                                                      <option value="">Test 1</option>
                                                      <option value="">Test 2</option>
                                                      <option value="">Test 3</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Cabang</label>
                                              <div class="col-lg-8">
                                                  <select class="form-control" id="Cabang" name="Cabang">
                                                      <option value="">- - - Pilih Cabang - - -</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Pendidikan Terakhir</label>
                                              <div class="col-lg-8">
                                                  <select class="form-control" id="Pendidikan" name="Pendidikan">
                                                      <option value="">- - - Pilih Pendidikan Terakhir - - -</option>
                                                      <option value="SMA">SMA</option>
                                                      <option value="S1">S1</option>
                                                      <option value="S2">S2</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Bidang Studi</label>
                                              <div class="col-lg-8">
                                                  <select class="form-control" id="BidangStudi" name="BidangStudi">
                                                      <option value="">- - - Pilih Bidang Studi - - -</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Jurusan</label>
                                              <div class="col-lg-8">
                                                  <input type="text" id="Jurusan" name="Jurusan" class="form-control" placeholder="Wajib di isi">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-lg-4">
                                          <div class="form-group">
                                              <label class="col-md-4">Upload KTP</label>
                                              <div class="col-lg-8">
                                                  <input type="file" id="KTP" name="KTP" class="form-control" placeholder="Input nama siswa">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Upload Ijazah</label>
                                              <div class="col-lg-8">
                                                  <input type="file" id="Ijazah" name="Ijazah" class="form-control" placeholder="Upload Ijazah">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Upload Sertifikat</label>
                                              <div class="col-lg-8">
                                                  <input type="file" id="Sertifikat" name="Sertifikat" class="form-control" placeholder="Input nama siswa">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-4">Bidang Studi Tambahan</label>
                                              <div class="col-lg-8">
                                                  <textarea rows="3" class="form-control" id="BidangStudi2" name="BidangStudi2" placeholder="Isi jika Anda memiliki lebih dari 1 Bidang Studi. (Cth : Matematika, Fisika, dll)"></textarea>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <legend></legend>
                                        <button type="button" id="btnsave" class="btn btn-primary" onclick="save_data()">Simpan</button>
                                    </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
            </div> <!-- END CONTAINER -->

        </div>

        <div class="footer">
            &copy; <?php echo date('Y'); ?> Copyright:
            <a href="www.primagama.co.id"> www.primagama.co.id </a>
        </div>
    </div>


<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<script src="<?= base_url('assets/js/ismart/iSmart.js') ?>" charset="utf-8"></script>


</body>
</html>
