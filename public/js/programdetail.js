$(document).ready(function () {
    //$("#dataTable");
    url = $("#dataTableUrl").val();
    $.getJSON(url).done(function (data) {
        if (data.status === "OK") {
            var z = 0;
            $.each(data.listData, function (i, list) {
                $("<tr>").appendTo("#dataTable tbody").attr("class", "detailItem").append(
                        $(document.createElement('td')).text(),
                        $(document.createElement('td')).text(list.nama),
                        $(document.createElement('td')).text(list.bidangstudi),
                        $(document.createElement('td')).text(list.bobot),
                        $(document.createElement('td')).attr("width", "7%").html('<a href="#" id="editBtn" data-value="'+list.id+'">Edit</a>'),
                        $(document.createElement('td')).attr("width", "7%").html('<a href="'+data.deleteUrl+'/'+list.id+'">Delete</a>')
                        );
                z += 1;
            });
        }
    });
});