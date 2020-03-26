
{{ content() }}

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
                        <h3 style="margin: 4px 0">Cabang: {% for list2  in result2  %}{{ list2.KodeAreaCabang}}- {{ list2.NamaAreaCabang}}{% endfor %}</h3>
                    </td>
                    <td>
                        <h3 class="text-right" style="margin:4px 0"></h3>
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
            <th width="220px" rowspan="2">Nama Siswa</th>
            <th width="220px" rowspan="2">No Dokumen</th>
            <th width="220px" rowspan="2">Tanggal Pembayaran  </th>
            <th width="220px" rowspan="2">Jumlah Bimbingan Yang Diinput Admin</th>
        </tr>
    </thead>
    <tbody>
        {% if result3 is not empty %}
            {% for list in result3 %}
                <tr>
                    <td>{{ loop.index }}</td>
                    <td>{{ list.NamaSiswa }}</td>
                    <td class="text-center">{{ (list.DocumentNo) }}</td>
                    <td class="text-center">{{ (list.TanggalPembayaran)}}</td>
                    <td class="text-center">{{ (list.JUMLAHBIMBINGAN )|number_format(0,',','.') }}{% set sumnom += list.JUMLAHBIMBINGAN %}</td>
                    

                </tr>
                {% set lastarea = currarea %}
            {% endfor %}
           <td></td>
           <td></td>
           <td></td>
           <td class="text-center">Jumlah Pembayaran</td>
           <td class="text-center" >Rp.{{ sumnom|number_format(0,',','.')}} </td>
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
    {{ link_to("Rptsiswacabangauditdetail2/view", "First", 'class':'button') }}
    {{ link_to("Rptsiswacabangauditdetail2/view?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("Rptsiswacabangauditdetail2/view?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("Rptsiswacabangauditdetail2/view?page="~page.last, "Last", 'class':'button') }}
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
