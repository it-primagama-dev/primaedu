
{{ form("menuitemsgroup/create", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("menuitemsgroup", "Go Back") }}</td>
        <td align="right">{{ submit_button("Simpan") }}</td>
    </tr>
</table>

{{ content() }}

<div align="center">
    <h1>Create menuitemsgroup</h1>
</div>

<table>
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
        <td>{{ submit_button("Simpan") }}</td>
    </tr>
</table>

</form>
