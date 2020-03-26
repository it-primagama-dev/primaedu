<form action="#" id="form2" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-6">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-print"> Cetak Packing Slip</i></p>
            </div>
            <div class="col-lg-6" style="text-align: right; display: none;" id="ubahdiv">
            <p><a href="javascript:void(0)" class="btn btn-warning" id="btnbc"><i class="fa fa-pencil"> Kelola Packing Slip</i></a></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <legend></legend>
        <div id="isi" class="table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="5%">No</th>
                        <th style="text-align: center;" width="20%">No. PR</th>
                        <th style="text-align: center;" width="20%">Tanggal</th>
                        <th style="text-align: center;" width="45%">Cabang</th>
                        <th style="text-align: center;" width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="data_po"></tbody>
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
    reload_data();
});

function reload_data() {
    //var PR = $('#PR').val();
    $.ajax({
        url : base_url+"Logistics/get_packing_slip",
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
            var group = data.group;
            if(group==30){
                $('#ubahdiv').css('display','block');
            }
            if (jml_data > 0) {
                $('#data_po').empty();
                $.each(data.rows, function(i, item) {

                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.PR_Number),
                        $('<td>').text(tgl_indo(item.PR_Date)),    
                        $('<td>').text(item.Area+' / '+item.KodeAreaCabang+' - '+item.NamaAreaCabang),    
                        $('<td class="print-hidden">').html("<a href=\"javascript:void(0)\" class=\"btn btn-info btn-xs\" onclick=\"Print('"+item.PR_Number+"')\"> Cetak Packing Slip</a>")
                    ).appendTo('#data_po');
                });
                $('#example').dataTable();
            } else {
                $('#data_po').empty();
                var $tr = $('<tr>').append(
                        $('<td colspan="5" style="text-align:center;">').text('- - - Tidak Ada Data - - -'),
                        ).appendTo('#data_po');
            }
        }
    });
};
function Print(pr) {
    redirectPost(base_url+'Logistics/print_packing',{PR:window.btoa(pr),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),kode:window.btoa(1)})
}
$("#btnbc").click(function(e) {
    redirectPost(base_url+'Logistics/open_ps',{token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),kode:window.btoa(1)})
});
</script>