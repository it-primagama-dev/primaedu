
{{ content() }}

<h1>
    List Pembayaran Siswa
</h1>

<style type="text/css">
	.center-td td{text-align:center}
	table.tabelview .td-input input[type=text]
	{
		width:400px;
	}
	table.tabelview{margin:20px 0px}
	table.tabelview{background-color:#fafafa} 
	table.tabelview .td-input
	{
		padding-bottom:10px;
	}
	table.tabelview #msg{color:#ff0000;text-align:center}
</style>

{{ form("pembayaran/listpembayaran", "method":"post") }}

<table class="tabelview">
	<tr>
        <td align="left" colspan="2" class="td-input">
			 <label for="Siswa">No Siswa</label>
			 <div class="input-control text">
			 {{ text_field("Siswa", "type" : "text") }}
			 </div>
			 <input type="button" value="Lihat" onclick="inqPembayaran(this.form['Siswa'].value);">
        </td>
    </tr>
	
	<tr>
        <td align="left" colspan="2" class="td-input">
			 <label for="Program">Program</label>
			  <div class="input-control select">
            <select id="Program" name="Program" onchange="">
				<?php
					if(isset($programs))
					{
						foreach($programs as $program)
						{
							echo "<option value='".$program->headerid."'>".$program->NamaProgram."</option>";
						}
					}
				?>
			</select>
			</div>
        </td>
    </tr>
	
	<tr>
        <td></td>
        <td align="center">{{ submit_button("Lihat List Pembayaran") }}</td>
    </tr>
	
	<tr>
        <td align="left" colspan="2" id="msg">
			{{ flash.output() }} <br>
        </td>
    </tr>
</table>

</form>

{% if pembayarans is defined %}
{{judul}}
{% endif %}

<table class="table bordered striped hovered center-td" align="center">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Bayar</th>
            <th>Metode Pembayaran</th>
            <th>Pembayaran Untuk</th>
            <th>Jumlah</th>
			<th>Sisa Pembayaran</th>
			<th>Status</th>
			<th>Action</th>
         </tr>
    </thead>
    <tbody>
    {% if pembayarans is defined %}
	<?php $i=1;?>
    {% for pembayaran in pembayarans %}
		
        <tr>
			<td><?php echo $i; ?></td>
            <td>{{ pembayaran.TanggalPembayaran }}</td>
            <td>{{ pembayaran.NamaMetode }}</td>
            <td>{{ pembayaran.PembayaranUntuk }}</td>
            <td><?php echo number_format($pembayaran->Jumlah,0,",",".")?></td>
            <td><?php echo number_format($pembayaran->SisaPembayaran,0,",",".")?></td>
			 <td>{{ pembayaran.Status }}</td>
			 <td>{{ link_to("pembayaran/receipt/"~pembayaran.RecID, "Cetak", "target": "_blank") }}</td>
        </tr>
	<?php $i++;?>	
    {% endfor %}
	
	<?php if(count($pembayarans)>0) {?>
		<tr>
            <td colspan="10" align="center">{{ flash.output() }}</td>
        </tr>
	<?php }?>
		
    {% endif %}
    </tbody>
</table>



<script type="text/javascript">

	var objJSON=null;

	function inqPembayaran(idsiswa)
	{
		if(idsiswa==null || idsiswa=="")
		{
			$('#msg').html('Masukkan No. Siswa');
			return;
		}
		
		clear();
		$(".loader").show();
	
		var jqxhr = $.ajax( "{{ url("pembayaran/inquiry") }}/"+ idsiswa+"/1")
		  .done(function() {
			try {
				objJSON = $.parseJSON(jqxhr.responseText);
				
				if(objJSON.NamaSiswa=="")$('#msg').html('No Siswa '+idsiswa+' tidak terdaftar atau tidak memiliki tagihan');
				else
				{
					$('#NamaSiswa').val(objJSON.NamaSiswa);
					
					var select=$('#Program')[0];
					
					//add
					for(i=0;i<objJSON.Program.length;i++)
					{
						var option=document.createElement("option");
						option.text=objJSON.Program[i].NamaProgram;
						option.value=objJSON.Program[i].RecIDHeader;
						select.add(option,null);
					}
					
					document.forms[0].submit();
				}
			}
			catch(err) {
				$('#msg').html('Error mendapatkan data siswa');
			}
			
		  })
		  .fail(function() {
			$('#msg').html('Error mendapatkan data siswa');
		  })
		  .always(function() {
			$(".loader").hide();
		  });
	}
	
	function clear()
	{
		$('#msg').html("");
		$('#NamaSiswa').val("");
		$('#BiayaBimbingan').val("");
		$('#AngsuranKe').val("");
		$('#JatuhTempo').val("");
		$('#SisaPembayaran').val("");
		
		var select=$('#Program')[0];
					
		//clear
		var sizeOpt=select.options.length;
		for(i=0;i<sizeOpt;i++)
		{
			select.remove(0);
		}
	}	
	
	
</script>


