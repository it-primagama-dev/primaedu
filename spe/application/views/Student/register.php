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
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-user"> Form Pendaftaran Siswa</i></p>
                <legend></legend>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="col-md-4">Nama Siswa</label>
            <div class="col-lg-8">
                <input type="text" id="Name" name="Name" class="form-control" placeholder="Input nama siswa">
            </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4">Telp. Siswa / WA</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Input nomor telepon siswa" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4">Email Siswa</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Input email siswa" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4">Jenis Kelamin</label>
                <div class="col-lg-8">
                <select class="form-control" id="Gender" name="Gender">
                    <option value="">- - - Pilih Jenis Kelamin - - -</option>
                    <option value="1">Laki-Laki</option>
                    <option value="2">Perempuan</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4">Tempat & Tgl Lahir</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Input tempat lahir" />
                </div>
                <div class="col-lg-4">
                    <input type="date" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Input tanggal lahir" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4">Nama Orang Tua</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Input nama orang tua siswa" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4">Telp. Orang Tua / WA</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Input nomor telepon orang tua" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4">Asal Sekolah</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="School" name="School" placeholder="Input asal sekolah" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4">Jenjang</label>
                <div class="col-lg-8">
                <select class="form-control" id="Stage" name="Stage">
                    <option value="">- - - Pilih Jenjang Siswa - - -</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4">Program</label>
                <div class="col-lg-8">
                <select class="form-control" id="ProgramPack" name="ProgramPack">
                    <option value="">- - - Pilih Program - - -</option>
                </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group" id="divmatpel" style="display: none;">
                <div class="col-lg-12">         
                  <table class="table table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu">
                    <thead>
                      <tr>
                        <th colspan="2" style="text-align: center;"><span id="pilih"></span></th>
                      </tr>
                      <!-- <tr>
                        <th colspan="2" style="text-align: center;">
                          <div class="radio radio-success radio-inline print-hidden">
                              <input type="radio" id="inlineradio[0]"  name='cek'>
                              <label for="inlineradio[0]">1</label>
                          </div>
                          <div class="radio radio-success radio-inline print-hidden">
                              <input type="radio" id="inlineradio[1]"  name='cek'>
                              <label for="inlineradio[1]">2</label>
                          </div>
                          <div class="radio radio-success radio-inline print-hidden">
                              <input type="radio" id="inlineradio[2]"  name='cek'>
                              <label for="inlineradio[2]">3</label>
                          </div>
                          <div class="radio radio-success radio-inline print-hidden">
                              <input type="radio" id="inlineradio[3]"  name='cek'>
                              <label for="inlineradio[3]">4</label>
                          </div>
                          <div class="checkboxdiv"><input type="checkbox" name="Extras" value="Wedges"><br/><input type="checkbox" name="Extras" value="Chips"><br/><input type="checkbox" name="Extras" value="Garlic Bread"><br/><input type="checkbox" name="Extras" value="Chicken Wings"> <br/><input type="checkbox" name="Extras" value="Cheese Sticks"></div>
                        </th>
                      </tr> -->
                      <tr>
                        <th style="text-align: center;">Pilih</th>
                        <th style="text-align: center;">Nama Mata Pelajaran</th>
                      </tr>
                    </thead>
                    <tbody id="data_matpel"></tbody>
                  </table>
                </div>
                <div class="col-lg-12" style="text-align: right;">   
                  <button type="button" id="btntambah" class="btn btn-success btn-sm" onclick="addharga()">Input Harga Pendaftaran & Bimbingan</button>
                </div>
            </div>
            <div id="divharga" style="display: none;">
            <div class="form-group">
                <div class="col-lg-12">
                  <legend></legend>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4">Harga Pendaftaran</label>
                <div class="col-lg-8">
                    <input type="text" class="Idr form-control" id="RegPrice" name="RegPrice" placeholder="Input Harga Pendaftaran" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4">Harga Bimbingan</label>
                <div class="col-lg-8">
                    <input type="text" class="Idr form-control" id="ProPrice" name="ProPrice" placeholder="Input Harga Bimbingan" />
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <legend></legend>
        <!-- <i class="fa"><p style="font-size: 18px;"> Detail Program dan Harga yang diikuti siswa :</p></i>
        <table class="table table-bordered table-hover dt-responsive" cellspacing="0" width="100%" id="tableMenu2">
          <thead>
            <tr>
              <th style="text-align: center;">No</th>
              <th style="text-align: center;">Nama Program Mata Pelajaran</th>
              <th style="text-align: center;">Harga Pendaftaran</th>
              <th style="text-align: center;">Harga Bimbingan</th>
              <th style="text-align: center;">Aksi</th>
             </tr>
          </thead>
          <tbody id="data_program"></tbody>
        </table> -->
          <button type="button" id="btnsave" class="btn btn-primary" onclick="save()">Simpan</button>
          <!-- <button type="button" id="btnsave" class="btn btn-primary" onclick="test()">TEST</button> -->
      </div>
    </div>
