<h1>
    <a href="javascript:$('#backform').submit()"><i class="icon-arrow-left-3 fg-darker smaller"></i></a>
    Inquiry Pembayaran
    <small>View Detail</small>
</h1>

{{ content() }}

<h2 class="place-left"><small>{{ s.VirtualAccount~' / '~s.NamaSiswa }} | {{ program.NamaProgram }}</small></h2>
<h2 class="place-right"><small>Cabang : {{ c.KodeNamaAreaCabang }}</small></h2>

{% if pb is defined %}
    <table class="table bordered hovered" id="header">
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
{% endif %}

{% if pd|length > 0 %}
    <legend>
        <small class="on-right text-bold fg-darker">Detil Pembayaran</small>
    </legend>
    <table class="table bordered hovered" id="detail">
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
                    <td id="paydate">{{ list.TanggalPembayaran }}</td>
                    <td>{{ list.PembayaranUntuk }}</td>
                    <td>{{ list.getMetodePembayaran() }}</td>
                    <td>{{ list.NoReferensi }}</td>
                    <td class="idrCurrency text-right">{{ list.Jumlah }}</td>
                    <td class="idrCurrency text-right">{{ list.SisaPembayaran }}</td>
                    <td class="text-center">{{ list.StatusDetail }}</td>
                    <td class="text-center">
                        {% if list.Editable %}<a href="#" class="edit button primary">Edit</a>{% endif %}
                        {% if list.Voidable %}<a href="#" class="void button danger">Void</a>{% endif %}
                    </td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
    <span>
        <a href="#" class="button primary" id="btn-cnadd">Tambah Diskon Khusus</a>
    </span>
{% endif %}

{{ partial('pbadmin/detail-modal') }}

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
    $('table#header').on('click', 'a.edit', function(){$('#pbeditmodal').modal('show');});
    $('table#detail').on('click', 'a.receipt', function(){
        $('#receiptform #RecID').val($(this).parents('tr').attr('data-pbdetail'));
        $('#receiptform').submit();
    });
    $('table#detail').on('click', 'a.void', function(){
        $('#voidform #Pbdetail').val($(this).parents('tr').attr('data-pbdetail'));
        $('#pbmodal').modal('show');
    });
    $('table#detail').on('click', 'a.edit', function(){
        $('#pdeditmodal #TanggalPembayaran').val($(this).parents('tr').find('#paydate').html());
        $('#pdeditmodal #Pbdetail').val($(this).parents('tr').attr('data-pbdetail'));
        $('#pdeditmodal').modal('show');
    });
    $('#btn-void').on('click', function(){$('#voidform').submit();});
    $('#pbeditmodal #btn-edit').on('click', function(){$('#editform').submit();});
    $('#pdeditmodal #btn-edit').on('click', function(){$('#pdeditform').submit();});
    $('#btn-cnadd').on('click', function(){$('#cnmodal').modal('show');});
    $('#btn-cnpost').on('click', function(){
        var frm = $('#cnform');
        var jumlah = frm.find('#Jumlah');
        var noref = frm.find('#NoReferensi');
        if(!jumlah.val()){jumlah.focus().parent().addClass('error-state');return;}
        else{jumlah.parent().removeClass('error-state');}
        if(!noref.val()){noref.focus().parent().addClass('error-state');return;}
        else{noref.parent().removeClass('error-state');}
        frm.submit();
    });
</script>