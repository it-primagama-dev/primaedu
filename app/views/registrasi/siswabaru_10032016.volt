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
        $("#myModal .modal-title").html("Pendaftaran Siswa ");
        $("#myModal .modal-body").html("Pastikan data yang anda input, sudah benar.");
        $("#myModal").modal('show');
    });
    $('#btn-submit').on('click', function () {
        $(".loader").show();
        var url3 = "{{ url('registrasi/harga/') }}" + $('#Program').val();
        var price = null;
        $.getJSON(url3).done(function (data3) {
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
