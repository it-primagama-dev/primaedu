{{ content() }}
<h1>Proses Finance</h1>
<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">

<!-- Input Refund -->

{{ form("refund/simpanrefundnominal1", "onSubmit": "return validasi2();", "method":"post",  "autocomplete" : "off","name":"form2") }}
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
                {{ text_field("nova","maxlength":"11","onkeyup":"angka(this);","onkeyup":"myFunction5('this')") }}
                {{ hidden_field("namanominal") }}
            </div>
         </div>
        <div class="span11">
            <label for="label">Tanggal Transfer <br/><font color="red">*Mohon tanggal disesuaikan dengan tanggal transfer nominal yang salah</font></label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                {{ text_field("tanggaltransfer","id":"tgltransfer") }}
            </div>
        </div>
        <div class="span11">
            <label for="Nominal">Total Transfer (Nominal Salah + Transfer Koreksi) <br/><font color="red">*cth: 5.000.000+3.000.000=8.000.000 mohon disesuaikan</font></label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("nominalsalah","class":"idrCurrency") }}
            </div>
        </div>
        <div class="span11">
            <label for="Nominal">Nominal Benar</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("nominalbenar","class":"idrCurrency") }}
            </div>
        </div>
        <div class="span11">
            <label for="Nominal">Selisih Nominal</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("selisihnominal","class":"idrCurrency","readonly":"true") }}
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
                <div class='printchatbox'>Telah terjadi kesalahan transfer ke nomor Virtual Account <span class="nova"></span> atas nama <span class="namanominal"></span> sebesar Rp <span class="selisihnominal"></span><br> kami telah melakukan transfer koreksi ke nomor Virtual Account <span class="nova"></span> atas nama <span class="namanominal"></span> sebesar Rp <span class="nominalbenar"></span><br> karena kami telah melakukan transfer koreksi, mohon pengembalian dana sebesar 11% dari Rp <span class="selisihnominal"></span></div>
            </div>
        </div>
        <div class="span11" style="padding-bottom:5%;">
            <input id="cekbox2" type='checkbox' onclick='run2();'/> Saya setuju dengan syarat dan ketentuan ini.
        </div>
        <div class="span11">
            <button id='cb2' onclick='KS_Animasi();' disabled type="submit">Simpan</button>
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
                            {{ select("nosurat", tracking2, 'using': ['NoSuratPernyataan', 'NoSuratPernyataan'],'useEmpty': true, 'emptyText': 'No. Surat', 'emptyValue': '') }}
                        </div>
                        <div class="span3">
                            {{ submit_button("Check") }}
                        </div>
                    </div>
                </div>
            </div>
            {{ end_form() }}
            {% if reject11 is not empty %}
            <div class="span12 no-margin">
                <div class="panel-body sp">
                    <ol>
                        {% for i in reject11 %}
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
var arrNoVa = "{{ url('refund/ambilnova') }}";
    $(document).ready(function() { 
        $("#nova").autocomplete({
        source: arrNoVa
    });
});

function run2(){
    var cb2 = document.getElementById("cb2");
 
    if(document.getElementById("cekbox2").checked == true){
        cb2.disabled = false;
    }else{
        cb2.disabled = true;
    } 
}
function validasi2(){
    if(form2.namapembuatpernyataan.value=="" || form2.namapembuatpernyataan.value==null){
        alert("Nama pembuat pernyataan tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form2.jabatanpembuatpernyataan.value=="" || form2.jabatanpembuatpernyataan.value==null){
        alert("Jabatan pembuat pernyataan tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form2.telpcabang.value=="" || form2.telpcabang.value==null){
        alert("Telp cabang terbaru tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form2.alamatcabang.value=="" || form2.alamatcabang.value==null){
        alert("Alamat cabang terbaru tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form2.nova.value=="" || form2.nova.value==null){
        alert("No. Virtual Account tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form2.tanggaltransfer.value=="" || form2.tanggaltransfer.value==null){
        alert("Tanggal transfer tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form2.nominalsalah.value=="" || form2.nominalsalah.value==null){
        alert("Nominal yang salah tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form2.TahunAjaran.value=="" || form2.TahunAjaran.value==null){
        alert("Tahun Ajaran tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form2.nominalbenar.value=="" || form2.nominalbenar.value==null){
        alert("Nominal yang benar tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    return true
}

function angka(e) {
    if (!/^[0-9]+$/.test(e.value)) {
        e.value = e.value.substring(0,e.value.length-1);
    }
}

function myFunction5(elem) {
    var nova=$("#nova").val();
    $.ajax({
        url:"{{ url('refund/carinamanominal') }}",
        type:"POST",
        data:"nova="+nova,
        cache:false,
        success:function(msg){
            data=msg.split("|");
            $("#namanominal").val(data[0]);
           <!-- $("#tgltransfer").val(data[1]); -->
           <!-- $("#nominalsalah").val(data[2]); -->
            $('.namanominal').text(data[0]);
            $('.nominalsalah').text(data[2]); 
        }
    })
}

$('#nova').keyup(function(event) {
    newText = event.target.value;
    $('.nova').text(newText);
});

$('#nominalsalah').keyup(function(event) {
    newText = event.target.value;
    $('.nominalsalah').text(newText);
});

$('#nominalbenar').keyup(function(event) {
    var nominal1 = document.getElementById("nominalsalah").value;
    var nominal2 = document.getElementById("nominalbenar").value;
    newText = event.target.value;
    tes = toAngka(nominal1) - toAngka(nominal2);
    $('.nominalbenar').text(newText);
    $('.selisihnominal').text(toRp(tes));
    $('#selisihnominal').val(toRp(tes));
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