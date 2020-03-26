<form action="#" id="form" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-6">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-barcode"> Data Barcode Cabang</i></p>
            </div>
            <div class="col-lg-6" style="text-align: right;">
            <p><a href="javascript:void(0)" class="btn btn-warning" id="btnbc"><i class="fa fa-exclamation-circle"> Barcode Bermasalah</i></a></p>
            </div>
        </div>
        	<legend></legend> 
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-5">
                <select id="Cabang" name="Cabang" class="form-control">
                   <option value=""> - - Pilih Cabang - - </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
                <select id="PR" name="PR" class="form-control">
                   <option value=""> - - Pilih PR - - </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            	<input type="text" id="BC" maxlength="14" class="form-control" placeholder="- - Input Barcode - -">
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
<div class="row" id="table" style="display: none;">
    <div class="col-lg-12">
			<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
				<thead>
					<tr>
						<th style="width: 5px;text-align: center;">No.</th>
						<th style="width: 10px;text-align: center;">Cabang</th>
						<th style="width: 80px;text-align: center;">PR</th>
						<th style="width: 80px;text-align: center;">Barcode</th>
						<th style="width: 80px;text-align: center;">Kode Item</th>
						<th style="width: 80px;text-align: center;">Status</th>
						<th style="width: 80px;text-align: center;">Invalid</th>
						<th style="width: 80px;text-align: center;">NoVA</th>
						<th style="width: 80px;text-align: center;">Update</th>
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
<div class="modal fade" id="myModalUpdate" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Title</h3>
			</div>
			<div class="modal-body form">
					<input type="hidden" value="" id="RecID" name="RecID"/>
					<input type="hidden" value="" id="Barcode2" name="Barcode2"/>
					<input type="hidden" value="" id="RecID2" name="RecID2"/>
					<div class="form-body"> 
<!-- <div class="row">
    <div class="col-lg-12">  -->             
					<form action="javascript:void(0)" id="formm" class="form-horizontal">
						<div class="form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<label class="control-label">Jenis Update</label>
								<select name="Update" id="Update" class="form-control" placeholder="Ubah Status Invalid">
									<option value="">-- Pilih Jenis Update --</option>
									<option value="4">Mutasi Barcode</option>
									<option value="1">Barter Barcode</option>
									<option value="2">Ganti Barcode</option>
									<option value="3">Hapus Barcode</option>
								</select>
							</div>
						</div>   
						</form>   
					<form action="javascript:void(0)" id="formmodal" class="form-horizontal">
						<div id="divmodal" style="display: none">
						<div class="form-group">
							<div class="col-md-2">
							</div>
						<div class="col-md-8">
							<input type="text" name="BC2" id="BC2" placeholder="Input barcode yang akan ditukar..." class="form-control" maxlength="14" onblur="cek_bc()">
						</div>
				        </div>
						<div class="form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
							<input type="text" name="ItemCode" id="ItemCode" placeholder="Kode Item..." class="form-control" readonly="readonly">
						</div>
						</div>
						<div class="form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
							<input type="text" name="Cabang2" id="Cabang2" placeholder="Cabang..." class="form-control" readonly="readonly">
						</div>
				        </div>
						<div class="form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
							<input type="text" name="PR2" id="PR2" placeholder="PR..." class="form-control" readonly="readonly">
						</div>
				        </div>
						<div class="form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
							<textarea id="desc" name="desc" placeholder="Keterangan..." rows="3" class="form-control"></textarea>
							</div>
				        </div>
						</div>
						<div id="divmodal2" style="display: none">
						<div class="form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
							<input type="text" name="BC3" id="BC3" placeholder="Input barcode pengganti..." maxlength="14" class="form-control">
							</div>
				        </div>
						<div class="form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
							<textarea id="desc2" name="desc2" placeholder="Keterangan..." rows="3" class="form-control"></textarea>
							</div>
				        </div>
				        </div>
						<div id="divmodal3" style="display: none">
						<div class="form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<p style="color: red;" id="divmodal3p"></p>
							</div>
				        </div>
						<div class="form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
							<textarea id="desc3" name="desc3" placeholder="Keterangan..." rows="3" class="form-control"></textarea>
							</div>
				        </div>
				        </div>
						<div id="divmodal4" style="display: none">
						<div class="form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
			                <select id="Cabang3" name="Cabang3" class="form-control">
			                   <option value=""> - - Pilih Cabang - - </option>
			                </select>
							</div>
				        </div>
						<div class="form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
							<textarea id="desc4" name="desc4" placeholder="Keterangan..." rows="3" class="form-control"></textarea>
							</div>
				        </div>
				        </div>
					</form>
						</div>
				<!-- </div>
			</div> -->
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save_update()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div> <!-- /.modal-content -->
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
    get_cbg();
});

$(function () {
    $('#Cabang').select2();
    $('#PR').select2();
    $('#Cabang3').select2({
    width: '100%'
	});
});

function get_cbg() {
$.getJSON(base_url+"Barcode/get_cabang", function(json){
    $('#Cabang,#Cabang3').empty();
    $('#Cabang,#Cabang3').append($('<option>').text("- - Pilih Cabang - -"));
    $.each(json, function(i, obj){
	$('#Cabang,#Cabang3').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
    });
});
}

