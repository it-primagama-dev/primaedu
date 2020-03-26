
{{ form("ismart/create", "method":"post") }}

<h1>
    {{ link_to("ismart/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    I-Smart
    <small class="on-right">Tambah Baru</small>
</h1>

{{ content() }}

<div class="grid fluid">
    <legend>Detail I-Smart</legend>
    <div class="row">
        
        <div class="span6">
            <label for="NamaISmart">Nama I-Smart</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaISmart", "maxlength" : 100) }}
            </div>
            
            <label for="Grade">Grade</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("Grade", ["A+" : "A+", "A" : "A" , "B" : "B", "C" : "C"]) }}
            </div>
            
            <label for="TipeISmart">Tipe I-Smart</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("TipeISmart", ["Tetap" : "Tetap", "Honor" : "Honor", "IBM" : "IBM"]) }}
            </div>
        </div>
        
        <div class="span3">
            <label for="TanggalLahir">Tanggal Lahir</label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                {{ text_field("TanggalLahir", "maxlength" : 30) }}
            </div>
            
            <label for="JenisKelamin">Jenis Kelamin</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("JenisKelamin", ["L" : "Laki laki", "P" : "Perempuan"])}}
            </div>
            
             <label for="Pekerjaan">Pekerjaan</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Pekerjaan", "maxlength" : 50) }}
            </div>
        </div>
            
        <div class="span3">
            <label for="TanggalGabung">Tanggal Gabung</label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                {{ text_field("TanggalGabung", "maxlength" : 30) }}
            </div>
            
            <label for="Telepon">Nomor Telepon</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Telepon", "maxlength" : 50) }}
            </div>
            
            <label for="Email">Email</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Email", "maxlength" : 100) }}
            </div>
        </div>   
    </div>
    <div class="row">
        <div class="span4">
            <label for="BidangStudi">Bidang Studi</label>
            <div class="input-control select" data-role="input-control">
                {{ select("BidangStudi", bidangstudi, "using" : ["KodeBidangStudi", "NamaBidangStudi"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            <label for="BidangStudi2">Bidang Studi Tambahan</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("BidangStudi2", "maxlength" : 100) }}
            </div>
        </div>
    </div>
    <legend>Detail Alamat</legend>
    <div class="row">
        <div class="span6">
            <label for="Propinsi">Propinsi</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Propinsi", propinsi, "using" : ["RecID", "NamaPropinsi"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            <label for="Kota">Kota</label>
            <div class="input-control select" data-role="input-control">
                <select id="Kota" name="Kota"></select>
            </div>
            <label for="Alamat">Alamat</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("Alamat", "maxlength" : 100) }}
            </div>
        </div>
    </div>

    {{ submit_button("Simpan") }}

</div>

</form>

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