
{{ content() }}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
<table class="tablePrint" style="width:100%;padding-left:3%;padding-right:3%;">
    <tr>
        <td colspan="7">
            <table style="width:100%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="125%"></td>
                    <td align="center" width="60%">
                        <h2><u>LAPORAN KOREKSI TRANSFER DEPOSIT</u></h2>
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
                        <th>No. </th>
                        <th>Status</th>
                        <th>No. Surat</th>
                        <th>Nama Cabang</th>
                        <th>No. VA Salah</th>
                        <th>No. VA Benar</th>
                        <th>Tgl. Transfer</th>
                        <th>Dialihkan Untuk</th>
                        <th>Tgl. Koreksi</th>
                        <th>Jml. Transfer</th>
                    </tr>
                </thead>

                <tbody>
                    {% if result is not empty %}
                        {% for list in result %}
                        <tr class="text-center">
                            <td>{{ loop.index }}</td>
                            <td>{{ list.TrackFinance }}</td>
                            <td>{{ list.NoSuratPernyataan }}</td>
                            <td class="text-left">{{ list.NamaAreaCabang }}</td>
                            <td>{{ list.NoVaSalah }}</td>
                            <td>{{ list.NoVaBenar }}</td>
                            <td>{{ list.TanggalTransfer }}</td>
                            <td>{{ jenisPengalihanList[list.JenisDeposite] }}</td>
                            <td>{{ list.tglkoreksi }}</td>
                            <td class="text-right">{{ list.Nominal|number_format(2,',','.') }}</td>

                            {% set total += list.Nominal %}

                        </tr>
                        {% endfor %}
                    {% else %}
                        <tr>
                            <td colspan="14" align="center">- Tidak Ada Data -</td>
                        </tr>
                    {% endif %}
                    <tr>
                        <th colspan='9' align='right' style="padding-right:5px;">Total</th>
                        <th colspan='1' class="text-right">{{total|number_format(2,',','.')}}</th>
                        
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