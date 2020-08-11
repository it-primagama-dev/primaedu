<form action="#" id="form_gadipake" class="form-horizontal">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"> <i class="fa fa-list"> Data Tentor / iSmart / IBM </i></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="text-align: right;">
        <div class="form-group">
            <div class="col-lg-4"></div>
            <div class="col-lg-3" style="padding-right: 0px;"><a href="<?php echo base_url()?>ismart/list_approve" type="button" id="tambah" class="btn btn-success pull-right"><span class="glyphicon glyphicon-list"></span> Data iSmart Aprroved</a>
            </div>
            <div class="col-lg-3 pull-right"><a href="<?php echo base_url()?>ismart/list_reject" type="button" id="tambah" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-list"></span> Data iSmart Reject</a>
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
                        <th width="23%">Aksi</th>
                        
                    </tr>
                </thead>
                <tbody id="data_item"></tbody>
            </table>
        </div>
        <legend></legend>
    </div>
</div>
</form>

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Title</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" id="RecID" name="RecID" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama iSmart</label>
                            <div class="col-md-9">
                                <input type="text" id="Nama" class="form-control" value="">
                            </div>
                        </div>
                         <div class="form-group">
                             <label class="control-label col-md-3">Grade</label>
                             <div class="col-md-9">
                                 <select class="form-control" id="Grade" name="Grade">
                                     <option value="">- - - Pilih Grade - - -</option>
                                     <option value="A+">A+</option>
                                     <option value="A">A</option>
                                     <option value="B">B</option>
                                     <option value="C">C</option>
                                     <option value="D">D</option>
                                     <option value="E">E</option>
                                 </select>
                             </div>
                         </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modal_form2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Title</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form2" class="form-horizontal">
                    <input type="hidden" value="" id="RecID2" name="RecID2" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama iSmart</label>
                            <div class="col-md-9">
                                <input type="text" id="Nama2" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="Reject()" class="btn btn-primary">Ya</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    reload_data();
});
var save_method;
var table;

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
function modal_form(RecID)
{
    $(".text-danger").remove();
        save_method = 'update';
        $('#form2')[0].reset();
        $.ajax({
            url : base_url + "ismart/approve_ismart/"+RecID,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form').modal({backdrop: 'static', keyboard: false});
                $('#Nama').val(data.Nama).attr('readonly', true);
                $('#RecID').val(data.RecID).attr('readonly', true);
                $('#modal_form').modal('show');
                $('.modal-title').text('Approve iSmart');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
}

function save()
{

    $(".text-danger").remove();
    if($('#Grade').val() == "") {
        $('#Grade').after('<p class="text-danger">Wajib disii</p>');
        $('#Grade').focus();
        return false;
        } else {
        var url;
            url = base_url + "ismart/save_approve";
        $('#data_item').empty();
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                $.notify(data.message,data.notify);
                $('#modal_form').modal('hide');
                reload_data();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
}

var save_method;
var table;
function modal_form2(RecID)
{
    $(".text-danger").remove();
        save_method = 'update';
        $('#form2')[0].reset();
        $.ajax({
            url : base_url + "ismart/reject_ismart/"+RecID,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form2').modal({backdrop: 'static', keyboard: false});
                $('#Nama2').val(data.Nama).attr('readonly', true);
                $('#RecID2').val(data.RecID).attr('readonly', true);
                $('#modal_form2').modal('show');
                $('.modal-title').text('Anda Yakin Reject iSmart ?');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
}

function Reject()
{
        var url;
            url = base_url + "ismart/save_reject";
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form2').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                $.notify(data.message,data.notify);
                $('#data_item').empty();
                $('#modal_form2').modal('hide');
                reload_data();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
}

function reload_data() {
    $.ajax({
        url : base_url+"ismart/get_data_ismart",
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
                        $("<td style='text-align: center;'>").html('<button type="button" class="btn btn-success btn-xs" data-toggle="modal" onclick="modal_form('+item.RecID+');"><span class="glyphicon glyphicon-ok"></span> Approve</button> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" onclick="modal_form2('+item.RecID+');"><span class="glyphicon glyphicon-remove"></span> Reject</button> <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" onclick="modal_form3('+item.RecID+');"><span class="glyphicon glyphicon-eye-open"></span> Detail</button>'),
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