{{ content() }}

{{ form("refund/view", "method":"post", "target" : "_blank","onSubmit":"return validasi();","name":"form") }}

<div class="grid fluid">
    <div class="row no-margin">
        <div class="span12">
            <legend class="no-margin">Laporan Koreksi Transfer</legend>
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
        <!--<div class="span2">
            <label for="Tahun_Ajaran">Tahun Ajaran</label>
            <div class="input-control select">
                <select name="TahunAjaran">
                    {% for r in TahunAjaran %}
                        <option value="{{r.RecID}}">{{r.Description}}</option>
                    {% endfor %}
                </select>
            </div>
        </div>-->
    </div>
    <div class="row">
        <button onclick="">Tampilkan</button>
    </div>
</div>
{{ end_form() }}

<script>
function validasi()
{
    if(form.DateFrom.value=="" || form.DateFrom.value==null){
        alert("silakan pilih tanggal dari terlebih dahulu"); return false;
    }
    if(form.DateTo.value=="" || form.DateTo.value==null){
        alert("silakan pilih tanggal sampai terlebih dahulu"); return false;
    }
    return true
}
</script>