function estadistica(id){

    $.ajax({
        type: "GET",
        url: "calcular-histograma/" + id,
        dataType: "json",
        success: function (comp) {
        // ---------------------------------------------------------

        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");


            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
              am5themes_Animated.new(root)
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
              panX: true,
              panY: true,
              wheelX: "panX",
              wheelY: "zoomX",
              pinchZoomX:true
            }));

            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);


            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
            xRenderer.labels.template.setAll({
              rotation: -90,
              centerY: am5.p50,
              centerX: am5.p100,
              paddingRight: 15
            });

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
              maxDeviation: 0.3,
              categoryField: "country",
              renderer: xRenderer,
              tooltip: am5.Tooltip.new(root, {})
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
              maxDeviation: 0.3,
              renderer: am5xy.AxisRendererY.new(root, {})
            }));


            // Create series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
              name: "Estadistica",
              xAxis: xAxis,
              yAxis: yAxis,
              valueYField: "value",
              sequencedInterpolation: true,
              categoryXField: "country",
              tooltip: am5.Tooltip.new(root, {
                labelText:"{valueY}"
              })
            }));

            series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
            series.columns.template.adapters.add("fill", function(fill, target) {
              return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", function(stroke, target) {
              return chart.get("colors").getIndex(series.columns.indexOf(target));
            });


            // Set data
            console.log(comp);
            var data = comp;


            xAxis.data.setAll(data);
            series.data.setAll(data);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear(1000);
            chart.appear(1000, 100);

            }); // end am5.ready()

        // ---------------------------------------------------------
        }
    });

    // $('#estadistic').attr('disabled', false);
}


function laguna(id){

    am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv2");


        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);

        root.dateFormatter.setAll({
          dateFormat: ["yearY"],
          dateFields: ["valueX"]
        });

        var data = [{
          "year": "Sem 1",
          "value": -0.307
        }, {
          "year": "Sem 2",
          "value": -0.168
        }, {
          "year": "Sem 3",
          "value": -0.073
        }, {
          "year": "Sem 4",
          "value": -0.027
        }, {
          "year": "Sem 5",
          "value": -0.251
        }, {
          "year": "Sem 6",
          "value": -0.281
        }, {
          "year": "Sem 7",
          "value": -0.348
        }, {
          "year": "Sem 8",
          "value": -0.074
        }, {
          "year": "Sem 9",
          "value": -0.011
        }, {
          "year": "Sem 10",
          "value": -0.074
        }, {
          "year": "Sem 11",
          "value": -0.124
        }];


        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
          focusable: true,
          panX: true,
          panY: true,
          wheelX: "panX",
          wheelY: "zoomX",
          pinchZoomX:true
        }));

        var easing = am5.ease.linear;


        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
          maxDeviation: 0.5,
          baseInterval: {
            timeUnit: "year",
            count: 1
          },
          renderer: am5xy.AxisRendererX.new(root, {
            minGridDistance: 50, pan:"zoom"
          }),
          tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
          maxDeviation: 1,
          renderer: am5xy.AxisRendererY.new(root, {pan:"zoom"})
        }));


        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.SmoothedXLineSeries.new(root, {
          minBulletDistance: 10,
          connect: false,
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: "value",
          valueXField: "year",
          tooltip: am5.Tooltip.new(root, {
            pointerOrientation: "horizontal",
            labelText: "{valueY}"
          })
        }));

        series.fills.template.setAll({ fillOpacity: 0.2, visible: true });

        // Add series axis range for a different stroke/fill
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/axis-ranges/#Series_axis_ranges
        var rangeDataItem = yAxis.makeDataItem({
          value: 0,
          endValue: 1000
        });

        var color = chart.get("colors").getIndex(3);

        var range = series.createAxisRange(rangeDataItem);

        range.strokes.template.setAll({
          stroke: color
        });

        range.fills.template.setAll({
          fill: color,
          fillOpacity: 0.2,
          visible: true
        });


        // Set up data processor to parse string dates
        // https://www.amcharts.com/docs/v5/concepts/data/#Pre_processing_data
        series.data.processor = am5.DataProcessor.new(root, {
          dateFormat: "yyyy",
          dateFields: ["year"]
        });

        series.data.setAll(data);

        series.bullets.push(function() {
          var circle = am5.Circle.new(root, {
            radius: 4,
            fill: series.get("fill"),
            stroke: root.interfaceColors.get("background"),
            strokeWidth: 2
          })

          circle.adapters.add("fill", function(fill, target) {
            var dataItem = circle.dataItem;
            if (dataItem.get("valueY") >= 0) {
              return color;
            }
            return fill
          })

          return am5.Bullet.new(root, {
            sprite: circle
          })
        });


        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
          xAxis: xAxis
        }));
        cursor.lineY.set("visible", false);

        // add scrollbar
        chart.set("scrollbarX", am5.Scrollbar.new(root, { orientation: "horizontal" }));

        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        chart.appear(1000, 100);

        }); // end am5.ready()

}


