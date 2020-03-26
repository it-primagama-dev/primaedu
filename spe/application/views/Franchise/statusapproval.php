<form action="#" id="myform" class="form-horizontal">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list"> Data Perubahan</i></p>
                <legend></legend>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="idtable" style="display: show;">
        <div class="col-lg-12">
            <div>
                <table class="table table-bordered table-hover" cellspacing="0" id="tableMenu" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th data-sortable="false">No</th>
                                    <th style="text-align: center;">Kode Cabang</th>
                                    <th style="text-align: center;">Nama Cabang</th>
                                    <th style="text-align: center;">User </th>
                                    <th style="text-align: center;">Tanggal </th><!-- 
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Approve/Reject Oleh</th>
                                    <th style="text-align: center;">Tanggal Approve/Reject</th> -->
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                </table>
            </div>
        </div>
    </div>
<div class="row" id="editdiv" style="display: none;">
    <div class="col-lg-12">
         <div class="form-group">
            <div class="col-lg-12">
            <legend><p style="font-size: 20px; font-weight: bold;"><i class="fa"> Detail Cabang</i></p></legend>
            <input type="hidden" name="FFID" id="FFID">
            <input type="hidden" name="RecID" id="RecID">
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
            <div class="col-md-4">
                <label class="control-label">No. KTP</label>
                <input type="hidden" id="tmpktp" name="tmpktp">
                <input type="text" id="NoKTP" name="NoKTP" class="form-control" placeholder=" No. KTP">
                <br>
                <input type="file" id="PicKTP" name="PicKTP" class="form-control">
            </div>
            <div class="col-md-2">
                <img src="" id="ktptumb" alt="no-image" class="img-responsive img imgPicKTP">
            </div>
            <div class="col-md-4">
                <label class="control-label">No. NPWP</label>
                <input type="hidden" id="tmpnpwp" name="tmpnpwp">
                <input type="text" id="NoNPWP" name="NoNPWP" class="form-control" placeholder=" No. NPWP">
                <br>
                <input type="file" id="PicNPWP" name="PicNPWP" class="form-control">
            </div>
            <div class="col-md-2">
                <img src="" id="npwptumb" alt="no-image" class="img-responsive img imgPicNPWP">
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
                <input type="text" id="DPP" name="DPP" class="form-control" placeholder=" DPP" readonly="readonly">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4">
                <label>PPn</label>
                <input type="text" id="PPn" name="PPn" class="form-control" placeholder=" PPn" readonly="readonly">
            </div>
            <div class="col-lg-4">
                <label>Nilai Franchise + PPn</label>
                <input type="text" id="NilaiTotal" name="NilaiTotal" class="form-control" readonly="readonly">
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
            <div class="col-lg-2">
            <button type="button" class="btn btn-warning" onclick="back()"><span class="glyphicon glyphicon-arrow-left"></span> Back</button>
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
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

$(document).ready(function(){
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    load_data();
    get_area();
    get_propinsi();
    get_bank();
    get_kotaall();
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
var jQueryTable;
var jQueryTable2;
function load_data() {
   // alert(DateFrom);
    $("#tableMenu").DataTable().destroy();
    $('#idtable').css('display','block');
    jQueryTable = $("#tableMenu").DataTable({
        "ajax": {
            "url":base_url + "Franchise/loadlistapproval",
            "type":"GET",
            //"data": ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"DateFrom":window.btoa(DateFrom)}),
            "dataType":"JSON"
        },
        "columns": [
            {"data":"RowNum","autoWidth":true},
            {"data":"KodeAreaCabang","autoWidth":true},
            {"data":"NamaAreaCabang","autoWidth":true},
            {"data":"CreatedBy","autoWidth":true},
            {"data":"CreatedDateTime","autoWidth":true, "render":
                function(data){
                    if(data==''){
                        return '-';
                    } else {
                        return tgl_indo(data);
                    }
                }},/*
            {"data":"StatusApproval","autoWidth":true},
            {"data":"ApprovalBy","autoWidth":true, "render":
                function(data){
                    if(data==null){
                        return '-';
                    } else {
                        return data;
                    }
                }},
            {"data":"ApprovalDateTime","autoWidth":true, "render":
                function(data){
                    if(data==null){
                        return '-';
                    } else {
                        return tgl_indo(data);
                    }
                }},*/
            {"data":null,"autoWidth":true,"sClass": "text-center","render": function(data) {
                var button = "";
                button += '<a class="btn btn-success btn-xs btn-block" href="javascript:void(0)" type="button" onclick="view_detail('+data.ID+')">Detail</a>';     
                return button;       
            }},
        ],
        'iDisplayLength': 10000,
        dom: "<'row'<'col-lg-1 col-xs-12'f><'col-lg-11 col-sm-12'B>>",
        buttons: [
        {
            extend: 'excel', footer: true,
            text: '<button type="button" class="btn btn-info pull-right"><span class="glyphicon glyphicon-download"></span> Download</button>',
            className: 'exportExcel',
            filename: 'Laporan FF Per-Area',
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            }
        }]
    });
}


function view_detail(RecID)
{
        $('#editdiv').css('display','block');
        $('#idtable').css('display','none');
        $('#Area,#Propinsi,#Kota,#BankName').select2();
        $('#editdiv').find('input, textarea, select').attr('disabled','disabled');
        //alert(BranchCode);
        url = base_url + "Franchise/loaddetailapproval/"+RecID;
        $.ajax({
            url : url,
            type: "GET",
            //data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"BranchCode":window.btoa(BranchCode)}),
            dataType: "JSON",
            success: function(data)
            {
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
                $('[name="RecID"]').val(data.RecID);

                if(data.Discount == null || data.Discount == ''){
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
                $('[name="DPP"]').val(convertToRupiah(DPP));
                $('[name="NilaiTotal"]').val(convertToRupiah(Total));
                $('[name="NoMOU"]').val(data.MOUNumber);
                $('[name="TglMOU"]').val(data.DateMOU);
                $('[name="Keterangan"]').val(data.Description);
                $('[name="FFID"]').val(data.FFID);

                //alert(data.KTP);
                if(data.KTP == null){
                    $("#ktptumb").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#ktptumb").attr("src",base_url+"assets/upload/ff/"+data.KTP);
                }

                if(data.NPWP == null){
                    $("#npwptumb").attr("src",base_url+"assets/images/no-image.png");
                } else {
                    $("#npwptumb").attr("src",base_url+"assets/upload/ff/"+data.NPWP);
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

            }
        });
}
function back()
{
    $('#editdiv').css('display','none');
    $('#idtable').css('display','show');
    load_data();
}
</script>