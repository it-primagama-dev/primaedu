
{{ content() }}

<h1>
    {{ link_to("inventstock/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Stok Barang
    <small>Pencarian</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th width="5%">#</th>
            <th width="15%">Kode Barang</th>
            <th width="40%">Nama Barang</th>
            <th width="10%">Stok Awal</th>
            <th width="10%">Qty Masuk</th>
            <th width="10%">Qty Keluar</th>
            <th width="10%">Jumlah Stok</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for inventstock in page.items %}
        <tr>
            <td>{{ loop.index + (20 * (page.current - 1)) }}</td>
            <td>{{ inventstock['KodeItem'] }}</td>
            <td>{{ inventstock['NamaItem'] }}</td>
            <td align="right">{{ inventstock['Balance']|number_format }}</td>
            <td align="right">{{ inventstock['QtyIn']|number_format }}</td>
            <td align="right">{{ inventstock['QtyOut']|number_format }}</td>
            <td align="right">{{ inventstock['Total']|number_format }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>

<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("inventstock/search", "First", 'class':'button') }}
    {{ link_to("inventstock/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("inventstock/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("inventstock/search?page="~page.last, "Last", 'class':'button') }}
</div>
