{{ content() }}

<script type="text/javascript">
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
    if(form4.novasalahdari.value=="" || form4.novasalahdari.value==null){
        alert("No. VA salah dari tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.novasalahsampai.value=="" || form4.novasalahsampai.value==null){
        alert("No. VA salah sampai tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.novabenardari.value=="" || form4.novabenardari.value==null){
        alert("No. VA benar dari tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.novabenarsampai.value=="" || form4.novabenarsampai.value==null){
        alert("No. VA benar sampai tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.tanggaltransfer.value=="" || form4.tanggaltransfer.value==null){
        alert("Tanggal transfer tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.TahunAjaran.value=="" || form4.TahunAjaran.value==null){
        alert("Tahun Ajaran tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    if(form4.nominal.value=="" || form4.nominal.value==null){
        alert("Jumlah nominal tidak boleh kosong, silakan isi terlebih dahulu"); return false;
    }
    return true
    }
    function angka(e) {
        if (!/^[0-9]+$/.test(e.value)) {
            e.value = e.value.substring(0,e.value.length-1);
        }
    }
</script>

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">

<!-- Input Refund -->

{{ form("refund/simpanrefundbertingkat", "onSubmit": "return validasi4();", "method":"post",  "autocomplete" : "off","name":"form4") }}
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
            <label for="label" class="no-padding">Kodecabang + No. VA yang Salah Dari</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("novasalahdari","maxlength":"11","onkeyup":"angka(this);") }}
            </div>
        </div>
        <div class="span11">
            <label for="label" class="no-padding">Kodecabang + No. VA yang Salah Sampai</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("novasalahsampai","maxlength":"11","onkeyup":"angka(this);") }}
            </div>
        </div>
        <div class="span11">
            <label for="label" class="no-padding">Kodecabang + No. VA yang Benar Dari</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("novabenardari","maxlength":"11","onkeyup":"angka(this);") }}
            </div>
         </div>
         <div class="span11">
            <label for="label" class="no-padding">Kodecabang + No. VA yang Benar Sampai</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("novabenarsampai","maxlength":"11","onkeyup":"angka(this);") }}
            </div>
         </div>
        <div class="span11">
            <label for="label">Tanggal Transfer</label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                {{ text_field("tanggaltransfer") }}
            </div>
        </div>
        <div class="span11">
            <label for="Nominal">Jumlah yang di transfer</label>
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
        <div class="span11" style="padding-bottom:5%;">
            <input id="cekbox4" type='checkbox' onclick="run4();"> Saya setuju dengan syarat dan ketentuan ini.
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
                    <h4>Kesalahan Payment Masuk Ke Cab.Lain atau Siswa Lain Bertingkat</h4>
                    <ol>
                        <li>Lengkapi form disamping setelah selesai checklist bahwa setuju dengan ketentuan yang ditetapkan dan klik tombol simpan, secara otomatis akan download surat pernyataan yang menyatakan terjadi kesalahan transfer, Kemudian surat tersebut di tanda tangan manajer cabang lalu di scan dan dikirim email ke <a href="mailto:finance@primagama.co.id?cc=endra.linardi@primagama.co.id">finance@primagama.co.id</a></li>
                        <li>Lakukan transfer kembali ke no virtual account yang benar / yang dimaksud</li>
                        <li>Mengirimkan bukti pembayaran untuk virtual account yang benar</li>
                        <li>Setelah melakukan pembayaran ke no VA yang benar / yang dimaksud baru akan kita lakukan proses refund</li>
                        <li>Proses refund kurang lebih 1 (satu) bulan</li>
                    </ol>
                </div>
            </div>
            {{ form("refund/trak", "method":"post") }}
            <div class="span12 no-margin">
                <div class="panel-body sp">
                    <label for="label">Tracking Refund</label>
                    <div class="input-control select">
                        <div class="span8">
                            <select name="nosurat" id="nosurat">
                                <option value="">No Surat</option>
                                {% for i in tracking4 %}
                                    <option value="{{ i.NoSuratPernyataan }}">{{ i.NoSuratPernyataan }}</option>
                                {% endfor %}
                            </select>
                        </div>
                        <div class="span3">
                            {{ submit_button("Check") }}
                        </div>
                    </div>
                </div>
            </div>
            {{ end_form() }}
            {% if reject13 is not empty %}
            <div class="span12 no-margin">
                <div class="panel-body sp">
                    <ol>
                        {% for i in reject13 %}
                        <li>No surat {{ i.nosuratpernyataan }} <b>di reject</b> <br/> Alasan Finance : {{ i.Keterangan }} <br/> Alasan GM : {{ i.KeteranganGM }}</li>
                        {% endfor %}
                    </ol>
                </div>
            </div>
            {% endif %}
        </div>
    </div>
</div>