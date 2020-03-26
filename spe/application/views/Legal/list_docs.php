<form action="#" id="form" class="form-horizontal">
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <div class="col-lg-12">
            <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list"> Data Dokumen Legal All Cabang</i></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12"><legend></legend><!-- 
        <div class="form-group">
            <div class="col-lg-6">
                <label>Pilih Cabang</label>
                <select id="PBranchCode" name="PBranchCode" class="form-control">
                   <option value=""> - - Pilih Cabang - - </option>
                </select>
            </div>
        </div> --><!-- 
        <div class="form-group">
            <div class="col-lg-5">
            <button type="button" class="btn btn-success print-hidden" onclick="load_data()"><span class="glyphicon glyphicon-search"></span> Cari Semua Cabang</button>
            </div>
        </div>
        <legend></legend> -->
    </div>
</div>
    <div class="row" id="idtable" style="display: none;">
        <div class="col-lg-12">
            <table class="display nowrap table-bordered table-hover" style="width:100%;" cellpadding="0" cellspacing="0" border="0" id="tableMenu">
                <thead>
                    <tr>
                        <th style="width: 5px;text-align: center;">No.</th>
                        <th style="text-align: center;">Kode Cabang</th>
                        <th style="text-align: center;">Nama Cabang</th>
                        <th style="text-align: center;">Form Cabang 01</th>
                        <th style="text-align: center;">Form Cabang 02</th>
                        <th style="text-align: center;">Surat Sanggup</th>
                        <th style="text-align: center;">Surat Pernyataan</th>
                        <th style="text-align: center;">Surat Pernyataan Rekening</th>
                        <th style="text-align: center;">Daftar Pengurus Cabang</th>
                        <th style="text-align: center;">Form Survey</th>
                        <th style="text-align: center;">Form Diskon</th>
                        <th style="text-align: center;">Foto KK</th>
                        <th style="text-align: center;">Foto KTP</th>
                        <th style="text-align: center;">Foto NPWP</th>
                        <th style="text-align: center;">Lembar Persetujuan</th>
                        <th style="text-align: center;">Foto Tanda Tangan</th>
                        <th style="text-align: center;">Daftar Hadir</th>
                        <th style="text-align: center;">Akta Notaris</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</form>

<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.css">-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/datatables/responsive.bootstrap.min.css">
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jQueryBarcode.js"></script> -->
<!--<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datatables/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/js/css/select2.custom.min.css">
<script type="text/javascript">

$(function () {
    $('#PBranchCode').select2();
});

$(document).ready(function(){
    get_cabang();
    load_data();
    $('#idtable').css('display', 'block');
    //table.columns.adjust().draw();
    var table = $('#example').DataTable({
            "scrollY": 200,
            "scrollX": true
    });
});


