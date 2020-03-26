
<h1>
    {{ link_to("detailcabang/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Cabang
    <small class="on-right">Detail</small>
</h1>

{{ content() }}


<div class="grid fluid">
    <legend>Detail Cabang</legend>
    <div class="row no-margin">
        <div class="span3">
            <label for="KodeCabang">Kode Cabang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodeCabang", "maxlength" : 4, "disabled": "disabled", "value": branchcode ) }}
            </div>
        </div>
        <div class="span6">
            <label for="NamaCabang">Nama Cabang</label>
            <div class="input-control text" data-role="input-control">
                {% if admin %}
                    {{ text_field("NamaCabang", "maxlength" : 100) }}
                {% else %}
                    {{ text_field("NamaCabang", "maxlength" : 100, "disabled": "disabled") }}
                {% endif %}
            </div>
        </div>
        <div class="span1">
            <label for="Aktif">Status</label>
            <div class="input-control checkbox">
                <label>
                    {% if admin %}
                        {{ check_field("Aktif") }}
                    {% else %}
                        {{ check_field("Aktif", "disabled": "disabled") }}
                    {% endif %}
                    <span class="check"></span>
                    Aktif
                </label>
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span3">
            <label for="Area">Area</label>
            <div class="input-control select" data-role="input-control">
                {% if admin %}
                    {{ select("Area", area, 'using': ['KodeAreaCabang', 'NamaAreaCabang']) }}
                {% else %}
                    {{ select("Area", area, 'using': ['KodeAreaCabang', 'NamaAreaCabang'], "disabled": "disabled") }}
                {% endif %}
            </div>
        </div>
        <div class="span3">
            <label for="TanggalBerlaku">Tanggal Berlaku</label>
                {% if admin %}
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                    {{ text_field("TanggalBerlaku", "maxlength" : 30) }}
                {% else %}
            <div class="input-control text">
                    {{ text_field("TanggalBerlaku", "maxlength" : 30, "disabled": "disabled") }}
                {% endif %}
            </div>
        </div>
        <div class="span3">
            <label for="TanggalBerakhir">Tanggal Berakhir</label>
                {% if admin %}
            <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                    {{ text_field("TanggalBerakhir", "maxlength" : 30) }}
                {% else %}
            <div class="input-control text">
                    {{ text_field("TanggalBerakhir", "maxlength" : 30, "disabled": "disabled") }}
                {% endif %}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span3">
            <label for="NoRekBCA">Rekening BCA</label>
            <div class="input-control text" data-role="input-control">
                {% if admin %}
                    {{ text_field("NoRekBCA", "maxlength" : 12) }}
                {% else %}
                    {{ text_field("NoRekBCA", "maxlength" : 12, "disabled": "disabled") }}
                {% endif %}
            </div>
        </div>
        <div class="span6">
            <label for="NamaRekBCA">Rekening BCA Atas Nama</label>
            <div class="input-control text" data-role="input-control">
                {% if admin %}
                    {{ text_field("NamaRekBCA", "maxlength" : 35) }}
                {% else %}
                    {{ text_field("NamaRekBCA", "maxlength" : 35, "disabled": "disabled") }}
                {% endif %}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="KodeBankNonBCA">Nama Bank Non-BCA</label>
            <div class="input-control select" data-role="input-control">
                {% if admin %}
                    {{ select("KodeBankNonBCA", bank, "using" : ["Kode", "Nama"],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
                {% else %}
                    {{ select("KodeBankNonBCA", bank, "using" : ["Kode", "Nama"], "disabled": "disabled",
                       'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
                {% endif %}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span3">
            <label for="NoRekNonBCA">Rekening Non-BCA</label>
            <div class="input-control text" data-role="input-control">
                {% if admin %}
                    {{ text_field("NoRekNonBCA", "maxlength" : 16) }}
                {% else %}
                    {{ text_field("NoRekNonBCA", "maxlength" : 16, "disabled": "disabled") }}
                {% endif %}
            </div>
        </div>
        <div class="span6">
            <label for="NamaRekNonBCA">Rekening Non-BCA Atas Nama</label>
            <div class="input-control text" data-role="input-control">
                {% if admin %}
                    {{ text_field("NamaRekNonBCA", "maxlength" :50) }}
                {% else %}
                    {{ text_field("NamaRekNonBCA", "maxlength" : 50, "disabled": "disabled") }}
                {% endif %}
            </div>
        </div>
    </div>

    <legend>Detail Kontak dan Alamat</legend>
    <div class="row">
        <div class="span6">
            <label for="Email">Email Cabang</label>
            <div class="input-control text" data-role="input-control">
                {% if admin %}
                    {{ text_field("Email", "maxlength" : 100) }}
                {% else %}
                    {{ text_field("Email", "maxlength" : 100, "disabled" : "disabled") }}
                {% endif %}
            </div>
        </div>
        <div class="span3">
            <label for="NoTelp">Nomor Telepon Cabang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoTelp", "maxlength" : 30) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="NamaManager">Nama Manager</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaManager", "maxlength" : 30) }}
            </div>
        </div>
        <div class="span3">
            <label for="NoHandPhone">Nomor Handphone Manager</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoHandPhone", "maxlength" : 30) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="Alamat">Alamat</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("Alamat", "maxlength" : 255) }}
            </div>
            <label for="Propinsi">Propinsi</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Propinsi", propinsi, "using" : ["RecID", "NamaPropinsi"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            <label for="Kota">Kota</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Kota", kotakab, "using" : ["RecID", "NamaKotaKab"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            <label for="KodePos">Kode Pos</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodePos", "maxlength" : 5) }}
            </div>
        </div>
    </div>

    <legend>Detail Franchisee</legend>
    <div class="row">
        <div class="span6">
            <label for="NamaFranchisee">Nama Franchisee</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaFranchisee", "maxlength" : 100) }}
            </div>
        </div>
        <div class="span3">
            <label for="NoTelpFranchisee">Nomor Telepon Franchisee</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoTelpFranchisee", "maxlength" : 50) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="EmailFranchisee">Email Franchisee</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("EmailFranchisee", "maxlength" : 100) }}
            </div>
        </div>
    </div>
</div>

<script>
    $("#Propinsi").on("change", function () {
        var url = "{{ url('registrasi/getkota/') }}" + $(this).val();
        $.getJSON(url).done(function (data) {
            $("#Kota").empty();
            if (data.status === "OK") {
                var htmlcontent = "";
                $.each(data.listData, function (i, list) {
                    htmlcontent += "<option value=\"" + list.id + "\">" + list.namakotakab + "</option>";
                });
                $("#Kota").html(htmlcontent);
            }
        });
    });
</script>
