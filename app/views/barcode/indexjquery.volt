
<div class="frames">
    <legend><h1>Input Data Barcode</h1></legend>
</div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

{{ content() }}

{{ form("barcode/tambah", "method":"post") }}

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

        <div class="span4">
            <label for="ViewType">Cabang</label>
            <div class="input-control select">
                <select id="Cabang" name="Cabang" onchange="myFunction()"></select>
            </div>
        </div>


        <div id="test" class="span4" hidden>
            <label for="ViewType">Jenjang</label>
            <div class="input-control select">
                {{ select("Jenjang", jenjang, "using" : ["KodeJenjang", "NamaJenjang"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '', 'id' : 'jenjang', 'onchange' : 'myFunction()' ) }}
            </div>
        </div>
    {% else %}
        {{ hidden_field("Area") }}
    {% endif %}
    </div>
    <div class="row no-margin">
{% else %}
{% endif %}

<div id="test2" hidden>
<legend>Silahkan Masukkan Barcode Disini</legend>



    <div id="test3">
        <input type="button" class="primary" id="btAdd" value="Tambah Barcode" class="bt" />
    </div>



</div>

{% if rpt_auth['areaparent'] is null %}
<script type="text/javascript">
$(document).ready(function(){
    optCabang();
    $('#Area').on('change', function(){optCabang();});
});
function optCabang() {
    url = '{{ url('deliveryreqheader/getcabang/') }}' + $('#Area').val();
    $.get(url).done(function(data){$('#Cabang').html(data);});
}


    var countBox =1;
    var boxName = 0;
function addInput()
    {
    var boxName="Barcode" +countBox; 
    document.getElementById('responce').innerHTML+='<br/><input type="text" id="Barcode" placeholder="'+boxName+'" value="oni" "  /><br/>';
    countBox += 1;

    document.getElementById("test3").style.display = "block";
    }

function myFunction() {
    var cab = document.getElementById("Cabang").value;
    var jen = document.getElementById("jenjang").value;

    if(cab !== ""){
         document.getElementById("test").style.display = "block";
    }

    if(cab == ""){
    document.getElementById("test").style.display = "";
    }

    if(jen !== ""){
    document.getElementById("test2").style.display = "block";
    }

    if(jen == ""){
    document.getElementById("test2").style.display = "";
    }

}

    $(document).ready(function() {

        var iCnt = 0;

        $('#btAdd').click(function() {
            if (iCnt <= 9) {

                iCnt = iCnt + 1;

                // ADD TEXTBOX.
                $(test3).append('<div class="row"><div class="span4"><div class="input-control text" data-role="input-control"><input type=text class="input" id=tb' + iCnt + ' ' +
                            'value="" placeholder="Barcode ' + iCnt + '" /></div></div></div>');

                // SHOW SUBMIT BUTTON IF ATLEAST "1" ELEMENT HAS BEEN CREATED.
                if (iCnt == 1) {

                    var divSubmit = $(document.createElement('div'));
                    $(divSubmit).append('<div class="row"><input type=button class="primary large"' + 
                        'onclick="GetTextValue()"' + 
                            'id=btSubmit value=Submit /></div>');

                }

                // ADD BOTH THE DIV ELEMENTS TO THE "test3" CONTAINER.
                $(test3).after(divSubmit);
            }
            // AFTER REACHING THE SPECIFIED LIMIT, DISABLE THE "ADD" BUTTON.
            // (20 IS THE LIMIT WE HAVE SET)
            else {      
                $(test3).append('<b><font color="red">*Maksimal Input 10 !!<font></b>'); 
                $('#btAdd').attr('class', 'bt-disable'); 
                $('#btAdd').attr('disabled', 'disabled');
            }
        });
    });

    // PICK THE VALUES FROM EACH TEXTBOX WHEN "SUBMIT" BUTTON IS CLICKED.
    var divValue, values = '';

    function GetTextValue() {

        $(divValue) 
            .empty() 
            .remove(); 
        
        values = '';

        $('.input').each(function() {
            divValue = $(document.createElement('div')).css({
                padding:'5px', width:'200px'
            });
            values += this.value + '<br />'
        });

        $(divValue).append('<p><b>Your selected values</b></p>' + values);
        $('body').append(divValue);
    }


</script>
{{ submit_button("Submit") }}
{% endif %}

{{ end_form() }}