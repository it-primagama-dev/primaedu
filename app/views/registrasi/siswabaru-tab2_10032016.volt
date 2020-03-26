<div class="grid fluid">    
    <legend class="no-margin">Biaya Pendaftaran & Bimbingan</legend>
    <div class="row">
        <div class="span3">
            <label for="BiayaPendaftaran">Biaya Pendaftaran</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("BiayaPendaftaran", "readonly" : "readonly", "class": "idrCurrency") }}
            </div>
        </div>
        <div class="span3">
            <label for="MetodePembayaran">Metode Pembayaran</label>
            <div class="input-control select" data-role="input-control">
                {{ select("MetodePembayaran", metode, 'using': ['MetodeId', 'NamaMetode']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span3">
            <label for="BiayaBimbingan">Biaya Bimbingan</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("BiayaBimbingan", "maxlength" : 30, "class": "idrCurrency") }}
            </div>
        </div>
        <div class="span3">
            <label for="TipePembayaran">Tipe Pembayaran</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("TipePembayaran", ['Lunas': 'Lunas', 'Angsuran': 'Angsuran']) }}
            </div>
        </div>
        <div class="span3">
            <label for="TanggalJatuhTempo">Tanggal Jatuh Tempo</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("TanggalJatuhTempo", "maxlength" : 30) }}
            </div>
        </div>
    </div>
    <legend>Pembayaran Bimbingan</legend>
    <div class="row">
        <div class="span3">
            <label for="TanggalBayar">Tanggal Bayar</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd" data-date="{{ date('Y-m-d') }}">
                {{ text_field("TanggalBayar") }}
            </div>
        </div>
        <div class="span3">
            <label for="JumlahBayar">Jumlah Bayar</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("JumlahBayar", "class" : "idrCurrency") }}
            </div>
        </div>
        <div class="span3">
            <label for="MetodePembayaran2">Metode Pembayaran</label>
            <div class="input-control select" data-role="input-control">
                <select id="MetodePembayaran2" name="MetodePembayaran2">
                </select>
            </div>
        </div>
        <div class="span3">
            <label for="NoReferensi">No Referensi</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoReferensi", "type" : "numeric") }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span12 text-right">
            <input id="btn-conf" class="primary large" type="button" value="Submit">
        </div>
    </div>
</div>