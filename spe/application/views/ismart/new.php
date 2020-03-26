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
					<li style="padding-left:25px;color:#FFFFFF;padding-top: 17px;"><p>Form Data Tentor / iSmart / IBM</p></li>
				</ul>

			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div id="page-wrapper" style="margin-left: 0px;">
		
		<div id="page-inner" style="padding-top: 0px">
			<!-- /. ROW  -->
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="panel">
						<div class="panel-body">

							<form action="#" id="form" class="form-horizontal">
							    <div class="row">
							        <div class="col-lg-12">
							            <div class="form-group">
							                <div class="col-lg-12">
							                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-file">  Form Isian Data Tentor / iSmart / IBM</i></p>
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
								                    <option value="iSmart">iSmart</option>
								                    <option value="IBM">IBM</option>
								                    <option value="Staf Akademik Cabang">Staf Akademik Cabang</option>
								                    <option value="Writer">Writer</option>
								                    <option value="Editor">Editor</option>
								                    <option value="PML">PML</option>

								                </select>
								            </div>
							            </div>
							            <div class="form-group">
							                <label class="col-md-4">Area</label>
								            <div class="col-lg-8">
								                <select class="form-control" id="Area" name="Area">
								                    <option value="">- - - Pilih Area - - -</option>
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
							          <button type="button" id="btnsave" class="btn btn-primary" onclick="save()">Simpan</button>
							      </div>
							    </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer">
			&copy; <?php echo date('Y'); ?> Copyright:
			<a href="www.primagama.co.id"> www.primagama.co.id </a>
		</div>
	</div>
	

<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">

