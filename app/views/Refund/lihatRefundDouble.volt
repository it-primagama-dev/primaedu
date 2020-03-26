<h1>
    <form action="downloadSurat/{{NoSuratPernyataan}}" method="POST">
        {{ link_to("refund", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }} KOREKSI TRANSFER DOUBLE 
        <button type="submit" style="background:none;font-size:24px;font-weight:bold">{{ NoSuratPernyataan }}</button>
    </form>
</h1>

{{ content() }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">
                <!-- Input Refund -->
                {{ form("refund/updateDoubleRefund", "onSubmit": "return validasi();", "method":"post",  "autocomplete" : "off","name":"form","id":"form_double") }}
                <input type="hidden" name="NoSuratPernyataan" value="{{NoSuratPernyataan}}">
                <input type="hidden" name="RefundRecID" value="{{RefundRecID}}">
                <div class="grid fluid">
                    <div class="row">
                        <div class="span11">
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Nama Pembuat Pernyataan</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("namapembuatpernyataan","placeholder":"Nama Pembuat Pernyataan dibutuhkan", "value":NamaPembuatPernyataan, "class":"listen-on-keyup", "data-old":NamaPembuatPernyataan) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Jabatan Pembuat Pernyataan</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("jabatanpembuatpernyataan","placeholder":"Jabatan Pembuat Pernyataan dibutuhkan", "value":JabatanPembuatPernyataan, "class":"listen-on-keyup", "data-old":JabatanPembuatPernyataan) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Telp Cabang Terbaru</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("telpcabang","maxlength":"12","onkeyup":"angka(this);","placeholder":"Telp Cabang dibutuhkan","value":TelpCabang, "class":"listen-on-keyup", "data-old":TelpCabang) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label">Alamat Cabang Terbaru</label>
                            <div class="input-control textarea" data-role="input-control">
                                {{ text_area("alamatcabang","placeholder":"Alamat Cabang dibutuhkan","value":AlamatCabang, "class":"listen-on-keyup", "data-old":AlamatCabang) }}
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
                                            <div class="input-control select" data-role="input-control" style="display: none" id="input-transaksi-1">
                                                <select style="width:100%" class="select2-ajax-siswa-cabang" maxlength="11" name="TbRecID[]" placeholder="Search transaksi dibutuhkan"></select>
                                                <input type="hidden" name="TransaksiBankRecID[]" class="TransaksiBankRecID" value="{{TransaksiBankRecID}}">
                                                <input type="hidden" name="nama_siswa[]" class="input_nama_siswa" value="{{NamaSiswa}}">
                                            </div>
                                            <div class="input-control text" data-role="input-control" id="input-transaksi-1-tmp">
                                                <input style="width:90% !important" readonly="readonly" type="text" name="nama_siswa_tmp" class="nama_siswa_tmp" value="{{NamaSiswa}}">
                                                <span style="width:9% !important; float: right" class="btn btn-default" id="close-transaksi-1">X</span>
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label" class="no-padding">Kode Cabang + Kode Siswa</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" class="input_va_siswa" name="va_siswa[]" maxlength="11" placeholder="Nova dibutuhkan" readonly="readonly" value="{{NoVA}}">
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label">Tanggal Transfer</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="tgl_transfer[]" class="input_tgl_transfer" placeholder="Tanggal transfer dibutuhkan" readonly="readonly" value="{{TanggalTransaksi}}">
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label">Nominal</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="nominal[]" class="input_nominal" placeholder="Nominal transfer dibutuhkan" readonly="readonly" value="{{Nominal}}">
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label">Tahun Ajaran</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="tahun_ajaran[]" class="input_tahun_ajaran" placeholder="Tahun ajaran dibutuhkan" readonly="readonly" value="{{TahunAjaranName}}">
                                                <input type="hidden" name="TahunAjaranID[]" class="TahunAjaranID" value="{{TahunAjaranID}}"/>
                                            </div>
                                        </div>

                                        <div class="span11">
                                            <h2 class="trx_number">Transaksi #2</h2>
                                            <label for="label" class="no-padding">Search Data Transaksi</label>
                                            <div class="input-control select" data-role="input-control" style="display: none" id="input-transaksi-2">
                                                <select style="width:100%" class="select2-ajax-siswa-cabang" maxlength="11" name="TbRecID[]" placeholder="Search transaksi dibutuhkan"></select>
                                                <input type="hidden" name="TransaksiBankRecID[]" class="TransaksiBankRecID" value="{{TransaksiBankRecIDSecondary}}">
                                                <input type="hidden" name="nama_siswa[]" class="input_nama_siswa" value="{{NamaSiswaSecondary}}">
                                            </div>
                                            <div class="input-control text" data-role="input-control" id="input-transaksi-2-tmp">
                                                <input style="width:90% !important" readonly="readonly" type="text" name="nama_siswa_tmp" class="nama_siswa_tmp" value="{{NamaSiswaSecondary}}">
                                                <span style="width:9% !important; float: right" class="btn btn-default" id="close-transaksi-2">X</span>
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label" class="no-padding">Kode Cabang + Kode Siswa</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" class="input_va_siswa" name="va_siswa[]" maxlength="11" placeholder="Nova dibutuhkan" readonly="readonly" value="{{NoVASecondary}}">
                                                
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label">Tanggal Transfer</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="tgl_transfer[]" class="input_tgl_transfer" placeholder="Tanggal transfer dibutuhkan" readonly="readonly" value="{{TanggalTransaksiSecondary}}">
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label">Nominal</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="nominal[]" class="input_nominal" placeholder="Nominal transfer dibutuhkan" readonly="readonly" value="{{NominalSecondary}}">
                                            </div>
                                        </div>
                                        <div class="span11">
                                            <label for="label">Tahun Ajaran</label>
                                            <div class="input-control text" data-role="input-control">
                                                <input type="text" name="tahun_ajaran[]" class="input_tahun_ajaran" placeholder="Tahun ajaran dibutuhkan" readonly="readonly" value="{{TahunAjaranName}}">
                                                <input type="hidden" name="TahunAjaranID[]" class="TahunAjaranID" value="{{TahunAjaranID}}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="span11">
                            <label for="label">Total Nominal</label>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" name="total_nominal" id="total_nominal" placeholder="Total Nominal transfer dibutuhkan" readonly="readonly" value="{{LebihNominal}}">
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label">Selisih Nominal</label>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" name="selisih_nominal" id="selisih_nominal" placeholder="Selisih Nominal transfer dibutuhkan" readonly="readonly" value="{{SelisihNominal}}">
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Keterangan">Kronologi</label>
                            <div class="input-control textarea" data-role="input-control">
                                <div class='text-box'>Telah terjadi double transfer ke nomor VA <span class="va_siswa"></span> atas nama <span class="nama_siswa"></span> sebesar <span class="nominal_total"></span><br/><br/>Mohon dapat dilakukan refund 11% dari <span class="nominal"></span> yaitu <span class="nominal_11_persen"></span> atas double transfer tersebut.</div>
                            </div>
                        </div>
                            
                        {%if TrackAccountReceivable == 'PENDING'%}
                            <div class="span11" style="padding-bottom:5%;">
                                <input id="cekbox" type='checkbox' onclick="run();"> Saya setuju dengan syarat dan ketentuan ini.
                            </div>
                            <div class="span11">
                                <button id='cb' disabled type="submit">Simpan</button>
                            </div>
                        {%endif%}
                    </div>
                </div>
                {{ end_form() }}


                <!-- Input Refund -->

            </div>
        </div>
        <div class="span6">
            <div class="span12 no-margin">
                <div class="panel-body sp" style="padding: 10px">
                    <h4>STATUS APPROVAL</h4>
                    <table class="table bordered hovered" id="header">
                        <thead>
                            <tr>
                                <th bgcolor="#000080"><font Color="#FFFFFF"><b> No. </font></th>
                                <th bgcolor="#000080"> <font Color="#FFFFFF"><b> Description </font></th>
                                <th bgcolor="#000080"><font Color="#FFFFFF"><b> Shipment Status</font></th>
                                <th bgcolor="#000080"><font Color="#FFFFFF"><b> Date</font></th>
                                <th bgcolor="#000080"><font Color="#FFFFFF"><b> Time</font></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td  bgcolor="#FFFFCC">1</td>
                                <td  bgcolor="#FFFFCC"><b>Account Receivable</b></td>
                                <td style="text-align:center">{% if TrackAccountReceivable=="REJECTED" %} {{TrackAccountReceivable}} <br/>({{Keterangan}}) {% else %} {{TrackAccountReceivable}} {% endif %}</td>
                                <td style="text-align:center">{% if TrackAccountReceivable=="PENDING" %} - {% else %} {{ tgl }} {% endif %}</td>
                                <td style="text-align:center">{% if TrackAccountReceivable=="PENDING" %} - {% else %} {{ jam }} {% endif %}</td>
                            </tr>
                            <tr>
                                <td  bgcolor="#FFFFCC">2</td>
                                <td  bgcolor="#FFFFCC"><b>Finance</b></td>
                                <td style="text-align:center">{% if TrackFinance=="REJECTED" %} {{TrackFinance}} <br/>({{KeteranganGM}}) {% else %} {{TrackFinance}} {% endif %}</td>
                                <td style="text-align:center">{% if TrackFinance=="PENDING" %} - {% else %} {{ tglGM }} {% endif %}</td>
                                <td style="text-align:center">{% if TrackFinance=="PENDING" %} - {% else %} {{ jamGM }} {% endif %}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="span12 no-margin">
                <div class="panel-body sp" style="padding: 10px">
                    <h4>SURAT PERNYATAAN</h4>
                    <div class="btn btn-primary" onClick="downloadSurat()"><i class="fa fa-download"></i> Download</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#form_double #cekbox").prop("disabled", true);
        
        $('.listen-on-keyup').keyup(function () {
            delay(function () {
                listenerOnKeyup();
            }, 1000);
        });
    });
    
    function listenerOnKeyup() {
        var inputs = $(".listen-on-keyup");
        for (var i = 0; i < inputs.length; i++) {
            var old_val = $(inputs[i]).attr("data-old");
            var new_val = $(inputs[i]).val();
            console.log("old : " + old_val + ", new : " + new_val);
            if (old_val != new_val) {
                $("#form_double #cekbox").prop("disabled", false);
                break;
            } else {
                $("#form_double #cekbox").prop("disabled", true);
            }
        }
    }
    
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
                    //console.log(index);
                    if (index_selected == index) {
                        $(this).val(row.NamaSiswa);
                    }

                    if (index_selected == 0) {
                        $(".nama_siswa").text(row.NamaSiswa);
                    }
                });

                $('#form_double input[name^="va_siswa"]').each(function (index) {
                    if (index_selected == index) {
                        $(this).val(row.NoVA);
                    }

                    if (index_selected == 0) {
                        $(".va_siswa").text(row.NoVA);
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
                
                $('#form_double input[name^="TransaksiBankRecID"]').each(function (index) {
                    if (index_selected == index) {
                        $(this).val(row.RecID);
                    }

                });
                
                countNominalTransfer();
            }
        });
    });
    
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
        $("#form_double .nominal").text(convertToRupiah(nominal_kembali));
        $("#form_double .nominal_11_persen").text(convertToRupiah(nominal_kembali_11_persen));
        $("#form_double .nominal_total").text(convertToRupiah(nominal_total));

        $("#form_double input[name=total_nominal]").val(nominal_total);
        $("#form_double input[name=selisih_nominal]").val(nominal_kembali);
    }
    
    $('#form_double #close-transaksi-1').click(function () {
        $("#form_double #input-transaksi-1").show();
        $("#form_double #input-transaksi-1-tmp").hide();
        $("#form_double #input-transaksi-2").show();
        $("#form_double #input-transaksi-2-tmp").hide();
        //reset
        resetTransaksi();
        $("#form_double #cekbox").prop("disabled", false);
    });
    
    $('#form_double #close-transaksi-2').click(function () {
        $("#form_double #input-transaksi-2").show();
        $("#form_double #input-transaksi-2-tmp").hide();
        //reset
        resetTransaksiSecondary();
        $("#form_double #cekbox").prop("disabled", false);
    });
    
    function resetTransaksi() {
        $("#form_double .TransaksiBankRecID").eq(0).val("");
        $('#form_double .input_va_siswa').eq(0).val("");
        $('#form_double .input_nama_siswa').eq(0).val("");
        $('#form_double .input_tgl_transfer').eq(0).val("");
        $('#form_double .input_nominal').eq(0).val("");
        $('#form_double .input_tahun_ajaran').eq(0).val("");
        $('#form_double .TahunAjaranID').eq(0).val("");
        resetTransaksiSecondary();
        $('#form_double #total_nominal').val("");
        $('#form_double #selisih_nominal').val("");
        resetKronologi();
    }
    
    function resetTransaksiSecondary(){
        $("#form_double .TransaksiBankRecID").eq(1).val("");
        $('#form_double .input_va_siswa').eq(1).val("");
        $('#form_double .input_nama_siswa').eq(1).val("");
        $('#form_double .input_tgl_transfer').eq(1).val("");
        $('#form_double .input_nominal').eq(1).val("");
        $('#form_double .input_tahun_ajaran').eq(1).val("");
        $('#form_double .TahunAjaranID').eq(1).val("");
    }
    
    function resetKronologi() {
        $('#form_double .va_siswa').text("");
        $('#form_double .nama_siswa').text("");
        $('#form_double .nominal_total').text("");
        $('#form_double .nominal').text("");
        $('#form_double .nominal_11_persen').text("");
    }
    
    function initData() {
        $('#form_double .va_siswa').text("{{NoVa}}");
        $('#form_double .nama_siswa').text("{{NamaSiswa}}");
        $('#form_double .nominal_total').text(convertToRupiah({{LebihNominal}}));
        $('#form_double .nominal').text(convertToRupiah({{Nominal}}));
        var nominal_11_persen = (11 / 100) * {{Nominal}};
        $('#form_double .nominal_11_persen').text(convertToRupiah(nominal_11_persen));
    }
    
    initData();
    
    function downloadSurat() {
        var noSurat = "{{NoSuratPernyataan}}";
        if (noSurat != "") {
            location.href = base_url + 'refund/downloadSurat/' + noSurat;
        }
    }
    
    function run() {
        var cb = document.getElementById("cb");

        if (document.getElementById("cekbox").checked == true) {
            cb.disabled = false;
        } else {
            cb.disabled = true;
        }
    }
    
    function validasi() {
        fCode = $('#form_double input,#form_double select,#form_double textarea');
        for (var i = 0; i < fCode.length; i++) {
            if (fCode[i].value == "" && fCode[i].type != 'hidden' && fCode[i].name != 'nosurat' && fCode[i].name != 'TbRecID[]') {
                alert($('[name="' + fCode[i].name + '"]').attr('placeholder'));
                fCode[i].focus();
                return false;
            }
        }
        return true;
    }

    function angka(e) {
        if (!/^[0-9]+$/.test(e.value)) {
            e.value = e.value.substring(0, e.value.length - 1);
        }
    }
</script>