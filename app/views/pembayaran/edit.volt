{{ content() }}
{{ form("pembayaran/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("pembayaran", "Go Back") }}</td>
        <td align="right">{{ submit_button("Simpan") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit pembayaran</h1>
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
            <label for="Siswa">Siswa</label>
        </td>
        <td align="left">
            {{ text_field("Siswa", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="Program">Program</label>
        </td>
        <td align="left">
            {{ text_field("Program", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="ScheduleHeader">ScheduleHeader</label>
        </td>
        <td align="left">
            {{ text_field("ScheduleHeader", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="PembayaranTipe">PembayaranTipe</label>
        </td>
        <td align="left">
                {{ text_field("PembayaranTipe") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="JumlahTotal">JumlahTotal</label>
        </td>
        <td align="left">
            {{ text_field("JumlahTotal", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="CreatedAt">CreatedAt</label>
        </td>
        <td align="left">
            {{ text_field("CreatedAt", "size" : 30) }}
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
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Simpan") }}</td>
    </tr>
</table>

</form>
