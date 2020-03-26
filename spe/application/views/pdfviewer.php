<html>
<head>
<title>gDocsViewer Demo</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.gdocsviewer.min.js"></script> 
<script type="text/javascript"> 
/*<![CDATA[*/
$(document).ready(function() {
	$('a.embed').gdocsViewer();
});
/*]]>*/
</script> 
</head>
<body style="background:#999; font-family:arial, helvetica, sans-serif; font-size:14px;">
<div style="background:#fff; width:960px; margin:0 auto; padding:20px;">
	<div>
		<a href="<?php echo base_url(); ?>assets/juknis-cabang.docx" class="embed" id="test">PDF at mozdev.org</a>
	</div>
</div>
</body>
</html>