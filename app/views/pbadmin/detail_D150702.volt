<h1>
    <a href="javascript:$('#backform').submit()"><i class="icon-arrow-left-3 fg-darker smaller"></i></a>
    Inquiry Pembayaran
    <small>View Detail</small>
</h1>

{{ content() }}

<h2 class="place-left"><small>{{ s.VirtualAccount~' / '~s.NamaSiswa }} | {{ program.NamaProgram }}</small></h2>
<h2 class="place-right"><small>Cabang : {{ c.KodeNamaAreaCabang }}</small></h2>

{% if pb is defined %}
    <table class="table bordered hovered">
        <thead>
            <tr>
                <th rowspan="2">Tipe Pembayaran</th>
                <th colspan="3">Biaya</th>
                <th rowspan="2">Sisa Pembayaran</th>
                <th rowspan="2">Jatuh Tempo</th>
                <th rowspan="2">Username</th>
                <th rowspan="2">Action</th>
            </tr>
            <tr>
                <th>Pendaftaran</th>
                <th>Bimbingan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-right">
                <td class="text-center">
                    {% if pb.PembayaranTipe == 'Lunas' %}
                        {{ pb.PembayaranTipe }}
                    {% else %}
                        {{ pb.PembayaranTipe~' - '~pb.AngsuranKe }}
                    {% endif %}
                </td>
                <td class="idrCurrency text-right">{{ pb.BiayaPendaftaran }}</td>
                <td class="idrCurrency text-right">{{ pb.BiayaBimbingan }}</td>
                <td class="idrCurrency text-right">{{ pb.JumlahTotal }}</td>
                <td class="idrCurrency text-right">{{ pb.SisaPembayaran }}</td>
                <td class="text-center">{{ pb.JatuhTempo }}</td>
                <td class="text-center">{{ pb.Users.Username }}</td>
                <td class="text-center"><a class="edit button primary">Edit</a></td>
            </tr>
        </tbody>
    </table>
<!-- Modal -->
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
{% endif %}
{% if pd|length > 0 %}
    <legend><small class="text-bold fg-darker on-right">Detil Pembayaran</small></legend>
    <table class="table bordered hovered">
        <thead>
            <tr>
                <th>##</th>
                <th>No. Kuitansi</th>
                <th>Tanggal</th>
                <th>Pembayaran Untuk</th>
                <th>Metode Pembayaran</th>
                <th>No. Referensi</th>
                <th>Jumlah Uang</th>
                <th>Sisa Pembayaran</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {% for list in pd %}
                <tr data-pbdetail="{{ list.RecID }}">
                    <td>{{ loop.index }}</td>
                    <td><a href="#" class="receipt">{{ list.DocumentNo }}</a></td>
                    <td>{{ list.TanggalPembayaran }}</td>
                    <td>{{ list.PembayaranUntuk }}</td>
                    <td>{{ list.getMetodePembayaran() }}</td>
                    <td>{{ list.NoReferensi }}</td>
                    <td class="idrCurrency text-right">{{ list.Jumlah }}</td>
                    <td class="idrCurrency text-right">{{ list.SisaPembayaran }}</td>
                    <td class="text-center">{{ list.StatusDetail }}</td>
                    <td class="text-center">
                        {% if list.Voidable %}<a href="#" class="void button danger">Void</a>{% endif %}
                    </td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
{% endif %}
<!-- Modal -->
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
{{ form("pbadmin/view", "method": "post", "id": "backform") }}
    {{ hidden_field("Cabang") }}{{ hidden_field("Siswa") }}
{{ end_form() }}
{{ form("pbadmin/receipt", "method": "post", "id": "receiptform", "target": "_blank") }}
    {{ hidden_field("RecID") }}{{ hidden_field("Cabang") }}
{{ end_form() }}
{{ form("pbadmin/void", "method": "post", "id": "voidform") }}
    {{ hidden_field("RecID") }}{{ hidden_field("Cabang") }}
    {{ hidden_field("Siswa") }}{{ hidden_field("Pbdetail") }}
{{ end_form() }}
<script>
    $('table').on('click', 'a.receipt', function(){
        $('#receiptform #RecID').val($(this).parents('tr').attr('data-pbdetail'));
        $('#receiptform').submit();
    });
    $('table').on('click', 'a.void', function(){
        $('#voidform #Pbdetail').val($(this).parents('tr').attr('data-pbdetail'));
        $('#pbmodal').modal('show');
    });
    $('#btn-void').on('click', function(){$('#voidform').submit();});
    $('table').on('click', 'a.edit', function(){$('#pbeditmodal').modal('show');});
    $('#btn-edit').on('click', function(){$('#editform').submit();});
</script>