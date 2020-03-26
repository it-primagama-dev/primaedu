<form action="#" id="form3" class="form-horizontal">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-12">
                <p style="font-size: 23px; font-weight: bold;"><i class="fa fa-list"> Laporan Pemesanan Buku</i></p>
                <legend></legend>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" id="form" style="display: none;">
            <div class="form-group">
                <div class="col-lg-6">
                    <strong><u>*Pilih Berdasarkan. . .</u></strong>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <select id="Opsi" name="opsi" class="form-control">
                        <option value=""> - - Pilih - - </option>
                        <option value="1"> Area </option>
                        <option value="2"> Cabang </option>
                        <option value="3"> Tanggal Transaksi </option>
                        <option value="4"> Tanggal Pemesanan </option>
                    </select>
                </div>
            </div>
            <div class="form-group" id="divarea" style="display: none;">
                <div class="col-lg-6">
                    <select id="Area" name="Area" class="form-control" style="width: 100%;">
                        <option value=""> - - Pilih Area - - </option>
                    </select>
                </div>
            </div>
            <div class="form-group" id="divcabang" style="display: none;">
                <div class="col-lg-6">
                    <select id="Cabang" name="Cabang" class="form-control" style="width: 100%;">
                        <option value=""> - - Pilih Cabang - - </option>
                    </select>
                </div>
            </div>
            <div class="form-group" id="divtglt" style="display: none;">
                <div class="col-lg-3">
                    <input type="text" name="tglawal" id="tglawal" class="form-control" placeholder=" - - Tanggal Awal Transaksi - - ">
                </div>
                <div class="col-lg-3">
                    <input type="text" name="tglakhir" id="tglakhir" class="form-control" placeholder=" - - Tanggal Akhir Transaksi - - ">
                </div>
            </div>
            <div class="form-group" id="divtglp" style="display: none;">
                <div class="col-lg-3">
                    <input type="text" name="tglawalp" id="tglawalp" class="form-control" placeholder=" - - Tanggal Awal Pemesanan - - ">
                </div>
                <div class="col-lg-3">
                    <input type="text" name="tglakhirp" id="tglakhirp" class="form-control" placeholder=" - - Tanggal Akhir Pemesanan - - ">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <button type="button" class="btn btn-success" onclick="get_data()"> Tampilkan</button>
                </div>
            </div>
            <legend></legend>
        </div>
        <div class="col-lg-12" id="refresh" style="display: none;">
            <div class="form-group">
                <div class="col-lg-6">
                    <button type="button" class="btn btn-warning" onclick="refresh()"> Ubah Pencarian</button>
                </div>
            </div>
            <legend></legend>
        </div>
    </div>
    <div class="row" id="idtable" style="display: none;">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="tableMenu">
                            <thead>
                                <tr>
                                    <th data-sortable="false">Area</th>
                                    <th style="text-align: center;">Cabang</th>
                                    <th style="text-align: center;">PR</th>
                                    <th style="text-align: center;">No. Inv</th>
                                    <th style="text-align: center;">Tanggal Pemesanan</th>
                                    <th style="text-align: center;">Tanggal Transaksi</th>
                                    <th style="text-align: center;">Nama Paket</th>
                                    <th style="text-align: center;">Detail Item</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Harga Satuan</th>
                                    <th style="text-align: center;">Harga Paket</th>
                                    <th style="text-align: center;">Harga Ongkir</th>
                                    <th style="text-align: center;">Harga Total</th>
                                </tr>
                            </thead>
                </table>
            </div>
        </div>
    </div>
</form>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- <link href="//datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" /> -->
<!-- <script src="https://nightly.datatables.net/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/datatables/responsive.bootstrap.min.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/js/css/select2.custom.min.css">
<script src="<?=base_url('assets/js/autoNumeric.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.js"></script>

<script type="text/javascript">
    /*! RowsGroup for DataTables v1.0.0
 * 2015 Alexey Shildyakov ashl1future@gmail.com
 */

