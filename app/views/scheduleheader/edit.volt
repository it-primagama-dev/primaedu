{{ content() }}
{{ form("scheduleheader/save", "method":"post","enctype": "multipart/form-data") }}

<h1>
    {{ link_to("scheduleheader/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Jadwal
    <small class="on-right">Ubah Jadwal</small>
    <small class="place-right">
        <a href="{{ url("scheduleheader/downloadschedule") }}"><i class="icon-download-2 on-left-more smaller"></i>Unduh File Excel</a>
    </small>
</h1>

<div class="grid fluid">
    <div class="row">
        <div class="span6">

            <label for="TahunAjaran">Tahun Ajaran</label>
            <div class="input-control select" data-role="input-control">
                {{ select("TahunAjaran", tahunajaran, 'using': ['RecID', 'Description'],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '0') }}
            </div>

            <label for="Description">Deskripsi</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Description", "size" : 30) }}
            </div>

            <label for="Program">Program</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Program", program, 'using': ['RecID', 'NamaProgram'],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '0') }}
            </div>

            <label for="excel">File Excel</label>
            <div class="input-control file" data-role="input-control">
                <?php echo $this->tag->fileField(array("excel")) ?>
                <button class="btn-file"></button>
            </div>	

            {{ hidden_field('KodeJadwal') }}
            {{ hidden_field("RecId") }}
            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>

</form>

{{ hidden_field("dataTableUrl") }}
<h2>
    <small class="padding10">
        <a href="#" id="createDetail">Tambah<i class="icon-plus on-right smaller"></i></a>
    </small>
</h2>
<table id="dataTable" class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Ruangan</th>
            <th>Guru</th>
            <th>Bidang Studi</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="place-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
    $("#createDetail").on("click", function () {
        $("#myModal .modal-title").html("Tambah Detail");
        $("#myModal .modal-body").load('{{url("scheduledetail/new/"~RecId)}}', function (e) {
            $("#myModal").modal('show');
        });
    });
    $("#dataTable tbody").on("click", "#editBtn", function () {
        var detailId = $(this).attr("data-value");
        $("#myModal .modal-title").html("Ubah Detail");
        $("#myModal .modal-body").load('{{url("scheduledetail/edit/")}}' + detailId, function (e) {
            $("#myModal").modal('show');
        });
    });
</script>


{{ javascript_include('js/scheduledetail.js') }}
