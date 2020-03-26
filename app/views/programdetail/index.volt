
{{ content() }}

<div align="right">
    {{ link_to("programdetail/new", "Create programdetail") }}
</div>

{{ form("programdetail/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search programdetail</h1>
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
            <label for="NamaProgramDetail">NamaProgramDetail</label>
        </td>
        <td align="left">
            {{ text_field("NamaProgramDetail", "size" : 30) }}
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
            <label for="Jenjang">Jenjang</label>
        </td>
        <td align="left">
            {{ text_field("Jenjang", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="BidangStudi">BidangStudi</label>
        </td>
        <td align="left">
                {{ text_field("BidangStudi") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="Bobot">Bobot</label>
        </td>
        <td align="left">
            {{ text_field("Bobot", "type" : "numeric") }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Cari") }}</td>
    </tr>
</table>

</form>
