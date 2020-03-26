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
            <table style="width:1000px;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="100%"></td>
                    <td align="center" width="64%">
                        <h2><u>{{ rpt_title }}</u></h2>
                    </td>
                    <td width="18%" align="right">
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>                    
                        </td>
                </tr>
                <tr>
                    <td>
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
            <table class="table bordered hoveredqq table2excel" style="width: 1500px; border-collapse: collapse">
                <thead>
                    <tr>
                        <th width = "1%" rowspan="2">No</th>
                        <th width = "6%" rowspan="2">Area</th>
                        <th width = "30%" colspan="5">TA 2015/2016</th>
                        <th width = "30%" colspan="5">TA 2016/2017</th>
                        <th width = "30%" colspan="5">TA 2017/2018</th>
                    </tr>
                    <tr>
                        <th width = "3%">Cabang</th>
                        <th width = "3%">Siswa</th>
                        <th width = "4%">Order Buku</th>
                        <th width = "8%">Biaya Bimbingan</th>
                        <th width = "7%">Pembayaran</th>
                        <th width = "3%">Cabang</th>
                        <th width = "3%">Siswa</th>
                        <th width = "4%">Order Buku</th>
                        <th width = "8%">Biaya Bimbingan</th>
                        <th width = "7%">Pembayaran</th>
                        <th width = "3%">Cabang</th>
                        <th width = "3%">Siswa</th>
                        <th width = "4%">Order Buku</th>
                        <th width = "8%">Biaya Bimbingan</th>
                        <th width = "7%">Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    {% if result2 is not empty %} 
                        {% for list in result2 %}
                            <tr class="text-center">
                                <td class="text-center">{{ loop.index }}</td>
                                <td align='left'> {{ list.Area }} </td>
                                <td align='right' >{{list.JumlahCabang1516 }}</td>
								<td align='right'>{{list.JumlahSiswa1516|number_format(0,',',',')}}</td>
								<td align='right'>-</td>
								<td align='right'>Rp. {{list.JumlahBiayaBimbingan1516|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.JumlahUangMasuk1516|number_format(0,',',',') }}</td>
                                <td align='right' >{{list.JumlahCabang1516 }}</td>
                                <td align='right'>{{list.JumlahSiswa1516|number_format(0,',',',')}}</td>
                                <td align='right'>{{list.JumlahBuku1516|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.JumlahBiayaBimbingan1516|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.JumlahUangMasuk1516|number_format(0,',',',') }}</td>
                                <td align='right' >{{list.JumlahCabang1516 }}</td>
                                <td align='right'>{{list.JumlahSiswa1516|number_format(0,',',',')}}</td>
                                <td align='right'>{{list.JumlahBuku1516|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.JumlahBiayaBimbingan1516|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.JumlahUangMasuk1516|number_format(0,',',',') }}</td>
                            </tr>
                            {% if loop.last %}
                            {% endif %}
                            {% set JumlahTotalCabang1516 += list.JumlahCabang1516 %}
                            {% set JumlahTotalSiswa1516 += list.JumlahSiswa1516 %}
                            {% set JumlahTotalBuku1516 += list.JumlahBuku1516 %}
                            {% set JumlahTotalBiaya1516 += list.JumlahBiayaBimbingan1516 %}
                            {% set JumlahTotalUang1516 += list.JumlahUangMasuk1516 %}
                            {% set JumlahTotalCabang1617 += list.JumlahCabang1617 %}
                            {% set JumlahTotalSiswa1617 += list.JumlahSiswa1617 %}
                            {% set JumlahTotalBuku1617 += list.JumlahBuku1617 %}
                            {% set JumlahTotalBiaya1617 += list.JumlahBiayaBimbingan1617 %}
                            {% set JumlahTotalUang1617 += list.JumlahUangMasuk1617 %}
                            {% set JumlahTotalCabang1718 += list.JumlahCabang1718 %}
                            {% set JumlahTotalSiswa1718 += list.JumlahSiswa1718 %}
                            {% set JumlahTotalBuku1718 += list.JumlahBuku1718 %}
                            {% set JumlahTotalBiaya1718 += list.JumlahBiayaBimbingan1718 %}
                            {% set JumlahTotalUang1718 += list.JumlahUangMasuk1718 %}
                        {% endfor %}
                    {% endif %}
					<tr>
						<th colspan='2' align='center'>Total</th>
                        <th align='right'>{{ JumlahTotalCabang1516 }}</th>
						<th align='right'>{{ JumlahTotalSiswa1516 }}</th>
						<th align='right'>-</th>
						<th align='right'>Rp. {{ JumlahTotalBiaya1516|number_format(0,',',',') }}</th>
						<th align='right'>Rp. {{ JumlahTotalUang1516|number_format(0,',',',') }}</th>
                        <th align='right'>{{ JumlahTotalCabang1617 }}</th>
                        <th align='right'>{{ JumlahTotalSiswa1617 }}</th>
                        <th align='right'>{{ JumlahTotalBuku1617 }}</th>
                        <th align='right'>Rp. {{ JumlahTotalBiaya1617|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{ JumlahTotalUang1617|number_format(0,',',',') }}</th>
                        <th align='right'>{{ JumlahTotalCabang1718 }}</th>
                        <th align='right'>{{ JumlahTotalSiswa1718 }}</th>
                        <th align='right'>{{ JumlahTotalBuku1718 }}</th>
                        <th align='right'>Rp. {{ JumlahTotalBiaya1718|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{ JumlahTotalUang1718|number_format(0,',',',') }}</th>
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
