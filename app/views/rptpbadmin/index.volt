<h1>Inquiry Pembayaran</h1>

{{ content() }}

{{ form("rptpbadmin/view", "method":"post", "target" : "_blank") }}

<div class="grid fluid">
    <div class="row">
        <div class="span4">
            <label for="Cabang">Cabang</label>
            <div class="input-control">
                {{ select_static('Cabang', cabang, 'using': ['RecID', 'KodeNamaAreaCabang'], 'style': 'width:100%') }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span4">
            <label for="Siswa">Kode / Nama Siswa</label>
            <div class="input-control text">
                {{ text_field('Siswa') }}
            </div>
        </div>
    </div>
    <button class="">Submit</button>
</div>

{{ end_form() }}

{{ stylesheet_link('css/select2.custom.min.css') }}
{{ javascript_include('js/select2.min.js') }}
<script type="text/javascript">
    $(function(){
        $('#Cabang').select2();
    });
</script>