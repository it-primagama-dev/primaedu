{{ content() }}
{{ form("deliveryreqless/createdev", "method":"post") }}

<h1>
    {{ link_to("deliveryreqless/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Pengiriman
    <small class="on-right">Pengiriman</small>
</h1>



<div class="grid fluid">
    <div class="row">
        <div class="span6">
  <?php echo $this->tag->hiddenField(array("Purchreqheader", "size" => 30)) ?>
  <?php echo $this->tag->hiddenField(array("Cabang", "size" => 30)) ?>
    <?php echo $this->tag->hiddenField(array("devId","size" => 30)) ?>


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

            <?php echo $this->tag->submitButton("Simpan") ?>
        </div>
    </div>
</div>

</form>