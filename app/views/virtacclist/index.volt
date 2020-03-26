<h1>
    Upload Virtual Account List
</h1>

{{ content() }}

{{ form("virtacclist/upload", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="FileExcel">File Excel</label>
            <div class="input-control file" data-role="input-control">
                {{ file_field("FileExcel", "size" : 30) }}
                <button class="btn-file"></button>
            </div>
            {{ submit_button("Upload") }}
        </div>
    </div>
</div>
{{ end_form() }}
