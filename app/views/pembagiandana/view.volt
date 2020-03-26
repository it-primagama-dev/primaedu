
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
                <th>No</th>
				<th width = '20%'>Kode Cabang/Nama Cabang</th>
                <th width = '15%'>NoVA</th>
                <th width = '30%'>Siswa</th>
				<th>Tanggal Transaksi</th>
				<th>Tanggal Import</th>
				<th>CardNo</th>
				<th>Nominal Gros</th>
				<th>Nominal MDR</th>
				 <th>Jumlah 89%</th>
				 <th>Jumlah 11%</th>
                <th>No Rekening BCA</th>
                <th>No Rekening Non-BCA</th>
                <th>Keterangan</th>
                
                
             </tr>
                </thead>
                <tbody>
                    {% if result is not empty %}
                        {% for list in result %}
                            
                            {% if list.rekbca is empty and list.reknonbca is empty %}<tr class="error">{% else %}<tr>{% endif %}
				   {% set Nominal+= list.Nominal %}
				   {% set total89 = Nominal*89/100%}
				   {% set total11 = Nominal*11/100%}
                    <td class="text-center">{{ loop.index }}</td>
                    <td>{{ list.NamaAreaCabang }}</td>
					<td>{{ list.NoVA }}</td>
					<td>{{ list.NamaSiswa }}</td>
					<td>{{ list.TanggalTransaksi }}</td>
					<td>{{ list.TanggalImport }}</td>
					<td>{{ list.CardNo }}</td>
					<td>Rp{{ list.gros_amt|number_format(0,',','.') }}</td>
					<td>Rp{{ list.Nominal |number_format(0,',','.')}}</td>
					<td>Rp{{ total89 |number_format(0,',','.') }}</td>
                    <td>Rp{{ total11 |number_format(0,',','.') }}</td>
				
                {% if list.NoRekBCA is empty %}
                    <td class="text-center">-</td>
                {% else %}
                    <td class="text-center" data-hint-position="top"
                        data-hint="Detail Rekening|{{ 'BCA<br/>' ~ list.NamaRekBCA }}">
                        {{ list.NoRekBCA }}
                    </td>
                {% endif %}
                {% if list.reknonbca is empty %}
                    <td class="text-center">-</td>
                {% else %}
                    <td class="text-center" data-hint-position="top"
                        data-hint="Detail Rekening|{{ list.namabank ~ '<br/>' ~ list.namanonbca }}">
                        {{ list.reknonbca }}
                    </td>					                     
                {% endif %}				
				  {% if list.NoVA is empty %}
                    <td class="text-center">-</td>
                {% else %}
                   <td>{{ list.keterangan }}</td>
					 <td class="text-center" data-hint-position="top"
                        data-hint="Detail Siswa|{{ list.siswa }}">
                        {{ list.Nova }}
                    </td>
				
                {% endif %}
				                    
                 
                </tr>
                            {% if loop.last %}
                               
							   
                            {% endif %}
                           
                        {% endfor %}
                 
                    {% endif %}
					
                </tbody>
            </table>

        </td>
    </tr>
</table>

