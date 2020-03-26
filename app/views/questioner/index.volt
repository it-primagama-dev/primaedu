{{ content() }}

<h1>
    Laporan Angket
</h1>


<div class="tab-control" data-role="tab-control" data-effect="fade">
    <ul class="tabs">
        <li class="active"><a href="#_tab1">Data Primer</a></li>
        <li><a href="#_tab2">Data Sekunder</a></li>
    </ul>
    <div class="frames">
        <div class="frame" id="_tab1"> 

{{ content() }}

<form id='userForm'>

<div class="grid fluid">
{% if rpt_auth['areaparent'] is null %}
    <div class="row">
    {% if rpt_auth['areacabang'] == 0 %}
        <div class="span4">
            <label for="ViewType">Area</label>
            <div class="input-control select">
                {{ select("Area", area, "using" : ["RecID", "NamaAreaCabang"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
    {% else %}
        {{ hidden_field("Area") }}
    {% endif %}
    </div>
    <div class="row no-margin">
        <div class="span4">
            <label for="ViewType">Cabang</label>
            <div class="input-control select">
                <select id="Cabang" name="Cabang"></select>
            </div>
        </div>
    </div>
    <div class="row no-margin">
{% else %}
    <div class="row">
{% endif %}
    </div>
    <div class="row">
    <div><input type='submit' value='Tampilkan' /></div>
    </div>
</div>
    </form>

<!-- where the response will be displayed -->
<div id='response'></div>

{% if rpt_auth['areaparent'] is null %}
<script type="text/javascript">
$(document).ready(function(){
    optCabang();
    $('#Area').on('change', function(){optCabang();});
});
function optCabang() {
    url = '{{ url('questioner/getcabang/') }}' + $('#Area').val();
    $.get(url).done(function(data){$('#Cabang').html(data);});
}
</script>
{% endif %}
 

<script>
$(document).ready(function(){
    $('#userForm').submit(function(){
        
        $('#response').html("<b>Loading response...</b>");
        $(".loader").show();

        $.ajax({
            type: 'POST',
            url: 'questioner/view',
            data: $(this).serialize()
        })

        .done(function(data){

        $('#response').html(data);$(".loader").hide();return;

        })

        .fail(function() {
         
            alert( "Posting failed." );
             
        });
 
        return false;
    });
});
</script>
   
        </div>
        <div class="frame" id="_tab2">

{{ content() }}

<form id='userForm2'>

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
    <div class="row">
    <div><input type='submit' value='Tampilkan' /></div>
    </div>
</div>
</div>
    </form>
<!-- where the response will be displayed -->
<div id='response2'></div>

<script>
$(document).ready(function(){
    $('#userForm2').submit(function(){
        
        $('#response').html("<b>Loading response...</b>");
        $(".loader").show();

        $.ajax({
            type: 'POST',
            url: 'questioner/viewarea',
            data: $(this).serialize()
        })

        .done(function(data){

        $('#response2').html(data);$(".loader").hide();return;

        })

        .fail(function() {
         
            alert( "Posting failed." );
             
        });
 
        return false;
    });
});
</script>
        </div>
    </div>
</div>