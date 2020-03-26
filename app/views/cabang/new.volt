<h1>
    {{ link_to("index", '<i class="icon-home fg-darker smaller"></i>') }}
    Cabang
    <small class="on-right">Tambah Baru</small>
</h1>
 
{{ content() }}
 
{{ form("cabang/create","onSubmit": "return validasi();", "method":"post", "enctype":"multipart/form-data","id":"AddForm") }}
 
<div class="grid fluid">
    <legend>Detail Cabang</legend>
    <div class="row no-margin">
        <div class="span3">
            <label for="KodeCabang">Kode Cabang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodeCabang", "maxlength" : 4, "placeholder": "4-Digit Numerik") }}
            </div>
        </div>
        <div class="span6">
            <label for="NamaCabang">Nama Cabang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaCabang", "maxlength" : 100) }}
            </div>
        </div>
        <div class="span1">
            <label for="Status">Status</label>
            <div class="input-control checkbox">
                <label>
                    <input id="Aktif" name="Aktif" type="checkbox" checked/>
                    <span class="check"></span>
                    Aktif
                </label>
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span3">
            <label for="Area">Area</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Area", area, 'using': ['KodeAreaCabang', 'NamaAreaCabang']) }}
            </div>
        </div>
      
    </div>
    <div class="row no-margin">
        <div class="span3">
            <label for="NoRekBCA">Rekening BCA</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoRekBCA", "maxlength" : 12) }}
            </div>
        </div>
        <div class="span6">
            <label for="NamaRekBCA">Rekening BCA Atas Nama</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaRekBCA", "maxlength" : 35) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="KodeBankNonBCA">Nama Bank Non-BCA</label>
            <div class="input-control select" data-role="input-control">
                    {{ select("KodeBankNonBCA", bank, "using" : ["Kode", "Nama"],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span3">
            <label for="NoRekNonBCA">Rekening Non-BCA</label>
            <div class="input-control text" data-role="input-control">
                    {{ text_field("NoRekNonBCA", "maxlength" : 12) }}
            </div>
        </div>
        <div class="span6">
            <label for="NamaRekNonBCA">Rekening Non-BCA Atas Nama</label>
            <div class="input-control text" data-role="input-control">
                    {{ text_field("NamaRekNonBCA", "maxlength" :50) }}
            </div>
        </div>
    </div>
 
    <legend>Detail Kontak dan Alamat</legend>
    <div class="row">
        <div class="span6">
            <label for="Email">Email Cabang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Email", "maxlength" : 50) }}
            </div>
        </div>
        <div class="span3">
            <label for="NoTelp">Nomor Telepon Cabang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoTelp", "maxlength" : 30) }}
            </div>
        </div>
    </div>
   <div class="row no-margin">
        <div class="span6">
            <label for="Alamat">Alamat</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("Alamat", "maxlength" : 255) }}
            </div>
            <label for="Propinsi">Propinsi</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Propinsi", propinsi, "using" : ["RecID", "NamaPropinsi"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            <label for="Kota">Kota</label>
            <div class="input-control select" data-role="input-control">
                <select id="Kota" name="Kota"></select>
            </div>
            <label for="KodePos">Kode Pos</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodePos", "maxlength" : 5) }}
            </div>
        </div>
    </div>
 
    <legend>Detail Franchisee</legend>
    <div class="row">
        <div class="span6">
            <label for="NamaFranchisee">Nama Franchisee</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaFranchisee", "maxlength" : 100) }}
            </div>
        </div>
        <div class="span3">
            <label for="NoTelpFranchisee">Nomor Telepon Franchisee</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoTelpFranchisee", "maxlength" : 50) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="EmailFranchisee">Email Franchisee</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("EmailFranchisee", "maxlength" : 100) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="AlamatKTP">Alamat Franchise sesuai KTP</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("AlamatKTP", "maxlength" : 255) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="NoKTP">No KTP</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoKTP", "maxlength" : 100) }}
            </div>
        </div>
        <div class="span3">
            <label for="KTP">Foto KTP</label>
                <input type="file" name="pic" id="pic" accept="image/jpeg, image/png">
        </div>
        <div class="span3">
                <img src="{{ url("public/uploads/no-image.png") }}" alt="Forest" style="width:100px; display:none;" class="pic" id="ktp1">
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="NoKTP">No NPWP</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoNPWP", "maxlength" : 100) }}
            </div>
        </div>
        <div class="span3">
            <label for="KTP">Foto NPWP</label>
                <input type="file" name="pic2" id="pic2" accept="image/jpeg, image/png">
        </div>
        <div class="span3">
                <img src="{{ url("public/uploads/no-image.png") }}" alt="Forest" style="width:100px; display:none;" class="pic2" id="npwp1">
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="Statuskepemilikan">Status Kepemilikan</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("Statuskepemilikan",["":"---","Perorangan":"Perorangan","CV":"CV","PT":"PT","5":"Yanglain"]) }}
            </div>
        </div>
        <div class="span6">
            <label for="Yanglain">Yang lain....</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Yanglain","id":"Yanglain", "maxlength" : 100, "disabled" :"true") }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="Pemimpin">Nama Pemimpin</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Direktur","id":"Direktur", "maxlength" : 100,"disabled" :"true") }} </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="SIUP">No SIUP</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("SIUP","id":"SIUP", "maxlength" : 100, "disabled" :"true") }}
            </div>
        </div>
        <div class="span6">
            <label for="TDP">No TDP (Tanda Daftar Perusahaan)</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("TDP","id":"TDP", "maxlength" : 100, "disabled"  :"true") }}
            </div>
        </div>
    </div>
 
    <legend>Organisasi Cabang</legend>
    <div class="row no-margin">
        <div class="span6">
            <label for="kplcab">Nama Manager</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaManager", "maxlength" : 100) }}
            </div>
        </div>
        <div class="span6">
            <label for="TKC">No Telpon Manager</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoHandPhone", "maxlength" : 100) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="AlamatKC">Alamat Manager</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("AlamatKC", "maxlength" : 255) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="pac">PAC</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("PAC", "maxlength" : 100) }}
            </div>
        </div>
        <div class="span6">
            <label for="Telppac">No Telpon PAC</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("telpPAC", "maxlength" : 100) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="kplcab">I-Smart Tetap</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Ismart", "maxlength" : 100) }}
            </div>
        </div>
        <div class="span6">
            <label for="Telpi">No Telpon I-Smart</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("TelpIsmart", "maxlength" : 100) }}
            </div>
        </div>
    </div>
 
    <legend>Gedung</legend>
    <div class="row no-margin">
        <div class="span6">
            <label for="BentukBangunan">Bentuk Bangunan</label>
            <div class="input-control select" data-role="input-control">
                 {{ select_static("Bentuk",["":"---","Rumah":"Rumah","Ruko":"Ruko"]) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="StatusBangunan">Status Bangunan</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("StatusB",["":"---","Milik Sendiri":"Milik Sendiri","Sewa":"Sewa"]) }}
            </div>
        </div>
    </div>

    <legend>Franchise Fee</legend>
    <div class="grid fluid">

