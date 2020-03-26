<h1>
    Pencarian Bidang Studi
    <small class="place-right">{{ link_to("bidangstudi/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

{{ content() }}

{{ form("bidangstudi/search", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="KodeBidangStudi">Kode Bidang Studi</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodeBidangStudi") }}
            </div>
            <label for="NamaBidangStudi">Nama Bidang Studi</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaBidangStudi", "size" : 30) }}
            </div>
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>
</form>
