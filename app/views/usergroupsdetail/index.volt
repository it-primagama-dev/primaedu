
{{ content() }}

<div align="right">
    {{ link_to("usergroupsdetail/new", "Create usergroupsdetail") }}
</div>

{{ form("usergroupsdetail/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search usergroupsdetail</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="RecID">RecID</label>
        </td>
        <td align="left">
            {{ text_field("RecID", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="UserGroup">UserGroup</label>
        </td>
        <td align="left">
            {{ text_field("UserGroup", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="MenuItems">MenuItems</label>
        </td>
        <td align="left">
            {{ text_field("MenuItems", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="ActionName">ActionName</label>
        </td>
        <td align="left">
            {{ text_field("ActionName", "size" : 30) }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Cari") }}</td>
    </tr>
</table>

</form>
