
{{ content() }}

<div align="right">
    {{ link_to("pembayaranmetode/new", "Create pembayaranmetode") }}
</div>

{{ form("pembayaranmetode/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search pembayaranmetode</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="MetodeId">MetodeId</label>
        </td>
        <td align="left">
            {{ text_field("MetodeId", "type" : "numeric") }}
        </td>
    </tr>
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
        <td></td>
        <td>{{ submit_button("Cari") }}</td>
    </tr>
</table>

</form>
