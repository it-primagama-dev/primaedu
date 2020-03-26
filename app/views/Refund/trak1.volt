<h1>
    {{ form("refund/cetak1", "method":"post","enctype": "multipart/form-data") }}
    	{{ link_to("refund", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }} TRACKING DETAIL
    	{{ hidden_field("name":"nocetek","id":"nocetek","nosurat") }}
    	<button type="submit" style="background:none;font-size:24px;font-weight:bold">{{ nosurat }}</button>
    {{ end_form() }}
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
			<td  bgcolor="#FFFFCC">1</td>
			<td  bgcolor="#FFFFCC"><b>Approve Finance Pusat<b></td>
			{% if TrackGM is not empty %}
				<td style="text-align:center">{{ TrackFinance }}</td>
				<td style="text-align:center">{% if TrackFinance=="PENDING" %} - {% else %} {{ tgl }} {% endif %}</td>
				<td style="text-align:center">{% if TrackFinance=="PENDING" %} - {% else %} {{ jam }} {% endif %}</td>
			{% endif %}
		</tr>
		<tr>
			<td  bgcolor="#FFFFCC">2</td>
			<td  bgcolor="#FFFFCC">Approve General Manager</td>
			{% if TrackFinance is not empty %}
				<td style="text-align:center">{{ TrackGM }}</td>
				<td style="text-align:center">{% if TrackGM=="PENDING" %} - {% else %} {{ tglGM }} {% endif %}</td>
				<td style="text-align:center">{% if TrackGM=="PENDING" %} - {% else %} {{ jamGM }} {% endif %}</td>
			{% endif %}
		</tr>
	</tbody>
</table>