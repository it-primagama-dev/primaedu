<h1>{{ rpt_title }}</h1>

{{ content() }}

{{ form("rptpurchreqappfin/view", "method":"post", "target" : "_blank") }}

{% if rpt_auth['areaparent'] is null %}
<div class="grid fluid">
    <div class="row">
    {% if rpt_auth['areacabang'] == 0 %}
        <div class="span4">
            <label for="KodeArea">Area</label>
            <div class="input-control select">
                {{ select("Area", area, "using" : ["RecID", "NamaAreaCabang"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
    {% else %}
        {{ hidden_field("Area") }}
    {% endif %}
    </div>    <div class="row no-margin">
        <div class="span4">
            <label for="ViewType">Cabang</label>
            <div class="input-control select">
                <select id="cabang" name="cabang"></select>
            </div>
        </div>
    </div>
    <div class="row no-margin">
{#
    <div class="row no-margin">
        <div class="span4">
            <legend class="no-margin">Periode Laporan</legend>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span2">
            <label for="Tanggal">Dari Tanggal</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("DateFrom") }}
            </div>
        </div>
        <div class="span2">
            <label for="Tanggal">Sampai Tanggal</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("DateTo") }}
            </div>
        </div>
    </div>
#}
    <div class="row">
        <button onclick="">Tampilkan</button>
    </div>
</div>
{% endif %}
{{ end_form() }}
{% if rpt_auth['areaparent'] is null %}
<script type="text/javascript">
$(document).ready(function(){
    optCabang();
    $('#Area').on('change', function(){optCabang();});
});
function optCabang() {
    url = '{{ url('rptpurchreqappfin/getcabang/') }}' + $('#Area').val();
    $.get(url).done(function(data){$('#cabang').html(data);});
}
</script>
{% endif %}