
<h1>
    {{ link_to("programharga/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Harga Program
    <small class="on-right">Edit</small>
</h1>

{{ content() }}

{{ form("programharga/save", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="Program">Nama Program</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Program", program, 'using': ['RecID', 'NamaProgram']) }}
            </div>
            <label for="AreaCabang">Nama Area</label>
            <div class="input-control select" data-role="input-control">
                {{ select("AreaCabang", area, 'using': ['RecID', 'NamaAreaCabang']) }}
            </div>
            <label for="SektorCabang">Sektor</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("SektorCabang") }}
            </div>
            <label for="TanggalBerlaku">Tanggal Berlaku</label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                {{ text_field("TanggalBerlaku", "type" : "date") }}
            </div>
            <label for="HargaBimbingan">Harga Bimbingan</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("HargaBimbingan", "type" : "numeric") }}
            </div>
            <label for="HargaPendaftaran">Harga Pendaftaran</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("HargaPendaftaran", "type" : "numeric") }}
            </div>
            {{ hidden_field("RecID") }}
            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>
{{ end_form() }}
