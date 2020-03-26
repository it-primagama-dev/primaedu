<div class="grid fluid">
    <legend>Pembayaran Pendaftaran</legend>
    <div class="row">
        <div class="span6">
            <label for="BiayaPendaftaran">Biaya Pendaftaran</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("BiayaPendaftaran", "readonly" : "readonly") }}
            </div>
            <label for="MetodePembayaran">Metode Pembayaran</label>
            <div class="input-control select" data-role="input-control">
                {{ select("MetodePembayaran", metode, 'using': ['MetodeId', 'NamaMetode']) }}
            </div>
        </div>
    </div>
    <legend>Pembayaran Bimbingan</legend>
    <div class="row">
        <div class="span6">
            <label for="BiayaBimbingan">Biaya Bimbingan</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("BiayaBimbingan", "maxlength" : 30) }}
            </div>
            <label for="TipePembayaran">Tipe Pembayaran</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("TipePembayaran", ['Lunas': 'Lunas', 'Angsuran': 'Angsuran']) }}
            </div>
            <label for="TanggalJatuhTempo">Tanggal Jatuh Tempo</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd" data-position="top">
                {{ text_field("TanggalJatuhTempo", "maxlength" : 30) }}
            </div>
        </div>
    </div>
    <legend>Kartu Siswa</legend>
    <div class="row">
        <div class="span6">
            <label for="NoKartuSiswa">Nomor Kartu</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoKartuSiswa", "maxlength" : 20, "data-popover": "popover", "data-popover-position": "right", "data-popover-background": "bg-red", "data-popover-color": "fg-white") }}
            </div>
        </div>
    </div>
</div>
