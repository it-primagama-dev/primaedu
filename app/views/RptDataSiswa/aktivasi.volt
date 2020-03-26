<h1>Data Siswa Aktivasi</h1>

{{ content() }}

{{ form("rptdatasiswa/searchaktivasi", "method":"post", "target" : "_blank") }}

<div class="grid fluid">

    <div class="row">
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


    

