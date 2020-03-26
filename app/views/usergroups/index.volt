<h1>
    Pencarian User Group
    <small class="place-right">{{ link_to("usergroups/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

{{ content() }}

{{ form("usergroups/search", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="GroupName">Group Name</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("GroupName", "size" : 30) }}
            </div>
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>
</form>
