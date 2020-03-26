
{{ content() }}

<nav class="navigation-bar blue">
    <nav class="navigation-bar-content">

        <span class="element logo"><img src="{{ url('img/logo_new_putih_web.png') }}"></span>
        {% for list in result %}
        <span class="element-divider"></span>
        <a class="element brand" href="#">{{ list.NamaAreaCabang }}</a>
        <span class="element-divider"></span>


        <span class="element"><strong> {{ list.NamaSiswa }} / {{ list.NoVA }}  </strong></span>
        <span class="element-divider"></span>
        
        <span class="element-divider"></span>
        <ul class="element-menu place-right">
            <li>
                <a class="dropdown-toggle icon-cog" href="#"></a>
                <ul class="dropdown-menu place-right" data-role="dropdown">
                    <li><a href="{{ url.get('SiswadataAdmin/end') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</nav>
<div class="container">


    <div id="wrapper" class="column">
        <div class="wrap margin-left-200">
            <div class="wrap">
                <div class="content-wrapper">
                    <div class="content">

<br>

<h2 align="center"><strong><i class="icon-pencil"></i> Silahkan lengkapi biodata dibawah ini...</strong> </h2>
                    {{ flash.output() }}
<div class="grid fluid">    

{{ form("SiswadataAdmin/save", "method":"post", "id":"myform") }}
                    {% for list2 in result2 %}
        <input type="text" id="iduser" name="iduser" value="{{ list2.iduser }}"></input>
                    {% endfor %}
        <input type="text" id="RecID" name="RecID" value="{{ list.siswa }}"></input>
        <input type="text" id="VirtualAccount" name="VirtualAccount" value="{{ list.VirtualAccount }}"></input>
        <input type="text" id="Jenjang" name="Jenjang" value="{{ list.Jenjang }}"></input>
        <input type="text" id="Cabang" name="Cabang" value="{{ list.Cabang }}"></input>
        <input type="hidden" id="status" name="status" value="{{ list.status }}"></input>
        <input type="hidden" id="AsalSekolah" name="AsalSekolah" value="{{ list.AsalSekolah }}"></input>
        <input type="hidden" id="CreatedBy" name="CreatedBy" value="{{ list.CreatedBy }}"></input>
        <input type="text" id="NoKartuSiswa" name="NoKartuSiswa" value="{{ list.NoKartuSiswa }}"></input>
        <input type="hidden" id="NamaAreaCabang" name="NamaAreaCabang" value="{{ list.NamaAreaCabang }}"></input>
        <input type="text" id="NoVA" name="NoVA" value="{{ list.NoVA }}"></input>
        <input type="hidden" id="MD" name="MD" value="{{ list.MD }}"></input>
        
        <input type="hidden" id="bcode" name="bcode" value="{{ barcode.bcode }}"></input>

    <legend class="no-margin">Data Siswa</legend>
    <div class="row">
       <div class="span3">
            <label for="NamaSiswa">Nama  Siswa</label>
            <div class="input-control text" data-role="input-control">
            <input type="text_field" id="NamaSiswa" name="NamaSiswa" value="{{ list.NamaSiswa }}" maxlength="30"></input>
            </div>
        </div>
                <div class="span3">
            <label for="EmailSiswa">Email Siswa </label>
            <div class="input-control text" data-role="input-control">
        <input type="text" id="EmailSiswa" name="EmailSiswa" value="{{ list.EmailSiswa }}"> </input>
            </div> 
        </div>
        <div class="span3">
            <label for="TempatLahir">Tempat Lahir</label>
            <div class="input-control text" data-role="input-control">
        <input type="text" id="TempatLahir" name="TempatLahir" value="{{ list.TempatLahir }}"></input>
            </div>
        </div>
        <div class="span3">
            <label for="TanggalLahir">Tanggal Lahir</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
        <input type="text" id="TanggalLahir" name="TanggalLahir" value="{{ list.TanggalLahir }}"></input>
            </div>
        </div>
    </div>
    <div class="row no-margin">

        <div class="span3">
            <label for="TeleponSiswa">Telepon Siswa</label>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="TeleponSiswa" name="TeleponSiswa" value="{{ list.TeleponSiswa }}"></input> 
            </div>
        </div>
        <div class="span3">
            <label for="JenisKelamin">Jenis Kelamin</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("JenisKelamin", ["L" : "Laki laki", "P" : "Perempuan"])}}
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
        
    </div>

    <legend>Data Orang Tua / Wali</legend>
    <div class="row no-margin">
        <div class="span3">
            <label for="NamaAyah">Nama Ayah / Wali</label>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="NamaAyah" name="NamaAyah" value="{{ list.NamaAyah }}"></input> 
            </div>
        </div>
        <div class="span3">
            <label for="EmailAyah">Email Ayah / Wali</label>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="EmailAyah" name="EmailAyah" value="{{ list.EmailAyah }}"></input> 
            </div>
        </div>
        <div class="span3">
            <label for="TeleponAyah">Telepon Ayah / Wali</label>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="TeleponAyah" name="TeleponAyah" value="{{ list.TeleponAyah }}"></input> 
            </div>
        </div>
        <div class="span3">
            <label for="PekerjaanAyah">Pekerjaan Ayah / Wali</label>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="PekerjaanAyah" name="PekerjaanAyah" value="{{ list.PekerjaanAyah }}"></input> 
            </div></div>
    </div>
    <div class="row no-margin">
        <div class="span3">
            <label for="NamaIbu">Nama Ibu / Wali</label>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="NamaIbu" name="NamaIbu" value="{{ list.NamaIbu }}"></input> 
            </div>
        </div>
        <div class="span3">
            <label for="EmailIbu">Email Ibu / Wali</label>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="EmailIbu" name="EmailIbu" value="{{ list.EmailIbu }}"></input> 
            </div>
        </div>
        <div class="span3">
            <label for="TeleponIbu">Telepon Ibu / Wali</label>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="TeleponIbu" name="TeleponIbu" value="{{ list.TeleponIbu }}"></input> 
            </div>
        </div>


        <div class="span3">
            <label for="PekerjaanIbu">Pekerjaan Ibu / Wali</label>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="PekerjaanIbu" name="PekerjaanIbu" value="{{ list.PekerjaanIbu }}"></input> 
            </div></div>
    </div>
	<div class="row no-margin">
		 <div class="span3">
            <label for="Alamat">Alamat</label>
				<div class="input-control textarea" data-role="input-control">                
               <textarea type="text" id="Alamat" name="Alamat" value="{{ list.Alamat }}">{{ list.Alamat }}</textarea> 
				</div>
            </div>
            <div class="span3">
            <label for="Propinsi">Propinsi</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Propinsi", propinsi, "using" : ["RecID", "NamaPropinsi"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div></div>
            <div class="span3">
            <label for="Kota">Kota</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Kota", kotakab, "using" : ["RecID", "NamaKotaKab"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div></div>
            <div class="span3">
            <label for="KodePos">Kode Pos</label>
                <div class="input-control text" data-role="input-control">
               <input type="text" id="KodePos" name="KodePos" value="{{ list.KodePos }}"></input> 
                </div></div>
	</div>

    <b>*Note</b> : <font color="red">Pastikan semua data terisi dengan benar.</font>
	<div class="row">
        <div class="span12 text-right">
            {{ submit_button("Submit", "class": "large primary", "id": "btn-conf", "onclick": "return validateForm()")}}
        </div>

    </div>
