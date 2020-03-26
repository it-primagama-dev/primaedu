
<h1>
    {{ link_to("area/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Area
    <small class="on-right">Tambah Baru</small>
</h1>

{{ content() }}

{{ form("area/create", "method":"post") }}

<div class="grid fluid">
    <legend>Detail Area</legend>
    <div class="row">
        <div class="span6">
            <label for="NamaCabang">Nama Area</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaCabang") }}
            </div>
            <label for="Email">Email</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Email") }}
            </div>
            <label for="NoTelp">Nomor Telepon Area</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoTelp") }}
            </div>
        </div>
    </div>
    <legend>Detail Alamat</legend>
    <div class="row">
        <div class="span6">
            <label for="Alamat">Alamat</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("Alamat") }}
            </div>
            <label for="Propinsi">Propinsi</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Propinsi", propinsi, "using" : ["RecID", "NamaPropinsi"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            <label for="Kota">Kota</label>
            <div class="input-control select" data-role="input-control">
                <select id="Kota" name="Kota"></select>
            </div>
            <label for="KodePos">Kode Pos</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodePos", "maxlength" : 5) }}
            </div>
        </div>
    </div>
    <legend>Detail Manager</legend>
    <div class="row">
        <div class="span6">
            <label for="NamaManager">Nama Manager</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaManager") }}
            </div>
            <label for="NoHandPhone">Nomor Handphone Manager</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoHandPhone") }}
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