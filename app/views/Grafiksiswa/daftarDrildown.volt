{{ content() }}
<h1>
    {{ link_to("grafiksiswa/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
</h1>
<div class="grid fluid no-margin">
    <div class="row">
        <div class="span12">
            <table class="table bordered striped hovered" cellspacing="0" width="100%" id="table_grafik">
                <thead>
                    <tr>
                        <th width="5%" bgcolor="#d9d9d9">No.</th>
                        <th bgcolor="#d9d9d9">NIS</th>
                        <th bgcolor="#d9d9d9">Nama Siswa</th>
                        <th bgcolor="#d9d9d9">Jenjang</th>
                        <th bgcolor="#d9d9d9">MD</th>
                        <th bgcolor="#d9d9d9">Kode Cabang</th>
                        <th bgcolor="#d9d9d9">Nama Area Cabang</th>
                        <th bgcolor="#d9d9d9">Tgl Daftar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<style>
.metro .table td:nth-child(1) {
    text-align:center;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $('#table_grafik').dataTable({
		"ajax": "{{ url('grafiksiswa/loadData?tahun='~tahun) }}",
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [[ 0, "asc" ]],
        "pagingType": "full_numbers",
        "processing": true
    });
});
</script>