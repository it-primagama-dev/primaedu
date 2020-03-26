{{ content() }}
{{ form("deliveryreqheader/save", "method":"post") }}

<h1>
    {{ link_to("deliveryreqheader/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Pengiriman
    <small class="on-right">Ubah Pengiriman</small>
</h1>

<div class="grid fluid">
    <div class="row">
        <div class="span5">
            <label for="ResiId">No Resi</label>
            <div class="input-control text" data-role="input-control">
                <?php echo $this->tag->textField(array("ResiId", "size" => 30)) ?>
            </div>
			
            <label for="PurchReqId">Nomor Pembelian</label>
            <div class="input-control text" data-role="input-control">
                <?php echo $this->tag->textField(array("PurchReqId", "size" => 30)) ?>
            </div>


            <label for="DeliveryReqDate">Tanggal Kirim</label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                <?php echo $this->tag->textField(array("DeliveryReqDate", "size" => 30)) ?>
            </div>
			
			
            <label for="DeliveryReqDate">Tanggal Estimasi</label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                <?php echo $this->tag->textField(array("EstimasiDate", "size" => 30)) ?>
            </div>
			
			<label for="PurchReqId">Koli</label>
            <div class="input-control text" data-role="input-control">
                <?php echo $this->tag->textField(array("Koli", "size" => 30)) ?>
				 </div>

           
            {{ hidden_field("PurchReqId") }}
            {{ hidden_field("RecId") }}
            {{ submit_button("Simpan") }}
        </div>

    </div>
</div>

</form>

{{ hidden_field("dataTableUrl") }}
<table id="dataTable" class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Pengiriman</th>
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
        $("#myModal .modal-body").load('{{url("deliveryreqline/new/"~RecId)}}', function (e) {
            $("#myModal").modal('show');
        });
		
    });

	
    $("#dataTable tbody").on("click", "#editBtn", function () {
        var detailId = $(this).attr("data-value");
        $("#myModal .modal-title").html("Ubah Detail");
        $("#myModal .modal-body").load('{{url("deliveryreqline/edit2/")}}' + detailId, function (e) {
            $("#myModal").modal('show');
        });
    });
</script>


{{ javascript_include('js/purchreqline.js') }}
