<h1>
    {{ link_to("Konfirmasipembayaran/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Pembelian
    <small class="on-right">Lihat Detail</small>
</h1>

{{ content() }}

{% if pr is not empty %}
    <table class="table bordered hovered" id="header">
        <thead>
            <tr>
				<th>Kode Konfirmasi</th>
                <th>Kode Pembelian</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Nominal</th>
                <th>Status</th>
				<th>Note</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ pr.ConfirmId }}</td>
				 <td>{{ pr.PurchReqId }}</td>
                <td>{{ pr.PurchReqDate }}</td>
                <td>{{ pr.PurchReqName }}</td>
                <td>{{ pr.Nominal }}</td>
                <td>{{ pr.Status }}</td>
				<td>{{ pr.Remarks }}</td>
            </tr>
        </tbody>
    </table>
{% endif %}
