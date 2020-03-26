
{{ content() }}

{% set sum1 = 0 %}

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
                        <a href="javascript:void()" onclick="window.print()" id="printLink" class="btn btn-success pull-right">Print</a>
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
                        <th width="4%">#</th>
                        <th>Nama Cabang</th>
                        <th>Nomor Kuitansi</th>
                        <th>Kode Siswa</th>
                        <th>Nama Siswa</th>
                        <th>Program</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    {% if result is not empty %}
                        {% for list in result %}
                            {% set sum1 += list.Jumlah %}
                            <tr>
                                <td>{{ loop.index }}</td>
                                <td>{{ list.NamaCabang }}</td>
                                <td>{{ list.DocumentNo }}</td>
                                <td>{{ list.VirtualAccount }}</td>
                                <td>{{ list.NamaSiswa }}</td>
                                <td>{{ list.NamaProgram }}</td>
                                <td class="text-right">Rp {{ list.Jumlah|number_format(0,',','.') }}</td>
                            </tr>
                            {% if loop.last %}
                                <tr class="text-right" style="background: #f0f0f0; font-weight: bold">
                                    <td class="text-center" colspan="6">Grand Total</td>
                                    <td>Rp {{ sum1|number_format(0,',','.') }}</td>
                                </tr>
                            {% endif %}
                        {% endfor %}
                    {% else %}
                        <tr>
                            <td colspan="6" align="center">- Tidak Ada Data -</td>
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
