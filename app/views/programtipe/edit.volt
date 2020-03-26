
<h1>
    {{ link_to("programtipe/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Tipe Program
    <small class="on-right">Edit</small>
</h1>

{{ content() }}

{{ form("programtipe/save", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="NamaTipeProgram">Nama Tipe Program</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaTipeProgram", "size" : 30) }}
            </div>
            {{ hidden_field("KodeTipeProgram") }}
            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>
{{ end_form() }}
