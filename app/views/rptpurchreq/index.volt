<h1>{{ rpt_title }}</h1>

{{ content() }}

{{ form("rptpurchreq/view", "method":"post", "target" : "_blank") }}

{% if rpt_auth['areaparent'] is null %}
<div class="grid fluid">
    <div class="row">
    {% if rpt_auth['areacabang'] == 0 %}
        <div class="span4">
            <label for="KodeArea">Area</label>
            <div class="input-control select">
                {{ select("KodeArea", area, "using" : ["KodeAreaCabang", "NamaAreaCabang"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
    {% else %}
        {{ hidden_field("KodeArea") }}
    {% endif %}
    </div>
    <div class="row no-margin">
        <div class="span4">
            <label for="Status">Status</label>
            <div class="input-control select">
                {{ select("Status", status, "using" : ["Status", "Status"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
    </div>

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

    <div class="row">
        <button onclick="">Tampilkan</button>
    </div>
</div>
{% endif %}
{{ end_form() }}
