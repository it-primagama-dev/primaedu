
{{ content() }}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
    table.scroll {width:140%; border:1px #a9c6c9 solid;font:10px verdana,arial,sans-serif;color:#333333;}
    table.scroll thead {display:table;width:100%;}
    table.scroll tbody {display:block;height:570px;overflow:auto;float:left;width:100%;}
    table.scroll th {background-color:#000099;color:#ffffff;}
</style>
{% set lines = '' %}
<table class="tablePrint" style="width:1340px">
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
                        <h3 style="margin: 4px 0">Area : {{ rpt_area }}
                    Cabang: {% for list  in result1  %}{{ list.KodeAreaCabang}}- {{ list.NamaAreaCabang}}{% endfor %}</h3>
                    </td>
                </tr>
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="7"><hr color="#000000"/></td>
    </tr>
    <tr>
    <table class="table bordered hovered table2excel" style="width: 135%;  border-collapse: collapse">
          <thead>
          <tr bgcolor=6495ED>
          <th style="width: 13%; ">Uraian / Keterangan </th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20171)}}" target="_blank"> Jan 17 </a> </th>
          <th> <a href="{{ url('Rptlaporancashinoutdetail/view/'~20172)}}" target="_blank">Feb 17 </a> </th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20173)}}" target="_blank">Mar 17</a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20174)}}" target="_blank">Apr 17</a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20175)}}" target="_blank">May 17</a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20176)}}" target="_blank">Jun 17</a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20177)}}" target="_blank">Jul 17</a></th> 
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20178)}}" target="_blank">Aug 17</a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20179)}}" target="_blank">Sep 17</a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~201710)}}" target="_blank">Oct 17</a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~201711)}}" target="_blank">Nov 17</a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~201712)}}" target="_blank">Dec 17</a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20181)}}" target="_blank">Jan 18 </a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20182)}}" target="_blank">Feb 18 </a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20183)}}" target="_blank">Mar 18 </a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20184)}}" target="_blank">Apr 18 </a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20185)}}" target="_blank">May 18 </a></th>
          <th><a href="{{ url('Rptlaporancashinoutdetail/view/'~20186)}}" target="_blank">Jun 18 </a></th>
          <th>Total</th>
          </tr>
          </thead>
         <tbody>
   <tr style="background-color:#000099; color:#ffffff">
    <th>I. CASH IN</t>
  </tr>
      <tr>
          <td>{% for list in resulttype %}{% if list.RecId=="TP-01"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result3 %}{% if list.bln=="1" and list.tahun=="2017" %}{% set sum41 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="2" and list.tahun=="2017" %}{% set sum42 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="3" and list.tahun=="2017" %}{% set sum43 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="4" and list.tahun=="2017" %}{% set sum44 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="5" and list.tahun=="2017" %}{% set sum45 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="6" and list.tahun=="2017" %}{% set sum46 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="7" and list.tahun=="2017"%}{% set sum47 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="8" and list.tahun=="2017" %}{% set sum48 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="9" and list.tahun=="2017" %}{% set sum49 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="10" and list.tahun=="2017" %}{% set sum410 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="11" and list.tahun=="2017" %}{% set sum411 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="12" and list.tahun=="2017" %}{% set sum412 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="1" and list.tahun=="2018" %}{% set sum413 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="2" and list.tahun=="2018" %}{% set sum414 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="3" and list.tahun=="2018" %}{% set sum415 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="4" and list.tahun=="2018" %}{% set sum416 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="5" and list.tahun=="2018" %}{% set sum417 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result3 %}{% if list.bln=="6" and list.tahun=="2018" %}{% set sum418 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum4a=sum41+sum42+sum43+sum44+sum45+sum46+sum47+sum48+sum49+sum410+sum411+sum412+sum413+sum414+sum415+sum416+sum417+sum418 %}
           <td>{{ sum4a|number_format(0,',','.')}}</td>
      </tr>

      <tr>
          <td>{% for list in resulttype %}{% if list.RecId=="TP-02"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-02"%}{% set sum51 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-02"%}{% set sum52 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-02"%}{% set sum53 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-02"%}{% set sum54 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-02"%}{% set sum55 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-02"%}{% set sum56 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-02"%}{% set sum57 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-02"%}{% set sum58 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-02"%}{% set sum59 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-02"%}{% set sum510 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-02"%}{% set sum511 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-02"%}{% set sum512 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-02"%}{% set sum513 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-02"%}{% set sum514 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-02"%}{% set sum515 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-02"%}{% set sum516 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-02"%}{% set sum517 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-02"%}{% set sum518 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum5a=sum51+sum52+sum53+sum54+sum55+sum56+sum57+sum58+sum59+sum510+sum511+sum512+sum513+sum514+sum515+sum516+sum517+sum518 %}
           <td>{{ sum5a|number_format(0,',','.')}}</td>
      </tr>
      <tr>
          <td>{% for list in resulttype %}{% if list.RecId=="TP-03"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-03"%}{% set sum61 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-03"%}{% set sum62 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-03"%}{% set sum63 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-03"%}{% set sum64 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-03"%}{% set sum65 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-03"%}{% set sum66 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-03"%}{% set sum67 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-03"%}{% set sum68 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-03"%}{% set sum69 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-03"%}{% set sum610 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-03"%}{% set sum611 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-03"%}{% set sum612 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-03"%}{% set sum613 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-03"%}{% set sum614 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-03"%}{% set sum615 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-03"%}{% set sum616 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-03"%}{% set sum617 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-03"%}{% set sum618 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum6a=sum61+sum62+sum63+sum64+sum65+sum66+sum67+sum68+sum69+sum610+sum611+sum612+sum613+sum614+sum615+sum616+sum617+sum618 %}
           <td>{{ sum6a|number_format(0,',','.')}}</td>
      </tr>
     
    <tr style="background-color: aqua;">
        <td>Jumlah Cash In</td>
      <td>{% set sum1b=sum41+sum51+sum61 %}{{ sum1b|number_format(0,',','.')}}</td>
      <td>{% set sum2b=sum42+sum52+sum62 %}{{ sum2b|number_format(0,',','.')}}</td>
      <td>{% set sum3b=sum43+sum53+sum63 %}{{ sum3b|number_format(0,',','.')}}</td>
      <td>{% set sum4b=sum44+sum54+sum64 %}{{ sum4b|number_format(0,',','.')}}</td>
      <td>{% set sum5b=sum45+sum55+sum65 %}{{ sum5b|number_format(0,',','.')}}</td>
      <td>{% set sum6b=sum46+sum56+sum66 %}{{ sum6b|number_format(0,',','.')}}</td>
      <td>{% set sum7b=sum47+sum57+sum67 %}{{ sum7b|number_format(0,',','.')}}</td>
      <td>{% set sum8b=sum48+sum58+sum68 %}{{ sum8b|number_format(0,',','.')}}</td>
      <td>{% set sum9b=sum49+sum59+sum69 %}{{ sum9b|number_format(0,',','.')}}</td>
      <td>{% set sum10b=sum410+sum510+sum610 %}{{ sum10b|number_format(0,',','.')}}</td>
      <td>{% set sum11b=sum411+sum511+sum611 %}{{ sum11b|number_format(0,',','.')}}</td>
      <td>{% set sum12b=sum412+sum512+sum612 %}{{ sum12b|number_format(0,',','.')}}</td>
      <td>{% set sum13b=sum413+sum513+sum613 %}{{ sum13b|number_format(0,',','.')}}</td>
      <td>{% set sum14b=sum414+sum514+sum614 %}{{ sum14b|number_format(0,',','.')}}</td>
      <td>{% set sum15b=sum415+sum515+sum615 %}{{ sum15b|number_format(0,',','.')}}</td>
      <td>{% set sum16b=sum416+sum516+sum616 %}{{ sum16b|number_format(0,',','.')}}</td>
      <td>{% set sum17b=sum417+sum517+sum617 %}{{ sum17b|number_format(0,',','.')}}</td>
      <td>{% set sum18b=sum418+sum518+sum618 %}{{ sum18b|number_format(0,',','.')}}</td>
      <td>{% set sum19b=sum4a+sum5a+sum6a %}{{ sum19b|number_format(0,',','.')}}</td>
      </tr>

    <tr style="background-color:#000099; color:#ffffff">
    <th>II. CASH OUT</th>
  </tr>
      <tr>
      <td>{% for list in resulttype %}{% if list.RecId=="TP-04"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-04"%}{% set sum71 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-04"%}{% set sum72 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-04"%}{% set sum73 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-04"%}{% set sum74 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-04"%}{% set sum75 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-04"%}{% set sum76 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-04"%}{% set sum77 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-04"%}{% set sum78 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-04"%}{% set sum79 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-04"%}{% set sum710 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-04"%}{% set sum711 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-04"%}{% set sum712 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-04"%}{% set sum713 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-04"%}{% set sum714 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-04"%}{% set sum715 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-04"%}{% set sum716 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-04"%}{% set sum717 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-04"%}{% set sum718 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum7a=sum71+sum72+sum73+sum74+sum75+sum76+sum77+sum78+sum79+sum710+sum711+sum712+sum713+sum714+sum715+sum716+sum717+sum718 %}
           <td>{{ sum7a|number_format(0,',','.')}}</td>
      </tr>
       <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-05"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-05"%}{% set sum81 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-05"%}{% set sum82 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-05"%}{% set sum83 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-05"%}{% set sum84 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-05"%}{% set sum85 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-05"%}{% set sum86 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-05"%}{% set sum87 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-05"%}{% set sum88 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-05"%}{% set sum89 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-05"%}{% set sum810 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-05"%}{% set sum811 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-05"%}{% set sum812 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-05"%}{% set sum813 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-05"%}{% set sum814 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-05"%}{% set sum815 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-05"%}{% set sum816 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-05"%}{% set sum817 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-05"%}{% set sum818 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum8a=sum81+sum82+sum83+sum84+sum85+sum86+sum87+sum88+sum89+sum810+sum811+sum812+sum813+sum814+sum815+sum816+sum817+sum818 %}
           <td>{{ sum8a|number_format(0,',','.')}}</td>
      </tr>
       <tr>
          <td>Management Fee 10% + 1% PPN</td>
          <td>{% for list in result4 %}{% if list.bln=="1" and list.tahun=="2017" %}{% set sum91 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="2" and list.tahun=="2017" %}{% set sum92 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="3" and list.tahun=="2017" %}{% set sum93 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="4" and list.tahun=="2017" %}{% set sum94 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="5" and list.tahun=="2017" %}{% set sum95 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="6" and list.tahun=="2017" %}{% set sum96 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="7" and list.tahun=="2017"%}{% set sum97 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="8" and list.tahun=="2017" %}{% set sum98 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="9" and list.tahun=="2017" %}{% set sum99 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="10" and list.tahun=="2017" %}{% set sum910 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="11" and list.tahun=="2017" %}{% set sum911 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="12" and list.tahun=="2017" %}{% set sum912 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="1" and list.tahun=="2018" %}{% set sum913 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="2" and list.tahun=="2018" %}{% set sum914 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="3" and list.tahun=="2018" %}{% set sum915 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="4" and list.tahun=="2018" %}{% set sum916 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="5" and list.tahun=="2018" %}{% set sum917 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result4 %}{% if list.bln=="6" and list.tahun=="2018" %}{% set sum918 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum9a=sum91+sum92+sum93+sum94+sum95+sum96+sum97+sum98+sum99+sum910+sum911+sum912+sum913+sum914+sum915+sum916+sum917+sum918 %}
           <td>{{ sum9a|number_format(0,',','.')}}</td>
      </tr>
       <tr>
   <tr style="background-color: aqua;">
    <td>Jumlah Cash Out</td>
    <td>{% set sum1c=sum71+sum81+sum91%}{{ sum1c|number_format(0,',','.')}}</td>
    <td>{% set sum2c=sum72+sum82+sum92%}{{ sum2c|number_format(0,',','.')}}</td>
    <td>{% set sum3c=sum73+sum83+sum93%}{{ sum3c|number_format(0,',','.')}}</td>
    <td>{% set sum4c=sum74+sum84+sum94%}{{ sum4c|number_format(0,',','.')}}</td>
    <td>{% set sum5c=sum75+sum85+sum95%}{{ sum5c|number_format(0,',','.')}}</td>
    <td>{% set sum6c=sum76+sum86+sum96%}{{ sum6c|number_format(0,',','.')}}</td>
    <td>{% set sum7c=sum77+sum87+sum97%}{{ sum7c|number_format(0,',','.')}}</td>
    <td>{% set sum8c=sum78+sum88+sum98%}{{ sum8c|number_format(0,',','.')}}</td>
    <td>{% set sum9c=sum79+sum89+sum99%}{{ sum9c|number_format(0,',','.')}}</td>
    <td>{% set sum10c=sum710+sum810+sum910%}{{ sum10c|number_format(0,',','.')}}</td>
    <td>{% set sum11c=sum711+sum811+sum911%}{{ sum11c|number_format(0,',','.')}}</td>
    <td>{% set sum12c=sum712+sum812+sum912%}{{ sum12c|number_format(0,',','.')}}</td>
    <td>{% set sum13c=sum713+sum813+sum913%}{{ sum13c|number_format(0,',','.')}}</td>
    <td>{% set sum14c=sum714+sum814+sum914%}{{ sum14c|number_format(0,',','.')}}</td>
    <td>{% set sum15c=sum715+sum815+sum915%}{{ sum15c|number_format(0,',','.')}}</td>
    <td>{% set sum16c=sum716+sum816+sum916%}{{ sum16c|number_format(0,',','.')}}</td>
    <td>{% set sum17c=sum717+sum817+sum917%}{{ sum17c|number_format(0,',','.')}}</td>
    <td>{% set sum18c=sum718+sum818+sum918%}{{ sum18c|number_format(0,',','.')}}</td>
    <td>{% set sum19c=sum7a+sum8a+sum9a%}{{ sum19c|number_format(0,',','.')}}</td>
  </tr>
   <tr>
    <td><B>A. AKTIVA TETAP</B></td>
      </tr>
       <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-08"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2%}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-08"%}{% set sum101 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-08"%}{% set sum102 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-08"%}{% set sum103 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-08"%}{% set sum104 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-08"%}{% set sum105 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-08"%}{% set sum106 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-08"%}{% set sum107 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-08"%}{% set sum108 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-08"%}{% set sum109 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-08"%}{% set sum1010 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-08"%}{% set sum1011 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-08"%}{% set sum1012 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-08"%}{% set sum1013 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-08"%}{% set sum1014 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-08"%}{% set sum1015 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-08"%}{% set sum1016 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-08"%}{% set sum1017 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2%}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-08"%}{% set sum1018 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum10a=sum101+sum102+sum103+sum104+sum105+sum106+sum107+sum108+sum109+sum1010+sum1011+sum1012+sum1013+sum1014+sum1015+sum1016+sum1017+sum1018 %}
           <td>{{ sum10a|number_format(0,',','.')}}</td>
      </tr>
      <tr>
      <td><B>B. KEWAJIBAN KEUANGAN</B></td>
      </tr>
       <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-06"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-06"%}{% set sum111 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-06"%}{% set sum112 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-06"%}{% set sum113 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-06"%}{% set sum114 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-06"%}{% set sum115 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-06"%}{% set sum116 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-06"%}{% set sum117 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-06"%}{% set sum118 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-06"%}{% set sum119 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-06"%}{% set sum1110 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-06"%}{% set sum1111 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-06"%}{% set sum1112 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-06"%}{% set sum1113 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-06"%}{% set sum1114 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-06"%}{% set sum1115 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-06"%}{% set sum1116 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-06"%}{% set sum1117 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-06"%}{% set sum1118 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum11a=sum111+sum112+sum113+sum114+sum115+sum116+sum117+sum118+sum119+sum1110+sum1111+sum1112+sum1113+sum1114+sum1115+sum1116+sum1117+sum1118 %}
           <td>{{ sum11a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-07"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-07"%}{% set sum121 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-07"%}{% set sum122 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-07"%}{% set sum123 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-07"%}{% set sum124 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-07"%}{% set sum125 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-07"%}{% set sum126 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-07"%}{% set sum127 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-07"%}{% set sum128 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-07"%}{% set sum129 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-07"%}{% set sum1210 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-07"%}{% set sum1211 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-07"%}{% set sum1212 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-07"%}{% set sum1213 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-07"%}{% set sum1214 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-07"%}{% set sum1215 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-07"%}{% set sum1216 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-07"%}{% set sum1217 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-07"%}{% set sum1218 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum12a=sum121+sum122+sum123+sum124+sum125+sum126+sum127+sum128+sum129+sum1210+sum1211+sum1212+sum1213+sum1214+sum1215+sum1216+sum1217+sum1218 %}
           <td>{{ sum12a|number_format(0,',','.')}}</td>
      </tr>
             
      <tr style="background-color: aqua;">
    <td>Jumlah Cash Out A & B</td>
    <td>{% set sum1d=sum101+sum111+sum121+sum131%}{{ sum1d|number_format(0,',','.')}}</td>
    <td>{% set sum2d=sum102+sum112+sum122+sum132%}{{ sum2d|number_format(0,',','.')}}</td>
    <td>{% set sum3d=sum103+sum113+sum123+sum133%}{{ sum3d|number_format(0,',','.')}}</td>
    <td>{% set sum4d=sum104+sum114+sum124+sum134%}{{ sum4d|number_format(0,',','.')}}</td>
    <td>{% set sum5d=sum105+sum115+sum125+sum135%}{{ sum5d|number_format(0,',','.')}}</td>
    <td>{% set sum6d=sum106+sum116+sum126+sum136%}{{ sum6d|number_format(0,',','.')}}</td>
    <td>{% set sum7d=sum107+sum117+sum127+sum137%}{{ sum7d|number_format(0,',','.')}}</td>
    <td>{% set sum8d=sum108+sum118+sum128+sum138%}{{ sum8d|number_format(0,',','.')}}</td>
    <td>{% set sum9d=sum109+sum119+sum129+sum139%}{{ sum9d|number_format(0,',','.')}}</td>
    <td>{% set sum10d=sum1010+sum1110+sum1210+sum1310%}{{ sum10d|number_format(0,',','.')}}</td>
    <td>{% set sum11d=sum1011+sum1111+sum1211+sum1311%}{{ sum11d|number_format(0,',','.')}}</td>
    <td>{% set sum12d=sum1012+sum1112+sum1212+sum1312%}{{ sum12d|number_format(0,',','.')}}</td>
    <td>{% set sum13d=sum1013+sum1113+sum1213+sum1313%}{{ sum13d|number_format(0,',','.')}}</td>
    <td>{% set sum14d=sum1014+sum1114+sum1214+sum1314%}{{ sum14d|number_format(0,',','.')}}</td>
    <td>{% set sum15d=sum1015+sum1115+sum1215+sum1315%}{{ sum15d|number_format(0,',','.')}}</td>
    <td>{% set sum16d=sum1016+sum1116+sum1216+sum1316%}{{ sum16d|number_format(0,',','.')}}</td>
    <td>{% set sum17d=sum1017+sum1117+sum1217+sum1317%}{{ sum17d|number_format(0,',','.')}}</td>
    <td>{% set sum18d=sum1018+sum1118+sum1218+sum1318%}{{ sum18d|number_format(0,',','.')}}</td>
    <td>{% set sum19d=sum10a+sum11a+sum12a+sum13a%}{{ sum19d|number_format(0,',','.')}}</td>
  </tr>
  <tr>
        <td><b>JUMLAH DANA OPERASIONAL</b></td>
      <td>{% set sum1b1=sum1b-sum1c-sum1d %}{{ sum1b1|number_format(0,',','.')}}</td>
      <td>{% set sum2b1=sum2b-sum2c-sum2d %}{{ sum2b1|number_format(0,',','.')}}</td>
      <td>{% set sum3b1=sum3b-sum3c-sum3d %}{{ sum3b1|number_format(0,',','.')}}</td>
      <td>{% set sum4b1=sum4b-sum4c-sum4d %}{{ sum4b1|number_format(0,',','.')}}</td>
      <td>{% set sum5b1=sum5b-sum5c-sum5d %}{{ sum5b1|number_format(0,',','.')}}</td>
      <td>{% set sum6b1=sum6b-sum6c-sum6d %}{{ sum6b1|number_format(0,',','.')}}</td>
      <td>{% set sum7b1=sum7b-sum7c-sum7d %}{{ sum7b1|number_format(0,',','.')}}</td>
      <td>{% set sum8b1=sum8b-sum8c-sum8d %}{{ sum8b1|number_format(0,',','.')}}</td>
      <td>{% set sum9b1=sum9b-sum9c-sum9d %}{{ sum9b1|number_format(0,',','.')}}</td>
      <td>{% set sum10b1=sum10b-sum10c-sum10d %}{{ sum10b1|number_format(0,',','.')}}</td>
      <td>{% set sum11b1=sum11b-sum11c-sum11d %}{{ sum11b1|number_format(0,',','.')}}</td>
      <td>{% set sum12b1=sum12b-sum12c-sum12d %}{{ sum12b1|number_format(0,',','.')}}</td>
      <td>{% set sum13b1=sum13b-sum13c-sum13d %}{{ sum13b1|number_format(0,',','.')}}</td>
      <td>{% set sum14b1=sum14b-sum14c-sum14d %}{{ sum14b1|number_format(0,',','.')}}</td>
      <td>{% set sum15b1=sum15b-sum15c-sum15d %}{{ sum15b1|number_format(0,',','.')}}</td>
      <td>{% set sum16b1=sum16b-sum16c-sum16d %}{{ sum16b1|number_format(0,',','.')}}</td>
      <td>{% set sum17b1=sum17b-sum17c-sum17d %}{{ sum17b1|number_format(0,',','.')}}</td>
      <td>{% set sum18b1=sum18b-sum18c-sum18d %}{{ sum18b1|number_format(0,',','.')}}</td>
      <td>{% set sum19b1=sum19b-sum19c-sum19d %}{{ sum19b1|number_format(0,',','.')}}</td>
      </tr>
      <tr>
      <td><B>C. BIAYA OPERASIONAL</B></td>
      </tr>
      <tr>
      <td><B>1. BIAYA PEMASARAN</B></td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-09"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-09"%}{% set sum141 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-09"%}{% set sum142 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-09"%}{% set sum143 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-09"%}{% set sum144 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-09"%}{% set sum145 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-09"%}{% set sum146 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-09"%}{% set sum147 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-09"%}{% set sum148 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-09"%}{% set sum149 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-09"%}{% set sum1410 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-09"%}{% set sum1411 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-09"%}{% set sum1412 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-09"%}{% set sum1413 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-09"%}{% set sum1414 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-09"%}{% set sum1415 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-09"%}{% set sum1416 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-09"%}{% set sum1417 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-09"%}{% set sum1418 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum14a=sum141+sum142+sum143+sum144+sum145+sum146+sum147+sum148+sum149+sum1410+sum1411+sum1412+sum1413+sum1414+sum1415+sum1416+sum1417+sum1418 %}
           <td>{{ sum14a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-10"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-10"%}{% set sum151 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-10"%}{% set sum152 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-10"%}{% set sum153 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-10"%}{% set sum154 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-10"%}{% set sum155 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-10"%}{% set sum156 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-10"%}{% set sum157 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-10"%}{% set sum158 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-10"%}{% set sum159 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-10"%}{% set sum1510 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-10"%}{% set sum1511 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-10"%}{% set sum1512 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-10"%}{% set sum1513 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-10"%}{% set sum1514 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-10"%}{% set sum1515 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-10"%}{% set sum1516 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-10"%}{% set sum1517 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-10"%}{% set sum1518 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum15a=sum151+sum152+sum153+sum154+sum155+sum156+sum157+sum158+sum159+sum1510+sum1511+sum1512+sum1513+sum1514+sum1515+sum1516+sum1517+sum1518 %}
           <td>{{ sum15a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-11"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-11"%}{% set sum161 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-11"%}{% set sum162 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-11"%}{% set sum163 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-11"%}{% set sum164 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-11"%}{% set sum165 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-11"%}{% set sum166 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-11"%}{% set sum167 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-11"%}{% set sum168 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-11"%}{% set sum169 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-11"%}{% set sum1610 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-11"%}{% set sum1611 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-11"%}{% set sum1612 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-11"%}{% set sum1613 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-11"%}{% set sum1614 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-11"%}{% set sum1615 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-11"%}{% set sum1616 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-11"%}{% set sum1617 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-11"%}{% set sum1618 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum16a=sum161+sum162+sum163+sum164+sum165+sum166+sum167+sum168+sum169+sum1610+sum1611+sum1612+sum1613+sum1614+sum1615+sum1616+sum1617+sum1618 %}
           <td>{{ sum16a|number_format(0,',','.')}}</td>
      </tr>
     
      <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-12"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-12"%}{% set sum171 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-12"%}{% set sum172 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-12"%}{% set sum173 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-12"%}{% set sum174 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-12"%}{% set sum175 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-12"%}{% set sum176 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-12"%}{% set sum177 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-12"%}{% set sum178 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-12"%}{% set sum179 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-12"%}{% set sum1710 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-12"%}{% set sum1711 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-12"%}{% set sum1712 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-12"%}{% set sum1713 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-12"%}{% set sum1714 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-12"%}{% set sum1715 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-12"%}{% set sum1716 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-12"%}{% set sum1717 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-12"%}{% set sum1718 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum17a=sum171+sum172+sum173+sum174+sum175+sum176+sum177+sum178+sum179+sum1710+sum1711+sum1712+sum1713+sum1714+sum1715+sum1716+sum1717+sum1718 %}
           <td>{{ sum17a|number_format(0,',','.')}}</td>
      </tr>
       <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-31"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-31"%}{% set sum391 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-31"%}{% set sum392 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-31"%}{% set sum393 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-31"%}{% set sum394 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-31"%}{% set sum395 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-31"%}{% set sum396 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-31"%}{% set sum397 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-31"%}{% set sum398 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-31"%}{% set sum399 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-31"%}{% set sum3910 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-31"%}{% set sum3911 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-31"%}{% set sum3912 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-31"%}{% set sum3913 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-31"%}{% set sum3914 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-31"%}{% set sum3915 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-31"%}{% set sum3916 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-31"%}{% set sum3917 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-31"%}{% set sum3918 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum39a=sum391+sum392+sum393+sum394+sum395+sum396+sum397+sum398+sum399+sum3910+sum3911+sum3912+sum3913+sum3914+sum3915+sum3916+sum3917+sum3918 %}
           <td>{{ sum39a|number_format(0,',','.')}}</td>
      </tr>
      
      <tr style="background-color: aqua;">
        <td>Jumlah Biaya Pemasaran </td>
        <td>{% set sum1e=sum141+sum151+sum161+sum171+sum391%}{{ sum1e|number_format(0,',','.')}}</td>
        <td>{% set sum2e=sum142+sum152+sum162+sum172+sum392%}{{ sum2e|number_format(0,',','.')}}</td>
        <td>{% set sum3e=sum143+sum153+sum163+sum173+sum393%}{{ sum3e|number_format(0,',','.')}}</td>
        <td>{% set sum4e=sum144+sum154+sum164+sum174+sum394%}{{ sum4e|number_format(0,',','.')}}</td>
        <td>{% set sum5e=sum145+sum155+sum165+sum175+sum395%}{{ sum5e|number_format(0,',','.')}}</td>
        <td>{% set sum6e=sum146+sum156+sum166+sum176+sum396%}{{ sum6e|number_format(0,',','.')}}</td>
        <td>{% set sum7e=sum147+sum157+sum167+sum177+sum397%}{{ sum7e|number_format(0,',','.')}}</td>
        <td>{% set sum8e=sum148+sum158+sum168+sum178+sum398%}{{ sum8e|number_format(0,',','.')}}</td>
        <td>{% set sum9e=sum149+sum159+sum169+sum179+sum399%}{{ sum9e|number_format(0,',','.')}}</td>
        <td>{% set sum10e=sum1410+sum1510+sum1610+sum1710+sum3910%}{{ sum10e|number_format(0,',','.')}}</td>
        <td>{% set sum11e=sum1411+sum1511+sum1611+sum1711+sum3911%}{{ sum11e|number_format(0,',','.')}}</td>
        <td>{% set sum12e=sum1412+sum1512+sum1612+sum1712+sum3912%}{{ sum12e|number_format(0,',','.')}}</td>
        <td>{% set sum13e=sum1413+sum1513+sum1613+sum1713+sum3913%}{{ sum13e|number_format(0,',','.')}}</td>
        <td>{% set sum14e=sum1414+sum1514+sum1614+sum1714+sum3914%}{{ sum14e|number_format(0,',','.')}}</td>
        <td>{% set sum15e=sum1415+sum1515+sum1615+sum1715+sum3915%}{{ sum15e|number_format(0,',','.')}}</td>
        <td>{% set sum16e=sum1416+sum1516+sum1616+sum1716+sum3916%}{{ sum16e|number_format(0,',','.')}}</td>
        <td>{% set sum17e=sum1417+sum1517+sum1617+sum1717+sum3917%}{{ sum17e|number_format(0,',','.')}}</td>
        <td>{% set sum18e=sum1418+sum1518+sum1618+sum1718+sum3918%}{{ sum18e|number_format(0,',','.')}}</td>
        <td>{% set sum19e=sum14a+sum15a+sum16a+sum17a+sum39a%}{{ sum19e|number_format(0,',','.')}}</td>
      </tr>
       <tr>
      <td><B>2. BIAYA AKADEMIK</B></td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-13"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-13"%}{% set sum181 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-13"%}{% set sum182 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-13"%}{% set sum183 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-13"%}{% set sum184 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-13"%}{% set sum185 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-13"%}{% set sum186 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-13"%}{% set sum187 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-13"%}{% set sum188 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-13"%}{% set sum189 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-13"%}{% set sum1810 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-13"%}{% set sum1811 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-13"%}{% set sum1812 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-13"%}{% set sum1813 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-13"%}{% set sum1814 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-13"%}{% set sum1815 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-13"%}{% set sum1816 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-13"%}{% set sum1817 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-13"%}{% set sum1818 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum18a=sum181+sum182+sum183+sum184+sum185+sum186+sum187+sum188+sum189+sum1810+sum1811+sum1812+sum1813+sum1814+sum1815+sum1816+sum1817+sum1818 %}
           <td>{{ sum18a|number_format(0,',','.')}}</td>
      </tr>
      <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-14"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-14"%}{% set sum191 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-14"%}{% set sum192 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-14"%}{% set sum193 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-14"%}{% set sum194 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-14"%}{% set sum195 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-14"%}{% set sum196 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-14"%}{% set sum197 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-14"%}{% set sum198 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-14"%}{% set sum199 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-14"%}{% set sum1910 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-14"%}{% set sum1911 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-14"%}{% set sum1912 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-14"%}{% set sum1913 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-14"%}{% set sum1914 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-14"%}{% set sum1915 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-14"%}{% set sum1916 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-14"%}{% set sum1917 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-14"%}{% set sum1918 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum19a=sum191+sum192+sum193+sum194+sum195+sum196+sum197+sum198+sum199+sum1910+sum1911+sum1912+sum1913+sum1914+sum1915+sum1916+sum1917+sum1918 %}
           <td>{{ sum19a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-15"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-15"%}{% set sum201 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-15"%}{% set sum202 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-15"%}{% set sum203 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-15"%}{% set sum204 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-15"%}{% set sum205 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-15"%}{% set sum206 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-15"%}{% set sum207 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-15"%}{% set sum208 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-15"%}{% set sum209 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-15"%}{% set sum2010 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-15"%}{% set sum2011 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-15"%}{% set sum2012 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-15"%}{% set sum2013 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-15"%}{% set sum2014 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-15"%}{% set sum2015 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-15"%}{% set sum2016 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-15"%}{% set sum2017 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-15"%}{% set sum2018 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum20a=sum201+sum202+sum203+sum204+sum205+sum206+sum207+sum208+sum209+sum2010+sum2011+sum2012+sum2013+sum2014+sum2015+sum2016+sum2017+sum2018 %}
           <td>{{ sum20a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-16"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-16"%}{% set sum211 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-16"%}{% set sum212 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-16"%}{% set sum213 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-16"%}{% set sum214 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-16"%}{% set sum215 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-16"%}{% set sum216 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-16"%}{% set sum217 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-16"%}{% set sum218 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-16"%}{% set sum219 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-16"%}{% set sum2110 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-16"%}{% set sum2111 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-16"%}{% set sum2112 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-16"%}{% set sum2113 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-16"%}{% set sum2114 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-16"%}{% set sum2115 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-16"%}{% set sum2116 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-16"%}{% set sum2117 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-16"%}{% set sum2118 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum21a=sum211+sum212+sum213+sum214+sum215+sum216+sum217+sum218+sum219+sum2110+sum2111+sum2112+sum2113+sum2114+sum2115+sum2116+sum2117+sum2118 %}
           <td>{{ sum21a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-19"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-19"%}{% set sum241 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-19"%}{% set sum242 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-19"%}{% set sum243 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-19"%}{% set sum244 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-19"%}{% set sum245 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-19"%}{% set sum246 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-19"%}{% set sum247 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-19"%}{% set sum248 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-19"%}{% set sum249 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-19"%}{% set sum2410 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-19"%}{% set sum2411 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-19"%}{% set sum2412 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-19"%}{% set sum2413 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-19"%}{% set sum2414 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-19"%}{% set sum2415 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-19"%}{% set sum2416 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-19"%}{% set sum2417 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-19"%}{% set sum2418 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum24a=sum241+sum242+sum243+sum244+sum245+sum246+sum247+sum248+sum249+sum2410+sum2411+sum2412+sum2413+sum2414+sum2415+sum2416+sum2417+sum2418 %}
           <td>{{ sum24a|number_format(0,',','.')}}</td>
      </tr>
      <tr style="background-color: aqua;">
        <td>Jumlah Biaya Akademik </td>
        <td>
        {% set sum1f=sum181+sum191+sum201+sum211+sum221+sum231+sum241%}{{ sum1f|number_format(0,',','.')}}</td>
        <td>{% set sum2f=sum182+sum192+sum202+sum212+sum222+sum232+sum242%}{{ sum2f|number_format(0,',','.')}}</td>
        <td>{% set sum3f=sum183+sum193+sum203+sum213+sum223+sum233+sum243%}{{ sum3f|number_format(0,',','.')}}</td>
        <td>{% set sum4f=sum184+sum194+sum204+sum214+sum224+sum234+sum244%}{{ sum4f|number_format(0,',','.')}}</td>
        <td>{% set sum5f=sum185+sum195+sum205+sum215+sum225+sum235+sum245%}{{ sum5f|number_format(0,',','.')}}</td>
        <td>{% set sum6f=sum186+sum196+sum206+sum216+sum226+sum236+sum246%}{{ sum6f|number_format(0,',','.')}}</td>
        <td>{% set sum7f=sum187+sum197+sum207+sum217+sum227+sum237+sum247%}{{ sum7f|number_format(0,',','.')}}</td>
        <td>{% set sum8f=sum188+sum198+sum208+sum218+sum228+sum238+sum248%}{{ sum8f|number_format(0,',','.')}}</td>
        <td>{% set sum9f=sum189+sum199+sum209+sum219+sum229+sum239+sum249%}{{ sum9f|number_format(0,',','.')}}</td>
        <td>{% set sum10f=sum1810+sum1910+sum2010+sum2110+sum2210+sum2310+sum2410%}{{ sum10f|number_format(0,',','.')}}</td>
        <td>{% set sum11f=sum1811+sum1911+sum2011+sum2111+sum2211+sum2311+sum2411%}{{ sum11f|number_format(0,',','.')}}</td>
        <td>{% set sum12f=sum1812+sum1912+sum2012+sum2112+sum2212+sum2312+sum2412%}{{ sum12f|number_format(0,',','.')}}</td>
        <td>{% set sum13f=sum1813+sum1913+sum2013+sum2113+sum2213+sum2313+sum2413%}{{ sum13f|number_format(0,',','.')}}</td>
        <td>{% set sum14f=sum1814+sum1914+sum2014+sum2114+sum2214+sum2314+sum2414%}{{ sum14f|number_format(0,',','.')}}</td>
        <td>{% set sum15f=sum1815+sum1915+sum2015+sum2115+sum2215+sum2315+sum2415%}{{ sum15f|number_format(0,',','.')}}</td>
        <td>{% set sum16f=sum1816+sum1916+sum2016+sum2116+sum2216+sum2316+sum2416%}{{ sum16f|number_format(0,',','.')}}</td>
        <td>{% set sum17f=sum1817+sum1917+sum2017+sum2117+sum2217+sum2317+sum2417%}{{ sum17f|number_format(0,',','.')}}</td>
        <td>{% set sum18f=sum1818+sum1918+sum2018+sum2118+sum2218+sum2318+sum2418%}{{ sum18f|number_format(0,',','.')}}</td>
        <td>{% set sum19f=sum18a+sum19a+sum20a+sum21a+sum22a+sum23a+sum24a%}{{ sum19f|number_format(0,',','.')}}</td>
      </tr>
       <tr>
      <td><B>3. BIAYA DIKLAT & KEPEGAWAIAN</B></td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-20"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-20"%}{% set sum251 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-20"%}{% set sum252 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-20"%}{% set sum253 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-20"%}{% set sum254 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-20"%}{% set sum255 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-20"%}{% set sum256 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-20"%}{% set sum257 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-20"%}{% set sum258 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-20"%}{% set sum259 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-20"%}{% set sum2510 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-20"%}{% set sum2511 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-20"%}{% set sum2512 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-20"%}{% set sum2513 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-20"%}{% set sum2514 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-20"%}{% set sum2515 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-20"%}{% set sum2516 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-20"%}{% set sum2517 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-20"%}{% set sum2518 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum25a=sum251+sum252+sum253+sum254+sum255+sum256+sum257+sum258+sum259+sum2510+sum2511+sum2512+sum2513+sum2514+sum2515+sum2516+sum2517+sum2518 %}
           <td>{{ sum25a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-21"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-21"%}{% set sum261 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-21"%}{% set sum262 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-21"%}{% set sum263 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-21"%}{% set sum264 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-21"%}{% set sum265 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-21"%}{% set sum266 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-21"%}{% set sum267 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-21"%}{% set sum268 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-21"%}{% set sum269 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-21"%}{% set sum2610 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-21"%}{% set sum2611 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-21"%}{% set sum2612 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-21"%}{% set sum2613 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-21"%}{% set sum2614 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-21"%}{% set sum2615 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-21"%}{% set sum2616 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-21"%}{% set sum2617 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-21"%}{% set sum2618 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum26a=sum261+sum262+sum263+sum264+sum265+sum266+sum267+sum268+sum269+sum2610+sum2611+sum2612+sum2613+sum2614+sum2615+sum2616+sum2617+sum2618 %}
           <td>{{ sum26a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-22"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-22"%}{% set sum271 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-22"%}{% set sum272 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-22"%}{% set sum273 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-22"%}{% set sum274 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-22"%}{% set sum275 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-22"%}{% set sum276 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-22"%}{% set sum277 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-22"%}{% set sum278 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-22"%}{% set sum279 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-22"%}{% set sum2710 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-22"%}{% set sum2711 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-22"%}{% set sum2712 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-22"%}{% set sum2713 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-22"%}{% set sum2714 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-22"%}{% set sum2715 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-22"%}{% set sum2716 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-22"%}{% set sum2717 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-22"%}{% set sum2718 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum27a=sum271+sum272+sum273+sum274+sum275+sum276+sum277+sum278+sum279+sum2710+sum2711+sum2712+sum2713+sum2714+sum2715+sum2716+sum2717+sum2718 %}
           <td>{{ sum27a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-23"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-23"%}{% set sum281 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-23"%}{% set sum282 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-23"%}{% set sum283 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-23"%}{% set sum284 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-23"%}{% set sum285 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-23"%}{% set sum286 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-23"%}{% set sum287 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-23"%}{% set sum288 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-23"%}{% set sum289 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-23"%}{% set sum2810 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-23"%}{% set sum2811 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-23"%}{% set sum2812 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-23"%}{% set sum2813 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-23"%}{% set sum2814 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-23"%}{% set sum2815 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-23"%}{% set sum2816 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-23"%}{% set sum2817 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-23"%}{% set sum2818 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum28a=sum281+sum282+sum283+sum284+sum285+sum286+sum287+sum288+sum289+sum2810+sum2811+sum2812+sum2813+sum2814+sum2815+sum2816+sum2817+sum2818 %}
           <td>{{ sum28a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-24"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-24"%}{% set sum291 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-24"%}{% set sum292 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-24"%}{% set sum293 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-24"%}{% set sum294 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-24"%}{% set sum295 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-24"%}{% set sum296 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-24"%}{% set sum297 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-24"%}{% set sum298 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-24"%}{% set sum299 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-24"%}{% set sum2910 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-24"%}{% set sum2911 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-24"%}{% set sum2912 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-24"%}{% set sum2913 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-24"%}{% set sum2914 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-24"%}{% set sum2915 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-24"%}{% set sum2916 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-24"%}{% set sum2917 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-24"%}{% set sum2918 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum29a=sum291+sum292+sum293+sum294+sum295+sum296+sum297+sum298+sum299+sum2910+sum2911+sum2912+sum2913+sum2914+sum2915+sum2916+sum2917+sum2918 %}
           <td>{{ sum29a|number_format(0,',','.')}}</td>
      </tr>
            <tr style="background-color: aqua;">
        <td>Jumlah Biaya Diklat & Kepegawaian </td>
        <td>{% set sum1g=sum251+sum261+sum271+sum281+sum291%}{{ sum1g|number_format(0,',','.')}}</td>
        <td>{% set sum2g=sum252+sum262+sum272+sum282+sum292%}{{ sum2g|number_format(0,',','.')}}</td>
        <td>{% set sum3g=sum253+sum263+sum273+sum283+sum293%}{{ sum3g|number_format(0,',','.')}}</td>
        <td>{% set sum4g=sum254+sum264+sum274+sum284+sum294%}{{ sum4g|number_format(0,',','.')}}</td>
        <td>{% set sum5g=sum255+sum265+sum275+sum285+sum295%}{{ sum5g|number_format(0,',','.')}}</td>
        <td>{% set sum6g=sum256+sum266+sum276+sum286+sum296%}{{ sum6g|number_format(0,',','.')}}</td>
        <td>{% set sum7g=sum257+sum267+sum277+sum287+sum297%}{{ sum7g|number_format(0,',','.')}}</td>
        <td>{% set sum8g=sum258+sum268+sum278+sum288+sum298%}{{ sum8g|number_format(0,',','.')}}</td>
        <td>{% set sum9g=sum259+sum269+sum279+sum289+sum299%}{{ sum9g|number_format(0,',','.')}}</td>
        <td>{% set sum10g=sum2510+sum2610+sum2710+sum2810+sum2910%}{{ sum10g|number_format(0,',','.')}}</td>
        <td>{% set sum11g=sum2511+sum2611+sum2711+sum2811+sum2911%}{{ sum11g|number_format(0,',','.')}}</td>
        <td>{% set sum12g=sum2512+sum2612+sum2712+sum2812+sum2912%}{{ sum12g|number_format(0,',','.')}}</td>
        <td>{% set sum13g=sum2513+sum2613+sum2713+sum2813+sum2913%}{{ sum13g|number_format(0,',','.')}}</td>
        <td>{% set sum14g=sum2514+sum2614+sum2714+sum2814+sum2914%}{{ sum14g|number_format(0,',','.')}}</td>
        <td>{% set sum15g=sum2515+sum2615+sum2715+sum2815+sum2915%}{{ sum15g|number_format(0,',','.')}}</td>
        <td>{% set sum16g=sum2516+sum2616+sum2716+sum2816+sum2916%}{{ sum16g|number_format(0,',','.')}}</td>
        <td>{% set sum17g=sum2517+sum2617+sum2717+sum2817+sum2917%}{{ sum17g|number_format(0,',','.')}}</td>
        <td>{% set sum18g=sum2518+sum2618+sum2718+sum2818+sum2918%}{{ sum18g|number_format(0,',','.')}}</td>
        <td>{% set sum19g=sum25a+sum26a+sum27a+sum28a+sum29a%}{{ sum19g|number_format(0,',','.')}}</td>
      </tr>
       <tr>
      <td><B>4. BIAYA KERUMAHTANGGAAN & UMUM</B></td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-25"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-25"%}{% set sum301 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-25"%}{% set sum302 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-25"%}{% set sum303 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-25"%}{% set sum304 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-25"%}{% set sum305 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-25"%}{% set sum306 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-25"%}{% set sum307 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-25"%}{% set sum308 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-25"%}{% set sum309 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-25"%}{% set sum3010 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-25"%}{% set sum3011 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-25"%}{% set sum3012 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-25"%}{% set sum3013 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-25"%}{% set sum3014 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-25"%}{% set sum3015 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-25"%}{% set sum3016 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-25"%}{% set sum3017 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-25"%}{% set sum3018 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum30a=sum301+sum302+sum303+sum304+sum305+sum306+sum307+sum308+sum309+sum3010+sum3011+sum3012+sum3013+sum3014+sum3015+sum3016+sum3017+sum3018 %}
           <td>{{ sum30a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-26"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-26"%}{% set sum311 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-26"%}{% set sum312 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-26"%}{% set sum313 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-26"%}{% set sum314 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-26"%}{% set sum315 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-26"%}{% set sum316 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-26"%}{% set sum317 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-26"%}{% set sum318 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-26"%}{% set sum319 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-26"%}{% set sum3110 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-26"%}{% set sum3111 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-26"%}{% set sum3112 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-26"%}{% set sum3113 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-26"%}{% set sum3114 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-26"%}{% set sum3115 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-26"%}{% set sum3116 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-26"%}{% set sum3117 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-26"%}{% set sum3118 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum31a=sum311+sum312+sum313+sum314+sum315+sum316+sum317+sum318+sum319+sum3110+sum3111+sum3112+sum3113+sum3114+sum3115+sum3116+sum3117+sum3118 %}
           <td>{{ sum31a|number_format(0,',','.')}}</td>
      </tr>
            
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-28"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-28"%}{% set sum331 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-28"%}{% set sum332 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-28"%}{% set sum333 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-28"%}{% set sum334 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-28"%}{% set sum335 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-28"%}{% set sum336 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-28"%}{% set sum337 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-28"%}{% set sum338 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-28"%}{% set sum339 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-28"%}{% set sum3310 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-28"%}{% set sum3311 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-28"%}{% set sum3312 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-28"%}{% set sum3313 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-28"%}{% set sum3314 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-28"%}{% set sum3315 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-28"%}{% set sum3316 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-28"%}{% set sum3317 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-28"%}{% set sum3318 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum33a=sum331+sum332+sum333+sum334+sum335+sum336+sum337+sum338+sum339+sum3310+sum3311+sum3312+sum3313+sum3314+sum3315+sum3316+sum3317+sum3318 %}
           <td>{{ sum33a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-29"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-29"%}{% set sum341 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-29"%}{% set sum342 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-29"%}{% set sum343 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-29"%}{% set sum344 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-29"%}{% set sum345 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-29"%}{% set sum346 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-29"%}{% set sum347 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-29"%}{% set sum348 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-29"%}{% set sum349 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-29"%}{% set sum3410 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-29"%}{% set sum3411 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-29"%}{% set sum3412 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-29"%}{% set sum3413 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-29"%}{% set sum3414 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-29"%}{% set sum3415 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-29"%}{% set sum3416 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-29"%}{% set sum3417 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-29"%}{% set sum3418 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum34a=sum341+sum342+sum343+sum344+sum345+sum346+sum347+sum348+sum349+sum3410+sum3411+sum3412+sum3413+sum3414+sum3415+sum3416+sum3417+sum3418 %}
           <td>{{ sum34a|number_format(0,',','.')}}</td>
      </tr>
             <tr>
        <td>{% for list in resulttype %}{% if list.RecId=="TP-30"%}{{ list.dec}}{% endif %}{% endfor %}</td>
          <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2017" and list.TypeId=="TP-30"%}{% set sum351 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}}{% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2017" and list.TypeId=="TP-30"%}{% set sum352 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2017" and list.TypeId=="TP-30"%}{% set sum353 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2017" and list.TypeId=="TP-30"%}{% set sum354 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2017" and list.TypeId=="TP-30"%}{% set sum355 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2017" and list.TypeId=="TP-30"%}{% set sum356 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="7" and list.tahun=="2017" and list.TypeId=="TP-30"%}{% set sum357 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="8" and list.tahun=="2017" and list.TypeId=="TP-30"%}{% set sum358 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="9" and list.tahun=="2017" and list.TypeId=="TP-30"%}{% set sum359 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="10" and list.tahun=="2017" and list.TypeId=="TP-30"%}{% set sum3510 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="11" and list.tahun=="2017" and list.TypeId=="TP-30"%}{% set sum3511 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="12" and list.tahun=="2017" and list.TypeId=="TP-30"%}{% set sum3512 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="1" and list.tahun=="2018" and list.TypeId=="TP-30"%}{% set sum3513 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="2" and list.tahun=="2018" and list.TypeId=="TP-30"%}{% set sum3514 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="3" and list.tahun=="2018" and list.TypeId=="TP-30"%}{% set sum3515 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="4" and list.tahun=="2018" and list.TypeId=="TP-30"%}{% set sum3516 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="5" and list.tahun=="2018" and list.TypeId=="TP-30"%}{% set sum3517 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           <td>{% for list in result2 %}{% if list.bln=="6" and list.tahun=="2018" and list.TypeId=="TP-30"%}{% set sum3518 += list.Jumlah %}{{ list.Jumlah |number_format(0,',','.')}} {% endif %}{% endfor %}</td>
           {% set sum35a=sum351+sum352+sum353+sum354+sum355+sum356+sum357+sum358+sum359+sum3510+sum3511+sum3512+sum3513+sum3514+sum3515+sum3516+sum3517+sum3518 %}
           <td>{{ sum35a|number_format(0,',','.')}}</td>
      </tr>
                  <tr style="background-color: aqua;">
        <td>Jumlah Biaya Kerumahtanggaan & Umum </td>
        <td>{% set sum1h=sum301+sum311+sum321+sum331+sum341+sum351%}{{ sum1h|number_format(0,',','.')}}</td>
        <td>{% set sum2h=sum302+sum312+sum322+sum332+sum342+sum352%}{{ sum2h|number_format(0,',','.')}}</td>
        <td>{% set sum3h=sum303+sum313+sum323+sum333+sum343+sum353%}{{ sum3h|number_format(0,',','.')}}</td>
        <td>{% set sum4h=sum304+sum314+sum324+sum334+sum344+sum354%}{{ sum4h|number_format(0,',','.')}}</td>
        <td>{% set sum5h=sum305+sum315+sum325+sum335+sum345+sum355%}{{ sum5h|number_format(0,',','.')}}</td>
        <td>{% set sum6h=sum306+sum316+sum326+sum336+sum346+sum356%}{{ sum6h|number_format(0,',','.')}}</td>
        <td>{% set sum7h=sum307+sum317+sum327+sum337+sum347+sum357%}{{ sum7h|number_format(0,',','.')}}</td>
        <td>{% set sum8h=sum308+sum318+sum328+sum338+sum348+sum358%}{{ sum8h|number_format(0,',','.')}}</td>
        <td>{% set sum9h=sum309+sum319+sum329+sum339+sum349+sum359%}{{ sum9h|number_format(0,',','.')}}</td>
        <td>{% set sum10h=sum3010+sum3110+sum3210+sum3310+sum3410+sum3510%}{{ sum10h|number_format(0,',','.')}}</td>
        <td>{% set sum11h=sum3011+sum3111+sum3211+sum3311+sum3411+sum3511%}{{ sum11h|number_format(0,',','.')}}</td>
        <td>{% set sum12h=sum3012+sum3112+sum3212+sum3312+sum3412+sum3512%}{{ sum12h|number_format(0,',','.')}}</td>
        <td>{% set sum13h=sum3013+sum3113+sum3213+sum3313+sum3413+sum3513%}{{ sum13h|number_format(0,',','.')}}</td>
        <td>{% set sum14h=sum3014+sum3114+sum3214+sum3314+sum3414+sum3514%}{{ sum14h|number_format(0,',','.')}}</td>
        <td>{% set sum15h=sum3015+sum3115+sum3215+sum3315+sum3415+sum3515%}{{ sum15h|number_format(0,',','.')}}</td>
        <td>{% set sum16h=sum3016+sum3116+sum3216+sum3316+sum3416+sum3516%}{{ sum16h|number_format(0,',','.')}}</td>
        <td>{% set sum17h=sum3017+sum3117+sum3217+sum3317+sum3417+sum3517%}{{ sum17h|number_format(0,',','.')}}</td>
        <td>{% set sum18h=sum3018+sum3118+sum3218+sum3318+sum3418+sum3518%}{{ sum18h|number_format(0,',','.')}}</td>
        <td>{% set sum19h=sum30a+sum31a+sum32a+sum33a+sum34a+sum35a%}{{ sum19h|number_format(0,',','.')}}</td>
      </tr>
      
  <tr>
   <td><b>JUMLAH BIAYA OPERASIONAL </B></td>
        <td>{% set sume1=sum1e+sum1f+sum1g+sum1h+sum1i+sum1j%}{{ sume1|number_format(0,',','.')}}</td>
        <td>{% set sume2=sum2e+sum2f+sum2g+sum2h+sum2i+sum2j%}{{ sume2|number_format(0,',','.')}}</td>  
        <td>{% set sume3=sum3e+sum3f+sum3g+sum3h+sum3i+sum3j%}{{ sume3|number_format(0,',','.')}}</td> 
        <td>{% set sume4=sum4e+sum4f+sum4g+sum4h+sum4i+sum4j%}{{ sume4|number_format(0,',','.')}}</td> 
        <td>{% set sume5=sum5e+sum5f+sum5g+sum5h+sum5i+sum5j%}{{ sume5|number_format(0,',','.')}}</td> 
        <td>{% set sume6=sum6e+sum6f+sum6g+sum6h+sum6i+sum6j%}{{ sume6|number_format(0,',','.')}}</td> 
        <td>{% set sume7=sum7e+sum7f+sum7g+sum7h+sum7i+sum7j%}{{ sume7|number_format(0,',','.')}}</td> 
        <td>{% set sume8=sum8e+sum8f+sum8g+sum8h+sum8i+sum8j%}{{ sume8|number_format(0,',','.')}}</td> 
        <td>{% set sumend9=sum9e+sum9f+sum9g+sum9h+sum9i+sum9j%}{{ sume9|number_format(0,',','.')}}</td> 
        <td>{% set sume10=sum10e+sum10f+sum10g+sum10h+sum10i+sum10j%}{{ sume10|number_format(0,',','.')}}</td> 
        <td>{% set sume11=sum11e+sum11f+sum11g+sum11h+sum11i+sum11j%}{{ sume11|number_format(0,',','.')}}</td> 
        <td>{% set sume12=sum12e+sum12f+sum12g+sum12h+sum12i+sum12j%}{{ sume12|number_format(0,',','.')}}</td> 
        <td>{% set sume13=sum13e+sum13f+sum13g+sum13h+sum13i+sum13j%}{{ sume13|number_format(0,',','.')}}</td> 
        <td>{% set sume14=sum14e+sum14f+sum14g+sum14h+sum14i+sum14j%}{{ sume14|number_format(0,',','.')}}</td> 
        <td>{% set sume15=sum15e+sum15f+sum15g+sum15h+sum15i+sum15j%}{{ sume15|number_format(0,',','.')}}</td> 
        <td>{% set sume16=+sum16e+sum16f+sum16g+sum16h+sum16i+sum16j%}{{ sume16|number_format(0,',','.')}}</td> 
        <td>{% set sume17=sum17e+sum17f+sum17g+sum17h+sum17i+sum17j%}{{ sume17|number_format(0,',','.')}}</td> 
        <td>{% set sume18=sum18e+sum18f+sum18g+sum18h+sum18i+sum18j%}{{ sume18|number_format(0,',','.')}}</td> 
        <td>{% set sume19=sum19e+sum19f+sum19g+sum19h+sum19i+sum19j%}{{ sume19|number_format(0,',','.')}}</td> 
  </tr>
  <tr>
  <td colspan="20">
  <br>
  </td>
  </tr> 
   <tr>
   <td><b>SURPLUS (DEFISIT)  </B></td>
        <td>{% set sumend1=(sum1+sum1b)-(sum1c+sum1d+sum1e+sum1f+sum1g+sum1h+sum1i+sum1j)%}{{ sumend1|number_format(0,',','.')}}</td>
        <td>{% set sumend2=(sum2+sum2b)-(sum2c+sum2d+sum2e+sum2f+sum2g+sum2h+sum2i+sum2j)%}{{ sumend2|number_format(0,',','.')}}</td>  
        <td>{% set sumend3=(sum3+sum3b)-(sum3c+sum3d+sum3e+sum3f+sum3g+sum3h+sum3i+sum3j)%}{{ sumend3|number_format(0,',','.')}}</td> 
        <td>{% set sumend4=(sum4+sum4b)-(sum4c+sum4d+sum4e+sum4f+sum4g+sum4h+sum4i+sum4j)%}{{ sumend4|number_format(0,',','.')}}</td> 
        <td>{% set sumend5=(sum5+sum5b)-(sum5c+sum5d+sum5e+sum5f+sum5g+sum5h+sum5i+sum5j)%}{{ sumend5|number_format(0,',','.')}}</td> 
        <td>{% set sumend6=(sum6+sum6b)-(sum6c+sum6d+sum6e+sum6f+sum6g+sum6h+sum6i+sum6j)%}{{ sumend6|number_format(0,',','.')}}</td> 
        <td>{% set sumend7=(sum7+sum7b)-(sum7c+sum7d+sum7e+sum7f+sum7g+sum7h+sum7i+sum7j)%}{{ sumend7|number_format(0,',','.')}}</td> 
        <td>{% set sumend8=(sum8+sum8b)-(sum8c+sum8d+sum8e+sum8f+sum8g+sum8h+sum8i+sum8j)%}{{ sumend8|number_format(0,',','.')}}</td> 
        <td>{% set sumend9=(sum9+sum9b)-(sum9c+sum9d+sum9e+sum9f+sum9g+sum9h+sum9i+sum9j)%}{{ sumend9|number_format(0,',','.')}}</td> 
        <td>{% set sumend10=(sum10+sum10b)-(sum10c+sum10d+sum10e+sum10f+sum10g+sum10h+sum10i+sum10j)%}{{ sumend10|number_format(0,',','.')}}</td> 
        <td>{% set sumend11=(sum11+sum11b)-(sum11c+sum11d+sum11e+sum11f+sum11g+sum11h+sum11i+sum11j)%}{{ sumend11|number_format(0,',','.')}}</td> 
        <td>{% set sumend12=(sum12+sum12b)-(sum12c+sum12d+sum12e+sum12f+sum12g+sum12h+sum12i+sum12j)%}{{ sumend12|number_format(0,',','.')}}</td> 
        <td>{% set sumend13=(sum13+sum13b)-(sum13c+sum13d+sum13e+sum13f+sum13g+sum13h+sum13i+sum13j)%}{{ sumend13|number_format(0,',','.')}}</td> 
        <td>{% set sumend14=(sum14+sum14b)-(sum14c+sum14d+sum14e+sum14f+sum14g+sum14h+sum14i+sum14j)%}{{ sumend14|number_format(0,',','.')}}</td> 
        <td>{% set sumend15=(sum15+sum15b)-(sum15c+sum15d+sum15e+sum15f+sum15g+sum15h+sum15i+sum15j)%}{{ sumend15|number_format(0,',','.')}}</td> 
        <td>{% set sumend16=(sum16+sum16b)-(sum16c+sum16d+sum16e+sum16f+sum16g+sum16h+sum16i+sum16j)%}{{ sumend16|number_format(0,',','.')}}</td> 
        <td>{% set sumend17=(sum17+sum17b)-(sum17c+sum17d+sum17e+sum17f+sum17g+sum17h+sum17i+sum17j)%}{{ sumend17|number_format(0,',','.')}}</td> 
        <td>{% set sumend18=(sum18+sum18b)-(sum18c+sum18d+sum18e+sum18f+sum18g+sum18h+sum18i+sum18j)%}{{ sumend18|number_format(0,',','.')}}</td> 
        <td>{% set sumend19=(sum19+sum19b)-(sum19c+sum19d+sum19e+sum19f+sum19g+sum19h+sum19i+sum19j)%}{{ sumend19|number_format(0,',','.')}}</td> 
  </tr>
                </tbody>
            </table>

        </td>
    </tr>
</table>
{#
{% if page.total_pages > 1 %}
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("rptlaporancashinout/view", "First", 'class':'button') }}
    {{ link_to("rptlaporancashinout/view?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("rptlaporancashinout/view?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("rptlaporancashinout/view?page="~page.last, "Last", 'class':'button') }}
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

