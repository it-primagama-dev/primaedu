<html>
  <head>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
  </head>
<body>
<?php
    foreach($result as $list){
        $area[] = $list->Area;
        $value[] = (float) $list->NilaiArea;
    }
     
?>

<?php
    foreach($result2 as $list2){
        $area[] = $list2->Area;
        $value2[] = (float) $list2->NilaiArea;
    }
     
?>


<br>

<div class="grid fluid">
<div id="container"></div>

    <div class="row">
        <div class="span3">
            <label for="ViewType"><strong>Grafik Berdasarkan Area</strong></label>
            <div class="input-control select">
            <select id="area" name="area">
            <option>--Pilih Area--</option>
            <?php
                            if(isset($result3)){
                                foreach($result3 as $row){
                                    ?>
            <option value="<?php echo $row->KodeAreaCabang ?>"><?php echo $row->NamaAreaCabang ?></option>
            <?php
                                }
                        }
                            ?>
            </select>
            </div>
        </div>
    </div>
<div id="grafikarea"></div>
</div>

<script type="text/javascript">
$(function () { 
    var data = {"name":"Angket 1","data":<?php echo json_encode($value);?>};
    var data2 = {"name":"Angket 2","data":<?php echo json_encode($value2);?>};
    var categories = <?php echo json_encode($area);?>;
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'column'
        },
        title: {
            text: 'Angket AM'
        },
        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: 'Point'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
             }]
        },
        tooltip: {
             formatter: function() {
                 return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,0) + '</b>, in '+ this.series.name;
             }
          },
        series: [data,data2]
    });
});
        </script>

<script>
    $(document).ready(function() {
    $("#area").change(function(){
        var area = $("#area").val();
            
        $.ajax({
        type: "POST",
        url : '{{ url('grafikkuesioner/area') }}',
        data: "area="+area,
        cache:false,
        success: function(data){
        $('#grafikarea').html(data);
        document.frm.add.disabled=false;
                    }
            });
        });
    })
</script>
  </body>
</html>