$("#Cabang").change(function(e) {
    var Cabang = e.target.value; 
	$.getJSON(base_url+"Barcode/get_pr/"+Cabang, function(json){
	    $('#PR').empty();
	    $('#PR').append($('<option>').text("- - Pilih PR - -"));
	    $('#PR').append($('<option>').text("Barcode Lama"));
	    $('#PR').append($('<option>').text("Barcode Mutasi"));
	    $.each(json, function(i, obj){
		$('#PR').append($('<option>').text(obj.PR_Number).attr('value', obj.PR_Number));
	    });
	});
});

var jQueryTable;
function get_data(){
	var Branch = $('#Cabang').val();
	var PR = $('#PR').val();
	var BC = $('#BC').val();
	if(PR=='- - Pilih PR - -'){
		PR='';
	} else {
		PR=PR;
	}
	//alert(Branch)
    $("#tableMenu").DataTable().destroy();
	if(Branch=='- - Pilih Cabang - -' && BC==''){
		alert('Pilih Kode Cabang / PR . . ! !');
	} else {
	$('#table').css('display','block');
    jQueryTable = $("#tableMenu").DataTable({
        "ajax": {
            "url":base_url + "Barcode/list_bcbranch",
            "type":"GET",
            "data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Kode":window.btoa(0),PR:PR,Branch:Branch,BC:BC}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","width":"5px"},
            {"data":"BranchCode","width":"10px"},
            {"data":"PR_Number","autoWidth":true},
            {"data":"Barcode","autoWidth":true},
            {"data":"ItemCode","autoWidth":true},
            {"data":"Status","autoWidth":true},
            {"data":"Invalid","autoWidth":true},
            {"data":"NoVA","autoWidth":true},
			{"data":"RecID","width":"16%","sClass": "text-center","render": function(data) {
				var button = '<div class="btn-group" data-toggle="buttons">';
				button += '<a class="btn btn-success btn-xs" href="javascript:void(0)" type="button" data-toggle="modal" onclick="modal_form(editID='+data+')">Invalid</a>';
				button += '<a class="btn btn-primary btn-xs" href="javascript:void(0)" type="button" data-toggle="modal" onclick="modal_formupdate(editID='+data+')">Barcode</a>';
				button += '</div>';
					return button;
				}
			},
        ],
  		"columnDefs":[
  		{
			"targets": [0,1,2],
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).css({'text-align':'center'});
			}
		},
		{
			"targets": 6,
			"createdCell": function (td, cellData, rowData, row, col) {
				if (cellData == 'Yes') {
					$(td).css({'background':'red','text-align':'center','color':'white'});
				} else {
					$(td).css({'background':'blue','text-align':'center','color':'white'});
				}
			}
		},
		{
			"targets": 5,
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
			filename: 'Stok Barcode Pusat',
			exportOptions: {
				modifier: {
					page: 'all'
				}
			}
		}]
    });	
	}
}

var editID;
function modal_form() {
	$(".text-danger").remove();
	//$('#form')[0].reset();
	save_method = 'edit';
		
	$.ajax({
		url : base_url + "Barcode/find_updateinvalid",
		type: "GET",
		data: ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"RecID": window.btoa(unescape(encodeURIComponent(editID)))}),
		dataType: "JSON",
		success: function(response)
		{
			$('[name="RecID"]').val(response.data[0].RecID);
			$('[name="Invalid"]').val(response.data[0].Invalid);
			
			$('#myModal').modal('show');
			$('.modal-title').text('Ubah Status Invalid');
		}
	});
}

function modal_formupdate() {
	$(".text-danger").remove();
	//$('#form')[0].reset();
	save_method = 'edit';
		
	$.ajax({
		url : base_url + "Barcode/find_updateinvalid",
		type: "GET",
		data: ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"RecID": window.btoa(unescape(encodeURIComponent(editID)))}),
		dataType: "JSON",
		success: function(response)
		{
			$('[name="RecID"]').val(response.data[0].RecID);
			$('[name="Barcode2"]').val(response.data[0].Barcode);
	
			
			$('#myModalUpdate').modal('show');
			$('.modal-title').text('Update Barcode - '+response.data[0].Barcode);
		}
	});
}

