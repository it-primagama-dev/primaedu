<form action="#" id="form" class="form-horizontal table-responsive" style="display: none;">
    <input type="hidden" name="pr" id="pr" value="<?php echo $PR ;?>">   
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-3">
                <p style="padding-bottom: 10px"><img src="<?php echo base_url(); ?>assets/images/logo_new_web.png" width="215"></p>
                <table>
                    <tr>
                        <td width="215" style="background: #FFD700 !important;text-align: center;color: #000000 !important;padding: 5px 0px 5px 0px;">SHIP TO</td>
                    </tr>
                </table>
                </div>
                <div class="col-lg-6" style="text-align:center;">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa"> Packing Slip Susulan <b><?php echo $PR ;?> <b class="print-hidden"> / </b><b id="print_ps" class="print-hidden"></b></b> </i></p>
                </div>
                <div class="col-lg-3" style="text-align: center;">
                <table style="float: right;">
                        <tr>
                            <td style="padding-bottom: 33px;"><?php echo date('d-m-Y'); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i id="page1"></i></td>
                        </tr>
                    <tr>
                        <td width="215" style="background: #FFD700 !important;text-align: center;color: #000000 !important;padding: 5px 0px 5px 0px;">SHIPPER</td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-xs-12">
                <label id="area"></label><br>
                <label id="kodecabang"></label>,
                <label id="namacabang"></label><br>
                <label id="alamat"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">

        <div id="SD" style="display: none; padding-right: 0px; padding-left: 0px;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; font-size: 15px; padding-bottom: 26px;width: 10%;" rowspan="2"> SD</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 10%;" colspan="2">MAT</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 20%;" colspan="2">B.INA-IPA-IPS-PPKn</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 14%;" colspan="2">SE 1 & 2 MAT</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 20%;" colspan="2">SE 1 <br>B.INA-IPA-IPS-PPKn</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 20%;" colspan="2">SE 2 <br>B.INA-IPA-IPS-PPKn</th>
                        </tr>
                        <tr>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                        </tr>
                    </thead>
                    <tbody id="data_item_SD"></tbody>
                </table>
            </div>
        </div>

        <div id="SMP" style="display: none; padding-right: 0px; padding-left: 0px;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; font-size: 15px; padding-bottom: 26px;width: 10%;" rowspan="2"> SMP</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 11%;" colspan="2">MAT</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 11%;" colspan="2">B.INA</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 11%;" colspan="2">B.ING</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 11%;" colspan="2">IPA</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 11%;" colspan="2">IPS</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 11%;" colspan="2">SE 1</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 11%;" colspan="2">SE 2</th>
                        </tr>
                        <tr>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                        </tr>
                    </thead>
                    <tbody id="data_item_SMP"></tbody>
                </table>
            </div>
        </div>

        <div id="IPA" style="display: none; padding-right: 0px; padding-left: 0px;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; font-size: 15px; padding-bottom: 26px;width: 10%;" rowspan="2"> SMA IPA</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 12%;" colspan="2">MAT Wajib</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">B.INA</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">B.ING</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 12%;" colspan="2">MAT Minat</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">BIO</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">FIS</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">KIM</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">SE 1</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">SE 2</th>
                        </tr>
                        <tr>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                        </tr>
                    </thead>
                    <tbody id="data_item_IPA"></tbody>
                </table>
            </div>
        </div>

        <div id="IPS" style="display: none; padding-right: 0px; padding-left: 0px;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; font-size: 15px; padding-bottom: 26px;width: 10%;" rowspan="2"> SMA IPS</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 12%;" colspan="2">MAT Wajib</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">B.INA</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">B.ING</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">EKO</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">GEO</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">SOS</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">SEJ</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">SE 1</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important; width: 8%;" colspan="2">SE 2</th>
                        </tr>
                        <tr>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">K</th>
                            <th style="text-align:center;background: #FFD700 !important; color: #000000 !important;">T</th>
                        </tr>
                    </thead>
                    <tbody id="data_item_IPS"></tbody>
                </table>
            </div>
        </div>
                    <p style="font-size: 14px;">
                        <b> *Keterangan Singkatan & Kode : 
                            (1). K = Qty Kurang Kirim, 
                            (2). T = Qty Terkirim, (3). <b style="background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">&nbsp;&nbsp;-&nbsp;&nbsp;</b> = Tidak Ada Kurang Kirim.</b> <br>

                    </p>
    </div>
    </div>  
    <div class="row">
        <div class="col-lg-12">
        <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th style="text-align:center;background-color: #FFD700 !important; color: #000000 !important; padding: 0px">STAF LOGISTIK</th>
                        </tr>
                        <tr>
                            <th style="text-align:center; padding: 30px"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th style="text-align:center;background-color: #FFD700 !important; color: #000000 !important; padding: 0px">PROSES BARCODE</th>
                        </tr>
                        <tr>
                            <th style="text-align:center; padding: 30px"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-xs-4" style="padding-right: 0px; padding-left: 0px;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th style="text-align:center;background-color: #FFD700 !important; color: #000000 !important; padding: 0px">TGL PENGIRIMAN</th>
                        </tr>
                        <tr>
                            <th style="text-align:center; padding: 30px"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </div>
    <div class="row" id="Comment">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-xs-12">
                    <p style="border: solid; padding: 10px; text-align: justify; font-size: 10px;">
                        <b> Catatan penting untuk penerima :</b> <br>
                        "Harap konfirmasi melalui email ke logistik@primagama.co.id dan cc ke Area Manager paling lambat 3(tiga) hari setelah barang diterima apabila ada ketidak sesuaian dalam jumlah/jenis barang yang diorder, setelah masa konfimasi tersebut terlewati barang yang diterima dinyatakan telah sesuai dengan order"
                    </p>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="#" id="form2" class="form-horizontal" style="display: none;">
    <div class="printheight" id="printheight" style="display: none;"></div>
    <div class="row print-hidden">
        <div class="col-lg-12"><br>
            <legend></legend>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-md-3">
                <p style="padding-bottom: 10px"><img src="<?php echo base_url(); ?>assets/images/logo_new_web.png" width="215"></p>
                <table>
                    <tr>
                        <td width="215" style="background: #F0E68C !important;text-align: center;color: #000000 !important;padding: 5px 0px 5px 0px;">SHIP TO</td>
                    </tr>
                </table>
                </div>
                <div class="col-md-6" style="text-align:center;">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa"> Packing Slip <b><?php echo $PR ;?> <b class="print-hidden"> / </b><b id="print_ps2" class="print-hidden"></b></b> </i></p>
                </div>
                <div class="col-md-3" style="text-align: center;">
                    <table style="float: right;">
                        <tr>
                            <td style="padding-bottom: 33px;"><?php echo date('d-m-Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i id="page2" class=""></i></td>
                        </tr>
                        <tr>
                            <td width="215" style="background: #F0E68C !important;text-align: center;color: #000000 !important;padding: 5px 0px 5px 0px;">SHIPPER</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-xs-12">
                <label id="area2"></label><br>
                <label id="kodecabang2"></label>,
                <label id="namacabang2"></label><br>
                <label id="alamat2"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
        <div class="col-lg-4" id="2006" style="display: none; padding-right: 0px; padding-left: 0px;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th style="text-align:center;background: #F0E68C !important; color: #000000 !important; width: 45%; padding-bottom: 13px;">K2006</th>
                            <th style="text-align:center;background: #F0E68C !important; color: #000000 !important; width: 25%">Qty Order</th>
                            <th style="text-align:center;background: #F0E68C !important; color: #000000 !important; width: 30%">Qty Terkirim</th>
                        </tr>
                    </thead>
                    <tbody id="data_item_2006"></tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4" id="kurnas" style="display: none; padding-left: 0px; padding-right: 0px;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th style="text-align:center;background: #F0E68C !important; color: #000000 !important; width: 45%; padding-bottom: 13px;">KURNAS</th>
                            <th style="text-align:center;background: #F0E68C !important; color: #000000 !important; width: 25%">Qty Order</th>
                            <th style="text-align:center;background: #F0E68C !important; color: #000000 !important; width: 30%">Qty Terkirim</th>
                        </tr>
                    </thead>
                    <tbody id="data_item_kurnas"></tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4" id="inten" style="display: none; padding-left: 0px; padding-right: 0px;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                        <tr>
                            <th style="text-align:center;background: #F0E68C !important; color: #000000 !important; width: 50%;padding-bottom: 13px;">INTENSIF</th>
                            <th style="text-align:center;background: #F0E68C !important; color: #000000 !important; width: 25%">Qty Order</th>
                            <th style="text-align:center;background: #F0E68C !important; color: #000000 !important; width: 25%">Qty Terkirim</th>
                        </tr>
                    </thead>
                    <tbody id="data_item_inten"></tbody>
                </table>
            </div>
        </div>
    </div>  
    </div>
    <div class="row" style="padding-top: -100px">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="text-align:center;background-color: #F0E68C !important; color: #000000 !important;width: 33.5%">STAF LOGISTIK</th>
                            <th style="text-align:center;background-color: #F0E68C !important; color: #000000 !important;width: 33.5%">PROSES BARCODE</th>
                            <th style="text-align:center;background-color: #F0E68C !important; color: #000000 !important;width: 33.5%">TANGGAL PENGIRIMAN</th>
                        </tr>
                        <tr>
                            <th style="text-align:center; padding: 35px"></th>
                            <th style="text-align:center; padding: 35px"></th>
                            <th style="text-align:center; padding: 35px"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-xs-12">
                    <p style="border: solid; padding: 10px; text-align: justify; font-size: 10px">
                        <b> Catatan penting untuk penerima :</b> <br>
                        "Harap konfirmasi melalui email ke logistik@primagama.co.id dan cc ke Area Manager paling lambat 3(tiga) hari setelah barang diterima apabila ada ketidak sesuaian dalam jumlah/jenis barang yang diorder, setelah masa konfimasi tersebut terlewati barang yang diterima dinyatakan telah sesuai dengan order"
                    </p>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="#" id="form3" class="form-horizontal">
    <div class="printheight2" id="printheight2" style="display: none;"></div>
    <div class="row1">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-md-3">
                <p style="padding-top: 10px;"><img src="<?php echo base_url(); ?>assets/images/logo_new_web.png" width="215"></p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <p style="font-size: 22px;" class="fa">
                    <i style="margin-bottom: 3px; font-weight: bold;" class="fa">KEPADA YTH,</i><br> 
                    <i style="margin-bottom: 3px; font-weight: bold;" class="fa" id="namacabang3"></i><br>
                    <i style="margin-bottom: 3px;" class="fa" id="alamat3"></i><br>
                    <i style="margin-bottom: 3px;" class="fa" id="notelp"></i><br>
                    <i class="fa" id="kota"></i>
                    </p>
                    <legend style="border: 1px solid #000080 !important; margin-bottom: 10px;"></legend>
                    <p style="font-size: 20px;" class="fa">
                    <i class="fa" style="margin-bottom: 3px; font-weight: bold;">Kode Cabang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; </i><i style="margin-bottom: 3px; font-weight: bold;" class="fa" id="kodecbg"> </i><br>
                    <i class="fa" style="margin-bottom: 3px; font-weight: bold;">Contact Person &nbsp;&nbsp;:&nbsp;&nbsp; </i><i style="margin-bottom: 3px; font-weight: bold;" class="fa" id="cperson"> </i></p>
                    <legend style="border: 1px solid #000080 !important; margin-bottom: 10px;"></legend>
                    <p style="font-size: 18px;" class="fa">
                    <b class="fa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Koli Ke &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dari &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Koli </b></p>
                    <legend style="border: 1px solid #000080 !important; margin-bottom: 10px;"></legend>
                    <p style="font-size: 18px;" class="fa">
                    <i style="margin-bottom: 3px; color: green !important;" class="fa">PENGIRIM : PRIMAGAMA</i><br>
                    <i style="margin-bottom: 3px; color: green !important;" class="fa">LOGISTIK PRIMA EDU PENDAMPING BELAJAR</i><br>
                    <i style="margin-bottom: 3px; color: green !important;" class="fa">Jl. Monjali 99, Mlati, Sinduadi, Sleman, Yk</i><br>
                    <i style="margin-bottom: 3px; color: green !important;" class="fa">TELP. 0274 - 552996</i><br>
                    <i style="margin-bottom: 3px; color: green !important;" class="fa">YOGYAKARTA, 55284</i>
                    </p>
                    <legend style="border: 1px solid #000080 !important; margin-bottom: 7px;"></legend>
                    <div class="col-lg-12" style=" text-align: center;">
                    <p style="font-size: 20px; color: red !important; text-align: center;" class="fa">
                    <b style="text-align: center; color: red !important;">ISI BUKU / MUDAH RUSAK</b><br>
                    <b style="text-align: center; color: red !important;">MOHON TIDAK DIBANTING !</b><br>
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row1" style="margin-top: 30px;">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-md-3">
                <p style="padding-top: 10px;"><img src="<?php echo base_url(); ?>assets/images/logo_new_web.png" width="215"></p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <p style="font-size: 22px; margin-top: 1px;" class="fa">
                    <i style="margin-bottom: 3px; font-weight: bold;" class="fa">KEPADA YTH,</i><br> 
                    <i style="margin-bottom: 3px; font-weight: bold;" class="fa" id="namacabang32"></i><br>
                    <i style="margin-bottom: 3px;" class="fa" id="alamat32"></i><br>
                    <i style="margin-bottom: 3px;" class="fa" id="notelp2"></i><br>
                    <i class="fa" id="kota2"></i>
                    </p>
                    <legend style="border: 1px solid #000080 !important; margin-bottom: 10px;"></legend>
                    <p style="font-size: 20px;" class="fa">
                    <i class="fa" style="margin-bottom: 3px; font-weight: bold;">Kode Cabang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; </i><i style="margin-bottom: 3px; font-weight: bold;" class="fa" id="kodecbg2"></i><br>
                    <i class="fa" style="margin-bottom: 3px; font-weight: bold;">Contact Person &nbsp;&nbsp;:&nbsp;&nbsp; </i><i style="margin-bottom: 3px; font-weight: bold;" class="fa" id="cperson2"></i></p>
                    <legend style="border: 1px solid #000080 !important; margin-bottom: 10px;"></legend>
                    <p style="font-size: 18px;" class="fa">
                    <b class="fa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Koli Ke &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dari &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Koli </b></p>
                    <legend style="border: 1px solid #000080 !important; margin-bottom: 10px;"></legend>
                    <p style="font-size: 18px; color: green !important;" class="fa">
                    <i style="margin-bottom: 3px; color: green !important;" class="fa">PENGIRIM : PRIMAGAMA</i><br>
                    <i style="margin-bottom: 3px; color: green !important;" class="fa">LOGISTIK PRIMA EDU PENDAMPING BELAJAR</i><br>
                    <i style="margin-bottom: 3px; color: green !important;" class="fa">Jl. Monjali 99, Mlati, Sinduadi, Sleman, Yk</i><br>
                    <i style="margin-bottom: 3px; color: green !important;" class="fa">TELP. 0274 - 552996</i><br>
                    <i style="margin-bottom: 3px; color: green !important;" class="fa">YOGYAKARTA, 55284</i>
                    </p>
                    <legend style="border: 1px solid #000080 !important; margin-bottom: 7px;"></legend>
                    <div class="col-lg-12" style=" text-align: center;">
                    <p style="font-size: 20px; color: red !important; text-align: center;" class="fa">
                    <b style="text-align: center; color: red !important;">ISI BUKU / MUDAH RUSAK</b><br>
                    <b style="text-align: center; color: red !important;">MOHON TIDAK DIBANTING !</b><br>
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="#" id="form4" class="form-horizontal">
        <div class="checkbox checkbox-success checkbox-inline print-hidden">
            <input type="checkbox" id="inlineCheckbox2" onchange="document.getElementById('form3').hidden = this.checked;" name='cek'>
            <label for="inlineCheckbox2"> Tidak cetak alamat.  </label>

        </div>
    <div class="row print-hidden">
        <div class="col-lg-12">
            <br>
            <button type="button" class="btn btn-success print-hidden" onclick="update_print()"><span class="glyphicon glyphicon-print"></span> Print</button>
        </div>
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<style>
.row1 > div {
    border: solid 2px #000080 !important; margin-bottom: 7PX;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
    reload_data();
});
function redirectPost(url, data) {
    var form = document.createElement('form');
    document.body.appendChild(form);
    form.method = 'post';
    form.action = url;
    for (var name in data) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = data[name];
        form.appendChild(input);
    }
    form.submit();
}
function reload_data() {
    var PR = window.btoa($('#pr').val());
    var token = window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=");
    $.ajax({
        url : base_url+"Logistics/get_detail_packing_less",
        type: 'POST',
        data: ({PR:PR,token:token}),
        dataType: 'json',
        beforeSend: function(){
            $("#ajax-loader").show();
        },
        complete: function() {
            $("#ajax-loader").hide();
        },
        success: function(data){
            var jml_data = Object.keys(data.rows).length;
            if(data.rows!=0){
                $('#SD').css('display','block');
            }
            if(data.rowssmp!=0){
                $('#SMP').css('display','block');
            }
            if(data.rowsipa!=0){
                $('#IPA').css('display','block');
            }
            if(data.rowsips!=0){
                $('#IPS').css('display','block');
            }
            if(data.rows2006!=0){
                $('#2006').css('display','block');
            }
            if(data.rowsnas!=0){
                $('#kurnas').css('display','block');
            }
            if(data.rowsinten!=0){
                $('#inten').css('display','block');
            }

            var total = 0;
                $.each(data.rows, function(i, item) {
                    if(item.MTKSD==0) {
                        trsd1 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        MTKSD = '-';
                    } else {
                        trsd1 = '<td style="text-align:center;">';
                        MTKSD = item.MTKSD;
                    }

                    if(item.TEMATIKSD==0) {
                        trsd2 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        TEMATIKSD = '-';

                    } else {
                        trsd2 = '<td style="text-align:center;">';
                        TEMATIKSD = item.TEMATIKSD;
                    }

                    if(item.SE12MTKSD==0) {
                        trsd3 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        SE12MTKSD = '-';

                    } else {
                        trsd3 = '<td style="text-align:center;">';
                        SE12MTKSD = item.SE12MTKSD;
                    }

                    if(item.SE1TEMATIKSD==0) {
                        trsd4 = '<td style="text-align:center; background-image: repeating-linear-gradient( 90deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px );">';
                        SE1TEMATIKSD = '-';

                    } else {
                        trsd4 = '<td style="text-align:center;">';
                        SE1TEMATIKSD = item.SE1TEMATIKSD;
                    }

                    if(item.SE2TEMATIKSD==0) {
                        trsd5 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        SE2TEMATIKSD = '-';

                    } else {
                        trsd5 = '<td style="text-align:center;">';
                        SE2TEMATIKSD = item.SE2TEMATIKSD;
                    }
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.PS_Pack),
                        $(trsd1).text(MTKSD),
                        $(trsd1).text(''),
                        $(trsd2).text(TEMATIKSD),
                        $(trsd2).text(''),
                        $(trsd3).text(SE12MTKSD),
                        $(trsd3).text(''),
                        $(trsd4).text(SE1TEMATIKSD),
                        $(trsd4).text(''),
                        $(trsd5).text(SE2TEMATIKSD),
                        $(trsd5).text('')
                    ).appendTo('#data_item_SD');
                });
                $.each(data.rowssmp, function(i, item) {
                    if(item.MTKSMP==0) {
                        trsmp1 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        MTKSMP = '-';
                    } else {
                        trsmp1 = '<td style="text-align:center;">';
                        MTKSMP = item.MTKSMP;
                    }

                    if(item.BINDSMP==0) {
                        trsmp2 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        BINDSMP = '-';
                    } else {
                        trsmp2 = '<td style="text-align:center;">';
                        BINDSMP = item.BINDSMP;
                    }

                    if(item.BINGSMP==0) {
                        trsmp3 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        BINGSMP = '-';
                    } else {
                        trsmp3 = '<td style="text-align:center;">';
                        BINGSMP = item.BINGSMP;
                    }
                    
                    if(item.IPASMP==0) {
                        trsmp4 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        IPASMP = '-';
                    } else {
                        trsmp4 = '<td style="text-align:center;">';
                        IPASMP = item.IPASMP;
                    }
                    
                    if(item.IPSSMP==0) {
                        trsmp5 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        IPSSMP = '-';
                    } else {
                        trsmp5 = '<td style="text-align:center;">';
                        IPSSMP = item.IPSSMP;
                    }
                    
                    if(item.SE1SMP==0) {
                        trsmp6 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        SE1SMP = '-';
                    } else {
                        trsmp6 = '<td style="text-align:center;">';
                        SE1SMP = item.SE1SMP;
                    }
                    
                    if(item.SE2SMP==0) {
                        trsmp7 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        SE2SMP = '-';
                    } else {
                        trsmp7 = '<td style="text-align:center;">';
                        SE2SMP = item.SE2SMP;
                    }
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.PS_Pack),
                        $(trsmp1).text(MTKSMP),
                        $(trsmp1).text(''),
                        $(trsmp2).text(BINDSMP),
                        $(trsmp2).text(''),
                        $(trsmp3).text(BINGSMP),
                        $(trsmp3).text(''),
                        $(trsmp4).text(IPASMP),
                        $(trsmp4).text(''),
                        $(trsmp5).text(IPSSMP),
                        $(trsmp5).text(''),
                        $(trsmp6).text(SE1SMP),
                        $(trsmp6).text(''),
                        $(trsmp7).text(SE2SMP),
                        $(trsmp7).text('')
                    ).appendTo('#data_item_SMP');
                });
                $.each(data.rowsipa, function(i, item) {
                    if(item.MTKSMA==0) {
                        tripa1 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        MTKSMA = '-';
                    } else {
                        tripa1 = '<td style="text-align:center;">';
                        MTKSMA = item.MTKSMA;
                    }

                    if(item.BINDSMA==0) {
                        tripa2 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        BINDSMA = '-';
                    } else {
                        tripa2 = '<td style="text-align:center;">';
                        BINDSMA = item.BINDSMA;
                    }

                    if(item.BINGSMA==0) {
                        tripa3 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        BINGSMA = '-';
                    } else {
                        tripa3 = '<td style="text-align:center;">';
                        BINGSMA = item.BINGSMA;
                    }

                    if(item.MTKM==0) {
                        tripa4 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        MTKM = '-';
                    } else {
                        tripa4 = '<td style="text-align:center;">';
                        MTKM = item.MTKM;
                    }

                    if(item.BIO==0) {
                        tripa5 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        BIO = '-';
                    } else {
                        tripa5 = '<td style="text-align:center;">';
                        BIO = item.BIO;
                    }

                    if(item.FIS==0) {
                        tripa6 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        FIS = '-';
                    } else {
                        tripa6 = '<td style="text-align:center;">';
                        FIS = item.FIS;
                    }

                    if(item.KIM==0) {
                        tripa7 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        KIM = '-';
                    } else {
                        tripa7 = '<td style="text-align:center;">';
                        KIM = item.KIM;
                    }

                    if(item.SE1IPA==0) {
                        tripa8 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        SE1IPA = '-';
                    } else {
                        tripa8 = '<td style="text-align:center;">';
                        SE1IPA = item.SE1IPA;
                    }

                    if(item.SE2IPA==0) {
                        tripa9 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        SE2IPA = '-';
                    } else {
                        tripa9 = '<td style="text-align:center;">';
                        SE2IPA = item.SE2IPA;
                    }

                    var $tr = $('<tr>').append(
                        $('<td>').text(item.PS_Pack),
                        $(tripa1).text(MTKSMA),
                        $(tripa1).text(''),
                        $(tripa2).text(BINDSMA),
                        $(tripa2).text(''),
                        $(tripa3).text(BINGSMA),
                        $(tripa3).text(''),
                        $(tripa4).text(MTKM),
                        $(tripa4).text(''),
                        $(tripa5).text(BIO),
                        $(tripa5).text(''),
                        $(tripa6).text(FIS),
                        $(tripa6).text(''),
                        $(tripa7).text(KIM),
                        $(tripa7).text(''),
                        $(tripa8).text(SE1IPA),
                        $(tripa8).text(''),
                        $(tripa9).text(SE2IPA),
                        $(tripa9).text('')
                    ).appendTo('#data_item_IPA');
                });
                $.each(data.rowsips, function(i, item) {
                    if(item.MTKSMA==0) {
                        trips1 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        MTKSMA = '-';
                    } else {
                        trips1 = '<td style="text-align:center;">';
                        MTKSMA = item.MTKSMA;
                    }

                    if(item.BINDSMA==0) {
                        trips2 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        BINDSMA = '-';
                    } else {
                        trips2 = '<td style="text-align:center;">';
                        BINDSMA = item.BINDSMA;
                    }

                    if(item.BINGSMA==0) {
                        trips3 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        BINGSMA = '-';
                    } else {
                        trips3 = '<td style="text-align:center;">';
                        BINGSMA = item.BINGSMA;
                    }

                    if(item.EKO==0) {
                        trips4 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        EKO = '-';
                    } else {
                        trips4 = '<td style="text-align:center;">';
                        EKO = item.EKO;
                    }

                    if(item.GEO==0) {
                        trips5 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        GEO = '-';
                    } else {
                        trips5 = '<td style="text-align:center;">';
                        GEO = item.GEO;
                    }

                    if(item.SOS==0) {
                        trips6 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        SOS = '-';
                    } else {
                        trips6 = '<td style="text-align:center;">';
                        SOS = item.SOS;
                    }

                    if(item.SEJ==0) {
                        trips7 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        SEJ = '-';
                    } else {
                        trips7 = '<td style="text-align:center;">';
                        SEJ = item.SEJ;
                    }

                    if(item.SE1IPS==0) {
                        trips8 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        SE1IPS = '-';
                    } else {
                        trips8 = '<td style="text-align:center;">';
                        SE1IPS = item.SE1IPS;
                    }

                    if(item.SE2IPS==0) {
                        trips9 = '<td style="text-align:center; background-image: repeating-linear-gradient( 45deg, #ccc, #ccc 5px, #aaa 5px, #aaa 10px ) !important;">';
                        SE2IPS = '-';
                    } else {
                        trips9 = '<td style="text-align:center;">';
                        SE2IPS = item.SE2IPS;
                    }

                    var $tr = $('<tr>').append(
                        $('<td>').text(item.PS_Pack),
                        $(trips1).text(MTKSMA),
                        $(trips1).text(''),
                        $(trips2).text(BINDSMA),
                        $(trips2).text(''),
                        $(trips3).text(BINGSMA),
                        $(trips3).text(''),
                        $(trips4).text(EKO),
                        $(trips4).text(''),
                        $(trips5).text(GEO),
                        $(trips5).text(''),
                        $(trips6).text(SOS),
                        $(trips6).text(''),
                        $(trips7).text(SEJ),
                        $(trips7).text(''),
                        $(trips8).text(SE1IPS),
                        $(trips8).text(''),
                        $(trips9).text(SE2IPS),
                        $(trips9).text('')
                    ).appendTo('#data_item_IPS');
                });
                $.each(data.rows2006, function(i, item) {
                    var $tr = $('<tr>').append(
                        $('<td style="text-align:left;">').text(item.PS_NAME),
                        $('<td style="text-align:center;">').text(item.Quantity-item.Qty),
                        $('<td style="text-align:center;">').text(''),
                    ).appendTo('#data_item_2006');
                });
                $.each(data.rowsnas, function(i, item) {
                    var $tr = $('<tr>').append(
                        $('<td style="text-align:left;">').text(item.PS_NAME),
                        $('<td style="text-align:center;">').text(item.Quantity-item.Qty),
                        $('<td style="text-align:center;">').text(''),
                    ).appendTo('#data_item_kurnas');
                });
                $.each(data.rowsinten, function(i, item) {
                    var $tr = $('<tr>').append(
                        $('<td style="text-align:left;">').text(item.PS_NAME),
                        $('<td style="text-align:center;">').text(item.Quantity-item.Qty),
                        $('<td style="text-align:center;">').text(''),
                    ).appendTo('#data_item_inten');
                });
                $.each(data.rowsinfo, function(i, item) {
                    area = item.Area;
                    print_ps = item.Print_PS+1;
                    kodecabang = item.KodeAreaCabang;
                    namacabang = item.NamaAreaCabang;
                    alamat = item.alamat+' / Contact Person : '+item.notelp+' / '+item.nohp;
                    alamat3 = item.alamat+', '+item.KodePos;
                    notelp = item.notelp+' / '+item.nohp;
                    kota = item.Kota+', '+item.Propinsi;
                    manager = item.NamaManager+' / '+item.nohp;
                });
                $('#area,#area2').text('Area : '+area);
                $('#kodecabang,#kodecabang2,#kodecbg').text('Kode Cabang : '+kodecabang);
                $('#namacabang,#namacabang2').text('Nama Cabang : '+namacabang);
                $('#namacabang3,#namacabang32').text('PRIMAGAMA '+namacabang);
                $('#alamat,#alamat2').text(alamat);
                $('#print_ps,#print_ps2').text(print_ps);
                $('#alamat3,#alamat32').text(alamat3);
                $('#notelp,#notelp2').text(notelp);
                $('#kota,#kota2').text(kota);
                $('#kodecbg,#kodecbg2').text(kodecabang);
                $('#cperson,#cperson2').text(manager);

                jsd = Object.keys(data.rows).length;
                jsmp = Object.keys(data.rowssmp).length;
                jipa = Object.keys(data.rowsipa).length;
                jips = Object.keys(data.rowsips).length;
                j2006 = Object.keys(data.rows2006).length;
                jnas = Object.keys(data.rowsnas).length;
                jinten = Object.keys(data.rowsinten).length;
                jtot1 = jsd+jsmp+jipa+jips;
                jtot2 = jnas+j2006+jinten;
                if(jtot1!=0){
                    $('#form').css('display','block');
                } 
                if(jtot2!=0){
                    $('#form2').css('display','block');
                }
                if(jtot1!=0 && jtot2!=0){
                    $('#page1').text('1/2');
                    $('#page2').text('2/2');
                    $('#printheight').css('margin-top','800px');
                } else {
                    $('#printheight').css('margin-top','0px');
                }
                $('#printheight2').css('margin-top','800px');
           }
    });
};

