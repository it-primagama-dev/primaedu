<div class="grid fluid">    
    <legend class="no-margin">Data Siswa</legend>
    <div class="row">
        <div class="span6">
            <label for="NamaSiswa">Nama  Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaSiswa","placeholder" : "wajib di isi") }}
            </div>
        </div>
        <div class="span3">
            <label for="TempatLahir">Tempat Lahir</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("TempatLahir") }}
            </div>
        </div>
        <div class="span3">
            <label for="TanggalLahir">Tanggal Lahir</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("TanggalLahir","placeholder" : "wajib di isi") }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="EmailSiswa">Email Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("EmailSiswa","placeholder" : "wajib di isi") }}
            </div>
        </div>
        <div class="span3">
            <label for="JenisKelamin">Jenis Kelamin</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("JenisKelamin", ["L" : "Laki laki", "P" : "Perempuan"])}}
            </div>
        </div>
        <div class="span3">
            <label for="Jenjang">Jenjang</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Jenjang", jenjang, "using" : ["KodeJenjang", "NamaJenjang"],
                'useEmpty': true, 'emptyText': ' - Pilih - ', 'emptyValue': '') }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="NoKartuSiswa">Kartu Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoKartuSiswa") }}
            </div>
        </div>
    </div>
    <legend>Data Orang Tua</legend>
    <div class="row no-margin">
        <div class="span6">
            <label for="NamaAyah">Nama Ayah</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaAyah","placeholder" : "wajib di isi") }}
            </div>
        </div>
        <div class="span3">
            <label for="EmailAyah">Email Ayah</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("EmailAyah") }}
            </div>
        </div>
        <div class="span3">
            <label for="TeleponAyah">Telepon Ayah</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("TeleponAyah","placeholder" : "wajib di isi ayah/ibu") }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="NamaIbu">Nama Ibu</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaIbu") }}
            </div>
        </div>
        <div class="span3">
            <label for="EmailIbu">Email Ibu</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("EmailIbu") }}
            </div>
        </div>
        <div class="span3">
            <label for="TeleponIbu">Telepon Ibu</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("TeleponIbu") }}
            </div>
        </div>
    </div>
    <legend>Pilih Program & Jadwal</legend>
    <div class="row">
        <div class="span4">
            <label for="Program">Program</label>
            <div class="input-control select" data-role="input-control">
                <select id="Program" name="Program">
                </select>
            </div>
        </div>
        <div class="span5">
            <label for="Jadwal">Jadwal</label>
            <div class="input-control select" data-role="input-control">
                <select id="Jadwal" name="Jadwal">
                </select>
            </div>
        </div>
    </div>
</div>
