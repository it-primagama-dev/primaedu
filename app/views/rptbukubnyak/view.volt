
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}
{% set lastKodeCabang = '' %}{% set currKodeCabang = '' %}


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
						<a href="#" id="downloadBtn" class="btn"><img src="{{ url('img/Excel-icon.png') }}"></a>
                        <a href="javascript::void();" onclick="window.print();" id="printLink" class="btn"><img src="{{ url('img/printer-icon.png') }}"></a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h3 class="text-right" style="margin:4px 0">&nbsp;</h3>
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
            <th width="40px">#</th>
            <th width="120px">Nama Area</th>
            <th width="260px">Kode / Nama Cabang</th>
            <th width="300px">Jumlah Buku</th>
        </tr>

    </thead>
    <tbody>
	
                    {% if result is not empty %}
                        {% for list in result %}
                            {% set currKodeCabang = list.KodeCabang %}
                <tr>
                    <td>{{ loop.index }}</td>
                    <td>{{ list.Area }}</td>
                    <td>{{ list.KodeCabang|trim~' / '~list.NamaCabang }}</td>
                    <td class="text-center">{{ list.Jumlahqty|number_format(0,',','.') }}</td>
 

              </tr>
	
				
                {% set lastKodeCabang = currKodeCabang %}



            {% endfor %}



		
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
    {{ link_to("rptrekapsiswabnyk/view", "First", 'class':'button') }}
    {{ link_to("rptrekapsiswabnyk/view?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("rptrekapsiswabnyk/view?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("rptrekapsiswabnyk/view?page="~page.last, "Last", 'class':'button') }}
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
