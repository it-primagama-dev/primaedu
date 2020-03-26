
{{ content() }}

<h1>
    Inquiry Transaksi Bank
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

{{ form("inquirybank", "method":"post") }}

<table class="tabelview">
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
			 <label for="Bank">Nama Bank</label>
			  <div class="input-control select">
            <?php echo Phalcon\Tag::selectStatic("Bank", array("" => "Semua Bank","BCA" => "BCA", "MANDIRI" => "MANDIRI")); ?>
			</div>
        </td>
    </tr>
	
    <tr>
        <td align="center" colspan="2">{{ submit_button("Lihat") }}</td>
    </tr>
	
	<tr>
        <td align="left" colspan="2" id="msg">
			{{ flash.output() }} <br>
        </td>
    </tr>
</table>

</form>

{{judul}}

<table class="table bordered striped hovered center-td" align="center">
    <thead>
        <tr>
            <th>Nama Bank</th>
            <th>No Siswa</th>
            <th>No Referensi</th>
            <th>Tanggal Transaksi</th>
			<th>Tanggal Upload</th>
            <th>Nominal</th>
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
            <td>{{ VASiswa }}</td>
            <td>{{ pembayaran.NoReferensi }}</td>
            <td>{{ pembayaran.TanggalTransaksi }}</td>
            <td>{{ pembayaran.TanggalImport }}</td>
            <td class="idrCurrency">{{ pembayaran.Nominal }}</td>
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
    {{ link_to("inquirybank?page="~page.first~"&use="~use, "First", 'class':'button') }}
    {{ link_to("inquirybank?page="~page.before~"&use="~use, "Previous", 'class':'button') }}
    {{ link_to("inquirybank?page="~page.next~"&use="~use, "Next", 'class':'button') }}
    {{ link_to("inquirybank?page="~page.last~"&use="~use, "Last", 'class':'button') }}
</div>

