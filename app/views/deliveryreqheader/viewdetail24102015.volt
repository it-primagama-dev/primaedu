<h1>
    {{ link_to("deliveryreqheader/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Pengiriman Buku
    <small class="on-right">Lihat Detail</small>
</h1>


{{ content() }}


{% if pr is not empty %}
    <table class="table bordered hovered" id="header">
        <thead>
            <tr>
                <th>Kode Cabang</th>
                <th>Kode Pembelian</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Requester</th>
                <th>Status</th>
            </tr>
        </thead>

<!-- Result View -->
<script type="text/javascript">
    function deleteList(id){
        document.getElementById("item"+id).innerHTML="";
    }

    function getDateAndSlipId(){
        var PurchReqIdSubmit = document.getElementById("PurchReqIdSubmit");
        var ReceiptDateSubmit = document.getElementById("ReceiptDateSubmit");
        var PackingSlipIdSubmit = document.getElementById("PackingSlipIdSubmit");

        PurchReqIdSubmit.value = document.getElementById("PurchReqId").value;
        ReceiptDateSubmit.value = document.getElementById("ReceiptDate").value;
        PackingSlipIdSubmit.value = document.getElementById("PackingSlipId").value;

        $('.loader').hide();


        return true;
    }
</script> 

<?php echo $this->tag->form(array("deliveryreqline/Qty", "autocomplete" => "off", "onclick" => "return getDateAndSlipId();")) ?>

<!-- Set PurchReqId, ReceiptDate, and PackingSlipId on submit -->


				<input type="text" name="PurchReqId" value="{{ pr.PurchReqId }}" />
<input type="text" name="Deliveryreqheader" value="{{ pr.RecId }}" />


        <tbody>
            <tr>
                <td>{{ pr.PurchReqId }}</td>
                <td>{{ pr.PurchReqId }}</td>
                <td>{{ pr.PurchReqDate }}</td>
                <td>{{ pr.PurchReqName }}</td>
                <td>{{ pr.Requester }}</td>
                <td>{{ pr.Status }}</td>
            </tr>
        </tbody>
    </table>

    {% if pr.Purchreqline is not empty %}
	
	<?php echo $this->tag->form("deliveryreqline/create") ?>
        <legend>
            <small class="on-right text-bold fg-darker">Detil Pembelian</small>
        </legend>
        <table class="table bordered hovered" id="detail">
            <thead>
                <tr>
                    <th rowspan="2">##</th>
                    <th rowspan="2">Kode Barang</th>
                    <th rowspan="2">Nama Barang</th>
                    <th colspan="3">Jumlah (Qty.)</th>
                </tr>
                <tr>
                    <th>Pembelian</th>
                    <th>Qty Akan Dikirim</th>
                </tr>
            </thead>
            <tbody>
                {% for line in pr.Purchreqline %}
				
                    <tr data-prlines="{{ line.RecId }}">
                        <td>{{ loop.index }}</td>
                        <td>{{ line.ItemId }}<input type="text" name="Deliveryreqheader" value="{{ line.RecId }}" /></td>
                        <td>{{ line.ItemName }}</td>
                        <td>{{ line.Qty }}</td>
            <td style="text-align:center;">
                <div class="input-control text" data-role="input-control">
           <?php echo $this->tag->numericField(array("". $line->RecId, "type" => "number", "min" => 1, "max" => 100000 , "size" => 30)) ?>
                </div>
            </td>

			    {% endfor %}
                    </tr>
                           <tr style="text-align:right;background:#FFF;">
                <td colspan="6"><?php echo $this->tag->submitButton(array("Post")) ?></td>
            </tr>

            </tbody>
        </table>
    {% endif %}
{% endif %}
