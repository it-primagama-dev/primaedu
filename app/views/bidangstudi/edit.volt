
<h1>
    {{ link_to("bidangstudi/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Bidang Studi
    <small class="on-right">Edit</small>
</h1>

{{ content() }}

{{ form("bidangstudi/save", "method":"post") }}

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
            {{ hidden_field("RecID")}}
            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>

</form>