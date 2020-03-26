
<h1>
    {{ link_to("usergroups/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    User Group
    <small class="on-right">Edit</small>
</h1>

{{ content() }}

{{ form("usergroups/save", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="GroupName">Group Name</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("GroupName", "size" : 30) }}
            </div>

            {{ hidden_field("RecID") }}
            {{ submit_button("Simpan") }}
        </div>
    </div>
</div>
{{ end_form() }}
{{ hidden_field("dataTableUrl") }}
<h2>
    <small class="padding10">
        <a href="#" id="createDetail">Create<i class="icon-plus on-right smaller"></i></a>
    </small>
</h2>
<table id="dataTable" class="table bordered striped hovered">
    <thead>
        <tr>
            <th>Menu Items</th>
            <th>Action Name</th>
            <th colspan="2"></th>
         </tr>
    </thead>
    <tbody></tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="place-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
    $("#createDetail").on("click", function(){
        $("#myModal .modal-title").html("Create Usergroups Detail");
        $("#myModal .modal-body").load('{{url("usergroupsdetail/new/"~RecID)}}', function(e){
            $("#myModal").modal('show');
        });
    });
    $("#dataTable tbody").on("click", "#editBtn", function(){
        var detailId = $(this).attr("data-value");
        $("#myModal .modal-title").html("Edit Usergroups Detail");
        $("#myModal .modal-body").load('{{url("usergroupsdetail/edit/")}}'+detailId, function(e){
            $("#myModal").modal('show');
        });
    });
</script>
{{ javascript_include('js/usergroups.js') }}