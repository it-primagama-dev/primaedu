
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
<table class="tablePrint" style="width:900px">
    <tr>
        <td colspan="7">
            <table style="width:100%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="125%"></td>
                    <td align="center" width="60%">
                        <h2><u>{{ rpt_title }}</u></h2>
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
                        <th width="4%">#</th>
                        <th width="9%">No. Induk Siswa</th>
                        <th width="17%">Nama Siswa</th>
                        <th width="17%">Program</th>
                        <th width="10%">Total Biaya</th>
                        <th width="13%">Total Pembayaran</th>
                        <th width="12%">Diskon</th>
                        <th width="12%">Total Hutang</th>
						 <th width="6%">Mengundurkan diri</th>
                    </tr>
                </thead>

                <tbody>
				{% set totsis=0 %}
                    {% if result is not empty %}
                        {% for list in result %}

                             {% set biaya+= list.JumlahTotal %}
                             {% set pembayaran+= list.Uang_masuk%}
                             {% set diskon+= list.Diskon%}
                             {% set hutang+= list.Hutang_siswa%}
                            
                            <tr class="text-center">
                                
								 
								 {%if list.MD==1%}
								 
								 <td>{{ loop.index }}</td>
                                <td>{{ list.VirtualAccount }}</td>
                                <td class="text-left">{{ list.NamaSiswa|upper }}</td>
                                <td class="text-left">{{ list.NamaProgram|upper}}</td>
                                <td class="text-center">Rp {{ list.JumlahTotal|number_format(0,',','.') }}</td>
                                <td class="text-center">Rp {{ list.Uang_masuk|number_format(0,',','.') }}</td>
								
								 {% set sisa= list.JumlahTotal-list.Uang_masuk-list.Diskon%}
                                <td class="text-center">Rp {{ list.Diskon|number_format(0,',','.') }}</td>
                                <td class="text-center">Rp {{ sisa|number_format(0,',','.') }}</td>
								 
								 
									<td class="text-center" >Tidak </td>
								{% else %}
									 <td bgcolor='red'>{{ loop.index }}</td>
                                <td bgcolor='red'>{{ list.VirtualAccount }}</td>
                                <td class="text-left" bgcolor='red'>{{ list.NamaSiswa|upper }}</td>
                                <td class="text-left" bgcolor='red'>{{ list.NamaProgram|upper}}</td>
                                <td class="text-center" bgcolor='red'>Rp {{ list.JumlahTotal|number_format(0,',','.') }}</td>
                                <td class="text-center" bgcolor='red'>Rp {{ list.Uang_masuk|number_format(0,',','.') }}</td>
								<td class="text-center" bgcolor='red'>Rp {{ list.Diskon|number_format(0,',','.') }}</td>
								 {% set sisa= list.JumlahTotal-list.Uang_masuk-list.Diskon%}
                                <td class="text-center" bgcolor='red'>Rp {{ sisa|number_format(0,',','.') }}</td>
								
								
								
								<td class="text-center" bgcolor='red'> Ya </td>
								
								 {% endif %}
									
								{% set hutangg+= sisa %}
								{% set totsis=totsis+1 %}
                        {% endfor %}
                    {% else %}

                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>

                {% if loop.last %}
                   
             {% endif %}

            {% endif %}

                    <tr>
                        <th colspan='4' align='center'>Total</th>
                        <td  align='center'>Rp {{biaya|number_format(0,',','.')}}</td>
                        <td  align='center'>Rp {{pembayaran|number_format(0,',','.')}}</td>
                        <td  align='center'>Rp {{diskon|number_format(0,',','.')}}</td>
                        <td align='center' colspan='2'>Rp {{hutangg|number_format(0,',','.')}}</td>
                    <tr>
					<tr>
                        <th colspan='4' align='center'>Total 11%</th>
						{% set sebelas=pembayaran*11/100 %}
						{% set sebelaspersen=biaya*11/100 %}
                        {% set sebelaspersendiskon=diskon*11/100 %}
                        <th  align='center' center>Rp {{sebelaspersen|number_format(0,',','.')}}</th>
						<th  align='center' center>Rp {{sebelas|number_format(0,',','.')}}</th>
                        <th  align='center' center>Rp {{sebelaspersendiskon|number_format(0,',','.')}}</th>
						<th  align='center' center colspan='2'> </th>
                        
                    <tr>
					<tr>
                      <th colspan='4' align='center'>Fee Management</th>
						{% if result1 is not empty %}
                        {% for listt in result1 %}
						
                        <th  align='center' center>- </th>
						<th align='center' center>Rp {{listt.Nominal|number_format(0,',','.')}}</th>
                        <th  align='center' center>- </th>
						<th  align='center' center colspan='2'> </th>
						  {% endfor %}
						    {% endif %}
							
					<tr>
                        <th colspan='4' align='center'>GRAND TOTAL</th>
						{% set TOTTAL = sebelas + listt.Nominal%}
						{% set grandtot = (biaya*11/100) - TOTTAL -sebelaspersendiskon%}

                        <th  align='center' center>Rp {{ sebelaspersen |number_format(0,',','.')}}</th>
						<th  align='center' center>Rp {{TOTTAL |number_format(0,',','.')}}</th>
                        <th  align='center' center>Rp {{sebelaspersendiskon |number_format(0,',','.')}}</th>
						<th  align='center' center colspan='2'>Rp {{grandtot |number_format(0,',','.')}} </th>
                        
                    <tr>
                        
                    <tr>
					<tr>
                        <th colspan='4' align='center'>Total siswa</th>
                        <th  align='center' colspan='5'> {{totsis}}</th>
                        
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
