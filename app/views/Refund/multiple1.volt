{{ content() }}
<script type="text/javascript">var base_url = "{{ url() }}"</script>
<h1 class="hidden-print">
	<i class="icon-arrow-left-3 fg-darker smaller"></i>
	Koreksi Transfer
</h1>
<div class="grid fluid display-print">
	<div class="row">
		<div class="span6" style="text-align: left;">
			<img src="{{ url('img/logo_new_web.png') }}" width="45%">
		</div>
		<div class="span6" style="text-align: right;">
			<div class="BranchTitle"></div>
		</div>
	</div>
	<hr style="background-color:#1d1d1d !important;color: #1d1d1d !important;height:2px;">
	<div class="row">
		<div class="span11" style="text-align: center;">
			<h2 style="text-decoration: underline;">SURAT PERNYATAAN</h2>
			<p>No.</p>
		</div>
	</div>
	<div class="row">
		<div class="span11">
			<p>Saya yang bertanda tangan dibawah ini :</p>
		</div>
	</div>
	<div class="row">
		<div class="span1">
			<p>Nama</p>
			<p>Jabatan</p>
			<p>Cabang</p>
		</div>
		<div class="span10">
			<div class="headerRefund"></div>
		</div>
	</div>
	<div class="row">
		<div class="span11">
			<p>Menerangkan bahwa telah terjadi kelasahan transfer sebagai berikut.</p>
		</div>
	</div>
</div>
<form method="post" action="javascript:void(0)" name="form" id="form" onsubmit="return saveData();">
<div class="grid fluid hidden-print">
	<div class="span5">
		<label for="label" class="no-padding">Nama Pembuat Pernyataan</label>
		<div class="input-control text" data-role="input-control">
			{{ text_field("namapembuatpernyataan","placeholder":"Nama Pembuat Pernyataan dibutuhkan") }}
		</div>
	</div>
	<div class="span5">
		<label for="label" class="no-padding">Jabatan Pembuat Pernyataan</label>
		<div class="input-control text" data-role="input-control">
			{{ text_field("jabatanpembuatpernyataan","placeholder":"Jabatan Pembuat Pernyataan dibutuhkan") }}
		</div>
	</div>
	<div class="span5">
		<label for="label" class="no-padding">Telp Cabang Terbaru</label>
		<div class="input-control text" data-role="input-control">
			{{ text_field("telpcabang","maxlength":"12","onkeyup":"angka(this);","placeholder":"Telp Cabang dibutuhkan") }}
		</div>
	</div>
	<div class="span5">
		<label for="label">Alamat Cabang Terbaru</label>
		<div class="input-control textarea" data-role="input-control">
			{{ text_area("alamatcabang","placeholder":"Alamat Cabang dibutuhkan") }}
		</div>
	</div>
</div>

<div class="grid fluid hidden-print">
	<div class="row">
		<div class="span3">
			<div class="input-control select" data-role="input-control">
				<select name="KodeCabang" id="KodeCabang"></select>
			</div>
		</div>
		<div class="span2">
			<div class="input-control select" data-role="input-control">
				<select name="tahunajaran" id="tahunajaran"></select>
			</div>
		</div>
		<div class="span6">
			<div class="input-control select" data-role="input-control">
				<select name="kodetransaksi" id="kodetransaksi"></select>
			</div>
		</div>
	</div>
</div>

<div class="grid fluid">
	<div class="row">
		<div class="span12">
			<div class="panel-body">
				<table class="table bordered striped hovered">
					<thead>
						<tr>
							<th style="text-align: center;width: 5px;">No.</th>
							<th>NoVa Transaksi</th>
							<th>Tanggal Transaksi</th>
							<th>Nominal Transaksi</th>
							<th>Th Ajaran</th>
							<th>Jenis Refund</th>
							<th>NoVa Refund</th>
							<th>Nominal Refund</th>
							<th>Selisi</th>
							<th class="hidden-print">Aksi</th>
						 </tr>
					</thead>
					<tbody id="data_barang"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="grid fluid">
	<div class="span11">
		<label for="Keterangan">Kronologi</label>
		<div class="input-control textarea" data-role="input-control">
			{{ text_area("Kronologi","placeholder":"Kronologi dibutuhkan","rows":"10") }}
		</div>
	</div>
	<div class="span11 hidden-print" style="padding-bottom:5%;">
		<input id="cekbox" type='checkbox' onclick="run();"> Saya setuju dengan syarat dan ketentuan ini.
	</div>
	<div class="span11 hidden-print">
		<button id='cb' disabled type="submit" onclick="saveData();">Simpan</button>
	</div>
