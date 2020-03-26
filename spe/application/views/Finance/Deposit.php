<form action="#" id="form3" class="form-horizontal">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list"> Deposit Cabang</i></p>
                <legend></legend>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group"><!-- 
                <label class="control-label col-md-2">Kode/Nama Cabang</label>
                <label class="control-label col-md-1">:</label> -->
                <div class="col-lg-6">
                    <select id="Cabang" name="Cabang" class="form-control" onchange="load_data()">
                        <option value=""> - - Pilih Cabang - - </option>
                    </select>
                </div>
            </div>
                <legend></legend>
        </div>
    </div>
</form>
<form action="#" id="form2" class="form-horizontal" style="display: none;">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa"> Cabang : </i> <i class="fa fa" id="KodeCabang"> </i></p>
                <input type="hidden" name="Cbg" id="Cbg">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa"> Deposit Tersedia : <b id="Nominal"></b></i></p>
                </div>
            </div>
        </div>
    </div>
<div class="nav-tabs-custom">
	<ul class="nav nav-tabs" id="myTab">
		<li class="active"><a href="#tabs1" data-toggle="tab">Deposit Masuk</a></li>
		<li><a href="#tabs2" data-toggle="tab" class="tabs-title">Deposit Keluar</a></li>
	</ul>
	<div class="tab-content">
		<div class="active tab-pane" id="tabs1">
			<div class="row">
				<div class="col-xs-12">
					<div>
						<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
							<thead>
								<tr>
									<th data-sortable="false">No.</th>
									<th>Tanggal</th>
									<th style="text-align: center;">Nominal</th>
									<th style="text-align: center;">Keterangan</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /.tab-pane -->

		<div class="tab-pane" id="tabs2">
			<div class="row">
				<div class="col-xs-12">
					<div>
						<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu2">
							<thead>
								<tr>
									<th data-sortable="false">No.</th>
									<th>Tanggal</th>
									<th style="text-align: center;">Nominal</th>
									<th style="text-align: center;">Keterangan</th>
									<th>Status</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /.tab-pane -->
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
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Nominal</label>
								<input type="text" name="Nominal" id="Nominal" class="Idr form-control" placeholder="Nominal . . ."/>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Keterangan</label>
								<textarea name="Description" id="Description" class="form-control" placeholder="Keterangan . . ."></textarea>
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<script src="<?=base_url('assets/js/autoNumeric.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    get_cabang();
});
$(function () {
    $('#Cabang').select2();
});

function get_cabang() {
$.getJSON(base_url+"Finance/get_cabang", function(json){
    $('#Cabang').empty();
    $('#Cabang').append($('<option>').text("- - Pilih Cabang - -"));
    $.each(json, function(i, obj){
		$('#Cabang').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
    });
});
}

var jQueryTable;
function load_data(){
	$('#form2').css('display','block');
	load_data2();
    var Cabang = document.getElementById('Cabang').value;
	jQueryTable = $("#tableMenu").DataTable({
		destroy: true,
		"ajax": {
			"url":base_url + "Finance/find_deposit",
			"type":"GET",
			"data": ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"Cabang" : window.btoa(unescape(encodeURIComponent(Cabang)))}),
			"dataType":"JSON"
		},
		"fnCreatedRow": function (row, data, index) {
			$('td', row).eq(0).html(index + 1);
		},
		"columns": [
			{"data": null,"width": "5px","sClass": "text-center","orderable": false},
			{"data": "Tanggal","width":"25%","sClass": "text-center","render":
				function(data){
					return tgl_indo(data);
				}
			},
			{"data":"Nominal","width":"30%","sClass": "text-right","render":
				function(data){
					return convertToRupiah(data);
				}
			},
			{"data":"Description","autoWidth":true},
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
				text: '<button type="button" class="btn btn-default pull-right" data-toggle="modal" onclick="addForm();"><span class="glyphicon glyphicon-plus-sign"></span> ADD</button>'
			}
		]
	});

    $.ajax({
		url:base_url + "Finance/find_deposit",
		type:"GET",
		data: ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"Cabang" : window.btoa(unescape(encodeURIComponent(Cabang)))}),
		dataType:"JSON",
        success: function(data){
             $.each(data.data2, function(i, item) {
             	if(item.Nominal=='' || item.Nominal == null){
             		Nominal = 0;
             	} else {
             		Nominal = item.Nominal;
             	}
               	$('#Nominal').text(convertToRupiah(Nominal));
               	$('#KodeCabang').text(item.KodeCabang+' - '+item.NamaCabang);
               	$('#Cbg').val(item.KodeCabang);
              });
        }
    });
}

function load_data2(){
	$('#form2').css('display','block');
    var Cabang = document.getElementById('Cabang').value;
	jQueryTable = $("#tableMenu2").DataTable({
		destroy: true,
		"ajax": {
			"url":base_url + "Finance/find_depositout",
			"type":"GET",
			"data": ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"Cabang" : window.btoa(unescape(encodeURIComponent(Cabang)))}),
			"dataType":"JSON"
		},
		"fnCreatedRow": function (row, data, index) {
			$('td', row).eq(0).html(index + 1);
		},
		"columns": [
			{"data": null,"width": "5px","sClass": "text-center","orderable": false},
			{"data": "Tanggal","width":"25%","sClass": "text-center","render":
				function(data){
					return tgl_indo(data);
				}
			},
			{"data":"Nominal","width":"30%","sClass": "text-right","render":
				function(data){
					return convertToRupiah(data);
				}
			},
			{"data":"Description","autoWidth":true},
			{"data":"Status","width":"15%","sClass": "text-center"},
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
		]
	});
}

var save_method;
function addForm() {
	$(".text-danger").remove();
	$('#myModal').modal('show');
	$('.modal-title').text('Add Deposit');
	$('#form')[0].reset();
	save_method = 'add';
}

function save()
{
	$(".text-danger").remove();
    if($('[name="Nominal"]').val() == "") {
        $('[name="Nominal"]').after('<p class="text-danger">This field is required</p>');
        $('[name="Nominal"]').focus();
        return false;
    }
    if($('[name="Description"]').val() == "") {
        $('[name="Description"]').after('<p class="text-danger">This field is required</p>');
        $('[name="Description"]').focus();
        return false;
    }
    
	var formdata = {};
	url = base_url+'Finance/add_deposit';
	formdata['Cabang'] = window.btoa(unescape(encodeURIComponent($('[name="Cbg"]').val())));
	formdata['Nominal'] = window.btoa(unescape(encodeURIComponent(convertToAngka($('[name="Nominal"]').val()))));
	formdata['Description'] = window.btoa(unescape(encodeURIComponent($('[name="Description"]').val())));
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
			load_data();
		}
	});
}
</script>