</div>


                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>

{% endfor %}

        
{% for list1 in result1 %}
<input type="hidden" id="total" name="total" value="{{ list1.total }}"></input>
{% endfor %}

{{ end_form() }}



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div align="center" class="modal-body">
                      <img src="{{ url('img/Lebah.jpg') }}">
            </div>
            <div class="modal-footer">
                <input type="button" class="primary small" value="Lanjut" data-dismiss="modal">
            </div>
        </div>
    </div>
</div>

<script>
    $("#Propinsi").on("change", function () {
        var url = "{{ url('SiswadataAdmin/getkota/') }}" + $(this).val();
        $.getJSON(url).done(function (data) {
            $("#Kota").empty();
            if (data.status === "OK") {
                var htmlcontent = "";
                $.each(data.listData, function (i, list) {
                    htmlcontent += "<option value=\"" + list.id + "\">" + list.namakotakab + "</option>";
                });
                $("#Kota").html(htmlcontent);
            }
        });
    });
</script>

<script type="text/javascript">

function validateForm() {
    var email = document.getElementById("myform").elements.namedItem("EmailSiswa").value;
    var tanggal = document.getElementById("myform").elements.namedItem("TanggalLahir").value;
    var tempat = document.getElementById("myform").elements.namedItem("TempatLahir").value;
    var JK = document.getElementById("myform").elements.namedItem("JenisKelamin").value;
    var agama = document.getElementById("myform").elements.namedItem("Agama").value;
    var telsis = document.getElementById("myform").elements.namedItem("TeleponSiswa").value;
    var namaayah = document.getElementById("myform").elements.namedItem("NamaAyah").value;
    var teleyah = document.getElementById("myform").elements.namedItem("TeleponAyah").value;
    var emailayah = document.getElementById("myform").elements.namedItem("EmailAyah").value;
    var telibu = document.getElementById("myform").elements.namedItem("TeleponIbu").value;
    var pekibu = document.getElementById("myform").elements.namedItem("PekerjaanIbu").value;
    var emailibu = document.getElementById("myform").elements.namedItem("EmailIbu").value;
    var namaibu = document.getElementById("myform").elements.namedItem("NamaIbu").value;
    var propinsi = document.getElementById("myform").elements.namedItem("Propinsi").value;
    var kota = document.getElementById("myform").elements.namedItem("Kota").value;
    var alamat = document.getElementById("myform").elements.namedItem("Alamat").value;
    var kodepos = document.getElementById("myform").elements.namedItem("KodePos").value;
    var kerjaayah = document.getElementById("myform").elements.namedItem("PekerjaanAyah").value;
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");

    if (email == null || email == "") {
        alert("Email wajib diisi !!");
        location.reload();
        return false;
    }

    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        alert("Email tidak valid !!");
        location.reload();
        return false;
    }

    if (tanggal == null || tanggal == "") {
        alert("Tanggal lahir wajib diisi !!");
        location.reload();
        return false;
    }
    if (tempat == null || tempat == "") {
        alert("Tempat lahir wajib diisi !!");
        location.reload();
        return false;
    }
    if (JK == null || JK == "") {
        alert("Jenis Kelamin wajib diisi !!");
        location.reload();
        return false;
    }
    if (telsis == null || telsis == "") {
        alert("Telepon Siswa wajib diisi !!");
        location.reload();
        return false;
    }
    if (namaayah == null || namaayah == "") {
        alert("Nama Ayah wajib diisi !!");
        location.reload();
        return false;
    }
    if (teleyah == null || teleyah == "") {
        alert("Telepon Ayah wajib diisi !!");
        location.reload();
        return false;
    }    
    if (telibu == null || telibu == "") {
        alert("Telepon Ibu wajib diisi !!");
        location.reload();
        return false;
    }    
    if (pekibu == null || pekibu == "") {
        alert("Pekerjaan Ibu wajib diisi !!");
        location.reload();
        return false;
    }    
    if (emailibu == null || emailibu == "") {
        alert("Email Ibu wajib diisi !!");
        location.reload();
        return false;
    }      
    if (kerjaayah == null || kerjaayah == "") {
        alert("Pekerjaan Ayah wajib diisi !!");
        location.reload();
        return false;
    }    
    if (emailayah == null || emailayah == "") {
        alert("Email Ayah wajib diisi !!");
        location.reload();
        return false;
    }   
    if (namaibu == null || namaibu == "") {
        alert("Nama Ibu wajib diisi !!");
        location.reload();
        return false;
    }
    if (propinsi == null || propinsi == "") {
        alert("Propinsi wajib diisi !!");
        location.reload();
        return false;
    }
    if (kota == null || kota == "") {
        alert("Kota wajib diisi !!");
        location.reload();
        return false;
    }
    if (alamat == null || alamat == "") {
        alert("Alamat wajib diisi !!");
        location.reload();
        return false;
    }
    if (agama == null || agama == "") {
        alert("Agama wajib diisi !!");
        location.reload();
        return false;
    }
    if (kodepos == null || kodepos == "") {
        alert("Kode Pos wajib diisi !!");
        location.reload();
        return false;
    }
}

</script>

<script>
$(document).ready(function(){

    $(window).load(function() {
        $("#myModal .modal-title").html("<center><h2><b>Salam SMART !!</b></h2></center>");
        $("#myModal").modal('show');
    });
});
</script>

<script>
    $("#Propinsi").on("change", function () {
        var url = "{{ url('registrasi/getkota/') }}" + $(this).val();
        $.getJSON(url).done(function (data) {
            $("#Kota").empty();
            if (data.status === "OK") {
                var htmlcontent = "";
                $.each(data.listData, function (i, list) {
                    htmlcontent += "<option value=\"" + list.id + "\">" + list.namakotakab + "</option>";
                });
                $("#Kota").html(htmlcontent);
            }
        });
    });
</script>