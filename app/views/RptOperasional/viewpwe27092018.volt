{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}{% set sumD4 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}{% set subD4 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
<table class="tablePrint" style="width:3500px">
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
                    <td colspan="2">
                        <h3 style="margin: 4px 0">Tahun Ajaran : {{ tahun }}</h3>
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
                        <th width = "1%" rowspan="2">No</th>
                        <th width = "2%" rowspan="2">Kode Cabang</th>
                        <th width = "6%" rowspan="2">Nama Cabang</th>
                        <th width = "3%" colspan="3">Januari</th>
						<th width = "3%" colspan="3">Februari</th>
						<th width = "3%" colspan="3">Maret</th>
						<th width = "3%" colspan="3">April</th>
                        <th width = "3%" colspan="3">Mei</th>
                        <th width = "3%" colspan="3">Juni</th>
                        <th width = "3%" colspan="3">Juli</th>
                        <th width = "3%" colspan="3">Agustus</th>
                        <th width = "3%" colspan="3">September</th>
                        <th width = "3%" colspan="3">Oktober</th>
                        <th width = "3%" colspan="3">November</th>
                        <th width = "3%" colspan="3">Desember</th>
                        <th width = "3%" colspan="3">Jumlah Total</th>
                    </tr>
                    <tr>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                        <th width = "1%">Siswa</th>
                        <th width = "3%">Biaya Bimbingan</th>
                        <th width = "3%">Uang Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    {% if result is not empty %} 
                        {% for list in result %}
                            {% set JumSis = list.SisJan+list.SisFeb+list.SisMar+list.SisApr+list.SisMei+list.SisJun+list.SisJul+list.SisAgu+list.SisSep+list.SisOkt+list.SisNov+list.SisDes %}
                            {% set JumBim = list.BimJan+list.BimFeb+list.BimMar+list.BimApr+list.BimMei+list.BimJun+list.BimJul+list.BimAgu+list.BimSep+list.BimOkt+list.BimNov+list.BimDes %}
                            {% set JumUang = list.UangJan+list.UangFeb+list.UangMar+list.UangApr+list.UangMei+list.UangJun+list.UangJul+list.UangAgu+list.UangSep+list.UangOkt+list.BimNov+list.BimDes %}
                            <tr class="text-center">
                                <td class="text-center">{{ loop.index }}</td>
                                <td> '{{ list.KodeAreaCabang }} </td>
                                <td align='left' >{{list.NamaAreaCabang}}</td>
								<td align='right'>{{list.SisJan|number_format(0,',',',')}}</td>
								<td align='right'>Rp. {{list.BimJan|number_format(0,',',',') }}</td>
								<td align='right'>Rp. {{list.UangJan|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisFeb|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.BimFeb|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangFeb|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisMar|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.BimMar|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangMar|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisApr|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.BimApr|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangApr|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisMei|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.BimMei|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangMei|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisJun|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.BimJun|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangJun|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisJul|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.BimJul|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangJul|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisAgu|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.BimAgu|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangAgu|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisSep|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.BimSep|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangSep|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisOkt|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.BimOkt|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangOkt|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisNov|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.BimNov|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangNov|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisDes|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.BimDes|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangDes|number_format(0,',',',') }}</td>

                                <td align='right'><strong>{{JumSis|number_format(0,',',',')}}</strong></td>
                                <td align='right'><strong>Rp. {{JumBim|number_format(0,',',',') }}</strong></td>
                                <td align='right'><strong>Rp. {{JumUang|number_format(0,',',',') }}</strong></td>
                                
                            </tr>
                            {% set JumSisJan += list.SisJan %}
                            {% set JumBimJan += list.BimJan %}
                            {% set JumUangJan += list.UangJan %}

                            {% set JumSisFeb += list.SisFeb %}
                            {% set JumBimFeb += list.BimFeb %}
                            {% set JumUangFeb += list.UangFeb %}

                            {% set JumSisMar += list.SisMar %}
                            {% set JumBimMar += list.BimMar %}
                            {% set JumUangMar += list.UangMar %}

                            {% set JumSisApr += list.SisApr %}
                            {% set JumBimApr += list.BimApr %}
                            {% set JumUangApr += list.UangApr %}

                            {% set JumSisMei += list.SisMei %}
                            {% set JumBimMei += list.BimMei %}
                            {% set JumUangMei += list.UangMei %}

                            {% set JumSisJun += list.SisJun %}
                            {% set JumBimJun += list.BimJun %}
                            {% set JumUangJun += list.UangJun %}

                            {% set JumSisJul += list.SisJul %}
                            {% set JumBimJul += list.BimJul %}
                            {% set JumUangJul += list.UangJul %}

                            {% set JumSisAgu += list.SisAgu %}
                            {% set JumBimAgu += list.BimAgu %}
                            {% set JumUangAgu += list.UangAgu %}

                            {% set JumSisSep += list.SisSep %}
                            {% set JumBimSep += list.BimSep %}
                            {% set JumUangSep += list.UangSep %}

                            {% set JumSisOkt += list.SisOkt %}
                            {% set JumBimOkt += list.BimOkt %}
                            {% set JumUangOkt += list.UangOkt %}

                            {% set JumSisNov += list.SisNov %}
                            {% set JumBimNov += list.BimNov %}
                            {% set JumUangNov += list.UangNov %}

                            {% set JumSisDes += list.SisDes %}
                            {% set JumBimDes += list.BimDes %}
                            {% set JumUangDes += list.UangDes %}

                            {% set JumSisTot += JumSis %}
                            {% set JumBimTot += JumBim %}
                            {% set JumUangTot += JumUang %}
                        {% endfor %}
                    {% endif %}
                    <tr>
                        <th colspan='3' align='center'>Total</th>

                        <th align='right'>{{JumSisJan|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumBimJan|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangJan|number_format(0,',',',') }}</th>

                                <th align='right'>{{JumSisFeb|number_format(0,',',',')}}</th>
                                <th align='right'>Rp. {{JumBimFeb|number_format(0,',',',') }}</th>
                                <th align='right'>Rp. {{JumUangFeb|number_format(0,',',',') }}</th>

                                <th align='right'>{{JumSisMar|number_format(0,',',',')}}</th>
                                <th align='right'>Rp. {{JumBimMar|number_format(0,',',',') }}</th>
                                <th align='right'>Rp. {{JumUangMar|number_format(0,',',',') }}</th>

                                <th align='right'>{{JumSisApr|number_format(0,',',',')}}</th>
                                <th align='right'>Rp. {{JumBimApr|number_format(0,',',',') }}</th>
                                <th align='right'>Rp. {{JumUangApr|number_format(0,',',',') }}</th>

                                <th align='right'>{{JumSisMei|number_format(0,',',',')}}</th>
                                <th align='right'>Rp. {{JumBimMei|number_format(0,',',',') }}</th>
                                <th align='right'>Rp. {{JumUangMei|number_format(0,',',',') }}</th>

                                <th align='right'>{{JumSisJun|number_format(0,',',',')}}</th>
                                <th align='right'>Rp. {{JumBimJun|number_format(0,',',',') }}</th>
                                <th align='right'>Rp. {{JumUangJun|number_format(0,',',',') }}</th>

                                <th align='right'>{{JumSisJul|number_format(0,',',',')}}</th>
                                <th align='right'>Rp. {{JumBimJul|number_format(0,',',',') }}</th>
                                <th align='right'>Rp. {{JumUangJul|number_format(0,',',',') }}</th>

                                <th align='right'>{{JumSisAgu|number_format(0,',',',')}}</th>
                                <th align='right'>Rp. {{JumBimAgu|number_format(0,',',',') }}</th>
                                <th align='right'>Rp. {{JumUangAgu|number_format(0,',',',') }}</th>

                                <th align='right'>{{JumSisSep|number_format(0,',',',')}}</th>
                                <th align='right'>Rp. {{JumBimSep|number_format(0,',',',') }}</th>
                                <th align='right'>Rp. {{JumUangSep|number_format(0,',',',') }}</th>

                                <th align='right'>{{JumSisOkt|number_format(0,',',',')}}</th>
                                <th align='right'>Rp. {{JumBimOkt|number_format(0,',',',') }}</th>
                                <th align='right'>Rp. {{JumUangOkt|number_format(0,',',',') }}</th>

                                <th align='right'>{{JumSisNov|number_format(0,',',',')}}</th>
                                <th align='right'>Rp. {{JumBimNov|number_format(0,',',',') }}</th>
                                <th align='right'>Rp. {{JumUangNov|number_format(0,',',',') }}</th>

                                <th align='right'>{{JumSisDes|number_format(0,',',',')}}</th>
                                <th align='right'>Rp. {{JumBimDes|number_format(0,',',',') }}</th>
                                <th align='right'>Rp. {{JumUangDes|number_format(0,',',',') }}</td>

                                <th align='right'>{{JumSisTot|number_format(0,',',',')}}</th>
                                <th align='right'>Rp. {{JumBimTot|number_format(0,',',',') }}</th>
                                <th align='right'>Rp. {{JumUangTot|number_format(0,',',',') }}</td>
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
