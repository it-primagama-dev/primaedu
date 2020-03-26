<h1>
    Pencarian Menu Item
    <small class="place-right">{{ link_to("menuitems/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

{{ content() }}

{{ form("menuitems/search", "method":"post", "autocomplete" : "off") }}

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
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>
</form>
