
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
                        <th >No</th>
                        <th >Kode Cabang</th>
                        <th>Nama Cabang</th>
                        <th >Total Harga</th>
                        <th >Total Biaya Bimbingan</th>
			<th>Total Pembayaran</th>
			<th>Sisa Hutang</th>
			<th>Tanggal Berakhir</th>
						
                     
                    </tr>
                </thead>
                <tbody>
                    {% if result is not empty %}
                        {% for list in result %}
                            
                             {% set hutangsemua+= list.total_hutang %}
							 {% set bayarsemua+= list.Uang_masuk%}
							 {% set jubuk+= list.total_buku%}
							 {% set jusis+= list.total_siswa%}
                           
                         
                             
                            <tr class="text-center">
                                <td> {{ loop.index }}</td>
                                <td> {{ list.KodeAreaCabang }}
								</td>
					
                                <td align='left' >{{ list.NamaAreaCabang}}</td>
                                <td> {{ list.total_siswa }}</td>
                                <td>
								Rp {{list.total_hutang|number_format(0,',','.')}}</td>
								 {% if list.Uang_masuk=='' %}
									<td >0</td>
								 
								 {%else%}
									<td>
									
									<a href="{{ url('Rptsiswapiutangcabang/view?cabang='~list.RecID)}}">
									Rp {{list.Uang_masuk|number_format(0,',','.') }}</a>
									 
								 </td>
									
								 
								 {% endif %}
								 
								 {% set hutang= list.total_hutang -list.Uang_masuk%}
								 {% set sisa+= hutang%}
								
								<td >Rp {{hutang|number_format(0,',','.')}}</td>
								<td >{{list.tanggalberakhir}}</td>
								
								
                          
                            </tr>
                            {% if loop.last %}
                               
							   
                            {% endif %}
                           
                        {% endfor %}
                 
                    {% endif %}
					<tr>
						<th colspan='3' align='center'>Total</th>
						
						<th  align='center'>{{jusis}}</th>
						<th  align='center'>
						Rp {{hutangsemua|number_format(0,',','.')}}</th>
						<th  align='center'>
						Rp {{bayarsemua|number_format(0,',','.')}}</th>
						<th colspan='2'  align='center'>Rp {{sisa|number_format(0,',','.')}}</th>
					<tr>
                </tbody>
            </table>

        </td>
    </tr>
</table>

