{{ form("programdetail/create", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span12">
            {{ hidden_field("Program") }}
            <label for="NamaProgramDetail">Nama Detail</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaProgramDetail", "size" : 30) }}
            </div>
            <label for="BidangStudi">Bidang Studi</label>
            <div class="input-control select" data-role="input-control">
                {{ select("BidangStudi", bidangstudi, 'using': ['KodeBidangStudi', 'NamaBidangStudi']) }}
            </div>
            <label for="Bobot">Bobot</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Bobot", "type" : "numeric") }}
            </div>

        </div>
    </div>
    <div class="row">
        <div class="span12">
            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>

{{ end_form() }}
