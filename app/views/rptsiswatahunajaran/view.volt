
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
                        <h2><u> Laporan Transaksi Bank </u></h2>
                    </td>
                    <td width="22%" align="right">
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>
                        <a href="javascript:void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3 style="margin: 4px 0">Area : {{ rpt_area }}, Cabang : {{ rpt_cabang }}</h3>
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
                        <th width="15%">No. VA</th>
                        <th width="25%">Nama Siswa</th>
                        <th width="10%">Bank</th>
                        <th width="15%">Tanggal Transaksi</th>
                        <th width="15%">Tanggal Import</th>
                        <th width="15%">Nominal</th>
                    </tr>
                </thead>

                <tbody>
				{% set totsis=0 %}
                    {% if result is not empty %}
                        {% for list in result %}

                             {% set total+= list.Nominal %}
                            
                            <tr class="text-center">
								 <td>{{ loop.index }}</td>
                                <td class="text-left">{{ list.NoVA }}</td>
                                <td class="text-left">{{ list.siswa }}</td>
                                <td class="text-center">{{ list.NamaBank }}</td>
                                <td class="text-center">{{ list.TanggalTransaksi }}</td>
                                <td class="text-center">{{ list.TanggalImport }}</td>
                                <td class="text-center">Rp {{ list.Nominal|number_format(0,',','.') }}</td>
                        {% endfor %}
                    {% else %}

                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>

                {% if loop.last %}
                   
             {% endif %}

            {% endif %}

                    <tr>
                        <th colspan='6' align='center'></th>
                    <tr>
                        <th colspan='6' align='center'>TOTAL</th>

						<th  align='center' center colspan='2'>Rp {{total |number_format(0,',','.')}} </th>
                        
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
