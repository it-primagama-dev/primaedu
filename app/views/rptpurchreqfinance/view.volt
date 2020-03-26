
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}
<style type="text/css">
    @media print {@page {size: A4 landscape}}
    .text-top { vertical-align: top }
</style>
<table class="tablePrint" style="width:100%;">
    <tr>
        <td colspan="7">
            <table style="width:100%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="125%"></td>
                    <td align="center" width="60%">
                        <h2><u>{{ rpt_title }}</u></h2>
                    </td>
                    <td width="22%" align="right">
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>
                        <a href="javascript:void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="text" style="margin: 4px 0">Periode : {{ tgl_awal }} S/d {{ tgl_akhir }}</h3>
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
                        <th width="10%">Kode PR</th>
                        <th width="20%">Nama PR</th>
                        <th width="10%">Kode Buku</th>
                        <th width="15%">Nama Buku</th>
                         <th width="5%">Jumlah Pembelian</th>
                        <th width="10%">Total Pembayaran</th>
                         <th width="12%">Tanggal Submit</th>
                         <th width="13%">Tanggal Approved</th>
                    </tr>
                </thead>

                <tbody>
                {% set totsis=0 %}
                    {% if result is not empty %}
                        {% for list in result %}
                         
                               
                                                        
                                <tr class="text-center">
                                 
                                <td>{{ loop.index }}</td>
                                <td>{{ list.KodePR }}</td>
                                <td class="text-left">{{ list.PurchReqName|upper }}</td>
                               
                                <td class="text-left">{{ list.ItemId }}</td>
                                <td class="text-left">{{ list.ItemName }}</td>
                                <td class="text-center">{{ list.pembelian }}</td>
                                <td class="text-center">Rp {{ list.Uang_masuk|number_format(0,',','.') }}</td>
                                <td class="text-center" >{{ list.TglSubmit }} </td>
                                <td class="text-center" >{{ list.TglApproved }} </td>
                                    
                        {% endfor %}
                    {% else %}

                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>

                {% if loop.last %}
                   
             {% endif %}

            {% endif %}
            
            {% if result3 is not empty %}
                        {% for list in result3 %}
                        
                        {% set biayamd+= list.JumlahTotalmd %}
                        {% set pembayaranmd+= list.Uang_masukmd%}

            {% endfor %}
                    {% else %}

                {% if loop.last %}
                   
             {% endif %}

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
