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
    <i> Untuk pendaftaran siswa tahun ajaran 2019/2020 silahkan pilih menu "<font color="red">Siswa Baru 2019/2020</font>"<br>
    <i> Dan untuk pendaftaran siswa tahun ajaran 2018/2019 silahkan pilih menu "<font color="green">Siswa 2018/2019</font>"<br> Terima kasih </b>
    </font>
            
            {% if result is not empty %}
            {% for list in result %}


               {% if list.cilegal18 == '1' %}
        <div class="row no-margin">
         <div class="span4"> 
            <legend><i class="icon-grid-view on-left-more smaller"></i>Siswa baru TA 2019/2020</legend>
            <a href="{{ url("registrasi/siswabaru/"~1486736823) }}">
                <button class="command-button danger">
                    <i class="icon-pencil on-left"></i>
                    Siswa Baru 2019/2020
                    <small>Mulai pengisian formulir</small>
                </button>
            </a>
        </div>
        <div class="span4"> 
            <legend><i class="icon-grid-view on-left-more smaller"></i>Siswa TA 2018/2019</legend>
                <button class="command-button success">
                     <pre>Silahkan Hubungi
Pak Julian   : 08118828368 
Pak Ayub     : 08118828392 
Pak Nasution : 08119926912 
Pak Budi Maryatno : 08122953799
                 </pre>
                </button>
            </a>
        </div>
        </div>
             {% elseif list.cilegal == '1' %}

            <legend><i class="icon-grid-view on-left-more smaller"></i>Siswa baru TA 2019/2020</legend>
                <button class="command-button success">
<marquee>MOHON MENGHUBUNGI DIVISI FRANCHISE NO.TELP. 0274 - 552996 ATAU 0813 2885 9396</marquee>
                    <!--<pre>Silahkan Hubungi
Pak Julian   : 08118828368 
Pak Ayub     : 08118828392 
Pak Nasution : 08119926912 
Pak Budi Maryatno : 08122953799
                 </pre>-->
                </button>
            </div> 
            {% else %}
            <div class="row no-margin">
            <div class="span4"> 
            <legend><i class="icon-grid-view on-left-more smaller"></i>Siswa baru TA 2019/2020</legend>
            <a href="{{ url("registrasi/siswabaru/"~1486736823) }}">
                <button class="command-button danger">
                    <i class="icon-pencil on-left"></i>
                    Siswa Baru 2019/2020
                    <small>Mulai pengisian formulir</small>
                </button>
            </a>
        </div>
        
    </div>
            {% endif %}            
           {% endfor %}
           {% endif %}
<div class="span4"> 
            <legend><i class="icon-grid-view on-left-more smaller"></i>Siswa baru TA 2018/2019</legend>
            <a href="{{ url("registrasi/siswabaru/"~6728364927) }}">
                <button class="command-button success">
                    <i class="icon-pencil on-left"></i>
                    Siswa 2018/2019
                    <small>Mulai pengisian formulir</small>
                </button>
            </a>
        </div>
        </div> 
    </div>
</div>
