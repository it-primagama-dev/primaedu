<h1>
    <form action="downloadSurat/{{NoSuratPernyataan}}" method="POST">
        {{ link_to("refund", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }} KOREKSI KELEBIHAN NOMINAL 
        <button type="submit" style="background:none;font-size:24px;font-weight:bold">{{ NoSuratPernyataan }}</button>
    </form>
</h1>
{{ content() }}
<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">
                <!-- Input Refund -->
                {{ form("refund/updateNominalRefund", "onSubmit": "return validasi();", "method":"post",  "autocomplete" : "off","name":"form","id":"form_nominal") }}
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
                            <label for="label" class="no-padding">Search Data Transaksi</label>
                            <div class="input-control select" data-role="input-control" style="display: none" id="input-transaksi">
                                <select style="width: 100%" id="select2-ajax-nominal" style="width: 100%" name="TbRecID" placeholder="Search transaksi dibutuhkan"></select>
                                <input type="hidden" name="TransaksiBankRecID" id="TransaksiBankRecID" value="{{TransaksiBankRecID}}">
                                <input type="hidden" name="nama_siswa" id="nama_siswa" value="{{NamaSiswa}}">
                            </div>
                            <div class="input-control text" data-role="input-control" id="input-transaksi-tmp">
                                <input style="width:90% !important" readonly="readonly" type="text" name="nama_siswa_tmp" id="nama_siswa_tmp" value="{{NamaSiswa}}">
                                <span style="width:9% !important; float: right" class="btn btn-default" id="close-transaksi">X</span>
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Kode Cabang + Kode Siswa</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("va_siswa","maxlength":"11","placeholder":"Nova dibutuhkan","readonly":"readonly", "value":NoVa) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label">Tanggal Transfer</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("tgl_transfer","readonly":"readonly","placeholder":"Tanggal transfer dibutuhkan", "value":TanggalTransfer) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Nominal">Nominal Salah</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("nominal_salah_rupiah","placeholder":"Nominal salah dibutuhkan","readonly":"readonly","style":"text-align:right") }}
                                <input type="hidden" id="nominal_salah" name="nominal_salah" value="{{LebihNominal}}">
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Nominal">Nominal Benar</label>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" id="nominal_benar_rupiah" name="nominal_benar_rupiah" class="idrCurrency" placeholder="Nominal benar dibutuhkan">
                                <input type="hidden" id="nominal_benar" name="nominal_benar" value="{{Nominal}}" class="listen-on-keyup" data-old="{{Nominal}}">
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Nominal">Selisih Nominal</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("nominal_selisih_rupiah","placeholder":"Selisi dibutuhkan","readonly":"readonly","style":"text-align:right") }}
                                <input type="hidden" id="nominal_selisih" name="nominal_selisih" value="{{SelisihNominal}}">
                            </div>
                        </div>
                        <div class="span11">
                            <label for="TahunAjaran">Tahun Ajaran</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("tahun_ajaran","readonly":"readonly","placeholder":"Tahun ajaran dibutuhkan", "value":TahunAjaranName) }}
                                <input type="hidden" name="TahunAjaranID" id="TahunAjaranID" value="{{TahunAjaran}}"/>
                            </div>
                        </div>
                        <div class="span11">
                            <label for="Keterangan">Kronologi</label>
                            <div class="input-control textarea" data-role="input-control">
                                <div class='text-box' style="width:100%">Telah terjadi kelebihan nominal transfer ke nomor VA <span class="va_siswa"></span> atas nama <span class="nama_siswa"></span> sebesar <span class="nominal_selisih"></span><br/><br/>Mohon dapat dilakukan refund 11% dari <span class="nominal"></span> yaitu <span class="nominal_11_persen"></span> atas kelebihan nominal transfer tersebut.</div>
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
        $("#form_nominal #cekbox").prop("disabled", true);
        /*$(".listen-on-keyup").on("keyup", function () {
         listenerOnKeyup();
         });*/
        $('.listen-on-keyup').keyup(function () {
            delay(function () {
                listenerOnKeyup();
            }, 1000);
        });
        /*
         //setup before functions
         var typingTimer;                //timer identifier
         var doneTypingInterval = 5000;  //time in ms, 5 second for example
         var $input = $('.listen-on-keyup');
         //on keyup, start the countdown
         $input.on('keyup', function () {
         clearTimeout(typingTimer);
         typingTimer = setTimeout(doneTyping, doneTypingInterval);
         });
         //on keydown, clear the countdown 
         $input.on('keydown', function () {
         clearTimeout(typingTimer);
         });
         //user is "finished typing," do something
         function doneTyping() {
         //do something
         listenerOnKeyup();
         }
         */
    });
    function listenerOnKeyup() {
        var inputs = $(".listen-on-keyup");
        for (var i = 0; i < inputs.length; i++) {
            var old_val = $(inputs[i]).attr("data-old");
            var new_val = $(inputs[i]).val();
            console.log("old : " + old_val + ", new : " + new_val);
            if (old_val != new_val) {
                $("#form_nominal #cekbox").prop("disabled", false);
                break;
            } else {
                $("#form_nominal #cekbox").prop("disabled", true);
            }
        }
    }
    function downloadSurat() {
        var noSurat = "{{NoSuratPernyataan}}";
        if (noSurat != "") {
            location.href = base_url + 'refund/downloadSurat/' + noSurat;
        }
    }
    function resetKronologi() {
        $('#form_nominal .va_siswa').text("");
        $('#form_nominal .nama_siswa').text("");
        $('#form_nominal .nominal').text("");
        $('#form_nominal .nominal_11_persen').text("");
		$('#form_nominal .nominal_selisih').text("");											 
    }
    function initData() {
        $('#form_nominal #nominal_salah_rupiah').val(convertToRupiah({{LebihNominal}}));
        $('#form_nominal #nominal_benar_rupiah').val(convertToRupiah({{Nominal}}));
        $('#form_nominal #nominal_selisih_rupiah').val(convertToRupiah({{SelisihNominal}}));
        $('#form_nominal .va_siswa').text("{{NoVa}}");
        $('#form_nominal .nama_siswa').text("{{NamaSiswa}}");
        $('#form_nominal .nominal').text(convertToRupiah({{Nominal}}));
		$('#form_nominal .nominal_selisih').text(convertToRupiah({{SelisihNominal}}));																			  
		var nominal_11_persen = (11 / 100) * {{Nominal}};
        $('#form_nominal .nominal_11_persen').text(convertToRupiah(nominal_11_persen));
    }
    initData();
    function reset() {
        $("#form_nominal #TbRecID").val("");
        $("#form_nominal #TransaksiBankRecID").val("");
        $('#form_nominal #va_siswa').val("");
        $('#form_nominal #nama_siswa').val("");
        $('#form_nominal #tgl_transfer').val("");
        $('#form_nominal #nominal_salah_rupiah').val("");
        $('#form_nominal #nominal_salah').val("");
        $('#form_nominal #nominal_benar_rupiah').val("");
        $('#form_nominal #nominal_benar').val("");
        $('#form_nominal #nominal_selisih_rupiah').val("");
        $('#form_nominal #nominal_selisih').val("");
        $('#form_nominal #tahun_ajaran').val("");
        $('#form_nominal #TahunAjaranID').val("");
        resetKronologi();
    }
    $('#form_nominal #close-transaksi').click(function () {
        $("#form_nominal #input-transaksi").show();
        $("#form_nominal #input-transaksi-tmp").hide();
        //reset
        reset();
        $("#form_nominal #cekbox").prop("disabled", false);
    });
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
                $("#form_nominal #TransaksiBankRecID").val(row.RecID);
                $('#form_nominal #va_siswa').val(row.NoVA);
                $('#form_nominal #nama_siswa').val(row.NamaSiswa);
                $('#form_nominal #tgl_transfer').val(row.TanggalTransaksi);
                $('#form_nominal #nominal_salah_rupiah').val(convertToRupiah(row.Nominal));
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
    function run() {
        var cb = document.getElementById("cb");
        if (document.getElementById("cekbox").checked == true) {
            cb.disabled = false;
        } else {
            cb.disabled = true;
        }
    }
    function validasi() {
        fCode = $('#form_nominal input,#form_nominal select,#form_nominal textarea');
        for (var i = 0; i < fCode.length; i++) {
            if (fCode[i].value == "" && fCode[i].type != 'hidden' && fCode[i].name != 'nosurat' && fCode[i].name != 'TbRecID') {
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
    $('#form_nominal #nominal_benar_rupiah').on("keyup", function (event) {
        var nominal_salah = parseInt($("#form_nominal #nominal_salah").val());
        var nominal_benar_rupiah = $(this).val();
        var nominal_benar = parseInt(convertToAngka(nominal_benar_rupiah));
        var nominal_selisih = nominal_salah - nominal_benar;
        var nominal_selisih_rupiah = convertToRupiah(isNaN(nominal_selisih) ? 0 : nominal_selisih);
        var nominal_11_persen = (11 / 100) * nominal_benar;
        var nominal_11_persen_rupiah = convertToRupiah(nominal_11_persen);
		$('#form_nominal .nominal_selisih').text(nominal_selisih_rupiah);																 
		$('#form_nominal .nominal').text(nominal_benar_rupiah);
        $('#form_nominal .nominal_11_persen').text(nominal_11_persen_rupiah);
        $('#form_nominal #nominal_selisih_rupiah').val(nominal_selisih_rupiah);
        $('#form_nominal #nominal_selisih').val(nominal_selisih);
        $('#form_nominal #nominal_benar_rupiah').val(nominal_benar_rupiah);
        $('#form_nominal #nominal_benar').val(nominal_benar);
        console.log("Nominal salah : " + nominal_salah);
        console.log("Nominal benar : " + nominal_benar);
        console.log("Nominal Selisih : " + nominal_selisih);
        //check data on keyup
        delay(function () {
            listenerOnKeyup();
        }, 1000);
        if (nominal_benar > nominal_salah) {
            alert("Nominal benar tidak boleh lebih besar dari nominal salah");
            $("#form_nominal #nominal_benar_rupiah").val("");
            $("#form_nominal #nominal_benar").val("");
            $('#form_nominal #nominal_selisih_rupiah').val("");
            $('#form_nominal #nominal_selisih').val("");
            $('#form_nominal .nominal').text("");
            $('#form_nominal .nominal_11_persen').text("");
			$('#form_nominal .nominal_selisih').text("");											 
            $(this).val("");
        }
    });
</script>