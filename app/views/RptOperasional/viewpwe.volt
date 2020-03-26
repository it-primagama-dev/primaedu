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
                        <th style="width: 1%" rowspan="2">No</th>
                        <th style="width: 3%" rowspan="2">Kode Cabang</th>
                        <th style="width: 6%" rowspan="2">Nama Cabang</th>
                        <th style="width: 5%" colspan="4">Januari</th>
                        <th style="width: 5%" colspan="4">Februari</th>
                        <th style="width: 5%" colspan="4">Maret</th>
                        <th style="width: 5%" colspan="4">April</th>
                        <th style="width: 5%" colspan="4">Mei</th>
                        <th style="width: 5%" colspan="4">Juni</th>
                        <th style="width: 5%" colspan="4">Juli</th>
                        <th style="width: 5%" colspan="4">Agustus</th>
                        <th style="width: 5%" colspan="4">September</th>
                        <th style="width: 5%" colspan="4">Oktober</th>
                        <th style="width: 5%" colspan="4">November</th>
                        <th style="width: 5%" colspan="4">Desember</th>
                        <th style="width: 10%" colspan="4">Jumlah Total</th>
                        <th style="width: 2%" rowspan="2">Prosentase Mencapai Target</th>
                        <th style="width: 3%" rowspan="2">Rata2 Harga Jual</th>
                        <th style="width: 2%" rowspan="2">Persentase Uang Masuk</th>
                    </tr>
                    <tr>
                        <th style="width: 1%">Siswa</th>
                        <th style="width: 2%">Biaya Pendaftaran</th>
                        <th style="width: 2%">Biaya Bimbingan</th>
                        <th style="width: 2%">Uang Masuk</th>
                        <th style="width: 1%">Siswa</th>
                        <th style="width: 2%">Biaya Pendaftaran</th>
                        <th style="width: 2%">Biaya Bimbingan</th>
                        <th style="width: 2%">Uang Masuk</th>
                        <th style="width: 1%">Siswa</th>
                        <th style="width: 2%">Biaya Pendaftaran</th>
                        <th style="width: 2%">Biaya Bimbingan</th>
                        <th style="width: 2%">Uang Masuk</th>
                        <th style="width: 1%">Siswa</th>
                        <th style="width: 2%">Biaya Pendaftaran</th>
                        <th style="width: 2%">Biaya Bimbingan</th>
                        <th style="width: 2%">Uang Masuk</th>
                        <th style="width: 1%">Siswa</th>
                        <th style="width: 2%">Biaya Pendaftaran</th>
                        <th style="width: 2%">Biaya Bimbingan</th>
                        <th style="width: 2%">Uang Masuk</th>
                        <th style="width: 1%">Siswa</th>
                        <th style="width: 2%">Biaya Pendaftaran</th>
                        <th style="width: 2%">Biaya Bimbingan</th>
                        <th style="width: 2%">Uang Masuk</th>
                        <th style="width: 1%">Siswa</th>
                        <th style="width: 2%">Biaya Pendaftaran</th>
                        <th style="width: 2%">Biaya Bimbingan</th>
                        <th style="width: 2%">Uang Masuk</th>
                        <th style="width: 1%">Siswa</th>
                        <th style="width: 2%">Biaya Pendaftaran</th>
                        <th style="width: 2%">Biaya Bimbingan</th>
                        <th style="width: 2%">Uang Masuk</th>
                        <th style="width: 1%">Siswa</th>
                        <th style="width: 2%">Biaya Pendaftaran</th>
                        <th style="width: 2%">Biaya Bimbingan</th>
                        <th style="width: 2%">Uang Masuk</th>
                        <th style="width: 1%">Siswa</th>
                        <th style="width: 2%">Biaya Pendaftaran</th>
                        <th style="width: 2%">Biaya Bimbingan</th>
                        <th style="width: 2%">Uang Masuk</th>
                        <th style="width: 1%">Siswa</th>
                        <th style="width: 2%">Biaya Pendaftaran</th>
                        <th style="width: 2%">Biaya Bimbingan</th>
                        <th style="width: 2%">Uang Masuk</th>
                        <th style="width: 1%">Siswa</th>
                        <th style="width: 2%">Biaya Pendaftaran</th>
                        <th style="width: 2%">Biaya Bimbingan</th>
                        <th style="width: 2%">Uang Masuk</th>
                        <th style="width: 2%">Siswa</th>
                        <th style="width: 4%">Biaya Pendaftaran</th>
                        <th style="width: 4%">Biaya Bimbingan</th>
                        <th style="width: 4%">Uang Masuk</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    {% if result is not empty %} 
                        {% for list in result %}
                            {% set JumSis = list.SisJan+list.SisFeb+list.SisMar+list.SisApr+list.SisMei+list.SisJun+list.SisJul+list.SisAgu+list.SisSep+list.SisOkt+list.SisNov+list.SisDes %}
                            {% set JumBim = list.BimJan+list.BimFeb+list.BimMar+list.BimApr+list.BimMei+list.BimJun+list.BimJul+list.BimAgu+list.BimSep+list.BimOkt+list.BimNov+list.BimDes %}
                            {% set JumPen = list.PenJan+list.PenFeb+list.PenMar+list.PenApr+list.PenMei+list.PenJun+list.PenJul+list.PenAgu+list.PenSep+list.PenOkt+list.PenNov+list.PenDes %}
                            {% set JumUang = list.UangJan+list.UangFeb+list.UangMar+list.UangApr+list.UangMei+list.UangJun+list.UangJul+list.UangAgu+list.UangSep+list.UangOkt+list.UangNov+list.UangDes %}
                            {% set PersentaseTarget = (JumBim/list.TargetNilai)*100 %}
                            {% set Rata2Harga = JumBim/JumSis %}
                            {% set Pertumbuhan = PersentaseTarget-list.TargetPersentase %}
                            {% set PersentaseUangMasuk = (JumUang/JumBim)*100 %}
                            <tr class="text-center">
                                <td class="text-center">{{ loop.index }}</td>
                                <td> '{{ list.KodeAreaCabang }} </td>
                                <td align='left' >{{list.NamaAreaCabang}}</td>
                                <td align='right'>{{list.SisJan|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.PenJan|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.BimJan|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangJan|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisFeb|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.PenFeb|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.BimFeb|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangFeb|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisMar|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.PenMar|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.BimMar|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangMar|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisApr|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.PenApr|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.BimApr|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangApr|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisMei|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.PenMei|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.BimMei|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangMei|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisJun|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.PenJun|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.BimJun|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangJun|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisJul|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.PenJul|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.BimJul|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangJul|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisAgu|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.PenAgu|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.BimAgu|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangAgu|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisSep|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.PenSep|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.BimSep|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangSep|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisOkt|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.PenOkt|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.BimOkt|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangOkt|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisNov|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.PenNov|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.BimNov|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangNov|number_format(0,',',',') }}</td>

                                <td align='right'>{{list.SisDes|number_format(0,',',',')}}</td>
                                <td align='right'>Rp. {{list.PenDes|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.BimDes|number_format(0,',',',') }}</td>
                                <td align='right'>Rp. {{list.UangDes|number_format(0,',',',') }}</td>

                                <td align='right'><strong>{{JumSis|number_format(0,',',',')}}</strong></td>
                                <td align='right'><strong>Rp. {{JumPen|number_format(0,',',',') }}</strong></td>
                                <td align='right'><strong>Rp. {{JumBim|number_format(0,',',',') }}</strong></td>
                                <td align='right'><strong>Rp. {{JumUang|number_format(0,',',',') }}</strong></td>
                                
                                <td align='center'><strong>{{Number.round(PersentaseTarget)}}%</strong></td>
                                <td align='right'><strong>Rp. {{Rata2Harga|number_format(0,',',',') }}</strong></td>
                                <td align='center'><strong>{{Number.round(PersentaseUangMasuk) }}%</strong></td>

                            </tr>
                            {% set JumSisJan += list.SisJan %}
                            {% set JumPenJan += list.PenJan %}
                            {% set JumBimJan += list.BimJan %}
                            {% set JumUangJan += list.UangJan %}

                            {% set JumSisFeb += list.SisFeb %}
                            {% set JumPenFeb += list.PenFeb %}
                            {% set JumBimFeb += list.BimFeb %}
                            {% set JumUangFeb += list.UangFeb %}

                            {% set JumSisMar += list.SisMar %}
                            {% set JumPenMar += list.PenMar %}
                            {% set JumBimMar += list.BimMar %}
                            {% set JumUangMar += list.UangMar %}

                            {% set JumSisApr += list.SisApr %}
                            {% set JumPenApr += list.PenApr %}
                            {% set JumBimApr += list.BimApr %}
                            {% set JumUangApr += list.UangApr %}

                            {% set JumSisMei += list.SisMei %}
                            {% set JumPenMei += list.PenMei %}
                            {% set JumBimMei += list.BimMei %}
                            {% set JumUangMei += list.UangMei %}

                            {% set JumSisJun += list.SisJun %}
                            {% set JumPenJun += list.PenJun %}
                            {% set JumBimJun += list.BimJun %}
                            {% set JumUangJun += list.UangJun %}

                            {% set JumSisJul += list.SisJul %}
                            {% set JumPenJul += list.PenJul %}
                            {% set JumBimJul += list.BimJul %}
                            {% set JumUangJul += list.UangJul %}

                            {% set JumSisAgu += list.SisAgu %}
                            {% set JumPenAgu += list.PenAgu %}
                            {% set JumBimAgu += list.BimAgu %}
                            {% set JumUangAgu += list.UangAgu %}

                            {% set JumSisSep += list.SisSep %}
                            {% set JumPenSep += list.PenSep %}
                            {% set JumBimSep += list.BimSep %}
                            {% set JumUangSep += list.UangSep %}

                            {% set JumSisOkt += list.SisOkt %}
                            {% set JumPenOkt += list.PenOkt %}
                            {% set JumBimOkt += list.BimOkt %}
                            {% set JumUangOkt += list.UangOkt %}

                            {% set JumSisNov += list.SisNov %}
                            {% set JumPenNov += list.PenNov %}
                            {% set JumBimNov += list.BimNov %}
                            {% set JumUangNov += list.UangNov %}

                            {% set JumSisDes += list.SisDes %}
                            {% set JumPenDes += list.PenDes %}
                            {% set JumBimDes += list.BimDes %}
                            {% set JumUangDes += list.UangDes %}

                            {% set JumSisTot += JumSis %}
                            {% set JumPenTot += JumPen %}
                            {% set JumBimTot += JumBim %}
                            {% set JumUangTot += JumUang %}
                            
                            {% set Rata2HargaTot += Rata2Harga %}
                        {% endfor %}
                    {% endif %}
                    <tr>
                        <th colspan='3' align='center'>Total</th>

                        <th align='right'>{{JumSisJan|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenJan|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimJan|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangJan|number_format(0,',',',') }}</th>

                        <th align='right'>{{JumSisFeb|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenFeb|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimFeb|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangFeb|number_format(0,',',',') }}</th>

                        <th align='right'>{{JumSisMar|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenMar|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimMar|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangMar|number_format(0,',',',') }}</th>

                        <th align='right'>{{JumSisApr|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenApr|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimApr|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangApr|number_format(0,',',',') }}</th>

                        <th align='right'>{{JumSisMei|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenMei|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimMei|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangMei|number_format(0,',',',') }}</th>

                        <th align='right'>{{JumSisJun|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenJun|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimJun|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangJun|number_format(0,',',',') }}</th>

                        <th align='right'>{{JumSisJul|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenJul|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimJul|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangJul|number_format(0,',',',') }}</th>

                        <th align='right'>{{JumSisAgu|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenAgu|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimAgu|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangAgu|number_format(0,',',',') }}</th>

                        <th align='right'>{{JumSisSep|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenSep|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimSep|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangSep|number_format(0,',',',') }}</th>

                        <th align='right'>{{JumSisOkt|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenOkt|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimOkt|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangOkt|number_format(0,',',',') }}</th>

                        <th align='right'>{{JumSisNov|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenNov|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimNov|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangNov|number_format(0,',',',') }}</th>

                        <th align='right'>{{JumSisDes|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenDes|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimDes|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangDes|number_format(0,',',',') }}</td>

                        <th align='right'>{{JumSisTot|number_format(0,',',',')}}</th>
                        <th align='right'>Rp. {{JumPenTot|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumBimTot|number_format(0,',',',') }}</th>
                        <th align='right'>Rp. {{JumUangTot|number_format(0,',',',') }}</td>
                            
                        <th align='center'></th>
                        <th align='right'>Rp. {{Rata2HargaTot|number_format(0,',',',') }}</th>
                        <th align='center'></td>
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
