        {{ javascript_include('charts/amcharts.js') }}
        {{ javascript_include('charts/serial.js') }}
        {{ javascript_include('charts/light.js') }}
<br></br>
<div id="chartdiv"></div>

<script>
var chartData = [{
  "category": 'Jakarta 1',
  "income": 90,
  "url": "#",
  "description": "click to drill-down",
  "months": [{
    "category": 1,
    "income": 1
  }, {
    "category": 2,
    "income": 2
  }, {
    "category": 3,
    "income": 1
  }, {
    "category": 4,
    "income": 3
  }, {
    "category": 5,
    "income": 2.5
  }, {
    "category": 6,
    "income": 1.1
  }, {
    "category": 7,
    "income": 2.9
  }, {
    "category": 8,
    "income": 3.5
  }, {
    "category": 9,
    "income": 3.1
  }, {
    "category": 10,
    "income": 1.1
  }, {
    "category": 11,
    "income": 1
  }, {
    "category": 12,
    "income": 3
  }]
}, {
  "category": 'Jakarta 2',
  "income": 29,
  "url": "#",
  "description": "click to drill-down",
  "months": [{
    "category": 1,
    "income": 4
  }, {
    "category": 2,
    "income": 3
  }, {
    "category": 3,
    "income": 1
  }, {
    "category": 4,
    "income": 4
  }, {
    "category": 5,
    "income": 2
  }, {
    "category": 6,
    "income": 1
  }, {
    "category": 7,
    "income": 2
  }, {
    "category": 8,
    "income": 2
  }, {
    "category": 9,
    "income": 3
  }, {
    "category": 10,
    "income": 1
  }, {
    "category": 11,
    "income": 1
  }, {
    "category": 12,
    "income": 3
  }]
}, {
  "category": 'Jawa Tengah 1',
  "income": 100,
  "url": "#",
  "description": "click to drill-down",
  "months": [{
    "category": 1,
    "income": 2
  }, {
    "category": 2,
    "income": 3
  }, {
    "category": 3,
    "income": 1
  }, {
    "category": 4,
    "income": 5
  }, {
    "category": 5,
    "income": 2
  }, {
    "category": 6,
    "income": 1
  }, {
    "category": 7,
    "income": 2
  }, {
    "category": 8,
    "income": 2.5
  }, {
    "category": 9,
    "income": 3.1
  }, {
    "category": 10,
    "income": 1.1
  }, {
    "category": 11,
    "income": 1
  }, {
    "category": 12,
    "income": 3
  }]
}, {
  "category": 'Jawa Tengah 2',
  "income": 97,
  "url": "#",
  "description": "click to drill-down",
  "months": [{
    "category": 1,
    "income": 2
  }, {
    "category": 2,
    "income": 3
  }, {
    "category": 3,
    "income": 1
  }, {
    "category": 4,
    "income": 5
  }, {
    "category": 5,
    "income": 2
  }, {
    "category": 6,
    "income": 1
  }, {
    "category": 7,
    "income": 2
  }, {
    "category": 8,
    "income": 2.5
  }, {
    "category": 9,
    "income": 3.1
  }, {
    "category": 10,
    "income": 1.1
  }, {
    "category": 11,
    "income": 1
  }, {
    "category": 12,
    "income": 3
  }]

}, {
  "category": 'Jawa Timur 2',
  "income": 10,
  "url": "#",
  "description": "click to drill-down",
  "months": [{
    "category": 1,
    "income": 2
  }, {
    "category": 2,
    "income": 3
  }, {
    "category": 3,
    "income": 1
  }, {
    "category": 4,
    "income": 5
  }, {
    "category": 5,
    "income": 2
  }, {
    "category": 6,
    "income": 1
  }, {
    "category": 7,
    "income": 2
  }, {
    "category": 8,
    "income": 2.5
  }, {
    "category": 9,
    "income": 3.1
  }, {
    "category": 10,
    "income": 1.1
  }, {
    "category": 11,
    "income": 1
  }, {
    "category": 12,
    "income": 3
  }]
}];

var chart = AmCharts.makeChart("chartdiv", {
  "type": "serial",
  "creditsPosition": "top-right",
  "autoMargins": false,
  "marginLeft": 30,
  "marginRight": 8,
  "marginTop": 10,
  "marginBottom": 26,
  "titles": [{
    "text": "Angket Area Manager"
  }],
  "dataProvider": chartData,
  "startDuration": 1,
  "graphs": [{
    "alphaField": "alpha",
    "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span> <br>[[description]]",
    "dashLengthField": "dashLengthColumn",
    "fillAlphas": 1,
    "title": "Income",
    "type": "column",
    "valueField": "income",
    "urlField": "url"
  }],
  "categoryField": "category",
  "categoryAxis": {
    "gridPosition": "start",
    "axisAlpha": 0,
    "tickLength": 0
  }
});

chart.addListener("clickGraphItem", function(event) {
  if ('object' === typeof event.item.dataContext.months) {

    // set the monthly data for the clicked month
    event.chart.dataProvider = event.item.dataContext.months;

    // update the chart title
    event.chart.titles[0].text = 'Area ' + event.item.dataContext.category;

    // let's add a label to go back to yearly data
    event.chart.addLabel(
      35, 20,
      "< Back",
      undefined,
      15,
      undefined,
      undefined,
      undefined,
      true,
      'javascript:resetChart();');

    // validate the new data and make the chart animate again
    event.chart.validateData();
    event.chart.animateAgain();
  }
});

// function which resets the chart back to yearly data
function resetChart() {
  chart.dataProvider = chartData;
  chart.titles[0].text = 'Angket Area Manager';

  // remove the "Go back" label
  chart.allLabels = [];

  chart.validateData();
  chart.animateAgain();
}
</script>

<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>