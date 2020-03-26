<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-barcode"> Data Stok Item </i></p>
            </div>
        </div>
        <legend></legend>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-5">
                <select id="ta" name="ta" class="form-control">
                   <option value=""> - - Pilih Tahun Ajaran - - </option>
                   <option value="4">TA 2018/2019 </option>
                   <option value="5">TA 2019/2020 </option>

                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success print-hidden" onclick="reload_data();"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
        </div>
        <legend></legend>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div id="isi" class="table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example2">
                <thead>
                    <tr class="text-center">
                        <th rowspan="2" width="2%" style="text-align: center">No</th>
                        <th rowspan="2" width="10%" style="text-align: center">Tipe Item</th>
                        <th rowspan="2" width="20%" style="text-align: center">Kode Item</th>
                        <th colspan="3" width="5%" style="text-align: center">Stok Qty</th>
                        <th colspan="3" width="5%" style="text-align: center">Stok Barcode</th>
                    </tr>
                    <tr class="text-center">
                        <th width="5%" style="text-align: center; background: #A9A9A9;">Total</th>
                        <th width="5%" style="text-align: center; background: #C0C0C0;">Terjual</th>
                        <th width="5%" style="text-align: center; background: #D3D3D3;">Sisa</th>
                        <th width="5%" style="text-align: center; background: #A9A9A9;">Total</th>
                        <th width="5%" style="text-align: center; background: #C0C0C0;">Terjual</th>
                        <th width="5%" style="text-align: center; background: #D3D3D3;">Sisa</th>
                    </tr>
                </thead>
                <tbody id="data_stok"></tbody>
                <tbody id="data_stok_total"></tbody>
            </table>
        </div>
    </div>
</div>
</form>

<!-- datatables css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?=base_url('assets/js/autoNumeric.js'); ?>"></script>
<script type="text/javascript">

$(document).ready(function(){
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    reload_data();
    $('#select_all').on('click', function(e) {
        if($(this).is(':checked',true)) {
            $(".emp_checkbox").prop('checked', true);
        } else {
            $(".emp_checkbox").prop('checked',false);
        }
    });
});
var save_method;
var table;

function reload_data() {
    var TA = $('#ta').val();  
    if(TA!=''){
        TAval=TA;
    } else {
        TAval=5;
    }
    $('#data_stok').empty();
    $('#data_stok_total').empty();
    $.ajax({
        url : base_url+"Logistics/get_data_stockitem",
        type: 'POST',
        data:({TA:TAval}),
        dataType: 'json',
        beforeSend: function(){
            $("#ajax-loader").show();
        },
        complete: function() {
            $("#ajax-loader").hide();
        },
        success: function(data){
            var jml_data = Object.keys(data.rows).length;
                var AvailableStockBC = 0;
                var TotalStock = 0;
                var OrderedStock = 0;
                var AvailableStock = 0;
                var TotalStockBC = 0;
                var OrderedStockBC = 0;
                $.each(data.rows, function(i, item) {
                    stok10persen = 10/100*item.TotalStock;
                    sisastok = item.TotalStock-item.OrderedStock;
                    if(sisastok <= stok10persen && sisastok > 0){
                        tr = "<tr style='background: #FFFF00;'>";
                    } else if(sisastok <= 0){
                        tr = "<tr style='background: #FF0000;'>";
                    } else {
                        tr = "<tr>"; 
                    }
                    var $tr2 = $(tr).append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.TypeName),
                        $('<td>').text(item.ItemCode),
                        $("<td style='background: #A9A9A9;'>").text(item.TotalStock),
                        $("<td style='background: #C0C0C0;'>").text(item.OrderedStock),
                        $("<td style='background: #D3D3D3;'>").text(item.TotalStock-item.OrderedStock),
                        $("<td style='background: #A9A9A9;'>").text(item.TotalStockBC),
                        $("<td style='background: #C0C0C0;'>").text(item.OrderedStockBC),
                        $("<td style='background: #D3D3D3;'>").text(item.TotalStockBC-item.OrderedStockBC)
                    ).appendTo('#data_stok');
                    TotalStock += item.TotalStock;
                    OrderedStock += item.OrderedStock;
                    AvailableStock += item.TotalStock-item.OrderedStock;
                    TotalStockBC += item.TotalStockBC;
                    OrderedStockBC += item.OrderedStockBC;
                    AvailableStockBC += item.TotalStockBC-item.OrderedStockBC;

                });
                $('#example2').dataTable({
                    "aLengthMenu": [[100, 200, -1], [100, 200, "All"]],
                    "pageLength": 100
                    });
                    var $tr3 = $('<tr>').append(
                        $("<th colspan='3' style='text-align:center;'>").text('Total'),
                        $("<th style='background: #A9A9A9;'>").text(TotalStock),
                        $("<th style='background: #C0C0C0;'>").text(OrderedStock),
                        $("<th style='background: #D3D3D3;'>").text(AvailableStock),
                        $("<th style='background: #A9A9A9;'>").text(TotalStockBC),
                        $("<th style='background: #C0C0C0;'>").text(OrderedStockBC),
                        $("<th style='background: #D3D3D3;'>").text(AvailableStockBC)
                    ).appendTo('#data_stok_total');
        }
    });
};
</script>