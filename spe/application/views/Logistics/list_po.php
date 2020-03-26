<?php
if ($AreaCabang->Cilegal == 1) {
    echo '<marquee>MOHON MENGHUBUNGI DIVISI FRANCHISE NO.TELP. 0274 - 552996 ATAU 0813 2885 9396</marquee>';
} else {
    ?>
<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list-ul"> Data Pemesanan Buku</i></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="text-align: right;">
        <div class="form-group">
            <div class="col-lg-12">
                <a href="javascript:void(0)" type="button" class="btn btn-success pull-right" onclick="order()">
                    <i class="fa fa-cart-plus"> Order Baru </i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <input type="hidden" name="cabang" id="cabang" value="<?php echo $AreaCabang->KodeAreaCabang ?>">
        <legend></legend>
        <marquee scrollamount="10"><h4><left><font color="blue">Juknis pemesanan buku telah diupdate, klik tombol "Bantuan" pada bagian bawah halaman ini.</font></left></h4></marquee>
        <div id="isi" class="table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="5%">No</th>
                        <th style="text-align: center;" width="15%">No. PR</th>
                        <th style="text-align: center;" width="10%">Tanggal</th>
                        <th style="text-align: center;" width="15%">Tagihan</th>
                        <th style="text-align: center;" width="15%">Deposit</th>
                        <th style="text-align: center;" width="15%">Total Tagihan</th>
                        <th style="text-align: center;" width="15%">Status</th>
                        <th style="text-align: center;" width="5%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="data_po"></tbody>
            </table>
        </div>
        <a href="javascript:void(0)" type="button" class="button button5 pull-right" onclick="juknis()" target="_blank"> <b>Bantuan</b> <i class="fa fa-question"></i></a>
    </div>
</div>
</form>
<?php } ?>
<!-- datatables css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<style>
.button {
    background-color: #DC143C; /* Green */
    border: none;
    color: white;
    padding: 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
.button5 {border-radius: 50%;}
a:hover {
    color: white;
    background-color: blue;
    text-decoration: none;
}
</style>
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

function juknis() {
    window.open(base_url+"juknis/buku.pdf");
}

function order() {
    var token = window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=");
    /*if($('#cabang').val() != '9999   '){
        alert('Mohon maaf sistem pemesanan buku sedang dalam perbaikan. Terima kasih.');
    } else {*/
    $.ajax({
        url : base_url+"Logistics/cek_order_cabang",
        type: "POST",
        dataType: "JSON",
        beforeSend: function(){
            $("#ajax-loader").show();
        },
        complete: function() {
            $("#ajax-loader").hide();
        },
        success: function(data)
        {
            var RecID = parseInt(data.rows[0].RecID);
            if (RecID > 0) {
                alert('Mohon untuk menyelesaikan proses pembayaran pada Pemesanan sebelumnya.');
                var formdata = {};
                formdata['token'] = token;
                formdata['pr'] = window.btoa(data.rows[0].PR_Number);
                //alert(data.rows[0].Invoice_Number);
                redirectPost(base_url+'Logistics/inv',formdata);
            } else {
                redirectPost(base_url+'Logistics/order', { token:token });
            }
        }
    });
/*}*/
}

$(document).ready(function(){
    reload_data();
});

function reload_data() {
    //var PR = $('#PR').val();
    $.ajax({
        url : base_url+"Logistics/get_order_cabang",
        type: 'GET',
        //data: ({PR:PR}),
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

                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.PR_Number),
                        $('<td>').text(tgl_indo(item.PR_Date)),
                        $('<td style="text-align:right;">').text(convertToRupiah(parseInt(item.TotalPrice))),
                        $('<td style="text-align:right;">').text(convertToRupiah(parseInt(item.Discount))),
                        $('<td style="text-align:right;">').text(convertToRupiah(parseInt(item.Nominal))),
                        $('<td>').text(item.Status),                        
                        $('<td class="print-hidden">').html("<a href=\"javascript:void(0)\" class=\"btn btn-info btn-xs\" onclick=\"Detail('"+item.PR_Number+"')\"> Detail</a>")
                    ).appendTo('#data_po');
                });
                $('#example').dataTable();
            } else {
                $('#data_po').empty();
                var $tr = $('<tr>').append(
                        $('<td colspan="8" style="text-align:center;">').text('- - - Tidak Ada Data - - -'),
                        ).appendTo('#data_po');
            }
        }
    });
};
function Detail(invo) {
    redirectPost(base_url+'Logistics/inv',{pr:window.btoa(invo),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),kode:window.btoa(1)})
}
</script>