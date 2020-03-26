<h1>
    Pencarian Tipe Program
    <small class="place-right">{{ link_to("programtipe/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

{{ content() }}

{{ form("programtipe/search", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="NamaTipeProgram">Nama Tipe Program</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaTipeProgram", "size" : 30) }}
            </div>
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>
</form>
