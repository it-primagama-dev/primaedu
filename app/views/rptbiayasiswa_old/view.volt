<h1>
    {{ link_to("rptbiayasiswa", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Laporan Penerimaan Biaya {{ rpttype }}
</h1>

{{ content() }}

<div class="grid fluid">
    <div class="row no-margin">
        <div class="span12">
            <h2><small class="place-right">Periode : {{ periode }}</small></h2>
        </div>
    </div>
</div>
<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Cabang</th>
            <th>Nomor Kuitansi</th>
            <th>Kode Siswa</th>
            <th>Nama Siswa</th>
            <th>Program</th>
            <th>Jumlah</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is not empty %}
    {% for list in page.items %}
        <tr>
            <td>{{ loop.index + (page.current - 1)*20 }}</td>
            <td>{{ list.NamaCabang }}</td>
            <td>{{ list.DocumentNo }}</td>
            <td>{{ list.VirtualAccount }}</td>
            <td>{{ list.NamaSiswa }}</td>
            <td>{{ list.NamaProgram }}</td>
            <td class="idrCurrency">{{ list.Jumlah }}</td>
        </tr>
    {% endfor %}
    {% else %}
        <tr>
            <td colspan="6" align="center">- Tidak Ada Data -</td>
        </tr>
    {% endif %}
    </tbody>
</table>
{% if page.total_pages > 1 %}
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("rptbiayasiswa/view", "First", 'class':'button') }}
    {{ link_to("rptbiayasiswa/view?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("rptbiayasiswa/view?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("rptbiayasiswa/view?page="~page.last, "Last", 'class':'button') }}
</div>
{% endif %}
