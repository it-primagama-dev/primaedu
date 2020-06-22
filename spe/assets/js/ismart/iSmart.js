/*var uri = window.location.pathname.split('/');
var baseUrl = window.location.protocol+ "//" +window.location.host+'/'+ uri[1] +'/'+ uri[2] +'/';*/

$('document').ready(function(){
  get_area();
  get_BidangStudi();

  $('#Area').select2();
  $('#BidangStudi').select2();

  function get_area() {
    $.getJSON(base_url+"ismart/get_area", function(json){
    $('#Area').empty();
    $('#Area').append($('<option>').text("- - Pilih Area - -").attr('value',''));
      //$('#Cabang').append($('<option>').text("- - Pilih Cabang - -").attr('value',''));
    $.each(json, function(i, obj){
    $('#Area').append($('<option>').text(obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
    });
  });
  }

  // GET CABANG
  $('#Area').on('change', function(){

    var areaval = this.value;

    $(".loader").show();
    $.get(base_url +'ismart/get_cabang/'+ areaval, function(data){
      $('#Cabang').html(data);
      $('#Cabang').select2();
    })

  })


});





   //  $("#Area").change(function(e) { //1
   //  var Area = e.target.value; //2
   // // alert(Area);
   //  $.getJSON(base_url+"ismart/get_cabang/"+Area, function(json){ //3
   //      $('#Cabang').empty();
   //      $('#Cabang').append($('<option>').text("- - Pilih Cabang - -").attr('value',''));
   //      /*$('#PR').append($('<option>').text("Barcode Lama"));*/
   //      $.each(json, function(i, obj){
   //      $('#Cabang').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
   //      });
   //  });
   //  });

    function get_BidangStudi() {
        $.getJSON(base_url+"ismart/get_BidangStudi", function(json){
        $('#BidangStudi').empty();
        $('#BidangStudi').append($('<option>').text("- - Pilih Bidang Studi - -").attr('value',''));
        //$('#Cabang').append($('<option>').text("- - Pilih Cabang - -").attr('value',''));
        $.each(json, function(i, obj){
        $('#BidangStudi').append($('<option>').text(obj.NamaBidangStudi).attr('value', obj.KodeBidangStudi));
        });
    });
    }

var userfile = {
    Ijazah:{},
    Sertifikat:{},
    KTP:{},
};

$("document").ready(function() {
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

            };
            reader.readAsDataURL(vm.myFile);
        }
    });
});

    function validEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    };

    function save_data() {
    email = $('[name="Email"]').val();
    //alert(validEmail(email));
    $(".text-danger").remove();
      if($('[name="Name"]').val() == "") {
          $('[name="Name"]').after('<p class="text-danger">Wajib diisi !!!</p>');
          $('[name="Name"]').focus();
          return false;
      }
      if($('[name="NoKTP"]').val() == "") {
          $('[name="NoKTP"]').after('<p class="text-danger">Wajib diisi !!!</p>');
          $('[name="NoKTP"]').focus();
          return false;
      }

      if($('[name="NoKTP"]').val() != "") {

        var no_ktp = $('[name="NoKTP"]').val();

        $.post(baseUrl +'ismart/check_ktp', {NoKTP: no_ktp})
        .done(function(val){
          if (val == 1) {
            $('[name="NoKTP"]').after('<p class="text-danger">No. KTP yang anda masukkan sudah tersedia didatabase.</p>');
            $('[name="NoKTP"]').focus();
            return false;
          }
        })
        .fail(function(err){
          console.log(err);
        })

      }

      if(!validEmail(email)) {
          $('[name="Email"]').after('<p class="text-danger">Format Email Salah !!!</p>');
          $('[name="Email"]').focus();
          return false;
      }
      if($('[name="Telepon"]').val() == "") {
          $('[name="Telepon"]').after('<p class="text-danger">Wajib diisi !!!</p>');
          $('[name="Telepon"]').focus();
          return false;
      }
      if($('[name="Pekerjaan"]').val() == "") {
          $('[name="Pekerjaan"]').after('<p class="text-danger">Pekerjaan Harus Diisi !!!</p>');
          $('[name="Pekerjaan"]').focus();
          return false;
      }
      if($('[name="Alamat"]').val() == "") {
          $('[name="Alamat"]').after('<p class="text-danger">Alamat Harus Diisi !!!</p>');
          $('[name="Alamat"]').focus();
          return false;
      }
      if($('[name="TipeiSmart"]').val() == "") {
          $('[name="TipeiSmart"]').after('<p class="text-danger">Pilih Tipe iSmart !!!</p>');
          $('[name="TipeiSmart"]').focus();
          return false;
      }
      if($('[name="Area"]').val() == "") {
          $('[name="Area"]').after('<p class="text-danger">Pilih Area !!!</p>');
          $('[name="Area"]').focus();
          return false;
      }
      if($('[name="Cabang"]').val() == "") {
          $('[name="Cabang"]').after('<p class="text-danger">Pilih Cabang !!!</p>');
          $('[name="Cabang"]').focus();
          return false;
      }
      if($('[name="Pendidikan"]').val() == "") {
          $('[name="Pendidikan"]').after('<p class="text-danger">Pilih Pendidikan Terakhir !!!</p>');
          $('[name="Pendidikan"]').focus();
          return false;
      }
      if($('[name="BidangStudi"]').val() == "") {
          $('[name="BidangStudi"]').after('<p class="text-danger">Pilih Bidang Studi !!!</p>');
          $('[name="BidangStudi"]').focus();
          return false;
      }
      if($('[name="Jurusan"]').val() == "") {
          $('[name="Jurusan"]').after('<p class="text-danger">Wajib diisi !!!</p>');
          $('[name="Jurusan"]').focus();
          return false;
      }
      if($('[name="KTP"]').val() == "") {
          $('[name="KTP"]').after('<p class="text-danger">Wajib diisi !!!</p>');
          $('[name="KTP"]').focus();
          return false;
      }
/*       if($('[name="Ijazah"]').val() == "") {
          $('[name="Ijazah"]').after('<p class="text-danger">Wajib diisi !!!</p>');
          $('[name="Ijazah"]').focus();
          return false;
      }
       if($('[name="Sertifikat"]').val() == "") {
          $('[name="Sertifikat"]').after('<p class="text-danger">Wajib diisi !!!</p>');
          $('[name="Sertifikat"]').focus();
          return false;
      }*/

      if (confirm("Anda yakin data sudah terinput dengan benar ?")) {

      var formdata = {};
      formdata['Name'] = $('#Name').val();
      formdata['NoKTP'] = $('#NoKTP').val();
      formdata['TipeiSmart'] = $('#TipeiSmart').val();
      formdata['Area'] = $('#Area').val();
      formdata['Cabang'] = $('#Cabang').val();
      formdata['BidangStudi'] = $('#BidangStudi').val();
      formdata['BidangStudi2'] = $('#BidangStudi2').val();
      formdata['Alamat'] = $('#Alamat').val();
      formdata['Email'] = $('#Email').val();
      formdata['Pendidikan'] = $('#Pendidikan').val();
      formdata['Pekerjaan'] = $('#Pekerjaan').val();
      formdata['Ijazah'] = $('#Ijazah').val();
      formdata['Telepon'] = $('#Telepon').val();
      formdata['Jurusan'] = $('#Jurusan').val();
      formdata['Sertifikat'] = $('#Sertifikat').val();
      formdata['ScanKTP'] = $('#KTP').val();

        if(userfile.Ijazah.file) {
            formdata['IjazahMime'] = userfile.Ijazah.type;
            formdata['IjazahFile'] = userfile.Ijazah.file;
        }

        if(userfile.Sertifikat.file) {
            formdata['SertifikatMime'] = userfile.Sertifikat.type;
            formdata['SertifikatFile'] = userfile.Sertifikat.file;
        }
        if(userfile.KTP.file) {
            formdata['KTPMime'] = userfile.KTP.type;
            formdata['KTPFile'] = userfile.KTP.file;
        }
        //test = formdata['IjazahFile'];
        //test = formdata['SertifikatFile'];
        //alert(test);
          $.ajax({
          url : base_url+"ismart/save_addiSmart",
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
            if (data.status == 'success') {
              // $('#form')[0].reset();
              $.notify(data.message,data.status);
              window.location.reload();
            }else {
              $.notify(data.message,data.status);
            }

          }
        })

        // $.post(base_url+"ismart/save_addiSmart", formdata)
        // .done(function(data){
        //   alert('success'+ data.message)
        // })
        // .fail(function(err){
        //   console.log(err);
        // })

      }


    }
