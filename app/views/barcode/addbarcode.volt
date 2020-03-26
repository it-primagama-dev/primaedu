{{ content() }}
<html>
    <head>
        {{ get_title() }}
        {{ assets.outputCss('cssHeader') }}
        {{ assets.outputJs('jsHeader') }}
    </head>
            <input type="hidden" name="Area" id="Area" value="{{ rpt_cabang }}">
            {{ form("barcode/tambah") }}

            <input type="hidden" name="Cabang" id="Cabang" value="{{ rpt_cabang }}">
            <input type="hidden" name="Area" id="Area" value="{{ rpt_area }}">
            <input type="hidden" name="Kodepr" id="Kodepr" value="{{ rpt_pr }}">
            <div class="grid fluid"><br>    
    <p class="place-right">
        <a href="{{ url("barcode/downloadform/") }}{{ rpt_prExcel }}"><i class="icon-download-2 on-left-more smaller"></i>Unduh File Excel</a>
    </p>
                        <font size="6">
            {{ link_to("barcode/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }} Input Barcode</font> <font size="4">- Cabang : {{ rpt_namacabang }} - <strong>{{ rpt_pr2 }}</strong></font>
                <div class="row">
                    <div class="span4">
                        <div class="input-control text" data-role="input-control">
                            {{ text_field("Barcode", "type": "number", "maxlength" : "14", "Placeholder" : "Scan Barcode Disini") }}
                        </div>
                    </div>
                    <div class="span4">
                        <div class="input-control text" data-role="input-control" align="center">
                        <strong>Jumlah Barcode {{ rpt_pr2 }}</strong> <br> <h2><strong><font color="red">
                        {% if jumlahpr is defined %}
                        {% for list in jumlahpr %}
                        {{ list.jumlahpr }}
                        {% endfor %}
                        {% endif %}
                        </font></strong></h2>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="input-control text" data-role="input-control" align="center">
                        <strong>Jumlah Total Barcode Cabang {{ rpt_kodecabang }}</strong><br> <h2><strong><font color="red">
                        {% if jumlah is defined %}
                        {% for list in jumlah %}
                        {{ list.jumlah }}
                        {% endfor %}
                        {% endif %}
                        </font></strong></h2>
                        </div>
                    </div>  
                </div>
                </div>
            {{ end_form() }}
            {{ form("barcode/uploadbarcode", "method":"post","enctype": "multipart/form-data") }}            
            <input type="hidden" name="Cabang" id="Cabang" value="{{ rpt_cabang }}">
            <input type="hidden" name="Kodepr" id="Kodepr" value="{{ rpt_pr }}">
                    <div class="row">
                        <div class="span3">          
                        <label for="excel">Upload Barcode Dengan File Excel</label>
                        <div class="input-control file" data-role="input-control">
                            <?php echo $this->tag->fileField(array("excel")) ?>
                            <button class="btn-file"></button>
                        </div>
                        </div>
                        <div class="span3"> 
                            {{ submit_button("Simpan") }}
                        </div>
                    </div>
            {{ end_form() }}
                {{ flash.output() }}
                        <legend></legend>
     <table class="table bordered striped hovered" style="width: 100%; border-collapse: collapse">
    <thead>
        <tr>
            <th width="5%">No.</th>
            <th width="25%%">PR</th>
            <th width="25%%">Barcode</th>
            <th width="45%">Nama Buku</th>
         </tr>
    </thead> 
    <tbody>
    {% if page.items is not empty %}
    {% for list in page.items %}
                <tr>
                <td align="center">{{ loop.index }}</td>
                <td align="center">{{ list.PurchReqId }}</td>
                <td align="center">{{ list.Barcode }}</td>
                <td align="center">{{ list.NamaItem }}
                </td>
                
                </tr>
    {% endfor %}
    {% else %}
        <tr>
            <td colspan="6" align="center">- Tidak Ada Data -</td>
        </tr>
    {% endif %}
    </tbody>
    </table>


        <script type="text/javascript">
            $(document).ready(function () {
                input2 = document.getElementById("Barcode");
                input2.value = "";
                input2.focus();

                input3 = document.getElementById("Cabang");
                input3.value = document.getElementById("Cabang").value;
            });
            $(".alert").fadeTo(5000, 500).slideUp(500, function () {
                $(this).alert('close');
            });
        </script>
        {{ javascript_include('js/metro.min.js') }}
        {{ javascript_include('js/custom.min.js') }}
    </body>
</html>