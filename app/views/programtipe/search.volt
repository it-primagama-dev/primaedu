
{{ content() }}

<h1>
    {{ link_to("programtipe/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Tipe Program
    <small class="place-right">{{ link_to("programtipe/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Nama Tipe Program</th>
            <th colspan="2">Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for programtipe in page.items %}
        <tr>
            <td>{{ programtipe.NamaTipeProgram }}</td>
            <td width="7%">{{ link_to("programtipe/edit/"~programtipe.KodeTipeProgram, "Edit") }}</td>
            <td width="7%">{{ link_to("programtipe/delete/"~programtipe.KodeTipeProgram, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("programtipe/search", "First", 'class':'button') }}
    {{ link_to("programtipe/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("programtipe/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("programtipe/search?page="~page.last, "Last", 'class':'button') }}
</div>