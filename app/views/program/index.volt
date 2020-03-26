<h1>
    Pencarian Program
    <small class="place-right">{{ link_to("program/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

{{ content() }}

{{ form("program/search", "method":"post", "autocomplete" : "off") }}

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
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>

{{ end_form() }}
