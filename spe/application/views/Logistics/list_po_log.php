<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list-ul"> Data Pemesanan Buku</i></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <legend></legend>
        <div class="form-group">
            <div class="col-lg-4">
                <select id="ta" name="ta" class="form-control">
                   <option value=""> - - Pilih Tahun Ajaran - - </option>
                   <option value="4">TA 2018/2019 </option>
                   <option value="5">TA 2019/2020 </option>

                </select>
            </div>
            <div class="col-lg-4">
                <select id="Status" name="Status" class="form-control">
                   <option value=""> - - Pilih Status - - </option>
                   <option value="9">Expired </option>
                   <option value="10">Cancel </option>
                   <option value="8">Pembayaran Gagal</option>
                   <option value="1">Menunggu Pembayaran </option>
                   <option value="2">Menunggu Pengiriman </option>
                   <option value="3">Dikirim </option>

                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success print-hidden" onclick="load_data();"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <legend></legend>
        <div id="isi" class="table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="tableMenu">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="5%">No</th>
                        <th style="text-align: center;" width="15%">No. PR</th>
                        <th style="text-align: center;" width="10%">Tgl Pemesanan</th>
                        <th style="text-align: center;" width="10%">Tgl Transaksi</th>
                        <th style="text-align: center;" width="20%">Cabang</th>
                        <th style="text-align: center;" width="15%">Total Tagihan</th>
                        <th style="text-align: center;" width="15%">Status</th>
                        <th style="text-align: center;" width="15%">Pembayaran</th>
                        <th style="text-align: center;" width="5%">Aksi</th>
                    </tr>
                </thead>
                <!-- <tbody id="data_po"></tbody> -->
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
    load_data();
});

var jQueryTable;
function load_data() {
    var TA = $('#ta').val();  
    var Status = $('#Status').val();  
    if(TA!=''){
        TAval=TA;
    } else {
        TAval=5;
    }
    //jQueryTable.Destroy();
    jQueryTable = $("#tableMenu").DataTable({
        "ajax": {
            "url":base_url + "Logistics/get_order_cabang_log",
            "type":"POST",
            "data": ({"TA":TAval,"Status":Status,"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg=")))}),
            "dataType":"JSON"
        },
        "destroy":true,
        "fnCreatedRow": function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        "columns": [
            {"data": null,"width": "5%","sClass": "text-center","orderable": false},
            {"data":"PR_Number","width": "15%"},
            {"data":"PR_Date","width": "15%","render": function(data) {
                    return tgl_indo(data);
                }
            },
            {"data":"TRX_Date","width": "15%","render": function(data) {
                    date = data;
                    if(date=='' || date == null){
                        return '-';
                    } else {
                        datefrmt = date.replace(/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/, "$1-$2-$3 $4:$5:$6");
                        return tgl_indo(datefrmt);
                    }
                }
            },
            {"data":"NamaAreaCabang","width": "25%"},
            {"data":"Nominal","width": "15%","sClass": "text-right","render": function(data) {
                    return convertToRupiah(data);
                }
            },
            {"data":"Status","width": "10%"},
            {"data":"Payment","width": "10%"},
            {"data":"PR_Number","width":"8","sClass": "text-center","render": function(data) {
                    return '<a class="btn btn-info btn-xs" href="javascript:void(0)" type="button" data-toggle="modal" onclick="Detail(\''+data+'\')">Detail</a>';
                }
            },
        ],
        "aLengthMenu": [[-1], ["All"]],
        "order": [[ 0, "asc" ]],
        "pagingType": "full_numbers",
        "processing": true,
        dom:
            "<'row'<'col-lg-2 col-sm-12'l><'col-lg-10 col-sm-12'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-lg-5 col-sm-12'i><'col-lg-7 col-sm-12'p>>", 
        buttons: [
        ]
    });
};

function Detail(invo) {
    redirectPost(base_url+'Logistics/inv',{pr:window.btoa(invo),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),kode:window.btoa(1)})
}
</script>