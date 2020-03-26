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
            <table style="width:1500px;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="100%"></td>
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
                        <h3 style="margin: 4px 0">Tahun Berakhir : {{ tahun }}</h3>
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
            <table class="table bordered hoveredqq table2excel" style="width: 2000px; border-collapse: collapse">
                <thead>
                    <tr>
                        <th >No</th>
                        <th width = "5%">Kode Cabang</th>
                        <th width = "10%">Nama Cabang</th>
                        <th width = "5%">Awal Kontrak</th>
                        <th width = "5%">Akhir Kontrak</th>
                        <th width = "6%">Saldo Awal Hutang</th>
                        <th width = "5%">Nilai Franchisee</th>
                        <th width = "5%">Diskon</th> 
                        <th width = "5%">DPP</th>
                        <th width = "5%">Pajak</th>
                        <th width = "6%">Tagihan FF</th>
                        <th width = "5%">Pembayaran</th>
                        <th width = "5%">Sisa Pembayaran</th>
                        <th width = "6%">Tanggal MOU </th>
                        <th width = "6%">No. KTP</th>
                        <th width = "6%">No. NPWP</th>
                        <th width = "30%">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    {% if result is not empty %} 
                        {% for list in result %}
                            {% set tanggal = list.TanggalBerakhir %}
                            <tr class="text-center">
                                <td class="text-center">{{ loop.index }}</td>
                                <td> {{ list.KodeCabang }}
                                </td>
                                <td align='left' >{{ list.NamaCabang}}</td>
                                <td>{{list.AwalKontrak}}</td>
                                <td>
                                {% if list.AkhirKontrak < today %}
                                <font color='red'>{{list.AkhirKontrak}}</font>
                                {% else %}
                                {{list.AkhirKontrak}}
                                {% endif %}
                                </td>
                                <td align='right'> {{list.SaldoAwal|number_format(0,',',',') }}</td>
                                <td align='right'> {{list.NilaiFF|number_format(0,',',',') }}</td>
                                <td align='right'>{{list.Diskon|number_format(0,',',',') }}</td>
                                <td align='right'>{{list.DPP|number_format(0,',',',') }}</td>
                                <td align='right'>{{list.Pajak|number_format(0,',',',') }}</td>
                                <td align='right'>{{list.TotalPenagihan|number_format(0,',',',') }}</td>
                                <td align='right'>
                                <a href="{{ url('RptDetailFranchise/viewpay/'~list.FFID)}}" target="_blank">
                                {{ (list.TotalPembayaran)|number_format(0,',',',') }}</td>
                                <td align='right'>{{list.SisaPembayaran|number_format(0,',',',')}}</td>
                                {%if list.TglMou == "1900-01-01"%}
                                    <td>MOU Belum dibuat</td>
                                {% elseif list.TglMou is NULL%}
                                    <td>MOU Belum dibuat</td>
                                {%else%}
                                    <td>{{list.TglMou}}</td>
                                {%endif%}
                                <td>{{list.KTP}}</td>
                                <td >{{list.NPWP}}</td>
                                {% if list.Keterangan== 'NULL' %}
                                    <td> </td>
                                {%else%}
                                    <td align = 'left'> {{list.Keterangan}}</td>
                                {%endif%}
                            </tr>
                            {% if loop.last %}
                            {% endif %}
                            {% set JumlahNilaiFF += list.NilaiFF %}
                            {% set JumlahDiskon += list.Diskon %}
                            {% set JumlahDPP += list.DPP %}
                            {% set JumlahPajak += list.Pajak %}
                            {% set JumlahTotalPenagihan += list.TotalPenagihan %}
                            {% set JumlahTotalPembayaran += list.TotalPembayaran %}
                            {% set JumlahSisaPembayaran += list.SisaPembayaran %}
                            {% set JumlahSaldoAwal += list.SaldoAwal %}
                            {% set JumlahSaldoAkhir += list.SaldoAkhir %}
                        {% endfor %}
                    {% endif %}
                    <tr>
                        <th colspan='5' align='center'>Total</th>
                        <th align='right'>{{ JumlahSaldoAwal|number_format(0,',',',') }}</th>
                        <th align='right'>{{ JumlahNilaiFF|number_format(0,',',',') }}</th>
                        <th align='right'>{{ JumlahDiskon|number_format(0,',',',') }}</th>
                        <th align='right'>{{ JumlahDPP|number_format(0,',',',') }}</th>
                        <th align='right'>{{ JumlahPajak|number_format(0,',',',') }}</th> 
                        <th align='right'>{{ JumlahTotalPenagihan|number_format(0,',',',') }}</th>   
                        <th align='right'>{{ JumlahTotalPembayaran|number_format(0,',',',') }}</th>  
                        <th align='right'>{{ JumlahSisaPembayaran|number_format(0,',',',') }}</th>
                        <th colspan='4'></th>
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
