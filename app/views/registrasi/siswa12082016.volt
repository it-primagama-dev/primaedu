<div class="grid fluid">    
    <legend>Data Siswa </legend>
    <div class="row">
        <div class="span6">
            <label for="NoKartuSiswa">Kartu Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoKartuSiswa") }}
            </div>
        </div>

<div class="span3">
            <label for="MD">Mengundurkan Diri</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("MD", ["0" : "Ya", "1" : "Tidak"])}}
            </div>
        </div>
<div class="span3">
            <label for="status">Status</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("status", ["0" : "Tidak Aktif", "1" : "Aktif"])}}
            </div>
        </div>

    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="NamaSiswa">Nama Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaSiswa") }}
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
                {{ text_field("TanggalLahir") }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="EmailSiswa">Email Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("EmailSiswa") }}
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
                {{ select("Jenjang", jenjang, "using" : ["KodeJenjang", "NamaJenjang"]) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="AsalSekolah">Asal Sekolah</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("AsalSekolah") }}
            </div>
        </div>
        <div class="span3">
            <label for="Agama">Agama</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("Agama", [
                    "" : "---",
                    "Islam" : "Islam", 
                    "KristenProtestan" : "Kristen Protestan",
                    "KristenKatolik" : "Kristen Katolik",
                    "Hindu" : "Hindu",
                    "Buddha" : "Buddha",
                    "Konghucu" : "Konghucu"]) }}
            </div>
        </div>
        <div class="span3">
            <label for="TeleponSiswa">Telepon Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("TeleponSiswa") }}
            </div>
        </div>
    </div>
</div>
