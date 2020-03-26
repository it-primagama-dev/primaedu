{{ content() }}

<h1>
    {{ link_to("nilai/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Nilai Siswa
    <small class="on-right">{{ program.NamaProgram }}</small>
    <small class="place-right">
        {{ link_to("nilai/input/"~program.RecID, 'Upload Nilai<i class="icon-upload-3 on-right smaller"></i>') }}
    </small>
</h1>

<table class="table bordered striped hovered text-center">
    <thead>
        <tr>
            <th rowspan="2" width="4%">No.</th>
            <th rowspan="2" width="11%">Kode Siswa</th>
            <th rowspan="2">Nama Siswa</th>
            <th rowspan="2" width="18%">Bidang Studi</th>
            <th colspan="10">Nilai</th>
            <th rowspan="2" width="12%">Action</th>
        </tr>
        <tr>
            <th width="3%">1</th>
            <th width="3%">2</th>
            <th width="3%">3</th>
            <th width="3%">4</th>
            <th width="3%">5</th>
            <th width="3%">6</th>
            <th width="3%">7</th>
            <th width="3%">8</th>
            <th width="3%">9</th>
            <th width="3%">10</th>
        </tr>
    </thead>
    <tbody>
        {% if page.items is defined %}
            {% for data in page.items %}
                <tr>
                    <td>{{ loop.index }}</td>
                    <td>{{ data.VirtualAccount }}</td>
                    <td class="text-left">{{ data.NamaSiswa }}</td>
                    <td>{{ data.NamaBidangStudi }}</td>
                    <td>{{ data.Nilai1 }}</td>
                    <td>{{ data.Nilai2 }}</td>
                    <td>{{ data.Nilai3 }}</td>
                    <td>{{ data.Nilai4 }}</td>
                    <td>{{ data.Nilai5 }}</td>
                    <td>{{ data.Nilai6 }}</td>
                    <td>{{ data.Nilai7 }}</td>
                    <td>{{ data.Nilai8 }}</td>
                    <td>{{ data.Nilai9 }}</td>
                    <td>{{ data.Nilai10 }}</td>
                    <td></td>
                </tr>
            {% else %}
                <tr>
                    <td colspan="15" class="text-center">- Tidak Ada Data -</td>
                </tr>
            {% endfor %}
        {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("nilai/search", "First", 'class':'button') }}
    {{ link_to("nilai/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("nilai/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("nilai/search?page="~page.last, "Last", 'class':'button') }}
</div>