<div class="grid fluid">
<div class="row">
<label for="TanggalBerlaku">Tanggal Berlaku</label>
    <div class="span1">
       <div class="input-control text" data-role="input-control">
             <input type="number" maxlength="2" id="hariBerlaku" name="hariBerlaku" value="{{ list.hariBerlaku}}" placeholder="Tanggal" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
       </div>
    </div>
    <div class="span1">
        <div class="input-control text" data-role="input-control">
            <input type="number" maxlength="2" id="bulanBerlaku" name="bulanBerlaku" value="{{ list.bulanBerlaku }}" placeholder="Bulan" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
        </div>
    </div>
    <div class="span1">
        <div class="input-control text" data-role="input-control">
            <input type="number" maxlength="4" id="tahunBerlaku" name="tahunBerlaku" value="{{ list.tahunBerlaku }}" placeholder="Tahun" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
        </div>
    </div>
</div>
<div class="grid fluid">
<div class="row">
<label for="TanggalBerakhir">Tanggal Berakhir</label>
    <div class="span1">
        <div class="input-control text">
             <input type="number" placeholder="Tanggal" maxlength="2" id="hariBerakhir" name="hariBerakhir" value="30" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
        </div>
    </div>
    <div class="span1">
        <div class="input-control text">
            <input type="number" placeholder="Bulan" maxlength="2" id="bulanBerakhir" name="bulanBerakhir" value="6" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
        </div>
    </div>
    <div class="span1">
        <div class="input-control text">
            <input type="number" maxlength="4" id="tahunBerakhir" name="tahunBerakhir" value="" placeholder="Tahun" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
        </div>
    </div>
    </div>
</div>

</div>

