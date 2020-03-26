 
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}{% set sumD4 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}{% set subD4 = 0 %}
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
                        <th >Nama Cabang</th>
                        <th >Jumlah Siswa</th>
                        <th >Total Biaya Bimbingan</th>
            <th>Total Pembayaran</th>
                <th >Total Biaya Bimbingan MD</th>
                <th >Diskon</th>    
                  <th >Sisa Hutang </th>  
                  <th>Tanggal Berakhir</th> 
                    </tr>
                </thead>
                <tbody>
                    {% if result is not empty %}
                        {% for list in result %}
                            
                             {% set hutangsemua+= list.hutang_MD %}
                             {% set bayarsemua+= list.Uang_masuk%}
                             {% set jubuk+= list.total_buku%}
                             {% set jusis+= list.total_siswa%}
                            {% set sumjummd0+= list.hutangg%}
                         
                             
                            <tr class="text-center">
                                <td> {{ loop.index }}</td>

                                <td> {{ list.KodeAreaCabang }}
                                </td>
                    
                                <td align='left' >{{ list.namacb}}</td>
                                <td>{{ list.total_siswa }}</td>
                                <td>
                                Rp {{list.hutang_MD|number_format(0,',','.')}}</td>
                                 {% if list.Uang_masuk=='' %}
                                    <td >0</td>
                                 
                                 {%else%}
                                    <td>
                                    
                                    <a href="{{ url('Rptsiswapiutangcabang/view?cabang='~list.RecID)}}">
                                    Rp {{list.Uang_masuk|number_format(0,',','.') }}</a>
                                     
                                 </td>
                                    
                                 
                                 {% endif %}
                                 
                                 {% set hutang= list.hutang_MD -list.Uang_masuk%}
                                 {% set sisa+= hutang%}
                                
                                
                                
                                <td BGCOLOR="orange">Rp {{list.hutangg|number_format(0,',','.')}}</td>
                                <td >{% set sumdiskon+=list.diskon %}Rp {{list.diskon|number_format(0,',','.')}}</td>
                                <td>Rp.{% set penhut=list.hutang_MD %}{% set penhutmd=list.hutangg %}{% set penhutbayar=list.Uang_masuk %}{% set pendisk=list.diskon %}  
                                {% set penhuttot=penhut-penhutmd-penhutbayar-pendisk %}{{penhuttot |number_format(0,',','.') }}{% set penhutsel+=penhuttot%}</td>
                                <td >{{list.TanggalBerakhir}}</td>
                            {% if loop.last %}
                               
                               
                            {% endif %}
                           
                        {% endfor %}
                        {% for list in result1 %}
                                 <td> Rp {{list.hutang_siswa_md|number_format(0,',','.')}}</td>
                                 {% endfor %}
                    {% endif %}
                    <tr>
                        <th colspan='3' align='center'>Total</th>
                        
                        <th  align='center'>{{jusis}}</th>
                        <th  align='center'>
                        Rp {{hutangsemua|number_format(0,',','.')}}</th>
                        <th  align='center'>
                        Rp {{bayarsemua|number_format(0,',','.')}}</th>
                    
                        <th  align='center'>Rp.{{sumjummd0|number_format(0,',','.')}}</th>
                        <th> Rp.{{sumdiskon|number_format(0,',','.')}}</th>
                        <th  align='center'>Rp.{{penhutsel|number_format(0,',','.')}}</th>
                        <th></th>
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
