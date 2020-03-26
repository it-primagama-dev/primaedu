
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
    
<div class="grid fluid">
    <div class="row">
        <div class="span3">
            <label for="Bank">Nama Bank</label>
            <div class="input-control select">
                {{ select_static("Bank", ["BCA": "BCA", "CardBCA": "Kartu Kredit/Debit BCA", "CardBRI": "CardBRI", "MANDIRI": "MANDIRI"] ) }}
            </div>
            <label for="Tanggal">Tanggal </label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("Tanggal", "type" : "text") }}
            </div>

			<label for="excel">File</label>
            <div class="input-control file" data-role="input-control">
                <?php echo $this->tag->fileField(array("excel")) ?>
                <button class="btn-file"></button>
            </div>	
        </div>
    </div>
    <div class="row">
        <div class=" span3">
            {{ submit_button("Import") }}
        </div>
    </div>
</div>
	


{{ end_form() }}

<div class="grid fluid">
    <div class="row">
        <div class="span4">
            {{ flash.output() }}
        </div>
    </div>
</div>
