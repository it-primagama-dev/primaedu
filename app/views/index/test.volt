{{ content() }}

{{ flash.output() }}

<h1>
    Import Rekening
</h1>

{{ form("index/test", "method":"post","enctype":"multipart/form-data") }}

<div class="grid fluid">
    <div class="row">
        <div class="span3">
            <label for="File">File</label>
            <div class="input-control file">
                {{ file_field("File", "type" : "file") }}
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
