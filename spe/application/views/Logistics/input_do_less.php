<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list-ul"> Input Detail Pengiriman <b id="pr"><?php echo $pr ?></b></i></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="text-align: right;">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa"> No Pengiriman : <b id="dr"></b></i></p>
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
                        <th style="text-align: center;" width="20%">Paket Item</th>
                        <th style="text-align: center;" width="20%">Kode Item</th>
                        <th style="text-align: center;" width="10%">Total Order</th>
                        <th style="text-align: center;" width="10%">Qty Kurang Kirim</th>
                        <th style="text-align: center;" width="10%">Qty akan di Kirim</th>
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
    var PR = window.btoa(document.getElementById('pr').innerHTML);
    var token = window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=");
    //alert(PR);
    $.ajax({
        url : base_url+"Logistics/get_detail_do_less",
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
            var total = 0;
            if (jml_data > 0) {
                $('#data_po').empty();
                $.each(data.rows, function(i, item) {
                    var numb=item.RecID;
                    SB=item.SisaSB;
                    QtySB="<input class=\"form-control\" type=\"text\" name=\"QtySB\" id=\"QtySB"+numb+"\" onblur=\"ubah_qtysb("+numb+")\" value=\""+item.SB+"\"><input class=\"form-control\" type=\"hidden\" name=\"SisaSB\" id=\"SisaSB"+numb+"\" value=\""+item.SisaSB+"\">";
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.RowNum),
                        $('<td>').text(item.PackName),
                        $('<td>').text(item.ItemName),
                        $('<td style="text-align:center;">').text(item.Quantity),
                        $('<td style="display: none;">').html("<input class=\"form-control\" type=\"text\" name=\"QtyOrder\" id=\"QtyOrder"+numb+"\" value=\""+item.Quantity+"\">"),
                        $('<td style="text-align:center;">').text(SB),
                        $('<td style="text-align:center;">').html(QtySB),
                        $('<td style="display: none;">').html("<input class=\"form-control\" type=\"text\" name=\"ItemCode\" id=\"ItemCode"+numb+"\" value=\""+item.ItemCode+"\">"),
                        $('<td style="display: none;">').html("<input class=\"form-control\" type=\"text\" name=\"RecID\" id=\"RecID"+item.RecID+"\" value=\""+item.RecID+"\">"),
                        $('<td style="display: none;">').html("<input class=\"form-control\" type=\"text\" name=\"ItemName\" id=\"ItemName"+item.RecID+"\" value=\""+item.ItemCode+"\">"),
                    ).appendTo('#data_po');
                MergeGridCells();
                });
                $.each(data.rows2, function(i2, item2) {
                $('#DO').val(item2.DO_Number);
                $('#dr').text(item2.DO_Number);
            });
            } else {
                $('#data_po').empty();
                var $tr = $('<tr>').append(
                        $('<td colspan="11" style="text-align:center;">').text('- - - Tidak Ada Data - - -'),
                        ).appendTo('#data_po');
                $.each(data.rows2, function(i2, item2) {
                $('#DO').val(item2.DO_Number);
                $('#dr').text(item2.DO_Number);
            });
            }
        }
    });
};

function ubah_qtysb(numb) {
            var TotalOrder = parseInt($('#SisaSB'+numb).val());
            var Qty = parseInt($('#QtySB'+numb).val());
            var QtyOri = $('#QtySB'+numb).val();
            if(QtyOri==''){
               var Qty = 0;
            }
            //alert(Qty);
            $(".text-danger").remove();
            if (Qty > TotalOrder) {
                $('#QtySB'+numb).after('<p class="text-danger">Kelebihan!</p>');
                $('#QtySB'+numb).focus();
                    return false;
            } else {
                
            }
};

function save() {
    if (confirm("Anda yakin data sudah terinput dengan benar ?")) {

    var n = $("input[name^='QtySB']").length;
    var array1 = $("input[name^='QtySB']");
    var array2 = $("input[name^='RecID']");
    var array3 = $("input[name^='ItemName']");
    for(i=0;i<n;i++)
    {
        qty_value=  array1[i].value;
        recid_value=  array2[i].value;
        name_value=  array3[i].value;
        if(qty_value!=0){
            //alert(qty_value);
            $.ajax({
                url : base_url+"Logistics/save_dodetail",
                type: 'POST',
                data: ({Qty:qty_value,RecID:recid_value,ItemName:name_value}),
                dataType: 'json',
                beforeSend: function(){
                    $("#ajax-loader").show();
                },
                complete: function() {
                    $("#ajax-loader").hide();
                },
                success: function(data){
                    //redirectPost(base_url+'Logistics/list_do');
                    $.notify(data.message,data.notify);
                }
            })
        }
    }

    var DO = window.btoa(document.getElementById('DO').value);
    var pr = window.btoa(document.getElementById('pr').innerHTML);
    var token = window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=");
    //alert(DO);
    $.ajax({
        url : base_url+"Logistics/save_do",
        type: 'POST',
        data: ({DO:DO,token:token,pr:pr}),
        dataType: 'json',
        beforeSend: function(){
            $("#ajax-loader").show();
        },
        complete: function() {
            $("#ajax-loader").hide();
        },
        success: function(data){
            redirectPost(base_url+'Logistics/list_do_less');
            $.notify(data.message,data.notify);
        }
    });
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