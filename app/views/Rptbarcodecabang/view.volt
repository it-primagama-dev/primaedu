<br>
{{ content() }}
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
                    <td align="center"></td>
                    <td align="center" width="60%">
                        <h2><u>Data Barcode Cabang</u></h2>
                    </td>
                    <td width="22%" align="right">
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>
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
                        <th width="25%">PR / Kode Pembelian</th>
                        <th width="20%">Barcode</th>
                        <th width="30%">Nama Buku</th>
                        <th width="20%">Status</th>
                    </tr>
                </thead>

                <tbody>
                    {% set total=0 %}
                    {% if page.items is not empty %}
                            {% for list in page.items %}                
                            
                            <tr class="text-center">
                                 <td>{{ loop.index }}</td>

                                {% if stok == 1 OR list.ApprovalDate <= '2017-06-01' %}
                                <td class="text-center">Barcode Lama</td>
                                {% else %}
                                <td class="text-center">{{ list.PurchReqId }}</td>
                                {% endif %}
                                <td class="text-center">{{ list.Barcode }}</td>
                                <td align="center">{{ list.NamaBuku }}
                                </td>
                                <td align="center">
                                {% if list.status == "0" %}
                                <font color="green">Belum digunakan</font>
                                {% elseif list.status == "1" %}
                                <font color="red">Sudah digunakan</font>
                                {% else %}

                                {% endif %}
                                </td>
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
                        {% set sdhdigunakan = list.jumlahpr %}
                        <th  align='center' center colspan='1'>{{list.jumlahpr}} </th>
                        {% endfor %}
                    {% endif %}
                        
                    <tr>
                    <tr>
                        <th colspan='4' align='center'>BARCODE DIGUNAKAN</th>

                    {% if jumlahpr1 is not empty %}
                        {% for list1 in jumlahpr1 %}
                        {% set digunakan = list1.jumlahpr %}
                        <th  align='center' center colspan='1'>{{list1.jumlahpr}} </th>
                        {% endfor %}
                    {% endif %}
                        
                    <tr>
                    <tr>
                        <th colspan='4' align='center'>SISA BARCODE</th>

                        <th  align='center' center colspan='1'>{{ sdhdigunakan - digunakan }} </th>
                        
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
