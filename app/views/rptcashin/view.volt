
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
<table class="tablePrint" style="width:1200px">
    <tr>
        <td colspan="7">
            <table style="width:100%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="125%"></td>
                    <td align="center" width="60%">
                        <h2><u> Laporan Rugi Laba Cabang</u></h2>
                    </td>
                    <td width="22%" align="right">
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>
                        <a href="javascript:void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3 style="margin: 4px 0">Area : {{ rpt_area }}, Cabang : {{ rpt_cabang }}</h3>
                    </td>
                    <td>
                        <h3 class="text-right" style="margin: 4px 0">Tahun Ajaran : {{ rpt_tahun }}</h3>
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
                        <th width="3%" bgcolor='#DCDCDC' >#</th>
                        <th width="8%" bgcolor='#DCDCDC'>Tahun Ajaran</th>
                        <th width="10%" bgcolor='#DCDCDC'>Pendapatan</th>
						<th width="15%" bgcolor='#DCDCDC'>Pengeluaran Biaya</th>
						<th width="15%" bgcolor='#DCDCDC'>Keterangan</th>
                        <th width="8%" bgcolor='#DCDCDC'>Tanggal</th>
                        <th width="10%" bgcolor='#DCDCDC'>Debet</th>
                        <th width="10%" bgcolor='#DCDCDC'>Kredit</th>
                        <th width="15%"bgcolor='#DCDCDC'>Total</th>
                    </tr>
                </thead>

                <tbody>
				{% set totsis=0 %}
                    {% if result is not empty %}
                        {% for list in result %}

                             {% set total+= list.Nominal89 %}
                            
                            <tr class="text-center">
								 <td>{{ loop.index }}</td>
                                <td class="text-center">{{ rpt_tahun }}</td>
                                <td class="text-left"> PENDAPATAN 89 % VA</td>
                                <td class="text-center">{{ list.NamaBank }}</td>
								<td class="text-center"></td>
								<td class="text-center"></td>
                                <td class="text-center">Rp {{ list.Nominal89|number_format(0,',','.') }}</td>
                                <td class="text-center">{{ list.TanggalImport }}</td>
                                <td class="text-center">Rp {{ list.Nominal89|number_format(0,',','.') }}</td>
                        {% endfor %}
                    {% else %}

                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>

                {% if loop.last %}
                   
             {% endif %}

            {% endif %}

                    <tr>
                        <th colspan='6' align='center'></th>
                    <tr>
                        
                        
                    <tr>

            
				{% set totsis=0 %}
                    {% if result2 is not empty %}
                        {% for listt in result2 %}

                             {% set total3+= listt.Jumlah %}
                            
                            <tr class="text-center">
								 <td>{{ loop.index }}</td>
                                <td class="text-center">{{ rpt_tahun }}</td>
                                <td class="text-left">PENDAFTARAN SISWA</td>
                                <td class="text-center">{{ list.NamaBank }}</td>
								<td class="text-center"></td>
								<td class="text-center"></td>
                                <td class="text-center">Rp {{ listt.Jumlah|number_format(0,',','.') }}</td>
                                <td class="text-center">{{ listt.TanggalImport }}</td>
                                <td class="text-center">Rp {{ listt.Jumlah|number_format(0,',','.') }}</td>
                        {% endfor %}
                    {% else %}

                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>

                {% if loop.last %}
                   
             {% endif %}

            {% endif %}

                    <tr>
                        <th colspan='6' align='center'></th>
                    <tr>
                        
                        
                    <tr>

                </tbody>	
				
				{% if result1 is not empty %}
                        {% for listt in result1 %}

                             {% set total1+= listt.Jumlah %}
                            
                            <tr class="text-center">
								 <td>{{ loop.index }}</td>
                                <td class="text-center"></td>
                                <td class="text-left"> </td>
								<td class="text-left">{{ listt.NamaBiayaGroup }}</td>
								<td class="text-left">{{ listt.Description }}</td>
                                <td class="text-center">{{ listt.Tanggal }}</td>
								<td class="text-center"></td>
                                <td class="text-center">Rp {{ listt.Jumlah|number_format(0,',','.')  }}</td>
								<td class="text-center"></td>
                        {% endfor %}
                    {% else %}

                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>

                {% if loop.last %}
                   
             {% endif %}

            {% endif %}

             <tr>
                        <th colspan='3' align='center'>TOTAL</th>	
						   
						    {% set totalnih= total + total3%}
							{% set grandtotal = totalnih - total1%}
							<th  align='center' center></th>
							<th  align='center' center></th>
							<th  align='center' center></th>							
							<th  align='center' bgcolor='Ivory'>Rp {{totalnih|number_format(0,',','.')}} </th> 
							<th  align='center' bgcolor='Ivory'>Rp {{total1 |number_format(0,',','.')}} </th>
							<th  align='center' bgcolor='Ivory'>Rp {{grandtotal |number_format(0,',','.')}} </th>
							                     
							
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
