{{ content() }}
{{ form("deliveryreqheader/create", "method":"post") }}

<h1>
    {{ link_to("deliveryreqheader/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Pengiriman
    <small class="on-right">Ubah Pengiriman</small>
</h1>



<div class="grid fluid">
    <div class="row">
        <div class="span6">
  <?php echo $this->tag->hiddenField(array("Purchreqheader", "size" => 30)) ?>
  <?php echo $this->tag->hiddenField(array("Cabang", "size" => 30)) ?>

            <label for="ResiId" ></label>
            <div class="input-control text" data-role="input-control">
                <?php echo $this->tag->hiddenField(array("ResiId", "size" => 30)) ?>
            </div>
			
            <label for="PurchReqId">Nomor Pembelian</label>
            <div class="input-control text" data-role="input-control">
                <?php echo $this->tag->textField(array("PurchReqId", "size" => 30)) ?>
            </div>


            <label for="DeliveryReqDate"></label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                <?php echo $this->tag->hiddenField(array("DeliveryReqDate", "size" => 30)) ?>
            </div>
			
			
            <label for="DeliveryReqDate"></label>
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                <?php echo $this->tag->hiddenField(array("EstimasiDate", "size" => 30)) ?>
            </div>
			
			<label for="PurchReqId"></label>
            <div class="input-control text" data-role="input-control">
                <?php echo $this->tag->hiddenField(array("Koli", "size" => 30)) ?>
            </div>

            <?php echo $this->tag->submitButton("Next") ?>
        </div>
    </div>
</div>

</form>