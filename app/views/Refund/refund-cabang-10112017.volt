{{ content() }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">

<!-- Input Refund -->

{{ form("refund/simpanDeposite", "onSubmit": "return validasi3();", "method":"post",  "autocomplete" : "off","name":"form3") }}
    <div class="grid fluid">
    <div class="row">
        <input type="hidden" id="recID" name="recID" value="{{ list.RecID}}">
        <div class="span11">
            <label for="label" class="no-padding">Nama Pembuat Pernyataan</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("namapembuatpernyataan") }}
            </div>
        </div>
        <div class="span11">
            <label for="label" class="no-padding">Jabatan Pembuat Pernyataan</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("jabatanpembuatpernyataan") }}
            </div>
        </div>
        <div class="span11">
            <label for="label" class="no-padding">Telp Cabang Terbaru</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("telpcabang","maxlength":"12","onkeyup":"angka(this);") }}    
            </div>
        </div>
        <div class="span11">
            <label for="label">Alamat Cabang Terbaru</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("alamatcabang") }}
            </div>
        </div>
        <div class="span11">
        <label for="label" class="no-padding">Pilih Kesalahan</label>
        <div class="input-control select" data-role="input-control">
        {{ select_static("JenisKesalahan", ["":"---","01" : "Salah Nominal", "02" : "Salah VA Cabang","03" : "Salah VA Siswa Masuk Ke Va Cabang"]) }}
        </div>
        </div>
        <div class="span11">
            <label for="label" class="no-padding">Virtual Account Salah <br/><font color="red">*Untuk Kesalahan Nominal Tidak Diisi</font></label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("novasalah","id":"novasalah1","maxlength":"6","disabled":"true","onkeyup":"angka(this);") }}
            </div>
         </div>
        <div class="span11">
            <label for="label" class="no-padding">Virtual Account Benar</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("novabenar","id":"novabenar1","maxlength":"6","disabled":"true","onkeyup":"angka(this);") }}
            </div>
        </div>
        <div class="span11">
            <label for="label">Tanggal Transfer</label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                {{ text_field("tanggaltransfer") }}
            </div>
        </div>
        <div class="span11">
            <label for="Nominal">Nominal Disetor</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("jumlahdisetor","class":"idrCurrency") }}
            </div>
        </div>
        <div class="span11">
            <label for="Nominal">Nominal Benar</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("jumlahbenar","class":"idrCurrency") }}
            </div>
        </div>
        <div class="span11">
            <label for="Nominal">Nominal Deposit</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("jumlahdeposit","class":"idrCurrency") }}
            </div>
        </div>
        <div class="span11">
            <label for="label">Dialihkan untuk ?</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("JenisDeposit", ["":"---","01" : "pembayaran Ongkir, MD, RFID", "02" : "Pembelian Buku"]) }}
            </div>
        </div>
        <div class="span11">
            <label for="TahunAjaran">Tahun Ajaran</label>
            <div class="input-control select" data-role="input-control">
                {{ select("TahunAjaran", TahunAjaran, 'using': ['RecID', 'Description'],'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
        <div class="span11">
            <label for="Keterangan">Kronologi</label>
            <div class="input-control textarea" data-role="input-control">
                <div class='printchatbox'>Sehubungan telah terjadinya kesalahan transfer salah input <span class="ket"></span> dengan <span class="novasalahdeposit"></span>. Nominal yang disetor sebesar <span class="jumlahdisetor"></span> dan nominal benarnya sebesar <span class="jumlahbenar"></span></span> maka <span class="nominalku"></span> kami minta <span class="nextaction"></span></div>
            </div>
        </div>
        <div class="span11" style="padding-bottom:5%;">
            <input id="cekbox3" type='checkbox' onclick='run3();'/> Saya setuju dengan syarat dan ketentuan ini.
        </div>
        <div class="span11">
            <button id='cb3' onclick='KS_Animasi();' disabled type="submit">Simpan</button>
        </div>
    </div>
    </div>
{{ end_form() }}


<!-- Input Refund -->

            </div>
        </div>
        <div class="span6">
            <div class="span12 no-margin">
                <div class="panel-body sp">
                    <h4>PROSEDUR DEPOSIT</h4>
                    <!--<h4>Kesalahan Transfer atau Kelebihan Pembayaran</h4>-->
                    <ol>
                        <li>Lengkapi form disamping setelah selesai checklist bahwa setuju dengan ketentuan yang ditetapkan dan klik tombol simpan, secara otomatis akan download surat pernyataan yang menyatakan terjadi kesalahan transfer, Kemudian surat tersebut di tanda tangan manajer cabang lalu di scan dan dikirim email ke <a href="mailto:finance@primagama.co.id?cc=endra.linardi@primagama.co.id">finance@primagama.co.id</a></li>
                        <li>Lakukan transfer kembali ke No Virtual Account yang benar / yang dimaksud</li>
                        <li>Mengirimkan bukti pembayaran untuk Virtual Account yang benar</li>
                        <li>Setelah melakukan pembayaran ke No VA yang benar / yang dimaksud baru akan kita lakukan proses deposit</li>
                        <li>Proses Deposit kurang lebih 1 (satu) bulan</li>
                    </ol>
                </div>
            </div>
            {{ form("refund/trak", "method":"post") }}
            <div class="span12 no-margin">
                <div class="panel-body sp">
                    <label for="label">Tracking Deposit</label>
                    <div class="input-control select">
                        <div class="span8">
                            {{ select("nosurat", tracking3, 'using': ['NoSuratPernyataan', 'NoSuratPernyataan'],'useEmpty': true, 'emptyText': 'No. Surat', 'emptyValue': '') }}
                        </div>
                        <div class="span3">
                            {{ submit_button("Check") }}
                        </div>
                    </div>
                </div>
            </div>
            {{ end_form() }}
            {% if reject12 is not empty %}
            <div class="span12 no-margin">
                <div class="panel-body sp">
                    <ol>
                        {% for i in reject12 %}
                        <li>No surat {{ i.nosuratpernyataan }} <b>di reject</b> <br/> Alasan Finance : {{ i.Keterangan }} <br/> Alasan GM : {{ i.KeteranganGM }}</li>
                        {% endfor %}
                    </ol>
                </div>
            </div>
            {% endif %}
        </div>
    </div>
</div>

<script type="text/javascript">
function run3(){
    var cb3 = document.getElementById("cb3");
 
    if(document.getElementById("cekbox3").checked == true){
        cb3.disabled = false;
    }else{
        cb3.disabled = true;
    } 
}

function validasi3(){
    if(form3.namapembuatpernyataan.value=="" || form3.namapembuatpernyataan.value==null){
        alert("Nama pembuat pernyataan tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form3.jabatanpembuatpernyataan.value=="" || form3.jabatanpembuatpernyataan.value==null){
        alert("Jabatan pembuat pernyataan tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form3.telpcabang.value=="" || form3.telpcabang.value==null){
        alert("Telp cabang terbaru tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form3.alamatcabang.value=="" || form3.alamatcabang.value==null){
        alert("Alamat cabang terbaru tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form3.tanggaltransfer.value=="" || form3.tanggaltransfer.value==null){
        alert("Tanggal transfer tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form3.jumlahdisetor.value=="" || form3.jumlahdisetor.value==null){
        alert("Nominal yang disetor tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form3.jumlahdeposit.value=="" || form3.jumlahdeposit.value==null){
        alert("Nominal yang dideposite tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form3.JenisDeposit.value=="" || form3.JenisDeposit.value==null){
        alert("Pilih Jenis deposite terlebih dahulu"); return false;
    }
    return true
}

function angka(e) {
    if (!/^[0-9]+$/.test(e.value)) {
        e.value = e.value.substring(0,e.value.length-1);
    }
}

$('#JenisDeposit').change(function(event) {
    newText = event.target.value;
    var novasalah1 = document.getElementById("novasalah1").value;
    var jumlahbenar = document.getElementById("jumlahbenar").value;
    var jumlahdeposit = document.getElementById("jumlahdeposit").value;
    if(newText==='01')
    {
        $('.nextaction').text("dialihkan untuk pembayaran ongkir / MD / RFID");
    }
    if(newText==='02')
    {
        $('.nextaction').text("dialihkan untuk pembelian buku selanjutnya");
    }

    if(novasalah1=='')
    {
        $('.nominalku').text(" sisa kelebihan transfer sebesar " + jumlahdeposit);
    }
    else
    {
        $('.nominalku').text(" nominal sebesar " + jumlahbenar);
    }
});

$('#novabenar1').keyup(function(event) {
    newText = event.target.value;
    var novasalah1 = document.getElementById("novasalah1").value;
    if(novasalah1=='')
    {
        $('.ket').text("Nominal");
        $('.novasalahdeposit').text(" No. VirtualAccount " + newText);
    }
    else
    {
        $('.ket').text("No. VirtualAccount");
        $('.novasalahdeposit').text(" No. VirtualAccount " + novasalah1 + " seharusnya ke No. VirtualAccount " + newText);
    }
});
$('#novasalah1').keyup(function(event) {
    newText = event.target.value;
    var novabenar1 = document.getElementById("novabenar1").value;
    if(novabenar1=='')
    {
        $('.ket').text("No. VirtualAccount");
        $('.novasalahdeposit').text(" No. VirtualAccount " + newText);
    }
    else
    {
        $('.ket').text("Nominal");
        $('.novasalahdeposit').text(" No. VirtualAccount " + newText);
    }
});

$('#jumlahdisetor').keyup(function(event) {
    newText = event.target.value;
    $('.jumlahdisetor').text(newText);
});

$('#jumlahbenar').keyup(function(event) {
    newText = event.target.value;
    $('.jumlahbenar').text(newText);
});

var arrNoVa1 = "{{ url('refund/ambilnovadeposit') }}";
$(document).ready(function() {
    $("#novasalah1").autocomplete({
        source: arrNoVa1
    });
    $("#novabenar1").autocomplete({
        source: arrNoVa1
    });
});

$('#jumlahbenar').keyup(function(event) {
    var jumlah1 = document.getElementById("jumlahdisetor").value;
    var jumlah2 = document.getElementById("jumlahbenar").value;
    newText = event.target.value;
    tes = toAngka(jumlah1) - toAngka(jumlah2);
    $('#jumlahdeposit').val(toRp(tes));
    $('.jumlahdeposit').text(toRp(tes));
});
$('#JenisKesalahan').change(function() {
  if ($(this).val() == '01') {
    $('#novasalah1').prop('disabled', true);
    $('#novabenar1').prop('disabled', false);
  }
  else if ($(this).val() == '02') {
    $('#novabenar1').prop('disabled', false);
    $('#novasalah1').prop('disabled', false);
  }
  else
  {
   $('#novabenar1').prop('disabled', true);
   $('#novasalah1').prop('disabled', false);
  }

});
</script>