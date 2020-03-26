
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
                            {% set currarea = list.TahunMulai %}
                            {% if currarea != lastarea and not loop.first %}
                                 <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="4">Sub Total</td>
                                    <td>{{ list.TanggalTransaksi|number_format(0,',','.') }}</td>
                                </tr>
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="4">Total Harga Franchisee</td>
                                    <td>{{ list.Total|number_format(0,',','.') }}</td>
                                </tr>
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="4">Sisa Pembayaran</td>
                                    <td>{{ sub|number_format(0,',','.') }}</td>
                                </tr>
                                
                                {% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
                            {% endif %}
                            {% set subD1 += list.Nominal %}
                            {% set subD2 = subD1 + list.Pembayaran %}
                            {% set subD3 = list.Total - subD2 %}
                            {% set subD4 += list.TotalPembayaranVA %}
                            {% set sumD1 += list.Nominal %}
                            {% set sumD2 += list.TotalPembayaran %}
                            {% set sumD3 += list.TotalPiutang %}
                            
                            
                            {% set sumD4 += list.TotalPembayaranVA %}
                            {% if currarea != lastarea %}
                                <tr style="font-weight: bold">
                                    <td>&nbsp;</td>
                                    <td colspan="4">
                                        &nbsp;Tahun Mulai: {{ list.TahunMulai }}
                                    </td>
                                </tr>
                            {% endif %}
                             {% set lines = list.TahunMulai %}
                            <tr class="text-center">
                                <td>{{ loop.index }}</td>
                                <td>{{ list.TanggalTransaksi }}</td>
                                <td class="text-right">{{ list.Nominal|number_format(0,',','.') }}</td>
                            </tr>
                            {% if loop.last %}
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="2">Sub Total</td>
                                    <td>{{ subD1|number_format(0,',','.') }}</td>
                                </tr>
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="2">Pembayaran sebelum sistem</td>
                                    <td>{{ list.Pembayaran|number_format(0,',','.') }}</td>
                                </tr>
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="2">Total Pembayaran</td>
                                    <td>{{ subD2|number_format(0,',','.') }}</td>
                                </tr>
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="2">Total Harga Franchisee</td>
                                    <td>{{ list.Total|number_format(0,',','.') }}</td>
                                </tr>
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="2" style="font-weight:bold; font-size: 15px;">Sisa Pembayaran</td>
                                    <td style="font-weight:bold; font-size: 15px;">{{ subD3|number_format(0,',','.') }}</td>
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