</div>
</form>
<div class="grid fluid display-print">
	<div class="row">
		<div class="span2" style="text-align: center;">
			<h5>Dibuat oleh,</h5>
			<h5 class="CreateBy"></h5>
		</div>
		<div class="span8"></div>
		<div class="span2" style="text-align: center;">
			<h5>Disetujui oleh,</h5>
			<h5 class="ApproveBy"></h5>
		</div>
	</div>
</div>
<link href="{{ url('select2/css/select2.custom.min.css') }}" rel="stylesheet" type="text/css">
<script src="{{ url('select2/js/select2.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
	$('#KodeCabang').select2({
		width: "100%",
		placeholder: "Cabang",
		ajax: {
			url: base_url+'refund/getBranchCode',
			dataType: "json",
			type: "GET",
			data: function (params) {
				var query = {
					search: params.term,
					page: params.page || 1,
					pagination: {
						more: (params.page * 10) < params.count_filtered
					}
				}
				return query;
			}
		}
	});

	$('#tahunajaran').select2({
		width: "100%",
		placeholder: "Tahun Ajaran",
		ajax: {
			url: base_url+'refund/getTahunAjaran',
			dataType: "json",
			type: "GET",
			data: function (params) {
				var query = {
					search: params.term,
					page: params.page || 1,
					pagination: {
						more: (params.page * 10) < params.count_filtered
					}
				}
				return query;
			}
		}
	});

	$('#kodetransaksi').select2({
		width: "100%",
		placeholder: "Kode Transaksi",
		ajax: {
			url: base_url+'refund/getTransaksi',
			dataType: "json",
			type: "GET",
			data: function (params) {
				var query = {
					KodeCabang: $('#KodeCabang').val(),
					tahunajaran: $('#tahunajaran').val(),
					search: params.term,
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

$(document).ready(function(){
	$('#kodetransaksi,#tahunajaran').attr('disabled','disabled');
	load_data();
});

$("#KodeCabang").change(function() {
	if ($('#KodeCabang').val()=="" || $('#KodeCabang').val()==null) {
		$('#tahunajaran').attr('disabled','disabled');
	} else {
		$('#tahunajaran').removeAttr('disabled','disabled');
	}
});

$("#tahunajaran").change(function() {
	if ($('#tahunajaran').val()=="" || $('#tahunajaran').val()==null) {
		$('#kodetransaksi').attr('disabled','disabled');
	} else {
		$('#kodetransaksi').removeAttr('disabled','disabled');
	}
});

$("#kodetransaksi").change(function() {
	var formData = {};
	formData['kodetransaksi'] = $('#kodetransaksi').val();
	formData['tahunajaran'] = $('#tahunajaran').val();
	$.ajax({
		url: base_url+"refund/simpanmultiple",
		dataType: "json",
		type: 'post',
		data: formData,
		success: function (json) {
			load_data();
		}
	});
});

function load_data() {
	$.ajax({
		url : base_url+"refund/getTmpMultiple",
		type: 'GET',
		dataType: 'json',
		success: function(data){
			var jml_data = Object.keys(data.rows).length;
			var total = 0;
			if (jml_data > 0) {
				$('#data_barang').empty();
				
				$.each(data.rows, function(i, item) {

					var option = '<div class="input-control select" data-role="input-control">';
					option += '<select name="JenisRF" id="JenisRF'+item.RecID+'" onChange="JenisRefund(\''+item.RecID+'\')">';
					option += '<option value="">--Pilih Jenis refund</option>';
					if (item.JenisRefund==1) {
						option += '<option value="1" selected="selected">Salah Kode Cabang</option>';
					} else {
						option += '<option value="1" >Salah Kode Cabang</option>';
					}
					if (item.JenisRefund==2) {
						option += '<option value="2" selected="selected">Salah Kode Siswa</option>';
					} else {
						option += '<option value="2">Salah Kode Siswa</option>';
					}
					if (item.JenisRefund==3) {
						option += '<option value="3" selected="selected">Salah Nominal</option>';
					} else {
						option += '<option value="3">Salah Nominal</option>';
					}
					option += '</select>';
					option += '</div>';
					
					var input_VA = '<div class="input-control text" data-role="input-control">';
					if (item.NoVaBenar != null) {
						input_VA += '<input type="text" name="NoVa2" id="NoVa2'+item.RecID+'" onblur="NoVaRF('+item.RecID+')" onkeyup="angka(this);" value="'+item.NoVaBenar+'" disabled="disabled" maxlength="11">';
					} else {
						input_VA += '<input type="text" name="NoVa2" id="NoVa2'+item.RecID+'" onblur="NoVaRF('+item.RecID+')" onkeyup="angka(this);" value="" disabled="disabled" maxlength="11">';
					}
					input_VA += '</div>';

					var input_Nominal = '<div class="input-control text" data-role="input-control">';
					if (item.NominalRF != null) {
						input_Nominal += '<input type="text" class="Idr" name="Nominal2" id="Nominal2'+item.RecID+'" onblur="NominalRF('+item.RecID+')" value="'+item.NominalRF+'" disabled="disabled">';
					} else {
						input_Nominal += '<input type="text" class="Idr" name="Nominal2" id="Nominal2'+item.RecID+'" onblur="NominalRF('+item.RecID+')" value="" disabled="disabled">';
					}
					var selisi = isNaN(item.NominalRF-item.Nominal)?0:item.NominalRF-item.Nominal;
					input_Nominal += '</div>';
					var NominalSelisi = '<div class="input-control text" data-role="input-control">';
					NominalSelisi += '<input type="text" class="Idr" name="NominalSelisi" id="NominalSelisi'+item.RecID+'" disabled="disabled" value="'+selisi+'">';
					NominalSelisi += '</div>';
					
					var $tr = $('<tr>').append(
						$('<td style="text-align: center;width: 5px;">').text(i+1),
						$('<td style="text-align: center;" id="NoVa1'+item.RecID+'">').text(item.NoVA),
						$('<td style="text-align: center;">').text(item.TanggalTransaksi),
						$('<td style="text-align: center;" id="Nominal1'+item.RecID+'">').text(convertToRupiah(item.Nominal)),
						$('<td style="text-align: center;">').text(item.Description),
						$('<td style="text-align: center;">').html(option),
						$('<td style="text-align: center;">').html(input_VA),
						$('<td style="text-align: center;">').html(input_Nominal),
						$('<td style="text-align: center;">').html(NominalSelisi),
						$('<td class="hidden-print" style="text-align: center;">').html('<a href="javascript:void(0)" onclick="delete_data('+item.RecID+')">Cancel</a>'),
						$('<td style="display:none">').html('<input type="hidden" name="id" class="emp_checkbox" data-emp-id="'+item.RecID+'" value="'+item.RecID+'">')
					).appendTo('#data_barang');
					$(document).ready(function() {
						$(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
					});
					$(document).ready(function(){
						var getData = function (request, response) {
							$.ajax({
								url: base_url+"refund/searchnovabenar",
								dataType: "json",
								data: {
									q: request.term
								},
								success: function (data) {
									response($.map(data, function (item) {
										return {
											label: item.name,
											value: item.id
										};
									}));
								}
							});
						};

						var selectItem = function (event, ui) {
							document.getElementById('NoVa2'+item.RecID).value = ui.item.value;
						}

						$('#NoVa2'+item.RecID).autocomplete({
							source: getData,
							select: selectItem
						});
					});
				});
			} else {
				$('#data_barang').empty();
			}
		}
	});
};

function JenisRefund(event) {
	var JRF = $('#JenisRF'+event).val();
	var Nominal1 = document.getElementById('Nominal1'+event).innerHTML;
	var NoVa1 = document.getElementById('NoVa1'+event).innerHTML;
	if (JRF==1 || JRF==2) {
		$('#Nominal2'+event).val(Nominal1);
		$('#NoVa2'+event).val('');
		$('#Nominal2'+event).attr('disabled','disabled');
		$('#NoVa2'+event).removeAttr('disabled','disabled');
		document.getElementById('NominalSelisi'+event).value = "";
	} else {
		$('#NoVa2'+event).val(NoVa1);
		$('#Nominal2'+event).val('');
		$('#NoVa2'+event).attr('disabled','disabled');
		$('#Nominal2'+event).removeAttr('disabled','disabled');
	}
}

function NominalRF(event) {
	var Nominal1 = convertToAngka(document.getElementById('Nominal1'+event).innerHTML);
	var Nominal2 = convertToAngka(document.getElementById('Nominal2'+event).value);
	var total = (parseInt(Nominal2)-parseInt(Nominal1));
	if (Nominal1 >= Nominal2) {
		alert('Nominal refund terlalu kecil tidak sesuai dengan Nominal transaksi.');
		document.getElementById('Nominal2'+event).value = "";
		document.getElementById('Nominal2'+event).focus();
	} else {
		document.getElementById('NominalSelisi'+event).value = isNaN(total)?"":convertToRupiah(total);
	}
	if (isNaN(convertToAngka($('#Nominal2'+event).val()))) {
		document.getElementById('Nominal2'+event).value = "";
		document.getElementById('Nominal2'+event).focus();
	} else {
		var formData = {};
		formData['RecID'] = event;
		formData['NoVa1'] = document.getElementById('NoVa1'+event).innerHTML;
		formData['NoVa2'] = $('#NoVa2'+event).val();
		formData['Nominal1'] = convertToAngka(document.getElementById('Nominal1'+event).innerHTML);
		formData['Nominal2'] = convertToAngka($('#Nominal2'+event).val());
		formData['NominalSelisi'] = isNaN(convertToAngka($('#NominalSelisi'+event).val()))?0:convertToAngka($('#NominalSelisi'+event).val());
		formData['JenisRF'] = $('#JenisRF'+event).val();
		$.ajax({
			url: base_url+"refund/updateMultiple",
			dataType: "json",
			type: 'post',
			data: formData,
			success: function (json) {
				load_data();
			}
		});
	}
}

function NoVaRF(e) {
	var NoVa1 = document.getElementById('NoVa1'+e).innerHTML;
	var NoVa2 = document.getElementById('NoVa2'+e).value;

	if (NoVa1===NoVa2) {
		alert('NoVa refund tidak boleh sama dengan NoVa Transaksi');
		document.getElementById('NoVa2'+e).value = "";
		document.getElementById('NoVa2'+e).focus();
	} else {
		if (isNaN(convertToAngka($('#Nominal2'+e).val()))) {
			document.getElementById('Nominal2'+e).value = "";
			document.getElementById('Nominal2'+e).focus();
		} else {
			var formData = {};
			formData['RecID'] = e;
			formData['NoVa1'] = document.getElementById('NoVa1'+e).innerHTML;
			formData['NoVa2'] = $('#NoVa2'+e).val();
			formData['Nominal1'] = convertToAngka(document.getElementById('Nominal1'+e).innerHTML);
			formData['Nominal2'] = convertToAngka($('#Nominal2'+e).val());
			formData['NominalSelisi'] = isNaN(convertToAngka($('#NominalSelisi'+e).val()))?0:convertToAngka($('#NominalSelisi'+e).val());
			formData['JenisRF'] = $('#JenisRF'+e).val();
			$.ajax({
				url: base_url+"refund/updateMultiple",
				dataType: "json",
				type: 'post',
				data: formData,
				success: function (json) {
					load_data();
				}
			});
		}
	}
};

function delete_data(id) {
	if (confirm("Are you sure you want to delete this ?")) {
		$.ajax({
			url : base_url+"refund/deleteTmp",
			type: "POST",
			data: ({id:id}),
			dataType: "JSON",
			success: function(data)
			{
				load_data();
				console.log(data.pesan);
			}
		});
	}
};

function angka(e) {
	if (!/^[0-9]+$/.test(e.value)) {
		e.value = e.value.substring(0,e.value.length-1);
	}
}

function convertToRupiah(angka){
	var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
	var rev2    = '';
	for(var i = 0; i < rev.length; i++){
		rev2  += rev[i];
		if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
			rev2 += '.';
		}
	}
	return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
}

function convertToAngka(rp){return parseInt(rp.replace(/,.*|\D/g,''),10)}

function run(){
	var cb = document.getElementById("cb");
	if(document.getElementById("cekbox").checked && $('[name="NoVa2"]').length) {
		cb.disabled = false;
	}else{
		cb.disabled = true;
	} 
}

function saveData(){
	fCode = $('#form input,#form select,#form textarea');
	for ( var i = 0; i < fCode.length; i++ ) {
		if (fCode[i].value=="" && fCode[i].type!='hidden' && fCode[i].name!='KodeCabang'&& fCode[i].name!='tahunajaran'&& fCode[i].name!='kodetransaksi') {
			alert($('[name="'+fCode[i].name+'"]').attr('placeholder'));
			fCode[i].focus();
			return false;
		}
	}
	fCode = $('#form input,#form select,#form textarea');
	for ( var i = 0; i < fCode.length; i++ ) {
		$('[name='+fCode[i].name+']').removeAttr('disabled','disabled');
	}

	var employee = [];
	var formdata = {};
	$(".emp_checkbox").each(function() {
		employee.push($(this).data('emp-id'));
	});

	formdata['id'] = employee.join(",");
	formdata['namapembuatpernyataan'] = $('[name="namapembuatpernyataan"]').val();
	formdata['jabatanpembuatpernyataan'] = $('[name="jabatanpembuatpernyataan"]').val();
	formdata['telpcabang'] = $('[name="telpcabang"]').val();
	formdata['alamatcabang'] = $('[name="alamatcabang"]').val();
	formdata['Kronologi'] = $('[name="Kronologi"]').val();


	$.ajax({
		url: base_url+"refund/saveMultiple",
		dataType: "json",
		type: 'post',
		data: formdata,
		success: function (json) {
			printReport();
		}
	});
}

function showDiv(elem) {
	if(elem.value == '') {
		document.getElementById('displayrefund').style.display = "none";
	} else {
		document.getElementById('displayrefund').style.display = "block";
	}
}

function printReport() {
	var BranchTitle = '<h4>tes</h4>';
	BranchTitle += '<h5>tes</h5>';
	BranchTitle += '<h5>tes</h5>';
	var headerRefund = '<p>: '+$('#namapembuatpernyataan').val()+'</p>';
	headerRefund += '<p>: '+$('#jabatanpembuatpernyataan').val()+'</p>';
	headerRefund += '<p>: '+$('#alamatcabang').val()+'</p>';
	$('.BranchTitle').html(BranchTitle);
	$('.headerRefund').html(headerRefund);
	window.print();
	load_data();
	$('#form')[0].reset();
	document.getElementById("cb").disabled = true;
}
</script>
<style type="text/css">
.display-print {
	display: none;
}
@media print {
	@page {size: A4;margin: 0px auto;}
	.select2-container--default .select2-selection--single {
		border: none;
		padding: 0px;
	}
	.select2-container--default .select2-selection--single .select2-selection__arrow b {
		display: none;
	}
	html, body {
		-webkit-print-color-adjust: exact;
		zoom: 90%;
		height: 100%;
		margin: 15px !important;
		padding: 0 !important;
		overflow: hidden;
	}
	a.page_break {page-break-after: always !important;}
	#page-wrapper {
		margin-left: 0px;
	}
	#sidebar,.metro .navigation-bar,.hidden-print {
		display: none;
	}
	#wrapper {
		padding-top: unset;
	}
	#wrapper div {
		margin-left: unset;
	}
	.metro .span5, .metro .size5 {
		width: 380px!important;
	}
	.metro .span11, .metro .size11 {
		width: 860px!important;
	}
	.metro .input-control.select select, .metro .input-control.textarea select, .metro .input-control.select textarea, .metro .input-control.textarea textarea,.metro .input-control.text input, .metro .input-control.password input, .metro .input-control.file input, .metro .input-control.email input, .metro .input-control.tel input, .metro .input-control.number input {
		border: unset;
		background: unset;
		min-height: unset;
	}
	textarea {border-style: none;border-color: Transparent;overflow: auto;resize: none;}
    select {-moz-appearance: none;-webkit-appearance:none;}
    select::-ms-expand {display: none;}
    #tableReport .table {
        border-width: 1px;border-style: solid;border-collapse: collapse;border-color: #d6ba93;overflow-x: unset;min-height: 0.01%;
    }
    .table.striped tbody tr:nth-child(odd) {background: #f0f0f0}
    .table.bordered td, .table.bordered th {
        border: 1px #ddd solid;
    }
    table {
    	width: 100% !important;
    }
    .display-print {
    	display: block;
    }
}
</style>