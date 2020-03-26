
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
                        {% for list2 in result2 %}
                                <tr class="text-right">
                                    <th class="text-left" colspan="2">Saldo Awal Hutang</th>
                                    <th>{{ list2.SaldoAwal|number_format(0,',','.') }}</th>
                                </tr>
                                <tr class="text-right">
                                    <th class="text-left" colspan="2">Tagihan FF</th>
                                    <th>{{ list2.Total|number_format(0,',','.') }}</th>
                                </tr>
                                <tr class="text-right">
                                    <th class="text-left" colspan="2">Total</th>
                                    <th>{{ list2.SaldoAkhir|number_format(0,',','.') }}</th>
                                </tr>
                        {% endfor %}
                    <tr>
                        <th colspan='3' class="text-center" style="background: #f0f0f0; font-weight: bold">Detail Pembayaran</th>
                    </tr>
                    <tr>
                        <th width="4%">#</th>
                        <th width="18%">Tanggal Transaksi</th>
                        <th width="12%">Jumlah Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    {% set lines = '' %}
                    {% if result is not empty %}
                        {% for list in result %}
                            {% set subD1 += list.Nominal %}
                            
                            <tr class="text-center">
                                <td>{{ loop.index }}</td>
                                <td>{{ list.TanggalTransaksi }}</td>
                                <td class="text-right">{{ list.Nominal|number_format(0,',','.') }}</td>
                            </tr>
                        {% endfor %}
                    {% else %}
                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data Pembayaran dari Transaksi Bank-</td>
                        </tr>
                    {% endif %}
                        {% for list2 in result2 %}
                            {% set subD2 = subD1 + list2.Pembayaran %}
                            {% set subD3 = list2.SaldoAkhir - subD2 %}
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-left" colspan="2">Pembayaran sebelum sistem</td>
                                    <td>{{ list2.Pembayaran|number_format(0,',','.') }}</td>
                                </tr>
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-left" colspan="2">Total Pembayaran</td>
                                    <td>{{ subD2|number_format(0,',','.') }}</td>
                                </tr>
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-left" colspan="2" style="font-weight:bold;">Sisa Pembayaran / Saldo Akhir Hutang</td>
                                    <td style="font-weight:bold;">{{ subD3|number_format(0,',','.') }}</td>
                                </tr>
                        {% endfor %}
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
