
{{ content() }}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>

{% set group = 0 %}
<table class="tablePrint" style="width:100%;">
    <tr>
        <td colspan="7">
            <table style="width:100%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="220"></td>
                    <td align="center" width="75%">
                        <h2><u>Laporan Data Siswa Aktivasi</u></h2>
                        <strong>Periode : {{ DateFrom }} - {{ DateTo }}
                    </td>
                    <td width="20%" align="right">
						<a href="#" id="downloadBtn" class="btn"><img src="{{ url('img/Excel-icon.png') }}"></a>
                        <a href="javascript::void();" onclick="window.print();" id="printLink" class="btn"><img src="{{ url('img/printer-icon.png') }}"></a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h3 class="text-right" style="margin:4px 0">&nbsp;</h3>
                    </td>
                </tr>
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="10"><hr color="#000000"/></td>
    </tr>
</table>
<table class="table bordered hovered table2excel" style="width: 100%; border-collapse: collapse">
    <thead>
        <tr>
            <th>No.</th>
            <th>Area</th>
            <th>Cabang</th>
            <th>NoVA</th>
            <th>Nama Siswa</th>
            <th>Email Siswa</th>
			<th>Telepon Siswa</th>
 		    <th>Tgl Aktivasi</th>
        </tr>
    </thead>
    <tbody>
        {% if page.items is defined %}
            {% for siswa in page.items %}
                <tr>
                    <td>{{ loop.index }}</td>
                    <td>{{ siswa.Area }}</td>
                    <td>{{ siswa.KodeAreaCabang }} - {{ siswa.NamaAreaCabang }}</td>
                    <td>'{{ siswa.NoVA }}</td>
                    <td>{{ siswa.NamaSiswa }}</td>
                    <td>{{ siswa.EmailSiswa }}</td>
                    <td>'{{ siswa.TeleponSiswa }}</td>
                    <td>{{ siswa.AktivasiCreatedAt }}</td>
                </tr>
            {% endfor %}
        {% endif %}
    </tbody>
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
