
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}{% set sumD4 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}{% set subD4 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %} {% set lines = '' %}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
{% set lines = '' %}
<table class="tablePrint" style="width:900px">
    <tr>
        <td colspan="7">
            <table style="width:100%;">
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
                        <h3 class="text-right" style="margin:4px 0">Periode : {{ periode }}</h3>
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
            <table class="table bordered hovered table2excel" style="width: 100%; border-collapse: collapse">
                <thead>
                    <tr>
                        <th width="4%">#</th>
                        <th width="12%">No. Induk Siswa</th>
                        <th width="16%">Nama Siswa</th>
						<th width="12%">Jenjang</th>
						<th width="12%">Bank</th>
						<th width="12%">Tanggal Transaksi</th>
						<th width="12%">BiayaBimbingan</th>
                        <th width="12%">Uang Masuk</th>
												
						<th width="12%">Hutang</th>
						
                    {% set bim = 0 %}
										{% set va = 00000 %}
                    
                    </tr>
                </thead>
                <tbody>
					{% set lines = '' %}
                    {% if result is not empty %}
                        {% for list in result %}
                            {% set currarea = list.NIS %}
                            {% if currarea != lastarea and not loop.first %}
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="6">Sub Total</td>
									<td>{{ subD3|number_format(0,',','.') }}</td>
                                    <td>{{ subD2|number_format(0,',','.') }}</td>
									
									<td>{{ subD3 - subD2 }}</td>
                                
                                </tr>
								
                                {% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
                            {% endif %}
                            {% set subD1 += list.BiayaBimbingan %}
                            {% set subD2 += list.Nominal %}
                            {% set subD3 = list.BiayaBimbingan %}
                            {% set subD4 += list.TotalPembayaranVA %}
                            {% set sumD1 += list.BiayaBimbingan %}
                            {% set sumD2 += list.TotalPembayaran %}
							{% set total += list.Nominal%}
							{% set total1 += list.BiayaBimbingan%}
							
                            
                            {% set sumD4 += list.TotalPembayaranVA %}
                            {% if currarea != lastarea %}
                            {% endif %}
							 {% set lines = list.ProgramSiswa %}
                            <tr class="text-center">
							
                                <td>{{ loop.index }}</td>
                                <td>{{ list.NIS }}</td>
                                <td class="text-left">{{ list.NamaSiswa|upper }}</td>
								<td class="text-left">{{ list.NamaJenjang|upper}}</td>
								<td class="text-left">{{ list.NamaBank|upper }}</td>
								<td class="text-left">{{ list.TanggalTransaksi|upper}}</td>
								<td></td>
                                <td class="text-right">{{ list.Nominal|number_format(0,',','.') }}</td>
								<td class="text-right"></td>
							
							
								
								
                            </tr>
                            {% if loop.last %}
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="6">Sub Total</td>
									
									<td>{{ subD3|number_format(0,',','.') }}</td>
									<td>{{ subD2|number_format(0,',','.') }}</td>
									<td>{{ subD3 - subD2 }}</td>
									
                                    
                                    							 
                                </tr>
								<tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="6">Grand Total</td>
									<td></td>
                                    <td>{{ total|number_format(0,',','.') }}</td>
									
									<td></td>
								 
                                </tr>
							{% endif %}
							
                            {% set lastarea = currarea %}
                        {% endfor %}
                    {% else %}
                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>
                    {% endif %}
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
