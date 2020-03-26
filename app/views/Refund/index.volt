{{ content() }}

<h1>
    <i class="icon-arrow-left-3 fg-darker smaller"></i>
    KOREKSI TRANSFER
</h1>

<div class="tab-control" data-role="tab-control" data-save-state="true">
    <ul class="tabs">
        <li class="active"><a href="#_tab1" onclick="initTab('_tab1')">Koreksi VA Siswa</a></li>
        <li><a href="#_tab2" onclick="initTab('_tab2')">Koreksi Kelebihan Nominal</a></li>
        <li><a href="#_tab3" onclick="initTab('_tab3')">Koreksi Transfer Double</a></li>
        <li><a href="#_tab4" onclick="initTab('_tab4')">Koreksi Deposit</a></li>
            {#<li><a href="#_tab4">Bertingkat</a></li>#}
    </ul>

    <div class="frames">
        <div class="frame" id="_tab1">{{ partial('refund/refund-siswa') }}</div>
        <div class="frame" id="_tab2">{{ partial('refund/refund-nominal') }}</div>
        <div class="frame" id="_tab3">{{ partial('refund/refund-double') }}</div>
        <div class="frame" id="_tab4">{{ partial('refund/refund-cabang') }}</div>
        {#<div class="frame" id="_tab4">{{ partial('refund/refund-bertingkat') }}</div>#}
    </div>
</div>

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
    .printchatbox {
        min-height: 100px;
        overflow: auto;
        vertical-align: top;
        -webkit-appearance: textarea;
        background-color: white;
        -webkit-rtl-ordering: logical;
        user-select: text;
        flex-direction: column;
        resize: auto;
        cursor: auto;
        white-space: pre-wrap;
        word-wrap: break-word;
        border-width: 1px;
        border-style: solid;
        border-color: initial;
        border-image: initial;
        padding: 2px;
        text-rendering: auto;
        color: initial;
        letter-spacing: normal;
        word-spacing: normal;
        text-transform: none;
        text-indent: 0px;
        text-shadow: none;
        display: inline-block;
        text-align: start;
        margin: 0em;
        font: 13.3333px Arial;
    }
</style>

<script type="text/javascript">
    function initTab(tab) {
        localStorage.setItem('_tab_actived', tab);
    }
    
    $(document).ready(function () {
        var noSurat = "{{noSurat}}";
        console.log(noSurat);
        $("#modalSuccess").modal('hide');
        if (noSurat != "") {
            $("#modalSuccess").modal('show');
            $("#modalSuccess #nosurat").text(noSurat);
            location.href = base_url + 'refund/downloadSurat/' + noSurat;
        }
        
        var tab_actived = localStorage.getItem('_tab_actived');
        if(tab_actived !== null){
            $(".tabs > li.active").removeClass("active");
            $('a[href="#'+tab_actived+'"]').parent("li").addClass("active");
            $('.tabs a[href="#' + tab_actived + '"]').trigger('click');
        }
        console.log(tab_actived);
        
        /*var first = getUrlVars()["id"];
        if (!!first) {
            $("#modalSuccess").modal('show');
            $("#nocetek").val(first)
        }
        $('#download').on('click', function () {
            $("#modalSuccess").modal('hide');
        });*/
    });

    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
            vars[key] = value;
        });
        return vars;
    }

    function angka(e) {
        if (!/^[0-9]+$/.test(e.value)) {
            e.value = e.value.substring(0, e.value.length - 1);
        }
    }
</script>

<div class="modal fade modal-success" id="modalSuccess">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="myModalLabel" style="text-align:center">Alert!</h1>
            </div>
            <div class="modal-body">
                <h2 class="text-center">Surat pernyataan <span id="nosurat"></span><br/>berhasil di download</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--
{{ form("refund/cetak", "method":"post","enctype": "multipart/form-data") }}
<div class="modal fade modal-success" id="modalSuccess">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="text-align:center">Data berhasil disimpan</h4>
            </div>
            <div class="modal-body">
                <h1 class="text-center">Silakan download surat pernyataan</h1>
                {{ hidden_field("nocetek") }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" id="download">Download</button>
            </div>
        </div>
    </div>
</div>
{{ end_form() }}
-->