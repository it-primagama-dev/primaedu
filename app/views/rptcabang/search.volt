
{{ content() }}

<h1>
    {{ link_to("rptcabang/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Cabang
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Kode Cabang</th>
            <th>Nama Cabang</th>
            <th>Area</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Nama Manager</th>
			<th>No HP</th>
			
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for areacabang in page.items %}
        <tr>
            <td>{{ areacabang.KodeAreaCabang }}</td>
            <td>{{ areacabang.NamaAreaCabang }}</td>
            <td>{{ areacabang.getNamaArea() }}</td>
            <td>{{ areacabang.Alamat }}</td>			
	    	<td>{{ areacabang.NoTelp }}</td>
         	<td>{{ areacabang.NamaManager }}</td>
			<td>{{ areacabang.NoHandPhone }}</td>	
		</tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("rptcabang/search", "First", 'class':'button') }}
    {{ link_to("rptcabang/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("rptcabang/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("rptcabang/search?page="~page.last, "Last", 'class':'button') }}
</div>