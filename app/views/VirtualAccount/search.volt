<div class="grid fluid no-margin"> 
    <div class="row">
        <div class="span12">
            {% for datas in page.items %}
            {% if loop.first %}
            <h1>
                {{ link_to("VirtualAccount/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
                Virtual Account
                <small class="place-right">
                <a href="{{ url('VirtualAccount/tambah/'~ Jenis ~ '/' ~ datas.KodeCabang) }}" onclick="return confirm('Apakah anda yakin ingin menambah va ini ? ');">Tambah Baru<i class="icon-plus on-right smaller"></i></a>
                </small>
            </h1>
            <table class="table striped bordered hovered dataTable">
                <thead>
                    <tr>
                        <th>Kode Cabang</th>
                        <th>Kode Siswa</th>
                        <th>Is Used</th>
                    </tr>
                </thead>
                {% endif %}
                <tbody>
                    <tr style="text-align:center">
                        <td>{{ datas.KodeCabang }}</td>
                        <td>{{ datas.KodeSiswa }}</td>
                        <td>{{ datas.IsUsed }}</td>
                    </tr>
                </tbody>
            {% if loop.last %}
            </table>
            <div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
            <div class="place-right">
                {{ link_to("VirtualAccount/search?jenis="~Jenis, "First", 'class':'button') }}
                {{ link_to("VirtualAccount/search?jenis="~Jenis~"&page="~page.before, "Previous", 'class':'button') }}
                {{ link_to("VirtualAccount/search?jenis="~Jenis~"&page="~page.next, "Next", 'class':'button') }}
                {{ link_to("VirtualAccount/search?jenis="~Jenis~"&page="~page.last, "Last", 'class':'button') }}
            </div>
            {% endif %}
            {% else %}
            <h1>
                {{ link_to("VirtualAccount/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
                Virtual Account
                <small class="place-right">
                    <a href="{{ url('VirtualAccount/tambah/'~ Jenis ~ '/' ~ KodeCabang) }}" onclick="return confirm('Apakah anda yakin ingin menambah va ini ? ');">Tambah Baru<i class="icon-plus on-right smaller"></i></a>
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