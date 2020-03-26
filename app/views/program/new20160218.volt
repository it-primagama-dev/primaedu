
<h1>
    {{ link_to("program/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Program
    <small class="on-right">Tambah Baru</small>
</h1>

{{ content() }}

{{ form("program/create", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="NamaProgram">Nama Program</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaProgram", "size" : 30) }}
            </div>
            <label for="TipeProgram">Tipe Program</label>
            <div class="input-control select" data-role="input-control">
                {{ select("TipeProgram", programtipe, 'using': ['KodeTipeProgram', 'NamaTipeProgram'],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            <label for="Jenjang">Jenjang</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Jenjang", jenjang, 'using': ['KodeJenjang', 'NamaJenjang'],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>

            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>
{{ end_form() }}
