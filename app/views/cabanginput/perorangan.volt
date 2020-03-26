<h1>{{ rpt_title }}</h1>

{{ content() }}

{{ form("cabanginput/save", "method":"post",  "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row no-margin">
        <div class="span3">
			{% if result1 is not empty %}
			{% for list in result1 %}
			<hidden>
			<input type="hidden" id="recID" name="recID" value="{{ list.KodeAreaCabang}}" readonly >
			</hidden>
			{% endfor %}
			{% endif %}
            <label for="NamaFSEE">Nama FSEE</label>
            <div class="input-control text" data-role="input-control">
				<input type="text" id="NamaFSEE" name="NamaFSEE" value="{{ list.NamaFSEE}}">
            </div>
        </div>
        <div class="span6">
            <label for="AlamatSurat">Alamat Surat</label>
			<div class="input-control textarea" data-role="input-control">
				{{ text_area("AlamatSurat") }}
			</div>
        </div>
    </div>
	<div class="row no-margin">
        <div class="span3">
            <label for="BadanUsaha">Badan Usaha</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="BadanUsaha" name="BadanUsaha" value="{{ list.BadanUsaha}}">
            </div>
        </div>
        <div class="span3">
            <label for="Telp">No Telepon</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="Telp" name="Telp" value="{{ list.Telp}}">
            </div>
        </div>
		<div class="span3">
            <label for="Telp">No KTP</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="Telp" name="Telp" value="{{ list.NoKTP}}">
            </div>
        </div>
    </div>
	<div class="row no-margin">
        <div class="span3">
            <label for="SIUP">SIUP</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="SIUP" name="SIUP" value="{{ list.SIUP}}">
            </div>
        </div>
        <div class="span3">
            <label for="NPWP">NPWP</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="NPWP" name="NPWP" value="{{ list.NPWP}}">
            </div>
        </div>

	</div>
	<div class="row no-margin">
        <div class="span6">
			<label for="DataKTP">Alamat KTP</label>
			<div class="input-control textarea" data-role="input-control">
				{{ text_area("DataKTP") }}
			</div>
		</div>

	</div>
	<div class="row no-margin">
        <div class="span3 ">
			<label for="SoftOpening">Tanggal Soft Opening</label>
        <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
				<input type="text" id="SoftOpening" name="SoftOpening" value="{{ list.SoftOpening}}"></input>
		</div>
		</div>
        <div class="span3">
            <label for="GrandOpening">Tanggal Grand Opening</label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
				<input type="text" id="GrandOpening" name="GrandOpening" value="{{ list.GrandOpening}}"></input>
			</div>
		</div>
	</div>
	
	
         {{ submit_button("Simpan") }}
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