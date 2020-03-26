<legend>
<h1>{{ rpt_title }}</h1>
</legend>
{{ content() }}

{{ form("RptDetailFranchise/view", "method":"post", "Target":"_blank") }}

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