/**
 * @summary     RowsGroup
 * @description Group rows by specified columns
 * @version     1.0.0
 * @file        dataTables.rowsGroup.js
 * @author      Alexey Shildyakov (ashl1future@gmail.com)
 * @contact     ashl1future@gmail.com
 * @copyright   Alexey Shildyakov
 * 
 * License      MIT - http://datatables.net/license/mit
 *
 * This feature plug-in for DataTables automatically merges columns cells
 * based on it's values equality. It supports multi-column row grouping
 * in according to the requested order with dependency from each previous 
 * requested columns. Now it supports ordering and searching. 
 * Please see the example.html for details.
 * 
 * Rows grouping in DataTables can be enabled by using any one of the following
 * options:
 *
 * * Setting the `rowsGroup` parameter in the DataTables initialisation
 *   to array which containes columns selectors
 *   (https://datatables.net/reference/type/column-selector) used for grouping. i.e.
 *    rowsGroup = [1, 'columnName:name', ]
 * * Setting the `rowsGroup` parameter in the DataTables defaults
 *   (thus causing all tables to have this feature) - i.e.
 *   `$.fn.dataTable.defaults.RowsGroup = [0]`.
 * * Creating a new instance: `new $.fn.dataTable.RowsGroup( table, columnsForGrouping );`
 *   where `table` is a DataTable's API instance and `columnsForGrouping` is the array
 *   described above.
 *
 * For more detailed information please see:
 *     
 */

(function($){

ShowedDataSelectorModifier = {
    order: 'current',
    page: 'current',
    search: 'applied',
}

GroupedColumnsOrderDir = 'asc';


/*
 * columnsForGrouping: array of DTAPI:cell-selector for columns for which rows grouping is applied
 */
var RowsGroup = function ( dt, columnsForGrouping )
{
    this.table = dt.table();
    this.columnsForGrouping = columnsForGrouping;
     // set to True when new reorder is applied by RowsGroup to prevent order() looping
    this.orderOverrideNow = false;
    this.order = []
    
    self = this;
    $(document).on('order.dt', function ( e, settings) {
        if (!self.orderOverrideNow) {
            self._updateOrderAndDraw()
        }
        self.orderOverrideNow = false;
    })
    
    $(document).on('draw.dt', function ( e, settings) {
        self._mergeCells()
    })

    this._updateOrderAndDraw();
};


RowsGroup.prototype = {
    _getOrderWithGroupColumns: function (order, groupedColumnsOrderDir)
    {
        if (groupedColumnsOrderDir === undefined)
            groupedColumnsOrderDir = GroupedColumnsOrderDir
            
        var self = this;
        var groupedColumnsIndexes = this.columnsForGrouping.map(function(columnSelector){
            return self.table.column(columnSelector).index()
        })
        var groupedColumnsKnownOrder = order.filter(function(columnOrder){
            return groupedColumnsIndexes.indexOf(columnOrder[0]) >= 0
        })
        var nongroupedColumnsOrder = order.filter(function(columnOrder){
            return groupedColumnsIndexes.indexOf(columnOrder[0]) < 0
        })
        var groupedColumnsKnownOrderIndexes = groupedColumnsKnownOrder.map(function(columnOrder){
            return columnOrder[0]
        })
        var groupedColumnsOrder = groupedColumnsIndexes.map(function(iColumn){
            var iInOrderIndexes = groupedColumnsKnownOrderIndexes.indexOf(iColumn)
            if (iInOrderIndexes >= 0)
                return [iColumn, groupedColumnsKnownOrder[iInOrderIndexes][1]]
            else
                return [iColumn, groupedColumnsOrderDir]
        })
        
        groupedColumnsOrder.push.apply(groupedColumnsOrder, nongroupedColumnsOrder)
        return groupedColumnsOrder;
    },
 
    // Workaround: the DT reset ordering to 'asc' from multi-ordering if user order on one column (without shift)
    //   but because we always has multi-ordering due to grouped rows this happens every time
    _getInjectedMonoSelectWorkaround: function(order)
    {
        if (order.length === 1) {
            // got mono order - workaround here
            var orderingColumn = order[0][0]
            var previousOrder = this.order.map(function(val){
                return val[0]
            })
            var iColumn = previousOrder.indexOf(orderingColumn);
            if (iColumn >= 0) {
                // assume change the direction, because we already has that in previos order
                return [[orderingColumn, this._toogleDirection(this.order[iColumn][1])]]
            } // else This is the new ordering column. Proceed as is.
        } // else got milti order - work normal
        return order;
    },
    
    _mergeCells: function()
    {
        var columnsIndexes = this.table.columns(this.columnsForGrouping, ShowedDataSelectorModifier).indexes().toArray()
        var showedRowsCount = this.table.rows(ShowedDataSelectorModifier)[0].length 
        this._mergeColumn(0, showedRowsCount - 1, columnsIndexes)
    },
    
    // the index is relative to the showed data
    //    (selector-modifier = {order: 'current', page: 'current', search: 'applied'}) index
    _mergeColumn: function(iStartRow, iFinishRow, columnsIndexes)
    {
        var columnsIndexesCopy = columnsIndexes.slice()
        currentColumn = columnsIndexesCopy.shift()
        currentColumn = this.table.column(currentColumn, ShowedDataSelectorModifier)
        
        var columnNodes = currentColumn.nodes()
        var columnValues = currentColumn.data()
        
        var newSequenceRow = iStartRow,
            iRow;
        for (iRow = iStartRow + 1; iRow <= iFinishRow; ++iRow) {
            
            if (columnValues[iRow] === columnValues[newSequenceRow]) {
                $(columnNodes[iRow]).hide()
            } else {
                $(columnNodes[newSequenceRow]).show()
                $(columnNodes[newSequenceRow]).attr('rowspan', (iRow-1) - newSequenceRow + 1)
                
                if (columnsIndexesCopy.length > 0)
                    this._mergeColumn(newSequenceRow, (iRow-1), columnsIndexesCopy)
                
                newSequenceRow = iRow;
            }
            
        }
        $(columnNodes[newSequenceRow]).show()
        $(columnNodes[newSequenceRow]).attr('rowspan', (iRow-1)- newSequenceRow + 1)
        if (columnsIndexesCopy.length > 0)
            this._mergeColumn(newSequenceRow, (iRow-1), columnsIndexesCopy)
    },
    
    _toogleDirection: function(dir)
    {
        return dir == 'asc'? 'desc': 'asc';
    },
 
    _updateOrderAndDraw: function()
    {
        this.orderOverrideNow = true;
        
        var currentOrder = this.table.order();
        currentOrder = this._getInjectedMonoSelectWorkaround(currentOrder);
        this.order = this._getOrderWithGroupColumns(currentOrder)
        this.table.order($.extend(true, Array(), this.order))
        this.table.draw()
    },
};


$.fn.dataTable.RowsGroup = RowsGroup;
$.fn.DataTable.RowsGroup = RowsGroup;

// Automatic initialisation listener
$(document).on( 'init.dt', function ( e, settings ) {
    if ( e.namespace !== 'dt' ) {
        return;
    }

    var api = new $.fn.dataTable.Api( settings );

    if ( settings.oInit.rowsGroup ||
         $.fn.dataTable.defaults.rowsGroup )
    {
        options = settings.oInit.rowsGroup?
            settings.oInit.rowsGroup:
            $.fn.dataTable.defaults.rowsGroup;
        new RowsGroup( api, options );
    }
} );

}(jQuery));

