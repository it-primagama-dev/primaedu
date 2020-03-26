
<h1>
    {{ link_to("cabang/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Cabang
    <small class="on-right">Edit</small>
</h1>

{{ content() }}

{{ form("cabang/save", "method":"post", "onSubmit": "return validasi();","id":"AddForm") }}

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
             
            <div class="input-control text">
                    {{ text_field("TanggalBerlaku", "maxlength" : 30, "disabled": "disabled") }}
            </div>
        </div>
        <div class="span3">
            <label for="TanggalBerakhir">Tanggal Berakhir</label>
               
            <div class="input-control text">
                    {{ text_field("TanggalBerakhir", "maxlength" : 30, "disabled": "disabled") }}
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
               {% if admin %}
                {{ text_field("NamaFranchisee", "maxlength" : 100) }}
              {% else %}
                {{ text_field("NamaFranchisee", "maxlength" : 100, "disabled": "disabled") }}
              {% endif %}

            </div>
        </div>
        <div class="span3">
            <label for="NoTelpFranchisee">Nomor Telepon Franchisee</label>
            <div class="input-control text" data-role="input-control">
               {% if admin %}
                {{ text_field("NoTelpFranchisee", "maxlength" : 50) }}
              {% else %}
                {{ text_field("NoTelpFranchisee", "maxlength" : 50, "disabled": "disabled") }}
              {% endif %}
            </div>
        </div>
        <div class="row no-margin">
        <div class="span6">
            <label for="AlamatKTP">Alamat Franchise sesuai KTP</label>
            <div class="input-control textarea" data-role="input-control">
            {% if admin %} {{ text_area("AlamatFranchisee", "maxlength" : 255) }}
            {% else %}
            <disabled>
                {{ text_area("AlamatFranchisee", "maxlength" : 255, "disabled": "disabled") }}
            </disabled>
            {%endif%}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="EmailFranchisee">Email Franchisee</label>
            <div class="input-control text" data-role="input-control">
               {% if admin %}
                {{ text_field("EmailFranchisee", "maxlength" : 100) }}
              {% else %}
                {{ text_field("EmailFranchisee", "maxlength" : 100, "disabled": "disabled") }}
              {% endif %}
            </div>
        </div>
    </div>
    </div>
 
    <legend>Organisasi Cabang</legend>
    <div class="row no-margin">
        <div class="span6">
            <label for="kplcab">Nama Manager</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaManager", "maxlength" : 100) }}
            </div>
        </div>
        <div class="span6">
            <label for="TKC">No Telpon Manager</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NoHandPhone", "maxlength" : 100) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="AlamatKC">Alamat Manager</label>
            <div class="input-control textarea" data-role="input-control" value="{{list.keterangan}}">
                {{ text_area("AlamatKC", "maxlength" : 255) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="pac">PAC</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("PAC", "maxlength" : 100) }}
            </div>
        </div>
        <div class="span6">
            <label for="Telppac">No Telpon PAC</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("telpPAC", "maxlength" : 100) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            <label for="kplcab">I-Smart Tetap</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Ismart", "maxlength" : 100) }}
            </div>
        </div>
        <div class="span6">
            <label for="Telpi">No Telpon I-Smart</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("TelpIsmart", "maxlength" : 100) }}
            </div>
        </div>
    </div>
 
    {{ hidden_field("RecID") }}
    {{ submit_button("Simpan","onClick":"ApiActionCabang();") }}
</div>
{{ end_form() }}

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

    function ApiActionCabang() {
        var formdata = {};
        formdata['RecID'] = window.btoa(unescape(encodeURIComponent($('[name="RecID"]').val())));
        formdata['KodeAreaCabang'] = window.btoa(unescape(encodeURIComponent($('[name="KodeCabang"]').val())));
        formdata['Area'] = window.btoa(unescape(encodeURIComponent($('[name="Area"]').val())));
        formdata['NamaAreaCabang'] = window.btoa(unescape(encodeURIComponent($('[name="NamaCabang"]').val())));
        formdata['TanggalBerlaku'] = window.btoa(unescape(encodeURIComponent($('[name="TanggalBerlaku"]').val())));
        formdata['TanggalBerakhir'] = window.btoa(unescape(encodeURIComponent($('[name="TanggalBerakhir"]').val())));
        formdata['Alamat'] = window.btoa(unescape(encodeURIComponent($('[name="Alamat"]').val())));
        formdata['Propinsi'] = window.btoa(unescape(encodeURIComponent($('[name="Propinsi"]').val())));
        formdata['Kota'] = window.btoa(unescape(encodeURIComponent($('[name="Kota"]').val())));
        formdata['KodePos'] = window.btoa(unescape(encodeURIComponent($('[name="KodePos"]').val())));
        formdata['NoTelp'] = window.btoa(unescape(encodeURIComponent($('[name="NoTelp"]').val())));
        formdata['NamaManager'] = window.btoa(unescape(encodeURIComponent($('[name="NamaManager"]').val())));
        formdata['NoHandPhone'] = window.btoa(unescape(encodeURIComponent($('[name="NoHandPhone"]').val())));
        formdata['NoRekBCA'] = window.btoa(unescape(encodeURIComponent($('[name="NoRekBCA"]').val())));
        formdata['NamaRekBCA'] = window.btoa(unescape(encodeURIComponent($('[name="NamaRekBCA"]').val())));
        formdata['KodeBankNonBCA'] = window.btoa(unescape(encodeURIComponent($('[name="KodeBankNonBCA"]').val())));
        formdata['NoRekNonBCA'] = window.btoa(unescape(encodeURIComponent($('[name="NoRekNonBCA"]').val())));
        formdata['NamaRekNonBCA'] = window.btoa(unescape(encodeURIComponent($('[name="NamaRekNonBCA"]').val())));
        formdata['NoRekMandiri'] = window.btoa(unescape(encodeURIComponent($('[name="NoRekMandiri"]').val())));
        formdata['NamaRekMandiri'] = window.btoa(unescape(encodeURIComponent($('[name="NamaRekMandiri"]').val())));
        formdata['Email'] = window.btoa(unescape(encodeURIComponent($('[name="Email"]').val())));
        // formdata['Longitude'] = window.btoa(unescape(encodeURIComponent(null)));
        // formdata['Latitude'] = window.btoa(unescape(encodeURIComponent(null)));
        formdata['NamaFranchisee'] = window.btoa(unescape(encodeURIComponent($('[name="NamaFranchisee"]').val())));
        // formdata['AlamatFranchisee'] = window.btoa(unescape(encodeURIComponent(null)));
        formdata['NamaFranchisee'] = window.btoa(unescape(encodeURIComponent($('[name="NamaFranchisee"]').val())));
        formdata['NoTelpFranchisee'] = window.btoa(unescape(encodeURIComponent($('[name="NoTelpFranchisee"]').val())));
        formdata['EmailFranchisee'] = window.btoa(unescape(encodeURIComponent($('[name="EmailFranchisee"]').val())));
        formdata['Aktif'] = window.btoa(unescape(encodeURIComponent($('[name="Aktif"]').val())));
        // formdata['Sektor'] = window.btoa(unescape(encodeURIComponent(null)));
        formdata['token'] = window.btoa(unescape(encodeURIComponent('Q3IzNHQzZF9ieS5IQG1aNGg=')));

        $.ajax({
            url: "{{ url('https://primagama.co.id/admin/ApiActionCabang')}}",
            method:"POST",
            data: formdata,
            type: "POST",
            dataType: "JSON",
            success:function(response){
                console.log(response);
                $('.loader').css({"display":"none"});
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $('.loader').css({"display":"none"});
            }
        });
    };

    function validasi(){
    fCode = $('#AddForm input,#AddForm select,#AddForm textarea');
        for ( var i = 0; i < fCode.length; i++ ) {
            if (fCode[i].value=="" && fCode[i].type!='hidden' && fCode[i].name != 'KodeBankNonBCA' && fCode[i].name != 'NoRekNonBCA' && fCode[i].name != 'NamaRekNonBCA' && fCode[i].name != 'NamaFranchisee' && fCode[i].name != 'NoTelpFranchisee' && fCode[i].name != 'EmailFranchisee' && fCode[i].name != 'NamaManager' && fCode[i].name != 'NoHandPhone' && fCode[i].name != 'AlamatKC' && fCode[i].name != 'PAC' && fCode[i].name != 'telpPAC' && fCode[i].name != 'Ismart' && fCode[i].name != 'TelpIsmart') {
                alert(fCode[i].name);
                fCode[i].focus();
                $('.loader').css({"display":"none"});
                return false;
            }
        }
        return true;
    }
</script>
