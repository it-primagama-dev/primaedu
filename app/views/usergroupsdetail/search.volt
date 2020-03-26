
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("usergroupsdetail/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("usergroupsdetail/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>RecID</th>
            <th>UserGroup</th>
            <th>MenuItems</th>
            <th>ActionName</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for usergroupsdetail in page.items %}
        <tr>
            <td>{{ usergroupsdetail.RecID }}</td>
            <td>{{ usergroupsdetail.UserGroup }}</td>
            <td>{{ usergroupsdetail.MenuItems }}</td>
            <td>{{ usergroupsdetail.ActionName }}</td>
            <td>{{ link_to("usergroupsdetail/edit/"~usergroupsdetail.RecID, "Edit") }}</td>
            <td>{{ link_to("usergroupsdetail/delete/"~usergroupsdetail.RecID, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("usergroupsdetail/search", "First") }}</td>
                        <td>{{ link_to("usergroupsdetail/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("usergroupsdetail/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("usergroupsdetail/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
