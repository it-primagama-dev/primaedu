{{ content() }}
{{ form("bukusiswa/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("bukusiswa", "Go Back") }}</td>
        <td align="right">{{ submit_button("Simpan") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit bukusiswa</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="ProgramSiswa">ProgramSiswa</label>
        </td>
        <td align="left">
            {{ text_field("ProgramSiswa", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="InventItem">InventItem</label>
        </td>
        <td align="left">
            {{ text_field("InventItem", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="TanggalTerima">TanggalTerima</label>
        </td>
        <td align="left">
                {{ text_field("TanggalTerima", "type" : "date") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="Jumlah">Jumlah</label>
        </td>
        <td align="left">
            {{ text_field("Jumlah", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="SerialNumber">SerialNumber</label>
        </td>
        <td align="left">
            {{ text_field("SerialNumber", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="Cabang">Cabang</label>
        </td>
        <td align="left">
            {{ text_field("Cabang", "type" : "numeric") }}
        </td>
    </tr>

    <tr>
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Simpan") }}</td>
    </tr>
</table>

</form>
