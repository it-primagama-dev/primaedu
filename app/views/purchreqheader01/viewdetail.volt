<h1>
    {{ link_to("purchreqheader/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Pembelian
    <small class="on-right">Lihat Detail</small>
</h1>

{{ content() }}

{% if pr is not empty %}
    <table class="table bordered hovered" id="header">
        <thead>
            <tr>
                <th>Kode Pembelian</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Requester</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ pr.PurchReqId }}</td>
                <td>{{ pr.PurchReqDate }}</td>
                <td>{{ pr.PurchReqName }}</td>
                <td>{{ pr.Requester }}</td>
                <td>{{ pr.Status }}</td>
            </tr>
        </tbody>
    </table>

    {% if pr.Purchreqline is not empty %}
        <legend>
            <small class="on-right text-bold fg-darker">Detil Pembelian</small>
        </legend>
        <table class="table bordered hovered" id="detail">
            <thead>
                <tr>
                    <th rowspan="2">##</th>
                    <th rowspan="2">Kode Barang</th>
                    <th rowspan="2">Nama Barang</th>
                    <th colspan="3">Jumlah (Qty.)</th>
                </tr>
                <tr>
                    <th>Pembelian</th>
                    <th>Sisa Pembelian</th>
                    <th>Sudah Diterima</th>
                </tr>
            </thead>
            <tbody>
                {% for line in pr.Purchreqline %}
                    <tr data-prlines="{{ line.RecId }}">
                        <td>{{ loop.index }}</td>
                        <td>{{ line.ItemId }}</td>
                        <td>{{ line.ItemName }}</td>
                        <td>{{ line.Qty }}</td>
                        <td>{{ line.QtyRemaining }}</td>
                        <td>{{ line.QtyReceived }}</td>
                        </td>
                    </tr>
                {% endfor %}
            </tbody>
        </table>
    {% endif %}
{% endif %}
