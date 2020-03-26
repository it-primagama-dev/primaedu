{{ content() }}

<h1>
    <i class="icon-arrow-left-3 fg-darker smaller"></i>
    Koreksi Transfer
</h1>
{{ form("refund/", "method":"post", "target" : "_blank") }}
<div class="grid fluid">
{% if rpt_auth['areaparent'] is null %}
    <div class="row">
    {% if rpt_auth['areacabang'] == 0 %}
        <div class="span4">
            <label for="ViewType">Area</label>
            <div class="input-control select">
                {{ select("Area", area, "using" : ["RecID", "NamaAreaCabang"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
    {% else %}
        {{ hidden_field("Area") }}
    {% endif %}
    </div>
    <div class="row no-margin">
        <div class="span4">
            <label for="ViewType">Cabang</label>
            <div class="input-control select">
                <select id="Cabang" name="Cabang"></select>
            </div>
        </div>
    </div>
    <div class="row no-margin">
{% else %}
    <div class="row">
{% endif %}
    </div>
    <div class="row">
        <button onclick="">Tampilkan</button>
    </div>
</div>
{{ end_form() }}

{% if rpt_auth['areaparent'] is null %}
<script type="text/javascript">
$(document).ready(function(){
    optCabang();
    $('#Area').on('change', function(){optCabang();});
});
function optCabang() {
    url = '{{ url('rptrekapjenjang/getcabang/') }}' + $('#Area').val();
    $.get(url).done(function(data){$('#Cabang').html(data);});
}
</script>
{% endif %}

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
$(document).ready(function() {
    var first = getUrlVars()["id"];
    if (!!first) {
       $("#modalSuccess").modal('show');
       $("#nocetek").val(first)
    }
    $('#download').on('click' , function() { 
      $("#modalSuccess").modal('hide');
    });
});

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
</script>


{{ form("refund/cetak1", "method":"post","enctype": "multipart/form-data") }}
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

<link rel="stylesheet" type="text/css" href="{{ url('jquery-ui/jquery-ui.min.css') }}">
<script type="text/javascript" charset="utf8" src="{{ url('jquery-ui/jquery-ui.min.js') }}"></script>