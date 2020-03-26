
<h1>
    {{ link_to("tracking/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    TRACKING DETAIL
</h1>

{{ content() }}


    <table class="table bordered hovered" id="header">
        <thead>
            <tr>
			<th bgcolor="#000080"><font Color="#FFFFFF"><b> No. </font></th>
            <th bgcolor="#000080"> <font Color="#FFFFFF"><b> Description </font></th>
			<th bgcolor="#000080"><font Color="#FFFFFF"><b> Shipment Status</font></th>
            <th bgcolor="#000080"><font Color="#FFFFFF"><b> Date</font></th>
			<th bgcolor="#000080"><font Color="#FFFFFF"><b> Time</font></th>
            </tr>
        </thead>
 
    <tbody>
		<tr>
			<td  bgcolor="#FFFFCC">1
			{% if deposit is not empty %}
							{% for list in deposit %}
								  
									{%set Deposit=list.Deposit%}
								
						{% endfor %}
						
				{% endif %}
			</td>
			<td bgcolor="#FFFFCC">Submit Pemesanan</td>
			{% if result is not empty %}
					{% for list in result %}
						{%if list.astatus=="Inreview" or list.astatus=="Approved" %}
							<td bgcolor="#FFEBCD"><font Color="#000080"><b>OK</font></td>
							<td  bgcolor="#FFEBCD"><b>{{list.PurchReqDate}}</td>
							<td  bgcolor="#FFEBCD"><b>{{list.waktu}} WIB</td>	
						{% else %}
						<td>{{"NO"}}</td>
							<td>-</td>
							<td>-</td>
					{%endif%}
					{% endfor %}
			{% else %}
						<td>{{"NO"}}</td>
							<td>-</td>
							<td>-</td>
					{% endif %}
		</tr>
		<tr>
			<td  bgcolor="#FFFFCC">2</td>
			<td  bgcolor="#FFFFCC">Approve Area Manager</td>
			{% if result is not empty %}
					{% for list in result %}
						{%if list.astatus=="Approved" %}
							<td  bgcolor="#FFEBCD"><font Color="#000080"><b>OK</font></td>
							<td  bgcolor="#FFEBCD"><b>{{list.approvaldate}}</td>
							<td  bgcolor="#FFEBCD"><b>{{list.waktuapp}} WIB</td>	
						{% else %}
						<td>{{"NO"}}</td>
							<td>-</td>
							<td>-</td>
					{%endif%}
					{% endfor %}
			{% else %}
			<td>{{"NO"}}</td>
							<td>-</td>
							<td>-</td>
					{% endif %}
		</tr>
		<tr>
			<td  bgcolor="#FFFFCC">3</td>
			<td  bgcolor="#FFFFCC">Submit Pembayaran</td>
			{% if rest is not empty %}
					{% for list in rest %}
						{%if list.astatus=="Inreview" or list.astatus=="Approved" or list.astatus=="OnHold"  %}
							<td  bgcolor="#FFEBCD"><font Color="#000080"><b>OK</font></td>
							<td  bgcolor="#FFEBCD"><b>{{list.PurchReqDate}}</td>
							<td  bgcolor="#FFEBCD"><b>{{list.waktu}} WIB</td>	
						{% else %}
						<td>{{"NO"}}</td>
							<td>-</td>
							<td>-</td>
					{%endif%}
					{% endfor %}
			{% else %}
			<td>{{"NO"}}</td>
							<td>-</td>
							<td>-</td>
					{% endif %}
			
		</tr>
		<tr>
			<td  bgcolor="#FFFFCC">4</td>
			<td  bgcolor="#FFFFCC"><b>Approve Finance Pusat</td>
			{% if rest is not empty %}
					{% for list in rest %}
						{%if list.astatus=="Approved" or list.astatus=="OnHold" %}
							<td  bgcolor="#FFEBCD"><font Color="#000080"><b>{{list.astatus}}</font></td>
							<td  bgcolor="#FFEBCD"><b>{{list.approvaldate}}</td>
							<td  bgcolor="#FFEBCD"><b>{{list.waktuapp}} WIB</td>	
							</tr>
							<tr>
							<td  bgcolor="#FFEBCD"><font Color="#000080"><b>***</font></td>
							<td  bgcolor="#FFEBCD"><b>Keterangan Keuangan</td>
							<td  bgcolor="#FFEBCD">Tagihan : <b> Rp{{list.HARGA|number_format(0,',','.')}}</td>
							<td  bgcolor="#FFEBCD">Yang di Bayarkan : <b>{%set NOMINAL=Deposit+ list.NOMINAL%} Rp {{NOMINAL|number_format(0,',','.')}}</td>
								{%if NOMINAL==list.HARGA  %}
									<td  bgcolor="#FFEBCD"><b>LUNAS</b></td>
								{% elseif NOMINAL<list.HARGA  %}
									<td  bgcolor="#FFEBCD"><b>Kurang : Rp {%set kurang=list.HARGA-NOMINAL%}{{kurang|number_format(0,',','.')}}</b></td>
								{% else %}
									<td  bgcolor="#FFEBCD"><b>Deposit anda : Rp {%set kurang=NOMINAL-list.HARGA%}{{kurang|number_format(0,',','.')}}</b></td>
								{%endif%}
						{% else %}
						<td>{{"NO"}}</td>
							<td>-</td>
							<td>-</td>
					{%endif%}
					{% endfor %}
				{% else %}
						<td>{{"NO"}}</td>
							<td>-</td>
							<td>-</td>
					{% endif %}
		</tr>
		<tr>
			<td  bgcolor="#FFFFCC">5</td>
			<td  bgcolor="#FFFFCC">Logistik/Packing Slip</td>
			{% if rest is not empty %}
					{% for list in rest %}
						{%if list.print_PS>=1 %}
							<td  bgcolor="#FFEBCD"><font Color="#000080"><b>OK</font></td>
							<td  bgcolor="#FFEBCD"><b>{{list.printDate}}</td>
							<td  bgcolor="#FFEBCD"><b>{{list.waktuprint}} WIB</td>	
						{% else %}
						<td>{{"NO"}}</td>
							<td>-</td>
							<td>-</td>
					{%endif%}
					{% endfor %}
				{% else %}
						<td>{{"NO"}}</td>
							<td>-</td>
							<td>-</td>
					{% endif %}
		</tr>
		<tr>
			<td  bgcolor="#FFFFCC">6</td>
			<td  bgcolor="#FFFFCC">Pengiriman</td>
			{% if reslast is not empty %}
					{% for list in reslast %}
						{%if list.status=="Approved" and list.ResiId!=""%}
							<td  bgcolor="#FFEBCD"><font Color="#000080"><b>OK</font></td>
							<td  bgcolor="#FFEBCD"><b>{{list.tanggal}}</td>
							<td  bgcolor="#FFEBCD"><b>{{list.waktu}} WIB</td>	
						{% else %}
						<td>{{"NO"}}</td>
							<td>-</td>
							<td>-</td>
					{%endif%}
					{% endfor %}
				{% else %}
						<td>{{"NO"}}</td>
							<td>-</td>
							<td>-</td>
					{% endif %}
			</tr>
					
					<tr>
					<td  bgcolor="#FFFFCC"> <font Color="#000080"><b>***</b></td>
					{%set ke = 0 %}
					{% if weri is not empty %}
					
							{% for list in weri %}
								{%set ke = ke + 1 %}
									<td  ><B><font Color="#000000"><b>ETA {{ke}} : {{list.ETA}}</font></B></td>
									<td ><B><font Color="#000000"><b>Koli {{ke}} : {{list.koli}}</font></B></td>
									<td  ><B><font Color="#000000" colspan="2"><b> Resi Id {{ke}}: {{list.ResiId}}</font></B></td>
									</tr>
									<td>
			
							{% endfor %}
						{% else %}
								<td  bgcolor="#FFFFCC">{{"NO"}}</td>
									<td>-</td>
									<td>-</td>
							{% endif %}
					</tr>	
				  
        </tbody>
    </table>
{% if reslast is not empty %}
{% for list in reslast %}
{%if list.ResiId!="" %}	
	
				<h1>
				
			   Detail 
			   
			</h1>

			{{ content() }}


				<table class="table bordered hovered" id="header">
					<thead>
						<tr>
						<th bgcolor="#000080"><font Color="#FFFFFF"><b> No.</font></th>
						<th bgcolor="#000080"><font Color="#FFFFFF"><b> Nama Barang</font></th>
						 <th bgcolor="#000080"><font Color="#FFFFFF"><b> Jumlah Barang yang di pesan</font></th>
						<th bgcolor="#000080"><font Color="#FFFFFF"><b> Jumlah Barang yang dikirim</font></th>
						<th bgcolor="#000080"><font Color="#FFFFFF"><b> Sisa Pesanan</font></th>
					   
						</tr>
					</thead>
			 
				<tbody>
				{%set nilai = 0 %}
						{% if tampung is not empty %}
							{% for list in tampung %}
								{%if list.resi!="" %}
								<tr>
									{%set nilai = nilai +1 %}
									<th>{{nilai}}</th>
									<th>{{list.ItemName}}</th>
									 <th>{{list.Qty}}</th>
									<th>{{list.QtyRemaining}}</th>
									{%set sisa = list.Qty - list.QtyRemaining %}
									<th><font Color="#000080">{{sisa }}</font></th>  
								</tr>
								{% endif %}
					{% endfor %} 
					  {% endif %}
					</tbody>
				</table>
{%endif%}
{% endfor %}
{%endif%}