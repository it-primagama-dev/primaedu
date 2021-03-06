<h1>Laporan Mutasi Siswa</h1>

{{ content() }}

{{ form("rptsiswa/index", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span4">
            <label for="Tanggal">Tanggal</label>
<!--            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">-->
            <div class="input-control text" data-role="input-control">
                {{ text_field("Tanggal", "readonly" : "readonly") }}
            </div>
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>

{{ end_form() }}

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>#</th>
            <th>Kode Siswa</th>
            <th>Nama Siswa</th>
            <th>Program</th>
            <th>Tanggal Daftar</th>
         </tr>
    </thead>
    <tbody>
    {% if jatuhtempo is defined %}
    {% for list in jatuhtempo %}
        <tr>
            <td>{{ loop.index }}</td>
            <td>{{ list.VirtualAccount }}</td>
            <td>{{ list.NamaSiswa }}</td>
            <td>{{ list.NamaProgram }}</td>
            <td>{{ list.TanggalDaftar }}</td>
        </tr>
    {% endfor %}
    {% else %}
        <tr>
            <td colspan="6" align="center">- Tidak Ada Data -</td>
        </tr>
    {% endif %}
    </tbody>
</table>