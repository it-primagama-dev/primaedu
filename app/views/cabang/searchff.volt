
{{ content() }}

<h1>
    {{ link_to("cabang/ff", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Pencarian Cabang
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Kode Cabang</th>
            <th>Nama Cabang</th>
            <th>Area</th>
            <th>Email</th>
            <th>Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for areacabang in page.items %}
        <tr>
            <td>{{ areacabang.KodeAreaCabang }}</td>
            <td>{{ areacabang.NamaAreaCabang }}</td>
            <td>{{ areacabang.getNamaArea() }}</td>
            <td>{{ areacabang.Email }}</td>
            <td width="7%">{{ link_to("cabang/editff/"~areacabang.RecID, "Edit") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("cabang/searchff", "First", 'class':'button') }}
    {{ link_to("cabang/searchff?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("cabang/searchff?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("cabang/searchff?page="~page.last, "Last", 'class':'button') }}
</div>