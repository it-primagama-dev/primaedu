
{{ content() }}

<h1>
    {{ link_to("menuitems/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Menu Items
    <small class="place-right">{{ link_to("menuitems/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Menu Item</th>
            <th>Controller Name</th>
            <th>Menu Item Group</th>
            <th colspan="2">Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for menuitem in page.items %}
        <tr>
            <td>{{ menuitem.MenuItem }}</td>
            <td>{{ menuitem.ControllerName }}</td>
            <td>{{ menuitem.getGroupName() }}</td>
            <td width="7%">{{ link_to("menuitems/edit/"~menuitem.RecID, "Edit") }}</td>
            <td width="7%">{{ link_to("menuitems/delete/"~menuitem.RecID, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("menuitems/search", "First", 'class':'button') }}
    {{ link_to("menuitems/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("menuitems/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("menuitems/search?page="~page.last, "Last", 'class':'button') }}
</div>
