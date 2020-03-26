<div class="grid fluid">
    <div class="row">
        <div class="span4">
            {{ flash.output() }}
        </div>
    </div>
</div>

{{ content() }}
{{ form("importemail/import", "method":"post","enctype": "multipart/form-data") }}

<h1>
    {{ link_to("importemail/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Import
    <small class="on-right">Email</small>
   
</h1>

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="Tanggal">Tanggal </label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("Tanggal", "type" : "text") }}
            </div>
            <label for="excel">File Excel</label>
            <div class="input-control file" data-role="input-control">
                <?php echo $this->tag->fileField(array("excel")) ?>
                <button class="btn-file"></button>
            </div>  
            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>

</form>