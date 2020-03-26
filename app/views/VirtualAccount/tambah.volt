<script>
    function validasi() {
        if (form.NoVaSampai.value == "" || form.NoVaSampai.value == null) {
            alert("Nomor VA sampai tidak boleh kosong, silakan isi terlebih dahulu");
            $("#myModal").modal('hide');
            $('#NoVaSampai').focus().parent().addClass('error-state');
            $(".loader").hide();
            return false;
        }
        return true
    }
    function angka(e) {
        if (!/^[0-9]+$/.test(e.value)) {
            e.value = e.value.substring(0, e.value.length - 1);
        }
    }
</script>

<h1>
    {{ link_to("VirtualAccount/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }} Virtual Account
</h1>
{{ form('VirtualAccount/create', 'role': 'form', 'autocomplete': 'off','name': 'form', 'onSubmit': 'return validasi();','method': 'post') }}
<input type="hidden" name="Jenis" value="{{Jenis}}">
<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="KodeCabang">Kode Cabang</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" name="KodeCabang" id="KodeCabang" value="<?php echo $KodeCabang ?>" readonly="readonly">
            </div>
        </div><!--span6 --> 
    </div>
    <div class="row" id="tahun_ajaran_input" style="display:none">
        <div class="span6">
            <label for="KodeCabang">Tahun Ajaran</label>
            <div class="input-control select" data-role="input-control">
                <select name="TahunAjaran" id="TahunAjaran">
                    <option value="">-- Pilih ---</option>
                    {% for tahun in TahunAjaran %}
                        <option value="{{tahun.RecID}}">{{tahun.Description}}</option>
                    {% endfor %} 
                </select>
            </div>
        </div><!--span6 --> 
    </div>
    <div class="row" id="range_input">
        <div class="span6">
            <label for="NoVaDari">No Va Dari</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" name="NoVaDari" id="NoVaDari" value="{{NoVaDari}}" readonly="readonly">
            </div>
            <label for="NoVaSampai">No Va Sampai</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" name="NoVaSampai" onkeyup="angka(this);" id="NoVaSampai"/>
            </div>
            <button type="submit">Save</button>
        </div><!--span6 --> 
    </div><!-- row -->
</div><!-- fluid -->
</form>

<script>
    $(document).ready(function () {
        var jenis = "{{Jenis}}";
        if (jenis == "new") {
            $('#tahun_ajaran_input').show();
            $('#range_input').hide();
            $('input[name="NoVaDari"]').val("");
        }

        $('#TahunAjaran').change(function () {
            $.ajax({
                url: base_url + "VirtualAccount/getLastNewVirtualAccount",
                type: "POST",
                data: {kc: $('#KodeCabang').val(), th: $(this).val()},
                dataType: "JSON",
                success: function (response)
                {
                    $('#range_input').show();
                    var next = (parseInt(response.last_va)+1);
                    $('#NoVaDari').val(next);
                },
                error: function () {
                    alert("Please login again, session has expired", "error");
                }
            });
        });
    });


</script>