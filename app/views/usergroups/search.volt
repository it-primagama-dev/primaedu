
{{ content() }}

<h1>
    {{ link_to("usergroups/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Groups
    <small class="place-right">{{ link_to("usergroups/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Group Name</th>
            <th colspan="2">Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for usergroup in page.items %}
        <tr>
            <td>{{ usergroup.GroupName }}</td>
            <td align="center" width="7%">{{ link_to("usergroups/edit/"~usergroup.RecID, "Edit") }}</td>
            <td align="center" width="7%">{{ link_to("usergroups/delete/"~usergroup.RecID, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("usergroups/search", "First", 'class':'button') }}
    {{ link_to("usergroups/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("usergroups/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("usergroups/search?page="~page.last, "Last", 'class':'button') }}
</div>