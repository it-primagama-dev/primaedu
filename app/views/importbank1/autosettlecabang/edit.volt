
<h1>
    {{ link_to("autosettlecabang/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    AutoSettle Cabang
    <small class="on-right">Edit</small>
</h1>

{{ content() }}

{{ form("autosettlecabang/submit", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">		
             <label for="TanggalPembayaran">Tanggal Pembayaran</label>
              <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                                {{ text_field("TanggalPembayaran") }}
 
            {{ hidden_field("RecID") }}
            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>
{{ end_form() }}