/*

TODO: Provide function which determines the all <tr>s and <td>s with "rowspan" html-attribute is parent (groupped) for the specified <tr> or <td>. To use in selections, editing or hover styles.

TODO: Feature
Use saved order direction for grouped columns
    Split the columns into grouped and ungrouped.
    
    user = grouped+ungrouped
    grouped = grouped
    saved = grouped+ungrouped
    
    For grouped uses following order: user -> saved (because 'saved' include 'grouped' after first initialisation). This should be done with saving order like for 'groupedColumns'
    For ungrouped: uses only 'user' input ordering
*/
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
    get_cabang();
    get_area();
    $('#form').css('display','block');
});

$("#Opsi").change(function(e) {
    var Id = e.target.value;
    //alert(Id);
    if(Id==1){
        $('#divarea').css('display','block');
        $('#divcabang').css('display','none');
        $('#divtglt').css('display','none');
        $('#divtglp').css('display','none');
    } else if(Id==2){
        $('#divarea').css('display','none');
        $('#divcabang').css('display','block');
        $('#divtglt').css('display','none');
        $('#divtglp').css('display','none');
    } else if(Id==3){
        $('#divarea').css('display','none');
        $('#divcabang').css('display','none');
        $('#divtglt').css('display','block');
        $('#divtglp').css('display','none');
    } else if(Id=4){
        $('#divarea').css('display','none');
        $('#divcabang').css('display','none');
        $('#divtglt').css('display','none');
        $('#divtglp').css('display','block');
    }
});

$(function () {
    $('#Cabang').select2();
    $('#Area').select2();
});

$(function(){
    var d = new Date();
    var n = d.getFullYear();
    $('[name="tglakhir"],[name="tglawal"],[name="tglakhirp"],[name="tglawalp"]').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "2017:"+n
    });
})

