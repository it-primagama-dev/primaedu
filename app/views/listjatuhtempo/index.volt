<h1>Laporan Jatuh Tempo</h1>

{{ content() }}

{{ form("listjatuhtempo/index", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span4">
            <label for="Tanggal">Tanggal</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd" data-date="{{ date }}">
                {{ text_field("Tanggal") }}
            </div>
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>
{{ end_form() }}
{% if jatuhtempo is defined %}
    <table class="table bordered striped hovered">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Siswa</th>
                <th>Nama Siswa</th>
                <th>Program</th>
                <th>Sisa Pembayaran</th>
                <th>Tanggal Jatuh Tempo</th>
            </tr>
        </thead>
        <tbody>
            {% if jatuhtempo|length > 0 %}
            {% for list in jatuhtempo %}
                <tr>
                    <td>{{ loop.index }}</td>
                    <td>{{ list.VirtualAccount }}</td>
                    <td>{{ list.NamaSiswa }}</td>
                    <td>{{ list.NamaProgram }}</td>
                    <td>{{ list.SisaPembayaran|number_format }}</td>
                    <td>{{ list.JatuhTempo }}</td>
                </tr>
            {% endfor %}
            {% else %}
                <tr><td colspan="6" align="center">- Tidak Ada Data -</td></tr>
            {% endif %}
        </tbody>
    </table>
{% endif %}