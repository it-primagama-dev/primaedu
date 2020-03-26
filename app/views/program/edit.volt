{{ content() }}

<h1>
    {{ link_to("program/search", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Program
    <small class="on-right">Edit</small>
</h1>

{{ form("program/save", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="NamaProgram">Nama Program</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaProgram", "size" : 30) }}
            </div>
            <label for="TipeProgram">Tipe Program</label>
            <div class="input-control select" data-role="input-control">
                {{ select("TipeProgram", programtipe, 'using': ['KodeTipeProgram', 'NamaTipeProgram'],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            <label for="Jenjang">Jenjang</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Jenjang", jenjang, 'using': ['KodeJenjang', 'NamaJenjang'],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            {{ hidden_field("RecID") }}
            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>

{{ end_form() }}

{{ hidden_field("dataTableUrl") }}
<h2>
    <small class="padding10">
        <a href="#" id="createDetail">Tambah<i class="icon-plus on-right smaller"></i></a>
    </small>
</h2>
<table id="dataTable" class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Nama Detail</th>
            <th>Bidang Studi</th>
            <th>Bobot</th>
            <th colspan="2"></th>
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
    $("#createDetail").on("click", function(){
        $("#myModal .modal-title").html("Tambah Detail");
        $("#myModal .modal-body").load('{{url("programdetail/new/"~RecID)}}', function(e){
            $("#myModal").modal('show');
        });
    });
    $("#dataTable tbody").on("click", "#editBtn", function(){
        var detailId = $(this).attr("data-value");
        $("#myModal .modal-title").html("Ubah Detail");
        $("#myModal .modal-body").load('{{url("programdetail/edit/")}}'+detailId, function(e){
            $("#myModal").modal('show');
        });
    });
</script>
{{ javascript_include('js/programdetail.js') }}