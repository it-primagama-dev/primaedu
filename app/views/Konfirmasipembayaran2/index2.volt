{{ content() }}

<h1>
    {{ link_to("registrasi", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Pendaftaran
    <small class="on-right">Formulir</small>
</h1>

{{ form("registrasi/proses", "method":"post", "id":"registrasi-form") }}
{% if memberarea is defined %}
    {{ hidden_field("RecID") }}
{% endif %}
<div class="tab-control" data-role="tab-control" data-effect="fade">
    <ul class="tabs">
        <li class="active"><a href="#_tab1">1. Isi Data</a></li>
        <li><a href="#_tab2">2. Biaya & Pembayaran</a></li>
    </ul>
 
    <div class="frames">
        <div class="frame" id="_tab1">{{ partial('registrasi/siswabaru-tab1') }}</div>
        <div class="frame" id="_tab2">{{ partial('registrasi/siswabaru-tab2') }}</div>
    </div>
</div>
{{ end_form() }}

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <input type="button" value="Batal" data-dismiss="modal">
                <input type="button" value="Lanjutkan" id="btn-submit">
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#TanggalBayar").on("change", function(){setpaymethod();});
    $("#Jenjang").on("change", function() {
        var url = "{{ url('registrasi/program/') }}" + $("#Jenjang option:selected").val();
        $.getJSON(url).done(function (data) {
            $('#Program').empty();
            if (data.status === "OK") {
                var htmlcontent = "";
                $.each(data.listData, function (i, list) {
                    htmlcontent += "<option value=\"" + list.id + "\">" + list.nama + "</option>";
                });
                $('#Program').html(htmlcontent);
                var url2 = "{{ url('registrasi/schedule/') }}" + $('#Program').val();
                $.getJSON(url2).done(function (data2) {
                    $('#Jadwal').empty();
                    if (data2.status === "OK") {
                        var htmlcontent = "";
                        $.each(data2.listData, function (i, list) {
                            htmlcontent += "<option value=\"" + list.id + "\">" + list.description + "</option>";
                        });
                        $('#Jadwal').html(htmlcontent);
                    }
                });
            }
        });
    });
    $('#Program').on('change', function () {
        var url2 = "{{ url('registrasi/schedule/') }}" + $('#Program').val();
        $.getJSON(url2).done(function (data2) {
            $('#Jadwal').empty();
            if (data2.status === "OK") {
                var htmlcontent = "";
                $.each(data2.listData, function (i, list) {
                    htmlcontent += "<option value=\"" + list.id + "\">" + list.description + "</option>";
                });
                $('#Jadwal').html(htmlcontent);
            }
        });
    });
    $(".tab-control").tabcontrol().bind("tabcontrolchange", function(event, frame){
        var id = $(frame).attr("id");
        if(id === "_tab2") {
            var urlHarga = "{{ url('registrasi/harga/') }}" + $('#Program').val();
            $.getJSON(urlHarga).done(function (data) {
                $('#BiayaPendaftaran').empty();
                if (data.status === "OK") {
                    $('#BiayaPendaftaran').val(data.listData[0].hargapendaftaran).autoNumeric('update');
                }
            });
            setpaymethod();
        }
    });
    $('#btn-conf').on('click', function () {
        $("#myModal .modal-title").html("Pendaftaran Siswa");
        $("#myModal .modal-body").html("Pastikan data yang anda input, sudah benar.");
        $("#myModal").modal('show');
    });
    $('#btn-submit').on('click', function () {
        $(".loader").show();
        var url3 = "{{ url('registrasi/harga/') }}" + $('#Program').val();
        var price = null;
		$.getJSON(url3).done(function (data3) {
		var nama=document.getElementById('NamaSiswa').value
		var tgl=document.getElementById('TanggalLahir').value
		var email=document.getElementById('EmailSiswa').value
		var ayah=document.getElementById('NamaAyah').value
		var ibu=document.getElementById('NamaIbu').value
		var telayah=document.getElementById('TeleponAyah').value
		var telibu=document.getElementById('TeleponIbu').value
		var jatuh=document.getElementById('TanggalJatuhTempo').value
		var agama=document.getElementById('Agama').value
		var asal=document.getElementById('AsalSekolah').value
		var telsis=document.getElementById('TeleponSiswa').value
		var alamat=document.getElementById('Alamat').value
		var kota=document.getElementById('Kota').value
		var provinsi=document.getElementById('Propinsi').value
		var tempat=document.getElementById('TempatLahir').value
		var jumbay=document.getElementById('JumlahBayar').value
		var metpem=document.getElementById('MetodePembayaran2').value
		
		
		
			
			
			
			if(nama===''||nama===null){
				alert("Nama siswa wajib di isi");
				$("#myModal").modal('hide');
				$('#NamaSiswa').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			if(tempat===''||tempat===null){
				alert("Tempat Lahir wajib di isi");
				$("#myModal").modal('hide');
				$('#TempatLahir').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			if(tgl===''||tgl===null){
				alert("Tanggal lahir wajib di isi");
				$("#myModal").modal('hide');
				$('#TanggalLahir').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			if(email===''||email===null){
				alert("Email siswa wajib di isi");
				$("#myModal").modal('hide');
				$('#EmailSiswa').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			if(agama===''||agama===null){
				alert("Agama siswa wajib di isi");
				$("#myModal").modal('hide');
				$('#Agama').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			if(asal===''||asal===null){
				alert("AsalSekolah siswa wajib di isi");
				$("#myModal").modal('hide');
				$('#AsalSekolah').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			if(telsis===''||telsis===null){
				alert("Telepon siswa wajib di isi");
				$("#myModal").modal('hide');
				$('#TeleponSiswa').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			if((ayah===''||ayah===null)&&(ibu===''||ibu===null)){
				alert("Nama Ayah/Ibu wajib di isi");
				$("#myModal").modal('hide');
				$('#NamaAyah').focus().parent().addClass('error-state');$(".loader").hide();return;
				$('#NamaIbu').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			if((telayah===''||telayah===null)&&(telibu===''||telibu===null)){
				alert("Telepon ayah/ibu wajib di isi");
				$("#myModal").modal('hide');
				$('#NamaAyah').focus().parent().addClass('error-state');$(".loader").hide();return;
				$('#NamaIbu').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			if(alamat===''||alamat===null){
				alert("Alamat Orang tua wajib di isi");
				$("#myModal").modal('hide');
				$('#Alamat').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			if(provinsi===''||provinsi===null){
				alert("Provinsi Orang tua siswa wajib di isi");
				$("#myModal").modal('hide');
				$('#Propinsi').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			if(kota===''||kota===null){
				alert("Kota Orang tua wajib di isi");
				$("#myModal").modal('hide');
				$('#Kota').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			
			
			
			if(jatuh===''||jatuh===null){
				alert("Jatuh Tempo wajib di isi");
				$("#myModal").modal('hide');
				$('#TanggalLahir').focus().parent().addClass('error-state');$(".loader").hide();return;
			}
			
			
			if(metpem===''&& jumbay!==''){
			
				
				
				alert("Metode Pembayaran Wajib di isi");
				$("#myModal").modal('hide');
				$('#metpem').focus().parent().addClass('error-state');$(".loader").hide();return;
				
				
			}
		
		
		
       
            if (data3.status === "OK") {
                price = data3.listData[0].hargabimbinganmin;
                if($('#BiayaBimbingan').autoNumeric('get') >= price && price !== null){
                    $('#BiayaBimbingan').parent().removeClass('error-state');
                    $('#registrasi-form').submit();return;
                };
                $("#myModal").modal('hide');
                $('#BiayaBimbingan').focus().parent().addClass('error-state');$(".loader").hide();return;
            }
            $("#myModal").modal('hide');
            $('#BiayaBimbingan').focus().parent().addClass('error-state');$(".loader").hide();
            alert('Oops! Error Validating "BiayaBimbingan" - Please Call Administrator');
        }).fail(function(){
            $("#myModal").modal('hide');
            $('#BiayaBimbingan').focus().parent().addClass('error-state');$(".loader").hide();
        });
/*        if($("#Program").val() === "") {
            $("#Program").addClass("error-state");
            e.preventDefault();
        }*/
    });
    function setpaymethod() {
        $("#MetodePembayaran2").empty();
        var url = "{{ url('registrasi/metode/') }}" + $("#TanggalBayar").val();
        $.get(url).done(function(d){$("#MetodePembayaran2").html(d);});
    }
});
</script>
