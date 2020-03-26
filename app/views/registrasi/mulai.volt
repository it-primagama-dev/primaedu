{{ content() }}

<h1>
    {{ link_to("registrasi", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Pendaftaran
    <small class="on-right">Formulir</small>
</h1>

<div class="wizard" id="registrasi">
{{ form("registrasi/proses", "method":"post", "id":"registrasi-form") }}
    <fieldset>
    <div class="steps">
        <div class="step" id="step-1">
            {{ partial('registrasi/siswa') }}
        </div>
        <div class="step" id="step-2">
            {{ partial('registrasi/orangtua') }}
        </div>
        <div class="step" id="step-3">
            {{ partial('registrasi/program') }}
        </div>
        <div class="step" id="step-4">
            {{ partial('registrasi/pembayaran') }}
        </div>
    </div>
    </fieldset>
{{ end_form() }}
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
{{ javascript_include('js/register.js') }}