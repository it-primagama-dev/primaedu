<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="" name="description" />
    <meta content="Primagama" name="Hamzah" />
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>">
    <title><?php echo (isset($title) && !empty($title)) ? $title : 'Form iSmart'; ?></title>
    <!-- Bootstrap Styles-->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="<?php echo base_url(); ?>assets/css/custom-styles.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='<?php echo base_url(); ?>assets/plugins/fonts-open/fonts-open.css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-148088236-4');
    </script>
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
                    <img style="margin-top: -5px;" class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo_new_putih_web.png" alt="logo-primagama" />
                </a>
                <div id="sideNav" href="javascript:void(0)">
                    <i class="fa fa-bars icon"></i>
                </div>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li style="padding-left:25px;color:#FFFFFF;padding-top: 17px;">
                        <p>Form Data Akademik Cabang</p>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->
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
                                                    <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-file"> Form Isian Data Tim Akademik Cabang</i></p>
                                                    <legend></legend>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <section id="PRIBADI" class="PRIBADI">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-file"> DATA PRIBADI</i></p>
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
                                                        <input type="text" id="Pekerjaan" name="Pekerjaan" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="col-md-4">Pendidikan Terakhir</label>
                                                    <div class="col-lg-8">
                                                        <select class="form-control" id="Pendidikan" name="Pendidikan">
                                                            <option value="">- - - Pilih Pendidikan Terakhir - - -</option>
                                                            <option value="SMA/SEDERAJAT">SMA/SEDERAJAT</option>
                                                            <option value="DIPLOMA">DIPLOMA</option>
                                                            <option value="S1">S1</option>
                                                            <option value="S2">S2</option>
                                                            <option value="S3">S3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4">Jurusan</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" id="Jurusan" name="Jurusan" class="form-control" placeholder="Wajib di isi">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4">Alamat Tinggal saat ini</label>
                                                    <div class="col-lg-8">
                                                        <textarea class="form-control" id="Alamat" name="Alamat" placeholder="Wajib Di isi"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4">Upload Foto</label>
                                                    <div class="col-lg-8">
                                                        <input type="file" id="Foto" name="Foto" class="form-control" placeholder="Input nama siswa">
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
                                                    <label class="col-md-4">Upload Sertifikat(2)</label>
                                                    <div class="col-lg-8">
                                                        <input type="file" id="Sertifikatt" name="Sertifikatt" class="form-control" placeholder="Input nama siswa"> <font color="red" style="font-size: 10px;">*Upload apabila memiliki lebih dari 1 sertifikat</font>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4">Upload Sertifikat(3)</label>
                                                    <div class="col-lg-8">
                                                        <input type="file" id="Sertifikattt" name="Sertifikattt" class="form-control" placeholder="Input nama siswa">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section id="KETERAMPILAN" class="KETERAMPILAN">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-file"> KETERAMPILAN</i></p>
                                                        <legend></legend>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="col-md-4">Posisi</label>
                                                    <div class="col-lg-8">
                                                        <select class="form-control" id="Posisi" name="Posisi">
                                                            <option value="">- - - Pilih Posisi - - -</option>
                                                            <option value="Akademik">Staf Akademik Cabang</option>
                                                            <option value="IBM/ISB">I-Smart Berikat Manajemen</option>
                                                            <option value="Honorer">I-Smart Honorer</option>
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
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="col-md-4">Bidang Studi (1)</label>
                                                    <div class="col-lg-8">
                                                        <select class="form-control" id="BidangStudi" name="BidangStudi">
                                                            <option value="">- - - Pilih Bidang Studi - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4">Bab Paling Dikuasai (1)</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" id="subject1" name="subject1" class="form-control" placeholder="Wajib di isi">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4">Bidang Studi (2)</label>
                                                    <div class="col-lg-8">
                                                        <select class="form-control" id="BidangStudi2" name="BidangStudi2">
                                                            <option value="">- - - Pilih Bidang Studi - - -</option>
                                                        </select> <font color="red" style="font-size: 10px;">*Isi jika anda memiliki lebih dari 1 Mata Pelajaran</font>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4">Bab Paling Dikuasai (2)</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" id="subject2" name="subject2" class="form-control" placeholder="Wajib di isi">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="col-md-4">Bidang Studi (3)</label>
                                                    <div class="col-lg-8">
                                                        <select class="form-control" id="BidangStudi3" name="BidangStudi3">
                                                            <option value="">- - - Pilih Bidang Studi - - -</option>
                                                        </select> <font color="red" style="font-size: 10px;">*Isi jika anda memiliki lebih dari 2 Mata Pelajaran</font>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4">Bab Paling Dikuasai (3)</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" id="subject3" name="subject3" class="form-control" placeholder="Wajib di isi">
                                                    </div>
                                                </div>
                                              </div>
                                        </div>
                                    </section>
                                    <section id="BANK" class="BANK">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-file"> DATA BANK</i></p>
                                                        <legend></legend>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="col-md-4">Nama Sesuai Rekening</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" id="NamaRek" name="NamaRek" class="form-control" placeholder="Isi Sesuai Rekening Anda">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4">Nomor Rekening BCA</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" id="NoRek" name="NoRek" class="form-control" placeholder="Wajib di isi">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4">Cabang BCA</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" id="CabangRek" name="CabangRek" class="form-control" placeholder="Wajib di isi">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="col-md-4">Nomor NPWP</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" id="NoNPWP" name="NoNPWP" class="form-control" placeholder="Wajib di isi">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4">Nomor Surat Perjanjian Kerja</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" id="NSPK" name="NSPK" class="form-control" placeholder="Wajib di isi">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4">Alamat Sesuai KTP</label>
                                                    <div class="col-lg-8">
                                                        <textarea class="form-control" id="AlamatKTP" name="AlamatKTP" placeholder="Wajib Di Isi"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
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


    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/js/css/select2.custom.min.css">
    <script src="<?= base_url('assets/js/ismart/iSmart.js') ?>" charset="utf-8"></script>


</body>

</html>