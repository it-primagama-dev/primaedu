{{ content() }}
<html>
    <head>
        {{ get_title() }}
        {{ assets.outputCss('cssHeader') }}
        {{ assets.outputJs('jsHeader') }}
    </head>
    <body class="metro">
        <div class="content padding-top-60" style="padding-left:25%;padding-right:25%">
{{ form("formismart/create", "method":"post") }}

<h1>
    I-Smart
    <small class="on-right">Tambah Baru</small>
</h1>

{{ content() }}

<div class="grid fluid">
    <legend>Detail I-Smart</legend>
    <div class="row">
        
        <div class="span6">
            <label for="NamaISmart">Nama I-Smart</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaISmart", "maxlength" : 100) }}
            </div>
            
            <label for="TipeISmart">Tipe I-Smart</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("TipeISmart", ["Tetap" : "Tetap", "Honor" : "Honor", "IBM" : "IBM"]) }}
            </div>

            <label for="ViewType">Area</label>
            <div class="input-control select">
                {{ select("Area", area, "using" : ["RecID", "NamaAreaCabang"]) }}
            </div>

            <label for="ViewType">Cabang</label>
            <div class="input-control select">
                <select id="Cabang" name="Cabang"></select>
            </div>
        </div>
        
        <div class="span3">
            <label for="Email">Email</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Email", "maxlength" : 100) }}
            </div>

            <label for="Pendidikan">Pendidikan Akhir</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("Pendidikan", ["SMA" : "SMA", "S1" : "S1", "S2" : "S2"])}}
            </div>

             <label for="Pekerjaan">Pekerjaan</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Pekerjaan", "maxlength" : 50) }}
            </div>
        </div>
            
        <div class="span3">
            <label for="Telepon">Nomor Telepon</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Telepon", "maxlength" : 50) }}
            </div>

            <label for="Jurusan">Jurusan</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Jurusan", "maxlength" : 100) }}
            </div>
        </div>   
    </div>
    <div class="row">
        <div class="span4">
            <label for="BidangStudi">Bidang Studi</label>
            <div class="input-control select" data-role="input-control">
                {{ select("BidangStudi", bidangstudi, "using" : ["KodeBidangStudi", "NamaBidangStudi"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            <label for="BidangStudi2">Bidang Studi Tambahan</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("BidangStudi2", "maxlength" : 100) }}
            </div>
        </div>
    </div>
    <legend>Detail Alamat</legend>
    <div class="row">
        <div class="span6">
            <label for="Alamat">Alamat</label>
            <div class="input-control textarea" data-role="input-control">
                {{ text_area("Alamat", "maxlength" : 100) }}
            </div>
        </div>
    </div>

    {{ submit_button("Simpan") }}

</div>

</form>


        <script type="text/javascript">
            $(document).ready(function () {
                optCabang();
                $('#Area').on('change', function () {
                    optCabang();
                });
            });
            function optCabang() {
                url = '{{ url('rptrekapjenjang/getcabang/') }}' + $('#Area').val();
                $.get(url).done(function (data) {
                    $('#Cabang').html(data);
                });
            }
        </script>

</body>
</html>