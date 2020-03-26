<style>
@media screen {
    @page {
      margin: 0.2cm;   
    }
    div.row > div {
      display: inline-block;  
      border: solid 3px #000080;
      margin: 0.1cm;
    }
    div.row {
      display: block;
      margin: solid 2px black;
      margin: 0.1cm 1cm;
    }
}
        

.table {
    display: table;
    border-spacing: 10px;
}
.row {
    display: table-row;
}
.row > div {
    display: table-cell;
    border: solid 3px #000080;
    padding: 4px;
}
</style>

<section class="table">
<div class="row">

<div>

{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}

                    {% if result is not empty %}
                        {% for list in result %}
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
                    </td>
                    <td width="22%" align="right">
                        <a href="javascript:void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                    <br>
                    <font size="5px"><b>KEPADA YTH, </b></font><br>
                    
                    <font size="5px"><b>PRIMAGAMA {{ list.NamaAreaCabang }} </b>
                    </font><br>
                    <font size="5px">{{ list.Alamat }}, {{ list.KodePos }}</font>
                    <br>
                    <font size="4px"><b>{{ list.NoTelp }}</b></font>
                    <br>

                    <font size="4px"><b>
                    {% if kota is not empty %}
                    {% for list1 in kota %}
                    {% if list1.RecID==list.Kota %}
                    {{ list1.NamaKotaKab }},
                    {% endif %}
                    {% endfor %}
                    {% endif %}

                    {% if propinsi is not empty %}
                    {% for list2 in propinsi %}
                    {% if list2.RecID==list.Propinsi %}
                    {{ list2.NamaPropinsi }}
                    {% endif %}
                    {% endfor %}
                    {% endif %}

                    </b></font>
                    

                    </td>
                </tr>
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="7"><hr color="#000080"/></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="4"><font size="4px"><b>Kode Cabang &nbsp&nbsp&nbsp&nbsp&nbsp : {{ list.KodeAreaCabang }}</b></font></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="4"><font size="4px"><b>Contact Person &nbsp&nbsp : {{ list.NoHandPhone }} - {{ list.NamaManager }}</b></font></td>
    </tr>
    <tr>
        <td colspan="7"><hr color="#000080"/></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="4"><font size="4px"><b>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        Koli Ke 
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        Dari 
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        Koli
        </b></font></td>
    </tr>
    <tr>
        <td colspan="7"><hr color="#000080"/></td>
    </tr>
                   
    <tr>
        <td colspan="7">
        <font size="3px" color="green"><b>PENGIRIM : PRIMAGAMA<br>
        <i>LOGISTIK PRIMA EDU PENDAMPING BELAJAR</i><br>
        Jl. Monjali 99, Mlati, Sinduadi, Sleman, Yk<br>
        TELP. 0274 - 552996<br>
        YOGYAKARTA, 55284</b></font>
        </td> 
    </tr>

    <tr>
        <td colspan="7"><hr color="#000080"/></td>
    </tr>
         
    <tr>
    <td colspan="7">           
    <h1 style="margin: 1px 0" align="center"><font color="red">ISI BUKU / MUDAH RUSAK<br> MOHON TIDAK DIBANTING !</font></h1>
    </td>
    </tr>

    <tr>
        <td colspan="7"><hr color="#000080"/></td>
    </tr>
</table>
                        {% endfor %}
                        {% endif %}
<script>
    $('#downloadBtn').on('click', function () {
        $(".table2excel").table2excel({
            exclude: ".noExl",
            name: "Primaedu",
            filename: "{{ rpt_title }}.xls"
        });
    });
</script>


</div>

<div>
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}

                    {% if result is not empty %}
                        {% for list in result %}
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
                    </td>
                    <td width="22%" align="right">
                        <a href="javascript:void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                    <br>
                    <font size="5px"><b>KEPADA YTH, </b></font><br>
                    
                    <font size="5px"><b>PRIMAGAMA {{ list.NamaAreaCabang }} </b>
                    </font><br>
                    <font size="5px">{{ list.Alamat }}, {{ list.KodePos }}</font>
                    <br>
                    <font size="4px"><b>{{ list.NoTelp }}</b></font>
                    <br>

                    <font size="4px"><b>
                    {% if kota is not empty %}
                    {% for list1 in kota %}
                    {% if list1.RecID==list.Kota %}
                    {{ list1.NamaKotaKab }},
                    {% endif %}
                    {% endfor %}
                    {% endif %}

                    {% if propinsi is not empty %}
                    {% for list2 in propinsi %}
                    {% if list2.RecID==list.Propinsi %}
                    {{ list2.NamaPropinsi }}
                    {% endif %}
                    {% endfor %}
                    {% endif %}

                    </b></font>
                    

                    </td>
                </tr>
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="7"><hr color="#000080"/></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="4"><font size="4px"><b>Kode Cabang &nbsp&nbsp&nbsp&nbsp&nbsp : {{ list.KodeAreaCabang }}</b></font></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="4"><font size="4px"><b>Contact Person &nbsp&nbsp : {{ list.NoHandPhone }} - {{ list.NamaManager }}</b></font></td>
    </tr>
    <tr>
        <td colspan="7"><hr color="#000080"/></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td colspan="4"><font size="4px"><b>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        Koli Ke 
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        Dari 
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        Koli
        </b></font></td>
    </tr>
    <tr>
        <td colspan="7"><hr color="#000080"/></td>
    </tr>
                   
    <tr>
        <td colspan="7">
        <font size="3px" color="green"><b>PENGIRIM : PRIMAGAMA<br>
        <i>LOGISTIK PRIMA EDU PENDAMPING BELAJAR</i><br>
        Jl. Monjali 99, Mlati, Sinduadi, Sleman, Yk<br>
        TELP. 0274 - 552996<br>
        YOGYAKARTA, 55284</b></font>
        </td> 
    </tr>

    <tr>
        <td colspan="7"><hr color="#000080"/></td>
    </tr>
         
    <tr>
    <td colspan="7">           
    <h1 style="margin: 1px 0" align="center"><font color="red">ISI BUKU / MUDAH RUSAK<br> MOHON TIDAK DIBANTING !</font></h1>
    </td>
    </tr>

    <tr>
        <td colspan="7"><hr color="#000080"/></td>
    </tr>
</table>
                        {% endfor %}
                        {% endif %}
<script>
    $('#downloadBtn').on('click', function () {
        $(".table2excel").table2excel({
            exclude: ".noExl",
            name: "Primaedu",
            filename: "{{ rpt_title }}.xls"
        });
    });
</script>

</div>
</div>
</section>