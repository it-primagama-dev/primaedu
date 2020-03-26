<legend>
<h2>{{ rpt_title }}</h2>
</legend>
{{ content() }}

{{ form("RptOperasional/view", "method":"post", "Target":"_blank") }}

<div class="grid fluid">
    <div class="row">
    {% if rpt_auth['areacabang'] == 0 %}
        <div class="span4">
            <label for="ViewType">Area</label>
            <div class="input-control select">
                {{ select("AreaID", area, "using" : ["RecID", "NamaAreaCabang"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
    {% else %}
        {{ hidden_field("Area") }}
    {% endif %}
    </div>
    

    <div class="row">
        <button onclick="">Tampilkan</button>
    </div>
</div>
{{ end_form() }}
<br></br>
{{ form("RptOperasional/viewarea", "method":"post", "Target":"_blank") }}
<legend>
<h2>{{ rpt_title2 }}</h2>
</legend>
<div class="grid fluid">
    <div class="row">
        <button onclick="">Tampilkan</button>
    </div>
</div>
{{ end_form() }}

