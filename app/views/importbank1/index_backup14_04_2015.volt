
{{ content() }}

<h1>
    Import File Bank
</h1>

<style type="text/css">
	.center-td td{text-align:center}
	table.tabelview .td-input input[type=text],input[type=file],select
	{
		width:250px;
	}
	table.tabelview{margin:20px}
	table.tabelview{background-color:#fafafa} 
	table.tabelview .td-input
	{
		padding-bottom:10px;
		width:250px;
	}
	table.tabelview #msg{color:#ff0000;text-align:center;padding:20px}
</style>

{{ form("importbank", "method":"post","enctype":"multipart/form-data") }}

<table class="tabelview">
	<tr>
        <td align="left" colspan="2" class="td-input">
			 <label for="Bank">Nama Bank</label>
			 <div class="input-control select">
            <?php echo Phalcon\Tag::selectStatic("Bank", array("BCA" => "BCA", "MANDIRI" => "MANDIRI")); ?>
			</div>
        </td>
    </tr>

	<tr>
        <td align="left" colspan="2" class="td-input">
			 <label for="Tanggal">Tanggal</label>
			 
			  <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
            {{ text_field("Tanggal", "type" : "text") }}
			  </div>
        </td>
    </tr>
	
	<tr>
        <td align="left" colspan="2" class="td-input">
			 <label for="File">File</label>
			 
            {{ file_field("File", "type" : "file") }}
        </td>
    </tr>
	
    <tr>
        <td colspan="2" align="center">{{ submit_button("Import") }}</td>
    </tr>
	


</form>

<table class="tabelview">
	<tr>
        <td align="left" colspan="2" id="msg">
			{{ flash.output() }} <br>
        </td>
    </tr>
</table>

{% if trans is defined %}



<table class="table bordered striped hovered center-td" align="center">
    <thead>
        <tr>
			<th>No</th>
            <th>Nama Bank</th>
            <th>No Siswa</th>
            <th>No Referensi</th>
            <th>Tanggal Transaksi</th>
            <th>Nominal</th>
         </tr>
    </thead>
    <tbody>
    {% set counter = 0 %}
    {% for pembayaran in trans %}
        <tr>
			<td>{{ counter+1 }}</td>
            <td>{{ pembayaran.NamaBank }}</td>
            <td>{{ pembayaran.Siswa }}</td>
            <td>{{ pembayaran.NoReferensi }}</td>
            <td>{{ pembayaran.TanggalTransaksi }}</td>
            <td>{{ pembayaran.getNominal() }}</td>
        </tr>
		{% set counter += 1 %}
    {% endfor %}
	
	{%if counter==0 %}
		<tr>
            <td colspan="10" align="center">{{ flash.output() }}</td>
        </tr>
	{% endif %}
		
    
    </tbody>
</table>

{% endif %}

