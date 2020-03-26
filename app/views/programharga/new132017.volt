
<h1>
    {{ link_to("programharga/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Harga Program
    <small class="on-right">Tambah Baru</small>
</h1>

{{ content() }}

{{ form("programharga/create", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="Area">Nama Area</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Area", area, 'using': ['RecID', 'NamaAreaCabang']) }}
            </div>
            <label for="Sektor">Sektor</label>
            <div class="input-control select" data-role="input-control">
            <select name="Sektor">
            <option value="">---</option>
            <option value="1"> Sektor 1</option>
            <option value="2"> Sektor 2</option>
            <option value="3"> Sektor 3</option>
            <option value="4"> Sektor 4</option>
            <option value="5"> Sektor 5</option>
            </select>
            </div>
            <label for="TahunAjaran">Tahun Ajaran</label>
            <div class="input-control select" data-role="input-control">
                {{ select("TahunAjaran", tahunajaran, 'using': ['RecID', 'Description']) }}
            </div>
        </div>
    </div>
                        <div id="detailprogram">
</div>
            {{ submit_button("Simpan") }}
{{ end_form() }}
<script type="text/javascript">
$(document).ready(function(){
    optProgram();
    $('#TahunAjaran').on('change', function(){optProgram();});
});
function optProgram() {
    url = '{{ url('programharga/getprogram/') }}' + $('#TahunAjaran').val();
    $.get(url).done(function(data){$('#Program').html(data);});
}
</script>
<script>
                    $(document).ready(function() {
                        $("#TahunAjaran").change(function(){
                        var TahunAjaran = $("#TahunAjaran").val();
            
                        $.ajax({
                        type: "POST",
                        url : '{{ url('programharga/detailprogram') }}',
                        data: "TahunAjaran="+TahunAjaran,
                        cache:false,
                        success: function(data){
                            $('#detailprogram').html(data);
                            document.frm.add.disabled=false;
                                }
                            });
                        });
                    })
</script>