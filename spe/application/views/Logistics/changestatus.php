<form action="#" id="myform" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-6">
                <input type="text" id="PR" name="PR" class="form-control" placeholder="PR . . .">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success print-hidden" onclick="load_data()"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
        </div>
    </div>
</div>

<div class="row" id="editdiv" style="display: none;">
    <div class="col-lg-12">
         <div class="form-group">
            <div class="col-lg-3">
                <input type="text" id="PR_Number" name="PR_Number" class="form-control" readonly="readonly">
            </div>
            <div class="col-lg-3">
                <input type="text" id="Invoice" name="Invoice" class="form-control" readonly="readonly">
            </div>
            <div class="col-lg-3"> 
                <input type="text" id="Nominal" name="Nominal" class="form-control" readonly="readonly">
            </div>
            <div class="col-lg-3">
                <input type="text" id="TrxDate" name="TrxDate" class="form-control" placeholder="Tanggal Transaksi . . .">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-primary print-hidden" onclick="settle()"><span class="glyphicon glyphicon-save"></span> SETTLE !</button>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/autoNumeric.js"></script>
<script type="text/javascript">
    function load_data()
    {
        $(".text-danger").remove();
            $('#editdiv').css('display','block');
        if($('[name="PR"]').val() == "") {
            $('#editdiv').css('display','none');
            $('[name="PR"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Isi PR Woiii !!!</p>');
            $('[name="PR"]').focus();
            return false;
        } else {
            $('#editdiv').css('display','block');
            PR = $('#PR').val();
            url = base_url + "Logistics/loadchange";
            $.ajax({
                url : url,
                type: "POST",
                data: ({"PR":window.btoa(PR)}),
                dataType: "JSON",
                success: function(data)
                {
                    $.each(data.rows, function(i, data) {
                    $('[name="Invoice"]').val(data.Invoice_Number);
                    $('[name="PR_Number"]').val(data.PR_Number);
                    $('[name="Nominal"]').val(convertToRupiah(data.Nominal));
            });
        }
        });
    }
    }

function settle() 
{
    $(".text-danger").remove();
    if($('[name="TrxDate"]').val() == "") {
        $('[name="TrxDate"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Wajib Diisi Woii !!!</p>');
        $('[name="TrxDate"]').focus();
        return false;
    }
    url = base_url + "Logistics/settle";
    var formdata = {};
    formdata['PR'] = window.btoa($('#PR_Number').val());
    formdata['INV'] = window.btoa($('#Invoice').val());
    formdata['TDATE'] = window.btoa($('#TrxDate').val());

        $.ajax({
            url : url,
            type: "POST",
            data: formdata,
            dataType: "JSON",
            success: function(response)
            {
                $.notify(response.message,response.notify);
                if(response.notify=='success') {
                    //document.getElementById('myform').reset();
                    //$('#editdiv').css('display','none');
                }
            }
        });
}
</script>