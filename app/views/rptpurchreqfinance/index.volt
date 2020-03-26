<h1>{{ rpt_title }}<small> - Approved Finance</small></h1>

{{ content() }}

{{ form("rptpurchreqfinance/view", "method":"post", "target" : "_blank") }}

<div class="grid fluid">
  {# <div class="row no-margin">
        <div class="span4">
            <label for="Status">Status</label>
            <div class="input-control select">
                {{ select("Status", status, "using" : ["Status", "Status"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
    </div> #}
    <div class="row no-margin">
        <div class="span4">
            <legend class="no-margin">Periode Laporan</legend>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span2">
            <label for="Tanggal">Dari Tanggal</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("DateFrom") }}
            </div>
        </div>
        <div class="span2">
            <label for="Tanggal">Sampai Tanggal</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("DateTo") }}
            </div>
        </div>
    </div>
    <div class="row">
        <button onclick="">Tampilkan</button>
    </div>
</div>
{{ end_form() }}
