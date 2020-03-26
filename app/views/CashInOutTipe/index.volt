<div class="grid fluid no-margin">
    <div class="row">
        <div class="span12">
            {% for datas in page.items %}
            {% if loop.first %}
            <h1>
                {{ link_to("CashInOutTipe/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
                Cash In Out
                <small class="place-right">
                <a href="{{ url('CashInOutTipe/tambah/') }}">Tambah Baru<i class="icon-plus on-right smaller"></i></a>
                </small>
            </h1>
            <table class="table striped bordered hovered dataTable">
                <thead>
                    <tr>
                        <th>Nama Group</th>
                        <th>Nama Huruf</th>
                        <th>Nama Class</th>
                        <th>Kode Item</th>
                        <th>Status</th>
                        <th>Deskripsi</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                {% endif %}
                <tbody>
                    <tr>
                        <td>{{ datas.GroupName }}</td>
                        <td>{{ datas.HurufName }}</td>
                        <td>{{ datas.ClassName }}</td>
                        <td style="text-align: center">{{ datas.RecID }}</td>
                        <td style="text-align: center">{{ datas.Status }}</td>
                        <td>{{ datas.TipeName }}</td>
                        <td>{{ link_to("CashInOutTipe/edit/"~datas.RecID, "Edit") }}</td>
                        <td><a href="{{ url("CashInOutTipe/hapus/"~datas.RecID) }}" onclick="return confirm('Apakah anda akan menghapus data ? ');">Delete</a></td>
                    </tr>
                </tbody>
            {% if loop.last %}
            </table>
            <div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
            <div class="place-right">
                {{ link_to("CashInOutTipe", "First", 'class':'button') }}
                {{ link_to("CashInOutTipe?page="~page.before, "Previous", 'class':'button') }}
                {{ link_to("CashInOutTipe?page="~page.next, "Next", 'class':'button') }}
                {{ link_to("CashInOutTipe?page="~page.last, "Last", 'class':'button') }}
            </div>
            {% endif %}
            {% else %}
            <h1>
                {{ link_to("CashInOutTipe/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
                Cash In Out
                <small class="place-right">
                    <a href="{{ url('CashInOutTipe/tambah/') }}">Tambah Baru<i class="icon-plus on-right smaller"></i></a>
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