function save()
{
	$(".text-danger").remove();

    if($('[name="Invalid"]').val() == "") {
        $('[name="Invalid"]').after('<p class="text-danger">Status dibutuhkan..</p>');
        $('[name="Invalid"]').focus();
        return false;
    }
    //alert($('[name="RecID"]').val());
	var formdata = {};
	var url;
	url = base_url+'Barcode/save_invalid';
	formdata['RecID'] = window.btoa(unescape(encodeURIComponent($('[name="RecID"]').val())));
	formdata['Invalid'] = window.btoa(unescape(encodeURIComponent($('[name="Invalid"]').val())));
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

$("#btnbc").click(function(e) {
	window.location.href = base_url + "Barcode/trouble";
});

$('#Update').on('change', function()
{
	if(this.value==4){
	$('#formmodal')[0].reset();
	$('#divmodal').css('display','none');
	$('#divmodal2').css('display','none');
	$('#divmodal3').css('display','none');
	$('#divmodal4').css('display','block');
	} else if(this.value==1){
	$('#formmodal')[0].reset();
	$('#divmodal').css('display','block');
	$('#divmodal2').css('display','none');
	$('#divmodal3').css('display','none');
	$('#divmodal4').css('display','none');
	} else if(this.value==2){
	$('#formmodal')[0].reset();
	$('#divmodal').css('display','none');
	$('#divmodal2').css('display','block');
	$('#divmodal3').css('display','none');
	$('#divmodal4').css('display','none');
	} else if(this.value==3) {
    var bc = $('#Barcode2').val();
	$('#formmodal')[0].reset();
	$('#divmodal').css('display','none');
	$('#divmodal2').css('display','none');
	$('#divmodal3').css('display','block');
	$('#divmodal4').css('display','none');
	//alert(bc);
    $.ajax({
        url : base_url+"Barcode/find_bcstok",
        type: "POST",
        data: ({bc:bc}),
        dataType: "JSON",
        success: function(data)
        {
            var jml_data = Object.keys(data.rows).length;
            if (jml_data <= 0) {
				$('#divmodal3p').text('*Tidak ada di stok pusat.');
            } else {
				$('#divmodal3p').text('*Ada di stok pusat.');
            }
        }
    });
	} else {
	$('#formmodal')[0].reset();
	$('#divmodal').css('display','none');
	$('#divmodal2').css('display','none');
	$('#divmodal3').css('display','none');
	}
});

function cek_bc() {
    $(".text-danger").remove();
    var bc = $('#BC2').val();
    if(bc==''){
    	alert('Silahkan isi barcode...');
    } else {
    $.ajax({
        url : base_url+"Barcode/find_bcbranch",
        type: "POST",
        data: ({bc:bc}),
        dataType: "JSON",
        success: function(data)
        {
            var jml_data = Object.keys(data.rows).length;
            if (jml_data <= 0) {
                //$("#btnSave").prop("disabled", true);
                $('#BC2').after('<p class="text-danger">Barcode tidak ada di cabang manapun...</p>');
                $('#BC2').focus();
                return false;
            }  else {
                $.each(data.rows, function(i, item) {
                $('#RecID2').val(item.RecID);
                $('#Cabang2').val(item.BranchCode);
                $('#ItemCode').val(item.ItemCode);
                $('#PR2').val(item.PR_Number);
                //$("#PR2").prop("disabled", false);
                });
            }
        }
    });
}
};

function save_update()
{
    var aksi = $('#Update').val();
    var BC1 = $('#Barcode2').val();
    var BC2 = $('#BC2').val();
    //alert(BC1+'-'+BC2);
	$(".text-danger").remove();
    if($('#Update').val() == "") {
        $('#Update').after('<p class="text-danger">This field is required</p>');
        $('#Update').focus();
        return false;
    }
    if($('#Update').val() == "1" && $('#BC2').val() == "") {
        $('#BC2').after('<p class="text-danger">This field is required</p>');
        $('#BC2').focus();
        return false;
    }
    if($('#Update').val() == "1" && $('#desc').val() == "") {
        $('#desc').after('<p class="text-danger">This field is required</p>');
        $('#desc').focus();
        return false;
    }
    if($('#Update').val() == "2" && $('#BC3').val() == "") {
        $('#BC3').after('<p class="text-danger">This field is required</p>');
        $('#BC3').focus();
        return false;
    }
    if($('#Update').val() == "2" && $('#desc2').val() == "") {
        $('#desc2').after('<p class="text-danger">This field is required</p>');
        $('#desc2').focus();
        return false;
    }
    if($('#Update').val() == "3" && $('#desc3').val() == "") {
        $('#desc3').after('<p class="text-danger">This field is required</p>');
        $('#desc3').focus();
        return false;
    }
    if($('#Update').val() == "4" && $('#Cabang3').val() == "- - Pilih Cabang - -") {
        $('#Cabang3').after('<p class="text-danger">This field is required</p>');
        $('#Cabang3').focus();
        return false;
    }
    if($('#Update').val() == "4" && $('#desc4').val() == "") {
        $('#desc4').after('<p class="text-danger">This field is required</p>');
        $('#desc4').focus();
        return false;
    }
    
	var formdata = {};
	url = base_url+'Barcode/save_updatebc';
	formdata['Update'] = $('#Update').val();
	formdata['BC2'] = $('#BC2').val();
	formdata['desc'] = $('#desc').val();
	formdata['BC3'] = $('#BC3').val();
	formdata['desc2'] = $('#desc2').val();
	formdata['desc3'] = $('#desc3').val();
	formdata['desc4'] = $('#desc4').val();
	formdata['Barcode2'] = $('#Barcode2').val();
	formdata['RecID2'] = $('#RecID2').val();
	formdata['RecID'] = $('#RecID').val();
	formdata['Cabang3'] = $('#Cabang3').val();
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
			$('#myModalUpdate').modal('hide');
			get_data();
		}
	});
}
</script>