<h1>
    Pencarian Users
    <small class="place-right">{{ link_to("users/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

{{ content() }}

{{ form("users/search", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="Username">Username</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Username", "size" : 30) }}
            </div>
            <label for="Email">Email</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Email", "size" : 30) }}
            </div>
            <label for="UserGroup">User Group</label>
            <div class="input-control select" data-role="input-control">
                {{ select("UserGroup", usergroup, 'using': ['RecID', 'GroupName'],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            <label for="AreaCabang">Area / Cabang</label>
            <div class="input-control select" data-role="input-control">
                {{ select("AreaCabang", areacabang, 'using': ['RecID', 'KodeNamaAreaCabang'],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>
</form>
