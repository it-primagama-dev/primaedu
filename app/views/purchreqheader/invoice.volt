<h1>
    {{ link_to("purchreqheader/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Invoice
    <small class="on-right">Detail Invoice</small>
</h1>

{{ content() }}
{% set total =0 %}
{% if pr is not empty %}
    <table class="table bordered hovered" id="header">
        <thead>
            <tr>
                <th>Kode Pembelian</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Requester</th>
                <th>Status</th>
                <th>Paket Pengiriman</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ pr.PurchReqId }}</td>
                <td>{{ pr.ApprovalDate }}</td>
                <td>{{ pr.PurchReqName }}</td>
                <td>{{ pr.Requester }}</td>
                <td>{{ pr.Status }}</td>
                <td>{{ pr.TipePengiriman }}</td>
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
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kode Barang</th>
                    <th rowspan="2">Nama Barang</th>
                    <th colspan="3">Jumlah (Qty.)</th>
                </tr>
                <tr>
                    <th>Pembelian</th>
                    <th>Harga</th>
                    <th>Harga_Total</th>
                </tr>
            </thead>
            <tbody>
                {% for line in pr.Purchreqline %}
                    <tr data-prlines="{{ line.RecId }}">
                        <td>{{ loop.index }}</td>
                        <td>{{ line.ItemId }}</td> 
                        <td>{{ line.ItemName }}</td>
                        <td>{{ line.Qty }}</td>
                        <td>{{line.price}}</td>
                        <td>{% set harga =line.Qty*line.price %}{{harga}}{% set total +=harga %}</td>
						{% endfor %}
                    </tr>
					<tr>
                        <td colspan='5' align='right' ><b>Jumlah Tagihan</b></td>
                        <td>{{ total|number_format(0,',','.')  }}</td> 
                        
                    </tr>
					<tr>
					<td>{% if result is not empty %}
							{% for list in result %}
								  <td colspan='4' align='right' ><b>Deposit Cabang</b></td>
									<td><u>{{ list.Deposit|number_format(0,',','.')}} -</u></td> 
								
						{% endfor %}
						{% else %}
							 <td colspan='4' align='right' ><b>Deposit Cabang</b></td>
							<td><u>{{ 0 }} -</u></td> 
					{%endif%}
					</td>
					<tr>
					<tr>
					<td>
								  <td colspan='4' align='right' ><b>Total Tagihan</b></td>
									<td><b>{% set jumlah=total-list.Deposit%}{{ jumlah|number_format(0,',','.')  }}</b></td> 
						
					</td>
					<tr>
                
				
            </tbody>
        </table>
    {% endif %}
{% endif %}
