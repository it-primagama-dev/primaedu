
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
                <tr>
                    <td colspan="2">
                        <h3 style="margin: 4px 0">Area : {{ rpt_area }}, Cabang : {{ rpt_cabang }}</h3>
                    </td>
                    <td>
                       
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
            <table class="table bordered hoveredqq table2excel" style="width: 2000px; border-collapse: collapse">
                <thead>
                    <tr>
					
                        <th >No</th>
                        <th >Kode Cabang</th>
                        <th width = "10%">Nama Cabang</th>
                        <th width = "5%">Awal Kontrak</th>
						<th width = "5%">Akhir Kontrak</th>
						<th width = "5%">Nilai Franchisee</th>
						<th width = "3 %">Diskon</th> 
						<th width = "5%">DPP</th>
						<th width = "5%">Pajak</th>
						<th width = "7%">Total Penagihan Ff</th>
						<th width = "7%">Pembayaran</th>
						<th width = "7%">Sisa Hutang</th>
						<th width = "9%">Tanggal MOU </th>
						<th width = "6%">Status</th>
						<th width = "5%">Status2</th>
						<th width = "10%">NPWP / NIK</th>
						<th width = "30%">Keterangan</th>
                     
                    </tr>
                </thead>
                <tbody>
				 
                    {% if result is not empty %} 
                        {% for list in result %}
                            
                             {% set hutangsemua+= list.total_hutang %}
							 {% set bayarsemua+= list.Uang_masuk%}
							 {% set jubuk+= list.total_buku%}
							 {% set jusis+= list.total_siswa%}
							 {% set dpp = list.Nilai - list.Diskon%}
							 {% set pajak = dpp * 10/100 %}
							 {% set tagih = dpp + pajak %}
							 {% set bayar = list.pembayaran + list.bus %}
							 {% set sisa = tagih - bayar %}
							 {% set semua += dpp %}
                           
							{% set tanggal = list.TanggalBerakhir%}
                            <tr class="text-center">
                                <td class="text-center">{{ loop.index }}</td>
                                <td> {{ list.KodeAreaCabang }}
								</td>
					
                                <td align='left' >{{ list.NamaAreaCabang}}</td>
								<td>{{list.AwalKontrak}}</td>
								<td >{{list.AkhirKontrak}}</td>
								{% if list.Pembayaran=='NULL'  and '0' %}
								<td >0</td>
								{%else%}
								<td align='right'> {{list.Nilai|number_format(0,',',',') }}</a></td>
								{%endif%}
								<td align='right'>{{list.Diskon|number_format(0,',',',') }}</a></td>
								<td align='right'>{{dpp|number_format(0,',',',') }}</a></td>
								<td align='right'>{{pajak|number_format(0,',',',') }}</a></td>
								
								 {% if tagih=='' %}
									<td >0</td>
								 
								 {%else%}
									<td align='right'>
									
									 {{tagih|number_format(0,',',',') }}
									</td>
								 {% endif %}
								 
								<td align='right'>
								<a href="{{ url('Rptpembayaranfranchisee/view?cabang='~list.RecID)}}">
								{{ (bayar)|number_format(0,',',',') }}</a></td>

								<td align='right'>{{sisa|number_format(0,',',',')}}</td>
								{%if list.TglMou == "1900-01-01"%}
									<td>MOU Belum dibuat</td>
								{% elseif list.TglMou is NULL%}
									<td>MOU Belum dibuat</td>
								{%else%}
									<td>{{list.TglMou}}</td>
								{%endif%}

								<td></td>
								<td></td>
								
								{% if list.Keterangan== 'NULL' %}
									<td> </td>
								{%else%}
									<td align = 'left'> {{list.NoNPWP}}/{{list.NoKTP}}</td>
								{%endif%}
								
								{% if list.Keterangan== 'NULL' %}
									<td> </td>
								{%else%}
									<td align = 'left'> {{list.Keterangan}}</td>
								{%endif%}
                          
                            </tr>
                            {% if loop.last %}
                               
							   
                            {% endif %}
                           {% set bayarjum += bayar %}
                           {% set sisajum += sisa %}
                        {% endfor %}
                 
                    {% endif %}
                    {% set semua += list.Nilai %}
                    {% set diskonjum += list.Diskon %}
                    {% set dppjum = semua - diskonjum %}
                    {% set pajakjum = dppjum * 10/100 %}
                    {% set tagihjum = dppjum + pajakjum %}
                    {% set bayar = list.pembayaran + list.bus %}

				<tr>
						<th colspan='5' align='center'>Total</th>
						
						<th  align='center'>Rp {{semua|number_format(0,',','.')}}</th>
						
						<th  align='center'>Rp {{diskonjum|number_format(0,',','.')}}</th>

						<th  align='center'>Rp {{dppjum|number_format(0,',','.')}}</th>

						<th align='center'>Rp {{pajakjum|number_format(0,',','.')}}</th> 

						<th align='center'>Rp {{tagihjum|number_format(0,',','.')}}</th>  

						<th align='center'>Rp {{bayarjum|number_format(0,',','.')}}</th>  

						<th align='center'>Rp {{sisajum|number_format(0,',','.')}}</th>
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
