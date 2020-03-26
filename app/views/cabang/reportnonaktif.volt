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
            <table style="width:1200px;">
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
            <table class="table bordered hoveredqq table2excel" style="width: 5500px; border-collapse: collapse">
                <thead>
                    <tr>
                        <th>No</th>
                        <th width = "1%">Area</th>
                        <th width = "1%">Kode Cabang</th>
                        <th width = "3%">Nama Cabang</th>
                        <th width = "2%">Tanggal Berlaku</th>
                        <th width = "2%">Tanggal Berakhir</th>
                        <th width = "2%">Propinsi</th>
                        <th width = "2%">Kota</th>
                        <th width = "4%">Alamat</th>
                        <th width = "2%">Kode Pos</th>
                        <th width = "2%">No. Telp</th>
                        <th width = "2%">Email</th>
                        <th width = "2%">Rek BCA</th>
                        <th width = "3%">Rek BCA Atas Nama</th>
                        <th width = "3%">Kode Bank Non BCA</th>
                        <th width = "2%">Rek Non BCA</th>
                        <th width = "3%">Rek Non BCA Atas Nama</th>
                        <th width = "2%">Manager</th>
                        <th width = "2%">No. Hp</th>
                        <th width = "3%">Alamat Manager</th>
                        <th width = "2%">PAC</th>
                        <th width = "2%">NoTelp PAC</th>
                        <th width = "2%">Ismart</th>
                        <th width = "2%">NoTelp Ismart</th>
                        <th width = "3%">Nama Franchisee</th>
                        <th width = "2%">NoTelp Franchisee</th>
                        <th width = "3%">Alamat Franchisee</th>
                        <th width = "2%">Status Kepemilikan</th>
                        <th width = "2%">Pemimpin</th>
                        <th width = "2%">SIUP</th>
                        <th width = "2%">TDP</th>
                        <th width = "3%">No. KTP</th>
                        <th width = "3%">No. NPWP</th>
                        <th width = "2%">Status Yang Lain</th>
                        <th width = "2%">Bentuk Bangunan</th>
                        <th width = "2%">Status Bangunan</th>
                        <th width = "2%">Awal Kontrak</th>
						<th width = "2%">Akhir Kontrak</th>
						<th width = "2%">Nilai Franchisee</th>
						<th width = "2%">Diskon</th> 
						<th width = "2%">DPP</th>
						<th width = "2%">Pajak</th>
						<th width = "2%">Total Penagihan FF</th>
						<th width = "2%">Pembayaran</th>
						<th width = "2%">Sisa Pembayaran</th>
						<th width = "2%">Tanggal MOU</th>
                    </tr>
                </thead>
                <tbody>
                    {% if result is not empty %} 
                        {% for list in result %}
							{% set tanggal = list.TanggalBerakhir%}
                            <tr class="text-center">
                                <td class="text-center">{{ loop.index }}</td>
                                <td> {{ list.Area }}</td>
                                <td> '{{ list.KodeCabang }}</td>
                                <td align='left' >{{ list.NamaCabang}}</td>
								<td>{{ list.AwalKontrak }}</td>
								<td>{{ list.AkhirKontrak }}</td>
                                <td> {{ list.NamaPropinsi }}</td>
                                <td> {{ list.NamaKotaKab }}</td>
                                <td align='left'> {{ list.Alamat }}</td>
                                <td> {{ list.KodePos }}</td>
                                <td> {{ list.NoTelp }}</td>
                                <td> {{ list.Email }}</td>
                                <td> {{ list.NoRekBCA }}</td>
                                <td> {{ list.NamaRekBCA }}</td>
                                <td> {{ list.KodeBankNonBCA }}</td>
                                <td> {{ list.NoRekNonBCA }}</td>
                                <td> {{ list.NamaRekNonBCA }}</td>
                                <td> {{ list.NamaManager }}</td>
                                <td> {{ list.NoHandPhone }}</td>
                                <td> {{ list.AlamatKC }}</td>
                                <td> {{ list.PAC }}</td>
                                <td> {{ list.telpPAC }}</td>
                                <td> {{ list.Ismart }}</td>
                                <td> {{ list.TelpIsmart }}</td>
                                <td> {{ list.NamaFranchisee }}</td>
                                <td> {{ list.NoTelpFranchisee }}</td>
                                <td> {{ list.AlamatFranchisee }}</td>
                                <td> {{ list.Statuskepemilikan }}</td>
                                <td> {{ list.Direktur }}</td>
                                <td> {{ list.SIUP }}</td>
                                <td> {{ list.TDP }}</td>
                                <td>{{ list.KTP }}</td>
                                <td>{{ list.NPWP }}</td>
                                <td> {{ list.YStatusKepemilikan }}</td>
                                <td> {{ list.Bentuk }}</td>
                                <td> {{ list.StatusB }}</td>
                                <td> {{ list.AwalKontrak }}</td>
                                <td> {{ list.AkhirKontrak }}</td>
								<td align='right'> {{list.NilaiFF|number_format(0,',',',') }}</td>
								<td align='right'>{{list.Diskon|number_format(0,',',',') }}</td>
								<td align='right'>{{list.DPP|number_format(0,',',',') }}</td>
								<td align='right'>{{list.Pajak|number_format(0,',',',') }}</td>
								<td align='right'>{{list.TotalPenagihan|number_format(0,',',',') }}</td>
								<td align='right'>
								<a href="{{ url('RptDetailFranchise/viewpay?cabang='~list.RecID)}}" target="_blank">
								{{ (list.TotalPembayaran)|number_format(0,',',',') }}</td>
								<td align='right'>{{list.SisaPembayaran|number_format(0,',',',')}}</td>
								{%if list.TglMou == "1900-01-01"%}
									<td>MOU Belum dibuat</td>
								{% elseif list.TglMou is NULL%}
									<td>MOU Belum dibuat</td>
								{%else%}
									<td>{{list.TglMou}}</td>
								{%endif%}
                            </tr>
                        {% endfor %}
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