</form>
</html>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="text-align: center;">
            <h4 class="modal-title">Data Siswa Berhasil Disimpan <!-- <i class="fa" id="nisp"></i> --> <!-- / <i class="fa" id="INV"></i> --></h4>
          </div>
          <div class="modal-body">

          <form action="#" id="form2" class="form-horizontal">
          <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="col-md-4">NISP <br><span style="font-size: 10px;">*Nomor Induk Siswa Primagama</span></label>
                    <input type="hidden" id="RecIDStudent">
                  <div class="col-lg-8">
                      <input type="text" id="nisp" name="nisp" class="form-control" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4">Nama Siswa</label>
                  <div class="col-lg-8">
                      <input type="text" id="Name2" class="form-control" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4">No. Telepon</label>
                  <div class="col-lg-8">
                      <input type="text" id="PhoneNumber2" class="form-control" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4">Asal Sekolah</label>
                  <div class="col-lg-8">
                      <input type="text" id="School2" class="form-control" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4">Jenjang</label>
                  <div class="col-lg-8">
                      <input type="text" id="Stage2" class="form-control" readonly="readonly">
                  </div>
                </div>
                <!-- <div class="form-group">
                  <div class="col-lg-12">
                    <legend></legend>
                  </div>
                </div> -->
                <div class="form-group">
                <div class="col-lg-12">
                  <table class="table table-bordered table-hover dt-responsive" width="100%" id="tableMenu3">
                      <thead>
                        <tr>
                          <th style="text-align: center;">Nama Paket Program</th>
                          <th style="text-align: center;">Detail Mata Pelajaran</th>
                        </tr>
                      </thead>
                      <tbody id="data_subjects"></tbody>
                  </table>
                </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4">Harga Pendaftaran</label>
                  <div class="col-lg-8">
                      <input type="text" id="RegPrice2" class="form-control" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4">Harga Bimbingan</label>
                  <div class="col-lg-8">
                      <input type="text" id="ProPrice2" class="form-control" readonly="readonly">
                  </div>
                </div>
              </div>
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="Lanjutkan" class="btn btn-primary" onClick="printandpay();">Cetak Kwitansi Pendaftaran & Bayar Bimbingan</button>
          </div>
        </div>

      </div>
    </div><!-- Modal -->
<!-- datatables css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?=base_url('assets/js/autoNumeric.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    get_stage();
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
});

/*function test(){
  $('#myModal').modal({
      show: 'show',
      backdrop: 'static',
      keyboard: false
  })
}*/

var jQueryTable;
function get_stage() {
    $.getJSON(base_url+"student/get_stage", function(json){
        $('#Stage').empty();
        $('#Stage').append($('<option>').text("- - Pilih Jenjang - -").attr('value', ''));
        $.each(json, function(i, obj){
    $('#Stage').append($('<option>').text(obj.StageName).attr('value', obj.StageCode));
        });
    });
}

