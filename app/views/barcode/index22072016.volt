
<div class="frames">
    <legend><h1>Input Data Barcode</h1></legend>
</div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>

{{ content() }}

{{ form("barcode/tambah", "method":"post") }}

<div class="grid fluid" data-bind="nextFieldOnEnter:true">
{% if rpt_auth['areaparent'] is null %}
    <div class="row">
    {% if rpt_auth['areacabang'] == 0 %}
        <div class="span4">
            <label for="ViewType">Area</label>
            <div class="input-control select">
                {{ select("Area", area, "using" : ["RecID", "NamaAreaCabang"],
                'useEmpty': true, 'emptyText': '---', 'emptyValue': '', 'onchange' : 'myFunction()') }}
            </div>
        </div>

        <div class="span4">
            <label for="ViewType">Cabang</label>
            <div class="input-control select">
                <select id="Cabang" name="Cabang" onchange="myFunction()"></select>
            </div>
        </div>
    {% else %}
        {{ hidden_field("Area") }}
    {% endif %}
    </div>
<div class="row no-margin">
{% else %}
{% endif %}

<div id="test2" data-bind="nextFieldOnEnter:true" hidden>
<legend>Silahkan Masukkan Barcode Disini</legend>
    <div id="test3" data-bind="nextFieldOnEnter:true">

        
<div class="row no-margin">
        <div class="span4">
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 1"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 2"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 3"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 4"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 5"></input> 
            </div>
            <div id="bc1" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom1()" value="Tambah Kolom"/>
            </div>
        </div>
       
        <div id="kolom1" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 6"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 7"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 8"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 9"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 10"></input> 
            </div>
            <div id="bc2" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom2()" value="Tambah Kolom"/>
            </div>
        </div>
        <div id="kolom2" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 11"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 12"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 13"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 14"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 15"></input> 
            </div>
            <div id="bc3" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom3()" value="Tambah Kolom"/>
            </div>
        </div>
        </div>

        <div class="row">
        <div id="kolom3" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 16"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 17"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 18"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 19"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 20"></input> 
            </div>
            <div id="bc4" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom4()" value="Tambah Kolom"/>
            </div>
        </div>
       
        <div id="kolom4" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 21"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 22"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 23"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 24"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 25"></input> 
            </div>
            <div id="bc5" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom5()" value="Tambah Kolom"/>
            </div>
        </div>
        <div id="kolom5" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 26"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 27"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 28"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 29"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 30"></input> 
            </div>
            <div id="bc6" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom6()" value="Tambah Kolom"/>
            </div>
            </div>
        </div>


        <!--Kolom 31 sampai 60-->


        <div class="row">
        <div id="kolom6"class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 31"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 32"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 33"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 34"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 35"></input> 
            </div>
            <div id="bc7" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom7()" value="Tambah Kolom"/>
            </div>
        </div>
       
        <div id="kolom7" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 36"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 37"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 38"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 39"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 40"></input> 
            </div>
            <div id="bc8" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom8()" value="Tambah Kolom"/>
            </div>
        </div>
        <div id="kolom8" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 41"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 42"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 43"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 44"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 45"></input> 
            </div>
            <div id="bc9" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom9()" value="Tambah Kolom"/>
            </div>
        </div>
        </div>

        <div class="row">
        <div id="kolom9" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 46"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 47"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 48"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 49"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 50"></input> 
            </div>
            <div id="bc10" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom10()" value="Tambah Kolom"/>
            </div>
        </div>
       
        <div id="kolom10" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 51"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 52"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 53"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 54"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 55"></input> 
            </div>
            <div id="bc11" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom11()" value="Tambah Kolom"/>
            </div>
        </div>
        <div id="kolom11" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 56"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 57"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 58"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 59"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 60"></input> 
            </div>
            <div id="bc12" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom12()" value="Tambah Kolom"/>
            </div>
        </div>
        </div>


        <!-- 61 sampai 120 -->

        <div class="row">
        <div id="kolom12" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 61"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 62"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 63"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 64"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 65"></input> 
            </div>
            <div id="bc13" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom13()" value="Tambah Kolom"/>
            </div>
        </div>
       
        <div id="kolom13" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 66"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 67"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 68"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 69"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 70"></input> 
            </div>
            <div id="bc14" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom14()" value="Tambah Kolom"/>
            </div>
        </div>
        <div id="kolom14" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 71"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 72"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 73"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 74"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 75"></input> 
            </div>
            <div id="bc15" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom15()" value="Tambah Kolom"/>
            </div>
        </div>
        </div>

        <div class="row">
        <div id="kolom15" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 76"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 77"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 78"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 79"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 80"></input> 
            </div>
            <div id="bc16" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom16()" value="Tambah Kolom"/>
            </div>
        </div>
       
        <div id="kolom16" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 81"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 82"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 83"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 84"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 85"></input> 
            </div>
            <div id="bc17" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom17()" value="Tambah Kolom"/>
            </div>
        </div>
        <div id="kolom17" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 86"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 87"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 88"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 89"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 90"></input> 
            </div>
            <div id="bc18" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom18()" value="Tambah Kolom"/>
            </div>
            </div>
        </div>

        <div class="row">
        <div id="kolom18"class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 91"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 92"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 93"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 94"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 95"></input> 
            </div>
            <div id="bc19" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom19()" value="Tambah Kolom"/>
            </div>
        </div>
       
        <div id="kolom19" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 96"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 97"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 98"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 99"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 100"></input> 
            </div>
            <div id="bc20" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom20()" value="Tambah Kolom"/>
            </div>
        </div>
        <div id="kolom20" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 101"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 102"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 103"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 104"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 105"></input> 
            </div>
            <div id="bc21" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom21()" value="Tambah Kolom"/>
            </div>
        </div>
        </div>

        <div class="row">
        <div id="kolom21" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 106"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 107"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 108"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 109"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 110"></input> 
            </div>
            <div id="bc22" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom22()" value="Tambah Kolom"/>
            </div>
        </div>
       
        <div id="kolom22" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 111"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 112"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 113"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 114"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 115"></input> 
            </div>
            <div id="bc23" class="text-right" hidden>
                <input type="button" class="primary" maxlength="14" name="submit" onclick="Kolom23()" value="Tambah Kolom"/>
            </div>
        </div>
        <div id="kolom23" class="span4" hidden>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 116"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 117"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 118"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 119"></input> 
            </div>
            <div class="input-control text" data-role="input-control">
               <input type="text" id="Barcode" name="Barcode[]" maxlength="14" placeholder="Barcode 120"></input> 
            </div>
            <div id="bc24" class="text-right" hidden>
                <font color="red">*Maksimal 120 kolom.</font>
            </div>
        </div>
        </div>
