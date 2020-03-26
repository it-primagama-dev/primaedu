{{ content() }}

<h1>
    Program
    <small class="on-right">Update</small>
</h1>
                    {{ content() }}

                    {{ flash.output() }}
                    {{ form("programupdate/save", "method":"post", "id":"myform") }}
                        <div class="row">
                            <div class="span4">
                                <label for="ViewType">Area</label>
                                <div class="input-control select">
                                    {{ select("Area", area, "using" : ["RecID", "NamaAreaCabang"],
                                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
                                </div>
                            </div>
                        </div>

                        <div class="row no-margin">
                            <div class="span4">
                                <label for="ViewType">Cabang</label>
                                <div class="input-control select">
                                    <select id="Cabang" name="Cabang" OnChange="showDiv(this)"></select>
                                </div>
                            </div>
                        </div>

                         <div class="row no-margin">

                        <div id="programsiswa">

                        </div>
<input type="submit" class="command-button primary" id="submit" name="submit" value="Simpan"/>
    {{ end_form() }}
                    <script>
                    $(document).ready(function() {
                        $("#Cabang").change(function(){
                        var Cabang = $("#Cabang").val();
            
                        $.ajax({
                        type: "POST",
                        url : '{{ url('programupdate/programsiswa') }}',
                        data: "Cabang="+Cabang,
                        cache:false,
                        success: function(data){
                            $('#programsiswa').html(data);
                            document.frm.add.disabled=false;
                                }
                            });
                        });
                    })
                    </script>

<script type="text/javascript">
$(document).ready(function(){
    optCabang();
    $('#Area').on('change', function(){optCabang();});
});
function optCabang() {
    url = '{{ url('rptrekapjenjang/getcabang/') }}' + $('#Area').val();
    $.get(url).done(function(data){$('#Cabang').html(data);});
}
</script>

        