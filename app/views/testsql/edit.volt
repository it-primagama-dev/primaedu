{{ content() }}
{{ form("testsql/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("testsql", "Go Back") }}</td>
        <td align="right">{{ submit_button("Simpan") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit testsql</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="nama">Nama</label>
        </td>
        <td align="left">
            {{ text_field("nama", "size" : 30) }}
        </td>
    </tr>

    <tr>
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Simpan") }}</td>
    </tr>
</table>

</form>
