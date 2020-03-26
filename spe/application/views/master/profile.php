<div class="row">
	<div class="col-xs-12">
		<div>
			<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
				<thead>
					<tr>
						<th data-sortable="false">No.</th>
						<th data-sortable="false">Username</th>
						<th data-sortable="false">Fullname</th>
						<th data-sortable="false">Email</th>
						<th data-sortable="false">Group Name</th>
						<th data-sortable="false">AreaCabang</th>
						<th data-sortable="false">Action</th>
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
								<label class="control-label">Fullname</label>
								<input type="text" name="Fullname" class="form-control" placeholder="Fullname dibutuhkan." autocomplete="name" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Username</label>
								<input type="text" name="Username" class="form-control" placeholder="Username dibutuhkan." autocomplete="username" <?php echo (isset($access) && !empty($access))?'':'disabled="disabled"'; ?>/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Password</label>
								<input type="password" name="Password" placeholder="Password dibutuhkan." class="form-control" autocomplete="new-password">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Ulangi Password</label>
								<input type="password" name="Password2" placeholder="Ulangi Password dibutuhkan." class="form-control" autocomplete="new-password">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Email</label>
								<input type="email" name="Email" class="form-control" placeholder="Email dibutuhkan." autocomplete="email">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">User Group</label>
								<select name="UserGroup" id="UserGroup" class="form-control" placeholder="User Group" <?php echo (!empty($access))?'':'disabled="disabled"'; ?>>
									<option value="">Pilih User Group</option>
									<?php if (isset($usergroups) && !empty($usergroups)) {
										foreach ($usergroups->result_array() as $row) {
											echo '<option value="'.$row['RecID'].'">'.$row['GroupName'].'</option>';
										}
									} ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Areacabang</label>
								<select name="AreaCabang" id="AreaCabang" class="form-control" placeholder="AreaCabang" <?php echo (!empty($access))?'':'disabled="disabled"'; ?>>
									<option value="">Pilih AreaCabang</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Disabled</label>
								<select name="Disabled" id="Disabled" class="form-control" placeholder="Disabled" <?php echo (!empty($access))?'':'disabled="disabled"'; ?>>
									<option value="">Pilih Disabled</option>
									<option value="0">Tidak</option>
									<option value="1">Ya</option>
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

<!-- datatables css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<link href="<?php echo base_url()?>assets/plugins/select2/css/select2-bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url()?>assets/plugins/select2/css/select2.custom.min.css" rel="stylesheet" />
<script src="<?php echo base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>

<script type="text/javascript">
var access = "<?php echo (!empty($access))?$access:''; ?>";
var jQueryTable;
$(document).ready(function() {
	var addCol = "<'row'<'col-lg-2 col-sm-12'l><'col-lg-9 col-sm-12'f><'col-lg-1 col-sm-12'B>>";
	addCol += "<'row'<'col-sm-12'tr>>";
	addCol += "<'row'<'col-lg-5 col-sm-12'i><'col-lg-7 col-sm-12'p>>";
	addButton = [{text: '<button type="button" class="btn btn-default pull-right" data-toggle="modal" onclick="addForm();"><span class="glyphicon glyphicon-plus-sign"></span> New</button>'}];

	jQueryTable = $("#tableMenu").DataTable({
		"paginate": (access)?"full_numbers":false,
		"ordering": false,
		"aLengthMenu": (access)?[[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]:false,
		"filter": (access)?true:false,
		"info": (access)?true:false,
		"dom": (access)?addCol:'', 
		"buttons": (access)?addButton:'',
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"language": {
            "sProcessing":   "Sedang memproses...",
            "oPaginate": {
                "sFirst":    "First",
                "sPrevious": "&laquo;",
                "sNext":     "&raquo;",
                "sLast":     "Last"
            }
        },
		"ajax": {
			"url":base_url + "master/load_profile",
			"type":"POST",
			"data": ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg=")))}),
			"dataType":"JSON",
			beforeSend: function() {
				$('.loader').hide();
			},
		},
		"columns": [
			{"data": "RecID","width": "5px","sClass": "text-center","orderable": false,render: function (data, type, row, meta) {
				return meta.row + meta.settings._iDisplayStart + 1;
			}},
			{"data":"Username","autoWidth":true},
			{"data":"Fullname","autoWidth":true},
			{"data":"Email","autoWidth":true},
			{"data":"GroupName","autoWidth":true},
			{"data":"NamaAreaCabang","autoWidth":true},
			{"data":null,"width":"150px","sClass": "text-center","render": function(data) {
				var button = '';
				if (access) {
					button += '<a class="btn btn-warning btn-xs btn-block" href="javascript:void(0)" type="button" onclick="ResetPass(ResetID='+data.RecID+')">Reset</a>';
				}
				button += '<a class="btn btn-success btn-xs btn-block" href="javascript:void(0)" type="button" data-toggle="modal" onclick="myModal(editID='+data.RecID+')">Edit</a>';
				if (access) {
					button += '<a class="btn btn-primary btn-xs aktif btn-block" href="javascript:void(0)" type="button" data-toggle="modal" onclick="delete_form(delID='+data.RecID+')">Delete</a>';
				}
				if (is_empty(data.is_web)) {
					button += '<a class="btn btn-danger btn-xs btn-block" href="javascript:void(0)" type="button" data-toggle="modal" onclick="sinkron_web('+data.RecID+')">Sinkron Web</a>';
				}
				if (is_empty(data.is_ems)) {
					button += '<a class="btn btn-info btn-xs btn-block" href="javascript:void(0)" type="button" data-toggle="modal" onclick="sinkron_ems('+data.RecID+')">Sinkron EMS</a>';
				}
				if (is_empty(data.is_sc)) {
					button += '<a class="btn btn-warning btn-xs btn-block" href="javascript:void(0)" type="button" data-toggle="modal" onclick="sinkron_sc('+data.RecID+')">Sinkron SC</a>';
				}
				return button;
			}},
		]
	});
});

var save_method;
function addForm() {
	$(".text-danger").remove();
	$('#myModal').modal('show');
	$('.modal-title').text('Add Users');
	$('#form')[0].reset();
	$('#AreaCabang').val('').trigger('change');
	save_method = 'add';
}

var editID;
function myModal() {
	$(".text-danger").remove();
	$('#form')[0].reset();
	save_method = 'edit';
		
	$.ajax({
		url : base_url + "master/find_profile",
		type: "GET",
		data: ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"RecID": window.btoa(unescape(encodeURIComponent(editID)))}),
		dataType: "JSON",
		success: function(response)
		{
			$('[name="RecID"]').val(response.RecID);
			$('[name="Username"]').val(response.Username);
			$('[name="Password"],[name="Password2"]').val(response.Password);
			$('[name="Fullname"]').val(response.Fullname);
			$('[name="Email"]').val(response.Email);
			$('[name="Fullname"]').val(response.Fullname);
			$('[name="UserGroup"]').val(response.UserGroup);
			$('[name="Disabled"]').val(response.Disabled);

			var data = {
			    id: response.AreaCabang,
			    text: response.NamaAreaCabang
			};
			if ($('[name="AreaCabang"]').find("option[value='" + data.id + "']").length) {
			    $('[name="AreaCabang"]').val(data.id).trigger('change');
			} else { 
			    var newOption = new Option(data.text, data.id, true, true);
			    $('[name="AreaCabang"]').append(newOption).trigger('change');
			} 
			
			$('#myModal').modal('show');
			$('.modal-title').text('Edit Users');
		}
	});
}

