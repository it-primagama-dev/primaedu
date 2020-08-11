<form action="#" id="form_gadipake" class="form-horizontal">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-list"> Data iSmart Reject</i></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <input type="hidden" name="grup" id="grup" value="<?php echo $this->session->userdata('UserGroup'); ?>">
        <legend></legend>
        <div id="isi" class="table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example">
                <thead>
                    <tr class="text-center">
                        <th width="1%">No</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Bidang Studi</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                        <th width="17%">Aksi</th>
                        
                    </tr>
                </thead>
                <tbody id="data_item"></tbody>
            </table>
        </div>
        <legend></legend>
    </div>
</div>
</form>
</form>
<div class="modal fade" id="modal_form3" role="dialog">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Title</h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form3" class="form-horizontal">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-md-4">Nama iSmart</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="Name" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Nomor KTP</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="NoKTP" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Email</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="Email" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Nomor Telepon</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="Telepon" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Pekerjaan</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="Pekerjaan" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Pendidikan Terakhir</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="Pendidikan" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Jurusan</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="Jurusan" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Alamat</label>
                                            <div class="col-lg-8">
                                                <textarea class="form-control" id="Alamat" readonly="readonly"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Posisi</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="Posisi" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Bidang Studi (1)</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="BidangStudi" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Bidang Studi (2)</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="BidangStudi2" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Nama Rekening</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="NamaRek" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Nomor Rekening</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="NoRek" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Cabang Bank</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="CabangRek" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Nomor NPWP</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="NoNPWP" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">No.Surat Perjanjian</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="NSPK" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Alamat KTP</label>
                                            <div class="col-lg-8">
                                                <textarea class="form-control" id="AlamatKTP" readonly="readonly"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Grade</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="Grade" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-md-4">Foto</label>
                                            <div class="col-lg-8">
                                                <img src="" id="Foto" alt="no-image" class="img-responsive img">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">KTP</label>
                                            <div class="col-lg-8">
                                                <img src="" id="KTP" alt="no-image" class="img-responsive img">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Ijazah</label>
                                            <div class="col-lg-8">
                                                <img src="" id="Ijazah" alt="no-image" class="img-responsive img">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Sertifikat(1)</label>
                                            <div class="col-lg-8">
                                                <img src="" id="Sertifikat" alt="no-image" class="img-responsive img">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Sertifikat(2)</label>
                                            <div class="col-lg-8">
                                                <img src="" id="Sertifikatt" alt="no-image" class="img-responsive img">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Sertifikat(3)</label>
                                            <div class="col-lg-8">
                                                <img src="" id="Sertifikattt" alt="no-image" class="img-responsive img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- datatables css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?=base_url('assets/js/autoNumeric.js'); ?>"></script>
<style>
.img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  height: 150px;
  width: 260px;
}

/*.img2 {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
}*/
</style>
<script type="text/javascript">

$(document).ready(function(){
    reload_data();
});

function modal_form3(RecID)
{
        $.ajax({
            url : base_url + "ismart/detail_ismart/"+RecID,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form3').modal({backdrop: 'static', keyboard: false});
                $('#Name').val(data.Nama).attr('readonly', true);
                $('#NoKTP').val(data.NoKTP);
                $('#Posisi').val(data.Posisi);
                $('#BidangStudi').val(data.BidStudi);
                $('#BidangStudi2').val(data.BidStudi1);
                $('#BidangStudi3').val(data.BidStudi2);
                $('#Alamat').val(data.AlamatRumah);
                $('#Email').val(data.Email);
                $('#Pendidikan').val(data.PendidikanAkhir);
                $('#Pekerjaan').val(data.Pekerjaan);
                $('#Jurusan').val(data.Jurusan);
                $('#Telepon').val(data.NoTelp);
                $('#NamaRek').val(data.NamaRek);
                $('#NoRek').val(data.NoRek);
                $('#CabangRek').val(data.CabangRek);
                $('#NoNPWP').val(data.NoNPWP);
                $('#NSPK').val(data.NoSurat);
                $('#Grade').val(data.Grade);
                $('#AlamatKTP').val(data.AlamatKTP);
                $("#Ijazah").attr("src",base_url+"assets/upload/ismart/ijazah/"+data.ScanIjazah);
                $("#KTP").attr("src",base_url+"assets/upload/ismart/KTP/"+data.ScanKTP);
                $("#Foto").attr("src",base_url+"assets/upload/ismart/foto/"+data.Foto);
                $("#Sertifikat").attr("src",base_url+"assets/upload/ismart/sertifikat/"+data.ScanCertificate);
                $("#Sertifikatt").attr("src",base_url+"assets/upload/ismart/sertifikat1/"+data.ScanCertificate1);
                $("#Sertifikattt").attr("src",base_url+"assets/upload/ismart/sertifikat2/"+data.ScanCertificate2);
                $('#modal_form3').modal('show');
                $('.modal-title').text('Detail iSmart');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
}

function reload_data() {
    $.ajax({
        url : base_url+"ismart/get_data_reject",
        type: 'GET',
        dataType: 'json',
        beforeSend: function(){
            $("#ajax-loader").show();
        },
        complete: function() {
            $("#ajax-loader").hide();
        },
        success: function(data){
            var jml_data = Object.keys(data.rows).length;
            if (jml_data > 0) {
                $('#data_item').empty();
                $.each(data.rows, function(i, item) {
                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.Nama),
                        $('<td>').text(item.Posisi),
                        $('<td>').text(item.BidStudi),
                        $('<td>').text(item.Email),
                        $('<td>').text(item.NoTelp),
                        $('<td>').text(item.Jurusan),
                        $('<td>').text(item.Status),
                        $("<td style='text-align: center;'>").html('<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" onclick="modal_form3('+item.RecID+');"><span class="glyphicon glyphicon-eye-open"></span> Detail</button>'),
                    ).appendTo('#data_item');
                });
                $('#example').dataTable({
                    "aLengthMenu": [[50, 100, -1], [50, 100, "All"]],
                    "pageLength": 50
                    });
            } else {
                $('#data_item').empty();
                var $tr = $('<tr>').append(
                          $('<td colspan="12" style="text-align: center;">').text('- - - No Data - - -'),
                          ).appendTo('#data_item');
            }
        }
    });
};
</script>