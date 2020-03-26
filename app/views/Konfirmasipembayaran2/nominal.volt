
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}{% set subD4 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
<h1>
    {{ link_to("Konfirmasipembayaran2/search", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
	Konfirmasi Pembayaran
</h1>
<table class="tablePrint" style="width:900px">
    <tr>
        <td colspan="7"><hr color="#000000"/></td>
    </tr>
	<tr>
		<td><h4 style="margin: 4px 0"> Cabang : {{ rpt_cabang }}</h4></td>
	</tr>
	<tr><td></td></tr>
	<tr><td><h5>Pembayaran Saat ini berada di tahun :
	{% if tahun is not empty %}
    {% for list in tahun %}
	 {{list.TahunMulai}}
	{%endfor%}
	{%endif%}
	</h5></td></tr>
    <tr>
        <td colspan="7">
		
		<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th width="5%">Tipe Pembayaran</th>
            <th>Nilai Franchise</th>
            <th>Pajak 10%</th>
            <th>Total Nilai Franchise</th>
			<th>Jatuh Tempo</th>
        </tr>
    </thead>
	<tbody>
				{% if rest is not empty %}
                        {% for list in rest %}	
                <tr>
                    <td>Pembayaran Franchise</td>
					<td>Rp {{ list.NilaiFranchisee |number_format(0,',','.') }}</td>
					{% set pajak = list.NilaiFranchisee * 10/100 %}
					<td>Rp {{ pajak |number_format(0,',','.') }}</td>
					<td>Rp {{ list.Total|number_format(0,',','.')  }}</td>
					<td>{{ list.TanggalBerakhir }}</td>
                </tr>
				{%endfor%}
				{%endif%}
			
	</tbody>
</table>
<br>
		<p>Data Transaksi</p>
            <table class="table bordered striped hoverel" style="width: 100%; border-collapse: collapse">
                <thead>
                    <tr>
                        <th >No</th>
                        <th >Tanggal Transaksi</th>
						<th>No. Transaksi</th>
                        <th >Dibayarkan oleh</th>
                        <th>Nominal</th>
                     
                    </tr>
                </thead>
                <tbody>
                    {% if result is not empty %}
                        {% for list in result %}	
                            
                             {% set hutangsemua+= list.total_hutang %}
							 {% set bayarsemua+= list.Uang_masuk%}
							 {% set total += list.Nominal%}
                         
                             
                            <tr class="text-center">
                                <td> {{ loop.index }}</td>
								<td> {{ list.ApprovalDate }}</td>
                                <td> {{ list.ConfirmId }}</td>
					
                                <td> {{ list.CreatedBy }}</td>
                                <td>Rp {{list.Nominal |number_format(0,',','.')}}</td>
								
								
                          
                            </tr>
                            {% if loop.last %}
                               
							   
                            {% endif %}
                           
                        {% endfor %}
                 
                    {% endif %}
					{% set sumD4 += Nominal %}
					<tr>
					<th colspan='5' align='center' >
					</tr>
					
					<tr>
						<th colspan='4' align='center'>Harga Francisee</th>
						<th  align='center'>Rp {{list.Total |number_format(0,',','.')}}</th>
					<tr>
					{% set bayar = list.Pembayaran %}
					<tr>
						<th colspan='4' align='center'>Yang Sudah Dibayarkan</th>
						<th  align='center'>Rp {{bayar|number_format(0,',','.')}}</th>
					<tr>
					{% set sisa = list.Total - bayar %}
					<tr>
						<th colspan='4' align='center' bgcolor="#33ccff">Sisa Pembayaran</th>
						<th  align='center' bgcolor="#33ccff">Rp {{sisa |number_format(0,',','.')}}</th>
					<tr>
					
					
					
                </tbody>
            </table>

        </td>
    </tr>
</table>

<script>
    $('#downloadBtn').on('click', function () {
        $(".table2excel").table2excel({
            exclude: ".noExl",
            name: "Primaedu",
            filename: "{{ rpt_title }}.xls"
        });
    });
</script>
<script>
	
</script>