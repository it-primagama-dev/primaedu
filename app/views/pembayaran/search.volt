
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("pembayaran/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("pembayaran/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>RecID</th>
            <th>Siswa</th>
            <th>Program</th>
            <th>ScheduleHeader</th>
            <th>PembayaranTipe</th>
            <th>JumlahTotal</th>
            <th>CreatedAt</th>
            <th>CreatedBy</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for pembayaran in page.items %}
        <tr>
            <td>{{ pembayaran.RecID }}</td>
            <td>{{ pembayaran.Siswa }}</td>
            <td>{{ pembayaran.Program }}</td>
            <td>{{ pembayaran.ScheduleHeader }}</td>
            <td>{{ pembayaran.PembayaranTipe }}</td>
            <td>{{ pembayaran.JumlahTotal }}</td>
            <td>{{ pembayaran.CreatedAt }}</td>
            <td>{{ pembayaran.CreatedBy }}</td>
            <td>{{ link_to("pembayaran/edit/"~pembayaran.RecID, "Edit") }}</td>
            <td>{{ link_to("pembayaran/delete/"~pembayaran.RecID, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("pembayaran/search", "First") }}</td>
                        <td>{{ link_to("pembayaran/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("pembayaran/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("pembayaran/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
