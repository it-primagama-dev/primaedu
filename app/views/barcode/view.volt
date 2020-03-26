
{{ content() }}
<title>{{ rpt_title }}</title>
{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
<table class="tablePrint" style="width:900px">
    <tr>
        <td colspan="7">
            <table style="width:100%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="125%"></td>
                    <td align="center" width="60%">
                        <h2><u>Data Barcode Cabang</u></h2>
                    </td>
                    <td width="22%" align="right">
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>
                        <a href="javascript:void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3 style="margin: 4px 0">Cabang : {{ rpt_namacabang }}</h3>
                    </td>
                    <td>
                        <h3 class="text-right" style="margin: 4px 0">{{ rpt_pr2 }}</h3>
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
            <table class="table bordered hovered table2excel" style="width: 100%; border-collapse: collapse">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="25%">Cabang</th>
                        <th width="20%">Kode Pembelian</th>
                        <th width="15%">Barcode</th>
                        <th width="35%">Jenis Buku</th>
                    </tr>
                </thead>

                <tbody>
                    {% set total=0 %}
                    {% if page.items is not empty %}
                            {% for list in page.items %}                
                            
                            <tr class="text-center">
                                 <td>{{ loop.index }}</td>
                                <td class="text-center">{{ rpt_namacabang }}</td>
                                <td class="text-center">{{ list.PurchReqId }}</td>
                                <td class="text-center">{{ list.Barcode }}</td>
                                <td align="center">{{ list.NamaItem }}</td>
                        {% endfor %}
                    {% else %}

                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>

                {% if loop.last %}
                {% set total=1 %}
                   
             {% endif %}

            {% endif %}

                    <tr>
                        <th colspan='4' align='center'>TOTAL BARCODE</th>

                    {% if jumlahpr is not empty %}
                        {% for list in jumlahpr %}
                        <th  align='center' center colspan='1'>{{list.jumlahpr}} </th>
                        {% endfor %}
                    {% endif %}
                        
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
