<h1>
    <form action="downloadSurat/{{NoSuratPernyataan}}" method="POST">
        {{ link_to("refund", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }} KOREKSI DEPOSIT 
        <button type="submit" style="background:none;font-size:24px;font-weight:bold">{{ NoSuratPernyataan }}</button>
    </form>
</h1>

{{ content() }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="panel-body">
                <!-- Input Refund -->
                {{ form("refund/updateCabangRefund", "onSubmit": "return validasi();", "method":"post",  "autocomplete" : "off","name":"form","id":"form_cabang") }}
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
                            <label for="label" class="no-padding">Tipe Transaksi Salah</label>
                            <div class="input-control select" data-role="input-control">
                                <select name="jenis_transaksi" id="jenis_transaksi" style="width:100%">
                                    {% for key,value in tipeTransaksiList %}
                                        {% if key == TipeTrx %}
                                            <option value="{{key}}" selected="selected">{{value}}</option>
                                        {% else %}
                                            <option value="{{key}}">{{value}}</option>
                                        {% endif %}
                                    {% endfor %}
                                </select>
                            </div>
                        </div>
                        <!--<div class="span11 transaksi-salah" style="display:none">-->
                        <div class="span11 transaksi-salah">
                            <label for="label" class="no-padding">Search Data Transaksi Salah<br/></label>
                            <div class="input-control select" data-role="input-control" style="display: none" id="input-transaksi">
                                <select style="width:100%" class="select2-ajax-cabang" maxlength="11" name="TbRecID" placeholder="Search transaksi dibutuhkan"></select>
                                <input type="hidden" name="TransaksiBankRecID" id="TransaksiBankRecID" value="{{TransaksiBankRecID}}" class="listen-on-keyup" data-old="{{TransaksiBankRecID}}">
                                <input type="hidden" name="nama_cabang" id="nama_cabang" value="{{NamaCabang}}">
                            </div>
                            <div class="input-control text" data-role="input-control" id="input-transaksi-tmp">
                                <input style="width:90% !important" readonly="readonly" type="text" name="nama_cabang_tmp" id="nama_cabang_tmp" value="{{NamaCabang}}">
                                <span style="width:9% !important; float: right" class="btn btn-default" id="close-transaksi">X</span>
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label" class="no-padding">Kode VA Salah</label>
                            <div class="input-control text" data-role="input-control">
                                {{ text_field("va_cabang","maxlength":"11","placeholder":"Kode VA Salah dibutuhkan","readonly":"readonly", "value":NoVA) }}
                            </div>
                        </div>
                        <div class="span11">
                            <label for="label">Tanggal Transfer</label>
                            <!--<div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">-->
                            <div class="input-control text">
                                {{ text_field("tgl_transfer","readonly":"readonly","placeholder":"Tanggal transfer dibutuhkan", "value":TanggalTransaksi) }}
                            </div>
                        </div>

                        <div class="span11">
                            <label for="Nominal">Nominal Disetor</label>
                            <div class="input-control text" data-role="input-control">
                                <!--{{ text_field("nominal","readonly:readonly", "class":"idrCurrency", "placeholder": "Nominal yang Disetorkan") }}-->
                                {{ text_field("nominal", "readonly":"readonly", "placeholder": "Nominal yang Disetorkan") }}
                                <input type="hidden" name="nominal_disetor" id="nominal_disetor" value="{{Nominal}}">
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
                            <input type="hidden" name="jenis_pengalihan_text" id="jenis_pengalihan_text" class="listen-on-keyup">
                        </div>

                        <div class="span11">
                            <label for="Keterangan">Kronologi</label>
                            <div class="input-control textarea" data-role="input-control">
                                <div class='text-box' style="width:100%">Sehubungan telah terjadinya kesalahan transfer dengan VA <span class="va_cabang"></span> sebesar <span class="nominal"></span> maka kami minta dialihkan untuk <span class="jenis_pengalihan"></span></div>
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
        var TipeTrx = "{{TipeTrx}}";
        initData();
        if(TipeTrx != "1"){
            $('#form_cabang #jenis_pengalihan option:not(:selected)').prop('disabled', true);
        }
        
        $("#form_cabang #cekbox").prop("disabled", true);
        $('.listen-on-keyup').keyup(function () {
            delay(function () {
                listenerOnKeyup();
            }, 1000);
        });
        $("#form_cabang #jenis_pengalihan").change(function () {
            var val = $(this).val();
            var txt = $(this).find('option:selected').text();
            $('#form_cabang .jenis_pengalihan').text(txt);
            $("#form_cabang #jenis_pengalihan_text").val(txt);
            listenerOnKeyup();
        });
    });
    
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
                $("#form_cabang #TransaksiBankRecID").val(row.RecID);
                $('#form_cabang #va_cabang').val(row.NoVA);
                $('#form_cabang #nama_cabang').val(row.NamaAreaCabang);
                $('#form_cabang #tgl_transfer').val(row.TanggalTransaksi);
                $('#form_cabang #nominal').val(convertToRupiah(row.Nominal));
                $('#form_cabang #nominal_disetor').val(row.Nominal);

                $('#form_cabang .va_cabang').text(row.NoVA);
                $('#form_cabang .nominal').text(convertToRupiah(row.Nominal));
            }
        });
    });
    
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
    
    function resetForm() {
        $("#form_cabang #TbRecID").val("");
        $("#form_cabang #TransaksiBankRecID").val("");
        $("#form_cabang #va_cabang").val("");
        $("#form_cabang #nama_cabang").val("");
        $("#form_cabang #tgl_transfer").val("");
        $("#form_cabang #nominal").val("");
        $("#form_cabang #nominal_disetor").val("");
        
        //reset kronologi
        resetKronologi();
        
        //show search trx
        $("#form_cabang #input-transaksi").show();
        $("#form_cabang #input-transaksi-tmp").hide();
        $("#form_cabang #cekbox").prop("disabled", false);
    }
    
    function listenerOnKeyup() {
        var inputs = $(".listen-on-keyup");
        for (var i = 0; i < inputs.length; i++) {
            var old_val = $(inputs[i]).attr("data-old");
            var new_val = $(inputs[i]).val();
            console.log("old : " + old_val + ", new : " + new_val);
            if (old_val != new_val) {
                $("#form_cabang #cekbox").prop("disabled", false);
                break;
            } else {
                $("#form_cabang #cekbox").prop("disabled", true);
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
        $('#form_cabang .va_cabang').text("");
        $('#form_cabang .nominal').text("");
        $('#form_cabang .jenis_pengalihan').text("");
    }
    
    function initData() {
        $("#form_cabang #nominal").val(convertToRupiah({{Nominal}}));
        $('#form_cabang #jenis_pengalihan').val({{JenisDeposit}});
        
        $('#form_cabang .va_cabang').text("{{NoVa}}");
        $('#form_cabang .nominal').text(convertToRupiah({{Nominal}}));
        var txt = $("#form_cabang #jenis_pengalihan").find('option:selected').text();
        $('#form_cabang .jenis_pengalihan').text(txt);
        
        $('#form_cabang #jenis_pengalihan_text').val(txt);
        $('#form_cabang #jenis_pengalihan_text').attr("data-old", txt);
    }
    
    $('#form_cabang #close-transaksi').click(function () {
        $("#form_cabang #input-transaksi").show();
        $("#form_cabang #input-transaksi-tmp").hide();
        resetForm();
        $("#form_cabang #cekbox").prop("disabled", false);
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
    
    function angka(e) {
        if (!/^[0-9]+$/.test(e.value)) {
            e.value = e.value.substring(0, e.value.length - 1);
        }
    }

</script>