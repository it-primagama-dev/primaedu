{{ content() }}

<h1>Proses Finance</h1>

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">

<!-- Input Refund -->

{{ form("refund/simpanrefundsiswa1", "onSubmit": "return validasi();", "method":"post",  "autocomplete" : "off","name":"form") }}
    <div class="grid fluid">
    <div class="row">

    <input type="hidden" name="Cabang" value="{{ kodecbg }}">
    
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
            <label for="label" class="no-padding">KodeCabang + KodeSiswa Salah</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("novasalah","maxlength":"11","onkeyup":"angka(this);","onkeyup":"myFunction1('this')") }}
                {{ hidden_field("namasalah") }}
            </div>
        </div>
        <div class="span11">
            <label for="label" class="no-padding">Kodecabang + KodeSiswa Benar</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("novabenar","maxlength":"11","onkeyup":"angka(this);","onkeyup":"myFunction2('this')") }}
            </div>
         </div>
        <div class="span11">
            <label for="label">Tanggal Transfer <br/>*mohon disesuaikan</label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                {{ text_field("tanggaltransfer") }}
                {{ hidden_field("namabenar") }}
            </div>
        </div>
        <div class="span11">
            <label for="Nominal">Jumlah yang di transfer <br/>*mohon disesuaikan</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("nominal","class":"idrCurrency") }}
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
                <div class='printchatbox'>Telah terjadi kesalahan transfer dengan nomor VA <span class="novasalah"></span> atas nama <span class="namasalah"></span> seharusnya transfer ke nomor VA <span class="novabenar"></span> atas nama <span class="namabenar"></span> sejumlah <span class="nominal"></span></div>
            </div>
        </div>
        <div class="span11" style="padding-bottom:5%;">
            <input id="cekbox" type='checkbox' onclick="run();"> Saya setuju dengan syarat dan ketentuan ini.
        </div>
        <div class="span11">
            <button id='cb' onclick='KS_Animasi();' disabled type="submit">Simpan</button>
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
                    <h4>PROSEDUR REFUND</h4>
                    <h4>Kesalahan Payment Masuk Ke Cab.Lain atau Siswa Lain</h4>
                    <ol>
                        <li>Lengkapi form disamping setelah selesai checklist bahwa setuju dengan ketentuan yang ditetapkan dan klik tombol simpan, secara otomatis akan download surat pernyataan yang menyatakan terjadi kesalahan transfer, Kemudian surat tersebut di tanda tangan manajer cabang lalu di scan dan dikirim email ke <a href="mailto:finance@primagama.co.id?cc=endra.linardi@primagama.co.id">finance@primagama.co.id</a></li>
                        <li>Lakukan transfer kembali ke no virtual account yang benar / yang dimaksud</li>
                        <li>Mengirimkan bukti pembayaran untuk virtual account yang benar</li>
                        <li>Setelah melakukan pembayaran ke no VA yang benar / yang dimaksud baru akan kita lakukan proses refund</li>
                        <li>Proses refund kurang lebih 1 (satu) bulan</li>
                    </ol>
                </div>
            </div>
            {{ form("refund/trak1", "method":"post") }}
            <div class="span12 no-margin">
                <div class="panel-body sp">
                    <label for="label">Tracking Refund</label>
                    <div class="input-control select">
                        <div class="span8">
                            {{ select("nosurat", tracking1, 'using': ['NoSuratPernyataan', 'NoSuratPernyataan'],'useEmpty': true, 'emptyText': 'No. Surat', 'emptyValue': '') }}
                        </div>
                        <div class="span3">
                            {{ submit_button("Check") }}
                        </div>
                    </div>
                </div>
            </div>
            {{ end_form() }}
            {% if reject10 is not empty %}
            <div class="span12 no-margin">
                <div class="panel-body sp">
                    <ol>
                        {% for i in reject10 %}
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
function run(){
    var cb = document.getElementById("cb");
    if(document.getElementById("cekbox").checked == true){
        cb.disabled = false;
    }else{
        cb.disabled = true;
    } 
}

function validasi(){
if(form.namapembuatpernyataan.value=="" || form.namapembuatpernyataan.value==null){
    alert("Nama pembuat pernyataan tidak boleh kosong, silakan isi terlebih dahulu"); return false;
}
if(form.jabatanpembuatpernyataan.value=="" || form.jabatanpembuatpernyataan.value==null){
    alert("Jabatan pembuat pernyataan tidak boleh kosong, silakan isi terlebih dahulu"); return false;
}
if(form.telpcabang.value=="" || form.telpcabang.value==null){
    alert("Telp cabang terbaru tidak boleh kosong, silakan isi terlebih dahulu"); return false;
}
if(form.alamatcabang.value=="" || form.alamatcabang.value==null){
    alert("Alamat cabang terbaru tidak boleh kosong, silakan isi terlebih dahulu"); return false;
}
if(form.novasalah.value=="" || form.novasalah.value==null){
    alert("No. VA salah tidak boleh kosong, silakan isi terlebih dahulu"); return false;
}
if(form.novabenar.value=="" || form.novabenar.value==null){
    alert("No. VA benar tidak boleh kosong, silakan isi terlebih dahulu"); return false;
}
if(form.tanggaltransfer.value=="" || form.tanggaltransfer.value==null){
    alert("Tanggal transfer tidak boleh kosong, silakan isi terlebih dahulu"); return false;
}
if(form.TahunAjaran.value=="" || form.TahunAjaran.value==null){
        alert("Tahun Ajaran tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
if(form.nominal.value=="" || form.nominal.value==null){
    alert("Jumlah nominal tidak boleh kosong, silakan isi terlebih dahulu"); return false;
}
return true
}
function angka(e) {
    if (!/^[0-9]+$/.test(e.value)) {
        e.value = e.value.substring(0,e.value.length-1);
    }
}
var arrNoVa = "{{ url('refund/ambilnova') }}";
$(document).ready(function() {
    $("#novasalah").autocomplete({
        source: arrNoVa
    });
    $("#novabenar").autocomplete({
        source: arrNoVa
    });
});

$('#novasalah').keyup(function(event) {
    newText = event.target.value;
    $('.novasalah').text(newText);
});

$('#novabenar').keyup(function(event) {
    newText = event.target.value;
    $('.novabenar').text(newText);
});

function showDiv(elem) {
    if(elem.value == '') {
        document.getElementById('displayrefund').style.display = "none";
    } else {
        document.getElementById('displayrefund').style.display = "block";
    }
}

function myFunction1(elem) {
    var novasalah=$("#novasalah").val();
    $.ajax({
        url:"{{ url('refund/carinamasalah') }}",
        type:"POST",
        data:"novasalah="+novasalah,
        cache:false,
        success:function(msg){
            data=msg.split("|");
            $("#namasalah").val(data[0]);
            $("#tanggaltransfer").val(data[1]);
            $("#nominal").val(data[2]);
            $('.namasalah').text(data[0]);
            $('.nominal').text(data[2]);
        }
    })
}

$('#nominal').keyup(function(event) {
    newText = event.target.value;
    $('.nominal').text(newText);
});

function myFunction2(elem) {
    var novabenar=$("#novabenar").val();
    $.ajax({
        url:"{{ url('refund/carinamabenar') }}",
        type:"POST",
        data:"novabenar="+novabenar,
        cache:false,
        success:function(html){
            $("#namabenar").val(html)
            $('.namabenar').text(html)
        }
    })
}
</script>