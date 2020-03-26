<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list-ul"> Ubah Detail Pengiriman <b id="dn"><?php echo $dn ?></b></i></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="text-align: right;">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa"> <b id="pr"></b></i></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <input type="hidden" name="DO" id="DO">
        <legend></legend>
        <div id="isi" class="table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="5%">No</th>
                        <th style="text-align: center;" width="30%">Paket Item</th>
                        <th style="text-align: center;" width="30%">Kode Item</th>
                        <th style="text-align: center;" width="10%">Qty Order</th>
                        <th style="text-align: center;" width="10%">Qty Terkirim</th>
                    </tr>
                </thead>
                <tbody id="data_po"></tbody>
            </table>
        </div>
    </div>
</div>    
<div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-success print-hidden" onclick="save()"><span class="glyphicon glyphicon-save"></span> Simpan</button>
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
<script type="text/javascript">
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

$(document).ready(function(){
    reload_data();
});

function reload_data() {
    var dn = window.btoa(document.getElementById('dn').innerHTML);
    var token = window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=");
    //alert(PR);
    $.ajax({
        url : base_url+"Logistics/get_detail_do_edit",
        type: 'POST',
        data: ({dn:dn,token:token}),
        dataType: 'json',
        beforeSend: function(){
            $("#ajax-loader").show();
        },
        complete: function() {
            $("#ajax-loader").hide();
        },
        success: function(data){
            var jml_data = Object.keys(data.rows).length;
            var total = 0;
            var qtytotal = 0;
            if (jml_data > 0) {
                $('#data_po').empty();
                $.each(data.rows, function(i, item) {
                    QtySB="<input class=\"form-control\" type=\"text\" name=\"QtySB\" id=\"QtySB"+item.RecID+"\" onblur=\"ubah_qtysb("+item.RecID+")\" value=\""+item.QtySB+"\">";
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.RowNum),
                        $('<td>').text(item.PackCode),
                        $('<td>').text(item.ItemCode),
                        $('<td style="text-align:center;">').text(item.Quantity),
                        $('<td style="display: none;">').html("<input class=\"form-control\" type=\"text\" name=\"QtyOrder\" id=\"QtyOrder"+item.RecID+"\" value=\""+item.Quantity+"\">"),
                        $('<td style="text-align:center;">').html(QtySB),
                    ).appendTo('#data_po');
                    DO=item.DO_Number;
                    pr=item.PR_Number;
                });
                $('#DO').val(DO);
                $('#pr').text(pr);
                MergeGridCells();
            } else {
                $('#data_po').empty();
                var $tr = $('<tr>').append(
                        $('<td colspan="7" style="text-align:center;">').text('- - - Tidak Ada Data - - -'),
                        ).appendTo('#data_po');
            }
        }
    });
};

function ubah_qtysb(RecID) {
            var TotalOrder = parseInt($('#QtyOrder'+RecID).val());
            var Qty = parseInt($('#QtySB'+RecID).val());
            //alert(Qty);
            if (Qty > TotalOrder) {
                alert('Jumlah yang diinput melebihi jumlah order.');
                reload_data();
            } else {
                $.ajax({
                    url : base_url+"Logistics/update_qty_input_do",
                    type: "POST",
                    data: ({Qty:Qty,RecID:RecID,Kode:1}),
                    dataType: "JSON",
                    beforeSend: function(){
                        $("#ajax-loader").show();
                    },
                    complete: function() {
                        $("#ajax-loader").hide();
                    },
                    success: function(data)
                    {
                        reload_data();
                        $.notify(data.message,data.notify);
                    }
                });
            }
};

function ubah_qtyse1(RecID) {
            var TotalOrder = parseInt($('#QtyOrder'+RecID).val());
            var Qty = parseInt($('#QtySE1'+RecID).val());
            //alert(Qty);
            if (Qty > TotalOrder) {
                alert('Jumlah yang diinput melebihi jumlah order.');
                reload_data();
            } else {
                $.ajax({
                    url : base_url+"Logistics/update_qty_input_do",
                    type: "POST",
                    data: ({Qty:Qty,RecID:RecID,Kode:2}),
                    dataType: "JSON",
                    beforeSend: function(){
                        $("#ajax-loader").show();
                    },
                    complete: function() {
                        $("#ajax-loader").hide();
                    },
                    success: function(data)
                    {
                        reload_data();
                        $.notify(data.message,data.notify);
                    }
                });
            }
};

function ubah_qtyse2(RecID) {
            var TotalOrder = parseInt($('#QtyOrder'+RecID).val());
            var Qty = parseInt($('#QtySE2'+RecID).val());
            //alert(Qty);
            if (Qty > TotalOrder) {
                alert('Jumlah yang diinput melebihi jumlah order.');
                reload_data();
            } else {
                $.ajax({
                    url : base_url+"Logistics/update_qty_input_do",
                    type: "POST",
                    data: ({Qty:Qty,RecID:RecID,Kode:3}),
                    dataType: "JSON",
                    beforeSend: function(){
                        $("#ajax-loader").show();
                    },
                    complete: function() {
                        $("#ajax-loader").hide();
                    },
                    success: function(data)
                    {
                        reload_data();
                        $.notify(data.message,data.notify);
                    }
                });
            }
};

