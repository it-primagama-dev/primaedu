{{ content() }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">

                <!-- Input Refund -->
                <!-- Input Refund -->
                {{ form("refund/createCabangRefund", "onSubmit": "return validasi4();", "method":"post",  "autocomplete" : "off","name":"form_cabang", "id":"form_cabang") }}
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
                                {{ text_area("alamatcabang","placeholder":"Alamat Cabang dibutuhkan", "value":areaCabang.Alamat) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Tipe Transaksi Salah</label>
                            <div class="input-control select" data-role="input-control">
                                <select name="jenis_transaksi" id="jenis_transaksi" style="width:100%">
                                    
                                    {% for key,value in tipeTransaksiList %}
                                        <option value="{{key}}">{{value}}</option>
                                    {% endfor %}
                                </select>
                            </div>
                        </div>
                        <!--<div class="span11 transaksi-salah" style="display:none">-->
                        <div class="span11 transaksi-salah">
                            <label for="label" class="no-padding">Search Data Transaksi Salah<br/></label>
                            <div class="input-control select" data-role="input-control">
                                <select style="width:100%" class="select2-ajax-cabang" maxlength="11" name="TbRecID" placeholder="Search transaksi dibutuhkan"></select>
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Kode VA Salah</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("va_cabang","maxlength":"11","placeholder":"Kode VA Salah dibutuhkan","readonly":"readonly") }}
                                <input type="hidden" id="nama_cabang">
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label">Tanggal Transfer</label>
                            <!--<div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">-->
                            <div class="input-control text">
                                {{ text_field("tgl_transfer","readonly":"readonly","placeholder":"Tanggal transfer dibutuhkan") }}
                            </div>
                        </div>

                        <div class="span11">
                            <label for="Nominal">Nominal Disetor</label>
                            <div class="input-control text" data-role="input-control">
                                <!--{{ text_field("nominal","readonly:readonly", "class":"idrCurrency", "placeholder": "Nominal yang Disetorkan") }}-->
                                {{ text_field("nominal", "readonly":"readonly", "placeholder": "Nominal yang Disetorkan") }}
                                <input type="hidden" name="nominal_disetor" id="nominal_disetor">
                            </div>
                        </div>

                        <div class="span11">
                            <label for="label">Jenis Pengalihan</label>
                            <div class="input-control select" data-role="input-control">
                                <select name="jenis_pengalihan" id="jenis_pengalihan" style="width:100%">
                                    <option value="0">-- Pilih --</option>
                                    {% for key,value in jenisPengalihanList %}
                                        <option value="{{key}}">{{value}}</option>
                                    {% endfor %}
                                    
                                </select>
                            </div>
                            <input type="hidden" name="jenis_pengalihan_text" id="jenis_pengalihan_text">
                        </div>

                        <div class="span11">
                            <label for="Keterangan">Kronologi</label>
                            <div class="input-control textarea" data-role="input-control">
                                <div class='printchatbox'>Sehubungan telah terjadinya kesalahan transfer dengan VA <span class="va_cabang"></span> sebesar <span class="nominal"></span> maka kami minta dialihkan untuk <span class="jenis_pengalihan"></span></div>
                            </div>
                        </div>
                        <div class="span11" style="padding-bottom:5%;">
                            <input id="cekbox4" type='checkbox' onclick='run4();'/> Saya setuju dengan syarat dan ketentuan ini.
                        </div>
                        <div class="span11">
                            <button id='cb4' disabled type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
                {{ end_form() }}
                <!-- Input Refund -->
                <!-- Input Refund -->

            </div>
        </div>
        <div class="span6">
            <div class="span12 no-margin">
                <div class="panel-body sp" style="padding: 10px">
                    <h4>PROSEDUR DEPOSIT</h4>
                    <!--<h4>Kesalahan Transfer atau Kelebihan Pembayaran</h4>-->
                    <ol>
                        <li>Lengkapi form disamping setelah selesai checklist bahwa setuju dengan ketentuan yang ditetapkan dan klik tombol simpan, secara otomatis akan download surat pernyataan yang menyatakan terjadi kesalahan transfer, Kemudian surat tersebut di tanda tangan manajer cabang lalu di scan dan dikirim email ke <a href="mailto:finance@primagama.co.id?cc=endra.linardi@primagama.co.id">finance@primagama.co.id</a></li>
                        <li>Lakukan transfer kembali ke no virtual account yang benar / yang dimaksud</li>
                        <li>Mengirimkan bukti pembayaran untuk virtual account yang benar</li>
                        <li>Setelah melakukan pembayaran ke no VA yang benar / yang dimaksud baru akan kita lakukan proses deposit</li>
                        <li>Proses Deposit kurang lebih 1 (satu) bulan</li>
                        <li>Refund hanya dapat diajukan maksimal 3 bulan dari tanggal transaksi yang salah</li>
                        <li>Pengalokasian deposit smartbook/buku hanya dapat digunakan 80% dari total tagihan dan sisanya dapat digunakan untuk pembelian selanjutnya</li>
                    </ol>
                </div>
            </div>
            <div class="span12 no-margin" id="form-cari-refund-cabang">
                <div class="panel-body sp" style="padding: 10px">
                    <h4>CARI DATA KOREKSI DEPOSIT</h4>
                    <label for="label">No. Surat Pernyataan</label>
                    <div class="input-control select">
                        <div class="span9">
                            <select id="select2-ajax-refund-cabang" name="nosurat" style="width: 100%"></select>
                        </div>
                        <div class="span3">
                            <div class="btn btn-primary" onClick="lihatKoreksiDeposit()"><i class="fa fa-search"></i> Lihat</div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        //var branchCode = "{{kdcabang}}";
        //$("#form_cabang #va_cabang").val(branchCode);
        //$("#form_cabang .va_cabang").text(branchCode);
        $("#form_cabang #jenis_transaksi").change(function () {
            resetForm();
            var value = $(this).val();
            if (value == "1") {//global
                //manual input
                //$("#form_cabang .transaksi-salah").hide();
                //$("#form_cabang #va_cabang").val(branchCode);
                $("#form_cabang #va_cabang").prop('readonly', false);
                $("#form_cabang .transaksi-salah").show();
                $("#form_cabang #va_cabang").prop('readonly', true);
                $("#form_cabang #jenis_pengalihan").val("0");
                $('#form_cabang #jenis_pengalihan option:not(:selected)').prop('disabled', false);
                $("#form_cabang #jenis_pengalihan_text").val("");
            } else {
                $("#form_cabang .transaksi-salah").show();
                $("#form_cabang #va_cabang").prop('readonly', true);
                //$("#form_cabang #nominal").prop('readonly', true);

                if (value == "2") {
                    $("#form_cabang #jenis_pengalihan").val("1");
                }
                if (value == "3") {
                    $("#form_cabang #jenis_pengalihan").val("2");
                }
                $('#form_cabang #jenis_pengalihan option:not(:selected)').prop('disabled', true);

                var txt = $("#form_cabang #jenis_pengalihan").find('option:selected').text();
                $('#form_cabang .jenis_pengalihan').text(txt);
                $("#form_cabang #jenis_pengalihan_text").val(txt);
            }
        });
        $("#form_cabang #va_cabang").keyup(function () {
            var val = $(this).val();
            $('#form_cabang .va_cabang').text(val);
        });
        /*
        $("#form_cabang #nominal").keyup(function () {
            var val = $(this).val();
            $('#form_cabang #nominal_disetor').val(convertToAngka(val));
            $('#form_cabang .nominal').text(val);
        });
    */
        $("#form_cabang #jenis_pengalihan").change(function () {
            var val = $(this).val();
            var txt = $(this).find('option:selected').text();
            $('#form_cabang .jenis_pengalihan').text(txt);
            $("#form_cabang #jenis_pengalihan_text").val(txt);
        });
    });
    
    function lihatKoreksiDeposit() {
        var id = $("#select2-ajax-refund-cabang").val();
        if (id == "" || id == undefined) {
            alert("Silahkan Isi No. Surat Pernyataan");
        } else {
            window.location.href = base_url + "refund/lihatRefundCabang?id=" + id;
        }
    }
    
    $('#select2-ajax-refund-cabang').select2({
        ajax: {
            url: "{{ url('refund/searchRefund') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page,
                    jenisRefund: 'Deposite',
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
        templateResult: formatRepoRefundCabang,
        templateSelection: formatRepoSelectionRefundCabang
    });

    function formatRepoRefundCabang(repo) {
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

    function formatRepoSelectionRefundCabang(repo) {
        return repo.NoSuratPernyataan;
    }

    function resetForm() {
        $("#form_cabang #va_cabang").val("");
        $("#form_cabang #tgl_transfer").val("");
        $("#form_cabang #nominal").val("");
        $("#form_cabang #nominal_disetor").val("");
        $("#form_cabang .va_cabang").text("");
        $("#form_cabang .nominal").text("");
        $("#form_cabang .jenis_pengalihan").text("");
    }

    $("#form_cabang #jenis_transaksi").select2();
    //$("#form_cabang #jenis_deposit").select2();
    function select2Init() {
        $('.select2-ajax-cabang').select2({
            ajax: {
                url: "{{ url('refund/searchTransactionCabang') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page,
                        type: $("#form_cabang #jenis_transaksi").val(),
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
            templateResult: formatRepoTransactionCabang,
            templateSelection: formatRepoTransactionSelectionCabang
        });
    }
    select2Init();

    function formatRepoTransactionCabang(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.NoVA + "</div>";

        if (repo.NamaAreaCabang) {
            markup += "<div class='select2-result-repository__description'>" + repo.NamaAreaCabang + "</div>";
        }

        markup += "<div class='select2-result-repository__footer'>" +
                "<div class='select2-result-repository__details'><i class='icon-clock'></i> " + repo.TanggalTransaksi + " </div>" +
                "<div class='select2-result-repository__details'>Rp. " + convertToRupiah(repo.Nominal, "") + " </div>" +
                "</div>" +
                "</div></div>";

        return markup;
    }

    function formatRepoTransactionSelectionCabang(repo) {
        return (repo.NamaAreaCabang) ? repo.NamaAreaCabang : repo.NoVA;
    }

    $('.select2-ajax-cabang').change(function () {
        var value = $(this).val();
        $.ajax({
            url: "{{ url('refund/getTransactionCabang') }}",
            dataType: 'json',
            data: {id: value},
            success: function (res) {
                var row = res.results;
                $("#form_cabang #TbRecID").val(row.RecID);
                $('#form_cabang #va_cabang').val(row.NoVA);
                $('#form_cabang #nama_cabang').val(row.NamaAreaCabang);
                $('#form_cabang #tgl_transfer').val(row.TanggalTransaksi);
                $('#form_cabang #nominal').val(convertToRupiah(row.Nominal));
                $('#form_cabang #nominal_disetor').val(row.Nominal);

                $('#form_cabang .va_cabang').text(row.NoVA);
                $('#form_cabang .nominal').text(convertToRupiah(row.Nominal));

                console.log(row.Nominal);

            }
        });
    })

    /*$('#form_cabang #jenis_deposit').change(function (event) {
        var value = $(this).val();
        if (value == '0')
        {
            $('#form_cabang .jenis_deposit').text("");
        }
        if (value == '1')
        {
            $('#form_cabang .jenis_deposit').text("pembayaran ongkir / MD / RFID");
        }
        if (value == '2')
        {
            $('#form_cabang .jenis_deposit').text("pembelian buku selanjutnya");
        }
        if (value == '3')
        {
            $('#form_cabang .jenis_deposit').text("franchise");
        }
    });*/

    function run4() {
        var cb4 = document.getElementById("cb4");

        if (document.getElementById("cekbox4").checked == true) {
            cb4.disabled = false;
        } else {
            cb4.disabled = true;
        }
    }

    function validasi4() {
        fCode = $('#form_cabang input,#form_cabang select,#form_cabang textarea');
        for (var i = 0; i < fCode.length; i++) {
            if (fCode[i].value == "" && fCode[i].type != 'hidden' && fCode[i].name != 'nosurat' && fCode[i].name != 'TbRecID') {
                alert($('[name="' + fCode[i].name + '"]').attr('placeholder'));
                fCode[i].focus();
                return false;
            }
        }
        return true;
    }
</script>