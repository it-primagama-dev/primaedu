<form action="#" id="form" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-6">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-barcode"> Barcode Pusat</i></p>
        	<legend></legend>
            </div>
            <div class="col-lg-6" style="text-align: right;">
            <p><a href="javascript:void(0)" class="btn btn-warning" id="btnbc"><i class="fa fa-file"> Data Barcode Pusat</i></a></p>
        	<legend></legend>
            </div>
        </div>
    </div>
</div>
</form>
<div class="row" style="padding-bottom: 15px;">
	<form method="post" id="import_form" enctype="multipart/form-data">
		<div class="form-group">
	        <div class="col-md-4 col-xs-12">
	            <input type="file" name="file" id="file" class="form-control">
	        </div>
	    </div>
		<div class="form-group">
	        <div class="col-md-5 col-xs-12">
	            <button style="border-radius: 0px;" type="submit" name="preview" id="preview" class="btn btn-primary col-xs-12 col-md-4"><span class="glyphicon glyphicon-search"></span> Preview</button>
	            <a href="<?php echo base_url()?>assets/AppFile/formatExcelBarcode.xlsx" style="border-radius: 0px;" name="formatExcel" id="formatExcel" class="btn btn-primary col-xs-12 col-md-7"><span class="glyphicon glyphicon-export"></span> Download Format Excel</a>
	        </div>
	    </div>
	</form>
</div>

<div class="nav-tabs-custom">
	<ul class="nav nav-tabs" id="myTab">
		<li class="active"><a href="#tabs1" data-toggle="tab">Import Barcode</a></li>
		<li><a href="#tabs2" data-toggle="tab">Preview per-item</a></li>
	</ul>
	<div class="tab-content">
		<div class="active tab-pane" id="tabs1">
			<form method="post" action="javascript:void(0)">
				<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
					<thead>
						<tr>
							<th style="width: 5px;text-align: center;">No.</th>
							<th style="width: 80px;text-align: center;">Barcode</th>
							<th style="width: 80px;text-align: center;">Kode Item</th>
							<th style="width: 80px;text-align: center;">Sudah Ada</th>
							<th style="width: 80px;text-align: center;">Double di Excel</th>
							<th style="width: 80px;text-align: center;">Format tidak valid</th>
						</tr>
					</thead>
				</table>
				<button type="submit" name="import" onclick="save();" class="btn btn-default">Import</button>
				<button type="button" class="btn btn-danger" onclick="resetBarcode()">Reset</button>
			</form>
		</div><!-- /.tab-pane -->
		<div class="tab-pane" id="tabs2"><!-- /.tab-pane -->
			<form method="post" action="javascript:void(0)" id="form2">
				<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="table2">
					<thead>
						<tr>
							<th style="width: 5px;text-align: center;">No.</th>
							<th style="width: 80px;text-align: center;">Kode Item</th>
							<th style="width: 80px;text-align: center;">Jumlah Barcode</th>
						</tr>
					</thead>
				</table>
			</form>
		</div><!-- /.tab-pane -->
	</div>
</div>

<div class="modal fade" id="infoUpload" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><!-- 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <h3 class="modal-title">Data yang berhasil diimport sbb.</h3>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="table3">
					<thead>
						<tr>
							<th style="width: 5px;text-align: center;">No.</th>
							<th style="width: 80px;text-align: center;">Kode Item</th>
							<th style="width: 80px;text-align: center;">Jumlah Barcode</th>
							<th style="width: 80px;text-align: center;">Tanggal</th>
						</tr>
					</thead>
				</table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnmodal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<!-- <script type="text/javascript" src="<?php echo base_url()?>assets/js/jQueryBarcode.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script type="text/javascript">
