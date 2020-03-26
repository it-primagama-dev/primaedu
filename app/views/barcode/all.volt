{{ content() }}
<html>
    <head>
        {{ get_title() }}
        {{ assets.outputCss('cssHeader') }}
        {{ assets.outputJs('jsHeader') }}
    </head>
            <input type="hidden" name="Area" id="Area" value="{{ rpt_cabang }}">

            <input type="hidden" name="Cabang" id="Cabang" value="{{ rpt_cabang }}">
            <input type="hidden" name="Area" id="Area" value="{{ rpt_area }}">
            <div class="grid fluid"><br>
                        <font size="6">
            {{ link_to("barcode/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }} Data Barcode</font> <font size="4">- Area : {{ rpt_namaarea }}, Cabang : {{ rpt_namacabang }}</font>
                        <legend></legend>
     <table class="table bordered striped hovered" style="width: 100%; border-collapse: collapse">
    <thead>
        <tr>
            <th width="5%">No.</th>
            <th width="35%%">Barcode</th>
            <th width="40%">Jenjang</th>
            <th width="20%">Action</th>
         </tr>
    </thead> 
    <tbody>
    {% if page.items is not empty %}
    {% for list in page.items %}
                <tr>
                <td align="center">{{ loop.index }}</td>
                <td align="center">{{ list.Barcode }}</td>
                <td align="center">{{ list.NamaJenjang }}</td>
                <td align="center">{{ link_to("barcode/edit/"~list.RecID, "Edit") }} || {{ link_to("barcode/delete/"~list.RecID, "Delete") }}</td>
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