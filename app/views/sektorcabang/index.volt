{{ content() }}

<h1>
    Sektor
    <small class="on-right">Cabang</small>
</h1>
                    {{ content() }}

                    {{ flash.output() }}
 {{ form("sektorcabang/save", "method":"post", "id":"myform") }}
                        <div class="row">
                            <div class="span4">
                                <label for="ViewType">Area</label>
                                <div class="input-control select">
                                    {{ select("Area", area, "using" : ["RecID", "NamaAreaCabang"],
                                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '', 'onchange':'showDiv(this)') }}
                                </div>
                            </div>
                        </div>
{#
                        <div class="row no-margin">
                            <div class="span4">
                                <label for="Sektor">Sektor</label>
                                <div class="input-control select">
                                    <select id="sektor" name="sektor">
                                    <option value="">---</option>
                                    <option value="1"> Sektor 1</option>
                                    <option value="2"> Sektor 2</option>
                                    <option value="3"> Sektor 3</option>
                                    <option value="4"> Sektor 4</option>
                                    <option value="5"> Sektor 5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
#}
                        <div id="detailcabang">

                        </div>
<input type="submit" class="command-button primary" id="submit" name="submit" value="Simpan"/>
    {{ end_form() }}
                    <script>
                    $(document).ready(function() {
                        $("#Area").change(function(){
                        var Area = $("#Area").val();
            
                        $.ajax({
                        type: "POST",
                        url : '{{ url('sektorcabang/detailcabang') }}',
                        data: "Area="+Area,
                        cache:false,
                        success: function(data){
                            $('#detailcabang').html(data);
                            document.frm.add.disabled=false;
                                }
                            });
                        });
                    })
                    </script>

        