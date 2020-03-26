
{{ content() }}

<div align="right">
    {{ link_to("pembayarandetail/new", "Create pembayarandetail") }}
</div>

{{ form("pembayarandetail/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search pembayarandetail</h1>
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
        <td>{{ submit_button("Cari") }}</td>
    </tr>
</table>

</form>
