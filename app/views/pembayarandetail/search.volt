
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("pembayarandetail/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("pembayarandetail/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>RecID</th>
            <th>Pembayaran</th>
            <th>TanggalPembayaran</th>
            <th>PembayaranMetode</th>
            <th>PembayaranUntuk</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>CreatedBy</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for pembayarandetail in page.items %}
        <tr>
            <td>{{ pembayarandetail.RecID }}</td>
            <td>{{ pembayarandetail.Pembayaran }}</td>
            <td>{{ pembayarandetail.TanggalPembayaran }}</td>
            <td>{{ pembayarandetail.PembayaranMetode }}</td>
            <td>{{ pembayarandetail.PembayaranUntuk }}</td>
            <td>{{ pembayarandetail.Jumlah }}</td>
            <td>{{ pembayarandetail.Status }}</td>
            <td>{{ pembayarandetail.CreatedBy }}</td>
            <td>{{ link_to("pembayarandetail/edit/"~pembayarandetail.RecID, "Edit") }}</td>
            <td>{{ link_to("pembayarandetail/delete/"~pembayarandetail.RecID, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("pembayarandetail/search", "First") }}</td>
                        <td>{{ link_to("pembayarandetail/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("pembayarandetail/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("pembayarandetail/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
