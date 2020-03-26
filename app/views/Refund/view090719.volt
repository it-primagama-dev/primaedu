
{{ content() }}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
<table class="tablePrint" style="width:100%;padding-left:3%;padding-right:3%;font-size: 11px;">
    <tr>
        <td colspan="7">
            <table style="width:100%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="125%"></td>
                    <td align="center" width="60%">
                        <h2><u>LAPORAN KOREKSI TRANSFER</u></h2>
                    </td>
                    <td width="22%" align="right">
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>
                        <a href="javascript:void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
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
            <table class="table bordered hovered table2excel" style="border-collapse: collapse;width:100%;padding-left:3%;padding-right:3%;">
                <thead>
                    <tr>
                        <th width="4%" rowspan="2">#</th>
                        <th width="9%" rowspan="2">No. Surat</th>
                        <th width="6%" rowspan="2">Tgl. Pengajuan</th>
                        <th width="4%" rowspan="2">Kode Cabang</th>
                        <th width="10%" rowspan="2">Nama Cabang</th>
                        <th width="5%" rowspan="2">VA Siswa</th>
                        <th width="10%" rowspan="2">Nama Siswa</th>
                        <th width="5%" rowspan="2">Total Biaya</th>
                        <th width="5%" rowspan="2">Total Pembayaran</th>
                        <th width="5%" rowspan="2">Total Diskon</th>
                        <th width="15%" colspan="3">Koreksi</th>
                        <th width="5%" rowspan="2">Total Hutang</th>
                        <th width="12%" colspan="2">Tgl. Approval</th>
                        <th width="5%" colspan="2">Status</th>
                    </tr>
                    <tr>
                        <th>100%</th>
                        <th>89%</th>
                        <th>11%</th>
                        <th>AR</th>
                        <th>Finance</th>
                        <th>AR</th>
                        <th>Finance</th>
                    </tr>
                </thead>

                <tbody>
                    {% if result is not empty %}
                        {% for list in result %}
                            {% set biaya += list.TotalBiaya %}
                            {% set pembayaran += list.TotalPembayaran%}
                            {% set diskon += list.Diskon%}
                            {% set koreksi += list.Koreksi%}
                            {% set koreksi_89 = list.Koreksi * 89 / 100 %}
                            {% set koreksi_11 = list.Koreksi * 11 / 100 %}
                            {% set total_89 += koreksi_89%}
                            {% set total_11 += koreksi_11%}
                            {% set hutang = list.TotalBiaya-(list.TotalPembayaran-list.Diskon-list.Koreksi) %}
                            {% set total_hutang += hutang %}

                            <tr class="text-center">
                                <td class="text-center">{{ loop.index }}</td>
                                <td class="text-center">{{ list.NoSurat }}</td>
                                <td class="text-center">{{ date("d-m-Y H:i:s",strtotime(list.TanggalPengajuan)) }}</td>
                                <td class="text-center">&nbsp;{{ list.KodeAreaCabang }}</td>
                                <td class="text-left">{{ list.NamaAreaCabang }}</td>
                                <td class="text-center">&nbsp;{{ list.VirtualAccount }}</td>
                                <td class="text-left">{{ list.NamaSiswa|upper }}</td>
                                <td class="text-right">{{ list.TotalBiaya|number_format(0,',','.') }}</td>
                                <td class="text-right">{{ list.TotalPembayaran-list.Koreksi|number_format(0,',','.') }}</td>
                                <td class="text-right">{{ list.Diskon|number_format(0,',','.') }}</td>

                                <td class="text-right">{{ list.Koreksi|number_format(0,',','.') }}</td>
                                <td class="text-right">{{ koreksi_89|number_format(0,',','.') }}</td>
                                <td class="text-right">{{ koreksi_11|number_format(0,',','.') }}</td>

                                <td class="text-right">{{ hutang|number_format(0,',','.') }}</td>

                                <td class="text-center">{{ date("d-m-Y H:i:s",strtotime(list.TanggalApprovalAR)) }}</td>
                                <td class="text-center">{{ date("d-m-Y H:i:s",strtotime(list.TanggalApprovalFN)) }}</td>

                                <td class="text-center">{{ list.StatusApprovalAR }}</td>
                                <td class="text-center">{{ list.StatusApprovalFN }}</td>
                            </tr>

                        {% endfor %}
                    {% else %}

                        <tr>
                            <td colspan="18" align="center">- Tidak Ada Data -</td>
                        </tr>

                    {% endif %}

                    <tr>
                        <th colspan='7' align='center'>Total</th>
                        <th align='right'>{{biaya|number_format(0,',','.')}}</th>
                        <th align='right'>{{pembayaran|number_format(0,',','.')}}</th>
                        <th align='right'>{{diskon|number_format(0,',','.')}}</th>
                        <th align='right'>{{koreksi|number_format(0,',','.')}}</th>
                        <th align='right'>{{total_89|number_format(0,',','.')}}</th>
                        <th align='right'>{{total_11|number_format(0,',','.')}}</th>
                        <th align='right' >{{total_hutang|number_format(0,',','.')}}</th>
                        <th align='center'>&nbsp;</th>
                        <th align='center'>&nbsp;</th>
                        <th align='center'>&nbsp;</th>
                        <th align='center'>&nbsp;</th>
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