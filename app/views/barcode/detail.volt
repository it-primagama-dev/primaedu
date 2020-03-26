<?php

 use Phalcon\Tag; ?>

<?php echo $this->getContent(); ?>

    <legend><h1 style="padding-left:2%;">
    <?php echo $this->tag->linkTo(array("barcode", '<i class="icon-arrow-left-3 fg-darker smaller"></i>')); ?>
 Pencarian Detail Barcode</h1></legend>

                        <form id='userForm'>

                        <div class="row no-margin">
                            <div class="span4">
                                <label for="ViewType">Barcode</label>
                                <div class="input-control text">
                                    <input id="Barcode" name="Barcode"></input>
                                </div>
                            </div>
                            <div class="span4">
                                <label for="ViewType">Kode Cabang / PR</label>
                                <div class="input-control text">
                                    <input id="pr" name="pr"></input>
                                </div>
                            </div>
                        </div>

                            <div>
                            <div class="span4">
                            <button onclick="">Cari</button>
                            </div>
                            </div>
                    </form>
<legend></legend>
                    <div id='response'></div>
                    <script>
                    $(document).ready(function(){
                        $('#userForm').submit(function(){
                            
                            $('#response').html("<b>Loading response...</b>");
                            $(".loader").show();

                            $.ajax({
                                type: 'POST',
                                url: 'detailbarcode',
                                data: $(this).serialize()
                            })

                            .done(function(data){

                            $('#response').html(data);$(".loader").hide();return;

                            })

                            .fail(function() {
                             
                                alert( "Posting failed." );
                                 
                            });
                     
                            return false;
                        });
                    });
                    </script>