{% for datas in data %}
		<table>
			<tbody>
			<tr>
				<td>{{datas.pertanyaan}}</td>
			</tr>
			</tbody>
		</table>
	{%if loop.last%}
		</table>
		{%endif%}
		{%else%}
			NoData
		{%endfor%}