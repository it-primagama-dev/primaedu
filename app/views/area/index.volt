<h1>
    Pencarian Area
    <small class="place-right">{{ link_to("area/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

{{ content() }}

{{ form("area/search", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="KodeAreaCabang">Kode Area</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodeAreaCabang", "maxlength" : 4) }}
            </div>
            <label for="NamaAreaCabang">Nama Area</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaAreaCabang", "maxlength" : 30) }}
            </div>
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>
{{ end_form() }}
