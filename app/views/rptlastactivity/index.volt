<h1>
    Aktifitas Cabang
</h1>

{{ content() }}

{{ javascript_include('js/jquery/jquery.dataTables.js') }}
<style type="text/css">
    .metro .dataTables_wrapper .dataTables_paginate span span {
        display: block;
        float: left;
        padding: 4px;
        line-height: 16px;
        font-size: 14px;
        margin-right: 1px;
        margin: auto;
        border: 1px transparent solid
    }
    .metro .dataTables_wrapper #DataTables_Table_0 .dataTables_empty {
        text-align: center
    }
</style>
{#
{% set group = '' %}
{% set sumD1 = 0 %}{% set sumD2 = 0 %}
{% set sumD3 = 0 %}{% set sumD4 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}
{% set subD3 = 0 %}{% set subD4 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}
#}
<div class="grid fluid no-margin">
    <div class="row">
        <div class="span12">
            <table class="table striped bordered hovered dataTable">
                <thead>
                    <tr>
                        <th width="14%">Nama Area</th>
                        <th width="9%">Kode Cabang</th>
                        <th>Nama Cabang</th>
                        <th width="12%">Jumlah Siswa</th>
                        <th width="12%">Transaksi Pembayaran</th>
                        <th width="12%">Jumlah Users</th>
                        <th width="16%">Login Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    {#% if result is not empty %}
                        {% for list in result %}
                            {% set sumD1 += list.JumlahUsers %}
                            {% set sumD2 += list.JumlahSiswa %}
                            {% set sumD3 += list.TransaksiPembayaran %}
                            {% set currarea = list.NamaArea %}
                            {% set subD1 += list.JumlahUsers %}
                            {% set subD2 += list.JumlahSiswa %}
                            {% set subD3 += list.TransaksiPembayaran %}
                            <tr>
                                <td>{{ loop.index }}</td>
                                <td>{{ list.NamaArea }}</td>
                                <td class="text-center">{{ list.KodeCabang|trim }}</td>
                                <td>{{ list.NamaCabang }}</td>
                                <td class="text-center">{{ list.JumlahSiswa|number_format(0,',','.') }}</td>
                                <td class="text-center">{{ list.TransaksiPembayaran|number_format(0,',','.') }}</td>
                                <td class="text-center">{{ list.JumlahUsers|number_format(0,',','.') }}</td>
                                <td class="text-center">{{ list.LoginTerakhir }}</td>
                            </tr>
                            {% set lastarea = currarea %}
                        {% endfor %}
                    {% else %}
                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>
                    {% endif %#}
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.dataTable').on('processing.dt', function () {
        $('.loader').toggleClass('show');
    }).dataTable({
        "deferRender": true,
        "ajax": "{{ url('rptlastactivity/data') }}",
        "columns": [
            {"data": "NamaArea"},
            {"data": "KodeCabang"},
            {"data": "NamaCabang"},
            {"data": "JumlahSiswa"},
            {"data": "TransaksiPembayaran"},
            {"data": "JumlahUsers"},
            {"data": "LoginTerakhir"},
        ],
        language: {
            zeroRecords: "Tidak Ada Data"
        }
    });
</script>