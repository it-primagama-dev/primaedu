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
    <b>
    <i> Untuk pendaftaran siswa tahun ajaran 2017/2018 silahkan pilih menu "<font color="red">Siswa Baru 2017/2018</font>"<br>
    <i> Dan untuk pendaftaran siswa tahun ajaran 2018/2019 silahkan pilih menu "<font color="green">Siswa Baru 2018/2019</font>"<br> Terima kasih </b>
    </font>
    <div class="row no-margin">
        <div class="span4"> 
            <legend><i class="icon-grid-view on-left-more smaller"></i>Siswa baru TA 2017/2018</legend>
            <a href="{{ url("registrasi/siswabaru/"~1486736823) }}">
                <button class="command-button danger">
                    <i class="icon-pencil on-left"></i>
                    Siswa Baru 2017/2018
                    <small>Mulai pengisian formulir</small>
                </button>
            </a>
        </div>
        <div class="span4"> 
            <legend><i class="icon-grid-view on-left-more smaller"></i>Siswa baru TA 2018/2019</legend>
            <a href="{{ url("registrasi/siswabaru/"~6728364927) }}">
                <button class="command-button success">
                    <i class="icon-pencil on-left"></i>
                    Siswa Baru 2018/2019
                    <small>Mulai pengisian formulir</small>
                </button>
            </a>
        </div> 
    </div>
</div>
