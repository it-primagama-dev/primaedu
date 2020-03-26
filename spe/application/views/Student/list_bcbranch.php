<form action="#" id="form" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-6">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-barcode"> Data Stok Barcode Cabang</i></p>
            </div>
        </div>
        	<legend></legend>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-5">
                <select id="PR" name="PR" class="form-control">
                   <option value=""> - - Pilih PR - TA 2019/2020 - - </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success print-hidden" onclick="get_data()"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
        </div>
        <legend></legend>
    </div>
</div>
<div class="row" id="table">
    <div class="col-lg-12">
			<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
				<thead>
					<tr>
						<th style="width: 5px;text-align: center;">No.</th>
						<th style="width: 80px;text-align: center;">PR</th>
						<th style="width: 80px;text-align: center;">Barcode</th>
						<th style="width: 80px;text-align: center;">Kode Item</th>
						<th style="width: 80px;text-align: center;">Status</th>
						<th style="width: 80px;text-align: center;">Invalid</th>
						<th style="width: 80px;text-align: center;">NoVA</th>
					</tr>
				</thead>
			</table> 
	</div>
</div>
</form>

<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Title</h3>
			</div>
			<div class="modal-body form">
				<form action="javascript:void(0)" id="form" class="form-horizontal">
					<input type="hidden" value="" name="RecID"/>
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Status</label>
								<select name="Invalid" id="Invalid" class="form-control" placeholder="Ubah Status Invalid">
									<option value="">--Pilih Status--</option>
									<option value="1">Invalid</option>
									<option value="0">Valid</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<script type="text/javascript">

$(document).ready(function(){
    get_pr();
    get_data();
});

$(function () {
    $('#PR').select2();
});

function get_pr() {
	$.getJSON(base_url+"Student/get_pr", function(json){
	    $('#PR').empty();
	    $('#PR').append($('<option>').text("- - Pilih PR - TA 2019/2020 - -"));
	    /*$('#PR').append($('<option>').text("Barcode Lama"));*/
	    $('#PR').append($('<option>').text("Barcode Mutasi"));
	    $.each(json, function(i, obj){
		$('#PR').append($('<option>').text(obj.PR_Number).attr('value', obj.PR_Number));
	    });
	});
}

var jQueryTable;
function get_data(){ 
	var PR = $('#PR').val();
	if(PR=='- - Pilih PR - TA 2019/2020 - -'){
		PR='';
	} else {
		PR=PR;
	}
	//alert(Branch)
    $("#tableMenu").DataTable().destroy();
    jQueryTable = $("#tableMenu").DataTable({
        "ajax": {
            "url":base_url + "Student/list_bcbranch",
            "type":"GET",
            "data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Kode":window.btoa(0),PR:PR}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","width":"5px"},
            {"data":"PR_Number","autoWidth":true},
            {"data":"Barcode","autoWidth":true},
            {"data":"ItemCode","width":"20%"},
            {"data":"Status","autoWidth":true},
            {"data":"Invalid","autoWidth":true},
            {"data":"NoVA","width":"12%"}
        ],
  		"columnDefs":[
  		{
			"targets": [0,1,2,6],
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).css({'text-align':'center'});
			}
		},
		{
			"targets": 5,
			"createdCell": function (td, cellData, rowData, row, col) {
				if (cellData == 'Yes') {
					$(td).css({'background':'red','text-align':'center','color':'white'});
				} else {
					$(td).css({'background':'blue','text-align':'center','color':'white'});
				}
			}
		},
		{
			"targets": 4,
			"createdCell": function (td, cellData, rowData, row, col) {
				if (cellData == 'digunakan') {
					$(td).css({'background':'red','text-align':'center','color':'white'});
				} else {
					$(td).css({'background':'blue','text-align':'center','color':'white'});
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
			filename: 'Stok Barcode Cabang',
			exportOptions: {
				modifier: {
					page: 'all'
				}
			}
		}]
    });	
}
</script>