<legend></legend>
        <div class="row no-margin">
        <input type="submit" class="primary large" id="submit" name="submit" value="Simpan"/>
    </div></div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <input type="button" value="Batal" data-dismiss="modal">
                <input type="button" value="Lanjutkan" id="btn-submit">
            </div>
        </div>
    </div>
</div>

{{ end_form() }}
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

function myFunction() {
    var cab = document.getElementById("Cabang").value;
    var area = document.getElementById("Area").value;

    if(cab !== ""){
    document.getElementById("test2").style.display = "block";
    document.getElementById("bc1").style.display = "block";
    document.getElementById("kolom1").style.display = "";
    document.getElementById("kolom2").style.display = "";
    document.getElementById("kolom3").style.display = "";
    document.getElementById("kolom4").style.display = "";
    document.getElementById("kolom5").style.display = "";
    document.getElementById("kolom6").style.display = "";
    document.getElementById("kolom7").style.display = "";
    document.getElementById("kolom8").style.display = "";
    document.getElementById("kolom9").style.display = "";
    document.getElementById("kolom10").style.display = "";
    document.getElementById("kolom11").style.display = "";
    document.getElementById("kolom12").style.display = "";
    document.getElementById("kolom13").style.display = "";
    document.getElementById("kolom14").style.display = "";
    document.getElementById("kolom15").style.display = "";
    document.getElementById("kolom16").style.display = "";
    document.getElementById("kolom17").style.display = "";
    document.getElementById("kolom18").style.display = "";
    document.getElementById("kolom19").style.display = "";
    document.getElementById("kolom20").style.display = "";
    document.getElementById("kolom21").style.display = "";
    document.getElementById("kolom22").style.display = "";
    document.getElementById("kolom23").style.display = "";
    }

    if(cab == ""){
    document.getElementById("test2").style.display = "";
    document.getElementById("bc1").style.display = "";
    document.getElementById("kolom1").style.display = "";
    document.getElementById("kolom2").style.display = "";
    document.getElementById("kolom3").style.display = "";
    document.getElementById("kolom4").style.display = "";
    document.getElementById("kolom5").style.display = "";
    document.getElementById("kolom6").style.display = "";
    document.getElementById("kolom7").style.display = "";
    document.getElementById("kolom8").style.display = "";
    document.getElementById("kolom9").style.display = "";
    document.getElementById("kolom10").style.display = "";
    document.getElementById("kolom11").style.display = "";
    document.getElementById("kolom12").style.display = "";
    document.getElementById("kolom13").style.display = "";
    document.getElementById("kolom14").style.display = "";
    document.getElementById("kolom15").style.display = "";
    document.getElementById("kolom16").style.display = "";
    document.getElementById("kolom17").style.display = "";
    document.getElementById("kolom18").style.display = "";
    document.getElementById("kolom19").style.display = "";
    document.getElementById("kolom20").style.display = "";
    document.getElementById("kolom21").style.display = "";
    document.getElementById("kolom22").style.display = "";
    document.getElementById("kolom23").style.display = "";
    }  

}

