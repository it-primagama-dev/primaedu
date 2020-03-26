{{ content() }}

{{ form("refund/ubahfinance", "method":"post","enctype": "multipart/form-data","id":"approved3") }}
<div class="grid fluid no-margin">
    <div class="row">
        <div class="col-md-12">
            {% if username == 'rini' OR username == 'ukky' OR username == 'devyana' %}
            <div class="btn-group place-right">
                <div class="input-control select" data-role="input-control" style="margin-top: 3px;margin-left: 7px;">
                    {{ select_static("onchange":"ganti4('this')","ubahstatus4","name":"ubahstatus", ["":"Ubah Status","Approved" : "Approved", "Rejected" : "Rejected"]) }}
                </div>
            </div>
            {% endif %}
            <table id="dt-refund-deposit" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th style="display:none">RecID</th>
                        <th>No</th>
                        <th>Kd Cabang</th>
                        <th>No. VA Salah</th>
                        <th>No. VA Benar</th>
                        <th>No. Surat</th>
                        <th>Tanggal Transfer</th>
                        <th>Jumlah Transfer</th>
                        <th>Track Account Receivable</th>
                        <!--<th>Track Finance</th>-->
                        <th style="display:none">Jenis Refund</th>
                        <th data-sortable="false">Aksi</th>
                        <th style="text-align: center;" data-sortable="false">
                            <input type="checkbox" onchange="checkAll(this)" name="chk[]" />
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {% for key,rows in list_refund_deposit %}
                    <tr>
                        <td style="display:none">{{ rows.RecID }}</td>
                        <td>{{ key+1 }}</td>
                        <td>{{ rows.CreateBy }}</td>
                        <td>{{ rows.NoVaSalah }}</td>
                        <td>{{ rows.NoVaBenar }}</td>
                        <td>{{ rows.NoSuratPernyataan }}</td>
                        <td>{{ rows.TanggalTransfer }}</td>
                        <td class="Idr">{{ rows.nominalbenar }}</td>
                        <td>{{ rows.TrackFinance }}</td>
                        <!--<td>{{ rows.TrackGM }}</td>-->
                        <td style="display:none"><input type="text" name="JenisRefund" value="{{ rows.JenisRefund }}"></td>
                        <td>
                            <a href="{{ url('refund/detail/'~rows.RecID) }}">Detail</a>
                        </td>
                        <td width="2%" style="text-align: center;">
                            {% if username == 'rini' AND rows.TrackFinance == 'Pending' 
                                OR username == 'ukky' AND rows.TrackFinance == 'Pending' 
                                OR username == 'devyana' AND rows.TrackFinance == 'Pending' %}
                                <input type="checkbox" name="RecID[]" value="{{ rows.RecID }}">
                            {% endif %}
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function ganti4(elem){
    var ubahstatus = document.getElementById("ubahstatus4");
    $(document).ready(function() {
        if(ubahstatus.value === "Rejected") {
            $('#modalSuccess3').modal('show');
        } else if(ubahstatus.value === "Approved") {
            $("form#approved3").submit();
            $('.loader').show();
        }
    });
}   
</script>

<div class="modal fade modal-success" id="modalSuccess3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!--
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                -->
                <h4 class="modal-title" id="myModalLabel" style="text-align:center">Alasan Pilih Reject</h4>
            </div>
            <div class="modal-body">
                <div class="input-control text" data-role="input-control">
                    {{ text_field("Keterangan") }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" onclick="$('.loader').show()">Simpan</button>
            </div>
        </div>
    </div>
</div>

{{ end_form() }}

<script type="text/javascript">
 function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
 $(document).ready(function(){
    $(".Idr").autoNumeric('init', {aDec: ',', aSep: '.'});
    $('#dt-refund-deposit').DataTable({
        "paging": false,
        "ordering": false,
        "info": false
    });
});
</script>