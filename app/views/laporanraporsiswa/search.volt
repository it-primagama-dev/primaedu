
{{ content() }}

<h1>
    {{ link_to("laporanraporsiswa/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Rapor Siswa
    <small>Pencarian</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>#</th>
            <th>Siswa</th>
            <th>Program</th>
            <th>Waktu Pendaftaran</th>
            <th>Action</th>
         </tr>
    </thead>
    <tbody>
    {% if programsiswa is defined %}
    {% for record in programsiswa %}
        <tr>
            <td>{{ loop.index }}</td>
            <td>{{ record.getSiswa()|capitalize }}</td>
            <td>{{ record.getProgram() }}</td>
            <td>{{ record.CreatedAt }}</td>
            <td width="7%">
                {{ link_to("laporanraporsiswa/print/"~record.RecID, "Cetak", "target": "_blank") }}
            </td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
</table>