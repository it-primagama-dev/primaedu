
{{ content() }}

<h1>
    {{ link_to("users/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Users
    <small class="place-right">{{ link_to("users/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Username</th>
            <th>Fullname</th>
            <th>Group</th>
            <th>Area</th>
            <th colspan="3">Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for user in page.items %}
        <tr>
            <td>{{ user.Username }}</td>
            <td>{{ user.Fullname }}</td>
            <td>{{ user.getUsergroup() }}</td>
            <td>{{ user.getAreaCabang() }}</td>
            <td width="7%">{{ link_to("users/reset/"~user.RecID, "Reset") }}</td>
            <td width="7%">{{ link_to("users/edit/"~user.RecID, "Edit") }}</td>
            <td width="7%">{{ link_to("users/delete/"~user.RecID, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("users/search", "First", 'class':'button') }}
    {{ link_to("users/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("users/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("users/search?page="~page.last, "Last", 'class':'button') }}
</div>