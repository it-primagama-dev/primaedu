{{ content() }}

<h1><p class="place-right">
<?php echo $this->tag->linkTo("barcode/detail", "Pencarian Detail Barcode") ?>
</p>
    Barcode
    <small class="on-right">Smartbook Cabang</small>
</h1>


<div class="tab-control" data-role="tab-control" data-effect="fade">
    <ul class="tabs">
        <li class="active"><a href="#_tab1">Input Barcode Cabang</a></li>
        <li><a href="#_tab2">Data Barcode Cabang</a></li>
    </ul>
    <div class="frames">
        <div class="frame" id="_tab1"> 
            <h1>{{ rpt_title }}</h1>

            {{ content() }}

            {{ form("barcode/addbarcode", "method":"post") }}

            <div class="grid fluid">

                <div class="row no-margin">
                    <div class="span4">
                        <label for="Cabang" class="no-padding">Kode / Nama Cabang</label>
                        <div class="input-control" data-role="input-control">
                            {{ select("Cabang", cabangtx, "using" : ["RecId","NamaCabang"],
                                        "useEmpty": true, "emptyValue": "", "emptyText": "---",
                                         "style" : "width:100%") }}
                        </div>
                    </div>
                </div>    

                <div class="row no-margin">
                    <div class="span4">
                        <label for="TA">Pilih Stok</label>
                        <div class="input-control select" data-role="input-control">
                        <select id="pr" name="pr" onchange="showDiv(this)">
                        <option value="">---</option>
                        <option value="1">TA 2016/2017 (Barcode Lama)</option>
                        <option value="2">TA 2017/2018</option>
                        </select>
                        </div>
                    </div>
                </div> 

                <div id="stepsHIDDEN" style='display:none;'>
                <div class="row no-margin">
                    <div class="span4">
                        <label for="ViewType">Kode PR / Kode Pembelian</label>
                        <div class="input-control select">
                             <select id="Kodepr" name="Kodepr" onchange="showDivPR(this)"></select>
                        </div>
                    </div>
                </div>
                </div>

                <div id="stepsHIDDENbutton" style='display:none;'>
                <div class="row no-margin">
                <div class="row">
                    <button><strong>Input Barcode</strong></button>
                </div>
                </div>
                </div>
            </div>
            {{ end_form() }}

            {{ stylesheet_link('css/select2.custom.min.css') }}
            {{ javascript_include('js/select2.min.js') }}
            <script type="text/javascript">
                $(function () {
                    $('#Cabang').select2();
                });
            </script>

            <script type="text/javascript">

            $(document).ready(function(){
                optKodepr();
                $('#Cabang').on('change', function(){optKodepr();});
                                });
            function optKodepr() {
                 url = '{{ url('barcode/getkodepr/') }}' + $('#Cabang').val();
                $.get(url).done(function(data){$('#Kodepr').html(data);});
            }
            function showDiv(elem){
                    if(elem.value == '1'){
                     document.getElementById('stepsHIDDEN').style.display = "none";
                     document.getElementById('stepsHIDDENbutton').style.display = "block";
                    } else if (elem.value == '2'){ 
                      document.getElementById('stepsHIDDEN').style.display = "block";
                      document.getElementById('stepsHIDDENbutton').style.display = "none";
                    } else {
                     document.getElementById('stepsHIDDENbutton').style.display = "none";
                     document.getElementById('stepsHIDDEN').style.display = "none";
                    }
                 }
            function showDivPR(elem){
                    if(elem.value != ''){
                     document.getElementById('stepsHIDDENbutton').style.display = "block";
                    } else {
                     document.getElementById('stepsHIDDENbutton').style.display = "none";
                    }
                 }
            </script>

            </div>
        <div class="frame" id="_tab2">

            <h1>{{ rpt_title }}</h1>

            {{ content() }}

            {{ form("barcode/view", "method":"post", "target" : "_blank") }}

            <div class="grid fluid">

                <div class="row no-margin">
                    <div class="span4">
                        <label for="Cabang" class="no-padding">Kode / Nama Cabang</label>
                        <div class="input-control" data-role="input-control">
                            {{ select("Cabang2", cabangtx, "using" : ["RecId","NamaCabang"],
                                        "useEmpty": true, "emptyValue": "", "emptyText": "---",
                                         "style" : "width:100%") }}
                        </div>
                    </div>
                </div>      
                <div class="row no-margin">
                    <div class="span4">
                        <label for="TA">Pilih Stok</label>
                        <div class="input-control select" data-role="input-control">
                        <select id="pr2" name="pr2" onchange="showDiv2(this)">
                        <option value="">---</option>
                        <option value="1">TA 2016/2017 (Barcode Lama)</option>
                        <option value="2">TA 2017/2018</option>
                        </select>
                        </div>
                    </div>
                </div>                   
                <div id="stepsHIDDEN2" style='display:none;'>
                <div class="row no-margin">
                    <div class="span4">
                        <label for="ViewType">Kode PR / Kode Pembelian</label>
                        <div class="input-control select">
                             <select id="Kodepr2" name="Kodepr2" onchange="showDivPR2(this)"></select>
                        </div>
                    </div>
                </div>
                </div>

                <div id="stepsHIDDENbutton2" style='display:none;'>
                <div class="row no-margin">
                <div class="row">
                    <button><strong>Lihat Barcode</strong></button>
                </div>
                </div>
                </div>
            </div>
            {{ end_form() }}

            {{ stylesheet_link('css/select2.custom.min.css') }}
            {{ javascript_include('js/select2.min.js') }}
            <script type="text/javascript">
                $(function () {
                    $('#Cabang2').select2();
                });
            </script>
            <script type="text/javascript">

            $(document).ready(function(){
                optKodepr2();
                $('#Cabang2').on('change', function(){optKodepr2();});
                                });
            function optKodepr2() {
                 url = '{{ url('barcode/getkodepr/') }}' + $('#Cabang2').val();
                $.get(url).done(function(data){$('#Kodepr2').html(data);});
            }
            function showDiv2(elem){
                    if(elem.value == '1'){
                     document.getElementById('stepsHIDDEN2').style.display = "none";
                     document.getElementById('stepsHIDDENbutton2').style.display = "block";
                    } else if (elem.value == '2'){ 
                      document.getElementById('stepsHIDDEN2').style.display = "block";
                      document.getElementById('stepsHIDDENbutton2').style.display = "none";
                    } else {
                     document.getElementById('stepsHIDDENbutton2').style.display = "none";
                     document.getElementById('stepsHIDDEN2').style.display = "none";
                    }
                 }
            function showDivPR2(elem){
                    if(elem.value != ''){
                     document.getElementById('stepsHIDDENbutton2').style.display = "block";
                    } else {
                     document.getElementById('stepsHIDDENbutton2').style.display = "none";
                    }
                 }
            </script>
        </div>
    </div>
</div>