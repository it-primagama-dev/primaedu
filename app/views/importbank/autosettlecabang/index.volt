<h1>
   Aktifitas Auto Settle 
</h1>

{{ content() }}

<div class="grid fluid">
    <div class="row no-margin">
        <div class="span12">
      {{ link_to("autosettlecabang/updatedate", '<div class="button success">Proses Update Tanggal Pembayaran</div>') }}
	  &nbsp;
    {{ link_to("autosettlecabang/proses", '<div class="button success">Proses Autosettle</div>') }}

        </div>
    </div>
</div>
<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>#</th>
			<th>Kode Cabang</th>
            <th>Nama Cabang</th>
            <th>Tanggal Transaksi</th>
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
            <td>{{ list.TanggalTransaksi }}</td>
	 	    <td>{{ list.NoReferensi }}</td>
            <td class="idrCurrency">{{ list.Nominal }}</td>
		 	<td>{{ list.Status }}</td>	
            <td class="idrCurrency">{{ list.JumlahNominal }}</td>
		 	<td>{{ list.TanggalPembayaran }}</td>	
		 	<td>{{ list.NamaMetode }}</td>	
            <td>{{ link_to("autosettlecabang/edit/"~list.RecID, "Edit") }}
			</td>
		
		</tr>
    {% endfor %}
    {% else %}
        <tr>
            <td colspan="11" align="center">- Tidak Ada Data -</td>
        </tr>
    {% endif %}
    </tbody>
</table>
{% if page.total_pages > 1 %}
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("autosettlecabang/", "First", 'class':'button') }}
    {{ link_to("autosettlecabang/?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("autosettlecabang/?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("autosettlecabang/?page="~page.last, "Last", 'class':'button') }}
</div>
{% endif %}

