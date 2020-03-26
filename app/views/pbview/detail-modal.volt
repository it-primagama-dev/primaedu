<!-- Modal Edit -->
<div class="modal fade" id="pbeditmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Edit Pembayaran</h4>
            </div>
            <div class="modal-body">{{ form("pbadmin/edit", "method": "post", "id": "editform") }}
                <div class="grid fluid">
                    <div class="row no-margin">
                        <div class="span6">
                            <label for="Bimbingan">Biaya Bimbingan</label>
                            <div class="input-control text">
                                {{ text_field("Bimbingan", "class": "idrCurrency", "value": pb.BiayaBimbingan) }}
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="span6">
                            <label for="JatuhTempo">Jatuh Tempo</label>
                            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                {{ text_field("JatuhTempo", "value": pb.JatuhTempo) }}
                            </div>
                        </div>
                        {{ hidden_field("RecID") }}{{ hidden_field("Cabang") }}{{ hidden_field("Siswa") }}
                    </div>
                </div>
            {{ end_form() }}</div>
            <div class="modal-footer">
                <button class="button" data-dismiss="modal">Batal</button>
                <button class="button primary" id="btn-edit">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Void -->
<div class="modal fade" id="pbmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Void Pembayaran</h4>
            </div>
            <div class="modal-body">
                Apakah anda yakin melakukan void Pembayaran?
            </div>
            <div class="modal-footer">
                <button class="button" data-dismiss="modal">Batal</button>
                <button class="button danger" id="btn-void">Lanjutkan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Diskon Khusus -->
<div class="modal fade" id="cnmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Tambah Diskon Khusus</h4>
            </div>
            <div class="modal-body">{{ form("pbadmin/creditnote", "method": "post", "id": "cnform") }}
                <div class="grid fluid">
                    <div class="row no-margin">
                        <div class="span6">
                            <label for="TanggalPembayaran">Tanggal</label>
                            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                {{ text_field("TanggalPembayaran", "value": date('Y-m-d')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="span6">
                            <label for="Jumlah">Jumlah</label>
                            <div class="input-control text">
                                {{ text_field("Jumlah", "class": "idrCurrency") }}
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="span6">
                            <label for="NoReferensi">Nomor Referensi</label>
                            <div class="input-control text">
                                {{ text_field("NoReferensi", "maxlength": "50") }}
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="span6">
                            <label for="Keterangan">Keterangan</label>
                            <div class="input-control textarea">
                                {{ text_area("Keterangan", "maxlength": "100") }}
                            </div>
                        </div>
                    </div>
                    {{ hidden_field("RecID") }}{{ hidden_field("Cabang") }}{{ hidden_field("Siswa") }}
                </div>
            {{ end_form() }}</div>
            <div class="modal-footer">
                <button class="button" data-dismiss="modal">Batal</button>
                <button class="button primary" id="btn-cnpost">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Detail -->
<div class="modal fade" id="pdeditmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Edit Detil Pembayaran</h4>
            </div>
            <div class="modal-body">{{ form("pbadmin/chdate", "method": "post", "id": "pdeditform") }}
                <div class="grid fluid">
                    <div class="row no-margin">
                        <div class="span6">
                            <label for="TanggalPembayaran">Tanggal Pembayaran</label>
                            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                {{ text_field("TanggalPembayaran") }}
                            </div>
                        </div>
                    </div>
                    {{ hidden_field("RecID") }}{{ hidden_field("Cabang") }}
                    {{ hidden_field("Siswa") }}{{ hidden_field("Pbdetail") }}
                </div>
            {{ end_form() }}</div>
            <div class="modal-footer">
                <button class="button" data-dismiss="modal">Batal</button>
                <button class="button primary" id="btn-edit">Simpan</button>
            </div>
        </div>
    </div>
</div>
