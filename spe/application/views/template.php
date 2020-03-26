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
	<title><?php echo (isset($title) && !empty($title))?$title:'PrimaEdu'; ?></title>
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
				<a style="padding-top: 17px" class="navbar-brand" href="javascript:void(0)" title="Koneksi Internet">
					<i style="font-size: 18px;color:#FFFFFF" id="connection_status" class="fa fa-refresh fa-spin" aria-hidden="true"></i>
				</a>
				<div id="sideNav" href="javascript:void(0)">
					<i class="fa fa-bars icon"></i> 
				</div>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li style="padding-left:25px;color:#FFFFFF;padding-top: 17px;"><p><?php echo !empty($this->sidebar_menu->sess())?$this->sidebar_menu->sess():null; ?></p></li>
				</ul>
				
				<?php $this->sidebar_menu->getMenu(); ?>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown messages-menu">
						<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell"></i>
							<span class="label label-info" id="count_msg">0</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header" id="notif_msg" style="margin: unset;padding: 5px;">You have 0 messages</li>
							<div class="data_notify"></div>
							<li class="footer"><a href="javascript:void(0)"></a></li>
						</ul>
					</li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sign-out fa-fw"></i></a>
					  <ul class="dropdown-menu">
							<li><a href="<?php echo base_url(); ?>master/profile">Profile</a></li>
							<li><a href="<?php echo base_url(); ?>master/logout">Logout</a></li>
					  </ul>
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div id="page-wrapper">
		<div class="header">
			<ol class="breadcrumb">
				<li><a href="javascript:void(0)">Home</a></li>
				<?php echo (isset($breadcrumb_1) && !empty($breadcrumb_1))?'<li>'.$breadcrumb_1.'':null; ?>
				<?php echo (isset($breadcrumb_2) && !empty($breadcrumb_2))?'<li>'.$breadcrumb_2.'':null; ?>
				<?php echo (isset($breadcrumb_3) && !empty($breadcrumb_3))?'<li>'.$breadcrumb_3.'':null; ?>
			</ol> 
		</div>
		
		<div id="page-inner">
			<!-- /. ROW  -->
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="panel">
						<div class="panel-body">
							<?php echo $contents; ?>
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
	
	<div class="modal fade" id="welcomeToWebApp" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button id="button_close1" style="display: none;float: right;" type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body form">
					<h1 id="kontenWebApp"></h1>
				</div>
				<div class="modal-footer">
					<button id="button_close2" style="display: none;float: right;" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<script type="text/javascript">      	
$(document).ready(function() {
	intervalonline();
    $.ajax({
        url : base_url+"master/checknotif",
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            if (data.rows[0].Waiting > 0) {
				intervalnotif();
            } else {

            }

        }
    });
});
</script>
</body>
</html>