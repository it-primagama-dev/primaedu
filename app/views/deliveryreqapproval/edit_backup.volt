{{ content() }}
{{ form("purchreqheader/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("purchreqheader", "Go Back") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Detail Pembelian</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="PurchReqId">ID</label>
        </td>
        <td align="left">
            {{ text_field("PurchReqId", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="PurchReqName">Name</label>
        </td>
        <td align="left">
            {{ text_field("PurchReqName", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="Requester">Requester</label>
        </td>
        <td align="left">
            {{ text_field("Requester", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="PurchReqDate">Date</label>
        </td>
        <td align="left">
                {{ text_field("PurchReqDate", "type" : "date") }}
        </td>
    </tr>
    

    <tr>
        <td>{{ hidden_field("RecId") }}</td>
        <td>{{ submit_button("Simpan") }}</td>
    </tr>
</table>

</form>

{{ hidden_field("dataTableUrl") }}
<h2>
    <small class="padding10">
        <a href="#" id="createProgramDetail">Tambah Detail Pembelian<i class="icon-plus on-right smaller"></i></a>
    </small>
</h2>
<table id="dataTable" class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Kode Item</th>
            <th>Nama Item</th>
            <th>Qty</th>
            <th colspan="2">Action</th>
         </tr>
    </thead>
    <tbody></tbody>
</table>
<script>
    $("#createProgramDetail").on("click", function(){
        $.Dialog({
            overlay: false,
            shadow: true,
            draggable: true,
            width: 450,
            height: 300,
            title: 'Tambah Detail Item',
            content: '',
            onShow: function(_dialog){
                var content = _dialog.children('.content');
                $.get('{{url("purchreqline/new/"~RecId)}}', function(data){
                    content.html(data);
                });
            }
        });
    });
    $("#dataTable tbody").on("click", "#editBtn", function(){
        var detailId = $(this).attr("data-value");
        $.Dialog({
            overlay: false,
            shadow: true,
            draggable: true,
            width: 480,
            height: 360,
            title: 'Edit Detail Item',
            content: '',
            onShow: function(_dialog){
                $.get('{{url("purchreqline/edit/")}}'+detailId, function(data){
                   $.Dialog.content(data) 
                });
            }
        });
    });
</script>
{{ javascript_include('js/purchreqline.js') }}
