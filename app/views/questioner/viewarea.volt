
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}{% set sumD4 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}{% set subD4 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %} {% set lines = '' %}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
{% set lines = '' %}
<table class="tablePrint" style="width:900px">
    <tr>
        <td colspan="7"> 
            <table style="width:100%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="125%"></td>
                    <td align="center" width="64%">
                        <h2><u>{{ rpt_title }}</u></h2>
                    </td>
                    <td width="18%" align="right">
                        <a href="#" id="downloadBtn" class="button">Download</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <h4 style="margin: 4px 0">Area : {{ rpt_area }}</h4>
                    </td>
                </tr>
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="7">
    <br>
            <table class="table bordered hovered table2excel" style="width: 100%; border-collapse: collapse">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="75%">Pertanyaan</th>
                        <th width="20%">Bobot</th>
                    </tr>
                </thead>
                <tbody>

                    {% set lines = '' %}
                    {% if result is not empty %}
                        {% for list in result %}
                        {% set jumlahbobot += list.bobot|number_format(2,',','.') %}
                            <tr>
                                <td>{{ loop.index }}</td>
                                <td>{{ list.pertanyaan }}</td>
                                <td class="text-center">{{ list.Bobot|number_format(2,'.','.') }}</td> 
                            </tr>
                        {% endfor %}
                    {% else %}
                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>
                    {% endif %}
                </tbody>

                        {% for list1 in result1 %}
                            <tr>
                                <td colspan="2"><b>Jumlah Responden</b></td>
                                <td colspan="1" class="text-center"><b>{{ list1.Responden }}</b></td> 
                            </tr>
                        {% endfor %}
                        {% for list2 in result2 %}
                            <tr>
                                <td colspan="2"><b>Total Responden</b></td>
                                <td colspan="1" class="text-center"><b>{{ list2.TotalResponden }}</b></td> 
                            </tr>
                        {% endfor %}
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