$("#Stage").change(function(e) {
    var Stage = e.target.value;
      //$("#tableMenu").DataTable().destroy();
    //alert(Stage);
    $('#data_matpel').empty();
    $('#divmatpel').css('display','none');
    $('#divharga').css('display','none');
    $('#RegPrice,#ProPrice').val('');
    $.getJSON(base_url+"student/get_programpack/"+Stage, function(json){
        $('#ProgramPack').empty();
        $('#ProgramPack').append($('<option>').text("- - Pilih Program - -").attr('value', ''));
        $.each(json, function(i, obj){
        $('#ProgramPack').append($('<option>').text(obj.PackName).attr('value', obj.RecID));
        });
    });
});

$("#ProgramPack").change(function(e) {
    var Program = e.target.value;
      //alert(Program);
    $.ajax({
        url : base_url+"student/get_subjects",
        type: 'POST',
        data: ({program:Program}),
        dataType: 'json',
        success: function(data){
            //var dataTampung = data;
            var jml_data = Object.keys(data.rows).length;
            var total = 0;
            if (jml_data > 0) {
                $('#data_matpel').empty();
                $('#RegPrice,#ProPrice').val('');
                $('#divharga').css('display','none');
                $('#divmatpel').css('display','block');
                $.each(data.rows, function(i, item) {
                    var $tr = $('<tr>').append(
                        $('<td style="text-align: center;">').html("<div class='checkbox checkbox-primary checkbox-inline print-hidden'><input type='checkbox' class='ids' id='checkboxprogram["+item.RecID+"]' value='"+item.RecID+"' name='cek'><label for='checkboxprogram["+item.RecID+"]'></label></div>"),
                        $('<td>').text(item.SubjectsName),
                    ).appendTo('#data_matpel');
                    jumlah = item.PackType;
                });
                    $("#tableMenu input[type=checkbox]").click(function(){
                    var countchecked = $("table input[type=checkbox]:checked").length;
                    if(countchecked >= jumlah) 
                    {
                        $('table input[type=checkbox]').not(':checked').attr("disabled",true);
                    }
                    else
                    {
                        $('table input[type=checkbox]').not(':checked').attr("disabled",false);
                    }
                    });
                $('#pilih').text("Pilih "+jumlah+" Mata Pelajaran");
            } else {
                $('#data_matpel').empty();
                var $tr = $('<tr>').append(
                        $('<td colspan="2" style="text-align:center;">').text('- - - Belum ada detail program - - -'),
                        ).appendTo('#data_matpel');
            }

        }
      });
});

function addharga() {
  var countchecked = $("table input[type=checkbox]:checked").length;
  //alert(countchecked);
  if(countchecked==jumlah){
    $('#divharga').css('display','block');
  } else {
    alert("Anda Baru Memilih "+countchecked+" Mata Pelajaran.");
  }
}

