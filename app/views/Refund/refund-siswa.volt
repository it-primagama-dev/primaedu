{{ content() }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">

                <!-- Input Refund -->

                {{ form("refund/createSiswaRefund", "onSubmit": "return validasi();", "method":"post",  "autocomplete" : "off","name":"form","id":"form_siswa") }}
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
                                {{ text_field("telpcabang","maxlength":"12","onkeyup":"angka(this);","placeholder":"Telp Cabang dibutuhkan","value":areaCabang.NoTelp) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label">Alamat Cabang Terbaru</label>
                            <div class="input-control textarea" data-role="input-control">
                                {{ text_area("alamatcabang","placeholder":"Alamat Cabang dibutuhkan","value":areaCabang.Alamat) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Search Data Transaksi Salah</label>
                            <div class="input-control select" data-role="input-control">
                                <select id="select2-ajax-siswa" name="TbRecID" placeholder="Search transaksi dibutuhkan"></select>
                                <input type="hidden" name="nama_siswa_salah" id="nama_siswa_salah">
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">KodeCabang + KodeSiswa Salah</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("va_siswa_salah","readonly":"readonly","placeholder":"NoVa Salah dibutuhkan") }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Kodecabang + KodeSiswa Benar</label>
                            <div class="input-control select" data-role="input-control">
                                <select id="select2-ajax-siswa-cabang" name="novabenar" placeholder="NoVa benar dibutuhkan"></select>
                                <input type="hidden" name="nama_siswa_benar" id="nama_siswa_benar">
                                <input type="hidden" name="va_siswa_benar" id="va_siswa_benar">
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label">Tanggal Transfer </label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("tanggaltransfer","readonly":"readonly","placeholder":"Tanggal transfer dibutuhkan") }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Nominal">Jumlah yang di transfer</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("nominal","readonly":"readonly","placeholder":"Nominal dibutuhkan") }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="TahunAjaran">Tahun Ajaran</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("TahunAjaran","readonly":"readonly","placeholder":"Tahun ajaran dibutuhkan") }}
                                <input type="hidden" name="TahunAjaranID" id="TahunAjaranID"/>
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Keterangan">Kronologi</label>
                            <div class="input-control textarea" data-role="input-control">
                                <div class='printchatbox'>Telah terjadi kesalahan transfer dengan nomor VA <span class="va_siswa_salah"></span> atas nama <span class="nama_siswa_salah"></span> seharusnya transfer ke nomor VA <span class="va_siswa_benar"></span> atas nama <span class="nama_siswa_benar"></span> sejumlah <span class="nominal"></span><br/><br/>Mohon dapat dilakukan refund 11% <span class="nominal_11_persen"></span> atas kesalahan transfer tersebut.</div>
                            </div>
                        </div>
                        <div class="span11" style="padding-bottom:5%;">
                            <input id="cekbox" type='checkbox' onclick="run();"> Saya setuju dengan syarat dan ketentuan ini.
                        </div>
                        <div class="span11">
                            <button id='cb' disabled type="submit">Simpan</button>
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
                    <h4>Kesalahan Transfer Masuk Ke Siswa Lain/Siswa Cab. Lain</h4>
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
            <div class="span12 no-margin" id="form-cari-refund-siswa">
                <div class="panel-body sp" style="padding: 10px">
                    <h4>CARI DATA KOREKSI VA SISWA</h4>
                    <label for="label">No. Surat Pernyataan</label>
                    <div class="input-control select">
                        <div class="span9">
                            <select id="select2-ajax-refund-siswa" name="nosurat" style="width: 100%"></select>
                        </div>
                        <div class="span3">
                            <div class="btn btn-primary" onClick="lihatKoreksiVaSiswa()"><i class="fa fa-search"></i> Lihat</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /*$('#select2-ajax-siswa').select2({
     minimumInputLength: 4,
     ajax: {
     url: "{{ url('refund/searchTransaction') }}",
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
    function lihatKoreksiVaSiswa() {
        var id = $("#select2-ajax-refund-siswa").val();
        if (id == "" || id == undefined) {
            alert("Silahkan Isi No. Surat Pernyataan");
        } else {
            window.location.href = base_url + "refund/lihatRefundSiswa?id=" + id;
        }
    }
    
    $('#select2-ajax-refund-siswa').select2({
        ajax: {
            url: "{{ url('refund/searchRefund') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page,
                    jenisRefund: 'Refund Siswa',
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
        templateResult: formatRepoRefundSiswa,
        templateSelection: formatRepoSelectionRefundSiswa
    });

    function formatRepoRefundSiswa(repo) {
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
        if(repo.TrackFinance != null){
            markup += "<div style='display: flex'>" +
                "<div style='flex: 50%; padding: 1px;'>Finance</div>" +
                "<div style='flex: 50%; padding: 1px; text-align:right'>" + repo.TrackFinance + "</div>" +
                "</div>";
        }
        markup += "</div></div></div>";

        return markup;
    }

    function formatRepoSelectionRefundSiswa(repo) {
        return repo.NoSuratPernyataan;
    }

    $('#select2-ajax-siswa').select2({
        ajax: {
            url: "{{ url('refund/searchTransaction') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
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
        templateResult: formatRepoSiswa,
        templateSelection: formatRepoSelectionSiswa
    });

    function formatRepoSiswa(repo) {
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

    function formatRepoSelectionSiswa(repo) {
        return (repo.NamaSiswa) ? repo.NamaSiswa : repo.NoVA;
    }

    $("#select2-ajax-siswa").change(function () {
        var value = $(this).val();
        $.ajax({
            url: "{{ url('refund/getTransaction') }}",
            dataType: 'json',
            data: {id: value},
            success: function (res) {
                var row = res.results;
                $("#form_siswa #TbRecID").val(row.RecID);
                $('#form_siswa #va_siswa_salah').val(row.NoVA);
                $('#form_siswa #tanggaltransfer').val(row.TanggalTransaksi);
                $('#form_siswa #nominal').val(row.Nominal);
                $('#form_siswa #TahunAjaran').val(row.tahunAjaran);
                $('#form_siswa #TahunAjaranID').val(row.tahunAjaranID);
                $("#form_siswa #nama_siswa_salah").val(row.NamaSiswa);

                $('#form_siswa .va_siswa_salah').text(row.NoVA);
                $('#form_siswa .nama_siswa_salah').text(row.NamaSiswa);
                $('#form_siswa .nominal').text(convertToRupiah(row.Nominal));

                var nominal_11_persen = (11 / 100) * row.Nominal;
                $('#form_siswa .nominal_11_persen').text(convertToRupiah(nominal_11_persen));
            }
        });
    });

    $('#select2-ajax-siswa-cabang').select2({
        minimumInputLength: 4,
        ajax: {
            url: "{{ url('refund/searchSiswaCabang') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
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
        templateResult: formatRepoSiswaCabang,
        templateSelection: formatRepoSelectionSiswaCabang
    });

    function formatRepoSiswaCabang(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.NoVa + "</div>";

        if (repo.NamaSiswa) {
            markup += "<div class='select2-result-repository__description'>" + repo.NamaSiswa + "</div>";
        }

        markup += "</div></div>";

        return markup;
    }

    function formatRepoSelectionSiswaCabang(repo) {
        return repo.NoVa;
    }

    $("#select2-ajax-siswa-cabang").change(function () {
        var value = $(this).val();
        $.ajax({
            url: "{{ url('refund/getSiswaCabang') }}",
            dataType: 'json',
            data: {id: value},
            success: function (res) {
                var row = res.results;
                $("#nama_siswa_benar").val(row.NamaSiswa);
                $("#va_siswa_benar").val(row.NoVA);
                $(".nama_siswa_benar").text(row.NamaSiswa);
                $(".va_siswa_benar").text(row.NoVA);

            }
        });
    });

    function run() {
        var cb = document.getElementById("cb");
        if (document.getElementById("cekbox").checked == true) {
            cb.disabled = false;
        } else {
            cb.disabled = true;
        }
    }

    function validasi() {
        fCode = $('#form_siswa input,#form_siswa select,#form_siswa textarea');
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