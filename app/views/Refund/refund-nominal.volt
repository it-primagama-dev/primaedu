{{ content() }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">

                <!-- Input Refund -->

                {{ form("refund/createNominalRefund", "onSubmit": "return validasi2();", "method":"post",  "autocomplete" : "off","name":"form2","id":"form_nominal") }}
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
                            <div class="input-control text" data-role="input-control">
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
                        <div class="span11">
                            <label for="label" class="no-padding">Search Data Transaksi</label>
                            <div class="input-control select" data-role="input-control">
                                <select id="select2-ajax-nominal" style="width: 100%" name="TbRecID" placeholder="Search transaksi dibutuhkan"></select>
                                <input type="hidden" name="nama_siswa" id="nama_siswa">
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">KodeCabang + KodeSiswa</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("va_siswa","maxlength":"11","placeholder":"Nova dibutuhkan","readonly":"readonly") }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label">Tanggal Transfer</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("tgl_transfer","readonly":"readonly","placeholder":"Tanggal transfer dibutuhkan") }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Nominal">Nominal Salah</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("nominal_salah","placeholder":"Nominal salah dibutuhkan","readonly":"readonly","style":"text-align:right") }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Nominal">Nominal Benar</label>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" id="nominal_benar_rupiah" name="nominal_benar_rupiah" class="idrCurrency" placeholder="Nominal benar dibutuhkan">
                                <input type="hidden" id="nominal_benar" name="nominal_benar" >
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Nominal">Selisih Nominal</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("nominal_selisih","placeholder":"Selisi dibutuhkan","readonly":"readonly","style":"text-align:right") }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="TahunAjaran">Tahun Ajaran</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("tahun_ajaran","readonly":"readonly","placeholder":"Tahun ajaran dibutuhkan") }}
                                <input type="hidden" name="TahunAjaranID" id="TahunAjaranID"/>
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Keterangan">Kronologi</label>
                            <div class="input-control textarea" data-role="input-control">
                                <div class='printchatbox' style="width:100%">Telah terjadi kelebihan nominal transfer ke nomor VA <span class="va_siswa"></span> atas nama <span class="nama_siswa"></span> sebesar <span class="nominal_selisih"></span><br/><br/>Mohon dapat dilakukan refund 11% dari <span class="nominal"></span> yaitu <span class="nominal_11_persen"></span> atas kelebihan nominal transfer tersebut.</div>
                            </div>
                        </div>
                        <div class="span11" style="padding-bottom:5%;">
                            <input id="cekbox2" type='checkbox' onclick='run2();'/> Saya setuju dengan syarat dan ketentuan ini.
                        </div>
                        <div class="span11">
                            <button id='cb2' disabled type="submit">Simpan</button>
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
                    <h4>Kesalahan Transfer Kelebihan Nominal</h4>
                    <ol>
                        <li>Lengkapi form disamping setelah selesai checklist bahwa setuju dengan ketentuan yang ditetapkan dan klik tombol simpan, secara otomatis akan download surat pernyataan yang menyatakan terjadi kesalahan transfer, Kemudian surat tersebut di tanda tangan manajer cabang lalu di scan dan dikirim email ke <a href="mailto:finance@primagama.co.id?cc=endra.linardi@primagama.co.id">finance@primagama.co.id</a></li>
                        <li>Lakukan transfer kembali ke no virtual account yang benar / yang dimaksud</li>
                        <li>Mengirimkan bukti pembayaran untuk virtual account yang benar</li>
                        <li>Setelah melakukan pembayaran ke no VA yang benar / yang dimaksud baru akan kita lakukan proses refund</li>
                        <li>Proses refund kurang lebih 1 (satu) bulan</li>
                        <li>Refund hanya dapat diajukan maksimal 3 bulan dari tanggal transaksi yang salah</li>
                    </ol>
                </div>
            </div>
            <div class="span12 no-margin" id="form-cari-refund-nominal">
                <div class="panel-body sp" style="padding: 10px">
                    <h4>CARI DATA KOREKSI KELEBIHAN NOMINAL</h4>
                    <label for="label">No. Surat Pernyataan</label>
                    <div class="input-control select">
                        <div class="span9">
                            <select id="select2-ajax-refund-nominal" name="nosurat" style="width: 100%"></select>
                        </div>
                        <div class="span3">
                            <div class="btn btn-primary" onClick="lihatKoreksiKelebihanNominal()"><i class="fa fa-search"></i> Lihat</div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>

    function lihatKoreksiKelebihanNominal() {
        var id = $("#select2-ajax-refund-nominal").val();
        if (id == "" || id == undefined) {
            alert("Silahkan Isi No. Surat Pernyataan");
        } else {
            window.location.href = base_url + "refund/lihatRefundNominal?id=" + id;
        }
    }
    
    $('#select2-ajax-refund-nominal').select2({
        ajax: {
            url: "{{ url('refund/searchRefund') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page,
                    jenisRefund: 'Refund Nominal',
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
        templateResult: formatRepoRefundNominal,
        templateSelection: formatRepoSelectionRefundNominal
    });

    function formatRepoRefundNominal(repo) {
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

    function formatRepoSelectionRefundNominal(repo) {
        return repo.NoSuratPernyataan;
    }

    $('#select2-ajax-nominal').select2({
        minimumInputLength: 4,
        ajax: {
            url: "{{ url('refund/searchTransactionSiswaCabang') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page,
                    return: "all_column"
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

    $("#select2-ajax-nominal").change(function () {
        var value = $(this).val();
        $.ajax({
            url: "{{ url('refund/getTransaction') }}",
            dataType: 'json',
            data: {id: value},
            success: function (res) {
                var row = res.results;
                $("#form_nominal #TbRecID").val(row.RecID);
                $('#form_nominal #va_siswa').val(row.NoVA);
                $('#form_nominal #nama_siswa').val(row.NamaSiswa);
                $('#form_nominal #tgl_transfer').val(row.TanggalTransaksi);
                $('#form_nominal #nominal_salah').val(row.Nominal);
                $('#form_nominal #tahun_ajaran').val(row.tahunAjaran);
                $('#form_nominal #TahunAjaranID').val(row.tahunAjaranID);

                $('#form_nominal .va_siswa').text(row.NoVA);
                $('#form_nominal .nama_siswa').text(row.NamaSiswa);
                $('#form_nominal .nominal').text(convertToRupiah(row.Nominal));
                var nominal_11_persen = (11 / 100) * row.Nominal;
                $('#form_nominal .nominal_11_persen').text(convertToRupiah(isNaN(nominal_11_persen) ? 0 : nominal_11_persen));

            }
        });
    });

    function run2() {
        var cb2 = document.getElementById("cb2");

        if (document.getElementById("cekbox2").checked == true) {
            cb2.disabled = false;
        } else {
            cb2.disabled = true;
        }
    }
    function validasi2() {
        fCode = $('#form_nominal input,#form_nominal select,#form_nominal textarea');
        for (var i = 0; i < fCode.length; i++) {
            if (fCode[i].value == "" && fCode[i].type != 'hidden' && fCode[i].name != 'nosurat') {
                alert($('[name="' + fCode[i].name + '"]').attr('placeholder'));
                fCode[i].focus();
                return false;
            }
        }
        return true;
    }

    $('#form_nominal #nominal_benar_rupiah').keyup(function (event) {
        var nominal_salah = parseInt($("#form_nominal #nominal_salah").val());
        var nominal_benar = parseInt(convertToAngka($(this).val()));
        var nominal_selisih = nominal_salah - nominal_benar;
        var nominal_selisih_rupiah = convertToRupiah(isNaN(nominal_selisih) ? 0 : nominal_selisih);
        $('#form_nominal .nominal_selisih').text(nominal_selisih_rupiah);
        $('#form_nominal #nominal_selisih').val(nominal_selisih_rupiah);
        $('#form_nominal #nominal_benar').val(nominal_benar);
        console.log("Nominal salah : " + nominal_salah);
        console.log("Nominal benar : " + nominal_benar);
        console.log("Nominal Selisih : " + nominal_selisih);

        if (nominal_benar > nominal_salah) {
            alert("Nominal benar tidak boleh lebih besar dari nominal salah");
            $("#form_nominal #nominal_benar").val("");
            $('#form_nominal #nominal_selisih').val("");
            $('#form_nominal .nominal_selisih').text("");
            $(this).val("");
        }
    });
</script>