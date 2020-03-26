<h1>{{ rpt_title }}</h1>

{{ content() }}

{{ form("vasiswa/view", "method":"post", "target" : "_blank") }}

<div class="grid fluid">
    <div class="row">
        <div class="span4">
            <label for="ViewType">Area</label>
            <div class="input-control select">
                {{ select("Area", area, "using" : ["RecID", "NamaAreaCabang"],
                'useEmpty': true, 'emptyText': '--- Pilih Area ---', 'emptyValue': '') }}
            </div>
        </div>
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
        <div class="span2">
            <label for="ViewType">VA Awal</label>
            <div class="input-control select">           
            <select name="va">
            <option value="">--- Pilih VA Awal ---</option>
            <option value="0000001">0000001</option>
            <option value="0000051">0000051</option>
            <option value="0000101">0000101</option>
            <option value="0000151">0000151</option>
            <option value="0000201">0000201</option>
            <option value="0000251">0000251</option>
            <option value="0000301">0000301</option>
            <option value="0000351">0000351</option>
            <option value="0000401">0000401</option>
            <option value="0000501">0000501</option>
            <option value="0000601">0000601</option>
            </select>
            </div>
        </div>
        <div class="span2">
            <label for="ViewType">VA Akhir</label>
            <div class="input-control select">           
            <select name="va2">
            <option value="">--- Pilih VA Akhir ---</option>
            <option value="0000050">0000050</option>
            <option value="0000100">0000100</option>
            <option value="0000150">0000150</option>
            <option value="0000200">0000200</option>
            <option value="0000250">0000250</option>
            <option value="0000300">0000300</option>
            <option value="0000350">0000350</option>
            <option value="0000400">0000400</option>
            <option value="0000500">0000500</option>
            <option value="0000600">0000600</option>
            <option value="0001200">0001200</option>
            <option value="0001600">0001600</option>
            </select>
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

    

