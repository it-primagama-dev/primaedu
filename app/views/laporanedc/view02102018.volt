 
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
            <table style="width:140%;">
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
            <table class="table bordered hovered table2excel" style="width: 140%; border-collapse: collapse">
                <thead>
                    <tr>
                <th>No</th>
				<th width = '10%'>Kode Cabang/Nama Cabang</th>
                <th width = '8%'>NoVA</th>
                <th width = '20%'>Siswa</th>
				<th width = '8%'>Tanggal Transaksi</th>
				<th width = '8%'>Tanggal Import</th>
				<th width = '10%'>CardNo</th>
				<th width = '9'>Nominal Gros</th>
				<th width = '8%'>Nominal MDR</th>
				<th width = '8%'>NETT</th>
				 <th width = '10%'>Jumlah 89%</th>
				 <th width = '10%'>Jumlah 11%</th>              
                <th width = '20%'>Keterangan</th>
                
                
             </tr>
                </thead>
                <tbody>
                    {% if result is not empty %}
                        {% for list in result %}
                            
                            {% if list.rekbca is empty and list.reknonbca is empty %}<tr class="error">{% else %}<tr>{% endif %}
				   {% set Nominal = list.Nominal %}
				   {% set total89 = Nominal*89/100%}
				   {% set total11 = Nominal*11/100%}
				   {% set persen = list.seq * 100 %}
				   {% set net = list.gros_amt - ( list.gros_amt*persen/100) %}
				   {% set net1 = list.gros_amt - ( list.gros_amt*list.seq/100) %}
                    <td class="text-center">{{ loop.index }}</td>
                    <td>{{ list.NamaAreaCabang }}</td>
					<td>{{list.KodeAreaCabang}}{{ list.VirtualAccount }}</td>
					<td>{{ list.NamaSiswa }}</td>
					<td>{{ list.TanggalTransaksi }}</td>
					<td>{{ list.TanggalImport }}</td>
					<td>{{ list.CardNo }}</td>
					<td>Rp{{ list.gros_amt|number_format(0,',','.') }}</td>
					{% if list.NamaBank == 'CardBRI' %}
						<td>{{list.seq}}%</td>
					{% else %}
						<td>{{ persen}}%</td>
					{% endif %}
					{% if list.NamaBank == 'CardBRI' %}
						<td>Rp{{ net1|number_format(2,',','.')}}</td>
					{% else %}
						<td>Rp{{ net|number_format(2,',','.')}}</td>
					{% endif %}
					<td>Rp{{ total89 |number_format(2,',','.') }}</td>
                    <td>Rp{{ total11 |number_format(2,',','.') }}</td>
					 <td>{{ list.Keterangan }}</td>
				
                    
                 
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

<script>
    $('#downloadBtn').on('click', function () {
        $(".table2excel").table2excel({
            exclude: ".noExl",
            name: "Primaedu",
            filename: "{{ rpt_title }}.xls"
        });
    });
</script>

