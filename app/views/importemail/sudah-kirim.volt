{{ content() }}
<link rel="stylesheet" type="text/css" href="{{ url('datatables/jquery.dataTables.min.css') }}">
<script type="text/javascript" charset="utf8" src="{{ url('datatables/jquery.dataTables.min.js') }}"></script>

<link href="{{ url('public/please-wait/jquery-ui.css') }}" rel="stylesheet">
{{ form("importemail/sendmail", "method":"post","enctype": "multipart/form-data") }}
<div class="grid fluid no-margin">
    <div class="row">
        <div class="span12">
            <div class="btn-group place-right" style="margin-top:-4px;padding-left:15px;">
                {{ link_to("importemail/excel", '<button type="button">Download</button>',"target":"_blank") }}
            </div>
            <div class="btn-group place-right" style="margin-top:-4px;padding-left:15px;">
                {{ submit_button("name":"hapus","id":"hapus","value":"Hapus") }}
            </div>
            <div class="btn-group place-right" style="margin-top:-4px;">
                {{ submit_button("name":"kirim","id":"kirim","value":"Kirim Ulang Email") }}
            </div>
            <table id="example5" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="display:none">RecID</th>
                        <th>Kode Cabang</th>
                        <th>No VA</th>
                        <th>Nama Siswa</th>
                        <th>Email Eksternal</th>
                        <th>Email Internal</th>
                        <th>Password</th>
                        <th>Status Kirim</th>
                        <th>Tanggal Import</th>
                        <th style="text-align: center;" data-sortable="false">
                            <input type="checkbox" onchange="checkAll(this)" name="chk[]" />
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {% for rows in result %}
                    <tr>
                        <td style="display:none">{{ rows.KodeCabang }}</td>
                        <td>{{ rows.KodeCabang }}</td>
                        <td>{{ rows.NoVa }}</td>
                        <td>{{ rows.NamaSiswa }}</td>
                        <td>{{ rows.EmailEksternal }}</td>
                        <td>{{ rows.EmailInternal }}</td>
                        <td>{{ rows.Password }}</td>
                        {% if rows.Status == 1 %}
                        <td>Sudah</td>
                        {% else %}
                        <td>Belum</td>
                        {% endif %}
                        <td>{{ rows.TanggalImport }}</td>
                        <td width="2%" style="text-align: center;">
                            <input type="checkbox" name="checkbox[]" value="{{ rows.RecID }}">
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{{ end_form() }}


<script type="text/javascript">
 function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
</script>