$("#btnbc").click(function(e) {
	window.location.href = base_url + "Barcode/list_bc";
});
$("#btnmodal").click(function(e) {
	window.location.reload();
});
var jQueryTable;
var jQueryTable2;
var jQueryTable3;
$(document).ready(function() {
    jQueryTable = $("#tableMenu").DataTable({
        "ajax": {
            "url":base_url + "import-barcode",
            "type":"GET",
            "data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Kode":window.btoa(0)}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","autoWidth":true},
            {"data":"Barcode","autoWidth":true},
            {"data":"ItemCode","autoWidth":true},
            {"data":"DuplicateDB","autoWidth":true},
            {"data":"DuplicateExcel","autoWidth":true},
            {"data":"NoValid","autoWidth":true},
        ],
  		"columnDefs":[
  		{
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).css({'text-align':'center'});
			}
		},
		{
			"targets": [3,4,5],
			"createdCell": function (td, cellData, rowData, row, col) {
				if (cellData == 'Yes') {
					$(td).css({'background':'red','text-align':'center','color':'white'});
				} else {
					$(td).css({'background':'blue','text-align':'center','color':'white'});
				}
			}
		},
		{
			'targets': 1,
    		'createdCell':  function (td, cellData, rowData, row, col) {
    			$(td).css({'text-align':'center'});
    			if (rowData['DuplicateDB']=='No' && rowData['DuplicateExcel']=='No' && rowData['NoValid']=='No') {
    				$(td).attr('class', 'Barcode');
    			}
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
			filename: 'Preview Barcode Pusat',
			exportOptions: {
				modifier: {
					page: 'all'
				}
			}
		}]
    });

    jQueryTable2 = $("#table2").DataTable({
        "ajax": {
            "url":base_url + "import-barcode",
            "type":"GET",
            "data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Kode":window.btoa(1)}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","autoWidth":true},
            {"data":"ItemCode","autoWidth":true},
            {"data":"jmlBC","autoWidth":true},
        ],
  		"columnDefs":[
  		{
			"targets": [0,2],
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).css({'text-align':'center'});
			}
		}],
        "aLengthMenu": [[1000, 5000, 10000, -1], [1000, 5000, 10000, "All"]],
        'iDisplayLength': 10000,
        "order": [[ 0, "asc" ]],
        "pagingType": "full_numbers"
    });
});

function save() {
	var formdata = {};
	var Barcode = [];
    $(".Barcode").each(function() {
        Barcode.push($(this).text());
    });
    formdata['Barcode'] = Barcode;
    $.ajax({
		url : base_url+'import',
		type: "POST",
		dataType: "JSON",
		data: formdata,
		success: function(response)
		{
			jQueryTable.ajax.reload( null, true);
		    jQueryTable2.ajax.reload( null, true);
		    //window.location.reload();

		   	$('#infoUpload').modal('show');
		    $("#table3").DataTable({
		    	"data": response.data,
		        "columns": [
		            {"data":"RowNum","autoWidth":true},
		            {"data":"ItemCode","autoWidth":true},
		            {"data":"jmlBC","autoWidth":true},
		            {"data":"CreatedDate","autoWidth":true},
		        ],
		  		"columnDefs":[
		  		{
					"targets": [0,2,3],
					"createdCell": function (td, cellData, rowData, row, col) {
						$(td).css({'text-align':'center'});
					}
				}],
		        "aLengthMenu": [[1000, 5000, 10000, -1], [1000, 5000, 10000, "All"]],
		        'iDisplayLength': 10000,
		        "order": [[ 0, "asc" ]],
		        "pagingType": "full_numbers"
		    });
		}
	});
}; 

$(document).ready(function() {
	$('#import_form').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url: base_url+"import-barcode",
			method:"POST",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			dataType: 'JSON',
			success:function(response){
				jQueryTable.ajax.reload( null, true);
				jQueryTable2.ajax.reload( null, true);
				$('#myTab a[href="#tabs1"]').tab('show');
				$.notify(response.message,response.notify);
			}
		})
	});
});

$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});

function resetBarcode() {
$.ajax({
    url: base_url+"import-barcode",
    type: "POST",
    dataType: "JSON",
    data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Kode":window.btoa(2)}),
    success:function(response) {
        $.notify(response.message,response.notify);
        jQueryTable.ajax.reload( null, true);
    }
});
}
</script>