<div class="row no-margin">
    <div class="span4">
        <label for="NilaiFranchisee">Nilai Franchisee</label>
        <div class="input-control text" data-role="input-control">
            <input type="text" id="NilaiFranchisee" name="NilaiFranchisee" class="Idr form-control"  onkeyup="calculate()"/>
        </div>
    </div>
    <div class="span4">
        <label for="Diskon">Diskon</label>
        <div class="input-control text" data-role="input-control">
            <input type="text" id="Diskon" name="Diskon" class="Idr form-control" onkeyup="calculate()"/>
        </div>
    </div>
    <div class="span4">
        <label for="Diskon">Dpp</label>
        <div class="input-control text" data-role="input-control">
            <input type="text" id="Dpp" name="Dpp" value="" readonly="readonly"  onkeyup="calculate()"/>
        </div>
    </div>
</div>
<div class="row no-margin">
    <div class="span4">
        <label for="pajak">PPn</label>
        <div class="input-control text">
            <input type="text" name="pajak" id="pajak" value="" readonly="readonly"> </input>
        </div>
    </div>
    <div class="span4">
        <label for="total">Nilai Franchise + PPn</label>
        <div class="input-control text">
            <input type="text" name="total" id="total"  readonly="readonly" value=""> </input>
        </div>
    </div>
</div>
<div class="row no-margin">
    <div class="span4">
        <label for="NoMOU">No Akta Perjanjian Franchisee / MOU</label>
        <div class="input-control text">
            <input type="text" name="NoMOU" id="NoMOU" value=""/>
        </div>
    </div>
    <div class="span4">
        <label for="total">Tanggal MOU</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
            <input type="text" name="TglMou" id="TglMou" value=""/>
            </div>
    </div>
</div>
<div class="row no-margin">
    <div class="span6 ">
        <label for="Keterangan">Keterangan</label>
        <div class="input-control textarea" data-role="input-control">
            {{ text_area("Keterangan") }}
        </div>
    </div>
</div>
 
<div class="row">
    <div class="span3">
    {{ submit_button("Simpan","onClick":"ApiActionCabang();") }}
    </div>
</div>
</div>
 
{{ end_form() }}
 <script type="text/javascript">
    $(document).ready(function(){
        $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    });
</script>
<style>
img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 150px;
}

img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
</style>
<script type="text/javascript">    

    function calculate(){
        var Dpp = document.getElementById('Dpp');
        var NilaiFranchisee,Diskon = 0; 
        NilaiFranchisee = document.getElementById('NilaiFranchisee');
        NilaiFranchisee.value = NilaiFranchisee.value;
        Diskon = document.getElementById('Diskon');

        Net = NilaiFranchisee.value.replace(/,.*|[^0-9]/g,'') - Diskon.value.replace(/,.*|[^0-9]/g,'');
        Pajak = Net*10/100;

        var NetFix = Net.toString().split('').reverse().join('');
        var ResultNet  = NetFix.match(/\d{1,3}/g);
        var ResultNet  = 'Rp ' + ResultNet.join('.').split('').reverse().join('') + ',00';

        DiskonOri = document.getElementById('Diskon').value;
        Dpp.value = ResultNet;
        Diskon.value = DiskonOri;

        var PajakFix = Pajak.toString().split('').reverse().join('');
        var ResultPajak  = PajakFix.match(/\d{1,3}/g);
        var ResultPajak  = 'Rp ' + ResultPajak.join('.').split('').reverse().join('') + ',00';
        var pajak = document.getElementById('pajak');
        pajak.value = ResultPajak;

        Total = +NilaiFranchisee.value.replace(/,.*|[^0-9]/g,'') + +pajak.value.replace(/,.*|[^0-9]/g,'');
        var TotalFix = Total.toString().split('').reverse().join('');
        var ResultTotal  = TotalFix.match(/\d{1,3}/g);
        var ResultTotal  = 'Rp ' + ResultTotal.join('.').split('').reverse().join('') + ',00';
        var total = document.getElementById('total');
        total.value = ResultTotal;
        }
</script>
<script>
    $(document).ready(function() {
        $('#tahunBerlaku').keyup(function(){
        var tahunBerlaku=parseInt($('#tahunBerlaku').val());
        var tahunBerakhir= tahunBerlaku + 5;
        $('#tahunBerakhir').val(tahunBerakhir);
        });
    });
</script>

