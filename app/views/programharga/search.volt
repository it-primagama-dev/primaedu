
{{ content() }}

<h1>
    {{ link_to("programharga/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Harga Program
    <small class="place-right">{{ link_to("programharga/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Program</th>
            <th>Area</th>
            <th>Sektor</th>
            <th>Harga Bimbingan</th>
            <th>Harga Pendaftaran</th>
            <th>Tanggal Berlaku</th>
            <th colspan="2">Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for programharga in page.items %}
        <tr>
            <td>{{ programharga.getNamaProgram() }}</td>
            <td>{{ programharga.getNamaArea() }}</td>
            <td>{{ programharga.SektorCabang }}</td>
            <td class="idrCurrency">{{ programharga.HargaBimbingan }}</td>
            <td class="idrCurrency">{{ programharga.HargaPendaftaran }}</td>
            <td>{{ programharga.TanggalBerlaku }}</td>
            <td width="7%">{{ link_to("programharga/edit/"~programharga.RecID, "Edit") }}</td>
            <td width="7%">{{ link_to("programharga/delete/"~programharga.RecID, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("programharga/search", "First", 'class':'button') }}
    {{ link_to("programharga/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("programharga/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("programharga/search?page="~page.last, "Last", 'class':'button') }}
</div>