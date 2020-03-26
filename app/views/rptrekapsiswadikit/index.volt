<h1>Laporan Jumlah Siswa Sedikit</h1>

{{ content() }}

{{ form("rptrekapsiswadikit/view", "method":"post", "target" : "_blank") }}

{% if rpt_auth['areaparent'] is null %}
<div class="grid fluid">
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
