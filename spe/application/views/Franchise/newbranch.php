<form id="myform" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
         <div class="form-group">
            <div class="col-lg-12">
            <legend><p style="font-size: 23px; font-weight: bold;"><i class="fa fa-home"> Tambah Cabang Baru</i></p></legend>
            </div>
            <div class="col-lg-12">
            <legend><p style="font-size: 20px; font-weight: bold;"><i class="fa"> Detail Cabang</i></p></legend>
            </div>
            <div class="col-lg-3">
                <label>Kode Cabang</label>
                <input type="text" id="BranchCode" name="BranchCode" maxlength="4" class="form-control" placeholder=" 4 Digit Numerik">
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
            <div class="col-md-4">
                <label class="control-label">No. KTP</label>
                <input type="text" id="NoKTP" name="NoKTP" class="form-control" placeholder=" No. KTP">
                <br>
                <input type="file" id="PicKTP" name="PicKTP" class="form-control">
            </div>
            <div class="col-md-2">
                <a target="_blank" href="javascript:void(0)" onclick="showthumbktp()">
                    <img src="" id="ktptumb" alt="no-image" class="img-responsive img imgPicKTP">
                </a>
            </div>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header" style="text-align: center;">

                  </div>
                  <div class="modal-body">
                    <img src="" id="ktptumb2" alt="no-image" class="img-responsive img2 imgPicKTP2">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-md-4">
                <label class="control-label">No. NPWP</label>
                <input type="text" id="NoNPWP" name="NoNPWP" class="form-control" placeholder=" No. NPWP">
                <br>
                <input type="file" id="PicNPWP" name="PicNPWP" class="form-control">
            </div>
            <div class="col-md-2">
                <a target="_blank" href="javascript:void(0)" onclick="showthumbnpwp()">
                    <img src="" id="npwptumb" alt="no-image" class="img-responsive img imgPicNPWP">
                </a>
            </div>
            <!-- Modal -->
            <div id="myModal2" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header" style="text-align: center;">

                  </div>
                  <div class="modal-body" style="text-align: center;">
                    <img src="" id="npwptumb2" alt="no-image" class="img-responsive img2 imgPicNPWP2">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
                  </div>
                </div>

              </div>
            </div>
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
                <input type="text" id="DPP" class="form-control" placeholder=" DPP" readonly="readonly">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4">
                <label>PPn</label>
                <input type="text" id="PPn" class="form-control" placeholder=" PPn" readonly="readonly">
            </div>
            <div class="col-lg-4">
                <label>Nilai Franchisee + PPn</label>
                <input type="text" id="NilaiTotal" class="form-control" readonly="readonly">
            </div>
            <div class="col-lg-4">
                <label>Total Tagihan</label>
                <input type="text" id="Tagihan" class="form-control" readonly="readonly">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4">
                <label>Metode Pembayaran</label>
                <select id="Metode" name="Metode" class="form-control">
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
                   <option value="6">6 X</option>
                   <option value="7">7 X</option>
                   <option value="8">8 X</option>
                   <option value="9">9 X</option>
                   <option value="10">10 X</option>
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
            <div class="col-lg-5">
            <button type="button" class="btn btn-success" onclick="save()"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            </div>
        </div>
        <legend></legend>
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/autoNumeric.js"></script>

<style>
.img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  height: 150px;
  width: 150px;
}

.img2 {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
}
</style>
<script type="text/javascript">


function showthumbktp()
{
    $('#myModal').modal({
        show: 'show',
        backdrop: 'static',
        keyboard: false
    })
}

function showthumbnpwp()
{
    $('#myModal2').modal({
        show: 'show',
        backdrop: 'static',
        keyboard: false
    })
}

$(document).ready(function(){
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    get_area();
    get_propinsi();
    get_bank();
    $('#YangLain,#NamaPemimpin,#NoSIUP,#NoTDP').attr('disabled','disabled').removeAttr('onclick');
});

