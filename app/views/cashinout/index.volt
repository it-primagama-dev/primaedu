{{ content() }}

<h1> 
    Cash In Out
    <small class="on-right">Cabang</small>
</h1>

<div class="grid fluid no-margin">
    <div class="row">
        <div class="span12">
            {% for rows in page.items %}
            {% if loop.first %}
            <h1>
                <small class="place-right">
                <a href="{{ url('cashinout/tambah/') }}">Tambah Baru<i class="icon-plus on-right smaller"></i></a>
                </small>
                <small class="place-left">
                <a href="{{ url('rptlaporancashinout') }}">Laporan<i class="icon-printer on-right smaller"></i></a>
                </small>
            </h1>
            <table class="table striped bordered hovered dataTable">
                <thead>
                    <tr>
                        <th>Kode Cabang</th>
                        <th>Nama Group</th>
                        <th>Nama Huruf</th>
                        <th>Nama Class</th>
                        <th>Nama Tipe</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th>Deskripsi</th>
                        <th>Pembuat</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                {% endif %}
                <tbody>
                    <tr>
                        <td>{{ rows.KodeCabang }}</td>
                        <td>{{ rows.IdGroup }}</td>
                        <td>{{ rows.IdHuruf }}</td>
                        <td>{{ rows.IdClass }}</td>
                        <td>{{ rows.IdTipe }}</td>
                        <td>{{ rows.Tanggal }}</td>
                        <td style="text-align: center" class="Idr">{{ rows.Nominal }}</td>
                        <td>{{ rows.Description }}</td>
                        <td>{{ rows.CreatedBy }}</td>
                        <td>{{ link_to("cashinout/edit/"~rows.RecId, "Edit") }}</td>
                        <td> <a href="{{ url('cashinout/hapus/' ~ rows.RecId) }}" onclick="return confirm('Apakah anda akan menghapus data ? ');">Hapus</a> </td>
                    </tr>
                </tbody>
            {% if loop.last %}
            </table>
            <div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
            <div class="place-right">
                {{ link_to("cashinout", "First", 'class':'button') }}
                {{ link_to("cashinout?page="~page.before, "Previous", 'class':'button') }}
                {{ link_to("cashinout?page="~page.next, "Next", 'class':'button') }}
                {{ link_to("cashinout?page="~page.last, "Last", 'class':'button') }}
            </div><br>
             <button href="" type="submit" value="{{ rows.KodeCabang }}"> .</button>
            {% endif %}
            {% else %}
            <h1>
                {{ link_to("cashinout", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
                Cash In Out
                <small class="place-right">
                    <a href="{{ url('cashinout/tambah/') }}">Tambah Baru<i class="icon-plus on-right smaller"></i></a>
                </small>
            </h1>
            <table class="table striped bordered hovered dataTable">
                <tr>
                    <td colspan="12" align="center">- Tidak Ada Data -</td>
                </tr>
            </table>
            {% endfor %}
        </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
});
</script>