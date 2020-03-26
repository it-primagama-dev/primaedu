
<h1>
    {{ link_to("menuitems/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Menu items
    <small class="on-right">Edit</small>
</h1>

{{ content() }}

{{ form("menuitems/save", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="MenuItem">Menu Item</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("MenuItem", "size" : 30) }}
            </div>
            <label for="ControllerName">Controller Name</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("ControllerName", "size" : 30) }}
            </div>
            <label for="MenuItemsGroup">Menu Items Group</label>
            <div class="input-control select" data-role="input-control">
                {{ select("MenuItemsGroup", group, 'using': ['MenuItemsGroupId', 'MenuItemsGroupName'],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            {{ hidden_field("RecID") }}
            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>
</form>
