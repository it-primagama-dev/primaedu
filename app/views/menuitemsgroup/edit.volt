{{ content() }}
{{ form("menuitemsgroup/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("menuitemsgroup", "Go Back") }}</td>
        <td align="right">{{ submit_button("Simpan") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit menuitemsgroup</h1>
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
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Simpan") }}</td>
    </tr>
</table>

</form>
