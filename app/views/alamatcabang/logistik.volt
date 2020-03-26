<h1>
    Cetak Alamat Cabang
 </h1>

{{ content() }}

{{ form("alamatcabang/searchlogistik", "method":"post", "target" : "_blank") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="Judul">Judul Pengiriman</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Judul", "maxlength" : 30) }}
            </div>
            <label for="KodeAreaCabang">Kode Cabang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodeAreaCabang", "maxlength" : 4) }}
            </div>
            <button type="submit"> Cari</button>
        </div>
    </div>
</div>
{{ end_form() }}
