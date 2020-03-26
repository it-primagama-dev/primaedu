
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
                        <h2><u>{{ rpt_title }}</u></h2>
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
            <th>Kode Siswa</th>
            <th>Nama Siswa</th>
			<th>Tempat Lahir</th>
 		    <th>Tanggal Lahir</th>
		    <th>Agama</th>
            <th>Jenis Kelamin</th>
            <th>Jenjang</th>
 		    <th>Alamat</th>
			<th>Nama Ayah</th>
 		    <th>Nama Ibu</th>
        </tr>
    </thead>
    <tbody>
        {% if page.items is defined %}
            {% for siswa in page.items %}
                {% if group != siswa.Cabang and not nogroup %}
                    <tr class="bg-steel fg-white">
                        <td colspan="10">
                            <i class="icon-next on-left-more"></i>
                            {{ siswa.getNamaArea()~' / '~siswa.getNamaCabang(true) }}
                        </td>
                    </tr>
                    {% set group = siswa.Cabang %}
                {% endif %}
                <tr>
                    <td>{{ siswa.VirtualAccount }}</td>
                    <td>{{ siswa.NamaSiswa }}</td>
                    <td>{{ siswa.TempatLahir }}</td>
				    <td>{{ siswa.TanggalLahir }}</td>
					<td>{{ siswa.Agama }}</td>
                    <td>{{ siswa.getJenisKelamin() }}</td>
                    <td>{{ siswa.getJenjang() }}</td>
					<td>{{ siswa.Alamat }}</td>	
					<td>{{ siswa.NamaAyah }}</td>	
					<td>{{ siswa.NamaIbu }}</td>	
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
