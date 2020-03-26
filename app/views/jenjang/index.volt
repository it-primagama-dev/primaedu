
{{ content() }}

<h1>
    {{ link_to("jenjang/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Jenjang
    <small class="place-right">{{ link_to("jenjang/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Nama Jenjang</th>
            <th colspan="2">Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for jenjang in page.items %}
        <tr>
            <td>{{ jenjang.NamaJenjang }}</td>
            <td align="center" width="7%">{{ link_to("jenjang/edit/"~jenjang.KodeJenjang, "Edit") }}</td>
            <td align="center" width="7%">{{ link_to("jenjang/delete/"~jenjang.KodeJenjang, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("jenjang/index", "First", 'class':'button') }}
    {{ link_to("jenjang/index?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("jenjang/index?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("jenjang/index?page="~page.last, "Last", 'class':'button') }}
</div>