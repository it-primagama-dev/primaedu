
{{ content() }}
{% set lastarea = '' %}{% set currarea = '' %}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
<table class="tablePrint" style="width:100%;">
    <tr>
        <td colspan="7">
            <table style="width:100%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="220"></td>
                    <td align="center" width="75%">
                        <h2><u>{{ rpt_title }}</u></h2>
                    </td>
                    <td width="20%" align="right">
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>
                        <a href="javascript::void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
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
</table>
<table class="table bordered hovered table2excel" style="table-layout: fixed; border-collapse: collapse">
    <thead>
        <th width="40px" rowspan="2">#</th>
            <th width="140px" rowspan="2">Nama Jenjang</th>
            <th width="520px" colspan="8">Tahun Ajaran</th>
            <tr>
            <b><td>2015/2016</td> <td>2016/2017</td> <td>2017/2018</td> <td>2018/2019</td> <td>2019/2020</td></b>
            </tr>
    </thead>

    <tbody>      
                <tr> 
                    <td>1</td>
                    <td> 3 SD </a></td>
                    <td class="text-center ">{% for list4  in result4  %}{% if list4.KodeJenjang=="47" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% else %}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="47" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="47" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                     <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="47" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                     <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="47" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                     
                </tr>

                <tr> 
                    <td>2</td>
                    <td> 4 SD </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="48" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="48" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="48" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="48" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="48" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>3</td>
                    <td>5 SD </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="49" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="49" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="49" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="49" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="49" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>4</td>
                    <td>6 SD </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="50" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="50" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="50" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="50" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="50" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>5</td>
                    <td>7 SMP </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="51" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="51" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="51" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="51" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="51" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>6</td>
                    <td>8 SMP </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="52" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="52" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="52" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="52" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="52" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>7</td>
                    <td>9 SMP </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="53" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="53" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="53" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="53" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="53" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>8</td>
                    <td> 10 SMA IPA </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="54" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="54" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="54" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="54" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="54" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>9</td>
                    <td> 10 SMA IPS </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="55" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="55" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="55" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="55" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="55" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>10</td>
                    <td> 11 SMA IPA </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="56" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="56" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="56" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="56" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="56" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>11</td>
                    <td>11 SMA IPS </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="57" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="57" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="57" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="57" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="57" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>12</td>
                    <td> 12 SMA IPA </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="58" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="58" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="58" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="58" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="58" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>13</td>
                    <td>  12 SMA IPS </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="59" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="59" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="59" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="59" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="59" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>14</td>
                    <td> 10 SMK TEKNIK </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="60" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="60" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="60" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="60" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="60" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>15</td>
                    <td>  10 SMK NON TEKNIK </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="61" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="61" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="61" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="61" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="61" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                
                <tr> 
                    <td>16</td>
                    <td> 12 SMK TEKNIK </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="64" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="64" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="64" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="64" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="64" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                 <tr> 
                    <td>17</td>
                    <td> 12 SMK NON TEKNIK </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="65" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="65" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="65" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="65" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="65" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                 <tr> 
                    <td>18</td>
                    <td> 12 SMA IPC </a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="66" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="66" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="66" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="66" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="66" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
                <tr> 
                    <td>19</td>
                    <td> 12 SMK</a></td>
                    <td class="text-center">{% for list4  in result4  %}{% if list4.KodeJenjang=="80" %}{% set sumjum1 += list4.jumlahSiswa %}{{list4.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list5  in result5  %}{% if list5.KodeJenjang=="80" %}{% set sumjum2 += list5.jumlahSiswa %}{{list5.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list6  in result6  %}{% if list6.KodeJenjang=="80" %}{% set sumjum3 += list6.jumlahSiswa %}{{list6.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list7  in result7  %}{% if list7.KodeJenjang=="80" %}{% set sumjum4 += list7.jumlahSiswa %}{{list7.jumlahSiswa}}{% endif %}{% endfor %}</td>
                    <td class="text-center">{% for list8  in result8  %}{% if list8.KodeJenjang=="80" %}{% set sumjum5 += list8.jumlahSiswa %}{{list8.jumlahSiswa}}{% endif %}{% endfor %}</td>
                </tr>
            <tr style="background: #f5f5f5;">
                <th colspan="2" class="text-right">Grand Total</th>
                <th class="text-center">{{ sumjum1|number_format(0,',','.') }}</th>
                <th class="text-center">{{ sumjum2|number_format(0,',','.') }}</th>
                <th class="text-center">{{ sumjum3|number_format(0,',','.') }}</th>
                <th class="text-center">{{ sumjum4|number_format(0,',','.') }}</th>
                <th class="text-center">{{ sumjum5|number_format(0,',','.') }}</th>
            </tr>
    </tbody>
    
</table>
{#
{% if page.total_pages > 1 %}
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div cla ss="place-right">
    {{ link_to("rptjenjangsiswa/view", "First", 'class':'button') }}
    {{ link_to("rptjenjangsiswa/view?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("rptjenjangsiswa/view?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("rptjenjangsiswa/view?page="~page.last, "Last", 'class':'button') }}
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
