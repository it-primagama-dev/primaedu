
<h1>
    {{ link_to("TrackingFranchise/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
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
			<td bgcolor="#FFFFCC">Submit Pembayaran</td>
			{% if result is not empty %}
					{% for list in result %}
						{%if list.Status=="Draft" or list.Status=="Approved" or list.Status=="OnHold" %}
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
			<td  bgcolor="#FFFFCC"><b>Approve Finance Pusat</td>
			{% if rest is not empty %}
					{% for list in rest %}
						{%if list.Status=="Approved" or list.Status=="OnHold" %}
							<td  bgcolor="#FFEBCD"><font Color="#000080"><b>{{list.Status}}</font></td>
							<td  bgcolor="#FFEBCD"><b>{{list.approvaldate}}</td>
							<td  bgcolor="#FFEBCD"><b>{{list.waktuapp}} WIB</td>	
							</tr>
							<tr>
							<td  bgcolor="#FFEBCD"><font Color="#000080"><b>***</font></td>
							<td  bgcolor="#FFEBCD"><b>Keterangan Keuangan</td>
							<td  bgcolor="#FFEBCD">Tagihan : <b> Rp{{list.Total|number_format(0,',','.')}}</td>
							<td  bgcolor="#FFEBCD">Yang di Bayarkan : <b>{%set NOMINAL= list.Nominal%} Rp {{NOMINAL|number_format(0,',','.')}}</td>
							{%set NOMINAL1 += list.Nominal%}
									{% if NOMINAL1 < list.Total  %}
									<td  bgcolor="#FFEBCD"><b>Kurang : Rp {%set kurang=list.Total-list.NOMINAL%}{{kurang|number_format(0,',','.')}}</b></td>
									{%elseif list.Total == list.NOMINAL %}
									<td  bgcolor="#FFEBCD"><b>LUNAS</b></td>		
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
									 <th>{{list.Qty|number_format(0,',','.')}}</th>
									<th>{{list.QtyRemaining|number_format(0,',','.')}}</th>
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