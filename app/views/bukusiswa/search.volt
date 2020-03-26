
{{ content() }}

<h1>
    {{ link_to("bukusiswa/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Penyerahan Buku
    <small>Pencarian</small>
</h1>

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>#</th>
            <th>Siswa</th>
            <th>Program</th>
            <th>Waktu Pendaftaran</th>
            <th>Tanggal Terima Buku</th>
            <th>Serial Number Buku</th>
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
            <td>{{ record.Bukusiswa.TanggalTerima|default("-") }}</td>
            <td>{{ record.Bukusiswa.SerialNumber|default("-") }}</td>
            <td width="7%">
                {% if record.Bukusiswa.RecID is not defined %}
                    {{ link_to('bukusiswa/new?siswa='~record.getJenjang()~record.getKodeSiswa()~record.RecID, "Proses") }}
                {% else %}
                    {{ link_to("bukusiswa/receipt/"~record.Bukusiswa.RecID, "Cetak", "target": "_blank") }}
                {% endif %}
            </td>
        </tr>


    {% endfor %}
    {% endif %}
    </tbody>
</table>