var delID;
function delete_form() {
	if (confirm("Are you sure you want to delete this ?")) {
		$.ajax({
			url : base_url + "master/delete_profile",
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

var ResetID;
function ResetPass() {
	if (confirm("Are you sure you want to Reset this ?")) {
		$.ajax({
			url : base_url + "master/reset_password",
			type: "POST",
			data: ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"RecID": window.btoa(unescape(encodeURIComponent(ResetID)))}),
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
        if (fCode[i].value=="" && fCode[i].type!='hidden' && fCode[i].type!='file' && fCode[i].name !='AreaCabang') {
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
		var url = base_url+'master/edit_profile';
	} else {
		var url = base_url+'master/add_profile';
	}
	
	formdata['Username'] = window.btoa(unescape(encodeURIComponent($('[name="Username"]').val())));
	formdata['Password'] = window.btoa(unescape(encodeURIComponent($('[name="Password"]').val())));
	formdata['Fullname'] = window.btoa(unescape(encodeURIComponent($('[name="Fullname"]').val())));
	formdata['Email'] = window.btoa(unescape(encodeURIComponent($('[name="Email"]').val())));
	formdata['UserGroup'] = window.btoa(unescape(encodeURIComponent($('[name="UserGroup"]').val())));
	formdata['AreaCabang'] = window.btoa(unescape(encodeURIComponent($('[name="AreaCabang"]').val())));
	formdata['Disabled'] = window.btoa(unescape(encodeURIComponent($('[name="Disabled"]').val())));
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
			$('[name="Username"],[name="UserGroup"],[name="AreaCabang"],[name="Disabled"]').attr('disabled','disabled');
			$('#myModal').modal('hide');
		}
	});
}

$(function () {
    $('#AreaCabang').select2({
        theme: "bootstrap",
        containerCssClass: ':all:',
        width: "100%",
        placeholder: "AreaCabang",
        ajax: {
            url: base_url+'master/get_areacabang',
            dataType: "json",
            type: "GET",
            data: function (params) {
            	var query = {
                    search: params.term,
                    token: window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),
                    page: params.page || 1,
                    pagination: {
                        more: (params.page * 10) < params.count_filtered
                    }
                }
                return query;
            }
        }
    });
});

function sinkron_web(id) {
	$.ajax({
		url : base_url + "master/sinkron_web",
		type: "POST",
		data: ({"RecID": id}),
		dataType: "JSON",
		success: function(response)
		{
			if (response.notify == 'success') {
				alert('Data berhasil disimpan dan dikirim ke email yang bersangkutan.');
				jQueryTable.ajax.reload( null, true);
			} else {
				alert('Data gagal disimpan');
			}
		}
	});
}

function sinkron_ems(id) {
	$.ajax({
		url : base_url + "master/sinkron_ems",
		type: "POST",
		data: ({"RecID": id}),
		dataType: "JSON",
		success: function(response)
		{
			if (response.notify == 'success') {
				alert('Data berhasil disimpan dan dikirim ke email yang bersangkutan.');
				jQueryTable.ajax.reload( null, true);
			} else {
				alert('Data gagal disimpan');
			}
		}
	});
}

function sinkron_sc(id) {
	$.ajax({
		url : base_url + "master/sinkron_sc",
		type: "POST",
		data: ({"RecID": id}),
		dataType: "JSON",
		success: function(response)
		{
			if (response.notify == 'success') {
				alert('Data berhasil disimpan dan dikirim ke email yang bersangkutan.');
				jQueryTable.ajax.reload( null, true);
			} else {
				alert('Data gagal disimpan');
			}
		}
	});
}

function is_empty(MyVar){
    return ((typeof MyVar== 'undefined') || (MyVar == null) || (MyVar == false) || (MyVar.length == 0) || (MyVar == ""));
}
</script>