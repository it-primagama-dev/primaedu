
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set sumB1 = 0 %}{% set sumB2 = 0 %}{% set sumB3 = 0 %}
{% set sumS1 = 0 %}{% set sumS2 = 0 %}{% set sumS3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
{% set subB1 = 0 %}{% set subB2 = 0 %}{% set subB3 = 0 %}
{% set subS1 = 0 %}{% set subS2 = 0 %}{% set subS3 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
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
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>
                        <a href="javascript::void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3 style="margin: 4px 0">Area : {{ rpt_area }}, Cabang : {{ rpt_cabang }}</h3>
                    </td>
                    <td>
                        <h3 class="text-right" style="margin:4px 0">Periode : {{ periode }}</h3>
                    </td>
                </tr>
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="7"><hr color="#000000"/></td>
    </tr>
</table>
<table class="table bordered hovered table2excel" style="table-layout: fixed; border-collapse: collapse">
    <thead>
        <tr>
            <th width="40px" rowspan="2">#</th>
            <th width="140px" rowspan="2">Nama Jenjang</th>
            <th width="220px" rowspan="2">Nama Program</th>
            <th width="220px" rowspan="2">Jumlah Siswa</th>
        </tr>
    </thead>
    <tbody>
        {% if result is not empty %}
            {% for list in result %}
                {% set sumD1 += list.PendaftaranLalu %}{% set sumD2 += list.Pendaftaran %}
                {% set sumD3 += list.PendaftaranLalu+list.Pendaftaran %}
                {% set sumB1 += list.BimbinganLalu %}{% set sumB2 += list.Bimbingan %}
                {% set sumB3 += list.BimbinganLalu+list.Bimbingan %}
                {% set sumS1 += list.JumlahSiswaLalu %}{% set sumS2 += list.JumlahSiswa %}
                {% set sumS3 += list.JumlahSiswaLalu+list.JumlahSiswa %}
                {% set currarea = list.NamaJenjang %}

                {% set subD1 += list.PendaftaranLalu %}{% set subD2 += list.Pendaftaran %}
                {% set subD3 += list.PendaftaranLalu+list.Pendaftaran %}
                {% set subB1 += list.BimbinganLalu %}{% set subB2 += list.Bimbingan %}
                {% set subB3 += list.BimbinganLalu+list.Bimbingan %}
                {% set subS1 += list.JumlahSiswaLalu %}{% set subS2 += list.JumlahSiswa %}
                {% set subS3 += list.JumlahSiswaLalu+list.JumlahSiswa %}
                <tr>
                    <td>{{ loop.index }}</td>
                    <td>{{ list.NamaJenjang }}</td>
                    <td>{% if list.NamaProgram is defined %}{{ list.NamaProgram }}{% endif %}</td>
                    <td class="text-center">{{ (list.JumlahSiswaLalu+list.JumlahSiswa)|number_format(0,',','.') }}</td>
                </tr>
                {% set lastarea = currarea %}
            {% endfor %}
            <tr style="background: #f5f5f5;">
                <th colspan="3" class="text-right">Grand Total</th>
                <th class="text-center">{{ sumS3|number_format(0,',','.') }}</th>
            </tr>
        {% else %}
            <tr>
                <td colspan="12" align="center">- Tidak Ada Data -</td>
            </tr>
        {% endif %}
    </tbody>
</table>
{#
{% if page.total_pages > 1 %}
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("rptjenjangsiswa/view", "First", 'class':'button') }}
    {{ link_to("rptjenjangsiswa/view?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("rptjenjangsiswa/view?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("rptjenjangsiswa/view?page="~page.last, "Last", 'class':'button') }}
</div>
{% endif %}
#}
<script>
    $('#downloadBtn').on('click', function () {
        $(".table2excel").table2excel({
            exclude: ".noExl",
            name: "Primaedu",
            filename: "{{ rpt_title }}.xls"
        });
    });
</script>
