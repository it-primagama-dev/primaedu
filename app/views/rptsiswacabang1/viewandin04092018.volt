
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
                        <th width="17%">Jenjang</th>
                         <th width="6%">Mengundurkan diri</th>
                    </tr>
                </thead>

                <tbody>
				{% set totsis=0 %}
                    {% if result is not empty %}
                        {% for list in result %}

                             {% set biaya+= list.JumlahTotal - list.Diskon %}
                             {% set pembayaran+= list.Uang_masuk%}
                             {% set hutang+= list.Hutang_siswa%}
                             {% set diskon+= list.Diskon%}
                            
                            <tr class="text-center">
                                
								 
								 {%if list.MD==1%}
								 
								 <td>{{ loop.index }}</td>
                                <td>{{ list.VirtualAccount }}</td>
                                <td class="text-left">{{ list.NamaSiswa|upper }}</td>
                                <td class="text-left">{{ list.NamaJenjang|upper}}</td>
								
								 
								 
									<td class="text-center" >Tidak </td>
								{% else %}
									 <td bgcolor='red'>{{ loop.index }}</td>
                                <td bgcolor='red'>{{ list.VirtualAccount }}</td>
                                <td class="text-left" bgcolor='red'>{{ list.NamaSiswa|upper }}</td>
                                <td class="text-left" bgcolor='red'>{{ list.NamaJenjang|upper}}</td>

								
								
								
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
					<tr>
                        <th colspan='4' align='center'>Total siswa</th>
                        <th  align='center' colspan='4'> {{totsis}}</th>
                        
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
