
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
	{% set no=0%}
        <tr>
            <th width="40px" rowspan="2">No</th>
            <th width="140px" rowspan="2">Tanggal</th>
			 <th width="140px" rowspan="2">kode cabang</th>
			 <th width="200px" rowspan="3">Nama Cabang</th>
            <th width="200px" rowspan="2">Jumlah barang</th>
            <th width="200px" rowspan="3"  colspan="2" >barang yang kurang</th>
           
        </tr>
    </thead>
    <tbody>
	{% if result is not empty %}
					{% for list in result %}
						{% set no=no+1 %}
						<tr>
							<td  bgcolor="#FFEBCD" width="40px" align="center">{{no}}</td>
							<td  bgcolor="#FFEBCD" width="140px" align="center">{{list.DeliveryReqDate}}</td>
							<td  bgcolor="#FFEBCD" width="140px" align="center" >{{list.KodeAreaCabang}}</td>
							<td  bgcolor="#FFEBCD" width="200px" >{{list.NamaAreaCabang}}</td>
							{% set kurang=list.jumlah-list.kurang %}
							<td bgcolor="#FFEBCD" width="200px" align="center" >{{list.jumlah|number_format(0,',','.')}}</td>
							<td  bgcolor="#FFEBCD" width="200px" align="center"  colspan="2">{{kurang|number_format(0,',','.')}}</td>
							
						</tr>	
					{% endfor %}
				{% endif %}
        
		
		
    </tbody>
</table>
{#
{% if page.total_pages > 1 %}
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("rptrekapcabang/view", "First", 'class':'button') }}
    {{ link_to("rptrekapcabang/view?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("rptrekapcabang/view?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("rptrekapcabang/view?page="~page.last, "Last", 'class':'button') }}
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
