
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
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
                    <td align="center" width="60%">
                        <h2><u>{{ rpt_title }}</u></h2>
                    </td>
                    <td width="22%" align="right">
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>
                        <a href="javascript:void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3 style="margin: 4px 0">Cabang : {{ rpt_cabang }}</h3>
                    </td>
                    <td>
                        <h3 class="text-right" style="margin: 4px 0">Tahun Ajaran : {{ rpt_tahun }}</h3>
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
                        <th width="20%">Bulan</th>
                        <th width="15%">Jumlah Siswa</th>
                        <th width="30%">Jumlah Biaya Bimbingan</th>
                        <th width="30%">Jumlah Pembayaran</th>
                    </tr>
                </thead>

                <tbody>
                    {% if result is not empty %}
                        {% for list in result %}
                                                        
                            <tr class="text-center">
                                <td>{{ loop.index }}</td>
                                <td class="text-left">{{ list.monthname }}</td>
                                <td class="text-right">{{ list.total_qty|upper }}</td>
                                <td class="text-right">Rp {{ list.JumlahTotal|number_format(0,',','.') }}</td>
                                <td class="text-right">Rp {{ list.Uang_masuk|number_format(0,',','.') }}</td>
                            </tr>
                            {% set TotalSiswa += list.total_qty %}
                            {% set TotalJumlah += list.JumlahTotal %}
                            {% set TotalUangMasuk += list.Uang_masuk %}
                        {% endfor %}
                    {% endif %}    
                            <tr class="text-center">
                                <th colspan="2">Jumlah Total</th>
                                <th class="text-right">{{ TotalSiswa|upper }}</th>
                                <th class="text-right">Rp {{ TotalJumlah|number_format(0,',','.') }}</th>
                                <th class="text-right">Rp {{ TotalUangMasuk|number_format(0,',','.') }}</th>
                            </tr>
                    
                    

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
