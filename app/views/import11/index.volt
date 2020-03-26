{{ content() }}
{{ form("import11/index", "method":"post","enctype": "multipart/form-data") }}

<h1>
    {{ link_to("import11/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Import
    <small class="on-right">11%</small>
   
</h1>

<div class="grid fluid">
    <div class="row">
        <div class="span6">
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
