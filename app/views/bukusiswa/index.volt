<h1>Penyerahan Buku</h1>

{{ content() }}

{{ form("bukusiswa/search", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span4">
            <label for="KodeSiswa">Kode Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodeSiswa", "maxlength" : 7) }}
            </div>
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>
{{ end_form() }}
