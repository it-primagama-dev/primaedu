<style>
    .panel-body {
        border: none;
        box-shadow: none;
    }
    .panel-body {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .sp h4 { text-align: center}
</style>

{{ content() }}

<h1>
    {{ link_to("refund/daftarRefund", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Kesalahan Transfer Detail <strong>{{ NoSuratPernyataan }}</strong>
</h1>

<div class="grid fluid panel-body">
    <div class="row">
        <div class="span6">
            <div class="span12 no-margin">
                <label for="label" class="no-padding">Nama Pembuat Pernyataan</label>
                <div class="input-control text" data-role="input-control">
                    {{ text_field("namapembuatpernyataan","disabled":"disabled","value":NamaPembuatPernyataan) }}
                </div>
            </div>
            <div class="span12 no-margin">
                <label for="label" class="no-padding">Jabatan Pembuat Pernyataan</label>
                <div class="input-control text" data-role="input-control">
                    {{ text_field("jabatanpembuatpernyataan","disabled":"disabled","value":JabatanPembuatPernyataan) }}
                </div>
            </div>
            <div class="span12 no-margin">
                <label for="label" class="no-padding">Cabang</label>
                <div class="input-control text" data-role="input-control">
                    {{ text_field("kodecabang","disabled":"disabled","value":CreateBy ~" - "~ NamaAreaCabang) }}
                </div>
            </div>
            <div class="span12 no-margin">
                <label for="label" class="no-padding">Telp Cabang Terbaru</label>
                <div class="input-control text" data-role="input-control">
                    {{ text_field("telpcabang","disabled":"disabled","value":TelpCabang) }}
                </div>
            </div>
            <div class="span12 no-margin">
                <label for="label">Alamat Cabang Terbaru</label>
                <div class="input-control textarea" data-role="input-control">
                    {{ text_area("alamatcabang","disabled":"disabled","value":AlamatCabang) }}
                </div>
            </div>
            <div class="span12 no-margin">
                <label for="label" class="no-padding">Approve Account Receivable</label>
                <div class="input-control text" data-role="input-control">
                    {{ text_field("TrackFinance","disabled":"disabled","value":TrackFinance) }}
                </div>
            </div>
            {% if JenisRefund != 'Deposite' %}
                <div class="span12 no-margin">
                    <label for="label" class="no-padding">Approve Finance</label>
                    <div class="input-control text" data-role="input-control">
                        {{ text_field("TrackGM","disabled":"disabled","value":TrackGM) }}
                    </div>
                </div>
            {% endif %}
            <div class="span12 no-margin">
                <label for="label" class="no-padding">Tanggal Buat Pernyataan</label>
                <div class="input-control text" data-role="input-control">
                    {{ text_field("Created","disabled":"disabled","value":Created) }}
                </div>
            </div>
            {% if TrackFinance != 'Pending' %}
                <div class="span12 no-margin">
                    <label for="label" class="no-padding">Tanggal Approve Account Receivable</label>
                    <div class="input-control text" data-role="input-control">
                        {{ text_field("Modified","disabled":"disabled","value":Modified) }}
                    </div>
                </div>
            {% endif %}
            {% if JenisRefund != 'Deposite' %}
                {% if TrackGM != 'Pending' %}
                    <div class="span12 no-margin">
                        <label for="label" class="no-padding">Tanggal Approve Finance</label>
                        <div class="input-control text" data-role="input-control">
                            {{ text_field("ModifiedGM","disabled":"disabled","value":ModifiedGM) }}
                        </div>
                    </div>
                {% endif %}
            {% endif %}
        </div>
        <div class="span6">
            <!--
            <div class="span12 no-margin">
                <label for="label" class="no-padding">Jenis Refund</label>
                <div class="input-control text" data-role="input-control">
            {{ text_field("jenisrefund","disabled":"disabled","value":JenisRefund) }}
        </div>
    </div>
            -->

            {% if JenisRefund == 'Refund Siswa' %}
                <div class="span12 no-margin">
                    <label for="label" class="no-padding">Kode Cabang + Kode Siswa Salah</label>
                    <div class="input-control text" data-role="input-control">
                        {{ text_field("novasalah","disabled":"disabled","value":NoVaSalah) }}
                    </div>
                </div>
                <div class="span12 no-margin">
                    <label for="label" class="no-padding">Kode Cabang + Kode Siswa Benar</label>
                    <div class="input-control text" data-role="input-control">
                        {{ text_field("novabenar","disabled":"disabled","value":NoVaBenar) }}
                    </div>
                </div>
            {% endif %}

            {% if JenisRefund == 'Refund Nominal' %}
                <div class="span12 no-margin">
                    <label for="label" class="no-padding">Kode Cabang + Kode Siswa</label>
                    <div class="input-control text" data-role="input-control">
                        {{ text_field("novabenar","disabled":"disabled","value":NoVaBenar) }}
                    </div>
                </div>
            {% endif %}

            {% if JenisRefund == 'Deposite' %}
                {% if NoVaSalah != "" %}
                    <div class="span12 no-margin">
                        <label for="label" class="no-padding">No. Virtual Account Salah</label>
                        <div class="input-control text" data-role="input-control">
                            {{ text_field("novasalah","disabled":"disabled","value":NoVaSalah) }}
                        </div>
                    </div>
                {% endif %}
                <div class="span12 no-margin">
                    <label for="label" class="no-padding">No. Virtual Account Benar</label>
                    <div class="input-control text" data-role="input-control">
                        {{ text_field("novabenar","disabled":"disabled","value":NoVaBenar) }}
                    </div>
                </div>
            {% endif %}

            <div class="span12 no-margin">
                <label for="label">Tanggal Transfer</label>
                <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                    {{ text_field("tanggaltransfer","disabled":"disabled","value":TanggalTransfer) }}
                </div>
            </div>

            {% if JenisRefund != 'Deposite' %}
                <div class="span12 no-margin">
                    <label for="label">Tahun Ajaran</label>
                    <div class="input-control text" data-role="input-control">
                        {{ text_field("TahunAjaran","disabled":"disabled","value":TahunAjaran) }}
                    </div>
                </div>
            {% endif %}

            <!--{% if JenisRefund == 'Deposite' %}
             <div class="span12 no-margin">
                <label for="label">Dialihkan untuk</label>
                <div class="input-control text" data-role="input-control">
            {% if JenisDeposite == 00 %}
                {{ text_field("JenisDeposite","disabled":"disabled","value":"Refund") }}
            {% elseif JenisDeposite == 01 %}
                {{ text_field("JenisDeposite","disabled":"disabled","value":"Pembayaran Ongkir, MD, MRID") }}
            {% elseif JenisDeposite == 02 %}
                {{ text_field("JenisDeposite","disabled":"disabled","value":"Pembayaran Buku") }}
            </div>
            {% endif %}
        </div>
            {% endif %}-->

                {% if JenisRefund == 'Deposite' %}
                    <div class="span12 no-margin">
                        <label for="label">Dialihkan Untuk</label>
                        <div class="input-control text" data-role="input-control">
                            <input disabled="disabled" value="{{JenisDeposite}}">
                        </div>
                    </div>
                {% endif %}

                {% if JenisRefund == 'Refund Siswa' %}
                    <div class="span12 no-margin">
                        <label for="Nominal">Nominal</label>
                        <div class="input-control textarea" data-role="input-control">
                            {{ text_area("nominal","disabled":"disabled","value":Nominal~"&#10;Terbilang" ~ Nominalterbilang ~ "rupiah") }}
                        </div>
                    </div>
                {% endif %}

                {% if JenisRefund == 'Refund Nominal' %}
                    <div class="span12 no-margin">
                        <label for="Nominal">Nominal Benar</label>
                        <div class="input-control textarea" data-role="input-control">
                            {{ text_area("nominal","disabled":"disabled","value":Nominal~"&#10;Terbilang" ~ Nominalterbilang ~ "rupiah") }}
                        </div>
                    </div>
                    <div class="span12 no-margin">
                        <label for="Nominal">Nominal Salah</label>
                        <div class="input-control textarea" data-role="input-control">
                            {{ text_area("LebihNominal","disabled":"disabled","value":LebihNominal~"&#10;Terbilang" ~ LebihNominalterbilang ~ "rupiah") }}
                        </div>
                    </div>
                {% endif %}

                {% if JenisRefund == 'Deposite' %}
                    <div class="span12 no-margin">
                        <label for="Nominal">Nominal Disetor</label>
                        <div class="input-control textarea" data-role="input-control">
                            {{ text_area("nominalbenar","disabled":"disabled","value":Nominal~"&#10;Terbilang" ~ Nominalterbilang ~ "rupiah") }}
                        </div>
                    </div>
                {% endif %}
                <!--{% if JenisRefund == 'Deposite' %}
                <div class="span12 no-margin">
                    <label for="Nominal">Nominal yang disetor</label>
                    <div class="input-control textarea" data-role="input-control">
                {{ text_area("nominaltransfer","disabled":"disabled","value":LebihNominal~"&#10;Terbilang" ~ LebihNominalterbilang ~ "rupiah") }}
            </div>
        </div>
        <div class="span12 no-margin">
            <label for="Nominal">Nominal yang di {% if JenisDeposite == '00' AND nominaldeposit != 'Rp 0,00' %} Refund {% elseif JenisDeposite == '01' AND nominaldeposit != 'Rp 0,00' OR JenisDeposite == '02' AND nominaldeposit != 'Rp 0,00' %} salah {% else %} Deposit {% endif %}</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("nominalbenar","disabled":"disabled","value":Nominal~"&#10;Terbilang" ~ Nominalterbilang ~ "rupiah") }}
            </div>
        </div>
                {% if nominaldeposit != 'Rp 0,00' %}
                <div class="span12 no-margin">
                    <label for="Nominal">Nominal {% if JenisDeposite == '00' %} Refund {% else %} Deposit {% endif %}</label>
                    <div class="input-control textarea" data-role="input-control">
                    {{ text_area("nominaldeposit","disabled":"disabled","value":nominaldeposit~"&#10;Terbilang" ~ nominaldepositterbilang ~ "rupiah") }}
                </div>
            </div>
                {% endif %}
                {% endif %}-->

                    <div class="span12 no-margin">
                        <label for="Keterangan">Kronologi</label>
                        <div class="input-control textarea" data-role="input-control">
                            <!--{{ text_area("kronologi","disabled":"disabled","value":Kronologi) }}-->
                            <div style="background-color:#ebebe4; border:1px #d9d9d9 solid;padding:5px">{{Kronologi}}</div>
                        </div>
                    </div>

                    <!--Approve Account Receivable-->
                    {% if JenisRefund == 'Deposite' %}
                        {% if usergroup == '21' AND TrackFinance == 'Pending' AND username == 'rini' 
                            OR usergroup == '21' AND TrackFinance == 'Pending' AND username == 'ukky' 
                               OR usergroup == '21' AND TrackFinance == 'Pending' AND username == 'devyana' %}
                            {{ form("refund/ubahfinance", "method":"post","enctype": "multipart/form-data","onSubmit": "return validasi88();","name":"form") }}
                            <div class="span12 no-margin">
                                <label for="label">Ubah Status</label>
                                <div class="input-control select" data-role="input-control">
                                    {{ select_static("onchange":"ganti('this')","ubahstatus", ["":"Ubah Status","Approved" : "Approved", "Rejected" : "Rejected"]) }}
                                </div>
                            </div>
                            <div class="span12 no-margin" style="display:none">
                                <label for="Nominal">Nominal yang akan dideposite</label>
                                <div class="input-control textarea" data-role="input-control">
                                    <input type="hidden" name="RecID[]" value="{{ RecID }}">
                                </div>
                            </div>
                            <div class="span12 no-margin" style="display:none">
                                <label for="Nominal">Nominal yang akan dideposite</label>
                                <div class="input-control textarea" data-role="input-control">
                                    {{ hidden_field("JenisRefund","value":JenisRefund) }}
                                </div>
                            </div>
                            <div class="span12 no-margin" style="display:none" id="stepsHIDDEN">
                                <label for="Nominal">Keterangan Pilih Reject</label>
                                <div class="input-control textarea" data-role="input-control">
                                    {{ text_area("Keterangan") }}
                                </div>
                            </div>
                            <div class="span12 no-margin">
                                <div class="span12 no-margin">
                                    <button type="submit" name="updated" name="update" onclick="$('.loader').show()">update</button>
                                </div> <!-- span4 -->
                            </div> <!-- row no-margin -->
                            {{ end_form() }}
                        {% endif %}
                    {% else %}
                        {% if username == 'endra' AND TrackGM == 'Pending' AND TrackFinance != 'Pending' 
                            OR usergroup == '21' AND TrackFinance == 'Pending' AND username == 'kitty' 
                            OR usergroup == '21' AND TrackFinance == 'Pending' AND username == 'devyana' 
                            OR usergroup == '21' AND TrackFinance == 'Pending' AND TrackGM == 'Pending' AND username == 'ukky' 
                            OR usergroup == '21' AND TrackFinance != 'Pending' AND TrackGM == 'Pending' AND username == 'ukky' %}
                            {{ form("refund/ubahfinance", "method":"post","enctype": "multipart/form-data","onSubmit": "return validasi88();","name":"form") }}
                            <div class="span12 no-margin">
                                <label for="label">Ubah Status</label>
                                <div class="input-control select" data-role="input-control">
                                    {{ select_static("onchange":"ganti('this')","ubahstatus", ["":"Ubah Status","Approved" : "Approved", "Rejected" : "Rejected"]) }}
                                </div>
                            </div>
                            <div class="span12 no-margin" style="display:none">
                                <label for="Nominal">Nominal yang akan dideposite</label>
                                <div class="input-control textarea" data-role="input-control">
                                    <input type="hidden" name="RecID[]" value="{{ RecID }}">
                                </div>
                            </div>
                            <div class="span12 no-margin" style="display:none">
                                <label for="Nominal">Nominal yang akan dideposite</label>
                                <div class="input-control textarea" data-role="input-control">
                                    {{ hidden_field("JenisRefund","value":JenisRefund) }}
                                </div>
                            </div>
                            <div class="span12 no-margin" style="display:none" id="stepsHIDDEN">
                                <label for="Nominal">Keterangan Pilih Reject</label>
                                <div class="input-control textarea" data-role="input-control">
                                    {{ text_area("Keterangan") }}
                                </div>
                            </div>
                            <div class="span12 no-margin">
                                <div class="span12 no-margin">
                                    <button type="submit" name="updated" name="update">update</button>
                                </div> <!-- span4 -->
                            </div> <!-- row no-margin -->
                            {{ end_form() }}
                        {% endif %}
                    {% endif %}

                    <!--
                    {% if usergroup == '21' AND TrackFinance != 'Pending' AND TrackGM != 'Pending' %}
                        {{ form("refund/sendapprovedall", "method":"post") }}
                        {{ hidden_field("EmailCabang","value":EmailCabang) }}
                        {{ hidden_field("JenisRefund","value":JenisRefund) }}
                        {{ hidden_field("RecID","value":RecID) }}
                        {{ hidden_field("NoSuratPernyataan","value":NoSuratPernyataan) }}
                        {{ hidden_field("NamaCabang","value":CreateBy ~" - "~ NamaAreaCabang) }}
                        <div class="span12 no-margin">
                        {{ submit_button("Kirim Pemberitahuan Kesalahan Telah Diperbaiki Ke Email ??") }}
                    </div>
                        {{ end_form() }}
                    {% endif %}
                    -->
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                var trackAccountReceivable = "{{TrackFinance}}";
                if (trackAccountReceivable == "Rejected") {
                    $('#ubahstatus').val("Rejected");
                    $('#ubahstatus option:not(:selected)').prop('disabled', true);
                    $('#stepsHIDDEN').show();
                    $("#Keterangan").val("{{Keterangan}}");
                    $("#Keterangan").attr("readonly","readonly");
                }
            });
            function ganti(elem) {
                var ubahstatus = document.getElementById("ubahstatus");
                if (ubahstatus.value === "Rejected") {
                    document.getElementById('stepsHIDDEN').style.display = "block";
                } else if (ubahstatus.value === "Approved") {
                    document.getElementById('stepsHIDDEN').style.display = "none";
                }
            }
            function validasi88() {
                if (form.ubahstatus.value == "" || form.ubahstatus.value == null) {
                    $('.loader').hide();
                    alert("silakan pilih status terlebih dahulu");
                    return false;
                } else {
                    if (form.ubahstatus.value == "Rejected") {
                        if (form.Keterangan.value == "" || form.Keterangan.value == null) {
                            $('.loader').hide();
                            alert("silakan isi keterangan reject terlebih dahulu");
                            return false;
                        }
                    }
                }
                return true
            }
        </script>