
{{ content() }}

<h1>
    AutoSettle
    <br>
    {{ link_to("autosettle/proses", '<div class="button success">Proses Autosettle</div>') }}
</h1>

<table class="table bordered striped hovered text-center">
    <thead>
        <tr>
            <th>Nama Bank</th>
            <th>Kode Cabang</th>
            <th>No Referensi</th>
            <th>Tanggal Transaksi</th>
            <th>Waktu Transaksi</th>
            <th>Nominal</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        {% if txbank.items is not empty %}
            {% for list in txbank.items %}
                <tr>
                    <td>{{ list.NamaBank }}</td>
                    <td>{{ list.KodeCabang }}</td>
                    <td>{{ list.NoReferensi }}</td>
                    <td>{{ list.TanggalTransaksi }}</td>
                    <td>{{ list.WaktuTransaksi|default('-') }}</td>
                    <td class="text-right">{{ list.Nominal|number_format(0, ',', '.') }}</td>
                    <td></td>
                </tr>
            {% endfor %}
        {% else %}
            <tr>
                <td colspan="7" align="center">- Tidak ada data -</td>
            </tr>
        {% endif %}
    </tbody>
</table>
{% if txbank.items is not empty %}
    <div class="place-left">{{ "halaman "~txbank.current~" dari "~txbank.total_pages }}</div>
    <div class="place-right">
        {{ link_to("autosettle/index", "First", 'class':'button') }}
        {{ link_to("autosettle/index?page="~txbank.before, "Previous", 'class':'button') }}
        {{ link_to("autosettle/index?page="~txbank.next, "Next", 'class':'button') }}
        {{ link_to("autosettle/index?page="~txbank.last, "Last", 'class':'button') }}
    </div>
{% endif %}