<script type="text/javascript">    

	$('document').ready(function(){
		get_area();
		get_BidangStudi();
	});

	$(function () {
    $('#Area').select2();
    $('#Cabang').select2();
    $('#BidangStudi').select2();
	});

	function get_area() {
		$.getJSON(base_url+"ismart/get_area", function(json){
	    $('#Area').empty();
	    $('#Area').append($('<option>').text("- - Pilih Area - -").attr('value',''));
	    //$('#Cabang').append($('<option>').text("- - Pilih Cabang - -").attr('value',''));
	    $.each(json, function(i, obj){
		$('#Area').append($('<option>').text(obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
	    });
	});
	}

	$("#Area").change(function(e) { //1
    var Area = e.target.value; //2
   // alert(Area); 
	$.getJSON(base_url+"ismart/get_cabang/"+Area, function(json){ //3
	    $('#Cabang').empty();
	    $('#Cabang').append($('<option>').text("- - Pilih Cabang - -").attr('value',''));
	    /*$('#PR').append($('<option>').text("Barcode Lama"));*/
	    $.each(json, function(i, obj){
		$('#Cabang').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
	    });
	});
	});

	function get_BidangStudi() {
		$.getJSON(base_url+"ismart/get_BidangStudi", function(json){
	    $('#BidangStudi').empty();
	    $('#BidangStudi').append($('<option>').text("- - Pilih Bidang Studi - -").attr('value',''));
	    //$('#Cabang').append($('<option>').text("- - Pilih Cabang - -").attr('value',''));
	    $.each(json, function(i, obj){
		$('#BidangStudi').append($('<option>').text(obj.NamaBidangStudi).attr('value', obj.KodeBidangStudi));
	    });
	});
	}

var userfile = {
    Ijazah:{},
    Sertifikat:{},
    KTP:{},
};

$("document").ready(function() {
    $("input[type=file]").change(function(e) {
        if (e) {
            var vm = this;
            index = e.currentTarget.id;
            vm.invalidFile = false;
            let files = e.target.files || e.dataTransfer.files;
            
            vm.myFile = files[0];
            userfile[index].name = files[0].name;
            userfile[index].type = files[0].type;

            var reader = new FileReader();
            reader.onloadend = function(event) {
                userfile[index].file = event.target.result;
                
            };
            reader.readAsDataURL(vm.myFile);
        }
    });
});

	function save() {
		//alert("test");
  	$(".text-danger").remove();
	  if($('[name="Name"]').val() == "") {
	      $('[name="Name"]').after('<p class="text-danger">Wajib diisi !!!</p>');
	      $('[name="Name"]').focus();
	      return false;
	  }
	  if($('[name="NoKTP"]').val() == "") {
	      $('[name="NoKTP"]').after('<p class="text-danger">Wajib diisi !!!</p>');
	      $('[name="NoKTP"]').focus();
	      return false;
	  }
	  if($('[name="Email"]').val() == "") {
	      $('[name="Email"]').after('<p class="text-danger">Wajib diisi !!!</p>');
	      $('[name="Email"]').focus();
	      return false;
	  }
	  if($('[name="Telepon"]').val() == "") {
	      $('[name="Telepon"]').after('<p class="text-danger">Wajib diisi !!!</p>');
	      $('[name="Telepon"]').focus();
	      return false;
	  }
	  if($('[name="Pekerjaan"]').val() == "") {
	      $('[name="Pekerjaan"]').after('<p class="text-danger">Pekerjaan Harus Diisi !!!</p>');
	      $('[name="Pekerjaan"]').focus();
	      return false;
	  }
	  if($('[name="Alamat"]').val() == "") {
	      $('[name="Alamat"]').after('<p class="text-danger">Alamat Harus Diisi !!!</p>');
	      $('[name="Alamat"]').focus();
	      return false;
	  }
	  if($('[name="TipeiSmart"]').val() == "") {
	      $('[name="TipeiSmart"]').after('<p class="text-danger">Pilih Tipe iSmart !!!</p>');
	      $('[name="TipeiSmart"]').focus();
	      return false;
	  }
	  if($('[name="Area"]').val() == "") {
	      $('[name="Area"]').after('<p class="text-danger">Pilih Area !!!</p>');
	      $('[name="Area"]').focus();
	      return false;
	  }
	  if($('[name="Cabang"]').val() == "") {
	      $('[name="Cabang"]').after('<p class="text-danger">Pilih Cabang !!!</p>');
	      $('[name="Cabang"]').focus();
	      return false;
	  }
	  if($('[name="Pendidikan"]').val() == "") {
	      $('[name="Pendidikan"]').after('<p class="text-danger">Pilih Pendidikan Terakhir !!!</p>');
	      $('[name="Pendidikan"]').focus();
	      return false;
	  }	 
	  if($('[name="BidangStudi"]').val() == "") {
	      $('[name="BidangStudi"]').after('<p class="text-danger">Pilih Bidang Studi !!!</p>');
	      $('[name="BidangStudi"]').focus();
	      return false;
	  }
	  if($('[name="Jurusan"]').val() == "") {
	      $('[name="Jurusan"]').after('<p class="text-danger">Wajib diisi !!!</p>');
	      $('[name="Jurusan"]').focus();
	      return false;
	  }

	   if($('[name="Ijazah"]').val() == "") {
	      $('[name="Ijazah"]').after('<p class="text-danger">Wajib diisi !!!</p>');
	      $('[name="Ijazah"]').focus();
	      return false;
	  }	 
	   if($('[name="Sertifikat"]').val() == "") {
	      $('[name="Sertifikat"]').after('<p class="text-danger">Wajib diisi !!!</p>');
	      $('[name="Sertifikat"]').focus();
	      return false;
	  }
	  if($('[name="KTP"]').val() == "") {
	      $('[name="KTP"]').after('<p class="text-danger">Wajib diisi !!!</p>');
	      $('[name="KTP"]').focus();
	      return false;
	  }

	  if (confirm("Anda yakin data sudah terinput dengan benar ?")) {
	
	  var formdata = {};
	  formdata['Name'] = $('#Name').val();
	  formdata['NoKTP'] = $('#NoKTP').val();
	  formdata['TipeiSmart'] = $('#TipeiSmart').val();
	  formdata['Area'] = $('#Area').val();
	  formdata['Cabang'] = $('#Cabang').val();
	  formdata['BidangStudi'] = $('#BidangStudi').val();
	  formdata['BidangStudi2'] = $('#BidangStudi2').val();
	  formdata['Alamat'] = $('#Alamat').val();
	  formdata['Email'] = $('#Email').val();
	  formdata['Pendidikan'] = $('#Pendidikan').val();
	  formdata['Pekerjaan'] = $('#Pekerjaan').val();
	  formdata['Ijazah'] = $('#Ijazah').val();
	  formdata['Telepon'] = $('#Telepon').val();
	  formdata['Jurusan'] = $('#Jurusan').val();
	  formdata['Sertifikat'] = $('#Sertifikat').val();
	  formdata['ScanKTP'] = $('#KTP').val();

        if(userfile.Ijazah.file) {
            formdata['IjazahMime'] = userfile.Ijazah.type;
            formdata['IjazahFile'] = userfile.Ijazah.file;
        }

        if(userfile.Sertifikat.file) {
            formdata['SertifikatMime'] = userfile.Sertifikat.type;
            formdata['SertifikatFile'] = userfile.Sertifikat.file;
        }
        if(userfile.KTP.file) {
            formdata['KTPMime'] = userfile.KTP.type;
            formdata['KTPFile'] = userfile.KTP.file;
        }
        //test = formdata['IjazahFile'];
        //test = formdata['SertifikatFile'];
        //alert(test);
	      $.ajax({
	          url : base_url+"ismart/save_addiSmart",
	          type: "POST",
	          data: formdata,
	          dataType: "JSON",
	          beforeSend: function(){
	              $("#ajax-loader").show();
	          },
	          complete: function() {
	              $("#ajax-loader").hide();
	          },
	          success: function(data)
	          {
	          		$('#form')[0].reset();
	            	$.notify(data.message,data.notify);
	           
	          }
	    })
	  }


	}
</script>
</body>
</html>