function save() {

  var countchecked = $("table input[type=checkbox]:checked").length;
  $(".text-danger").remove();
  if($('[name="Name"]').val() == "") {
      $('[name="Name"]').after('<p class="text-danger">Wajib diisi !!!</p>');
      $('[name="Name"]').focus();
      return false;
  }
  if($('[name="PhoneNumber"]').val() == "") {
      $('[name="PhoneNumber"]').after('<p class="text-danger">Wajib diisi !!!</p>');
      $('[name="PhoneNumber"]').focus();
      return false;
  }
  if($('[name="School"]').val() == "") {
      $('[name="School"]').after('<p class="text-danger">Wajib diisi !!!</p>');
      $('[name="School"]').focus();
      return false;
  }
  if($('[name="Stage"]').val() == "") {
      $('[name="Stage"]').after('<p class="text-danger">Wajib diisi !!!</p>');
      $('[name="Stage"]').focus();
      return false;
  }
  if($('[name="ProgramPack"]').val() == "") {
      $('[name="ProgramPack"]').after('<p class="text-danger">Wajib diisi !!!</p>');
      $('[name="ProgramPack"]').focus();
      return false;
  }
  if(countchecked!=jumlah){
      $('#tableMenu').after("<p class='text-danger'>Anda Baru Memilih "+countchecked+" Mata Pelajaran.</p>");
      $('#tableMenu').focus();
      return false;
  }
  if($('[name="RegPrice"]').val() == "") {
      $('[name="RegPrice"]').after('<p class="text-danger">Wajib diisi !!!</p>');
      $('[name="RegPrice"]').focus();
      return false;
  }
  if($('[name="ProPrice"]').val() == "") {
      $('[name="ProPrice"]').after('<p class="text-danger">Wajib diisi !!!</p>');
      $('[name="ProPrice"]').focus();
      return false;
  }
  if (confirm("Anda yakin data sudah terinput dengan benar ?")) {
  var testval = [];
  $('.ids:checked').each(function() {
   testval.push($(this).val());
  });
  var formdata = {};
  formdata['Subjects'] = String(testval);
  formdata['Name'] = $('#Name').val();
  formdata['PhoneNumber'] = $('#PhoneNumber').val();
  formdata['School'] = $('#School').val();
  formdata['Stage'] = $('#Stage').val();
  formdata['ProgramPack'] = $('#ProgramPack').val();
  formdata['RegPrice'] = convertToAngka($('#RegPrice').val());
  formdata['ProPrice'] = convertToAngka($('#ProPrice').val());
      $.ajax({
          url : base_url+"student/save_student",
          type: "POST",
          data: formdata,
          dataType: "JSON",
          beforeSend: function(){
              $("#ajax-loader").show();
          },
          complete: function() {
              $("#ajax-loader").hide();
          },
          success: function(data)
          {
              $.notify(data.message,data.notify); 
              var nisp = data.nisp;
              $.ajax({
                    url : base_url+"student/load_studentsave",
                    type: "POST",
                    data: ({nisp:nisp}),
                    dataType: "JSON",
                    success: function(data)
                    {
                        $('#myModal').modal({
                            show: 'show',
                            backdrop: 'static',
                            keyboard: false
                        })
                        $.each(data.rows, function(i, item) {
                            var $tr = $('<tr>').append(
                                $('<td>').text(item.PackName),
                                $('<td>').text(item.SubjectsName),
                            ).appendTo('#data_subjects');
                          nisp = item.NISP;
                          Name = item.Name;
                          Stage = item.StageName;
                          School = item.School;
                          PhoneNumber = item.PhoneNumber;
                          RegPrice = item.RegisterPrice;
                          ProPrice = item.ProgramPrice;
                          RecIDStudent = item.RecIDStudent;
                        });
                          MergeCommonRows($("#tableMenu3"), 1);
                          $('#nisp').val(nisp);
                          $('#Name2').val(Name);
                          $('#Stage2').val(Stage);
                          $('#School2').val(School);
                          $('#PhoneNumber2').val(PhoneNumber);
                          $('#RegPrice2').val(convertToRupiah(RegPrice));
                          $('#ProPrice2').val(convertToRupiah(ProPrice));
                          $('#RecIDStudent').val(RecIDStudent);
                    }
              })
            }
    })
  }
}

