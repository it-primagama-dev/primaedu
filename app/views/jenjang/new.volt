
{{ form("jenjang/create", "method":"post") }}

<h1>
    {{ link_to("jenjang/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Jenjang
    <small class="on-right">Tambah Baru</small>
</h1>

{{ content() }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="NamaJenjang">Nama Jenjang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaJenjang", "size" : 30) }}
            </div>

            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>

</form>
