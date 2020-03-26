<div id="element"></div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/jquery.timeline/jquery.timeline.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery.timeline/jquery.timeline.js"></script>
<script type="text/javascript">
$(function() {
	$.ajax({
		url: base_url+"master/tracking",
		type: "GET",
		data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"action":window.btoa(1)}),
		dataType: 'JSON',
		success:function(response){
			$("#element").timeline({
				data: response.results
			});
		}
	});
});
</script>