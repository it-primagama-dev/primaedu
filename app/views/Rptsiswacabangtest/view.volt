
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
                        <th width="5%">#</th>
                        <th width="10%">No. Induk Siswa</th>
                        <th width="15%">Nama Siswa</th>
                        <th width="13%">Program</th>
                        <th width="12%">Total Biaya</th>
                        <th width="12%">Total Pembayaran</th>
                        <th width="12%">Total Discount</th>
                        <th width="12%">Total Hutang</th>
                         <th width="5%">Mengundurkan diri</th>
                        
                    {% set bim = 0 %}
                                        {% set va = 00000 %}
                    
                    </tr>
                </thead>
                <tbody>



                    {% if result2 is not empty %}
                        {% for list in result2 %}

                             {% set biaya+= list.JumlahTotal %}
                             {% set pembayaran+= list.Uang_masuk%}
                             {% set hutang+= list.Hutang_siswa%}
                             {% set diskon = list.uang%}
                            {% set subD8 += list.uang%}
                                
                                 {% set sisa = biaya-pembayaran-subD8%}
                                    
                                {% set hutangg+= sisa %}
                                {% set totsis=totsis+1 %}
                        {% endfor %}
                   
                    {% endif %}

                    {% set lines = '' %}
                    {% if result is not empty %}
                        {% for list in result %}
                            {% set currarea = list.VirtualAccount %}
                            {% if currarea != lastarea and not loop.first %}
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="4">Sub Total</td>
                                    <td class="text-center">Rp {{ subD1|number_format(0,',','.') }}</td>
                                    <td class="text-center">Rp {{ subD3|number_format(0,',','.') }}</td>
                                    <td class="text-center">Rp {{ subD11|number_format(0,',','.') }}</td>
                                    <td class="text-center">Rp {{ subD4|number_format(0,',','.') }}</td>
                                    <td></td>
                                    
                                
                                </tr>
                                
                                {% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
                            {% endif %}
                            {% set subD1 += list.JumlahTotal %}
                            {% set subD2 += list.Nominal %}
                            {% set subD3 = list.Uang_masuk %}
                            {% set subD11 = list.uang %}
                            {% set subD4 = subD1 - subD3 - list.uang %}
                            {% set subD5 += subD1 %}
                            {% set subD6 += subD3 %}
                            {% set subD7 += subD4 %}
                            {% set total1 += list.BiayaBimbingan%}
                            
                            
                            {% set sumD4 += list.TotalPembayaranVA %}
                            {% if currarea != lastarea %}
                            {% endif %}
                             {% set lines = list.ProgramSiswa %}
                            <tr class="text-center">
                            

                            {%if list.MD==1%}

                                <td>{{ loop.index }}</td>
                                <td>{{ list.VirtualAccount }}</td>
                                <td class="text-left">{{ list.NamaSiswa|upper }}</td>
                                <td class="text-left">{{ list.NamaProgram|upper}}</td>
                                <td class="text-center">Rp {{ list.JumlahTotal|number_format(0,',','.') }}</td>
                                <td class="text-center">-</td>
                                <td class="text-center">-</td>
                                <td class="text-center">-</td>
                                <td> Tidak</td>  
                                
                            </tr>


                                {% else %}

                                <td bgcolor='red'>{{ loop.index }}</td>
                                <td bgcolor='red'>{{ list.VirtualAccount }}</td>
                                <td class="text-left" bgcolor='red'>{{ list.NamaSiswa|upper }}</td>
                                <td class="text-left" bgcolor='red'>{{ list.NamaProgram|upper}}</td>
                                <td class="text-center" bgcolor='red'>Rp {{ list.JumlahTotal|number_format(0,',','.') }}</td>
                                <td class="text-center" bgcolor='red'>-</td>
                                <td class="text-center" bgcolor='red'>-</td>
                                <td class="text-center" bgcolor='red'>-</td>
                                
                                <td class="text-center" bgcolor='red'> Ya </td>
                                
                            </tr>


                                 {% endif %}

                            {% if loop.last %}
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="4">Sub Total</td>
                                    <td class="text-center">Rp {{ subD1|number_format(0,',','.') }}</td>
                                    <td class="text-center">Rp {{ subD3|number_format(0,',','.') }}</td>
                                    <td class="text-center">Rp {{ list.uang|number_format(0,',','.') }}</td>
                                    <td class="text-center">Rp {{ subD4|number_format(0,',','.') }}</td>
                                    <td></td>
                                    
                                
                                </tr>



                    <tr>
                        <th colspan='4' align='center'>Total</th>
                        <th  align='center' center>Rp {{biaya|number_format(0,',','.')}}</th>
                        <th  align='center' center>Rp {{pembayaran|number_format(0,',','.')}}</th>
                        <th  align='center' center>Rp {{subD8|number_format(0,',','.')}}</th>
                        <th  align='center' center colspan='2'>Rp {{sisa|number_format(0,',','.')}}</th>
                    </tr>
                    <tr>
                        <th colspan='4' align='center'>Total 11%</th>
                        {% set sebelas=pembayaran*11/100 %}
                        {% set sebelaspersen=biaya*11/100 %}
                        <th  align='center' center>Rp {{sebelaspersen|number_format(0,',','.')}}</th>
                        <th  align='center' center>Rp {{sebelas|number_format(0,',','.')}}</th>
                        <th  align='center' center>-</th>
                        <th  align='center' center colspan='2'> </th>
                        
                    </tr>
                    <tr>
                      <th colspan='4' align='center'>Fee Management</th>
                        {% if result1 is not empty %}
                        {% for listt in result1 %}
                        
                        <th  align='center' center>- </th>
                        <th align='center' center>Rp {{listt.Nominal|number_format(0,',','.')}}</th>
                        <th  align='center' center>-</th>
                        <th  align='center' center colspan='2'> </th>
                          {% endfor %}
                            {% endif %}
                           
                    </tr> 
                    <tr>
                        <th colspan='4' align='center'>GRAND TOTAL</th>
                        {% set TOTTAL = sebelas+ listt.Nominal%}
                        {% set Total = biaya*11/100 %}
                        {% set grandtot = (biaya*11/100)-TOTTAL%}
                        <th  align='center' center>Rp {{ Total |number_format(0,',','.')}}</th>
                        <th  align='center' center>Rp {{ TOTTAL |number_format(0,',','.')}}</th>
                        <th  align='center' center>-</th>
                        <th  align='center' center colspan='2'>Rp {{grandtot |number_format(0,',','.')}} </th>
                        
                    </tr>


                    <tr>
                        <th colspan='4' align='center'>Total siswa</th>
                        <th  align='center' colspan='5'> {{totsis}}</th>
                        
                    </tr>
                    {% if result3 is not empty %}
                        {% for list in result3 %}

                             {% set biayaaa += list.JumlahTotalmd %}
                             {% set pembayaranaa += list.Uang_masukmd %}

                        {% endfor %}
                    {% else %}

            {% endif %}
                        {% set sebelasaa=pembayaranaa*11/100 %}
                        {% set sebelaspersenaa=biayaaa*11/100 %}
                    
                        {% set TOTTALaa = sebelasaa + listt.Nominal%}
                        {% set grandtotaa = (biayaaa*11/100)-TOTTALaa%}
                    <tr>
                      <th colspan='4' align='center'>Total 11% Siswa MD</th>
                        
                        <th  align='center' center colspan='3'> </th>
                        <th  align='center' center colspan='2'> Rp {{grandtotaa |number_format(0,',','.')}}</th>
                           
                    </tr> 

                    {% set grandtothutang = grandtot - grandtotaa %}
                    <tr>
                      <th colspan='4' align='center'>Grand Total Hutang</th>
                        
                        <th  align='center' center colspan='3'> </th>
                        <th  align='center' center colspan='2'> Rp {{grandtothutang |number_format(0,',','.')}} </th>
                           
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
