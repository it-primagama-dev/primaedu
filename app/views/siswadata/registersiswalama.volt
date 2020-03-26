{% for list in result %}
{{ form("Siswadata/save", "method":"post", "id":"myform") }}


                <input type="hidden" id="iduser" name="iduser" value="{{ iduserEMS }}"></input>


<div id='myDIV'>

        <input type="hidden" id="RecID" name="RecID" value="{{ RecidSiswa }}"></input>

        <input type="hidden" id="VirtualAccount" name="VirtualAccount" value="{{ list.VirtualAccount }}"></input>
        <input type="hidden" id="Jenjang" name="Jenjang" value="{{ list.Jenjang }}"></input>
        <input type="hidden" id="Cabang" name="Cabang" value="{{ list.Cabang }}"></input>
        <input type="hidden" id="status" name="status" value="{{ list.status }}"></input>
        <input type="hidden" id="AsalSekolah" name="AsalSekolah" value="{{ list.AsalSekolah }}"></input>
        <input type="hidden" id="CreatedBy" name="CreatedBy" value="{{ list.CreatedBy }}"></input>
        <input type="hidden" id="NoKartuSiswa" name="NoKartuSiswa" value="{{ list.NoKartuSiswa }}"></input>
        <input type="hidden" id="NamaAreaCabang" name="NamaAreaCabang" value="{{ list.NamaAreaCabang }}"></input>
        <input type="hidden" id="NoVA" name="NoVA" value="{{ NoVAbaru }}"></input>
        <input type="hidden" id="NoVALama" name="NoVALama" value="{{ NoVALama }}"></input>
        <input type="hidden" id="MD" name="MD" value="{{ list.MD }}"></input>
        
        <input type="hidden" id="bcode" name="bcode" value="{{ barcode.bcode }}"></input>
        <input type="hidden" id="VA" name="VA" value="{{ list.VirtualAccount }}"></input>

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
</div>

{% endfor %}

        
{% for list1 in result1 %}
<input type="hidden" id="total" name="total" value="{{ list1.total }}"></input>
{% endfor %}

{{ end_form() }}