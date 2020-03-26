<form action="#" id="myform" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-edit"> Input Data Perpanjangan Franchisee</i></p>
        	<legend></legend>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-6">
                <label>Pilih Cabang</label>
                <select id="PBranchCode" name="PBranchCode" class="form-control">
                   <option value=""> - - Pilih Cabang - - </option>
                </select>
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
<div class="row" id="editdiv" style="display: none;">
    <div class="col-lg-12">
         <div class="form-group">
            <div class="col-lg-12">
            <legend><p style="font-size: 20px; font-weight: bold;"><i class="fa" id="cbg"> </i></p></legend>
            <input type="hidden" name="FFID" id="FFID">
            <input type="hidden" name="BranchCode" id="BranchCode">
            <input type="hidden" name="BGN" id="BGN">
            <input type="hidden" name="FFIDNUMB" id="FFIDNUMB">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th width="15%" style="text-align:center;">Tanggal Berlaku</th>
                            <th width="15%" style="text-align:center;">Tanggal Berakhir</th>
                            <th width="18%" style="text-align:center;">Saldo Awal</th>
                            <th width="18%" style="text-align:center;">Tagihan FF</th>
                            <th width="18%" style="text-align:center;">Pembayaran</th>
                            <th width="25%" style="text-align:center;">Sisa Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody id="data_ff"></tbody>
                </table>
            </div>
            <i class="fa" id="info" style="color: red; font-size: 20px;"></i>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12">
            <legend><p style="font-size: 20px; font-weight: bold;"><i class="fa"> Form Perpanjangan Franchisee</i></p></legend>
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
<script type="text/javascript">

$(document).ready(function(){
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    get_cabang();
});

$(function () {
    $('#PBranchCode').select2();
});

function get_cabang() {
$.getJSON(base_url+"Franchise/get_cabang", function(json){
    $('#PBranchCode').empty();
    $('#PBranchCode').append($('<option>').text("- - Pilih Cabang - -").attr('value', ''));
    $.each(json, function(i, obj){
    $('#PBranchCode').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
    });
});
}

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


function load_data() {
    BranchCode = $('#PBranchCode').val();
    if($('[name="PBranchCode"]').val() == "") {
        $('[name="PBranchCode"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Pilih Cabang !</p>');
        $('[name="PBranchCode"]').focus();
        return false;
    } else {
    $('#editdiv').css('display','block');
    $('#data_ff').empty();
        $.ajax({
            url : base_url+"Franchise/loadrenewal",
            type: 'POST',
            data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"BranchCode":window.btoa(BranchCode)}),
            dataType: 'json',
            success: function(item){
                //alert(item.DateTo);
                        BGN = item.BGN;
                        PAY = item.PAY;
                        BILL = item.BILL;
                        if(BGN==0){
                            BGNV=0;
                        } else {
                            BGNV=BGN;
                        }
                        if(PAY==0){
                            PAYV=0;
                        } else {
                            PAYV=PAY;
                        }
                        if(BILL==0){
                            BILLV=0;
                        } else {
                            BILLV=BILL;
                        }
                        if(item.NoPay==1){
                            SAL = 0;
                        } else {
                            SAL = BILLV;
                        }
                        //SISA = BILLV;
                        var $tr = $('<tr>').append(
                            $('<td>').text(item.DateFrom),
                            $('<td>').text(item.DateTo),    
                            $('<td>').text(convertToRupiah(BGNV)),    
                            $('<td>').text(convertToRupiah(item.TOT)),    
                            $('<td>').text(convertToRupiah(PAYV)),    
                            $('<td>').text(convertToRupiah(BILLV))
                        ).appendTo('#data_ff');
                        $('#cbg').text('Data Kontrak Sebelumnya Cabang : '+item.KodeCabang+' - '+item.NamaCabang);
                        $('#info').text('*Note : Jumlah sisa pembayaran senilai '+convertToRupiah(SAL)+' akan menjadi saldo awal di kontrak selanjutnya. ');
                        $('#FFID').val(item.FFID);
                        $('#BranchCode').val(item.KodeCabang);
                        $('#BranchCode').val(item.KodeCabang);
                        $('#BGN').val(SAL);
                        $('#FFIDNUMB').val(item.FFIDNUMB);
            }
        });
    }
};


function save() 
{
    $(".text-danger").remove();
    if($('[name="BranchCode"]').val() == "") {
        $('[name="BranchCode"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Kode Cabang Wajib Diisi !</p>');
        $('[name="BranchCode"]').focus();
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
    url = base_url + "Franchise/saverenewal";
    var diskonval = $('#Diskon').val();
    if(diskonval != '' || diskonval != 0){
        Diskon = convertToAngka(diskonval);
    } else {
        Diskon = 0;
    }
    var formdata = {};
    formdata['token'] = unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="));
    formdata['BranchCode'] = window.btoa($('#BranchCode').val());
    formdata['TglBerlaku'] = window.btoa($('#TglBerlaku').val());
    formdata['TglBerakhir'] = window.btoa($('#TglBerakhir').val());
    formdata['NilaiFF'] = window.btoa(convertToAngka($('#NilaiFF').val()));
    formdata['Diskon'] = window.btoa(Diskon);
    formdata['DPP'] = window.btoa(convertToAngka($('#DPP').val()));
    formdata['PPn'] = window.btoa(convertToAngka($('#PPn').val()));
    formdata['NilaiTotal'] = window.btoa(convertToAngka($('#NilaiTotal').val()));
    formdata['NoMOU'] = window.btoa($('#NoMOU').val());
    formdata['TglMOU'] = window.btoa($('#TglMOU').val());
    formdata['Keterangan'] = window.btoa($('#Keterangan').val());
    formdata['FFID'] = window.btoa($('#FFID').val());
    formdata['BGN'] = window.btoa($('#BGN').val());
    formdata['FFIDNUMB'] = window.btoa($('#FFIDNUMB').val());
    formdata['FFID'] = window.btoa($('#FFID').val());
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
                }
            }
        });
}
</script>