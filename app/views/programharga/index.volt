{{ content() }}
<br>
<div class="tab-control" data-role="tab-control" data-effect="fade">
    <ul class="tabs">
        <li class="active"><a href="#_tab1">Harga Program</a></li>
        <li><a href="#_tab2">Tambah Harga Program Per-Sektor</a></li>
    </ul>
    <div class="frames">
        <div class="frame" id="_tab1"> 
        <h1>
    Pencarian Harga Program
    <small class="place-right">{{ link_to("programharga/new", 'Tambah Baru<i class="icon-plus on-right smaller"></i>') }}</small>
</h1>

{{ content() }}

{{ form("programharga/search", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="Program">Program</label>
            <div class="input-control select" data-role="input-control">
                {{ select("Program", program, 'using': ['RecID', 'NamaProgram'],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            <label for="AreaCabang">Area</label>
            <div class="input-control select" data-role="input-control">
                {{ select("AreaCabang", area, 'using': ['RecID', 'NamaAreaCabang'],
                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
            <label for="Sektor">Sektor</label>
            <div class="input-control select" data-role="input-control">
            <select name="SektorCabang">
            <option value="">---</option>
            <option value="1"> Sektor 1</option>
            <option value="2"> Sektor 2</option>
            <option value="3"> Sektor 3</option>
            <option value="4"> Sektor 4</option>
            <option value="5"> Sektor 5</option>
            </select>
            </div>
            {{ submit_button("Cari") }}
        </div>
    </div>
</div>
{{ end_form() }}            
        </div>
        <div class="frame" id="_tab2">


<h1>
    {{ link_to("programharga/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Harga Program
    <small class="on-right">Tambah Baru</small>
</h1>

{{ content() }}


            {{ form("programharga/uploadharga", "method":"post","enctype": "multipart/form-data") }} 
                    <div class="row">
                        <div class="span3">          
                        <label for="excel">Upload File Excel</label>
                        <div class="input-control file" data-role="input-control">
                            <?php echo $this->tag->fileField(array("excel")) ?>
                            <button class="btn-file"></button>
                        </div>
                        </div>
                        <div class="span3"> 
                            {{ submit_button("Simpan") }}
                        </div>
                    </div>
            {{ end_form() }}
{{ form("programharga/createtabaru", "method":"post") }}

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
            <label for="TahunAjaran">Tipe Program 2017/2018</label>
            <div class="input-control select" data-role="input-control">
                <select name="TahunAjaran" id="TahunAjaran" class="form-control" required>
                    <option value="">---</option>
                    <option value="0">All</option>
                    <option value="1">Reguler</option>
                    <option value="2">Reguler - PIKSE</option>
                    <option value="3">Reguler - PIKSUN</option>
                    <option value="4">Reguler - PIKSE - PIKSUN</option>
                    <option value="5">Reguler - PIKSTAN</option>
                    <option value="6">Reguler - PIKSUN - PIKSTAN</option>
                    <option value="7">Reguler - PIKSE - PIKSTAN</option>
                    <option value="8">Intensif</option>
                    <option value="9">3 Semester</option>
                </select>
            </div>
        </div>
    </div>
                        <div id="detailprogram">
</div>
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
    </div>
</div> 