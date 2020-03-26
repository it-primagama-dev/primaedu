
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set sumB1 = 0 %}{% set sumB2 = 0 %}{% set sumB3 = 0 %}
{% set sumS1 = 0 %}{% set sumS2 = 0 %}{% set sumS3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}{% set subD4 = 0 %}
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
						<a href="#" id="downloadBtn" class="btn"><img src="{{ url('img/Excel-icon.png') }}"></a>
                        <a href="javascript::void();" onclick="window.print();" id="printLink" class="btn"><img src="{{ url('img/printer-icon.png') }}"></a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
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
            <th width="40px">#</th>
            <th width="120px">Nama Area</th>
            <th width="280px">Kode / Nama Cabang</th>
            <th width="100px">Total Siswa Cabang</th>
			<th width="150px">Jum. Biaya Bimbingan</th>
			<th width="100px">Total Siswa Settle</th>
			<th width="150px">Jum. Pemby. dari VA</th>
			
        </tr>

    </thead>
    <tbody>
        {% if result is not empty %}
            {% for list in result %}
				
				{% if currarea != lastarea and not loop.first %}
					<tr style="background: #f5f5f5;">
						<th colspan="3" class="text-center">Total {{ lastarea }}</th>
						<th class="text-center">{{ subD1|number_format(0,',','.') }}</th>
						<th class="text-center">{{ subD2|number_format(0,',','.') }}</th>
						<th class="text-center">{{ subD3|number_format(0,',','.') }}</th>
						<th class="text-center">{{ subD4|number_format(0,',','.') }}</th>
					
					</tr>
					{% set subD1 = 0 %}
				{% endif %}
				{% set subD1 += list.jum_a %}
				{% set subD2 += list.nilai_a %}
				{% set subD3 += list.jum_b %}
				{% set subD4 += list.nilai_b %}
				
                <tr>
                    <td>{{ loop.index }}</td>
                    <td>{{ list.NamaArea }}</td>
                    <td>{{ list.KodeCabang|trim~' / '~list.NamaCabang }}</td>
                    <td class="text-center">{{ list.jum_a|number_format(0,',','.') }}</td>
                    <td class="text-right">{{ list.nilai_a|number_format(0,',','.') }}</td>
                    <td class="text-center">{{ list.jum_b|number_format(0,',','.') }}</td>
                    <td class="text-right">{{ list.nilai_b|number_format(0,',','.') }}</td>
                  
                </tr>
                {% set lastarea = currarea %}
            {% endfor %}
			 <tr style="background: #f5f5f5;">
                <th colspan="3" class="text-center">Total {{ lastarea }}</th>
                <th class="text-center">{{ subD1|number_format(0,',','.') }}</th>
                <th class="text-right">{{ subD2|number_format(0,',','.') }}</th>
                <th class="text-center">{{ subD3|number_format(0,',','.') }}</th>
                <th class="text-right">{{ subD4|number_format(0,',','.') }}</th>
                
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
    {{ link_to("rptrekapsiswabnykarea/view", "First", 'class':'button') }}
    {{ link_to("rptrekapsiswabnykarea/view?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("rptrekapsiswabnykarea/view?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("rptrekapsiswabnykarea/view?page="~page.last, "Last", 'class':'button') }}
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
