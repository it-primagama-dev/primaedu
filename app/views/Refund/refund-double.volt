{{ content() }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">

                <!-- Input Refund -->

                {{ form("refund/createDoubleRefund", "onSubmit": "return validasi3();", "method":"post",  "autocomplete" : "off","name":"form3","id":"form_double") }}
                <div class="grid fluid">
                    <div class="row">
                        <input type="hidden" id="recID" name="recID" value="{{ list.RecID}}">
                        <div class="span11">
                            <label for="label" class="no-padding">Nama Pembuat Pernyataan</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("namapembuatpernyataan","placeholder":"Nama Pembuat Pernyataan dibutuhkan") }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Jabatan Pembuat Pernyataan</label>
                            <div class="input-control text" data-role="input-cont rol">
                                {{ text_field("jabatanpembuatpernyataan","placeholder":"Jabatan Pembuat Pernyataan dibutuhkan") }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Telp Cabang Terbaru</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("telpcabang","maxlength":"12","onkeyup":"angka(this);","placeholder":"Telp Cabang dibutuhkan", "value":areaCabang.NoTelp) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label">Alamat Cabang Terbaru</label>
                            <div class="input-control textarea" data-role="input-control">
                                {{ text_area("alamatcabang","placeholder":"Alamat Cabang dibutuhkan","value":areaCabang.Alamat) }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div id="box-trx">
                                    <div class="trx-clone">
                                        <div class="span11">
                                        </div>
                                        <div class="span11">
                                            <h2 class="trx_number">Transaksi #1</h2>
                                            <label for="label" class="no-padding">Search Data Transaksi</label>
                                            <div class="input-control select" data-role="input-control">
                                                <select style="width:100%" class="select2-ajax-siswa-cabang" maxlength="11" name="TbRecID[]" placeholder="Search transaksi dibutuhkan"></select>
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label" class="no-padding">KodeCabang + KodeSiswa</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" class="input_va_siswa" name="va_siswa[]" maxlength="11" placeholder="Nova dibutuhkan" readonly="readonly">
                                                <input type="hidden" name="nama_siswa[]">
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label">Tanggal Transfer</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="tgl_transfer[]" placeholder="Tanggal transfer dibutuhkan" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label">Nominal</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="nominal[]" class="input_nominal" placeholder="Nominal transfer dibutuhkan" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label">Tahun Ajaran</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="tahun_ajaran[]" placeholder="Tahun ajaran dibutuhkan" readonly="readonly">
                                                <input type="hidden" name="TahunAjaranID[]"/>
                                            </div>
                                        </div>

                                        <div class="span11">
                                            <h2 class="trx_number">Transaksi #2</h2>
                                            <label for="label" class="no-padding">Search Data Transaksi</label>
                                            <div class="input-control select" data-role="input-control">
                                                <select style="width:100%" class="select2-ajax-siswa-cabang" maxlength="11" name="TbRecID[]" placeholder="Search transaksi dibutuhkan"></select>
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label" class="no-padding">KodeCabang + KodeSiswa</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" class="input_va_siswa" name="va_siswa[]" maxlength="11" placeholder="Nova dibutuhkan" readonly="readonly">
                                                <input type="hidden" name="nama_siswa[]">
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label">Tanggal Transfer</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="tgl_transfer[]" placeholder="Tanggal transfer dibutuhkan" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label">Nominal</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="nominal[]" class="input_nominal" placeholder="Nominal transfer dibutuhkan" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label">Tahun Ajaran</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="tahun_ajaran[]" placeholder="Tahun ajaran dibutuhkan" readonly="readonly">
                                                <input type="hidden" name="TahunAjaranID[]"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-md-4 box-tambah">
                                <div class="span11">
                                </div>
                                <div class="span11">
                                    <span class="btn btn-default" id='add'>Tambah Transaksi Lain</span>
                                </div>
                            </div>-->
                        </div>
                        <hr>
                        <div class="span11">
                            <label for="label">Total Nominal</label>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" name="total_nominal" placeholder="Total Nominal transfer dibutuhkan" readonly="readonly">
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label">Selisih Nominal</label>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" name="selisih_nominal" placeholder="Selisih Nominal transfer dibutuhkan" readonly="readonly">
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Keterangan">Kronologi</label>
                            <div class="input-control textarea" data-role="input-control">
                                <div class='printchatbox'>Telah terjadi double transfer ke nomor VA <span class="va_siswa_double"></span> atas nama <span class="nama_siswa_double"></span> sebesar <span class="total_nominal_double"></span><br/><br/>Mohon dapat dilakukan refund 11% dari <span class="kembali_nominal_double"></span> yaitu <span class="kembali_nominal_persen_double"></span> atas double transfer tersebut.</div>
                            </div>
                        </div>
                        <div class="span11" style="padding-bottom:5%;">
                            <input id="cekbox3" type='checkbox' onclick='run3();'/> Saya setuju dengan syarat dan ketentuan ini.
                        </div>
                        <div class="span11">
                            <button id='cb3' disabled type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
                {{ end_form() }}


                <!-- Input Refund -->

            </div>
        </div>
        <div class="span6">
            <div class="span12 no-margin">
                <div class="panel-body sp" style="padding: 10px">
                    <h4>PROSEDUR REFUND</h4>
                    <h4>Kesalahan Transfer Double</h4>
                    <ol>
                        <li>Lengkapi form disamping setelah selesai checklist bahwa setuju dengan ketentuan yang ditetapkan dan klik tombol simpan, secara otomatis akan download surat pernyataan yang menyatakan terjadi kesalahan transfer, Kemudian surat tersebut di tanda tangan manajer cabang lalu di scan dan dikirim email ke <a href="mailto:finance@primagama.co.id?cc=endra.linardi@primagama.co.id">finance@primagama.co.id</a></li>
                        <li>Lakukan transfer kembali ke no virtual account yang benar / yang dimaksud</li>
                        <li>Mengirimkan bukti pembayaran serta kwitansi untuk virtual account yang benar </li>
                        <li>Setelah melakukan pembayaran ke no VA yang benar / yang dimaksud baru akan kita lakukan proses refund</li>
                        <li>Proses refund kurang lebih 1 (satu) bulan</li>
                        <li>Refund hanya dapat diajukan maksimal 3 bulan dari tanggal transaksi yang salah</li>
                    </ol>
                </div>
            </div>
            <div class="span12 no-margin" id="form-cari-refund-double">
                <div class="panel-body sp" style="padding: 10px">
                    <h4>CARI DATA KOREKSI TRANSFER DOUBLE</h4>
                    <label for="label">No. Surat Pernyataan</label>
                    <div class="input-control select">
                        <div class="span9">
                            <select id="select2-ajax-refund-double" name="nosurat" style="width: 100%"></select>
                        </div>
                        <div class="span3">
                            <div class="btn btn-primary" onClick="lihatKoreksiTransferDouble()"><i class="fa fa-search"></i> Lihat</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function lihatKoreksiTransferDouble() {
        var id = $("#select2-ajax-refund-double").val();
        if (id == "" || id == undefined) {
            alert("Silahkan Isi No. Surat Pernyataan");
        } else {
            window.location.href = base_url + "refund/lihatRefundDouble?id=" + id;
        }
    }
    
    $('#select2-ajax-refund-double').select2({
        ajax: {
            url: "{{ url('refund/searchRefund') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page,
                    jenisRefund: 'Refund Double',
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                var select2Data = $.map(data.results, function (obj) {
                    obj.id = obj.RecID;
                    return obj;
                });

                return {
                    results: select2Data,
                    pagination: {
                        more: data.pagination.more
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        minimumInputLength: 4,
        templateResult: formatRepoRefundDouble,
        templateSelection: formatRepoSelectionRefundDouble
    });

    function formatRepoRefundDouble(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.NoSuratPernyataan + "</div>";

        markup += "<div class='select2-result-repository__description'>" +
                "<div style='display: flex;'>" +
                "<div style='flex: 50%; padding: 1px;'>Account Receivable</div>" +
                "<div style='flex: 50%; padding: 1px; text-align:right'>" + repo.TrackAccountReceivable + "</div>" +
                "</div>";
        if (repo.TrackFinance != null) {
            markup += "<div style='display: flex'>" +
                    "<div style='flex: 50%; padding: 1px;'>Finance</div>" +
                    "<div style='flex: 50%; padding: 1px; text-align:right'>" + repo.TrackFinance + "</div>" +
                    "</div>";
        }
        markup += "</div></div></div>";

        return markup;
    }

    function formatRepoSelectionRefundDouble(repo) {
        return repo.NoSuratPernyataan;
    }
    
    trx_number = 1;

    $("#add").css("pointer-events", "none");
    function select2Init() {
        /*$('.select2-ajax-siswa-cabang').select2({
         minimumInputLength: 4,
         ajax: {
         url: "{{ url('refund/searchTransactionSiswaCabang') }}",
         dataType: 'json',
         delay: 250,
         data: function (params) {
         return {
         q: params.term,
         page: params.page
         };
         },
         }
         });*/
        $('.select2-ajax-siswa-cabang').select2({
            minimumInputLength: 4,
            ajax: {
                url: "{{ url('refund/searchTransactionSiswaCabang') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var va = $(".input_va_siswa:first").val();
                    var nominal = $(".input_nominal:first").val();
                    console.log("VA : " + va);
                    console.log("Nominal : " + nominal);
                    return {
                        q: params.term,
                        page: params.page,
                        return: "all_column",
                        va: va,
                        nominal: nominal
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;

                    var select2Data = $.map(data.results, function (obj) {
                        obj.id = obj.RecID;
                        return obj;
                    });

                    return {
                        results: select2Data,
                        pagination: {
                            more: data.pagination.more
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            minimumInputLength: 4,
            templateResult: formatRepoTransactionSiswaCabang,
            templateSelection: formatRepoTransactionSelectionSiswaCabang
        });
    }
    select2Init();

    function formatRepoTransactionSiswaCabang(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.NoVA + "</div>";

        if (repo.NamaSiswa) {
            markup += "<div class='select2-result-repository__description'>" + repo.NamaSiswa + "</div>";
        }

        markup += "<div class='select2-result-repository__footer'>" +
                "<div class='select2-result-repository__details'><i class='icon-clock'></i> " + repo.TanggalTransaksi + " </div>" +
                "<div class='select2-result-repository__details'>Rp. " + convertToRupiah(repo.Nominal, "") + " </div>" +
                "<div class='select2-result-repository__details'><i class='icon-star'></i> " + repo.tahunAjaran + " </div>" +
                "</div>" +
                "</div></div>";

        return markup;
    }

    function formatRepoTransactionSelectionSiswaCabang(repo) {
        return (repo.NamaSiswa) ? repo.NamaSiswa : repo.NoVA;
    }

    function select2ChangeInit() {
        $(".select2-ajax-siswa-cabang").change(function () {
            var value = $(this).val();
            var index_selected = $(".select2-ajax-siswa-cabang").index(this);
            console.log(index_selected);
            $.ajax({
                url: "{{ url('refund/getTransaction') }}",
                dataType: 'json',
                data: {id: value},
                success: function (res) {
                    var row = res.results;

                    $('#form_double input[name^="nama_siswa"]').each(function (index) {
                        console.log(index);
                        if (index_selected == index) {
                            $(this).val(row.NamaSiswa);
                        }

                        if (index_selected == 0) {
                            $(".nama_siswa_double").text(row.NamaSiswa);
                        }
                    });

                    $('#form_double input[name^="va_siswa"]').each(function (index) {
                        if (index_selected == index) {
                            $(this).val(row.NoVA);
                        }

                        if (index_selected == 0) {
                            $(".va_siswa_double").text(row.NoVA);
                        }
                    });

                    $('#form_double input[name^="tgl_transfer"]').each(function (index) {
                        if (index_selected == index) {
                            $(this).val(row.TanggalTransaksi);
                        }

                    });

                    $('#form_double input[name^="nominal"]').each(function (index) {
                        if (index_selected == index) {
                            $(this).val(row.Nominal);
                        }

                    });

                    $('#form_double input[name^="tahun_ajaran"]').each(function (index) {
                        if (index_selected == index) {
                            $(this).val(row.tahunAjaran);
                        }

                    });

                    $('#form_double input[name^="TahunAjaranID"]').each(function (index) {
                        if (index_selected == index) {
                            $(this).val(row.tahunAjaranID);
                        }

                    });

                    $("#add").css("pointer-events", "auto");
                    countNominalTransfer();
                }
            });
        });
    }
    select2ChangeInit();

    $(document).ready(function () {
        $("#add").click(function () {
            $(".select2-ajax-siswa-cabang").select2("destroy");
            var trx_html = $('.trx-clone').eq(0).clone();
            $(".trx_number", trx_html).html('Transaksi #' + (trx_number + 1) + ' <span class="btn btn-default" onclick="reInitTrxClone(this)">Hapus</span>');
            trx_html.find("input:text").val("");
            trx_html.find("select").val("");
            trx_number++;
            trx_html.appendTo("#box-trx");
            if (trx_number == 2) {
                $(".box-tambah").hide();
            } else {
                $(".box-tambah").show();
            }
            //trx_html.find("select").select2();

            select2ChangeInit();
            select2Init();
            //setTimeout(select2Init, 10000);
        });
    });

    function reInitTrxClone(ini) {
        //$(ini).closest(".trx-clone").remove();
        trx_number = 1;
        var n = 0;
        $('.trx_number:gt(0)').each(function (index, tr) {
            n++;
        });
        n--;
        console.log(n);
        $('.trx-clone:gt(0)').remove();
        for (i = 0; i < n; i++) {
            var trx_html = $('.trx-clone').eq(0).clone();
            $(".trx_number", trx_html).html('Transaksi #' + (trx_number + 1) + ' <input type="radio" value="1" class="benar" name="benar[]"> <span class="btn btn-default" onclick="reInitTrxClone(this)">Hapus</span>');
            trx_number++;
            trx_html.appendTo("#box-trx");
        }
        if (trx_number == 2) {
            $(".box-tambah").hide();
        } else {
            $(".box-tambah").show();
        }

        select2Init();
        countNominalTransfer();
    }

    function countNominalTransfer() {
        var nominal_utama = 0;
        var nominal_total = 0;
        var nominal_kembali = 0;
        $('#form_double input[name^="nominal"]').each(function (index) {
            var nominal = $(this).val();
            if (index == 0) {
                nominal_utama = (nominal != "") ? nominal : nominal_utama;
            }
            if (nominal != "") {
                nominal_total = parseInt(nominal_total) + parseInt(nominal);
            }
        });
        nominal_kembali = nominal_total - parseInt(nominal_utama);
        console.log("nominal utama " + nominal_utama);
        console.log("nominal total " + nominal_total);
        console.log("nominal kembali " + nominal_kembali);

        var nominal_kembali_11_persen = (11 / 100) * nominal_kembali;
        $(".kembali_nominal_double").text(convertToRupiah(nominal_kembali));
        $(".kembali_nominal_persen_double").text(convertToRupiah(nominal_kembali_11_persen));
        $(".total_nominal_double").text(convertToRupiah(nominal_total));

        $("#form_double input[name=total_nominal]").val(nominal_total);
        $("#form_double input[name=selisih_nominal]").val(nominal_kembali);
    }

    function run3() {
        var cb = document.getElementById("cb3");
        if (document.getElementById("cekbox3").checked == true) {
            cb.disabled = false;
        } else {
            cb.disabled = true;
        }
    }

    function validasi3() {
        fCode = $('#form_double input,#form_double select,#form_double textarea');
        for (var i = 0; i < fCode.length; i++) {
            if (fCode[i].value == "" && fCode[i].type != 'hidden' && fCode[i].name != 'nosurat') {
                alert($('[name="' + fCode[i].name + '"]').attr('placeholder'));
                fCode[i].focus();
                return false;
            }
        }
        return true;
    }


</script>