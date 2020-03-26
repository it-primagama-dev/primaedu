$(document).ready(function () {
    //$("#dataTable");
    url = $("#dataTableUrl").val();
    $.getJSON(url).done(function (data) {
        if (data.status === "OK") {
            var z = 0;
            $.each(data.listData, function (i, list) {
                $("<tr>").appendTo("#dataTable tbody").attr("class", "detailItem").append(
                    $(document.createElement('td')).text(list.Tanggal),
                    $(document.createElement('td')).text(list.Jam),
                    $(document.createElement('td')).text(list.Ruangan),
                    $(document.createElement('td')).text(list.Guru),
                    $(document.createElement('td')).text(list.BidangStudi),
                    $(document.createElement('td')).html('<a href="#" id="editBtn" data-value="'+list.id+'">Edit</a>'),
                    $(document.createElement('td')).html('<a href="'+data.deleteUrl+'/'+list.id+'">Delete</a>')
                    );
                z += 1;
            });
        }
    });
});