<script>
    $("#Propinsi").on("change", function () {
        var url = "{{ url('registrasi/getkota/') }}" + $(this).val();
        $.getJSON(url).done(function (data) {
            $("#Kota").empty();
            if (data.status === "OK") {
                var htmlcontent = "";
                $.each(data.listData, function (i, list) {
                    htmlcontent += "<option value=\"" + list.id + "\">" + list.namakotakab + "</option>";
                });
                $("#Kota").html(htmlcontent);
            }
        });
    });

$('#Statuskepemilikan').change(function() {
  if ($(this).val() == 'Perorangan') {
    $('#Yanglain').prop('disabled', true);
    $('#Direktur').prop('disabled', true);
    $('#SIUP').prop('disabled', true);
   $('#TDP').prop('disabled', true);
  }
  else if ($(this).val() == 'CV') {
    $('#Yanglain').prop('disabled', true);
    $('#Direktur').prop('disabled', false);
    $('#SIUP').prop('disabled', false);
   $('#TDP').prop('disabled', false);
  }
  else if ($(this).val() == 'PT')
  {
    $('#Yanglain').prop('disabled', true);
    $('#Direktur').prop('disabled', false);
    $('#SIUP').prop('disabled', false);
   $('#TDP').prop('disabled', false);
  }
  else 
  {
   $('#Yanglain').prop('disabled', false);
    $('#Direktur').prop('disabled', true);
    $('#SIUP').prop('disabled', true);
   $('#TDP').prop('disabled', true);
  }


});
</script>


<script type="text/javascript">
var userfile = {
    pic:{},
    pic2:{},
};

$("document").ready(function() {
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
                $(".pic").attr("src",userfile.pic.file);
                $(".pic2").attr("src",userfile.pic2.file);
            };
            reader.readAsDataURL(vm.myFile);
        }
    });
    $("#pic").change(function(t) {
        if(t){
        $("#ktp1").css("display", "block");
        } 
    });    
    $("#pic2").change(function(t) {
        if(t){
        $("#npwp1").css("display", "block");
        } 
    });
});

function validasi() {
    if($('[name="pic"]').val() == "" || $('[name="pic"]').val() == null) {
        alert("Foto/Scan KTP harus diisi...");
        $('[name="pic"]').focus();
        $(".loader").hide();
        return false;
    } if (!Checkfiles(userfile.pic.name)) {
        $(".loader").hide();
        return false;
    } if($('[name="pic2"]').val() == "" || $('[name="pic2"]').val() == null) {
        alert("Foto/Scan NPWP harus diisi...");
        $('[name="pic2"]').focus();
        $(".loader").hide();
        return false;
    } if (!Checkfiles(userfile.pic2.name)) {
        $(".loader").hide();
        return false;
    } if($('[name="hariBerlaku"]').val() == "" || $('[name="hariBerlaku"]').val() == null) {
        alert("Tanggal berlaku harus diisi...");
        $('[name="hariBerlaku"]').focus();
        $(".loader").hide();
        return false;
    } if($('[name="bulanBerlaku"]').val() == "" || $('[name="bulanBerlaku"]').val() == null) {
        alert("Bulan berlaku harus diisi...");
        $('[name="bulanBerlaku"]').focus();
        $(".loader").hide();
        return false;
    } if($('[name="tahunBerlaku"]').val() == "" || $('[name="tahunBerlaku"]').val() == null) {
        alert("Tahun berlaku harus diisi...");
        $('[name="tahunBerlaku"]').focus();
        $(".loader").hide();
        return false;
    } if($('[name="hariBerakhir"]').val() == "" || $('[name="hariBerakhir"]').val() == null) {
        alert("Tanggal berakhir harus diisi...");
        $('[name="hariBerakhir"]').focus();
        $(".loader").hide();
        return false;
    } if($('[name="bulanBerakhir"]').val() == "" || $('[name="bulanBerakhir"]').val() == null) {
        alert("Bulan berakhir harus diisi...");
        $('[name="bulanBerakhir"]').focus();
        $(".loader").hide();
        return false;
    } if($('[name="tahunBerakhir"]').val() == "" || $('[name="tahunBerakhir"]').val() == null) {
        alert("Tahun berakhir harus diisi...");
        $('[name="tahunBerakhir"]').focus();
        $(".loader").hide();
        return false;
    } if($('[name="NilaiFranchisee"]').val() == "" || $('[name="NilaiFranchisee"]').val() == null) {
        alert("Nilai Franchisee harus diisi...");
        $('[name="NilaiFranchisee"]').focus();
        $(".loader").hide();
        return false;
    } else {
        return true;
        $(".loader").show();
    }
}

