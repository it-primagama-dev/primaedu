var jQueryTable;
var jQueryTable2;
var jQueryTable3;
$(document).ready(function() {
    jQueryTable = $("#tableMenu").DataTable({
        "ajax": {
            "url":base_url + "import-barcode",
            "type":"GET",
            "data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Kode":window.btoa(0)}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","autoWidth":true},
            {"data":"Barcode","autoWidth":true},
            {"data":"ItemCode","autoWidth":true},
            {"data":"DuplicateDB","autoWidth":true},
            {"data":"DuplicateExcel","autoWidth":true},
            {"data":"NoValid","autoWidth":true},
        ],
  		"columnDefs":[
  		{
			"targets": 0,
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).css({'text-align':'center'});
			}
		},
		{
			"targets": [3,4,5],
			"createdCell": function (td, cellData, rowData, row, col) {
				if (cellData == 'Yes') {
					$(td).css({'background':'red','text-align':'center','color':'white'});
				} else {
					$(td).css({'background':'blue','text-align':'center','color':'white'});
				}
			}
		},
		{
			'targets': 1,
    		'createdCell':  function (td, cellData, rowData, row, col) {
    			$(td).css({'text-align':'center'});
    			if (rowData['DuplicateDB']=='No' && rowData['DuplicateExcel']=='No' && rowData['NoValid']=='No') {
    				$(td).attr('class', 'Barcode');
    			}
    		}
        }],
        "aLengthMenu": [[1000, 5000, 10000, -1], [1000, 5000, 10000, "All"]],
        'iDisplayLength': 10000,
        "order": [[ 0, "asc" ]],
        "pagingType": "full_numbers",
        dom: "<'row'<'col-lg-2 col-xs-12'l><'col-lg-9 col-xs-12'f><'col-lg-1 col-sm-12'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-lg-5 col-sm-12'i><'col-lg-7 col-sm-12'p>>",
		buttons: [
		{
			extend: 'excel',
			text: '<button type="button" class="btn btn-info pull-right"><span class="glyphicon glyphicon-export"></span> Excel</button>',
			className: 'exportExcel',
			filename: 'Export excel',
			exportOptions: {
				modifier: {
					page: 'all'
				}
			}
		}]
    });

    jQueryTable2 = $("#table2").DataTable({
        "ajax": {
            "url":base_url + "import-barcode",
            "type":"GET",
            "data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Kode":window.btoa(1)}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","autoWidth":true},
            {"data":"ItemCode","autoWidth":true},
            {"data":"jmlBC","autoWidth":true},
        ],
  		"columnDefs":[
  		{
			"targets": [0,2],
			"createdCell": function (td, cellData, rowData, row, col) {
				$(td).css({'text-align':'center'});
			}
		}],
        "aLengthMenu": [[1000, 5000, 10000, -1], [1000, 5000, 10000, "All"]],
        'iDisplayLength': 10000,
        "order": [[ 0, "asc" ]],
        "pagingType": "full_numbers"
    });
});

function save() {
	var formdata = {};
	var Barcode = [];
    $(".Barcode").each(function() {
        Barcode.push($(this).text());
    });
    formdata['Barcode'] = Barcode;
    $.ajax({
		url : base_url+'import',
		type: "POST",
		dataType: "JSON",
		data: formdata,
		success: function(response)
		{
			jQueryTable.ajax.reload( null, true);
		    jQueryTable2.ajax.reload( null, true);

		   // $('#infoUpload').modal('show');
		    $("#table3").DataTable({
		    	"data": response.data,
		        "columns": [
		            {"data":"RowNum","autoWidth":true},
		            {"data":"ItemCode","autoWidth":true},
		            {"data":"jmlBC","autoWidth":true},
		            {"data":"CreatedDate","autoWidth":true},
		        ],
		  		"columnDefs":[
		  		{
					"targets": [0,2,3],
					"createdCell": function (td, cellData, rowData, row, col) {
						$(td).css({'text-align':'center'});
					}
				}],
		        "aLengthMenu": [[1000, 5000, 10000, -1], [1000, 5000, 10000, "All"]],
		        'iDisplayLength': 10000,
		        "order": [[ 0, "asc" ]],
		        "pagingType": "full_numbers"
		    });
		    window.location.reload();
		}
	});
};

$(document).ready(function() {
	$('#import_form').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url: base_url+"import-barcode",
			method:"POST",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			dataType: 'JSON',
			success:function(response){
				jQueryTable.ajax.reload( null, true);
				jQueryTable2.ajax.reload( null, true);
				$('#myTab a[href="#tabs1"]').tab('show');
				$.notify(response.message,response.notify);
			}
		})
	});
});

$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});

function resetBarcode() {
$.ajax({
    url: base_url+"import-barcode",
    type: "POST",
    dataType: "JSON",
    data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"Kode":window.btoa(2)}),
    success:function(response) {
        $.notify(response.message,response.notify);
        jQueryTable.ajax.reload( null, true);
    }
});
}