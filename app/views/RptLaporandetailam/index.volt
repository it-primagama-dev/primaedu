<h1>{{ rpt_title }}</h1>

{{ content() }}

{{ form("RptLaporanDetailam/view", "method":"post") }}

<div class="grid fluid">
    <div class="row">
    {% if rpt_auth['areacabang'] == 0 %}
        <div class="span4">
            <label for="ViewType">Area</label>
            <div class="input-control select">
                {{ select("Area", area, "using" : ["RecID", "NamaAreaCabang"]) }}
            </div>
        </div>
    {% else %}
        {{ hidden_field("Area") }}
	
    {% endif %} 
	
    </div>
	
	<div class = "row">
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