function Checkfiles(fileName) {
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
    if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG") {
        return true;
    } else {
        alert("Gambar Harus format JPG,PNG,JPEG");
        fileName.focus();
        return false;
    }
}

function ApiActionCabang() {
    var formdata = {};
    formdata['KodeAreaCabang'] = window.btoa(unescape(encodeURIComponent($('[name="KodeCabang"]').val())));
    formdata['Area'] = window.btoa(unescape(encodeURIComponent($('[name="Area"]').val())));
    formdata['NamaAreaCabang'] = window.btoa(unescape(encodeURIComponent($('[name="NamaCabang"]').val())));
    formdata['TanggalBerlaku'] = window.btoa(unescape(encodeURIComponent($('[name="TanggalBerlaku"]').val())));
    formdata['TanggalBerakhir'] = window.btoa(unescape(encodeURIComponent($('[name="TanggalBerakhir"]').val())));
    formdata['Alamat'] = window.btoa(unescape(encodeURIComponent($('[name="Alamat"]').val())));
    formdata['Propinsi'] = window.btoa(unescape(encodeURIComponent($('[name="Propinsi"]').val())));
    formdata['Kota'] = window.btoa(unescape(encodeURIComponent($('[name="Kota"]').val())));
    formdata['KodePos'] = window.btoa(unescape(encodeURIComponent($('[name="KodePos"]').val())));
    formdata['NoTelp'] = window.btoa(unescape(encodeURIComponent($('[name="NoTelp"]').val())));
    formdata['NamaManager'] = window.btoa(unescape(encodeURIComponent($('[name="NamaManager"]').val())));
    formdata['NoHandPhone'] = window.btoa(unescape(encodeURIComponent($('[name="NoHandPhone"]').val())));
    formdata['NoRekBCA'] = window.btoa(unescape(encodeURIComponent($('[name="NoRekBCA"]').val())));
    formdata['NamaRekBCA'] = window.btoa(unescape(encodeURIComponent($('[name="NamaRekBCA"]').val())));
    formdata['KodeBankNonBCA'] = window.btoa(unescape(encodeURIComponent($('[name="KodeBankNonBCA"]').val())));
    formdata['NoRekNonBCA'] = window.btoa(unescape(encodeURIComponent($('[name="NoRekNonBCA"]').val())));
    formdata['NamaRekNonBCA'] = window.btoa(unescape(encodeURIComponent($('[name="NamaRekNonBCA"]').val())));
    formdata['NoRekMandiri'] = window.btoa(unescape(encodeURIComponent($('[name="NoRekMandiri"]').val())));
    formdata['NamaRekMandiri'] = window.btoa(unescape(encodeURIComponent($('[name="NamaRekMandiri"]').val())));
    formdata['Email'] = window.btoa(unescape(encodeURIComponent($('[name="Email"]').val())));
    // formdata['Longitude'] = window.btoa(unescape(encodeURIComponent(null)));
    // formdata['Latitude'] = window.btoa(unescape(encodeURIComponent(null)));
    formdata['NamaFranchisee'] = window.btoa(unescape(encodeURIComponent($('[name="NamaFranchisee"]').val())));
    // formdata['AlamatFranchisee'] = window.btoa(unescape(encodeURIComponent(null)));
    formdata['NamaFranchisee'] = window.btoa(unescape(encodeURIComponent($('[name="NamaFranchisee"]').val())));
    formdata['NoTelpFranchisee'] = window.btoa(unescape(encodeURIComponent($('[name="NoTelpFranchisee"]').val())));
    formdata['EmailFranchisee'] = window.btoa(unescape(encodeURIComponent($('[name="EmailFranchisee"]').val())));
    formdata['Aktif'] = window.btoa(unescape(encodeURIComponent($('[name="Aktif"]').val())));
    // formdata['Sektor'] = window.btoa(unescape(encodeURIComponent(null)));
    formdata['token'] = window.btoa(unescape(encodeURIComponent('Q3IzNHQzZF9ieS5IQG1aNGg=')));

    $.ajax({
        url: "{{ url('https://primagama.co.id/admin/ApiActionCabang')}}",
        method:"POST",
        data: formdata,
        type: "POST",
        dataType: "JSON",
        success:function(response){
            console.log(response);
            $('.loader').css({"display":"none"});
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            $('.loader').css({"display":"none"});
        }
    });
};

</script>