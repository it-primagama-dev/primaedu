<form action="#" id="form" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-exclamation-circle"> Barcode Bermasalah</i></p>
        	<legend></legend> 
            </div>
        </div>
    </div>
</div>
<div class="row" id="table">
    <div class="col-lg-12">
			<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
				<thead>
					<tr>
						<th style="width: 5px;text-align: center;">No.</th>
						<th style="width: 80px;text-align: center;">Barcode 1</th>
						<th style="width: 80px;text-align: center;">Barcode 2</th>
						<th style="width: 80px;text-align: center;">Aksi</th>
						<th style="width: 80px;text-align: center;">Keterangan</th>
					</tr>
				</thead>
			</table> 
	</div>
</div>
</form>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<!-- <script type="text/javascript" src="<?php echo base_url()?>assets/js/jQueryBarcode.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<script type="text/javascript">
$(document).ready(function(){
    get_data();
});
var jQueryTable;
function get_data(){
    jQueryTable = $("#tableMenu").DataTable({
        "ajax": {
            "url":base_url + "Barcode/find_bctrouble",
            "type":"GET",
            //"data":""
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","width":"5px"},
            {"data":"Barcode1","autoWidth":true},
            {"data":"Barcode2","autoWidth":true},
            {"data":"Action","autoWidth":true},
            {"data":"Description","autoWidth":true}
        ],
  		"columnDefs":[
  		{
			"targets": [0,1,2],
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).css({'text-align':'center'});
			}
		}],
        "aLengthMenu": [[1000, 5000, 10000, -1], [1000, 5000, 10000, "All"]],
        'iDisplayLength': 10000,
        "order": [[ 0, "asc" ]],
        "pagingType": "full_numbers",
        dom: "<'row'<'col-lg-2 col-xs-12'l><'col-lg-8 col-xs-12'f><'col-lg-2 col-sm-12'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-lg-5 col-sm-12'i><'col-lg-7 col-sm-12'p>>",
		buttons: [
		{
			extend: 'excel',
			text: '<button type="button" class="btn btn-info pull-right"><span class="glyphicon glyphicon-download"></span> Download Excel</button>',
			className: 'exportExcel',
			filename: 'Barcode Bermasalah',
			exportOptions: {
				modifier: {
					page: 'all'
				}
			}
		}]
    });	
}
</script>