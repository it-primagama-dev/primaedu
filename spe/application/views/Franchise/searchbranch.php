<form action="#" id="myform" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-search"> Data Cabang</i></p>
        	<legend></legend>
            </div>
            <!-- <div id="content">
                 <h3>Hello, this is a H3 tag</h3>

                <p>a pararaph</p>
            </div>
            <div id="editor"></div>
            <button id="cmd">generate PDF</button> -->
        </div>
    </div>
</div>
<div class="row" id="searchdiv" style="display: none;">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
                <label>Pilih Cabang</label>
                <select id="PBranchCode" name="PBranchCode" class="form-control">
                   <option value=""> - - Pilih Cabang - - </option>
                </select>
                <input type="hidden" id="UserGroup" value="<?php echo $this->session->userdata('UserGroup'); ?>">
                <input type="hidden" id="KodeCabang" value="<?php echo $this->session->userdata('KodeAreaCabang'); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" id="btnn" class="btn btn-success print-hidden" onclick="load_data()"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
        </div>
        <legend></legend>
    </div>
</div>
<div class="row" id="editdiv" style="display: none;">
    <div class="col-lg-12">
         <div class="form-group">
            <div class="col-lg-12">
            <legend><p style="font-size: 20px; font-weight: bold;"><i class="fa"> Detail Cabang</i></p></legend>
            <input type="hidden" name="FFID" id="FFID">
            </div>
            <div class="col-lg-3">
                <label>Kode Cabang</label>
                <input type="text" id="BranchCode" name="BranchCode" maxlength="4" class="form-control" placeholder=" 4 Digit Numerik" readonly="readonly">
            </div>
            <div class="col-lg-5">
                <label>Nama Cabang</label>
                <input type="text" id="BranchName" name="BranchName" class="form-control" placeholder=" Nama Cabang">
            </div>
            <div class="col-lg-2">
                <label>Status</label>
                <select id="Status" name="Status" class="form-control">
                   <option value="">---Pilih Status---</option>
                   <option value="1">Aktif</option>
                   <option value="0">Tidak Aktif</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label>Sektor</label>
                <select id="Sektor" name="Sektor" class="form-control">
                    <option value=""> - - Pilih Sektor - - </option>
                   <option value="1">Sektor 1</option>
                   <option value="2">Sektor 2</option>
                   <option value="3">Sektor 3</option>
                   <option value="4">Sektor 4</option>
                   <option value="5">Sektor 5</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-3">
                <label>Area</label>
                <select id="Area" name="Area" class="form-control">
                    <option value=""> - - Pilih Area - - </option>
                </select>
            </div>
            <div class="col-lg-4">
                <label>Rekening BCA</label>
                <input type="text" id="RekBCA" name="RekBCA" class="form-control" placeholder=" No Rek BCA">
            </div>
            <div class="col-lg-5">
                <label>Rekening BCA Atas Nama</label>
                <input type="text" id="RekBCAName" name="RekBCAName" class="form-control" placeholder=" Rek BCA Atas Nama">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-3">
                <label>Nama Bank Non-BCA</label>
                <select id="BankName" name="BankName" class="form-control">
                   <option>---Pilih Bank---</option>
                </select>
            </div>
            <div class="col-lg-4">
                <label>Rekening Non-BCA</label>
                <input type="text" id="RekNonBCA" name="RekNonBCA" class="form-control" placeholder=" No Rek Non-BCA">
            </div>
            <div class="col-lg-5">
                <label>Rekening Non-BCA Atas Nama</label>
                <input type="text" id="RekNonBCAName" name="RekNonBCAName" class="form-control" placeholder=" Rek Non-BCA Atas Nama">
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-12">
            <br>
            <legend><p style="font-size: 20px; font-weight: bold;"><i class="fa"> Detail Kontak & Alamat</i></p></legend>
            </div>
            <div class="col-lg-6">
                <label>Email Cabang</label>
                <input type="text" id="Email" name="Email" class="form-control" placeholder=" Email">
            </div>
            <div class="col-lg-6">
                <label>Telepon Cabang</label>
                <input type="text" id="NoTelp" name="NoTelp" class="form-control" placeholder=" No. Telepon">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-6">
                <label>Alamat</label>
                <textarea id="AlamatCabang" name="AlamatCabang" rows="7" class="form-control" placeholder="Nama Jalan & RT/RW"></textarea>
            </div>
            <div class="col-lg-6">
                <label>Propinsi</label>
                <select id="Propinsi" name="Propinsi" class="form-control">
                   <option>---Pilih Propinsi---</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label>Kota</label>
                <select id="Kota" name="Kota" class="form-control">
                   <option>---Pilih Kota---</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label>Kode Pos</label>
                <input type="text" id="KodePos" name="KodePos" class="form-control" placeholder=" Kode Pos">
            </div>
        </div> 
        <div class="form-group">
            <div class="col-lg-12">
            <br>
            <legend><p style="font-size: 20px; font-weight: bold;"><i class="fa"> Detail Franchisee</i></p></legend>
            </div>
            <div class="col-lg-6">
                <label>Nama Franchisee</label>
                <input type="text" id="NamaFranchisee" name="NamaFranchisee" class="form-control" placeholder=" Nama Franchisee">
            </div>
            <div class="col-lg-6">
                <label>Telepon Franchisee</label>
                <input type="text" id="NoTelpFranchisee" name="NoTelpFranchisee" class="form-control" placeholder=" No. Telepon Franchisee">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-6">
                <label>Alamat Franchisee</label>
                <textarea id="AlamatFranchisee" name="AlamatFranchisee" rows="4" class="form-control" placeholder="Nama Jalan & RT/RW"></textarea>
            </div>
            <div class="col-lg-6">
                <label>Email Franchisee</label>
                <input type="text" id="EmailFranchisee" name="EmailFranchisee" class="form-control" placeholder=" Email Franchisee">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label class="control-label">No. KTP</label>
                <input type="hidden" id="tmpktp" name="tmpktp">
                <input type="text" id="NoKTP" name="NoKTP" class="form-control" placeholder=" No. KTP">
                <br>
                <input type="file" id="PicKTP" name="PicKTP" class="form-control">
            </div><!-- 
            <div class="col-md-2">
                <img src="" id="ktptumb" alt="no-image" class="img-responsive img imgPicKTP">
            </div> -->
            <div class="col-md-6">
                <label class="control-label">No. NPWP</label>
                <input type="hidden" id="tmpnpwp" name="tmpnpwp">
                <input type="text" id="NoNPWP" name="NoNPWP" class="form-control" placeholder=" No. NPWP">
                <br>
                <input type="file" id="PicNPWP" name="PicNPWP" class="form-control">
            </div><!-- 
            <div class="col-md-2">
                <img src="" id="npwptumb" alt="no-image" class="img-responsive img imgPicNPWP">
            </div> -->
        </div>
        <div class="form-group">
            <div class="col-lg-6">
                <label>Status Kepemilikan</label>
                <select id="StatusKepemilikan" name="StatusKepemilikan" class="form-control">
                   <option value="">---Pilih Status Kepemilikan---</option>
                   <option value="Perorangan">Perorangan</option>
                   <option value="CV">CV</option>
                   <option value="PT">PT</option>
                   <option value="Yang Lain">Yang Lain</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label>Yang Lain</label>
                <input type="text" id="YangLain" name="YangLain" class="form-control" placeholder=" Info Yang Lain">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4">
                <label>Nama Pemimpin</label>
                <input type="text" id="NamaPemimpin" name="NamaPemimpin" class="form-control" placeholder=" Nama Pemimpin">
            </div>
            <div class="col-lg-4">
                <label>No. SIUP</label>
                <input type="text" id="NoSIUP" name="NoSIUP" class="form-control" placeholder=" No. SIUP">
            </div>
            <div class="col-lg-4">
                <label>No. TDP (Tanda Daftar Perusahaan)</label>
                <input type="text" id="NoTDP" name="NoTDP" class="form-control" placeholder=" No. TDP">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12">
            <br>
            <legend><p style="font-size: 20px; font-weight: bold;"><i class="fa"> Organisasi Cabang</i></p></legend>
            </div>
            <div class="col-lg-6">
                <label>Nama Manager</label>
                <input type="text" id="NamaManager" name="NamaManager" class="form-control" placeholder=" Nama Manager">
            </div>
            <div class="col-lg-6">
                <label>Telepon Manager</label>
                <input type="text" id="NoTelpManager" name="NoTelpManager" class="form-control" placeholder=" No. Telepon Manager">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-6">
                <label>Alamat Manager</label>
                <textarea rows="4" id="AlamatManager" name="AlamatManager" class="form-control" placeholder="Nama Jalan & RT/RW"></textarea>
            </div>
            <div class="col-lg-6">
                <label>PAC</label>
                <input type="text" id="PAC" name="PAC" class="form-control" placeholder=" Nama PAC">
            </div>
            <div class="col-lg-6">
                <label>Telepon PAC</label>
                <input type="text" id="NoTelpPAC" name="NoTelpPAC" class="form-control" placeholder=" No. Telepon PAC">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-6">
                <label>I-Smart Tetap</label>
                <input type="text" id="iSmart" name="iSmart" class="form-control" placeholder=" Nama iSmart">
            </div>
            <div class="col-lg-6">
                <label>Telepon I-Smart</label>
                <input type="text" id="NoTelpISmart" name="NoTelpISmart" class="form-control" placeholder=" No. Telepon I-Smart">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12">
            <br>
            <legend><p style="font-size: 20px; font-weight: bold;"><i class="fa"> Gedung</i></p></legend>
            </div>
            <div class="col-lg-6">
                <label>Bentuk Bangunan</label>
                <select id="BentukB" name="BentukB" class="form-control">
                   <option value="">---Pilih Bentuk Bangunan---</option>
                   <option value="Rumah">Rumah</option>
                   <option value="Ruko">Ruko</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label>Status Bangunan</label>
                <select id="StatusB" name="StatusB" class="form-control">
                   <option value="">---Pilih Status Bangunan---</option>
                   <option value="Milik Sendiri">Milik Sendiri</option>
                   <option value="Sewa">Sewa</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12">
            <br>
            <legend><p style="font-size: 20px; font-weight: bold;"><i class="fa"> Franchise Fee</i></p></legend>
            </div>
            <div class="col-lg-4">
                <label>Tanggal Berlaku (Tangal Awal)</label>
                <input type="text" name="TglBerlaku" id="TglBerlaku" class="form-control" value="">
            </div>
            <div class="col-lg-4">
                <label>Tanggal Berakhir</label>
                <input type="text" name="TglBerakhir" id="TglBerakhir" class="form-control" value="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4">
                <label>Nilai Franchisee</label>
                <input type="text" id="NilaiFF" name="NilaiFF" class="Idr form-control" onkeyup="calculate()" placeholder=" Nilai Franchisee">
            </div>
            <div class="col-lg-4">
                <label>Diskon</label>
                <input type="text" id="Diskon" name="Diskon" class="Idr form-control" onkeyup="calculate()" placeholder=" Diskon">
            </div>
            <div class="col-lg-4">
                <label>DPP</label>
                <input type="text" id="DPP" name="DPP" class="form-control" placeholder=" DPP" readonly="readonly">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4">
                <label>PPn</label>
                <input type="text" id="PPn" name="PPn" class="form-control" placeholder=" PPn" readonly="readonly">
            </div><!-- 
            <div class="col-lg-4">
                <label>Nilai Franchisee + PPn</label>
                <input type="text" id="NilaiTotal" name="NilaiTotal" class="form-control" readonly="readonly">
            </div> -->
            <div class="col-lg-4">
                <label>Total Tagihan</label>
                <input type="text" id="Tagihan" name="Tagihan" class="form-control" readonly="readonly">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4">
                <label>Metode Pembayaran</label>
                <select id="Metode" name="Metode" class="form-control" disabled="disabled">
                   <option value="">--- Pilih Metode Pembayaran ---</option>
                   <option value="Cash">Cash</option>
                   <option value="Termin">Termin</option>
                </select>
            </div>
            <div class="col-lg-4">
                <label>Tenor</label>
                <select id="Tenor" name="Tenor" class="form-control" disabled="disabled">
                   <option value="">--- Pilih Tenor ---</option>
                   <option value="1">1 X</option>
                   <option value="2">2 X</option>
                   <option value="3">3 X</option>
                   <option value="4">4 X</option>
                   <option value="5">5 X</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div id="divtenor" class="col-lg-8" style="display: none;">
                <label>Tabel Tenor</label>
                <table class="table table-bordered table-hover" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 20%; text-align: center;">Tenor Ke-</th>
                            <th style="text-align: center;">Nominal</th>
                            <th style="text-align: center;">Jatuh Tempo</th>
                        </tr>
                    </thead>
                    <tbody id="ttenor"></tbody>
                </table>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4">
                <label>No Akta Perjanjian Franchisee / MOU</label>
                <input type="text" id="NoMOU" name="NoMOU" class="form-control" placeholder=" No MOU">
            </div>
            <div class="col-lg-4">
                <label>Tanggal MOU</label>
                <input type="text" id="TglMOU" name="TglMOU" class="form-control" value="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-8">
                <label>Keterangan</label>
                <textarea rows="4" id="Keterangan" name="Keterangan" class="form-control" placeholder="Keterangan"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12">
            <br>
            <legend><p style="font-size: 20px; font-weight: bold;"><i class="fa"> Dokumen Legal</i></p></legend>
            </div>
            <div class="col-lg-3">
                <label>Form Cabang 01</label>
                <img src="" id="FormCabang01" alt="no-image" class="img-responsive img imgFormCabang01">
            </div>
            <div class="col-lg-3">
                <label>Form Cabang  02</label>
                <img src="" id="FormCabang02" alt="no-image" class="img-responsive img imgFormCabang02">
            </div>
            <div class="col-lg-3">
                <label>Surat Sanggup</label>
                <img src="" id="SuratSanggup" alt="no-image" class="img-responsive img imgSuratPernyataan">
            </div>
            <div class="col-lg-3">
                <label>Surat Pernyataan</label>
                <img src="" id="SuratPernyataan" alt="no-image" class="img-responsive img imgSuratPernyataan">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-3">
                <label>Surat Pernyataan Rekening</label>
                <img src="" id="SuratPernyataanRek" alt="no-image" class="img-responsive img imgSuratPernyataanRek">
            </div>
            <div class="col-lg-3">
                <label>Pengurus Cabang</label>
                <img src="" id="PengurusCabang" alt="no-image" class="img-responsive img imgPengurusCabang">
            </div>
            <div class="col-lg-3">
                <label>Form Survey</label>
                <img src="" id="FormSurvey" alt="no-image" class="img-responsive img imgFormSurvey">
            </div>
            <div class="col-lg-3">
                <label>Foto Kantor</label>
                <img src="" id="FotoKantor" alt="no-image" class="img-responsive img imgFotoKantor">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-3">
                <label>Form Diskon</label>
                <img src="" id="FormDiskon" alt="no-image" class="img-responsive img imgFormDiskon">
            </div>
            <div class="col-lg-3">
                <label>Foto KK</label>
                <img src="" id="FotoKK" alt="no-image" class="img-responsive img imgFotoKK">
            </div>
            <div class="col-lg-3">
                <label>Foto KTP</label>
                <img src="" id="FotoKTP" alt="no-image" class="img-responsive img imgFotoKTP">
            </div>
            <div class="col-lg-3">
                <label>Foto NPWP</label>
                <img src="" id="FotoNPWP" alt="no-image" class="img-responsive img imgFotoNPWP">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-3">
                <label>Lembar Persetujuan</label>
                <img src="" id="LembarSetuju" alt="no-image" class="img-responsive img imgLembarSetuju">
            </div>
            <div class="col-lg-3">
                <label>Foto Tanda Tangan</label>
                <img src="" id="FotoTT" alt="no-image" class="img-responsive img imgFotoTT">
            </div>
            <div class="col-lg-3">
                <label>Foto Daftar Hadir</label>
                <img src="" id="DaftarHadir" alt="no-image" class="img-responsive img imgDaftarHadir">
            </div>
            <div class="col-lg-3">
                <label>Akta Notaris</label><br>
                <a id="SuratNotaris">Download Akta Notaris</a>
            </div>
        </div>
        <legend></legend>
    </div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/autoNumeric.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<style>