function ubah_qtysup(RecID ) {
            var TotalOrder = parseInt($('#QtyOrder'+RecID).val());
            var Qty = parseInt($('#QtySUP'+RecID).val());
            //alert(Qty);
            if (Qty > TotalOrder) {
                alert('Jumlah yang diinput melebihi jumlah order.');
                reload_data();
            } else {
                $.ajax({
                    url : base_url+"Logistics/update_qty_input_do",
                    type: "POST",
                    data: ({Qty:Qty,RecID:RecID,Kode:4}),
                    dataType: "JSON",
                    beforeSend: function(){
                        $("#ajax-loader").show();
                    },
                    complete: function() {
                        $("#ajax-loader").hide();
                    },
                    success: function(data)
                    {
                        reload_data();
                        $.notify(data.message,data.notify);
                    }
                });
            }
};

function ubah_QtyBag() {
            var TotalOrder = parseInt($('#QtyTotal').val());
            var Qty = parseInt($('#QtyBag').val());
            var DO = $('#DO').val();
            //alert(DO);
            if (Qty > TotalOrder) {
                alert('Jumlah yang diinput melebihi jumlah order.');
                reload_data();
            } else {
                $.ajax({
                    url : base_url+"Logistics/update_qty_bonus",
                    type: "POST",
                    data: ({Qty:Qty,DO:DO,Kode:1}),
                    dataType: "JSON",
                    beforeSend: function(){
                        $("#ajax-loader").show();
                    },
                    complete: function() {
                        $("#ajax-loader").hide();
                    },
                    success: function(data)
                    {
                        reload_data();
                        $.notify(data.message,data.notify);
                    }
                });
            }
};

function ubah_QtySticker() {
            var TotalOrder = parseInt($('#QtyTotal').val());
            var Qty = parseInt($('#QtySticker').val());
            var DO = $('#DO').val();
            //alert(DO);
            if (Qty > TotalOrder) {
                alert('Jumlah yang diinput melebihi jumlah order.');
                reload_data();
            } else {
                $.ajax({
                    url : base_url+"Logistics/update_qty_bonus",
                    type: "POST",
                    data: ({Qty:Qty,DO:DO,Kode:2}),
                    dataType: "JSON",
                    beforeSend: function(){
                        $("#ajax-loader").show();
                    },
                    complete: function() {
                        $("#ajax-loader").hide();
                    },
                    success: function(data)
                    {
                        reload_data();
                        $.notify(data.message,data.notify);
                    }
                });
            }
};

function ubah_QtyStickerS() {
            var TotalOrder = parseInt($('#QtyTotal').val());
            var Qty = parseInt($('#QtyStickerS').val());
            var DO = $('#DO').val();
            //alert(DO);
            if (Qty > TotalOrder) {
                alert('Jumlah yang diinput melebihi jumlah order.');
                reload_data();
            } else {
                $.ajax({
                    url : base_url+"Logistics/update_qty_bonus",
                    type: "POST",
                    data: ({Qty:Qty,DO:DO,Kode:3}),
                    dataType: "JSON",
                    beforeSend: function(){
                        $("#ajax-loader").show();
                    },
                    complete: function() {
                        $("#ajax-loader").hide();
                    },
                    success: function(data)
                    {
                        reload_data();
                        $.notify(data.message,data.notify);
                    }
                });
            }
};

function save() {
    if (confirm("Anda yakin data sudah terinput dengan benar ?")) {
        redirectPost(base_url+'Logistics/list_edit_do')
    }
};
//rowspan table
function MergeGridCells() {
    var dimension_cells = new Array();
    var dimension_col = null;
    var columnCount = $("#example tr:first th").length;
    for (dimension_col = 0; dimension_col <= columnCount-2; dimension_col++) {
        // first_instance holds the first instance of identical td
        var first_instance = null;
        var rowspan = 1;
        // iterate through rows
        $("#example").find('tr').each(function () {

            // find the td of the correct column (determined by the dimension_col set above)
            var dimension_td = $(this).find('td:nth-child(' + dimension_col + ')');



            if (first_instance === null) {
                // must be the first row
                first_instance = dimension_td;
            } else if (dimension_td.text() === first_instance.text()) {
                // the current td is identical to the previous
                // remove the current td
               // dimension_td.remove();
                dimension_td.attr('hidden', true);
                ++rowspan;
                // increment the rowspan attribute of the first instance
                first_instance.attr('rowspan', rowspan);
            } else {
                // this cell is different from the last
                first_instance = dimension_td;
                rowspan = 1;
            }
        });
    }
}
</script>