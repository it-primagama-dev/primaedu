
{{ content() }}

{{ form("pembayaran", "method":"post", "id" : "pembayaran") }}

<h1>
    <small class="place-right">
        {{ link_to("pembayaran/listpembayaran", 'List Pembayaran<i class="icon-plus on-right smaller"></i>') }} 
    </small>
</h1>


<div align="left">
    <h1>Pembayaran Bimbingan</h1>
</div>


<style type="text/css">
    table .td-input input[type=text]
    {
        width:400px;

    }
    table .td-input
    {
        padding-bottom:10px;
    }
    #msg{color:#ff0000;text-align:left;padding-top:20px}
    .input-control.text,.input-control.select{padding:0px 10px}
    label{text-align:left;padding-left:10px}
</style>


<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <div class="span10">
                <label for="Siswa" class="no-padding">No Siswa / Nama Siswa</label>
                <div class="input-control" data-role="input-control">
                    {{ select("Siswa", siswatx, "using" : ["VirtualAccount","NamaSiswa"],
"useEmpty": true, "emptyValue": "", "emptyText": "---", "style" : "width:100%") }}
                </div>
            </div>

            <div class="span2">
                <label for="Siswa">&nbsp;</label>
                <input type="button" value="Lihat" onclick="inqPembayaran(this.form['Siswa'].value, false);">
            </div>
        </div>

        <div class="span6" id="msg">
            {{ flash.output() }}
        </div>
    </div>

    <div class="row">
        <div class="span6">
            <div>
                <b>Informasi Pembayaran</b>
            </div>

            <label for="NamaSiswa">Nama Siswa</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaSiswa", "type" : "text","disabled" : "disabled") }}
            </div>

            <label for="Program">Program</label>
            <div class="input-control select" data-role="input-control">
                <select id="Program" name="Program" onchange="programChanged();"></select>
            </div>

            <label for="BiayaBimbingan">Biaya Bimbingan dan Pendaftaran</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("BiayaBimbingan", "type" : "text","disabled" : "disabled") }}
            </div>

            <label for="AngsuranKe">Angsuran Ke</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("AngsuranKe", "type" : "text","disabled" : "disabled") }}
            </div>

            <label for="Diskon">Diskon</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Diskon", "type" : "text","disabled" : "disabled") }}
            </div>

            <label for="JatuhTempo">Tanggal Jatuh Tempo</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("JatuhTempo", "type" : "text","disabled" : "disabled") }}
            </div>

            <label for="SisaPembayaran">Sisa Pembayaran</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("SisaPembayaran", "type" : "text","disabled" : "disabled") }}
            </div>
        </div>

        <div class="span6">
            <div>
                <b>Input Data Pembayaran</b>
            </div>

            <label for="TanggalPembayaran">Tanggal Bayar</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("TanggalPembayaran", "type" : "text") }}
            </div>

            <label for="Metode">Cara Bayar</label>
            <div class="input-control select" data-role="input-control">
                <select id="Metode" name="Metode"></select>
            </div>

            <label for="NoReferensi">No Referens</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoReferensi", "type" : "numeric") }}
            </div>
			
			<label for="CardNo">No Kartu Debit/Kredit 16 Digit</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("CardNo", "type" : "text") }}
            </div>
			
			<label for="AuthCd">Appr. Code Pada Struk EDC</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("AuthCd", "type" : "text") }}
            </div>
			
            <label for="Jumlah">Jumlah Bayar</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Jumlah", "type" : "text", "class": "idrCurrency") }}
            </div>
            <input id="btn-conf" class="primary" type="button" value="Submit">
        </div>
    </div>
</div>