function get_cabang() {
$.getJSON(base_url+"Franchise/get_cabang", function(json){
    $('#PBranchCode').empty();
    $('#PBranchCode').append($('<option>').text("- - Pilih Cabang - -").attr('value', ''));
    $.each(json, function(i, obj){
    $('#PBranchCode').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
    });
});
}

                    /*    $(document).ready(function () {
                            $('#idtable').css('display', 'block');
                            table.columns.adjust().draw();
                        });*/

                        var jQueryTable;
                        var jQueryTable2;
                        $("#tableMenu").DataTable({
                            "scrollY": 0,
                            "scrollX": true
                        });
                        function load_data() {
                            //BranchCode = $('#PBranchCode').val();
                            //alert(ItemCode);
                            $("#tableMenu").DataTable().destroy();
                            $('#tableMenuFoot').empty();
                            if ($('[name="PBranchCode"]').val() == "-") {
                                $('[name="PBranchCode"]').after('<p class="text-danger"><i class="fa fa-info-circle"></i> Pilih Cabang !</p>');
                                $('[name="PBranchCode"]').focus();
                                return false;
                            } else {
                                $('#idtable').css('display', 'block');
                                jQueryTable = $("#tableMenu").DataTable({
                                    "scrollY": 400,
                                    "scrollX": true,
                                    "scrollCollapse": true,
                                    "ajax": {
                                        "url": base_url + "Legal/loadlistdocs",
                                        "type": "POST",
                                        "data": ({"token": window.btoa("Q3IzNHQzZF9ieS5IQG1aNGg=")/*, "BranchCode": window.btoa(BranchCode)*/}),
                                        "dataType": "JSON",
                                        "dataSrc": function (json) {
                                            //addRow(json);
                                            return json.data;
                                        }
                                    },
                                    "columns": [
                                        {"data": "RowNum", "autoWidth": true},
                                        {"data": "BranchCode", "autoWidth": true},
                                        {"data": "BranchName", "autoWidth": true},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.FormCabang01 == null) {
                                                            return data.FormCabang01;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.FormCabang01 + '">' + data.FormCabang01;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.FormCabang02 == null) {
                                                            return data.FormCabang02;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.FormCabang02 + '">' + data.FormCabang02;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.SuratSanggup == null) {
                                                            return data.SuratSanggup;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.SuratSanggup + '">' + data.SuratSanggup;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.SuratPernyataan == null) {
                                                            return data.SuratPernyataan;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.SuratPernyataan + '">' + data.SuratPernyataan;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.SuratPernyataanRek == null) {
                                                            return data.SuratPernyataanRek;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.SuratPernyataanRek + '">' + data.SuratPernyataanRek;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.PengurusCabang == null) {
                                                            return data.PengurusCabang;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.PengurusCabang + '">' + data.PengurusCabang;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.FormSurvey == null) {
                                                            return data.FormSurvey;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.FormSurvey + '">' + data.FormSurvey;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.FormDiskon == null) {
                                                            return data.FormDiskon;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.FormDiskon + '">' + data.FormDiskon;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.FotoKK == null) {
                                                            return data.FotoKK;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.FotoKK + '">' + data.FotoKK;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.FotoKTP == null) {
                                                            return data.FotoKTP;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.FotoKTP + '">' + data.FotoKTP;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.FotoNPWP == null) {
                                                            return data.FotoNPWP;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.FotoNPWP + '">' + data.FotoNPWP;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.LembarPersetujuan == null) {
                                                            return data.LembarPersetujuan;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.LembarPersetujuan + '">' + data.LembarPersetujuan;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.FotoTandaTangan == null) {
                                                            return data.FotoTandaTangan;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.FotoTandaTangan + '">' + data.FotoTandaTangan;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.DaftarHadir == null) {
                                                            return data.DaftarHadir;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.DaftarHadir + '">' + data.DaftarHadir;
                                                            +'</a>'
                                                        }
                                                    }},
                                        {"data": null, "autoWidth": true, "render":
                                                    function (data) {
                                                        if (data.SuratNotaris == null) {
                                                            return data.SuratNotaris;
                                                        } else {
                                                            return '<a href="' + base_url + 'Legal/download/' + data.SuratNotaris + '">' + data.SuratNotaris;
                                                            +'</a>'
                                                        }
                                                    }},
                                    ],
                                    'iDisplayLength': 10000,
                                    /*dom: 'Bfrtip',
                                    buttons: [
                                        'excel'
                                    ],*/
                                    "initComplete": function (settings, json) {
                                        $('#idtable').css('display', 'block');
                                        jQueryTable.columns.adjust().draw();
                                    },
                                    createdRow: function (row, data, dataIndex) {
                                        if (data.RowNum == "") {
                                            $(row).addClass('table-total');
                                        }
                                    },
                                    /*"columnDefs": [
                                        {
                                            "targets": [0,1,2,3,4,13,14,15,16],
                                            "createdCell": function (td, cellData, rowData, row, col) {
                                                if (rowData.RowNum == "") {
                                                    $(td).addClass('border-0');
                                                }
                                            }
                                        }
                                    ]*/

                                });
                                if ($.fn.DataTable.isDataTable('#tableMenu')) {
                                }
                            }
                        }

</script>