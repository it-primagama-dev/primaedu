{{ content() }}
{{ form("tentor/save", "method":"post") }}

<h1>
    {{ link_to("tentor/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    I-Smart
    
    <small class="on-right">Ubah Jadwal</small>
</h1>

<div class="grid fluid">
    <legend>Detail I-Smart</legend>
    <div class="row">
        
        <div class="span6">
            <label for="NamaISmart">Nama I-Smart</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaISmart", "maxlength" : 100, "readonly":"readonly") }}
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
            <label for="Email">Email</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Email", "maxlength" : 100, "readonly":"readonly") }}
            </div>

            <label for="Pendidikan">Pendidikan Akhir</label>
            <div class="input-control select" data-role="input-control">
                {{ text_field("Pendidikan", "maxlength" : 100, "readonly":"readonly") }}
            </div>

             <label for="Pekerjaan">Pekerjaan</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Pekerjaan", "maxlength" : 50, "readonly":"readonly") }}
            </div>
        </div>
            
        <div class="span3">
            
            <label for="Telepon">Nomor Telepon</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Telepon", "maxlength" : 50, "readonly":"readonly") }}
            </div>

            <label for="Jurusan">Jurusan</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Jurusan", "maxlength" : 100, "readonly":"readonly") }}
            </div>
        </div>   
    </div>
    <div class="row">
        <div class="span4">
            <label for="BidangStudi">Bidang Studi</label>
            <div class="input-control select" data-role="input-control">
                {{ text_field("BidangStudi", "maxlength" : 30, "readonly":"readonly") }}
            </div>
            <label for="BidangStudi2">Bidang Studi Tambahan</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("BidangStudi2", "maxlength" : 100, "readonly":"readonly") }}
            </div>
        </div>
    </div>
    <legend>Detail Alamat</legend>
    <div class="row">
        <div class="span6">
            <label for="Alamat">Alamat</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("Alamat", "maxlength" : 100) }}
            </div>
        </div>
    </div>

    {{ hidden_field("KodeISmart") }}
    {{ hidden_field("RecID") }}
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