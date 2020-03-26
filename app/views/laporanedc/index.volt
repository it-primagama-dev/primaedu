
{{ content() }}

<h1>
    Laporan EDC
</h1>


{{ form("laporanedc/view", "method":"post") }}
 
<div class="grid fluid">
    <div class="row">
        <div class="span3">
            <label for="Bank">Nama Bank</label>
            <div class="input-control select">
                {{ select_static("Bank", ["CardBCA" : "CardBCA"]) }}
            </div>
        </div>
        <div class="span3">
            <label for="Tanggal">Tanggal Import</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd" data-date="{{ date }}">
                {{ text_field("Tanggal", "type" : "text") }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            {{ submit_button("Generate") }}
        </div>
    </div>
{{ end_form() }}

<script>
    $('#downloadBtn').on('click', function () {
        $(".table2excel").table2excel({
            exclude: ".noExl",
            name: "Primaedu",
            filename: "{{ rpt_title }}.xls"
        });
    });
</script>
