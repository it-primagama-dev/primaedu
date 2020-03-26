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
            <label for="Direktur">Direktur</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="Direktur" name="Direktur" value="{{ list.Direktur}}">
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
        <div class="span3">
            <label for="SIUP">SIUP</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="SIUP" name="SIUP" value="{{ list.SIUP}}">
            </div>
        </div>
		<div class="span3">
            <label for="TDP">TDP</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="TDP" name="TDP" value="{{ list.TDP}}">
            </div>
        </div>
		<div class="span3">
            <label for="Telp">No Telepon Direksi</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="Telp" name="Telp" value="{{ list.Telp}}">
            </div>
        </div>
	</div>
	<div class="row no-margin">
        <div class="span6">
            <label for="AlamatSurat">Alamat Surat</label>
			<div class="input-control textarea" data-role="input-control">
				{{ text_area("AlamatSurat") }}
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