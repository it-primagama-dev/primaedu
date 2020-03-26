<div class="row">
	<div class="col-xs-12">
		<input type="hidden" id="usergroup" value="<?php echo $usergroup;?>">
		<div>
			<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
				<thead>
					<tr>
						<th data-sortable="false">No.</th>
						<th>Kode Paket</th>
						<th>Nama Paket</th>
						<th>Harga Paket</th>
						<th>Harga Ongkir</th>
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
								<label class="control-label">Nama Paket</label>
								<input type="text" name="PackName" id="PackName" class="form-control" placeholder="Controller Name."/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Status</label>
								<select name="Status" id="Status" class="form-control" placeholder="Status">
									<option value="">Pilih Status</option>
									<option value="0">Tutup</option>
									<option value="1">Buka</option>
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
			<div class="modal-body form">
				<form action="javascript:void(0)" id="form2" class="form-horizontal">
				<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu2">
					<thead>
						<tr>
							<th data-sortable="false">No.</th>
							<th>Nama Buku</th>
							<th>Harga Satuan</th>
						</tr>
					</thead>
				</table>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- datatables css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>

<script type="text/javascript">
var jQueryTable;
$(document).ready(function() {
	usergroup = $("#usergroup").val();
	//alert(usergroup);
	jQueryTable = $("#tableMenu").DataTable({
		"ajax": {
			"url":base_url + "Logistics/find_packitem",
			"type":"GET",
			"data": ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg=")))}),
			"dataType":"JSON"
		},
		"fnCreatedRow": function (row, data, index) {
			$('td', row).eq(0).html(index + 1);
		},
		"columns": [
			{"data": null,"width": "5px","sClass": "text-center","orderable": false},
			{"data":"PackCode","autoWidth":true},
			{"data":"PackName","autoWidth":true},
			{"data": null,"sClass": "text-right","autoWidth":true,"render": function(data) {
					if(data.PackType!=6){
						return convertToRupiah(data.Price);
					} else {
						return convertToRupiah(data.PriceB);
					}
				}
			},
			{"data": null,"sClass": "text-right","autoWidth":true,"render": function(data) {
					if(data.PackType!=6){
						return convertToRupiah(data.DelivFee);
					} else {
						return convertToRupiah(data.DelivFeeB);
					}
				}
			},
			{"data":"Status","sClass": "text-center","autoWidth":true,"render": function(data) {
					if(data=='Buka'){
						return "<font color='green'>Buka</font>";
					} else {
						return "<font color='red'>Tutup</font>";;
					}
				}
			},
			{"data":"RecID","width":"80px","sClass": "text-center","render": function(data) {
				var button = '<div class="btn-group" data-toggle="buttons">';
					button += '<a class="btn btn-info btn-xs" id="detail" href="javascript:void(0)" type="button" data-toggle="modal" onclick="Detailform(detailID='+data+')">Detail</a>';
				button += '</div>';

				var button2 = '<div class="btn-group" data-toggle="buttons">';
					button2 += '<a class="btn btn-success btn-xs" id="edit" href="javascript:void(0)" type="button" data-toggle="modal" onclick="modal_form(editID='+data+')">Edit</a><a class="btn btn-info btn-xs" id="detail" href="javascript:void(0)" type="button" data-toggle="modal" onclick="Detailform(detailID='+data+')">Detail</a>';
					button2 += '</div>';

					if(usergroup == 30){
						return button2;
					} else {
						return button;
					}
				}
			},
		],
		"aLengthMenu": [[-1], ["All"]],
		"order": [[ 0, "asc" ]],
		"pagingType": "full_numbers",
		"processing": true,
		dom:
			"<'row'<'col-lg-2 col-sm-12'l><'col-lg-10 col-sm-12'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-lg-5 col-sm-12'i><'col-lg-7 col-sm-12'p>>", 
		buttons: [
		]
	});
});

var save_method;
function addForm() {
	$(".text-danger").remove();
	$('#myModal').modal('show');
	$('.modal-title').text('Add paket item');
	$('#form')[0].reset();
	save_method = 'add';
}

var editID;
function modal_form() {
	$(".text-danger").remove();
	$('#form')[0].reset();
	save_method = 'edit';
		
	$.ajax({
		url : base_url + "Logistics/find_packitem",
		type: "GET",
		data: ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"RecID": window.btoa(unescape(encodeURIComponent(editID)))}),
		dataType: "JSON",
		success: function(response)
		{
			$('[name="RecID"]').val(response.data[0].RecID);
			$('[name="PackName"]').val(response.data[0].PackName);
			$('[name="Status"]').val(response.data[0].StatusID);
			
			$('#myModal').modal('show');
			$('.modal-title').text('Edit Paket Item');
		}
	});
}

var detailID;
var jQueryTable2;
function Detailform() {
	$('#tableMenu2').DataTable().destroy();
	//$("#tableMenu2").empty();
		
	/*$.ajax({
		url : base_url + "Logistics/find_packitemdetail",
		type: "GET",
		data: ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"RecID": window.btoa(unescape(encodeURIComponent(detailID)))}),
		dataType: "JSON",
		success: function(response)
		{	*/
    		//jQueryTable2.Destroy();
			jQueryTable2 = $("#tableMenu2").DataTable({
					"ajax": {
						"url":base_url + "Logistics/find_packitemdetail",
						"type":"GET",
						"data": ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"RecID": window.btoa(unescape(encodeURIComponent(detailID)))}),
						"dataType":"JSON"
					},
					"fnCreatedRow": function (row, data, index) {
						$('td', row).eq(0).html(index + 1);
					},
					"columns": [
						{"data": null,"width": "5px","sClass": "text-center","orderable": false},
						{"data":"ItemName","autoWidth":true},
						{"data": null,"sClass": "text-right","autoWidth":true,"render": function(data) {
								if(data.PackType==6){
									return convertToRupiah(data.PriceB);
								} else {
									return convertToRupiah(data.Price);
								}
							}
						},
					],
					"bPaginate": false,
					"bFilter": false, 
					"bInfo": false,
					buttons: [
					]
				});

			
			$('#myModal2').modal('show');
			$('.modal-title').text('Detail Paket Item');
		}

function save()
{
	$(".text-danger").remove();
    fCode = $('form input,form select,form textarea');
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
    }
    
	var formdata = {};
	var url;/*
	if (save_method == 'edit') {*/
		formdata['RecID'] = window.btoa(unescape(encodeURIComponent($('[name="RecID"]').val())));
		url = base_url+'Logistics/edit_packitem';
	/*} else {
		url = base_url+'master/add_menuitems';
	}*/
	formdata['PackName'] = window.btoa(unescape(encodeURIComponent($('[name="PackName"]').val())));
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
</script>