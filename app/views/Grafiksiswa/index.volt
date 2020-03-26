{{ content() }}
<div class="grid fluid">
    {{ form("grafiksiswa/index", "method":"post","enctype": "multipart/form-data","name":"form") }}
	<div class="row">
		<div class="span3">
			<label for="ViewType"><strong>Grafik Berdasarkan Tahun</strong></label>
			<div class="input-control select">
				<select id="tahun" name="tahun" onchange="this.form.submit()">
					<option>--Pilih Tahun--</option>
					{% for i in 2001..date('Y') %}
					<option value="{{ i }}">{{ i }}</option>
					{% endfor %}
				</select>
			</div>
		</div>
	</div>
	{{ end_form() }}
</div>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
{{ javascript_include('charts/highcharts.js') }}
{{ javascript_include('charts/drilldown.js') }}
{{ javascript_include('charts/exporting.js') }}
<script type="text/javascript">var base_url = "{{ url() }}";</script>
<script type="text/javascript">
var id = '{{ tahun }}';
$.getJSON(base_url + 'grafiksiswa/load_data',{tahun: id}, function(chartData) {
    Highcharts.Tick.prototype.drillable = function () {};
    $('#container').highcharts({
        chart: {
            type: 'column',
            events: {
                drilldown: function (e) {
                    if (!e.seriesOptions) {
                        var chart = this;
						chart.showLoading('<p>Plase wait ...</p>');
						$.ajax({
							url: base_url+"grafiksiswa/load_drildown?id=" + e.point.drilldown,
							async: false,
							success:function(ajax) {
								data = {
									name: 'Grafik pertanggal',
									data: ajax
								};
							}
						});

                        setTimeout(function () {
                            chart.hideLoading();
                            chart.addSeriesAsDrilldown(e.point, data);
                        }, 300);
                    }
                }
            }
        },
        title: {
            text: 'Index Siswa'
        },
        subtitle: {
            text: {{ tahun }}
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            title: {
                text: false
            },
            labels: {
                overflow: 'justify'
            }

        },
        legend: {
           labelFormatter: function() {
                var total = 0;
                for(var i=this.yData.length; i--;) { total += this.yData[i]; };
                return 'Total: ' + total;
            }
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
        },
		series: [{
			name: 'Grafik',
			colorByPoint: true,
			data: chartData
		}],
        drilldown: {
            drillUpButton: {
                relativeTo: 'spacingBox',
                position: {
                    y: 0,
                    x: -30
                },
                theme: {
                    fill: 'white',
                    'stroke-width': 1,
                    stroke: 'silver',
                    r: 0,
                    states: {
                        hover: {
                            fill: '#a4edba'
                        },
                        select: {
                            stroke: '#039',
                            fill: '#a4edba'
                        }
                    }
                }

            },
            series: []
        }
    })
});
</script>