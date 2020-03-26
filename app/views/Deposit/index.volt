{{ content() }}

<h1>
    Deposit
    <small class="on-right">Cabang</small>
</h1>


<div class="tab-control" data-role="tab-control" data-effect="fade">
    <ul class="tabs">
        <li class="active"><a href="#_tab1">Input Deposit</a></li>
        <li><a href="#_tab2">Lihat Deposit / Invoice</a></li>
    </ul>
    <div class="frames">
        <div class="frame" id="_tab1"> 
                    {{ content() }}

                    {{ flash.output() }}
                    {{ form("deposit/save", "method":"post") }}
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

                        <div class="row no-margin">
                            <div class="span4">
                                <label for="ViewType">Kode PR / Kode Pembelian</label>
                                <div class="input-control select">
                                    <select id="Kodepr" name="Kodepr" onchange="showDiv(this)"></select>
                                </div>
                            </div>
                        </div>

                        <div id="detailkodepr">

                        </div>

                        <div id="stepsHIDDEN" style='display:none;'>
                            <div class="row no-margin">
                            <div class="span8">
                                <label for="Keterangan">Keterangan (Deposit Lainnya)</label>
                                <div class="input-control text" data-role="input-control">
                                    {{ text_field("Keterangan", "maxlength" : 300, "placeholder":"Wajib Diisi") }}
                                </div>
                            </div>
                            </div>
                            <div class="row margin">
                            <div class="span4">
                            <button onclick="">Simpan</button>
                            </div>
                            </div>
                        </div>
                    {{ end_form() }}

                    <script type="text/javascript">

                    $(document).ready(function(){
                        optCabang();
                        $('#Area').on('change', function(){optCabang();});
                        $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
                    });
                    function optCabang() {
                        url = '{{ url('deposit/getcabang/') }}' + $('#Area').val();
                        $.get(url).done(function(data){$('#Cabang').html(data);});
                    }

                    $(document).ready(function(){
                        optKodepr();
                        $('#Cabang').on('change', function(){optKodepr();});
                    });
                    function optKodepr() {
                        url = '{{ url('deposit/getkodepr/') }}' + $('#Cabang').val();
                        $.get(url).done(function(data){$('#Kodepr').html(data);});
                    }

                    function showDiv(elem){
                          if(elem.value == ''){
                            document.getElementById('stepsHIDDEN').style.display = "none";
                          } 
                          else{ 
                            document.getElementById('stepsHIDDEN').style.display = "block";
                          }
                        }

                    </script>
                    <script>
                    $(document).ready(function() {
                        $("#Kodepr").change(function(){
                        var Kodepr = $("#Kodepr").val();
                        var Cabang = $("#Cabang").val();
            
                        $.ajax({
                        type: "POST",
                        url : '{{ url('deposit/detailkodepr') }}',
                        data:"Kodepr="+Kodepr+"&Cabang="+Cabang,
                        cache:false,
                        success: function(data){
                            $('#detailkodepr').html(data);
                            document.frm.add.disabled=false;
                                }
                            });
                        });
                    })
                    </script>

        </div>
        <div class="frame" id="_tab2">
<form id='userForm'>
                        <div class="row">
                            <div class="span4">
                                <label for="ViewType">Area</label>
                                <div class="input-control select">
                                    {{ select("Area1", area, "using" : ["RecID", "NamaAreaCabang"],
                                    'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
                                </div>
                            </div>
                        </div>

                        <div class="row no-margin">
                            <div class="span4">
                                <label for="ViewType">Cabang</label>
                                <div class="input-control select">
                                    <select id="Cabang1" name="Cabang"></select>
                                </div>
                            </div>
                        </div>

                        <div class="row no-margin">
                            <div class="span4">
                                <label for="ViewType">Kode PR / Kode Pembelian</label>
                                <div class="input-control select">
                                    <select id="Kodepr1" name="Kodepr1" onchange="showDiv1(this)"></select>
                                </div>
                            </div>
                        </div>

                        <div id="stepsHIDDEN1" style='display:none;'>
                            <div>
                            <div class="span4">
                            <button onclick="">Tampilkan</button>
                            </div>
                            </div>
                        </div>
                    </form>
                    <div id='response'></div>
                    <script type="text/javascript">
                    $(document).ready(function(){
                        optCabang1();
                        $('#Area1').on('change', function(){optCabang1();});
                    });
                    function optCabang1() {
                        url = '{{ url('deposit/getcabang/') }}' + $('#Area1').val();
                        $.get(url).done(function(data){$('#Cabang1').html(data);});
                    }

                    $(document).ready(function(){
                        optKodepr1();
                        $('#Cabang1').on('change', function(){optKodepr1();});
                    });
                    function optKodepr1() {
                        url = '{{ url('deposit/getkodepr1/') }}' + $('#Cabang1').val();
                        $.get(url).done(function(data){$('#Kodepr1').html(data);});
                    }

                    function showDiv1(elem){
                          if(elem.value == ''){
                            document.getElementById('stepsHIDDEN1').style.display = "none";
                          } 
                          else{ 
                            document.getElementById('stepsHIDDEN1').style.display = "block";
                          }
                        }

                    </script>
                    <script>
                    $(document).ready(function(){
                        $('#userForm').submit(function(){
                            
                            $('#response').html("<b>Loading response...</b>");
                            $(".loader").show();

                            $.ajax({
                                type: 'POST',
                                url: 'Deposit/view',
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
    </div>
</div>