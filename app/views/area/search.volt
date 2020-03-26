
{{ content() }}

<h1>
    {{ link_to("area/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Area
    <small class="place-right">{{ link_to("area/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Kode Area</th>
            <th>Nama Area</th>
            <th>Email</th>
            <th colspan="2">Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for areacabang in page.items %}
        <tr>
            <td>{{ areacabang.KodeAreaCabang }}</td>
            <td>{{ areacabang.NamaAreaCabang }}</td>
            <td>{{ areacabang.Email }}</td>
            <td width="7%">{{ link_to("area/edit/"~areacabang.RecID, "Edit") }}</td>
            <td width="7%">{{ link_to("area/delete/"~areacabang.RecID, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("area/search", "First", 'class':'button') }}
    {{ link_to("area/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("area/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("area/search?page="~page.last, "Last", 'class':'button') }}
</div>