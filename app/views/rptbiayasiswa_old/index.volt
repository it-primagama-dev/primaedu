<h1>Laporan Penerimaan Biaya</h1>

{{ content() }}

{{ form("rptbiayasiswa/view", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
{% if rpt_auth['areaparent'] is null %}
    {{ stylesheet_link('css/select2.custom.min.css') }}
    {{ javascript_include('js/select2.min.js') }}
    <div class="row">
        <div class="span4">
            <label for="Cabang">Cabang</label>
            <div class="input-control">
                {{ select("Cabang", cabang, "using" : ["RecID", "KodeNamaAreaCabang"],
                    'useEmpty': 'true', 'emptyText': '---', 'emptyValue': '', 'style': 'width:100%') }}
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){$('#Cabang').select2();});
    </script>
{% endif %}
    <div class="row">
        <div class="span4">
            <label for="ViewType">Tipe Laporan</label>
            <div class="input-control select">
                {{ select_static("ViewType", ["D" : "Biaya Pendaftaran", "B" : "Biaya Bimbingan"]) }}
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
            <label for="DateFrom">Dari Tanggal</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("DateFrom") }}
            </div>
        </div>
        <div class="span2">
            <label for="DateTo">Sampai Tanggal</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("DateTo") }}
            </div>
        </div>
    </div>
    <div class="row">
        {{ submit_button("Tampilkan") }}
    </div>
</div>
{{ end_form() }}
