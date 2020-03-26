
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}{% set sumD4 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}{% set subD4 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
<table class="tablePrint" style="width:900px">
    <tr>
        <td colspan="7">
            <table style="width:1500px;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="125%"></td>
                    <td align="center" width="64%">
                        <h2><u>{{ rpt_title }}</u></h2>
                    </td>
                    <td width="18%" align="right">
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>
                        <a href="javascript:void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
                    </td>
                </tr>
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="7"><hr color="#000000"/></td>
    </tr>
    <tr>
        <td colspan="7">
            <table class="table bordered hovered table2excel" style="width: 1500px; border-collapse: collapse">
                <thead>
                    <tr>
                        <th >No</th>
                        <th >Kode Cabang</th>
                        <th width = "15%">Nama Cabang</th>
                        <th width = "7%">Awal Kontrak</th>
                        <th width = "7%">Akhir Kontrak</th>
						<th width = "5%">DPP (Rp)</th>
						<th width = "5%">Pajak (Rp)</th>
						<th width = "7%">Total Penagihan Ff (Rp)</th>
						<th width = "7%">Pembayaran (Rp)</th>
						<th width = "5%">Kurang Bayar (Rp)</th>
						<th width = "7%">Tanggal MOU </th>
						<th width = "7%">No MOU </th>
						<th width = "15%">NPWP / NIK</th>
						<th width = "20%">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
				 
                    {% if result is not empty %} 
                        {% for list in result %}
                            
                             {% set hutangsemua+= list.total_hutang %}
                             {% set andin = list.andin %}
							 {% set bayarsemua+= list.Uang_masuk%}
							 {% set jubuk+= list.total_buku%}
							 {% set jusis+= list.total_siswa%}
							 {% set dpp = list.Nilai - list.Diskon%}
                           	 {% set semua += dpp %}
                           	 {% set totaltagih += list.Total  %}
							 {% set pay = list.Pembayaran + andin%}


							{% set tanggal = list.TanggalBerakhir - 6 %}
                            <tr class="text-center">
                                <td class="text-center">{{ loop.index }}</td>
                                <td> {{ list.KodeAreaCabang }}
								</td>
					
                                <td align='left' >{{ list.NamaAreaCabang}}</td>
                                
                                <td>{{list.TanggalBerlaku}}</td>
								<td >{{list.AkhirKontrak}}</td>
								{% if list.Pembayaran=='NULL'  and '0' %}
								<td >0</td>
								{%else%}
								<td align='right'> {{dpp|number_format(0,',',',') }}</a></td>
								{%endif%}
								<td align='right'>{{list.Pajak|number_format(0,',',',') }}</a></td>
								
								 {% if list.Total=='' %}
									<td >0</td>
								 
								 {%else%}
									<td align='right'>
									
									 {{list.Total|number_format(0,',',',') }}
									</td>
								 {% endif %}
								 {% set hutang= list.Total - pay%}
								 {% set sisa+= hutang%}
								 {% set pajak += list.Pajak %}
								
								<td align='right'>
								<a href="{{ url('Rptpembayaranfranchisee/view?cabang='~list.RecID)}}">
								{{ (pay)|number_format(0,',',',') }}</a></td>

								<td align='right'>{{hutang|number_format(0,',',',')}}</td>
								{%if list.TglMou == "1900-01-01"%}
									<td>MOU Belum dibuat</td>
								{% elseif list.TglMou is NULL%}
									<td>MOU Belum dibuat</td>
								{%else%}
									<td>{{list.TglMou}}</td>
								{%endif%}

								{%if list.NoMou != "NULL"%}
									<td>No MOU Belum Diisi</td>
								{%else%}
									<td>{{list.NoMOU}}</td>
								{%endif%}
								
								{% if list.Keterangan== 'NULL' %}
									<td> </td>
								{%else%}
									<td align = 'left'> {{NPWP}}</td>
								{%endif%}
								
								{% if list.Keterangan== 'NULL' %}
									<td> </td>
								{%else%}
									<td align = 'left'> {{list.Keterangan}}</td>
								{%endif%}
                            </tr>
                           
                        {% endfor %}
                 
                    {% endif %}
                    
                    
                    
				<tr>
						<th colspan='5' align='center'>Total</th>
						
						<th  align='center'>Rp {{semua|number_format(0,',','.')}}</th>
						
						<th  align='center'>Rp {{pajak|number_format(0,',','.')}}</th>

						<th  align='center'>Rp {{totaltagih|number_format(0,',','.')}}</th>

						<th align='center'>Rp {{nominal|number_format(0,',','.')}}</th> 

						<th align='center'>Rp {{sisa|number_format(0,',','.')}}</th>  
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
