
<h1>
    {{ link_to("bukusiswa/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Penyerahan Buku
    <small class="on-right">Proses</small>
</h1>
{% for list in result %}

<strong>Nama Siswa : {{ list.NamaSiswa }}<br> Program : {{ list.NamaProgram }}</strong>

{% endfor %}

{{ content() }}

{{ form("bukusiswa/create", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="InventItem">Nama Buku</label>
            <div class="input-control select" data-role="input-control">
            <select id="InventItem" name="InventItem"> 
            {% for list in buku %}
            <option value="{{ list.KodeItem }}">{{ list.NamaItem }}</option>
            {% endfor %}
            </select> <font size="2" color="red"><i>*Daftar buku ditampilkan berdasarkan jenjang siswa tersebut dan hanya yang tersedia stoknya.</i></font>
            </div>
            
            <label for="TanggalTerima">Tanggal Terima</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd" data-effect="slide">
                {{ text_field("TanggalTerima", "size" : 30) }}
            </div>
            <label for="Jumlah">Jumlah</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Jumlah", "value" : 1, "readonly" : "readonly") }}
            </div>
            <label for="SerialNumber">Barcode Buku</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("SerialNumber", "maxlength":14) }}
            </div>

            <input type="hidden" id="ProgramSiswa" name="ProgramSiswa" value="{{ program }}"></input>
            <input type="hidden" id="kodesiswa" name="kodesiswa" value="{{ siswa }}"></input>
            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>



{% for list in result %}

 <input type="hidden" id="siswa" name="siswa" value="{{ list.NamaSiswa }}"></input>
 <input type="hidden" id="kodebarcode" name="kodebarcode" value="{{ list.kodebarcode }}"></input>
 <input type="hidden" id="program" name="program" value="{{ list.NamaProgram }}"></input>
 <input type="hidden" id="jenjang" name="jenjang" value="{{ list.KodeJenjang }}"></input>

{% endfor %}


{{ end_form() }}




   


  
 

  