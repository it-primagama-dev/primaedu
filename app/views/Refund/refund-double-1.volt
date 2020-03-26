{{ content() }}
<h1>Proses Finance Untuk Double Transfer</h1>
<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">

<!-- Input Refund -->

{{ form("refund/simpanrefunddouble1", "onSubmit": "return validasi4();", "method":"post",  "autocomplete" : "off","name":"form4") }}
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
            <label for="label" class="no-padding">KodeCabang + KodeSiswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("novadouble","maxlength":"11","onkeyup":"angka(this);","onkeyup":"myFunctiondouble('this')") }}
                {{ hidden_field("namanominaldouble") }}
            </div>
         </div>
        <div class="span11">
            <label for="label">Tanggal Transfer <br/><font color="red">*Mohon tanggal disesuaikan dengan Nominal transfer yang akan di refund</font></label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                {{ text_field("tanggaltransferdouble","id":"tgltransferdouble") }}
            </div>
        </div>
        <div class="span11">
            <label for="Nominal">Total Transfer (Nominal transfer 1 + Nominal Transfer 2) <br/><font color="red">*Mohon Jumlah transfer disesuaikan (Cth: 3.000.000+3.000.000=6.000.000) </font></label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("nominalsalahdouble","class":"idrCurrency") }}
            </div>
        </div>
        <div class="span11">
            <label for="Nominal">Nominal Benar</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("nominalbenardouble","class":"idrCurrency") }}
            </div>
        </div>
        <div class="span11">
            <label for="Nominal">Selisih Nominal</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("selisihnominaldouble","class":"idrCurrency","readonly":"true") }}
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
                <div class='printchatbox'>Telah terjadi Double transfer ke nomor Virtual Account <span class="novadouble"></span> atas nama <span class="namanominaldouble"></span> sebesar Rp <span class="nominalsalahdouble">.</span><br>Oleh karena itu,kami mohon pengembalian dana sebesar 11% dari <span class="selisihnominaldouble"></span></div>
            </div>
        </div>
        <div class="span11" style="padding-bottom:5%;">
            <input id="cekbox4" type='checkbox' onclick='run4();'/> Saya setuju dengan syarat dan ketentuan ini.
        </div>
        <div class="span11">
            <button id='cb4' onclick='KS_Animasi();' disabled type="submit">Simpan</button>
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
                    <h4>Kesalahan Transfer atau Kelebihan Pembayaran</h4>
                    <ol>
                        <li>Lengkapi form disamping setelah selesai checklist bahwa setuju dengan ketentuan yang ditetapkan dan klik tombol simpan, secara otomatis akan download surat pernyataan yang menyatakan terjadi kesalahan transfer, Kemudian surat tersebut di tanda tangan manajer cabang lalu di scan dan dikirim email ke <a href="mailto:finance@primagama.co.id?cc=endra.linardi@primagama.co.id">finance@primagama.co.id</a></li>
                        <li>Lakukan transfer kembali ke no virtual account yang benar / yang dimaksud</li>
                        <li>Mengirimkan bukti pembayaran serta kwitansi untuk virtual account yang benar </li>
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
                            {{ select("nosurat", trackingdouble, 'using': ['NoSuratPernyataan', 'NoSuratPernyataan'],'useEmpty': true, 'emptyText': 'No. Surat', 'emptyValue': '') }}
                        </div>
                        <div class="span3">
                            {{ submit_button("Check") }}
                        </div>
                    </div>
                </div>
            </div>
            {{ end_form() }}
            {% if rejectdouble is not empty %}
            <div class="span12 no-margin">
                <div class="panel-body sp">
                    <ol>
                        {% for i in rejectdouble %}
                        <li>No surat {{ i.nosuratpernyataan }} <b>di reject</b> <br/> Alasan Finance : {{ i.Keterangan }} <br/> Alasan GM : {{ i.KeteranganGM }}</li>
                        {% endfor %}
                    </ol>
                </div>
            </div>
            {% endif %}
        </div>
    </div>
</div>

<script>
var arrNoVa = "{{ url('refund/ambilnovadouble') }}";
    $(document).ready(function() { 
        $("#novadouble").autocomplete({
        source: arrNoVa
    });
});

function run4(){
    var cb4 = document.getElementById("cb4");
 
    if(document.getElementById("cekbox4").checked == true){
        cb4.disabled = false;
    }else{
        cb4.disabled = true;
    } 
}
function validasi4(){
    if(form4.namapembuatpernyataan.value=="" || form4.namapembuatpernyataan.value==null){
        alert("Nama pembuat pernyataan tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.jabatanpembuatpernyataan.value=="" || form4.jabatanpembuatpernyataan.value==null){
        alert("Jabatan pembuat pernyataan tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.telpcabang.value=="" || form4.telpcabang.value==null){
        alert("Telp cabang terbaru tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.alamatcabang.value=="" || form4.alamatcabang.value==null){
        alert("Alamat cabang terbaru tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.novadouble.value=="" || form4.novadouble.value==null){
        alert("No. Virtual Account tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.tanggaltransferdouble.value=="" || form4.tanggaltransferdouble.value==null){
        alert("Tanggal transfer tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.nominalsalahdouble.value=="" || form4.nominalsalahdouble.value==null){
        alert("Nominal yang salah tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.TahunAjaran.value=="" || form4.TahunAjaran.value==null){
        alert("Tahun Ajaran tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.nominalbenardouble.value=="" || form4.nominalbenardouble.value==null){
        alert("Nominal yang benar tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    return true
}

function angka(e) {
    if (!/^[0-9]+$/.test(e.value)) {
        e.value = e.value.substring(0,e.value.length-1);
    }
}

function myFunctiondouble(elem) {
    var novadouble=$("#novadouble").val();
    $.ajax({
        url:"{{ url('refund/carinamadouble') }}",
        type:"POST",
        data:"novadouble="+novadouble,
        cache:false,
        success:function(msg){
            data=msg.split("|");
            $("#namanominaldouble").val(data[0]);
           <!-- $("#tgltransferdouble").val(data[1]); -->
           <!-- $("#nominalsalahdouble").val(data[2]); -->
            $('.namanominaldouble').text(data[0]);
            $('.nominalsalahdouble').text(data[2]); 
        }
    })
}

$('#novadouble').keyup(function(event) {
    newText = event.target.value;
    $('.novadouble').text(newText);
});

$('#nominalsalahdouble').keyup(function(event) {
    newText = event.target.value;
    $('.nominalsalahdouble').text(newText);
});

$('#nominalbenardouble').keyup(function(event) {
    var nominal1double = document.getElementById("nominalsalahdouble").value;
    var nominal2double = document.getElementById("nominalbenardouble").value;
    newText = event.target.value;
    tes = toAngka(nominal1double) - toAngka(nominal2double);
    $('.nominalbenardouble').text(newText);
    $('.selisihnominaldouble').text(toRp(tes));
    $('#selisihnominaldouble').val(toRp(tes));
});

function toRp(angka){
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

function toAngka(rp){return parseInt(rp.replace(/,.*|\D/g,''),10)}
</script>