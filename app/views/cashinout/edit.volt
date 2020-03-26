 {{ content() }}

<h1>
{{ link_to("cashinout", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }} Cash In Out
</h1>
{{ content() }}

{{ flash.output() }}
{{ form("cashinout/update", 'autocomplete': 'off','name': 'form', 'onSubmit': 'return validasi();','method': 'post') }}
    <input type="hidden" name="RecId" value="{{ RecId }}">
    <div class="input-group input-lg span8">
        <label for="Group">Group</label>
        <div class="input-control select" data-role="input-control">
            <select name="Group" id="Group" class="form-control input-md" onChange="aktif1('this')">
                <option value="">--</option>
                {% for i in group %}
                {% if IDGroup == i.RecId %}
                <option value='{{ i.RecId }}' selected="selected">{{ i.GroupName }}</option>
                {% else %}
                <option value='{{ i.RecId }}'>{{ i.GroupName }}</option>
                {% endif %}
                {% endfor %}
            </select>
        </div>
    </div>

    <div id="sembunyikan1">
        <div class="input-group input-lg span8">
            <label for="Huruf">Huruf</label>
            <div class="input-control select" data-role="input-control">
                <select name="Huruf" id="Huruf" class="form-control input-md" onChange="aktif2('this')">
                    {% if IDHuruf is defined %}
                    <option value="{{ IDHuruf }}">{{ HurufId }}</option>
                    {% endif %}
                </select>
            </div>
        </div>
    </div>

    <div id="sembunyikan2">
        <div class="input-group input-lg span8">
            <label for="Class">Class</label>
            <div class="input-control select" data-role="input-control">
                <select name="Class" id="Class" class="form-control input-md" onChange="aktif3('this')">
                    {% if IDClass is defined %}
                    <option value="{{ IDClass }}">{{ ClassId }}</option>
                    {% endif %}
                </select>
            </div>
        </div>
    </div>

    <div id="sembunyikan3">
        <div class="input-group input-lg span8">
            <label for="Tipe">Tipe</label>
            <div class="input-control select" data-role="input-control">
                <select name="Tipe" id="Tipe" class="form-control input-md" onChange="showDiv('this')">
                    {% if IDTipe is defined %}
                    <option value="{{ IDTipe }}">{{ TipeId }}</option>
                    {% endif %}
                </select>
            </div>
        </div>
    </div>


    <div id="stepsHIDDEN">
        <div class="row no-margin">
            <div class="span8">
                <label for="Tanggal">Tanggal</label>
                <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
                    {{ text_field("Tanggal", "type" : "date", "value" : Tanggal) }}
                </div> <!-- input-control text -->
            </div> <!-- span4 -->
        </div> <!-- row margin -->
                            
        <div class="row no-margin">
            <div class="span8">
                <label for="Nominal">Nominal (Deposit Lainnya)</label>
                <div class="input-control text" data-role="input-control">
                    {{ text_field("Nominal", "maxlength" : 30, "class": "Idr", "placeholder":"Wajib Diisi", "value" : Nominal) }}
                </div> <!-- input-control text -->
            </div> <!-- span4 -->
        </div> <!-- row no-margin -->
        
        <div class="row no-margin">
            <div class="span">
                <label for="Description">Keterangan</label>
                <div class="input-control text" data-role="input-control">
                    <textarea name="Description" id="Description" cols="96" rows="5">{{ Description }}</textarea>
                </div> <!-- input-control text -->
            </div> <!-- span8 -->
        </div> <!-- row no-margin -->
                            
        <div class="row margin" style="padding-top: 8%;">
            <div class="span">
                <input type="submit" name="submit" value="simpan">
            </div> <!-- span4 -->
        </div> <!-- row no-margin -->
    </div> <!-- stepsHIDDEN -->
{{ end_form() }}

<script type="text/javascript">
    $(document).ready(function(){
        $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    });

    function showDiv(elem)
    {
        if(elem.value == ''){
            document.getElementById('stepsHIDDEN').style.display = "none";
        } 
        else
        {
            document.getElementById('stepsHIDDEN').style.display = "block";
        }
    }

    function aktif1(elem)
    {   
        var kode = document.getElementById('Group');
        if(kode.value === "G-01" || kode.value === "G-02") {
            $(document).ready(function() {
            document.getElementById('sembunyikan1').style.display = "none";
            document.getElementById('sembunyikan2').style.display = "none";
            document.getElementById('sembunyikan3').style.display = "block";
            $("#Group").on("click", function () {
                var url = "{{ url('cashinout/getTipeGroup/') }}" + $(this).val();
                $.getJSON(url).done(function (data) {
                    $("#Tipe").empty();
                    if (data.status === "OK") {
                        var htmlcontent = "";
                        htmlcontent += "<option value=\"\">--</option>";
                        $.each(data.listData, function (i, list) {
                            htmlcontent += "<option value=\"" + list.RecID + "\">" + list.Deskripsi + "</option>";
                        });
                        $("#Tipe").html(htmlcontent);
                    }
                });
            });
            });
        }
        else
        {
            $(document).ready(function() {
            document.getElementById('sembunyikan1').style.display = "block";
            document.getElementById('sembunyikan2').style.display = "block";
            $("#Group").on("click", function () {
                var url = "{{ url('cashinout/getHuruf/') }}" + $(this).val();
                $.getJSON(url).done(function (data) {
                    $("#Huruf").empty();
                    if (data.status === "OK") {
                        var htmlcontent = "";
                        htmlcontent += "<option value=\"\">--</option>";
                        $.each(data.listData, function (i, list) {
                            htmlcontent += "<option value=\"" + list.RecID + "\">" + list.Deskripsi + "</option>";
                        });
                        $("#Huruf").html(htmlcontent);
                    }
                });
            });
            });
        }
        if(kode.value === "G-03")
        {
            document.getElementById('sembunyikan2').style.display = "block";
        }
        if(kode.value == "" || kode.value == null){
            document.getElementById('sembunyikan1').style.display = "none";
            document.getElementById('sembunyikan2').style.display = "none";
            document.getElementById('sembunyikan3').style.display = "none";
            document.getElementById('stepsHIDDEN').style.display = "none";
        }
    }

   function aktif2(elem)
    {   
        var kode = document.getElementById('Huruf');
        if(kode.value === 'H-02' || kode.value === 'H-01'){
        $(document).ready(function() {
            document.getElementById('sembunyikan2').style.display = "none";
            $("#Huruf").on("click", function () {
                var url = "{{ url('cashinout/getTipeHuruf/') }}" + $(this).val();
                $.getJSON(url).done(function (data) {
                    $("#Tipe").empty();
                    if (data.status === "OK") {
                        var htmlcontent = "";
                        htmlcontent += "<option value=\"\">--</option>";
                        $.each(data.listData, function (i, list) {
                            htmlcontent += "<option value=\"" + list.RecID + "\">" + list.Deskripsi + "</option>";
                        });
                        $("#Tipe").html(htmlcontent);
                    }
                });
            });
        });
        }
        else
        {   
            $(document).ready(function() {
            document.getElementById('sembunyikan2').style.display = "block";
            $("#Huruf").on("click", function () {
                var url = "{{ url('cashinout/getClass/') }}" + $(this).val();
                $.getJSON(url).done(function (data) {
                    $("#Class").empty();
                    if (data.status === "OK") {
                        var htmlcontent = "";
                        htmlcontent += "<option value=\"\">--</option>";
                        $.each(data.listData, function (i, list) {
                            htmlcontent += "<option value=\"" + list.RecId + "\">" + list.ClassName + "</option>";
                        });
                        $("#Class").html(htmlcontent);
                    }
                });
            });
            });
        }
        if(kode.value === 'H-01')
        {
            document.getElementById('sembunyikan3').style.display = "block";
            document.getElementById('stepsHIDDEN').style.display = "block";
        }
        else
        {
            document.getElementById('sembunyikan3').style.display = "block";
        }
    }
    function aktif3(elem)
    {
        if(elem.value != ""){
            $(document).ready(function() {
            $("#Class").on("click", function () {
                var url = "{{ url('cashinout/getTipe/') }}" + $(this).val();
                $.getJSON(url).done(function (data) {
                    $("#Tipe").empty();
                    if (data.status === "OK") {
                        var htmlcontent = "";
                        htmlcontent += "<option value=\"\">--</option>";
                        $.each(data.listData, function (i, list) {
                            htmlcontent += "<option value=\"" + list.RecID + "\">" + list.Deskripsi + "</option>";
                        });
                        $("#Tipe").html(htmlcontent);
                    }
                });
            });
            });
        }
    }

    function validasi(){
        if(form.Group.value=="" || form.Group.value==null){
            alert("Silakan pilih group terlebih dahulu");
            $("#myModal").modal('hide');
            $('#Group').focus().parent().addClass('error-state');$(".loader").hide();return false;
        }
        if(form.Tanggal.value=="" || form.Tanggal.value==null){
            alert("Silakan isi tanggal terlebih dahulu");
            $("#myModal").modal('hide');
            $('#Tanggal').focus().parent().addClass('error-state');$(".loader").hide();return false;
        }
        if(form.Nominal.value=="" || form.Nominal.value==null){
            alert("Silakan isi Nominal terlebih dahulu");
            $("#myModal").modal('hide');
            $('#Nominal').focus().parent().addClass('error-state');$(".loader").hide();return false;
        }
        if(form.Description.value=="" || form.Description.value==null){
            alert("Silakan isi deskripsi terlebih dahulu");
            $("#myModal").modal('hide');
            $('#Description').focus().parent().addClass('error-state');$(".loader").hide();return false;
        }
        return true
    }
</script>