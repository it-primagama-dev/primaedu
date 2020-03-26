
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}{% set subD4 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
<table class="tablePrint" style="width:900px">
    <tr>
        <td colspan="7"><hr color="#000000"/></td>
    </tr>
    <tr>
        <td colspan="7">
            <table class="table bordered hovered table2excel" style="width: 100%; border-collapse: collapse">
                <thead>
                    <tr>
                        <th >No</th>
                        <th >Tanggal Transaksi</th>
                        <th>NoVA</th>
                        <th >Nama Siswa</th>
                        <th>Nominal</th>
						<th colspan='2'>Tahun Ajaran</th>
                        
						
                     
                    </tr>
                </thead>
                <tbody>
                    {% if result is not empty %}
                        {% for list in result %}
                            
                             {% set hutangsemua+= list.total_hutang %}
							 {% set bayarsemua+= list.Uang_masuk%}
							 {% set jubuk+= list.total_buku%}
							 {% set jusis+= list.Nominal%}
                           
                         
                             
                            <tr class="text-center">
                                <td> {{ loop.index }}</td>
                                <td> {{ list.TanggalTransaksi }}
								</td>
					
                                <td align='left' >{{ list.NoVA}}</td>
                                <td> {{ list.NamaSiswa }}</td>
                                <td>Rp {{list.Nominal |number_format(0,',','.')}}</td>
								
								{{ form("TransaksiSiswa/update", "method":"post")}}
								{{ hidden_field("ajaran","value":'1') }}
								{{ hidden_field("tahun","value":list.RecID) }}
								 {{ hidden_field("Area") }}
                                <td><button onclick="">2015|2016</button></td>
								{{ end_form() }}
								
								
								{{ form("TransaksiSiswa/update", "method":"post") }}
								{{ hidden_field("ajaran","value":'2') }}
								{{ hidden_field("tahun","value":list.RecID) }}
								 {{ hidden_field("Area") }}
								
								<td><button onclick="">2016|2017</button></td>
								{{end_form()}}
								
								
                          
                            </tr>
                            {% if loop.last %}
                               
							   
                            {% endif %}
                           
                        {% endfor %}
                 
                    {% endif %}
					{% set sumD4 += Nominal %}
					<tr>
						<th colspan='4' align='center'>Total</th>
						<th  align='center'>Rp {{jusis}}</th>
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
