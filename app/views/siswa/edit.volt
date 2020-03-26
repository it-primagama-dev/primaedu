{{ content() }}

{{ form("siswa/save", "method":"post") }}

<h1>
    {{ link_to("siswa", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Siswa
    <small class="on-right">Edit</small>
    <small class="place-right">{{ submit_button("Simpan", "class": "button large primary") }}</small>
</h1>

<div class="tab-control" data-role="tab-control">
    <ul class="tabs">
        <li class="active"><a href="#_siswa">Data Siswa</a></li>
        <li><a href="#_orangtua">Data Orang Tua</a></li>
    </ul>
 
    <div class="frames">
        <div class="frame" id="_siswa">{{ partial('registrasi/siswa') }}</div>
        <div class="frame" id="_orangtua">{{ partial('registrasi/orangtua') }}</div>
    </div>
</div>
{{ hidden_field("RecID") }}
{{ end_form() }}

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