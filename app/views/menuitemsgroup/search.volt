
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("menuitemsgroup/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("menuitemsgroup/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>MenuItemsGroupId</th>
            <th>MenuItemsGroupName</th>
            <th>MenuItemsGroupOrder</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for menuitemsgroup in page.items %}
        <tr>
            <td>{{ menuitemsgroup.MenuItemsGroupId }}</td>
            <td>{{ menuitemsgroup.MenuItemsGroupName }}</td>
            <td>{{ menuitemsgroup.MenuItemsGroupOrder }}</td>
            <td>{{ link_to("menuitemsgroup/edit/"~menuitemsgroup.MenuItemsGroupId, "Edit") }}</td>
            <td>{{ link_to("menuitemsgroup/delete/"~menuitemsgroup.MenuItemsGroupId, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("menuitemsgroup/search", "First") }}</td>
                        <td>{{ link_to("menuitemsgroup/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("menuitemsgroup/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("menuitemsgroup/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
