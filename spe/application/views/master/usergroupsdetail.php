<div class="row">
	<div class="col-xs-12">
		<div>
			<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
				<thead>
					<tr>
						<th data-sortable="false">No.</th>
						<th>Group Name</th>
						<th>Menu Item</th>
						<th>Action Name</th>
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
					<input type="hidden" value="<?php echo (isset($UserGroupID) && !empty($UserGroupID)) ? $UserGroupID:''; ?>" name="UserGroup"/>
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Menu Item</label>
								<select name="MenuItems" id="MenuItems" class="form-control" placeholder="Menu Item">
									<option value="">Pilih Menu Item</option>
									<?php if (isset($MenuItems) && !empty($MenuItems)) {
										foreach ($MenuItems->result_array() as $row) {
											echo '<option value="'.$row['RecID'].'">'.$row['MenuItem'].'</option>"';
										}
									} ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Action Name</label>
								<input type="text" name="ActionName" id="ActionName" class="form-control" placeholder="Action Name" value="-"/>
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
	jQueryTable = $("#tableMenu").DataTable({
		"ajax": {
			"url":base_url + "master/find_usergroupsdetail",
			"type":"GET",
			"data": ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),'UserGroupID':window.btoa(unescape(encodeURIComponent('<?php echo (isset($UserGroupID) && !empty($UserGroupID)) ? $UserGroupID:''; ?>')))}),
			"dataType":"JSON"
		},
		"fnCreatedRow": function (row, data, index) {
			$('td', row).eq(0).html(index + 1);
		},
		"columns": [
			{"data": null,"width": "5px","sClass": "text-center","orderable": false},
			{"data":"GroupName","autoWidth":true},
			{"data":"MenuItem","autoWidth":true},
			{"data":"ActionName","autoWidth":true},
			{"data":"RecID","width":"150px","sClass": "text-center","render": function(data) {
				var button = '<div class="btn-group" data-toggle="buttons">';
				button += '<a class="btn btn-success btn-xs" href="javascript:void(0)" type="button" data-toggle="modal" onclick="modal_form(editID='+data+')">Edit</a>';
				button += '<a class="btn btn-primary btn-xs" href="javascript:void(0)" type="button" data-toggle="modal" onclick="delete_form(delID='+data+')">Delete</a>';
				button += '</div>';
					return button;
				}
			},
		],
		"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
	$(".text-danger").remove();
	$('#myModal').modal('show');
	$('.modal-title').text('Add User Group Detail');
	$('#form')[0].reset();
	save_method = 'add';
}

var editID;
function modal_form() {
	$(".text-danger").remove();
	$('#form')[0].reset();
	save_method = 'edit';
		
	$.ajax({
		url : base_url + "master/find_usergroupsdetail",
		type: "GET",
		data: ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"RecID": window.btoa(unescape(encodeURIComponent(editID)))}),
		dataType: "JSON",
		success: function(response)
		{
			$('[name="RecID"]').val(response.data[0].RecID);
			$('[name="UserGroup"]').val(response.data[0].UserGroup);
			$('[name="MenuItems"]').val(response.data[0].MenuItems);
			$('[name="ActionName"]').val(response.data[0].ActionName);
			
			$('#myModal').modal('show');
			$('.modal-title').text('Edit User Group Detail');
		}
	});
}

var delID;
function delete_form() {
	if (confirm("Are you sure you want to delete this ?")) {
		$.ajax({
			url : base_url + "master/delete_usergroupsdetail",
			type: "POST",
			data: ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"RecID": window.btoa(unescape(encodeURIComponent(delID)))}),
			dataType: "JSON",
			success: function(response)
			{
				$.notify(response.message,response.notify);
				jQueryTable.ajax.reload( null, true);
			}
		});
	}
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
	var url;
	if (save_method == 'edit') {
		formdata['RecID'] = window.btoa(unescape(encodeURIComponent($('[name="RecID"]').val())));
		url = base_url+'master/edit_usergroupsdetail';
	} else {
		url = base_url+'master/add_usergroupsdetail';
	}
	formdata['UserGroup'] = window.btoa(unescape(encodeURIComponent($('[name="UserGroup"]').val())));
	formdata['MenuItems'] = window.btoa(unescape(encodeURIComponent($('[name="MenuItems"]').val())));
	formdata['ActionName'] = window.btoa(unescape(encodeURIComponent($('[name="ActionName"]').val())));
	formdata['token'] = window.btoa(unescape(encodeURIComponent('Q3IzNHQzZF9ieS5IQG1aNGg=')));
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