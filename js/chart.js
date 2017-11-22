// since v3, chart can accept data in JSON format
// if your category axis parses dates, you should only
// set date format of your data (dataDateFormat property of AmSerialChart)      

var lineChartData = [
    {

        "date": "2012-01-01",
        "members": 100,
        "orders": 75,
        "products":50,
        "sales":25

    },

    {

        "date": "2012-01-02",
        "members": 25,
        "orders": 50,
        "products":75,
        "sales":100

    },
    {

        "date": "2012-01-03",
        "members": 100,
        "orders": 75,
        "products":50,
        "sales":25

    },

    {

        "date": "2012-01-04",
        "members": 25,
        "orders": 50,
        "products":75,
        "sales":100

    },{

        "date": "2012-01-05",
        "members": 100,
        "orders": 75,
        "products":50,
        "sales":25

    },

    {

        "date": "2012-01-06",
        "members": 25,
        "orders": 50,
        "products":75,
        "sales":100

    },
   

   
   
];


AmCharts.ready(function () {
    var chart = new AmCharts.AmSerialChart();
    chart.dataProvider = lineChartData;
    chart.pathToImages = "http://www.amcharts.com/lib/3/images/";
    chart.categoryField = "date";
    chart.dataDateFormat = "YYYY-MM-DD";
    chart.fontFamily = "Verdana";

  

    // sometimes we need to set margins manually
    // autoMargins should be set to false in order chart to use custom margin values
    chart.autoMargins = true;
    chart.marginRight = 0;
    chart.marginLeft = 30;
    chart.marginBottom = 30;
    chart.marginTop = 40;
    chart.colors = ['#f00'];
    
    // AXES
    // category                
    var categoryAxis = chart.categoryAxis;
    categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
    categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
    categoryAxis.inside = false;
    categoryAxis.gridAlpha = 0;
    categoryAxis.tickLength = 0;
    categoryAxis.axisAlpha = 3;
    categoryAxis.fontSize = 9;
    categoryAxis.axisColor = "rgba(255,255,255,0.8)";
    categoryAxis.color = "rgba(255,255,255,0.8)";
    
    
    // value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.dashLength = 1;
    valueAxis.gridColor = "rgba(255,255,255,0.8)";
    valueAxis.gridAlpha = 1;
    valueAxis.axisColor = "rgba(255,255,255,0.8)";
    valueAxis.color = "rgba(255,255,255,0.8)";
    valueAxis.axisAlpha = 0.5;
    valueAxis.fontSize = 9;
    chart.addValueAxis(valueAxis);
    
    // members
    var graph = new AmCharts.AmGraph();
    graph.type = "smoothedLine";
    graph.valueField = "members";
    graph.lineColor = "#53d769";
    graph.lineThickness = 3;
    graph.bullet = "round";
    //graph.bulletColor = "rgba(0,0,0,0.3)";
    graph.bulletBorderColor = "#53d769";
    graph.bulletBorderAlpha = 1;
    graph.bulletBorderThickness = 3;
    graph.bulletSize = 6;
    graph.fillAlphas = 0.2;
    graph.fillColorsField = "#53d769";
    chart.addGraph(graph);

    // orders
    var graph1 = new AmCharts.AmGraph();
    graph1.type = "smoothedLine";
    graph1.valueField = "orders";
    graph1.lineColor = "#1c7dfa";
    graph1.lineThickness = 3;
    graph1.bullet = "round";
    //graph1.bulletColor = "rgba(0,0,0,0.3)";
    graph1.bulletBorderColor = "#1c7dfa";
    graph1.bulletBorderAlpha = 1;
    graph1.bulletBorderThickness = 3;
    graph1.bulletSize = 6;
    graph1.fillAlphas = 0.2;
    graph1.fillColorsField = "#1c7dfa";
    chart.addGraph(graph1);

    //products
    var graph2 = new AmCharts.AmGraph();
    graph2.type = "smoothedLine";
    graph2.valueField = "products";
    graph2.lineColor = "red";
    graph2.lineThickness = 3;
    graph2.bullet = "round";
    //graph1.bulletColor = "rgba(0,0,0,0.3)";
    graph2.bulletBorderColor = "red";
    graph2.bulletBorderAlpha = 1;
    graph2.bulletBorderThickness = 3;
    graph2.bulletSize = 6;
    graph2.fillAlphas = 0.2;
    graph2.fillColorsField = "#1c7dfa";
    chart.addGraph(graph2);
    
    
    //sales
    var graph3 = new AmCharts.AmGraph();
    graph3.type = "smoothedLine";
    graph3.valueField = "sales";
    graph3.lineColor = "yellow";
    graph3.lineThickness = 3;
    graph3.bullet = "round";
    //graph1.bulletColor = "rgba(0,0,0,0.3)";
    graph3.bulletBorderColor = "yellow";
    graph3.bulletBorderAlpha = 1;
    graph3.bulletBorderThickness = 3;
    graph3.bulletSize = 6;
    graph3.fillAlphas = 0.2;
    graph3.fillColorsField = "#1c7dfa";
    chart.addGraph(graph3);
    




    // CURSOR
    var chartCursor = new AmCharts.ChartCursor();
    chart.addChartCursor(chartCursor);
    chartCursor.categoryBalloonAlpha = 0.2;
    chartCursor.cursorAlpha = 0.2;
    chartCursor.cursorColor = 'rgba(255,255,255,.8)';
    chartCursor.categoryBalloonEnabled = true;
    
    // WRITE
    chart.write("chartdiv");

});

