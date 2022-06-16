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
            var data = [{
                country:"Semana 1",
                value:"830.57"
            },{
                country:"Semana 2",
                value:"100.00"
            },{
                country:"Semana 3",
                value:"150.00"
            }];

            // var data = [{
            //   country: "Semana 1",
            //   value: 2025
            // }, {
            //   country: "Semana 2",
            //   value: 1882
            // }, {
            //   country: "Semana 3",
            //   value: 1809
            // }, {
            //   country: "Semana 4",
            //   value: 1322
            // }, {
            //   country: "Semana 5",
            //   value: 1122
            // }, {
            //   country: "Semana 6",
            //   value: 1114
            // }, {
            //   country: "Semana 7",
            //   value: 984
            // }, {
            //   country: "Semana 8",
            //   value: 711
            // }, {
            //   country: "Semana 9",
            //   value: 665
            // }, {
            //   country: "Semana 10",
            //   value: 580
            // }, {
            //   country: "Semana 11",
            //   value: 443
            // }, {
            //   country: "Semana 12",
            //   value: 441
            // },];
            // console.log(data);
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
