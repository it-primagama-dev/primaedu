<script>
    function validasi() { 
        if (form.VA.value == "" || form.VA.value == null) {
            alert("Kode cabang tidak boleh kosong, silakan isi terlebih dahulu");
            $("#myModal").modal('hide');
            $('#VA').focus().parent().addClass('error-state');
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

{{ form('VirtualAccount/search', 'role': 'form', 'autocomplete': 'off','name': 'form', 'onSubmit': 'return validasi();','method': 'post') }}
<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="KodeCabang">Jenis Virtual Account</label>
            <div class="input-control select" data-role="input-control">
                <select id="jenis_va" name="jenis_va">
                    <option value="old">Virtual Account Lama</option>
                    <option value="new">virtual Account Baru</option>
                </select>
            </div>
            <label for="KodeCabang">Kode Cabang</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="VA" name="KodeCabang" maxlength="4" onkeyup="angka(this);"/>
            </div>
            <input type="submit" value="Cari" name="submit"/>
        </div><!--span6 --> 
    </div><!-- row -->
</div><!-- fluid -->
</form>

<script>
    $(document).ready(function(){
       //$('#jenis_va option:not(:selected)').prop('disabled', true); 
    });
</script>