.img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  height: 150px;
  width: 150px;
}
</style>
<script type="text/javascript">
var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#cmd').click(function () {
    doc.fromHTML($('#content').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save('sample-file.pdf');
});

$(document).ready(function(){
    $("#myform :input").prop("disabled", true);
    $("#PBranchCode,#btnn").prop("disabled", false);
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    get_cabang();
    get_area();
    get_propinsi();
    get_bank();
    get_kotaall();
    $('#YangLain,#NamaPemimpin,#NoSIUP,#NoTDP').attr('disabled','disabled').removeAttr('onclick');

    if($('#UserGroup').val()==11){
        $("#searchdiv").css("display","none");
        load_data();
    } else {
        $("#searchdiv").css("display","block");
    }
});

$(function () {
    $('#PBranchCode').select2();
});

function get_cabang() {
$.getJSON(base_url+"Franchise/get_cabang", function(json){
    $('#PBranchCode').empty();
    $('#PBranchCode').append($('<option>').text("- - Pilih Cabang - -").attr('value', ''));
    $.each(json, function(i, obj){
    $('#PBranchCode').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang+' - '+obj.Alamat).attr('value', obj.KodeAreaCabang));
    });
});
}

function get_area() {
$.getJSON(base_url+"Franchise/get_area", function(json){
    $('#Area').empty();
    $('#Area').append($('<option>').text("- - Pilih Area - -").attr('value', ''));
    $.each(json, function(i, obj){
        $('#Area').append($('<option>').text(obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
    });
});
}

function get_bank() {
$.getJSON(base_url+"Franchise/get_bank", function(json){
    $('#BankName').empty();
    $('#BankName').append($('<option>').text("- - Pilih Bank - -").attr('value', ''));
    $.each(json, function(i, obj){
        $('#BankName').append($('<option>').text(obj.Nama).attr('value', obj.Kode));
    });
});
}

function get_propinsi() {
$.getJSON(base_url+"Franchise/get_propinsi", function(json){
    $('#Propinsi').empty();
    $('#Propinsi').append($('<option>').text("- - Pilih Propinsi - -").attr('value', ''));
    $.each(json, function(i, obj){
    $('#Propinsi').append($('<option>').text(obj.NamaPropinsi).attr('value', obj.RecID));
    });
});
}

function get_kotaall() {
$.getJSON(base_url+"Franchise/get_kotaall", function(json){
    $('#Kota').empty();
    $('#Kota').append($('<option>').text("- - Pilih Kota - -").attr('value', ''));
    $.each(json, function(i, obj){
    $('#Kota').append($('<option>').text(obj.NamaKotaKab).attr('value', obj.RecID));
    });
});
}

$("#Propinsi").change(function(e) {
    var Propinsi = e.target.value;
    $.getJSON(base_url+"Franchise/get_kota/"+Propinsi, function(json){
        $('#Kota').empty();
        //$('#Kota').append($('<option>').text("- - Pilih Kota - -").attr('value', ''));
        $.each(json, function(i, obj){
        $('#Kota').append($('<option>').text(obj.NamaKotaKab).attr('value', obj.RecID));
        });
    });
});

function calculate(){
    var Dpp = document.getElementById('DPP');
    var NilaiFranchisee,Diskon = 0; 
    NilaiFranchisee = document.getElementById('NilaiFF');
    NilaiFranchisee.value = NilaiFranchisee.value;
    Diskon = document.getElementById('Diskon');

    Net = NilaiFranchisee.value.replace(/,.*|[^0-9]/g,'') - Diskon.value.replace(/,.*|[^0-9]/g,'');
    Pajak = Net*10/100;
    Tag = Net + Pajak;

    var NetFix = Net.toString().split('').reverse().join('');
    var ResultNet  = NetFix.match(/\d{1,3}/g);
    var ResultNet  = 'Rp ' + ResultNet.join('.').split('').reverse().join('') + ',00';

    DiskonOri = document.getElementById('Diskon').value;
    Dpp.value = ResultNet;
    Diskon.value = DiskonOri;

    var PajakFix = Pajak.toString().split('').reverse().join('');
    var ResultPajak  = PajakFix.match(/\d{1,3}/g);
    var ResultPajak  = 'Rp ' + ResultPajak.join('.').split('').reverse().join('') + ',00';
    var pajak = document.getElementById('PPn');
    pajak.value = ResultPajak;

    Total = +NilaiFranchisee.value.replace(/,.*|[^0-9]/g,'') + +pajak.value.replace(/,.*|[^0-9]/g,'');
    var TotalFix = Total.toString().split('').reverse().join('');
    var ResultTotal  = TotalFix.match(/\d{1,3}/g);
    var ResultTotal  = 'Rp ' + ResultTotal.join('.').split('').reverse().join('') + ',00';
    /*var total = document.getElementById('NilaiTotal');
    total.value = ResultTotal;*/

    //Tag = +Net.value.replace(/,.*|[^0-9]/g,'') + +pajak.value.replace(/,.*|[^0-9]/g,'');
    var TagFix = Tag.toString().split('').reverse().join('');
    var ResultTag  = TagFix.match(/\d{1,3}/g);
    var ResultTag  = 'Rp ' + ResultTag.join('.').split('').reverse().join('') + ',00';
    var Tagihan = document.getElementById('Tagihan');
    Tagihan.value = ResultTag;
    }

$("#StatusKepemilikan").change(function(e) {
    var Id = e.target.value;
    //alert(Id);
    if(Id=='Perorangan'){
        $("#YangLain").attr('disabled',true);
        $("#NoSIUP").attr('disabled',true);
        $("#NoTDP").attr('disabled',true);
        $("#NamaPemimpin").attr('disabled',true);
    } else if(Id=='CV' || Id=='PT'){
        $("#YangLain").attr('disabled',true);
        $("#NoSIUP").removeAttr('disabled','disabled');
        $("#NoTDP").removeAttr('disabled','disabled');
        $("#NamaPemimpin").removeAttr('disabled','disabled');
    } else if(Id=='Yang Lain'){
        $("#YangLain").removeAttr('disabled','disabled');
        $("#NoSIUP").attr('disabled',true);
        $("#NoTDP").attr('disabled',true);
        $("#NamaPemimpin").attr('disabled',true);
    } else {
        $("#YangLain").attr('disabled',true);
        $("#NoSIUP").attr('disabled',true);
        $("#NoTDP").attr('disabled',true);
        $("#NamaPemimpin").attr('disabled',true);
    }

});
$(function(){
    var d = new Date();
    var n = d.getFullYear();
    $('#TglMOU').datepicker({
        dateFormat: 'yy-m-d',
        changeMonth: true,
        changeYear: true,
        yearRange: "2015:"+n
    });
})

$(function() {
    $( "#TglBerlaku" ).datepicker({
      dateFormat: 'yy-m-d',
      defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        var date = new Date(selectedDate);
        /*    day  = date.getDate(),  
            month = date.getMonth() + 1,              
            year =  date.getFullYear();*/
        fix = date.getFullYear()+5 + '-' + '06' + '-' + '30';
        
        //alert(fix)
        //var YearDate = '01/24/2019';
        $( "#TglBerakhir" ).datepicker( "option", "minDate", fix );
      }
    });
    $( "#TglBerakhir" ).datepicker({
      dateFormat: 'yy-m-d',
      defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#TglBerlaku" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });

var userfile = {
    PicKTP:{},
    PicNPWP:{},
};

$("document").ready(function() {
    //$(".img").attr("src",base_url+"assets/images/no-image.png");
    $("input[type=file]").change(function(e) {
        if (e) {
            var vm = this;
            index = e.currentTarget.id;
            vm.invalidFile = false;
            let files = e.target.files || e.dataTransfer.files;
            
            vm.myFile = files[0];
            userfile[index].name = files[0].name;
            userfile[index].type = files[0].type;

            var reader = new FileReader();
            reader.onloadend = function(event) {
                userfile[index].file = event.target.result;
                if (userfile.PicKTP.file) {
                    $(".imgPicKTP").attr("src",userfile.PicKTP.file).attr('id','is_picKTP');
                }
                if (userfile.PicNPWP.file) {
                    $(".imgPicNPWP").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP');
                }
            };
            reader.readAsDataURL(vm.myFile);
        }
    });
});

function load_data()
{
    $(".text-danger").remove();
        $('#editdiv').css('display','block');
    if($('[name="PBranchCode"]').val() == "" && $('#KodeCabang').val() == "") {
        $('#editdiv').css('display','none');
        $('[name="PBranchCode"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Pilih Cabang !</p>');
        $('[name="PBranchCode"]').focus();
        return false;
    } else {
        $('#Area,#Propinsi,#Kota,#BankName').select2();
        $('#editdiv').css('display','block');
        $("#divtenor").css('display','none');
        $('#ttenor').empty();

        if($('#KodeCabang').val() == ''){
            BranchCode = $('#PBranchCode').val();
        } else {
            BranchCode = $('#KodeCabang').val();
        }
        //alert(BranchCode);
        url = base_url + "Franchise/loadeditbranch";
        $.ajax({
            url : url,
            type: "POST",
            data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"BranchCode":window.btoa(BranchCode)}),
            dataType: "JSON",
            success: function(data)
            {
                $.each(data.rows, function(i, data) {
                //alert(data.KodeAreaCabang);
                $('[name="BranchCode"]').val(data.KodeAreaCabang);
                $('[name="BranchName"]').val(data.NamaAreaCabang);
                $('[name="Sektor"]').val(data.Sektor);
                $('[name="RekBCA"]').val(data.NoRekBCA);
                $('[name="RekBCAName"]').val(data.NamaRekBCA);
                $('[name="RekNonBCA"]').val(data.NoRekNonBCA);
                $('[name="RekNonBCAName"]').val(data.NamaRekNonBCA);
                $('[name="Email"]').val(data.Email);
                $('[name="NoTelp"]').val(data.NoTelp);
                $('[name="AlamatCabang"]').val(data.Alamat);
                $('[name="KodePos"]').val(data.KodePos);
                $('[name="NamaFranchisee"]').val(data.NamaFranchisee);
                $('[name="NoTelpFranchisee"]').val(data.NoTelpFranchisee);
                $('[name="EmailFranchisee"]').val(data.EmailFranchisee);
                $('[name="AlamatFranchisee"]').val(data.AlamatFranchisee);
                $('[name="NoKTP"]').val(data.NoKTP);
                $('[name="NoNPWP"]').val(data.NoNPWP);
                $('[name="YangLain"]').val(data.YStatusKepemilikan);
                $('[name="NamaPemimpin"]').val(data.Direktur);
                $('[name="NoSIUP"]').val(data.SIUP);
                $('[name="NoTDP"]').val(data.TDP);
                $('[name="NamaManager"]').val(data.NamaManager);
                $('[name="NoTelpManager"]').val(data.NoHandPhone);
                $('[name="AlamatManager"]').val(data.AlamatKC);
                $('[name="PAC"]').val(data.PAC);
                $('[name="NoTelpPAC"]').val(data.telpPAC);
                $('[name="iSmart"]').val(data.Ismart);
                $('[name="NoTelpISmart"]').val(data.TelpIsmart);
                $('[name="TglBerlaku"]').val(data.TanggalBerlaku);
                $('[name="TglBerakhir"]').val(data.TanggalBerakhir);
                $('[name="NilaiFF"]').val(convertToRupiah(data.Value));
                $('[name="tmpktp"]').val(data.KTP);
                $('[name="tmpnpwp"]').val(data.NPWP);

                if(data.Discount == null || data.Discount == '' || data.Discount == 0){
                    Diskon = 0;
                    $('[name="Diskon"]').val(convertToRupiah(0));
                } else {
                    Diskon = data.Discount;
                    $('[name="Diskon"]').val(convertToRupiah(data.Discount));
                }
                FF = data.Value;
                PPn = (FF-Diskon)*10/100;
                DPP = FF-Diskon;
                Total = (FF-0) + PPn;
                $('[name="PPn"]').val(convertToRupiah(PPn));
                $('[name="DPP"]').val(convertToRupiah(DPP));/*
                $('[name="NilaiTotal"]').val(convertToRupiah(Total));*/
                $('[name="NoMOU"]').val(data.MOUNumber);
                $('[name="TglMOU"]').val(data.DateMOU);
                $('[name="Keterangan"]').val(data.Description);
                $('[name="FFID"]').val(data.FFID);
                $('[name="Tagihan"]').val(convertToRupiah(data.TotalValue));

                //alert(data.KTP);
                if(data.FormCabang01 == null){
                    $("#FormCabang01").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#FormCabang01").attr("src",base_url+"assets/upload/legal/"+data.FormCabang01);
                }

                if(data.FormCabang02 == null){
                    $("#FormCabang02").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#FormCabang02").attr("src",base_url+"assets/upload/legal/"+data.FormCabang02);
                }

                if(data.SuratSanggup == null){
                    $("#SuratSanggup").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#SuratSanggup").attr("src",base_url+"assets/upload/legal/"+data.SuratSanggup);
                }

                if(data.SuratPernyataan == null){
                    $("#SuratPernyataan").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#SuratPernyataan").attr("src",base_url+"assets/upload/legal/"+data.SuratPernyataan);
                }

                if(data.SuratPernyataanRek == null){
                    $("#SuratPernyataanRek").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#SuratPernyataanRek").attr("src",base_url+"assets/upload/legal/"+data.SuratPernyataanRek);
                }

                if(data.PengurusCabang == null){
                    $("#PengurusCabang").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#PengurusCabang").attr("src",base_url+"assets/upload/legal/"+data.PengurusCabang);
                }

                if(data.FormSurvey == null){
                    $("#FormSurvey").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#FormSurvey").attr("src",base_url+"assets/upload/legal/"+data.FormSurvey);
                }

                if(data.FotoKantor == null){
                    $("#FotoKantor").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#FotoKantor").attr("src",base_url+"assets/upload/legal/"+data.FotoKantor);
                }

                if(data.FormDiskon == null){
                    $("#FormDiskon").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#FormDiskon").attr("src",base_url+"assets/upload/legal/"+data.FormDiskon);
                }

                if(data.FotoKK == null){
                    $("#FotoKK").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#FotoKK").attr("src",base_url+"assets/upload/legal/"+data.FotoKK);
                }

                if(data.FotoKTP == null){
                    $("#FotoKTP").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#FotoKTP").attr("src",base_url+"assets/upload/legal/"+data.FotoKTP);
                }

                if(data.FotoNPWP == null){
                    $("#FotoNPWP").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#FotoNPWP").attr("src",base_url+"assets/upload/legal/"+data.FotoNPWP);
                }

                if(data.LembarPersetujuan == null){
                    $("#LembarSetuju").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#LembarSetuju").attr("src",base_url+"assets/upload/legal/"+data.LembarPersetujuan);
                }

                if(data.FotoTandaTangan == null){
                    $("#FotoTT").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#FotoTT").attr("src",base_url+"assets/upload/legal/"+data.FotoTandaTangan);
                }

                if(data.DaftarHadir == null){
                    $("#DaftarHadir").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#DaftarHadir").attr("src",base_url+"assets/upload/legal/"+data.DaftarHadir);
                }
                
                if(data.SuratNotaris != null){
                    $("#SuratNotaris").attr("href",base_url + 'Legal/download/'+data.SuratNotaris)
                } else {
                    $("#SuratNotaris").attr("href", "#")
                }
                
                if ($('[name="Status"]').find("option[value='" + data.Aktif + "']").length) {
                    $('[name="Status"]').val(data.Aktif).trigger('change');
                } else { 
                    var newOption = new Option(data.Aktif, data.Aktif, true, true);
                    $('[name="Status"]').append(newOption).trigger('change');
                } 

                if ($('[name="Area"]').find("option[value='" + data.Area + "']").length) {
                    $('[name="Area"]').val(data.Area).trigger('change');
                } else { 
                    var newOption = new Option(data.Area, data.Area, true, true);
                    $('[name="Area"]').append(newOption).trigger('change');
                } 

                if ($('[name="BankName"]').find("option[value='" + data.KodeBankNonBCA + "']").length) {
                    $('[name="BankName"]').val(data.KodeBankNonBCA).trigger('change');
                } else { 
                    var newOption = new Option(data.KodeBankNonBCA, data.KodeBankNonBCA, true, true);
                    $('[name="BankName"]').append(newOption).trigger('change');
                } 

                if ($('[name="Propinsi"]').find("option[value='" + data.Propinsi + "']").length) {
                    $('[name="Propinsi"]').val(data.Propinsi).trigger('change');
                } else { 
                    var newOption = new Option(data.Propinsi, data.Propinsi, true, true);
                    $('[name="Propinsi"]').append(newOption).trigger('change');
                } 

                if ($('[name="Kota"]').find("option[value='" + data.Kota + "']").length) {
                    $('[name="Kota"]').val(data.Kota).trigger('change');
                } else { 
                    var newOption = new Option(data.Kota, data.Kota, true, true);
                    $('[name="Kota"]').append(newOption).trigger('change');
                } 

                if ($('[name="StatusKepemilikan"]').find("option[value='" + data.Statuskepemilikan + "']").length) {
                    $('[name="StatusKepemilikan"]').val(data.Statuskepemilikan).trigger('change');
                } else { 
                    var newOption = new Option(data.Statuskepemilikan, data.Statuskepemilikan, true, true);
                    $('[name="StatusKepemilikan"]').append(newOption).trigger('change');
                } 

                if ($('[name="BentukB"]').find("option[value='" + data.Bentuk + "']").length) {
                    $('[name="BentukB"]').val(data.Bentuk).trigger('change');
                } else { 
                    var newOption = new Option(data.Bentuk, data.Bentuk, true, true);
                    $('[name="BentukB"]').append(newOption).trigger('change');
                } 

                if ($('[name="StatusB"]').find("option[value='" + data.StatusB + "']").length) {
                    $('[name="StatusB"]').val(data.StatusB).trigger('change');
                } else { 
                    var newOption = new Option(data.StatusB, data.StatusB, true, true);
                    $('[name="StatusB"]').append(newOption).trigger('change');
                } 

                if ($('[name="Metode"]').find("option[value='" + data.PayMethod + "']").length) {
                    $('[name="Metode"]').val(data.PayMethod).trigger('change');
                } else { 
                    var newOption = new Option(data.PayMethod, data.PayMethod, true, true);
                    $('[name="Metode"]').append(newOption).trigger('change');
                }
            });
            var jml_data = Object.keys(data.rowse).length;
            if (jml_data > 0) {
                $("#divtenor").css('display','block');
                $('#ttenor').empty();
                $.each(data.rowse, function(i, item) {
                var $tr = $('<tr>').append(
                    $('<td style="text-align: center;">').text(i+1),
                    $('<td style="text-align: right;">').text(convertToRupiah(item.Nominal)),
                    $('<td style="text-align: center;">').text(tgl_indo(item.DueDate)),
                    ).appendTo('#ttenor');
                });
            } 
            if ($('[name="Tenor"]').find("option[value='" + jml_data + "']").length) {
                    $('[name="Tenor"]').val(jml_data).trigger('change');
                } else { 
                    var newOption = new Option(jml_data, jml_data, true, true);
                    $('[name="Tenor"]').append(newOption).trigger('change');
                }
            }
        });

    }
}

function save() 
{
    $(".text-danger").remove();
    if($('[name="BranchCode"]').val() == "") {
        $('[name="BranchCode"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Kode Cabang Wajib Diisi !</p>');
        $('[name="BranchCode"]').focus();
        return false;
    } else if($('[name="BranchName"]').val() == "") {
        $('[name="BranchName"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Nama Cabang Wajib Diisi !</p>');
        $('[name="BranchName"]').focus();
        return false;
    } else if($('[name="Status"]').val() == "") {
        $('[name="Status"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Status Cabang Wajib Diisi !</p>');
        $('[name="Status"]').focus();
        return false;
    } else if($('[name="Area"]').val() == "") {
        $('[name="Area"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Area Wajib Diisi !</p>');
        $('[name="Area"]').focus();
        return false;
    } else if($('[name="Email"]').val() == "") {
        $('[name="Email"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Email Wajib Diisi !</p>');
        $('[name="Email"]').focus();
        return false;
    } else if($('[name="NoTelp"]').val() == "") {
        $('[name="NoTelp"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> No Telp Wajib Diisi !</p>');
        $('[name="NoTelp"]').focus();
        return false;
    } else if($('[name="AlamatCabang"]').val() == "") {
        $('[name="AlamatCabang"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Alamat Wajib Diisi !</p>');
        $('[name="AlamatCabang"]').focus();
        return false;
    } else if($('[name="Propinsi"]').val() == "") {
        $('[name="Propinsi"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Propinsi Wajib Diisi !</p>');
        $('[name="Propinsi"]').focus();
        return false;
    } else if($('[name="Kota"]').val() == "") {
        $('[name="Kota"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Kota Wajib Diisi !</p>');
        $('[name="Kota"]').focus();
        return false;
    } else if($('[name="NamaFranchisee"]').val() == "") {
        $('[name="NamaFranchisee"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Nama Franchisee Wajib Diisi !</p>');
        $('[name="NamaFranchisee"]').focus();
        return false;
    } else if($('[name="NoTelpFranchisee"]').val() == "") {
        $('[name="NoTelpFranchisee"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> No Telp Franchisee Wajib Diisi !</p>');
        $('[name="NoTelpFranchisee"]').focus();
        return false;
    } else if($('[name="AlamatFranchisee"]').val() == "") {
        $('[name="AlamatFranchisee"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Alamat Franchisee Wajib Diisi !</p>');
        $('[name="AlamatFranchisee"]').focus();
        return false;
    } else if($('[name="EmailFranchisee"]').val() == "") {
        $('[name="EmailFranchisee"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Email Franchisee Wajib Diisi !</p>');
        $('[name="EmailFranchisee"]').focus();
        return false;
    } else if($('[name="StatusKepemilikan"]').val() == "") {
        $('[name="StatusKepemilikan"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Status Kepemilikan Wajib Diisi !</p>');
        $('[name="StatusKepemilikan"]').focus();
        return false;
    } else if($('[name="NamaManager"]').val() == "") {
        $('[name="NamaManager"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Nama Manager Wajib Diisi !</p>');
        $('[name="NamaManager"]').focus();
        return false;
    } else if($('[name="NoTelpManager"]').val() == "") {
        $('[name="NoTelpManager"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> No Telp Manager Wajib Diisi !</p>');
        $('[name="NoTelpManager"]').focus();
        return false;
    } else if($('[name="BentukB"]').val() == "") {
        $('[name="BentukB"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Bentuk Bangunan Wajib Diisi !</p>');
        $('[name="BentukB"]').focus();
        return false;
    } else if($('[name="StatusB"]').val() == "") {
        $('[name="StatusB"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Status Bangunan Wajib Diisi !</p>');
        $('[name="StatusB"]').focus();
        return false;
    } else if($('[name="TglBerlaku"]').val() == "") {
        $('[name="TglBerlaku"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Tanggal Wajib Diisi !</p>');
        $('[name="TglBerlaku"]').focus();
        return false;
    } else if($('[name="TglBerakhir"]').val() == "") {
        $('[name="TglBerakhir"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Tanggal Wajib Diisi !</p>');
        $('[name="TglBerakhir"]').focus();
        return false;
    } else if($('[name="NilaiFF"]').val() == "") {
        $('[name="NilaiFF"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Wajib Diisi !</p>');
        $('[name="NilaiFF"]').focus();
        return false;
    } 
    url = base_url + "Franchise/saverecord";
    var diskonval = $('#Diskon').val();
    if(diskonval != '' || diskonval != 0){
        Diskon = convertToAngka(diskonval);
    } else {
        Diskon = 0;
    }
    var formdata = {};
    formdata['token'] = unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="));
    formdata['BranchCode'] = window.btoa($('#BranchCode').val());
    formdata['BranchName'] = window.btoa($('#BranchName').val());
    formdata['Status'] = window.btoa($('#Status').val());
    formdata['Area'] = window.btoa($('#Area').val());
    formdata['RekBCA'] = window.btoa($('#RekBCA').val());
    formdata['RekBCAName'] = window.btoa($('#RekBCAName').val());
    formdata['BankName'] = window.btoa($('#BankName').val());
    formdata['RekNonBCA'] = window.btoa($('#RekNonBCA').val());
    formdata['RekNonBCAName'] = window.btoa($('#RekNonBCAName').val());
    formdata['Email'] = window.btoa($('#Email').val());
    formdata['NoTelp'] = window.btoa($('#NoTelp').val());
    formdata['AlamatCabang'] = window.btoa($('#AlamatCabang').val());
    formdata['Propinsi'] = window.btoa($('#Propinsi').val());
    formdata['Kota'] = window.btoa($('#Kota').val());
    formdata['KodePos'] = window.btoa($('#KodePos').val());
    formdata['NamaFranchisee'] = window.btoa($('#NamaFranchisee').val());
    formdata['NoTelpFranchisee'] = window.btoa($('#NoTelpFranchisee').val());
    formdata['AlamatFranchisee'] = window.btoa($('#AlamatFranchisee').val());
    formdata['EmailFranchisee'] = window.btoa($('#EmailFranchisee').val());
    formdata['NoKTP'] = window.btoa($('#NoKTP').val());
    formdata['NoNPWP'] = window.btoa($('#NoNPWP').val());
    formdata['StatusKepemilikan'] = $('#StatusKepemilikan').val();
    formdata['YangLain'] = window.btoa($('#YangLain').val());
    formdata['NamaPemimpin'] = window.btoa($('#NamaPemimpin').val());
    formdata['NoSIUP'] = window.btoa($('#NoSIUP').val());
    formdata['NoTDP'] = window.btoa($('#NoTDP').val());
    formdata['NamaManager'] = window.btoa($('#NamaManager').val());
    formdata['NoTelpManager'] = window.btoa($('#NoTelpManager').val());
    formdata['AlamatManager'] = window.btoa($('#AlamatManager').val());
    formdata['PAC'] = window.btoa($('#PAC').val());
    formdata['NoTelpPAC'] = window.btoa($('#NoTelpPAC').val());
    formdata['iSmart'] = window.btoa($('#iSmart').val());
    formdata['NoTelpISmart'] = window.btoa($('#NoTelpISmart').val());
    formdata['BentukB'] = window.btoa($('#BentukB').val());
    formdata['StatusB'] = window.btoa($('#StatusB').val());
    formdata['TglBerlaku'] = window.btoa($('#TglBerlaku').val());
    formdata['TglBerakhir'] = window.btoa($('#TglBerakhir').val());
    formdata['NilaiFF'] = window.btoa(convertToAngka($('#NilaiFF').val()));
    formdata['Diskon'] = window.btoa(Diskon);
    formdata['DPP'] = window.btoa(convertToAngka($('#DPP').val()));
    formdata['PPn'] = window.btoa(convertToAngka($('#PPn').val()));
    formdata['NilaiTotal'] = window.btoa(convertToAngka($('#DPP').val())+convertToAngka($('#PPn').val()));
    formdata['NoMOU'] = window.btoa($('#NoMOU').val());
    formdata['TglMOU'] = window.btoa($('#TglMOU').val());
    formdata['Keterangan'] = window.btoa($('#Keterangan').val());
    formdata['Sektor'] = window.btoa($('#Sektor').val());
    formdata['FFID'] = window.btoa($('#FFID').val());
    formdata['tmpnpwp'] = window.btoa($('#tmpnpwp').val());
    formdata['tmpktp'] = window.btoa($('#tmpktp').val());
    //ktpfile = $('#PicKTP').val();
    //npwpfile = $('#PicNPWP').val();

        if(userfile.PicKTP.file) {
            formdata['PicKTPMime'] = userfile.PicKTP.type;
            formdata['PicKTPFile'] = userfile.PicKTP.file;
        }

        if(userfile.PicNPWP.file) {
            formdata['PicNPWPMime'] = userfile.PicNPWP.type;
            formdata['PicNPWPFile'] = userfile.PicNPWP.file;
        }
       //alert($('#StatusKepemilikan').val());
        $.ajax({
            url : url,
            type: "POST",
            data: formdata,
            dataType: "JSON",
            success: function(response)
            {
                $.notify(response.message,response.notify);
                if(response.notify=='success') {
                    document.getElementById('myform').reset();
                    $('#editdiv').css('display','none');
                    $(".img").attr("src",base_url+"assets/images/no-image.png");
                }
            }
        });
}
</script>