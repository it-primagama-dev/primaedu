
{{ content() }}

{{ form("rptdatasiswa/search", "method":"post", "target" : "_blank") }}

<div align="left">
    <h1>Laporan Data Siswa</h1>
</div> 
<div class="grid fluid">
    <div class="row">
        <div class="span10">
            <div class="span6">
                <label for="Cabang" class="no-padding">Kode / Nama Cabang</label>
                <div class="input-control" data-role="input-control">
                    {{ select("Cabang", cabangtx, "using" : ["RecId","NamaCabang"],
"useEmpty": true, "emptyValue": "", "emptyText": "---", "style" : "width:100%") }}
                </div>
            </div>

            <div class="span4">
                <label for="TA">Tahun Ajaran</label>
                <div class="input-control select" data-role="input-control">
                {{ select_static("TA", ["" : "---","1" : "2015/2016", "2" : "2016/2017", "3" : "2017/2018", "4" : "2018/2019", "5" : "2019/2020"])}}
                </div>
            </div>
        </div>
        </div>
            
        <div class="row">
            <div class="span2">
        <button onclick="">Tampilkan</button>
            </div>
        </div>

</div>

</form>

{{ stylesheet_link('css/select2.custom.min.css') }}
{{ javascript_include('js/select2.min.js') }}
<script type="text/javascript">
    $(function () {
        $('#Cabang').select2();
    });
</script>
