
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set sumB1 = 0 %}{% set sumB2 = 0 %}{% set sumB3 = 0 %}
{% set sumS1 = 0 %}{% set sumS2 = 0 %}{% set sumS3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
{% set subB1 = 0 %}{% set subB2 = 0 %}{% set subB3 = 0 %}
{% set subS1 = 0 %}{% set subS2 = 0 %}{% set subS3 = 0 %}

{% set lastarea = '' %}{% set currarea = '' %}

<style type="text/css">
    @media print{@page {size: A4 potrait}}
</style>

<table style="width:100%;">
    <tr>
        <td colspan="7">
            <table style="width:90%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="220"></td>
                    <td align="center" width="75%">
                        <h2><u>{{ rpt_title }}  {{reqid}}</u></h2>
                    </td>
                    <td width="20%" align="left">
                    <strong>{{ date("d-m-Y") }}</strong>
                        <a href="javascript::void();" onclick="window.print();" id="printLink" class="btn btn-success pull-left">Print</a>
                    </td>
                </tr>
				<tr>
				 <td width="100px"  bgcolor="#191970" align="center"><font Color="#FFFFFF">SHIP TO</font></td> 
				 <td align="center"></td> 
				 <td width="100px"  bgcolor="#191970" align="center"><font Color="#FFFFFF">SHIPPER</font></td> 
				 </tr>
                <tr>
                    <td colspan="2" border='1px'>
                        <h3 style="margin: 1px 0">Area : {{ rpt_area }}</h3>
                    </td>
                    
                </tr>
				 <tr>
                    <td colspan="2" border='1px'>
                        <h3 style="margin: 1px 0">Kode Cabang : {{ rpt_cabang }}</h3>
                    </td>
                    
                </tr>
				 <tr>
                    <td colspan="2" border='1px'>
                        <h3 style="margin: 1px 0">Nama Cabang : {{ rpt_namacabang }}</h3>
                    </td>
                    
                </tr>
				<tr>
                    <td colspan="2" border='1px'>
                        <h3 style="margin: 2px 0"> {{ rpt_alamat }} / Contact Person : {{ rpt_hp }}</h3>
                    </td>
                    
                </tr>
            </table>    
        </td>
    </tr>
    
</table>


<table  style="width:100%;" border="1px" align='center'>
	<tr><td width="500px">
		
					<table border="1px" align='center'>
						<tr>
							<td bgcolor="#191970" align="center" colspan="3" width="400px"><font Color="#FFFFFF">KURIKULUM 2006<font></td>  
			 			
						</tr>
						<tr>
							<td  bgcolor="#191970" align="center" ><font Color="#FFFFFF">NO<font></td>
							<td bgcolor="#191970" align="center"><font Color="#FFFFFF">DESCRIPTION<font></td> 
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">ORDER QTY<font></td>    			
						</tr>
						{% set nilai = 0 %}
							 {% if result is not empty %}
								{% for list in result %}
								 {% if list.tahun=="2006"%}
								{% set sum1 += list.Qty %}
								<tr>
									{% set nilai = nilai+1 %}
									<td height="25px" align="center"border='1px'> <font size="2px"><b>{{ nilai }}</b></font></td>
									<td height="25px" align="left"> <font size="2px"><b>{{ list.ItemID }}</b></font> </td>
									<td height="25px" align="right"> <font size="2px"><b>{{ list.Qty |number_format(0,',','.')}}</b></font></td>
									
								</tr>
							
							{% endif %}
							{% endfor %}
							{% endif %}
					
					
						<tr>
							 <td  align="center" colspan="2"><font size="2px"><b>Total</b></font></td>
							<td align="right"><font size="2px"><b>{{ sum1|number_format(0,',','.') }}</b></font></td>  
						</tr>
					
					</table>
			
		</td>
		<!--
		<td width="500px" >
			<table  border="1px" align='center'>
					<tr>
						<td align="center" bgcolor="#191970" colspan="3" width="400px"><font Color="#FFFFFF" >KURIKULUM 2013<font></td>  
					</tr>
					<tr>
							<td   bgcolor="#191970" align="center" ><font Color="#FFFFFF">NO<font></td>
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">DESCRIPTION<font></td> 
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">ORDER QTY<font></td>      
					</tr>	{% set nil = 0 %}
							{% if result is not empty %}
							{% for list in result %}
							 {% if list.tahun=="2013"%}
							{% set sum3 += list.Qty %}
					<tr>	{% set nil = nil+1 %}
									<td height="25px" align="center"> <font size="2px"><b>{{ nil }}</b></font></td>
									<td height="25px" align="left"> <font size="2px"><b>{{ list.ItemID }}</b></font> </td>
									<td height="25px" align="right"> <font size="2px"><b>{{ list.Qty |number_format(0,',','.')}}</b></font></td>
								
					</tr>
						
							{% endif %}
							{% endfor %}
							{% endif %}
					
					
					<tr>
						 <td align="center" colspan="2"><font size="2px"><b>Total</b></font></td>
						<td  align="right"><font size="2px"><b> {{ sum3|number_format(0,',','.') }}</b></font></td>  
					</tr>
			</table>
				
		</td>
		-->
		<td width="500px" >
			<table  border="1px" align='center'>
					<tr>
						<td align="center" bgcolor="#191970" colspan="3" width="400px"><font Color="#FFFFFF" >KURIKULUM NASIONAL<font></td>  
					</tr>
					<tr>
							<td   bgcolor="#191970" align="center" ><font Color="#FFFFFF">NO<font></td>
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">DESCRIPTION<font></td> 
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">ORDER QTY<font></td>      
					</tr>	{% set nil = 0 %}
							{% if result is not empty %}
							{% for list in result %}
							 {% if list.tahun=="ional"%}
							{% set sum3 += list.Qty %}
					<tr>	{% set nil = nil+1 %}
									<td height="25px" align="center"> <font size="2px"><b>{{ nil }}</b></font></td>
									<td height="25px" align="left"> <font size="2px"><b>{{ list.ItemID }}</b></font> </td>
									<td height="25px" align="right"> <font size="2px"><b>{{ list.Qty |number_format(0,',','.')}}</b></font></td>
								
					</tr>
						
							{% endif %}
							{% endfor %}
							{% endif %}
					
					
					<tr>
						 <td align="center" colspan="2"><font size="2px"><b>Total</b></font></td>
						<td  align="right"><font size="2px"><b> {{ sum3|number_format(0,',','.') }}</b></font></td>  
					</tr>
			</table>
				
		</td>

		<td width="500px" >
			<table  border="1px" align='center'>
					<tr>
						<td align="center" bgcolor="#191970" colspan="3" width="400px"><font Color="#FFFFFF" >SMK<font></td>  
					</tr>
					<tr>
							<td   bgcolor="#191970" align="center" ><font Color="#FFFFFF">NO<font></td>
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">DESCRIPTION<font></td> 
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">ORDER QTY<font></td>      
					</tr>	{% set nil = 0 %}
							{% if result is not empty %}
							{% for list in result %}
							 {% if list.tahun=="2 SMK"%}
							{% set sum7 += list.Qty %}
					<tr>	{% set nil = nil+1 %}
									<td height="25px" align="center"> <font size="2px"><b>{{ nil }}</b></font></td>
									<td height="25px" align="left"> <font size="2px"><b>{{ list.ItemID }}</b></font> </td>
									<td height="25px" align="right"> <font size="2px"><b>{{ list.Qty |number_format(0,',','.')}}</b></font></td>
					</tr>
							{% endif %}
							{% endfor %}
							{% endif %}
					<tr>
						 <td align="center" colspan="2"><font size="2px"><b>Total</b></font></td>
						<td  align="right"> <font size="2px"><b>{{ sum7|number_format(0,',','.') }}</b></font></td>  
					</tr>
			</table>
			<!--
			<br>
				<table  border="1px" align='center'>
					<tr>
						<td align="center" bgcolor="#191970" colspan="3" width="400px"><font Color="#FFFFFF" >PIKSTAN<font></td>  
					</tr>
					<tr>
							<td   bgcolor="#191970" align="center" ><font Color="#FFFFFF">NO<font></td>
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">DESCRIPTION<font></td> 
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">ORDER QTY<font></td>      
					</tr>	{% set nil = 0 %}
							{% if result is not empty %}
							{% for list in result %}
							 {% if list.tahun=="/2017"%}
							{% set sum11 += list.Qty %}
					<tr>	{% set nil = nil+1 %}
									<td align="center"> <font size="2px"><b>{{ nil }}</b></font></td>
									<td align="left"> <font size="2px"><b>{{ list.ItemID }}</b></font> </td>
									<td align="right"> <font size="2px"><b>{{ list.Qty |number_format(0,',','.')}}</b></font></td>
					</tr>
							{% endif %}
							{% endfor %}
							{% endif %}
					<tr>
						 <td align="center" colspan="2"><font size="2px"><b>Total</b></font></td>
						<td  align="right"> <font size="2px"><b>{{ sum11|number_format(0,',','.') }}</b></font></td>  
					</tr>
			</table>
			-->
		</td>

		<!--
		<td width="500px" >
			<table  border="1px" align='center'>
					<tr>
						<td align="center" bgcolor="#191970" colspan="3" width="400px"><font Color="#FFFFFF" >PROGRAM INTENSIF<font></td>  
					</tr>
					<tr>
							<td   bgcolor="#191970" align="center" ><font Color="#FFFFFF">NO<font></td>
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">DESCRIPTION<font></td> 
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">ORDER QTY<font></td>      
					</tr>	{% set nil = 0 %}
							{% if result is not empty %}
							{% for list in result %}
							 {% if list.tahun=="A IPA" or list.tahun=="A IPS" or list.tahun=="N SMP" or list.tahun=="UN SD"%}
							{% set sum8 += list.Qty %}
					<tr>	{% set nil = nil+1 %}
									<td align="left"> <font size="2px"><b>{{ nil }}</b></font></td>
									<td align="left"> <font size="2px"><b>{{ list.ItemID }}</b></font> </td>
									<td align="right"> <font size="2px"><b>{{ list.Qty |number_format(0,',','.')}}</b></font></td>
								
					</tr>
						
							{% endif %}
							{% endfor %}
							{% endif %}
					
					
					<tr>
						 <td align="center" colspan="2"><font size="2px"><b>Total</b></font></td>
						<td  align="right"> <font size="2px"><b>{{ sum8|number_format(0,',','.') }}</b></font></td>  
					</tr>
					<tr>
							<td   bgcolor="#191970" align="center" ><font Color="#FFFFFF">NO<font></td>
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">DESCRIPTION<font></td> 
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">ORDER QTY<font></td>      
					</tr>	{% set nil = 0 %}
							{% if result is not empty %}
							{% for list in result %}
							 {% if list.tahun==" 2017"%}
							{% set sum9 += list.Qty %}
					<tr>	{% set nil = nil+1 %}
									<td align="left"> <font size="2px"><b>{{ nil }}</b></font></td>
									<td align="left"> <font size="2px"><b>{{ list.ItemID }}</b></font> </td>
									<td align="right"> <font size="2px"><b>{{ list.Qty |number_format(0,',','.')}}</b></font></td>
								
					</tr>
						
							{% endif %}
							{% endfor %}
							{% endif %}
					
					
					<tr>
						 <td align="center" colspan="2"><font size="2px"><b>Total</b></font></td>
						<td  align="right"> <font size="2px"><b>{{ sum9|number_format(0,',','.') }}</b></font></td>  
					</tr>
			</table>
				
		</td>
		-->
		<!--
		<td width="500px" >
			<table  border="1px" align='center'>
					<tr>
						<td align="center" bgcolor="#191970" colspan="3" width="400px"><font Color="#FFFFFF" >PIKSE <font></td>  
					</tr>
					<tr>
							<td   bgcolor="#191970" align="center" ><font Color="#FFFFFF">NO<font></td>
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">DESCRIPTION<font></td> 
							<td  bgcolor="#191970" align="center"><font Color="#FFFFFF">ORDER QTY<font></td>      
					</tr>	{% set nil = 0 %}
							{% if result is not empty %}
							{% for list in result %}
							 {% if list.tahun=="2017"%}
							{% set sum9 += list.Qty %}
					<tr>	{% set nil = nil+1 %}
									<td align="left"> <font size="2px"><b>{{ nil }}</b></font></td>
									<td align="left"> <font size="2px"><b>{{ list.ItemID }}</b></font> </td>
									<td align="center"> <font size="2px"><b>{{ list.Qty |number_format(0,',','.')}}</b></font></td>
								
					</tr>
						
							{% endif %}
							{% endfor %}
							{% endif %}
					
					
					<tr>
						 <td align="center" colspan="2"><font size="2px"><b>Total</b></font></td>
						<td  align="right"> <font size="2px"><b>{{ sum9|number_format(0,',','.') }}</b></font></td>  
					</tr>
			</table>
				
		</td>
		-->
	</tr>     
	

	<tr>
		<td colspan='1'>
			<table border='1px' align='center'>
				<tr>
					<td width="200px"  align="center" bgcolor="#191970" colspan="4"><font Color="#FFFFFF">STAF LOGISTIK<font></td>  	
				</tr>
				<tr height='80px'  padding-top="0px">
					<td width="250px" padding-top="0px" >
						
					</td>  
					
				</tr>
			</table>
		</td>
		<td  colspan="1">
			<table  border='1px' align='center'>
				<tr>
					 <td width="200px"  align="center" bgcolor="#191970" colspan="4"><font Color="#FFFFFF">PROSES BARCODE<font></td> 				
				</tr>
				<tr height='80px' >
					<td width="200px" >
					</td>				
				</tr>
			</table>
		</td>
		<td  colspan="1">
			<table  border='1px' align='center'>
				<tr>
					 <td width="200px"  align="center" bgcolor="#191970" colspan="4"><font Color="#FFFFFF">TANGGAL PENGIRIMAN<font></td> 				
				</tr>
				<tr height='80px' >
					<td width="200px" >
					</td>				
				</tr>
			</table>
		</td>
  </tr>     
</table>


<br>
<table padding-top="0px" >
        <tr>
            <td width="80%"  bgcolor="#FFFFFF" align="left" ><b>COMMENT :</b></td>	
        </tr>  
</table> <br></br> <br>
<table border="1px" >
  
        <tr >
            <td bgcolor="#FFFFFF" align="left" ><font size="2"><b>Catatan penting untuk penerima</b><br/>  	
       "Harap konfirmasi melalui email ke logistik@primagama.co.id dan cc ke Area Manager paling lambat 3(tiga)
	   hari setelah barang diterima apabila ada ketidak sesuaian dalam jumlah/jenis barang yang diorder, setelah
	   masa konfimasi tersebut terlewati barang yang diterima dinyatakan telah sesuai dengan order"
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

