<h1>
    Pencarian Cabang
    {% if admin %}
    <small class="place-right">
        {{ link_to("cabang/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}
    </small>
    {% endif %}
</h1>

{{ content() }}

{{ form("cabang/search", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="KodeAreaCabang">Kode Cabang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodeAreaCabang", "maxlength" : 4) }}
            </div>
            <label for="NamaAreaCabang">Nama Cabang</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("NamaAreaCabang", "maxlength" : 30) }}
            </div>
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>
{{ end_form() }}

<script type="text/javascript">
$(function() {
    function send_data() {
        $.ajax({
            type: "POST",
            url: "{{ url('https://primagama.co.id/admin/cek_cabang') }}",
            data: ({token:'Q3IzNHQzZF9ieS5IQG1aNGg='}),
            dataType:"json",
            success: function(data) {
                var employee = [];
                $.each(data.list, function(i, item) {
                    employee.push(item.RecID);
                });
                var Kode_area_cabang = employee.join(",");
                var fd = new FormData();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('Nonsiswa/getareacabang')}}",
                    dataType:"json",
                    data: ({KodeAreaCabang:Kode_area_cabang}),
                    success: function(res) {
                        var jml = Object.keys(res).length;
                        if (jml > 0) {
                            $.each(res, function(i, item) {
                                var key = i + 1;
                                fd.append('RecID', item.RecID);
                                fd.append('KodeAreaCabang', item.KodeAreaCabang);
                                fd.append('Area', item.Area);
                                fd.append('NamaAreaCabang', item.NamaAreaCabang);
                                fd.append('TanggalBerlaku', item.TanggalBerlaku);
                                fd.append('TanggalBerakhir', item.TanggalBerakhir);
                                fd.append('Alamat', item.Alamat);
                                fd.append('Propinsi', item.Propinsi);
                                fd.append('Kota', item.Kota);
                                fd.append('KodePos', item.KodePos);
                                fd.append('NoTelp', item.NoTelp);
                                fd.append('NamaManager', item.NamaManager);
                                fd.append('NoHandPhone', item.NoHandPhone);
                                fd.append('NoRekBCA', item.NoRekBCA);
                                fd.append('NamaRekBCA', item.NamaRekBCA);
                                fd.append('KodeBankNonBCA', item.KodeBankNonBCA);
                                fd.append('NoRekNonBCA', item.NoRekNonBCA);
                                fd.append('NamaRekNonBCA', item.NamaRekNonBCA);
                                fd.append('NoRekMandiri', item.NoRekMandiri);
                                fd.append('NamaRekMandiri', item.NamaRekMandiri);
                                fd.append('Email', item.Email);
                                fd.append('Longitude', item.Longitude);
                                fd.append('Latitude', item.Latitude);
                                fd.append('NamaFranchisee', item.NamaFranchisee);
                                fd.append('AlamatFranchisee', item.AlamatFranchisee);
                                fd.append('NoTelpFranchisee', item.NoTelpFranchisee);
                                fd.append('EmailFranchisee', item.EmailFranchisee);
                                fd.append('Aktif', item.Aktif);
                                fd.append('Sektor', item.Sektor);
                                fd.append('token', 'Q3IzNHQzZF9ieS5IQG1aNGg=');
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ url('https://primagama.co.id/admin/simpan_cabang')}}",
                                    data: fd,
                                    processData: false,
                                    contentType: false,
                                    dataType:"json",
                                    success: function(sukses) {
                                        console.log(sukses);
                                    }
                                });
                            });
                        } else if (jml == null){
                            alert('No Record...');
                        }
                    }
                });
            }
        });
    };
    if (navigator.onLine == true) {
        send_data();
        setInterval(function() {
            send_data();
        }, 30000);
    } else {
        console.log('Tidak ada koneksi internet');
    }
});
</script>
