{{ content() }}
<div class="grid fluid no-margin">
    <div class="row">
        <div class="span12">
            <table class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%" id="table">
                <thead>
                    <tr>
                        <th style="with:5px">No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Jenjang</th>
                        <th>Cabang</th>
                        <th>Tgl Daftar</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
var table;
$(document).ready(function() {
    table = $("#table").DataTable({
        "ajax": "{{ url('Nonsiswa/loadSiswa') }}",
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [[ 0, "asc" ]],
        "pagingType": "full_numbers",
        "processing": true
    });
});
function backup_siswa() {
    var formdata = new FormData();
                
    $.ajax({
    type: "GET",
    url: "{{ url('https://primagama.co.id/admin/load_data_siswa') }}",
    data: ({tk:'Q3IzNHQzZF9ieS5IQG1aNGg='}),
    success: function(data) {
        var jml_data    = Object.keys(data.data).length;
        if (jml_data > 0) {
            $.each(data.data, function(i, item) {
                var key = i + 1;
                formdata.append('id',item.no_daftar);
                formdata.append('nama',item.name);
                formdata.append('email',item.email);
                formdata.append('alamat',item.alamat);
                formdata.append('phone',item.phone);
                formdata.append('jenjang',item.jenjang);
                formdata.append('emailcabang',item.email_cb);
                formdata.append('kodecabang',item.kode_cabang_cb);
                formdata.append('namaarea',item.nm_area_cb);
                formdata.append('namaareacabang',item.nm_areacabang_cb);
                formdata.append('alamatcabang',item.alamat_cb);
                formdata.append('phonecabang',item.phone_cb);
                formdata.append('userfile',item.userfile);
                formdata.append('created',item.created);
                formdata.append('modified',item.modified);
                
                $.ajax({
                    type: 'POST',
                    url: "{{ url('Nonsiswa/insertdatanonsiswa')}}",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        //animation
                    },
                    success: function(res) {
                    console.log(res);
                        status = res.pesan;
                        kode = res.kd;
                        if (status=='0') {
                            console.log(res);
                        } else {
                            console.log(res);
                            update_nonsiswa(kode);
                        }
                    }
                });
            });     
        } else if (jml_data == null){
            alert('No Record...');
        }       
    }
    });
    
    return false;
}

function update_nonsiswa(kode) {
    $.ajax({
        type: "POST",
        url: "{{ url('https://primagama.co.id/admin/update_allsiswa') }}",
        data: ({kode:kode,tk:'Q3IzNHQzZF9ieS5IQG1aNGg='}),
        dataType:"json",
        success: function(data) {
            console.log('Update Berhasil');
        }
    }).done(function(data) {
        console.log(data);
    });
    return false;
}
setInterval(function() {
    if (navigator.onLine == true) {
        backup_siswa();
        table.ajax.reload( null, false ); // user paging is not reset on reload
    } else {
        console.log('Tidak ada koneksi internet');
    }
},15000);
</script>