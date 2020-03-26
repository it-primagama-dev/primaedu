<div class="grid fluid">
    <legend>Data Orang Tua & Alamat</legend>
    <div class="row">
        <div class="span6">
            <label for="NamaAyah">Nama Ayah</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaAyah") }}
            </div>
            <label for="EmailAyah">Email Ayah</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("EmailAyah") }}
            </div>
            <label for="TeleponAyah">Telepon Ayah</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("TeleponAyah") }}
            </div>
            <label for="PekerjaanAyah">Pekerjaan Ayah</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("PekerjaanAyah") }}
            </div>
        </div>
        <div class="span6">
            <label for="NamaIbu">Nama Ibu</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaIbu") }}
            </div>
            <label for="EmailOrangTua">Email Ibu</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("EmailIbu") }}
            </div>
            <label for="TeleponOrangTua">Telepon Ibu</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("TeleponIbu") }}
            </div>
            <label for="PekerjaanIbu">Pekerjaan Ibu</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("PekerjaanIbu") }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span6">
            <label for="Alamat">Alamat</label>
            <div class="input-control textarea" data-role="input-control">
                
                {{ text_area("Alamat") }}
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
                {{text_field("KodePos") }}
            </div>
        </div>
    </div>
</div>