
{{ content() }}

<h1>
    {{ link_to("programdetail/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Program Detail
    <small class="place-right">{{ link_to("programdetail/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>RecID</th>
            <th>NamaProgramDetail</th>
            <th>Program</th>
            <th>Jenjang</th>
            <th>BidangStudi</th>
            <th>Bobot</th>
            <th colspan="2"></th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for programdetail in page.items %}
        <tr>
            <td>{{ programdetail.RecID }}</td>
            <td>{{ programdetail.NamaProgramDetail }}</td>
            <td>{{ programdetail.Program }}</td>
            <td>{{ programdetail.Jenjang }}</td>
            <td>{{ programdetail.BidangStudi }}</td>
            <td>{{ programdetail.Bobot }}</td>
            <td>{{ link_to("programdetail/edit/"~programdetail.RecID, "Edit") }}</td>
            <td>{{ link_to("programdetail/delete/"~programdetail.RecID, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("programdetail/search", "First", 'class':'button') }}
    {{ link_to("programdetail/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("programdetail/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("programdetail/search?page="~page.last, "Last", 'class':'button') }}
</div>