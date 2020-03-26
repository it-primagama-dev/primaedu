{{ content() }}

{{ form("refund/viewdeposit", "method":"post", "target" : "_blank","onSubmit":"return validasi();","name":"form") }}
<div class="grid fluid">
    <div class="row no-margin">
        <div class="span12">
            <legend class="no-margin">Laporan Koreksi Transfer Deposit</legend>
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
        <div class="span2">
            <label for="Tanggal">Status</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static("status", ["":"-- Semua --","Approved":"Approved","Rejected":"Rejected","Pending":"Pending"]) }}
            </div>
        </div>
        <div class="span2">
            <label for="Tanggal">Dialihkan untuk</label>
            <div class="input-control select" data-role="input-control">
                <select name="dialihkan" id="dialihkan" style="width:100%">
                    <option value="">-- Semua --</option>
                    {% for key,value in jenisPengalihanList %}
                        <option value="{{key}}">{{value}}</option>
                    {% endfor %}

                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <button onclick="">Tampilkan</button>
    </div>
</div>
{{ end_form() }}

<script>
    function validasi()
    {
        if (form.DateFrom.value == "" || form.DateFrom.value == null) {
            alert("silakan pilih tanggal dari terlebih dahulu");
            return false;
        }
        if (form.DateTo.value == "" || form.DateTo.value == null) {
            alert("silakan pilih tanggal sampai terlebih dahulu");
            return false;
        }
        return true
    }
</script>