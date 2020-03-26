<h1>
    {{ link_to("autosettlecabang", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
   Aktifitas Auto Settle {{ rpttype }}
</h1>

{{ content() }}

<div class="grid fluid">
    <div class="row no-margin">
        <div class="span12">
            <h2><small class="place-right">Periode : {{ periode }}</small></h2>
        </div>
    </div>
</div>
<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>#</th>
			<th>Kode Cabang</th>
            <th>Nama Cabang</th>
            <th>Bank</th>
            <th>Tanggal Transaksi</th>
            <th>Jam</th>
            <th>VA</th>
            <th>Jumlah</th>
			<th>Status</th>
		    <th>Jumlah Pembayaran</th>
            <th>Tanggal Pembayaran</th>
            <th>Metode</th>
            <th>Action</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is not empty %}
    {% for list in page.items %}
        <tr>
            <td>{{ loop.index + (page.current - 1)*20 }}</td>
            <td>{{ list.KodeCabang }}</td>
		    <td>{{ list.NamaCabang }}</td>
            <td>{{ list.NamaBank }}</td>       
            <td>{{ list.TanggalTransaksi }}</td>
            <td>{{ list.WaktuTransaksi }}</td>
	 	    <td>{{ list.NoReferensi }}</td>
            <td class="idrCurrency">{{ list.Nominal }}</td>
		 	<td>{{ list.Status }}</td>	
            <td class="idrCurrency">{{ list.JumlahNominal }}</td>
		 	<td>{{ list.TanggalPembayaran }}</td>	
		 	<td>{{ list.NamaMetode }}{{ list.NamaMetode }}</td>	
            <td>{{ link_to("autosettlecabang/edit/"~list.RecID, "Edit") }}

			
		
		
		
			</td>
		
		</tr>
    {% endfor %}
    {% else %}
        <tr>
            <td colspan="12" align="center">- Tidak Ada Data -</td>
        </tr>
    {% endif %}
    </tbody>
</table>
{% if page.total_pages > 1 %}
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("autosettlecabang/view", "First", 'class':'button') }}
    {{ link_to("autosettlecabang/view?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("autosettlecabang/view?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("autosettlecabang/view?page="~page.last, "Last", 'class':'button') }}
</div>
{% endif %}

{{ partial('autosettlecabang/detail-modal') }}


<script>
	$('#btn-editadd').on('click', function(){$('#pdeditform').modal('show');});   
    $('#btn-cnadd').on('click', function(){$('#cnmodal').modal('show');});
	$('#btn-cnpost').on('click', function(){
        var frm = $('#cnform');
        frm.submit();
    });

</script>