function update_print() {
    var PR = window.btoa($('#pr').val());
    var token = window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=");
    var countprint = window.btoa(document.getElementById('print_ps').innerHTML);
    $.ajax({
        url : base_url+"Logistics/update_print",
        type: "POST",
        data: ({PR:PR,token:token,print_ps:countprint}),
        dataType: "JSON",
        beforeSend: function(){
            $("#ajax-loader").show();
        },
        complete: function() {
            $("#ajax-loader").hide();
        },
        success: function(data)
        {
            window.print();
            $("#ajax-loader").hide();
            redirectPost(base_url+'Logistics/list_do_less');
            $.notify(data.message,data.notify);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR.status);
        }
    });
}

// disable ctrl+p / ctrl+ship+p
/*window.addEventListener("keydown",function(e) {
    if(e.ctrlKey&&(e.which==80)) {
        e.preventDefault()
    }
});*/
</script>
<style type="text/css">
.header-laporan {display: none;}
th {
    height: 10px;
}
@media print {
    @page {size: A4;margin: 0px auto;}
    html, body {
        -webkit-print-color-adjust: exact;
        zoom: 95%;
    }
    textarea {border-style: none;border-color: Transparent;overflow: auto;resize: none;}
    select {-moz-appearance: none;-webkit-appearance:none;}
    select::-ms-expand {display: none;}
    .hr {border-bottom: 1px solid black;}
    .header-laporan {display: block;padding-bottom: 25px;padding-top: 25px}
    .doble-border {border-bottom-style: double !important;}
    .navbar-default,.print-hidden,.ibox-title,.breadcrumb,.theme-config,.footer,#btnSave { display: none; }
    .ibox-content {border-color: transparent;}
    .form-control,.form-control[readonly] {background-color:transparent;border:none;/*overflow-wrap: break-word;*//*word-wrap: break-word;*/}
    .ibox-content {border-color: transparent;}
    .print-block {margin-top: 350px;margin-bottom: 350px;}
    .font-print {font-size: 12px;}
    .chosen-container-single .chosen-single {border: none;background:transparent;-moz-appearance: none;-webkit-appearance:none;border-top-right-radius: 0px;-webkit-box-shadow: none;box-shadow: none;}
    .chosen-container-single .chosen-single div b {display: none;}
    .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12,
    .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12,
    .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12,
    .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 { float: left; }
    .col-sm-12,.col-xs-12,.col-md-12,.col-lg-12 { width: 100%; }
    .col-sm-11,.col-xs-11,.col-md-11,.col-lg-11 { width: 91.66666666666666%; }
    .col-sm-10,.col-xs-10,.col-md-10,.col-lg-10 { width: 83.33333333333334%; }
    .col-sm-9,.col-xs-9,.col-md-9,.col-lg-9 { width: 75%; }
    .col-sm-8,.col-xs-8,.col-md-8,.col-lg-8 { width: 66.66666666666666%; }
    .col-sm-7,.col-xs-7,.col-md-7,.col-lg-7 { width: 58.333333333333336%; }
    .col-sm-6,.col-xs-6,.col-md-6,.col-lg-6 { width: 50%; }
    .col-sm-5,.col-xs-5,.col-md-5,.col-lg-5 { width: 41.66666666666667%; }
    .col-sm-4,.col-xs-4,.col-md-4,.col-lg-4 { width: 33.33333333333333%; }
    .col-sm-3,.col-xs-3,.col-md-3,.col-lg-3 { width: 25%; }
    .col-sm-2,.col-xs-2,.col-md-2,.col-lg-2 { width: 16.666666666666664%; }
    .col-sm-1,.col-xs-1,.col-md-1,.col-lg-1 { width: 8.333333333333332%; }
    .col-xs-offset-12 {margin-left: 100%;}
    .col-xs-offset-11 {margin-left: 91.66666667%;}
    .col-xs-offset-10 {margin-left: 83.33333333%;}
    .col-xs-offset-9 {margin-left: 75%;}
    .col-xs-offset-8 {margin-left: 66.66666667%;}
    .col-xs-offset-7 {margin-left: 58.33333333%;}
    .col-xs-offset-6 {margin-left: 50%;}
    .col-xs-offset-5 {margin-left: 41.66666667%;}
    .col-xs-offset-4 {margin-left: 33.33333333%;}
    .col-xs-offset-3 {margin-left: 25%;}
    .col-xs-offset-2 {margin-left: 16.66666667%;}
    .col-xs-offset-1 {margin-left: 8.33333333%;}
    .col-xs-offset-0 {margin-left: 0;}
    .col-sm-offset-12 {margin-left: 100%;}
    .col-sm-offset-11 {margin-left: 91.66666667%;}
    .col-sm-offset-10 {margin-left: 83.33333333%;}
    .col-sm-offset-9 {margin-left: 75%;}
    .col-sm-offset-8 {margin-left: 66.66666667%;}
    .col-sm-offset-7 {margin-left: 58.33333333%;}
    .col-sm-offset-6 {margin-left: 50%;}
    .col-sm-offset-5 {margin-left: 41.66666667%;}
    .col-sm-offset-4 {margin-left: 33.33333333%;}
    .col-sm-offset-3 {margin-left: 25%;}
    .col-sm-offset-2 {margin-left: 16.66666667%;}
    .col-sm-offset-1 {margin-left: 8.33333333%;}
    .col-sm-offset-0 {margin-left: 0;}
    .col-md-offset-12 {margin-left: 100%;}
    .col-md-offset-11 {margin-left: 91.66666667%;}
    .col-md-offset-10 {margin-left: 83.33333333%;}
    .col-md-offset-9 {margin-left: 75%;}
    .col-md-offset-8 {margin-left: 66.66666667%;}
    .col-md-offset-7 {margin-left: 58.33333333%;}
    .col-md-offset-6 {margin-left: 50%;}
    .col-md-offset-5 {margin-left: 41.66666667%;}
    .col-md-offset-4 {margin-left: 33.33333333%;}
    .col-md-offset-3 {margin-left: 25%;}
    .col-md-offset-2 {margin-left: 16.66666667%;}
    .col-md-offset-1 {margin-left: 8.33333333%;}
    .col-md-offset-0 {margin-left: 0;}
    .col-lg-offset-12 {margin-left: 100%;}
    .col-lg-offset-11 {margin-left: 91.66666667%;}
    .col-lg-offset-10 {margin-left: 83.33333333%;}
    .col-lg-offset-9 {margin-left: 75%;}
    .col-lg-offset-8 {margin-left: 66.66666667%;}
    .col-lg-offset-7 {margin-left: 58.33333333%;}
    .col-lg-offset-6 {margin-left: 50%;}
    .col-lg-offset-5 {margin-left: 41.66666667%;}
    .col-lg-offset-4 {margin-left: 33.33333333%;}
    .col-lg-offset-3 {margin-left: 25%;}
    .col-lg-offset-2 {margin-left: 16.66666667%;}
    .col-lg-offset-1 {margin-left: 8.33333333%;}
    .col-lg-offset-0 {margin-left: 0;}
    .select2-container--default .select2-selection--single {
        border: none;
        padding: 0px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        display: none;
    }
    #page-wrapper {
        margin-left: 0px;
        margin-top: -80px;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > thead > tr > td {
        border-bottom-width: 1px;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > th,
    .table-bordered > tfoot > tr > th,
    .table-bordered > thead > tr > td,
    .table-bordered > tbody > tr > td,
    .table-bordered > tfoot > tr > td {
        border: 1px solid #333 !important;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f9f9f9 !important;
    }
    .table > tbody + tbody {
        border-top: 1px solid #333 !important;
    }
    .table > tbody > tr > td,
    .table > tfoot > tr > td,
    .table-bordered > tbody > tr > th {
        line-height: 0.5;
    }
    .table-responsive {
        overflow-x: unset;
    }
    .printheight {
        display: block !important;
    }
    .printheight2 {
        display: block !important;
    }
}
</style>
<style type="text/css">
    .checkbox {
  padding-left: 20px; }
  .checkbox label {
    display: inline-block;
    position: relative;
    padding-left: 5px; }
    .checkbox label::before {
      content: "";
      display: inline-block;
      position: absolute;
      width: 17px;
      height: 17px;
      left: 0;
      margin-left: -20px;
      border: 1px solid #cccccc;
      border-radius: 3px;
      background-color: #fff;
      -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
      -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
      transition: border 0.15s ease-in-out, color 0.15s ease-in-out; }
    .checkbox label::after {
      display: inline-block;
      position: absolute;
      width: 16px;
      height: 16px;
      left: 0;
      top: 0;
      margin-left: -20px;
      padding-left: 3px;
      padding-top: 1px;
      font-size: 11px;
      color: #555555; }
  .checkbox input[type="checkbox"] {
    opacity: 0; }
    .checkbox input[type="checkbox"]:focus + label::before {
      outline: thin dotted;
      outline: 5px auto -webkit-focus-ring-color;
      outline-offset: -2px; }
    .checkbox input[type="checkbox"]:checked + label::after {
      font-family: 'FontAwesome';
      content: "\f00c"; }
    .checkbox input[type="checkbox"]:disabled + label {
      opacity: 0.65; }
      .checkbox input[type="checkbox"]:disabled + label::before {
        background-color: #eeeeee;
        cursor: not-allowed; }
  .checkbox.checkbox-circle label::before {
    border-radius: 50%; }
  .checkbox.checkbox-inline {
    margin-top: 0; }

.checkbox-primary input[type="checkbox"]:checked + label::before {
  background-color: #428bca;
  border-color: #428bca; }
.checkbox-primary input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-danger input[type="checkbox"]:checked + label::before {
  background-color: #d9534f;
  border-color: #d9534f; }
.checkbox-danger input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-info input[type="checkbox"]:checked + label::before {
  background-color: #5bc0de;
  border-color: #5bc0de; }
.checkbox-info input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-warning input[type="checkbox"]:checked + label::before {
  background-color: #f0ad4e;
  border-color: #f0ad4e; }
.checkbox-warning input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-success input[type="checkbox"]:checked + label::before {
  background-color: #5cb85c;
  border-color: #5cb85c; }
.checkbox-success input[type="checkbox"]:checked + label::after {
  color: #fff; }

.radio {
  padding-left: 20px; }
  .radio label {
    display: inline-block;
    position: relative;
    padding-left: 5px; }
    .radio label::before {
      content: "";
      display: inline-block;
      position: absolute;
      width: 17px;
      height: 17px;
      left: 0;
      margin-left: -20px;
      border: 1px solid #cccccc;
      border-radius: 50%;
      background-color: #fff;
      -webkit-transition: border 0.15s ease-in-out;
      -o-transition: border 0.15s ease-in-out;
      transition: border 0.15s ease-in-out; }
    .radio label::after {
      display: inline-block;
      position: absolute;
      content: " ";
      width: 11px;
      height: 11px;
      left: 3px;
      top: 3px;
      margin-left: -20px;
      border-radius: 50%;
      background-color: #555555;
      -webkit-transform: scale(0, 0);
      -ms-transform: scale(0, 0);
      -o-transform: scale(0, 0);
      transform: scale(0, 0);
      -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33); }
  .radio input[type="radio"] {
    opacity: 0; }
    .radio input[type="radio"]:focus + label::before {
      outline: thin dotted;
      outline: 5px auto -webkit-focus-ring-color;
      outline-offset: -2px; }
    .radio input[type="radio"]:checked + label::after {
      -webkit-transform: scale(1, 1);
      -ms-transform: scale(1, 1);
      -o-transform: scale(1, 1);
      transform: scale(1, 1); }
    .radio input[type="radio"]:disabled + label {
      opacity: 0.65; }
      .radio input[type="radio"]:disabled + label::before {
        cursor: not-allowed; }
  .radio.radio-inline {
    margin-top: 0; }

.radio-primary input[type="radio"] + label::after {
  background-color: #428bca; }
.radio-primary input[type="radio"]:checked + label::before {
  border-color: #428bca; }
.radio-primary input[type="radio"]:checked + label::after {
  background-color: #428bca; }

.radio-danger input[type="radio"] + label::after {
  background-color: #d9534f; }
.radio-danger input[type="radio"]:checked + label::before {
  border-color: #d9534f; }
.radio-danger input[type="radio"]:checked + label::after {
  background-color: #d9534f; }

.radio-info input[type="radio"] + label::after {
  background-color: #5bc0de; }
.radio-info input[type="radio"]:checked + label::before {
  border-color: #5bc0de; }
.radio-info input[type="radio"]:checked + label::after {
  background-color: #5bc0de; }

.radio-warning input[type="radio"] + label::after {
  background-color: #f0ad4e; }
.radio-warning input[type="radio"]:checked + label::before {
  border-color: #f0ad4e; }
.radio-warning input[type="radio"]:checked + label::after {
  background-color: #f0ad4e; }

.radio-success input[type="radio"] + label::after {
  background-color: #5cb85c; }
.radio-success input[type="radio"]:checked + label::before {
  border-color: #5cb85c; }
.radio-success input[type="radio"]:checked + label::after {
  background-color: #5cb85c; }
</style>