</form>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <input type="button" value="Batal" data-dismiss="modal">
                <input type="button" value="Lanjutkan" id="btn-submit">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var objJSON = null;

    function inqPembayaran(idsiswa, auto)
    {
        if (idsiswa == null || idsiswa == "")
        {
            $('#msg').html('Masukkan No. Siswa');
            return;
        }

        clear();
        $(".loader").show();

        var jqxhr = $.ajax("{{ url('pembayaran/inquiry/') }}" + idsiswa)
                .done(function () {
                    try {
                        objJSON = $.parseJSON(jqxhr.responseText);

                        if (objJSON.NamaSiswa == "")
                            $('#msg').html('No Siswa ' + idsiswa + ' tidak terdaftar atau tidak memiliki tagihan');

                        else
                        {
                            if (!auto)
                                $('#msg').html("");

                            $('#NamaSiswa').val(objJSON.NamaSiswa);

                            var select = $('#Program')[0];

                            //add
                            for (i = 0; i < objJSON.Program.length; i++)
                            {
                                var option = document.createElement("option");
                                option.text = objJSON.Program[i].NamaProgram;
                                option.value = objJSON.Program[i].RecIDHeader;
                                select.add(option, null);
                            }

                            programChanged();
                        }
                    }
                    catch (err) {
                        console.log(err);
                        $('#msg').html('Error mendapatkan data siswa 1');
                    }

                })
                .fail(function () {
                    $('#msg').html('Error mendapatkan data siswa 2');
                })
                .always(function () {
                    $(".loader").hide();
                });
    }

    function clear()
    {
        //$('#msg').html("");
        $('#NamaSiswa').val("");
        $('#BiayaBimbingan').val("");
        $('#AngsuranKe').val("");
        $('#JatuhTempo').val("");
        $('#SisaPembayaran').val("");
        $('#Diskon').val("");
        $('#deldisc').parent().remove();

        var select = $('#Program')[0];

        //clear
        var sizeOpt = select.options.length;
        for (i = 0; i < sizeOpt; i++)
        {
            select.remove(0);
        }
    }

    function programChanged()
    {
        var select = $('#Program')[0];

        var index = select.selectedIndex;
        //	$('#BiayaBimbingan').val(FormatMoney(objJSON.Program[index].BiayaTotal,0,',','.'));
        //	$('#AngsuranKe').val(objJSON.Program[index].AngsuranKe);
        //	$('#JatuhTempo').val(objJSON.Program[index].JatuhTempo);
        //	$('#SisaPembayaran').val(formatMoney(objJSON.Program[index].SisaPembayaran,0,',','.'));

        $('#BiayaBimbingan').val(Number(objJSON.Program[index].BiayaTotal).formatMoney(0, "", ".", ","));
        $('#AngsuranKe').val(objJSON.Program[index].AngsuranKe);
        $('#JatuhTempo').val(objJSON.Program[index].JatuhTempo);
        $('#SisaPembayaran').val(Number(objJSON.Program[index].SisaPembayaran).formatMoney(0, "", ".", ","));
        $('#Diskon').val(Number(objJSON.Program[index].Diskon).formatMoney(0, "", ".", ","));
    }

    function confirm()
    {
        $.post("{{ url('pembayaran/confirm') }}", $("#pembayaran").serialize())
                .done(function (data) {
                    if (data.status != 'OK') {
                        $('#btn-submit').addClass('disabled').off("click");
                        msg = '<h5 class="fg-red">' + data.message + '</h5>';
                    } else {
                        $('#btn-submit').removeClass('disabled').addClass('success').on("click", function () {
                            $("#pembayaran").submit();
                        });
                        msg = '<h5>Apakah anda yakin menyimpan pembayaran senilai, ' + data.message + '?</h5>';
                    }
                    $("#myModal .modal-body").html(msg);
                    $("#myModal").modal('show');
                })
                .always(function () {
                    $("#myModal .modal-title").html("Pembayaran Bimbingan");
                });
    }

    Number.prototype.formatMoney = function (places, symbol, thousand, decimal) {
        places = !isNaN(places = Math.abs(places)) ? places : 2;
        symbol = symbol !== undefined ? symbol : "$";
        thousand = thousand || ",";
        decimal = decimal || ".";
        var number = this,
                negative = number < 0 ? "-" : "",
                i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
        return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
    };

    $('#Siswa').on("keyup keypress", function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            e.preventDefault();
            inqPembayaran(document.getElementById('Siswa').value, true);
            return false;
        }
    });
    $("#btn-conf").on("click", function () {
        confirm()
    });
    $("#TanggalPembayaran").on("change", function () {
        setpaymethod();
    });
    function setpaymethod() {
        $("#Metode").empty();
        var url = "{{ url('registrasi/metode/') }}" + $("#TanggalPembayaran").val();
        $.get(url).done(function (d) {
            $("#Metode").html(d);
        });
    }
</script>


{% if nosiswa is defined %}
    <script type='text/javascript'>
        document.getElementById('Siswa').value = "{{ nosiswa }}";
        inqPembayaran(document.getElementById('Siswa').value, true);
    </script>
{% endif %}

{{ stylesheet_link('css/select2.custom.min.css') }}
{{ javascript_include('js/select2.min.js') }}
<script type="text/javascript">
    $(function () {
        $('#Siswa').select2();
    });
</script>
