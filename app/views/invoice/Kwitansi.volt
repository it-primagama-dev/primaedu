
{{ content() }}
<style type="text/css">
    @media print{@page {size: A4 potrait}}
</style>

<table style="width:100%;" >
    <tr>
        <td colspan="7">
            <table style="width:90%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="220"></td>
                    <td align="center" width="75%">
                        <h2><u>{{ rpt_title }}  {{reqid}}</u></h2>
                    </td>
                    <td width="20%" align="left">
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-left">Download</a>
                        <a href="javascript::void();" onclick="window.print();" id="printLink" class="btn btn-success pull-left">Print</a>
                    </td>
					 </td>
                </tr>
			</table>
		</td>
    </tr>	

teeeeeeeeeeeeeeeesssssssssssssssssss	
				
    
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

