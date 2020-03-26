
{{ content() }}

<div align="right">
    {{ link_to("menuitemsgroup/new", "Create menuitemsgroup") }}
</div>

{{ form("menuitemsgroup/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search menuitemsgroup</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="MenuItemsGroupId">MenuItemsGroupId</label>
        </td>
        <td align="left">
            {{ text_field("MenuItemsGroupId", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="MenuItemsGroupName">MenuItemsGroupName</label>
        </td>
        <td align="left">
            {{ text_field("MenuItemsGroupName", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="MenuItemsGroupOrder">MenuItemsGroupOrder</label>
        </td>
        <td align="left">
            {{ text_field("MenuItemsGroupOrder", "type" : "numeric") }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Cari") }}</td>
    </tr>
</table>

</form>
