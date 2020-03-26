<form action="#" id="form" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list"> Transaksi Pembelian Buku</i></p>
        	<legend></legend>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-5">
                <select id="Status" name="Status" class="form-control">
                   <option value=""> - - Pilih Status Transaksi - - </option>
                   <option value="WAITING"> WAITING </option>
                   <option value="SUCCESS"> SUCCESS </option>
                   <option value="CANCEL"> CANCEL </option>
                   <option value="EXPIRED"> EXPIRED </option>
                   <option value="SETTLE"> SETTLE </option>

                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success print-hidden" onclick="reload_data()"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
        </div>
        <legend></legend>
    </div>
</div>
</form>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
			<form method="post" action="javascript:void(0)">
				<table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
					<thead>
						<tr>
							<th style="width: 5px;text-align: center;">No.</th>
							<th style="width: 80px;text-align: center;">PR</th>
							<th style="width: 80px;text-align: center;">Invoice</th>
							<th style="width: 80px;text-align: center;">Kode Pembayaran</th>
							<th style="width: 80px;text-align: center;">Nominal</th>
							<th style="width: 80px;text-align: center;">Tanggal Transaksi</th>
							<th style="width: 80px;text-align: center;">Status</th>
                            <th style="width: 80px;text-align: center;">Aksi</th>
						</tr>
					</thead>
				</table>
			</form>
		</div>
	</div>
</div>

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

$("#btnbc").click(function(e) {
	window.location.href = base_url + "Barcode/list_bcbranch";
});

$(document).ready(function(){
    get_item();
    reload_data();
});

$("#btnmodal").click(function(e) {
	window.location.reload();
});

$(function () {
    $('#Cabang').select2();
    $('#PR').select2();
});

function get_item() {
$.getJSON(base_url+"Barcode/get_cabang", function(json){
    $('#Cabang').empty();
    $('#Cabang').append($('<option>').text("- - Pilih Cabang - -"));
    $.each(json, function(i, obj){
	$('#Cabang').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
    });
});
}

$("#Cabang").change(function(e) {
    var Cabang = e.target.value;
	$.getJSON(base_url+"Barcode/get_pr/"+Cabang, function(json){
	    $('#PR').empty();
	    $('#PR').append($('<option>').text("- - Pilih PR - -"));
	    $.each(json, function(i, obj){
		$('#PR').append($('<option>').text(obj.PR_Number).attr('value', obj.PR_Number));
	    });
	});
    $('#Branch').val(Cabang);
});

$("#PR").change(function(e) {
    var PR_Number = e.target.value;
    $('#PR_Number').val(PR_Number);
});

var jQueryTable;
var jQueryTable2;
function reload_data() {
    Status = $('#Status').val();
    //alert(Status);
    jQueryTable = $("#tableMenu").DataTable({
        "destroy" : true,
        "ajax": {
            "url":base_url + "Finance/Logtrans",
            "type":"GET",
            "data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Kode":window.btoa(0),"Status":window.btoa(Status)}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","autoWidth":true},
            {"data":"PR_Number","sClass": "text-center","autoWidth":true},
            {"data":"TRANSIDMERCHANT","sClass": "text-center","autoWidth":true},
            {"data":"PAYMENTCODE","sClass": "text-center","autoWidth":true},
			{"data": "AMOUNT","width":"20%","sClass": "text-right","render":
				function(data){
					return convertToRupiah(data);
				}
			},
			{"data": "PAYMENTDATETIME","width":"20%","sClass": "text-center","render":
				function(data){
					if(data==null){
						return data;
					} else {
					return data.replace(/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/,"$1/$2/$3 $4:$5:$6");	
				}
				}
			},
            {"data":"RESULTMSG","sClass": "text-center","autoWidth":true},
            {"data":"RecID","width":"80px","sClass": "text-center","render": function(data) {
                var button = '<div class="btn-group" data-toggle="buttons">';
                button += "<button class='btn btn-success btn-xs aktif' onClick='settle("+data+")'>OK</button>";
                button += '</div>';
                    return button;
                }
            },
        ],
  		"columnDefs":[
  		{
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).css({'text-align':'center'});
			},
            'targets': 7,
            'createdCell':  function (td, cellData, rowData, row, col) {
                if (rowData['RESULTMSG'] != 'SETTLE') {
                    $(td).find('.aktif').css('display','none');
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
			filename: 'Transaksi Buku',
			exportOptions: {
				modifier: {
					page: 'all'
				}
			}
		}]
    });
}

var inv;
function settle(inv) {
    if (confirm("Anda yakin transaksi ini settle ?")) {
            //jQueryTable.empty();
            $.ajax({
                url : base_url+"Finance/settle",
                type: "POST",
                data: ({inv:window.btoa(inv),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=")}),
                dataType: "JSON",
                success: function(data)
                {
                    jQueryTable.ajax.reload( null, true);
                    reload_data();
                    $.notify(data.message,data.notify);
                }
            });
        }
        }
</script>