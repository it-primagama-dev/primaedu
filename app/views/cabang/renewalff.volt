<legend><h1>Input Data Perpanjangan Franchisee</h1>
</legend>
<h3><strong>{{ cabang }}</strong></h3>
{{ content() }}

{{ form("cabang/saverenewal", "onSubmit": "return validasi();", "method":"post",  "autocomplete" : "off") }}
<legend></legend>
<div class="grid fluid">
<div class="row no-margin">
<input type="hidden" id="kodecabang" name="kodecabang" value="{{ kodeAreaCabang }}">
{% for list in ffid %}
<input type="hidden" id="ffid" name="ffid" value="{{ list.FFID }}">
{% endfor %}
<strong>*Data Kontrak Sebelumnya</strong>
<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Tanggal Berlaku</th>
            <th>Tanggal Berakhir</th>
            <th>Saldo Awal</th>
            <th>Tagihan FF</th>
            <th>Pembayaran</th>
            <th>Sisa Pembayaran</th>
        </tr>
    </thead>
    <tbody>
            {% if result is not empty %}
            {% for list in result %}
            {% set sisa = list.SisaPembayaran %}
            {% set ffidold = list.FFID %}
                <tr>
                    <td align="center">{{ list.AwalKontrak }}</td>
                    <td align="center">{{ list.AkhirKontrak }}</td>
                    <td align="right">Rp {{ list.SaldoAwal |number_format(0,',','.') }}</td>
                    <td align="right">Rp {{ list.TotalPenagihan |number_format(0,',','.') }}</td>
                    <td align="right">Rp {{ list.TotalPembayaran |number_format(0,',','.')}}</td>
                    <td align="right">Rp {{ list.SisaPembayaran |number_format(0,',','.')}}</td>
                </tr>
            {% endfor %}
                    {% else %}
                        <tr>
                            <td colspan="5" align="center">- Tidak Ada Data -</td>
                        </tr>
            {% endif %}
    </tbody>
</table>
<font color="red"><strong>*Note : Jumlah sisa pembayaran senilai <u> Rp {{ sisa |number_format(0,',','.')}} </u> akan menjadi saldo awal di kontrak selanjutnya.</strong></font>
<br></br>
<input type="hidden" id="ffidold" name="ffidold" value="{{ ffidold }}">
<input type="hidden" id="saldoawal" name="saldoawal" value="{{ sisa }}">
<label for="TanggalBerlaku">Tanggal Berlaku</label>
    <div class="span1">
       <div class="input-control text" data-role="input-control">
             <input type="number" maxvalue="12" maxlength="2" id="hariBerlaku" name="hariBerlaku" value="{{ list.hariBerlaku}}" placeholder="Tgl" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
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
<div class="row no-margin">
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
    {{ submit_button("Simpan") }}
    </div>
</div>
</div>
{{ end_form() }}

<script type="text/javascript">
    $(document).ready(function(){
        $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    });
    $(document).ready(function() {
        $('#tahunBerlaku').keyup(function(){
        var tahunBerlaku=parseInt($('#tahunBerlaku').val());
        var tahunBerakhir= tahunBerlaku + 5;
        $('#tahunBerakhir').val(tahunBerakhir);
        });
    });
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

function validasi() {
    if($('[name="hariBerlaku"]').val() == "" || $('[name="hariBerlaku"]').val() == null) {
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
</script>