function Kolom1() {
         document.getElementById("kolom1").style.display = "block";
         document.getElementById("bc1").style.display = "";
         document.getElementById("bc2").style.display = "block";
}

function Kolom2() {
         document.getElementById("kolom2").style.display = "block";
         document.getElementById("bc2").style.display = "";
         document.getElementById("bc3").style.display = "block";
         
}

function Kolom3() {
         document.getElementById("kolom3").style.display = "block";
         document.getElementById("bc3").style.display = "";
         document.getElementById("bc4").style.display = "block";
}

function Kolom4() {
         document.getElementById("kolom4").style.display = "block";
         document.getElementById("bc4").style.display = "";
         document.getElementById("bc5").style.display = "block";
}

function Kolom5() {
         document.getElementById("kolom5").style.display = "block";
         document.getElementById("bc5").style.display = "";
         document.getElementById("bc6").style.display = "block";
}

function Kolom6() {
         document.getElementById("kolom6").style.display = "block";
         document.getElementById("bc6").style.display = "";
         document.getElementById("bc7").style.display = "block";
}

function Kolom7() {
         document.getElementById("kolom7").style.display = "block";
         document.getElementById("bc7").style.display = "";
         document.getElementById("bc8").style.display = "block";
}

function Kolom8() {
         document.getElementById("kolom8").style.display = "block";
         document.getElementById("bc8").style.display = "";
         document.getElementById("bc9").style.display = "block";
}

function Kolom9() {
         document.getElementById("kolom9").style.display = "block";
         document.getElementById("bc9").style.display = "";
         document.getElementById("bc10").style.display = "block";
}

function Kolom10() {
         document.getElementById("kolom10").style.display = "block";
         document.getElementById("bc10").style.display = "";
         document.getElementById("bc11").style.display = "block";
}

function Kolom11() {
         document.getElementById("kolom11").style.display = "block";
         document.getElementById("bc11").style.display = "";
         document.getElementById("bc12").style.display = "block";
}

function Kolom12() {
         document.getElementById("kolom12").style.display = "block";
         document.getElementById("bc12").style.display = "";
         document.getElementById("bc13").style.display = "block";
}

function Kolom13() {
         document.getElementById("kolom13").style.display = "block";
         document.getElementById("bc13").style.display = "";
         document.getElementById("bc14").style.display = "block";
}

function Kolom14() {
         document.getElementById("kolom14").style.display = "block";
         document.getElementById("bc14").style.display = "";
         document.getElementById("bc15").style.display = "block";
}

function Kolom15() {
         document.getElementById("kolom15").style.display = "block";
         document.getElementById("bc15").style.display = "";
         document.getElementById("bc16").style.display = "block";
}

function Kolom16() {
         document.getElementById("kolom16").style.display = "block";
         document.getElementById("bc16").style.display = "";
         document.getElementById("bc17").style.display = "block";
}

function Kolom17() {
         document.getElementById("kolom17").style.display = "block";
         document.getElementById("bc17").style.display = "";
         document.getElementById("bc18").style.display = "block";
}

function Kolom18() {
         document.getElementById("kolom18").style.display = "block";
         document.getElementById("bc18").style.display = "";
         document.getElementById("bc19").style.display = "block";
}

function Kolom19() {
         document.getElementById("kolom19").style.display = "block";
         document.getElementById("bc19").style.display = "";
         document.getElementById("bc20").style.display = "block";
}

function Kolom20() {
         document.getElementById("kolom20").style.display = "block";
         document.getElementById("bc20").style.display = "";
         document.getElementById("bc21").style.display = "block";
}

function Kolom21() {
         document.getElementById("kolom21").style.display = "block";
         document.getElementById("bc21").style.display = "";
         document.getElementById("bc22").style.display = "block";
}

function Kolom22() {
         document.getElementById("kolom22").style.display = "block";
         document.getElementById("bc22").style.display = "";
         document.getElementById("bc23").style.display = "block";
}

function Kolom23() {
         document.getElementById("kolom23").style.display = "block";
         document.getElementById("bc23").style.display = "";
         document.getElementById("bc24").style.display = "block";
}

$('#Barcode').keyup(function () {
    if (this.value.length == this.maxLength) {
      $(this).next('#Barcode').focus();
    }
});
</script>

<script type="text/javascript">
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function(element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input', function (e) {
                var self = $(this)
                , form = $(element)
                  , focusable
                  , next
                ;
                if (e.keyCode == 13) {
                    focusable = form.find('input,a,button,textarea').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length -1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
            });
        }
    };

    ko.applyBindings({});
</script>


{% endif %}
