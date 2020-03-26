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
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="100%"></td>
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
                        <h3 style="margin: 4px 0">Area : {{ rpt_area }}</h3>
                    </td>
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
            <table class="table bordered hoveredqq table2excel" style="width: 100%; border-collapse: collapse">
                <thead>
                    <tr>
                        <th >No</th>
                        <th width = "10%">Kode Cabang</th>
                        <th width = "30%">Nama Cabang</th>
                        <th width = "10%">Jumlah Siswa</th>
						<th width = "13%">Jumlah Order Buku</th>
						<th width = "19%">Jumlah Biaya Bimbingan</th>
						<th width = "18%">Jumlah Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    {% if result is not empty %} 
                        {% for list in result %}
                            <tr class="text-center">
                                <td class="text-center">{{ loop.index }}</td>
                                <td> '{{ list.KodeAreaCabang }} </td>
                                <td align='left' >{{list.NamaCabang}}</td>
								<td align='right'>{{list.JumlahSiswa|number_format(0,',',',')}}</td>
								<td align='right'>{{list.JumlahBuku|number_format(0,',',',') }}</td>
								<td align='right'>Rp. {{list.JumlahBiayaBimbingan|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.JumlahUangMasuk|number_format(0,',',',') }}</td>
                            </tr>
                            {% if loop.last %}
                            {% endif %}
                            {% set JumlahTotalSiswa += list.JumlahSiswa %}
                            {% set JumlahTotalBuku += list.JumlahBuku %}
                            {% set JumlahTotalBiaya += list.JumlahBiayaBimbingan %}
                            {% set JumlahTotalUang += list.JumlahUangMasuk %}
                        {% endfor %}
                    {% endif %}
					<tr>
						<th colspan='3' align='center'>Total</th>
						<th align='right'>{{ JumlahTotalSiswa }}</th>
						<th align='right'>{{ JumlahTotalBuku }}</th>
						<th align='right'>Rp. {{ JumlahTotalBiaya|number_format(0,',',',') }}</th>
						<th align='right'>Rp. {{ JumlahTotalUang|number_format(0,',',',') }}</th>
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
