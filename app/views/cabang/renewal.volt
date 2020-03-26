<legend><h1>Input Data Perpanjangan Franchisee</h1>
</legend>
{{ content() }}
{# 
<marquee behavior="scroll" direction="left"><h3><font color="red">Under Maintenance . . .</font></h3></marquee>
<marquee behavior="scroll" direction="right"><h3><font color="red">Under Maintenance . . .</font></h3></marquee>
<marquee behavior="scroll" direction="left"><h3><font color="red">Under Maintenance . . .</font></h3></marquee>
<marquee behavior="scroll" direction="right"><h3><font color="red">Under Maintenance . . .</font></h3></marquee>
<marquee behavior="scroll" direction="left"><h3><font color="red">Under Maintenance . . .</font></h3></marquee>
<marquee behavior="scroll" direction="right"><h3><font color="red">Under Maintenance . . .</font></h3></marquee>
<marquee behavior="scroll" direction="left"><h3><font color="red">Under Maintenance . . .</font></h3></marquee>
<marquee behavior="scroll" direction="right"><h3><font color="red">Under Maintenance . . .</font></h3></marquee>
<marquee behavior="scroll" direction="left"><h3><font color="red">Under Maintenance . . .</font></h3></marquee>
<marquee behavior="scroll" direction="right"><h3><font color="red">Under Maintenance . . .</font></h3></marquee>
<marquee behavior="scroll" direction="left"><h3><font color="red">Under Maintenance . . .</font></h3></marquee>
#}
{{ form("cabang/renewalff", "onSubmit": "return validasi();", "method":"post",  "autocomplete" : "off") }}

<div class="grid fluid">
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
                <select id="Cabang" name="Cabang"></select>
            </div>
        </div>
    </div>
    <div class="row">
         {{ submit_button("Cari") }} 
    </div>
</div>
{{ end_form() }}
<script type="text/javascript">
$(document).ready(function(){
    optCabang();
    $('#Area').on('change', function(){optCabang();});
});
function optCabang() {
    url = '{{ url('rptrekapjenjang/getcabang/') }}' + $('#Area').val();
    $.get(url).done(function(data){$('#Cabang').html(data);});
}
function validasi() {
     if($('[name="Cabang"]').val() == "" || $('[name="Cabang"]').val() == null) {
        alert("Pilih Cabang...");
        $('[name="Cabang"]').focus();
        $(".loader").hide();
        return false;
    } else {
        return true;
        $(".loader").show();
    }
}
</script>