<h1>{{ rpt_title }}</h1>

{{ content() }}

{{ form("Rptsiswacabangtest/view", "method":"post", "target" : "_blank") }}

<div class="grid fluid">
{% if rpt_auth['areaparent'] is null %}
    <div class="row">
    {% if rpt_auth['areacabang'] == 0 %}
        <div class="span4">
            <label for="ViewType">Area</label>
            <div class="input-control select">
                {{ select("Area", area, "using" : ["RecID", "NamaAreaCabang"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
    {% else %}
        {{ hidden_field("Area") }}
    {% endif %}
    </div>
    <div class="row no-margin">
        <div class="span4">
            <label for="ViewType">Cabang</label>
            <div class="input-control select">
                <select id="Cabang" name="Cabang"></select>
            </div>
        </div>
    </div>
    <div class="row no-margin">
{% else %}
    <div class="row">
{% endif %}
        
        <div class="span2">
            <label for="tahun">Tahun Ajaran</label>
            <div class="input-control select">
                {{ select("tahun", tahun, "using" : ["RecID", "Description"],'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
    </div>
    <div class="row">
        <button onclick="">Tampilkan</button>
    </div>
</div>
{{ end_form() }}

{% if rpt_auth['areaparent'] is null %}
<script type="text/javascript">
$(document).ready(function(){
    optCabang();
    $('#Area').on('change', function(){optCabang();});
});
function optCabang() {
    url = '{{ url('rptrekapjenjang/getcabang/') }}' + $('#Area').val();
    $.get(url).done(function(data){$('#Cabang').html(data);});
}
</script>
{% endif %}

    

