
{{ content() }}

<h1>
    AutoSettle
	<br>
	{{ link_to("autosettle/proses", '<div class="button" style="background-color:#00ef67">Proses Autosettle</div>') }}
</h1>

<style type="text/css">
	.center-td td{text-align:center}
</style>

<table class="table bordered striped hovered center-td" align="center">
    <thead>
        <tr>
            <th>Nama Bank</th>
            <th>No Siswa</th>
            <th>No Referensi</th>
            <th>Tanggal Transaksi</th>
            <th>Nominal</th>
            <th>Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for pembayaran in page.items %}
		<?php
			$VASiswa=$pembayaran->RecordSiswa !=null ? $pembayaran->RecordSiswa->VirtualAccount : "";
		?>
	
        <tr>
            <td>{{ pembayaran.NamaBank }}</td>
            <td>{{ text_field("Siswa"~pembayaran.RecID, "type" : "text","value" : VASiswa) }}</td>
            <td>{{ pembayaran.NoReferensi }}</td>
            <td>{{ pembayaran.TanggalTransaksi }}</td>
            <td>{{ pembayaran.getNominal() }}</td>
            <td><input type="button" value="Edit" onclick="editData({{pembayaran.RecID}})"></td>
        </tr>
    {% endfor %}
	
	{%if page.total_items==0 %}
		<tr>
            <td colspan="10" align="center">{{ flash.output() }}</td>
        </tr>
	{% endif %}
		
    {% endif %}
    </tbody>
</table>

<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("autosettle", "First", 'class':'button') }}
    {{ link_to("autosettle?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("autosettle?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("autosettle?page="~page.last, "Last", 'class':'button') }}
</div>

{{ form("autosettle?page="~page.current~"", "method":"post", "id":"editform", "autocomplete" : "off") }}
	<input type="hidden" name="recid">
	<input type="hidden" name="nosiswa">
</form>

<script type="text/javascript">
	function editData(recID)
	{
		$(".loader").show();
		form=document.getElementById("editform");
		form["recid"].value=""+recID;
		form["nosiswa"].value=document.getElementById("Siswa"+recID).value;
		form.submit();
	}
</script>
