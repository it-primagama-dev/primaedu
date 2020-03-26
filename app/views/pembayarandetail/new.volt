
{{ form("pembayarandetail/create", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("pembayarandetail", "Go Back") }}</td>
        <td align="right">{{ submit_button("Simpan") }}</td>
    </tr>
</table>

{{ content() }}

<div align="center">
    <h1>Create pembayarandetail</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="Pembayaran">Pembayaran</label>
        </td>
        <td align="left">
            {{ text_field("Pembayaran", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="TanggalPembayaran">TanggalPembayaran</label>
        </td>
        <td align="left">
            {{ text_field("TanggalPembayaran", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="PembayaranMetode">PembayaranMetode</label>
        </td>
        <td align="left">
            {{ text_field("PembayaranMetode", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="PembayaranUntuk">PembayaranUntuk</label>
        </td>
        <td align="left">
                {{ text_field("PembayaranUntuk") }}
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
            <label for="Status">Status</label>
        </td>
        <td align="left">
                {{ text_field("Status") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="CreatedBy">CreatedBy</label>
        </td>
        <td align="left">
            {{ text_field("CreatedBy", "type" : "numeric") }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Simpan") }}</td>
    </tr>
</table>

</form>
