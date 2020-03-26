<form action="#" id="myform" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-6">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-upload"> Upload Dokumen Legal</i></p>
            </div>
            <div class="col-lg-6" style="text-align: right;">
            <p><a href="javascript:void(0)" class="btn btn-info" id="btnbc"> <i class="fa fa-file">  Data Dokumen Legal</i></a></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <legend></legend>
        <div class="form-group">
            <div class="col-lg-6">
                <label>Pilih Cabang</label>
                <select id="PBranchCode" name="PBranchCode" class="form-control">
                   <option value=""> - - Pilih Cabang - - </option>
                </select>
                <input type="hidden" id="UserGroup" value="<?php echo $this->session->userdata('UserGroup'); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success print-hidden" onclick="load_data()"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
        </div>
        <legend></legend>
    </div>
</div>
<div class="row" id="editdiv" style="display: none;">
    <div class="col-lg-12">
         <div class="form-group">
            <div class="col-lg-12">
            <legend><p style="font-size: 20px; font-weight: bold;"><i class="fa"> Detail Cabang</i></p></legend>
            <input type="hidden" name="FFID" id="FFID">
            </div>
            <div class="col-lg-3">
                <label>Kode Cabang</label>
                <input type="text" id="BranchCode" name="BranchCode" maxlength="4" class="form-control" placeholder=" 4 Digit Numerik" readonly="readonly">
            </div>
            <div class="col-lg-9">
                <label>Nama Cabang</label>
                <input type="text" id="BranchName" name="BranchName" class="form-control" placeholder=" Nama Cabang" readonly="readonly">
            </div>
        </div>


        <div id="divfranchisee">
        <div class="form-group">
            <div class="col-md-4">
                <label class="control-label">Form Cabang 1 (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="FormCabang01" name="FormCabang01" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="FormCabang01tumb" alt="no-image" class="img-responsive img FormCabang01">
            </div>
            <div class="col-md-4">
                <label class="control-label">Form Cabang 2 (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="FormCabang02" name="FormCabang02" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="FormCabang02tumb" alt="no-image" class="img-responsive img FormCabang02">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4">
                <label class="control-label">Surat Sanggup (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="SuratSanggup" name="SuratSanggup" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="SuratSangguptumb" alt="no-image" class="img-responsive img SuratSanggup">
            </div>
            <div class="col-md-4">
                <label class="control-label">Surat Pernyataan (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="SuratPernyataan" name="SuratPernyataan" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="SuratPernyataantumb" alt="no-image" class="img-responsive img SuratPernyataan">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4">
                <label class="control-label">Surat Pernyataan Rekening (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="SuratPernyataanRek" name="SuratPernyataanRek" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="SuratPernyataanRektumb" alt="no-image" class="img-responsive img SuratPernyataanRek">
            </div>
            <div class="col-md-4">
                <label class="control-label">Pengurus Cabang (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="PengurusCabang" name="PengurusCabang" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="PengurusCabangtumb" alt="no-image" class="img-responsive img PengurusCabang">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4">
                <label class="control-label">Form Survey (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="FormSurvey" name="FormSurvey" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="FormSurveytumb" alt="no-image" class="img-responsive img FormSurvey">
            </div>
            <div class="col-md-4">
                <label class="control-label">Foto Kantor (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="FotoKantor" name="FotoKantor" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="FotoKantortumb" alt="no-image" class="img-responsive img FotoKantor">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4">
                <label class="control-label">Form Diskon (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="FormDiskon" name="FormDiskon" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="FormDiskontumb" alt="no-image" class="img-responsive img FormDiskon">
            </div>
            <div class="col-md-4">
                <label class="control-label">Foto KK (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="FotoKK" name="FotoKK" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="FotoKKtumb" alt="no-image" class="img-responsive img FotoKK">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4">
                <label class="control-label">Foto KTP (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="FotoKTP" name="FotoKTP" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="FotoKTPtumb" alt="no-image" class="img-responsive img FotoKTP">
            </div>
            <div class="col-md-4">
                <label class="control-label">Foto NPWP (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="FotoNPWP" name="FotoNPWP" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="FotoNPWPtumb" alt="no-image" class="img-responsive img FotoNPWP">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4">
                <label class="control-label">Lembar Persetujuan (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="LembarSetuju" name="LembarSetuju" class="form-control" disabled="disabled">
            </div>
            <div class="col-md-2">
                <img src="" id="LembarSetujutumb" alt="no-image" class="img-responsive img LembarSetuju">
            </div>
            <div class="col-md-4">
                <label class="control-label">Foto Tanda Tangan (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="FotoTT" name="FotoTT" class="form-control">
            </div>
            <div class="col-md-2">
                <img src="" id="FotoTTtumb" alt="no-image" class="img-responsive img FotoTT">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4">
                <label class="control-label">Foto Daftar Hadir (.jpg/.jpeg/.png)</label>
                <br>
                <input type="file" id="DaftarHadir" name="DaftarHadir" class="form-control">
            </div>
            <div class="col-md-2">
                <img src="" id="DaftarHadirtumb" alt="no-image" class="img-responsive img DaftarHadir">
            </div>
            <div class="col-md-6">
                <label class="control-label">Akta Notaris (.pdf)</label>
                <br>
                <input type="file" id="SuratNotaris" name="SuratNotaris" class="form-control">
            </div>
        </div>
        </div>
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success" onclick="save()"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            </div>
        </div>
        <legend></legend>
    </div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/autoNumeric.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<style>
.img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  height: 150px;
  width: 150px;
}

.img2 {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
}
</style>
<script type="text/javascript">
var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$("#btnbc").click(function(e) {
    window.location.href = base_url + "Legal/list_docs";
});

$(document).ready(function(){
    get_cabang();
});

$(function () {
    $('#PBranchCode').select2();
});

function get_cabang() {
$.getJSON(base_url+"legal/get_cabang2", function(json){
    $('#PBranchCode').empty();
    $('#PBranchCode').append($('<option>').text("- - Pilih Cabang - -").attr('value', ''));
    $.each(json, function(i, obj){
    $('#PBranchCode').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
    });
});
}

var userfile = {
    /*FormCabang01:{},
    FormCabang02:{},
    SuratSanggup:{},
    SuratPernyataan:{},
    SuratPernyataanRek:{},
    PengurusCabang:{},
    FormSurvey:{},
    FotoKantor:{},
    FormDiskon:{},
    FotoKK:{},
    FotoKTP:{},
    FotoNPWP:{},
    LembarSetuju:{},*/
    FotoTT:{},
    DaftarHadir:{},
    SuratNotaris:{},
};

$("document").ready(function() {
    //$(".img").attr("src",base_url+"assets/images/no-image.png");
    $("input[type=file]").change(function(e) {
        if (e) {
            var vm = this;
            index = e.currentTarget.id;
            vm.invalidFile = false;
            let files = e.target.files || e.dataTransfer.files;
            
            vm.myFile = files[0];
            userfile[index].name = files[0].name;
            userfile[index].type = files[0].type;

            var reader = new FileReader();
            reader.onloadend = function(event) {
                userfile[index].file = event.target.result;
                /*if (userfile.FormCabang01.file) {
                    $(".FormCabang01").attr("src",userfile.FormCabang01.file).attr('id','is_FormCabang01');
                    //$(".imgPicKTP2").attr("src",userfile.PicKTP.file).attr('id','is_picKTP2');
                    //document.getElementById("ktphref").href="test"; 
                }
                if (userfile.FormCabang02.file) {
                    $(".FormCabang02").attr("src",userfile.FormCabang02.file).attr('id','is_FormCabang02');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.SuratSanggup.file) {
                    $(".SuratSanggup").attr("src",userfile.SuratSanggup.file).attr('id','is_SuratSanggup');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.SuratPernyataan.file) {
                    $(".SuratPernyataan").attr("src",userfile.SuratPernyataan.file).attr('id','is_SuratPernyataan');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.SuratPernyataanRek.file) {
                    $(".SuratPernyataanRek").attr("src",userfile.SuratPernyataanRek.file).attr('id','is_SuratPernyataanRek');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.PengurusCabang.file) {
                    $(".PengurusCabang").attr("src",userfile.PengurusCabang.file).attr('id','is_PengurusCabang');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.FormSurvey.file) {
                    $(".FormSurvey").attr("src",userfile.FormSurvey.file).attr('id','is_FormSurvey');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.FotoKantor.file) {
                    $(".FotoKantor").attr("src",userfile.FotoKantor.file).attr('id','is_FotoKantor');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.FormDiskon.file) {
                    $(".FormDiskon").attr("src",userfile.FormDiskon.file).attr('id','is_FormDiskon');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.FotoKK.file) {
                    $(".FotoKK").attr("src",userfile.FotoKK.file).attr('id','is_FotoKK');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.FotoKTP.file) {
                    $(".FotoKTP").attr("src",userfile.FotoKTP.file).attr('id','is_FotoKTP');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.FotoNPWP.file) {
                    $(".FotoNPWP").attr("src",userfile.FotoNPWP.file).attr('id','is_FotoNPWP');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.LembarSetuju.file) {
                    $(".LembarSetuju").attr("src",userfile.LembarSetuju.file).attr('id','is_LembarSetuju');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }*/
                if (userfile.FotoTT.file) {
                    $(".FotoTT").attr("src",userfile.FotoTT.file).attr('id','is_FotoTT');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.DaftarHadir.file) {
                    $(".DaftarHadir").attr("src",userfile.DaftarHadir.file).attr('id','is_DaftarHadir');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
                if (userfile.SuratNotaris.file) {
                    $(".SuratNotaris").attr("src",userfile.SuratNotaris.file).attr('id','is_SuratNotaris');
                    //$(".imgPicNPWP2").attr("src",userfile.PicNPWP.file).attr('id','is_picNPWP2');
                }
            };
            reader.readAsDataURL(vm.myFile);
        }
    });
});

function load_data()
{
    $(".text-danger").remove();
        $('#editdiv').css('display','block');
    if($('[name="PBranchCode"]').val() == "") {
        $('#editdiv').css('display','none');
        $('[name="PBranchCode"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Pilih Cabang !</p>');
        $('[name="PBranchCode"]').focus();
        return false;
    } else {
        $('#Area,#Propinsi,#Kota,#BankName').select2();
        $('#editdiv').css('display','block');
        $("#divtenor").css('display','none');
        //$('#ttenor').empty();
        BranchCode = $('#PBranchCode').val();
        //alert(BranchCode);
        url = base_url + "Legal/loadupload2";
        $.ajax({
            url : url,
            type: "POST",
            data: ({"token":window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg="),"BranchCode":window.btoa(BranchCode)}),
            dataType: "JSON",
            success: function(data)
            {
                $.each(data.rows, function(i, data) {
                //alert(data.KodeAreaCabang);
                $('[name="BranchCode"]').val(data.KodeAreaCabang);
                $('[name="BranchName"]').val(data.NamaAreaCabang);
                $("#FormCabang01tumb").attr("src",base_url+"assets/upload/legal/"+data.FormCabang01);
                $("#FormCabang02tumb").attr("src",base_url+"assets/upload/legal/"+data.FormCabang02);
                $("#SuratPernyataanRektumb").attr("src",base_url+"assets/upload/legal/"+data.SuratPernyataanRek);
                $("#PengurusCabangtumb").attr("src",base_url+"assets/upload/legal/"+data.PengurusCabang);
                $("#FormSurveytumb").attr("src",base_url+"assets/upload/legal/"+data.FormSurvey);
                $("#FotoKantortumb").attr("src",base_url+"assets/upload/legal/"+data.FotoKantor);
                $("#FormDiskontumb").attr("src",base_url+"assets/upload/legal/"+data.FormDiskon);
                $("#FotoKKtumb").attr("src",base_url+"assets/upload/legal/"+data.FotoKK);
                $("#FotoKTPtumb").attr("src",base_url+"assets/upload/legal/"+data.FotoKTP);
                $("#FotoNPWPtumb").attr("src",base_url+"assets/upload/legal/"+data.FotoNPWP);
                $("#LembarSetujutumb").attr("src",base_url+"assets/upload/legal/"+data.LembarPersetujuan);
                $("#SuratPernyataantumb").attr("src",base_url+"assets/upload/legal/"+data.SuratPernyataan);
                $("#SuratSangguptumb").attr("src",base_url+"assets/upload/legal/"+data.SuratSanggup);
                $("#FotoTTtumb").attr("src",base_url+"assets/images/no-image.png");
                $("#DaftarHadirtumb").attr("src",base_url+"assets/images/no-image.png");
                //$("#SuratNotaristumb").attr("src",base_url+"assets/images/no-image.png");
        });
    }
    });
}
}

function save() 
{
    $(".text-danger").remove();
    if($('[name="BranchCode"]').val() == "") {
        $('[name="BranchCode"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Kode Cabang Wajib Diisi !</p>');
        $('[name="BranchCode"]').focus();
        return false;
    }
    if($('[name="FotoTT"]').val() == "") {
        $('[name="FotoTT"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Wajib Diisi !</p>');
        $('[name="FotoTT"]').focus();
        return false;
    }
    if($('[name="DaftarHadir"]').val() == "") {
        $('[name="DaftarHadir"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Wajib Diisi !</p>');
        $('[name="DaftarHadir"]').focus();
        return false;
    }
    if($('[name="SuratNotaris"]').val() == "") {
        $('[name="SuratNotaris"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Wajib Diisi !</p>');
        $('[name="SuratNotaris"]').focus();
        return false;
    }
    url = base_url + "Legal/updateupload2";

    var formdata = {};
    formdata['token'] = unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="));
    formdata['BranchCode'] = window.btoa($('#BranchCode').val());
    //ktpfile = $('#PicKTP').val();
    //npwpfile = $('#PicNPWP').val();
        /*if(userfile.FormCabang01.file) {
            formdata['FormCabang01Mime'] = userfile.FormCabang01.type;
            formdata['FormCabang01File'] = userfile.FormCabang01.file;
        }
        if(userfile.FormCabang02.file) {
            formdata['FormCabang02Mime'] = userfile.FormCabang02.type;
            formdata['FormCabang02File'] = userfile.FormCabang02.file;
        }
        if(userfile.SuratSanggup.file) {
            formdata['SuratSanggupMime'] = userfile.SuratSanggup.type;
            formdata['SuratSanggupFile'] = userfile.SuratSanggup.file;
        }
        if(userfile.SuratPernyataan.file) {
            formdata['SuratPernyataanMime'] = userfile.SuratPernyataan.type;
            formdata['SuratPernyataanFile'] = userfile.SuratPernyataan.file;
        }
        if(userfile.SuratPernyataanRek.file) {
            formdata['SuratPernyataanRekMime'] = userfile.SuratPernyataanRek.type;
            formdata['SuratPernyataanRekFile'] = userfile.SuratPernyataanRek.file;
        }
        if(userfile.PengurusCabang.file) {
            formdata['PengurusCabangMime'] = userfile.PengurusCabang.type;
            formdata['PengurusCabangFile'] = userfile.PengurusCabang.file;
        }
        if(userfile.FormSurvey.file) {
            formdata['FormSurveyMime'] = userfile.FormSurvey.type;
            formdata['FormSurveyFile'] = userfile.FormSurvey.file;
        }
        if(userfile.FormDiskon.file) {
            formdata['FormDiskonMime'] = userfile.FormDiskon.type;
            formdata['FormDiskonFile'] = userfile.FormDiskon.file;
        }
        if(userfile.FotoKTP.file) {
            formdata['FotoKTPMime'] = userfile.FotoKTP.type;
            formdata['FotoKTPFile'] = userfile.FotoKTP.file;
        }
        if(userfile.FotoKK.file) {
            formdata['FotoKKMime'] = userfile.FotoKK.type;
            formdata['FotoKKFile'] = userfile.FotoKK.file;
        }
        if(userfile.FotoNPWP.file) {
            formdata['FotoNPWPMime'] = userfile.FotoNPWP.type;
            formdata['FotoNPWPFile'] = userfile.FotoNPWP.file;
        }
        if(userfile.LembarSetuju.file) {
            formdata['LembarSetujuMime'] = userfile.LembarSetuju.type;
            formdata['LembarSetujuFile'] = userfile.LembarSetuju.file;
        }
        if(userfile.FotoKantor.file) {
            formdata['FotoKantorMime'] = userfile.FotoKantor.type;
            formdata['FotoKantorFile'] = userfile.FotoKantor.file;
        }*/
        if(userfile.FotoTT.file) {
            formdata['FotoTTrMime'] = userfile.FotoTT.type;
            formdata['FotoTTFile'] = userfile.FotoTT.file;
        }
        if(userfile.DaftarHadir.file) {
            formdata['DaftarHadirMime'] = userfile.DaftarHadir.type;
            formdata['DaftarHadirFile'] = userfile.DaftarHadir.file;
        }
        if(userfile.SuratNotaris.file) {
            formdata['FotoKantorMime'] = userfile.SuratNotaris.type;
            formdata['SuratNotarisFile'] = userfile.SuratNotaris.file;
        }
    //alert($('#Status').val());
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
                    $('#editdiv').css('display','none');
                    //$(".img").attr("src",base_url+"assets/images/no-image.png");
                }
            }
        });
}

</script>