{{ content() }}
{{ form("purchreqheader/save", "method":"post") }}

<h1>
    {{ link_to("purchreqheader/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Pembelian
    <small class="on-right">Ubah Pembelian</small>
</h1>

<div class="grid fluid">
    <div class="row">
        <div class="span5">
            <label for="PurchReqName">Deskripsi</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("PurchReqName", "size" : 30) }}
            </div>

            <label for="Requester">Requester</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Requester", "size" : 30) }}
            </div>

            <label for="PurchReqDate">Tanggal</label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                {{ text_field("PurchReqDate", "size" : 30) }}
            </div>

            {{ hidden_field("PurchReqId") }}
            {{ hidden_field("RecId") }}
            {{ submit_button("Simpan") }}
        </div>
        <div class="span5">
            <label for="Remarks">Remarks</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("Remarks") }}
            </div>
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
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Pesanan</th>
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
        $("#myModal .modal-body").load('{{url("purchreqline/new/"~RecId)}}', function (e) {
            $("#myModal").modal('show');
        });
    });
    $("#dataTable tbody").on("click", "#editBtn", function () {
        var detailId = $(this).attr("data-value");
        $("#myModal .modal-title").html("Ubah Detail");
        $("#myModal .modal-body").load('{{url("purchreqline/edit/")}}' + detailId, function (e) {
            $("#myModal").modal('show');
        });
    });
</script>


{{ javascript_include('js/purchreqline.js') }}
