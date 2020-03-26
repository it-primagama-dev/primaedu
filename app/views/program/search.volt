
{{ content() }}

<h1>
    {{ link_to("program/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Program
    <small class="place-right">{{ link_to("program/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Nama Program</th>
            <th>Tipe Program</th>
            <th>Jenjang</th>
            <th colspan="2">Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for program in page.items %}
        <tr>
            <td>{{ program.NamaProgram }}</td>
            <td>{{ program.getTipeProgram() }}</td>
            <td>{{ program.getJenjang() }}</td>
            <td width="7%">{{ link_to("program/edit/"~program.RecID, "Edit") }}</td>
            <td width="7%">{{ link_to("program/delete/"~program.RecID, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("program/search", "First", 'class':'button') }}
    {{ link_to("program/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("program/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("program/search?page="~page.last, "Last", 'class':'button') }}
</div>