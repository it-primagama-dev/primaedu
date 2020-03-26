
{{ form("pembayaranmetode/create", "method":"post") }}

<h1>
    {{ link_to("pembayaranmetode/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Metode Pembayaran
    <small class="on-right">Tambah Baru</small>
</h1>

{{ content() }}

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
        <td></td>
        <td>{{ submit_button("Simpan") }}</td>
    </tr>
</table>

</form>
