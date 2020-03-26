
{{ content() }}

{% set sumD1 = 0 %}
{% set sumD2 = 0 %}
{% set sumD3 = 0 %}
{% set sumD4 = 0 %}
{% set sumD5 = 0 %}
{% set sumD6 = 0 %}
{% set subD1 = 0 %}
{% set subD2 = 0 %}
{% set subD3 = 0 %}
{% set subD4 = 0 %}
{% set subD5 = 0 %}
{% set subD6 = 0 %}
{% set lastarea = '' %}
{% set currarea = '' %}
{% set lines = '' %}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
{% set lines = '' %}
<table class="tablePrint" style="width:100%">
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
                        <th width="04%" rowspan="2">#</th>
                        <th width="12%" rowspan="2">No. Induk Siswa</th>
                        <th width="16%" rowspan="2">Nama Siswa</th>
                        <th width="12%" rowspan="2">Jenjang</th>
                        <th width="12%" rowspan="2">Bank</th>
                        <th width="12%" rowspan="2">Tanggal Transaksi</th>
                        <th width="12%" rowspan="2">BiayaBimbingan</th>
                        <th width="12%" rowspan="2">Uang Masuk</th>
                        <th width="10%" rowspan="2">Diskon</th>
                        <th width="12%" colspan="3">Koreksi</th>
                        <th width="10%" colspan="3">Hutang</th>
                        <th width="15%" rowspan="2">Keterangan</th>
                        <th width="15%" rowspan="2">Mengundurkan diri</th>
                        {% set bim = 0 %}
                        {% set va = 00000 %}
                    </tr>
                    <tr>
                        <th>100%</th>
                        <th>89%</th>
                        <th>11%</th>
                        <th>100%</th>
                        <th>89%</th>
                        <th>11%</th>
                    </tr>
                </thead>
                <tbody>
                    {% set lines = '' %}
                    {% if result is not empty %}
                        {% for list in result %}
                            {% set currarea = list.NIS %}
                            {% if currarea != lastarea and not loop.first %}
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="6">Sub Total</td>

                                    {% set subD689 = subD6 * 89 / 100 %}
                                    {% set subD611 = subD6 * 11 / 100 %}
                                    {% set h100 = subD3 - (subD2-subD5-subD6) %}

                                    <td>{{ subD3|number_format(0,',','.') }}</td>
                                    <td>{{ subD2|number_format(0,',','.') }}</td>
                                    <td>{{ subD5|number_format(0,',','.') }}</td>
                                    <td>{{ subD6|number_format(0,',','.') }}</td>
                                    <td>{{ subD689|number_format(0,',','.') }}</td>
                                    <td>{{ subD611|number_format(0,',','.') }}</td>
                                    <td>{{ h100|number_format(0,',','.') }}</td>
                                    {% if h100 != 0 %}
                                    <td>{{ (subD3 - (subD2-subD5-subD689))|number_format(0,',','.') }}</td>
                                    <td>{{ (subD3 - (subD2-subD5-subD611))|number_format(0,',','.') }}</td>
                                    {% else %}
                                    <td>0</td>
                                    <td>0</td>
                                    {% endif %}
                                    <td><span style="display:none;">grandtotaldiskon</span</td>
                                    <td><span style="display:none;">grandtotaldiskon</span</td>
                                </tr>
                                
                                {% set subD1 = 0 %}
                                {% set subD2 = 0 %}
                                {% set subD3 = 0 %}
                                {% set subD5 = 0 %}
                                {% set subD6 = 0 %}

                                {% endif %}
                                {% set subD1 += list.BiayaBimbingan %}
                                {% set subD2 += list.Nominal %}
                                {% set subD3 = list.BiayaBimbingan %}
                                {% set subD4 += list.TotalPembayaranVA %}
                                {% set subD5 += list.diskon %}
                                {% set subD6 += list.koreksi %}
                                {% set sumD1 += list.BiayaBimbingan %}
                                {% set sumD2 += list.TotalPembayaran %}
                                {% set sumD4 += list.TotalPembayaranVA %}
                                {% set sumD5 += list.diskon %}
                                {% set sumD6 += list.koreksi %}
                                {% set total += list.Nominal%}
                                {% set total1 += list.BiayaBimbingan%}
                                {% set diskon += list.diskon%}
                                {% set totalkoreksi100 += list.koreksi%}
                                {% set totalkoreksi89 += list.koreksi * 89 /100 %}
                                {% set totalkoreksi11 += list.koreksi * 11 /100 %}
                                {#
                                {% set totalhutang100 += list.BiayaBimbingan -(list.Nominal-list.diskon-list.koreksi) %}
                                {% set totalhutang89 += list.BiayaBimbingan -(list.Nominal-list.diskon-(list.koreksi * 89 / 100 )) %}
                                {% set totalhutang11 += list.BiayaBimbingan -(list.Nominal-list.diskon-(list.koreksi * 11 / 100 )) %}
                                #}

                            {% if currarea != lastarea %}
                            {% endif %}
                                {% set lines = list.ProgramSiswa %}
                                <tr class="text-center">
                                    <td>{{ loop.index }}</td>
                                    <td>{{ list.NIS }}</td>
                                    <td class="text-left">{{ list.NamaSiswa|upper }}</td>
                                    <td class="text-left">{{ list.NamaJenjang|upper}}</td>
                                    <td class="text-left">{{ list.NamaBank|upper }}</td>
                                    <td class="text-left">{{ list.TanggalTransaksi|upper}}</td>
                                    <td></td>
                                    <td class="text-right">{{ list.Nominal|number_format(0,',','.') }}</td>
                                    <td class="text-right">{{ list.diskon|number_format(0,',','.') }}</td>
                                    <td class="text-right">{{ list.koreksi|number_format(0,',','.') }}</td>
                                    <td class="text-right">{{ list.koreksi * 89 / 100|number_format(0,',','.') }}</td>
                                    <td class="text-right">{{ list.koreksi * 11 / 100|number_format(0,',','.') }}</td>
                                    <td><span style="display:none;">hutang100</span</td>
                                    <td><span style="display:none;">hutang89</span</td>
                                    <td><span style="display:none;">hutang11</span</td>
                                    <td class="text-left">{{ list.Keterangan }}</td>
                                    <td class="text-center">{{ list.MD }}</td>
                                </tr>
                                {% if loop.last %}
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="6">Sub Total</td>
                                    {% set subd6100 = subD3 - (subD2-subD5-subD6) %}
                                    {% set subD689 = subD6 * 89 / 100 %}
                                    {% set subD611 = subD6 * 11 / 100 %}

                                    <td>{{ subD3|number_format(0,',','.') }}</td>
                                    <td>{{ subD2|number_format(0,',','.') }}</td>
                                    <td>{{ subD5|number_format(0,',','.') }}</td>
                                    <td>{{ subD6|number_format(0,',','.') }}</td>
                                    <td>{{ subD689 }}</td>
                                    <td>{{ subD611 }}</td>
                                    <td>{{ subd6100 }}</td>
                                    {% if subd6100 != 0 %}
                                    <td>{{ subD3 - (subD2-subD5-subD689) }}</td>
                                    <td>{{ subD3 - (subD2-subD5-subD611) }}</td>
                                    {% else %}
                                    <td>0</td>
                                    <td>0</td>
                                    {% endif %}
                                    <td><span style="display:none;">grandtotaldiskon</span</td>
                                    <td><span style="display:none;">grandtotaldiskon</span</td>
                                </tr>
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="6">Grand Total</td>
                                    <td><span style="display:none;">biayabimbingan</span</td>
                                    <td>{{ total|number_format(0,',','.') }}</td>
                                    <td>{{ diskon|number_format(0,',','.') }}</td>
                                    <td>{{ totalkoreksi100|number_format(0,',','.') }}</td>
                                    <td>{{ totalkoreksi89|number_format(0,',','.') }}</td>
                                    <td>{{ totalkoreksi11|number_format(0,',','.') }}</td>
                                    <td>{#{{ totalhutang100|number_format(0,',','.') }}#}</td>
                                    <td>{#{{ totalhutang89|number_format(0,',','.') }}#}</td>
                                    <td>{#{{ totalhutang11|number_format(0,',','.') }}#}</td>
                                    <td><span style="display:none;">keterangan</span</td>
                                    <td><span style="display:none;">MD</span</td>
                                </tr>
                                {% endif %}
                            {% set lastarea = currarea %}
                        {% endfor %}
                    {% else %}
                        <tr>
                            <td colspan="17" align="center">- Tidak Ada Data -</td>
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
