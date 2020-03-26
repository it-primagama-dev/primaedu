<div class="grid fluid">    
    <legend class="no-margin">Data Siswa</legend>
    <div class="row">
        <div class="span3">
            <label for="NamaSiswa">Nama  Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaSiswa","placeholder" : "wajib di isi") }}
            </div>
        </div>
        
        <div class="span3">
            <label for="TeleponSiswa">Telepon Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("TeleponSiswa","placeholder" : "wajib di isi") }} 
            </div>
        </div>
                {{ hidden_field("TempatLahir","placeholder" : "wajib di isi") }}

                {{ hidden_field("TanggalLahir","placeholder" : "wajib di isi") }}

                {{ hidden_field("EmailSiswa","placeholder" : "wajib di isi") }}

                {{ hidden_field("JenisKelamin") }}

        <div class="span3">
            <label for="Jenjang">Jenjang</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Jenjang", jenjang, "using" : ["KodeJenjang", "NamaJenjang"],
                'useEmpty': true, 'emptyText': ' - Pilih - ', 'emptyValue': '') }}
            </div>
        </div>
            <div class="span3">
            <label for="AsalSekolah">Asal Sekolah</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("AsalSekolah","placeholder" : "wajib di isi") }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
                {{ hidden_field("NoKartuSiswa") }}

                {{ hidden_field("Agama") }}
    </div>
	
                {{ hidden_field("NamaAyah","placeholder" : "wajib di isi") }}

                {{ hidden_field("EmailAyah") }}

                {{ hidden_field("TeleponAyah","placeholder" : "wajib di isi ayah/ibu") }}

                {{ hidden_field("NamaIbu") }}

                {{ hidden_field("EmailIbu") }}

                {{ hidden_field("TeleponIbu") }}
                
					{{ hidden_field("Alamat","placeholder" : "wajib di isi") }}

					{{ hidden_field("Propinsi") }}

                    {{ hidden_field("Kota") }}
        
					{{ hidden_field("KodePos","placeholder" : "wajib di isi") }}
   

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