{{ content() }}
{{ form("pembayaranmetode/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("pembayaranmetode", "Go Back") }}</td>
        <td align="right">{{ submit_button("Simpan") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit pembayaranmetode</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="NamaMetode">NamaMetode</label>
        </td>
        <td align="left">
            {{ text_field("NamaMetode", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="Aktif">Aktif</label>
        </td>
        <td align="left">
            {{ text_field("Aktif", "type" : "numeric") }}
        </td>
    </tr>

    <tr>
        <td>{{ hidden_field("MetodeId") }}</td>
        <td>{{ submit_button("Simpan") }}</td>
    </tr>
</table>

</form>
