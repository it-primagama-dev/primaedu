<h1>
    Pencarian Alamat Cabang
 </h1>

{{ content() }}

{{ form("alamatcabang/search", "method":"post", "target" : "_blank") }}

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
            <button type="submit"> Cari</button>
        </div>
    </div>
</div>
{{ end_form() }}
