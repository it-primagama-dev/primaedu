<div class="row">
	<div class="col-xs-12">
		<div>
			<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
				<thead>
					<tr>
						<th data-sortable="false">No.</th>
						<th>PR</th>
						<th>DN</th>
						<th>Ekspedisi</th>
						<th>CP</th><!-- 
						<th>Link</th> -->
						<th>No. Resi</th>
						<th>Tgl Kirim</th>
						<th>Tgl Estimasi</th>
						<th>Koli</th>
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
                            <label class="control-label col-md-3">PR</label>
                            <div class="col-md-9">
                                <input type="text" name="PR_Number" class="form-control" value="" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No. Pengiriman</label>
                            <div class="col-md-9">
                                <input type="text" name="DO_Number" class="form-control" value="" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Expedisi</label>
                            <div class="col-md-9">
                                <select name="Expedisi" id="Expedisi" class="form-control">
                                    <option value="">--Pilih Expedisi--</option>
                                    <?php foreach ($item->result() as $r) { ?>
                                        <option value="<?php echo $r->RecID ?>"><?php echo $r->Exp_Name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Contact Person</label>
                            <div class="col-md-9">
                                <input type="text" name="CP" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Link Web Cek Resi</label>
                            <div class="col-md-9">
                                <input type="text" name="Link" class="form-control" value="" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No. Resi</label>
                            <div class="col-md-9">
                                <input type="text" name="Resi" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Kirim</label>
                            <div class="col-md-9">
                                <input type="text" name="Deliv_Date" id="Deliv_Date" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Estimasi</label>
                            <div class="col-md-9">
                                <input type="text" name="Est_Date" id="Est_Date" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Koli</label>
                            <div class="col-md-9">
                                <input type="text" name="Koli" class="form-control" value="">
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>

<script type="text/javascript">

$(function(){
    var d = new Date();
    var n = d.getFullYear();
    $('[name="Est_Date"],[name="Deliv_Date"]').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "2017:"+n
    });
})

$("#Expedisi").change(function(e) {
    var RecID = e.target.value;
    //alert(RecID);
    $.ajax({
        url : base_url + "Logistics/edit_exp/"+RecID,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="CP"]').val(data.Contact);
            $('[name="Link"]').val(data.Link);
        }
    });
})

var jQueryTable;
$(document).ready(function() {
	jQueryTable = $("#tableMenu").DataTable({
		"ajax": {
			"url":base_url + "Logistics/find_list_do_exp_edit",
			"type":"GET",
			"data": ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg=")))}),
			"dataType":"JSON"
		},
		"fnCreatedRow": function (row, data, index) {
			$('td', row).eq(0).html(index + 1);
		},
		"columns": [
			{"data": null,"width": "5px","sClass": "text-center","orderable": false},
			{"data":"PR_Number","autoWidth":true},
			{"data":"DO_Number","autoWidth":true},
			{"data":"Exp_Name","autoWidth":true},
			{"data":"CP","autoWidth":true},/*
			{"data":"Link","autoWidth":true},*/
			{"data":"NoResi","autoWidth":true},
			{"data":"DO_Date","autoWidth":true,"render": function(data) {
					return tgl_indo(data);
				}
			},
			{"data":"Estimate_Date","autoWidth":true,"render": function(data) {
					return tgl_indo(data);
				}
			},
			{"data":"Koli","autoWidth":true},
			{"data":"RecID","width":"80px","sClass": "text-center","render": function(data) {
				var button = '<a class="btn btn-success btn-xs" href="javascript:void(0)" type="button" data-toggle="modal" onclick="modal_form(editID='+data+')">Edit</a>';
					return button;
				}
			},
		],
		"aLengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
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

var editID;
function modal_form() {
	$(".text-danger").remove();
	$('#form')[0].reset();
	save_method = 'edit';
		
	$.ajax({
		url : base_url + "Logistics/find_list_do_exp_edit",
		type: "GET",
		data: ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"RecID": window.btoa(unescape(encodeURIComponent(editID)))}),
		dataType: "JSON",
		success: function(response)
		{
			$('[name="RecID"]').val(response.data[0].RecID);
			$('[name="PR_Number"]').val(response.data[0].PR_Number);
			$('[name="DO_Number"]').val(response.data[0].DO_Number);
			$('[name="Deliv_Date"]').val(response.data[0].DO_Date);
			$('[name="Est_Date"]').val(response.data[0].Estimate_Date);
			$('[name="Link"]').val(response.data[0].Link);
			$('[name="CP"]').val(response.data[0].CP);
			$('[name="Koli"]').val(response.data[0].Koli);
			$('[name="Expedisi"]').val(response.data[0].ExpID);
			$('[name="Resi"]').val(response.data[0].NoResi);
			
			$('#myModal').modal('show');
			$('.modal-title').text('Edit Detail Ekspedisi');
		}
	});
}

function save()
{
	$(".text-danger").remove();
/*    fCode = $('form input,form select,form textarea');
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
	if (save_method == 'edit') {*/
	formdata['RecID'] = window.btoa(unescape(encodeURIComponent($('[name="RecID"]').val())));
	url = base_url+'Logistics/edit_list_do_exp_edit';
	/*} else {
		url = base_url+'master/add_menuitems';
	}*/
	formdata['Expedisi'] = window.btoa(unescape(encodeURIComponent($('[name="Expedisi"]').val())));
	formdata['CP'] = window.btoa(unescape(encodeURIComponent($('[name="CP"]').val())));
	formdata['Resi'] = window.btoa(unescape(encodeURIComponent($('[name="Resi"]').val())));
	formdata['Deliv_Date'] = $('[name="Deliv_Date"]').val();
	formdata['Est_Date'] = $('[name="Est_Date"]').val();
	formdata['Koli'] = window.btoa(unescape(encodeURIComponent($('[name="Koli"]').val())));
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