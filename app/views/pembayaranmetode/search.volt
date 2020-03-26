
{{ content() }}

<h1>
    {{ link_to("pembayaranmetode/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Metode Pembayaran
    <small class="place-right">{{ link_to("pembayaranmetode/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>MetodeId</th>
            <th>NamaMetode</th>
            <th>Aktif</th>
            <th colspan="2">Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for pembayaranmetode in page.items %}
        <tr>
            <td>{{ pembayaranmetode.MetodeId }}</td>
            <td>{{ pembayaranmetode.NamaMetode }}</td>
            <td>{{ pembayaranmetode.Aktif }}</td>
            <td>{{ link_to("pembayaranmetode/edit/"~pembayaranmetode.MetodeId, "Edit") }}</td>
            <td>{{ link_to("pembayaranmetode/delete/"~pembayaranmetode.MetodeId, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("pembayaranmetode/search", "First", 'class':'button') }}
    {{ link_to("pembayaranmetode/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("pembayaranmetode/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("pembayaranmetode/search?page="~page.last, "Last", 'class':'button') }}
</div>