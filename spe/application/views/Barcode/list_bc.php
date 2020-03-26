<form action="#" id="form" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-barcode"> Data Barcode Pusat</i></p>
        	<legend></legend>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-6">
                <select id="ItemCode" name="ItemCode" class="form-control">
                   <option value="- - Pilih Item - -"> - - Pilih Item - - </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-6">
            	<input type="text" id="BC" maxlength="14" class="form-control" placeholder="- - Input Barcode - -">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success print-hidden" onclick="load_data()"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
        </div>
        <legend></legend>
    </div>
</div>
<div class="row" id="table" style="display: none;">
    <div class="col-lg-12">
		<div class="active tab-pane" id="tabs1">
			<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
				<thead>
					<tr>
						<th style="width: 5px;text-align: center;">No.</th>
						<th style="width: 80px;text-align: center;">Barcode</th>
						<th style="width: 80px;text-align: center;">Kode Item</th>
						<th style="width: 80px;text-align: center;">Available</th>
                        <th style="width: 80px;text-align: center;">Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
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
$(document).ready(function() {
	get_item();
});

$(function () {
    $('#ItemCode').select2();
});

function get_item() {
$.getJSON(base_url+"Barcode/get_item", function(json){
    $('#ItemCode').empty();
    $('#ItemCode').append($('<option>').text("- - Pilih Item - -"));
    $.each(json, function(i, obj){
	$('#ItemCode').append($('<option>').text(obj.ItemName).attr('value', obj.ItemCode));
    });
});
}
var jQueryTable;
var jQueryTable2;
function load_data() {
    ItemCode = $('#ItemCode').val();
    Barcode = $('#BC').val();
	//alert(ItemCode);
    $("#tableMenu").DataTable().destroy();
    if(ItemCode=='- - Pilih Item - -' && Barcode==''){
    	alert('Pilih Item / Barcode...');
    } else {
	$('#table').css('display','block');
    jQueryTable = $("#tableMenu").DataTable({
        "ajax": {
            "url":base_url + "Barcode/list_bc",
            "type":"GET",
            "data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Kode":window.btoa(0),"ItemCode":window.btoa(ItemCode),"Barcode":window.btoa(Barcode)}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","autoWidth":true},
            {"data":"Barcode","autoWidth":true},
            {"data":"ItemCode","autoWidth":true},
            {"data":"Status","autoWidth":true},
            {"data":"RecID","width":"80px","sClass": "text-center","render": function(data) {
                var button = '<div class="btn-group" data-toggle="buttons">';
                button += '<a class="btn btn-danger btn-xs aktif" href="javascript:void(0)" type="button" data-toggle="modal" onclick="delete_form(delID='+data+')">Delete</a>';
                button += '</div>';
                    return button;
                }
            },
        ],
  		"columnDefs":[
  		{
			"targets": [0,1],
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).css({'text-align':'center'});
			}
		},
		{
			"targets": 3,
			"createdCell": function (td, cellData, rowData, row, col) {
				if (cellData == 'No') {
					$(td).css({'background':'red','text-align':'center','color':'white'});
				} else {
					$(td).css({'background':'blue','text-align':'center','color':'white'});
				}
			}
		},
        {
            'targets': 4,
            'createdCell':  function (td, cellData, rowData, row, col) {
                if (rowData['Status'] == 'No') {
                    $(td).find('.aktif').attr('disabled','disabled').removeAttr('onclick');
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

var delID;
function delete_form() {
    if (confirm("Are you sure you want to delete this ?")) {
        //alert(delID);
        $.ajax({
            url : base_url + "Barcode/delete_barcode",
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

</script>