function get_area() {
$.getJSON(base_url+"Report/get_area", function(json){
    $('#Area').empty();
    $('#Area').append($('<option>').text("- - Pilih Area - -"));
    $.each(json, function(i, obj){
        $('#Area').append($('<option>').text(obj.NamaAreaCabang).attr('value', obj.NamaAreaCabang));
    });
});
}

function get_cabang() {
$.getJSON(base_url+"Report/get_cabang", function(json){
    $('#Cabang').empty();
    $('#Cabang').append($('<option>').text("- - Pilih Cabang - -"));
    $.each(json, function(i, obj){
        $('#Cabang').append($('<option>').text(obj.KodeAreaCabang+' - '+obj.NamaAreaCabang).attr('value', obj.KodeAreaCabang));
    });
});
}

function refresh(){
    window.location.href = base_url+'report/smartbook';
}

var table;
function get_data() {
    var area =  $('#Area').val();
    var cabang =  $('#Cabang').val();
    var tglawal =  $('#tglawal').val();
    var tglakhir =  $('#tglakhir').val();
    var tglawalp =  $('#tglawalp').val();
    var tglakhirp =  $('#tglakhirp').val();
    if(area == '- - Pilih Area - -' && cabang == '- - Pilih Cabang - -' && tglawal == '' && tglawalp == '' || area == '- - Pilih Area - -' && cabang == '- - Pilih Cabang - -' && tglakhir == '' && tglakhirp == ''){
        alert("Pilih Area / Cabang / Tanggal Transaksi / Tanggal Pemesanan !!!");
    } else {
    $('#form').css('display','none');
    $('#idtable').css('display','block');
    $('#refresh').css('display','block');
    var table = $('#tableMenu').DataTable({
        "ajax": {
            "url":base_url + "Report/find_smartbook",
            "type":"POST",
            "data": ({"token": window.btoa(unescape(encodeURIComponent("Q3IzNHQzZF9ieS5IQG1aNGg="))),"area":window.btoa(area),"cabang":window.btoa(cabang),"tglawal":window.btoa(tglawal),"tglakhir":window.btoa(tglakhir),"tglawalp":window.btoa(tglawalp),"tglakhirp":window.btoa(tglakhirp)}),
            "dataType":"JSON"
        },
        "columns": [
            {"data": "Area","name":"first","width":"12%","sClass": "text-center"},
            {"data":"BranchCode","width":"22%","sClass": "text-left"},
            {"data":"PR_Number","width":"15%"},
            {"data":"Invoice_Number","width":"15%"},
            {"data":"PR_Date","width":"10%","sClass": "text-center","render":
                function(data){
                    return tgl_indo(data);
                }},
            {"data":"Pay_Date","width":"10%","sClass": "text-center","render":
                function(data){
                    tgl = data.replace(/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/,"$1-$2-$3 $4:$5:$6");
                    return tgl_indo_time2(tgl);
                }},
            {"data":"PackCode","autoWidth":true},
            {"data":"ItemCode","autoWidth":true},
            {"data":"Quantity","width":"8%","sClass": "text-center"},
            {"data":"Price","autoWidth":true,"render":
                function(data){
                    return convertToRupiah(data);
                }},
            {"data":"PricePack","autoWidth":true,"render":
                function(data){
                    return convertToRupiah(data);
                }},
            {"data":"DelivFee","autoWidth":true,"render":
                function(data){
                    return convertToRupiah(data);
                }},
            {"data":"TotalPrice","autoWidth":true,"render":
                function(data){
                    return convertToRupiah(data);
                }},
        ],
        "aLengthMenu": [[-1], [10, 25, 50, "All"]],
        "order": [[ 0, "asc" ]],
        "pagingType": "full_numbers",
        dom: "<'row'<'col-lg-3 col-xs-12'f><'col-lg-9 col-sm-12'B>>" +
                "<'row'<'col-sm-12'tr>>",
        buttons: [
        {
            extend: 'excel',
            text: '<button type="button" class="btn btn-info pull-right"><span class="glyphicon glyphicon-download"></span> Download Excel</button>',
            className: 'exportExcel',
            filename: 'Laporan Pemesanan Buku',
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            }
        }
        ],
        rowsGroup: [
            'first:name',1,2,3,4,5,6,8,10,11,12
        ]
    });
}
}
</script>