
{{ content() }}

<h1>
    {{ link_to("siswa/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Siswa
</h1>

{% set group = 0 %}

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Kode Siswa</th>
            <th>Nama Siswa</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Jenjang</th>
            <th colspan="2" width="10%">Action</th>
        </tr>
    </thead>
    <tbody>
        {% if page.items is defined %}
            {% for siswa in page.items %}
                {% if group != siswa.Cabang and not nogroup %}
                    <tr class="bg-steel fg-white">
                        <td colspan="7">
                            <i class="icon-next on-left-more"></i>
                            {{ siswa.getNamaArea()~' / '~siswa.getNamaCabang(true) }}
                        </td>
                    </tr>
                    {% set group = siswa.Cabang %}
                {% endif %}
                <tr>
                    <td>{{ siswa.VirtualAccount }}</td>
                    <td>{{ siswa.NamaSiswa }}</td>
                    <td>{{ siswa.EmailSiswa }}</td>
                    <td>{{ siswa.getJenisKelamin() }}</td>
                    <td>{{ siswa.getJenjang() }}</td>
                    {% if leveluser != 1 %}
                        <td colspan="2" class="text-center">{{ link_to("siswa/view/"~siswa.RecID, "View") }}</td>
                    {% else %}
                        <td>{{ link_to("siswa/edit/"~siswa.RecID, "Edit") }}</td>
                        <td><a href="#" data-url="{{ url("siswa/delete/"~siswa.RecID) }}">Delete</a></td>
                    {% endif %}
                </tr>
            {% endfor %}
        {% endif %}
    </tbody>
</table>
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("siswa/search", "First", 'class':'button') }}
    {{ link_to("siswa/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("siswa/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("siswa/search?page="~page.last, "Last", 'class':'button') }}
</div>
<!-- Modal Delete -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Delete Siswa</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button class="button" data-dismiss="modal">Batal</button>
                <a class="button danger" id="btn-del">Lanjutkan</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('table').on('click','[data-url]',function(){
        var txt = 'Apakah anda yakin menghapus data siswa '
        + '<b>' + $(this).parents('tr').find('td:nth-child(2)').html() + '</b> ?';
        $('#deletemodal .modal-body').html(txt);
        $('#deletemodal #btn-del').attr('href', $(this).attr('data-url'));
        $('#deletemodal').modal('show');
    });
</script>
