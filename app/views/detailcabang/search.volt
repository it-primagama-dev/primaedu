
{{ content() }}

<h1>
    {{ link_to("detailcabang/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Cabang
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
            <td width="7%">{{ link_to("detailcabang/detail/"~areacabang.RecID, "Detail") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("detailcabang/search", "First", 'class':'button') }}
    {{ link_to("detailcabang/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("detailcabang/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("detailcabang/search?page="~page.last, "Last", 'class':'button') }}
</div>