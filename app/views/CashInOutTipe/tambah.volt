<h1>
{{ link_to("CashInOutTipe", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }} Cash In Out
</h1>
{{ form('CashInOutTipe/create', 'role': 'form', 'autocomplete': 'off','name': 'form', 'onSubmit': 'return validasi();','method': 'post') }}
	<div class="grid fluid">
    	<div class="row">

    		<div class="input-group input-lg span8">
		        <label for="Kode Tipe">Kode Tipe</label>
				<div class="input-control text" data-role="input-control">
					<input type="text" name="KodeTipe" value="{{ IdBaru }}" readonly="readonly">
				</div>
				<label for="Kode Unix">Kode Unix</label>
				<div class="input-control text" data-role="input-control">
					<input type="text" name="KodeUnix" value="{{ KodeUnix }}" readonly="readonly">
				</div>
				<label for="Group">Group</label>
		        <div class="input-control select" data-role="input-control">
		            <select name="Group" id="Group" class="form-control input-md" onChange="aktif1('this')">
		                <option value="">--</option>
		                {% for i in group %}
		                <option value='{{ i.RecId }}'>{{ i.GroupName }}</option>
		                {% endfor %}
		            </select>
		        </div>
		        <div id="sembunyikan1" style="display: none;">
		            <label for="Huruf">Huruf</label>
		            <div class="input-control select" data-role="input-control">
		                <select name="Huruf" id="Huruf" class="form-control input-md" onChange="aktif2('this')">
		                    <option value="">--</option>
		                </select>
		            </div>
        		</div>
        		<div id="sembunyikan2" style="display: none;">
		            <label for="Class">Class</label>
		            <div class="input-control select" data-role="input-control">
		                <select name="Class" id="Class" class="form-control input-md" onChange="aktif3('this')">
		                    <option value="">--</option>
		                </select>
		            </div>
		        </div>
		    	<div id="sembunyikan3" style="display: none;">
		            <label for="Tipe">Deskripsi Tipe</label>
		            <div class="input-control text" data-role="input-control">
                    {{ text_field("Tipe", "placeholder":"Wajib Diisi") }}
                    </div> <!-- input-control text -->
		        </div>
                <div class="row margin">
                    <div class="span">
                        <input type="submit" name="submit" value="simpan">
                    </div> <!-- span4 -->
                </div> <!-- row no-margin -->
		    </div>
    	</div><!-- row -->
	</div><!-- fluid -->
</form>

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
            document.getElementById('sembunyikan2').style.display = "none";
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
        if(kode.value === 'H-02'){
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
</script>