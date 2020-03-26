
<h1>
    {{ link_to("tracking/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
     DETAIL Pesanan <strong>{{ pr }}</strong>
</h1>




   
	
				<h1>
				
			   Detail 
			   
			</h1>

			{{ content() }}


				<table class="table bordered hovered" id="header">
					<thead>
						<tr>
						<th bgcolor="#000080"><font Color="#FFFFFF"><b> No.</font></th>
						<th bgcolor="#000080"><font Color="#FFFFFF"><b> Kode Barang</font></th>
						<th bgcolor="#000080"><font Color="#FFFFFF"><b> Nama Barang</font></th>
						 <th bgcolor="#000080"><font Color="#FFFFFF"><b> Jumlah Barang yang di pesan</font></th>
						
					   
						</tr>
					</thead>
			 
				<tbody>
				{%set nilai = 0 %}
						{% if tampung is not empty %}
							{% for list in tampung %}
								
								<tr>
									{%set nilai = nilai +1 %}
									<td>{{nilai}}</td>
									<td>{{list.ItemId}}</td>
									<td>{{list.ItemName}}</td>
									 <td>{{list.Qty|number_format(0,',','.')}}</td>
									
								</tr>
								
					{% endfor %} 
					  {% endif %}
					</tbody>
				</table>