$(function () {
    $('#Area,#Propinsi,#Kota,#BankName').select2();
});

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

$("#Propinsi").change(function(e) {
    var Propinsi = e.target.value;
    $.getJSON(base_url+"Franchise/get_kota/"+Propinsi, function(json){
        $('#Kota').empty();
        $('#Kota').append($('<option>').text("- - Pilih Kota - -").attr('value', ''));
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
    var total = document.getElementById('NilaiTotal');
    total.value = ResultTotal;

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

$("#Metode").change(function(e) {
    var Id = e.target.value;
    //alert(Id);
    if(Id=='Cash'){
        $("#Tenor").attr('disabled',true);
    } else {
        $("#Tenor").removeAttr('disabled','disabled');
    } 

});

$("#Tenor").change(function(e) {
    var Id = e.target.value;
    //alert(Id);
    $('#ttenor').empty();
    $("#divtenor").css('display','block');
    for(var i=0; i<Id; i+=1){
        var $tr = $('<tr>').append(
            $('<td style="text-align: center;">').text(i+1),
            $('<td style="text-align: center;">').html("<input style='text-align: right;' type='text' id='Nominal["+i+"]' name='Nominal["+i+"]' class='Idr form-control noms' onblur='maks()'>"),
            $('<td style="text-align: center;">').html("<input style='text-align: center;' type='text' id='JatuhTempo"+i+"' name='JatuhTempo["+i+"]' class='form-control jth'>"),
            ).appendTo('#ttenor');
            $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
        $(function(){
            var d = new Date();
            var n = d.getFullYear();
            $('#JatuhTempo'+i+'').datepicker({
                dateFormat: 'yy-m-d',
                changeMonth: true,
                changeYear: true,
                yearRange: "2015:"+n
            });
        })
    }
});

function maks(){
    Tag = $('#Tagihan').val().replace(/,.*|[^0-9]/g,'');
    //alert(Tag);
    var nom = 0;
    for(var i = 0, len = $('#Tenor').val(); i < len; i++) {
        var nominal = $('[name="Nominal['+i+']"]').val().replace(/,.*|[^0-9]/g,'');
        nom += parseInt(nominal);
    }

    if(nom > Tag){
        alert('Jumlah tenor melebihi jumlah tagihan !!!');
    }
}

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
    $(".img").attr("src",base_url+"assets/images/no-image.png");
    $(".img2").attr("src",base_url+"assets/images/no-image.png");
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
                    $(".imgPicKTP2").attr("src",userfile.PicKTP.file).attr('id','is_picKTP2');
                }
                if (userfile.PicNPWP.file) {
                    $(".imgPicNPWP").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP');
                    $(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
            };
            reader.readAsDataURL(vm.myFile);
        }
    });
});


function save()
{
    //var regex = new RegExp("(.*?)\.(jpeg|jpg|png)$");
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
    }  else if($('[name="BentukB"]').val() == "") {
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
    url = base_url + "Franchise/save";
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
    formdata['Metode'] = window.btoa($('#Metode').val());
    var Nominal = [];
    $(".noms").each(function() {  
        Nominal.push($(this).val());
    });
    var DueDate = [];
    $(".jth").each(function() {  
        DueDate.push($(this).val());
    });
    formdata['Nominal'] = Nominal;
    formdata['DueDate'] = DueDate;

        if(userfile.PicKTP.file) {
            formdata['PicKTPMime'] = userfile.PicKTP.type;
            formdata['PicKTPFile'] = userfile.PicKTP.file;
        }
        if(userfile.PicNPWP.file) {
            formdata['PicNPWPMime'] = userfile.PicNPWP.type;
            formdata['PicNPWPFile'] = userfile.PicNPWP.file;
        }
      //alert(Nominal);
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
                     $('#ttenor').empty();
                     $(".img").attr("src",base_url+"assets/images/no-image.png");
                }
            }
        });
}
</script>