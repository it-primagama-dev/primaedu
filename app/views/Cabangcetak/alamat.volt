
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
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>
                        <a href="javascript:void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
                    </td>
                </tr>
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="7">
            <table class="table bordered hovered table2excel" style="width: 100%; border-collapse: collapse">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Area</th>
                        <th width="10%">Kode Cabang</th>
                        <th width="30%">Nama Cabang</th>
                        <th width="40%">Alamat</th>
                        <th width="40%">Telp Cabang</th>
                        <th width="40%">Nama / No Hp Manager</th>
                    
                    </tr>
                </thead>
                <tbody>

                    {% if result is not empty %}
                        {% for list in result %}
                                <tr class="text-right">
                                    <td class="text-center"> {{ loop.index }}</td>
                                    <td class="text-center"> {{ list.area }}</td>
                                    <td class="text-center"> '{{ list.KodeCabang }}</td>
                                    <td class="text-left"> {{ list.cabang }}</td>
                                    <td class="text-left"> {{ list.alamat }}</td>
                                    <td class="text-left"> '{{ list.telp }}</td>
                                    <td class="text-left">{{ list.namamanager }} / '{{ list.nohp }}</td>
                                    <td></td>
                                    
                                
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
