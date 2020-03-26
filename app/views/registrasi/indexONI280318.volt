<h1>Pendaftaran</h1>

<div class="grid fluid">
    <!--
    <div class="row no-margin">
    {{ form("registrasi/siswabaru", "method":"post") }}
        <div class="span4">
            <legend><i class="icon-grid-view on-left-more smaller"></i>Siswa sudah terdaftar</legend>
            <label for="NoIndukSiswa">Nomor Induk Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoIndukSiswa", "maxlength": 7) }}
            </div>
            {{ submit_button("Submit", "class": "large primary")}}
        </div>
    {{ end_form() }}
    </div>
    -->
    <font color="blue"><b>Note : <br></b>
    <i> Untuk siswa reservasi silahkan daftarkan dengan VA baru pada menu "Siswa Baru" dibawah ini.<br> Terima kasih
    </font>
    <div class="row no-margin">
        <div class="span4">
            <legend><i class="icon-grid-view on-left-more smaller"></i>Siswa baru</legend>
            <a href="{{ url("registrasi/siswabaru") }}">
                <button class="command-button primary">
                    <i class="icon-pencil on-left"></i>
                    Siswa Baru
                    <small>Mulai pengisian formulir</small>
                </button>
            </a>
        </div>
    </div>
</div>
