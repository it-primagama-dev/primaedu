
<?php echo $this->tag->form("Pemesanan/pesan") ?>

<h1>
    <?php echo $this->tag->linkTo(array("Pemesanan/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>')); ?>
    Silahkan pilih Kode Pemesanan Anda
    <small class="on-right"></small>
</h1>

<?php echo $this->getContent(); ?>

<div class="grid fluid">
    <div class="row">
         <div class="span2">
            <label for="RecId">Nomor Pembelian</label>
            <div class="input-control select" data-role="input-control" >
                <?php 

                if(!isset($NoPR)){
                    $test = $this->modelsManager->createBuilder()
                        ->columns(["Purchreqheader.RecId", "Purchreqheader.PurchReqId"])
                        ->from("Purchreqheader")
                        ->Join("Purchreqline", "Purchreqheader.RecId = p.Purchreqheader", "p")
                        ->where("Purchreqheader.Cabang = :cabang: AND p.QtyRemaining > 0 ")
                        ->groupBy(["Purchreqheader.RecId", "Purchreqheader.PurchReqId"])
                        ->getQuery()
                        ->execute(["cabang" => $areacabang])
                        ->setHydrateMode(\Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);

                        echo $this->tag->select(["PurchReqId", $test, "using" => ["PurchReqId", "PurchReqId"]]);
                }
                else {echo $this->tag->select(["PurchReqId", $NoPR, "using" => ["PurchReqId", "PurchReqId"]]); }
				
				
				?>

			</div>
       

           

            <?php echo $this->tag->submitButton("Check") ?>
        </div>
    </div>
</div>

</form>
