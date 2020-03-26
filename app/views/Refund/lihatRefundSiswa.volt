<h1>
    <form action="downloadSurat/{{NoSuratPernyataan}}" method="POST">
        {{ link_to("refund", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }} KOREKSI VA SISWA 
        <button type="submit" style="background:none;font-size:24px;font-weight:bold">{{ NoSuratPernyataan }}</button>
    </form>
</h1>

{{ content() }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">
                <!-- Input Refund -->
                {{ form("refund/updateSiswaRefund", "onSubmit": "return validasi();", "method":"post",  "autocomplete" : "off","name":"form","id":"form_siswa") }}
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
                        <div class="span11">
                            <label for="label" class="no-padding">Search Data Transaksi Salah</label>
                            <div class="input-control select" data-role="input-control" style="display: none" id="input-transaksi-salah">
                                <select style="width: 100%" id="select2-ajax-siswa" name="TbRecID" placeholder="Search transaksi dibutuhkan"></select>
                                <input type="hidden" name="TransaksiBankRecID" id="TransaksiBankRecID" value="{{TransaksiBankRecID}}">
                                <input type="hidden" name="nama_siswa_salah" id="nama_siswa_salah" value="{{NamaSiswaSalah}}">
                            </div>
                            <div class="input-control text" data-role="input-control" id="input-transaksi-salah-tmp">
                                <input style="width:90% !important" readonly="readonly" type="text" name="nama_siswa_salah_tmp" id="nama_siswa_salah_tmp" value="{{NamaSiswaSalah}}">
                                <span style="width:9% !important; float: right" class="btn btn-default" id="close-transaksi-salah">X</span>
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Kode Cabang + Kode Siswa Salah</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("va_siswa_salah","readonly":"readonly","placeholder":"NoVa Salah dibutuhkan", "value":NoVaSalah) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Kode Cabang + Kode Siswa Benar</label>
                            <div class="input-control select" data-role="input-control" style="display: none" id="input-va-benar">
                                <select style="width: 100%" id="select2-ajax-siswa-cabang" name="novabenar" placeholder="NoVa benar dibutuhkan"></select>
                                <input type="hidden" name="nama_siswa_benar" id="nama_siswa_benar" value="{{NamaSiswaBenar}}">
                                <input type="hidden" name="va_siswa_benar" id="va_siswa_benar" value="{{NoVaBenar}}">
                            </div>
                            <div class="input-control text" data-role="input-control" id="input-va-benar-tmp">
                                <input style="width:90% !important" readonly="readonly" type="text" name="va_benar_tmp" id="va_benar_tmp" value="{{NoVaBenar}}">
                                <span style="width:9% !important; float: right" class="btn btn-default" id="close-va-benar">X</span>
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label">Tanggal Transfer </label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("tanggaltransfer","readonly":"readonly","placeholder":"Tanggal transfer dibutuhkan", "value":TanggalTransfer) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Nominal">Jumlah yang di transfer</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("nominal","readonly":"readonly","placeholder":"Nominal dibutuhkan", "value":Nominal) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="TahunAjaran">Tahun Ajaran</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("TahunAjaran","readonly":"readonly","placeholder":"Tahun ajaran dibutuhkan", "value":TahunAjaranName) }}
                                <input type="hidden" name="TahunAjaranID" id="TahunAjaranID" value="{{TahunAjaran}}"/>
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Keterangan">Kronologi</label>
                            <div class="input-control textarea" data-role="input-control">
                                <div class='text-box'>Telah terjadi kesalahan transfer dengan nomor VA <span class="va_siswa_salah"></span> atas nama <span class="nama_siswa_salah"></span> seharusnya transfer ke nomor VA <span class="va_siswa_benar"></span> atas nama <span class="nama_siswa_benar"></span> sejumlah <span class="nominal"></span><br/><br/>Mohon dapat dilakukan refund 11% <span class="nominal_11_persen"></span> atas kesalahan transfer tersebut.</div>
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
    $(document).ready(function(){
        $("#form_siswa #cekbox").prop("disabled", true);
        $(".listen-on-keyup").keyup(function(){
            delay(function () {
                listenerOnKeyup();
            }, 1000);
            /*var old_val = $(this).attr("data-old");
            var new_val = $(this).val();
            if(old_val != new_val){
                $("#form_siswa #cekbox").prop("disabled", false);
                //console.log("not disabled");
            }else{
                $("#form_siswa #cekbox").prop("disabled", true);
                //console.log("disabled");
            }*/
        });
    });
    function listenerOnKeyup() {
        var inputs = $(".listen-on-keyup");
        for (var i = 0; i < inputs.length; i++) {
            var old_val = $(inputs[i]).attr("data-old");
            var new_val = $(inputs[i]).val();
            console.log("old : " + old_val + ", new : " + new_val);
            if (old_val != new_val) {
                $("#form_siswa #cekbox").prop("disabled", false);
                break;
            } else {
                $("#form_siswa #cekbox").prop("disabled", true);
            }
        }
    }
    function downloadSurat(){
        var noSurat = "{{NoSuratPernyataan}}";
        if (noSurat != "") {
            location.href = base_url + 'refund/downloadSurat/' + noSurat;
        }
    }
    function resetKronologiSiswaSalah(){
        $('#form_siswa .va_siswa_salah').text("");
        $('#form_siswa .nama_siswa_salah').text("");
        $('#form_siswa .nominal').text("");
        $('#form_siswa .nominal_11_persen').text("");
    }
    function resetKronologiSiswaBenar(){
        $("#form_siswa .nama_siswa_benar").text("");
        $("#form_siswa .va_siswa_benar").text("");
    }
    function initData() {
        $('#form_siswa .va_siswa_salah').text("{{NoVaSalah}}");
        $('#form_siswa .nama_siswa_salah').text("{{NamaSiswaSalah}}");
        $('#form_siswa .nominal').text(convertToRupiah({{Nominal}}));

        var nominal_11_persen = (11 / 100) * {{Nominal}};
        $('#form_siswa .nominal_11_persen').text(convertToRupiah(nominal_11_persen));
        $("#form_siswa .nama_siswa_benar").text("{{NamaSiswaBenar}}");
        $("#form_siswa .va_siswa_benar").text("{{NoVaBenar}}");
    }
    initData();
    $('#form_siswa #close-transaksi-salah').click(function(){
        $("#form_siswa #input-transaksi-salah").show();
        $("#form_siswa #input-transaksi-salah-tmp").hide();
        resetKronologiSiswaSalah();
        $("#form_siswa #cekbox").prop("disabled", false);
    });
    $('#form_siswa #close-va-benar').click(function(){
        $("#form_siswa #input-va-benar").show();
        $("#form_siswa #input-va-benar-tmp").hide();
        resetKronologiSiswaBenar();
        $("#form_siswa #cekbox").prop("disabled", false);
    });
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
                $("#form_siswa #TransaksiBankRecID").val(row.RecID);
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
            if (fCode[i].value == "" && fCode[i].type != 'hidden' && fCode[i].name != 'nosurat' && fCode[i].name != 'TbRecID' && fCode[i].name != 'novabenar') {
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