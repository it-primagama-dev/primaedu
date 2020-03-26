<div class="row">
	<div class="col-xs-12">
		<div>
			<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
				<thead>
					<tr>
						<th data-sortable="false">No.</th>
						<th>Kode Cabang</th>
						<th>Nama Cabang</th>
						<th>Jenis Buku</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

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
								<label class="control-label">Cabang</label>
								<input type="text" name="Cabang" id="Cabang" class="form-control" placeholder="Controller Name." readonly="readonly" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Status</label>
								<select name="Status" id="Status" class="form-control" placeholder="Status">
									<option value="">Pilih Status</option>
									<option value="0">Tidak Aktif</option>
									<option value="1">AKtif</option>
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

<div class="modal fade" id="myModal2" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Title</h3>
			</div>
			<div class="modal-body">
				<form action="#" id="form" class="form-horizontal">
				<div class="row">
				    <div class="col-lg-12">
				        <div class="form-group">
				            <div class="col-lg-12">
				                <select id="BranchCode" name="BranchCode" class="form-control" style="width: 100%;">
				                   <option value=""> - - Pilih Cabang - - </option>
				                </select>
				            </div>
				        </div>
				        <div class="form-group">
				            <div class="col-lg-12">
				                <select id="Category" name="Category" class="form-control" style="width: 100%;">
				                   <option value=""> - - Pilih Jenis Buku - - </option>
				                   <!-- <option value="1">PIKSUN</option> -->
				                   <option value="2">PIKSE LAMA</option><!-- 
				                   <option value="3">Paket SE</option> -->
				                </select>
				            </div>
				        </div>
				    </div>
				</div>
			</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="saveadd()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- datatables css -->
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

$(function () {
    $('#BranchCode').select2();
});

function get_item() {
$.getJSON(base_url+"Barcode/get_cabang", function(json){
    $('#BranchCode').empty();
    $('#BranchCode').append($('<option>').text("- - Pilih Cabang - -"));
    $.each(json, function(i, obj){
	$('#BranchCode').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
    });
});
}

var jQueryTable;
$(document).ready(function() {
	get_item();
	jQueryTable = $("#tableMenu").DataTable({
		"ajax": {
			"url":base_url + "Master/find_ordersp",
			"type":"GET",
			"data": ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg=")))}),
			"dataType":"JSON"
		},
		"fnCreatedRow": function (row, data, index) {
			$('td', row).eq(0).html(index + 1);
		},
		"columns": [
			{"data": null,"width": "5px","sClass": "text-center","orderable": false},
			{"data":"BranchCode","autoWidth":true},
			{"data":"NamaAreaCabang","autoWidth":true},
			{"data":"Category","sClass": "text-center","autoWidth":true},
			{"data":"Status","sClass": "text-center","autoWidth":true},
			{"data":"RecID","width":"80px","sClass": "text-center","render": function(data) {
				var button = '<a class="btn btn-success btn-xs" href="javascript:void(0)" type="button" data-toggle="modal" onclick="modal_form(editID='+data+')">Edit</a>';
					return button;
				}
			},
		],
		"aLengthMenu": [[15, 30, 60, -1], [15, 30, 60, "All"]],
		"order": [[ 0, "asc" ]],
		"pagingType": "full_numbers",
		"processing": true,
		dom:
			"<'row'<'col-lg-2 col-sm-12'l><'col-lg-9 col-sm-12'f><'col-lg-1 col-sm-12'B>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-lg-5 col-sm-12'i><'col-lg-7 col-sm-12'p>>", 
		buttons: [
			{
				text: '<button type="button" class="btn btn-default pull-right" data-toggle="modal" onclick="addForm();"><span class="glyphicon glyphicon-plus-sign"></span> New</button>'
			}
		]
	});
});

var save_method;
function addForm() {
	$('#myModal2').modal('show');
	$('.modal-title').text('Add Cabang Order Khusus');
}

var editID;
function modal_form() {
	$(".text-danger").remove();
	$('#form')[0].reset();
	save_method = 'edit';
		
	$.ajax({
		url : base_url + "Master/find_ordersp",
		type: "GET",
		data: ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"RecID": window.btoa(unescape(encodeURIComponent(editID)))}),
		dataType: "JSON",
		success: function(response)
		{
			$('[name="RecID"]').val(response.data[0].RecID);
			$('[name="Cabang"]').val(response.data[0].BranchCode+' - '+response.data[0].NamaAreaCabang);
			$('[name="Status"]').val(response.data[0].StatusID);
			
			$('#myModal').modal('show');
			$('.modal-title').text('Edit Data');
		}
	});
}

function save()
{
	var formdata = {};
	var url;/*
	if (save_method == 'edit') {*/
		formdata['RecID'] = window.btoa(unescape(encodeURIComponent($('[name="RecID"]').val())));
		url = base_url+'Master/edit_ordersp';
	/*} else {
		url = base_url+'master/add_menuitems';
	}*/
	//formdata['BranchCode'] = window.btoa(unescape(encodeURIComponent($('[name="Cabang"]').val())));
	//alert($('[name="RecID"]').val());
	formdata['Status'] = window.btoa(unescape(encodeURIComponent($('[name="Status"]').val())));
	formdata['token'] = window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg=")));
	$.ajax({
		url : url,
		type: "POST",
		data: formdata,
		dataType: "JSON",
		success: function(response)
		{
			$.notify(response.message,response.notify);
			jQueryTable.ajax.reload( null, true);
			$('#myModal').modal('hide');
		}
	});
}

function saveadd()
{
	$(".text-danger").remove();
    /*fCode = $('form input,form select,form textarea');
    for ( var i = 0; i < fCode.length; i++ ) {
        if (fCode[i].value=="" && fCode[i].type!='hidden' && fCode[i].type!='file') {
            $('<p class="text-danger"><i class="fa fa-info-circle"></i> '+$('[name="'+fCode[i].name+'"]').attr('placeholder')+' dibutuhkan</p>').insertAfter(fCode[i]);
            fCode[i].focus();
            return false;
        }
    }

    fCode = $('form input,form select,form textarea');
    for ( var i = 0; i < fCode.length; i++ ) {
        $('[name='+fCode[i].name+']').removeAttr('disabled','disabled');
    }*/
    
	var formdata = {};
	var url;/*
	if (save_method == 'edit') {
		formdata['RecID'] = window.btoa(unescape(encodeURIComponent($('[name="RecID"]').val())));
		url = base_url+'Logistics/edit_estimate';
	} else {*/
	url = base_url+'Master/add_ordersp';
	/*}*/
	formdata['BranchCode'] = window.btoa(unescape(encodeURIComponent($('[name="BranchCode"]').val())));
	formdata['Category'] = window.btoa(unescape(encodeURIComponent($('[name="Category"]').val())));
	formdata['token'] = window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg=")));
	//alert(CKEDITOR.instances['editor1'].getData());
	$.ajax({
		url : url,
		type: "POST",
		data: formdata,
		dataType: "JSON",
		success: function(response)
		{
			$.notify(response.message,response.notify);
			jQueryTable.ajax.reload( null, true);
			$('#myModal2').modal('hide');
		}
	});
}
</script>