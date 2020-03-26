$(document).ready(function () {
    $('#registrasi').wizard({
        stepper: true,
        stepperType: 'rounded', // stepper type, see http://metroui.org.ua/stepper.html
        stepperClickable: false, // set to true if you can switch page over click on stepper
        startPage: 'default', // if this value ne 'default' wizard started from this page
        finishStep: 'default', // 'default' - last page or int - number of page
        buttons: {//show or hide buttons
            cancel: {show: true, title: "Batal", group: "left"},
            help: false,
            prior: {show: true, title: "Kembali", group: "right"},
            next: {show: true, title: "Lanjutkan", group: "right"},
            finish: {show: true, title: "Selesai & Simpan", group: "right"}
        },
        onPage: function (page, wiz) {
            if (page === 3) {
                var jenjang = $("#Jenjang option:selected").val();
                var url = "/registrasi/program/" + jenjang;
                $.getJSON(url).done(function (data) {
                    $('#Program').empty();
                    if (data.status === "OK") {
                        var htmlcontent = "";
                        $.each(data.listData, function (i, list) {
                            htmlcontent += "<option value=\"" + list.id + "\">" + list.nama + "</option>";
                        });
                        $('#Program').html(htmlcontent);
                        var url2 = "/registrasi/schedule/" + $('#Program').val();
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
                $('#Program').on('change', function () {
                    var url2 = "/registrasi/schedule/" + $('#Program').val();
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
            }
            if (page === 4) {
                var url3 = "/registrasi/harga/" + $('#Program').val();
                $.getJSON(url3).done(function (data3) {
                    $('#BiayaPendaftaran').empty();
                    if (data3.status === "OK") {
                        $('#BiayaPendaftaran').val(data3.listData[0].hargapendaftaran);
                    }
                });
                //$('#HargaProgram').val($('.tile.selected').find('input').val());
            }
        },
        onFinish: function () {
            $(".loader").show();
            var url3 = "/registrasi/harga/" + $('#Program').val();
            $.getJSON(url3).done(function (data3) {
                if (data3.status === "OK") {
                    if ($('#BiayaBimbingan').val() >= data3.listData[0].hargabimbinganmin) {
                        $('#BiayaBimbingan').parent().removeClass('error-state');
                        var kartu = "/registrasi/kartu?lookup=" + $('#NoKartuSiswa').val();
                        $.getJSON(kartu).done(function (datalookup) {
                            if (datalookup.status === "0") {
                                $("#registrasi-form").submit();
                            } else {
                                $('#NoKartuSiswa').focus().parent().addClass('error-state');
                            }
                        }).fail(function () {
                            $('#NoKartuSiswa').focus().parent().addClass('error-state');
                        });
                        $(".loader").hide();
                    } else {
                        $(".loader").hide();
                        $('#BiayaBimbingan').focus().parent().addClass('error-state');
                    }
                }
            }).fail(function () {
                $(".loader").hide();
            });
        }

        // Buttons click methods, page change events
//            onCancel: function(page, wiz){...},
//            onHelp: function(page, wiz){...},
//            onPrior: function(page, wiz){...},
//            onNext: function(page, wiz){...},
//            onFinish: function(page, wiz){...},
//            onPage: function(page, wiz){...},
//            onStepClick: function(step){...}
    });
});