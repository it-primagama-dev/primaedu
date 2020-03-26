
<h1>
    {{ link_to("usergroups/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    User Group
    <small class="on-right">Tambah Baru</small>
</h1>

{{ content() }}

{{ form("usergroups/create", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="GroupName">Group Name</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("GroupName", "size" : 30) }}
            </div>

            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>
</form>
