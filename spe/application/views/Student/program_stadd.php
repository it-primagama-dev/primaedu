<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>assets/js/dateformat.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>assets/js/sha-1.js"></script>
</head>
<form action="#" id="form" class="form-horizontal">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-plus"> Tambah Program Siswa</i></p>
                <legend></legend>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="col-lg-4" style="padding-top: 8px;">NISP / Nama Siswa</label>
                <div class="col-lg-8">
                <select class="form-control" id="StudentID" name="StudentID">
                    <option value="">- - - Pilih Siswa - - -</option>
                </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12">  
        <br><legend></legend>
          <button type="button" id="btnsave" class="btn btn-primary" onclick="printandpay()">Tampilkan</button>
      </div>
    </div>
</form>
</html>
<script src="<?=base_url('assets/js/autoNumeric.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<script type="text/javascript">
$(document).ready(function(){
    get_branch_st();
});

$(function () {
    $('#StudentID').select2();
});

function get_branch_st() {
    $.getJSON(base_url+"student/get_branch_st", function(json){
        $('#StudentID').empty();
        $('#StudentID').append($('<option>').text("- - Pilih Siswa - -").attr('value', ''));
        $.each(json, function(i, obj){
        $('#StudentID').append($('<option>').text(obj.StudentID+' - '+obj.Name).attr('value', obj.RecID));
        });
    });
}

function printandpay() {
  $(".text-danger").remove();
  if($('[name="StudentID"]').val() == "") {
      $('[name="StudentID"]').after('<p class="text-danger">Wajib diisi !!!</p>');
      $('[name="StudentID"]').focus();
      return false;
  }
  StudentID = $('#StudentID').val();
  //alert(StudentID);
  redirectPost(base_url+"student/add_programst", {StudentID:window.btoa(StudentID),Code:window.btoa(1)});
}

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
</script>
