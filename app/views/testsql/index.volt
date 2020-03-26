
{{ content() }}

<div align="right">
    {{ link_to("testsql/new", "Create testsql") }}
</div>

{{ form("testsql/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search testsql</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="id">Id</label>
        </td>
        <td align="left">
            {{ text_field("id", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="nama">Nama</label>
        </td>
        <td align="left">
            {{ text_field("nama", "size" : 30) }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Cari") }}</td>
    </tr>
</table>

</form>
