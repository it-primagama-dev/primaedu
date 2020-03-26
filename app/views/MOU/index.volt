<h1>{{ rpt_title }}</h1>

{{ content() }}

{{ form("MOU/search", "method":"post",  "autocomplete" : "off") }}

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
    <div class="row">
         {{ submit_button("Cari") }}
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
{% if jatuhtempo is defined %}
<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th width="5%">Kode Area Cabang </th>
            <th>Nama Cabang</th>
            <th>Tanggal Berlaku</th>
            <th>Tanggal Berakhir</th>
            <th width="10%">Action</th>
        </tr>
    </thead>
    <tbody>
			{% if result is not empty %}
					{% for list in result %}
					
                <tr>
                    <td>{{ list.RecID }}</td>
					<td>{{ list.NamaAreaCabang }}</td>
					<td>{{ list.TanggalBerlaku }}</td>
					<td>{{ list.TanggalBerakhir }}</td>
                    <td>{{list.TgPembayaran}}</td>
						<a href="{{ url('pembayaranfranchise/index'~list.RecID)}}">Edit </a>
						
                    </td>
                </tr>
            {% endfor %}
        {% endif %}
    </tbody>
</table>
{%endif%}