function printandpay() {
  StudentID = $('#RecIDStudent').val();
  //alert(StudentID);
  redirectPost(base_url+"student/detail_st", {StudentID:window.btoa(StudentID),token:window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=")});
}

function MergeCommonRows(table, columnIndexToMerge){
    previous = null;
    cellToExtend = null;
    table.find("td:nth-child("+columnIndexToMerge+")").each(function(){
        jthis = $(this);
        content = jthis.text()
        if(previous == content){
            jthis.remove();
            if(cellToExtend.attr("rowspan") == undefined){
                cellToExtend.attr("rowspan", 2);
            }
            else{
                currentrowspan = parseInt(cellToExtend.attr("rowspan"));
                cellToExtend.attr("rowspan", currentrowspan+1);
            }
        }
        else{
            previous = content;
            cellToExtend = jthis;
        }
    });
};

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
/*function reload_program() {
    $.ajax({
        url : base_url+"student/get_program_tmp",
        type: 'POST',
        //data: ({PR:PR}),
        dataType: 'json',
        success: function(data){
            var dataTampung = data;
            var jml_data = Object.keys(data.rows).length;
            var total = 0;
            if (jml_data > 0) {
                //$('#data_item').empty();
                //$('#btnSavehide').css('display','block');
                $.each(data.rows, function(i, item) {
                    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
                    var $tr = $('<tr>').append(
                        $('<td>').text(i+1),
                        $('<td>').text(item.ProgramDetailName),
                        $('<td style="text-align: right;">').html("<input class=\"form-control Idr\" type=\"text\" name=\"PriceReg\" id=\"PriceReg"+item.RecID+"\">"),
                        $('<td style="text-align: right;">').html("<input class=\"form-control Idr\" type=\"text\" name=\"PricePro\" id=\"PricePro"+item.RecID+"\">"),
                      
                        $('<td class="print-hidden" style="text-align: center;">').html("<a href=\"javascript:void(0)\" onclick=\"delete_data("+item.RecID+",'"+item.ItemCode+"',"+item.Quantity+")\"><i style=\"color: red\" class=\"fa fa-trash\"></i></a>"),
                    ).appendTo('#data_program');
                    //total += isNaN(parseInt(item.Price)*parseInt(item.Quantity)) ? 0 : parseInt(parseInt(item.Price)*parseInt(item.Quantity));
                });
               // $('#total_t').text(convertToRupiah(total));
                //$('#total_tagihan').text(convertToRupiah(total));
                
            } else {
                $('#data_program').empty();
                //$('#total_t').empty();
                //$('#total_tagihan').empty();
                var $tr = $('<tr>').append(
                        $('<td colspan="5" style="text-align:center;">').text('- - - Belum ada detail program - - -'),
                        ).appendTo('#data_program');
            }

        }
      });
}*/

/*function addprogram() {
  var testval = [];
 $('.ids:checked').each(function() {
   testval.push($(this).val());
 });
  //alert(testval);
  var formdata = {};
  formdata['programdetail'] = String(testval);
                    $.ajax({
                        url : base_url+"student/input_program_tmp",
                        type: "POST",
                        data: formdata,
                        dataType: "JSON",
                        beforeSend: function(){
                            $("#ajax-loader").show();
                        },
                        complete: function() {
                            $("#ajax-loader").hide();
                        },
                        success: function(data)
                        {
                            $.notify(data.message,data.notify);
                            reload_program();
                        }
                    });
}*/
</script>

<style type="text/css">
    .checkbox {
  padding-left: 20px; }
  .checkbox label {
    display: inline-block;
    position: relative;
    padding-left: 5px; }
    .checkbox label::before {
      content: "";
      display: inline-block;
      position: absolute;
      width: 17px;
      height: 17px;
      left: 0;
      margin-left: -20px;
      border: 1px solid #cccccc;
      border-radius: 3px;
      background-color: #fff;
      -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
      -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
      transition: border 0.15s ease-in-out, color 0.15s ease-in-out; }
    .checkbox label::after {
      display: inline-block;
      position: absolute;
      width: 16px;
      height: 16px;
      left: 0;
      top: 0;
      margin-left: -20px;
      padding-left: 3px;
      padding-top: 1px;
      font-size: 11px;
      color: #555555; }
  .checkbox input[type="checkbox"] {
    opacity: 0; }
    .checkbox input[type="checkbox"]:focus + label::before {
      outline: thin dotted;
      outline: 5px auto -webkit-focus-ring-color;
      outline-offset: -2px; }
    .checkbox input[type="checkbox"]:checked + label::after {
      font-family: 'FontAwesome';
      content: "\f00c"; }
    .checkbox input[type="checkbox"]:disabled + label {
      opacity: 0.65; }
      .checkbox input[type="checkbox"]:disabled + label::before {
        background-color: #eeeeee;
        cursor: not-allowed; }
  .checkbox.checkbox-circle label::before {
    border-radius: 50%; }
  .checkbox.checkbox-inline {
    margin-top: 0; }

.checkbox-primary input[type="checkbox"]:checked + label::before {
  background-color: #428bca;
  border-color: #428bca; }
.checkbox-primary input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-danger input[type="checkbox"]:checked + label::before {
  background-color: #d9534f;
  border-color: #d9534f; }
.checkbox-danger input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-info input[type="checkbox"]:checked + label::before {
  background-color: #5bc0de;
  border-color: #5bc0de; }
.checkbox-info input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-warning input[type="checkbox"]:checked + label::before {
  background-color: #f0ad4e;
  border-color: #f0ad4e; }
.checkbox-warning input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-success input[type="checkbox"]:checked + label::before {
  background-color: #5cb85c;
  border-color: #5cb85c; }
.checkbox-success input[type="checkbox"]:checked + label::after {
  color: #fff; }

.radio {
  padding-left: 20px; }
  .radio label {
    display: inline-block;
    position: relative;
    padding-left: 5px; }
    .radio label::before {
      content: "";
      display: inline-block;
      position: absolute;
      width: 17px;
      height: 17px;
      left: 0;
      margin-left: -20px;
      border: 1px solid #cccccc;
      border-radius: 50%;
      background-color: #fff;
      -webkit-transition: border 0.15s ease-in-out;
      -o-transition: border 0.15s ease-in-out;
      transition: border 0.15s ease-in-out; }
    .radio label::after {
      display: inline-block;
      position: absolute;
      content: " ";
      width: 11px;
      height: 11px;
      left: 3px;
      top: 3px;
      margin-left: -20px;
      border-radius: 50%;
      background-color: #555555;
      -webkit-transform: scale(0, 0);
      -ms-transform: scale(0, 0);
      -o-transform: scale(0, 0);
      transform: scale(0, 0);
      -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33); }
  .radio input[type="radio"] {
    opacity: 0; }
    .radio input[type="radio"]:focus + label::before {
      outline: thin dotted;
      outline: 5px auto -webkit-focus-ring-color;
      outline-offset: -2px; }
    .radio input[type="radio"]:checked + label::after {
      -webkit-transform: scale(1, 1);
      -ms-transform: scale(1, 1);
      -o-transform: scale(1, 1);
      transform: scale(1, 1); }
    .radio input[type="radio"]:disabled + label {
      opacity: 0.65; }
      .radio input[type="radio"]:disabled + label::before {
        cursor: not-allowed; }
  .radio.radio-inline {
    margin-top: 0; }

.radio-primary input[type="radio"] + label::after {
  background-color: #428bca; }
.radio-primary input[type="radio"]:checked + label::before {
  border-color: #428bca; }
.radio-primary input[type="radio"]:checked + label::after {
  background-color: #428bca; }

.radio-danger input[type="radio"] + label::after {
  background-color: #d9534f; }
.radio-danger input[type="radio"]:checked + label::before {
  border-color: #d9534f; }
.radio-danger input[type="radio"]:checked + label::after {
  background-color: #d9534f; }

.radio-info input[type="radio"] + label::after {
  background-color: #5bc0de; }
.radio-info input[type="radio"]:checked + label::before {
  border-color: #5bc0de; }
.radio-info input[type="radio"]:checked + label::after {
  background-color: #5bc0de; }

.radio-warning input[type="radio"] + label::after {
  background-color: #f0ad4e; }
.radio-warning input[type="radio"]:checked + label::before {
  border-color: #f0ad4e; }
.radio-warning input[type="radio"]:checked + label::after {
  background-color: #f0ad4e; }

.radio-success input[type="radio"] + label::after {
  background-color: #5cb85c; }
.radio-success input[type="radio"]:checked + label::before {
  border-color: #5cb85c; }
.radio-success input[type="radio"]:checked + label::after {
  background-color: #5cb85c; }
</style>