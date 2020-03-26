<form action="#" id="form" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-pencil"> Ubah Detail Pengiriman</i></p>
        	<legend></legend>
            </div>
        </div>
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
                <input type="hidden" name="PR_Number" id="PR_Number" class="form-control">
                <input type="hidden" name="Branch" id="Branch" class="form-control">
        </div>
        <div class="form-group">
            <div class="col-lg-5">
                <select id="DN" name="DN" class="form-control">
                   <option value=""> - - Pilih No Pengiriman - - </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success print-hidden" onclick="Edit_DO()"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<script type="text/javascript">

$(document).ready(function(){
    get_item();
});

$(function () {
    $('#Cabang').select2();
    $('#PR').select2();
    $('#DN').select2();
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
    var PR = e.target.value;
    $.getJSON(base_url+"Barcode/get_dn/"+PR, function(json){
        $('#DN').empty();
        $('#DN').append($('<option>').text("- - Pilih No Pengiriman - -"));
        $.each(json, function(i, obj){
        $('#DN').append($('<option>').text(obj.DO_Number).attr('value', obj.DO_Number));
        });
    });
    //$('#Branch').val(Cabang);
});

$("#PR").change(function(e) {
    var PR_Number = e.target.value;
    $('#PR_Number').val(PR_Number);
});

function Edit_DO() {
    dn = $('#DN').val();
    //alert(dn);
    if(dn == '' || dn == '- - Pilih No Pengiriman - -'){
        alert('Pilih Nomor Pengiriman !!');
    } else {
        redirectPost(base_url+'Logistics/edit_do',{dn:window.btoa(dn),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),kode:window.btoa(1)})
    }
}
</script>