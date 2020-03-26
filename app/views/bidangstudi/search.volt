
{{ content() }}

<h1>
    {{ link_to("bidangstudi/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Bidang Studi
    <small class="place-right">{{ link_to("bidangstudi/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Kode Bidang Studi</th>
            <th>Nama Bidang Studi</th>
            <th colspan="2">Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for bidangstudi in page.items %}
        <tr>
            <td>{{ bidangstudi.KodeBidangStudi }}</td>
            <td>{{ bidangstudi.NamaBidangStudi }}</td>
            <td align="center" width="7%">{{ link_to("bidangstudi/edit/"~bidangstudi.KodeBidangStudi, "Edit") }}</td>
            <td align="center" width="7%">{{ link_to("bidangstudi/delete/"~bidangstudi.KodeBidangStudi, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("bidangstudi/search", "First", 'class':'button') }}
    {{ link_to("bidangstudi/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("bidangstudi/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("bidangstudi/search?page="~page.last, "Last", 'class':'button') }}
</div>