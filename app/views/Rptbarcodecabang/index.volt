<h1>
    Data Stok Barcode Buku
</h1>

{{ content() }}

{{ form("rptbarcodecabang/view", "method":"post", "target" : "_blank") }}

<div class="grid fluid">
    <div class="row no-margin">
        <div class="span6">
            <label for="TA">Pilih Stok</label>
            <div class="input-control select" data-role="input-control">
            <select id="pr" name="pr" onchange="showDiv(this)">
            <option value="">---</option>
            <option value="1">TA 2016/2017 (Barcode Lama)</option>
            <option value="2">TA 2017/2018</option>
            <option value="3">ALL</option>
            </select>
            </div>

            <div id="stepsHIDDEN" style='display:none;'>
            <label for="ViewType">Pilih PR / Kode Pembelian</label>
            <div class="input-control select">
                {{ select("PRecId", PRecId, "using" : ["RecId", "PurchReqId"],
                'useEmpty': true, 'emptyText': '-- ALL --', 'emptyValue': '') }}
            </div>
            </div>
        </div>
        </div>
        <button onclick="">Tampilkan</button>
</div>
<script>
                    function showDiv(elem){
                          if(elem.value == '1' || elem.value == '3' || elem.value == ''){
                            document.getElementById('stepsHIDDEN').style.display = "none";
                          } 
                          else{ 
                            document.getElementById('stepsHIDDEN').style.display = "block";
                          }
                        }
</script>