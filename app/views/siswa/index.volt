<h1>
    Pencarian Siswa
</h1>

{{ content() }}

{{ form("siswa/search", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
{% if auth['areaparent'] is null %}
    <div class="row no-margin">
    {% if auth['areacabang'] == 0 %}
        <div class="span2">
            <label for="AreaID">Area</label>
            <div class="input-control select">
                {{ select("AreaID", area, "using" : ["RecID", "NamaAreaCabang"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
        <div class="span4">
            <label for="CabangID">Cabang</label>
            <div class="input-control select">
                <select id="CabangID" name="CabangID"></select>
            </div>
        </div>
    {% else %}
        <div class="span6">
            <label for="CabangID">Cabang</label>
            <div class="input-control select">
                <select id="CabangID" name="CabangID"></select>
            </div>
            {{ hidden_field("AreaID") }}
        </div>
    {% endif %}
    </div>
{% endif %}
    <div class="row no-margin">
        <div class="span6">
            <label for="VirtualAccount">Kode Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("VirtualAccount", "maxlength" : 7) }}
            </div>
            <label for="NamaSiswa">Nama Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaSiswa") }}
            </div>
            <label for="JenisKelamin">Jenis Kelamin</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("JenisKelamin", ["": "-", "L" : "Laki laki", "P" : "Perempuan"]) }}
            </div>
            <label for="Jenjang">Jenjang</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Jenjang", jenjang, 'using': ['KodeJenjang', 'NamaJenjang'],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
    </div>
    {{ submit_button("Cari") }}
</div>
{{ end_form() }}
{% if auth['areaparent'] is null %}
<script type="text/javascript">
$(document).ready(function(){
    optCabang();
    $('#AreaID').on('change', function(){optCabang();});
});
function optCabang() {
    url = '{{ url('siswa/getcabang/') }}' + $('#AreaID').val();
    $.get(url).done(function(data){$('#CabangID').html(data);});
}
</script>
{% endif %}