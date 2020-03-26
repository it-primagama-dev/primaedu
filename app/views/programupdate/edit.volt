
<h1>
    {{ link_to("sektorcabang/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Sektor Cabang
</h1>

{{ content() }}

{{ form("sektorcabang/saveedit", "method":"post") }}

<div class="grid fluid">
    <legend>Ubah Sektor Cabang</legend>
    <div class="row no-margin">
        <div class="span3">
            <label for="KodeCabang">Kode Cabang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodeCabang", "maxlength" : 4, "disabled": "disabled", "value": branchcode ) }}
            </div>
        </div>
        <div class="span5">
            <label for="NamaCabang">Nama Cabang</label>
            <div class="input-control text" data-role="input-control">
                {% if admin %}
                    {{ text_field("NamaCabang", "maxlength" : 100) }}
                {% else %}
                    {{ text_field("NamaCabang", "maxlength" : 100, "disabled": "disabled") }}
                {% endif %}
            </div>
        </div>
        <div class="span3">
            <label for="Aktif">Sektor Cabang</label>
               [ <input type="radio" id="sektor" name="Sektor" value="1" 
               {% if sektor == 1 %} checked {% else %} {% endif %}> <strong>1</strong>  </input> ].
               [ <input type="radio" id="sektor" name="Sektor" value="2"
               {% if sektor == 2 %} checked {% else %} {% endif %}> <strong>2</strong>  </input> ].
                [ <input type="radio" id="sektor" name="Sektor" value="3"
               {% if sektor == 3 %} checked {% else %} {% endif %}> <strong>3 </strong> </input> ].
               [ <input type="radio" id="sektor" name="Sektor" value="4"
               {% if sektor == 4 %} checked {% else %} {% endif %}> <strong>4</strong>  </input> ].
               [ <input type="radio" id="sektor" name="Sektor" value="5"
               {% if sektor == 5 %} checked {% else %} {% endif %}> <strong>5</strong>  </input> ].
        </div>
    </div>

    {{ hidden_field("RecID") }}
<input type="submit" class="command-button primary" id="submit" name="submit" value="Simpan"/>

{{ end_form() }}