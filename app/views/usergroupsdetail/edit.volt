{{ form("usergroupsdetail/save", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span12">
            {{ hidden_field("UserGroup") }}
			{{ hidden_field("RecID") }}
            <label for="MenuItems">Menu Item</label>
            <div class="input-control select" data-role="input-control">
                {{ select("MenuItems", menuitem, 'using': ['RecID', 'MenuItem']) }}
            </div>
            <label for="ActionName">Action Name</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("ActionName") }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>

{{ end_form() }}
