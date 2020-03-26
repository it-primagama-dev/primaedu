{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}

                    {% if result is not empty %}
                        {% for list in result %}
<style type="text/css">
    @media print{@page {size: A4 portrait}}
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
                    <h1 style="margin: 4px 0"> Kepada Yth,</h1><br>
                    <h1 style="margin: 4px 0">
                    <strong>PRIMAGAMA</strong> {{ list.NamaAreaCabang }}
                    </h1>
                    <font size="5px">{{ list.Alamat }}, {{ list.KodePos }}</font>
                    <br>
                    <font size="5px"><b>{{ list.NoTelp }}</b></font>
                    <br></br>

                    <font size="5px"><b>
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
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        
        Koli Ke 
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        Dari 
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        Koli
        </b></font></td>
    </tr>
    <tr>
        <td colspan="7"><hr color="#000080"/></td>
    </tr>
                   
    <tr>
        <td colspan="7">
        <font size="5px" color="green"><b>PENGIRIM : PRIMAGAMA<br>
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
    <h1 style="margin: 4px 0" align="center"><font color="red">ISI BUKU / MUDAH RUSAK<br> MOHON TIDAK DIBANTING !</font></h1>
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
