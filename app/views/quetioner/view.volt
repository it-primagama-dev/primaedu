
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
                        <th width="5%">#</th>
						<th width="35%">Pertanyaan</th>
						<th width="15%">Jawaban</th>
						<th width="5%">Bobot</th>
						<th width="20%">Area</th>
						
                    {% set bim = 0 %}
					{% set va = 00000 %}
                    
                    </tr>
                </thead>
                <tbody>
					{% set lines = '' %}
                    {% if hasil is not empty %}
                        {% for list in hasil %}
                            {% set currarea = list.NamaAreaCabang %}
                            {% if currarea != lastnamaareacabang and not loop.first %}
                                
                                {% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
                            {% endif %}                            {% set sumD1 = loop.index %}
                            {%  set sumD2 += list.Bobot%}
							{% set subD5 = sumD2 / sumD1 %}
							{% set subD3 = subD5%}
							
							{% set subD1 = 1 %}
							{% set subD2 = 2 %}
							{% set subE3 = 3 %}
							{% set subD4 = 4 %}
							
                            {% if subD3 == subD4 %}
								{% set hasil = 'Ramah'%}
							{% endif %}	
							{% if subD3 == subE3 %}
								{% set hasil = 'Baik'%}
							{% endif %}
							{% if subD3 == subD2 %}
								{% set hasil = 'Buruk' %}
							{% endif %}
							{% if subD3 == subD1 %}
								{% set hasil = 'Sangat Buruk'%}
							{% endif %}
									
									
									
							
                            {% set sumD4 += list.TotalPembayaranVA %}
                            {% if currarea != lastnamaareacabang %}
                            {% endif %}
							  
                            <tr class="text-center">
							
                                <td>{{ loop.index }}</td>
                                <td align="left">{{ list.pertanyaan }}</td>
                                <td class="text-left">{{ list.Pilihan|upper }}</td>
								
                                <td class="text-right">{{ list.Bobot|number_format(0,',','.') }}</td>
								<td class="text-left">{{ list.NamaAreaCabang|upper }}</td>
								
                            </tr>
							{% if loop.last %}
							<tr class="text-right" style="background: #f0f0f0; font-weight: bold">
								<td class="text-center">Saran</td>
								<td align="left" colspan="4">{{ list.saran }}</td>
							</tr>
							{% endif %}
                            {% if loop.last %}
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="3">Sub Total</td>
                                    <td>{{ subD5 |number_format(0,',','.') }}</td>
									
									
									<td>{{ hasil }}</td>
									
                                  
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
{#
{% if page.total_pages > 1 %}
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("rptrekapsiswabnyk/view", "First", 'class':'button') }}
    {{ link_to("rptrekapsiswabnyk/view?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("rptrekapsiswabnyk/view?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("rptrekapsiswabnyk/view?page="~page.last, "Last", 'class':'button') }}
</div>
{% endif %}
#}

<script>
    $('#downloadBtn').on('click', function () {
        $(".table2excel").table2excel({
            exclude: ".noExl",
            name: "Primaedu",
            filename: "{{ rpt_title }}.xls"
        });
    });
</script>
