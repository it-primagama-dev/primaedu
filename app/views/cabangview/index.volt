<h1>
    Pencarian Cabang
    {% if admin %}
    {% endif %}
</h1>

{{ content() }}

{{ form("cabangview/search", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="KodeAreaCabang">Kode Cabang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodeAreaCabang", "maxlength" : 4) }}
            </div>
            <label for="NamaAreaCabang">Nama Cabang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaAreaCabang", "maxlength" : 30) }}
            </div>
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>
{{ end_form() }}
